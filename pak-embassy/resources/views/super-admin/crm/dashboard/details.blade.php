@extends("layouts.master")
@section("content")
    <div class="page-content">
        @if(!Request::is('crm/leads'))
            <div class="home-main section">
                <h4 class="my-4 fw-bold">CRM Dashboard</h4>
                <div class="row">
                    <div class="col-md-5 d-flex flex-column">
                        <div class="card main-card-crm h-100">
                            <div class="d-flex justify-content-between">
                                <span>Total Users</span>
                                <img src="images/crm-user.svg" alt="">
                            </div>
                            <h4>{{ $totalUsers }}</h4>
                            <div class="crm-mid">
                                <div>
                                    <p>Active</p>
                                    <h4>{{ $activeUsers }}</h4>
                                </div>
                                <div>
                                    <p>Inactive</p>
                                    <h4>{{ $inActiveUsers }}</h4>
                                </div>
                                <div>

                                    <h5>+12% <i class="fa-solid fa-arrow-up"></i></h5>
                                </div>
                            </div>
                            <div id="chart-sm">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 d-flex flex-column">
                        <div class="row g-3 h-100">
                            <div class="col-md-6 mb-2">
                                <div class="card card-crm h-100">
                                    <div class="main-card ">
                                        <div class="w-100">
                                            <div class="right-card">
                                                <p>Total Leads</p>
                                                <h2>{{ $totalLeads }}</h2>
                                            </div>
                                            <img class="card-image one" src="images/img-one.png" alt="Card Icon">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="card card-crm h-100">
                                    <div class="main-card ">
                                        <div class="w-100">
                                            <div class="right-card">
                                                <p>Total Matchmaking</p>
                                            <h2>{{ $totalMatchMaking }}</h2>
                                            </div>
                                            <img class="card-image one" src="images/total-matching.png" alt="Card Icon">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="card card-crm h-100">
                                    <div class="main-card ">
                                        <div class="w-100">
                                            <div class="right-card">
                                                <p>Total Meetings</p>
                                                <h2>{{ $totalMeetings }}</h2>
                                            </div>
                                            <img class="card-image one" src="images/total-meeting.png" alt="Card Icon">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="card card-crm h-100">
                                    <div class="main-card ">
                                        <div class="w-100">
                                            <div class="right-card">
                                                <p>Total Registered Compnay</p>
                                                <h2>{{ $organizations }}</h2>
                                            </div>
                                            <img class="card-image one" src="images/total-registered-company.png"
                                                alt="Card Icon">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-5 d-flex align-items-stretch">
                <div class="col-12 d-flex mt-2">
                    <div class="chart-card card flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <h5 class="fw-bold">Yearly Stats</h5>
                            <div class="chevron-solved">
                                <select id="yearSelector" class="form-select btn-common-bg" aria-label="Select Year">
                                    @php
                                        $currentYear = now()->year;
                                        $selectedYear = request()->get('year', $currentYear);
                                    @endphp
                                    @for($year = $currentYear; $year >= $currentYear - 3; $year--)
                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div id="monthly-trans-bars"></div>
                    </div>
                </div>
            </div>
        @endif
        <div class="lead-section">
            <div class="page-title">
                <h3>Action Items</h3>
            </div>
            <div class="card border-0 py-3 px-2">
                <div class="row g-3 ">
                    <div class="col-lg-8 col-md-12">
                        <x-filter-search-box tableId="leadsTable" paginationContainer="pagination-container" />
                    </div>
                    <div class="col-lg-4 monthly-trans-bars col-md-12 text-md-end">
                        <div class="me-2">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="date-flex">
                                        <div class="date-main">
                                            <input type="text" class="rounded-0 border-end" id="from" autocomplete="off" placeholder="From">
                                        </div>
                                        <div class="date-main">
                                            <input type="text" class="rounded-0" id="to" autocomplete="off" placeholder="To">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if(!Request::is('crm/leads'))
                                        <button type="button" id="exportExcel" class="btn btn-common-bg">Export CSV</button>
                                    @else
                                        <button type="button" class="btn btn-common-bg"><a href="#">Add Lead</a></button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive view-table">
                            <span id="waiting-for-sorting" style="display: none;">Wait for sorting...</span>
                            <table class="table table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th class="sortable" data-sort="name"><a href="#" class="text-decoration-none text-black">Event Name</a><img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow"></a></th>
                                        {{-- uncomment later --}}
                                        {{-- <th>Lead ID <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                                        </th> --}}
                                        <th class="sortable" data-sort="lead-type">Action</th>
                                        <th class="sortable" data-sort="description"><a href="#" class="text-decoration-none text-black">Description</a> <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow"></th>
                                        <th class="sortable" data-sort="assigned_to"><a href="#" class="text-decoration-none text-black">Assigned to</a> <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow"></th>
                                        <th class="sortable" data-sort="due_date"><a href="#" class="text-decoration-none text-black">Due Date</a> <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow"></th>
                                        <th class="sortable" data-sort="status">Status <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow"></th>
                                        <th class="sortable" data-sort="comment">Comments <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow"></th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="leadsTable">
                                    @forelse($actionItems as $actionItem)
                                        <tr>
                                            <td class="td-name">{{ $actionItem->event->name }}</td>
                                            {{-- uncomment later --}}
                                            {{-- <td class="td-lead-id">{{ $user->lead_id ?? 'N/A' }}</td> --}}
                                            <td class="td-lead-type">{{ $actionItem->action }}</td>
                                            <td class="td-email">{{ $actionItem->description }}</td>
                                            <td class="td-phone">{{ $actionItem->assignedUser?->name }}</td>
                                            <td class="td-date">{{ $actionItem->due_date ? \Carbon\Carbon::parse($actionItem->due_date)->format('d/m/Y') : '-' }}</td>
                                            <td class="td-status">
                                            {{ $actionItem->status}}
                                            </td>
                                           <td>{{ $actionItem->comment }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="16" class="text-center">No record found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <x-pagination :items="$actionItems" />
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js-file")
<script>
    var data = {
        monthlyCounts: @json($monthlyCounts)
    };
</script>
<script src="{{ asset('js/apex-chart.js') }}"></script>
<script src="{{ asset('js/SuperAdmin/CRM/dashboard.js') }}"></script>
<script>
    const indexUrl = "{{ route('dashboard.index') }}";
</script>
@endsection