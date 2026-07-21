
let currentLovId = null;
let currentLovType = null;

// Open Add/Edit LOV Modal
$(document).on('click', '[data-bs-target="#lovModal"]', function () {
    currentLovId = $(this).data('id') || null;   // null = Add
    currentLovType = $(this).data('type') || null;

    // Set form values
    $('#lovTypeId').val(currentLovType);
    $('#lovName').val($(this).data('name') || '');

    // Update modal title
    $('#lovModalLabel').text(currentLovId ? 'Edit LOV' : 'Add New LOV');
});

$('#saveLovBtn').on('click', function () {
    let formData = new FormData($('#lovForm')[0]);
    let url = currentLovId ? '/lov/update/' + currentLovId : '/lov/store/' + currentLovType;

    if (currentLovId) {
        formData.append('_method', 'PUT'); // Laravel PUT override
    }

    $.ajax({
        url: url,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success) {
                $('#lovForm')[0].reset();
                $('#lovModal').modal('hide');
                
                // Show SweetAlert success message
                if (typeof Swal !== 'undefined') {
                    const action = currentLovId ? 'updated' : 'created';
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: `LOV has been ${action} successfully.`,
                        confirmButtonColor: '#198754',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
                
                currentLovId = null;
                
                // Refresh the current page with pagination to show all entries
                refreshLovsTable();
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            
            // Show error alert
            if (typeof Swal !== 'undefined') {
                let errorMessage = 'Failed to save LOV. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    // Handle validation errors
                    const errors = xhr.responseJSON.errors;
                    const firstError = Object.values(errors)[0];
                    errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                    confirmButtonColor: '#dc3545'
                });
            }
        }

    });
});

// Function to refresh LOVs table with current pagination
function refreshLovsTable() {
    // Get the type from currentLovType or from URL
    const type = currentLovType || new URLSearchParams(window.location.search).get('type');
    
    if (!type) {
        // Try to get from active sidebar item
        const activeType = $('.lov-type-list li.active a').data('type');
        if (activeType) {
            currentLovType = activeType;
        } else {
            console.warn('Cannot refresh: No type found');
            return;
        }
    }
    
    // Use the baseUrl and category from the page (defined in index.blade.php)
    if (typeof baseUrl === 'undefined' || typeof category === 'undefined') {
        console.warn('Cannot refresh: baseUrl or category not defined');
        return;
    }
    
    // Get current pagination parameters from URL
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page') || 1;
    const perPage = urlParams.get('per_page') || $('.per-page-select').val() || 10;
    
    // Build refresh URL with current pagination
    const refreshUrl = baseUrl + '?type=' + type + '&page=' + page + '&per_page=' + perPage;
    
    // Make AJAX call to refresh the table
    $.ajax({
        url: refreshUrl,
        type: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
            if (response.success) {
                $("#lovsTable").html(response.html);
                if (response.pagination) {
                    $('.pagination-container').replaceWith(response.pagination);
                }
            }
        },
        error: function() {
            console.error('Failed to refresh LOVs table');
        }
    });
}

// Open Delete Modal
$(document).on('click', '.delete-lov', function () {
    $('#confirmDeleteBtn').data('id', $(this).data('id'));
    $('#confirmDeleteBtn').data('type', $(this).data('type'));

    $('#deleteMessage').text(
        `Are you sure you want to delete this ${$(this).data('type')}?`
    );
});

// Confirm Delete
$(document).on('click', '#confirmDeleteBtn', function () {
    let id = $(this).data('id');

    if (id) {
        $.ajax({
            url: '/lov/delete/' + id,
            type: 'DELETE',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function (response) {
                if (response.success) {
                    $('#lovDeleteModal').modal('hide');
                    $('#lovSuccessModal').modal('show');
                    $('#lov-' + id).remove();

                } else {
                    showToast("Delete failed.");
                }
            },
            error: function () {
                showToast('Something went wrong.');
            }
        });
    }
});



// Pagination link click handle
$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    let url = $(this).attr("href");

    $.ajax({
        url: url,
        type: "GET",
        beforeSend: function () {
            $("#table-container").addClass("loading");
        },
        success: function (response) {
            if (response.success) {
                // update table rows
                $("#lovsTable").html(response.html);

                // update pagination component
                $(".pagination-container").replaceWith(response.pagination);

            }
        },
        complete: function () {
            $("#table-container").removeClass("loading");
        },
        error: function () {
            alert("Pagination fetch error!");
        }
    });
});


// per-page change (AJAX)
$(document).on("change", ".per-page-select", function () {
    let perPage = $(this).val();
    let url = "?per_page=" + perPage;

    $.ajax({
        url: url,
        type: "GET",
        beforeSend: function () {
            $("#table-container").addClass("loading");
        },
        success: function (response) {
            if (response.success) {
                // update table rows
                $("#lovsTable").html(response.html);

                // update pagination with new info
                $(".pagination-container").replaceWith(response.pagination);
            }
        },
        complete: function () {
            $("#table-container").removeClass("loading");
        },
        error: function () {
            alert("Per-page change error!");
        }
    });
});


$(document).ready(function () {
    // Search input event
    $('#searchInput').on('keyup', function () {
        let search = $(this).val();
        let url = window.location.href;

        $.ajax({
            url: url,
            type: 'GET',
            data: {name: search},
            success: function (response) {
                if (response.success) {
                    // update table rows
                    $("#lovsTable").html(response.html);

                    // update pagination with new info
                    $(".pagination-container").replaceWith(response.pagination);

                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});

$(document).on("click", ".sort", function () {
    let sortBy = $(this).data("sort");
    let currentOrder = $(this).data("order") || "asc";
    let newOrder = currentOrder === "asc" ? "desc" : "asc";
    let perPage = $("select[name='per_page']").val() || 10;
    let url = window.location.pathname;

    $.ajax({
        url: url,
        type: "GET",
        data: {
            sort_by: sortBy,
            sort_order: newOrder,
            per_page: perPage
        },
        success: function (response) {
            if (response.success) {
                $("#lovsTable").html(response.html);
                $(".pagination-container").replaceWith(response.pagination);
            }
        }
    });

    $(this).data("order", newOrder); // toggle order
});

// Handle toggle switch for status updates
$(document).on('change', '.toggle-switch', function(e) {
    e.stopPropagation(); // Prevent event bubbling
    
    let toggle = $(this);
    let url = toggle.data('url');
    let status = toggle.is(':checked') ? 1 : 0;
    let icon = toggle.next('label').find('i');
    let statusText = status ? 'activated' : 'deactivated';

    // Immediately update icon
    icon.toggleClass('fa-toggle-on fa-toggle-off text-success text-secondary');

    if (!url) return;

    // Create form data with _method override for PUT
    let formData = new FormData();
    formData.append('status_id', status);
    formData.append('_method', 'PUT');

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        beforeSend: function() {
            toggle.prop('disabled', true);
        },
        success: function(response) {
            if (response.success) {
                // Show SweetAlert on success
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Status Updated!',
                        text: 'Status has been ' + statusText + ' successfully.',
                        confirmButtonColor: '#198754',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }
        },
        error: function(xhr) {
            // Revert toggle on error
            toggle.prop('checked', !status);
            icon.toggleClass('fa-toggle-on fa-toggle-off text-success text-secondary');
            
            // Show error alert
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: xhr.responseJSON?.message || 'Failed to update status. Please try again.',
                    confirmButtonColor: '#dc3545'
                });
            } else {
                console.error('Failed to update status:', xhr.responseJSON);
            }
        },
        complete: function() {
            toggle.prop('disabled', false);
        }
    });
});

