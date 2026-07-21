@extends("layouts.master")
@section("content")
    <div class="page-title">
        <h3>Add Individual</h3>
    </div>
    <div class="card border-0 py-3 px-2">
        <div class="row">
            <div class="col-12 mb-3">
                <a href="{{ route('skilled_individuals.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i>Go Back
                </a>
            </div>
        </div>

        <form id="addIndividualForm" enctype="multipart/form-data">
            @csrf
            
            <!-- 1- Personal Information -->
            <h5 class="section-title mt-4 mb-3">1- Personal Information</h5>
            <div class="row g-3">
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                    <label for="name">Full Name <span class="text-danger">*</span></label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="name_error" class="text-danger small"></div>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control @error('passport_no') is-invalid @enderror" id="passport_no" name="passport_no" placeholder="Passport No" value="{{ old('passport_no') }}" required>
                    <label for="passport_no">Passport no. <span class="text-danger">*</span></label>
                    @error('passport_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="passport_no_error" class="text-danger small"></div>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control @error('iqama_id') is-invalid @enderror" id="iqama_id" name="iqama_id" placeholder="Iqama ID" value="{{ old('iqama_id') }}" required>
                    <label for="iqama_id">Iqama ID <span class="text-danger">*</span></label>
                    @error('iqama_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="iqama_id_error" class="text-danger small"></div>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Mobile No" value="{{ old('phone') }}" required>
                    <label for="phone">Mobile No. <span class="text-danger">*</span></label>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="phone_error" class="text-danger small"></div>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    <label for="email">Email ID <span class="text-danger">*</span></label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="email_error" class="text-danger small"></div>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control @error('linkedin_url') is-invalid @enderror" id="linkedin_url" name="linkedin_url" placeholder="LinkedIn Profile" value="{{ old('linkedin_url') }}">
                    <label for="linkedin_url">LinkedIn Profile</label>
                    @error('linkedin_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="linkedin_url_error" class="text-danger small"></div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Profile Photo</label>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('image').click()">Browse...</button>
                        <input type="text" id="imageFileName" class="form-control" placeholder="Select Photo" readonly>
                        <input type="file" id="image" name="image" class="d-none" accept="image/*" onchange="updateImageFileName()">
                    </div>
                    @error('image')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <div id="image_error" class="text-danger small"></div>
                </div>
            </div>

            <!-- 2- Employment Information -->
            <h5 class="section-title mt-5 mb-3">2- Employment Information</h5>
            <div class="row g-3">
                <div class="col-md-6 form-floating">
                    <select class="form-select @error('level_id') is-invalid @enderror" id="level_id" name="level_id" required>
                        <option value="" disabled selected>Select Level</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                        @endforeach
                    </select>
                    <label for="level_id">Level <span class="text-danger">*</span></label>
                    @error('level_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="level_id_error" class="text-danger small"></div>
                </div>
                <div class="col-md-6 form-floating">
                    <select class="form-select @error('influence_ability_id') is-invalid @enderror" id="influence_ability_id" name="influence_ability_id" required>
                        <option value="" disabled selected>Select Influence Ability</option>
                        @foreach($influence_abilities as $influence_ability)
                            <option value="{{ $influence_ability->id }}" {{ old('influence_ability_id') == $influence_ability->id ? 'selected' : '' }}>{{ $influence_ability->name }}</option>
                        @endforeach
                    </select>
                    <label for="influence_ability_id">Influence Ability <span class="text-danger">*</span></label>
                    @error('influence_ability_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="influence_ability_id_error" class="text-danger small"></div>
                </div>
            </div>

            <!-- 3- Employment Area -->
            <h5 class="section-title mt-5 mb-3">3- Employment Area</h5>
            <div class="row g-3">
                <div class="col-md-6 form-floating">
                    <select class="form-select @error('industry_area_id') is-invalid @enderror" id="industry_area_id" name="industry_area_id" required>
                        <option value="" disabled selected>Select Industry Area</option>
                        @foreach($industry_areas as $industry_area)
                            <option value="{{ $industry_area->id }}" {{ old('industry_area_id') == $industry_area->id ? 'selected' : '' }}>{{ $industry_area->name }}</option>
                        @endforeach
                    </select>
                    <label for="industry_area_id">Employer Industry <span class="text-danger">*</span></label>
                    @error('industry_area_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="industry_area_id_error" class="text-danger small"></div>
                </div>
                <div class="col-md-6 form-floating">
                    <select class="form-select @error('work_domain_id') is-invalid @enderror" id="work_domain_id" name="work_domain_id" required>
                        <option value="" disabled selected>Select Work Domain</option>
                        @foreach($work_domains as $work_domain)
                            <option value="{{ $work_domain->id }}" {{ old('work_domain_id') == $work_domain->id ? 'selected' : '' }}>{{ $work_domain->name }}</option>
                        @endforeach
                    </select>
                    <label for="work_domain_id">Work Domain <span class="text-danger">*</span></label>
                    @error('work_domain_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="work_domain_id_error" class="text-danger small"></div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Skills <span class="text-danger">*</span></label>
                    <div class="dropdown">
                        <button type="button" class="btn form-select w-100 text-start @error('skills') is-invalid @enderror" id="skillsBtn" data-bs-toggle="dropdown" aria-expanded="false">
                            Select skills
                        </button>
                        <div class="dropdown-menu p-3 pb-0 text-nowrap" style="max-height: 300px; overflow-y: auto;">
                            @foreach($skills as $skill)
                                <div class="form-check">
                                    <input class="form-check-input skill-checkbox" type="checkbox" name="skills[]" value="{{ $skill->id }}" id="skill{{ $skill->id }}">
                                    <label class="form-check-label" for="skill{{ $skill->id }}">{{ $skill->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @error('skills')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <div id="skills_error" class="text-danger small"></div>
                </div>
                <!-- <div class="col-md-6">
                    <label for="additional_skills" class="form-label">Additional Skills</label>
                    <div class="tags-input-container form-control" id="additional_skills_container" style="min-height: 38px; display: flex; flex-wrap: wrap; align-items: flex-start; gap: 5px; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 0.375rem;">
                        <input type="text" id="additional_skills_input" class="border-0 flex-grow-1" placeholder="Type and press Enter" style="outline: none; min-width: 120px; flex: 1;">
                    </div>
                    <input type="hidden" name="additional_skills" id="additional_skills_hidden">
                    @error('additional_skills')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <div id="additional_skills_error" class="text-danger small"></div>
                </div> -->
            </div>

            <div class="row mt-4">
                <div class="col-12 text-end">
                    <button type="button" class="btn btn-outline-secondary me-2" onclick="window.location.href='{{ route('skilled_individuals.index') }}'">Cancel</button>
                    <button type="submit" class="btn btn-common-bg">Add Individual</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section("js-file")
    <script>
        function updateImageFileName() {
            const fileInput = document.getElementById('image');
            const fileNameInput = document.getElementById('imageFileName');
            if (fileInput.files.length > 0) {
                fileNameInput.value = fileInput.files[0].name;
            }
        }

        // Update dropdown button text for skills
        $('input[name="skills[]"]').on('change', function() {
            const selected = $('input[name="skills[]"]:checked').map(function() {
                return $(this).siblings('label').text().trim();
            }).get();
            $('#skillsBtn').text(selected.length ? selected.join(', ') : 'Select skills');
            
            // Remove invalid class if skills are selected
            if (selected.length > 0) {
                $('#skillsBtn').removeClass('is-invalid');
            }
        });

        // Additional skills tags input
        let additionalSkills = [];
        const additionalSkillsInput = document.getElementById('additional_skills_input');
        const additionalSkillsContainer = document.getElementById('additional_skills_container');
        const additionalSkillsHidden = document.getElementById('additional_skills_hidden');

        // Only add event listeners if the elements exist (not commented out)
        if (additionalSkillsInput && additionalSkillsContainer && additionalSkillsHidden) {
            additionalSkillsInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const value = this.value.trim();
                    if (value && !additionalSkills.includes(value)) {
                        additionalSkills.push(value);
                        updateAdditionalSkillsDisplay();
                        this.value = '';
                    }
                }
            });

            function updateAdditionalSkillsDisplay() {
                additionalSkillsContainer.innerHTML = '';
                additionalSkills.forEach((skill, index) => {
                    const tag = document.createElement('span');
                    tag.className = 'badge bg-secondary me-1 mb-1';
                    tag.style.cursor = 'pointer';
                    tag.innerHTML = skill + ' <i class="fa fa-times"></i>';
                    tag.onclick = function() {
                        additionalSkills.splice(index, 1);
                        updateAdditionalSkillsDisplay();
                    };
                    additionalSkillsContainer.appendChild(tag);
                });
                additionalSkillsContainer.appendChild(additionalSkillsInput);
                additionalSkillsHidden.value = JSON.stringify(additionalSkills);
            }
        }

        // Clear errors on input/change
        $(document).on('input change', '#addIndividualForm input, #addIndividualForm select, #addIndividualForm textarea', function() {
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

        // Form submission
        $('#addIndividualForm').on('submit', function(e) {
            e.preventDefault();
            
            // Update additional skills hidden input if it exists
            if (additionalSkillsHidden) {
                additionalSkillsHidden.value = JSON.stringify(additionalSkills);
            }
            
            const formData = new FormData(this);

            $.ajax({
                url: '{{ route('skilled_individuals.store') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    showToast(response.message || 'Individual added successfully!');
                    setTimeout(() => {
                        window.location.href = '{{ route('skilled_individuals.index') }}';
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
                        
                        $.each(errors, function(field, messages) {
                            const errorMessage = Array.isArray(messages) ? messages[0] : messages;
                            
                            // Try to find error container by field ID pattern
                            const fieldId = field.replace(/\./g, '_') + '_error';
                            const errorElement = $('#' + fieldId);
                            
                            // Find the input field
                            let input = $(`[name="${field}"]`);
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
                                        formFloating.append(`<div class="invalid-feedback" style="display: block !important;">${errorMessage}</div>`);
                                    }
                                }
                                // If error element exists, use it
                                else if (errorElement.length) {
                                    errorElement.text(errorMessage);
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
                            } else if (errorElement.length) {
                                // If input not found but error element exists, use it
                                errorElement.text(errorMessage);
                            }
                        });
                        
                        // Scroll to first error field
                        if (firstErrorField && firstErrorField.length) {
                            $('html, body').animate({
                                scrollTop: firstErrorField.offset().top - 100
                            }, 500);
                        }
                    } else {
                        // Only show toast for non-validation errors
                        let errorMsg = 'Failed to add individual';
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

