<!-- Event Section -->
<section class="event-sec">
    <div class="container">
        <div class="event-top ">
            <div>
                <h1 class=" "> Upcoming Events in KSA</h1>
                <img src="images/Flags.svg" alt="" class="img-fluid">
            </div>
            <a href="{{'/events'}}">view All</a>

        </div>
        <div class="row g-3">
            @foreach ($data['events']->take(3) as $event)
            <div class="col-md-6 col-lg-4 col-sm-12 mb-2">
                <div class="single-card">
                    @if(!empty($event->images) && count($event->images) > 0)
                    <img src="{{ asset('storage/' . $event->images[0]->path) }}"
                        alt="Event Image"
                        class="img-fluid w-100 d-block mx-auto"
                        style="object-fit: contain; height: 200px; background:#f8f9fa;">
                    @else
                    <img src="{{ asset('images/fintech-1.png') }}"
                        alt="Default Event Image"
                        class="img-fluid w-100 d-block mx-auto"
                        style="object-fit: contain; height: 200px; background:#f8f9fa;">
                    @endif
                    <div class="card-txt">
                        <h4>{{$event['name']}}</h4>
                        <p> {!! Str::limit($event->event_overview, 100, '...') !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>