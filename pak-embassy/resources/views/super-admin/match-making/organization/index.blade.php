@extends("layouts.master")
@section("content")
    <div class="page-title">
        <h3>Organizations</h3>
    </div>
    <div class="card border-0 py-3 px-2">
        <div class="row">
            @include('super-admin.match-making.organization.__filters')

            @include('super-admin.match-making.organization.__table')
        </div>
    </div>

@endsection
@section("js-file")
    <script>
        document.querySelector('.btn[data-bs-target="#exampleModalToggle2"]').addEventListener('click', function () {
            const modalElement = document.getElementById('exampleModalToggle2');

            // Wait for the modal to be fully shown
            modalElement.addEventListener('shown.bs.modal', function () {
                setTimeout(function () {
                    const modal = bootstrap.Modal.getInstance(modalElement); // Get the current modal instance
                    if (modal) {
                        modal.hide(); // Close the modal
                    }
                }, 1500); // Close after 2 seconds
            }, { once: true }); // Ensure the event listener runs only once
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
                            $("#organizationMatchMakingTable").html(response.html);

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
                        $("#organizationMatchMakingTable").html(response.html);

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

        $(document).on('change', '.form-select', function() {
            let perPage = $(this).val();
            let url = window.location.origin + window.location.pathname + '?per_page=' + perPage;
            fetchOrganizations(url);
        });

        function fetchOrganizations(url) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#organizationMatchMakingTable').html($(response).find('#organizationMatchMakingTable').html());
                    $('.pagination').html($(response).find('.pagination').html());
                },
                error: function() {
                    alert('Failed to load data');
                }
            });
        }
    </script>

@endsection
