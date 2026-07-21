<?php

namespace App\Http\Controllers\SuperAdmin\UserManagement;

use App\Models\User;
use App\Models\Organization;
use App\Models\Lov;
use App\Models\LovType;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserManagement\OrganizationService;
use App\Services\OrganizationAuthService;
use App\Http\Requests\Organization\UpdateOrganizationRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrganizationController extends Controller
{
    protected $organizationService;
    protected $organizationAuthService;

    public function __construct(OrganizationService $organizationService, OrganizationAuthService $organizationAuthService)
    {
        $this->organizationService = $organizationService;
        $this->organizationAuthService = $organizationAuthService;
    }

    private function renderOrganizationRows($organizations, $view = 'super-admin.organization.single-organization-row')
    {
        $rows = '';
        $serialNumber = $organizations instanceof \Illuminate\Pagination\LengthAwarePaginator ? $organizations->firstItem() : 1;

        if ($organizations->count() > 0) {
            foreach ($organizations as $index => $org) {
                $rows .= view($view, [
                    'org' => $org,
                    'serialNumber' => $serialNumber + $index
                ])->render();
            }
        } else {
            $rows .= '<tr id="no-record-row"><td colspan="16" class="text-center">No record found</td></tr>';
        }

        return $rows;
    }

    public function index(Request $request)
    {
        try {
            $organizations = $this->organizationService->getOrganizations($request);

            if ($request->ajax()) {
                $rowsHtml = $this->renderOrganizationRows($organizations);
                $pagination = view('components.pagination', ['items' => $organizations])->render();

                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination,
                    'count' => $organizations->total(),
                ]);
            }

            return view('super-admin.organization.index', compact('organizations'));
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to fetch organizations', 'error' => $e->getMessage()], 500);
        }
    }

    public function create()
    {
        $industryAreas = Lov::lovsByType(LovType::INDUSTRY_TYPE_KSA);
        $serviceDomains = Lov::lovsByType(LovType::SERVICE_DOMAIN);
        $skills = Skill::where('is_active', true)->where('type', 'business')->get();
        
        return view('super-admin.organization.create', compact('industryAreas', 'serviceDomains', 'skills'));
    }

    public function store(UpdateOrganizationRequest $request)
    {
        DB::beginTransaction();
        try {
            // Validate and store company identity
            $companyIdentityData = $request->only([
                'organization_type',
                'name', 'website_url', 'secp_registration_number', 'pseb_registration_number',
                'pasha_registration_number', 'ceo_name', 'ceo_contact', 'ceo_email',
                'has_ksa_registered_company', 'saudi_entity_name', 'representative_name',
                'representative_contact', 'representative_email'
            ]);
            $companyIdentityData['company_logo'] = $request->file('company_logo');
            
            $organization = $this->organizationAuthService->handleCompanyIdentityStep($companyIdentityData, null);

            // Store company info - ensure industry_area is an integer
            $companyInfoData = $request->only([
                'company_type', 'years_of_experience', 'no_of_staff', 'has_company_certificate',
                'reference', 'no_of_projects', 'reference_project'
            ]);
            $companyInfoData['industry_area'] = (int) $request->input('industry_area');
            $companyInfoData['organization_id'] = $organization->id;
            $this->organizationAuthService->handleCompanyInfoStep($companyInfoData, $organization->id);

            // Store products if provided
            $productNames = $request->input('product_name', []);
            $productCapabilities = $request->input('product_capabilities', []);
            
            // Ensure arrays and filter out empty values
            if (!is_array($productNames)) {
                $productNames = $productNames ? [$productNames] : [];
            }
            if (!is_array($productCapabilities)) {
                $productCapabilities = $productCapabilities ? [$productCapabilities] : [];
            }
            
            // Filter out empty product names
            $productNames = array_filter($productNames, function($name) {
                return !empty(trim($name));
            });
            
            if (count($productNames) > 0) {
                // Ensure capabilities array matches names array length
                $capabilities = array_values($productCapabilities);
                while (count($capabilities) < count($productNames)) {
                    $capabilities[] = '';
                }
                $capabilities = array_slice($capabilities, 0, count($productNames));
                
                $productsData = [
                    'name' => array_values($productNames),
                    'capabilities' => $capabilities
                ];
                $this->organizationAuthService->handleProductsInfoStep($productsData, $organization->id);
            }

            // Store service info if provided
            $serviceDomains = $request->input('service_domains', []);
            $skills = $request->input('skills', []);
            
            // Ensure arrays
            if (!is_array($serviceDomains)) {
                $serviceDomains = $serviceDomains ? [$serviceDomains] : [];
            }
            if (!is_array($skills)) {
                $skills = $skills ? [$skills] : [];
            }
            
            // Only store if at least one service domain or skill is selected, or if IP/staff_certification is provided
            if (count($serviceDomains) > 0 || count($skills) > 0 || $request->filled('ip') || $request->filled('staff_certification')) {
                // Ensure we have at least empty arrays if nothing is selected
                if (count($serviceDomains) === 0) {
                    $serviceDomains = [];
                }
                if (count($skills) === 0) {
                    $skills = [];
                }
                
                $serviceInfoData = [
                    'service_domains' => array_values(array_filter($serviceDomains)),
                    'skills' => array_values(array_filter($skills)),
                    'ip' => $request->input('ip', ''),
                    'staff_certification' => $request->input('staff_certification', '')
                ];
                $this->organizationAuthService->handleServiceInfoStep($serviceInfoData, $organization->id);
            }

            // Set organization as verified by default when added by admin
            $organization->update(['is_verified' => 1, 'step' => 6]);
            $user = User::where('email', $organization->ceo_email)->first();
            if ($user) {
                $user->update(['is_active' => 1]);
            }

            DB::commit();
            return response()->json(['message' => 'Organization added successfully!']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Organization store error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return response()->json([
                'message' => 'Failed to add organization',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function invite(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|unique:users,email',
            ]);

            $this->organizationService->sendInvitation($request->email);

            return response()->json([
                'message' => 'Invitation sent successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to send invitation. Please try again.'
            ], 500);
        }
    }

    public function show($id, Request $request)
    {
        try {
            $organization = $this->organizationService->getOrganization($id);
            
            // Get attended events using the relationship
            $records = $request->per_page ?? 30;
            $sortBy = $request->sort_by ?? 'end_date';
            $sortOrder = $request->sort_order ?? 'desc';
            
            $attendedEvents = $organization->user->attendedEvents()
                ->applyFilter($request)
                ->orderBy($sortBy, $sortOrder)
                ->paginate($records)
                ->withQueryString();

            if ($request->ajax() && $request->has('tab') && $request->tab === 'attended-events') {
                $rowsHtml = $this->renderAttendedEventRows($attendedEvents);
                $pagination = view('components.pagination', ['items' => $attendedEvents])->render();

                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination,
                    'count' => $attendedEvents->total(),
                ]);
            }

            return view('super-admin.organization.detail', compact('organization', 'attendedEvents'));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch organization', 'error' => $e->getMessage()], 500);
        }
    }

    private function renderAttendedEventRows($events)
    {
        $rows = '';
        if ($events->count() > 0) {
            foreach ($events as $event) {
                $rows .= view('super-admin.organization.partials.single-attended-event-row', [
                    'event' => $event
                ])->render();
            }
        } else {
            $rows .= '<tr id="no-record-row"><td colspan="7" class="text-center">No attended events found</td></tr>';
        }
        return $rows;
    }
    public function edit($id)
    {
        try {
            $organization = $this->organizationService->getOrganization($id);
            
            if (!$organization) {
                return redirect()->route('organizations.index')->with('error', 'Organization not found');
            }
            
            $industryAreas = Lov::lovsByType(LovType::INDUSTRY_TYPE_KSA);
            $serviceDomains = Lov::lovsByType(LovType::SERVICE_DOMAIN);
            $skills = Skill::where('is_active', true)->where('type', 'business')->get();
            
            // Get organization's current skills
            $organizationSkills = $organization->user ? $organization->user->skills->pluck('id')->toArray() : [];
            
            // Get organization's current service domains using work_domain() method
            $organizationServiceDomains = [];
            if ($organization->user) {
                $organizationServiceDomains = $organization->user->work_domain()
                    ->get()
                    ->pluck('id')
                    ->toArray();
            }
            
            return view('super-admin.organization.edit', compact('organization', 'industryAreas', 'serviceDomains', 'skills', 'organizationSkills', 'organizationServiceDomains'));
        } catch (\Exception $e) {
            Log::error('Error loading organization for edit: ' . $e->getMessage(), [
                'organization_id' => $id,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('organizations.index')->with('error', 'Failed to load organization for editing: ' . $e->getMessage());
        }
    }

    public function update(UpdateOrganizationRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $organization = Organization::findOrFail($id);

            // Update company identity
            $companyIdentityData = $request->only([
                'name', 'website_url', 'secp_registration_number', 'pseb_registration_number',
                'pasha_registration_number', 'ceo_name', 'ceo_contact', 'ceo_email',
                'has_ksa_registered_company', 'saudi_entity_name', 'representative_name',
                'representative_contact', 'representative_email'
            ]);
            if ($request->hasFile('company_logo')) {
                $companyIdentityData['company_logo'] = $request->file('company_logo');
            }
            $this->organizationAuthService->handleCompanyIdentityStep($companyIdentityData, $organization->id);

            // Update company info
            $companyInfoData = $request->only([
                'company_type', 'years_of_experience', 'no_of_staff', 'has_company_certificate',
                'reference', 'no_of_projects', 'reference_project'
            ]);
            $companyInfoData['industry_area'] = (int) $request->input('industry_area');
            $companyInfoData['organization_id'] = $organization->id;
            $this->organizationAuthService->handleCompanyInfoStep($companyInfoData, $organization->id);

            // Update products if provided
            $productNames = $request->input('product_name', []);
            $productCapabilities = $request->input('product_capabilities', []);
            
            if (!is_array($productNames)) {
                $productNames = $productNames ? [$productNames] : [];
            }
            if (!is_array($productCapabilities)) {
                $productCapabilities = $productCapabilities ? [$productCapabilities] : [];
            }
            
            $productNames = array_filter($productNames, function($name) {
                return !empty(trim($name));
            });
            
            // Delete existing products and create new ones
            $organization->products()->delete();
            
            if (count($productNames) > 0) {
                $capabilities = array_values($productCapabilities);
                while (count($capabilities) < count($productNames)) {
                    $capabilities[] = '';
                }
                $capabilities = array_slice($capabilities, 0, count($productNames));
                
                $productsData = [
                    'name' => array_values($productNames),
                    'capabilities' => $capabilities
                ];
                $this->organizationAuthService->handleProductsInfoStep($productsData, $organization->id);
            }

            // Update service info and skills
            $serviceDomains = $request->input('service_domains', []);
            $skills = $request->input('skills', []);
            
            if (!is_array($serviceDomains)) {
                $serviceDomains = $serviceDomains ? [$serviceDomains] : [];
            }
            if (!is_array($skills)) {
                $skills = $skills ? [$skills] : [];
            }
            
            $serviceInfoData = [
                'service_domains' => array_values(array_filter($serviceDomains)),
                'skills' => array_values(array_filter($skills)),
                'ip' => $request->input('ip', ''),
                'staff_certification' => $request->input('staff_certification', '')
            ];
            $this->organizationAuthService->handleServiceInfoStep($serviceInfoData, $organization->id);

            DB::commit();
            return response()->json(['message' => 'Organization updated successfully!']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Organization update error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return response()->json([
                'message' => 'Failed to update organization',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            // Manually parse request data if not in input
            $org_id = $request->input('org_id');
            $action = $request->input('action');
            
            // If not in input, try parsing from raw body
            if (!$org_id || !$action) {
                parse_str($request->getContent(), $parsed);
                $org_id = $org_id ?? ($parsed['org_id'] ?? null);
                $action = $action ?? ($parsed['action'] ?? null);
                
                // Merge parsed data into request
                if ($org_id && $action) {
                    $request->merge([
                        'org_id' => $org_id,
                        'action' => $action
                    ]);
                }
            }
            
            $validated = $request->validate([
                'org_id' => 'required|integer|exists:organizations,id',
                'action' => 'required|string|in:approve,decline'
            ]);

            $this->organizationService->updateStatus($validated);
            DB::commit();
            
            $action = $validated['action'];
            $message = $action === 'approve' ? 'Organization approved successfully!' : 'Organization declined successfully!';
            
            return response()->json([
                'success' => true,
                'message' => $message,
                'action' => $action,
                'is_verified' => $action === 'approve' ? 1 : 0
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update organization',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->organizationService->deleteOrganization($id);
            DB::commit();
            return response()->json(['message' => 'Organization deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete organization', 'error' => $e->getMessage()], 500);
        }
    }
}
