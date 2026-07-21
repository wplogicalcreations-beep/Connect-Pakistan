@extends('dashboard-layouts.company-layout.master')

@section('content')
<div class="event-top mt-4 mb-3">
    <a href="{{ url('/company/discover-job')}}"><img src="{{ asset('user-dash-img/ph_arrow-left-bold.svg')}}" alt="ph_arrow-left-bold image">Go
        Back</a>
</div>
<div class="row g-4 text-style border-bottom">
    <!-- Left Column -->
    <div class="col-lg-7">
        <h2>{{$job->title}}<span class="badge bg-success">{{ ucfirst($job->work_mode) }}</span></h2>
        {!! $job->description !!}
        <div>
            <h4 class="section-title">Key Responsibilities</h4>
            {!! $job->responsibilities !!}
        </div>
        <div>
            <h4 class="section-title">Requirements</h4>
            {!! $job->requirements !!}
        </div>
        <div>
            <h4 class="section-title">What We Offer</h4>
            {!! $job->benefits !!}
        </div>

    </div>

    <!-- Right Column: Event Card -->
    <div class="col-lg-5">
        <div class="event-card border-0 p-0 background-unset">
            @if(!empty($job->organization) && $job->organization->images->isNotEmpty())
            <img src="{{ asset('storage/' . $job->organization->images->first()->path) }}"
                alt="{{ $job->organization->name ?? 'Organization Job Image' }}"
                class="job-image">
            @else
            <img src="{{ asset('user-dash-img/event-date.svg') }}"
                alt="Default Job Image"
                class="job-image">
            @endif
            <!-- Date and Time Section -->
            <div class="my-4">
                <h6 class="text-muted fw-bold mb-2">Date Posted</h6>
                <p class="mb-1"><img class="pe-2" width="20" height="20" src="{{ asset('user-dash-img/event-date.svg')}}"
                        alt="calender Image">{{ $job->created_at->format('l, j F Y') }}</p>
            </div>
            <div class="my-4">
                <h6 class="text-muted fw-bold mb-2">Job Type</h6>
                <p class="mb-1"><img class="pe-2" width="20" height="20" src="{{ asset('user-dash-img/type.svg')}}"
                        alt="calender Image">{{$job->work_mode}} - {{$job->job_type}}</p>
            </div>

            <!-- Location -->
            <h6 class="text-muted fw-bold mb-2">Location</h6>
            <p>
                <i class="bi bi-geo-alt-fill me-2 text-success"></i>
                <a href="{{$job->location}}" target="_blank"
                    class="text-decoration-none text-dark">
                    {{$job->address}}
                </a>
            </p>

            <!-- Embedded Google Map -->
            <div class="ratio ratio-4x3 rounded overflow-hidden">
                <iframe src="{{$job->embed_map}}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>
    </div>
</div>
@endsection
@section('js-file')
@endsection