// profile-add-edit-modal.js
document.addEventListener("DOMContentLoaded", function () {
    // Counter for form IDs
    let educationFormCounter = 0;
    let experienceFormCounter = 0;
    let certificationFormCounter = 0;

    // Countries data
    let countries = [];

    // Load countries from backend
    function loadCountries() {
        if (countries.length > 0) return Promise.resolve();

        return new Promise((resolve, reject) => {
            $.ajax({
                url: '/user/profile/countries',
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        countries = response.countries;
                        resolve(countries);
                    } else {
                        reject('Failed to load countries');
                    }
                },
                error: function (xhr) {
                    console.error('Error loading countries:', xhr);
                    reject(xhr);
                }
            });
        });
    }

    // Education Section
    function addEducationForm(isEditing = false, educationData = null) {
        educationFormCounter++;
        const id = educationFormCounter;

        loadCountries().then(() => {
            generateEducationForm(id, isEditing, educationData);
        }).catch(error => {
            console.error('Failed to load countries:', error);
            generateEducationForm(id, isEditing, educationData);
        });
    }

    // Work Experience Section
    function addExperienceForm(isEditing = false, experienceData = null) {
        experienceFormCounter++;
        const id = experienceFormCounter;

        loadCountries().then(() => {
            generateExperienceForm(id, isEditing, experienceData);
        }).catch(error => {
            console.error('Failed to load countries:', error);
            generateExperienceForm(id, isEditing, experienceData);
        });
    }

    // Certification Section
    function addCertificationForm(isEditing = false, certificateData = null) {
        certificationFormCounter++;
        const id = certificationFormCounter;
        generateCertificationForm(id, isEditing, certificateData);
    }

    // Generate Education Form
    function generateEducationForm(id, isEditing = false, educationData = null) {
        const formHTML = `
            <div class="form-section mt-4 border-bottom pb-3" id="education-form-${id}">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="edu-country-${id}" name="country">
                                <option value="">Choose...</option>
                                ${countries.map(country => `<option value="${country.id}">${country.name}</option>`).join('')}
                            </select>
                            <label for="edu-country-${id}">Country</label>
                            <small class="error text-danger country-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="degree-type-${id}" name="degree_type">
                                <option value="">Choose...</option>
                                <option value="Bachelor">Bachelor</option>
                                <option value="Master">Master</option>
                                <option value="Diploma">Diploma</option>
                                <option value="Ph.D.">Ph.D.</option>
                            </select>
                            <label for="degree-type-${id}">Degree Type</label>
                            <small class="error text-danger degree-type-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="degree-name-${id}" name="degree_name" placeholder="Degree Name">
                            <label for="degree-name-${id}">Degree Name</label>
                            <small class="error text-danger degree-name-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="institute-name-${id}" name="institute_name" placeholder="Institute Name">
                            <label for="institute-name-${id}">Institute Name</label>
                            <small class="error text-danger institute-name-error"></small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="currently-studying-${id}" name="currently_studying">
                            <label class="form-check-label" for="currently-studying-${id}">
                                Currently Studying
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="edu-start-date-${id}" name="start_date" placeholder="Start Date">
                            <label for="edu-start-date-${id}">Start Date</label>
                            <small class="error text-danger start-date-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="edu-end-date-${id}" name="end_date" placeholder="End Date">
                            <label for="edu-end-date-${id}">End Date</label>
                            <small class="error text-danger end-date-error"></small>
                        </div>
                    </div>
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <button type="button" class="btn btn-success btn-sm add-education-btn" id="add-education-${id}">+ Add</button>
                    ${id > 1 ? '<button type="button" class="btn btn-outline-danger btn-sm remove-education" data-id="' + id + '">- Remove</button>' : ''}
                </div>
            </div>
        `;

        const container = document.getElementById('educationContainer');
        container.insertAdjacentHTML('beforeend', formHTML);

        // Add currently studying checkbox handler
        document.getElementById(`currently-studying-${id}`).addEventListener('change', function () {
            const endDateInput = document.getElementById(`edu-end-date-${id}`);
            endDateInput.disabled = this.checked;
            if (this.checked) {
                endDateInput.value = '';
            }
        });

        // Add remove handler for forms that can be removed
        if (id > 1) {
            document.querySelector(`.remove-education[data-id="${id}"]`).addEventListener('click', function () {
                removeEducationForm(id);
            });
        }

        // Add handler for + Add button
        document.getElementById(`add-education-${id}`).addEventListener('click', function () {
            // Hide all existing + Add buttons
            document.querySelectorAll('.add-education-btn').forEach(btn => btn.style.display = 'none');
            addEducationForm();
        });

        // If we're editing, populate the form with existing data
        if (isEditing && educationData) {
            populateEducationForm(educationData, id);
        }
    }

    // Generate Experience Form
    function generateExperienceForm(id, isEditing = false, experienceData = null) {
        const formHTML = `
            <div class="form-section mt-4 border-bottom pb-3" id="experience-form-${id}">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="company-${id}" name="company" placeholder="Company">
                            <label for="company-${id}">Company</label>
                            <small class="error text-danger company-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="job-title-${id}" name="job_title" placeholder="Job Title">
                            <label for="job-title-${id}">Job Title</label>
                            <small class="error text-danger job-title-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="exp-country-${id}" name="country">
                                <option value="">Choose...</option>
                                ${countries.map(country => `<option value="${country.id}">${country.name}</option>`).join('')}
                            </select>
                            <label for="exp-country-${id}">Country</label>
                            <small class="error text-danger country-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="job-type-${id}" name="job_type">
                                <option value="">Choose...</option>
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                            </select>
                            <label for="job-type-${id}">Job Type</label>
                            <small class="error text-danger job-type-error"></small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Job Description" id="job-description-${id}" name="job_description" style="height: 100px"></textarea>
                            <label for="job-description-${id}">Job Description</label>
                            <small class="error text-danger job-description-error"></small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="currently-working-${id}" name="currently_working">
                            <label class="form-check-label" for="currently-working-${id}">
                                Currently Working
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="exp-start-date-${id}" name="start_date" placeholder="Start Date">
                            <label for="exp-start-date-${id}">Start Date</label>
                            <small class="error text-danger start-date-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="exp-end-date-${id}" name="end_date" placeholder="End Date">
                            <label for="exp-end-date-${id}">End Date</label>
                            <small class="error text-danger end-date-error"></small>
                        </div>
                    </div>
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <button type="button" class="btn btn-success btn-sm add-experience-btn" id="add-experience-${id}">+ Add</button>
                    ${id > 1 ? '<button type="button" class="btn btn-outline-danger btn-sm remove-experience" data-id="' + id + '">- Remove</button>' : ''}
                </div>
            </div>
        `;

        const container = document.getElementById('workExperienceContainer');
        container.insertAdjacentHTML('beforeend', formHTML);

        // Add event listener for currently working checkbox
        document.getElementById(`currently-working-${id}`).addEventListener('change', function () {
            const endDateInput = document.getElementById(`exp-end-date-${id}`);
            endDateInput.disabled = this.checked;
            if (this.checked) {
                endDateInput.value = '';
            }
        });

        // Add remove handler for forms that can be removed
        if (id > 1) {
            document.querySelector(`.remove-experience[data-id="${id}"]`).addEventListener('click', function () {
                removeExperienceForm(id);
            });
        }

        // Add handler for + Add button
        document.getElementById(`add-experience-${id}`).addEventListener('click', function () {
            // Hide all existing + Add buttons
            document.querySelectorAll('.add-experience-btn').forEach(btn => btn.style.display = 'none');
            addExperienceForm();
        });

        // If we're editing, populate the form with existing data
        if (isEditing && experienceData) {
            populateExperienceForm(experienceData, id);
        }
    }

    // Generate Certification Form
    function generateCertificationForm(id, isEditing = false, certificateData = null) {
        const formHTML = `
            <div class="form-section mt-4 border-bottom pb-3" id="certification-form-${id}">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="cert-title-${id}" name="cert_title" placeholder="Certificate Title">
                            <label for="cert-title-${id}">Certificate Title</label>
                            <div class="error cert-title-error"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="institute-${id}" name="institute" placeholder="Institute">
                            <label for="institute-${id}">Institute</label>
                            <div class="error institute-error"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="grade-${id}" name="grade" placeholder="Grade">
                            <label for="grade-${id}">Grade</label>
                            <div class="error grade-error"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="cert-start-date-${id}" name="start_date" placeholder="Start Date">
                            <label for="cert-start-date-${id}">Start Date</label>
                            <div class="error start-date-error"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="cert-end-date-${id}" name="end_date" placeholder="End Date">
                            <label for="cert-end-date-${id}">End Date</label>
                            <div class="error end-date-error"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <button type="button" class="btn btn-success btn-sm add-certification-btn" id="add-certification-${id}">+ Add</button>
                    ${id > 1 ? '<button type="button" class="btn btn-outline-danger btn-sm remove-certification ms-auto" data-id="' + id + '">- Remove</button>' : ''}
                </div>
            </div>
        `;

        const container = document.getElementById('certificationContainer');
        container.insertAdjacentHTML('beforeend', formHTML);

        // Add remove handler for forms that can be removed
        if (id > 1) {
            document.querySelector(`.remove-certification[data-id="${id}"]`).addEventListener('click', function () {
                removeCertificationForm(id);
            });
        }

        // Add handler for + Add button
        document.getElementById(`add-certification-${id}`).addEventListener('click', function () {
            // Hide all existing + Add buttons
            document.querySelectorAll('.add-certification-btn').forEach(btn => btn.style.display = 'none');
            addCertificationForm();
        });

        // If we're editing, populate the form with existing data
        if (isEditing && certificateData) {
            populateCertificateForm(certificateData, id);
        }
    }

    // Remove form functions
    function removeEducationForm(id) {
        const form = document.getElementById(`education-form-${id}`);
        if (form) form.remove();
        
        // Show + Add button on the last remaining form
        const remainingForms = document.querySelectorAll('#educationContainer .form-section');
        if (remainingForms.length > 0) {
            const lastForm = remainingForms[remainingForms.length - 1];
            const addBtn = lastForm.querySelector('.add-education-btn');
            if (addBtn) addBtn.style.display = 'inline-block';
        }
    }

    function removeExperienceForm(id) {
        const form = document.getElementById(`experience-form-${id}`);
        if (form) form.remove();
        
        // Show + Add button on the last remaining form
        const remainingForms = document.querySelectorAll('#workExperienceContainer .form-section');
        if (remainingForms.length > 0) {
            const lastForm = remainingForms[remainingForms.length - 1];
            const addBtn = lastForm.querySelector('.add-experience-btn');
            if (addBtn) addBtn.style.display = 'inline-block';
        }
    }

    function removeCertificationForm(id) {
        const form = document.getElementById(`certification-form-${id}`);
        if (form) form.remove();
        
        // Show + Add button on the last remaining form
        const remainingForms = document.querySelectorAll('#certificationContainer .form-section');
        if (remainingForms.length > 0) {
            const lastForm = remainingForms[remainingForms.length - 1];
            const addBtn = lastForm.querySelector('.add-certification-btn');
            if (addBtn) addBtn.style.display = 'inline-block';
        }
    }

    // Populate form functions
    function populateEducationForm(education, formId) {
        document.getElementById(`edu-country-${formId}`).value = education.country_id || '';
        document.getElementById(`degree-type-${formId}`).value = education.degree_type || '';
        document.getElementById(`degree-name-${formId}`).value = education.degree_name || '';
        document.getElementById(`institute-name-${formId}`).value = education.institution || '';
        
        const currentlyStudying = document.getElementById(`currently-studying-${formId}`);
        currentlyStudying.checked = education.currently_studying || false;
        
        const endDateInput = document.getElementById(`edu-end-date-${formId}`);
        endDateInput.disabled = currentlyStudying.checked;
        
        if (education.start_date) {
            const startDate = new Date(education.start_date);
            document.getElementById(`edu-start-date-${formId}`).value = startDate.toISOString().split('T')[0];
        }
        
        if (education.end_date && !currentlyStudying.checked) {
            const endDate = new Date(education.end_date);
            document.getElementById(`edu-end-date-${formId}`).value = endDate.toISOString().split('T')[0];
        }
    }

    function populateExperienceForm(experience, formId) {
        document.getElementById(`company-${formId}`).value = experience.company || '';
        document.getElementById(`job-title-${formId}`).value = experience.title || '';
        document.getElementById(`exp-country-${formId}`).value = experience.country_id || '';
        document.getElementById(`job-type-${formId}`).value = experience.job_type || '';
        document.getElementById(`job-description-${formId}`).value = experience.responsibilities || '';
        
        const currentlyWorking = document.getElementById(`currently-working-${formId}`);
        currentlyWorking.checked = experience.currently_working || false;
        
        const endDateInput = document.getElementById(`exp-end-date-${formId}`);
        endDateInput.disabled = currentlyWorking.checked;
        
        if (experience.start_date) {
            const startDate = new Date(experience.start_date);
            document.getElementById(`exp-start-date-${formId}`).value = startDate.toISOString().split('T')[0];
        }
        
        if (experience.end_date && !currentlyWorking.checked) {
            const endDate = new Date(experience.end_date);
            document.getElementById(`exp-end-date-${formId}`).value = endDate.toISOString().split('T')[0];
        }
    }

    function populateCertificateForm(certificate, formId) {
        document.getElementById(`cert-title-${formId}`).value = certificate.title || '';
        document.getElementById(`institute-${formId}`).value = certificate.institution || '';
        document.getElementById(`grade-${formId}`).value = certificate.grade || '';
        
        if (certificate.start_date) {
            const startDate = new Date(certificate.start_date);
            document.getElementById(`cert-start-date-${formId}`).value = startDate.toISOString().split('T')[0];
        }
        
        if (certificate.end_date) {
            const endDate = new Date(certificate.end_date);
            document.getElementById(`cert-end-date-${formId}`).value = endDate.toISOString().split('T')[0];
        }
    }

    // Submit all forms functions
    function submitAllEducationForms() {
        const forms = document.querySelectorAll('#educationContainer .form-section');
        console.log('Found education forms:', forms.length);
        const educationData = [];
        let isValid = true;

        // Clear all previous errors
        clearAllErrors('educationContainer');

        forms.forEach((form) => {
            // Extract the actual form ID from the form's ID attribute
            const formId = form.id.split('-').pop();
            const id = parseInt(formId);
            
            // Validate each form
            if (!validateEducationForm(id)) {
                isValid = false;
            }

            // Get form values
            const countryId = document.getElementById(`edu-country-${id}`)?.value;
            const degreeType = document.getElementById(`degree-type-${id}`)?.value;
            const degreeName = document.getElementById(`degree-name-${id}`)?.value;
            const instituteName = document.getElementById(`institute-name-${id}`)?.value;
            const startDate = document.getElementById(`edu-start-date-${id}`)?.value;
            const endDate = document.getElementById(`edu-end-date-${id}`)?.value;
            const currentlyStudying = document.getElementById(`currently-studying-${id}`)?.checked;

            educationData.push({
                degree_type: degreeType,
                institution: instituteName,
                degree_name: degreeName,
                country_id: countryId,
                start_date: startDate,
                end_date: currentlyStudying ? null : endDate,
                currently_studying: currentlyStudying
            });
        });

        if (!isValid) {
            return; // Don't submit if validation fails
        }

        // Submit to backend
        if (window.profileManager) {
            window.profileManager.submitMultipleEducation(educationData)
                .done((response) => {
                    if (response.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('education'));
                        modal.hide();
                        location.reload();
                    }
                })
                .fail((xhr) => {
                    console.error('Error submitting education:', xhr);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        showValidationErrors(xhr.responseJSON.errors, 'educationContainer');
                    } else {
                        alert('Failed to add education. Please try again.');
                    }
                });
        }
    }

    function submitAllExperienceForms() {
        const forms = document.querySelectorAll('#workExperienceContainer .form-section');
        console.log('Found experience forms:', forms.length);
        const experienceData = [];
        let isValid = true;

        // Clear all previous errors
        clearAllErrors('workExperienceContainer');

        forms.forEach((form) => {
            // Extract the actual form ID from the form's ID attribute
            const formId = form.id.split('-').pop();
            const id = parseInt(formId);
            
            // Validate each form
            if (!validateExperienceForm(id)) {
                isValid = false;
            }

            // Get form values
            const company = document.getElementById(`company-${id}`)?.value;
            const jobTitle = document.getElementById(`job-title-${id}`)?.value;
            const countryId = document.getElementById(`exp-country-${id}`)?.value;
            const jobType = document.getElementById(`job-type-${id}`)?.value;
            const jobDescription = document.getElementById(`job-description-${id}`)?.value;
            const startDate = document.getElementById(`exp-start-date-${id}`)?.value;
            const endDate = document.getElementById(`exp-end-date-${id}`)?.value;
            const currentlyWorking = document.getElementById(`currently-working-${id}`)?.checked;

            experienceData.push({
                company_name: company,
                job_title: jobTitle,
                country_id: countryId,
                job_type: jobType,
                description: jobDescription,
                start_date: startDate,
                end_date: currentlyWorking ? null : endDate,
                currently_working: currentlyWorking
            });
        });

        if (!isValid) {
            return; // Don't submit if validation fails
        }

        // Submit to backend
        if (window.profileManager) {
            window.profileManager.submitMultipleExperience(experienceData)
                .done((response) => {
                    if (response.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('workExperience'));
                        modal.hide();
                        location.reload();
                    }
                })
                .fail((xhr) => {
                    console.error('Error submitting experience:', xhr);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        showValidationErrors(xhr.responseJSON.errors, 'workExperienceContainer');
                    } else {
                        alert('Failed to add experience. Please try again.');
                    }
                });
        }
    }

    function submitAllCertificationForms() {
        const forms = document.querySelectorAll('#certificationContainer .form-section');
        console.log('Found certification forms:', forms.length);
        const certificationData = [];
        let isValid = true;

        // Clear all previous errors
        clearAllErrors('certificationContainer');

        forms.forEach((form) => {
            // Extract the actual form ID from the form's ID attribute
            const formId = form.id.split('-').pop();
            const id = parseInt(formId);
            
            // Validate each form
            if (!validateCertificationForm(id)) {
                isValid = false;
            }

            // Get form values
            const title = document.getElementById(`cert-title-${id}`)?.value;
            const institution = document.getElementById(`institute-${id}`)?.value;
            const grade = document.getElementById(`grade-${id}`)?.value;
            const startDate = document.getElementById(`cert-start-date-${id}`)?.value;
            const endDate = document.getElementById(`cert-end-date-${id}`)?.value;

            certificationData.push({
                title: title,
                institution: institution,
                grade: grade,
                start_date: startDate,
                end_date: endDate
            });
        });

        if (!isValid) {
            return; // Don't submit if validation fails
        }

        // Submit to backend
        if (window.profileManager) {
            window.profileManager.submitMultipleCertification(certificationData)
                .done((response) => {
                    if (response.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('certification'));
                        modal.hide();
                        location.reload();
                    }
                })
                .fail((xhr) => {
                    console.error('Error submitting certification:', xhr);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        showValidationErrors(xhr.responseJSON.errors, 'certificationContainer');
                    } else {
                        alert('Failed to add certification. Please try again.');
                    }
                });
        }
    }

    // Validation and error display functions
    function showFieldError(fieldId, message) {
        const field = document.getElementById(fieldId);
        if (field) {
            field.classList.add('is-invalid');
            const errorElement = field.parentNode.querySelector('.error, .invalid-feedback');
            if (errorElement) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';
            }
        }
    }

    function clearFieldError(fieldId) {
        const field = document.getElementById(fieldId);
        if (field) {
            field.classList.remove('is-invalid');
            const errorElement = field.parentNode.querySelector('.error, .invalid-feedback');
            if (errorElement) {
                errorElement.textContent = '';
                errorElement.style.display = 'none';
            }
        }
    }

    function clearAllErrors(containerId) {
        const container = document.getElementById(containerId);
        if (container) {
            const errorElements = container.querySelectorAll('.error, .invalid-feedback');
            errorElements.forEach(error => {
                error.textContent = '';
                error.style.display = 'none';
            });
            const invalidFields = container.querySelectorAll('.is-invalid');
            invalidFields.forEach(field => field.classList.remove('is-invalid'));
        }
    }

    function showValidationErrors(errors, containerId) {
        // Clear previous errors
        clearAllErrors(containerId);
        
        // Show new errors
        Object.keys(errors).forEach(fieldName => {
            const errorMessages = errors[fieldName];
            if (Array.isArray(errorMessages) && errorMessages.length > 0) {
                // Try to find the field by name or ID
                let field = document.querySelector(`[name="${fieldName}"]`);
                if (!field) {
                    field = document.getElementById(fieldName);
                }
                if (field) {
                    showFieldError(field.id, errorMessages[0]);
                }
            }
        });
    }

    function validateEducationForm(id) {
        let isValid = true;
        
        // Clear previous errors
        clearFieldError(`edu-country-${id}`);
        clearFieldError(`degree-type-${id}`);
        clearFieldError(`institute-name-${id}`);
        clearFieldError(`degree-name-${id}`);
        clearFieldError(`edu-start-date-${id}`);
        clearFieldError(`edu-end-date-${id}`);

        // Validate country
        const country = document.getElementById(`edu-country-${id}`)?.value;
        if (!country) {
            showFieldError(`edu-country-${id}`, 'Country is required');
            isValid = false;
        }

        // Validate degree type
        const degreeType = document.getElementById(`degree-type-${id}`)?.value;
        if (!degreeType) {
            showFieldError(`degree-type-${id}`, 'Degree type is required');
            isValid = false;
        }

        // Validate institution
        const institution = document.getElementById(`institute-name-${id}`)?.value;
        if (!institution) {
            showFieldError(`institute-name-${id}`, 'Institution is required');
            isValid = false;
        }

        // Validate degree name
        const degreeName = document.getElementById(`degree-name-${id}`)?.value;
        if (!degreeName) {
            showFieldError(`degree-name-${id}`, 'Degree name is required');
            isValid = false;
        }

        // Validate start date
        const startDate = document.getElementById(`edu-start-date-${id}`)?.value;
        if (!startDate) {
            showFieldError(`edu-start-date-${id}`, 'Start date is required');
            isValid = false;
        }

        // Validate end date (only if not currently studying)
        const currentlyStudying = document.getElementById(`currently-studying-${id}`)?.checked;
        const endDate = document.getElementById(`edu-end-date-${id}`)?.value;
        if (!currentlyStudying && !endDate) {
            showFieldError(`edu-end-date-${id}`, 'End date is required when not currently studying');
            isValid = false;
        }

        // Validate date range
        if (startDate && endDate && !currentlyStudying) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            if (end <= start) {
                showFieldError(`edu-end-date-${id}`, 'End date must be after start date');
                isValid = false;
            }
        }

        return isValid;
    }

    function validateExperienceForm(id) {
        let isValid = true;
        
        // Clear previous errors
        clearFieldError(`company-${id}`);
        clearFieldError(`job-title-${id}`);
        clearFieldError(`exp-country-${id}`);
        clearFieldError(`job-type-${id}`);
        clearFieldError(`job-description-${id}`);
        clearFieldError(`exp-start-date-${id}`);
        clearFieldError(`exp-end-date-${id}`);

        // Validate company
        const company = document.getElementById(`company-${id}`)?.value;
        if (!company) {
            showFieldError(`company-${id}`, 'Company is required');
            isValid = false;
        }

        // Validate job title
        const jobTitle = document.getElementById(`job-title-${id}`)?.value;
        if (!jobTitle) {
            showFieldError(`job-title-${id}`, 'Job title is required');
            isValid = false;
        }

        // Validate country
        const country = document.getElementById(`exp-country-${id}`)?.value;
        if (!country) {
            showFieldError(`exp-country-${id}`, 'Country is required');
            isValid = false;
        }

        // Validate job type
        const jobType = document.getElementById(`job-type-${id}`)?.value;
        if (!jobType) {
            showFieldError(`job-type-${id}`, 'Job type is required');
            isValid = false;
        }

        // Validate job description
        const jobDescription = document.getElementById(`job-description-${id}`)?.value;
        if (!jobDescription) {
            showFieldError(`job-description-${id}`, 'Job description is required');
            isValid = false;
        }

        // Validate start date
        const startDate = document.getElementById(`exp-start-date-${id}`)?.value;
        if (!startDate) {
            showFieldError(`exp-start-date-${id}`, 'Start date is required');
            isValid = false;
        }

        // Validate end date (only if not currently working)
        const currentlyWorking = document.getElementById(`currently-working-${id}`)?.checked;
        const endDate = document.getElementById(`exp-end-date-${id}`)?.value;
        if (!currentlyWorking && !endDate) {
            showFieldError(`exp-end-date-${id}`, 'End date is required when not currently working');
            isValid = false;
        }

        // Validate date range
        if (startDate && endDate && !currentlyWorking) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            if (end <= start) {
                showFieldError(`exp-end-date-${id}`, 'End date must be after start date');
                isValid = false;
            }
        }

        return isValid;
    }

    function validateCertificationForm(id) {
        let isValid = true;
        
        // Clear previous errors
        clearFieldError(`cert-title-${id}`);
        clearFieldError(`institute-${id}`);
        clearFieldError(`grade-${id}`);
        clearFieldError(`cert-start-date-${id}`);
        clearFieldError(`cert-end-date-${id}`);

        // Validate title
        const title = document.getElementById(`cert-title-${id}`)?.value;
        if (!title) {
            showFieldError(`cert-title-${id}`, 'Certificate title is required');
            isValid = false;
        }

        // Validate institution
        const institution = document.getElementById(`institute-${id}`)?.value;
        if (!institution) {
            showFieldError(`institute-${id}`, 'Institution is required');
            isValid = false;
        }

        // Validate grade
        const grade = document.getElementById(`grade-${id}`)?.value;
        if (!grade) {
            showFieldError(`grade-${id}`, 'Grade is required');
            isValid = false;
        }

        // Validate start date
        const startDate = document.getElementById(`cert-start-date-${id}`)?.value;
        if (!startDate) {
            showFieldError(`cert-start-date-${id}`, 'Start date is required');
            isValid = false;
        }

        // Validate end date
        const endDate = document.getElementById(`cert-end-date-${id}`)?.value;
        if (!endDate) {
            showFieldError(`cert-end-date-${id}`, 'End date is required');
            isValid = false;
        }

        // Validate date range
        if (startDate && endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            if (end <= start) {
                showFieldError(`cert-end-date-${id}`, 'End date must be after start date');
                isValid = false;
            }
        }

        return isValid;
    }

    // Edit form validation functions
    function validateEditEducationForm() {
        let isValid = true;
        
        // Clear previous errors
        clearFieldError('edit_country_id');
        clearFieldError('edit_degree_type');
        clearFieldError('edit_institute_name');
        clearFieldError('edit_degree_name');
        clearFieldError('edit_start_date');
        clearFieldError('edit_end_date');

        // Validate country
        const country = document.getElementById('edit_country_id')?.value;
        if (!country) {
            showFieldError('edit_country_id', 'Country is required');
            isValid = false;
        }

        // Validate degree type
        const degreeType = document.getElementById('edit_degree_type')?.value;
        if (!degreeType) {
            showFieldError('edit_degree_type', 'Degree type is required');
            isValid = false;
        }

        // Validate institution
        const institution = document.getElementById('edit_institute_name')?.value;
        if (!institution) {
            showFieldError('edit_institute_name', 'Institution is required');
            isValid = false;
        }

        // Validate degree name
        const degreeName = document.getElementById('edit_degree_name')?.value;
        if (!degreeName) {
            showFieldError('edit_degree_name', 'Degree name is required');
            isValid = false;
        }

        // Validate start date
        const startDate = document.getElementById('edit_start_date')?.value;
        if (!startDate) {
            showFieldError('edit_start_date', 'Start date is required');
            isValid = false;
        }

        // Validate end date (only if not currently studying)
        const currentlyStudying = document.getElementById('edit_currently_studying')?.checked;
        const endDate = document.getElementById('edit_end_date')?.value;
        if (!currentlyStudying && !endDate) {
            showFieldError('edit_end_date', 'End date is required when not currently studying');
            isValid = false;
        }

        // Validate date range
        if (startDate && endDate && !currentlyStudying) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            if (end <= start) {
                showFieldError('edit_end_date', 'End date must be after start date');
                isValid = false;
            }
        }

        return isValid;
    }

    function validateEditExperienceForm() {
        let isValid = true;
        
        // Clear previous errors
        clearFieldError('edit_company');
        clearFieldError('edit_job_title');
        clearFieldError('edit_country');
        clearFieldError('edit_job_type');
        clearFieldError('edit_job_description');
        clearFieldError('edit_exp_start_date');
        clearFieldError('edit_exp_end_date');

        // Validate company
        const company = document.getElementById('edit_company')?.value;
        if (!company) {
            showFieldError('edit_company', 'Company is required');
            isValid = false;
        }

        // Validate job title
        const jobTitle = document.getElementById('edit_job_title')?.value;
        if (!jobTitle) {
            showFieldError('edit_job_title', 'Job title is required');
            isValid = false;
        }

        // Validate country
        const country = document.getElementById('edit_country')?.value;
        if (!country) {
            showFieldError('edit_country', 'Country is required');
            isValid = false;
        }

        // Validate job type
        const jobType = document.getElementById('edit_job_type')?.value;
        if (!jobType) {
            showFieldError('edit_job_type', 'Job type is required');
            isValid = false;
        }

        // Validate job description
        const jobDescription = document.getElementById('edit_job_description')?.value;
        if (!jobDescription) {
            showFieldError('edit_job_description', 'Job description is required');
            isValid = false;
        }

        // Validate start date
        const startDate = document.getElementById('edit_exp_start_date')?.value;
        if (!startDate) {
            showFieldError('edit_exp_start_date', 'Start date is required');
            isValid = false;
        }

        // Validate end date (only if not currently working)
        const currentlyWorking = document.getElementById('edit_currently_working')?.checked;
        const endDate = document.getElementById('edit_exp_end_date')?.value;
        if (!currentlyWorking && !endDate) {
            showFieldError('edit_exp_end_date', 'End date is required when not currently working');
            isValid = false;
        }

        // Validate date range
        if (startDate && endDate && !currentlyWorking) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            if (end <= start) {
                showFieldError('edit_exp_end_date', 'End date must be after start date');
                isValid = false;
            }
        }

        return isValid;
    }

    function validateEditCertificationForm() {
        let isValid = true;
        
        // Clear previous errors
        clearFieldError('edit_title');
        clearFieldError('edit_institution');
        clearFieldError('edit_grade');
        clearFieldError('edit_start_date');
        clearFieldError('edit_end_date');

        // Validate title
        const title = document.getElementById('edit_title')?.value;
        if (!title) {
            showFieldError('edit_title', 'Certificate title is required');
            isValid = false;
        }

        // Validate institution
        const institution = document.getElementById('edit_institution')?.value;
        if (!institution) {
            showFieldError('edit_institution', 'Institution is required');
            isValid = false;
        }

        // Validate grade
        const grade = document.getElementById('edit_grade')?.value;
        if (!grade) {
            showFieldError('edit_grade', 'Grade is required');
            isValid = false;
        }

        // Validate start date
        const startDate = document.getElementById('edit_start_date')?.value;
        if (!startDate) {
            showFieldError('edit_start_date', 'Start date is required');
            isValid = false;
        }

        // Validate end date
        const endDate = document.getElementById('edit_end_date')?.value;
        if (!endDate) {
            showFieldError('edit_end_date', 'End date is required');
            isValid = false;
        }

        // Validate date range
        if (startDate && endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            if (end <= start) {
                showFieldError('edit_end_date', 'End date must be after start date');
                isValid = false;
            }
        }

        return isValid;
    }

    // Real-time validation event listeners
    function addRealTimeValidation() {
        // Add event listeners for real-time validation on all form fields
        document.addEventListener('input', function(e) {
            const field = e.target;
            const fieldId = field.id;
            
            // Clear error when user starts typing
            if (field.classList.contains('is-invalid')) {
                clearFieldError(fieldId);
            }
        });

        // Add event listeners for select changes
        document.addEventListener('change', function(e) {
            const field = e.target;
            const fieldId = field.id;
            
            // Clear error when user makes a selection
            if (field.classList.contains('is-invalid')) {
                clearFieldError(fieldId);
            }
        });
    }

    // Initialize modals
    document.getElementById('education')?.addEventListener('shown.bs.modal', function () {
        // Clear container and add one default form
        document.getElementById('educationContainer').innerHTML = '';
        educationFormCounter = 0;
        addEducationForm();
    });

    // Add submit button event listeners
    document.getElementById('submitEducationBtn')?.addEventListener('click', function() {
        console.log('Education submit button clicked');
        submitAllEducationForms();
    });

    document.getElementById('submitExperienceBtn')?.addEventListener('click', function() {
        console.log('Experience submit button clicked');
        submitAllExperienceForms();
    });

    document.getElementById('submitCertificationBtn')?.addEventListener('click', function() {
        console.log('Certification submit button clicked');
        submitAllCertificationForms();
    });


    document.getElementById('workExperience')?.addEventListener('shown.bs.modal', function () {
        // Clear container and add one default form
        document.getElementById('workExperienceContainer').innerHTML = '';
        experienceFormCounter = 0;
        addExperienceForm();
    });

    document.getElementById('certification')?.addEventListener('shown.bs.modal', function () {
        // Clear container and add one default form
        document.getElementById('certificationContainer').innerHTML = '';
        certificationFormCounter = 0;
        addCertificationForm();
    });

    // Edit modal event listeners
    document.getElementById('editeducation')?.addEventListener('shown.bs.modal', function () {
        if (window.editingEducation) {
            populateEditEducationForm(window.editingEducation);
        }
        
        // Add currently studying checkbox handler
        document.getElementById('edit_currently_studying')?.addEventListener('change', function () {
            const endDateInput = document.getElementById('edit_end_date');
            endDateInput.disabled = this.checked;
            if (this.checked) {
                endDateInput.value = '';
            }
        });
    });

    document.getElementById('editworkExperience')?.addEventListener('shown.bs.modal', function () {
        if (window.editingExperience) {
            populateEditExperienceForm(window.editingExperience);
        }
        
        // Add currently working checkbox handler
        document.getElementById('edit_currently_working')?.addEventListener('change', function () {
            const endDateInput = document.getElementById('edit_exp_end_date');
            endDateInput.disabled = this.checked;
            if (this.checked) {
                endDateInput.value = '';
            }
        });
    });

    document.getElementById('editcertification')?.addEventListener('shown.bs.modal', function () {
        if (window.editingCertificate) {
            populateEditCertificateForm(window.editingCertificate);
        }
    });

    // Populate edit forms
    function populateEditEducationForm(education) {
        document.getElementById('edit_country_id').value = education.country_id || '';
        document.getElementById('edit_degree_type').value = education.degree_type || '';
        document.getElementById('edit_degree_name').value = education.degree_name || '';
        document.getElementById('edit_institute_name').value = education.institution || '';
        
        const currentlyStudying = document.getElementById('edit_currently_studying');
        currentlyStudying.checked = education.currently_studying || false;
        
        const endDateInput = document.getElementById('edit_end_date');
        endDateInput.disabled = currentlyStudying.checked;
        
        // Format dates
        if (education.start_date) {
            const startDate = new Date(education.start_date);
            document.getElementById('edit_start_date').value = startDate.toISOString().split('T')[0];
        }
        if (education.end_date && !currentlyStudying.checked) {
            const endDate = new Date(education.end_date);
            document.getElementById('edit_end_date').value = endDate.toISOString().split('T')[0];
        }
    }

    function populateEditExperienceForm(experience) {
        // Map backend field names to form field names
        document.getElementById('edit_company').value = experience.company_name || experience.company || '';
        document.getElementById('edit_job_title').value = experience.job_title || experience.title || '';
        document.getElementById('edit_job_type').value = experience.job_type || '';
        document.getElementById('edit_job_description').value = experience.description || experience.job_description || experience.responsibilities || '';
        
        // Set country
        if (experience.country_id) {
            document.getElementById('edit_country').value = experience.country_id;
        }
        
        // Set currently working checkbox
        const currentlyWorking = document.getElementById('edit_currently_working');
        currentlyWorking.checked = experience.currently_working || false;
        
        const endDateInput = document.getElementById('edit_exp_end_date');
        endDateInput.disabled = currentlyWorking.checked;
        
        // Format dates
        if (experience.start_date) {
            let startDate;
            if (typeof experience.start_date === 'string') {
                // Handle different date formats
                if (experience.start_date.includes('T')) {
                    startDate = new Date(experience.start_date);
                } else {
                    // Handle YYYY-MM-DD format
                    startDate = new Date(experience.start_date + 'T00:00:00');
                }
            } else {
                startDate = new Date(experience.start_date);
            }
            
            if (!isNaN(startDate.getTime())) {
                document.getElementById('edit_exp_start_date').value = startDate.toISOString().split('T')[0];
            }
        }
        
        if (experience.end_date && !currentlyWorking.checked) {
            let endDate;
            if (typeof experience.end_date === 'string') {
                // Handle different date formats
                if (experience.end_date.includes('T')) {
                    endDate = new Date(experience.end_date);
                } else {
                    // Handle YYYY-MM-DD format
                    endDate = new Date(experience.end_date + 'T00:00:00');
                }
            } else {
                endDate = new Date(experience.end_date);
            }
            
            if (!isNaN(endDate.getTime())) {
                document.getElementById('edit_exp_end_date').value = endDate.toISOString().split('T')[0];
            }
        }
    }

    function populateEditCertificateForm(certificate) {
        document.getElementById('edit_title').value = certificate.title || '';
        document.getElementById('edit_institution').value = certificate.institution || '';
        document.getElementById('edit_grade').value = certificate.grade || '';
        
        // Format dates
        if (certificate.start_date) {
            const startDate = new Date(certificate.start_date);
            document.getElementById('edit_cert_start_date').value = startDate.toISOString().split('T')[0];
        }
        if (certificate.end_date) {
            const endDate = new Date(certificate.end_date);
            document.getElementById('edit_cert_end_date').value = endDate.toISOString().split('T')[0];
        }
    }

    // Update button event listeners
    document.getElementById('updateEducationBtn')?.addEventListener('click', function() {
        updateEducation();
    });

    document.getElementById('updateExperienceBtn')?.addEventListener('click', function() {
        updateExperience();
    });

    document.getElementById('updateCertificationBtn')?.addEventListener('click', function() {
        updateCertification();
    });

    // Update functions
    function updateEducation() {
        // Validate form first
        if (!validateEditEducationForm()) {
            return;
        }

        const formData = new FormData(document.getElementById('editEducationForm'));
        const educationData = {
            country_id: formData.get('country_id'),
            degree_type: formData.get('degree_type'),
            degree_name: formData.get('degree_name'),
            institution: formData.get('institute_name'),
            start_date: formData.get('start_date'),
            end_date: formData.get('end_date'),
            currently_studying: document.getElementById('edit_currently_studying').checked
        };

        if (window.profileManager && window.editingEducationId) {
            window.profileManager.updateEducation(window.editingEducationId, educationData)
                .done((response) => {
                    if (response.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editeducation'));
                        modal.hide();
                        location.reload();
                    }
                })
                .fail((xhr) => {
                    console.error('Error updating education:', xhr);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        showValidationErrors(xhr.responseJSON.errors, 'editEducationForm');
                    }
                });
        }
    }

    function updateExperience() {
        // Validate form first
        if (!validateEditExperienceForm()) {
            return;
        }

        const formData = new FormData(document.getElementById('editExperienceForm'));
        const experienceData = {
            company_name: formData.get('company'),
            job_title: formData.get('job_title'),
            country_id: formData.get('country'),
            job_type: formData.get('job_type'),
            description: formData.get('job_description'),
            start_date: formData.get('start_date'),
            end_date: formData.get('end_date'),
            currently_working: document.getElementById('edit_currently_working').checked
        };

        if (window.profileManager && window.editingExperienceId) {
            window.profileManager.updateExperience(window.editingExperienceId, experienceData)
                .done((response) => {
                    if (response.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editworkExperience'));
                        modal.hide();
                        location.reload();
                    }
                })
                .fail((xhr) => {
                    console.error('Error updating experience:', xhr);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        showValidationErrors(xhr.responseJSON.errors, 'editExperienceForm');
                    }
                });
        }
    }

    function updateCertification() {
        // Validate form first
        if (!validateEditCertificationForm()) {
            return;
        }

        const formData = new FormData(document.getElementById('editCertificationForm'));
        const certificateData = {
            title: formData.get('title'),
            institution: formData.get('institution'),
            grade: formData.get('grade'),
            start_date: formData.get('start_date'),
            end_date: formData.get('end_date')
        };

        if (window.profileManager && window.editingCertificateId) {
            window.profileManager.updateCertification(window.editingCertificateId, certificateData)
                .done((response) => {
                    if (response.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editcertification'));
                        modal.hide();
                        location.reload();
                    }
                })
                .fail((xhr) => {
                    console.error('Error updating certificate:', xhr);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        showValidationErrors(xhr.responseJSON.errors, 'editCertificationForm');
                    }
                });
        }
    }

    // Load countries for edit modals
    function loadCountriesForEditModals() {
        loadCountries().then(() => {
            // Populate country dropdowns in edit modals
            const countrySelects = document.querySelectorAll('#edit_country_id, #edit_country');
            countrySelects.forEach(select => {
                select.innerHTML = '<option value="">Choose...</option>' + 
                    countries.map(country => `<option value="${country.id}">${country.name}</option>`).join('');
            });
        });
    }

    // Load countries when page loads
    loadCountriesForEditModals();

    // Initialize real-time validation
    addRealTimeValidation();

    // Make form functions globally available
    window.addEducationForm = addEducationForm;
    window.addExperienceForm = addExperienceForm;
    window.addCertificationForm = addCertificationForm;
    window.populateEditEducationForm = populateEditEducationForm;
    window.populateEditExperienceForm = populateEditExperienceForm;
    window.populateEditCertificateForm = populateEditCertificateForm;
});