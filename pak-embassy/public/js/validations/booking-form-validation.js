document.addEventListener('DOMContentLoaded', function() {
    // Setup real-time validation for all form fields
    setupRealTimeValidation();
    
    // Setup step validation
    setupStepValidation();
    
    // Also setup validation when modal is shown (for pre-populated fields)
    const modal = document.getElementById('stepModal');
    if (modal) {
        modal.addEventListener('shown.bs.modal', function() {
            // Small delay to ensure fields are populated
            setTimeout(() => {
                setupRealTimeValidation();
            }, 100);
        });
    }
});

// Setup real-time validation for all form fields
function setupRealTimeValidation() {
    const fields = [
        'firstName', 'lastName', 'phone_number', 'email', 'startDate', 'company', 'termsCheck'
    ];
    
    fields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field) {
            // Add blur and input event listeners for real-time validation
            field.addEventListener('blur', function() {
                validateField(fieldId);
            });
            
            field.addEventListener('input', function() {
                validateField(fieldId);
            });
            
            // Validate pre-populated fields immediately
            if (field.value && field.value.trim()) {
                console.log('Validating pre-populated field:', fieldId, 'with value:', field.value);
                validateField(fieldId);
            }
            
            // Always validate checkbox to show initial state
            if (fieldId === 'termsCheck') {
                console.log('Validating checkbox on setup');
                validateField(fieldId);
            }
        }
    });
    
    // Setup radio button validation
    setupRadioButtonValidation();
    
    // Setup checkbox validation
    setupCheckboxValidation();
}

// Setup radio button validation
function setupRadioButtonValidation() {
    const radioGroups = [
        { name: 'people_count', errorId: 'people_count_error' },
        { name: 'space_type', errorId: 'space_type_error' },
        { name: 'duration', errorId: 'duration_error' }
    ];
    
    radioGroups.forEach(group => {
        const radios = document.querySelectorAll(`input[name="${group.name}"]`);
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                validateRadioGroup(group.name, group.errorId);
            });
        });
    });
}

// Setup checkbox validation
function setupCheckboxValidation() {
    const termsCheckbox = document.getElementById('termsCheck');
    if (termsCheckbox) {
        termsCheckbox.addEventListener('change', function() {
            validateField('termsCheck');
        });
        
        // Validate checkbox immediately if it's already checked
        if (termsCheckbox.checked) {
            validateField('termsCheck');
        }
    }
}

// Individual field validation function
function validateField(fieldId) {
    const field = document.getElementById(fieldId);
    let errorElementId = fieldId + '_error';
    
    console.log('Validating field:', fieldId, 'Field found:', !!field);
    
    if (!field) return true;
    
    let isValid = true;
    let errorMessage = '';
    
    // Get field value
    let fieldValue = '';
    if (field.type === 'checkbox') {
        fieldValue = field.checked;
    } else {
        fieldValue = field.value || '';
    }
    
    switch(fieldId) {
        case 'firstName':
            if (!fieldValue.trim()) {
                isValid = false;
                errorMessage = 'First name is required';
            } else if (fieldValue.trim().length > 255) {
                isValid = false;
                errorMessage = 'First name must not exceed 255 characters';
            }
            break;
            
        case 'lastName':
            if (!fieldValue.trim()) {
                isValid = false;
                errorMessage = 'Last name is required';
            } else if (fieldValue.trim().length > 255) {
                isValid = false;
                errorMessage = 'Last name must not exceed 255 characters';
            }
            break;
            
        case 'phone_number':
            if (!fieldValue.trim()) {
                isValid = false;
                errorMessage = 'Phone number is required';
            } else if (!/^9665\d{8}$/.test(fieldValue.trim())) {
                isValid = false;
                errorMessage = 'Phone number must start with 9665 and be 12 digits total (9665XXXXXXXX)';
            }
            break;
            
        case 'email':
            if (!fieldValue.trim()) {
                isValid = false;
                errorMessage = 'Email is required';
            } else if (!/^\S+@\S+\.\S+$/.test(fieldValue.trim())) {
                isValid = false;
                errorMessage = 'Please enter a valid email address';
            }
            break;
            
        case 'startDate':
            console.log('Validating startDate:', fieldId, 'Value:', fieldValue);
            if (!fieldValue.trim()) {
                isValid = false;
                errorMessage = 'Estimated start date is required';
                console.log('Start date validation failed - empty');
            } else {
                const selectedDate = new Date(fieldValue);
                const today = new Date();
                today.setHours(0, 0, 0, 0); // Reset time to start of day
                
                console.log('Selected date:', selectedDate);
                console.log('Today:', today);
                console.log('Is selected date >= today?', selectedDate >= today);
                
                if (selectedDate < today) {
                    isValid = false;
                    errorMessage = 'Start date must be after today';
                    console.log('Start date validation failed - date is in the past');
                } else {
                    console.log('Start date validation passed');
                }
            }
            break;
            
        case 'company':
            // Company is optional, but if provided, validate length
            if (fieldValue.trim() && fieldValue.trim().length > 255) {
                isValid = false;
                errorMessage = 'Company name must not exceed 255 characters';
            }
            break;
            
        case 'termsCheck':
            console.log('Validating checkbox:', fieldId, 'Checked:', fieldValue);
            if (!fieldValue) {
                isValid = false;
                errorMessage = 'You must accept the terms and conditions';
                console.log('Checkbox validation failed - not checked');
            } else {
                console.log('Checkbox validation passed - checked');
            }
            break;
    }
    
    // Show/hide error message and apply visual feedback
    const errorElement = document.getElementById(errorElementId);
    console.log('Error element for', fieldId, ':', errorElementId, 'Found:', !!errorElement);
    
    if (errorElement) {
        if (isValid) {
            errorElement.textContent = '';
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
            console.log('Field', fieldId, 'is valid - showing green border');
        } else {
            errorElement.textContent = errorMessage;
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
            console.log('Field', fieldId, 'is invalid - showing red border, error:', errorMessage);
        }
    } else {
        console.log('Error element not found for field:', fieldId);
    }
    
    return isValid;
}

// Validate radio button group
function validateRadioGroup(groupName, errorId) {
    const selectedRadio = document.querySelector(`input[name="${groupName}"]:checked`);
    const errorElement = document.getElementById(errorId);
    
    if (!selectedRadio) {
        if (errorElement) {
            let errorMessage = '';
            switch(groupName) {
                case 'people_count':
                    errorMessage = 'Please select number of people';
                    break;
                case 'space_type':
                    errorMessage = 'Please select a space type';
                    break;
                case 'duration':
                    errorMessage = 'Please select duration';
                    break;
            }
            errorElement.textContent = errorMessage;
        }
        return false;
    } else {
        if (errorElement) {
            errorElement.textContent = '';
        }
        return true;
    }
}

// Setup step validation
function setupStepValidation() {
    // Override the existing validateStep function
    window.validateStep = function(step) {
        let isValid = true;
        
        // Clear previous errors
        document.querySelectorAll('[id$="_error"]').forEach(el => {
            el.textContent = '';
        });
        
        // Clear visual feedback
        document.querySelectorAll('.is-invalid, .is-valid').forEach(el => {
            el.classList.remove('is-invalid', 'is-valid');
        });
        
        switch (step) {
            case 1:
                isValid = validateRadioGroup('people_count', 'people_count_error');
                break;
                
            case 2:
                isValid = validateRadioGroup('space_type', 'space_type_error');
                break;
                
            case 3:
                isValid = validateRadioGroup('duration', 'duration_error');
                break;
                
            case 4:
                // Validate all required fields in step 4
                const requiredFields = ['firstName', 'lastName', 'phone_number', 'email', 'startDate', 'termsCheck'];
                requiredFields.forEach(fieldId => {
                    if (!validateField(fieldId)) {
                        isValid = false;
                    }
                });
                
                // Validate company name if provided (optional field)
                const companyField = document.getElementById('company');
                if (companyField && companyField.value.trim()) {
                    if (!validateField('company')) {
                        isValid = false;
                    }
                }
                break;
        }
        
        return isValid;
    };
}

// Utility function to clear all errors
function clearAllErrors() {
    document.querySelectorAll('[id$="_error"]').forEach(el => {
        el.textContent = '';
    });
    
    document.querySelectorAll('.is-invalid, .is-valid').forEach(el => {
        el.classList.remove('is-invalid', 'is-valid');
    });
}

// Utility function to show field error
function showFieldError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorElement = document.getElementById(fieldId + '_error');
    
    if (field && errorElement) {
        errorElement.textContent = message;
        field.classList.remove('is-valid');
        field.classList.add('is-invalid');
    }
}

// Utility function to clear field error
function clearFieldError(fieldId) {
    const field = document.getElementById(fieldId);
    const errorElement = document.getElementById(fieldId + '_error');
    
    if (field && errorElement) {
        errorElement.textContent = '';
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
    }
}

// Test function to validate all fields manually
function testAllFields() {
    console.log('=== Testing all fields ===');
    const fields = ['firstName', 'lastName', 'phone_number', 'email', 'startDate', 'company', 'termsCheck'];
    
    fields.forEach(fieldId => {
        console.log('Testing field:', fieldId);
        const field = document.getElementById(fieldId);
        if (field) {
            console.log('Field found, value:', field.value || field.checked);
            validateField(fieldId);
        } else {
            console.log('Field not found:', fieldId);
        }
    });
}

// Test function specifically for checkbox
function testCheckbox() {
    console.log('=== Testing Checkbox ===');
    const checkbox = document.getElementById('termsCheck');
    const errorElement = document.getElementById('termsCheck_error');
    
    console.log('Checkbox found:', !!checkbox);
    console.log('Checkbox checked:', checkbox ? checkbox.checked : 'N/A');
    console.log('Error element found:', !!errorElement);
    
    if (checkbox) {
        validateField('termsCheck');
    }
}

// Test function specifically for start date
function testStartDate() {
    console.log('=== Testing Start Date ===');
    const startDateField = document.getElementById('startDate');
    const errorElement = document.getElementById('startDate_error');
    
    console.log('Start date field found:', !!startDateField);
    console.log('Start date value:', startDateField ? startDateField.value : 'N/A');
    console.log('Error element found:', !!errorElement);
    
    if (startDateField) {
        validateField('startDate');
    }
}

// Make test functions available globally
window.testAllFields = testAllFields;
window.testCheckbox = testCheckbox;
window.testStartDate = testStartDate;
