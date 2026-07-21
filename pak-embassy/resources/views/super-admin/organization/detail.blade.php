
@extends("layouts.master")
@section("content")
<div class="page-content">
    <div class="page-title">
        <h3 class="info-head">Organization Details</h3>
    </div>

    <div class="card border-0 my-3 p-3">
        <div class="row g-3 align-items-center account-card">
            <div class="col-md-2 text-center">
                <img
                    src="{{ $organization->user->images->first() ? asset('storage/' . $organization->user->images->first()->path) : asset('img/default.png') }}"
                    alt="Profile Image"
                    class="img-fluid w-100  d-block mx-auto rounded">
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-6">
                        <div class="d-flex justify-content-between align-items-center">
                            <p>Name:</p>
                            <span>{{ $organization->name }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p>CEO Name</p>
                            <span>{{ $organization->ceo_name }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p>Contact Number</p>
                            <span>{{ $organization->ceo_conatact }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p>Register Date</p>
                            <span>{{ $organization->created_at->format('d M Y H:i:s') }}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-between align-items-center">
                            <p>Staff Count</p>
                            <span>{{ $organization->no_of_staff }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p>No. of Projects</p>
                            <span>{{ $organization->no_of_projects }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p>Years of Experience</p>
                            <span>{{ $organization->years_of_experience }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p>Status</p>
                            <span class="badge bg-success text-white fw-normal rounded-pill">{{ $organization->is_verified == 1 ? "Active" : 'Pending' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tabs -->
    <ul class="nav nav-tabs" id="orgDetailTabs" role="tablist" style="border-bottom: 2px solid #e8e8e8; margin-top: 20px;">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="other-info-tab" data-bs-toggle="tab" href="#other-info" role="tab" aria-controls="other-info" aria-selected="true" style="border-bottom: 3px solid #198754; color: #000; padding: 10px 20px;">Other Information</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="attended-events-tab" data-bs-toggle="tab" href="#attended-events" role="tab" aria-controls="attended-events" aria-selected="false" style="border-bottom: 3px solid transparent; color: #000; padding: 10px 20px;">Attended Events</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="orgDetailTabsContent">
        <!-- Other Information Tab -->
        <div class="tab-pane fade show active" id="other-info" role="tabpanel" aria-labelledby="other-info-tab">
            <div class="users-page-info">
        <h5>
            Employment Information
        </h5>
        <div class="row g-3">
            <!-- <div class="col-md-6">
                <div class="common-design">
                    <p>Current Employer</p>
                    <span class="form-label fw-bold">N/A</span>
                </div>


            </div> -->

            <!-- <div class="col-md-6">
                <div class="common-design">
                    <p>Previous Employer</p>
                    <span class="form-label fw-bold">N/A</span>
                </div>


            </div> -->
            <!-- <div class="col-md-6">
                <div class="common-design">
                    <p>Level</p>
                    <span class="form-label fw-bold">N/A</span>
                </div>


            </div> -->

            <!-- <div class="col-md-6">
                <div class="common-design">
                    <p>Influence Ability</p>
                    <span class="form-label fw-bold">N/A</span>
                </div>


            </div> -->
            <div class="col-md-6">
                <div class="common-design">
                    <p>Employer Industry</p>
                    <span class="form-label fw-bold">{{$organization?->user?->industry_area->first()?->name ?? '-'}}</span>
                </div>


            </div>




            <h5 class="work-domain-skill">Work Domain <span>(Enable/Disable for Matchmaking)</span></h5>
            @if($organization->user->lovs->isNotEmpty())
            @foreach($organization?->user->lovs as $lov)
            <div class="col-md-6">
                <div class="common-design">
                    <p>{{ $lov?->name }}</p>
                    <div class="radio">
                        <div class="form-check form-switch radio-costum">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                checked="">
                            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif


            <h5 class="work-domain-skill">Skills</h5>
            @if($organization?->user->skills->isNotEmpty())
            @foreach($organization->user->skills as $skill)
            <div class="col-md-6">
                <div class="common-design">
                    <p>Skill {{ $loop->iteration }}</p>
                    <span class="form-label fw-bold">{{ $skill->name }}</span>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
        </div>

        <!-- Attended Events Tab -->
        <div class="tab-pane fade" id="attended-events" role="tabpanel" aria-labelledby="attended-events-tab">
            <div class="card border-0 my-3 p-3">
                <div class="table-responsive view-table">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="sortable" data-sort="event-name">Event Name <img class="sort-arrow" src="{{ asset('images/sort-arrow.svg') }}" alt="Sort Arrow"></th>
                                <th class="sortable" data-sort="event-type">Event Type <img class="sort-arrow" src="{{ asset('images/sort-arrow.svg') }}" alt="Sort Arrow"></th>
                                <th class="sortable" data-sort="event-location">Location <img class="sort-arrow" src="{{ asset('images/sort-arrow.svg') }}" alt="Sort Arrow"></th>
                                <th class="sortable" data-sort="event-city">City <img class="sort-arrow" src="{{ asset('images/sort-arrow.svg') }}" alt="Sort Arrow"></th>
                                <th class="sortable" data-sort="event-start-date">Start Date & Time <img class="sort-arrow" src="{{ asset('images/sort-arrow.svg') }}" alt="Sort Arrow"></th>
                                <th class="sortable" data-sort="event-end-date">End Date & Time <img class="sort-arrow" src="{{ asset('images/sort-arrow.svg') }}" alt="Sort Arrow"></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="attendedEventsTable">
                            @forelse($attendedEvents as $event)
                                @include('super-admin.organization.partials.single-attended-event-row', ['event' => $event])
                            @empty
                                <tr id="no-record-row">
                                    <td colspan="7" class="text-center">No attended events found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <x-pagination :items="$attendedEvents"/>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-file')
<script src="{{ asset('js/SuperAdmin/events-management.js') }}"></script>
<script>
    // Handle tab switching and active state
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('#orgDetailTabs .nav-link');
        
        tabs.forEach(tab => {
            tab.addEventListener('shown.bs.tab', function(e) {
                // Remove active state from all tabs
                tabs.forEach(t => {
                    t.classList.remove('active');
                    t.style.borderBottom = '3px solid transparent';
                });
                
                // Add active state to clicked tab
                e.target.classList.add('active');
                e.target.style.borderBottom = '3px solid #198754';
            });
        });
    });
</script>
@endsection