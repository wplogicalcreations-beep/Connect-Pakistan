@extends("layouts.master")
@section("content")
    <div class="page-title">
        <h3>Edit Organization</h3>
    </div>
    <div class="card border-0 py-3 px-2">
        <div class="row">
            <div class="col-12 mb-3">
                <a href="{{ route('organizations.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i>Go Back
                </a>
            </div>
        </div>

        <form id="editOrganizationForm" enctype="multipart/form-data" novalidate>
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="organization_id" value="{{ $organization->id }}">
            
            <!-- 1- Company Identity -->
            <h5 class="section-title mt-4 mb-3">1- Company Identity</h5>
            <div class="row g-3">
                <div class="col-md-6 form-floating">
                    <select class="form-select" id="organization_type" name="organization_type" required>
                        <option value="PAK" {{ old('organization_type', $organization->organization_type ?? 'PAK') === 'PAK' ? 'selected' : '' }}>Pakistani Company</option>
                        <option value="KSA" {{ old('organization_type', $organization->organization_type ?? 'PAK') === 'KSA' ? 'selected' : '' }}>Saudi (KSA) Company</option>
                    </select>
                    <label for="organization_type">Organization Type <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Organization Name" value="{{ old('name', $organization->name) }}" required>
                    <label for="name">Organization Name <span class="text-danger">*</span></label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control @error('website_url') is-invalid @enderror" id="website_url" name="website_url" placeholder="Website URL" value="{{ old('website_url', $organization->website_url) }}" required>
                    <label for="website_url">Website URL <span class="text-danger website-required">*</span><span class="text-muted website-optional d-none"> (Optional)</span></label>
                    @error('website_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating org-pak-only">
                    <input type="text" class="form-control @error('secp_registration_number') is-invalid @enderror" id="secp_registration_number" name="secp_registration_number" placeholder="SECP Registration No" value="{{ old('secp_registration_number', $organization->secp_registration_number) }}" required>
                    <label for="secp_registration_number">SECP Registration No <span class="text-danger">*</span></label>
                    @error('secp_registration_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating org-pak-only">
                    <input type="text" class="form-control @error('pseb_registration_number') is-invalid @enderror" id="pseb_registration_number" name="pseb_registration_number" placeholder="PSEB Registration No" value="{{ old('pseb_registration_number', $organization->pseb_registration_number) }}" required>
                    <label for="pseb_registration_number">PSEB Registration No <span class="text-danger">*</span></label>
                    @error('pseb_registration_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating org-pak-only">
                    <input type="text" class="form-control @error('pasha_registration_number') is-invalid @enderror" id="pasha_registration_number" name="pasha_registration_number" placeholder="PASHA Registration No" value="{{ old('pasha_registration_number', $organization->pasha_registration_number) }}" required>
                    <label for="pasha_registration_number">PASHA Registration No <span class="text-danger">*</span></label>
                    @error('pasha_registration_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control @error('ceo_name') is-invalid @enderror" id="ceo_name" name="ceo_name" placeholder="Name of CEO" value="{{ old('ceo_name', $organization->ceo_name) }}" required>
                    <label for="ceo_name">Name of CEO <span class="text-danger ceo-name-required">*</span><span class="text-muted ceo-name-optional d-none"> (Optional)</span></label>
                    @error('ceo_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control @error('ceo_contact') is-invalid @enderror" id="ceo_contact" name="ceo_contact" placeholder="Contact of CEO" value="{{ old('ceo_contact', $organization->ceo_contact) }}" required>
                    <label for="ceo_contact">Contact of CEO <span class="text-danger">*</span></label>
                    @error('ceo_contact')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <input type="email" class="form-control @error('ceo_email') is-invalid @enderror" id="ceo_email" name="ceo_email" placeholder="Email of CEO" value="{{ old('ceo_email', $organization->ceo_email) }}" required>
                    <label for="ceo_email">Email of CEO <span class="text-danger">*</span></label>
                    @error('ceo_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating org-pak-only">
                    <select class="form-select @error('has_ksa_registered_company') is-invalid @enderror" id="has_ksa_registered_company" name="has_ksa_registered_company" required>
                        <option value="" disabled>Select an option</option>
                        <option value="1" {{ old('has_ksa_registered_company', $organization->has_ksa_registered_company) == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('has_ksa_registered_company', $organization->has_ksa_registered_company) == 0 ? 'selected' : '' }}>No</option>
                    </select>
                    <label for="has_ksa_registered_company">Do you have a registered company in KSA? <span class="text-danger">*</span></label>
                    @error('has_ksa_registered_company')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control @error('saudi_entity_name') is-invalid @enderror" id="saudi_entity_name" name="saudi_entity_name" placeholder="Name of Saudi Entity" value="{{ old('saudi_entity_name', $organization->saudi_entity_name) }}" required>
                    <label for="saudi_entity_name">Name of Saudi Entity <span class="text-danger">*</span></label>
                    @error('saudi_entity_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control @error('representative_name') is-invalid @enderror" id="representative_name" name="representative_name" placeholder="Company Representative Name" value="{{ old('representative_name', $organization->representative_name) }}" required>
                    <label for="representative_name">Company Representative Name <span class="text-danger">*</span></label>
                    @error('representative_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control @error('representative_contact') is-invalid @enderror" id="representative_contact" name="representative_contact" placeholder="Representative Contact No" value="{{ old('representative_contact', $organization->representative_contact) }}" required>
                    <label for="representative_contact">Representative Contact No <span class="text-danger">*</span></label>
                    @error('representative_contact')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <input type="email" class="form-control @error('representative_email') is-invalid @enderror" id="representative_email" name="representative_email" placeholder="Email of Representative" value="{{ old('representative_email', $organization->representative_email) }}" required>
                    <label for="representative_email">Email of Representative <span class="text-danger">*</span></label>
                    @error('representative_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Company Logo <span class="text-danger company-logo-required">*</span><span class="text-muted company-logo-optional d-none"> (Optional)</span></label>
                    @if($organization->user && $organization->user->images->where('type', 'company_logo')->first())
                        <div class="mb-2">
                            <img id="existingCompanyLogo" src="{{ asset('storage/' . $organization->user->images->where('type', 'company_logo')->first()->path) }}" alt="Current Logo" style="max-height: 100px; border-radius: 5px;">
                        </div>
                    @endif
                    <div class="input-group">
                        <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('company_logo').click()">Browse...</button>
                        <input type="text" id="logoFileName" class="form-control @error('company_logo') is-invalid @enderror" placeholder="Select Logo" readonly>
                        <input type="file" id="company_logo" name="company_logo" class="d-none" accept="image/*" onchange="updateLogoFileName()">
                    </div>
                    @error('company_logo')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- 2- Company Information -->
            <h5 class="section-title mt-5 mb-3">2- Company Information</h5>
            <div class="row g-3">
                <div class="col-md-6 form-floating">
                    <select class="form-select @error('company_type') is-invalid @enderror" id="company_type" name="company_type" required>
                        <option value="" disabled>Select an option</option>
                        <option value="product" {{ old('company_type', $organization->company_type) == 'product' ? 'selected' : '' }}>Product</option>
                        <option value="services" {{ old('company_type', $organization->company_type) == 'services' ? 'selected' : '' }}>Services</option>
                    </select>
                    <label for="company_type">Company Type <span class="text-danger">*</span></label>
                    @error('company_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <input type="number" class="form-control @error('years_of_experience') is-invalid @enderror" id="years_of_experience" name="years_of_experience" placeholder="No. of Years of Experience" min="0" value="{{ old('years_of_experience', $organization->years_of_experience) }}" required>
                    <label for="years_of_experience">No. of Years of Experience <span class="text-danger">*</span></label>
                    @error('years_of_experience')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <input type="number" class="form-control @error('no_of_staff') is-invalid @enderror" id="no_of_staff" name="no_of_staff" placeholder="No. of Staff" min="1" value="{{ old('no_of_staff', $organization->no_of_staff) }}" required>
                    <label for="no_of_staff">No. of Staff <span class="text-danger">*</span></label>
                    @error('no_of_staff')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <select class="form-select @error('has_company_certificate') is-invalid @enderror" id="has_company_certificate" name="has_company_certificate" required>
                        <option value="" disabled>Select an option</option>
                        <option value="1" {{ old('has_company_certificate', $organization->has_company_certificate) == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('has_company_certificate', $organization->has_company_certificate) == 0 ? 'selected' : '' }}>No</option>
                    </select>
                    <label for="has_company_certificate">Company Certificate (if any) <span class="text-danger">*</span></label>
                    @error('has_company_certificate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <select class="form-select @error('industry_area') is-invalid @enderror" id="industry_area" name="industry_area" required>
                        <option value="" disabled>Select an option</option>
                        @foreach($industryAreas as $industry)
                            <option value="{{ $industry->id }}" {{ old('industry_area', $organization->user && $organization->user->lovs->where('pivot.lov_type_id', 3)->first() ? $organization->user->lovs->where('pivot.lov_type_id', 3)->first()->id : '') == $industry->id ? 'selected' : '' }}>{{ $industry->name }}</option>
                        @endforeach
                    </select>
                    <label for="industry_area">Industry Area of Company in KSA <span class="text-danger">*</span></label>
                    @error('industry_area')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control @error('reference') is-invalid @enderror" id="reference" name="reference" placeholder="Reference/Existing Clients (Optional)" value="{{ old('reference', $organization->reference) }}">
                    <label for="reference">Reference/Existing Clients (Optional)</label>
                    @error('reference')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <input type="number" class="form-control @error('no_of_projects') is-invalid @enderror" id="no_of_projects" name="no_of_projects" placeholder="No. of Projects" min="0" value="{{ old('no_of_projects', $organization->no_of_projects) }}" required>
                    <label for="no_of_projects">No. of Projects <span class="text-danger">*</span></label>
                    @error('no_of_projects')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control @error('reference_project') is-invalid @enderror" id="reference_project" name="reference_project" placeholder="Reference Projects (Optional)" value="{{ old('reference_project', $organization->reference_project) }}">
                    <label for="reference_project">Reference Projects (Optional)</label>
                    @error('reference_project')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- 3- Product Information -->
            <h5 class="section-title mt-5 mb-3">3- Product Information</h5>
            @error('product_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('product_name.*')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('product_capabilities')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('product_capabilities.*')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div id="products-container">
                @if($organization->products && $organization->products->count() > 0)
                    @foreach($organization->products as $index => $product)
                        <div class="row g-3 product-row mb-3">
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" id="product_name_{{ $index }}" name="product_name[]" placeholder="Product Name" value="{{ $product->name }}">
                                <label for="product_name_{{ $index }}">Product Name <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" id="product_capabilities_{{ $index }}" name="product_capabilities[]" placeholder="Product Capabilities" value="{{ $product->capabilities }}">
                                <label for="product_capabilities_{{ $index }}">Product Capabilities <span class="text-danger">*</span></label>
                            </div>
                            @if($index > 0)
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-sm btn-danger remove-product-btn">Remove</button>
                            </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="row g-3 product-row mb-3">
                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control" id="product_name_0" name="product_name[]" placeholder="Product Name">
                            <label for="product_name_0">Product Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control" id="product_capabilities_0" name="product_capabilities[]" placeholder="Product Capabilities">
                            <label for="product_capabilities_0">Product Capabilities <span class="text-danger">*</span></label>
                        </div>
                    </div>
                @endif
            </div>
            <div class="text-end mb-4">
                <button type="button" class="btn btn-common-bg" id="addProductBtn">+ Add New Product</button>
            </div>

            <!-- 4- Service Information -->
            <h5 class="section-title mt-5 mb-3">4- Service Information</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Services Domain <span class="text-danger">*</span></label>
                    <div class="dropdown">
                        <button type="button" class="btn form-select w-100 text-start @error('service_domains') is-invalid @enderror" id="serviceDomainsBtn" data-bs-toggle="dropdown" aria-expanded="false">
                            @php
                                $selectedDomainNames = [];
                                if (!empty($organizationServiceDomains)) {
                                    $selectedDomainNames = \App\Models\Lov::whereIn('id', $organizationServiceDomains)->pluck('name')->toArray();
                                }
                            @endphp
                            {{ count($selectedDomainNames) > 0 ? implode(', ', $selectedDomainNames) : 'Select service domain' }}
                        </button>
                        <div class="dropdown-menu p-3 pb-0 text-nowrap" style="max-height: 300px; overflow-y: auto;">
                            @foreach($serviceDomains as $domain)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="service_domains[]" value="{{ $domain->id }}" id="serviceDomain{{ $domain->id }}" {{ in_array($domain->id, $organizationServiceDomains ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="serviceDomain{{ $domain->id }}">{{ $domain->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @error('service_domains')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                    @error('service_domains.*')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Services Skills Involved <span class="text-danger">*</span></label>
                    <div class="dropdown">
                        <button type="button" class="btn form-select w-100 text-start @error('skills') is-invalid @enderror" id="skillsBtn" data-bs-toggle="dropdown" aria-expanded="false">
                            @php
                                $selectedSkills = $organization->user ? $organization->user->skills->pluck('name')->toArray() : [];
                            @endphp
                            {{ count($selectedSkills) > 0 ? implode(', ', $selectedSkills) : 'Select skills' }}
                        </button>
                        <div class="dropdown-menu p-3 pb-0 text-nowrap" style="max-height: 300px; overflow-y: auto;">
                            @foreach($skills as $skill)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="skills[]" value="{{ $skill->id }}" id="skill{{ $skill->id }}" {{ in_array($skill->id, $organizationSkills) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="skill{{ $skill->id }}">{{ $skill->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @error('skills')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                    @error('skills.*')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control @error('ip') is-invalid @enderror" id="ip" name="ip" placeholder="Any IP on Implement Methodologies" value="{{ old('ip', $organization->ip) }}" required>
                    <label for="ip">Any IP on Implement Methodologies <span class="text-danger">*</span></label>
                    @error('ip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control @error('staff_certification') is-invalid @enderror" id="staff_certification" name="staff_certification" placeholder="Certifications of Staff in Various Domains" value="{{ old('staff_certification', $organization->staff_certification) }}" required>
                    <label for="staff_certification">Certifications of Staff in Various Domains <span class="text-danger">*</span></label>
                    @error('staff_certification')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12 text-end">
                    <button type="button" class="btn btn-outline-secondary me-2" onclick="window.location.href='{{ route('organizations.index') }}'">Cancel</button>
                    <button type="submit" class="btn btn-common-bg">Update Organization</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section("js-file")
    <style>
        .form-floating .is-invalid ~ .invalid-feedback,
        .form-floating .is-invalid ~ label ~ .invalid-feedback {
            display: block !important;
        }
        .is-invalid + .text-danger {
            display: block !important;
        }
    </style>
    <script>
        let productCount = {{ $organization->products ? $organization->products->count() : 1 }};

        function setOrganizationTypeValidation() {
            const orgType = $('#organization_type').val();
            const isKsa = orgType === 'KSA';
            const pakOnlyFields = ['secp_registration_number', 'pseb_registration_number', 'pasha_registration_number', 'has_ksa_registered_company'];

            $('#website_url').prop('required', isKsa);
            $('#ceo_name').prop('required', isKsa);
            $('#company_logo').prop('required', isKsa);
            $('#ceo_email').prop('required', true);

            pakOnlyFields.forEach((fieldId) => {
                $(`#${fieldId}`).prop('required', !isKsa);
            });

            $('.org-pak-only').toggleClass('d-none', isKsa);
            $('.website-required').toggleClass('d-none', !isKsa);
            $('.website-optional').toggleClass('d-none', isKsa);
            $('.ceo-name-required').toggleClass('d-none', !isKsa);
            $('.ceo-name-optional').toggleClass('d-none', isKsa);
            $('.company-logo-required').toggleClass('d-none', !isKsa);
            $('.company-logo-optional').toggleClass('d-none', isKsa);

            // On KSA, clear hidden PAK-only fields to avoid stale payload values.
            if (isKsa) {
                pakOnlyFields.forEach((fieldId) => {
                    const $field = $(`#${fieldId}`);
                    $field.val('');
                    if ($field.is('select')) {
                        $field.prop('selectedIndex', 0);
                    }
                    $field.removeClass('is-invalid is-valid');
                    $field.closest('.form-floating').find('.invalid-feedback').remove();
                    $field.closest('.col-md-6, .col-md-12').find('.text-danger.small').remove();
                });
            }
        }

        function updateLogoFileName() {
            const fileInput = document.getElementById('company_logo');
            const fileNameInput = document.getElementById('logoFileName');
            if (fileInput.files.length > 0) {
                fileNameInput.value = fileInput.files[0].name;
            }
        }

        setOrganizationTypeValidation();
        $('#organization_type').on('change', setOrganizationTypeValidation);

        $('#addProductBtn').on('click', function() {
            const productRow = `
                <div class="row g-3 product-row mb-3">
                    <div class="col-md-6 form-floating">
                        <input type="text" class="form-control" id="product_name_${productCount}" name="product_name[]" placeholder="Product Name">
                        <label for="product_name_${productCount}">Product Name <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="text" class="form-control" id="product_capabilities_${productCount}" name="product_capabilities[]" placeholder="Product Capabilities">
                        <label for="product_capabilities_${productCount}">Product Capabilities <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-sm btn-danger remove-product-btn">Remove</button>
                    </div>
                </div>
            `;
            $('#products-container').append(productRow);
            productCount++;
        });

        $(document).on('click', '.remove-product-btn', function() {
            $(this).closest('.product-row').remove();
        });

        // Update dropdown button text for service domains
        $('input[name="service_domains[]"]').on('change', function() {
            const selected = $('input[name="service_domains[]"]:checked').map(function() {
                return $(this).siblings('label').text().trim();
            }).get();
            $('#serviceDomainsBtn').text(selected.length ? selected.join(', ') : 'Select service domain');
        });

        // Update dropdown button text for skills
        $('input[name="skills[]"]').on('change', function() {
            const selected = $('input[name="skills[]"]:checked').map(function() {
                return $(this).siblings('label').text().trim();
            }).get();
            $('#skillsBtn').text(selected.length ? selected.join(', ') : 'Select skills');
        });

        // Frontend validation function
        function validateForm() {
            let isValid = true;
            const errors = {};
            
            // Clear previous frontend errors
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            $('.text-danger.small').remove();
            $('.alert-danger').remove();
            
            // Validate required fields
            const requiredFields = {
                'organization_type': 'Organization type is required.',
                'name': 'Company name is required.',
                'website_url': 'Website URL is required for KSA organizations.',
                'ceo_name': 'CEO name is required for KSA organizations.',
                'ceo_contact': 'CEO contact number is required.',
                'ceo_email': 'CEO email is required.',
                'saudi_entity_name': 'Saudi entity name is required.',
                'representative_name': 'Representative name is required.',
                'representative_contact': 'Representative contact number is required.',
                'representative_email': 'Representative email is required.',
                'company_type': 'Company type is required.',
                'years_of_experience': 'Years of experience is required.',
                'no_of_staff': 'Number of staff is required.',
                'has_company_certificate': 'Please specify if the company has a certificate.',
                'industry_area': 'Industry area is required.',
                'no_of_projects': 'Number of projects is required.',
                'ip': 'IP on Implement Methodologies is required.',
                'staff_certification': 'Staff certification information is required.'
            };

            const isKsa = $('#organization_type').val() === 'KSA';
            if (!isKsa) {
                delete requiredFields.website_url;
                delete requiredFields.ceo_name;
                requiredFields.secp_registration_number = 'SECP registration number is required.';
                requiredFields.pseb_registration_number = 'PSEB registration number is required.';
                requiredFields.pasha_registration_number = 'PASHA registration number is required.';
                requiredFields.has_ksa_registered_company = 'Please specify if the company is registered in KSA.';
            } else {
                const hasExistingLogo = $('#existingCompanyLogo').length > 0;
                requiredFields.company_logo = 'Company logo is required for KSA organizations.';
                if (hasExistingLogo && !$('#company_logo').val()) {
                    delete requiredFields.company_logo;
                }
            }
            
            // Validate regular required fields
            $.each(requiredFields, function(field, message) {
                const input = $(`[name="${field}"]`);
                if (input.length) {
                    const value = input.val();
                    if (!value || value.trim() === '' || value === '') {
                        isValid = false;
                        errors[field] = [message];
                        displayFieldError(field, message);
                    }
                }
            });
            
            // Validate email fields
            const emailFields = {
                'ceo_email': 'Please enter a valid CEO email address.',
                'representative_email': 'Please enter a valid representative email address.'
            };
            
            $.each(emailFields, function(field, message) {
                const input = $(`[name="${field}"]`);
                if (input.length && input.val()) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(input.val())) {
                        isValid = false;
                        errors[field] = [message];
                        displayFieldError(field, message);
                    }
                }
            });
            
            // Validate URL
            const websiteUrl = $('[name="website_url"]').val();
            if (websiteUrl) {
                try {
                    new URL(websiteUrl);
                } catch (e) {
                    isValid = false;
                    errors['website_url'] = ['Please enter a valid website URL.'];
                    displayFieldError('website_url', 'Please enter a valid website URL.');
                }
            }
            
            // Validate contact numbers (9665XXXXXXXX format)
            const contactFields = {
                'ceo_contact': 'CEO contact must start with 9665 and be 12 digits total (9665XXXXXXXX).',
                'representative_contact': 'Representative contact must start with 9665 and be 12 digits total (9665XXXXXXXX).'
            };
            
            $.each(contactFields, function(field, message) {
                const input = $(`[name="${field}"]`);
                if (input.length && input.val()) {
                    const contactRegex = /^9665\d{8}$/;
                    if (!contactRegex.test(input.val())) {
                        isValid = false;
                        errors[field] = [message];
                        displayFieldError(field, message);
                    }
                }
            });
            
            // Validate product fields
            const productNames = $('[name="product_name[]"]').filter(function() {
                return $(this).val() && $(this).val().trim() !== '';
            });
            
            if (productNames.length === 0) {
                isValid = false;
                errors['product_name'] = ['At least one product name is required.'];
                const container = $('#products-container');
                if (container.length && !container.find('.alert-danger').length) {
                    container.prepend(`<div class="alert alert-danger mb-3">At least one product name is required.</div>`);
                }
            }
            
            // Validate product capabilities
            const productCapabilities = $('[name="product_capabilities[]"]').filter(function() {
                return $(this).val() && $(this).val().trim() !== '';
            });
            
            if (productCapabilities.length === 0) {
                isValid = false;
                errors['product_capabilities'] = ['At least one product capability is required.'];
                const container = $('#products-container');
                if (container.find('.alert-danger').length === 0) {
                    container.prepend(`<div class="alert alert-danger mb-3">At least one product capability is required.</div>`);
                }
            }
            
            // Validate service domains
            const serviceDomains = $('[name="service_domains[]"]:checked');
            if (serviceDomains.length === 0) {
                isValid = false;
                errors['service_domains'] = ['At least one service domain must be selected.'];
                const dropdown = $('#serviceDomainsBtn');
                if (dropdown.length) {
                    dropdown.addClass('is-invalid');
                    const parent = dropdown.closest('.col-md-6');
                    if (!parent.find('.text-danger.small').length) {
                        parent.append(`<div class="text-danger small mt-1">At least one service domain must be selected.</div>`);
                    }
                }
            }
            
            // Validate skills
            const skills = $('[name="skills[]"]:checked');
            if (skills.length === 0) {
                isValid = false;
                errors['skills'] = ['At least one skill must be selected.'];
                const dropdown = $('#skillsBtn');
                if (dropdown.length) {
                    dropdown.addClass('is-invalid');
                    const parent = dropdown.closest('.col-md-6');
                    if (!parent.find('.text-danger.small').length) {
                        parent.append(`<div class="text-danger small mt-1">At least one skill must be selected.</div>`);
                    }
                }
            }
            
            return isValid;
        }
        
        // Function to display error under a field
        function displayFieldError(field, message) {
            let input = $(`[name="${field}"]`);
            const forceInlineFields = ['secp_registration_number', 'pseb_registration_number', 'pasha_registration_number', 'has_ksa_registered_company'];
            
            if (!input.length) {
                input = $(`#${field}`);
            }
            
            if (input.length) {
                input.addClass('is-invalid');

                // Force consistent red-border + inline message for these PAK-only fields.
                if (forceInlineFields.includes(field)) {
                    const parent = input.closest('.col-md-6, .col-md-12');
                    if (parent.length) {
                        parent.find('.invalid-feedback, .text-danger.small').remove();
                        parent.append(`<div class="text-danger small mt-1">${message}</div>`);
                    } else {
                        input.next('.invalid-feedback, .text-danger.small').remove();
                        input.after(`<div class="text-danger small mt-1">${message}</div>`);
                    }
                    return;
                }
                
                // For form-floating inputs
                const formFloating = input.closest('.form-floating');
                if (formFloating.length) {
                    // Remove existing error
                    formFloating.find('.invalid-feedback').remove();
                    // Add error message after the label (inside form-floating)
                    const label = formFloating.find('label');
                    if (label.length) {
                        label.after(`<div class="invalid-feedback" style="display: block !important; margin-top: 0.25rem;">${message}</div>`);
                    } else {
                        formFloating.append(`<div class="invalid-feedback" style="display: block !important; margin-top: 0.25rem;">${message}</div>`);
                    }
                }
                // For select dropdowns (form-floating)
                else if (input.is('select')) {
                    const selectFormFloating = input.closest('.form-floating');
                    if (selectFormFloating.length) {
                        selectFormFloating.find('.invalid-feedback').remove();
                        const label = selectFormFloating.find('label');
                        if (label.length) {
                            label.after(`<div class="invalid-feedback" style="display: block !important; margin-top: 0.25rem;">${message}</div>`);
                        } else {
                            selectFormFloating.append(`<div class="invalid-feedback" style="display: block !important; margin-top: 0.25rem;">${message}</div>`);
                        }
                    } else {
                        // Select without form-floating
                        const parent = input.closest('.col-md-6, .col-md-12');
                        if (parent.length) {
                            parent.find('.text-danger.small').remove();
                            parent.append(`<div class="text-danger small mt-1">${message}</div>`);
                        }
                    }
                }
                // For other inputs (not form-floating)
                else {
                    // Remove existing error
                    input.next('.invalid-feedback, .text-danger.small').remove();
                    // Add error after input
                    input.after(`<div class="text-danger small mt-1">${message}</div>`);
                }
            } else {
                console.warn(`Field not found for error display: ${field}`);
            }
        }
        
        // Clear errors on input/change
        $(document).on('input change', '#editOrganizationForm input, #editOrganizationForm select, #editOrganizationForm textarea', function() {
            const field = $(this);
            field.removeClass('is-invalid');
            field.closest('.form-floating').find('.invalid-feedback').remove();
            field.closest('.col-md-6, .col-md-12').find('.text-danger.small').remove();
            const fieldId = field.attr('name') || field.attr('id');
            if (fieldId) {
                $('#' + fieldId.replace(/\./g, '_') + '_error').text('');
            }
        });

        // Auto-clear all errors after 5 seconds
        let errorTimeout;
        function clearErrorsAfterTimeout() {
            clearTimeout(errorTimeout);
            errorTimeout = setTimeout(function() {
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').fadeOut(300, function() { $(this).remove(); });
                $('.text-danger.small').fadeOut(300, function() { $(this).remove(); });
                $('.alert-danger').fadeOut(300, function() { $(this).remove(); });
            }, 5000);
        }

        $('#editOrganizationForm').on('submit', function(e) {
            e.preventDefault();
            
            // Run frontend validation
            if (!validateForm()) {
                // Scroll to first error
                const firstError = $('.is-invalid').first();
                if (firstError.length) {
                    $('html, body').animate({
                        scrollTop: firstError.offset().top - 100
                    }, 500);
                }
                return false;
            }
            
            const formData = new FormData(this);

            $.ajax({
                url: '{{ route('organizations.update', $organization->id) }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    showToast(response.message || 'Organization updated successfully!');
                    setTimeout(() => {
                        window.location.href = '{{ route('organizations.index') }}';
                    }, 1500);
                },
                error: function(xhr) {
                    console.log('Error response:', xhr.responseJSON); // Debug log
                    
                    // Clear previous errors
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                    $('.text-danger.small').remove();
                    $('.alert-danger').remove();
                    
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        let firstErrorField = null;
                        
                        // Start auto-clear timer
                        clearErrorsAfterTimeout();
                        
                        console.log('Validation errors:', errors); // Debug log
                        
                        // Display errors under respective fields
                        $.each(errors, function(field, messages) {
                            const errorMessage = Array.isArray(messages) ? messages[0] : messages;
                            console.log(`Processing error for field: ${field}, message: ${errorMessage}`); // Debug log
                            
                            // Handle array fields like product_name.*, service_domains.*, skills.*
                            if (field.includes('.*')) {
                                const baseField = field.replace('.*', '');
                                
                                // For product fields
                                if (baseField === 'product_name' || baseField === 'product_capabilities') {
                                    const container = $('#products-container');
                                    if (container.length) {
                                        const existingAlert = container.find('.alert-danger').first();
                                        if (existingAlert.length) {
                                            existingAlert.text(errorMessage);
                                        } else {
                                            container.prepend(`<div class="alert alert-danger mb-3">${errorMessage}</div>`);
                                        }
                                    }
                                }
                                // For service_domains
                                else if (baseField === 'service_domains') {
                                    const dropdown = $('#serviceDomainsBtn');
                                    if (dropdown.length) {
                                        dropdown.addClass('is-invalid');
                                        const parent = dropdown.closest('.col-md-6');
                                        const existingError = parent.find('.text-danger.small');
                                        if (existingError.length) {
                                            existingError.text(errorMessage);
                                        } else {
                                            parent.append(`<div class="text-danger small mt-1">${errorMessage}</div>`);
                                        }
                                    }
                                }
                                // For skills
                                else if (baseField === 'skills') {
                                    const dropdown = $('#skillsBtn');
                                    if (dropdown.length) {
                                        dropdown.addClass('is-invalid');
                                        const parent = dropdown.closest('.col-md-6');
                                        const existingError = parent.find('.text-danger.small');
                                        if (existingError.length) {
                                            existingError.text(errorMessage);
                                        } else {
                                            parent.append(`<div class="text-danger small mt-1">${errorMessage}</div>`);
                                        }
                                    }
                                }
                            }
                            // Handle base array fields (product_name, service_domains, skills)
                            else if (field === 'product_name' || field === 'product_capabilities') {
                                const container = $('#products-container');
                                if (container.length) {
                                    const existingAlert = container.find('.alert-danger').first();
                                    if (existingAlert.length) {
                                        existingAlert.text(errorMessage);
                                    } else {
                                        container.prepend(`<div class="alert alert-danger mb-3">${errorMessage}</div>`);
                                    }
                                }
                            }
                            else if (field === 'service_domains') {
                                const dropdown = $('#serviceDomainsBtn');
                                if (dropdown.length) {
                                    dropdown.addClass('is-invalid');
                                    const parent = dropdown.closest('.col-md-6');
                                    const existingError = parent.find('.text-danger.small');
                                    if (existingError.length) {
                                        existingError.text(errorMessage);
                                    } else {
                                        parent.append(`<div class="text-danger small mt-1">${errorMessage}</div>`);
                                    }
                                }
                            }
                            else if (field === 'skills') {
                                const dropdown = $('#skillsBtn');
                                if (dropdown.length) {
                                    dropdown.addClass('is-invalid');
                                    const parent = dropdown.closest('.col-md-6');
                                    const existingError = parent.find('.text-danger.small');
                                    if (existingError.length) {
                                        existingError.text(errorMessage);
                                    } else {
                                        parent.append(`<div class="text-danger small mt-1">${errorMessage}</div>`);
                                    }
                                }
                            }
                            // Handle regular fields
                            else {
                                let input = $(`[name="${field}"]`);
                                
                                // Try alternative selectors
                                if (!input.length) {
                                    input = $(`#${field}`);
                                }
                                
                                if (input.length) {
                                    input.addClass('is-invalid');
                                    
                                    // For form-floating inputs
                                    const formFloating = input.closest('.form-floating');
                                    if (formFloating.length) {
                                        const existingError = formFloating.find('.invalid-feedback');
                                        if (existingError.length) {
                                            existingError.text(errorMessage);
                                        } else {
                                            formFloating.append(`<div class="invalid-feedback">${errorMessage}</div>`);
                                        }
                                    }
                                    // For select dropdowns without form-floating
                                    else if (input.is('select')) {
                                        const parent = input.closest('.col-md-6, .col-md-12');
                                        if (parent.length) {
                                            const existingError = parent.find('.text-danger.small');
                                            if (existingError.length) {
                                                existingError.text(errorMessage);
                                            } else {
                                                parent.append(`<div class="text-danger small mt-1">${errorMessage}</div>`);
                                            }
                                        }
                                    }
                                    // For other inputs
                                    else {
                                        const existingError = input.next('.invalid-feedback, .text-danger.small');
                                        if (existingError.length) {
                                            existingError.text(errorMessage);
                                        } else {
                                            input.after(`<div class="text-danger small mt-1">${errorMessage}</div>`);
                                        }
                                    }
                                    
                                    // Track first error field for scrolling
                                    if (!firstErrorField) {
                                        firstErrorField = input;
                                    }
                                } else {
                                    console.warn(`Field not found: ${field}`); // Debug log
                                }
                            }
                        });
                        
                        // Scroll to first error field
                        if (firstErrorField && firstErrorField.length) {
                            $('html, body').animate({
                                scrollTop: firstErrorField.offset().top - 100
                            }, 500);
                        } else {
                            // Scroll to first error container
                            const firstErrorContainer = $('.is-invalid, .alert-danger').first();
                            if (firstErrorContainer.length) {
                                $('html, body').animate({
                                    scrollTop: firstErrorContainer.offset().top - 100
                                }, 500);
                            }
                        }
                    } else {
                        // Only show toast for non-validation errors
                        let errorMsg = 'Failed to update organization';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        showToast(errorMsg, 'error');
                    }
                }
            });
        });
    </script>
@endsection

