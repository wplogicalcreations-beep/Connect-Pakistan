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
                $("#spacesRequestTable").html(response.html);

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
    const tableRows = $('#spacesRequestTable tr:visible').toArray();
    sortDirection[column] = !sortDirection[column];
    tableRows.sort((a, b) => {
        const aText = $(a).find(`.${getClassForColumn(column)}`).text().toLowerCase().trim();
        const bText = $(b).find(`.${getClassForColumn(column)}`).text().toLowerCase().trim();

        if (aText < bText) return sortDirection[column] ? -1 : 1;
        if (aText > bText) return sortDirection[column] ? 1 : -1;
        return 0;
    });
    $('#spacesRequestTable').append(tableRows);
});
function getClassForColumn(column) {
    switch (column) {
        case 'request-id': return 'request-request-id';
        case 'request-name': return 'request-space-name';
        case 'request-email': return 'request-space-email';
        case 'request-phone': return 'request-space-phone';
        case 'request-people': return 'request-space-people-count';
        case 'request-starting-date': return 'request-space-start-date';
        case 'request-status': return 'request-space-status';
        default: return '';
    }
}

function exportTable(format) {
    let tableRows = [];
    $('#spacesRequestTable tr:visible').each(function() {
        let row = [];
        $(this).find('td').not(':last').each(function() {
            row.push($(this).text().trim());
        });
        if(row.length) tableRows.push(row);
    });

    if(format === 'excel') {
        let wb = XLSX.utils.book_new();
        let ws = XLSX.utils.aoa_to_sheet(tableRows);
        XLSX.utils.book_append_sheet(wb, ws, "Spaces Request");
        XLSX.writeFile(wb, "spaces_request.xlsx");
    }

    if(format === 'pdf') {
        const { jsPDF } = window.jspdf;
        let doc = new jsPDF();
        doc.autoTable({
            head: [['Request ID', 'Name ', 'Email', 'Phone Number', 'No. of People', 'Est. Start Date', 'Status']],
            body: tableRows
        });
        doc.save('spaces_request.pdf');
    }

    if(format === 'print') {
        let printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Spaces Request</title></head><body><table border="1">');
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
    fetchSpacesRequest(url);
});

function fetchSpacesRequest(url) {
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            $('#spacesRequestTable').html($(response).find('#spacesRequestTable').html());
            $('.pagination').html($(response).find('.pagination').html());
        },
        error: function() {
            // alert('Failed to load data');
        }
    });
}

function openEnquiryModal(url) {

    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            $('#enquiryModalContent').html(response.html);
            $('#enquiryModal').modal('show');
        },
        error: function() {
            alert('Failed to load enquiry details.');
        }
    });
}