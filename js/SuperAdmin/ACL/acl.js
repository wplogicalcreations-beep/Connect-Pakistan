$("#addRoleForm").on("submit", function (e) {
    e.preventDefault();
    let form = this;
    let formData = new FormData(form);

    $.ajax({
        url: form.action,
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function (response) {
            if (response.success) {
                $("#no-record-row").hide();
                $("#rolesTable").prepend(response.row);
                $("#rolesTable tr").each(function(index){
                    $(this).find(".sr-number").text(index + 1);
                });
                $("#staticBackdropAdd").modal("hide");
                form.reset();
                showToast(response.message);
            } else {
                showToast(response.message);
            }
        },
        error: function (xhr) {
            let msg = "An error occurred while saving.";
            if (xhr.responseJSON && xhr.responseJSON.message) {
                msg = xhr.responseJSON.error;
            }
            showToast(msg, 'error');
        }
    });
});

$('#rolesTable').on('click', 'a[data-bs-target="#staticBackdrop"]', function () {
    const id = $(this).data('id');
    const name = $(this).data('name');
    const status = $(this).data('status');
    $('#editRoleForm').attr('action', '/acl/role/' + id);
    $('#editRoleName').val(name);
    $('#editRoleStatus').val(status);
});

$('#editRoleForm').on('submit', function (e) {
    e.preventDefault();
    const form = this;
    const formData = new FormData(form);

    $.ajax({
        url: form.action,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function (response) {
               if (response.success) {
                const row = $('#role-' + response.data.id);
                row.find('.role-name').text(response.data.name);
                let statusBadge = response.data.status == 1
                    ? '<span class="badge bg-success-2 p-2">Active</span>'
                    : '<span class="badge bg-danger p-2">Inactive</span>';

                row.find('.role-status').html(statusBadge);
                const dropdownItem = row.find('.dropdown-item[data-bs-target="#staticBackdrop"]');
                dropdownItem.data('name', response.data.name);
                dropdownItem.data('status', response.data.status);
                $('#staticBackdrop').modal('hide');
                showToast(response.message);
            } else {
                showToast(response.message);
            }
        },
        error: function (xhr) {
            let msg = 'An error occurred while updating.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                msg = xhr.responseJSON.error;
            }
            showToast(msg, 'error');
        }
    });
});

let deleteId = null;
$('#exampleModalToggle').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget);
    deleteId = button.data('id'); 
});
$('#confirmDeleteBtn').on('click', function () {
    if (!deleteId) return;
    $.ajax({
        url: "/acl/role/" + deleteId,
        type: "POST",
        data: { _method: 'DELETE' },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            $('#role-' + deleteId).remove();
            $('#exampleModalToggle').modal('hide');
            $('#exampleModalToggle').on('hidden.bs.modal', function () {
                $('#exampleModalToggle2').modal('show');
                setTimeout(() => $('#exampleModalToggle2').modal('hide'), 1500);
                $(this).off('hidden.bs.modal');
            });
            showToast(response.message);
            $('#rolesTable tr').each(function (index) {
                $(this).find('.sr-number').text(index + 1);
            });
            if ($('#rolesTable tr').length === 0) {
                $('#rolesTable').append('<tr id="no-record-row"><td colspan="16" class="text-center">No record found</td></tr>');
            }
            deleteId = null;
        },
        error: function (xhr) {
            $('#exampleModalToggle').modal('hide');
            showToast(xhr.responseJSON?.message || 'Failed to delete', 'error');
            deleteId = null;
        }
    });
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
                $("#rolesTable").html(response.html);

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

let sortDirection = {};
$(document).on('click', '.sortable', function() {
    const column = $(this).data('sort');
    const tableRows = $('#rolesTable tr:visible').toArray();
    sortDirection[column] = !sortDirection[column];
    tableRows.sort((a, b) => {
        const aText = $(a).find(`.${getClassForColumn(column)}`).text().toLowerCase().trim();
        const bText = $(b).find(`.${getClassForColumn(column)}`).text().toLowerCase().trim();

        if (aText < bText) return sortDirection[column] ? -1 : 1;
        if (aText > bText) return sortDirection[column] ? 1 : -1;
        return 0;
    });
    $('#rolesTable').append(tableRows);
    let counter = 1;
    $('#rolesTable tr:visible').each(function() {
        $(this).find('.sr-number').text(counter++);
    });
});
function getClassForColumn(column) {
    switch(column) {
        case 'name': return 'role-name';
        default: return '';
    }
}

$(document).on('change', '.form-select', function() {
    let perPage = $(this).val();
    let url = window.location.origin + window.location.pathname + '?per_page=' + perPage;
    fetchRoles(url);
});

function fetchRoles(url) {
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            $('#rolesTable').html($(response).find('#rolesTable').html());
            $('.pagination').html($(response).find('.pagination').html());
        },
        error: function() {
            alert('Failed to load data');
        }
    });
}

// Handle permissions modal
$(document).on('click', '.view-permissions-btn', function() {
    const roleName = $(this).data('role-name');
    const permissions = $(this).data('permissions');
    const permissionCount = $(this).data('permission-count');
    
    // Update modal title
    $('#permissionsRoleName').text(roleName);
    $('#permissionsCount').text(permissionCount);
    
    // Clear previous permissions
    $('#permissionsList').empty();
    $('#noPermissionsMessage').hide();
    
    // Display permissions
    if (permissions && permissions.length > 0) {
        permissions.forEach(function(permission) {
            const badge = $('<span>')
                .addClass('badge bg-primary p-2 mb-2')
                .css({
                    'font-size': '0.875rem',
                    'font-weight': 'normal'
                })
                .text(permission);
            $('#permissionsList').append(badge);
        });
    } else {
        $('#noPermissionsMessage').show();
    }
});