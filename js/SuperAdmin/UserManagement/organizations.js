function approveOrDeclineOrganization(orgId, action, event) {
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }
    
    // Close dropdown if open
    $('.dropdown-menu').removeClass('show');
    $('.dropdown-toggle').attr('aria-expanded', 'false');
    
    const actionText = action === 'approve' ? 'approve' : 'decline';
    const actionTitle = action === 'approve' ? 'Approve' : 'Decline';
    const confirmText = action === 'approve' 
        ? 'Are you sure you want to approve this organization?' 
        : 'Are you sure you want to decline this organization?';
    const confirmButtonText = action === 'approve' ? 'Yes, Approve' : 'Yes, Decline';
    const icon = action === 'approve' ? 'question' : 'warning';
    const confirmButtonColor = action === 'approve' ? '#198754' : '#dc3545';

    Swal.fire({
        title: actionTitle + ' Organization?',
        text: confirmText,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: confirmButtonColor,
        cancelButtonColor: '#6c757d',
        confirmButtonText: confirmButtonText,
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            updateOrganizationStatus(orgId, action);
        }
    });
    
    return false;
}

function updateOrganizationStatus(orgId, action) {
    // Ensure orgId and action are valid
    if (!orgId || !action) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Invalid organization ID or action.',
            confirmButtonColor: '#dc3545'
        });
        return;
    }

    // Convert orgId to integer to ensure proper type
    const orgIdInt = parseInt(orgId);
    const actionStr = String(action).trim();
    
    // Debug: Log the data being sent
    console.log('Sending data - orgId:', orgIdInt, 'action:', actionStr);

    // Prepare data object
    const requestData = {
        org_id: orgIdInt,
        action: actionStr
    };

    $.ajax({
        url: "/organizations/update-status",
        type: "POST",
        data: requestData,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            "X-Requested-With": "XMLHttpRequest"
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                // Update status badge
                const badge = response.is_verified == 1
                    ? '<span class="badge bg-success p-2">Approved</span>'
                    : '<span class="badge bg-info p-2">Pending</span>';
                $("#org-status-" + orgIdInt).html(badge);

                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    confirmButtonColor: '#198754',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        },
        error: function (xhr) {
            let errorMsg = 'Error updating organization status.';
            if (xhr.responseJSON) {
                if (xhr.responseJSON.errors) {
                    // Handle validation errors
                    const errors = Object.values(xhr.responseJSON.errors).flat();
                    errorMsg = errors.join(', ');
                } else if (xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
            } else if (xhr.status === 422) {
                errorMsg = 'Validation failed. Please check the data.';
            }
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: errorMsg,
                confirmButtonColor: '#dc3545'
            });
        }
    });
}


let deleteId = null;
$('#exampleModalToggle').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget);
    deleteId = button.data('id'); 
});
$('#confirmDeleteBtn').on('click', function () {
    if (!deleteId) return;
    let finalUrl = deleteUrl.replace(':id', deleteId);
    $.ajax({
        url: finalUrl,
        type: "POST",
        data: { _method: 'DELETE' },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            $('#organization-user-' + deleteId).remove();
            $('#exampleModalToggle').modal('hide');
            $('#exampleModalToggle').on('hidden.bs.modal', function () {
                $('#exampleModalToggle2').modal('show');
                setTimeout(() => $('#exampleModalToggle2').modal('hide'), 1500);
                $(this).off('hidden.bs.modal');
            });
            showToast(response.message);
            $('#organizationUsersTable tr').each(function (index) {
                $(this).find('.sr-number').text(index + 1);
            });
            if ($('#organizationUsersTable tr').length === 0) {
                $('#organizationUsersTable').append('<tr id="no-record-row"><td colspan="16" class="text-center">No record found</td></tr>');
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

$(document).on('click', '#sendInviteBtn', function(e) {
    e.preventDefault();
    let form = $('#inviteOrganizationForm')[0];
    let formData = new FormData(form);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: inviteUrl,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            showToast(response.message);
            $('#exampleModalToggle3').modal('hide');
            $('#inviteOrganizationForm')[0].reset();
        },
        error: function(xhr) {
            let errorMsg = xhr.responseJSON?.message ?? 'Something went wrong!';
            showToast(errorMsg);
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
                $("#organizationUsersTable").html(response.html);

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
    const tableRows = $('#organizationUsersTable tr:visible').toArray();
    sortDirection[column] = !sortDirection[column];
    tableRows.sort((a, b) => {
        const aText = $(a).find(`.${getClassForColumn(column)}`).text().toLowerCase().trim();
        const bText = $(b).find(`.${getClassForColumn(column)}`).text().toLowerCase().trim();

        if (aText < bText) return sortDirection[column] ? -1 : 1;
        if (aText > bText) return sortDirection[column] ? 1 : -1;
        return 0;
    });
    $('#organizationUsersTable').append(tableRows);
    let counter = 1;
    $('#organizationUsersTable tr:visible').each(function() {
        $(this).find('.sr-number').text(counter++);
    });
});
function getClassForColumn(column) {
    switch(column) {
        case 'name': return 'org-name';
        case 'type': return 'org-type';
        case 'count': return 'org-staff';
        case 'domain': return 'org-lovs';
        case 'ceo-name': return 'ceo-name';
        case 'register-date': return 'created_at';
        case 'status': return 'org-status';
        default: return '';
    }
}

function exportTable(format) {
    let tableRows = [];
    $('#organizationUsersTable tr:visible').each(function() {
        let row = [];
        $(this).find('td').not(':last').each(function() {
            row.push($(this).text().trim());
        });
        if(row.length) tableRows.push(row);
    });

    if(format === 'excel') {
        let wb = XLSX.utils.book_new();
        let ws = XLSX.utils.aoa_to_sheet(tableRows);
        XLSX.utils.book_append_sheet(wb, ws, "Organizations");
        XLSX.writeFile(wb, "organizations.xlsx");
    }

    if(format === 'pdf') {
        const { jsPDF } = window.jspdf;
        let doc = new jsPDF();
        doc.autoTable({
            head: [['Sr', 'Organization Name', 'Type', 'Head Count', 'Domain', 'Name of CEO', 'Register Date', 'Status']],
            body: tableRows
        });
        doc.save('organizations.pdf');
    }

    if(format === 'print') {
        let printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Organizations</title></head><body><table border="1">');
        tableRows.forEach(row => {
            printWindow.document.write('<tr>');
            row.forEach(cell => printWindow.document.write('<td>' + cell + '</td>'));
            printWindow.document.write('</tr>');
        });
        printWindow.document.write('</table></body></html>');
        printWindow.document.close();
        printWindow.print();
    }
}
$('#exportExcel').on('click', () => exportTable('excel'));
$('#exportPDF').on('click', () => exportTable('pdf'));
$('#exportPrint').on('click', () => exportTable('print'));

$(document).on('change', '.form-select', function() {
    let perPage = $(this).val();
    let url = window.location.origin + window.location.pathname + '?per_page=' + perPage;
    fetchOrganizations(url);
});

function fetchOrganizations(url) {
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            $('#organizationUsersTable').html($(response).find('#organizationUsersTable').html());
            $('.pagination').html($(response).find('.pagination').html());
        },
        error: function() {
            // alert('Failed to load data');
        }
    });
}