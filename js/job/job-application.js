$(document).on('click', '.submit-btn', function () {
    let url = $(this).data('url');
    let jobId = $(this).data('job-id');
    let formElement = document.getElementById("job-application-form");

    // Validate main form fields first and track failed fields
    const mainFormFields = ['firstName', 'lastName', 'phone', 'email', 'street', 'zip', 'city', 'state', 'country', 'department', 'linkedin', 'portfolio', 'resume', 'image'];
    let allMainFormValid = true;
    let firstFailedField = null;

    mainFormFields.forEach(fieldId => {
        if (!validateMainFormField(fieldId)) {
            allMainFormValid = false;
            if (!firstFailedField) {
                firstFailedField = getFieldElement(fieldId);
            }
        }
    });

    // Validate all education forms
    const educationForms = document.querySelectorAll('[id^="education-form-"]');
    let allEducationValid = true;

     educationForms.forEach(form => {
         const formId = form.id.split('-')[2];
         console.log('Validating education form:', formId, 'Form element:', form);
         const validationResult = validateEducationFormExternal(formId);
         console.log('Education validation result:', validationResult);
         if (!validationResult.isValid) {
             allEducationValid = false;
             if (!firstFailedField && validationResult.firstFailedField) {
                 firstFailedField = validationResult.firstFailedField;
                 console.log('First failed education field:', firstFailedField);
             }
         }
     });

    // Validate all experience forms
    const experienceForms = document.querySelectorAll('[id^="experience-form-"]');
    let allExperienceValid = true;

     experienceForms.forEach(form => {
         const formId = form.id.split('-')[2];
         console.log('Validating experience form:', formId);
         const validationResult = validateExperienceFormExternal(formId);
         console.log('Experience validation result:', validationResult);
         if (!validationResult.isValid) {
             allExperienceValid = false;
             if (!firstFailedField && validationResult.firstFailedField) {
                 firstFailedField = validationResult.firstFailedField;
                 console.log('First failed experience field:', firstFailedField);
             }
         }
     });

    console.log('Validation Results:', {
        mainForm: allMainFormValid,
        education: allEducationValid,
        experience: allExperienceValid,
        firstFailedField: firstFailedField
    });

    // If validation fails, don't submit and scroll to first error
    if (!allMainFormValid || !allEducationValid || !allExperienceValid) {
        scrollToFirstError(firstFailedField);
        return;
    }

    // Continue with form submission...
    collectEducationDataForSubmission(formElement);
    collectExperienceDataForSubmission(formElement);

    let formData = new FormData(formElement);
    formData.append("job_post_id", jobId);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            // Disable submit button if needed
        },
        success: function (response) {
            Swal.fire({
                icon: 'success',
                title: 'Applied!',
                text: response.message ?? "Application Submitted!",
            }).then(() => {
                window.location.href = discoverJobUrl;
            });
        },
        error: function (xhr) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $(".text-danger").text("");
                $.each(xhr.responseJSON.errors, function (field, messages) {
                    let fieldId = field.replace(/\./g, "_") + "_error";
                    $("#" + fieldId).text(messages[0]);
                });

                // Scroll to first error after backend validation
                const firstErrorField = document.querySelector('.is-invalid');
                if (firstErrorField) {
                    scrollToFirstError(firstErrorField);
                }
            }
        },
    });
});

const input = document.getElementById('job_skills');
const container = document.querySelector('.tags-container');

input.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' && input.value.trim() !== '') {
        e.preventDefault();
        const tagText = input.value.trim();

        // Create tag chip
        const tag = document.createElement('span');
        tag.className = 'tag-chip me-1 mb-1 badge text-white bg-secondary';
        tag.innerHTML = `${tagText} <span class="remove-tag" style="cursor:pointer">&times;</span>`;

        // Create hidden input for form submission
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'additional_skills[]';
        hiddenInput.value = tagText;

        tag.appendChild(hiddenInput);

        // Remove functionality
        tag.querySelector('.remove-tag').addEventListener('click', () => {
            container.removeChild(tag);
        });

        // Insert the tag before the input
        container.insertBefore(tag, input);

        // Clear input
        input.value = '';
    }
});
function attachEducationData(formElement) {
    // Remove old hidden inputs (avoid duplicates on multiple submits)
    formElement.querySelectorAll('.edu-hidden').forEach(el => el.remove());

    // Collect data from the education cards/div
    const rows = document.querySelectorAll("#educationDetailsList .edu-entry");

    rows.forEach((row, index) => {
        const university = row.querySelector('.edu-university')?.innerText || "";
        const course = row.querySelector('.edu-course')?.innerText || "";
        const program = row.querySelector('.edu-program')?.innerText || "";
        const address = row.querySelector('.edu-address')?.innerText || "";
        const fromDate = row.querySelector('.edu-from')?.innerText || "";
        const toDate = row.querySelector('.edu-to')?.innerText || "";

        // Create hidden inputs for each field
        const fields = { university, course, program, address, from: fromDate, to: toDate };

        Object.entries(fields).forEach(([key, value]) => {
            let input = document.createElement('input');
            input.type = 'hidden';
            input.classList.add('edu-hidden'); // mark for cleanup
            input.name = `education[${index}][${key}]`;
            input.value = value;
            formElement.appendChild(input);
        });
    });
}


function collectEducationDataForSubmission(formElement) {
    // Remove old hidden inputs (avoid duplicates on multiple submits)
    formElement.querySelectorAll('.edu-hidden').forEach(el => el.remove());

    // Collect data from our education forms
    const educationForms = document.querySelectorAll('[id^="education-form-"]');

    educationForms.forEach((form, index) => {
        const formId = form.id.split('-')[2];
        const degreeType = document.getElementById(`degree-type-${formId}`);
        const degreeName = document.getElementById(`degree-name-${formId}`);
        const institution = document.getElementById(`institute-name-${formId}`);
        const countryId = document.getElementById(`edu-country-${formId}`);
        const startDate = document.getElementById(`edu-start-date-${formId}`);
        const endDate = document.getElementById(`edu-end-date-${formId}`);
        const currentlyStudying = document.getElementById(`currently-studying-${formId}`);

        // Create hidden inputs for each field
        const fields = {
            degree_type: degreeType ? degreeType.value : '',
            degree_name: degreeName ? degreeName.value : '',
            institution: institution ? institution.value : '',
            country_id: countryId ? countryId.value : '',
            start_date: startDate ? startDate.value : '',
            end_date: currentlyStudying && currentlyStudying.checked ? '' : (endDate ? endDate.value : ''),
            currently_studying: currentlyStudying ? currentlyStudying.checked : false
        };

        Object.entries(fields).forEach(([key, value]) => {
            let input = document.createElement('input');
            input.type = 'hidden';
            input.classList.add('edu-hidden'); // mark for cleanup
            input.name = `education[${index}][${key}]`;
            // Convert boolean to string properly for FormData
            input.value = typeof value === 'boolean' ? (value ? '1' : '0') : value;
            formElement.appendChild(input);
        });
    });
}

function validateEducationFormExternal(formId) {
    let isValid = true;
    const errors = {};
    let firstFailedField = null;

    console.log('validateEducationFormExternal called with formId:', formId);

    // Get form elements
    const degreeType = document.getElementById(`degree-type-${formId}`);
    const degreeName = document.getElementById(`degree-name-${formId}`);
    const institution = document.getElementById(`institute-name-${formId}`);
    const countryId = document.getElementById(`edu-country-${formId}`);
    const startDate = document.getElementById(`edu-start-date-${formId}`);
    const endDate = document.getElementById(`edu-end-date-${formId}`);
    const currentlyStudying = document.getElementById(`currently-studying-${formId}`);

    console.log('Education form elements found:', {
        degreeType: !!degreeType,
        degreeName: !!degreeName,
        institution: !!institution,
        countryId: !!countryId,
        startDate: !!startDate,
        endDate: !!endDate,
        currentlyStudying: !!currentlyStudying
    });

    // Clear previous errors
    clearEducationErrors(formId);

    // Validate degree type
    if (!degreeType || !degreeType.value) {
        errors.degreeType = 'Degree type is required';
        isValid = false;
        if (degreeType) {
            degreeType.classList.add('is-invalid');
            degreeType.classList.remove('is-valid');
            if (!firstFailedField) firstFailedField = degreeType;
        }
    } else if (degreeType) {
        degreeType.classList.remove('is-invalid');
        degreeType.classList.add('is-valid');
    }

    // Validate degree name
    if (!degreeName || !degreeName.value.trim()) {
        errors.degreeName = 'Degree name is required';
        isValid = false;
        if (degreeName) {
            degreeName.classList.add('is-invalid');
            degreeName.classList.remove('is-valid');
            if (!firstFailedField) firstFailedField = degreeName;
        }
    } else if (degreeName) {
        degreeName.classList.remove('is-invalid');
        degreeName.classList.add('is-valid');
    }

    // Validate institution
    if (!institution || !institution.value.trim()) {
        errors.institution = 'Institution name is required';
        isValid = false;
        if (institution) {
            institution.classList.add('is-invalid');
            institution.classList.remove('is-valid');
            if (!firstFailedField) firstFailedField = institution;
        }
    } else if (institution) {
        institution.classList.remove('is-invalid');
        institution.classList.add('is-valid');
    }

    // Validate country
    if (!countryId || !countryId.value) {
        errors.country = 'Country is required';
        isValid = false;
        if (countryId) {
            countryId.classList.add('is-invalid');
            countryId.classList.remove('is-valid');
            if (!firstFailedField) firstFailedField = countryId;
        }
    } else if (countryId) {
        countryId.classList.remove('is-invalid');
        countryId.classList.add('is-valid');
    }

    // Validate start date
    if (!startDate || !startDate.value) {
        errors.startDate = 'Start date is required';
        isValid = false;
        if (startDate) {
            startDate.classList.add('is-invalid');
            startDate.classList.remove('is-valid');
            if (!firstFailedField) firstFailedField = startDate;
        }
    } else if (startDate) {
        startDate.classList.remove('is-invalid');
        startDate.classList.add('is-valid');
    }

    // Validate end date (only if not currently studying)
    if (!currentlyStudying || !currentlyStudying.checked) {
        if (!endDate || !endDate.value) {
            errors.endDate = 'End date is required';
            isValid = false;
            if (endDate) {
                endDate.classList.add('is-invalid');
                endDate.classList.remove('is-valid');
                if (!firstFailedField) firstFailedField = endDate;
            }
        } else if (startDate && startDate.value && endDate.value <= startDate.value) {
            errors.endDate = 'End date must be after start date';
            isValid = false;
            if (endDate) {
                endDate.classList.add('is-invalid');
                endDate.classList.remove('is-valid');
                if (!firstFailedField) firstFailedField = endDate;
            }
        } else if (endDate) {
            endDate.classList.remove('is-invalid');
            endDate.classList.add('is-valid');
        }
    } else if (endDate) {
        // If currently studying, clear validation classes
        endDate.classList.remove('is-invalid');
        endDate.classList.remove('is-valid');
    }

    // Show errors
    if (!isValid) {
        showEducationErrors(formId, errors);
    }

    return {
        isValid: isValid,
        firstFailedField: firstFailedField
    };
}

function validateExperienceFormExternal(formId) {
    let isValid = true;
    const errors = {};
    let firstFailedField = null;

    console.log('validateExperienceFormExternal called with formId:', formId);

    // Get form elements
    const companyName = document.getElementById(`company-${formId}`);
    const jobTitle = document.getElementById(`job-title-${formId}`);
    const countryId = document.getElementById(`exp-country-${formId}`);
    const jobType = document.getElementById(`job-type-${formId}`);
    const jobDescription = document.getElementById(`job-description-${formId}`);
    const startDate = document.getElementById(`exp-start-date-${formId}`);
    const endDate = document.getElementById(`exp-end-date-${formId}`);
    const currentlyWorking = document.getElementById(`currently-working-${formId}`);

    console.log('Experience form elements found:', {
        companyName: !!companyName,
        jobTitle: !!jobTitle,
        countryId: !!countryId,
        jobType: !!jobType,
        jobDescription: !!jobDescription,
        startDate: !!startDate,
        endDate: !!endDate,
        currentlyWorking: !!currentlyWorking
    });

    // Clear previous errors
    clearExperienceErrors(formId);

    // Validate company name
    if (!companyName || !companyName.value.trim()) {
        errors.company = 'Company name is required';
        isValid = false;
        if (companyName) {
            companyName.classList.add('is-invalid');
            companyName.classList.remove('is-valid');
            if (!firstFailedField) firstFailedField = companyName;
        }
    } else if (companyName) {
        companyName.classList.remove('is-invalid');
        companyName.classList.add('is-valid');
    }

    // Validate job title
    if (!jobTitle || !jobTitle.value.trim()) {
        errors.jobTitle = 'Job title is required';
        isValid = false;
        if (jobTitle) {
            jobTitle.classList.add('is-invalid');
            jobTitle.classList.remove('is-valid');
            if (!firstFailedField) firstFailedField = jobTitle;
        }
    } else if (jobTitle) {
        jobTitle.classList.remove('is-invalid');
        jobTitle.classList.add('is-valid');
    }

    // Validate country
    if (!countryId || !countryId.value) {
        errors.country = 'Country is required';
        isValid = false;
        if (countryId) {
            countryId.classList.add('is-invalid');
            countryId.classList.remove('is-valid');
            if (!firstFailedField) firstFailedField = countryId;
        }
    } else if (countryId) {
        countryId.classList.remove('is-invalid');
        countryId.classList.add('is-valid');
    }

    // Validate job type
    if (!jobType || !jobType.value) {
        errors.jobType = 'Job type is required';
        isValid = false;
        if (jobType) {
            jobType.classList.add('is-invalid');
            jobType.classList.remove('is-valid');
            if (!firstFailedField) firstFailedField = jobType;
        }
    } else if (jobType) {
        jobType.classList.remove('is-invalid');
        jobType.classList.add('is-valid');
    }

    // Validate job description
    if (!jobDescription || !jobDescription.value.trim()) {
        errors.jobDescription = 'Job description is required';
        isValid = false;
        if (jobDescription) {
            jobDescription.classList.add('is-invalid');
            jobDescription.classList.remove('is-valid');
            if (!firstFailedField) firstFailedField = jobDescription;
        }
    } else if (jobDescription) {
        jobDescription.classList.remove('is-invalid');
        jobDescription.classList.add('is-valid');
    }

    // Validate start date
    if (!startDate || !startDate.value) {
        errors.startDate = 'Start date is required';
        isValid = false;
        if (startDate) {
            startDate.classList.add('is-invalid');
            startDate.classList.remove('is-valid');
            if (!firstFailedField) firstFailedField = startDate;
        }
    } else if (startDate) {
        startDate.classList.remove('is-invalid');
        startDate.classList.add('is-valid');
    }

    // Validate end date (only if not currently working)
    if (!currentlyWorking || !currentlyWorking.checked) {
        if (!endDate || !endDate.value) {
            errors.endDate = 'End date is required';
            isValid = false;
            if (endDate) {
                endDate.classList.add('is-invalid');
                endDate.classList.remove('is-valid');
                if (!firstFailedField) firstFailedField = endDate;
            }
        } else if (startDate && startDate.value && endDate.value <= startDate.value) {
            errors.endDate = 'End date must be after start date';
            isValid = false;
            if (endDate) {
                endDate.classList.add('is-invalid');
                endDate.classList.remove('is-valid');
                if (!firstFailedField) firstFailedField = endDate;
            }
        } else if (endDate) {
            endDate.classList.remove('is-invalid');
            endDate.classList.add('is-valid');
        }
    } else if (endDate) {
        // If currently working, clear validation classes
        endDate.classList.remove('is-invalid');
        endDate.classList.remove('is-valid');
    }

    // Show errors
    if (!isValid) {
        showExperienceErrors(formId, errors);
    }

    return {
        isValid: isValid,
        firstFailedField: firstFailedField
    };
}

function clearEducationErrors(formId) {
    const errorSelectors = [
        '.degree-type-error',
        '.degree-name-error',
        '.institute-name-error',
        '.country-error',
        '.start-date-error',
        '.end-date-error'
    ];

    errorSelectors.forEach(selector => {
        const errorElement = document.querySelector(`#education-form-${formId} ${selector}`);
        if (errorElement) {
            errorElement.textContent = '';
        }
    });
}

function clearExperienceErrors(formId) {
    const errorSelectors = [
        '.company-error',
        '.job-title-error',
        '.country-error',
        '.job-type-error',
        '.job-description-error',
        '.start-date-error',
        '.end-date-error'
    ];

    errorSelectors.forEach(selector => {
        const errorElement = document.querySelector(`#experience-form-${formId} ${selector}`);
        if (errorElement) {
            errorElement.textContent = '';
        }
    });
}

function showEducationErrors(formId, errors) {
    if (errors.degreeType) {
        const errorElement = document.querySelector(`#education-form-${formId} .degree-type-error`);
        if (errorElement) errorElement.textContent = errors.degreeType;
    }
    if (errors.degreeName) {
        const errorElement = document.querySelector(`#education-form-${formId} .degree-name-error`);
        if (errorElement) errorElement.textContent = errors.degreeName;
    }
    if (errors.institution) {
        const errorElement = document.querySelector(`#education-form-${formId} .institute-name-error`);
        if (errorElement) errorElement.textContent = errors.institution;
    }
    if (errors.country) {
        const errorElement = document.querySelector(`#education-form-${formId} .country-error`);
        if (errorElement) errorElement.textContent = errors.country;
    }
    if (errors.startDate) {
        const errorElement = document.querySelector(`#education-form-${formId} .start-date-error`);
        if (errorElement) errorElement.textContent = errors.startDate;
    }
    if (errors.endDate) {
        const errorElement = document.querySelector(`#education-form-${formId} .end-date-error`);
        if (errorElement) errorElement.textContent = errors.endDate;
    }
}

function showExperienceErrors(formId, errors) {
    if (errors.company) {
        const errorElement = document.querySelector(`#experience-form-${formId} .company-error`);
        if (errorElement) errorElement.textContent = errors.company;
    }
    if (errors.jobTitle) {
        const errorElement = document.querySelector(`#experience-form-${formId} .job-title-error`);
        if (errorElement) errorElement.textContent = errors.jobTitle;
    }
    if (errors.country) {
        const errorElement = document.querySelector(`#experience-form-${formId} .country-error`);
        if (errorElement) errorElement.textContent = errors.country;
    }
    if (errors.jobType) {
        const errorElement = document.querySelector(`#experience-form-${formId} .job-type-error`);
        if (errorElement) errorElement.textContent = errors.jobType;
    }
    if (errors.jobDescription) {
        const errorElement = document.querySelector(`#experience-form-${formId} .job-description-error`);
        if (errorElement) errorElement.textContent = errors.jobDescription;
    }
    if (errors.startDate) {
        const errorElement = document.querySelector(`#experience-form-${formId} .start-date-error`);
        if (errorElement) errorElement.textContent = errors.startDate;
    }
    if (errors.endDate) {
        const errorElement = document.querySelector(`#experience-form-${formId} .end-date-error`);
        if (errorElement) errorElement.textContent = errors.endDate;
    }
}

function collectExperienceDataForSubmission(formElement) {
    // Remove old hidden inputs (avoid duplicates on multiple submits)
    formElement.querySelectorAll('.exp-hidden').forEach(el => el.remove());

    // Collect data from our experience forms
    const experienceForms = document.querySelectorAll('[id^="experience-form-"]');

    experienceForms.forEach((form, index) => {
        const formId = form.id.split('-')[2];
        const companyName = document.getElementById(`company-${formId}`);
        const jobTitle = document.getElementById(`job-title-${formId}`);
        const countryId = document.getElementById(`exp-country-${formId}`);
        const jobType = document.getElementById(`job-type-${formId}`);
        const description = document.getElementById(`job-description-${formId}`);
        const startDate = document.getElementById(`exp-start-date-${formId}`);
        const endDate = document.getElementById(`exp-end-date-${formId}`);
        const currentlyWorking = document.getElementById(`currently-working-${formId}`);

        // Create hidden inputs for each field
        const fields = {
            job_title: jobTitle ? jobTitle.value : '',
            job_type: jobType ? jobType.value : '',
            company_name: companyName ? companyName.value : '',
            country_id: countryId ? countryId.value : '',
            start_date: startDate ? startDate.value : '',
            end_date: currentlyWorking && currentlyWorking.checked ? '' : (endDate ? endDate.value : ''),
            currently_working: currentlyWorking ? currentlyWorking.checked : false,
            description: description ? description.value : ''
        };

        Object.entries(fields).forEach(([key, value]) => {
            let input = document.createElement('input');
            input.type = 'hidden';
            input.classList.add('exp-hidden'); // mark for cleanup
            input.name = `experience[${index}][${key}]`;
            // Convert boolean to string properly for FormData
            input.value = typeof value === 'boolean' ? (value ? '1' : '0') : value;
            formElement.appendChild(input);
        });
    });
}

function attachDynamicData(formElement, listSelector, entrySelector, fieldMap, inputPrefix) {
    // Remove old hidden inputs (avoid duplicates on multiple submits)
    formElement.querySelectorAll(`.${inputPrefix}-hidden`).forEach(el => el.remove());

    // Collect data from the list
    const rows = document.querySelectorAll(`${listSelector} ${entrySelector}`);

    rows.forEach((row, index) => {
        const fields = {};

        // Extract values using the provided field map
        for (let [fieldKey, selector] of Object.entries(fieldMap)) {
            fields[fieldKey] = row.querySelector(selector)?.innerText || "";
        }

        // Create hidden inputs for each field
        Object.entries(fields).forEach(([key, value]) => {
            let input = document.createElement('input');
            input.type = 'hidden';
            input.classList.add(`${inputPrefix}-hidden`); // mark for cleanup
            input.name = `${inputPrefix}[${index}][${key}]`;
            input.value = value;
            formElement.appendChild(input);
        });
    });
}

// Helper function to get field element by fieldId or direct element
function getFieldElement(fieldIdOrElement) {
    // If it's already a DOM element, return it directly
    if (fieldIdOrElement instanceof HTMLElement) {
        return fieldIdOrElement;
    }

    let field = document.getElementById(fieldIdOrElement);

    // Handle special cases for file uploads
    if (!field) {
        if (fieldIdOrElement === 'resume') {
            field = document.getElementById('resumeUpload');
        } else if (fieldIdOrElement === 'image') {
            field = document.getElementById('photoUpload');
        }
    }

    return field;
}


// Function to scroll to the first error field
function scrollToFirstError(firstFailedField) {
    console.log('scrollToFirstError called with:', firstFailedField);

    if (!firstFailedField) {
        // Try to find the first invalid field if none was provided
        firstFailedField = document.querySelector('.is-invalid');
        console.log('Found first invalid field:', firstFailedField);
    }

    if (firstFailedField) {
        console.log('Scrolling to field:', firstFailedField.id || firstFailedField.className);

        // If it's a file input, scroll to its container
        let scrollTarget = firstFailedField;
        if (firstFailedField.type === 'file') {
            scrollTarget = firstFailedField.closest('.upload-container') || firstFailedField;
        }

        // Smooth scroll to the field with better positioning
        scrollTarget.scrollIntoView({
            behavior: 'smooth',
            block: 'center',
            inline: 'nearest'
        });

        // Add a highlight effect
        scrollTarget.style.transition = 'all 0.3s ease';
        scrollTarget.style.boxShadow = '0 0 0 3px rgba(220, 53, 69, 0.25)';

        // Remove highlight after 2 seconds
        setTimeout(() => {
            scrollTarget.style.boxShadow = '';
        }, 2000);

        // Focus the field for better UX (if it's focusable)
        setTimeout(() => {
            if (firstFailedField.focus && firstFailedField.type !== 'file') {
                firstFailedField.focus();
                console.log('Focused field:', firstFailedField.id || firstFailedField.className);
            }
        }, 500);
    } else {
        console.log('No failed field to scroll to');
        // Scroll to top as fallback
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

