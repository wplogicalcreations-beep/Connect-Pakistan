$("#addDepartmentForm").on("submit", function (e) {
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
                $("#departmentsTable").prepend(response.row);
                $("#departmentsTable tr").each(function(index){
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

$('#departmentsTable').on('click', 'a[data-bs-target="#staticBackdrop"]', function () {
    const id = $(this).data('id');
    const name = $(this).data('name');
    $('#editDepartmentForm').attr('action', '/departments/' + id);
    $('#editDepartmentName').val(name);
});

$('#editDepartmentForm').on('submit', function (e) {
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
                const row = $('#department-' + response.data.id);
                $('#department-' + response.data.id).find('.dept-name').text(response.data.name);
                 $('#department-' + response.data.id)
                    .find('.dropdown-item[data-bs-target="#staticBackdrop"]')
                    .data('name', response.data.name);
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
        url: "/departments/" + deleteId,
        type: "POST",
        data: { _method: 'DELETE' },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            $('#department-' + deleteId).remove();
            $('#exampleModalToggle').modal('hide');
            $('#exampleModalToggle').on('hidden.bs.modal', function () {
                $('#exampleModalToggle2').modal('show');
                setTimeout(() => $('#exampleModalToggle2').modal('hide'), 1500);
                $(this).off('hidden.bs.modal');
            });
            showToast(response.message);
            $('#departmentsTable tr').each(function (index) {
                $(this).find('.sr-number').text(index + 1);
            });
            if ($('#departmentsTable tr').length === 0) {
                $('#departmentsTable').append('<tr id="no-record-row"><td colspan="16" class="text-center">No record found</td></tr>');
            }
            deleteId = null;
        },
        error: function (xhr) {
            $('#exampleModalToggle').modal('hide');
            showToast(xhr.responseJSON?.error || 'Failed to delete', 'error');
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
                $("#departmentsTable").html(response.html);

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
$('.sort-column').on('click', function() {
    let index = $(this).index();
    let type = $(this).data('sort');
    sortDirection[index] = !sortDirection[index];
    let rows = $('#departmentsTable tr').get();
    rows.sort(function(a, b) {
        let A = $(a).children('td').eq(index).text().toLowerCase();
        let B = $(b).children('td').eq(index).text().toLowerCase();

        if(type === 'number') {
            A = parseInt(A);
            B = parseInt(B);
        }

        if(A < B) return sortDirection[index] ? -1 : 1;
        if(A > B) return sortDirection[index] ? 1 : -1;
        return 0;
    });
    $.each(rows, function(idx, row) {
        $('#departmentsTable').append(row);
    });
    let counter = 1;
    $('#departmentsTable tr:visible').each(function() {
        $(this).find('.sr-number').text(counter++);
    });
});

$('.btn-excel').on('click', function() {
    var table = document.getElementById('departmentsTable');
    var wb = XLSX.utils.book_new();
    var clone = table.cloneNode(true);
    clone.querySelectorAll('tr').forEach(row => row.removeChild(row.lastElementChild));
    var ws = XLSX.utils.table_to_sheet(clone);
    XLSX.utils.book_append_sheet(wb, ws, "Departments");
    XLSX.writeFile(wb, "departments.xlsx");
});

$('.btn-pdf').on('click', function() {
    const { jsPDF } = window.jspdf;
    var doc = new jsPDF();
    var table = document.getElementById('departmentsTable');
    var clone = table.cloneNode(true);
    clone.querySelectorAll('tr').forEach(row => row.removeChild(row.lastElementChild));
    doc.autoTable({ 
        html: clone,
        startY: 10,
    });
    doc.save('departments.pdf');
});

$('.btn-print').on('click', function() {
    var table = document.getElementById('departmentsTable');
    var clone = table.cloneNode(true);
    clone.querySelectorAll('tr').forEach(row => row.removeChild(row.lastElementChild));
    var newWin = window.open('', '_blank');
    newWin.document.write('<html><head><title>Departments</title>');
    newWin.document.write('<link rel="stylesheet" href="your-css-path.css">');
    newWin.document.write('</head><body>');
    newWin.document.write(clone.outerHTML);
    newWin.document.write('</body></html>');
    newWin.document.close();
    newWin.print();
});

$(document).on('change', '.form-select', function() {
    let perPage = $(this).val();
    let url = window.location.origin + window.location.pathname + '?per_page=' + perPage;
    fetchDepartments(url);
});

function fetchDepartments(url) {
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            $('#departmentsTable').html($(response).find('#departmentsTable').html());
            $('.pagination').html($(response).find('.pagination').html());
        },
        error: function() {
            alert('Failed to load data');
        }
    });
}