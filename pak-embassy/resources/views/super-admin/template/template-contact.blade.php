<x-common-banner
    primary_button=true
    secondary_button=true
    :data="$data"
    editable=true
/>

<section class="get-in-touch-main my-5">
    <div class="container">
        <div class="row g-3">
            <div class="col-md-7">
                <div class="contact-us">
                    <h3>Connect <span>with us</span></h3>
                    <p>Lorem ipsum dolor sit amet consectetur.</p>
                </div>

                @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
                @endif

                <form class="row g-lg-4 g-3" action="{{ route('contact.store') }}" method="POST">
                    @csrf

                    <div class="col-md-6">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" class="form-control p-3 @error('full_name') is-invalid @enderror" name="full_name" id="fullname" value="{{ old('full_name') }}">
                        @error('full_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phonenumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control p-3 @error('phone_number') is-invalid @enderror" name="phone_number" id="phonenumber" value="{{ old('phone_number') }}">
                        @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control p-3 @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="reason" class="form-label">Reason for contact</label>
                        <input type="text" class="form-control p-3 @error('reason_for_contact') is-invalid @enderror" name="reason_for_contact" id="reason" value="{{ old('reason_for_contact') }}">
                        @error('reason_for_contact')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" cols="30" rows="4" class="form-control p-3 @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                        @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-green-custom">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <div class="d-flex justify-content-end">
                    <div class="get-in-touch-right">
                        <h2>Get In Touch</h2>
                        <p>Have questions? Contact us and have your questions answered</p>
                        <div class="get-in-touch-right-inner">
                            <img src="{{asset('images/phone.svg')}}" alt="phone-icon">
                            <div class="get-in-touch-right-inner">
                                <h3>Phone</h3>
                                <p><a href="tel:+921231234567">+92 123 1234567</a></p>
                                <p><a href="tel:+921231234567">+92 123 1234567</a></p>
                            </div>

                        </div>

                        <div class="get-in-touch-right-inner">
                            <img src="{{ asset('images/email.svg') }}" alt="phone-icon">
                            <div>
                                <h3>Email</h3>
                                <p><a href="mailto:info@embassy.com">info@embassy.com</a></p>
                            </div>
                        </div>

                        <div class="get-in-touch-right-inner">
                            <img src="{{ asset('images/social.svg') }}" alt="phone-icon">
                            <div>
                                <h3>Social Media</h3>
                                <p><a href="mailto:info@embassy.com">info@embassy.com</a></p>
                                <div class="social-icons">
                                    <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ asset('images/fb.svg') }}" alt="">
                                    </a>
                                    <a href="https://twitter.com" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ asset('images/twtr.svg') }}" alt="">
                                    </a>
                                    <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ asset('images/insta.svg') }}" alt="">
                                    </a>
                                    <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ asset('images/youtube.svg') }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="our-location my-5">
    <div class="container">
        <div>
            <h2>Our <span>Location</span></h2>
            <img src="{{ asset('images/map.jpg') }}" alt="">
        </div>
    </div>
</section>