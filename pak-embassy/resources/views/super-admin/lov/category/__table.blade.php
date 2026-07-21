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
                    <th class="text-center sort-column" data-sort="string">{{ Str::of($type)->replace('-', ' ')->title() }}
                        <a href="javascript:void(0);"
                           class="sort" data-sort="id">
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
                <tbody id="lovsTable">
                @forelse($lovs as $index => $lov)
                    @include('super-admin.lov.category.single-row', [
                        'lov' => $lov,
                        'serialNumber' => $lovs->firstItem() + $index,
                        'type' => $type
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
<x-pagination :items="$lovs"/>
@include('super-admin.lov.category.modal')

