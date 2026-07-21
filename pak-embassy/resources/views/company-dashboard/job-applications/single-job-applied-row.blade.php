<tr id="applications-{{ $application->id }}">
    <td>AID{{$application->id}}</td>
    <td class="text-center dept-name">{{$application->details->name ?? '-'}}</td>
    <td class="text-center dept-name">{{$application->jobPost->title ?? '-'}}</td>
    <td class="text-center dept-name">{{$application->details->email ?? '-'}}</td>
    <td class="text-center dept-name">{{$application->details->phone ?? '-'}}</td>
    <td class="text-center dept-name">{{$application->details->experience ?? '-'}}</td>
    <td class="text-center dept-name"><span class="badge bg-success-2 p-2">{{$application->status->name ?? '-'}}</span></td>
    <!-- <td>
        <div class="dropdown">
            <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                Select
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop"><img src="{{ asset('user-dash-img/edit.svg')}}"
                            class="me-2" alt="Edit-icon">Edit </a></li>
                <li>
                    <a class="dropdown-item" href="complaint-assign.html">
                        <img src="{{ asset('user-dash-img/assign.svg')}}" class="me-2" alt="assign-icon">Assign
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" data-bs-toggle="modal" href="#exampleModalToggle"
                        role="button"><img src="{{ asset('user-dash-img/delete-icon.svg')}}" class="me-2"
                            alt="delete-icon">Delete</a>
                </li>
            </ul>
        </div>
    </td> -->


</tr>