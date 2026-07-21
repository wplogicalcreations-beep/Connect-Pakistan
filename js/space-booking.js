const steps = document.querySelectorAll('.step');
const stepContents = document.querySelectorAll('.step-content');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const lines = document.querySelectorAll('.line');
const form = document.getElementById('multiStepForm');

let currentStep = 1;
const totalSteps = 5;

// Function to display validation errors from backend
function displayValidationErrors(errors) {
    console.log('Displaying validation errors:', errors);

    // Clear all previous errors first
    clearAllErrors();

    for (const [field, errorMessages] of Object.entries(errors)) {
        // Convert field name to match our field IDs
        let fieldId = field;
        if (field === 'first_name') fieldId = 'firstName';
        else if (field === 'last_name') fieldId = 'lastName';
        else if (field === 'phone_number') fieldId = 'phone_number';
        else if (field === 'estimated_start_date') fieldId = 'startDate';
        else if (field === 'company_name') fieldId = 'company';
        else if (field === 'people_count') fieldId = 'people_count';
        else if (field === 'space_type') fieldId = 'space_type';
        else if (field === 'duration') fieldId = 'duration';
        else if (field === 'terms') fieldId = 'termsCheck';
        
        console.log('Looking for field with ID:', fieldId);

        const fieldElement = document.getElementById(fieldId);
        if (fieldElement) {
            // Use the validation system's showFieldError function
            if (typeof showFieldError === 'function') {
                showFieldError(fieldId, errorMessages[0]);
            } else {
                // Fallback to direct error display
                const errorElement = document.getElementById(fieldId + '_error');
                if (errorElement) {
                    errorElement.textContent = errorMessages[0];
                    fieldElement.classList.remove('is-valid');
                    fieldElement.classList.add('is-invalid');
                }
            }
            console.log('Error displayed for field:', field, 'in element:', fieldId);
        } else {
            console.log('Field element not found for field:', field, 'with ID:', fieldId);
        }
    }
}

function showStep(step) {
    stepContents.forEach(content => {
        content.classList.toggle('active', parseInt(content.dataset.step) === step);
    });

    steps.forEach(s => {
        const sNum = parseInt(s.dataset.step);
        s.classList.remove('active', 'completed');
        if (sNum < step) s.classList.add('completed');
        if (sNum === step) s.classList.add('active');
    });

    lines.forEach((line, index) => {
        line.style.backgroundColor = index < step - 1 ? '#14532d' : '#e5e7eb';
    });

    if (step === 4) {
        nextBtn.textContent = 'Submit →';
    } else if (step === 5) {
        nextBtn.textContent = 'Finish';
        updateSummary();
    } else {
        nextBtn.textContent = 'Continue →';
    }

    prevBtn.disabled = (step === 1 || step === 5);
    prevBtn.style.opacity = (step === 1 || step === 5) ? '0' : '1';
}

// validateStep function is now handled by booking-form-validation.js
// This function will be overridden by the validation system

function updateSummary() {
    // Update the summary in step 5
    const peopleCount = document.querySelector('input[name="people_count"]:checked');
    const spaceType = document.querySelector('input[name="space_type"]:checked');
    const duration = document.querySelector('input[name="duration"]:checked');
    const startDate = document.getElementById('startDate');

    if (peopleCount) {
        const value = peopleCount.value;
        let text = '';
        if (value === '1') text = '1 person';
        else if (value === '2') text = '2 people';
        else if (value === '3-4') text = '3-4 people';
        else if (value === '5-9') text = '5-9 people';
        else if (value === '10-19') text = '10-19 people';
        else if (value === '20-49') text = '20-49 people';
        else if (value === '50-99') text = '50-99 people';
        else if (value === '100+') text = '100+ people';
        document.getElementById('summaryPeople').textContent = text;
    }

    if (spaceType) {
        document.getElementById('summarySpaceType').textContent =
            spaceType.value === 'co_workspace' ? 'Co-WorkSpace' : 'Private Office';
    }

    if (duration) {
        document.getElementById('summaryDuration').textContent = duration.value + ' months';
    }

    if (startDate.value) {
        const date = new Date(startDate.value);
        document.getElementById('summaryDate').textContent =
            date.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
    }
}

nextBtn.addEventListener('click', async () => {
    if (currentStep === 4) {
        // Validate step 4 before submitting
        if (validateStep(currentStep)) {
            // Submit the form via AJAX
            try {
                const formData = new FormData(form);

                // Debug: Log form data
                console.log('Form data being sent:');
                for (let [key, value] of formData.entries()) {
                    console.log(key + ': ' + value);
                }

                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                console.log('Response status:', response.status);
                console.log('Response data:', data);

                if (response.ok) {
                    // Success - proceed to step 5
                    currentStep++;
                    showStep(currentStep);
                } else {
                    // Show validation errors
                    if (data.errors) {
                        console.log('Backend validation errors:', data.errors);
                        displayValidationErrors(data.errors);
                    }
                }
            } catch (error) {
                console.error('Form submission error:', error);
                // Show a generic error message
                alert('An error occurred while submitting the form. Please try again.');
            }
        }
    } else if (currentStep === totalSteps) {
        // Final step: close the modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('stepModal'));
        modal.hide();
        // Reset form and redirect or show success message
        form.reset();
        window.location.reload(); // Or redirect to a success page
    } else {
        // Validate current step before proceeding
        if (validateStep(currentStep)) {
            currentStep++;
            showStep(currentStep);
        }
    }
});

prevBtn.addEventListener('click', () => {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
});

// Function to verify all error elements exist
function verifyErrorElements() {
    const requiredErrorIds = [
        'coworking_space_error',
        'people_count_error',
        'space_type_error',
        'duration_error',
        'first_name_error',
        'last_name_error',
        'phone_number_error',
        'email_error',
        'estimated_start_date_error',
        'company_error',
        'terms_error'
    ];

    console.log('Verifying error elements exist:');
    requiredErrorIds.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            console.log('✓ Found:', id);
        } else {
            console.log('✗ Missing:', id);
        }
    });
}

// Reset on modal open
document.getElementById('stepModal').addEventListener('show.bs.modal', () => {
    currentStep = 1;
    showStep(currentStep);
    // Clear any validation errors using the new validation system
    if (typeof clearAllErrors === 'function') {
        clearAllErrors();
    } else {
        // Fallback to old method
        document.querySelectorAll('[id$="_error"]').forEach(el => {
            el.textContent = '';
        });
    }
    // Verify all error elements exist
    setTimeout(verifyErrorElements, 100);
});

// Ensure only one checkbox is selected at a time
document.querySelectorAll('input[type="radio"][name="space_type"]').forEach(radio => {
    radio.addEventListener('change', function () {
        if (this.checked) {
            document.querySelectorAll('input[type="radio"][name="space_type"]').forEach(r => {
                if (r !== this) r.checked = false;
            });
        }
    });
});
