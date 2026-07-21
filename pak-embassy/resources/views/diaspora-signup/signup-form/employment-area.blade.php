<div class="step-container d-none" id="step3">
    <div class="row g-3 min-vh-100">
        <!-- Left Panel -->
        <div class="col-lg-5 left-panel d-flex flex-column justify-content-center align-items-center">
            <div class="text-center text-white">
                <img src="{{asset('img/Frame13.png')}}" alt="City Skyline" class="left-image mb-4">
            </div>
        </div>

        <!-- Right Panel -->
        <div class="col-lg-7 right-panel d-flex flex-column justify-content-center">
            <div class="form-container">

                <!-- Progress Indicator -->
                @include('diaspora-signup.signup-form.progress-bar')


                <!-- Form -->
                <form id="form-step3">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Employer Industry</label>
                            <select name="industry_area_id" class="form-select text-dark" required>
                                <option class="text-mute" disabled selected value="">Select Industry Area</option>
                                @foreach($industry_areas as $industry_area)
                                <option class="text-dark" value="{{ $industry_area->id }}">{{ $industry_area->name }}</option>
                                @endforeach
                            </select>
                            <div id="industry_area_id_error" class="text-danger small"></div>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Work Domain</label>
                            <select name="work_domain_id" class="form-select text-dark" required>
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
                                <button type="button" class="btn form-select w-100 text-start" data-bs-toggle="dropdown" id="skillsBtn">
                                    Select service domain
                                </button>
                                <div class="dropdown-menu p-3 pb-0 text-nowrap">
                                    @foreach($skills as $skill)
                                    <div class="form-check">
                                        <input class="form-check-input skill-checkbox"
                                            type="checkbox"
                                            name="skills[]" required
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

                        <div class="col-md-6 mb-4 position-relative">
                            <label for="additional_skills" class="form-label">Additional Skills</label>
                            <div class="tags-input-container form-control" id="additional_skills_container" style="min-height: 38px; display: flex; flex-wrap: wrap; align-items: flex-start; gap: 5px; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 0.375rem; transition: all 0.15s ease-in-out;">
                                <input type="text" id="additional_skills" class="border-0 flex-grow-1" placeholder="Type and press Enter" style="outline: none; min-width: 120px; flex: 1;">
                            </div>
                            <div id="additional_skills_error" class="text-danger small"></div>
                        </div>

                    </div>



                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-secondary btn-lg px-5 me-3"
                            onclick="prevStepIndividual(3)">Previous</button>
                        <button type="button" class="btn btn-primary btn-lg px-5"
                            onclick="nextStep(3);">Next</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <a href="{{'/login'}}" class="login-link">Have an Account <span>Login here</span></a>
                </div>
            </div>
        </div>
    </div>
</div>