@extends("layouts.master")
@section("content")
    <div class="page-title">
        <h3>Skills</h3>
    </div>
    <div class="card border-0 py-3 px-2">
        <div class="row">
            @include('super-admin.lov.skills.__filters')

            @include('super-admin.lov.skills.__table')
        </div>
    </div>

@endsection
@section("js-file")
    <script src="{{ asset('js/skill.js') }}"></script>
    <script>
        document.querySelector('.btn[data-bs-target="#exampleModalToggle2"]').addEventListener('click', function () {
            const modalElement = document.getElementById('exampleModalToggle2');

            // Wait for the modal to be fully shown
            modalElement.addEventListener('shown.bs.modal', function () {
                setTimeout(function () {
                    const modal = bootstrap.Modal.getInstance(modalElement); // Get the current modal instance
                    if (modal) {
                        modal.hide(); // Close the modal
                    }
                }, 1500); // Close after 2 seconds
            }, { once: true }); // Ensure the event listener runs only once
        });
    </script>

@endsection
