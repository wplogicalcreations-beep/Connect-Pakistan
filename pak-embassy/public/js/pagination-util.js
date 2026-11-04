// AJAX pagination, per-page, search and sort (shared helper in url-utils.js)
bindAjaxTable(() => "#" + table_id, () => (typeof search_by !== "undefined" ? search_by : "name"));