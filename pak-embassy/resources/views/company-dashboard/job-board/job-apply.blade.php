@extends('dashboard-layouts.company-layout.master')

@section('content')
    <div class="event-top mt-4 mb-3">
        <a href="{{ url('/company/discover-job')}}"><img src="{{ asset('user-dash-img/ph_arrow-left-bold.svg')}}" alt="ph_arrow-left-bold image">Go
            Back</a>
    </div>
    <h4>Mobile Application Developer <span class="badge bg-success ms-2">Onsite</span></h4>

    <!-- 1. Basic Information -->
    <div class="section-title">1. Basic Information</div>
    <div class="row g-3">
        <div class="col-md-6 form-floating">
            <input type="text" class="form-control" id="firstName" placeholder="First Name">
            <label for="firstName">First Name</label>
        </div>
        <div class="col-md-6 form-floating">
            <input type="text" class="form-control" id="lastName" placeholder="Last Name">
            <label for="lastName">Last Name</label>
        </div>
        <div class="col-md-6 form-floating">
            <input type="text" class="form-control" id="phone" placeholder="+92 |">
            <label for="phone">Phone Number</label>
        </div>
        <div class="col-md-6 form-floating">
            <input type="email" class="form-control" id="email" placeholder="Email">
            <label for="email">Email</label>
        </div>
    </div>

    <!-- 2. Address Information -->
    <div class="section-title">2. Address Information</div>
    <div class="row g-3">
        <div class="col-md-6 form-floating">
            <input type="text" class="form-control" id="street" placeholder="Street">
            <label for="street">Street</label>
        </div>
        <div class="col-md-6 form-floating">
            <input type="text" class="form-control" id="zip" placeholder="Zip Code">
            <label for="zip">Zip/Postal Code</label>
        </div>
        <div class="col-md-6 form-floating">
            <input type="text" class="form-control" id="city" placeholder="City">
            <label for="city">City</label>
        </div>
        <div class="col-md-6 form-floating">
            <select class="form-select" id="state" aria-label="State">
                <option selected>Placeholder</option>
            </select>
            <label for="state">State/Province</label>
        </div>
        <div class="col-md-6 form-floating">
            <select class="form-select" id="country" aria-label="Country">
                <option selected>Placeholder</option>
            </select>
            <label for="country">Country</label>
        </div>
    </div>

    <!-- 3. Professional Skills -->
    <div class="section-title">3. Professional Skills</div>
    <div class="row g-3">
        <div class="col-md-6 form-floating">
            <input type="text" class="form-control" id="skills" placeholder="Skill Set">
            <label for="skills">Skill Set</label>
        </div>
        <div class="col-md-6 form-floating">
            <select class="form-select" id="department">
                <option selected>Placeholder</option>
            </select>
            <label for="department">Departments</label>
        </div>
    </div>

    <!-- 4. Education Details -->
    <div class="section-title">4. Education Details</div>
    <button class="btn btn-outline-success btn-sm mb-3">+ Add Education</button>

    <!-- 5. Experience Details -->
    <div class="section-title">5. Experience Details</div>
    <button class="btn btn-outline-success btn-sm mb-3">+ Add Experience</button>

    <!-- 6. Social Links -->
    <div class="section-title">6. Social Links</div>
    <div class="row g-3">
        <div class="col-md-6 form-floating">
            <input type="url" class="form-control" id="linkedin" placeholder="LinkedIn">
            <label for="linkedin">LinkedIn</label>
        </div>
        <div class="col-md-6 form-floating">
            <input type="url" class="form-control" id="portfolio" placeholder="Portfolio Link">
            <label for="portfolio">Portfolio Link</label>
        </div>
    </div>

    <!-- 7. Attachment Information -->
    <div class="section-title">7. Attachment Information</div>
    <div class="row g-3">
        <!-- Upload Resume -->
        <div class="col-md-6">
            <div class="upload-container">
                <label for="resumeUpload" class="upload-box w-100" role="button">
                    <div class="overlay-text">Click to Upload Resume</div>
                    <div id="resumePreview" class="preview-box">
                        <i class="bi bi-upload fs-3"></i>
                        <strong id="resumeText">Upload Resume</strong>
                    </div>
                </label>
                <input type="file" id="resumeUpload" class="d-none" accept=".pdf,.doc,.docx"
                    onchange="handleFileUpload(this, 'resumeText', 'resumePreview')">
            </div>
        </div>

        <!-- Upload Photo -->
        <div class="col-md-6">
            <div class="upload-container">
                <label for="photoUpload" class="upload-box w-100" role="button">
                    <div class="overlay-text">Click to Upload Photo</div>
                    <div id="photoPreview" class="preview-box">
                        <i class="bi bi-image fs-3"></i>
                        <strong id="photoText">Upload Photo</strong>
                    </div>
                </label>
                <input type="file" id="photoUpload" class="d-none" accept="image/*"
                    onchange="handleImageUpload(this, 'photoPreview', 'photoText')">
            </div>
        </div>
    </div>



    <!-- Buttons -->
    <div class="d-flex justify-content-end mt-4">
        <button class="btn btn-outline-secondary me-2">Cancel</button>
        <button class="btn btn-success">Submit Application →</button>
    </div>
@endsection
@section('js-file')
@endsection
