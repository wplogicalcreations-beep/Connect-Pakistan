<div class="col-md-12">
    <div class="dep-list-table">
        <div class="table-responsive view-table">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                <tr>
                    <th class="sort-column" data-sort="number">Sr: <a href="javascript:void(0);" class="sort"
                                                                      data-sort="id">
                            <img class="sort-arrow"
                                 src="{{asset('images/sort-arrow.svg')}}"
                                 alt="Sort Arrow"></a>
                    </th>
                    <th class="text-center sort-column" data-sort="string">Skill
                        <a href="javascript:void(0);"
                           class="sort" data-sort="name">
                            <img class="sort-arrow"
                                 src="{{asset('images/sort-arrow.svg')}}"
                                 alt="Sort Arrow"></a>
                    </th>
                    <th class="text-center sort-column" data-sort="string">Status
                        <a href="javascript:void(0);"
                           class="sort" data-sort="is_active">
                            <img class="sort-arrow"
                                 src="{{asset('images/sort-arrow.svg')}}"
                                 alt="Sort Arrow"></a>
                    </th>
                    <th> Action <img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}" alt="Sort Arrow">
                    </th>
                </tr>
                </thead>
                <tbody id="skillsTable">
                @forelse($skills as $index => $skill)
                    @include('super-admin.lov.skills.single-skill-row', [
                        'skill' => $skill,
                        'serialNumber' => $skills->firstItem() + $index
                    ])
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No record found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<x-pagination :items="$skills"/>
@include('super-admin.lov.skills.modal')

