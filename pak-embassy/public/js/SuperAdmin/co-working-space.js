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
                $("#coWorkingSpaceTable").html(response.html);

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