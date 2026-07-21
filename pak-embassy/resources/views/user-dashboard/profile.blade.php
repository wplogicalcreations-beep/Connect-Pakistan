@extends('dashboard-layouts.user-layout.master')
@section('content')
<div class="container py-5">
    <h4 class="mb-4">Profile Information</h4>

    <!-- Profile Card -->
    <div class="profile-card d-flex flex-column flex-md-row align-items-start gap-3">
        <img src="{{ optional(Auth::user()->images()->first())->path
                ? asset('storage/' . optional(Auth::user()->images()->first())->path)
                : asset('images/Users.svg') }}" alt="Profile Picture" class="profile-img">
        <div class="flex-grow-1">
            <div class="d-flex justify-content-between">
                <h5 class="mb-1">{{Auth::user()->name}}</h5>
                {{-- <img src="{{ asset('user-dash-img/edit-button.svg')}}" alt="Edit button" data-bs-toggle="modal"--}}
                {{-- data-bs-target="#editProfileModal" style="cursor: pointer;">--}}
            </div>
            <div class="small-text mb-2 d-flex flex-column flex-sm-row flex-wrap align-items-start gap-2">
                <span><img src="{{ asset('user-dash-img/ic_outline-email.svg')}}" alt="email-icon"> {{Auth::user()->email}}</span>
                <span><img src="{{ asset('user-dash-img/line-md_phone.svg')}}" alt="phone Icon"> {{Auth::user()->phone}}</span>
                @if(Auth::user()->individualProfile && !empty(Auth::user()->individualProfile->linkedin_url))
                <span><img src="{{ asset('user-dash-img/mingcute_linkedin-line.svg') }}" alt="linkedin icon"> {{ Auth::user()->individualProfile->linkedin_url }}</span>
                @endif
            </div>
            <p class="mb-2">
                {{Auth::user()?->individualProfile?->bio ?? ''}}
            </p>
                <div class="d-flex">
                    <span class="badge bg-ligght skill-badge text-dark" style="font-size: 14px;">Skills</span>
                    <div class="d-flex flex-wrap gap-1">
                        @foreach(Auth::user()->skills as $skill)
                        <span class="badge bg-success skill-badge">{{$skill->name ?? '--'}}</span>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>

    <!-- Education Section -->
    <div class="card border-0 my-3 p-3">
        <h5 class="section-title mt-0">Education</h5>

        <div id="educationDetailsList">
            @forelse(Auth::user()->educations as $education)
            <div class="border rounded p-3 mb-2 bg-white position-relative" data-education-id="{{ $education->id }}">
                <small class="text-muted p-absolute">Education</small>
                <div class="d-flex justify-content-between align-items-start mb-5">
                    <div>
                        <h6 class="mb-1">{{ $education->institution }}</h6>
                        <p class="mb-1 text-muted small">{{ $education->degree_type }} - {{ $education->degree_name }}</p>
                    </div>
                    <div class="d-flex gap-3 hide-textmbl-view">
                        <a href="#" class="text-decoration-none text-muted d-flex align-items-center editEdu" data-education-id="{{ $education->id }}">
                            <img class="pe-2" src="{{ asset('user-dash-img/uil_edit.svg')}}" alt="edit"> <span>Edit</span>
                        </a>
                        <a href="#" class="text-decoration-none text-muted d-flex align-items-center removeEduEntry" data-education-id="{{ $education->id }}">
                            <img class="pe-2" src="{{ asset('user-dash-img/flowbite_trash-bin-outline.svg')}}" alt="Delete"> <span>Delete</span>
                        </a>
                    </div>
                </div>
                <div class="d-flex justify-content-between hide-textmbl-view">
                    @if($education->country)
                    <p class="mb-1 text-muted small">
                        <img src="{{ asset('user-dash-img/akar-icons_location.svg')}}" alt="">{{ $education->country->name }}
                    </p>
                    @endif
                    <p class="mb-0 text-muted small">
                        {{ $education->start_date ? $education->start_date->format('d-m-Y') : 'N/A' }}
                        @if($education->end_date)
                        – {{ $education->end_date->format('d-m-Y') }}
                        @elseif($education->currently_studying)
                        – Present
                        @endif
                    </p>
                </div>
            </div>
            @empty
            <div class="text-center text-muted py-4">
                <p>No education records found. Add your first education entry!</p>
            </div>
            @endforelse
        </div>

        <button class="btn btn-outline-success btn-sm add-btn" data-bs-toggle="modal" data-bs-target="#education">+ Add Education</button>
    </div>

    <!-- Work Experience Section -->
    <div class="card border-0 my-3 p-3">
        <h5 class="section-title mt-0">Work Experience</h5>

        <div id="experienceDetailsList">
            @forelse(Auth::user()->experiences as $experience)
            <div class="border rounded p-3 mb-2 bg-white position-relative" data-experience-id="{{ $experience->id }}">
                <small class="text-muted p-absolute">Work Experience</small>
                <div class="d-flex justify-content-between align-items-start mb-5">
                    <div>
                        <h6 class="mb-1">{{ $experience->job_title }}</h6>
                        <p class="mb-1 text-muted small">{{ $experience->company_name }}</p>
                    </div>
                    <div class="d-flex gap-3 hide-textmbl-view">
                        <a href="#" class="text-decoration-none text-muted d-flex align-items-center editExp" data-experience-id="{{ $experience->id }}">
                            <img class="pe-2" src="{{ asset('user-dash-img/uil_edit.svg')}}" alt="edit"> <span>Edit</span>
                        </a>
                        <a href="#" class="text-decoration-none text-muted d-flex align-items-center removeExpEntry" data-experience-id="{{ $experience->id }}">
                            <img class="pe-2" src="{{ asset('user-dash-img/flowbite_trash-bin-outline.svg')}}" alt="Delete"> <span>Delete</span>
                        </a>
                    </div>
                </div>
                <div class="d-flex justify-content-between hide-textmbl-view">
                    @if($experience->country)
                    <p class="mb-1 text-muted small">
                        <img src="{{ asset('user-dash-img/akar-icons_location.svg')}}" alt="">{{ $experience->country->name }}
                    </p>
                    @endif
                    <p class="mb-0 text-muted small">
                        {{ $experience->start_date ? $experience->start_date->format('d-m-Y') : 'N/A' }}
                        @if($experience->end_date)
                        – {{ $experience->end_date->format('d-m-Y') }}
                        @elseif($experience->currently_working)
                        – Present
                        @endif
                    </p>
                </div>
                @if($experience->description)
                <div class="mt-2">
                    <p class="mb-0 text-muted small"><strong>Description:</strong> {{ $experience->description }}</p>
                </div>
                @endif
            </div>
            @empty
            <div class="text-center text-muted py-4">
                <p>No work experience records found. Add your first work experience!</p>
            </div>
            @endforelse
        </div>

        <button class="btn btn-outline-success btn-sm add-btn" data-bs-toggle="modal" data-bs-target="#workExperience">+ Add Experience</button>
    </div>

    <!-- Certifications Section -->
    <div class="card border-0 my-3 p-3">
        <h5 class="section-title mt-0">Certifications</h5>

        <div id="certificationDetailsList">
            @forelse(Auth::user()->certificates as $certificate)
            <div class="border rounded p-3 mb-2 bg-white position-relative" data-certification-id="{{ $certificate->id }}">
                <small class="text-muted p-absolute">Certificate</small>
                <div class="d-flex justify-content-between align-items-start mb-5">
                    <div>
                        <h6 class="mb-1">{{ $certificate->title }}</h6>
                        <p class="mb-1 text-muted small">{{ $certificate->institution }}</p>
                    </div>
                    <div class="d-flex gap-3 hide-textmbl-view">
                        <a href="#" class="text-decoration-none text-muted d-flex align-items-center editCert" data-certification-id="{{ $certificate->id }}">
                            <img class="pe-2" src="{{ asset('user-dash-img/uil_edit.svg')}}" alt="edit"> <span>Edit</span>
                        </a>
                        <a href="#" class="text-decoration-none text-muted d-flex align-items-center removeCertEntry" data-certification-id="{{ $certificate->id }}">
                            <img class="pe-2" src="{{ asset('user-dash-img/flowbite_trash-bin-outline.svg')}}" alt="Delete"> <span>Delete</span>
                        </a>
                    </div>
                </div>
                <div class="d-flex justify-content-between hide-textmbl-view">
                    @if($certificate->grade)
                    <p class="mb-1 text-muted small">Grade: {{ $certificate->grade }}</p>
                    @endif
                    <p class="mb-0 text-muted small">
                        @if($certificate->start_date)
                        {{ $certificate->start_date->format('d-m-Y') }}
                        @if($certificate->end_date)
                        – {{ $certificate->end_date->format('d-m-Y') }}
                        @endif
                        @endif
                    </p>
                </div>
            </div>
            @empty
            <div class="text-center text-muted py-4">
                <p>No certificate records found. Add your first certificate!</p>
            </div>
            @endforelse
        </div>

        <button class="btn btn-outline-success btn-sm add-btn" data-bs-toggle="modal" data-bs-target="#certification">+ Add Certifications</button>
    </div>
</div>

@include('user-dashboard.profile-add-edit-modal')
@endsection
@section('js-file')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const editIconUrl = "{{ asset('user-dash-img/uil_edit.svg') }}";
    const deleteIconUrl = "{{ asset('user-dash-img/flowbite_trash-bin-outline.svg')}}";
    const locationIconUrl = "{{ asset('user-dash-img/akar-icons_location.svg')}}";
</script>
<script src="{{asset('js/user-dashboard.js/profile-add-edit-modal.js')}}"></script>
<script src="{{asset('js/user-dashboard/profile-management.js')}}"></script>
@endsection