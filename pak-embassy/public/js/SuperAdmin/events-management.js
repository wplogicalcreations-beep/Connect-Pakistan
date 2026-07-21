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
                $("#eventsTable").html(response.html);

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
    const tableRows = $('#eventsTable tr:visible').toArray();
    sortDirection[column] = !sortDirection[column];
    tableRows.sort((a, b) => {
        const aText = $(a).find(`.${getClassForColumn(column)}`).text().toLowerCase().trim();
        const bText = $(b).find(`.${getClassForColumn(column)}`).text().toLowerCase().trim();

        if (aText < bText) return sortDirection[column] ? -1 : 1;
        if (aText > bText) return sortDirection[column] ? 1 : -1;
        return 0;
    });
    $('#eventsTable').append(tableRows);
});
function getClassForColumn(column) {
    switch(column) {
        case 'event-id': return 'event-id';
        case 'event-name': return 'event-name';
        case 'event-type': return 'event-type';
        case 'event-city': return 'event-city';
        case 'event-location': return 'event-location';
        case 'event-mom': return 'event-mom';
        case 'event-activites': return 'event-activites';
        case 'event-start-date': return 'event-start-date';
        case 'event-start-time': return 'event-start-time';
        case 'event-end-date': return 'event-end-date';
        case 'event-end-time': return 'event-end-time';
        case 'event-status': return 'event-status';
        case 'meeting-link': return 'meeting-link';
        default: return '';
    }
}

$(document).on('click', '.pagination a', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');
    fetchEvents(url);
});

$(document).on('change', '.form-select', function() {
    let perPage = $(this).val();
    let url = window.location.origin + window.location.pathname + '?per_page=' + perPage;
    fetchEvents(url);
});

function fetchEvents(url) {
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            $('#eventsTable').html($(response).find('#eventsTable').html());
            $('.pagination').html($(response).find('.pagination').html());
        },
        error: function() {
            alert('Failed to load data');
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
    $.ajax({
        url: "/events/" + deleteId,
        type: "POST",
        data: { _method: 'DELETE' },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            $('#event-' + deleteId).remove();
            $('#exampleModalToggle').modal('hide');
            $('#exampleModalToggle').on('hidden.bs.modal', function () {
                $('#exampleModalToggle2').modal('show');
                setTimeout(() => $('#exampleModalToggle2').modal('hide'), 1500);
                $(this).off('hidden.bs.modal');
            });
            showToast(response.message);
            if ($('#eventsTable tr').length === 0) {
                $('#eventsTable').append('<tr id="no-record-row"><td colspan="16" class="text-center">No record found</td></tr>');
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