<div class="col-md-12">
    <div class="table-responsive view-table cow-worker-table">
        <table class="table table-striped table-hover">
            <thead class="table-light">
            <tr>
                <th class="sortable" data-sort="space-id">
                    Sr: <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="space-id">
                    Page Name <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="space-name">
                    No. of Sections <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="space-name">
                    Status <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="space-action">
                    Action <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>

            </tr>

            </thead>
            <tbody id="knowledgeBaseTable">
                @forelse($knowledgeBases as $index => $knowledgeBase)
                    <tr id="knowledgeBase-{{ $knowledgeBase->id }}">
                        <td class="knowledgeBase-id">{{ $knowledgeBases->firstItem() + $index }}</td>
                        <td class="knowledgeBase-page_name">{{ $knowledgeBase->page_name }}</td>
                        <td class="knowledgeBase-sections">{{ $knowledgeBase->sections_count }}</td>
                        <td class="knowledgeBase-status">
                            <x-toggle-button 
                                :state="$knowledgeBase->status_id" 
                                :url="route('knowledge.update-status', $knowledgeBase->id)" 
                            />
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Select
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" 
                                            href="{{ route('knowledge.show',['id' => $knowledgeBase->id]) }}">
                                            <img src="images/Bookings.svg" class="me-2" alt="View-icon">View 
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('knowledge.edit',['id' => $knowledgeBase->id]) }}">
                                            <img src="{{ asset('images/edit.svg') }}" class="me-2" alt="edit-icon">Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item open-delete-modal" href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#globalDeleteModal"
                                            data-url="{{ route('knowledge.destroy', $knowledgeBase->id) }}"
                                            data-row-id="knowledgeBase-{{ $knowledgeBase->id }}">
                                            <img src="{{ asset('images/delete-icon.svg') }}" class="me-2" alt="delete-icon">Delete
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
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
<x-pagination :items="$knowledgeBases" />
<x-delete-modal />
