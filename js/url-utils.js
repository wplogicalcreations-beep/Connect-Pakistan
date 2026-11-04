// Shared URL helpers, loaded by every layout before page scripts.

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

// Fetches a server-rendered table page and swaps in its rows and pagination.
// `table` is a selector string or a function returning one (resolved at request time).
function loadTableHtml(table, url, options = {}) {
    const showLoading = () => $("#table-container").addClass("loading");
    const hideLoading = () => $("#table-container").removeClass("loading");

    return $.ajax({
        url: url,
        type: "GET",
        data: options.data,
        beforeSend: options.loading ? showLoading : undefined,
        success: function (response) {
            if (response.success) {
                const selector = typeof table === "function" ? table() : table;
                $(selector).html(response.html); // NOSONAR - server-rendered Blade partial; data is escaped server-side
                $(".pagination-container").replaceWith(response.pagination); // NOSONAR - server-rendered Blade partial; data is escaped server-side
            }
        },
        complete: options.loading ? hideLoading : undefined,
        error: function (xhr) {
            if (options.errorMessage) {
                alert(options.errorMessage);
            } else {
                console.error(xhr.responseText);
            }
        }
    });
}

// Loads pagination links of a server-rendered table via AJAX instead of a full page load.
function bindAjaxPagination(table) {
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        const url = toSameOriginUrl($(this).attr("href"));
        if (!url) return;
        loadTableHtml(table, url, { loading: true, errorMessage: "Pagination fetch error!" });
    });
}

// Wires AJAX pagination, per-page, search and column sort for a server-rendered table.
// `searchKey` is the query parameter name for the search box (string or function).
function bindAjaxTable(table, searchKey = "name") {
    bindAjaxPagination(table);

    $(document).on("change", ".per-page-select", function () {
        const url = window.location.pathname + "?per_page=" + encodeURIComponent($(this).val());
        loadTableHtml(table, url, { loading: true, errorMessage: "Per-page change error!" });
    });

    $(function () {
        $("#searchInput").on("keyup", function () {
            const url = toSameOriginUrl(window.location.href);
            if (!url) return;
            const key = typeof searchKey === "function" ? searchKey() : searchKey;
            loadTableHtml(table, url, { data: { [key]: $(this).val() } });
        });
    });

    $(document).on("click", ".sort", function () {
        const newOrder = ($(this).data("order") || "asc") === "asc" ? "desc" : "asc";
        loadTableHtml(table, window.location.pathname, {
            data: {
                sort_by: $(this).data("sort"),
                sort_order: newOrder,
                per_page: $("select[name='per_page']").val() || 10
            }
        });
        $(this).data("order", newOrder); // toggle order
    });
}
