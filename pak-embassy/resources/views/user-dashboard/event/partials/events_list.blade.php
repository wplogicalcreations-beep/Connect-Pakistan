@forelse ($events as $event)
 @include('user-dashboard.event.partials.single-event-card', ['event' => $event])
@empty
<div class="col-12">
    <div class="single-card text-center p-5 shadow-sm rounded">
        <!-- <img src="{{ asset('images/no-events.png') }}"
                                alt="No Events"
                                class="img-fluid mb-3"
                                style="max-width:150px;"> -->
        <h4 class="mb-2">No Events</h4>
        <p class="text-muted">Stay tuned! We’ll be posting new Events soon.</p>
    </div>
</div>
@endforelse