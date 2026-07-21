// Global variables
let currentStep = 1;
const totalSteps = 6;
let organizationId = null;
let currentEmail = null;

// Initialize the application
document.addEventListener('DOMContentLoaded', function() {
    initializePasscodeInputs();
    initializeFormValidation();
    addAnimationClasses();
    // Initialize progress indicator to show current step
    updateProgressIndicator(currentStep);

    // Organization type (PAK/KSA) behavior for business signup
    initializeOrganizationTypeToggle();
});

function initializeOrganizationTypeToggle() {
    const orgTypeInput = document.getElementById('organization_type');
    const orgTypeSelect = document.getElementById('organization_type_select');

    if (!orgTypeSelect || !orgTypeInput) return;

    function setFieldRequired(fieldId, isRequired) {
        const el = document.getElementById(fieldId);
        if (!el) return;
        if (isRequired) el.setAttribute('required', 'required');
        else el.removeAttribute('required');
    }

    function toggleOptionalUI(key, isOptional) {
        const req = document.querySelectorAll(`.${key}-required`);
        const opt = document.querySelectorAll(`.${key}-optional`);
        req.forEach(n => n.classList.toggle('d-none', isOptional));
        opt.forEach(n => n.classList.toggle('d-none', !isOptional));
    }

    function applyOrgType(type) {
        orgTypeInput.value = type;
        const isKsa = type === 'KSA';
        const pakOnlyFields = ['secp_registration_number', 'pseb_registration_number', 'pasha_registration_number', 'has_ksa_registered_company'];

        // PAK: website/CEO email/name/logo optional (validate only if filled)
        // KSA: all mandatory
        setFieldRequired('website_url', isKsa);
        setFieldRequired('ceo_name', isKsa);
        setFieldRequired('ceo_email', true); // Always required
        setFieldRequired('formFile', isKsa); // company_logo
        pakOnlyFields.forEach((fieldId) => setFieldRequired(fieldId, !isKsa));

        document.querySelectorAll('.org-pak-only').forEach((el) => {
            el.classList.toggle('d-none', isKsa);
        });

        toggleOptionalUI('website', !isKsa);
        toggleOptionalUI('ceo-name', !isKsa);
        toggleOptionalUI('company-logo', !isKsa);

        // Clear errors for fields that just became optional
        ['website_url', 'ceo_name', 'company_logo', ...pakOnlyFields].forEach((name) => {
            const err = document.getElementById(`${name}_error`);
            if (err && !isKsa) err.textContent = '';
        });

        if (isKsa) {
            pakOnlyFields.forEach((fieldId) => {
                const field = document.getElementById(fieldId);
                if (field) {
                    if (field.tagName === 'SELECT') {
                        field.value = '';
                        field.selectedIndex = 0;
                    } else {
                        field.value = '';
                    }
                    field.classList.remove('is-invalid');
                    field.classList.remove('is-valid');
                    hideFieldError(field);
                }
            });
        }

        // Refresh Next button state
        if (typeof checkStep1ButtonState === 'function') checkStep1ButtonState();
    }

    orgTypeSelect.addEventListener('change', () => {
        applyOrgType(orgTypeSelect.value === 'KSA' ? 'KSA' : 'PAK');
    });

    // initial
    applyOrgType(orgTypeSelect.value === 'KSA' ? 'KSA' : 'PAK');
}

// Step navigation functions
function nextStep(step) {
    if (validateCurrentStep()) {
        if (step == 2) {
            submitCompanyIdentity().then((success) => {
                if (success) {
                    hideCurrentStep();
                    showStep(step);
                    currentStep = step;
                    updateProgressIndicator(step);
                    addAnimationClasses();
                }
            });
        } else if (step == 3) {
            submitCompanyInfo().then((success) => {
                if (success) {
                    hideCurrentStep();
                    showStep(step);
                    currentStep = step;
                    updateProgressIndicator(step);
                    addAnimationClasses();
                }
            });
        } else if (step == 4) {
            // Clean up empty product rows before submitting
            cleanupEmptyProductRows();
            submitProductInfo().then((success) => {
                if (success) {
                    hideCurrentStep();
                    showStep(step);
                    currentStep = step;
                    updateProgressIndicator(step);
                    addAnimationClasses();
                }
            });
        } else if (step == 5) {
            submitServiceInfo().then((success) => {
                if (success) {
                    hideCurrentStep();
                    showStep(step);
                    currentStep = step;
                    updateProgressIndicator(step);
                    addAnimationClasses();
                }
            });
        } else {
            hideCurrentStep();
            showStep(step);
            currentStep = step;
            updateProgressIndicator(step);
            addAnimationClasses();
        }
    }
}

// Step navigation functions
// function nextStepProgressBar(step) {
//     if (validateCurrentStep()) {
//         if (step == 2) {
//             // nextSteps().then((success) => {
//                 // if (success) {
//                     hideCurrentStep();
//                     showStep(step);
//                     currentStep = step;
//                     alert(currentStep)
//                     updateProgressIndicator(step);
//                     addAnimationClasses();
//                 // }
//             // });
//         } else if (step == 3) {
//             nextSteps().then((success) => {
//                 if (success) {
//                     hideCurrentStep();
//                     showStep(step);
//                     currentStep = step;
//                     updateProgressIndicator(step);
//                     addAnimationClasses();
//                 }
//             });
//         } else if (step == 4) {
//             nextSteps().then((success) => {
//                 if (success) {
//                     hideCurrentStep();
//                     showStep(step);
//                     currentStep = step;
//                     updateProgressIndicator(step);
//                     addAnimationClasses();
//                 }
//             });
//         } else if (step == 5) {
//             nextSteps().then((success) => {
//                 if (success) {
//                     hideCurrentStep();
//                     showStep(step);
//                     currentStep = step;
//                     updateProgressIndicator(step);
//                     addAnimationClasses();
//                 }
//             });
//         } else {
//             hideCurrentStep();
//             showStep(step);
//             currentStep = step;
//             updateProgressIndicator(step);
//             addAnimationClasses();
//         }
//     }
// }

function prevStep(step) {
    // Clean up empty product rows before leaving step 3
    if (currentStep === 3) {
        cleanupEmptyProductRows();
    }
    hideCurrentStep();
    showStep(step);
    currentStep = step;
    updateProgressIndicator(step);
    addAnimationClasses();
}
function prevStepIndividual(step) {
    hideCurrentStep();
    showStep(step-1);
    currentStep = step-1;
    updateProgressIndicator(step-1);
    addAnimationClasses();
}


function hideCurrentStep() {
    const currentStepElement = document.getElementById(`step${currentStep}`);
    if (currentStepElement) {
        currentStepElement.classList.add('d-none');
    }
}

function showStep(step) {
    const stepElement = document.getElementById(`step${step}`);
    if (stepElement) {
        stepElement.classList.remove('d-none');
        stepElement.classList.add('fade-in');
        
        // Clean up empty product rows when showing step 3
        if (step === 3) {
            cleanupEmptyProductRows();
        }
    }
}

// Remove empty product rows (rows where both name and capabilities are empty)
function cleanupEmptyProductRows() {
    const container = document.querySelector(".products-container");
    if (!container) return;
    
    const productRows = container.querySelectorAll(".product-row");
    if (!productRows || productRows.length === 0) return;
    
    // Keep the first row always, remove others if empty
    productRows.forEach((row, index) => {
        if (index === 0) return; // Keep first row
        
        const nameInput = row.querySelector('input[name="name[]"]');
        const capabilitiesInput = row.querySelector('input[name="capabilities[]"]');
        
        // Check if both fields are empty
        const nameValue = nameInput ? nameInput.value.trim() : '';
        const capabilitiesValue = capabilitiesInput ? capabilitiesInput.value.trim() : '';
        
        // Remove row if both fields are empty
        if (!nameValue && !capabilitiesValue) {
            row.remove();
        }
    });
}

// Progress indicator functions
function updateProgressIndicator(step) {
    const progressIndicators = document.querySelectorAll('.progress-indicator');

    progressIndicators.forEach(progressIndicator => {
        const progressSteps = progressIndicator.querySelectorAll('.progress-step');

        progressSteps.forEach((progressStep, index) => {
            const stepNumber = index + 1;
            const circle = progressStep.querySelector('.step-circle');
            const line = progressStep.querySelector('.step-line');

            // Reset all state classes
            progressStep.classList.remove('step-success', 'step-active', 'step-inactive');

            if (stepNumber < step) {
                // Completed step
                progressStep.classList.add('step-success');
                if (circle) {
                    circle.style.backgroundImage = "url('img/circle-Success.png')";
                    circle.innerHTML = "";
                }
                if (line) {
                    line.style.backgroundColor = "green";
                }
            } else if (stepNumber === step) {
                // Current step
                progressStep.classList.add('step-active');
                if (circle) {
                    circle.style.backgroundImage = "url('img/circle.png')";
                    circle.innerHTML = "";
                }
                if (line) {
                    line.style.backgroundColor = "#ccc"; // optional: current line color
                }
            } else {
                // Upcoming steps
                progressStep.classList.add('step-inactive');
              if (circle) {
    circle.style.backgroundImage = "none";
    circle.innerHTML = ""; 
}
                if (line) {
                    line.style.backgroundColor = "#ccc";
                }
            }
        });
    });
}



// Passcode input functionality
function initializePasscodeInputs() {
    const passcodeInputs = document.querySelectorAll('.passcode-digit');

    passcodeInputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            const value = e.target.value;

            // Only allow numbers
            if (!/^\d*$/.test(value)) {
                e.target.value = '';
                return;
            }

            // Auto-focus next input
            if (value && index < passcodeInputs.length - 1) {
                passcodeInputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', function(e) {
            // Handle backspace
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                passcodeInputs[index - 1].focus();
            }
        });

        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text');
            const numbers = pastedData.replace(/\D/g, '').split('');

            // Fill inputs with pasted numbers
            numbers.forEach((num, i) => {
                if (index + i < passcodeInputs.length) {
                    passcodeInputs[index + i].value = num;
                    if (index + i + 1 < passcodeInputs.length) {
                        passcodeInputs[index + i + 1].focus();
                    }
                }
            });
        });
    });
}

// Form validation
function initializeFormValidation() {
    // Add validation to all required fields
    const requiredFields = document.querySelectorAll('input[required], select[required]');

    requiredFields.forEach(field => {
        field.addEventListener('blur', function() {
            validateField(this);
            checkStep1ButtonState();
        });

        field.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                validateField(this);
            }
            // Check button state on input for step 1 fields
            if (this.closest('#companyIdentityForm')) {
                checkStep1ButtonState();
            }
        });
        
        // For file inputs, check on change
        if (field.type === 'file') {
            field.addEventListener('change', function() {
                validateField(this);
                checkStep1ButtonState();
            });
        }
    });
    
    // Initial check for step 1 button state
    setTimeout(() => {
        checkStep1ButtonState();
    }, 100);
}

function validateField(field) {
    const value = field.value.trim();
    const fieldName = field.getAttribute('name');
    const maxLength = 255;

    // Remove existing validation classes
    field.classList.remove('is-valid', 'is-invalid');
    hideFieldError(field);

    // Check if field is required and empty
    if (field.hasAttribute('required') && !value) {
        field.classList.add('is-invalid');
        const errorMsg = `${getFieldLabel(fieldName)} is required`;
        console.log('About to show error for field:', fieldName, 'Error div ID:', fieldName + '_error');
        showFieldError(field, errorMsg);
        console.log('After showFieldError call');
        return false;
    }

    // Skip validation if field is empty and not required
    if (!value && !field.hasAttribute('required')) {
        return true;
    }

    // Max length validation (255 for most fields)
    if (value && value.length > maxLength) {
        field.classList.add('is-invalid');
        showFieldError(field, `${getFieldLabel(fieldName)} cannot exceed ${maxLength} characters`);
        return false;
    }

    // Email validation
    if (field.type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            field.classList.add('is-invalid');
            showFieldError(field, 'Please enter a valid email address');
            return false;
        }
    }

    // URL validation for website_url
    if (fieldName === 'website_url' && value) {
        try {
            const url = new URL(value);
            if (!url.protocol.startsWith('http')) {
                throw new Error('Invalid protocol');
            }
        } catch {
            field.classList.add('is-invalid');
            showFieldError(field, 'Please enter a valid URL (e.g., https://example.com)');
            return false;
        }
    }

    // Phone number validation (9665XXXXXXXX format)
    if ((fieldName === 'ceo_contact' || fieldName === 'representative_contact') && value) {
        const phoneRegex = /^9665\d{8}$/;
        if (!phoneRegex.test(value)) {
            field.classList.add('is-invalid');
            showFieldError(field, 'Phone must start with 9665 and be 12 digits (e.g., 966512345678)');
            return false;
        }
    }

    // Boolean validation for has_ksa_registered_company
    if (fieldName === 'has_ksa_registered_company' && value === '') {
        field.classList.add('is-invalid');
        showFieldError(field, 'Please select an option');
        return false;
    }

    // File validation for company_logo
    if (fieldName === 'company_logo' && field.type === 'file') {
        if (field.hasAttribute('required') && (!field.files || field.files.length === 0)) {
            field.classList.add('is-invalid');
            showFieldError(field, 'Company Logo is required');
            return false;
        }
        
        if (field.files && field.files.length > 0) {
            const file = field.files[0];
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/svg+xml'];
            const allowedExtensions = ['.jpg', '.jpeg', '.png', '.svg'];
            const maxSize = 2048 * 1024; // 2MB in bytes

            // Check file type by MIME type
            const isValidMimeType = allowedTypes.includes(file.type);
            
            // Also check file extension as fallback (for SVG which might have different MIME types)
            const fileName = file.name.toLowerCase();
            const hasValidExtension = allowedExtensions.some(ext => fileName.endsWith(ext));

            if (!isValidMimeType && !hasValidExtension) {
                field.classList.add('is-invalid');
                showFieldError(field, 'Logo must be a JPG, JPEG, PNG, or SVG image');
                return false;
            }

            if (file.size > maxSize) {
                field.classList.add('is-invalid');
                showFieldError(field, 'Logo size must not exceed 2MB');
                return false;
            }
        }
    }

    // If validation passes
    if (value || (field.type === 'file' && field.files && field.files.length > 0)) {
        field.classList.add('is-valid');
        hideFieldError(field);
    }
    
    // Check button state after validation
    if (field.closest('#companyIdentityForm')) {
        checkStep1ButtonState();
    }

    return true;
}

function getFieldLabel(fieldName) {
    const labels = {
        'name': 'Organization Name',
        'website_url': 'Website URL',
        'secp_registration_number': 'SECP Registration No.',
        'pseb_registration_number': 'PSEB Registration No.',
        'pasha_registration_number': 'PASHA Registration No.',
        'ceo_name': 'Name of CEO',
        'ceo_contact': 'Contact of CEO',
        'ceo_email': 'Email of CEO',
        'has_ksa_registered_company': 'KSA Registered Company',
        'saudi_entity_name': 'Name of Saudi Entity',
        'representative_name': 'Company Representative Name',
        'representative_contact': 'Representative Contact No.',
        'representative_email': 'Email of Representative',
        'company_logo': 'Company Logo'
    };
    return labels[fieldName] || 'This field';
}

function showFieldError(field, message) {
    if (!field || !message) {
        console.error('showFieldError: Invalid parameters', field, message);
        return;
    }

    // Remove existing error message first
    hideFieldError(field);

    const fieldName = field.getAttribute('name') || field.getAttribute('id');
    if (!fieldName) {
        console.error('showFieldError: Field has no name or id', field);
        return;
    }
    
    const errorDivId = fieldName + '_error';
    console.log('showFieldError: Looking for error div', errorDivId, 'for field', fieldName);
    
    // Try to find existing error div by ID
    let errorDiv = document.getElementById(errorDivId);
    
    if (!errorDiv) {
        // If error div doesn't exist, find the container and create it
        // For file inputs, look for the parent container that has the error div
        let container = field.closest('.position-relative') || field.closest('.mb-4') || field.closest('.chose-inputs') || field.parentNode;
        
        if (container) {
            errorDiv = document.createElement('div');
            errorDiv.id = errorDivId;
            errorDiv.className = 'text-danger small mt-1';
            container.appendChild(errorDiv);
            console.log('showFieldError: Created new error div in container', errorDivId);
        } else {
            console.error('showFieldError: Cannot find container for field', fieldName);
            return;
        }
    }
    
    // Set the error message with explicit styles
    errorDiv.textContent = message;
    errorDiv.innerHTML = message;
    errorDiv.style.cssText = 'display: block !important; visibility: visible !important; opacity: 1 !important; color: #dc3545 !important; font-size: 0.875rem !important; margin-top: 0.25rem !important;';
    errorDiv.classList.remove('d-none', 'hidden');
    errorDiv.classList.add('d-block');
    
    console.log('showFieldError: Error message set', {
        divId: errorDivId,
        message: message,
        textContent: errorDiv.textContent,
        innerHTML: errorDiv.innerHTML,
        display: window.getComputedStyle(errorDiv).display,
        visibility: window.getComputedStyle(errorDiv).visibility
    });
    
    // Force a reflow to ensure the element is visible
    errorDiv.offsetHeight;
    
    // Check button state after showing error
    checkStep1ButtonState();
}

function hideFieldError(field) {
    const fieldName = field.getAttribute('name') || field.getAttribute('id');
    const errorDivId = fieldName ? fieldName + '_error' : null;
    
    // Try to find error div by ID
    if (errorDivId) {
        const errorDiv = document.getElementById(errorDivId);
        if (errorDiv) {
            errorDiv.innerHTML = '';
            errorDiv.style.display = 'none';
            errorDiv.style.visibility = 'hidden';
        }
    }
    
    // Also remove any dynamically created error divs that don't have the ID
    const container = field.closest('.position-relative') || field.closest('.mb-4') || field.parentNode;
    if (container) {
        const existingErrors = container.querySelectorAll('.text-danger.small');
        existingErrors.forEach(err => {
            if (!err.id || err.id !== errorDivId) {
                err.remove();
            }
        });
    }
    
    // Check button state after hiding error
    checkStep1ButtonState();
}

// Check if there are any errors in step 1 and update button state
function checkStep1ButtonState() {
    const step1Form = document.getElementById('companyIdentityForm');
    if (!step1Form) return;
    
    const nextBtn = document.getElementById('nextBtnStep1');
    if (!nextBtn) return;
    
    // Check all error divs in step 1
    const errorDivs = step1Form.querySelectorAll('[id$="_error"]');
    let hasErrors = false;
    console.log(hasErrors);
    
    errorDivs.forEach(errorDiv => {
        const display = window.getComputedStyle(errorDiv).display;
        const visibility = window.getComputedStyle(errorDiv).visibility;
        const hasContent = errorDiv.textContent.trim().length > 0 || errorDiv.innerHTML.trim().length > 0;
        
        // Check if error is visible
        if ((display !== 'none' && visibility !== 'hidden') && hasContent) {
            hasErrors = true;
        }
    });
    
    // Also check for is-invalid classes on fields
    const invalidFields = step1Form.querySelectorAll('.is-invalid');
    if (invalidFields.length > 0) {
        hasErrors = true;
    }
    
    // Update button state: add allow-green-hover class only if there are no errors
    if (hasErrors) {
        nextBtn.classList.remove('allow-green-hover');
    } else {
        nextBtn.classList.add('allow-green-hover');
    }
}

function validateCurrentStep() {

    const currentStepElement = document.getElementById(`step${currentStep}`);
    const requiredFields = currentStepElement.querySelectorAll('input[required], select[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        if (!validateField(field)) {
            isValid = false;
        }
    });

    // Special validation for passcode step
    if (currentStep === 5) {
        isValid = validatePasscode();
    }

    return isValid;
}

function validatePasscode() {
    const passcodeInputs = document.querySelectorAll('.passcode-digit');
    const firstPasscode = Array.from(passcodeInputs).slice(0, 6).map(input => input.value).join('');
    const secondPasscode = Array.from(passcodeInputs).slice(6, 12).map(input => input.value).join('');

    // Clear previous errors
    clearPasscodeErrors();

    let isValid = true;

    if (firstPasscode.length !== 6) {
        showErrorById('passcode_error', 'Please enter a 6-digit passcode');
        isValid = false;
    }

    if (secondPasscode.length !== 6) {
        showErrorById('passcode_confirmation_error', 'Please re-enter your 6-digit passcode');
        isValid = false;
    }

    if (firstPasscode.length === 6 && secondPasscode.length === 6) {
        if (firstPasscode !== secondPasscode) {
            showErrorById('passcode_confirmation_error', 'Passcodes do not match');
            isValid = false;
        }

        const numericRegex = /^[0-9]+$/;
        if (!numericRegex.test(firstPasscode) || !numericRegex.test(secondPasscode)) {
            showErrorById('passcode_error', 'Passcode must contain numbers only');
            isValid = false;
        }
    }

    const termsCheck = document.getElementById('termsCheck');
    if (!termsCheck.checked) {
        showErrorById('termsCheck_error', 'Please agree to the terms and conditions');
        isValid = false;
    }

    return isValid;
}

// Helper functions for field error display
function showErrorById(errorId, message) {
    const errorElement = document.getElementById(errorId);
    if (errorElement) {
        errorElement.textContent = message;
    }
}

function clearPasscodeErrors() {
    const errorIds = ['passcode_error', 'passcode_confirmation_error', 'termsCheck_error'];
    errorIds.forEach(id => {
        const errorElement = document.getElementById(id);
        if (errorElement) {
            errorElement.textContent = '';
        }
    });
}

// Preview and modal functions
function showPreview() {
    if (validateCurrentStep()) {
        submitPasscode().then((success) => {
            if (success) {
                // Explicitly hide step 5 (passcode) before showing step 6 (preview)
                const step5 = document.getElementById('step5');
                if (step5) {
                    step5.classList.add('d-none');
                }
                
                // Hide current step (in case currentStep is set)
                hideCurrentStep();
                
                // Show step 6 (preview)
                showStep(6);
                currentStep = 6;
                addAnimationClasses();
            }
        });
    }
}

function showAuthModal() {
    // Get email from CEO email field
    const emailInput = document.querySelector('#ceo_email');
    let email = '';
    if (emailInput) {
        email = emailInput.value;
    }
    
    // Display email in modal
    if (email) {
        $('#authModalEmail').text(email);
    }
    
    const authModal = new bootstrap.Modal(document.getElementById('authModal'));
    authModal.show();

    // Focus on first OTP input
    setTimeout(() => {
        const firstOtpInput = document.querySelector('#authModal .passcode-digit');
        if (firstOtpInput) {
            firstOtpInput.focus();
        }
    }, 500);
}

function showVerifiedModal() {
    const otpInputs = document.querySelectorAll('#authModal .passcode-digit');
    const otp = Array.from(otpInputs).map(input => input.value).join('');
    if (otp.length !== 6) {
        showToast('Please enter the 6-digit verification code', 'error');
        return;
    }
    const confirmBtn = document.querySelector('#authModal .btn-secondary-2');
    confirmBtn.disabled = true;
    $.ajax({
        url: accountVerificationUrl,
        type: "POST",
        data: {
            organization_id: organizationId,
            verification_code: otp
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            Swal.fire({
                title: 'Success!',
                text: 'Organization has been registered successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = dashboardUrl;
                }
            });
        },
        error: function(xhr) {
            showToast(xhr.responseJSON?.error || 'Something went wrong', 'error');
        }
    });
}

// Animation functions
function addAnimationClasses() {
    const currentStepElement = document.getElementById(`step${currentStep}`);
    if (currentStepElement) {
        // Remove existing animation classes
        currentStepElement.classList.remove('fade-in', 'slide-in');

        // Add animation class based on step type
        if (currentStep === 6) {
            currentStepElement.classList.add('slide-in');
        } else {
            currentStepElement.classList.add('fade-in');
        }
    }
}

// Toast notification function
function showToast(message, type = 'info') {
    // Create toast container if it doesn't exist
    let toastContainer = document.getElementById('toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container';
        toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
        toastContainer.style.zIndex = '9999';
        document.body.appendChild(toastContainer);
    }

    // Create toast element
    const toastElement = document.createElement('div');
    toastElement.className = `toast align-items-center text-white bg-${type === 'error' ? 'danger' : 'success'} border-0`;
    toastElement.setAttribute('role', 'alert');
    toastElement.setAttribute('aria-live', 'assertive');
    toastElement.setAttribute('aria-atomic', 'true');

    toastElement.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;

    toastContainer.appendChild(toastElement);

    // Show toast
    const toast = new bootstrap.Toast(toastElement, {
        autohide: true,
        delay: 5000
    });
    toast.show();

    // Remove toast element after it's hidden
    toastElement.addEventListener('hidden.bs.toast', function() {
        toastElement.remove();
    });
}

// File upload functionality
function initializeFileUpload() {
    const fileInputs = document.querySelectorAll('input[type="file"]');
    const fileDisplayInputs = document.querySelectorAll('.input-group input[readonly]');

    fileDisplayInputs.forEach((displayInput, index) => {
        const browseBtn = displayInput.nextElementSibling;
        const fileInput = fileInputs[index];

        if (browseBtn && fileInput) {
            browseBtn.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    displayInput.value = this.files[0].name;
                }
            });
        }
    });
}

// Add new product functionality
function addNewProduct() {
    const productForm = document.getElementById('productInfoForm');
    const addButton = productForm.querySelector('.btn-outline-primary');

    // Create new product fields
    const newProductDiv = document.createElement('div');
    newProductDiv.className = 'row mt-3 product-row';
    newProductDiv.innerHTML = `
        <div class="col-md-6 mb-3">
            <label class="form-label">Product Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="Enter product name">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Product Category</label>
            <select class="form-select">
                <option value="">Select category</option>
                <option value="software">Software</option>
                <option value="hardware">Hardware</option>
                <option value="service">Service</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Product Code</label>
            <input type="text" class="form-control" placeholder="Enter product code">
        </div>
        <div class="col-md-6 mb-3 d-flex align-items-end">
            <button type="button" class="btn btn-outline-danger" onclick="removeProduct(this)">
                Remove Product
            </button>
        </div>
    `;

    // Insert before the add button
    addButton.parentNode.parentNode.insertBefore(newProductDiv, addButton.parentNode.parentNode);
}

function removeProduct(button) {
    const productRow = button.closest('.product-row');
    if (productRow) {
        productRow.remove();
    }
}

// Initialize additional functionality
document.addEventListener('DOMContentLoaded', function() {
    initializeFileUpload();

    // Add event listener for "Add New Product" button
    const addProductBtn = document.querySelector('.btn-outline-primary');
    if (addProductBtn && addProductBtn.textContent.includes('Add New Product')) {
        addProductBtn.addEventListener('click', addNewProduct);
    }

    // Add event listener for "Resend" link
    const resendLink = document.querySelector('a[href="#"]');
    if (resendLink && resendLink.textContent.includes('Resend')) {
        resendLink.addEventListener('click', function(e) {
            e.preventDefault();
            showToast('Verification code resent to your email', 'success');
        });
    }
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    // Allow navigation with arrow keys in passcode inputs
    if (e.target.classList.contains('passcode-digit')) {
        const inputs = Array.from(document.querySelectorAll('.passcode-digit'));
        const currentIndex = inputs.indexOf(e.target);

        if (e.key === 'ArrowLeft' && currentIndex > 0) {
            inputs[currentIndex - 1].focus();
        } else if (e.key === 'ArrowRight' && currentIndex < inputs.length - 1) {
            inputs[currentIndex + 1].focus();
        }
    }

    // Allow signup-form submission with Enter key
    if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
        e.preventDefault();
        const currentStepElement = document.getElementById(`step${currentStep}`);
        const submitButton = currentStepElement.querySelector('.btn-primary');
        if (submitButton) {
            submitButton.click();
        }
    }
});

// Form data collection for preview
function collectFormData() {
    const formData = {
        companyIdentity: {},
        companyInfo: {},
        productInfo: {},
        serviceInfo: {}
    };

    // Collect data from each step
    const steps = [1, 2, 3, 4];
    steps.forEach(step => {
        const stepElement = document.getElementById(`step${step}`);
        const inputs = stepElement.querySelectorAll('input, select, textarea');

        inputs.forEach(input => {
            if (input.name || input.id) {
                const key = input.name || input.id;
                const value = input.type === 'checkbox' ? input.checked : input.value;

                switch(step) {
                    case 1:
                        formData.companyIdentity[key] = value;
                        break;
                    case 2:
                        formData.companyInfo[key] = value;
                        break;
                    case 3:
                        formData.productInfo[key] = value;
                        break;
                    case 4:
                        formData.serviceInfo[key] = value;
                        break;
                }
            }
        });
    });

    return formData;
}
document.addEventListener("DOMContentLoaded", function () {
    const addBtn = document.querySelector(".add-p-btn");
    const container = document.querySelector(".products-container");

    addBtn.addEventListener("click", function () {
        const firstRow = container.querySelector(".product-row");
        const newRow = firstRow.cloneNode(true);

        // Clear inputs
        newRow.querySelectorAll("input").forEach(input => input.value = "");

        // Add remove button only for appended rows
        const removeContainer = newRow.querySelector(".remove-btn-container");
        removeContainer.innerHTML = ''; // clear any existing content
        const removeBtn = document.createElement("button");
        removeBtn.type = "button";
        removeBtn.innerHTML = "&times;";
        removeBtn.className = "remove-p-btn btn btn-outline-danger btn-sm border px-2 py-1";
        removeContainer.appendChild(removeBtn);

        container.appendChild(newRow);
    });

    // Remove row
    container.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-p-btn")) {
            e.target.closest(".product-row").remove();
        }
    });
});


document.addEventListener("DOMContentLoaded", () => {
  const dropbtn = document.querySelector(".dropbtn3");
  if (dropbtn) {
    dropbtn.addEventListener("click", function () {
      let dropdownContent = this.nextElementSibling;
      dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
    });
  }
});

// Optional: Close dropdown when clicking outside
document.addEventListener("DOMContentLoaded", function () {
    function updateDropdownText(dropdown) {
        // Find the button - it's the previous sibling or parent's previous sibling
        const dropdownContainer = dropdown.closest('.service-domain-dropdown');
        const button = dropdownContainer ? dropdownContainer.querySelector('button') : dropdown.previousElementSibling;

        // Prevent dropdown from closing when clicking inside
        dropdown.addEventListener("click", function (e) {
            e.stopPropagation();
        });

        dropdown.addEventListener("change", function () {
            let selectedLabels = [];
            dropdown.querySelectorAll("input[type=checkbox]:checked").forEach(checkbox => {
                // Try both .signup-form-check and .form-check
                const formCheck = checkbox.closest(".signup-form-check") || checkbox.closest(".form-check");
                if (formCheck) {
                    const label = formCheck.querySelector("label");
                    if (label) {
                        selectedLabels.push(label.innerText.trim());
                    }
                }
            });

            // Determine default text based on button ID
            let defaultText = "Select service domain";
            if (button && button.id) {
                if (button.id.includes('skills') || button.id.includes('Link2')) {
                    defaultText = "Select skills";
                }
            }

            if (button) {
                button.innerText = selectedLabels.length > 0 ? selectedLabels.join(", ") : defaultText;
            }
        });
    }

    // Apply to ALL dropdown menus (including modal)
    document.querySelectorAll(".service-domain-dropdown .dropdown-menu").forEach(menu => {
        updateDropdownText(menu);
    });
});

function handleAjaxError(xhr, nextBtn, resolve) {
    if (nextBtn) {
        $(nextBtn)
            .prop('disabled', false)
            .removeAttr('disabled')
            .removeClass('disabled')
            .attr('aria-disabled', 'false');
    }
    if (xhr.status === 422 && xhr.responseJSON?.errors) {
        const errors = xhr.responseJSON.errors;
        const [firstField] = Object.keys(errors);
        const firstMessage = errors[firstField][0];
        $('.invalid-feedback.backend').remove();
        Object.entries(errors).forEach(([name, msgs]) => {
            const $field = $(`[name="${name}"]`);
            if ($field.length) {
                $field.addClass('is-invalid')
                      .after(`<div class="invalid-feedback backend d-block">${msgs[0]}</div>`);
            }
        });
        setTimeout(() => {
            $('.invalid-feedback.backend').fadeOut(300, function () { $(this).remove(); });
            $(errorContainer).fadeOut(300, function () { $(this).html('').show(); });
            $('.is-invalid').removeClass('is-invalid');
        }, 3000);

        resolve(false);
    } else {
        resolve(false);
    }
}

function submitCompanyIdentity() {
    let form = document.getElementById("companyIdentityForm"); 
    let formData = new FormData(form);
    let nextBtn = document.getElementById("nextBtnStep1");
    $("#step1Errors").html('');
    nextBtn.disabled = true;

    return new Promise((resolve, reject) => {
        $.ajax({
            url: companyIdentityUrl,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: { 
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            success: function (response) {
                $("#step1Errors").html('');
                $('#companyIdentityForm .text-danger.small').text('');
                $('#companyIdentityForm input, #companyIdentityForm select').removeClass('is-invalid').addClass('is-valid');
                nextBtn.disabled = false;
                checkStep1ButtonState();
                resolve(true);
                $("#organization_id").val(response.organization.id);
                organizationId = response.organization.id;
            },
            error: function (xhr) {
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    // Clear previous errors
                    $('#companyIdentityForm .text-danger.small').text('');
                    $('#companyIdentityForm input, #companyIdentityForm select').removeClass('is-invalid');
                    
                    const errors = xhr.responseJSON.errors;
                    let firstErrorField = null;
                    
                    // Display errors under respective fields
                    $.each(errors, function(field, messages) {
                        const errorMessage = Array.isArray(messages) ? messages[0] : messages;
                        const fieldInput = $(`#companyIdentityForm [name="${field}"]`);
                        
                        if (fieldInput.length) {
                            fieldInput.addClass('is-invalid');
                            const errorDiv = $(`#${field}_error`);
                            if (errorDiv.length) {
                                errorDiv.text(errorMessage).show();
                            } else {
                                fieldInput.after(`<div id="${field}_error" class="text-danger small mt-1">${errorMessage}</div>`);
                            }
                            
                            if (!firstErrorField) {
                                firstErrorField = fieldInput[0];
                            }
                        }
                    });
                    
                    // Scroll to first error
                    if (firstErrorField) {
                        $('html, body').animate({
                            scrollTop: $(firstErrorField).offset().top - 100
                        }, 500);
                    }
                    
                    nextBtn.disabled = false;
                    checkStep1ButtonState();
                    resolve(false);
                } else {
                    handleAjaxError(xhr, nextBtn, resolve);
                }
            }
        });
    });
}

function updateFileName() {
    const fileInput = document.getElementById('formFile');
    const fileNameInput = document.getElementById('fileName');

    if (fileInput.files.length > 0) {
        fileNameInput.value = fileInput.files[0].name;
    } else {
        fileNameInput.value = '';
    }
}

function submitCompanyInfo() {
    let form = document.getElementById("companyInfoForm"); 
    let formData = new FormData(form);
    let nextBtn = document.getElementById("nextBtnStep2");
    $("#step2Errors").html('');
    nextBtn.disabled = true;
    formData.append("organization_id", organizationId);

    return new Promise((resolve, reject) => {
        $.ajax({
            url: companyInfoUrl,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: { 
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            success: function (response) {
                $("#step2Errors").html('');
                nextBtn.disabled = false;
                resolve(true);
            },
            error: function (xhr) {
                handleAjaxError(xhr, nextBtn, resolve);
            }
        });
    });
}

function submitProductInfo() {
    let form = document.getElementById("productInfoForm"); 
    let formData = new FormData(form);
    let nextBtn = document.getElementById("nextBtnStep3");
    $("#step3Errors").html('');
    nextBtn.disabled = true;
    formData.append("organization_id", organizationId);

    return new Promise((resolve, reject) => {
        $.ajax({
            url: productInfoUrl,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: { 
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            success: function (response) {
                $("#step3Errors").html('');
                nextBtn.disabled = false;
                resolve(true);
            },
            error: function (xhr) {
                handleAjaxError(xhr, nextBtn, resolve);
            }
        });
    });
}

function submitServiceInfo() {
    let form = document.getElementById("serviceInfoForm"); 
    let formData = new FormData(form);
    let nextBtn = document.getElementById("nextBtnStep4");
    $("#step4Errors").html('');
    nextBtn.disabled = true;
    formData.append("organization_id", organizationId);

    return new Promise((resolve, reject) => {
        $.ajax({
            url: serviceInfoUrl,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: { 
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            success: function (response) {
                $("#step4Errors").html('');
                nextBtn.disabled = false;
                resolve(true);
            },
            error: function (xhr) {
                handleAjaxError(xhr, nextBtn, resolve);
            }
        });
    });
}

function submitPasscode() {
    let form = document.getElementById("passcodeForm"); 
    let formData = new FormData(form);
    formData.append("organization_id", organizationId);

    return new Promise((resolve, reject) => {
        $.ajax({
            url: passcodeUrl,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: { 
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            success: function (response) {
                populatePreview(response);
                previewCompanyIdentityModal(response);
                previewCompanyInformationModal(response);
                previewProductInformationModal(response);
                previewServiceInformationModal(response);
                resolve(true);
            },
            error: function (xhr) {
                resolve(false);
            }
        });
    });
}

document.addEventListener("input", function(e) {
    if (e.target.classList.contains("passcode-digit")) {
        let passcode = "";
        let confirmPasscode = "";
        document.querySelectorAll('.passcode-digit[data-index]').forEach(input => {
            let i = parseInt(input.dataset.index);
            if (i < 6) {
                passcode += input.value;
            } else {
                confirmPasscode += input.value;
            }
        });

        document.getElementById("passcode").value = passcode;
        document.getElementById("passcode_confirmation").value = confirmPasscode;
    }
});

function populatePreview(data) {
    const org = data.organization;
    const serviceDomains = data.serviceDomains;
    const skills = data.skills;
    const industryArea = data.industryArea;

    document.querySelector('.organization-name').textContent = org.name || '';
    document.querySelector('.secp-no').textContent = org.secp_registration_number || '';
    document.querySelector('.pasha-no').textContent = org.pasha_registration_number || '';
    document.querySelector('.ceo-contact').textContent = org.ceo_contact || '';
    document.querySelector('.reg-comp-ksa').textContent = org.has_ksa_registered_company ? 'YES' : 'NO';
    document.querySelector('.company-rep-name').textContent = org.representative_name || '';
    document.querySelector('.company-rep-email').textContent = org.representative_email || '';
    document.querySelector('.website-url').textContent = org.website_url || '';
    document.querySelector('.pseb-no').textContent = org.pseb_registration_number || '';
    document.querySelector('.ceo-name').textContent = org.ceo_name || '';
    document.querySelector('.ceo-email').textContent = org.ceo_email || '';
    document.querySelector('.ksa-entity-name').textContent = org.representative_name || '';
    document.querySelector('.company-rep-contact').textContent = org.representative_contact || '';

    // Company logo
    if (org.user && org.user.images && org.user.images.length > 0) {
        const logoImg = document.querySelector('.company-logo');
        const logo = org.user.images.find(img => img.type === 'company_logo');
        if (logo) {
            logoImg.src = window.location.origin + '/storage/' + logo.path;
        }
    }

    // 2. Company Information
    document.querySelector('.company-type').textContent = org.company_type || '';
    document.querySelector('.staff-count').textContent = org.no_of_staff || '';
    if (industryArea && industryArea.length > 0) {
        document.querySelector('.industry-area').textContent = industryArea.map(d => d.name).join(', ');
    }
    document.querySelector('.project-count').textContent = org.no_of_projects || '';
    document.querySelector('.experience-years').textContent = org.years_of_experience ? org.years_of_experience + ' Years' : '';
    document.querySelector('.has-certificate').textContent = org.has_certificate ? 'YES' : 'NO';
    document.querySelector('.reference-clients').textContent = org.reference || '';
    document.querySelector('.reference-projects').textContent = org.reference_project || '';

    // 3. Product Information (multiple)
    if (org.products && org.products.length > 0) {
        document.querySelector('.product-names').textContent = org.products.map(p => p.name).join(', ');
        document.querySelector('.product-capabilities').textContent = org.products.map(p => p.capabilities).join(', ');
    }

    // 4. Service Information
    if (serviceDomains && serviceDomains.length > 0) {
        document.querySelector('.service-domains').textContent = serviceDomains.map(d => d.name).join(', ');
    }
    if (skills && skills.length > 0) {
        document.querySelector('.skills').textContent = skills.map(s => s.name).join(', ');
    }
    document.querySelector('.ip-implement').textContent = org.ip || '';
    document.querySelector('.staff-certificate').textContent = org.staff_certification || '';

    // Finally show the preview step
    const step6 = document.getElementById('step6');
    if (step6.classList.contains('d-none')) {
        step6.classList.remove('d-none');
    }
}

function showEditCompanyIdentityModal() {
    $("#editCompanyIdentityModal").modal("show");
}

function showEditCompanyInformationModal() {
    $("#editCompanyInformationModal").modal("show");
}

function showEditProductInformationModal() {
    // Fetch organization data to populate the modal
    if (!organizationId) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Organization ID not found. Please try again.',
            confirmButtonText: 'OK'
        });
        return;
    }

    // Fetch organization data
    $.ajax({
        url: typeof getOrganizationDataUrl !== 'undefined' ? getOrganizationDataUrl : '/organization/get-organization-data',
        type: "POST",
        data: {
            organization_id: organizationId
        },
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        },
        success: function(response) {
            previewProductInformationModal(response);
            $("#editProductInformationModal").modal("show");
        },
        error: function(xhr) {
            console.error('Failed to fetch organization data:', xhr);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to load product information. Please try again.',
                confirmButtonText: 'OK'
            });
        }
    });
}

function showEditServiceInformationModal() {
    $("#editServiceInformationModal").modal("show");
}

function previewCompanyIdentityModal(data) {
    const org = data.organization || {};

    $('#name-modal').val(org.name || '');
    $('#website_url-modal').val(org.website_url || '');
    $('#secp_registration_number-modal').val(org.secp_registration_number || '');
    $('#pseb_registration_number-modal').val(org.pseb_registration_number || '');
    $('#pasha_registration_number-modal').val(org.pasha_registration_number || '');
    $('#ceo_name-modal').val(org.ceo_name || '');
    $('#ceo_contact-modal').val(org.ceo_contact || '');
    $('#ceo_email-modal').val(org.ceo_email || '');
    $('#has_ksa_registered_company-modal').val(org.has_ksa_registered_company ? 1 : 0);
    $('#saudi_entity_name-modal').val(org.saudi_entity_name || '');
    $('#representative_name-modal').val(org.representative_name || '');
    $('#representative_contact-modal').val(org.representative_contact || '');
    $('#representative_email-modal').val(org.representative_email || '');

    // if (org.images && org.images.length > 0) {
    //     const logo = org.images.find(img => img.type === 'company_logo');
    //     if (logo) {
    //         const fileNameInput = document.getElementById('fileName-Modal');
    //         fileNameInput.value = logo.path.split('/').pop();
    //     }
    // }
}

function submitCompanyIdentityModal() {
    let form = $("#companyIdentityForm-modal")[0];
    let formData = new FormData(form);
    formData.append("organization_id", organizationId);
    let updateBtn = document.getElementById("updateButtonStep1");
    $("#step1ErrorsModal").html('');
    updateBtn.disabled = true;

    $.ajax({
        url: companyIdentityUrl,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        },
        success: function(response) {
            $("#editCompanyIdentityModal").modal("hide");
            $("#step1ErrorsModal").html('');
            updateBtn.disabled = false;
            populatePreview(response);
            previewCompanyIdentityModal(response);
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Organization data has been updated successfully!',
                confirmButtonText: 'OK'
            });
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let firstField = Object.keys(errors)[0];
                let firstMessage = errors[firstField][0];
                $("#step1ErrorsModal").html(`<div class="text-danger">${firstMessage}</div>`);
                updateBtn.disabled = false;
            }
        }
    });
}

// function updateFileNameModal() {
//     const fileInput = document.getElementById('formFile-Modal');
//     const fileNameInput = document.getElementById('fileName-Modal');

//     if (fileInput.files.length > 0) {
//         fileNameInput.value = fileInput.files[0].name;
//     } else {
//         fileNameInput.value = '';
//     }
// }

function previewCompanyInformationModal(data) {
    const org = data.organization || {};
    const industryArea = data.industryArea;

    $('#company_type-modal').val(org.company_type || '');
    $('#years_of_experience-modal').val(org.years_of_experience || '');
    $('#no_of_staff-modal').val(org.no_of_staff || '');
    $('#has_company_certificate-modal').val(org.has_certificate ? 1 : 0);
    $('#industry_area-modal').val(industryArea[0].id);
    $('#reference-modal').val(org.reference || '');
    $('#no_of_projects-modal').val(org.no_of_projects || '');
    $('#reference_project-modal').val(org.reference_project || '');
}

function submitCompanyInformationModal() {
    let form = $("#companyInformationForm-modal")[0];
    let formData = new FormData(form);
    formData.append("organization_id", organizationId);
    let updateBtn = document.getElementById("updateButtonStep2");
    $("#step2ErrorsModal").html('');
    updateBtn.disabled = true;

    $.ajax({
        url: companyInfoUrl,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        },
        success: function(response) {
            $("#step2ErrorsModal").html('');
            $("#editCompanyInformationModal").modal("hide");
            updateBtn.disabled = false;
            populatePreview(response);
            previewCompanyInformationModal(response);
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Organization data has been updated successfully!',
                confirmButtonText: 'OK'
            });
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let firstField = Object.keys(errors)[0];
                let firstMessage = errors[firstField][0];
                $("#step2ErrorsModal").html(`<div class="text-danger">${firstMessage}</div>`);
                updateBtn.disabled = false;
            }
        }
    });
}

function previewProductInformationModal(data) {
    const org = data.organization || {};
    const products = org.products || [];

    const container = $('#product-fields-container');
    container.empty();

    products.forEach(product => {
        const row = `
            <div class="row mb-3 product-row">
                <input type="hidden" name="product_id[]" value="${product.id || ''}">
                <div class="col-md-6 mb-4 position-relative">
                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name[]" placeholder="Enter Product Name" value="${product.name || ''}" required>
                </div>
                <div class="col-md-6 mb-4 position-relative">
                    <label class="form-label">Product Capabilities <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="capabilities[]" placeholder="Enter Product Capabilities" value="${product.capabilities || ''}" required>
                </div>
            </div>
        `;
        container.append(row);
    });

    if (products.length === 0) {
        const emptyRow = `
            <div class="row mb-3 product-row">
                <div class="col-md-6 mb-4 position-relative">
                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name[]" placeholder="Enter Product Name" required>
                </div>
                <div class="col-md-6 mb-4 position-relative">
                    <label class="form-label">Product Capabilities <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="capabilities[]" placeholder="Enter Product Capabilities" required>
                </div>
            </div>
        `;
        container.append(emptyRow);
    }
}

// $(document).on('click', '.add-p-btn', function() {
//     const container = $('#product-fields-container');
//     const newRow = `
//         <div class="row mb-3 product-row">
//             <div class="col-md-6 mb-4 position-relative">
//                 <label class="form-label">Product Name <span class="text-danger">*</span></label>
//                 <input type="text" class="form-control" name="name[]" placeholder="Enter Product Name" required>
//             </div>
//             <div class="col-md-6 mb-4 position-relative">
//                 <label class="form-label">Product Capabilities</label>
//                 <input type="text" class="form-control" name="capabilities[]" placeholder="Enter Product Capabilities" required>
//             </div>
//         </div>
//     `;
//     container.append(newRow);
// });

function submitProductInformationModal() {
    let form = $("#productInformationForm-modal")[0];
    let formData = new FormData(form);
    formData.append("organization_id", organizationId);
    let updateBtn = document.getElementById("updateButtonStep3");
    $("#step3ErrorsModal").html('');
    updateBtn.disabled = true;

    $.ajax({
        url: productInfoUrl,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        },
        success: function(response) {
            $("#step3ErrorsModal").html('');
            $("#editProductInformationModal").modal("hide");
            updateBtn.disabled = false;
            populatePreview(response);
            previewProductInformationModal(response);
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Organization data has been updated successfully!',
                confirmButtonText: 'OK'
            });
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let firstField = Object.keys(errors)[0];
                let firstMessage = errors[firstField][0];
                $("#step3ErrorsModal").html(`<div class="text-danger">${firstMessage}</div>`);
                updateBtn.disabled = false;
            }
        }
    });
}

function previewServiceInformationModal(data) {
    const org = data.organization || {};
    const selections = [
        { items: data.serviceDomains || [], inputName: 'service_domains[]', buttonSelector: '#dropdownMenuLink-modal', defaultText: 'Select service domain' },
        { items: data.skills || [], inputName: 'skills[]', buttonSelector: '#dropdownMenuLink2-modal', defaultText: 'Select skills' }
    ];

    selections.forEach(({ items, inputName, buttonSelector, defaultText }) => {
        const ids = items.map(i => i.id);
        // Check the checkboxes within the modal
        $(`#editServiceInformationModal input[name="${inputName}"]`).each(function() {
            $(this).prop('checked', ids.includes(parseInt($(this).val())));
        });
        
        // Get labels from checked checkboxes - find label within the same form-check container
        const labels = $(`#editServiceInformationModal input[name="${inputName}"]:checked`).map(function() {
            const formCheck = $(this).closest('.form-check');
            const label = formCheck.find('label');
            return label.length ? label.text().trim() : '';
        }).get().filter(label => label !== '');

        // Update button text
        $(buttonSelector).text(labels.length ? labels.join(', ') : defaultText);
    });

    $('#ip-implement-modal').val(org.ip || '');
    $('#staff-certificate-modal').val(org.staff_certification || '');
}

function submitServiceInformationModal() {
    let form = $("#serviceInformationForm-modal")[0];
    let formData = new FormData(form);
    formData.append("organization_id", organizationId);
    let updateBtn = document.getElementById("updateButtonStep4");
    $("#step4ErrorsModal").html('');
    updateBtn.disabled = true;

    $.ajax({
        url: serviceInfoUrl,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        },
        success: function(response) {
            $("#step4ErrorsModal").html('');
            $("#editServiceInformationModal").modal("hide");
            updateBtn.disabled = false;
            populatePreview(response);
            previewServiceInformationModal(response);
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Organization data has been updated successfully!',
                confirmButtonText: 'OK'
            });
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let firstField = Object.keys(errors)[0];
                let firstMessage = errors[firstField][0];
                $("#step4ErrorsModal").html(`<div class="text-danger">${firstMessage}</div>`);
                updateBtn.disabled = false;
            }
        }
    });
}

function checkEmail() {
    // Clear previous errors - use more specific selector
    const $emailError = $('#emailError');
    if ($emailError.length) {
        $emailError.addClass('d-none').css('display', 'none');
    }
    $('#email').removeClass('is-invalid', 'is-valid');
    
    let email = $('#email').val().trim();
    
    // Frontend validation - must pass before backend call
    if (!email) {
        const $emailError = $('#emailError');
        $emailError
            .removeClass('d-none')
            .text("Please enter valid email")
            .css({
                'display': 'block',
                'visibility': 'visible',
                'opacity': '1'
            });
        $('#email').addClass('is-invalid');
        // Trigger auto-clear timer
        if (typeof autoClearErrors === 'function') {
            autoClearErrors();
        }
        return;
    }
    
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        const $emailError = $('#emailError');
        $emailError
            .removeClass('d-none')
            .text("Please enter valid email")
            .css({
                'display': 'block',
                'visibility': 'visible',
                'opacity': '1'
            });
        $('#email').addClass('is-invalid');
        // Trigger auto-clear timer
        if (typeof autoClearErrors === 'function') {
            autoClearErrors();
        }
        return;
    }
    
    // Frontend validation passed - show success state
    $('#email').addClass('is-valid');
    
    // Now make backend call
    let token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: checkEmailUrl,
        method: 'POST',
        data: { _token: token, email: email },
        dataType: 'json',
        success: function (response) {
            console.log('AJAX Success - Response:', response);
            // Check if response has error (even in success handler)
            if (response && response.error) {
                // Handle error even in success response
                $('#email').removeClass('is-valid').addClass('is-invalid');
                const $emailError = $('#emailError');
                if ($emailError.length) {
                    $emailError
                        .removeClass('d-none')
                        .html(response.error)
                        .css({
                            'display': 'block !important',
                            'visibility': 'visible !important',
                            'opacity': '1 !important',
                            'color': '#dc3545 !important'
                        })
                        .show();
                }
                if (typeof autoClearErrors === 'function') {
                    autoClearErrors();
                }
                return;
            }
            
            // Success - proceed to next step
            currentEmail = email;
            $('#stepEmail').addClass('d-none');
            $('#stepPasscode').removeClass('d-none');
        },
        error: function (xhr, status, error) {
            console.log('AJAX Error - Status:', xhr.status, 'Response:', xhr.responseJSON, 'Status Text:', status);
            
            // Remove success state and show error
            $('#email').removeClass('is-valid').addClass('is-invalid');
            
            // Get the error element - it should exist in the HTML (line 130)
            let $emailError = $('#emailError');
            
            // Check if multiple elements exist (shouldn't happen)
            if ($emailError.length > 1) {
                console.warn('Multiple emailError elements found, using first one');
                $emailError = $emailError.first();
            }
            
            // If element doesn't exist, something is wrong - try to find it or create it
            if ($emailError.length === 0) {
                console.error('emailError element not found in DOM!');
                // Try to find it by checking the email input's parent
                const $emailInput = $('#email');
                const $parent = $emailInput.parent();
                $emailError = $parent.find('#emailError');
                
                // If still not found, create it
                if ($emailError.length === 0) {
                    console.warn('Creating emailError element');
                    $emailError = $('<div id="emailError" class="text-danger small"></div>');
                    $emailInput.after($emailError);
                }
            }
            
            console.log('Error element found:', $emailError.length, 'Position:', $emailError.position(), 'Parent:', $emailError.parent().attr('class'));
            
            let errorMessage = 'Invalid email';
            
            // Try to parse response JSON
            let responseData = null;
            try {
                if (xhr.responseJSON) {
                    responseData = xhr.responseJSON;
                } else if (xhr.responseText) {
                    responseData = JSON.parse(xhr.responseText);
                }
            } catch (e) {
                console.error('Error parsing response:', e);
            }
            
            // Backend returns errors in 'error' key with different status codes
            if (responseData && responseData.error) {
                errorMessage = responseData.error;
            } else {
                // Fallback messages based on status code
                if (xhr.status === 404) {
                    errorMessage = 'Please enter valid email';
                } else if (xhr.status === 403) {
                    errorMessage = 'Your account is inactive';
                } else if (xhr.status === 500) {
                    errorMessage = (responseData && responseData.error) ? responseData.error : 'An error occurred. Please try again.';
                } else {
                    errorMessage = 'Invalid email';
                }
            }
            
            console.log('Displaying error message:', errorMessage);
            
            // Show error with explicit styling - force visibility
            $emailError
                .removeClass('d-none')
                .html(errorMessage)
                .css({
                    'display': 'block',
                    'visibility': 'visible',
                    'opacity': '1',
                    'color': '#dc3545',
                    'margin-top': '0.25rem',
                    'font-size': '0.875rem'
                })
                .show();
            
            // Trigger auto-clear timer (but delay it to ensure error is visible first)
            setTimeout(function() {
                if (typeof autoClearErrors === 'function') {
                    autoClearErrors();
                }
            }, 100);
        }
    });
}

function getPasscode() {
    let code = '';
    $('.passcode-digit').each(function () {
        code += $(this).val().trim();
    });
    return code;
}

function getRemember()
{
    return $('#termsCheck').prop('checked');
}

function handleSignIn() {
    $('#passcodeError').addClass('d-none');
    let passcode = getPasscode();
    let remember = getRemember();
    if (passcode.length !== 6) {
        $('#passcodeError').removeClass('d-none').text("Please enter valid passcode.");
        // Trigger auto-clear timer for passcode errors
        if (typeof autoClearPasscodeErrors === 'function') {
            autoClearPasscodeErrors();
        }
        return;
    }

    let token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/organization/organization-signin',
        method: 'POST',
        data: { _token: token, email: currentEmail, passcode: passcode, remember: remember },
        success: function (response) {
            showToast('Signed in successfully');
            if (response.user.roles[0].name === 'organization_admin') {
                window.location.href = '/company/dashboard';
            } else if (response.user.roles[0].name === 'customer') {
                window.location.href = '/user/dashboard';
            }
        },
        error: function (xhr) {
            $('#passcodeError').removeClass('d-none').text("Incorrect passcode");
            // Trigger auto-clear timer for passcode errors
            if (typeof autoClearPasscodeErrors === 'function') {
                autoClearPasscodeErrors();
            }
        }
    });
}

function setupDropdown(container, defaultText) {
    const checkboxes = container.querySelectorAll('.form-check-input');
    const button = container.querySelector('.dropbtn3');

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function () {
            const selected = Array.from(checkboxes)
                .filter(c => c.checked)
                .map(c => c.nextElementSibling.innerText.trim());

            if (selected.length === 0) {
                button.innerText = defaultText;
            } else if (selected.length <= 2) {
                button.innerText = selected.join(', ');
            } else {
                const firstTwo = selected.slice(0, 2).join(', ');
                button.innerText = `${firstTwo} +${selected.length - 2} more`;
            }
        });
    });
}

document.querySelectorAll('.service-domain-dropdown').forEach((dropdown, i) => {
    if (i === 0) {
        setupDropdown(dropdown, 'Select service domain');
    } else if (i === 1) {
        setupDropdown(dropdown, 'Select skills');
    }
});

// Export functions for global access
window.nextStep = nextStep;
window.prevStep = prevStep;
window.prevStepIndividual =prevStepIndividual;
window.showPreview = showPreview;
window.showAuthModal = showAuthModal;
window.showVerifiedModal = showVerifiedModal;
window.addNewProduct = addNewProduct;
window.removeProduct = removeProduct;

