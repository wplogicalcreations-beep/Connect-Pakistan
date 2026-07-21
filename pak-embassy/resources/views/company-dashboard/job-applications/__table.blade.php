<div class="col-md-12">
    <div class="dep-list-table">
        <div class="table-responsive view-table">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="sort-column" data-sort="number">Application ID
                            <a href="javascript:void(0);"
                                class="sort" data-sort="id">
                                <img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow">
                            </a>
                        </th>
                        <th class="text-center sort-column" data-sort="string">Candidate Name
                            <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                        </th>

                        <th class="text-center sort-column" data-sort="string">Title
                            <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                        </th>
                        <th class="text-center sort-column" data-sort="string">Email
                            <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                        </th>
                        <th class="text-center sort-column" data-sort="string">Phone Number
                            <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                        </th>
                        <th class="text-center sort-column" data-sort="string">No. of Experience
                            <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                        </th>
                        <th class="text-center sort-column" data-sort="string">Status
                            <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                        </th>
                        <!-- <th> Action <img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}" alt="Sort Arrow">
                        </th> -->
                    </tr>
                </thead>
                <tbody id="applicationsTable">
                    @forelse($applications as $index => $application)
                    @include('company-dashboard.job-applications.single-job-applied-row', [
                    'application' => $application
                    ])
                    @empty
                    <tr>
                        <td colspan="12" class="text-center">No Application found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<x-pagination :items="$applications" />
<!-- @include('super-admin.lov.skills.modal') -->