<div class="col-md-12">
    <div class="dep-list-table">
        <div class="table-responsive view-table">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="sort-column" data-sort="number">Sr:
                            <a href="javascript:void(0);"
                                class="sort" data-sort="id">
                                <img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow">
                            </a>
                        </th>
                        <th class="text-center sort-column" data-sort="string">Company Name
                            <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                        </th>
                        <th class="text-center sort-column" data-sort="string">Job Title
                            <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                        </th>
                        <th class="text-center sort-column" data-sort="string">Job Type
                            <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                        </th>
                        <th class="text-center sort-column" data-sort="string">Work Mode
                            <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                        </th>
                        <th class="text-center sort-column" data-sort="string">Expert Level
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
                <tbody id="jobApplicationsTable">
                    @forelse($jobApplications as $index => $jobApplication)
                    @include('user-dashboard.job-application.single-job-application-row', [
                    'jobApplication' => $jobApplication,
                    'serialNumber' => $jobApplications->firstItem() + $index
                    ])
                    @empty
                    <tr>
                        <td colspan="12" class="text-center">No Job Application found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<x-pagination :items="$jobApplications" />
{{-- <!-- @include('super-admin.lov.skills.modal') --> --}}