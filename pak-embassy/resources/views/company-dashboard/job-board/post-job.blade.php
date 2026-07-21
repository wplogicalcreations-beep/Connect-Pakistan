@extends('dashboard-layouts.company-layout.master')
@section('css-file')
<style>
/* CKEditor validation styles */
.ck-editor.is-invalid {
    border: 2px solid #dc3545 !important;
    border-radius: 0.375rem;
}

.ck-editor.is-valid {
    border: 2px solid #198754 !important;
    border-radius: 0.375rem;
}

.ck-editor.is-invalid .ck-editor__editable {
    border-color: #dc3545 !important;
}

.ck-editor.is-valid .ck-editor__editable {
    border-color: #198754 !important;
}
</style>
@endsection
@section('content')
<div class="event-top mt-4 mb-3">
    <a href="{{ url('/company/discover-job') }}">
        <img src="{{ asset('user-dash-img/ph_arrow-left-bold.svg') }}" alt="ph_arrow-left-bold image"> Go Back
    </a>
</div>
<h4>Post a New Job</h4>

<form id="job-post-form" action="{{ route('company.post.job') }}" method="POST">
    @csrf

    <!-- 1. Job Information -->
    <div class="section-title">1. Job Information</div>
    <div class="row g-3">
        <div class="col-md-6 form-floating">
            <input type="text" class="form-control" id="job-title" name="title" placeholder="Job Title" value="{{ old('title') }}">
            <label for="job-title">Job Title</label>
            <div id="title_error" class="text-danger small">@error('title') {{ $message }} @enderror</div>
        </div>

        <div class="col-md-6 form-floating">
            <select class="form-select" id="job_domain_id" name="domain_id">
                <option value ='' disabled {{ old('domain_id') ? '' : 'selected' }}>Choose Job Type</option>
                @foreach($domains as $domain)
                <option value="{{ $domain->id }}" {{ old('domain_id') == $domain->id ? 'selected' : '' }}>{{ $domain->name }}</option>
                @endforeach
            </select>
            <label for="job-domain_id">Job Category</label>
            <div id="domain_id_error" class="text-danger small">@error('domain_id') {{ $message }} @enderror</div>
        </div>

        <div class="col-md-6 form-floating">
            <select class="form-select" id="job-type" name="job_type">
                <option value ='' disabled {{ old('job_type') ? '' : 'selected' }}>Choose Job Type</option>
                <option value="full_time" {{ old('job_type')=='full_time' ? 'selected' : '' }}>Full Time</option>
                <option value="part_time" {{ old('job_type')=='part_time' ? 'selected' : '' }}>Part Time</option>
                <option value="contract" {{ old('job_type')=='contract' ? 'selected' : '' }}>Contract</option>
                <option value="internship" {{ old('job_type')=='internship' ? 'selected' : '' }}>Internship</option>
            </select>
            <label for="job-type">Job Type</label>
            <div id="job_type_error" class="text-danger small">@error('job_type') {{ $message }} @enderror</div>
        </div>

        <div class="col-md-6 form-floating">
            <select class="form-select" id="work-mode" name="work_mode">
                <option value ='' disabled {{ old('work_mode') ? '' : 'selected' }}>Choose Work Mode</option>
                <option value="onsite" {{ old('work_mode')=='onsite' ? 'selected' : '' }}>Onsite</option>
                <option value="remote" {{ old('work_mode')=='remote' ? 'selected' : '' }}>Remote</option>
                <option value="hybrid" {{ old('work_mode')=='hybrid' ? 'selected' : '' }}>Hybrid</option>
            </select>
            <label for="work-mode">Work Mode</label>
            <div id="work_mode_error" class="text-danger small">@error('work_mode') {{ $message }} @enderror</div>
        </div>

        <div class="col-md-6 form-floating">
            <input type="text" class="form-control" id="job-location" name="location" placeholder="Job Location" value="{{ old('location') }}">
            <label for="job-location">Job Location URL</label>
            <div id="location_error" class="text-danger small">@error('location') {{ $message }} @enderror</div>
        </div>

        <div class="col-md-6 form-floating">
            <input type="text" class="form-control" id="embed_map_job" name="embed_map" placeholder="Job Location" value="{{ old('embed_map') }}">
            <label for="embed_map">Embedd Map URL</label>
            <div id="embed_map_error" class="text-danger small">@error('embed_map') {{ $message }} @enderror</div>
        </div>

        <div class="col-md-6 form-floating">
            <input type="text" class="form-control" id="job-address" name="address" placeholder="Address" value="{{ old('address') }}">
            <label for="job-address">Address</label>
            <div id="address_error" class="text-danger small">@error('address') {{ $message }} @enderror</div>
        </div>

        <div class="col-md-6 form-floating">
            <input type="number" class="form-control" id="vacancies" name="vacancies" placeholder="No. of Vacancies" min="1" value="{{ old('vacancies', 1) }}">
            <label for="vacancies">Vacancies</label>
            <div id="vacancies_error" class="text-danger small">@error('vacancies') {{ $message }} @enderror</div>
        </div>
    </div>

    <!-- 2. Job Description -->
    <div class="section-title">2. Job Description</div>
    <div class="row g-3">
        <div class="form-floating">
            <textarea class="form-control ckeditor" id="description" name="description">{{ old('description') }}</textarea>
            <label for="description">Job Description</label>
            <div id="description_error" class="text-danger small">@error('description') {{ $message }} @enderror</div>
        </div>

        <div class="form-floating">
            <textarea class="form-control ckeditor" id="responsibilities" name="responsibilities">{{ old('responsibilities') }}</textarea>
            <label for="responsibilities">Key Responsibilities</label>
            <div id="responsibilities_error" class="text-danger small">@error('responsibilities') {{ $message }} @enderror</div>
        </div>

        <div class="form-floating">
            <textarea class="form-control ckeditor" id="requirements" name="requirements">{{ old('requirements') }}</textarea>
            <label for="requirements">Requirements</label>
            <div id="requirements_error" class="text-danger small">@error('requirements') {{ $message }} @enderror</div>
        </div>

        <div class="form-floating">
            <textarea class="form-control ckeditor" id="benefits" name="benefits">{{ old('benefits') }}</textarea>
            <label for="benefits">What we Offer (Benefits)</label>
            <div id="benefits_error" class="text-danger small">@error('benefits') {{ $message }} @enderror</div>
        </div>
    </div>

    <!-- 3. Experience & Salary -->
    <div class="section-title">3. Experience & Salary</div>
    <div class="row g-3">
        <div class="col-md-6 form-floating">
            <input type="number" class="form-control" id="min_experience" name="min_experience" placeholder="Minimum Experience (years)" value="{{ old('min_experience') }}">
            <label for="min_experience">Minimum Experience (Years)</label>
            <div id="min_experience_error" class="text-danger small">@error('min_experience') {{ $message }} @enderror</div>
        </div>

        <div class="col-md-6 form-floating">
            <input type="number" class="form-control" id="max_experience" name="max_experience" placeholder="Maximum Experience (years)" value="{{ old('max_experience') }}">
            <label for="max_experience">Maximum Experience (Years)</label>
            <div id="max_experience_error" class="text-danger small">@error('max_experience') {{ $message }} @enderror</div>
        </div>

        <div class="col-md-6 form-floating">
            <input type="number" class="form-control" id="min_salary" name="min_salary" placeholder="Minimum Salary" min="1" value="{{ old('min_salary') }}">
            <label for="min_salary">Minimum Salary</label>
            <div id="min_salary_error" class="text-danger small">@error('min_salary') {{ $message }} @enderror</div>
        </div>

        <div class="col-md-6 form-floating">
            <input type="number" class="form-control" id="max_salary" name="max_salary" placeholder="Maximum Salary" min="1" value="{{ old('max_salary') }}">
            <label for="max_salary">Maximum Salary</label>
            <div id="max_salary_error" class="text-danger small">@error('max_salary') {{ $message }} @enderror</div>
        </div>
        <div class="col-md-6 form-floating">
            <select class="form-select" id="currency" name="currency" required>
                <option disabled {{ old('currency') ? '' : 'selected' }}>Choose Currency</option>
                <option value="SAR" {{ old('currency')=='SAR' ? 'selected' : '' }}>SAR</option>                
            </select>
            <label for="job-type">Currency</label>
            <div id="currency_error" class="text-danger small">@error('currency') {{ $message }} @enderror</div>
        </div>
    </div>

    <!-- 4. Dates -->
    <div class="section-title">4. Dates</div>
    <div class="row g-3">
        <div class="col-md-6 form-floating">
            <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}">
            <label for="expiry_date">Expiry Date</label>
            <div id="expiry_date_error" class="text-danger small">@error('expiry_date') {{ $message }} @enderror</div>
        </div>
    </div>
    <!-- Buttons -->
    <div class="d-flex justify-content-end mt-4">
        <a href="{{ url('/company/discover-job')}}" class="btn btn-outline-secondary me-2">Cancel</a>
        <button type="submit" class="btn btn-success rounded">Post New Job →</button>
    </div>
</form>

@endsection
@section('js-file')
<script src="{{ asset('js/validations/job-form-validation.js') }}"></script>
<script src="{{ asset('js/jquery/ckeditor.js') }}"></script>
<script src="{{ asset('js/SuperAdmin/form-ckeditor.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Wait for form-ckeditor.js to initialize CKEditor instances
    setTimeout(() => {
        console.log('Setting up CKEditor validation after initialization...');
        
        // Check for CKEditor 5 instances created by form-ckeditor.js
        const ckEditorFields = ['description', 'responsibilities', 'requirements', 'benefits'];
        ckEditorFields.forEach(fieldId => {
            const textarea = document.getElementById(fieldId);
            if (textarea && textarea.nextElementSibling && textarea.nextElementSibling.classList.contains('ck-editor')) {
                // CKEditor 5 instance exists, find it in the editors array
                const editorIndex = Array.from(document.querySelectorAll('.ckeditor')).indexOf(textarea);
                if (window.editors && window.editors[editorIndex]) {
                    window[fieldId + '_editor'] = window.editors[editorIndex];
                    console.log('Found CKEditor 5 instance for:', fieldId);
                } else {
                    console.log('CKEditor instance not found for:', fieldId, 'at index:', editorIndex);
                }
            } else {
                console.log('CKEditor element not found for:', fieldId);
            }
        });
    }, 1000);
});
</script>
@endsection