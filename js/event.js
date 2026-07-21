// Setup CSRF token for all AJAX requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Enroll button click
$(document).on('click', '.enroll-btn', function (e) {
    e.preventDefault();

    let $btn = $(this); // store the clicked button
    let url = $(this).data('url');
    let eventId = $(this).data('event-id');

    $.ajax({
        url: url,
        method: 'POST',
        data: { event_id: eventId },
        success: function (response) {
            Swal.fire({
                icon: 'success',
                title: 'Enrolled!',
                text: response.message ?? "Successfully enrolled!",
                confirmButtonColor: '#28a745'
            });
            $btn.addClass('d-none'); // hide "Enroll Now →" button
            $('.not-interested-btn').addClass('d-none'); // hide "Not Interested" button
            $('.enrolled-btn').removeClass('d-none'); // show "Enrolled" button
        },
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Something went wrong",
                confirmButtonColor: '#dc3545'
            });
        }
    });
});
