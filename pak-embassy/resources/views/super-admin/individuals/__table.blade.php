<div class="col-md-12">
    <div class="table-responsive view-table">
        <table class="table table-striped table-hover">
            <thead class="table-light">
            <tr>
                <th>Sr: <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="name">Name <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="work-domain">Work Domain <img class="sort-arrow" src="images/sort-arrow.svg"
                                     alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="level">Level <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="skilled">Skilled<img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="register-date">Register Date <img class="sort-arrow" src="images/sort-arrow.svg"
                                       alt="Sort Arrow">
                </th>

                <th class="sortable" data-sort="status">Status <img class="sort-arrow" src="images/sort-arrow.svg"
                                alt="Sort Arrow">
                </th>
                <th>
                    <div>
                        Action <img class="sort-arrow" src="images/sort-arrow.svg"
                                    alt="Sort Arrow">

                    </div>
                </th>
            </tr>
            </thead>
            <tbody id="skilledIndividualsTable">
                @forelse($users as $index => $user)
                    @include('super-admin.individuals.single-individual-row', ['user' => $user, 'serialNumber' => $users->firstItem() + $index])
                @empty
                    <tr id="no-record-row">
                        <td colspan="8" class="text-center">No record found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<x-pagination :items="$users"/>

@include('super-admin.individuals.modal')
