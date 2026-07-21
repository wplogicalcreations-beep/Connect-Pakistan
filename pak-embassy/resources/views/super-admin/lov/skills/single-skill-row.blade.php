<tr id="skills-{{ $skill->id }}">
    <td class="sr-number">{{ $serialNumber }}</td>
    <td class="text-center dept-name">{{ $skill->name }}</td>
    <td class="text-center">
        <x-toggle-button 
            :state="$skill->is_active ?? 0" 
            :url="route('skill.update', $skill->id)"
            :id="'toggleSkill_' . $skill->id"
        />
    </td>
    <td>
        <div>
            <div class="dropdown">
                <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    Select
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#"
                           data-bs-toggle="modal"
                           data-bs-target="#staticBackdrop"
                           data-id="{{ $skill->id }}"
                           data-name="{{ $skill->name }}"
                           data-type="{{ $skill->type }}">
                            <img src="{{ asset('images/edit.svg') }}" class="me-2" alt="edit-icon">Edit
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item delete-skill" href="#"
                           data-bs-toggle="modal"
                           data-bs-target="#exampleModalToggle"
                           data-id="{{ $skill->id }}">
                            <img src="{{ asset('images/delete-icon.svg') }}" class="me-2" alt="delete-icon">Delete
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </td>
</tr>
