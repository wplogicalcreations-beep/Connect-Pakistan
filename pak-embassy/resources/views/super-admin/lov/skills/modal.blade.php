<!-- Modal for Add -->
<div class="modal fade" id="staticBackdropAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-dark" id="staticBackdropAddLabel">Add New Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addSkillForm">
                <div class="modal-body my-4">
                    <div class="form-floating mb-3">
                        <div class="add-new-dep">
                            <input type="text" id="floatingSelect" name="name" class="form-control" placeholder="Name" required>
                            <label for="floatingSelect">Skill Name</label>
                        </div>
                    </div>
                    <!-- Type field is hidden and auto-set from URL category -->
                    <input type="hidden" name="type" id="skillType" required>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-outline-secondary my-3 button-style"
                            data-bs-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-common-bg my-3">Add New Skill</button>
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
                <h5 class="modal-title text-dark" id="staticBackdropLabel">Edit Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editSkillForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body my-4">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" id="editSkillName" class="form-control" placeholder="Skill Name" required>
                        <label for="editSkillName">Skill Name</label>
                    </div>
                    <div class="form-floating">
                        <select name="type" id="editSkillType" class="form-select" required>
                            <option value="">Select Type</option>
                            <option value="individual">Individual</option>
                            <option value="business">Business</option>
                        </select>
                        <label for="editSkillType">Type <span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary my-3 button-style"
                            data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark my-3" id="saveSkillBtn">Save</button>
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
                <h5 class="fw-bold">Deleted Successfully <img src="{{asset('images/tick-mark.svg')}}" alt="Tick Mark"></h5>
            </div>
        </div>
    </div>
</div>
