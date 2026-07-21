<div class="page-content page-content-ck">
    <div class="page-title">
        <h3 class="go-back" style="cursor: pointer;" onclick="window.history.back();">
            Go Back</h3>
    </div>
    <div class="card border-0 p-3">
        <div class="row g-3">
            <div class="col-md-12">
                <div class="company-info-main d-flex flex-wrap align-items-start">
                    @foreach($user->images as $image)
                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $user->name }}" class="user-image" style="height: 60px; width: auto; border-radius: 5px;">
                    @endforeach
                    <div class="company-right-content w-100 w-md-auto">

                        <h3>{{ $user->name }}</h3>
                        <div class="info-icons d-flex flex-column flex-md-row flex-wrap">
                            <div class="d-flex align-items-center mb-2 mb-md-0">
                                <img src="images/email-info.svg" alt="Email icon">
                                <span>{{ $user->email }}</span>
                            </div>
                            @if(!empty($user->location))
                            <div class="d-flex align-items-center mb-2 mb-md-0">
                                <img src="images/location-info.svg" alt="Location icon">
                                <span>{{ $user->location}}</span>
                            </div>
                            @endif
                            <div class="d-flex align-items-center mb-2 mb-md-0">
                                <img src="images/phone-info.svg" alt="Phone icon">
                                <span>{{ $user->phone }}</span>
                            </div>
                            @if($user->individualProfile && !empty($user->individualProfile->linkedin_url))
                            <div class="d-flex align-items-center mb-2 mb-md-0">
                                <img src="images/linkedin-info.svg" alt="LinkedIn icon">
                                <a class="text-dark" href="{{ $user->individualProfile->linkedin_url }}" target="_blank">
                                    {{$user->individualProfile->linkedin_url}}
                                </a>
                            </div>
                            @endif
                        </div>
                        <p>{{$user?->individualProfile?->bio ?? ''}}</p>
                        <div class="d-flex align-items-start mb-2 mb-md-0 gap-2">
                            <span class="mt-2">Skills</span>
                            <div class="info-label flex-wrap">
                                @if($user->skills->isNotEmpty())
                                <div class="span-overflow">
                                    @foreach($user->skills as $skill)
                                    <span class="badge bg-success-3">{{ $skill->name }}</span>
                                    @endforeach
                                </div>
                                @else
                                <span class="badge bg-secondary">N/A</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <form id="selectedMatchesForm" method="POST" action="{{ route('match-making.store-private-event', ['type' => 'private']) }}">
                    @csrf
                    <div class="info-recommend-matches">
                        <div class="recommend-top">
                            <h3 class="my-4 fw-bold">Recommended Matches</h3>
                            <button type="submit" class="btn btn-common-bg">+ Create Event</button>
                        </div>

                        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($recommended->chunk(4) as $chunkIndex => $matchChunk)
                                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                    <div class="row">
                                        @foreach($matchChunk as $match)
                                        @php
                                        $image = $match->images->first()->path ?? 'images/default.png';
                                        $name = $match->name;
                                        @endphp
                                        <div class="col-md-3">
                                            <div class="slide-common text-center p-2 select-match" data-email="{{ $match->email }}">
                                                <img src="{{ asset('storage/' . $image) }}"
                                                    class="d-block w-100 rounded"
                                                    alt="{{ $name }}">
                                                <p class="mt-2 fw-semibold">{{ $name }}</p>
                                                <span class="badge bg-success d-none"><i class="fa-solid fa-check text-light"></i></span>
                                                <input type="hidden" name="selected_emails[]" value="" />
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <button class="carousel-control-prev custom-arrow" type="button"
                                data-bs-target="#myCarousel" data-bs-slide="prev">
                                <span class="custom-prev-icon">
                                    <img src="images/Left-Arrow.svg" alt="Prev" class="arrow-img">
                                </span>
                            </button>

                            <button class="carousel-control-next custom-arrow" type="button"
                                data-bs-target="#myCarousel" data-bs-slide="next">
                                <span class="custom-next-icon">
                                    <img src="images/right-Arrow.svg" alt="Next" class="arrow-img">
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
