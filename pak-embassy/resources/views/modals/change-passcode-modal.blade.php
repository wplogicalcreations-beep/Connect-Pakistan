<!-- Change Passcode Modal -->
<div class="modal fade" id="changePasscodeModal" tabindex="-1" aria-labelledby="changePasscodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
            <div class="modal-header border-0 pb-0" style="position: relative;">
                <h5 class="modal-title fw-bold" id="changePasscodeModalLabel" style="color: #333; font-size: 1.5rem;">Change Passcode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 1rem; right: 1rem;"></button>
            </div>
            <div class="modal-body px-4 pb-4">
                <p class="text-muted mb-4">Enter your new passcode below to change it</p>
                
                <!-- Old Passcode -->
                <div class="mb-4">
                    <label class="form-label fw-semibold mb-3" style="color: #333;">Enter Old Passcode</label>
                    <div class="passcode-input-group d-flex justify-content-start gap-2" data-group="old">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="0">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="1">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="2">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="3">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="4">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="5">
                    </div>
                </div>

                <!-- New Passcode -->
                <div class="mb-4">
                    <label class="form-label fw-semibold mb-3" style="color: #333;">Enter New Passcode</label>
                    <div class="passcode-input-group d-flex justify-content-start gap-2" data-group="new">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="0">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="1">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="2">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="3">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="4">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="5">
                    </div>
                </div>

                <!-- Re-Enter Passcode -->
                <div class="mb-4">
                    <label class="form-label fw-semibold mb-3" style="color: #333;">Re-Enter Passcode</label>
                    <div class="passcode-input-group d-flex justify-content-start gap-2" data-group="confirm">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="0">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="1">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="2">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="3">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="4">
                        <input type="text" class="passcode-digit" maxlength="1" placeholder="0" inputmode="numeric" pattern="[0-9]*" data-index="5">
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #e9ecef; color: #333; border: none; padding: 0.5rem 1.5rem; border-radius: 6px;">Cancel</button>
                <button type="button" class="btn btn-success" id="confirmPasscodeBtn" style="background-color: #0c5b2c; color: white; border: none; padding: 0.5rem 1.5rem; border-radius: 6px;">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Success/Verified Modal -->
<div class="modal fade" id="passcodeChangedModal" tabindex="-1" aria-labelledby="passcodeChangedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
            <div class="modal-header border-0 pb-0" style="position: relative;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 1rem; right: 1rem;"></button>
            </div>
            <div class="modal-body text-center px-4 pb-4">
                <div class="mb-3">
                    <div style="width: 80px; height: 80px; background-color: #d4edda; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="fa-solid fa-check" style="font-size: 2.5rem; color: #0c5b2c;"></i>
                    </div>
                </div>
                <h5 class="fw-bold mb-3" style="color: #333;">Passcode Changed!</h5>
                <p class="text-muted mb-4" style="font-size: 0.95rem;">Your passcode has been changed successfully.</p>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: white; color: #0c5b2c; border: 2px solid #0c5b2c; padding: 0.5rem 1.5rem; border-radius: 6px;">Close</button>
                <button type="button" class="btn btn-success" id="goToLoginBtn" style="background-color: #0c5b2c; color: white; border: none; padding: 0.5rem 1.5rem; border-radius: 6px;">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Account Logout Modal -->
<div class="modal fade" id="accountLogoutModal" tabindex="-1" aria-labelledby="accountLogoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
            <div class="modal-header border-0 pb-0" style="position: relative;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 1rem; right: 1rem;"></button>
            </div>
            <div class="modal-body text-center px-4 pb-4">
                <div class="mb-3">
                    <div style="width: 80px; height: 80px; background-color: #ff9800; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="fa-solid fa-exclamation" style="font-size: 2.5rem; color: white;"></i>
                    </div>
                </div>
                <h5 class="fw-bold mb-3" style="color: #333;">Account Logout!</h5>
                <p class="text-muted mb-4" style="font-size: 0.95rem;">You will be signed out of your account and need to log in again to access your dashboard.</p>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: white; color: #0c5b2c; border: 2px solid #0c5b2c; padding: 0.5rem 1.5rem; border-radius: 6px;">Close</button>
                <button type="button" class="btn btn-success" id="logoutAccountBtn" style="background-color: #0c5b2c; color: white; border: none; padding: 0.5rem 1.5rem; border-radius: 6px;">Logout Account</button>
            </div>
        </div>
    </div>
</div>

<style>
.passcode-digit {
    width: 50px;
    height: 50px;
    border-radius: 12%;
    border: 2px solid #dee2e6;
    text-align: center;
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    background-color: #fff;
    transition: all 0.3s ease;
}

.passcode-digit::placeholder {
    color: #999;
    opacity: 1;
}

.passcode-digit:focus {
    outline: none;
    border-color: #0c5b2c;
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
    background-color: #f8f9fa;
}

.passcode-digit:not(:placeholder-shown) {
    border-color: #28a745;
    background-color: #f8f9fa;
}

.passcode-input-group {
    margin-bottom: 0.5rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to reset Change Passcode modal
    function resetChangePasscodeModal() {
        const changePasscodeModal = document.getElementById('changePasscodeModal');
        if (changePasscodeModal) {
            const allInputs = changePasscodeModal.querySelectorAll('.passcode-digit');
            allInputs.forEach(input => {
                input.value = '';
            });
            // Focus on first input of old passcode group
            const firstInput = changePasscodeModal.querySelector('.passcode-input-group[data-group="old"] .passcode-digit[data-index="0"]');
            if (firstInput) {
                firstInput.focus();
            }
        }
    }
    
    // Reset modal when it's closed
    const changePasscodeModalElement = document.getElementById('changePasscodeModal');
    if (changePasscodeModalElement) {
        changePasscodeModalElement.addEventListener('hidden.bs.modal', function() {
            resetChangePasscodeModal();
            removeErrorMessage();
        });
    }
    
    // Handle passcode digit inputs with auto-focus
    const passcodeDigits = document.querySelectorAll('.passcode-digit');
    
    passcodeDigits.forEach(digit => {
        digit.addEventListener('input', function(e) {
            // Only allow numbers
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Move to next input if value entered
            if (this.value && parseInt(this.dataset.index) < 5) {
                const group = this.closest('.passcode-input-group').dataset.group;
                const nextIndex = parseInt(this.dataset.index) + 1;
                const nextInput = document.querySelector(`.passcode-input-group[data-group="${group}"] .passcode-digit[data-index="${nextIndex}"]`);
                if (nextInput) {
                    nextInput.focus();
                }
            }
        });
        
        digit.addEventListener('keydown', function(e) {
            // Handle backspace - move to previous field if current is empty
            if (e.key === 'Backspace' && !this.value && parseInt(this.dataset.index) > 0) {
                const group = this.closest('.passcode-input-group').dataset.group;
                const prevIndex = parseInt(this.dataset.index) - 1;
                const prevInput = document.querySelector(`.passcode-input-group[data-group="${group}"] .passcode-digit[data-index="${prevIndex}"]`);
                if (prevInput) {
                    prevInput.value = '';
                    prevInput.focus();
                }
            }
        });
        
        digit.addEventListener('keypress', function(e) {
            // Prevent non-numeric characters
            if (!/[0-9]/.test(e.key)) {
                e.preventDefault();
            }
        });
        
        digit.addEventListener('paste', function(e) {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData('text');
            const digits = paste.replace(/[^0-9]/g, '').slice(0, 6);
            
            const group = this.closest('.passcode-input-group').dataset.group;
            const startIndex = parseInt(this.dataset.index);
            
            digits.split('').forEach((char, idx) => {
                if (startIndex + idx < 6) {
                    const input = document.querySelector(`.passcode-input-group[data-group="${group}"] .passcode-digit[data-index="${startIndex + idx}"]`);
                    if (input) {
                        input.value = char;
                    }
                }
            });
            
            // Focus last filled input or next empty
            const lastIndex = Math.min(startIndex + digits.length - 1, 5);
            const lastFilled = document.querySelector(`.passcode-input-group[data-group="${group}"] .passcode-digit[data-index="${lastIndex}"]`);
            if (lastFilled) {
                lastFilled.focus();
            }
        });
    });
    
    // Function to get passcode from input group
    function getPasscodeFromGroup(groupName) {
        const group = document.querySelector(`.passcode-input-group[data-group="${groupName}"]`);
        if (!group) return '';
        
        const inputs = group.querySelectorAll('.passcode-digit');
        let passcode = '';
        inputs.forEach(input => {
            passcode += input.value || '';
        });
        return passcode;
    }

    // Function to validate passcode inputs
    function validatePasscodeInputs() {
        const oldPasscode = getPasscodeFromGroup('old');
        const newPasscode = getPasscodeFromGroup('new');
        const confirmPasscode = getPasscodeFromGroup('confirm');

        // Check if all fields are filled
        if (oldPasscode.length !== 6) {
            return { valid: false, message: 'Please enter your old passcode.' };
        }

        if (newPasscode.length !== 6) {
            return { valid: false, message: 'Please enter a new passcode.' };
        }

        if (confirmPasscode.length !== 6) {
            return { valid: false, message: 'Please confirm your new passcode.' };
        }

        // Check if new passcodes match
        if (newPasscode !== confirmPasscode) {
            return { valid: false, message: 'New passcode and confirmation do not match.' };
        }

        // Check if new passcode is different from old
        if (oldPasscode === newPasscode) {
            return { valid: false, message: 'New passcode must be different from the old passcode.' };
        }

        return { valid: true, oldPasscode, newPasscode, confirmPasscode };
    }

    // Function to show error message
    function showErrorMessage(message) {
        // Remove existing error message if any
        const existingError = document.querySelector('.passcode-error-message');
        if (existingError) {
            existingError.remove();
        }

        // Create error message element
        const errorDiv = document.createElement('div');
        errorDiv.className = 'passcode-error-message alert alert-danger mt-3';
        errorDiv.style.cssText = 'padding: 0.75rem; border-radius: 6px; font-size: 0.9rem;';
        errorDiv.textContent = message;

        // Insert error message after the modal body content
        const modalBody = document.querySelector('#changePasscodeModal .modal-body');
        if (modalBody) {
            modalBody.appendChild(errorDiv);
            
            // Scroll to error message
            errorDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }

    // Function to remove error message
    function removeErrorMessage() {
        const existingError = document.querySelector('.passcode-error-message');
        if (existingError) {
            existingError.remove();
        }
    }

    // Handle Confirm button click - validate and submit passcode change
    document.getElementById('confirmPasscodeBtn').addEventListener('click', function() {
        // Remove any existing error messages
        removeErrorMessage();

        // Validate inputs
        const validation = validatePasscodeInputs();
        
        if (!validation.valid) {
            showErrorMessage(validation.message);
            return;
        }

        // Disable button and show loading state
        const confirmBtn = document.getElementById('confirmPasscodeBtn');
        const originalText = confirmBtn.textContent;
        confirmBtn.disabled = true;
        confirmBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Changing...';

        // Determine the route based on current URL
        const currentPath = window.location.pathname;
        const changePasscodeRoute = currentPath.includes('/company/') 
            ? '/company/change-passcode' 
            : '/user/change-passcode';

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Make AJAX request
        fetch(changePasscodeRoute, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                old_passcode: validation.oldPasscode,
                new_passcode: validation.newPasscode,
                new_passcode_confirmation: validation.confirmPasscode
            })
        })
        .then(response => response.json())
        .then(data => {
            // Re-enable button
            confirmBtn.disabled = false;
            confirmBtn.textContent = originalText;

            if (data.message) {
                // Success - reset modal and show success modal
                resetChangePasscodeModal();
                
                // Close the Change Passcode modal
                const changePasscodeModal = bootstrap.Modal.getInstance(document.getElementById('changePasscodeModal'));
                if (changePasscodeModal) {
                    changePasscodeModal.hide();
                }
                
                // Show Passcode Changed success modal
                const passcodeChangedModal = new bootstrap.Modal(document.getElementById('passcodeChangedModal'));
                passcodeChangedModal.show();
            } else if (data.error) {
                // Show error message
                showErrorMessage(data.error);
            }
        })
        .catch(error => {
            // Re-enable button
            confirmBtn.disabled = false;
            confirmBtn.textContent = originalText;

            console.error('Error:', error);
            showErrorMessage('An error occurred while changing your passcode. Please try again.');
        });
    });
    
    // Handle Go to Login button in Passcode Changed modal - show Account Logout modal
    const goToLoginBtn = document.getElementById('goToLoginBtn');
    if (goToLoginBtn) {
        goToLoginBtn.addEventListener('click', function() {
            // Close the Passcode Changed modal
            const passcodeChangedModal = bootstrap.Modal.getInstance(document.getElementById('passcodeChangedModal'));
            if (passcodeChangedModal) {
                passcodeChangedModal.hide();
            }
            
            // Show Account Logout modal
            const accountLogoutModal = new bootstrap.Modal(document.getElementById('accountLogoutModal'));
            accountLogoutModal.show();
        });
    }
    
    // Handle Logout Account button click - perform logout
    const logoutAccountBtn = document.getElementById('logoutAccountBtn');
    if (logoutAccountBtn) {
        logoutAccountBtn.addEventListener('click', function() {
            // Close the Account Logout modal
            const accountLogoutModal = bootstrap.Modal.getInstance(document.getElementById('accountLogoutModal'));
            if (accountLogoutModal) {
                accountLogoutModal.hide();
            }
            
            // Submit the logout form
            const logoutForm = document.getElementById('logout-form');
            if (logoutForm) {
                logoutForm.submit();
            } else {
                // Fallback: determine logout URL based on current path
                const currentPath = window.location.pathname;
                const logoutUrl = currentPath.includes('/company/') ? '/company/logout' : '/user/logout';
                
                // Create a form and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = logoutUrl;
                
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                form.appendChild(csrfInput);
                
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
});
</script>

