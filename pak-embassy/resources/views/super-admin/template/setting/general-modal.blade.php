<!-- General Description Modal -->
<div class="modal fade sidepanel sidepanel-custom" id="myGeneralModel" tabindex="-1" aria-labelledby="generalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#198754; color:white">
                <h5 class="modal-title" id="generalModalLabel">Edit Description</h5>
                <button type="button" class="btn-close btn-close-white closebtnmodal" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body p-0">
                    <!-- Tab panes -->
                    <div class="tab-content text-center">
                        <div class="tab-pane active general_model_data" id="desc-detail" role="tabpanel">
                            <textarea class="ckeditor form-control" name="general_model_desc" id="" placeholder="hell" rows="6"></textarea>
                            <div class="p-3 text-end">
                                <button type="button" class="btn btn-theme" id="done_typing"
                                    style="background-color:#198754; color:white">{{ __('Apply') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Button Details Modal -->
<div class="modal fade sidepanel sidepanel-custom" id="myButtonModel" tabindex="-1" aria-labelledby="buttonModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#198754; color:white">
                <h5 class="modal-title" id="buttonModalLabel">Edit Button Details</h5>
                <button type="button" class="btn-close btn-close-white closebtnmodal" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-0">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs nav-tabs-neutral " role="tablist" data-background-color="theme">
                            <li class="nav-item active">
                                <a class="nav-link text-dark" data-toggle="tab" href="#btn-detail"
                                    role="tab">{{ __('edit_btn_details') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-0">
                        <!-- Tab panes -->
                        <div class="tab-content text-center">
                            <div class="tab-pane p-3 active button_model_data" id="btn-detail" role="tabpanel">
                                <div class="row align-items-left">
                                    <div class="form-group text-start">
                                        <label>{{ __('btn_text') }}</label>
                                        <input type="text" class="form-control" id=""
                                            name="general_btn_text" placeholder="" value="" />
                                    </div>
                                    <div class="form-group text-start">
                                        <label>{{ __('btn_url') }}</label>
                                        <input type="text" id="" class="form-control" name="general_btn_url"
                                            value="" />
                                    </div>
                                    <div class="form-group p-3 text-end">
                                        <button type="button" class="btn btn-theme"
                                            id="done_btn_details" style="background-color:#198754; color:white">{{ __('Apply') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
