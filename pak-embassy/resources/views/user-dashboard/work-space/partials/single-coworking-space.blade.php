@forelse ($coworkingSpaces as $coworkingSpace)
<div class="col-md-6 col-lg-4 col-sm-12 mb-2">
    <div class="card shadow-sm h-100">
        @if($coworkingSpace->images && $coworkingSpace->images->first())
        <img src="{{ asset('storage/' . $coworkingSpace->images->first()->path) }}"
            class="card-img-top"
            alt="Olaya District">
        @else
        <img src="{{ asset('user-dash-img/workSpace-two.png') }}"
            class="card-img-top"
            alt="Olaya District">
        @endif
        <div class="card-body px-0 mx-3 border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0">{{$coworkingSpace->name}}</h6>
                <div class="icon-div">
                    <img src="{{ asset('user-dash-img/wifi.svg')}}" alt="Wifi">
                    <img src="{{ asset('user-dash-img/aircondition.svg')}}" alt="Air condition">
                    <img src="{{ asset('user-dash-img/garage.svg')}}" alt="garage">
                </div>
            </div>
            <p class="text-muted small mb-3">{{$coworkingSpace->location}}</p>
            <p class="small text-muted">{{$coworkingSpace->space_overview}}</p>
            <div class="d-flex align-items-center justify-content-between mt-2">
                <span class="badge bg-light text-success border-success">Starts from SAR {{$coworkingSpace->starting_price}}/ {{$coworkingSpace->month_rentals}}
                    months</span>
                <div>
                    <i class="bi bi-wifi me-2 text-success"></i>
                    <i class="bi bi-person-workspace text-success"></i>
                </div>
            </div>
        </div>
        <div class="card-footer bg-transparent border-0 text-center">
            <button class="btn btn-outline-success btn-sm "> <a href="{{ url('/user/co-work-space-detail/'.$coworkingSpace->id)}}" class="text-decoration-none">Explore Now →</a> </button>
        </div>
    </div>
</div>
@empty
<div class="col-12">
    <div class="single-card text-center p-5 shadow-sm rounded">
        <!-- <img src="{{ asset('images/no-events.png') }}"
                                alt="No Events"
                                class="img-fluid mb-3"
                                style="max-width:150px;"> -->
        <h4 class="mb-2">No Coworking Space Posted</h4>
        <p class="text-muted">Stay tuned! We’ll be posting new Coworking Space soon.</p>
    </div>
</div>
@endforelse