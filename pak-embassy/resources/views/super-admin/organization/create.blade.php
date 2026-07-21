@extends("layouts.master")
@section("content")
    <div class="page-title">
        <h3>Add Organization</h3>
    </div>
    <div class="card border-0 py-3 px-2">
        <div class="row">
            <div class="col-12 mb-3">
                <a href="{{ route('organizations.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i>Go Back
                </a>
            </div>
        </div>

        <form id="addOrganizationForm" enctype="multipart/form-data" novalidate>
            @csrf
            
            <!-- 1- Company Identity -->
            <h5 class="section-title mt-4 mb-3">1- Company Identity</h5>
            <div class="row g-3">
                <div class="col-md-6 form-floating">
                    <select class="form-select" id="organization_type" name="organization_type" required>
                        <option value="PAK" selected>Pakistani Company</option>
                        <option value="KSA">Saudi (KSA) Company</option>
                    </select>
                    <label for="organization_type">Organization Type <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Organization Name" required>
                    <label for="name">Organization Name <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control" id="website_url" name="website_url" placeholder="Website URL" required>
                    <label for="website_url">Website URL <span class="text-danger website-required">*</span><span class="text-muted website-optional d-none"> (Optional)</span></label>
                </div>
                <div class="col-md-6 form-floating org-pak-only">
                    <input type="text" class="form-control" id="secp_registration_number" name="secp_registration_number" placeholder="SECP Registration No" required>
                    <label for="secp_registration_number">SECP Registration No <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating org-pak-only">
                    <input type="text" class="form-control" id="pseb_registration_number" name="pseb_registration_number" placeholder="PSEB Registration No" required>
                    <label for="pseb_registration_number">PSEB Registration No <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating org-pak-only">
                    <input type="text" class="form-control" id="pasha_registration_number" name="pasha_registration_number" placeholder="PASHA Registration No" required>
                    <label for="pasha_registration_number">PASHA Registration No <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control" id="ceo_name" name="ceo_name" placeholder="Name of CEO" required>
                    <label for="ceo_name">Name of CEO <span class="text-danger ceo-name-required">*</span><span class="text-muted ceo-name-optional d-none"> (Optional)</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control" id="ceo_contact" name="ceo_contact" placeholder="Contact of CEO" required>
                    <label for="ceo_contact">Contact of CEO <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="email" class="form-control" id="ceo_email" name="ceo_email" placeholder="Email of CEO" required>
                    <label for="ceo_email">Email of CEO <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating org-pak-only">
                    <select class="form-select" id="has_ksa_registered_company" name="has_ksa_registered_company" required>
                        <option value="" disabled selected>Select an option</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    <label for="has_ksa_registered_company">Do you have a registered company in KSA? <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control" id="saudi_entity_name" name="saudi_entity_name" placeholder="Name of Saudi Entity" required>
                    <label for="saudi_entity_name">Name of Saudi Entity <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control" id="representative_name" name="representative_name" placeholder="Company Representative Name" required>
                    <label for="representative_name">Company Representative Name <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control" id="representative_contact" name="representative_contact" placeholder="Representative Contact No" required>
                    <label for="representative_contact">Representative Contact No <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="email" class="form-control" id="representative_email" name="representative_email" placeholder="Email of Representative" required>
                    <label for="representative_email">Email of Representative <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Company Logo</label>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('company_logo').click()">Browse...</button>
                        <input type="text" id="logoFileName" class="form-control" placeholder="Select Logo" readonly>
                        <input type="file" id="company_logo" name="company_logo" class="d-none" accept="image/*" onchange="updateLogoFileName()">
                    </div>
                    <small class="text-danger company-logo-required">*</small>
                    <small class="text-muted company-logo-optional d-none">(Optional)</small>
                </div>
            </div>

            <!-- 2- Company Information -->
            <h5 class="section-title mt-5 mb-3">2- Company Information</h5>
            <div class="row g-3">
                <div class="col-md-6 form-floating">
                    <select class="form-select" id="company_type" name="company_type" required>
                        <option value="" disabled selected>Select an option</option>
                        <option value="product">Product</option>
                        <option value="services">Services</option>
                    </select>
                    <label for="company_type">Company Type <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="number" class="form-control" id="years_of_experience" name="years_of_experience" placeholder="No. of Years of Experience" min="0" required>
                    <label for="years_of_experience">No. of Years of Experience <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="number" class="form-control" id="no_of_staff" name="no_of_staff" placeholder="No. of Staff" min="1" required>
                    <label for="no_of_staff">No. of Staff <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <select class="form-select" id="has_company_certificate" name="has_company_certificate" required>
                        <option value="" disabled selected>Select an option</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    <label for="has_company_certificate">Company Certificate (if any) <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <select class="form-select" id="industry_area" name="industry_area" required>
                        <option value="" disabled selected>Select an option</option>
                        @foreach($industryAreas as $industry)
                            <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                        @endforeach
                    </select>
                    <label for="industry_area">Industry Area of Company in KSA <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control" id="reference" name="reference" placeholder="Reference/Existing Clients (Optional)">
                    <label for="reference">Reference/Existing Clients (Optional)</label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="number" class="form-control" id="no_of_projects" name="no_of_projects" placeholder="No. of Projects" min="0" required>
                    <label for="no_of_projects">No. of Projects <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control" id="reference_project" name="reference_project" placeholder="Reference Projects (Optional)">
                    <label for="reference_project">Reference Projects (Optional)</label>
                </div>
            </div>

            <!-- 3- Product Information -->
            <h5 class="section-title mt-5 mb-3">3- Product Information</h5>
            <div id="products-container">
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
                        <button type="button" class="btn form-select w-100 text-start" id="serviceDomainsBtn" data-bs-toggle="dropdown" aria-expanded="false">
                            Select service domain
                        </button>
                        <div class="dropdown-menu p-3 pb-0 text-nowrap" style="max-height: 300px; overflow-y: auto;">
                            @foreach($serviceDomains as $domain)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="service_domains[]" value="{{ $domain->id }}" id="serviceDomain{{ $domain->id }}">
                                    <label class="form-check-label" for="serviceDomain{{ $domain->id }}">{{ $domain->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Services Skills Involved <span class="text-danger">*</span></label>
                    <div class="dropdown">
                        <button type="button" class="btn form-select w-100 text-start" id="skillsBtn" data-bs-toggle="dropdown" aria-expanded="false">
                            Select skills
                        </button>
                        <div class="dropdown-menu p-3 pb-0 text-nowrap" style="max-height: 300px; overflow-y: auto;">
                            @foreach($skills as $skill)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="skills[]" value="{{ $skill->id }}" id="skill{{ $skill->id }}">
                                    <label class="form-check-label" for="skill{{ $skill->id }}">{{ $skill->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control" id="ip" name="ip" placeholder="Any IP on Implement Methodologies" required>
                    <label for="ip">Any IP on Implement Methodologies <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control" id="staff_certification" name="staff_certification" placeholder="Certifications of Staff in Various Domains" required>
                    <label for="staff_certification">Certifications of Staff in Various Domains <span class="text-danger">*</span></label>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12 text-end">
                    <button type="button" class="btn btn-outline-secondary me-2" onclick="window.location.href='{{ route('organizations.index') }}'">Cancel</button>
                    <button type="submit" class="btn btn-common-bg">Add Organization</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section("js-file")
    <script>
        let productCount = 1;

        function setOrganizationTypeValidation() {
            const orgType = $('#organization_type').val();
            const isKsa = orgType === 'KSA';
            const pakOnlyFields = ['secp_registration_number', 'pseb_registration_number', 'pasha_registration_number', 'has_ksa_registered_company'];

            // Required toggles
            $('#website_url').prop('required', isKsa);
            $('#ceo_name').prop('required', isKsa);
            $('#company_logo').prop('required', isKsa);
            $('#ceo_email').prop('required', true); // always required
            pakOnlyFields.forEach((fieldId) => {
                $(`#${fieldId}`).prop('required', !isKsa);
            });

            // Show/hide PAK-only fields
            $('.org-pak-only').toggleClass('d-none', isKsa);

            // When switched to KSA, clear hidden fields so payload does not keep old values
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

            // Optional labels
            $('.website-required').toggleClass('d-none', !isKsa);
            $('.website-optional').toggleClass('d-none', isKsa);
            $('.ceo-name-required').toggleClass('d-none', !isKsa);
            $('.ceo-name-optional').toggleClass('d-none', isKsa);
            $('.company-logo-required').toggleClass('d-none', !isKsa);
            $('.company-logo-optional').toggleClass('d-none', isKsa);
        }

        function updateLogoFileName() {
            const fileInput = document.getElementById('company_logo');
            const fileNameInput = document.getElementById('logoFileName');
            if (fileInput.files.length > 0) {
                fileNameInput.value = fileInput.files[0].name;
            }
        }

        $(document).ready(function() {
            setOrganizationTypeValidation();
            $('#organization_type').on('change', setOrganizationTypeValidation);
        });

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

        // Clear errors on input/change
        $(document).on('input change', '#addOrganizationForm input, #addOrganizationForm select, #addOrganizationForm textarea', function() {
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

        $('#addOrganizationForm').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                url: '{{ route('organizations.store') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    showToast(response.message || 'Organization added successfully!');
                    setTimeout(() => {
                        window.location.href = '{{ route('organizations.index') }}';
                    }, 1500);
                },
                error: function(xhr) {
                    // Clear previous errors
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                    $('.text-danger.small').remove();
                    $('.alert-danger').remove();
                    
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        let firstErrorField = null;
                        
                        // Display errors under respective fields
                        $.each(errors, function(field, messages) {
                            const errorMessage = Array.isArray(messages) ? messages[0] : messages;
                            
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
                                const forceInlineFields = ['secp_registration_number', 'pseb_registration_number', 'pasha_registration_number', 'has_ksa_registered_company'];
                                
                                // Try alternative selectors
                                if (!input.length) {
                                    input = $(`#${field}`);
                                }
                                
                                if (input.length) {
                                    input.addClass('is-invalid');

                                    // Force consistent error display for PAK-only identity fields.
                                    if (forceInlineFields.includes(field)) {
                                        const parent = input.closest('.col-md-6, .col-md-12');
                                        if (parent.length) {
                                            parent.find('.invalid-feedback, .text-danger.small').remove();
                                            parent.append(`<div class="text-danger small mt-1">${errorMessage}</div>`);
                                        } else {
                                            input.next('.invalid-feedback, .text-danger.small').remove();
                                            input.after(`<div class="text-danger small mt-1">${errorMessage}</div>`);
                                        }
                                        if (!firstErrorField) {
                                            firstErrorField = input;
                                        }
                                        return;
                                    }
                                    
                                    // For form-floating inputs
                                    const formFloating = input.closest('.form-floating');
                                    if (formFloating.length) {
                                        const existingError = formFloating.find('.invalid-feedback');
                                        if (existingError.length) {
                                            existingError.text(errorMessage);
                                        } else {
                                            formFloating.append(`<div class="invalid-feedback" style="display: block !important;">${errorMessage}</div>`);
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
                        let errorMsg = 'Failed to add organization';
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

