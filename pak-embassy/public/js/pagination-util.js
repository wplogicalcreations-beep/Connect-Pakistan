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
                $("#"+table_id).html(response.html);

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


// per-page change (AJAX)
$(document).on("change", ".per-page-select", function () {
    let baseUrl = window.location.pathname; // e.g. /user/applied-job
    let perPage = $(this).val();
    let url = baseUrl + "?per_page=" + perPage;

    $.ajax({
        url: url,
        type: "GET",
        beforeSend: function () {
            $("#table-container").addClass("loading");
        },
        success: function (response) {
            if (response.success) {
                // update table rows
                $("#"+table_id).html(response.html);

                // update pagination with new info
                $(".pagination-container").replaceWith(response.pagination);
            }
        },
        complete: function () {
            $("#table-container").removeClass("loading");
        },
        error: function () {
            alert("Per-page change error!");
        }
    });
});


$(document).ready(function () {
    // Search input event
    $('#searchInput').on('keyup', function () {
        let search = $(this).val();
        let url = window.location.href;
        let searchKey = typeof search_by !== 'undefined' ? search_by : 'name';

        $.ajax({
            url: url,
            type: 'GET',
            data: {[searchKey]: search},
            success: function (response) {
                if (response.success) {
                    // update table rows
                    $("#"+table_id).html(response.html);

                    // update pagination with new info
                    $(".pagination-container").replaceWith(response.pagination);

                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});

$(document).on("click", ".sort", function () {
    let sortBy = $(this).data("sort");
    let currentOrder = $(this).data("order") || "asc";
    let newOrder = currentOrder === "asc" ? "desc" : "asc";
    let perPage = $("select[name='per_page']").val() || 10;
    let url = window.location.pathname;

    $.ajax({
        url: url,
        type: "GET",
        data: {
            sort_by: sortBy,
            sort_order: newOrder,
            per_page: perPage
        },
        success: function (response) {
            if (response.success) {
                $("#"+table_id).html(response.html);
                $(".pagination-container").replaceWith(response.pagination);
            }
        }
    });

    $(this).data("order", newOrder); // toggle order
});