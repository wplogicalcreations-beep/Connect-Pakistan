// =================== FRONTEND VALIDATION (Supports Main + Modal) ===================

// validate one field (scoped by form)
function validateField(name, formId = null) {
    let formSelector = formId ? "#" + formId : "";
    let value = document.querySelector(`${formSelector} [name='${name}']`)?.value?.trim() || "";
    let errorEl = document.querySelector(`${formSelector} #${name}_error`);
    if (!errorEl) return true;
    errorEl.textContent = "";

    // validation cases...
    switch (name) {
        case "name":
            if (!value) errorEl.textContent = "Full Name is required";
            else if (value.length > 255) errorEl.textContent = "Full Name cannot exceed 255 characters";
            break;
        case "passport_no":
            if (!value) errorEl.textContent = "Passport No is required";
            else if (!/^[A-Z]{2}\d{7}$/.test(value)) errorEl.textContent = "Passport No must be 2 uppercase letters followed by 7 digits (e.g., AB1234567)";
            break;
        case "iqama_id":
            if (!value) errorEl.textContent = "Iqama ID is required";
            else if (!/^[2]\d{9}$/.test(value)) errorEl.textContent = "Iqama ID must start with 2 and be 10 digits";
            break;
        case "phone":
            if (!value) errorEl.textContent = "Mobile No is required";
            else if (!/^9665\d{8}$/.test(value)) errorEl.textContent = "Phone must start with 9665 and be 12 digits";
            break;
        case "email":
            if (!value) errorEl.textContent = "Email is required";
            else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) errorEl.textContent = "Enter a valid email address";
            break;
        case "linkedin_url":
            if (!value) errorEl.textContent = "LinkedIn Profile is required";
            else if (!/^(https?:\/\/)?([\w\-]+\.)+[\w\-]+(\/[\w\-._~:/?#[\]@!$&'()*+,;=]*)?$/.test(value)) {
                errorEl.textContent = "Enter a valid URL";
            }
            break;
        case "image":
            let file = document.querySelector(`${formSelector} [name='image']`)?.files[0];
            if (file) {
                let allowed = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
                if (!allowed.includes(file.type)) errorEl.textContent = "Only JPG, PNG, or GIF files are allowed";
                else if (file.size > 2048 * 1024) errorEl.textContent = "Image must not exceed 2MB";
            }
            break;
        case "level_id":
            if (!value) errorEl.textContent = "Level is required";
            break;
        case "influence_ability_id":
            if (!value) errorEl.textContent = "Influence Ability is required";
            break;

        // === Step 3 fields ===
        case "industry_area_id":
            if (!value) errorEl.textContent = "Industry Area is required";
            break;
        case "work_domain_id":
            if (!value) errorEl.textContent = "Work Domain is required";
            break;
        case "skills":
            let skillsSelected = document.querySelectorAll(`${formSelector} [name='skills[]']:checked`);
            if (!skillsSelected.length) errorEl.textContent = "At least one skill is required";
            break;
        case "additional_skills":
            let additional = document.querySelectorAll(`${formSelector} [name='additional_skills[]']`);
            additional.forEach(input => {
                if (input.value && input.value.length > 255) {
                    errorEl.textContent = "Additional skills cannot exceed 255 characters";
                }
            });
            break;
    }

    // ✅ Highlight input border
    let inputEl = document.querySelector(`${formSelector} [name='${name}']`);
    if (inputEl) {
        if (errorEl.textContent) {
            inputEl.classList.add("is-invalid");
            inputEl.classList.remove("is-valid");
        } else {
            inputEl.classList.remove("is-invalid");
            inputEl.classList.add("is-valid");
        }
    }

    return !errorEl.textContent;
}


// validate full step1 form
function validateStep1(formId) {
    let fields = ["name", "passport_no", "iqama_id", "phone", "email", "linkedin_url", "image"];
    let ok = true;
    fields.forEach(f => { if (!validateField(f, formId)) ok = false; });
    return ok;
}
function validateStep2(formId) {
    let fields = ["level_id", "influence_ability_id"]; // no user_id here
    let ok = true;
    fields.forEach(f => { if (!validateField(f, formId)) ok = false; });
    return ok;
}

function validateStep3(formId) {
    let fields = ["industry_area_id", "work_domain_id", "skills", "additional_skills"];
    let ok = true;
    fields.forEach(f => { if (!validateField(f, formId)) ok = false; });
    return ok;
}

// Passcode validation function
function validatePasscode() {
    const passcodeInputs = document.querySelectorAll('.passcode-digit');
    const firstPasscode = Array.from(passcodeInputs).slice(0, 6).map(input => input.value).join('');
    const secondPasscode = Array.from(passcodeInputs).slice(6, 12).map(input => input.value).join('');

    // Clear previous errors
    clearPasscodeErrors();

    let isValid = true;

    if (firstPasscode.length !== 6) {
        showFieldError('passcode_error', 'Please enter a 6-digit passcode');
        isValid = false;
    }

    if (secondPasscode.length !== 6) {
        showFieldError('passcode_confirmation_error', 'Please re-enter your 6-digit passcode');
        isValid = false;
    }

    if (firstPasscode.length === 6 && secondPasscode.length === 6) {
        if (firstPasscode !== secondPasscode) {
            showFieldError('passcode_confirmation_error', 'Passcodes do not match');
            isValid = false;
        }

        const numericRegex = /^[0-9]+$/;
        if (!numericRegex.test(firstPasscode) || !numericRegex.test(secondPasscode)) {
            showFieldError('passcode_error', 'Passcode must contain numbers only');
            isValid = false;
        }
    }

    const termsCheck = document.getElementById('termsCheck');
    if (!termsCheck.checked) {
        showFieldError('termsCheck_error', 'Please agree to the terms and conditions');
        isValid = false;
    }

    return isValid;
}

// Helper functions for field error display
function showFieldError(errorId, message) {
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

document.addEventListener("DOMContentLoaded", function () {
    ["form-step1", "modal-form-step1", "form-step2", "modal-form-step2", "form-step3", "modal-form-step3",].forEach(formId => {
        let form = document.getElementById(formId);
        if (!form) return;

        form.querySelectorAll("input, select").forEach(input => {
            input.addEventListener("blur", () => validateField(input.name, formId));
            input.addEventListener("change", () => validateField(input.name, formId));
        });

        // Auto-uppercase passport number input
        const passportInput = form.querySelector("[name='passport_no']");
        if (passportInput) {
            passportInput.addEventListener("input", function(e) {
                e.target.value = e.target.value.toUpperCase();
            });
        }
    });

    // =================== STEP 1 NEXT BUTTON (Disable until required filled + green hover only if no errors) ===================
    const step1Form = document.getElementById("form-step1");
    const step1NextBtn = document.getElementById("step1NextBtn");

    // Step-1 required fields
    const step1Required = ["name", "passport_no", "iqama_id", "phone", "email", "linkedin_url"];

    function isFilled(value) {
        return (value ?? "").toString().trim().length > 0;
    }

    function step1HasVisibleErrors() {
        if (!step1Form) return false;

        // any "error" div has text?
        const errorIds = ["name_error", "passport_no_error", "iqama_id_error", "phone_error", "email_error", "linkedin_url_error", "image_error"];
        const hasErrorText = errorIds.some((id) => {
            const el = step1Form.querySelector("#" + id);
            return el && el.textContent && el.textContent.trim().length > 0;
        });

        // or any invalid inputs already marked by validation
        const hasInvalidClass = step1Form.querySelectorAll(".is-invalid").length > 0;

        return hasErrorText || hasInvalidClass;
    }

    function updateStep1NextButtonState() {
        if (!step1Form || !step1NextBtn) return;

        const allRequiredFilled = step1Required.every((fieldName) => {
            const el = step1Form.querySelector(`[name="${fieldName}"]`);
            return el && isFilled(el.value);
        });

        const hasErrors = step1HasVisibleErrors();
        const canProceed = allRequiredFilled && !hasErrors;

        // Disable until required fields are filled AND there are no validation errors showing
        step1NextBtn.disabled = !canProceed;

        // For hover styling: only green when "ready"
        step1NextBtn.classList.toggle("is-ready", canProceed);
        step1NextBtn.classList.toggle("disabled", !canProceed);
    }

    if (step1Form && step1NextBtn) {
        // initial
        updateStep1NextButtonState();

        // update on typing (required fields)
        step1Required.forEach((name) => {
            const el = step1Form.querySelector(`[name="${name}"]`);
            if (!el) return;
            el.addEventListener("input", updateStep1NextButtonState);
            el.addEventListener("change", updateStep1NextButtonState);
            el.addEventListener("blur", () => {
                // don't force-show errors early; just re-evaluate after blur validation runs
                updateStep1NextButtonState();
            });
        });

        // update after validations that happen on blur/change for optional fields too
        ["linkedin_url", "image"].forEach((name) => {
            const el = step1Form.querySelector(`[name="${name}"]`);
            if (!el) return;
            el.addEventListener("change", () => setTimeout(updateStep1NextButtonState, 0));
            el.addEventListener("blur", () => setTimeout(updateStep1NextButtonState, 0));
        });
    }
});


function nextStep(step, user_id = null) {

    if (step === 1 && !validateStep1("form-step1")) {
        return; // stop if frontend validation fails
    }

    if (step === 2 && !validateStep2("form-step2")) {
        return; // stop if frontend validation fails
    }

    if (step === 3 && !validateStep3("form-step2")) {
        return; // stop if frontend validation fails
    }

    if (step === 5 && !validatePasscode()) {
        return; // stop if passcode validation fails
    }

    let formElement = document.getElementById('form-step' + step);
    let formData = new FormData(formElement); // <-- handles file inputs too
    // if user_id exists, inject it into form (hidden input)
    if (user_id) {
        formData.append("user_id", user_id); // append instead of push
    }

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: '/individual-signup/step' + step,
        type: "POST",
        data: formData,
        processData: false,  // <-- required for FormData
        contentType: false,  // <-- required for FormData
        beforeSend: function () {
            // $(".submit_hold").attr("disabled", true);
        },
        success: function (response) {
            if (response.user_id) {
                // update hidden input for next steps
                $("#user_id").val(response.user_id);
            }
            if (response.userDetails) {
                fillPreview(response.userDetails);
                fillStep1Form(response.userDetails);
                fillStep2Form(response.userDetails)
                fillStep3Form(response.userDetails)
            }

            // ✅ If registration is completed, show auth modal
            if (response.completed) {
                // Get email from userDetails or form
                let email = '';
                if (response.userDetails && response.userDetails.email) {
                    email = response.userDetails.email;
                } else {
                    // Fallback to form field
                    const emailInput = document.querySelector('#form-step1 input[name="email"]');
                    if (emailInput) {
                        email = emailInput.value;
                    }
                }
                // Display email in modal
                if (email) {
                    $('#authModalEmail').text(email);
                }
                $("#authModal").modal("show");
                return; // don't call goToNextStep anymore
            }

            goToNextStep(step, response.user_id);
            hideCurrentStep();
            showStep(step + 1);
            currentStep = step + 1;
            updateProgressIndicator(step + 1);
            addAnimationClasses();
        },
        error: function (xhr, status, error) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                // ✅ Use the formElement you already have
                let form = $(formElement);

                // clear old errors (only inside this form)
                form.find(".text-danger").text("");

                $.each(xhr.responseJSON.errors, function (field, messages) {
                    // Replace dots with underscores so "level_id.0" → "level_id_0"
                    let fieldId = field.replace(/\./g, "_") + "_error";

                    // show error inside this form only
                    form.find("#" + fieldId).text(messages[0]);

                    // also mark input red/green
                    let inputEl = form.find(`[name="${field}"]`);
                    inputEl.removeClass("is-valid").addClass("is-invalid");
                });

                // Clear all error messages inside this form only after 5 seconds
                setTimeout(function () {
                    form.find(".text-danger").fadeOut("slow", function () {
                        $(this).text("").show(); // reset text & re-show element for next validation
                    });
                }, 5000);
            }
        }
    });
}

function goToNextStep(currentStep, user_id = null) {
    let current = $("#step" + currentStep);
    let next = $("#step" + (currentStep + 1));

    if (user_id) {
        $("form[id^='form-step']").each(function () {
            if ($(this).find("#user_id").length) {
                $(this).find("#user_id").val(user_id); // update if exists
            } else {
                $(this).append('<input type="hidden" id="user_id" name="user_id" value="' + user_id + '">');
            }
        });
    }

    // Hide current
    current.addClass("d-none");

    // Show next
    next.removeClass("d-none");
}

function prevStep(currentStep) {
    let current = $("#step" + currentStep);
    let previous = $("#step" + (currentStep - 1));

    // Hide current
    current.addClass("d-none");

    // Show previous
    previous.removeClass("d-none");
}

//for Passcode
const digits = document.querySelectorAll('.passcode-digit');
const hiddenPasscode = document.getElementById('passcode-hidden');
const hiddenConfirmation = document.getElementById('passcode-confirmation-hidden');

// Separate first 6 and last 6 digits
const passcodeDigits = Array.from(digits).slice(0, 6);
const confirmDigits = Array.from(digits).slice(6, 12);

// Function to update hidden input
function updateHiddenInput(digitInputs, hiddenInput) {
    hiddenInput.value = digitInputs.map(d => d.value).join('');
}

// Auto move to next input and update hidden inputs dynamically
digits.forEach((input, index) => {
    input.addEventListener('input', () => {
        // Allow only numbers
        input.value = input.value.replace(/[^0-9]/g, '');

        // Auto focus next
        if (input.value.length === 1 && index < digits.length - 1) {
            digits[index + 1].focus();
        }

        // Update hidden inputs
        updateHiddenInput(passcodeDigits, hiddenPasscode);
        updateHiddenInput(confirmDigits, hiddenConfirmation);
    });

    // Backspace move to previous input
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && input.value === '' && index > 0) {
            digits[index - 1].focus();
        }
    });
});



//For skills - Main form
const skillCheckboxes = document.querySelectorAll('#form-step2 .skill-checkbox, #form-step3 .skill-checkbox');
const skillsBtn = document.getElementById('skillsBtn');

if (skillCheckboxes.length > 0 && skillsBtn) {
    skillCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const selected = Array.from(skillCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.nextElementSibling.innerText.trim());
            
            if (selected.length === 0) {
                skillsBtn.innerText = 'Select skills';
            } else if (selected.length <= 2) {
                skillsBtn.innerText = selected.join(', ');
            } else {
                const firstTwo = selected.slice(0, 2).join(', ');
                skillsBtn.innerText = `${firstTwo} +${selected.length - 2} more`;
            }
        });
    });
}

//For skills - Modal form (using event delegation to avoid duplicate listeners)
$(document).on('change', '#modal-form-step3 .skill-checkbox', function() {
    const modalSkillCheckboxes = document.querySelectorAll('#modal-form-step3 .skill-checkbox');
    const modalSkillsBtn = document.getElementById('modalSkillsBtn');
    
    if (modalSkillsBtn) {
        const selected = Array.from(modalSkillCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.nextElementSibling.innerText.trim());
        
        if (selected.length === 0) {
            modalSkillsBtn.innerText = 'Select skills';
        } else if (selected.length <= 2) {
            modalSkillsBtn.innerText = selected.join(', ');
        } else {
            const firstTwo = selected.slice(0, 2).join(', ');
            modalSkillsBtn.innerText = `${firstTwo} +${selected.length - 2} more`;
        }
    }
});


//For Additional Skills
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('additional_skills');
    const container = document.getElementById('additional_skills_container');

    if (input && container) {
        // Function to auto-resize container
        function autoResizeContainer() {
            const tags = container.querySelectorAll('.skill-tag');
            const inputHeight = input.offsetHeight;
            const tagsPerRow = Math.floor(container.offsetWidth / 150); // Approximate width per tag
            const totalRows = Math.ceil(tags.length / tagsPerRow) || 1;
            const minHeight = Math.max(38, (totalRows * 32) + 16); // 32px per tag row + padding
            container.style.minHeight = minHeight + 'px';
        }

        input.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Always prevent form submission
                e.stopPropagation(); // Stop event bubbling
                
                const tagText = input.value.trim();
                if (tagText !== '') {
                    // Create tag chip with project's green color
                    const tag = document.createElement('span');
                    tag.className = 'skill-tag badge me-1 mb-1 d-inline-flex align-items-center';
                    tag.style.cssText = `
                        font-size: 0.75rem;
                        background-color: var(--primary-green, #1a5f3c) !important;
                        color: white;
                        border: none;
                        padding: 4px 8px;
                        border-radius: 12px;
                        max-width: 150px;
                        word-wrap: break-word;
                    `;
                    tag.innerHTML = `${tagText} <span class="remove-tag ms-1" style="cursor:pointer; font-weight: bold; margin-left: 4px;">&times;</span>`;

                    // Create hidden input for form submission
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'additional_skills[]';
                    hiddenInput.value = tagText;

                    tag.appendChild(hiddenInput);

                    // Remove functionality
                    tag.querySelector('.remove-tag').addEventListener('click', () => {
                        container.removeChild(tag);
                        autoResizeContainer(); // Resize after removal
                    });

                    // Insert the tag before the input
                    container.insertBefore(tag, input);

                    // Clear input
                    input.value = '';

                    // Auto-resize container
                    autoResizeContainer();
                }
            }
        });

        // Handle backspace to remove last tag
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && input.value === '') {
                const tags = container.querySelectorAll('.skill-tag');
                if (tags.length > 0) {
                    const lastTag = tags[tags.length - 1];
                    container.removeChild(lastTag);
                    autoResizeContainer(); // Resize after removal
                }
            }
        });

        // Focus styling
        input.addEventListener('focus', function() {
            container.style.borderColor = 'var(--primary-green, #1a5f3c)';
            container.style.boxShadow = '0 0 0 0.2rem rgba(26, 95, 60, 0.25)';
        });

        input.addEventListener('blur', function() {
            container.style.borderColor = '#ced4da';
            container.style.boxShadow = 'none';
        });

        // Initial resize
        autoResizeContainer();
    }
});


function fillPreview(user) {
    // Personal Info
    $("[data-field='name']").text(user.name || '');
    $("[data-field='iqama_id']").text(user.individual_profile?.iqama_id || '');
    $("[data-field='email']").text(user.email || '');
    $("[data-field='phone']").text(user.phone || '');
    $("[data-field='passport_no']").text(user.individual_profile?.passport_no || '');
    $("[data-field='mobile_no']").text(user.phone || '');
    $("[data-field='linkedin_url']").text(user.individual_profile?.linkedin_url || '');

    if (user.profile_photo_url) {
        $("[data-field='profile_photo']").attr("src", user.profile_photo_url);
    }

    // Employment Info (using LOV arrays)
    $("[data-field='level']").text(user.level?.[0]?.name || '');
    $("[data-field='influence']").text(user.influence_ability?.[0]?.name || '');

    // Employment Area
    $("[data-field='industry']").text(user.industry_area?.[0]?.name || '');
    $("[data-field='work_domain']").text(user.work_domain?.[0]?.name || '');

    if (user.images && user.images.length > 0) {
        // adjust base URL if needed
        let photoUrl = "/storage/" + user.images[0].path;
        $("[data-field='profile_photo']").attr("src", photoUrl);
    } else {
        $("[data-field='profile_photo']").attr("src", "img/placeholder.png");
    }

    // Skills (array of LOVs)
    if (user.skills && user.skills.length > 0) {
        let skillsHtml = '';
        user.skills.forEach((skill, index) => {
            skillsHtml += `
                <div class="col-md-6 mb-2">
                    <div class="preview-common-design">
                        <span>Skill ${index + 1}</span>
                        <strong>${skill?.name || ''}</strong>
                    </div>
                </div>
            `;
        });
        $("#skills-preview").html(skillsHtml);
    } else {
        $("#skills-preview").html(''); // clear skills if none
    }

    // Additional Skills (from JSON string)
    if (user.individual_profile?.additional_skills) {
        let additionalSkills = [];

        try {
            // Parse JSON string safely
            additionalSkills = JSON.parse(user.individual_profile.additional_skills);
        } catch (e) {
            console.error("Error parsing additional_skills:", e);
        }

        if (Array.isArray(additionalSkills) && additionalSkills.length > 0) {
            let addSkillsHtml = '';
            additionalSkills.forEach((skill, index) => {
                addSkillsHtml += `
                    <div class="col-md-6 mb-2">
                        <div class="preview-common-design">
                            <span>Additional Skill ${index + 1}</span>
                            <strong>${skill}</strong>
                        </div>
                    </div>
                `;
            });

            // Append after normal skills
            $("#skills-preview").append(addSkillsHtml);
        }
    }

}
function fillStep1Form(user) {
    // Fill text inputs
    $("#modal-form-step1 input[name='name']").val(user.name || '');
    $("#modal-form-step1 input[name='passport_no']").val(user.individual_profile?.passport_no || '');
    $("#modal-form-step1 input[name='iqama_id']").val(user.individual_profile?.iqama_id || '');
    $("#modal-form-step1 input[name='phone']").val(user.phone || '');
    $("#modal-form-step1 input[name='email']").val(user.email || '');
    $("#modal-form-step1 input[name='linkedin_url']").val(user.individual_profile?.linkedin_url || '');

    // Add or update hidden input for user_id
    if ($("#modal-form-step1 input[name='user_id']").length === 0) {
        $("#modal-form-step1").append(`
            <input type="hidden" name="user_id" value="${user.id}">
        `);
    } else {
        $("#modal-form-step1 input[name='user_id']").val(user.id);
    }

    // If there's a profile photo (we can’t prefill file inputs directly)
    if (user.profile_photo_url) {
        // Show preview somewhere in modal (optional)
        if ($("#profilePhotoPreview").length === 0) {
            $("#modal-form-step1").prepend(`
                <div class="mb-3 text-center">
                    <img id="profilePhotoPreview" 
                         src="${user.profile_photo_url}" 
                         alt="Profile Photo" 
                         class="img-thumbnail" 
                         style="max-width: 150px;">
                </div>
            `);
        } else {
            $("#profilePhotoPreview").attr("src", user.profile_photo_url);
        }
    }
}

function fillStep2Form(user) {
    // Step 2 - Employment Info
    if (user.level && user.level.length > 0) {
        $("#modal-form-step2 select[name='level_id']").val(user.level[0].id);
    } else {
        $("#modal-form-step2 select[name='level_id']").val('');
    }

    if (user.influence_ability && user.influence_ability.length > 0) {
        $("#modal-form-step2 select[name='influence_ability_id']").val(user.influence_ability[0].id);
    } else {
        $("#modal-form-step2 select[name='influence_ability_id']").val('');
    }

    // Add or update hidden input for user_id
    if ($("#modal-form-step2 input[name='user_id']").length === 0) {
        $("#modal-form-step2").append(`
            <input type="hidden" name="user_id" value="${user.id}">
        `);
    } else {
        $("#modal-form-step2 input[name='user_id']").val(user.id);
    }
}

function fillStep3Form(user) {
    // Industry Area
    if (user.industry_area && user.industry_area.length > 0) {
        $("#modal-form-step3 select[name='industry_area_id']").val(user.industry_area[0].id);
    } else {
        $("#modal-form-step3 select[name='industry_area_id']").val('');
    }

    // Work Domain
    if (user.work_domain && user.work_domain.length > 0) {
        $("#modal-form-step3 select[name='work_domain_id']").val(user.work_domain[0].id);
    } else {
        $("#modal-form-step3 select[name='work_domain_id']").val('');
    }

    // Skills (checkboxes) - Main form
    if (user.skills && user.skills.length > 0) {
        $("#form-step2 .skill-checkbox, #form-step3 .skill-checkbox").prop('checked', false); // clear old selections
        user.skills.forEach(skill => {
            $(`#form-step2 .skill-checkbox[value='${skill.id}'], #form-step3 .skill-checkbox[value='${skill.id}']`).prop('checked', true);
        });
        
        // Update main form skills button text
        const selectedSkills = user.skills.map(skill => skill.name);
        if (selectedSkills.length <= 2) {
            $('#skillsBtn').text(selectedSkills.join(', '));
        } else {
            const firstTwo = selectedSkills.slice(0, 2).join(', ');
            $('#skillsBtn').text(`${firstTwo} +${selectedSkills.length - 2} more`);
        }
    } else {
        $("#form-step2 .skill-checkbox, #form-step3 .skill-checkbox").prop('checked', false);
        $('#skillsBtn').text('Select skills');
    }

    // Skills (checkboxes) - Modal form
    if (user.skills && user.skills.length > 0) {
        $("#modal-form-step3 .skill-checkbox").prop('checked', false); // clear old selections
        user.skills.forEach(skill => {
            $(`#modal-form-step3 .skill-checkbox[value='${skill.id}']`).prop('checked', true);
        });
        
        // Update modal skills button text
        const selectedSkills = user.skills.map(skill => skill.name);
        if (selectedSkills.length <= 2) {
            $('#modalSkillsBtn').text(selectedSkills.join(', '));
        } else {
            const firstTwo = selectedSkills.slice(0, 2).join(', ');
            $('#modalSkillsBtn').text(`${firstTwo} +${selectedSkills.length - 2} more`);
        }
    } else {
        $("#modal-form-step3 .skill-checkbox").prop('checked', false);
        $('#modalSkillsBtn').text('Select skills');
    }

    // Add or update hidden input for user_id
    if ($("#modal-form-step3 input[name='user_id']").length === 0) {
        $("#modal-form-step3").append(`
                <input type="hidden" name="user_id" value="${user.id}">
            `);
    } else {
        $("#modal-form-step3 input[name='user_id']").val(user.id);
    }
}





function updateFileName() {
    const fileInput = document.getElementById('formFile');
    const fileName = document.getElementById('fileName');
    if (fileInput.files.length > 0) {
        fileName.value = fileInput.files[0].name;
    } else {
        fileName.value = '';
    }
}

function showVerifiedModal() {
    Swal.fire({
        title: 'Success!',
        text: 'User has been registered successfully.',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = dashboardUrl;
        }
    });
}

function showPersonalInfoModal() {
    $("#step1Modal").modal("show");
}

function showEmploymentInfoModal() {
    $("#step2Modal").modal("show");
}


function showEmploymentAreaInfoModal() {
    $("#step3Modal").modal("show");
}

function modalUpdations(step) {
    if (step === 1 && !validateStep1("modal-form-step1")) {
        return; // stop if frontend validation fails
    }

    if (step === 2 && !validateStep2("modal-form-step2")) {
        return; // stop if frontend validation fails
    }

    if (step === 3 && !validateStep3("modal-form-step3")) {
        return; // stop if frontend validation fails
    }
    let formElement = document.getElementById('modal-form-step' + step);
    let formData = new FormData(formElement); // <-- handles file inputs too
    // if user_id exists, inject it into form (hidden input)

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: '/individual-signup/step' + step,
        type: "POST",
        data: formData,
        processData: false,  // <-- required for FormData
        contentType: false,  // <-- required for FormData
        beforeSend: function () {
            // $(".submit_hold").attr("disabled", true);
        },
        success: function (response) {
            // Close the update modal first
            let modalId = 'step' + step + 'Modal';
            $('#' + modalId).modal('hide');
            
            if (response.userDetails) {
                fillPreview(response.userDetails);
                fillStep1Form(response.userDetails);
                fillStep2Form(response.userDetails);
                fillStep3Form(response.userDetails)
            }
            
            // Show SweetAlert for successful update after modal is closed
            setTimeout(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'User data has been updated successfully!',
                    confirmButtonText: 'OK'
                });
            }, 300); // Small delay to ensure modal is fully closed
        },
        error: function (xhr, status, error) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                // ✅ Use the formElement you already have
                let form = $(formElement);

                // clear old errors (only inside this form)
                form.find(".text-danger").text("");

                $.each(xhr.responseJSON.errors, function (field, messages) {
                    // Replace dots with underscores so "level_id.0" → "level_id_0"
                    let fieldId = field.replace(/\./g, "_") + "_error";

                    // show error inside this form only
                    form.find("#" + fieldId).text(messages[0]);

                    // also mark input red/green
                    let inputEl = form.find(`[name="${field}"]`);
                    inputEl.removeClass("is-valid").addClass("is-invalid");
                });

                // Clear all error messages inside this form only after 5 seconds
                setTimeout(function () {
                    form.find(".text-danger").fadeOut("slow", function () {
                        $(this).text("").show(); // reset text & re-show element for next validation
                    });
                }, 5000);
            }
        }

    });
}

