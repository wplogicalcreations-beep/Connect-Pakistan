// Returns the absolute URL only if it points to this site's own origin, otherwise null.
// Prevents AJAX requests (and the HTML they return) from being redirected to another host.
function toSameOriginUrl(rawUrl) {
    try {
        const parsed = new URL(rawUrl, window.location.href);
        return parsed.origin === window.location.origin ? parsed.href : null;
    } catch (e) {
        return null;
    }
}

// Pagination link click handle
$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    let url = toSameOriginUrl($(this).attr("href"));
    if (!url) return;

    $.ajax({
        url: url,
        type: "GET",
        beforeSend: function () {
            $("#table-container").addClass("loading");
        },
        success: function (response) {
            if (response.success) {
                // update table rows
                $("#"+table_id).html(response.html); // NOSONAR - server-rendered Blade partial; data is escaped server-side

                // update pagination component
                $(".pagination-container").replaceWith(response.pagination); // NOSONAR - server-rendered Blade partial; data is escaped server-side

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
    let url = baseUrl + "?per_page=" + encodeURIComponent(perPage);

    $.ajax({
        url: url,
        type: "GET",
        beforeSend: function () {
            $("#table-container").addClass("loading");
        },
        success: function (response) {
            if (response.success) {
                // update table rows
                $("#"+table_id).html(response.html); // NOSONAR - server-rendered Blade partial; data is escaped server-side

                // update pagination with new info
                $(".pagination-container").replaceWith(response.pagination); // NOSONAR - server-rendered Blade partial; data is escaped server-side
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
        let url = toSameOriginUrl(window.location.href);
        if (!url) return;
        let searchKey = typeof search_by !== 'undefined' ? search_by : 'name';

        $.ajax({
            url: url,
            type: 'GET',
            data: {[searchKey]: search},
            success: function (response) {
                if (response.success) {
                    // update table rows
                    $("#"+table_id).html(response.html); // NOSONAR - server-rendered Blade partial; data is escaped server-side

                    // update pagination with new info
                    $(".pagination-container").replaceWith(response.pagination); // NOSONAR - server-rendered Blade partial; data is escaped server-side

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
                $("#"+table_id).html(response.html); // NOSONAR - server-rendered Blade partial; data is escaped server-side
                $(".pagination-container").replaceWith(response.pagination); // NOSONAR - server-rendered Blade partial; data is escaped server-side
            }
        }
    });

    $(this).data("order", newOrder); // toggle order
});