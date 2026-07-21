<div class="col-md-6 col-lg-4 col-sm-12 mb-2">
    <div class="single-card card h-100 d-flex flex-column">
        @if(!empty($event->images) && count($event->images) > 0)
        <img src="{{ asset('storage/' . $event->images[0]->path) }}"
            alt="Event Image"
            class="img-fluid w-100"
            style="object-fit: cover; height: 200px;">
        @else
        <img src="{{ asset('user-dash-img/event-date.svg') }}"
            alt="Default Event Image"
            class="img-fluid w-100 d-block mx-auto"
            style="object-fit: contain; height: 200px; background:#f8f9fa;">
        @endif
        <img src="images/fintech-1.png" alt="" class="img-fluid w-100">
        <div class="card-txt card-body d-flex flex-column flex-grow-1">
            <h4>{{$event['name']}}</h4>
            <p class="flex-grow-1 overflow-auto"> {!! Str::limit($event->event_overview, 100, '...') !!}</p>
        </div>
        <hr>
        <div class="text-center mt-auto">
            <button class="btn"> <a href="{{ route('event.details', $event->id) }}" class="btn btn-enrol">
                    Access Now ->
                </a></button>
        </div>
    </div>
</div>