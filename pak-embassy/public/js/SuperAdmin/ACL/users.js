// Function to clear all error messages
function clearFormErrors(formId) {
    $(formId + ' .text-danger').hide().text('');
    $(formId + ' .form-control, ' + formId + ' .form-select').removeClass('is-invalid');
}

// Function to check if form has any errors
function hasFormErrors(formId) {
    const visibleErrors = $(formId + ' .text-danger:visible').filter(function() {
        return $(this).text().trim().length > 0;
    });
    const invalidFields = $(formId + ' .is-invalid');
    return visibleErrors.length > 0 || invalidFields.length > 0;
}

// Function to display field errors
function displayFieldErrors(errors, formId) {
    // Determine if this is edit form (has 'edit' prefix)
    const isEditForm = formId === '#editUserForm';
    const errorPrefix = isEditForm ? 'edit_' : '';
    
    $.each(errors, function(field, messages) {
        const errorMessage = Array.isArray(messages) ? messages[0] : messages;
        const fieldInput = $(formId + ' [name="' + field + '"]');
        const errorDivId = errorPrefix + field + '_error';
        const errorDiv = $(formId + ' #' + errorDivId);
        
        if (fieldInput.length) {
            fieldInput.addClass('is-invalid');
            if (errorDiv.length) {
                errorDiv.text(errorMessage).css({
                    'display': 'block',
                    'visibility': 'visible',
                    'opacity': '1',
                    'color': '#dc3545',
                    'font-size': '0.875rem',
                    'margin-top': '0.25rem'
                });
            } else {
                // Create error div if it doesn't exist
                const errorDivHtml = '<div id="' + errorDivId + '" class="text-danger small mt-1" style="display: block !important; visibility: visible !important; opacity: 1 !important; color: #dc3545 !important; font-size: 0.875rem !important; margin-top: 0.25rem !important;">' + errorMessage + '</div>';
                fieldInput.closest('.col-md-6, .col-md-12').append(errorDivHtml);
            }
        }
    });
}

// Frontend validation function
function validateUserForm(formId) {
    let isValid = true;
    const isEditForm = formId === '#editUserForm';
    const errorPrefix = isEditForm ? 'edit_' : '';
    
    // Clear previous errors first
    clearFormErrors(formId);
    
    // Validate name
    const name = $(formId + ' [name="name"]').val().trim();
    if (!name) {
        showFieldError(formId, 'name', 'Name is required', errorPrefix);
        isValid = false;
    }
    
    // Validate email (only for add form)
    if (!isEditForm) {
        const email = $(formId + ' [name="email"]').val().trim();
        if (!email) {
            showFieldError(formId, 'email', 'Email is required', errorPrefix);
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showFieldError(formId, 'email', 'Please enter a valid email address', errorPrefix);
            isValid = false;
        }
    }
    
    // Validate password (only for add form)
    if (!isEditForm) {
        const password = $(formId + ' [name="password"]').val();
        if (!password) {
            showFieldError(formId, 'password', 'Password is required', errorPrefix);
            isValid = false;
        } else if (password.length < 6) {
            showFieldError(formId, 'password', 'Password must be at least 6 characters', errorPrefix);
            isValid = false;
        }
        
        // Validate password confirmation
        const passwordConfirmation = $(formId + ' [name="password_confirmation"]').val();
        if (!passwordConfirmation) {
            showFieldError(formId, 'password_confirmation', 'Please confirm your password', errorPrefix);
            isValid = false;
        } else if (password !== passwordConfirmation) {
            showFieldError(formId, 'password_confirmation', 'Passwords do not match', errorPrefix);
            isValid = false;
        }
    }
    
    // Validate phone
    const phone = $(formId + ' [name="phone"]').val().trim();
    if (!phone) {
        showFieldError(formId, 'phone', 'Phone number is required', errorPrefix);
        isValid = false;
    } else if (!/^9665\d{8}$/.test(phone)) {
        showFieldError(formId, 'phone', 'Phone must start with 9665 and be 12 digits (e.g., 966512345678)', errorPrefix);
        isValid = false;
    }
    
    // Validate NID
    const nid = $(formId + ' [name="nid"]').val().trim();
    if (!nid) {
        showFieldError(formId, 'nid', 'NID is required', errorPrefix);
        isValid = false;
    } else if (!/^\d{10}$/.test(nid)) {
        showFieldError(formId, 'nid', 'NID must be exactly 10 digits', errorPrefix);
        isValid = false;
    } else if (!/^[1-3]/.test(nid)) {
        showFieldError(formId, 'nid', 'NID must start with 1, 2, or 3', errorPrefix);
        isValid = false;
    }
    
    // Validate department
    const departmentId = $(formId + ' [name="department_id"]').val();
    if (!departmentId) {
        showFieldError(formId, 'department_id', 'Please select a department', errorPrefix);
        isValid = false;
    }
    
    // Validate role
    const role = $(formId + ' [name="role"]').val();
    if (!role) {
        showFieldError(formId, 'role', 'Please select a role', errorPrefix);
        isValid = false;
    }
    
    return isValid;
}

// Helper function to show field error
function showFieldError(formId, fieldName, message, errorPrefix) {
    const fieldInput = $(formId + ' [name="' + fieldName + '"]');
    const errorDivId = errorPrefix + fieldName + '_error';
    const errorDiv = $(formId + ' #' + errorDivId);
    
    if (fieldInput.length) {
        fieldInput.addClass('is-invalid');
        if (errorDiv.length) {
            errorDiv.text(message).css({
                'display': 'block',
                'visibility': 'visible',
                'opacity': '1',
                'color': '#dc3545',
                'font-size': '0.875rem',
                'margin-top': '0.25rem'
            });
        } else {
            const errorDivHtml = '<div id="' + errorDivId + '" class="text-danger small mt-1" style="display: block !important; visibility: visible !important; opacity: 1 !important; color: #dc3545 !important; font-size: 0.875rem !important; margin-top: 0.25rem !important;">' + message + '</div>';
            fieldInput.closest('.col-md-6, .col-md-12').append(errorDivHtml);
        }
    }
}

// Function to mask NID (show asterisks for all but last 4 digits)
function maskNid(nid) {
    if (!nid || nid.length < 4) return nid;
    const nidStr = String(nid);
    const last4 = nidStr.slice(-4);
    const masked = '*'.repeat(Math.max(0, nidStr.length - 4));
    return masked + last4;
}

$("#addUserForm").on("submit", function (e) {
    e.preventDefault();
    let form = this;
    
    // Frontend validation - prevent submission if errors exist
    if (!validateUserForm('#addUserForm')) {
        // Scroll to first error
        const firstError = $('#addUserForm .is-invalid').first();
        if (firstError.length) {
            $('html, body').animate({
                scrollTop: firstError.offset().top - 100
            }, 500);
        }
        return false;
    }
    
    // Check if there are any existing errors
    if (hasFormErrors('#addUserForm')) {
        return false;
    }
    
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
                $("#usersTable").prepend(response.row);
                $("#usersTable tr").each(function(index){
                    $(this).find(".sr-number").text(index + 1);
                });
                $("#exampleModalToggle3").modal("hide");
                form.reset();
                clearFormErrors('#addUserForm');
                showToast(response.message);
            } else {
                showToast(response.message);
            }
        },
        error: function (xhr) {
            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                // Display validation errors under fields
                displayFieldErrors(xhr.responseJSON.errors, '#addUserForm');
                // Scroll to first error
                const firstError = $('#addUserForm .is-invalid').first();
                if (firstError.length) {
                    $('html, body').animate({
                        scrollTop: firstError.offset().top - 100
                    }, 500);
                }
            } else {
                let msg = "An error occurred while saving.";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                showToast(msg, 'error');
            }
        }
    });
});

// Clear errors when modal is opened
$('#exampleModalToggle3').on('show.bs.modal', function () {
    clearFormErrors('#addUserForm');
});

// Clear errors on input change
$('#addUserForm input, #addUserForm select').on('input change', function() {
    const fieldName = $(this).attr('name');
    if (fieldName) {
        $(this).removeClass('is-invalid');
        $('#addUserForm #' + fieldName + '_error').hide().text('');
    }
});

$('#usersTable').on('click', 'a[data-bs-target="#exampleModalToggle4"]', function () {
    const id = $(this).data('id');
    const name = $(this).data('name');
    const email = $(this).data('email');
    const phone = $(this).data('phone');
    const nid = $(this).data('nid');
    const department = $(this).data('department');
    const role = $(this).data('role');
    $('#editUserForm').attr('action', '/users/' + id);
    $('#editUserForm #edit-pageName').val(name);
    $('#editUserForm #edit-email').val(email).prop('readonly', true);
    $('#editUserForm #edit-phone-no').val(phone);
    $('#editUserForm #edit-nid').val(nid);
    $('#editUserForm #edit-assign-department').val(department);
    $('#editUserForm #edit-assign-role').val(role);
    clearFormErrors('#editUserForm');
});

$('#editUserForm').on('submit', function (e) {
    e.preventDefault();
    const form = this;
    
    // Frontend validation - prevent submission if errors exist
    if (!validateUserForm('#editUserForm')) {
        // Scroll to first error
        const firstError = $('#editUserForm .is-invalid').first();
        if (firstError.length) {
            $('html, body').animate({
                scrollTop: firstError.offset().top - 100
            }, 500);
        }
        return false;
    }
    
    // Check if there are any existing errors
    if (hasFormErrors('#editUserForm')) {
        return false;
    }
    
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
                const row = $('#user-' + response.data.id);
                row.find('.user-name').text(response.data.name);
                row.find('.user-email').text(response.data.email);
                row.find('.user-phone').text(response.data.phone);
                // Mask NID - show asterisks for all but last 4 digits
                const maskedNid = maskNid(response.data.nid);
                row.find('.user-nid').text(maskedNid);
                row.find('.user-department').text(response.data.department_name);
                row.find('.user-role').text(response.data.role);
                const editBtn = row.find('.dropdown-item[data-bs-target="#exampleModalToggle4"]');
                editBtn.data('name', response.data.name);
                editBtn.data('email', response.data.email);
                editBtn.data('phone', response.data.phone);
                // Store full NID in data attribute for edit form (needed for form population)
                editBtn.data('nid', response.data.nid);
                editBtn.data('department', response.data.department_id);
                editBtn.data('role', response.data.role);
                $('#exampleModalToggle4').modal('hide');
                clearFormErrors('#editUserForm');
                showToast(response.message);
            } else {
                showToast(response.message);
            }
        },
        error: function (xhr) {
            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                // Display validation errors under fields
                displayFieldErrors(xhr.responseJSON.errors, '#editUserForm');
                // Scroll to first error
                const firstError = $('#editUserForm .is-invalid').first();
                if (firstError.length) {
                    $('html, body').animate({
                        scrollTop: firstError.offset().top - 100
                    }, 500);
                }
            } else {
                let msg = 'An error occurred while updating.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                showToast(msg, 'error');
            }
        }
    });
});

// Clear errors when edit modal is opened
$('#exampleModalToggle4').on('show.bs.modal', function () {
    clearFormErrors('#editUserForm');
});

// Clear errors on input change for edit form
$('#editUserForm input, #editUserForm select').on('input change', function() {
    const fieldName = $(this).attr('name');
    if (fieldName) {
        $(this).removeClass('is-invalid');
        $('#editUserForm #edit_' + fieldName + '_error').hide().text('');
    }
});

let deleteId = null;
$('#exampleModalToggle').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget);
    deleteId = button.data('id'); 
});
$('#confirmDeleteBtn').on('click', function () {
    if (!deleteId) return;
    $.ajax({
        url: "/users/" + deleteId,
        type: "POST",
        data: { _method: 'DELETE' },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            $('#user-' + deleteId).remove();
            $('#exampleModalToggle').modal('hide');
            $('#exampleModalToggle').on('hidden.bs.modal', function () {
                $('#exampleModalToggle2').modal('show');
                setTimeout(() => $('#exampleModalToggle2').modal('hide'), 1500);
                $(this).off('hidden.bs.modal');
            });
            showToast(response.message);
            $('#usersTable tr').each(function (index) {
                $(this).find('.sr-number').text(index + 1);
            });
            if ($('#usersTable tr').length === 0) {
                $('#usersTable').append('<tr id="no-record-row"><td colspan="16" class="text-center">No record found</td></tr>');
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
                $("#usersTable").html(response.html);

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
    const tableRows = $('#usersTable tr:visible').toArray();
    sortDirection[column] = !sortDirection[column];
    tableRows.sort((a, b) => {
        const aText = $(a).find(`.${getClassForColumn(column)}`).text().toLowerCase().trim();
        const bText = $(b).find(`.${getClassForColumn(column)}`).text().toLowerCase().trim();

        if (aText < bText) return sortDirection[column] ? -1 : 1;
        if (aText > bText) return sortDirection[column] ? 1 : -1;
        return 0;
    });
    $('#usersTable').append(tableRows);
    let counter = 1;
    $('#usersTable tr:visible').each(function() {
        $(this).find('.sr-number').text(counter++);
    });
});
function getClassForColumn(column) {
    switch(column) {
        case 'name': return 'user-name';
        case 'email': return 'user-email';
        case 'phone': return 'user-phone';
        case 'nid': return 'user-nid';
        case 'status': return 'user-status';
        case 'department': return 'user-department';
        case 'role': return 'user-role';
        default: return '';
    }
}

function exportTable(format) {
    let tableRows = [];
    $('#usersTable tr:visible').each(function() {
        let row = [];
        $(this).find('td').not(':last').each(function() {
            row.push($(this).text().trim());
        });
        if(row.length) tableRows.push(row);
    });

    if(format === 'excel') {
        let wb = XLSX.utils.book_new();
        let ws = XLSX.utils.aoa_to_sheet(tableRows);
        XLSX.utils.book_append_sheet(wb, ws, "Users");
        XLSX.writeFile(wb, "users.xlsx");
    }

    if(format === 'pdf') {
        const { jsPDF } = window.jspdf;
        let doc = new jsPDF();
        doc.autoTable({
            head: [['Sr', 'Name', 'Email', 'Phone', 'NID', 'Department', 'Role', 'Created At', 'Status']],
            body: tableRows
        });
        doc.save('users.pdf');
    }

    if(format === 'print') {
        let printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Users</title></head><body><table border="1">');
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
    fetchUsers(url);
});

function fetchUsers(url) {
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            $('#usersTable').html($(response).find('#usersTable').html());
            $('.pagination').html($(response).find('.pagination').html());
        },
        error: function() {
            // alert('Failed to load data');
        }
    });
}