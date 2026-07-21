<div class="modal fade" id="joinAs" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-transparent border-0">
                <h1 class="modal-title fs-5">Join as</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-3 pt-0">

                <!-- Skilled Individual -->
                <div class="card-design1"
                     style="padding:20px;border:1px solid #ddd;border-radius:10px;margin-bottom:15px;cursor:pointer;"
                     onclick="window.location.href='{{ route('register.individual.signup') }}'">
                    <h3>I am a Skilled Individual</h3>
                    <p class="mb-0">Looking for an opportunity.</p>
                </div>

                <!-- Organization -->
                <div class="card-design2"
                     style="padding:20px;border:1px solid #ddd;border-radius:10px;margin-bottom:15px;cursor:pointer;"
                     onclick="window.location.href='{{ url('organization-signup') }}'">
                    <h3>I am an Organization</h3>
                    <p class="mb-0">Looking to hire talent & provide opportunities.</p>
                </div>

            </div>
        </div>
    </div>
</div>