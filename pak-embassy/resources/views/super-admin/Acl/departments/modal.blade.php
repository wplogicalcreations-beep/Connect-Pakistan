<!-- Modal for Add -->
<div class="modal fade" id="staticBackdropAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-dark" id="staticBackdropAddLabel">Add New Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addDepartmentForm" action="{{ route('departments.store') }}" method="POST">
                <div class="modal-body my-4">
                    <div class="form-floating">
                        <div class="add-new-dep">
                            <input type="text" id="floatingSelect" name="name" class="form-control" placeholder="Enter Department Name" required>
                            <label for="floatingSelect">Department Name</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary my-3 button-style"
                            data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-common-bg my-3">Add New Department</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal for status change -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-dark" id="staticBackdropLabel">Edit Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editDepartmentForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body my-4">
                    <div class="form-floating">
                        <input type="text" name="name" id="editDepartmentName" class="form-control" placeholder="Department Name" required>
                        <label for="editDepartmentName">Department Name</label>
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
                <button type="button" class="btn btn-outline-secondary mb-3 button-style" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-dark mb-3 confirm-delete-btn" id="confirmDeleteBtn">Yes</button>
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
