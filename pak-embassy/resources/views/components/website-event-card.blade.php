<div class="col-lg-4 col-md-6">
    <div class="card-main flex-column">
        @if(!empty($event->images) && count($event->images) > 0)
        <img src="{{ asset('storage/' . $event->images[0]->path) }}"
            alt="Event Image" width="393" height="144">
        @else
        <img src="{{ asset('user-dash-img/event-date.svg') }}"
            alt="Default Event Image" width="393" height="144">
        @endif
        <div class="card-body">
            <p class="card-title">
                {{ $event?->name ?? "" }}
            </p>
            <p class="card-text">{!! $event?->event_overview ?? "(Empty)" !!}</p>
            <hr>
            <div class="text-center">
                <button class="btn card-btn-applyNow">
                    <a href="">Enroll Now <i class="fa-solid fa-arrow-right"></i> </a>
                </button>
            </div>
        </div>
    </div>
</div>