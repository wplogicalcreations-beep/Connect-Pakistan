<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diaspora Sign Up - Embassy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">
    <link href="{{asset('css/diaspora-signup.css')}}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/embassy-logo.svg') }}" type="image/x-icon">
</head>

<body>
<div class="diaspora">
{{--    @include('application-forms.product1.steps.select-success-partner-step')--}}

    <div class="container-fluid">
        <!-- Step 1: Company Identity -->
        @include('diaspora-signup.signup-form.personal-info')

        <!-- Step 2: Company Information -->
        @include('diaspora-signup.signup-form.employment')

        <!-- Step 3: Product Information -->
        @include('diaspora-signup.signup-form.employment-area')
        <!-- Step 4: Service Information -->

        @include('diaspora-signup.signup-form.preview')

                        <!-- Form -->
{{--                        <form id="serviceInfoForm">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6 mb-4 position-relative">--}}
{{--                                    <div class="dropdown service-domain-dropdown">--}}
{{--                                        <label class="form-label">Service Domain</label>--}}
{{--                                        <button type="button" class="dropbtn3 btn form-select w-100 text-start"--}}
{{--                                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"--}}
{{--                                                data-bs-display="static">--}}
{{--                                            Select service domain--}}
{{--                                        </button>--}}
{{--                                        <div class="dropdown-menu p-3 pb-0 text-nowrap"--}}
{{--                                             aria-labelledby="dropdownMenuLink">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="it"--}}
{{--                                                       id="serviceIT">--}}
{{--                                                <label class="form-check-label" for="serviceIT">--}}
{{--                                                    Operations--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="finance"--}}
{{--                                                       id="serviceFinance" checked>--}}
{{--                                                <label class="form-check-label" for="serviceFinance">--}}
{{--                                                    Cybersecurity--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="healthcare"--}}
{{--                                                       id="serviceHealthcare" checked>--}}
{{--                                                <label class="form-check-label" for="serviceHealthcare">--}}
{{--                                                    Digital--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="education"--}}
{{--                                                       id="serviceEducation" checked>--}}
{{--                                                <label class="form-check-label" for="serviceEducation">--}}
{{--                                                    Finance--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="education"--}}
{{--                                                       id="serviceEducation" checked>--}}
{{--                                                <label class="form-check-label" for="serviceEducation">--}}
{{--                                                    Information Technology--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                                <div class="col-md-6 mb-4 position-relative">--}}


{{--                                    <div class="dropdown service-domain-dropdown">--}}
{{--                                        <label class="form-label">Service Skills Involved</label>--}}


{{--                                        <button type="button" class="dropbtn3 btn form-select w-100 text-start"--}}
{{--                                                id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false"--}}
{{--                                                data-bs-display="static">--}}
{{--                                            Select service domain--}}
{{--                                        </button>--}}
{{--                                        <div class="dropdown-menu p-3 pb-0 text-nowrap"--}}
{{--                                             aria-labelledby="dropdownMenuLink">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="it"--}}
{{--                                                       id="serviceIT2">--}}
{{--                                                <label class="form-check-label" for="serviceIT2">--}}
{{--                                                    ML Engineer--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="finance"--}}
{{--                                                       id="serviceFinance2" checked>--}}
{{--                                                <label class="form-check-label" for="serviceFinance2">--}}
{{--                                                    Software Architecture--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="healthcare"--}}
{{--                                                       id="serviceHealthcare2" checked>--}}
{{--                                                <label class="form-check-label" for="serviceHealthcare2">--}}
{{--                                                    Block Chain--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="education"--}}
{{--                                                       id="serviceEducation2" checked>--}}
{{--                                                <label class="form-check-label" for="serviceEducation2">--}}
{{--                                                    Payments--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="education"--}}
{{--                                                       id="serviceEducation2" checked>--}}
{{--                                                <label class="form-check-label" for="serviceEducation2">--}}
{{--                                                    CI/CD Tools--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}
{{--                                <div class="col-md-6 mb-4 position-relative">--}}
{{--                                    <label class="form-label">Any Pre-Implement Methodologies</label>--}}
{{--                                    <input type="text" class="form-control" placeholder="Enter methodologies">--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 mb-4 position-relative">--}}
{{--                                    <label class="form-label">Certifications of Staff in Various Domains</label>--}}
{{--                                    <input type="text" class="form-control" placeholder="Enter certifications">--}}
{{--                                </div>--}}
{{--                            </div>--}}


{{--                            <div class="text-center mt-4">--}}
{{--                                <button type="button" class="btn btn-secondary btn-lg px-5 me-3"--}}
{{--                                        onclick="prevStep(3)">Previous</button>--}}
{{--                                <button type="button" class="btn btn-primary btn-lg px-5"--}}
{{--                                        onclick="nextStep(5)">Next</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}

                    </div>
                </div>
            </div>
        </div>

        <!-- Step 5: Setup Passcode -->
      @include('diaspora-signup.signup-form.setup-passcode')
    </div>
</div>

@include('diaspora-signup.signup-form.modal')

@include('diaspora-signup.signup-form.personalInfoModal')
@include('diaspora-signup.signup-form.employmentInfoModal')
@include('diaspora-signup.signup-form.employmentAreaInfoModal')


<script>
    const dashboardUrl = "{{ route('user.dashboard') }}";
</script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('js/script.js')}}"></script>
<script src="{{ asset('js/signup/diaspora-signup.js') }}"></script>
</body>

</html>
