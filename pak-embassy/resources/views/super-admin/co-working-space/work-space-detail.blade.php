@extends("layouts.master")
@section('content')
<div class="event-top mt-4 mb-3">
    <h3 class="go-back" style="cursor: pointer;" onclick="window.history.back();">
        <img src="{{ asset('user-dash-img/ph_arrow-left-bold.svg')}}" alt="ph_arrow-left-bold image">
        Go Back
    </h3>
</div>
<div class="container my-5 text-style">
    <!-- Title -->
    <h4 class="fw-bold">{{$space->name}}</h4>
    <p class="text-muted">{{$space->location}}</p>

    <!-- Image -->
    @if($space->images && $space->images->first())
    <img src="{{ asset('storage/' . $space->images->first()->path) }}"
        class="card-img-top"
        alt="Olaya District">
    @else
    <img src="{{ asset('user-dash-img/workSpace-two.png') }}"
        class="card-img-top"
        alt="Olaya District">
    @endif

    <!-- Overview -->
    <h6 class="fw-bold mb-2">Co-WorkSpace Overview</h6>
    <p>{{$space->space_overview}}</p>

    <!-- Options -->
    <h6 class="fw-bold mt-4 mb-2">Co-WorkSpace Options</h6>
    {!!$space->space_description!!}

    <!-- Amenities -->
    <h6 class="fw-bold mt-4 mb-2">Amenities</h6>
    {!!$space->space_amenities!!}
    <!-- Location -->
    <h6 class="fw-bold mt-4 mb-2">Location</h6>
    <p><i class="bi bi-geo-alt-fill text-success me-2"></i>{{$space->location}}</p>
    <div class="ratio ratio-16x9 mb-4">
        <iframe src="https://www.google.com/maps?q=24.7136,46.6753&z=15&output=embed" allowfullscreen
            loading="lazy">
        </iframe>
    </div>

    <!-- Contact -->
    <h6 class="fw-bold mt-4 mb-2">Contact</h6>
    <p>Get in touch with us to learn more or schedule a tour:</p>
    <p><strong>Phone:</strong> <a href="tel:{{$space->phone}}" class="text-decoration-none">{{$space->phone}}</a>
    </p>
    <p><strong>Email:</strong> <a href="mailto:coworkspace@email.com"
            class="text-decoration-none">{{$space->email}}</a></p>
</div>

@endsection