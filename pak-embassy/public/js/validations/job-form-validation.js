document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("job-post-form");
    if (!form) return;

    // Setup real-time validation
    setupRealTimeValidation();

    form.addEventListener("submit", function (e) {
        let isValid = true;
        let firstErrorField = null;

        // Clear previous errors
        document.querySelectorAll("[id$='_error']").forEach(el => el.textContent = "");

        // Validate all fields
        const fields = [
            'job-title', 'job_domain_id', 'job-type', 'work-mode', 'job-location',
            'embed_map_job', 'job-address', 'vacancies', 'description',
            'responsibilities', 'requirements', 'benefits', 'min_experience',
            'max_experience', 'min_salary', 'max_salary', 'currency', 'expiry_date'
        ];

        fields.forEach(fieldId => {
            if (!validateField(fieldId)) {
                isValid = false;
                if (!firstErrorField) {
                    firstErrorField = document.getElementById(fieldId);
                }
            }
        });

        if (!isValid) {
            e.preventDefault();
            if (firstErrorField) {
                firstErrorField.scrollIntoView({ behavior: "smooth", block: "center" });
                firstErrorField.focus();
            }
        }
    });

    function setupRealTimeValidation() {
        const ckeditorFields = ['description', 'responsibilities', 'requirements', 'benefits'];

        const fields = [
            'job-title', 'job_domain_id', 'job-type', 'work-mode', 'job-location',
            'embed_map_job', 'job-address', 'vacancies',
            'min_experience', 'max_experience',
            'min_salary', 'max_salary',
            'currency', 'expiry_date'
        ];

        // Setup CKEditor 5 validation
        setupCKEditor5Validation();

        // Normal inputs/selects
        fields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.addEventListener("blur", () => validateField(fieldId));
                field.addEventListener("input", function () {
                    if (this.value.trim() !== "") validateField(fieldId);
                });
            }
        });

        // CKEditor (v4) fields
        // ✅ CKEditor (v4) fields
        // ✅ CKEditor (v4) fields
        if (typeof CKEDITOR !== "undefined") {
            ckeditorFields.forEach(fieldId => {
                if (CKEDITOR.instances[fieldId]) {
                    const editor = CKEDITOR.instances[fieldId];

                    // Validate on blur
                    editor.on("blur", () => validateField(fieldId));

                    // Validate on content change
                    editor.on("change", () => validateField(fieldId));

                    // Real-time validation while typing
                    editor.on("key", () => {
                        if (editor.getData().trim() !== "") {
                            validateField(fieldId);
                        }
                    });
                }
            });
        }


    }

    function validateField(fieldId) {
        // alert('validateField');
        const field = document.getElementById(fieldId);
        let errorElementId = fieldId + "_error";

        const errorElementMap = {
            'job-title': 'title_error',
            'job_domain_id': 'domain_id_error',
            'job-type': 'job_type_error',
            'work-mode': 'work_mode_error',
            'job-location': 'location_error',
            'embed_map_job': 'embed_map_error',
            'job-address': 'address_error',
            'vacancies': 'vacancies_error',
            'description': 'description_error',
            'responsibilities': 'responsibilities_error',
            'requirements': 'requirements_error',
            'benefits': 'benefits_error',
            'min_experience': 'min_experience_error',
            'max_experience': 'max_experience_error',
            'min_salary': 'min_salary_error',
            'max_salary': 'max_salary_error',
            'currency': 'currency_error',
            'expiry_date': 'expiry_date_error'
        };

        errorElementId = errorElementMap[fieldId] || errorElementId;
        const errorElement = document.getElementById(errorElementId);
        if (!errorElement) return true;

        let isValid = true;
        let errorMessage = "";

        // Get field value (normal vs CKEditor)
        let fieldValue = "";
        const ckEditorFields = ['description', 'responsibilities', 'requirements', 'benefits'];

        if (ckEditorFields.includes(fieldId)) {
            // Try CKEditor 5 first
            const editor5 = window[fieldId + '_editor'];
            if (editor5) {
                fieldValue = editor5.getData();
                console.log('CKEditor 5 field value for', fieldId, ':', fieldValue);
            } 
            // Fallback to CKEditor 4
            else if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances[fieldId]) {
                fieldValue = CKEDITOR.instances[fieldId].getData();
                console.log('CKEditor 4 field value for', fieldId, ':', fieldValue);
            } 
            // Fallback to textarea value
            else {
                fieldValue = field.value || "";
                console.log('Fallback field value for', fieldId, ':', fieldValue);
            }
        } else if (field) {
            fieldValue = field.value || "";
        }

        // ✅ Add your validation rules here (kept same as your original code)
        switch (fieldId) {
            case "job-title":
                if (!fieldValue.trim()) {
                    isValid = false;
                    errorMessage = "Job title is required";
                } else if (fieldValue.length > 255) {
                    isValid = false;
                    errorMessage = "Job title may not be greater than 255 characters";
                }
                break;

            case "job_domain_id":
                if (!fieldValue) {
                    isValid = false;
                    errorMessage = "Job category is required";
                }
                break;

            case "job-type":
                if (!fieldValue) {
                    isValid = false;
                    errorMessage = "Job type is required";
                }
                break;

            case "work-mode":
                if (!fieldValue) {
                    isValid = false;
                    errorMessage = "Work mode is required";
                }
                break;
                
            case 'job-location':
                if (field.value.trim()) {
                    if (field.value.trim().length > 255) {
                isValid = false;
                        errorMessage = 'Location may not be greater than 255 characters';
            } else {
                        let urlPattern = /^(https?:\/\/)?([\w\-]+(\.[\w\-]+)+)([\/\w\-.~:?#[\]@!$&'()*+,;=]*)?$/;
                        if (!urlPattern.test(field.value.trim())) {
                            isValid = false;
                            errorMessage = 'Please enter a valid URL';
                        }
                    }
                }
                break;
                
            case 'embed_map_job':
                if (field.value.trim()) {
                    let embedPattern = /^https:\/\/www\.google\.com\/maps\/embed\?pb=/;
                    if (!embedPattern.test(field.value.trim())) {
                isValid = false;
                        errorMessage = 'Please enter a valid Google Maps embed URL';
                    }
                }
                break;
                
            case 'job-address':
                if (field.value.trim() && field.value.trim().length > 255) {
            isValid = false;
                    errorMessage = 'Address may not be greater than 255 characters';
                }
                break;

            case "vacancies":
                if (!fieldValue.trim()) {
                    isValid = false;
                    errorMessage = "Number of vacancies is required";
                } else if (isNaN(fieldValue) || parseInt(fieldValue) < 1) {
                    isValid = false;
                    errorMessage = "Number of vacancies must be at least 1";
                }
                break;

            case "description":
            case "responsibilities":
            case "requirements":
            case "benefits":
                if (!fieldValue.trim()) {
                    isValid = false;
                    errorMessage = `${fieldId.charAt(0).toUpperCase() + fieldId.slice(1)} is required`;
                }
                break;

            case "min_experience":
                if (!fieldValue.trim()) {
                    isValid = false;
                    errorMessage = "Minimum experience is required";
                } else if (isNaN(fieldValue) || parseInt(fieldValue) < 0 || parseInt(fieldValue) > 50) {
                    isValid = false;
                    errorMessage = "Minimum experience must be between 0 and 50 years";
                }
                break;

            case "max_experience":
                if (!fieldValue.trim()) {
                    isValid = false;
                    errorMessage = "Maximum experience is required";
                } else if (isNaN(fieldValue) || parseInt(fieldValue) < 0 || parseInt(fieldValue) > 50) {
                    isValid = false;
                    errorMessage = "Maximum experience must be between 0 and 50 years";
                } else {
                    const minExp = document.getElementById('min_experience').value;
                    if (minExp && parseInt(fieldValue) < parseInt(minExp)) {
                        isValid = false;
                        errorMessage = "Maximum experience must be greater than or equal to minimum experience";
                    }
                }
                break;

            case "min_salary":
                if (!fieldValue.trim()) {
                    isValid = false;
                    errorMessage = "Minimum salary is required";
                } else if (isNaN(fieldValue) || parseFloat(fieldValue) < 1 || parseFloat(fieldValue) > 10000000) {
                    isValid = false;
                    errorMessage = "Minimum salary must be between 1 and 10,000,000";
                }
                break;

            case "max_salary":
                if (!fieldValue.trim()) {
                    isValid = false;
                    errorMessage = "Maximum salary is required";
                } else if (isNaN(fieldValue) || parseFloat(fieldValue) < 1 || parseFloat(fieldValue) > 10000000) {
                    isValid = false;
                    errorMessage = "Maximum salary must be between 1 and 10,000,000";
                } else {
                    const minSalary = document.getElementById('min_salary').value;
                    if (minSalary && parseFloat(fieldValue) < parseFloat(minSalary)) {
                        isValid = false;
                        errorMessage = "Maximum salary must be greater than or equal to minimum salary";
                    }
                }
                break;

            case "currency":
                if (!fieldValue) {
                    isValid = false;
                    errorMessage = "Currency is required";
                }
                break;
                
            case 'expiry_date':
                if (!field.value.trim()) {
                    isValid = false;
                    errorMessage = 'Expiry date is required';
                } else if (isNaN(Date.parse(field.value))) {
                    isValid = false;
                    errorMessage = 'Expiry date must be a valid date';
                } else {
            const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    const parts = field.value.split("-");
            const expiryDate = new Date(parts[0], parts[1] - 1, parts[2]);

            if (expiryDate <= today) {
                isValid = false;
                        errorMessage = 'Expiry date must be greater than today';
                    }
            }
                break;
        }

        // Show error message
        if (!isValid) {
            errorElement.textContent = errorMessage;
            if (field) {
                field.classList.add("is-invalid");
                field.classList.remove("is-valid");
            }
            // For CKEditor fields, also add visual feedback to the editor container
            if (ckEditorFields.includes(fieldId)) {
                const editor5 = window[fieldId + '_editor'];
                if (editor5) {
                    const editorElement = editor5.ui.element;
                    if (editorElement) {
                        editorElement.classList.add("is-invalid");
                        editorElement.classList.remove("is-valid");
                    }
                }
            }
        } else {
            // Clear error message when validation is successful
            errorElement.textContent = "";
            if (field) {
                field.classList.remove("is-invalid");
                field.classList.add("is-valid");
            }
            // For CKEditor fields, also add visual feedback to the editor container
            if (ckEditorFields.includes(fieldId)) {
                const editor5 = window[fieldId + '_editor'];
                if (editor5) {
                    const editorElement = editor5.ui.element;
                    if (editorElement) {
                        editorElement.classList.remove("is-invalid");
                        editorElement.classList.add("is-valid");
                    }
                }
            }
        }

        return isValid;
    }

    // Update CKEditor content before submit
    form.addEventListener("submit", function () {
        // Update CKEditor 5 instances (data is automatically synced)
        const ckEditorFields = ['description', 'responsibilities', 'requirements', 'benefits'];
        ckEditorFields.forEach(fieldId => {
            const editor5 = window[fieldId + '_editor'];
            if (editor5) {
                console.log('Updating CKEditor 5 instance for:', fieldId);
            }
        });

        // Update CKEditor 4 instances
        if (typeof CKEDITOR !== "undefined") {
            for (let instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        }
    });

    // Setup CKEditor 5 validation
    function setupCKEditor5Validation() {
        console.log('Setting up CKEditor 5 validation...');
        
        const checkCKEditor5Instances = () => {
            const ckEditorFields = ['description', 'responsibilities', 'requirements', 'benefits'];
            console.log('Checking for CKEditor instances. Available editors:', window.editors);
            
            ckEditorFields.forEach(fieldId => {
                const editor = window[fieldId + '_editor'];
                console.log('Checking field:', fieldId, 'Editor found:', !!editor);
                
                if (editor && !editor._validationHooked) {
                    console.log('Hooking validation for CKEditor 5 field:', fieldId);
                    
                    // Hook validation on change/blur
                    editor.model.document.on('change:data', () => {
                        console.log('CKEditor 5 change event for:', fieldId);
                        validateField(fieldId);
                    });

                    editor.editing.view.document.on('blur', () => {
                        console.log('CKEditor 5 blur event for:', fieldId);
                        validateField(fieldId);
                    });

                    editor.editing.view.document.on('keyup', () => {
                        console.log('CKEditor 5 keyup event for:', fieldId);
                        validateField(fieldId);
                    });

                    // Hook input event for real-time error clearing
                    editor.editing.view.document.on('input', () => {
                        console.log('CKEditor 5 input event for:', fieldId);
                        validateField(fieldId);
                    });

                    editor._validationHooked = true;
                } else if (editor && editor._validationHooked) {
                    console.log('Validation already hooked for:', fieldId);
                } else {
                    console.log('No editor found for:', fieldId);
                }
            });
        };

        // Check for instances every 500ms
        const interval = setInterval(checkCKEditor5Instances, 500);
        
        // Stop checking after 10 seconds
        setTimeout(() => clearInterval(interval), 10000);
    }
});
