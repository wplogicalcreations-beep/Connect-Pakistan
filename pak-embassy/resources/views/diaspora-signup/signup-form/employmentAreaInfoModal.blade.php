<!-- Step 1 Modal -->
<div class="modal fade" id="step3Modal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title">Employment Area</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <form id="modal-form-step3">
                     @csrf
                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Employer Industry</label>
                            <select name="industry_area_id" class="form-select text-dark">
                                <option class="text-mute" disabled selected value="">Select Industry Area</option>
                                @foreach($industry_areas as $industry_area)
                                <option class="text-dark" value="{{ $industry_area->id }}">{{ $industry_area->name }}</option>
                                @endforeach
                            </select>
                            <div id="industry_area_id_error" class="text-danger small"></div>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Work Domain</label>
                            <select name="work_domain_id" class="form-select text-dark">
                                <option class="text-mute" disabled selected value="">Select Work Domain</option>
                                @foreach($work_domains as $work_domain)
                                <option class="text-dark" value="{{ $work_domain->id }}">{{ $work_domain->name }}</option>
                                @endforeach
                            </select>
                            <div id="work_domain_id_error" class="text-danger small"></div>
                        </div>
                    </div>

                    <!-- Another Row -->
                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <div class="dropdown service-domain-dropdown">
                                <label class="form-label">Skills</label>
                                <button type="button" class="btn form-select w-100 text-start" data-bs-toggle="dropdown" id="modalSkillsBtn">
                                    Select skills
                                </button>
                                <div class="dropdown-menu p-3 pb-0 text-nowrap">
                                    @foreach($skills as $skill)
                                    <div class="form-check">
                                        <input class="form-check-input skill-checkbox"
                                            type="checkbox"
                                            name="skills[]"
                                            value="{{ $skill['id'] }}"
                                            id="emp{{ $skill['id'] }}">
                                        <label class="form-check-label" for="emp{{ $skill['id'] }}">
                                            {{ $skill['name'] }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="skills_error" class="text-danger small"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" form="form-step3" onclick="modalUpdations(3)" class="btn btn-primary">Update</button>
            </div>

        </div>
    </div>
</div>