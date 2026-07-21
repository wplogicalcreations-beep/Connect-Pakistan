@extends('dashboard-layouts.user-layout.master')

@section('content')
    <div class="card border-0 py-3 px-2 my-4">
        <div class="row">
            <div class="col-12 col-md-12 px-4">
                <div class="input-group mb-3 drop-buttons">
                    <button class="btn btn-outline-secondary dropdown-toggle filter-button" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('user-dash-img/filter-icon.svg')}}" alt="Filter Icon">Filters
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>

                    </ul>
                    <input type="text" class="form-control search-input" placeholder="Search"
                        aria-label="Text input with dropdown button">
                </div>
            </div>

            <div class="col-md-12">
                <div class="table-responsive view-table">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Sr:<img class="sort-arrow" src="{{ asset('user-dash-img/sort-arrow.svg')}}" alt="Sort Arrow">
                                </th>
                                <th>Company Name <img class="sort-arrow" src="{{ asset('user-dash-img/sort-arrow.svg')}}" alt="Sort Arrow">
                                </th>
                                <th>Job Title <img class="sort-arrow" src="{{ asset('user-dash-img/sort-arrow.svg')}}" alt="Sort Arrow">
                                </th>
                                <th>Job Type <img class="sort-arrow" src="{{ asset('user-dash-img/sort-arrow.svg')}}" alt="Sort Arrow">
                                </th>
                                <th>Work Mode<img class="sort-arrow" src="{{ asset('user-dash-img/sort-arrow.svg')}}" alt="Sort Arrow">
                                </th>
                                <th>Expert Level <img class="sort-arrow" src="{{ asset('user-dash-img/sort-arrow.svg')}}" alt="Sort Arrow">
                                </th>
                                <th>Status <img class="sort-arrow" src="{{ asset('user-dash-img/sort-arrow.svg')}}" alt="Sort Arrow">
                                </th>
                                <th>Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>MYTM,LLC</td>
                                <td>Software Engineer</td>
                                <td>Full-Time</td>
                                <td>On-Site</td>
                                <td>Mid-Level</td>
                                <td><span class="badge bg-success-2 p-2">Active</span></td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop"><img src="images/edit.svg"
                                                        class="me-2" alt="Edit-icon">Edit </a></li>
                                            <li>
                                                <a class="dropdown-item" href="complaint-assign.html">
                                                    <img src="images/assign.svg" class="me-2" alt="assign-icon">Assign
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" data-bs-toggle="modal" href="#exampleModalToggle"
                                                    role="button"><img src="images/delete-icon.svg" class="me-2"
                                                        alt="delete-icon">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>


                            </tr>
                            <tr>
                                <td>1</td>
                                <td>MYTM,LLC</td>
                                <td>Software Engineer</td>
                                <td>Full-Time</td>
                                <td>On-Site</td>
                                <td>Mid-Level</td>
                                <td><span class="badge bg-success-2 p-2">Active</span></td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop"><img src="images/edit.svg"
                                                        class="me-2" alt="Edit-icon">Edit </a></li>
                                            <li>
                                                <a class="dropdown-item" href="complaint-assign.html">
                                                    <img src="images/assign.svg" class="me-2" alt="assign-icon">Assign
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" data-bs-toggle="modal" href="#exampleModalToggle"
                                                    role="button"><img src="images/delete-icon.svg" class="me-2"
                                                        alt="delete-icon">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>


                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 center">
                <div class="pagination-container mb-3">
                    <div class="rows-info">
                        <span>Showing 1 to 30 of 93 entries</span>
                        <select class="form-select form-select-sm  bg-transparent" style="width: auto;">
                            <option value="10">10</option>
                            <option value="30" selected>30</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#"><i
                                    class="fas fa-angle-double-left"></i></a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a>
                        </li>
                        <input type="number" class="btn-common-bg text-light border-0 text-center" name="number"
                            id="number" value="1">
                        <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#"><i
                                    class="fas fa-angle-double-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-file')
@endsection
