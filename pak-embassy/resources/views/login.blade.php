<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/embassy-logo.svg') }}" type="image/x-icon">
    <style>
        .card-design1, .card-design2 {
            cursor: pointer;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 15px;
            transition: all 0.3s ease-in-out;
        }
        .card-design1:hover, .card-design2:hover {
            background-color: #1a5f3c;
            color: #fff;
        }
        .card-design1:hover p, .card-design2:hover p {
            color: #fff;
        }
        .card-design1:hover h3, .card-design2:hover h3 {
            color: #fff;
        }
    </style>
</head>

<body>
<div class="diaspora">
    <div class="container-fluid">
        <!-- Step 1: Company Identity -->
        <div class="step-container login-main-dev" id="step1">
            <div class="row g-3 min-vh-100">
                <!-- Left Panel -->
                <div class="col-lg-5 left-panel d-flex flex-column justify-content-center align-items-center">
                    <div class="text-center text-white width-div">
                        <img src="img/FrameLogin.png" alt="Business Meeting" class="width-img">
                    </div>
                </div>

                <!-- Right Panel -->
                <div class="col-lg-7 right-panel d-flex flex-column justify-content-center">
                    <div class="row justify-content-center rounded" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                        <div class="col-md-12">
                            <div class="form-container">
                                <div class="logo text-center">
                                    <img src="img/embassy-logo.svg" alt="" class="mb-4">
                                    <h4>Hey Again!</h4>
                                </div>

                                <!-- Form -->
                                {{-- <form id="passcodeFormSingle" class="passcodeForm">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="email" class="form-label fw-bold p-0">
                                            Email Address
                                            <span class="text-danger h1 pb-4"><sup>.</sup></span>
                                        </label>
                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            class="form-control"
                                            placeholder="Enter Email"
                                            required
                                            autocomplete="username"
                                        />
                                        <div id="emailError" class="text-danger small d-none my-2">
                                            <i class="fa-solid fa-circle-exclamation text-danger me-2"></i>
                                            Please enter a valid email address.
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-bold p-0">Enter Passcode <span
                                                class="text-danger h1 pb-4"><sup>.</sup></span></label>
                                        <div class="passcode-inputs">
                                            <input type="text" class="passcode-digit" maxlength="1" data-index="0">
                                            <input type="text" class="passcode-digit" maxlength="1" data-index="1">
                                            <input type="text" class="passcode-digit" maxlength="1" data-index="2">
                                            <input type="text" class="passcode-digit" maxlength="1" data-index="3">
                                            <input type="text" class="passcode-digit" maxlength="1" data-index="4">
                                            <input type="text" class="passcode-digit" maxlength="1" data-index="5">
                                        </div>
                                    </div>


                                    <div id="passcodeError" class="text-danger small d-none  my-2">
                                        <i class="fa-solid fa-circle-exclamation text-danger me-2"></i> Entered Passcode
                                        is not correct.
                                    </div>
                                    <div class="mb-4 d-flex justify-content-between">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="termsCheck">
                                            <label class="form-check-label" for="termsCheck">
                                                Remember Me
                                            </label>
                                        </div>
                                        <div>
                                            <button type="button" class="btn pt-0" data-bs-toggle="modal"
                                                    data-bs-target="#resetPasscode">Reset Passcode?
                                            </button>

                                        </div>
                                    </div>

                                    <div class="text-center mt-2">

                                        <button type="button" class="btn btn-primary w-100" onclick="handleSignIn()">
                                            Sign
                                            In
                                        </button>
                                    </div>
                                </form> --}}

                                    <!-- Step 1: Email -->
                                    <div class="step-container" id="stepEmail">
                                    <form id="emailForm">
                                        @csrf
                                        <div class="mb-4">
                                        <label for="email" class="form-label fw-bold" style="position: unset">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control" placeholder="Enter Email" required />
                                        <div id="emailError" class="text-danger small d-none">Invalid Email</div>
                                        </div>
                                        <button type="button" class="btn btn-primary w-100" onclick="checkEmail()">Next</button>
                                    </form>
                                    </div>

                                    <!-- Step 2: Passcode -->
                                    <div class="step-container d-none" id="stepPasscode">
                                    <form id="passcodeForm">
                                        <div class="mb-4 text-center">
                                        <label class="form-label fw-bold" style="position: unset">Enter Passcode <span class="text-danger">*</span></label>
                                        <div class="passcode-inputs justify-content-center">
                                            <input type="text" class="passcode-digit" maxlength="1">
                                            <input type="text" class="passcode-digit" maxlength="1">
                                            <input type="text" class="passcode-digit" maxlength="1">
                                            <input type="text" class="passcode-digit" maxlength="1">
                                            <input type="text" class="passcode-digit" maxlength="1">
                                            <input type="text" class="passcode-digit" maxlength="1">
                                        </div>
                                        </div>
                                        <div id="passcodeError" class="text-danger small d-none">Incorrect passcode</div>
                                        <div class="mb-4 d-flex justify-content-between">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="termsCheck">
                                            <label class="form-check-label" for="termsCheck">
                                                Remember Me
                                            </label>
                                        </div>
                                        <div>
                                            <button type="button" class="btn pt-0" data-bs-toggle="modal"
                                                    data-bs-target="#resetPasscode">Reset Passcode?
                                            </button>

                                        </div>
                                        </div>
                                        <button type="button" class="btn btn-primary w-100" onclick="handleSignIn()">Sign In</button>
                                    </form>
                                    </div>

                                <div class="text-center mt-3">
                                    <a href="#" class="login-link" data-bs-toggle="modal"
                                       data-bs-target="#joinAs">Do not have account? <span>Sign Up Now</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- Authentication Modal -->
<div class="modal fade" id="authModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="d-flex align-items-center">
                    <img src="img/verify-account.svg" alt="">

                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title">Authenticate Your Account</h5>
                <p class="text-muted">To authorise Sign Up, please enter the verification code shared via email
                    below.</p>

                <div class="mb-4">
                    <label class="form-label fw-bold mb-0">Enter Verification Code <span
                            class="text-danger h1 pb-4"><sup>.</sup></span></label>
                    <div class="passcode-inputs">
                        <input type="text" class="passcode-digit" maxlength="1" data-index="12">
                        <input type="text" class="passcode-digit" maxlength="1" data-index="13">
                        <input type="text" class="passcode-digit" maxlength="1" data-index="14">
                        <input type="text" class="passcode-digit" maxlength="1" data-index="15">
                        <input type="text" class="passcode-digit" maxlength="1" data-index="16">
                        <input type="text" class="passcode-digit" maxlength="1" data-index="17">
                    </div>
                </div>

                <div class="text-start mb-3">
                    <a href="#" class="text-dark text-decoration-none">Do not received code? <span
                            class="text-success">Resend</span></a>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-secondary-2" onclick="showVerifiedModal()">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Account Verified Modal -->
<div class="modal fade" id="verifiedModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="img/verified-icon.svg" alt="">
                <h5 class="modal-title my-3">Account Verified!</h5>
                <p class="text-muted">Your account has been verified. You’ll be directed to Login Page
                    automatically. If not, Click “Go to Login”</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Go to Login</button>
            </div>
        </div>
    </div>
</div>
<!-- joinAs modal -->
@include('joinAs')
<!-- reset Passcode modal -->
<div class="modal fade" id="resetPasscode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-transparent border-0">
                <div class="d-flex align-items-center">
                    <img src="img/edit-icon.svg" alt="">

                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-3 pt-0">
                <h3>Reset Passcode</h3>
                <p>If you've forgotten your account Passcode, please enter your email to reset your Passcode.</p>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email <span
                            class="text-danger h1"><sup>.</sup></span></label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="xyz@hotmail.com">
                </div>
                <p>Remember your Passcode? <a href="{{ route('login') }}" class="text-success fw-bold text-decoration-none">Login Here</a></p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-secondary-2" data-bs-toggle="modal"
                        data-bs-target="#resetPasscodeEmail">Reset
                </button>
            </div>

        </div>
    </div>
</div>

<!-- reset Passcode emial sent modal -->
<div class="modal fade" id="resetPasscodeEmail" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-transparent border-0">
                <div class="d-flex align-items-center">
                    <img src="img/edit-icon.svg" alt="">

                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-3 pt-0">
                <h3>Reset Passcode</h3>
                <p>If you've forgotten your account Passcode, please enter your email to reset your Passcode.</p>
                <div class="reset-email">
                    <div class="d-flex align-items-center gap-2">
                            <span>

                                <i class="fa-solid fa-check text-success"></i>
                            </span>
                        <p class="mb-0 fw-bold">Email sent successfully!</p>
                    </div>
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
            <div class="modal-footer border-0">

                <a href="{{ route('login') }}" class="btn btn-primary">Back to Login</a>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('js/script.js')}}"></script>
<script>
    const signInUrl = "{{ route('organization.signIn') }}"
    const checkEmailUrl = "{{ route('organization.checkEmail') }}"
    
    // Auto-clear errors functionality
    document.addEventListener('DOMContentLoaded', function() {
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        
        if (emailInput && emailError) {
            // Clear errors when user starts typing
            emailInput.addEventListener('input', function() {
                clearAllErrors();
            });
            
            // Auto-clear errors after 5 seconds
            autoClearErrors();
        }
        
        // Passcode error clearing
        const passcodeInputs = document.querySelectorAll('.passcode-digit');
        if (passcodeInputs.length > 0) {
            passcodeInputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    clearPasscodeErrors();
                });
            });
        }
    });
    
    function clearAllErrors() {
        const emailError = document.getElementById('emailError');
        const emailInput = document.getElementById('email');
        
        if (emailError) {
            emailError.classList.add('d-none');
        }
        
        if (emailInput) {
            emailInput.classList.remove('is-invalid', 'is-valid');
        }
    }
    
    function autoClearErrors() {
        const emailError = document.getElementById('emailError');
        if (emailError && !emailError.classList.contains('d-none')) {
            // Clear errors after 5 seconds
            setTimeout(function() {
                clearAllErrors();
            }, 5000);
        }
    }
    
    // Passcode error clearing functions
    function clearPasscodeErrors() {
        const passcodeError = document.getElementById('passcodeError');
        if (passcodeError) {
            passcodeError.classList.add('d-none');
        }
    }
    
    function autoClearPasscodeErrors() {
        const passcodeError = document.getElementById('passcodeError');
        if (passcodeError && !passcodeError.classList.contains('d-none')) {
            // Clear passcode errors after 5 seconds
            setTimeout(function() {
                clearPasscodeErrors();
            }, 5000);
        }
    }
</script>
</body>

</html>
