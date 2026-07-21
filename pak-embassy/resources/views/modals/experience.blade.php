<div class="form-section mt-4" id="experience-form-${id}">
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" id="company-${id}" placeholder="Company">
                <label for="company-${id}">Company</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" id="job-title-${id}" placeholder="Job Title">
                <label for="job-title-${id}">Job Title</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-select" id="exp-country-${id}">
                    <option selected>Choose...</option>
                    <option value="US">United States</option>
                    <option value="IN">Pakistan</option>
                </select>
                <label for="exp-country-${id}">Country</label>
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
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input class="form-control" placeholder="Job Description" id="job-description-${id}"></input>
                <label for="job-description-${id}">Job Description</label>
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
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="date" class="form-control" id="exp-end-date-${id}" placeholder="End Date">
                <label for="exp-end-date-${id}">End Date</label>
            </div>
        </div>
    </div>
    <div class="mt-3 d-flex justify-content-end gap-2">
        <button type="button" class="btn btn-outline-secondary" onclick="removeExperience(${id})">Cancel</button>
        <button type="button" class="btn btn-success rounded" onclick="submitExperience(${id})">Save</button>
    </div>
</div>