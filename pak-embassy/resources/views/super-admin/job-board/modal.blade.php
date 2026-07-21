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
<div class="modal fade" id="changeStatusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="changeStatusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-dark" id="changeStatusLabel">Change Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="updateStatusForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="job_id" name="job_id"> <!-- hidden job id -->

                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="form-floating">
                                <select class="form-select" id="status-dropdown" name="status_id" aria-label="Floating label select example">
                                    <option value="" disabled hidden>Select Status</option>
                                </select>
                                <label for="status-dropdown">Status</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary my-3 button-style"
                            data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark my-3">Update</button>
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
                <button type="button" class="btn btn-dark mb-3" data-bs-target="#exampleModalToggle2"
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
