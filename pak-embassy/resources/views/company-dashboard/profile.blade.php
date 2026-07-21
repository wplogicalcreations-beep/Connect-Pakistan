@extends('dashboard-layouts.company-layout.master')

@section('content')
<div class="container-fluid py-5">
    <h4 class="mb-4">Profile Information</h4>

    <!-- Profile Card -->
    <div class="profile-card d-flex flex-column flex-md-row align-items-start gap-3">
        <img src="{{ optional($user->images()->first())->path
                ? asset('storage/' . optional($user->images()->first())->path)
                : asset('images/Users.svg') }}" alt="Profile Picture" class="company-logo">
        <div class="flex-grow-1">
            <div class="d-flex justify-content-between">
                <h5 class="mb-1">{{$organization->name ?? '--'}}</h5>
                {{-- <img src="{{ asset('user-dash-img/edit-button.svg') }}" alt="Edit button" data-bs-toggle="modal"--}}
                {{-- data-bs-target="#editProfileModal" style="cursor: pointer;">--}}
            </div>
            <div class="small-text mb-2 d-flex flex-wrap align-items-center gap-2">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('user-dash-img/ic_outline-email.svg') }}" alt="email-icon" class="me-1">
                    {{$organization->ceo_email ?? '--'}}
                </div>

                @if($organization->location)
                <div class="d-flex align-items-center">
                    <img src="{{ asset('user-dash-img/akar-icons_location.svg') }}" alt="location icon" class="me-1">
                    {{$organization->location}}
                </div>
                @endif

                <div class="d-flex align-items-center">
                    <img src="{{ asset('user-dash-img/line-md_phone.svg') }}" alt="phone Icon" class="me-1">
                    {{$organization->ceo_contact ?? '--'}}
                </div>

                @if(!empty($organization->website_url))
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-globe fs-6 me-1"></i>
                    <a class="text-dark" href="{{ $organization->website_url }}" target="_blank">
                        {{ $organization->website_url }}
                    </a>
                </div>
                @endif
            </div>
            <p class="mb-2">
                {{$organization?->bio ?? ''}}
            </p>
            <div class="d-flex">
                <span class="badge bg-ligght skill-badge text-dark" style="font-size: 14px;">Services</span>
            <div class="d-flex flex-wrap align-items-center gap-1">
                @foreach($user->skills as $skill)
                <span class="badge bg-success skill-badge">{{$skill->name ?? '--'}}</span>
                @endforeach
            </div>
            </div>
        </div>
        <div>
            <i class="bi bi-pencil-square text-success fs-5"></i>
        </div>
    </div>

    <!-- Company Identity Section -->
    <h5 class="section-title mt-5">1. Company Identity</h5>
    <div class="card border-0 my-3 p-3 profilr-span">
        <div class="row">
            <!-- Left Side -->
            <div class="col-12 col-lg-6">
                <div class="d-flex justify-content-between">
                    <span>Organization Name</span>
                    <span class="fw-bold">{{$organization->name ?? '--'}}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>SECP Registration No.</span>
                    <span class="fw-bold">{{$organization->secp_registration_number ?? '--'}}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>PASHA Registration No.</span>
                    <span class="fw-bold">{{$organization->pseb_registration_number ?? '--'}}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>CEO’s Contact No.</span>
                    <span class="fw-bold">{{$organization->ceo_contact ?? '--'}}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Registered Company in KSA?</span>
                    <span class="fw-bold">{{ $organization->has_ksa_registered_company == 1 ? 'Yes' : 'No' }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Company Representative Name</span>
                    <span class="fw-bold">{{$organization->representative_name ?? '--'}}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Representative Email</span>
                    <span class="fw-bold">{{$organization->representative_email ?? '--'}}</span>
                </div>
            </div>

            <!-- Right Side -->
            <div class="col-12 col-lg-6">
                <div class="d-flex justify-content-between">
                    <span>Website URL</span>
                    <span class="fw-bold">{{$organization->website_url ?? '--'}}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>PSEB Registration No.</span>
                    <span class="fw-bold">{{$organization->pseb_registration_number ?? '--'}}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Name of CEO</span>
                    <span class="fw-bold">{{$organization->ceo_name ?? '--'}}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>CEO’s Email</span>
                    <span class="fw-bold">{{$organization->ceo_email ?? '--'}}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Name of KSA Entity</span>
                    <span class="fw-bold">{{$organization->saudi_entity_name ?? '--'}}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Company Representative No.</span>
                    <span class="fw-bold">{{$organization->representative_contact ?? '--'}}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Company Logo</span>

                    <img src="{{ optional($organization->images()->first())->path
                ? asset('storage/' . optional($organization->images()->first())->path)
                : asset('images/Users.svg') }}"
                        alt="Logo" style="height: 30px;">
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Company Information -->
    <h5 class="section-title mt-5">2. Company Information</h5>
    <div class="card border-0 my-3 p-3 profilr-span">
        <div class="row">
            <!-- Left Side -->
            <div class="col-12 col-lg-6">
                <div class="d-flex justify-content-between">
                    <span>Company Type</span>
                    <span class="fw-bold">{{$organization->company_type}}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>No. of Staff</span>
                    <span class="fw-bold">{{$organization->no_of_staff}}</span>
                </div>
                {{-- <div class="d-flex justify-content-between">--}}
                {{-- <span>Industry Area</span>--}}
                {{-- <span class="fw-bold">--}}
                {{--</span>--}}
                {{-- </div>--}}
                <div class="d-flex justify-content-between">
                    <span>No. of Projects</span>
                    <span class="fw-bold">{{$organization->no_of_projects}}</span>
                </div>
            </div>

            <!-- Right Side -->
            <div class="col-12 col-lg-6">
                <div class="d-flex justify-content-between">
                    <span>No. of Experience</span>
                    <span class="fw-bold">{{$organization->years_of_experience}}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Have Company Certificate?</span>
                    <span class="fw-bold">{{ $organization->has_company_certificate == 1 ? 'Yes' : 'No' }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Reference/Existing Clients</span>
                    <span class="fw-bold">{{$organization->reference}}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Reference Projects</span>
                    <span class="fw-bold">{{$organization->reference_project}}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Product Information -->
    <h5 class="section-title mt-5">3. Product Information</h5>
    <div class="card border-0 my-3 p-3 profilr-span">
        <div class="row">
            @foreach($organization->products as $product)
            <div class="col-12 col-lg-6">
                <div class="d-flex justify-content-between">
                    <span>{{$product->name}}</span>
                    <span class="fw-bold">{{$product->capabilities}}</span>
                </div>
            </div>

            @endforeach

        </div>
    </div>

    <!-- 4. Service Information -->
    <h5 class="section-title mt-5">4. Service Information</h5>
    <div class="card border-0 my-3 p-3 profilr-span">
        <div class="row">
            <?php

            $work_domain = $user->lovs()
                ->wherePivot('lov_type_id', \App\Models\LovType::WORK_DOMAIN)
                ->get();
            ?>

            @foreach($work_domain as $workDomain)
            <!-- Left Side -->


            <div class="col-12 col-lg-6">

                <div class="d-flex justify-content-between">
                    <span>Service Domain</span>
                    <span class="fw-bold">{{$workDomain->name}}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>IP on Implement Methodologies</span>
                    <span class="fw-bold">192.011.21.1</span>
                </div>
            </div>
            @endforeach

            <!-- Right Side -->

            <div class="col-12 col-lg-6">
                <div class="d-flex justify-content-between">
                    <span>Service Skills</span>
                    <span class="fw-bold">
                        @foreach($user->skills as $skill )
                        {{$skill->name}},
                        @endforeach
                    </span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Certifications of Staff</span>
                    <span class="fw-bold">{{$organization->staff_certification}}</span>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content rounded-3">

                <!-- Header -->
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body px-4">

                    <!-- Profile Image Upload -->
                    <div class="text-center mb-4 position-relative">
                        <img src="{{ asset('user-dash-img/company-logo.png') }}" width="104" height="104"
                            alt="Profile" class="rounded-circle" width="100" height="100" id="profileImage">
                        <label for="imageUpload"
                            class="position-absolute bottom-0 end-50 translate-middle-x bg-transparent rounded-circle p-1"
                            style="cursor: pointer;">
                            <img src="{{ asset('user-dash-img/edit-button.svg') }}" alt="Edit" width="20">
                        </label>
                    </div>

                    <!-- Form -->
                    <form>
                        <h5 class="section-title mt-5">1. Company Identity</h5>
                        <div class="row g-3">
                            <!-- Organization Name -->
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" id="organizationName"
                                    placeholder="Organization Name">
                                <label for="organizationName">Organization Name</label>
                            </div>

                            <!-- Website URL -->
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" id="url" placeholder="Website URL">
                                <label for="url">Website URL</label>
                            </div>

                            <!-- Registration -->
                            <div class="col-md-6 form-floating">
                                <select class="form-select" id="registration" aria-label="Gender">
                                    <option value="" selected disabled>Select No</option>
                                    <option value="Male">121</option>
                                    <option value="Female">2311</option>
                                </select>
                                <label for="registration">SECP Registration No.</label>
                            </div>

                            <!-- PSEB Registration No. -->
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" id="PSEB"
                                    placeholder="PSEB Registration No.">
                                <label for="PSEB">PSEB Registration No.</label>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6 form-floating">
                                <label for="mobile_code" class="form-label for-phone">Phone Number</label>
                                <input type="tel" id="mobile_code" name="phone"
                                    class="form-control for-phone-style" placeholder="Enter phone number">
                            </div>


                            <!-- DOB -->
                            <div class="col-md-6 form-floating">
                                <input type="date" class="form-control" id="dob"
                                    placeholder="Date of Birth">
                                <label for="dob">Date of Birth</label>
                            </div>

                            <!-- Country -->
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control bg-search-icon" id="country"
                                    placeholder="Country">
                                <label for="country">Country</label>
                            </div>

                            <!-- Province -->
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control bg-search-icon" id="province"
                                    placeholder="Province">
                                <label for="province">Province</label>
                            </div>

                            <!-- District -->
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control bg-search-icon" id="district"
                                    placeholder="District">
                                <label for="district">District</label>
                            </div>

                            <!-- Tehsil -->
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control bg-search-icon" id="tehsil"
                                    placeholder="Tehsil">
                                <label for="tehsil">Tehsil</label>
                            </div>

                            <!-- Address -->
                            <div class="col-12 form-floating">
                                <input type="text" class="form-control" id="address" placeholder="Address">
                                <label for="address">Address</label>
                            </div>

                            <!-- Skills -->
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control bg-search-icon" id="skills"
                                    placeholder="Skills">
                                <label for="skills">Skills</label>
                            </div>

                            <!-- Languages -->
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control bg-search-icon" id="languages"
                                    placeholder="Languages">
                                <label for="languages">Languages</label>
                            </div>

                            <!-- Profile Bio -->
                            <div class="col-12">
                                <label for="bio" class="form-label">Profile Bio</label>
                                <textarea class="form-control" id="bio" rows="3"
                                    placeholder="Write your bio..."></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success rounded">Update Profile</button>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('js-file')
    @endsection