
<!-- Modal for Add -->
<div class="modal fade" id="staticBackdropAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-dark" id="staticBackdropAddLabel">Add New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addRoleForm" action="{{ route('acl.storeRole') }}" method="POST">
                <div class="modal-body my-4">
                    <div class="form-floating">
                        <div class="add-new-dep">
                            <input type="text" id="floatingSelect" name="name" class="form-control" placeholder="Enter Role Name" required>
                            <label for="floatingSelect">Role Name</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary my-3 button-style"
                            data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-common-bg my-3">Add New Role</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Edit -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-dark" id="staticBackdropLabel">Edit Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editRoleForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body my-4">
                    <div class="form-floating">
                        <input type="text" name="name" id="editRoleName" class="form-control" placeholder="Role Name" value="" required>
                        <label for="editRoleName">Role Name</label>
                    </div>
                </div>
                <div class="modal-body my-4">
                    <div class="form-floating">
                        <select name="status" id="editRoleStatus" class="form-select" required>
                            <option value="" disabled selected>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <label for="editRoleStatus">Status</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary my-3 button-style"
                            data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark my-3">Save</button>
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

<!-- Modal for View Permissions -->
<div class="modal fade" id="viewPermissionsModal" aria-hidden="true" aria-labelledby="viewPermissionsModalLabel"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-dark fw-bold" id="viewPermissionsModalLabel">
                    <span id="permissionsRoleName"></span> - Permissions
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body my-4">
                <div class="mb-3">
                    <small class="text-muted">
                        <span id="permissionsCount"></span> permission(s) assigned
                    </small>
                </div>
                <div id="permissionsList" class="d-flex flex-wrap gap-2">
                    <!-- Permissions will be dynamically inserted here -->
                </div>
                <div id="noPermissionsMessage" class="text-center text-muted py-4" style="display: none;">
                    <p>No permissions assigned to this role.</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary my-3 button-style"
                        data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
