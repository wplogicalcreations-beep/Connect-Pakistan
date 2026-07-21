@extends('layouts.landing-page')

@section('title', 'Event')

@section('content')
    <x-common-banner
        primary_button=true
        :data="$data"
    />


    <section class="common-base-main">
        <div class="container">
            <h3 class="section-heading">Your Past Events in KSA</h3>

          <div class="row g-3">
            @if($events && $events->count() > 0)
                @foreach($events as $event)
                    <x-website-event-card :event="$event" />
                @endforeach
            @endif
          </div>
        </div>
    </section>
@endsection