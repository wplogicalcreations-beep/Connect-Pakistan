@extends("layouts.master")
@section("content")
    <div class="page-title">
        <h3>Events</h3>
    </div>
    <div class="card border-0 py-3 px-2">
        <div class="row">
            @include('super-admin.events.__filters')

            @include('super-admin.events.__table')
        </div>
    </div>

@endsection
@section("js-file")
    <script src="{{asset('js/jquery/ckeditor.js')}}"></script>
    <script src="{{ asset('js/SuperAdmin/events-management.js') }}"></script>
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
            }, {once: true}); // Ensure the event listener runs only once
        });

        const ckEditors = {}; // store CKEditor instances

        function loadMinutes(eventId, viewOnly = false) {
            const viewDiv = document.getElementById(`minutes-content-${eventId}`);
            const textarea = document.getElementById(`minutes-${eventId}`);
            const url = "{{ route('events.view-minutes', ['event' => ':id']) }}".replace(':id', eventId);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const minutes = data.minutes ?? null;

                    if (viewOnly && viewDiv) {
                        viewDiv.innerHTML = minutes ?? "No minutes of meeting found. Please create MOM to view.";
                    } else if (!viewOnly && textarea) {
                        // Initialize or update CKEditor
                        if (!ckEditors[eventId]) {
                            ClassicEditor.create(textarea)
                                .then(editor => {
                                    ckEditors[eventId] = editor;
                                    editor.setData(minutes);
                                })
                                .catch(err => console.error(err));
                        } else {
                            ckEditors[eventId].setData(minutes);
                        }
                    }
                })
                .catch(err => {
                    console.error(err);
                    if (viewOnly && viewDiv) viewDiv.innerHTML = 'Failed to load minutes.';
                    if (!viewOnly && textarea) textarea.value = 'Failed to load minutes.';
                });
        }

        function submitMinutes(eventId, url) {
            const editor = ckEditors[eventId];
            if (!editor) {
                alert('Editor not initialized.');
                return;
            }

            const minutes = editor.getData().trim();
            if (!minutes) {
                alert('Please enter the minutes.');
                return;
            }

            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
            formData.append('event_mom_detail', minutes);
            formData.append('event_id', eventId);

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(() => {
                $(`#minutesModal-${eventId}-edit`).modal('hide');
                showToast("Minutes saved successfully!");
            })
            .catch(err => {
                console.error(err);
                showToast("Error saving minutes.");
            });
        }


    </script>

@endsection
