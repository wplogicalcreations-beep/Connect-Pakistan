<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\OrganizationAuthService;
use App\Http\Requests\Organization\StorePasscodeRequest;
use App\Http\Requests\Organization\ChangePasscodeRequest;
use App\Http\Requests\Organization\StoreCompanyInfoRequest;
use App\Http\Requests\Organization\StoreServiceInfoRequest;
use App\Http\Requests\Organization\StoreProductsInfoRequest;
use App\Http\Requests\Organization\StoreCompanyIdentityRequest;
use App\Http\Requests\Organization\SignInRequest;
use Illuminate\Support\Facades\Auth;

class OrganizationAuthController extends Controller
{
    protected $organizationAuthService;

    public function __construct(OrganizationAuthService $organizationAuthService)
    {
        $this->organizationAuthService = $organizationAuthService;
    }

    /**
     * Store company identity step data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeCompanyIdentity(StoreCompanyIdentityRequest $request)
    {
        DB::beginTransaction();

        try {
            $organization = $this->organizationAuthService->handleCompanyIdentityStep($request->validated(), $request->organization_id);

            DB::commit();
            return response()->json([
                'message' => 'Company identity saved successfully',
                'organization' => $organization
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeCompanyInfo(StoreCompanyInfoRequest $request)
    {
        DB::beginTransaction();

        try {
            $organization = $this->organizationAuthService->handleCompanyInfoStep($request->validated(), $request->organization_id);

            DB::commit();
            return response()->json(['message' => 'Company info saved successfully.', 'organization' => $organization, 'industryArea' => $organization->industry_area], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeProductsInfo(StoreProductsInfoRequest $request)
    {
        DB::beginTransaction();

        try {
            $organization = $this->organizationAuthService->handleProductsInfoStep($request->validated(), $request->organization_id);

            DB::commit();
            return response()->json(['message' => 'Product info saved successfully.', 'organization' => $organization], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeServiceInfo(StoreServiceInfoRequest $request)
    {
        DB::beginTransaction();

        try {
            $organization = $this->organizationAuthService->handleServiceInfoStep($request->validated(), $request->organization_id);

            DB::commit();
            return response()->json(['message' => 'Service info saved successfully', 'organization' => $organization, 'serviceDomains' => $organization->serviceDomains, 'skills' => $organization->skills], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storePasscode(StorePasscodeRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $this->organizationAuthService->handlePasscodeStep(
                $request->validated()['organization_id'],
                $request->validated()['passcode']
            );

            DB::commit();
            return response()->json([
                'organization' => $data['organization'],
                'industryArea' => $data['industryArea'],
                'serviceDomains' => $data['serviceDomains'],
                'skills' => $data['skills'],
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function accountVerification(Request $request)
    {
        DB::beginTransaction();

        try {
            $this->organizationAuthService->handleAccountVerification($request);

            DB::commit();
            return response()->json(['message' => 'Account verified successfully.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function checkEmail(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);
            $user = $this->organizationAuthService->handleCheckEmail($request->email);
            if (!$user) {
                return response()->json(['error' => 'Please enter valid email'], 404);
            }
            if (!$user->is_active) {
                return response()->json(['error' => 'Your account is inactive'], 403);
            }

            return response()->json(['message' => 'Email verified'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function signIn(SignInRequest $request)
    {
        try {
            $user = $this->organizationAuthService->handleSignIn(
                $request->validated()['email'],
                $request->validated()['passcode']
            );
            if (!$user) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
            $user = $user['user'];
            Auth::login($user, filter_var($request->validated()['remember'] ?? false, FILTER_VALIDATE_BOOLEAN));

            return response()->json([
                'message' => 'Signed in successfully',
                'user'    => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getOrganizationData(Request $request)
    {
        try {
            $request->validate([
                'organization_id' => ['required', 'integer', 'exists:organizations,id'],
            ]);
            
            $data = $this->organizationAuthService->getOrganizationData($request->organization_id);
            
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function changePasscode(ChangePasscodeRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json(['error' => 'User not authenticated.'], 401);
            }

            $this->organizationAuthService->changePasscode(
                $user,
                $request->validated()['old_passcode'],
                $request->validated()['new_passcode']
            );

            DB::commit();
            return response()->json(['message' => 'Passcode changed successfully.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}