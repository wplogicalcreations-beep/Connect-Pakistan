<div class="col-md-12">
    <div class="dep-list-table">
        <div class="table-responsive view-table">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                <tr>
                    <th class="sort-column" data-sort="number">Sr: <img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                                                        alt="Sort Arrow">
                    </th>
                    <th class="text-center sort-column" data-sort="string">Skill <img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                                                                      alt="Sort Arrow">
                    <th> Action <img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}" alt="Sort Arrow">
                    </th>
                </tr>
                </thead>
                <tbody id="skillsTable">
                @forelse($skills as $index => $skill)
                    @include('super-admin.lov.skills.single-skill-row')
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No departments found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<x-pagination :items="$skills"/>
@include('super-admin.lov.skills.modal')
