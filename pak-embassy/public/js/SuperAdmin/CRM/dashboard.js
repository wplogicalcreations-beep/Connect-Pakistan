 var options = {
      chart: {
        type: 'line',
        height: 130,
        toolbar: {
          show: false
        },
        background: 'transparent'
      },
      series: [{
        name: 'Data',
        data: [10, 100, 30, 100]
      }],
      stroke: {
        curve: 'straight', // ✅ Straight line between points
        width: 3,
        colors: ['#000']   // Black line
      },
      markers: {
        size: 8,
        colors: ['#0B3D0B'],      // Fill color: dark green
        strokeColors: '#0B3D0B',  // Border color
        strokeWidth: 2
      },
      grid: {
        show: false
      },
      xaxis: {
        labels: { show: false },
        axisBorder: { show: false },
        axisTicks: { show: false }
      },
      yaxis: {
        show: false
      },
      tooltip: {
        enabled: false
      },
      dataLabels: {
        enabled: false
      }
    };

    var chart = new ApexCharts(document.querySelector("#chart-sm"), options);
    chart.render();

var monthlyData = data.monthlyCounts;
var leadsData = monthlyData.map(item => item.leads);
var matchmakingsData = monthlyData.map(item => item.matchmakings);
var meetingsData = monthlyData.map(item => item.meetings);

var options = {
  series: [
    { name: "Leads", data: leadsData },
    { name: "Matchmakings", data: matchmakingsData },
    { name: "Meetings", data: meetingsData },
  ],
  chart: {
    type: "line",
    height: 400,
    toolbar: { show: false },
    zoom: { enabled: false },
  },
  stroke: { curve: "smooth", width: 2 },
  markers: { size: 0 },
  colors: ["#0ED95D", "#0C5B2C", "#EB0D0D"],
  dataLabels: { enabled: false },
  xaxis: {
    categories: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
  },
  yaxis: { min: 0 },
  legend: { position: "bottom", horizontalAlign: "left", offsetX: 20, offsetY: 16 }
};

// Store chart instance globally for updates
window.monthlyChart = new ApexCharts(document.querySelector("#monthly-trans-bars"), options);
window.monthlyChart.render();

// Function to update monthly chart with new data
function updateMonthlyChart(monthlyCounts) {
    var leadsData = monthlyCounts.map(item => item.leads);
    var matchmakingsData = monthlyCounts.map(item => item.matchmakings);
    var meetingsData = monthlyCounts.map(item => item.meetings);

    // Update chart data
    window.monthlyChart.updateSeries([
        { name: "Leads", data: leadsData },
        { name: "Matchmakings", data: matchmakingsData },
        { name: "Meetings", data: meetingsData },
    ]);
}

    $(document).ready(function () {
      // Trigger search when either date input changes
      $('#from, #to').on('change keyup', function () {
          let from = $('#from').val();
          let to = $('#to').val();
          let url = window.location.href;

          $.ajax({
              url: url,
              type: 'GET',
              data: { from: from, to: to },
              success: function (response) {
                  if (response.success) {
                      // update table rows
                      $("#leadsTable").html(response.html);

                      // update pagination with new info
                      $(".pagination-container").replaceWith(response.pagination);
                  }
              },
              error: function (xhr) {
                  console.error(xhr.responseText);
              }
          });
      });

      // Handle year selector change for monthly counts
      $('#yearSelector').on('change', function () {
          let year = $(this).val();
          let url = window.location.href;
          
          // Get current URL parameters
          let urlObj = new URL(url);
          urlObj.searchParams.set('year', year);
          
          $.ajax({
              url: urlObj.toString(),
              type: 'GET',
              data: { year: year },
              success: function (response) {
                  // If response contains monthlyCounts, update the chart
                  if (response.monthlyCounts) {
                      updateMonthlyChart(response.monthlyCounts);
                  } else {
                      // If it's a full page response, reload the page
                      window.location.href = urlObj.toString();
                  }
              },
              error: function (xhr) {
                  console.error(xhr.responseText);
              }
          });
      });
  });

    // Sorting link click handle
    $(document).on("click", ".sortable", function (e) {
        e.preventDefault();
        let sortBy = $(this).data("sort");
        let currentOrder = $(this).data("order") || "desc";
        let newOrder = currentOrder === "desc" ? "asc" : "desc";
        let perPage = $("select[name='per_page']").val() || 10;
        let url = window.location.href;
        
        // Get current filters
        const from = $('#from').val();
        const to = $('#to').val();

        // set data attribute
        $(this).data("order", newOrder);

        // waiting for sorting
        $("#waiting-for-sorting").show();

        let ajaxData = {
            sort_by: sortBy,
            sort_order: newOrder,
            per_page: perPage,
            action_items: '1' // Always include for action items table sorting
        };

        // Include date filters if they exist
        if (from) ajaxData.from = from;
        if (to) ajaxData.to = to;

        $.ajax({
            url: url,
            type: "GET",
            data: ajaxData,
            success: function (response) {
                
                if (response.success) {
                    $("#leadsTable").html(response.html);
                    
                    // Update pagination if provided
                    if (response.pagination) {
                        $(".pagination-container").replaceWith(response.pagination);
                    }
                }

                // waiting for sorting
                $("#waiting-for-sorting").hide();
            },
                error: function () {
                    // waiting for sorting
                    $("#waiting-for-sorting").hide();
            }
        });
    });


    // Pagination link click handle
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        let url = $(this).attr("href");
        
        // Get current filters to determine if we're on action items
        const from = $('#from').val();
        const to = $('#to').val();
        
        // Check if we're in the action items section (has "Action Items" heading)
        const isActionItemsSection = $('h3:contains("Action Items")').length > 0;
        
        // If we're on action items section or have date filters, add action_items parameter
        if (from || to || isActionItemsSection) {
            // Parse the URL and add action_items parameter
            const urlObj = new URL(url);
            urlObj.searchParams.set('action_items', '1');
            
            // Include date filters if they exist
            if (from) urlObj.searchParams.set('from', from);
            if (to) urlObj.searchParams.set('to', to);
            
            url = urlObj.toString();
        }

        $.ajax({
            url: url,
            type: "GET",
            beforeSend: function () {
                $("#table-container").addClass("loading");
            },
            success: function (response) {
                if (response.success) {
                    // update table rows
                    $("#leadsTable").html(response.html);

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

function exportTable(format) {
    // Show loading indicator
    const exportBtn = $('#exportExcel');
    const originalText = exportBtn.text();
    exportBtn.prop('disabled', true).text('Exporting...');

    // Get current filters
    const from = $('#from').val();
    const to = $('#to').val();
    const name = $('#searchInput').val();

    // Build URL with all filters and a very high per_page to get all records
    let exportUrl = indexUrl;
    const params = new URLSearchParams();
    params.append('per_page', '99999'); // Get all records
    params.append('ajax', '1'); // Ensure we get JSON response
    params.append('action_items', '1'); // Always request action items for export
    if (from) params.append('from', from);
    if (to) params.append('to', to);
    if (name) params.append('name', name);
    exportUrl += '?' + params.toString();

    // Fetch all data from backend
    $.ajax({
        url: exportUrl,
        type: 'GET',
        success: function(response) {
            console.log('Export response:', response);
            if (response.success && response.html) {
                // Parse the HTML response to extract all table rows
                // The response.html contains just the <tr> elements, so wrap in table for proper parsing
                const $tempTable = $('<table>').html(response.html);
                let tableRows = [];
                
                // Add headers
                tableRows.push(['Event Name', 'Action', 'Description', 'Assigned to', 'Due Date', 'Status', 'Comments']);

                // Extract all data rows - response.html contains <tr> elements directly
                const $rows = $tempTable.find('tr');
                console.log('Found rows:', $rows.length);
                
                $rows.each(function() {
                    // Skip "No record found" row
                    const rowText = $(this).find('td').text().trim();
                    if (rowText === 'No record found' || rowText === '') return;
                    
                    let row = [];
                    // Get all td columns for action items (Event Name, Action, Description, Assigned to, Due Date, Status, Comments)
                    $(this).find('td').each(function() {
                        // Get all text content including badges
                        let cellText = $(this).text().trim();
                        row.push(cellText);
                    });
                    if(row.length > 0) {
                        tableRows.push(row);
                        console.log('Added row:', row);
                    }
                });

                console.log('Total rows for export:', tableRows.length);
                
                if(tableRows.length > 1) { // More than just headers
                    if(format === 'excel') {
                        let wb = XLSX.utils.book_new();
                        let ws = XLSX.utils.aoa_to_sheet(tableRows);
                        XLSX.utils.book_append_sheet(wb, ws, "Action Items");
                        XLSX.writeFile(wb, "action_items.xlsx");
                    }
                } else {
                    alert('No data to export.');
                }
            } else {
                console.error('Invalid response:', response);
                alert('Failed to export data. Please try again.');
            }
        },
        error: function(xhr) {
            console.error('Export error:', xhr);
            alert('Failed to export data. Please try again.');
        },
        complete: function() {
            // Restore button state
            exportBtn.prop('disabled', false).text(originalText);
        }
    });
}
$('#exportExcel').on('click', () => exportTable('excel'));

$(document).on('change', '.form-select', function() {
    let perPage = $(this).val();
    let url = window.location.origin + window.location.pathname + '?per_page=' + perPage;
    fetchLeads(url);
});

function fetchLeads(url) {
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            $('#leadsTable').html($(response).find('#leadsTable').html());
            $('.pagination').html($(response).find('.pagination').html());
        },
        error: function() {
            // alert('Failed to load data');
        }
    });
}