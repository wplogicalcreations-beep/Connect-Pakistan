<div class="col-lg-4 col-md-6">
    <div class="custom-card-common">
        <div class="card-main flex-column">
            <div class="card-head">
            @if(!empty($job->organization->images) && count($job->organization->images) > 0)
            <img src="{{ asset('storage/' . $job->organization->images[0]->path) }}"
                alt="Job Image" width="94" height="84">
            @else
            <img src="{{ asset('user-dash-img/event-date.svg') }}"
                alt="Default Event Image" width="94" height="84">
            @endif
            <div>
                <p class="mb-0">{{ $job?->title ?? "" }}</p>
                <span>{{ $job?->organization?->name ?? "" }}</span>
            </div>
            </div>
            <div class="card-body">
                <div class="card-body-common">
                <div>
                    <img src="{{ asset('images/camera.svg') }}" alt="">
                    <p>SAR {{ $job?->min_salary ?? 0 }} - SAR {{ $job?->max_salary ?? 0 }}</p>
                </div>
                <div>
                    <img src="{{ asset('images/brefcase.svg') }}" alt="">
                    <p>{{ $job?->vacancies ?? 0 }} Vacancy</p>
                </div>
                </div>
                <p class="card-text">{!! $job?->description ?? "" !!}</p>
                <hr>
                <div class="text-center">
                    <button class="btn card-btn-applyNow">
                        <a href="">Apply Now <i class="fa-solid fa-arrow-right"></i> </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>