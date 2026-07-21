function openStatusModal(jobId, currentStatusId) {
    $("#job_id").val(jobId);
    $.ajax({
        url: "/jobs-board/get-statuses",
        type: "GET",
        success: function (response) {
            let dropdown = $("#status-dropdown");
            dropdown.empty();
            dropdown.append('<option value="" disabled hidden>Select Status</option>');

            $.each(response.statuses, function (key, value) {
                dropdown.append('<option value="' + value.id + '">' + value.name + '</option>');
            });
            dropdown.val(currentStatusId);
            $("#changeStatusModal").modal("show");
        }
    });
}

$("#updateStatusForm").on("submit", function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    $.ajax({
        url: "/jobs-board/update-status",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        success: function (response) {
            $("#changeStatusModal").modal("hide");
            showToast("Status updated successfully!");
            let jobId = formData.get("job_id");
            $(`#job-board-${jobId} .job-status span`)
                .text(response.status_name)
                .removeClass()
                .addClass(`badge ${response.status_class} p-2`);
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            showToast("Error updating status.");
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
                $("#jobsBoardTable").html(response.html);

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
    const tableRows = $('#jobsBoardTable tr:visible').toArray();
    sortDirection[column] = !sortDirection[column];
    tableRows.sort((a, b) => {
        const aText = $(a).find(`.${getClassForColumn(column)}`).text().toLowerCase().trim();
        const bText = $(b).find(`.${getClassForColumn(column)}`).text().toLowerCase().trim();

        if (aText < bText) return sortDirection[column] ? -1 : 1;
        if (aText > bText) return sortDirection[column] ? 1 : -1;
        return 0;
    });
    $('#jobsBoardTable').append(tableRows);
    let counter = 1;
    $('#jobsBoardTable tr:visible').each(function() {
        $(this).find('.sr-number').text(counter++);
    });
});
function getClassForColumn(column) {
    switch(column) {
        case 'company-name': return 'company-name';
        case 'job-title': return 'title-name';
        case 'job-type': return 'job-type';
        case 'work-mode': return 'work-mode';
        case 'expert-level': return 'expert-level';
        case 'job-status': return 'job-status';
        default: return '';
    }
}

$(document).on('click', '.pagination a', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');
    fetchJobs(url);
});

$(document).on('change', '.form-select', function() {
    let perPage = $(this).val();
    let url = window.location.origin + window.location.pathname + '?per_page=' + perPage;
    fetchJobs(url);
});

function fetchJobs(url) {
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            $('#jobsBoardTable').html($(response).find('#jobsBoardTable').html());
            $('.pagination').html($(response).find('.pagination').html());
        },
        error: function() {
            // alert('Failed to load data');
        }
    });
}