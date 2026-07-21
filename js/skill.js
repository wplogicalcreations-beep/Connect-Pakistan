$("#addSkillForm").on("submit", function (e) {
    e.preventDefault();
    let form = this;
    let formData = new FormData(form);
    
    // Get category from button data if available (for category-based views)
    let category = $('[data-bs-target="#staticBackdropAdd"]').data('category');
    
    // If category not in button data, extract from URL
    if (!category) {
        const urlPath = window.location.pathname;
        const categoryMatch = urlPath.match(/\/lov\/category\/(individual|business|embassy)/);
        if (categoryMatch) {
            category = categoryMatch[1];
        }
    }
    
    // Set type based on category
    if (category) {
        formData.set('type', category);
        $('#skillType').val(category);
    }

    $.ajax({
        url: '/skill/store',
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function (response) {
            if (response.success) {
                // Reload the page or refresh table based on context
                if (typeof baseUrl !== 'undefined' && category) {
                    // If we're in category view, reload with correct type filter based on category
                    let typeParam = 'skills'; // Default for individual
                    if (category === 'business') {
                        typeParam = 'service-skills';
                    } else if (category === 'individual') {
                        typeParam = 'skills';
                    }
                    window.location.href = baseUrl + '?type=' + typeParam;
                } else {
                    $("#skillsTable").html(response.html);
                    $("#staticBackdropAdd").modal("hide");
                    form.reset();
                    // Reset type field if in category view
                    if (category) {
                        $('#skillType').val(category);
                    }
                }
                if (typeof showToast !== 'undefined') {
                    showToast(response.message || 'Skill added successfully');
                } else if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Skill added successfully',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            } else {
                if (typeof showToast !== 'undefined') {
                    showToast(response.message);
                }
            }
        },
        error: function (xhr) {
            let msg = "An error occurred while saving.";
            if (xhr.responseJSON && xhr.responseJSON.message) {
                msg = xhr.responseJSON.message;
            }
            if (typeof showToast !== 'undefined') {
                showToast(msg);
            } else if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: msg
                });
            }
        }
    });
});

$('#skillsTable').on('click', 'a[data-bs-target="#staticBackdrop"]', function () {
    const id = $(this).data('id');
    const name = $(this).data('name');
    $('#editSkillForm').attr('action', '/skills/' + id);
    $('#editSkillName').val(name);
});

$(document).ready(function () {

    let currentSkillId = null;

    // Modal open hone par id aur name set karo
    $('#staticBackdrop').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        currentSkillId = button.data('id'); // id yaad rakhna
        let skillName = button.data('name');
        let skillType = button.data('type'); // Get type from data attribute

        $('#editSkillName').val(skillName);
        if (skillType) {
            $('#editSkillType').val(skillType);
        }
    });

    // Save button click par AJAX call
    $('#saveSkillBtn').on('click', function () {
        let formData = new FormData($('#editSkillForm')[0]);

        $.ajax({
            url: "/skill/update/" + currentSkillId,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function (response) {
                if (response.success) {
                    $("#skillsTable").html(response.html);
                    $('#staticBackdrop').modal('hide');
                    showToast(response.message);
                } else {
                    showToast(response.message);
                }
            },
            error: function (xhr) {
                let msg = 'An error occurred while updating.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                showToast(msg);
            }
        });
    });

});


$(document).ready(function () {
    let deleteId = null;

    // When delete link is clicked, store ID
    $(document).on('click', '.delete-skill', function () {
        deleteId = $(this).data('id'); // skill id
    });

    // Confirm Delete button click
    $(document).on('click', '#confirmDeleteBtn', function () {
        if (deleteId) {
            $.ajax({
                url: 'skill/delete/' + deleteId,   // Adjust if your route differs
                type: 'DELETE',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    // Close modal
                    $('#exampleModalToggle').modal('hide');
                    // Optionally remove the row/item from DOM
                    $('#skills-' + deleteId).hide();
                    $('#exampleModalToggle2').modal('show');
                },
                error: function (xhr) {
                    alert('Something went wrong');
                }
            });
        }
    });
});



$(document).on('keyup', '.search-input', function() {
    let value = $(this).val().toLowerCase().trim();
    $('#skillsTable tr').each(function() {
        let name = $(this).find('.dept-name').text().toLowerCase().trim();
        $(this).toggle(name.includes(value));
    });
    let counter = 1;
    $('#skillsTable tr:visible').each(function() {
        $(this).find('.sr-number').text(counter++);
    });
});

$('.btn-excel').on('click', function() {
    var table = document.getElementById('skillsTable');
    var wb = XLSX.utils.book_new();
    var clone = table.cloneNode(true);
    clone.querySelectorAll('tr').forEach(row => row.removeChild(row.lastElementChild));
    var ws = XLSX.utils.table_to_sheet(clone);
    XLSX.utils.book_append_sheet(wb, ws, "skills");
    XLSX.writeFile(wb, "skills.xlsx");
});

$('.btn-pdf').on('click', function() {
    const { jsPDF } = window.jspdf;
    var doc = new jsPDF();
    var table = document.getElementById('skillsTable');
    var clone = table.cloneNode(true);
    clone.querySelectorAll('tr').forEach(row => row.removeChild(row.lastElementChild));
    doc.autoTable({
        html: clone,
        startY: 10,
    });
    doc.save('skills.pdf');
});

$('.btn-print').on('click', function() {
    var table = document.getElementById('skillsTable');
    var clone = table.cloneNode(true);
    clone.querySelectorAll('tr').forEach(row => row.removeChild(row.lastElementChild));
    var newWin = window.open('', '_blank');
    newWin.document.write('<html><head><title>Skills</title>');
    newWin.document.write('<link rel="stylesheet" href="your-css-path.css">'); // optional
    newWin.document.write('</head><body>');
    newWin.document.write(clone.outerHTML);
    newWin.document.write('</body></html>');
    newWin.document.close();
    newWin.print();
});


$(document).ready(function () {
    $('#staticBackdrop').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var skillId = button.data('id');
        var skillName = button.data('name');
        $('#editSkillName').val(skillName);
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
                $("#skillsTable").html(response.html);

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
    let perPage = $(this).val();
    let url = "?per_page=" + perPage;

    $.ajax({
        url: url,
        type: "GET",
        beforeSend: function () {
            $("#table-container").addClass("loading");
        },
        success: function (response) {
            if (response.success) {
                // update table rows
                $("#skillsTable").html(response.html);

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

        $.ajax({
            url: url,
            type: 'GET',
            data: {name: search},
            success: function (response) {
                if (response.success) {
                    // update table rows
                    $("#skillsTable").html(response.html);

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
                $("#skillsTable").html(response.html);
                $(".pagination-container").replaceWith(response.pagination);
            }
        }
    });

    $(this).data("order", newOrder); // toggle order
});
