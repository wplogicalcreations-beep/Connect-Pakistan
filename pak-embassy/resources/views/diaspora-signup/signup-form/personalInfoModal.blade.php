<!-- Step 1 Modal -->
<div class="modal fade" id="step1Modal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title">Personal Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form id="modal-form-step1">
             @csrf
          <div class="row g-3">
            <div class="col-md-6 mb-3">
              <label class="form-label">Full Name <span class="text-danger">*</span></label>
              <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
              <div id="name_error" class="text-danger small"></div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Passport No. <span class="text-danger">*</span></label>
              <input type="text" name="passport_no" class="form-control" placeholder="Enter passport number" required>
              <div id="passport_no_error" class="text-danger small"></div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Iqama ID <span class="text-danger">*</span></label>
              <input type="text" name="iqama_id" class="form-control" placeholder="Enter Iqama ID" required>
              <div id="iqama_id_error" class="text-danger small"></div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Mobile No. <span class="text-danger">*</span></label>
              <input type="tel" name="phone" class="form-control" placeholder="Enter mobile number" required>
              <div id="phone_error" class="text-danger small"></div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Email ID <span class="text-danger">*</span></label>
              <input type="email" name="email" class="form-control" placeholder="Enter email" required>
              <div id="email_error" class="text-danger small"></div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">LinkedIn Profile <span class="text-danger">*</span></label>
              <input type="text" name="linkedin_url" class="form-control" placeholder="Enter LinkedIn URL" required>
              <div id="linkedin_url_error" class="text-danger small"></div>
            </div>

            <!-- <div class="col-md-6 mb-3">
              <label class="form-label">Profile Photo</label>
              <div class="input-group">
                <input type="file" id="formFile" name="image" class="form-control">
              </div>
              <div id="image_error" class="text-danger small"></div>
            </div> -->
          </div>
        </form>
      </div>

      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" form="form-step1" onclick="modalUpdations(1)" class="btn btn-primary">Update</button>
      </div>

    </div>
  </div>
</div>
