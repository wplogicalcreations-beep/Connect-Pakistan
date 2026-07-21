
<!-- Modal for Add -->
<div class="modal fade" id="staticBackdropAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-dark" id="staticBackdropAddLabel">Add Complaint</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="view-all.html">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="complainer-name"
                                       placeholder="name@example.com">
                                <label for="complainer-name">Complainer Name</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="complainer-phone"
                                       placeholder="Password">
                                <label for="complainer-phone">Complainer Phone</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <select class="form-select" id="complaint-type"
                                        aria-label="Floating label select example">
                                    <option value="1">Type One</option>
                                    <option value="2">Type two</option>
                                </select>
                                <label for="complaint-type">Complaint type</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <select class="form-select" id="complaint-SubType"
                                        aria-label="Floating label select example">
                                    <option value="1">Sub Type one</option>
                                    <option value="2">Sub Type two</option>
                                </select>
                                <label for="complaint-SubType">Complaint subtype</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="description"
                                       placeholder="name@example.com">
                                <label for="description">Description</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <select class="form-select" id="priority"
                                        aria-label="Floating label select example">
                                    <option value="1">Priority One</option>
                                    <option value="2">Priority two</option>
                                </select>
                                <label for="priority">Select Priority</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <select class="form-select" id="status" aria-label="Floating label select example">
                                    <option value="1">Active</option>
                                    <option value="2">In-Active</option>
                                </select>
                                <label for="status">Select Status</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary my-3 button-style"
                            data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark my-3">Save Complaint</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal for Edit -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-dark" id="staticBackdropLabel">Edit Complaint</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="view-all.html">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="complainer-name" value="Ali Ahmed"
                                       placeholder="name@example.com">
                                <label for="complainer-name">Complainer Name</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="complainer-phone" value="0321-1234567"
                                       placeholder="Password">
                                <label for="complainer-phone">Complainer Phone</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <select class="form-select" id="complaint-type"
                                        aria-label="Floating label select example">
                                    <option value="1">Technical</option>
                                    <option value="2">Type two</option>
                                </select>
                                <label for="complaint-type">Complaint type</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <select class="form-select" id="complaint-SubType"
                                        aria-label="Floating label select example">
                                    <option value="1">App not working</option>
                                    <option value="2">Sub Type two</option>
                                </select>
                                <label for="complaint-SubType">Complaint subtype</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="description"
                                       value="Kindly solve the issue." placeholder="name@example.com">
                                <label for="description">Description</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <select class="form-select" id="priority"
                                        aria-label="Floating label select example">
                                    <option value="1">Medium</option>
                                    <option value="2">Priority two</option>
                                </select>
                                <label for="priority">Select Priority</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <select class="form-select" id="status" aria-label="Floating label select example">
                                    <option value="1">Pending</option>
                                    <option value="2">In-Active</option>
                                </select>
                                <label for="status">Select Status</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary my-3 button-style"
                            data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark my-3">Update Complaint</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Dealte data -->
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h5 class="fw-bold">Are you sure want to delete this? </h5>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-outline-secondary mb-3 button-style"
                        data-bs-dismiss="modal">No</button>
                <button type="button" id="confirmDeleteBtn" class="btn btn-dark mb-3" data-bs-target="#exampleModalToggle2"
                        data-bs-toggle="modal" data-bs-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center my-4">
                <h5 class="fw-bold">Deleted Successfully <img src="images/tick-mark.svg" alt="Tick Mark"></h5>
            </div>
        </div>
    </div>
</div>
<!-- Modal for invite user -->
<div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggle3"
     tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="addUserForm" action="{{ route('users.store') }}" method="POST">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <h2 class="mb-3">Add New User</h2>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="pageName" name="name" placeholder="Enter Name"
                                    value="" required>
                                <label for="pageName">Name</label>
                            </div>
                            <div id="name_error" class="text-danger small mt-1" style="display: none;"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email"
                                    value="" required>
                                <label for="email">Email</label>
                            </div>
                            <div id="email_error" class="text-danger small mt-1" style="display: none;"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password"
                                    value="" required autocomplete="new-password">
                                <label for="password">Password</label>
                            </div>
                            <div id="password_error" class="text-danger small mt-1" style="display: none;"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="c-password" name="password_confirmation" placeholder="Enter Confirm Password"
                                    value="" required autocomplete="new-password">
                                <label for="c-password">Confirm Password</label>
                            </div>
                            <div id="password_confirmation_error" class="text-danger small mt-1" style="display: none;"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="phone-no" name="phone" placeholder="Enter Phone No." value="" required>
                                <label for="phone-no">Phone No.</label>
                            </div>
                            <div id="phone_error" class="text-danger small mt-1" style="display: none;"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nid" name="nid" placeholder="Enter NID"
                                    value="" required>
                                <label for="nid">NID</label>
                            </div>
                            <div id="nid_error" class="text-danger small mt-1" style="display: none;"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="assign-department" name="department_id" aria-label="Floating label select example" required>
                                    <option value="" selected disabled>Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                <label for="assign-department">Assign Department</label>
                            </div>
                            <div id="department_id_error" class="text-danger small mt-1" style="display: none;"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="assign-role" name="role" aria-label="Floating label select example" required>
                                    <option value="" selected disabled>Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <label for="assign-role">Assign Role</label>
                            </div>
                            <div id="role_error" class="text-danger small mt-1" style="display: none;"></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="modal-footer border-0">
                    <div class="upload-btns">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-outline-secondary button-style">Close</button>
                        <button type="submit" class="btn btn-common-bg">Add New User</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalToggle4" aria-hidden="true" aria-labelledby="exampleModalToggle4"
     tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <h2 class="mb-3">Edit User</h2>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit-pageName" name="name" placeholder="Enter Name"
                                    value="" required>
                                <label for="edit-pageName">Name</label>
                            </div>
                            <div id="edit_name_error" class="text-danger small mt-1" style="display: none;"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit-email" name="email" placeholder="Enter Email"
                                    value="" readonly>
                                <label for="edit-email">Email</label>
                            </div>
                            <div id="edit_email_error" class="text-danger small mt-1" style="display: none;"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="edit-phone-no" name="phone" placeholder="Enter Phone No." value="" required>
                                <label for="edit-phone-no">Phone No.</label>
                            </div>
                            <div id="edit_phone_error" class="text-danger small mt-1" style="display: none;"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit-nid" name="nid" placeholder="Enter NID"
                                    value="" required>
                                <label for="edit-nid">NID</label>
                            </div>
                            <div id="edit_nid_error" class="text-danger small mt-1" style="display: none;"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="edit-assign-department" name="department_id" aria-label="Floating label select example" required>
                                    <option value="" selected disabled>Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                <label for="edit-assign-department">Assign Department</label>
                            </div>
                            <div id="edit_department_id_error" class="text-danger small mt-1" style="display: none;"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="edit-assign-role" name="role" aria-label="Floating label select example" required>
                                    <option value="" selected disabled>Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <label for="edit-assign-role">Assign Role</label>
                            </div>
                            <div id="edit_role_error" class="text-danger small mt-1" style="display: none;"></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="modal-footer border-0">
                    <div class="upload-btns">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-outline-secondary button-style">Close</button>
                        <button type="submit" class="btn btn-common-bg">Update User</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
