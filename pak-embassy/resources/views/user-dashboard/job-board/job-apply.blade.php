@extends('dashboard-layouts.user-layout.master')

@section('content')
<style>
.upload-container.is-invalid {
    border: 2px solid #dc3545 !important;
    border-radius: 8px;
}
.upload-container.is-valid {
    border: 2px solid #198754 !important;
    border-radius: 8px;
}
</style>
<div class="event-top mt-4 mb-3">
    <a href="{{ url('/user/discover-job')}}"><img src="{{ asset('user-dash-img/ph_arrow-left-bold.svg')}}" alt="ph_arrow-left-bold image">Go
        Back</a>
</div>
<h4>{{$job->title}} <span class="badge bg-success ms-2">{{$job->work_mode}}</span></h4>

<!-- 1. Basic Information -->
<form id="job-application-form">
    <div class="section-title">1. Basic Information</div>
    <div class="row g-3">
        <div class="col-md-6 form-floating">
            <input type="text" name="first_name" class="form-control" value="{{$user->first_name}}" id="firstName" placeholder="First Name">
            <label for="firstName">First Name</label>
            <div id="first_name_error" class="text-danger small"></div>
        </div>
        <div class="col-md-6 form-floating">
            <input type="text" name="last_name" class="form-control" value="{{$user->last_name}}" id="lastName" placeholder="Last Name">
            <label for="lastName">Last Name</label>
            <div id="last_name_error" class="text-danger small"></div>
        </div>
        <div class="col-md-6 form-floating">
            <input type="text" name="phone" class="form-control" value="{{$user->phone}}" id="phone" placeholder="9665XXXXXXX" maxlength="12">
            <label for="phone">Phone Number</label>
            <div id="phone_error" class="text-danger small"></div>
        </div>
        <div class="col-md-6 form-floating">
            <input type="email" name="email" class="form-control" readonly value="{{$user->email}}" id="email" placeholder="Email">
            <label for="email">Email</label>
            <div id="email_error" class="text-danger small"></div>
        </div>
    </div>

    <!-- 2. Address Information -->
    <div class="section-title">2. Address Information</div>
    <div class="row g-3">
        <div class="col-md-6 form-floating">
            <input type="text" name="street_address" class="form-control" id="street" placeholder="Street">
            <label for="street">Street</label>
            <div id="street_address_error" class="text-danger small"></div>
        </div>
        <div class="col-md-6 form-floating">
            <input type="text" name="postal_code" class="form-control" id="zip" placeholder="Zip Code">
            <label for="zip">Zip/Postal Code</label>
            <div id="postal_code_error" class="text-danger small"></div>
        </div>
        <div class="col-md-6 form-floating">
            <input type="text" name="city" class="form-control" id="city" placeholder="City">
            <label for="city">City</label>
            <div id="city_error" class="text-danger small"></div>
        </div>
        <div class="col-md-6 form-floating">
            <input type="text" name="state" class="form-control" id="state" placeholder="State">
            <label for="state">State/Province</label>
            <div id="state_error" class="text-danger small"></div>
        </div>
        <div class="col-md-6 form-floating">
            <select name="country" class="form-select" id="country">
                <option disabled selected value="">Select Country</option>
            </select>
            <label for="country">Country</label>
            <div id="country_error" class="text-danger small"></div>
        </div>
    </div>

    <!-- 3. Professional Skills -->
    <div class="section-title">3. Professional Skills</div>
    <div class="row g-3">
        <div class="col-md-6 form-floating">
            <div class="input-group flex-wrap p-2 pt-0 tags-container">
                <input name="job_skills" type="text" id="job_skills" class="form-control pt-2" placeholder="Type Skills and press Enter">
                
            </div>
            <div id="job_skills_error" class="text-danger small"></div>
        </div>

        <div class="col-md-6 form-floating">
            <select class="form-select" name="department_id" id="department">
                <option disabled selected value="">Select Department</option>
                @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
            <label for="department">Departments</label>
            <div id="department_id_error" class="text-danger small"></div>
        </div>
    </div>
        <!-- === Education Section === -->
        <div class="my-3">
            <h4>4. Education Details</h4>
        <div id="education-container"></div>
        <button type="button" id="add-education-btn" class="btn btn-outline-success btn-sm add-btn">+ Add Education</button>
        </div>

        <!-- === Experience Section === -->
        <div class="my-3">
            <h4>5. Experience Details</h4>
        <div id="experience-container"></div>
        <button type="button" id="add-experience-btn" class="btn btn-outline-success btn-sm add-btn">+ Add Experience</button>
        </div>
    {{-- <!-- 4. Education Details -->
    <div class="section-title">4. Education Details</div>
    <div id="educationDetailsList"></div>
    <button type="button" class="btn btn-outline-success btn-sm add-btn" data-bs-toggle="modal" data-bs-target="#education">+ Add Education</button>

    <!-- 5. Experience Details -->
    <div class="section-title">5. Experience Details</div>
    <div id="workExperienceDetailsList"></div>
    <button type="button" class="btn btn-outline-success btn-sm add-btn" data-bs-toggle="modal"
                data-bs-target="#workExperience">+ Add Experience</button> --}}

    <!-- 6. Social Links -->
    <div class="section-title">6. Social Links</div>
    <div class="row g-3">
        <div class="col-md-6 form-floating">
            <input type="url" class="form-control" id="linkedin" value="{{$user?->individualProfile?->linkedin_url}}" name="linkedin_url" placeholder="LinkedIn">
            <label for="linkedin">LinkedIn</label>
            <div id="linkedin_url_error" class="text-danger small"></div>
        </div>
        <div class="col-md-6 form-floating">
            <input type="url" class="form-control" id="portfolio" name="portfolio_link" placeholder="Portfolio Link">
            <label for="portfolio">Portfolio Link</label>
            <div id="portfolio_link_error" class="text-danger small"></div>
        </div>
    </div>

    <!-- 7. Attachment Information -->
    <div class="section-title">7. Attachment Information</div>
    <div class="row g-3">
        <!-- Upload Resume -->
        <div class="col-md-6">
            <div class="upload-container" id="resume-container">
                <label for="resumeUpload" class="upload-box w-100" role="button">
                    <div class="overlay-text">Click to Upload Resume</div>
                    <div id="resumePreview" class="preview-box">
                        <i class="bi bi-upload fs-3"></i>
                        <strong id="resumeText">Upload Resume</strong>
                    </div>
                </label>
                <input type="file" name="resume" id="resumeUpload" class="d-none" accept=".pdf,.doc,.docx"
                    onchange="handleFileUpload(this, 'resumeText', 'resumePreview')">
                  <div id="resume_error" class="text-danger small"></div>
            </div>
        </div>

        <!-- Upload Photo -->
        <div class="col-md-6">
            <div class="upload-container" id="image-container">
                <label for="photoUpload" class="upload-box w-100" role="button">
                    <div class="overlay-text">Click to Upload Photo</div>
                    <div id="photoPreview" class="preview-box">
                        <i class="bi bi-image fs-3"></i>
                        <strong id="photoText">Upload Photo</strong>
                    </div>
                </label>
                <input type="file" id="photoUpload" name="image" class="d-none" accept="image/*"
                    onchange="handleImageUpload(this, 'photoPreview', 'photoText')">
                <div id="image_error" class="text-danger small"></div>
            </div>
        </div>
    </div>



    <!-- Buttons -->
    <div class="d-flex justify-content-end mt-4">
        <button type="button" class="btn btn-outline-secondary me-2" id="cancelJobApplicationBtn">Cancel</button>
        <button type="button"  class="btn btn-success  submit-btn" data-job-id="{{$job->id}}" data-url="{{route('application.store')}}" onclick="applicationSubmit()">Submit Application →</button>
    </div>
</form>
@endsection
@section('js-file')
<script>
const discoverJobUrl = "{{ route('jobs.list')}}";
const editIconUrl = "{{ asset('user-dash-img/uil_edit.svg') }}";
const deleteIconUrl = "{{ asset('user-dash-img/flowbite_trash-bin-outline.svg')}}";
const locationIconUrl = "{{ asset('user-dash-img/akar-icons_location.svg')}}";

// Cancel button redirect
$(document).ready(function() {
    $('#cancelJobApplicationBtn').on('click', function() {
        window.location.href = discoverJobUrl;
    });
});

// Global variables
let countries = [];
let eduCounter = 0;
let expCounter = 0;

// Load countries from backend
async function loadCountries() {
    try {
        const response = await fetch('/user/profile/countries');
        const data = await response.json();
        if (data.success) {
            countries = data.countries;
            populateMainCountryDropdown();
            return countries;
        }
    } catch (error) {
        console.error('Error loading countries:', error);
    }
    return [];
}

// Populate main country dropdown
function populateMainCountryDropdown() {
    const countrySelect = document.getElementById('country');
    if (countrySelect && countries.length > 0) {
        // Clear existing options except the first one
        countrySelect.innerHTML = '<option disabled selected value="">Select Country</option>';
        
        // Add countries from the loaded data
        countries.forEach(country => {
            const option = document.createElement('option');
            option.value = country.id;
            option.textContent = country.name;
            countrySelect.appendChild(option);
        });
    }
}

// Load existing education and experience data as forms
async function loadExistingData() {
    try {
        const response = await fetch('/user/profile/data');
        const data = await response.json();
        if (data.success) {
            // Load existing education data as forms
            if (data.user.educations && data.user.educations.length > 0) {
                data.user.educations.forEach(education => {
                    eduCounter++;
                    addExistingEducationForm(education, eduCounter);
                });
            }
            
            // Load existing experience data as forms
            if (data.user.experiences && data.user.experiences.length > 0) {
                data.user.experiences.forEach(experience => {
                    expCounter++;
                    addExistingExperienceForm(experience, expCounter);
                });
            }
        }
    } catch (error) {
        console.error('Error loading existing data:', error);
    }
}

// Add existing education as editable form
function addExistingEducationForm(education, id) {
    const formHTML = `
        <div class="form-section mt-4 border rounded p-3 bg-light" id="education-form-${id}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Education (Existing)</h6>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeEducation(${id})" title="Remove Education">
                    <img src="${deleteIconUrl}" alt="Delete" width="16" height="16">
                </button>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-select" id="edu-country-${id}">
                            <option value="">Choose...</option>
                            ${countries.map(country => `<option value="${country.id}" ${education.country_id == country.id ? 'selected' : ''}>${country.name}</option>`).join('')}
                        </select>
                        <label for="edu-country-${id}">Country</label>
                        <small class="error text-danger country-error"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-select" id="degree-type-${id}">
                            <option value="">Choose...</option>
                            <option value="Bachelor" ${education.degree_type === 'Bachelor' ? 'selected' : ''}>Bachelor</option>
                            <option value="Master" ${education.degree_type === 'Master' ? 'selected' : ''}>Master</option>
                            <option value="Diploma" ${education.degree_type === 'Diploma' ? 'selected' : ''}>Diploma</option>
                            <option value="Ph.D." ${education.degree_type === 'Ph.D.' ? 'selected' : ''}>Ph.D.</option>
                        </select>
                        <label for="degree-type-${id}">Degree Type</label>
                        <small class="error text-danger degree-type-error"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="degree-name-${id}" value="${education.degree_name || ''}" placeholder="Degree Name">
                        <label for="degree-name-${id}">Degree Name</label>
                        <small class="error text-danger degree-name-error"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="institute-name-${id}" value="${education.institution || ''}" placeholder="Institute Name">
                        <label for="institute-name-${id}">Institute Name</label>
                        <small class="error text-danger institute-name-error"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="currently-studying-${id}" ${education.currently_studying ? 'checked' : ''}>
                        <label class="form-check-label" for="currently-studying-${id}">
                            Currently Studying
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="edu-start-date-${id}" value="${education.start_date ? education.start_date.split('T')[0] : ''}" placeholder="Start Date">
                        <label for="edu-start-date-${id}">Start Date</label>
                        <small class="error text-danger start-date-error"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="edu-end-date-${id}" value="${education.end_date ? education.end_date.split('T')[0] : ''}" placeholder="End Date" ${education.currently_studying ? 'disabled' : ''}>
                        <label for="edu-end-date-${id}">End Date</label>
                        <small class="error text-danger end-date-error"></small>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.getElementById('education-container').insertAdjacentHTML('beforeend', formHTML);
    setupEducationFormEvents(id);
}

// Add existing experience as editable form
function addExistingExperienceForm(experience, id) {
    const formHTML = `
        <div class="form-section mt-4 border rounded p-3 bg-light" id="experience-form-${id}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Work Experience (Existing)</h6>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeExperience(${id})" title="Remove Experience">
                    <img src="${deleteIconUrl}" alt="Delete" width="16" height="16">
                </button>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="company-${id}" value="${experience.company_name || ''}" placeholder="Company">
                        <label for="company-${id}">Company</label>
                        <small class="error text-danger company-error"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="job-title-${id}" value="${experience.job_title || ''}" placeholder="Job Title">
                        <label for="job-title-${id}">Job Title</label>
                        <small class="error text-danger job-title-error"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-select" id="exp-country-${id}">
                            <option value="">Choose...</option>
                            ${countries.map(country => `<option value="${country.id}" ${experience.country_id == country.id ? 'selected' : ''}>${country.name}</option>`).join('')}
                        </select>
                        <label for="exp-country-${id}">Country</label>
                        <small class="error text-danger country-error"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-select" id="job-type-${id}">
                            <option value="">Choose...</option>
                            <option value="Full Time" ${experience.job_type === 'Full Time' ? 'selected' : ''}>Full Time</option>
                            <option value="Part Time" ${experience.job_type === 'Part Time' ? 'selected' : ''}>Part Time</option>
                        </select>
                        <label for="job-type-${id}">Job Type</label>
                        <small class="error text-danger job-type-error"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Job Description" id="job-description-${id}" style="height: 100px" required>${experience.description || ''}</textarea>
                        <label for="job-description-${id}">Job Description</label>
                        <small class="error text-danger job-description-error"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="currently-working-${id}" ${experience.currently_working ? 'checked' : ''}>
                        <label class="form-check-label" for="currently-working-${id}">
                            Currently Working
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="exp-start-date-${id}" value="${experience.start_date ? experience.start_date.split('T')[0] : ''}" placeholder="Start Date">
                        <label for="exp-start-date-${id}">Start Date</label>
                        <small class="error text-danger start-date-error"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="exp-end-date-${id}" value="${experience.end_date ? experience.end_date.split('T')[0] : ''}" placeholder="End Date" ${experience.currently_working ? 'disabled' : ''}>
                        <label for="exp-end-date-${id}">End Date</label>
                        <small class="error text-danger end-date-error"></small>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.getElementById('experience-container').insertAdjacentHTML('beforeend', formHTML);
    setupExperienceFormEvents(id);
}

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', async function() {
            await loadCountries();
            await loadExistingData();
            setupMainFormValidation();
        });

        // Setup validation for main form fields
        function setupMainFormValidation() {
            // Basic Information fields
            const basicFields = ['firstName', 'lastName', 'phone', 'email'];
            basicFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.addEventListener('blur', function() {
                        validateMainFormField(fieldId);
                    });
                }
            });

            // Address Information fields
            const addressFields = ['street', 'zip', 'city', 'state', 'country'];
            addressFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.addEventListener('blur', function() {
                        validateMainFormField(fieldId);
                    });
                }
            });

            // Professional Skills fields
            const skillsFields = ['job_skills', 'department'];
            skillsFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.addEventListener('blur', function() {
                        validateMainFormField(fieldId);
                    });
                }
            });

            // Social Links fields
            const socialFields = ['linkedin', 'portfolio'];
            socialFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.addEventListener('blur', function() {
                        validateMainFormField(fieldId);
                    });
                    // Add real-time validation on input (similar to individual signup)
                    field.addEventListener('input', function() {
                        if (this.value.trim() !== '') {
                            validateMainFormField(fieldId);
                }
            });
        }
            });
            
            // Add real-time validation to all main form fields
            const allMainFields = [...basicFields, ...addressFields, ...skillsFields, ...socialFields];
            allMainFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.addEventListener('input', function() {
                        if (this.value.trim() !== '') {
                            validateMainFormField(fieldId);
                        }
                    });
                }
            });
            
            // Add validation for file upload fields
            const resumeField = document.getElementById('resumeUpload');
            if (resumeField) {
                resumeField.addEventListener('change', function() {
                    console.log('Resume field changed, validating...');
                    validateMainFormField('resume');
                });
            }
            
            const imageField = document.getElementById('photoUpload');
            if (imageField) {
                imageField.addEventListener('change', function() {
                    console.log('Image field changed, validating...');
                    validateMainFormField('image');
                });
            }
        }

        // Validate main form fields (similar to individual signup pattern)
        function validateMainFormField(fieldId) {
            console.log('Validating field:', fieldId);
            const errorElementMap = {
                'firstName': 'first_name_error',
                'lastName': 'last_name_error',
                'phone': 'phone_error',
                'email': 'email_error',
                'street': 'street_address_error',
                'zip': 'postal_code_error',
                'city': 'city_error',
                'state': 'state_error',
                'country': 'country_error',
                'job_skills': 'job_skills_error',
                'department': 'department_id_error',
                'linkedin': 'linkedin_url_error',
                'portfolio': 'portfolio_link_error',
                'resume': 'resume_error',
                'image': 'image_error'
            };
            
            const errorElementId = errorElementMap[fieldId];
            const errorElement = document.getElementById(errorElementId);
            console.log('Error element:', errorElement);
            
            if (!errorElement) return true;
            
            // Handle file upload fields differently
            let field;
            if (fieldId === 'resume') {
                field = document.getElementById('resumeUpload');
            } else if (fieldId === 'image') {
                field = document.getElementById('photoUpload');
            } else {
                field = document.getElementById(fieldId);
            }
            
            console.log('Field found:', field);
            if (!field) return true;

            let isValid = true;
            let errorMessage = '';

            // Clear previous error
            errorElement.textContent = '';

            // Validation rules (similar to individual signup)
            switch(fieldId) {
                case 'firstName':
                case 'lastName':
                    if (!field.value.trim()) {
                        isValid = false;
                        errorMessage = 'This field is required';
                    } else if (field.value.length > 255) {
                        isValid = false;
                        errorMessage = 'Cannot exceed 255 characters';
                    }
                    break;
                case 'phone':
                    if (!field.value.trim()) {
                        isValid = false;
                        errorMessage = 'Phone number is required';
                    } else if (!/^9665\d{8}$/.test(field.value)) {
                        isValid = false;
                        errorMessage = 'Phone must start with 9665 and be 12 digits';
                    }
                    break;
                case 'email':
                    if (!field.value.trim()) {
                        isValid = false;
                        errorMessage = 'Email is required';
                    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value)) {
                        isValid = false;
                        errorMessage = 'Please enter a valid email address';
                    }
                    break;
                case 'street':
                case 'city':
                case 'state':
                    if (!field.value.trim()) {
                        isValid = false;
                        errorMessage = 'This field is required';
                    }
                    break;
                case 'zip':
                    if (!field.value.trim()) {
                        isValid = false;
                        errorMessage = 'Postal code is required';
                    }
                    break;
                case 'country':
                    if (!field.value) {
                        isValid = false;
                        errorMessage = 'Please select a country';
                    }
                    break;
                case 'job_skills':
                    // Skills validation is optional, but if filled, should be valid
                    break;
                case 'department':
                    // Department is nullable in backend, so no validation needed
                    break;
                case 'linkedin':
                    if (!field.value.trim()) {
                        isValid = false;
                        errorMessage = 'LinkedIn URL is required';
                    } else if (!/^https?:\/\/.+/.test(field.value)) {
                        isValid = false;
                        errorMessage = 'Please enter a valid URL';
                    }
                    break;
                case 'portfolio':
                    if (field.value.trim() && !/^https?:\/\/.+/.test(field.value)) {
                        isValid = false;
                        errorMessage = 'Please enter a valid URL';
                    }
                    break;
                case 'resume':
                    console.log('Validating resume field');
                    const resumeContainer = document.getElementById('resume-container');
                    console.log('Resume container:', resumeContainer);
                    console.log('Field files:', field.files);
                    if (!field.files || field.files.length === 0) {
                        console.log('No resume file selected');
                        isValid = false;
                        errorMessage = 'Resume file is required';
                        if (resumeContainer) {
                            resumeContainer.classList.add('is-invalid');
                            resumeContainer.classList.remove('is-valid');
                        }
                    } else {
                        const file = field.files[0];
                        const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                        const maxSize = 5 * 1024 * 1024; // 5MB
                        
                        if (!allowedTypes.includes(file.type)) {
                            isValid = false;
                            errorMessage = 'Resume must be a PDF, DOC, or DOCX file';
                            if (resumeContainer) {
                                resumeContainer.classList.add('is-invalid');
                                resumeContainer.classList.remove('is-valid');
                            }
                        } else if (file.size > maxSize) {
                            isValid = false;
                            errorMessage = 'Resume file size must not exceed 5MB';
                            if (resumeContainer) {
                                resumeContainer.classList.add('is-invalid');
                                resumeContainer.classList.remove('is-valid');
                            }
                        } else if (resumeContainer) {
                            resumeContainer.classList.remove('is-invalid');
                            resumeContainer.classList.add('is-valid');
                        }
                    }
                    break;
                case 'image':
                    console.log('Validating image field');
                    const imageContainer = document.getElementById('image-container');
                    console.log('Image container:', imageContainer);
                    console.log('Field files:', field.files);
                    if (!field.files || field.files.length === 0) {
                        console.log('No image file selected');
                        isValid = false;
                        errorMessage = 'Profile image is required';
                        if (imageContainer) {
                            imageContainer.classList.add('is-invalid');
                            imageContainer.classList.remove('is-valid');
                        }
                    } else {
                        const file = field.files[0];
                        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                        const maxSize = 2 * 1024 * 1024; // 2MB
                        
                        if (!allowedTypes.includes(file.type)) {
                            isValid = false;
                            errorMessage = 'Image must be a JPEG, PNG, or GIF file';
                            if (imageContainer) {
                                imageContainer.classList.add('is-invalid');
                                imageContainer.classList.remove('is-valid');
                            }
                        } else if (file.size > maxSize) {
                            isValid = false;
                            errorMessage = 'Image file size must not exceed 2MB';
                            if (imageContainer) {
                                imageContainer.classList.add('is-invalid');
                                imageContainer.classList.remove('is-valid');
                            }
                        } else if (imageContainer) {
                            imageContainer.classList.remove('is-invalid');
                            imageContainer.classList.add('is-valid');
                        }
                    }
                    break;
            }

            // Show error if invalid and add visual feedback
            if (!isValid) {
                errorElement.textContent = errorMessage;
                field.classList.add('is-invalid');
                field.classList.remove('is-valid');
            } else {
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
            }

            return isValid;
        }

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/job/job-application.js') }}"></script>
<script>

        // Education HTML Block
        const educationFormHTML = (id) => `
            <div class="form-section mt-4 border rounded p-3 bg-light" id="education-form-${id}">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Education</h6>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeEducation(${id})" title="Remove Education">
                        <img src="${deleteIconUrl}" alt="Delete" width="16" height="16">
                    </button>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="edu-country-${id}">
                                <option value="">Choose...</option>
                                ${countries.map(country => `<option value="${country.id}">${country.name}</option>`).join('')}
                            </select>
                            <label for="edu-country-${id}">Country</label>
                            <small class="error text-danger country-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="degree-type-${id}">
                                <option selected>Choose...</option>
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
                            <input type="text" class="form-control" id="degree-name-${id}" placeholder="Degree Name">
                            <label for="degree-name-${id}">Degree Name</label>
                            <small class="error text-danger degree-name-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="institute-name-${id}" placeholder="Institute Name">
                            <label for="institute-name-${id}">Institute Name</label>
                            <small class="error text-danger institution-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="currently-studying-${id}" name="currently_studying">
                            <label class="form-check-label" for="currently-studying-${id}">
                                Currently Studying
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="edu-start-date-${id}" placeholder="Start Date">
                            <label for="edu-start-date-${id}">Start Date</label>
                            <small class="error text-danger start-date-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="edu-end-date-${id}" placeholder="End Date">
                            <label for="edu-end-date-${id}">End Date</label>
                            <small class="error text-danger end-date-error"></small>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Experience HTML Block
        const experienceFormHTML = (id) => `
            <div class="form-section mt-4 border rounded p-3 bg-light" id="experience-form-${id}">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Work Experience</h6>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeExperience(${id})" title="Remove Experience">
                        <img src="${deleteIconUrl}" alt="Delete" width="16" height="16">
                    </button>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="company-${id}" placeholder="Company">
                            <label for="company-${id}">Company</label>
                            <small class="error text-danger company-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="job-title-${id}" placeholder="Job Title">
                            <label for="job-title-${id}">Job Title</label>
                            <small class="error text-danger job-title-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="exp-country-${id}">
                                <option value="">Choose...</option>
                                ${countries.map(country => `<option value="${country.id}">${country.name}</option>`).join('')}
                            </select>
                            <label for="exp-country-${id}">Country</label>
                            <small class="error text-danger country-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="job-type-${id}">
                                <option selected>Choose...</option>
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                            </select>
                            <label for="job-type-${id}">Job Type</label>
                            <small class="error text-danger job-type-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input class="form-control" placeholder="Job Description" id="job-description-${id}" required></input>
                            <label for="job-description-${id}">Job Description</label>
                            <small class="error text-danger job-description-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="currently-working-${id}">
                            <label class="form-check-label" for="currently-working-${id}">
                                Currently Working
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="exp-start-date-${id}" placeholder="Start Date">
                            <label for="exp-start-date-${id}">Start Date</label>
                            <small class="error text-danger start-date-error"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="exp-end-date-${id}" placeholder="End Date">
                            <label for="exp-end-date-${id}">End Date</label>
                            <small class="error text-danger end-date-error"></small>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Event Listeners
        document.getElementById("add-education-btn").addEventListener("click", function () {
            eduCounter++;
            document.getElementById("education-container").insertAdjacentHTML("beforeend", educationFormHTML(eduCounter));
            setupEducationFormEvents(eduCounter);
        });

        document.getElementById("add-experience-btn").addEventListener("click", function () {
            expCounter++;
            document.getElementById("experience-container").insertAdjacentHTML("beforeend", experienceFormHTML(expCounter));
            setupExperienceFormEvents(expCounter);
        });

        // Setup form events
        function setupEducationFormEvents(id) {
            // Currently studying checkbox logic
            document.getElementById(`currently-studying-${id}`).addEventListener('change', function() {
                const endDateInput = document.getElementById(`edu-end-date-${id}`);
                endDateInput.disabled = this.checked;
                if (this.checked) {
                    endDateInput.value = '';
                }
                // Clear end date error when checkbox is checked
                clearEducationErrors(id);
            });

            // Real-time validation on blur
            const fields = [
                `degree-type-${id}`,
                `degree-name-${id}`,
                `institute-name-${id}`,
                `edu-country-${id}`,
                `edu-start-date-${id}`,
                `edu-end-date-${id}`
            ];

            fields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.addEventListener('blur', function() {
                        validateEducationForm(id);
                    });
                    // Add real-time validation on input (similar to main form)
                    field.addEventListener('input', function() {
                        if (this.value.trim() !== '') {
                            validateEducationForm(id);
                        }
                    });
                }
            });
        }

        function setupExperienceFormEvents(id) {
            // Currently working checkbox logic
            document.getElementById(`currently-working-${id}`).addEventListener('change', function() {
                const endDateInput = document.getElementById(`exp-end-date-${id}`);
                endDateInput.disabled = this.checked;
                if (this.checked) {
                    endDateInput.value = '';
                }
                // Clear end date error when checkbox is checked
                clearExperienceErrors(id);
            });

            // Real-time validation on blur
            const fields = [
                `company-${id}`,
                `job-title-${id}`,
                `exp-country-${id}`,
                `job-type-${id}`,
                `job-description-${id}`,
                `exp-start-date-${id}`,
                `exp-end-date-${id}`
            ];

            fields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.addEventListener('blur', function() {
                        validateExperienceForm(id);
                    });
                    // Add real-time validation on input (similar to main form)
                    field.addEventListener('input', function() {
                        if (this.value.trim() !== '') {
                            validateExperienceForm(id);
                        }
                    });
                }
            });
        }

        // Validation Functions
        function validateEducationForm(formId) {
            let isValid = true;
            const errors = {};
            let firstFailedField = null;

            // Get form elements
            const degreeType = document.getElementById(`degree-type-${formId}`);
            const degreeName = document.getElementById(`degree-name-${formId}`);
            const institution = document.getElementById(`institute-name-${formId}`);
            const countryId = document.getElementById(`edu-country-${formId}`);
            const startDate = document.getElementById(`edu-start-date-${formId}`);
            const endDate = document.getElementById(`edu-end-date-${formId}`);
            const currentlyStudying = document.getElementById(`currently-studying-${formId}`);

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

            // Always show errors (even if form is valid, to clear previous errors)
                showEducationErrors(formId, errors);

            return {
                isValid: isValid,
                firstFailedField: firstFailedField
            };
        }

        function validateExperienceForm(formId) {
            let isValid = true;
            const errors = {};
            let firstFailedField = null;

            // Get form elements
            const companyName = document.getElementById(`company-${formId}`);
            const jobTitle = document.getElementById(`job-title-${formId}`);
            const countryId = document.getElementById(`exp-country-${formId}`);
            const jobType = document.getElementById(`job-type-${formId}`);
            const jobDescription = document.getElementById(`job-description-${formId}`);
            const startDate = document.getElementById(`exp-start-date-${formId}`);
            const endDate = document.getElementById(`exp-end-date-${formId}`);
            const currentlyWorking = document.getElementById(`currently-working-${formId}`);

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

            // Always show errors (even if form is valid, to clear previous errors)
                showExperienceErrors(formId, errors);

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

        // Remove Functions
        function removeEducation(id) {
            const form = document.getElementById(`education-form-${id}`);
            if (form) form.remove();
        }

        function removeExperience(id) {
            const form = document.getElementById(`experience-form-${id}`);
            if (form) form.remove();
        }


        // Collect all education and experience data for form submission
        function collectEducationData() {
            const educationData = [];
            const educationForms = document.querySelectorAll('[id^="education-form-"]');
            
            educationForms.forEach(form => {
                const formId = form.id.split('-')[2];
                const degreeType = document.getElementById(`degree-type-${formId}`);
                const degreeName = document.getElementById(`degree-name-${formId}`);
                const institution = document.getElementById(`institute-name-${formId}`);
                const countryId = document.getElementById(`edu-country-${formId}`);
                const startDate = document.getElementById(`edu-start-date-${formId}`);
                const endDate = document.getElementById(`edu-end-date-${formId}`);
                const currentlyStudying = document.getElementById(`currently-studying-${formId}`);

                // Collect data even if some fields are empty (validation will be done on backend)
                educationData.push({
                    degree_type: degreeType ? degreeType.value : '',
                    degree_name: degreeName ? degreeName.value : '',
                    institution: institution ? institution.value : '',
                    country_id: countryId ? countryId.value : '',
                    start_date: startDate ? startDate.value : '',
                    end_date: currentlyStudying && currentlyStudying.checked ? null : (endDate ? endDate.value : ''),
                    currently_studying: currentlyStudying ? currentlyStudying.checked : false
                });
            });
            
            return educationData;
        }

        function collectExperienceData() {
            const experienceData = [];
            const experienceForms = document.querySelectorAll('[id^="experience-form-"]');
            
            experienceForms.forEach(form => {
                const formId = form.id.split('-')[2];
                const companyName = document.getElementById(`company-${formId}`);
                const jobTitle = document.getElementById(`job-title-${formId}`);
                const countryId = document.getElementById(`exp-country-${formId}`);
                const jobType = document.getElementById(`job-type-${formId}`);
                const description = document.getElementById(`job-description-${formId}`);
                const startDate = document.getElementById(`exp-start-date-${formId}`);
                const endDate = document.getElementById(`exp-end-date-${formId}`);
                const currentlyWorking = document.getElementById(`currently-working-${formId}`);

                // Collect data even if some fields are empty (validation will be done on backend)
                experienceData.push({
                    job_title: jobTitle ? jobTitle.value : '',
                    job_type: jobType ? jobType.value : '',
                    company_name: companyName ? companyName.value : '',
                    country_id: countryId ? countryId.value : '',
                    start_date: startDate ? startDate.value : '',
                    end_date: currentlyWorking && currentlyWorking.checked ? null : (endDate ? endDate.value : ''),
                    currently_working: currentlyWorking ? currentlyWorking.checked : false,
                    description: description ? description.value : ''
                });
            });
            
            return experienceData;
        }

        // Override the main form submission to include education and experience data
        function submitJobApplication() {
            const form = document.getElementById('job-application-form');
            const formData = new FormData(form);
            
            // Add education data
            const educationData = collectEducationData();
            educationData.forEach((edu, index) => {
                Object.keys(edu).forEach(key => {
                    formData.append(`education[${index}][${key}]`, edu[key]);
                });
            });
            
            // Add experience data
            const experienceData = collectExperienceData();
            experienceData.forEach((exp, index) => {
                Object.keys(exp).forEach(key => {
                    formData.append(`experience[${index}][${key}]`, exp[key]);
                });
            });
            
            // Submit the form with all data
            // You can call your existing applicationSubmit() function here
            // or implement the submission logic
            console.log('Education Data:', educationData);
            console.log('Experience Data:', experienceData);
            console.log('Form Data:', Object.fromEntries(formData));
            
            // Call the existing application submit function
            if (typeof applicationSubmit === 'function') {
                applicationSubmit();
            }
        }

    </script>
@endsection