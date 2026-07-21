@props([
    'modalId' => 'globalDeleteModal',
    'successModalId' => 'globalDeleteSuccessModal',
])

<!-- Global Delete Confirmation Modal -->
<div class="modal fade" id="{{ $modalId }}" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h5 class="fw-bold">Are you sure you want to delete this?</h5>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-outline-secondary mb-3" data-bs-dismiss="modal">No</button>
                <button type="button"
                        class="btn btn-dark mb-3 confirm-delete"
                        data-url=""
                        data-row-id=""
                        data-success-modal="#{{ $successModalId }}"
                        data-bs-dismiss="modal">
                    Yes
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="{{ $successModalId }}" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center my-4">
                <h5 class="fw-bold">
                    Deleted Successfully 
                    <img src="{{ asset('images/tick-mark.svg') }}" alt="Tick Mark">
                </h5>
            </div>
        </div>
    </div>
</div>
