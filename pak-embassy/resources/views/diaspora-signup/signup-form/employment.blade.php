<div class="step-container d-none" id="step2">
    <div class="row g-3 min-vh-100">
        <!-- Left Panel -->
        <div class="col-lg-5 left-panel d-flex flex-column justify-content-center align-items-center">
            <div class="text-center text-white">
                <img src="{{asset('img/Frame12.png')}}" alt="Business Woman" class="left-image mb-4">
            </div>
        </div>

        <!-- Right Panel -->
        <div class="col-lg-7 right-panel d-flex flex-column justify-content-center">
            <div class="form-container">

                <!-- Progress Indicator -->
                @include('diaspora-signup.signup-form.progress-bar')
                <!-- Form -->
                <form id="form-step2">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Level</label>
                            <select name="level_id" class="form-select text-dark" required>
                                <option  class="text-mute" disabled selected value="">Select Level</option>
                                @foreach($levels as $level)
                                    <option class="text-dark" value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                             <div id="level_id_error" class="text-danger small"></div>
                        </div>

                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Influence Ability</label>
                            <select name="influence_ability_id" class="form-select text-dark" required>
                                <option class="text-mute" disabled selected value="">Select Influence Ability</option>
                                @foreach($influence_abilities as $influence_ability)
                                    <option class="text-dark" value="{{ $influence_ability->id }}">{{ $influence_ability->name }}</option>
                                @endforeach
                            </select>
                            <div id="influence_ability_id_error" class="text-danger small"></div>
                        </div>
                    </div>


                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-secondary btn-lg px-5 me-3"
                                onclick="prevStepIndividual(2);">Previous</button>
                        <button type="button" class="btn btn-primary btn-lg px-5"
                                onclick="nextStep(2);">Next</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <a href="{{'/login'}}" class="login-link">Have an Account <span>Login here</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
