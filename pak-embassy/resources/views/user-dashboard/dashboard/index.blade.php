{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}

{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Embassy</title>--}}
{{--    <!-- <link rel="icon" href="images/favicon-ion.png" type="image/x-icon"> -->--}}
{{--    <link rel="stylesheet" href="css/font-awesome.css">--}}
{{--    <link rel="stylesheet" href="css/bootstrap.css">--}}
{{--    <link rel="stylesheet" href="css/jQuery-Ui.css">--}}
{{--    <link rel="stylesheet" href="css/apex-chart.css">--}}
{{--    <link rel="stylesheet" href="css/mainDashboard.css">--}}

{{--</head>--}}

{{--<body>--}}

{{--<div class="content">--}}
{{--    <div class="iq-top-navbar">--}}
{{--        <div class="iq-navbar-custom">--}}
{{--            <div class="navbar-breadcrumb d-flex align-items-center">--}}
{{--                <div class="open-sidebar">--}}
{{--                    <i class="fa-solid fa-bars-staggered ps-0 pe-2"></i>--}}
{{--                </div>--}}
{{--                <h5 class="mb-0">--}}
{{--                    <i class="fa-solid fa-bars me-2 collapse-sidebar"></i>--}}
{{--                    Welcome!--}}
{{--                </h5>--}}
{{--            </div>--}}
{{--            <nav class="navbar navbar-expand-lg">--}}
{{--                <div class="container-fluid justify-content-end">--}}
{{--                    <div class="topBar-right ">--}}

{{--                            <span>--}}
{{--                                <div class="red-notify-dot"></div>--}}
{{--                                <i class="fa-regular fa-bell" style="color: #fff;"></i>--}}
{{--                            </span>--}}
{{--                        <div class="dropdown d-flex">--}}
{{--                            <img class="radius-image p-0" src="images/profile-photo.png" alt="profile-photo">--}}
{{--                            <div class="name-email">--}}

{{--                                <span>admin@admin.com</span>--}}
{{--                                <i class="fa-solid fa-angle-down text-light"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </nav>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="page-content">--}}
{{--        <div class="home-main section">--}}
{{--            <div class="buttonsDates">--}}
{{--                <div>--}}

{{--                    <button type="button" class="btn btn-outline-secondary border-2 button-style">Today</button>--}}
{{--                    <button type="button" class="btn btn-outline-secondary border-2 button-style">Yesterday</button>--}}
{{--                    <button type="button" class="btn btn-outline-secondary border-2 button-style">Last 7--}}
{{--                        Days</button>--}}
{{--                    <button type="button" class="button-style btn btn-outline-secondary">Last 30 Days</button>--}}
{{--                    <button type="button" class="button-style btn btn-outline-secondary">Last 6 Months</button>--}}
{{--                    <button type="button" class="button-style btn btn-outline-secondary">Last Year</button>--}}
{{--                    <div class="date-flex">--}}
{{--                        <div class="date-main">--}}
{{--                            <input type="text" class="rounded-0 border-end " id="from" autocomplete="off"--}}
{{--                                   placeholder="From">--}}
{{--                        </div>--}}
{{--                        <div class="date-main">--}}
{{--                            <input type="text" class="rounded-0" id="to" autocomplete="off" placeholder="To">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <button class="btn btnprint"><img src="images/printCSV.svg" alt=""> Print CSV</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-5 d-flex flex-column">--}}
{{--                    <div class="card h-100">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="main-card">--}}
{{--                                    <div class="first-card">--}}
{{--                                        <span>Welcome Back</span>--}}
{{--                                        <h4>Embassy Staff</h4>--}}
{{--                                    </div>--}}
{{--                                    <div class="second-card ">--}}
{{--                                        <span>470</span>--}}
{{--                                        <p>Total Members</p>--}}
{{--                                        <div class="d-flex gap-4 mt-2">--}}
{{--                                            <div>--}}
{{--                                                <p>companies</p>--}}
{{--                                                <p class="fw-bold">70</p>--}}
{{--                                            </div>--}}
{{--                                            <div>--}}
{{--                                                <p>individuals</p>--}}
{{--                                                <p class="fw-bold">400</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 text-end">--}}
{{--                                <div class="card-image">--}}
{{--                                    <img src="images/card-image.png" alt="Card Image">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-7 d-flex flex-column">--}}
{{--                    <div class="row h-100">--}}
{{--                        <div class="col-md-6 mb-2">--}}
{{--                            <div class="card h-100">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="main-card">--}}
{{--                                            <div class="right-card">--}}
{{--                                                <img class="card-image one" src="images/img-one.png"--}}
{{--                                                     alt="Card Icon">--}}
{{--                                            </div>--}}
{{--                                            <div class="right-card">--}}
{{--                                                <span>Skilled individuals(Diaspora)</span>--}}
{{--                                                <p>400</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- <div class="col-md-6">--}}
{{--                                        <div id="customer-chart"></div>--}}
{{--                                    </div> -->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 mb-2">--}}
{{--                            <div class="card h-100">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="main-card">--}}
{{--                                            <div class="right-card">--}}
{{--                                                <img class="card-image two" src="images/img-two.png"--}}
{{--                                                     alt="Card Icon">--}}
{{--                                            </div>--}}
{{--                                            <div class="right-card">--}}
{{--                                                <span>Companies</span>--}}
{{--                                                <p>70</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- <div class="col-md-6">--}}
{{--                                        <div id="ultraCustomers-chart"></div>--}}
{{--                                    </div> -->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 mt-2">--}}
{{--                            <div class="card h-100">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="main-card">--}}
{{--                                            <div class="right-card">--}}
{{--                                                <img class="card-image three" src="images/img-three.png"--}}
{{--                                                     alt="Card Icon">--}}
{{--                                            </div>--}}
{{--                                            <div class="right-card">--}}
{{--                                                <span>Events</span>--}}
{{--                                                <p>18</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- <div class="col-md-6">--}}
{{--                                        <div id="active-chart"></div>--}}
{{--                                    </div> -->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 mt-2">--}}
{{--                            <div class="card h-100">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="main-card">--}}
{{--                                            <div class="right-card">--}}
{{--                                                <img class="card-image four" src="images/img-four.png"--}}
{{--                                                     alt="Card Icon">--}}
{{--                                            </div>--}}
{{--                                            <div class="right-card">--}}
{{--                                                <span>Co-Working Space</span>--}}
{{--                                                <p>108</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- <div class="col-md-6">--}}
{{--                                        <div id="NonActive-chart"></div>--}}
{{--                                    </div> -->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row my-5 d-flex align-items-stretch">--}}
{{--            <div class="col-12 d-flex mt-2">--}}
{{--                <div class="chart-card card flex-grow-1">--}}
{{--                    <div class="d-flex justify-content-between">--}}
{{--                        <h5 class="fw-bold">Companies & Diaspora</h5>--}}
{{--                        <div>--}}
{{--                            <select class="signup-form-select " aria-label="Default select example">--}}
{{--                                <option>Select Year</option>--}}
{{--                                <option value="1" selected>2024</option>--}}
{{--                                <option value="2">2023</option>--}}
{{--                                <option value="3">2022</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div id="monthly-trans"></div>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--            <div class="col-lg-6 col-md-12 d-flex mt-4">--}}
{{--                <div class="chart-card card flex-grow-1">--}}
{{--                    <div class="d-flex justify-content-between">--}}
{{--                        <h5 class="fw-bold">Diaspora by Level</h5>--}}

{{--                    </div>--}}
{{--                    <div id="payment"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-6 col-md-12 d-flex mt-4">--}}
{{--                <div class="chart-card card flex-grow-1">--}}
{{--                    <div class="d-flex justify-content-between">--}}
{{--                        <h5 class="fw-bold">Diaspora by Ability</h5>--}}

{{--                    </div>--}}
{{--                    <div id="disporaAbility"></div>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--            <div class="col-lg-6 col-md-12 d-flex mt-4">--}}
{{--                <div class="chart-card card flex-grow-1 mature-lead">--}}
{{--                    <div class="ms-3">--}}

{{--                        <span>Total Leads Generated</span>--}}
{{--                        <div class="d-flex">--}}
{{--                            <h4 class="fw-bold">210</h4>--}}
{{--                            <div class="matured-leads">--}}
{{--                                <p>150</p>--}}
{{--                                <p>Matured Leads</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <div id="totalLeads"></div>--}}
{{--                        <div class="total-leads-chart">--}}
{{--                            <span class="fw-bold">60 <br>--}}
{{--                                Pending Leads</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-lg-6 col-md-12 d-flex mt-4">--}}
{{--                <div class="chart-card card flex-grow-1">--}}
{{--                    <div class="ms-3">--}}
{{--                        <h5>Total Matchmaking</h5>--}}
{{--                        <h4 class="fw-bold">1250</h4>--}}

{{--                    </div>--}}
{{--                    <div id="totalMatchmaking"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}


{{--    <!-- Charts Section  -->--}}

{{--    <!-- <div class="chart-card my-4">--}}
{{--        <div class="card">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-4 p-0">--}}
{{--                    <div class="chart-div">--}}
{{--                        <p class="m-0 text-center fw-bold">Time Left for In Progress Tasks</p>--}}
{{--                        <div class="main-chart">--}}
{{--                            <div class="" id="progressTasks"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div> -->--}}
{{--</div>--}}



{{--<script src="js/jQuery.js"></script>--}}
{{--<script src="js/bootstrap.js"></script>--}}
{{--<script src="js/font-awesome.js"></script>--}}
{{--<script src="js/jQuery-ui.js"></script>--}}
{{--<script src="js/apex-chart.js"></script>--}}
{{--<script src="js/main.js"></script>--}}
{{--<script src="js/apex-common.js"></script>--}}



{{--</script>--}}
{{--</body>--}}

{{--</html>--}}

@extends('dashboard-layouts.user-layout.master')
@section('content')
    <div>
        <!-- charts  -->
        @include('user-dashboard.dashboard.cards')
            <!-- Events -->
                @include('user-dashboard.dashboard.events')
    </div>
@endsection
@section('js-file')
@section("js-file")
<script> let listing_url ="{{route('applications.list')}}"</script>
<script src="{{ asset('js/job/job-application-listing.js') }}"></script>
@endsection

