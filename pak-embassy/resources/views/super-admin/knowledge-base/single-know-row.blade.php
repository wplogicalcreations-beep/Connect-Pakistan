<tr id="knowledgeBase-{{ $knowledgeBase->id }}">
    <td class="knowledgeBase-id">{{ $serialNumber }}</td>
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
            </ul>
        </div>
    </td>
</tr>