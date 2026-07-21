@props(['knowledge'])

<div class="col-lg-4 col-md-6">
    <div class="card-main flex-column">
        @if($knowledge->sections && $knowledge->sections->count() > 0 && $knowledge->sections->first()->images && $knowledge->sections->first()->images->count() > 0)
            <img src="{{ asset('storage/' . $knowledge->sections->first()->images->first()->path) }}" alt="{{ $knowledge->heading }}" class="img-fluid w-100">
        @else
            <img src="{{ asset('images/knowledge1.png') }}" alt="{{ $knowledge->heading }}" class="img-fluid w-100">
        @endif
        
        <div class="card-body">
            <p class="card-title">
                {{ $knowledge->heading }}
            </p>
            <p class="card-text">
                @if($knowledge->sections && $knowledge->sections->count() > 0)
                    {!! Str::limit($knowledge->sections->first()->content, 150) !!}
                @else
                    No content available.
                @endif
            </p>
            <hr>
            <div class="text-center">
                <button class="btn card-btn">
                    <a href="{{ route('knowledge.detail', $knowledge->id) }}" target="_blank">View Details</a>
                </button>
            </div>
        </div>
    </div>
</div>
