<div class="step-content active">
    <h5 class="fw-bold">Co-WorkSpace Enquiry</h5>
    <div class="finish-tick-mark mx-auto my-3"></div>
    <p>Co-workspace enquiry has been submitted!</p>
    
    <div class="row justify-content-center">
        <div class="col-md-4">
            <!-- current status -->
            <div class="text-center">
                <p>
                    <h4 class="text-uppercase">{{ $enquiry->status?->name ?? 'New' }}</h4>
                </p>
            </div>

            <div class="bg-light px-3 py-3 text-start rounded">
                <!-- Date -->
                <p>
                    <img class="pe-1" src="{{ asset('user-dash-img/uil_calender.svg') }}" alt="Calendar"> 
                    <span>{{ \Carbon\Carbon::parse($enquiry->estimated_start_date)->format('l, F j, Y') }}</span>
                </p>

                <!-- Space Type -->
                <p>
                    <img class="pe-1" src="{{ asset('user-dash-img/step-icon.svg') }}" alt="Space Type"> 
                    <span>{{ ucfirst(str_replace('_', ' ', $enquiry->space_type)) }}</span>
                </p>

                <!-- People Count -->
                <p>
                    <img class="pe-1" src="{{ asset('user-dash-img/step-icon-2.svg') }}" alt="People Count"> 
                    <span>{{ $enquiry->people_count }} people</span>
                </p>

                <!-- Duration -->
                <p>
                    <img class="pe-1" src="{{ asset('user-dash-img/event-time.svg') }}" alt="Duration"> 
                    <span>{{ $enquiry->duration }} months</span>
                </p>

                <!-- Co working space people -->
                <p>
                    <img class="pe-1" src="{{ asset('user-dash-img/Users.svg') }}" alt="People"> 
                    <span>
                        {{ $enquiry->coworkingSpace?->bookingRequests->where('status_id', \App\Models\Status::getStatusIdBySlug(\App\Models\Status::APPROVED))->count() }}
                        /
                        {{ $enquiry->coworkingSpace?->people }}
                        Request Approved
                    </span>
                </p>
                
            </div>

            <!-- Accept or Reject Button -->
            <div class="mt-3 d-flex gap-2 justify-content-center">
                <form action="{{ route('co-working-space.accept-enquiry', ['id' => $enquiry->id]) }}" method="post">
                    @csrf
                    <button type="submit" class="badge bg-success">Accept</button>
                </form>
                <form action="{{ route('co-working-space.reject-enquiry', ['id' => $enquiry->id]) }}" method="post">
                    @csrf
                    <button type="submit" class="badge bg-danger">Reject</button>
                </form>
                <form action="{{ route('co-working-space.in-review-enquiry', ['id' => $enquiry->id]) }}" method="post">
                    @csrf
                    <button type="submit" class="badge bg-warning">In Review</button>
                </form>
            </div>
        </div>
    </div>
</div>
