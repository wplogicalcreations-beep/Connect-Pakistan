<!-- Add / Edit LOV Modal -->
<div class="modal fade" id="lovModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="lovModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-dark" id="lovModalLabel">Add New</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="lovForm">
                @csrf
                <input type="hidden" name="id" id="lovId">
                <input type="hidden" name="lov_type_id" id="lovTypeId">

                <div class="modal-body my-4">
                    <div class="form-floating">
                        <input type="text" name="name" id="lovName" class="form-control" placeholder="Name" required>
                        <label for="lovName" id="lovLabel">Name</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary my-3 button-style"
                            data-bs-dismiss="modal">Close</button>
                    <a class="btn btn-common-bg my-3" id="saveLovBtn">Save</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="lovDeleteModal" aria-hidden="true" aria-labelledby="lovDeleteModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h5 class="fw-bold" id="deleteMessage">Are you sure you want to delete this?</h5>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-outline-secondary mb-3 button-style" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-dark mb-3" id="confirmDeleteBtn">Yes</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="lovSuccessModal" aria-hidden="true" aria-labelledby="lovSuccessModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center my-4">
                <h5 class="fw-bold">Deleted Successfully
                    <img src="{{asset('images/tick-mark.svg')}}" alt="Tick Mark">
                </h5>
            </div>
        </div>
    </div>
</div>

