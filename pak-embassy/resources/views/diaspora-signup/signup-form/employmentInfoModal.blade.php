<!-- Step 1 Modal -->
<div class="modal fade" id="step2Modal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title">Employment Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <form id="modal-form-step2">
                     @csrf
                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Level</label>
                            <select name="level_id" class="form-select text-dark">
                                <option class="text-mute" disabled selected value="">Select Level</option>
                                @foreach($levels as $level)
                                <option class="text-dark" value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                            <div id="level_id_error" class="text-danger small"></div>
                        </div>

                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Influence Ability</label>
                            <select name="influence_ability_id" class="form-select text-dark">
                                <option class="text-mute" disabled selected value="">Select Influence Ability</option>
                                @foreach($influence_abilities as $influence_ability)
                                <option class="text-dark" value="{{ $influence_ability->id }}">{{ $influence_ability->name }}</option>
                                @endforeach
                            </select>
                            <div id="influence_ability_id_error" class="text-danger small"></div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" form="form-step2" onclick="modalUpdations(2)" class="btn btn-primary">Update</button>
            </div>

        </div>
    </div>
</div>