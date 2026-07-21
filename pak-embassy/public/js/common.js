$(document).on('click', '.load-more', function () {
    let button = $(this);
    let page = button.data('page');
    let target = button.data('target');
    let url = button.data('url');

    $.ajax({
        url: url + "?page=" + page,
        type: "GET",
        success: function (data) {
            $(target).append(data.html);
            if (data.hasMorePages) {
                button.data('page', page + 1); // increase page
            } else {
                button.hide(); // hide button when no more pages
            }
        }
    });
});

$(document).ready(function() {
    // Function to submit form via AJAX
    function submitForm() {
        $.ajax({
            url: $form.attr('action'),
            method: $form.attr('method'),
            data: $form.serialize(),
            success: function(response) {
                result.html(response.html);

                if (response.hasMorePages) {
                    loadmore.show();
                } else {
                    loadmore.hide();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    }

    // Debounce function for keyup
    var typingTimer;
    var typingInterval = 500; // 500ms delay

    // Trigger on search input keyup
    $form.find('input[name="title"]').on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(submitForm, typingInterval);
    });
    $form.find('input[name="name"]').on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(submitForm, typingInterval);
    });
    $form.find('input[name="start_date"]').on('change', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(submitForm, typingInterval);
    });

    // Trigger on location input keyup
    $form.find('input[name="location"]').on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(submitForm, typingInterval);
    });

    // Trigger on dropdown change
    $form.find('select').on('change', submitForm);

    // Prevent normal form submission
    $form.on('submit', function(e) {
        e.preventDefault();
        submitForm();
    });
});