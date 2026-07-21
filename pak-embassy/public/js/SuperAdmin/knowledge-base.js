// Helper function for toast notifications
function showToast(message, type = 'success') {
    // You can replace this with your preferred toast library
    // For now, using a simple alert as fallback
    if (type === 'error') {
        alert('Error: ' + message);
    } else {
        alert(message);
    }
}

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
                $("#knowledgeBaseTable").html(response.html);

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
    const tableRows = $('#coWorkingSpaceTable tr:visible').toArray();
    sortDirection[column] = !sortDirection[column];
    tableRows.sort((a, b) => {
        const aText = $(a).find(`.${getClassForColumn(column)}`).text().toLowerCase().trim();
        const bText = $(b).find(`.${getClassForColumn(column)}`).text().toLowerCase().trim();

        if (aText < bText) return sortDirection[column] ? -1 : 1;
        if (aText > bText) return sortDirection[column] ? 1 : -1;
        return 0;
    });
    $('#coWorkingSpaceTable').append(tableRows);
});
function getClassForColumn(column) {
    switch (column) {
        case 'space-id': return 'space-id';
        case 'space-name': return 'space-name';
        case 'space-email': return 'space-email';
        case 'space-phone': return 'space-phone';
        case 'space-price': return 'space-price';
        case 'space-rental': return 'space-rental';
        case 'space-people': return 'space-people';
        default: return '';
    }
}

function exportTable(format) {
    let tableRows = [];
    $('#coWorkingSpaceTable tr:visible').each(function() {
        let row = [];
        $(this).find('td').not(':last').each(function() {
            row.push($(this).text().trim());
        });
        if(row.length) tableRows.push(row);
    });

    if(format === 'excel') {
        let wb = XLSX.utils.book_new();
        let ws = XLSX.utils.aoa_to_sheet(tableRows);
        XLSX.utils.book_append_sheet(wb, ws, "Co Working Spaces");
        XLSX.writeFile(wb, "co_woking_spaces.xlsx");
    }

    if(format === 'pdf') {
        const { jsPDF } = window.jspdf;
        let doc = new jsPDF();
        doc.autoTable({
            head: [['Space ID', 'Title', 'Email', 'Phone', 'Starting Price', 'Month Rentals', 'People']],
            body: tableRows
        });
        doc.save('co_woking_spaces.pdf');
    }

    if(format === 'print') {
        let printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Co Working Spaces</title></head><body><table border="1">');
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
    fetchSpaces(url);
});

function fetchSpaces(url) {
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            $('#coWorkingSpaceTable').html($(response).find('#coWorkingSpaceTable').html());
            $('.pagination').html($(response).find('.pagination').html());
        },
        error: function() {
            // alert('Failed to load data');
        }
    });
}

$('#knowledgeForm').on('submit', function(e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);

    $.ajax({
        url: $(form).attr('action'),
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        beforeSend: function() {
            $('button[type="submit"]').prop('disabled', true).text('Saving...');
        },
        success: function(response) {
            
            // Reset form only if response.data is not empty
            if (response.data && Object.keys(response.data).length > 0) {
                form.reset();
            }

            // Show success toast or modal
            showToast(response.message || 'Knowledge saved successfully');

            // Redirect or update the page if needed
            // window.location.href = "/knowledge"; 
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                // Validation errors
                const errors = xhr.responseJSON.errors;
                $.each(errors, function(field, messages) {
                    let input = $('[name="' + field + '"]');
                    input.addClass('is-invalid');
                    input.after('<div class="invalid-feedback">' + messages[0] + '</div>');
                });
            } else {
                // Other errors
                showToast(xhr.responseJSON?.error || 'Failed to save', 'error');
            }
        },
        complete: function() {
            $('button[type="submit"]').prop('disabled', false).text('Add Knowledge');
        }
    });
});

$(document).on('change', '.toggle-switch', function() {
    let toggle = $(this);
    let url = toggle.data('url');
    let status = toggle.is(':checked') ? 1 : 0;
    let icon = toggle.next('label').find('i');

    // Immediately update icon
    icon.toggleClass('fa-toggle-on fa-toggle-off text-success text-secondary');

    if (!url) return;

    $.ajax({
        url: url,
        type: "POST",
        contentType: 'application/json',
        data: JSON.stringify({ status_id: status }),
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        beforeSend: function() {
            toggle.prop('disabled', true); // disable toggle during request
        },
        success: function(response) {
            showToast(response.message || 'Status updated successfully');
        },
        error: function(xhr) {
            // Revert toggle on error
            toggle.prop('checked', !status);
            icon.toggleClass('fa-toggle-on fa-toggle-off text-success text-secondary');
            showToast(xhr.responseJSON?.error || 'Failed to update status', 'error');
        },
        complete: function() {
            toggle.prop('disabled', false); // re-enable toggle
        }
    });
});


// When the delete button is clicked, set the URL and row-id on the confirm button
$(document).on('click', '.open-delete-modal', function () {
    let url = $(this).data('url');
    let rowId = $(this).data('row-id') || '';

    console.log('Setting delete data:', { url, rowId });

    // Clear any previous data and set new data
    let confirmBtn = $('#globalDeleteModal').find('.confirm-delete');
    
    // Force remove all data attributes
    confirmBtn.removeAttr('data-url');
    confirmBtn.removeAttr('data-row-id');
    
    // Clear any cached data
    confirmBtn.removeData('url');
    confirmBtn.removeData('row-id');
    
    // Set new data attributes
    confirmBtn.attr('data-url', url);
    confirmBtn.attr('data-row-id', rowId);
    
    // Verify the data was set correctly
    console.log('Confirm button data after setting:', {
        url: confirmBtn.attr('data-url'),
        rowId: confirmBtn.attr('data-row-id')
    });
    
    // Ensure modal is in clean state
    $('#globalDeleteModal').off('hidden.bs.modal.resetData');
});

// When user confirms delete
$(document).on('click', '.confirm-delete', function () {
    // Use attr() instead of data() to ensure we get the current values
    let url = $(this).attr('data-url');
    let rowId = $(this).attr('data-row-id');
    let successModal = $(this).attr('data-success-modal');

    console.log('Confirm delete clicked with:', { url, rowId, successModal });

    if (!url) {
        console.error("Delete URL missing.");
        return;
    }

    // Disable the confirm button to prevent double clicks
    let confirmBtn = $(this);
    confirmBtn.prop('disabled', true).text('Deleting...');

    console.log('About to delete:', url);
    $.ajax({
        url: url,
        type: 'POST',
        data: { _method: 'DELETE' },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            // If row ID provided, remove from DOM
            if (rowId) {
                $(`#${rowId}`).fadeOut(300, function() {
                    $(this).remove();
                });
            }

            // Show success modal
            if (successModal) {
                $(successModal).modal('show');
                
                // Auto-close success modal after 2s
                setTimeout(() => {
                    $(successModal).modal('hide');
                }, 2000);
            }

            // Trigger global event
            $(document).trigger('record:deleted', response);
        },
        error: function (xhr) {
            console.error("Delete failed:", xhr.responseText);
            
            // Show error message
            let errorMessage = 'Something went wrong while deleting.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            
            // Show error toast
            showToast(errorMessage, 'error');
        },
        complete: function() {
            // Re-enable button and reset text
            confirmBtn.prop('disabled', false).text('Yes');
            
            // Immediately clear the data attributes to prevent reuse
            confirmBtn.removeAttr('data-url');
            confirmBtn.removeAttr('data-row-id');
            confirmBtn.removeData('url');
            confirmBtn.removeData('row-id');
            
            console.log('Data cleared after deletion');
            
            // Reset modal data attributes after modal is hidden
            $('#globalDeleteModal').on('hidden.bs.modal.resetData', function() {
                confirmBtn.removeAttr('data-url').removeAttr('data-row-id');
                confirmBtn.removeData('url').removeData('row-id');
                $(this).off('hidden.bs.modal.resetData');
            });
        }
    });
});






