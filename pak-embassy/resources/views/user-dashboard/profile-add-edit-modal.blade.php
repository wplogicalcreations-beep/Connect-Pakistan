<!-- Modal Add Education -->
<div class="modal fade" id="education" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="educationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="educationLabel">Education</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Container where forms will be appended -->
                <div id="educationContainer">
                    <!-- Default form will be added here by JavaScript -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="submitEducationBtn">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Work Experience -->
<div class="modal fade" id="workExperience" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="workExperienceLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="workExperienceLabel">Work Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Container where forms will be appended -->
                <div id="workExperienceContainer"></div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="submitExperienceBtn">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Certifications -->
<div class="modal fade" id="certification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="certificationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="certificationLabel">Certification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Container where forms will be appended -->
                <div id="certificationContainer"></div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="submitCertificationBtn">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Education Modal -->
<div class="modal fade" id="editeducation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editeducationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editeducationLabel">Edit Education</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="editEducationForm">
                    <div class="row g-3">
                        <!-- Country -->
                        <div class="col-md-6 form-floating">
                            <select class="form-select" id="edit_country_id" name="country_id">
                                <option value="">Select Country</option>
                            </select>
                            <label for="edit_country_id">Select Country</label>
                            <small class="error country_id_error text-danger"></small>
                        </div>
                        <!-- Degree Type -->
                        <div class="col-md-6 form-floating">
                            <select class="form-select" id="edit_degree_type" name="degree_type">
                                <option value="">Choose...</option>
                                <option value="Bachelor">Bachelor</option>
                                <option value="Master">Master</option>
                                <option value="Diploma">Diploma</option>
                                <option value="Ph.D.">Ph.D.</option>
                            </select>
                            <label for="edit_degree_type">Degree Type</label>
                            <small class="error degree_type_error text-danger"></small>
                        </div>
                        <!-- Degree Name -->
                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control" id="edit_degree_name" name="degree_name" placeholder="Degree Name">
                            <label for="edit_degree_name">Degree Name</label>
                            <small class="error degree_name_error text-danger"></small>
                        </div>
                        <!-- Institute Name -->
                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control" id="edit_institute_name" name="institute_name" placeholder="Institute Name">
                            <label for="edit_institute_name">Institute Name</label>
                            <small class="error institute_name_error text-danger"></small>
                        </div>
                        <!-- Currently Studying -->
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="edit_currently_studying" name="currently_studying">
                                <label class="form-check-label" for="edit_currently_studying">
                                    Currently Studying
                                </label>
                            </div>
                        </div>
                        <!-- Start Date -->
                        <div class="col-md-6 form-floating">
                            <input type="date" class="form-control" id="edit_start_date" name="start_date" placeholder="Start Date">
                            <label for="edit_start_date">Start Date</label>
                            <small class="error start_date_error text-danger"></small>
                        </div>
                        <!-- End Date -->
                        <div class="col-md-6 form-floating">
                            <input type="date" class="form-control" id="edit_end_date" name="end_date" placeholder="End Date">
                            <label for="edit_end_date">End Date</label>
                            <small class="error end_date_error text-danger"></small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-success" id="updateEducationBtn">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Work Experience Modal -->
<div class="modal fade" id="editworkExperience" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editworkExperienceLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editworkExperienceLabel">Edit Work Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="editExperienceForm">
                    <div class="row g-3">
                        <!-- Company -->
                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control" id="edit_company" name="company" placeholder="Company">
                            <label for="edit_company">Company</label>
                            <small class="error company_error text-danger"></small>
                        </div>
                        <!-- Job Title -->
                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control" id="edit_job_title" name="job_title" placeholder="Job Title">
                            <label for="edit_job_title">Job Title</label>
                            <small class="error job_title_error text-danger"></small>
                        </div>
                        <!-- Country -->
                        <div class="col-md-6 form-floating">
                            <select class="form-select" id="edit_country" name="country">
                                <option value="">Choose...</option>
                            </select>
                            <label for="edit_country">Country</label>
                            <small class="error country_error text-danger"></small>
                        </div>
                        <!-- Job Type -->
                        <div class="col-md-6 form-floating">
                            <select class="form-select" id="edit_job_type" name="job_type">
                                <option value="">Choose...</option>
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                            </select>
                            <label for="edit_job_type">Job Type</label>
                            <small class="error job_type_error text-danger"></small>
                        </div>
                        <!-- Job Description -->
                        <div class="col-md-12 form-floating">
                            <textarea class="form-control" id="edit_job_description" name="job_description" placeholder="Job Description" style="height: 100px"></textarea>
                            <label for="edit_job_description">Job Description</label>
                            <small class="error job_description_error text-danger"></small>
                        </div>
                        <!-- Currently Working -->
                        <div class="col-md-6">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="edit_currently_working" name="currently_working">
                                <label class="form-check-label" for="edit_currently_working">
                                    Currently Working
                                </label>
                            </div>
                        </div>
                        <!-- Start Date -->
                        <div class="col-md-6 form-floating">
                            <input type="date" class="form-control" id="edit_exp_start_date" name="start_date" placeholder="Start Date">
                            <label for="edit_exp_start_date">Start Date</label>
                            <small class="error start_date_error text-danger"></small>
                        </div>
                        <!-- End Date -->
                        <div class="col-md-6 form-floating">
                            <input type="date" class="form-control" id="edit_exp_end_date" name="end_date" placeholder="End Date">
                            <label for="edit_exp_end_date">End Date</label>
                            <small class="error end_date_error text-danger"></small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-success" id="updateExperienceBtn">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Certification Modal -->
<div class="modal fade" id="editcertification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editcertificationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editcertificationLabel">Edit Certification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="editCertificationForm">
                    <div class="row g-3">
                        <!-- Title -->
                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control" id="edit_title" name="title" placeholder="Enter Certificate Title">
                            <label for="edit_title">Enter Certificate Title</label>
                            <small class="error title_error text-danger"></small>
                        </div>
                        <!-- Institution -->
                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control" id="edit_institution" name="institution" placeholder="Enter Institution">
                            <label for="edit_institution">Enter Institution</label>
                            <small class="error institution_error text-danger"></small>
                        </div>
                        <!-- Grade -->
                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control" id="edit_grade" name="grade" placeholder="Enter Grade">
                            <label for="edit_grade">Enter Grade</label>
                            <small class="error grade_error text-danger"></small>
                        </div>
                        <!-- Start Date -->
                        <div class="col-md-6 form-floating">
                            <input type="date" class="form-control" id="edit_cert_start_date" name="start_date" placeholder="Start Date">
                            <label for="edit_cert_start_date">Enter Start Date</label>
                            <small class="error start_date_error text-danger"></small>
                        </div>
                        <!-- End Date -->
                        <div class="col-md-6 form-floating">
                            <input type="date" class="form-control" id="edit_cert_end_date" name="end_date" placeholder="End Date">
                            <label for="edit_cert_end_date">End Date</label>
                            <small class="error end_date_error text-danger"></small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-success" id="updateCertificationBtn">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
    aria-hidden="true">
    <!-- Keep the existing profile modal content -->
</div>