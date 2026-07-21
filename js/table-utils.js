(function (window, $) {
	"use strict";

	if (!$) {
		return;
	}

	function toQueryString(params) {
		const searchParams = new URLSearchParams();
		Object.keys(params || {}).forEach(function (key) {
			const value = params[key];
			if (value !== undefined && value !== null && value !== "") {
				searchParams.set(key, value);
			}
		});
		return searchParams.toString();
	}

	function buildUrl(baseUrl, params) {
		const url = new URL(baseUrl, window.location.origin);
		const existing = Object.fromEntries(url.searchParams.entries());
		const merged = Object.assign({}, existing, params || {});
		url.search = toQueryString(merged);
		return url.pathname + (url.search ? ("?" + url.searchParams.toString()) : "");
	}

	function removeLastColumn(tableElement) {
		const rows = tableElement.querySelectorAll("tr");
		rows.forEach(function (row) {
			if (row.lastElementChild) {
				row.removeChild(row.lastElementChild);
			}
		});
	}

	var TableUtils = {
		init: function (options) {
			var defaults = {
				rootSelector: "",
				tableSelector: "table",
				tableContainerSelector: "table",
				paginationContainerSelector: ".pagination-container",
				loadingContainerSelector: "",
				searchInputSelector: "",
				perPageSelectSelector: "",
				sortTriggerSelector: "",
				export: {
					excelButtonSelector: "",
					pdfButtonSelector: "",
					printButtonSelector: "",
					fileName: "table",
					title: "Table",
					excludeLastColumn: true
				},
				paramNames: {
					search: "search",
					sortBy: "sort_by",
					sortOrder: "sort_order",
					perPage: "per_page",
					page: "page"
				},
				baseUrl: window.location.pathname,
				additionalParams: function () { return {}; },
				onBeforeUpdate: function () {},
				onAfterUpdate: function () {}
			};

			var cfg = $.extend(true, {}, defaults, options || {});
			// Favor 'name' by default if backend expects it
			if (!options || !options.paramNames || !options.paramNames.search) {
				var qs = new URLSearchParams(window.location.search);
				if (qs.has('name')) {
					cfg.paramNames.search = 'name';
				}
			}

			if (!cfg.rootSelector) {
				return;
			}

			var $root = $(cfg.rootSelector);
			if (!$root.length) {
				return;
			}

			if ($root.data("tableUtilsBound")) {
				return;
			}
			$root.data("tableUtilsBound", true);

			var ns = ".tableUtils-" + Math.random().toString(36).slice(2);

			function setLoading(isLoading) {
				if (!cfg.loadingContainerSelector) return;
				var $loading = $(cfg.loadingContainerSelector);
				if (!$loading.length) return;
				if (isLoading) {
					$loading.addClass("loading");
				} else {
					$loading.removeClass("loading");
				}
			}

			function refresh(url, data) {
				cfg.onBeforeUpdate();
				setLoading(true);
				$.ajax({
					url: url,
					type: "GET",
					data: data || {},
					success: function (response) {
						if (response && response.success) {
							$root.find(cfg.tableContainerSelector).html(response.html);
							if (response.pagination) {
								var $old = $root.find(cfg.paginationContainerSelector).first();
								if ($old.length) {
									$old.replaceWith(response.pagination);
								}
							}
						}
					},
					complete: function () {
						setLoading(false);
						cfg.onAfterUpdate();
					},
					error: function () {
						console.error("TableUtils: AJAX request failed for", url);
					}
				});
			}

			// Pagination
			$root.on("click" + ns, ".pagination a", function (e) {
				e.preventDefault();
				var href = $(this).attr("href") || cfg.baseUrl;
				refresh(href, cfg.additionalParams());
			});

			// Per-page (bind at document in case control is outside root)
			if (cfg.perPageSelectSelector) {
				$(document).on("change" + ns, cfg.perPageSelectSelector, function () {
					var perPage = $(this).val();
					var params = $.extend({}, cfg.additionalParams());
					params[cfg.paramNames.perPage] = perPage;
					var url = buildUrl(cfg.baseUrl, params);
					refresh(url);
				});
			}

			// Search (bind at document in case control is outside root)
			if (cfg.searchInputSelector) {
				$(document).on("keyup" + ns, cfg.searchInputSelector, function () {
					var term = $(this).val();
					var params = $.extend({}, cfg.additionalParams());
					params[cfg.paramNames.search] = term;
					var url = buildUrl(cfg.baseUrl, params);
					refresh(url);
				});
			}

			// Sort
			if (cfg.sortTriggerSelector) {
				$root.on("click" + ns, cfg.sortTriggerSelector, function () {
					var $el = $(this);
					var sortBy = $el.data("sort");
					var currentOrder = $el.data("order") || "asc";
					var newOrder = currentOrder === "asc" ? "desc" : "asc";
					var params = $.extend({}, cfg.additionalParams());
					params[cfg.paramNames.sortBy] = sortBy;
					params[cfg.paramNames.sortOrder] = newOrder;
					var perPage = $(cfg.perPageSelectSelector).val();
					if (perPage) params[cfg.paramNames.perPage] = perPage;
					var url = buildUrl(cfg.baseUrl, params);
					refresh(url);
					$el.data("order", newOrder);
				});
			}

			// Export - Excel
			if (cfg.export && cfg.export.excelButtonSelector) {
				$root.on("click" + ns, cfg.export.excelButtonSelector, function () {
					if (!window.XLSX || !window.XLSX.utils) {
						console.warn("TableUtils: XLSX not available for Excel export");
						return;
					}
					var rootEl = $root.get(0);
					var table = rootEl ? rootEl.querySelector(cfg.tableSelector) : document.querySelector(cfg.tableSelector);
					if (!table) return;
					var clone = table.cloneNode(true);
					if (cfg.export.excludeLastColumn) removeLastColumn(clone);
					var workbook = window.XLSX.utils.book_new();
					var worksheet = window.XLSX.utils.table_to_sheet(clone);
					window.XLSX.utils.book_append_sheet(workbook, worksheet, cfg.export.title || "Table");
					window.XLSX.writeFile(workbook, (cfg.export.fileName || "table") + ".xlsx");
				});
			}

			// Export - PDF
			if (cfg.export && cfg.export.pdfButtonSelector) {
				$root.on("click" + ns, cfg.export.pdfButtonSelector, function () {
					var jsPDF = window.jspdf && window.jspdf.jsPDF;
					if (!jsPDF) {
						console.warn("TableUtils: jsPDF not available for PDF export");
						return;
					}
					var rootEl = $root.get(0);
					var table = rootEl ? rootEl.querySelector(cfg.tableSelector) : document.querySelector(cfg.tableSelector);
					if (!table) return;
					var clone = table.cloneNode(true);
					if (cfg.export.excludeLastColumn) removeLastColumn(clone);
					var doc = new jsPDF();
					if (doc.autoTable) {
						doc.autoTable({ html: clone, startY: 10 });
					}
					doc.save((cfg.export.fileName || "table") + ".pdf");
				});
			}

			// Export - Print
			if (cfg.export && cfg.export.printButtonSelector) {
				$root.on("click" + ns, cfg.export.printButtonSelector, function () {
					var rootEl = $root.get(0);
					var table = rootEl ? rootEl.querySelector(cfg.tableSelector) : document.querySelector(cfg.tableSelector);
					if (!table) return;
					var clone = table.cloneNode(true);
					if (cfg.export.excludeLastColumn) removeLastColumn(clone);
					var w = window.open("", "_blank");
					if (!w) return;
					w.document.write("<html><head><title>" + (cfg.export.title || "Table") + "</title></head><body>");
					w.document.write(clone.outerHTML);
					w.document.write("</body></html>");
					w.document.close();
					w.print();
				});
			}
		}
	};

	// Auto initialization using data attributes
	TableUtils.autoInit = function () {
		var ATTR = {
			root: "tableUtils",
			table: "tableSelector",
			tableContainer: "tableContainerSelector",
			pagination: "paginationContainerSelector",
			loading: "loadingContainerSelector",
			search: "searchInputSelector",
			perPage: "perPageSelectSelector",
			sort: "sortTriggerSelector",
			baseUrl: "baseUrl",
			excel: "excelButtonSelector",
			pdf: "pdfButtonSelector",
			print: "printButtonSelector",
			fileName: "fileName",
			title: "title",
			excludeLast: "excludeLastColumn",
			paramSearch: "paramSearch",
			paramSortBy: "paramSortBy",
			paramSortOrder: "paramSortOrder",
			paramPerPage: "paramPerPage",
			paramPage: "paramPage"
		};

		var $instances = $('[data-' + ATTR.root + ']');

		console.log($instances);

		// If no declarative instances, try sensible defaults for common pages
		if ($instances.length === 0) {
			var $defaultRoot = $('#table-container');
			if ($defaultRoot.length) {
				var detected = new URLSearchParams(window.location.search);
				var searchParamName = detected.has('name') ? 'name' : 'search';
				TableUtils.init({
					rootSelector: '#table-container',
					tableSelector: '#applicationsTable',
					tableContainerSelector: '#applicationsTable',
					paginationContainerSelector: '.pagination-container',
					loadingContainerSelector: '#table-container',
					searchInputSelector: '#searchInput',
					perPageSelectSelector: ".per-page-select, select[name='per_page']",
					sortTriggerSelector: '.sort',
					baseUrl: window.location.pathname,
					paramNames: {
						search: searchParamName,
						sortBy: 'sort_by',
						sortOrder: 'sort_order',
						perPage: 'per_page',
						page: 'page'
					}
				});
			}
		}

		$instances.each(function () {
			var $container = $(this);
			if ($container.data("tableUtilsBound")) return;

			var opts = {
				rootSelector: this,
				tableSelector: $container.data(ATTR.table) || "table",
				tableContainerSelector: $container.data(ATTR.tableContainer) || "table",
				paginationContainerSelector: $container.data(ATTR.pagination) || ".pagination-container",
				loadingContainerSelector: $container.data(ATTR.loading) || "",
				searchInputSelector: $container.data(ATTR.search) || "",
				perPageSelectSelector: $container.data(ATTR.perPage) || "",
				sortTriggerSelector: $container.data(ATTR.sort) || "",
				baseUrl: $container.data(ATTR.baseUrl) || window.location.pathname,
				export: {
					excelButtonSelector: $container.data(ATTR.excel) || "",
					pdfButtonSelector: $container.data(ATTR.pdf) || "",
					printButtonSelector: $container.data(ATTR.print) || "",
					fileName: $container.data(ATTR.fileName) || "table",
					title: $container.data(ATTR.title) || "Table",
					excludeLastColumn: (function () {
						var v = $container.data(ATTR.excludeLast);
						if (typeof v === "boolean") return v;
						if (typeof v === "string") return v === "true" || v === "1";
						return true;
					})()
				}
			};

			// Allow overriding param names via data attributes; otherwise detect from URL where possible
			var currentParams = new URLSearchParams(window.location.search);
			var paramNames = {
				search: $container.data(ATTR.paramSearch) || (currentParams.has('name') ? 'name' : 'search'),
				sortBy: $container.data(ATTR.paramSortBy) || 'sort_by',
				sortOrder: $container.data(ATTR.paramSortOrder) || 'sort_order',
				perPage: $container.data(ATTR.paramPerPage) || 'per_page',
				page: $container.data(ATTR.paramPage) || 'page'
			};
			opts.paramNames = paramNames;

			TableUtils.init(opts);
		});
	};

	// Default auto-init on DOM ready
	$(function () {
		TableUtils.autoInit();
	});

	window.TableUtils = TableUtils;

})(window, window.jQuery);


