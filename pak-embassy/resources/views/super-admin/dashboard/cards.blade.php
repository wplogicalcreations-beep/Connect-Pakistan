<div class="page-content">
    <div class="home-main section">
        <div class="buttonsDates">
            <div class="buttonsDates">
                <div class="row gx-2 gy-2 align-items-center justify-content-end">

                    <!-- Buttons -->
                    <div class="col-6 col-sm-4 col-md-3 col-lg-auto">
                        <button type="button" class="btn btn-outline-secondary w-100 button-style">Today</button>
                    </div>
                    <div class="col-6 col-sm-4 col-md-3 col-lg-auto">
                        <button type="button" class="btn btn-outline-secondary w-100 button-style">Yesterday</button>
                    </div>
                    <div class="col-6 col-sm-4 col-md-3 col-lg-auto">
                        <button type="button" class="btn btn-outline-secondary w-100 button-style">Last 7 Days</button>
                    </div>
                    <div class="col-6 col-sm-4 col-md-3 col-lg-auto">
                        <button type="button" class="btn btn-outline-secondary w-100 button-style">Last 30
                            Days</button>
                    </div>
                    <div class="col-6 col-sm-4 col-md-3 col-lg-auto">
                        <button type="button" class="btn btn-outline-secondary w-100 button-style">Last 6
                            Months</button>
                    </div>
                    <div class="col-6 col-sm-4 col-md-3 col-lg-auto">
                        <button type="button" class="btn btn-outline-secondary w-100 button-style">Last Year</button>
                    </div>

                    <!-- Date Range Inputs -->
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <input type="text" class="form-control" id="from" placeholder="From" autocomplete="off">
                    </div>
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <input type="text" class="form-control" id="to" placeholder="To" autocomplete="off">
                    </div>

                    <!-- Print CSV Button -->
                    <div class="col-12 col-md-6 col-lg-auto">
                        <button class="btn btn-secondary w-100" style="font-size: 10px">
                            <img src="images/printCSV.svg" alt="" class="me-1"> Print CSV
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 d-flex flex-column screen-adjust">
                <div class="card h-100">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="main-card">
                                <div class="first-card">
                                    <span>Welcome Back</span>
                                    <h4>Embassy Staff</h4>
                                </div>
                                <div class="second-card ">
                                    <span>{{ $data['employee_info']['total_employees'] }}</span>
                                    <p>Total Members</p>
                                    <div class="d-flex gap-4 mt-2">
                                        <div>
                                            <p>companies</p>
                                            <p class="fw-bold">{{ $data['employee_info']['organizations']}}</p>
                                        </div>
                                        <div>
                                            <p>individuals</p>
                                            <p class="fw-bold">{{ $data['employee_info']['individuals'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="card-image">
                                <img src="images/card-image.png" alt="Card Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 screen-adjust">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="main-card">
                                        <div class="right-card pb-3">
                                            <img class="card-image one" src="images/img-one.png" alt="Card Icon">
                                        </div>
                                        <div class="right-card">
                                            <span>Skilled Individuals(Diaspora)</span>
                                            <p>{{ $data['employee_info']['individuals'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div id="customer-chart"></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="main-card">
                                        <div class="right-card pb-3">
                                            <img class="card-image two" src="images/img-two.png" alt="Card Icon">
                                        </div>
                                        <div class="right-card">
                                            <span>Companies</span>
                                            <p>{{ $data['employee_info']['organizations'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div id="ultraCustomers-chart"></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="main-card">
                                        <div class="right-card pb-3">
                                            <img class="card-image three" src="images/img-three.png" alt="Card Icon">
                                        </div>
                                        <div class="right-card">
                                            <span>Events</span>
                                            <p>{{ $data['events_count'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div id="active-chart"></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="main-card">
                                        <div class="right-card pb-3">
                                            <img class="card-image four" src="images/img-four.png" alt="Card Icon">
                                        </div>
                                        <div class="right-card">
                                            <span>Co-Working Space</span>
                                            <p>{{ $data['coworking_spaces_count'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div id="NonActive-chart"></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-5 d-flex align-items-stretch">
        <div class="col-12 d-flex mt-2">
            <div class="chart-card card flex-grow-1">
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold">Companies & Diaspora</h5>
                    <div>
                        <select class="form-select " aria-label="Default select example">
                            <option>Select Year</option>
                            <option value="1" selected>2025</option>
                            <option value="2">2023</option>
                            <option value="3">2022</option>
                        </select>
                    </div>
                </div>
                <div id="monthly-trans"></div>
            </div>
        </div>


        <div class="col-lg-6 col-md-12 d-flex mt-4 screen-adjust chart-res">
            <div class="chart-card card flex-grow-1">
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold">Diaspora by Level</h5>

                </div>
                <div id="payment"></div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 d-flex mt-4 screen-adjust chart-res">
            <div class="chart-card card flex-grow-1">
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold">Diaspora by Ability</h5>

                </div>
                <div id="disporaAbility"></div>
            </div>
        </div>


        <div class="col-lg-6 col-md-12 d-flex mt-4 screen-adjust chart-res">
            <div class="chart-card card flex-grow-1 mature-lead">
                <div class="ms-3">

                    <span>Total Leads Generated</span>
                    <div class="d-flex">
                        <h4 class="fw-bold">{{ $data['leads']['leads'] }}</h4>
                        <div class="matured-leads">
                            <p>{{ $data['leads']['matureLeadsCount'] }}</p>
                            <p>Matured Leads</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div id="totalLeads"></div>
                    <div class="total-leads-chart">
                        <span class="fw-bold">{{ $data['leads']['pendingLeadsCount'] }} <br>
                            Pending Leads</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 d-flex mt-4 screen-adjust chart-res">
            <div class="chart-card card flex-grow-1">
                <div class="ms-3">
                    <h5>Total Matchmaking</h5>
                    <h4 class="fw-bold">{{ $data['matchmaking']['total_matches'] }}</h4>

                </div>
                <div id="totalMatchmaking"></div>
            </div>
        </div>
    </div>

</div>
