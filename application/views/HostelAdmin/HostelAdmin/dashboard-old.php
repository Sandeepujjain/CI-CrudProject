<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.2.2/css/bootstrap.min.css">
<!-- bootstrap icon link -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

<!-- datatable links start  -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

<!-- datatable links end -->
<div class="content_wrapper">
    <!-- Dashboard -->
    <div class="myDiv" id="Hos_Dashboard">
        <div class="row">
            <div class="col-md-9 bg-light rounded py-3">
                <div class="owl-slider">
                    <div id="card-slider" class="owl-carousel pt-4">
                        <div class="item">
                            <div class="cards">
                                <div class="card_one">
                                    <div class="icon">
                                        <img src="<?php echo base_url('assets/images/students.svg'); ?>">
                                    </div>
                                    <div class="content">
                                        <h6>Students Allocated
                                            <span></span>
                                        </h6>
                                        <span class="num">1000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="cards">
                                <div class="card_one card_blue">
                                    <div class="icon">
                                        <img src="<?php echo base_url('assets/images/teacher.png'); ?>">
                                    </div>
                                    <div class="content">
                                        <h6>Vaccant
                                            <span>Rooms</span>
                                        </h6>
                                        <span class="num">12/500</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="cards">
                                <div class="card_one card_orange">
                                    <div class="icon">
                                        <img src="<?php echo base_url('assets/images/setting.png'); ?>">
                                    </div>
                                    <div class="content">
                                        <h6>Ex-Hosteller</h6>
                                        <span class="num">5000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- line chart and bar chart for Hostellers by Year-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="dashboardcard bg-white">
                            <div class="head">
                                Hostellers by Year
                            </div>
                            <canvas id="chLine" class="p-2"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dashboardcard bg-white">
                            <div class="head">
                                Student Mess Attendance
                            </div>
                            <canvas id="chBar" class="p-2"></canvas>
                        </div>
                    </div>
                </div>
                <!-- end -->
                <!-- Menu -->
                <div class="dashboardcard bg-white mt-2">
                    <div class="head">
                        Menu Cards
                    </div>
                    <div class="owl-slider p-2">
                        <div id="leave-slider" class="owl-carousel pt-4 custom-slide">
                            <div class="item">
                                <div class="leave_card">
                                    <div class="content">
                                        <h6>
                                            Breakfast
                                            <span>Pongal/Upuma, Medhu Vadai(2 Nos.), Sambar, Coconut Chutney, Bread,
                                                Butter Jam, Coffee/Tea, Milk</span>
                                        </h6>
                                        <span class="date">
                                            <i class="far fa-calendar-alt"></i> 20Aug2023 Monday
                                        </span>
                                    </div>
                                    <div class="foot_action">
                                        <button class="btn btn-sm">Time: 7.30 AM TO 10.15 AM</button>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="leave_card">
                                    <div class="content">
                                        <h6>
                                            Lunch
                                            <span>Fulka, Peas Masala, Dry Ladies finger fry, Plain rice, sambar, Rasam,
                                                Curd, Appalam, Pickles</span>
                                        </h6>
                                        <span class="date">
                                            <i class="far fa-calendar-alt"></i> 20Aug2023 Monday
                                        </span>
                                    </div>
                                    <div class="foot_action">
                                        <button class="btn btn-sm">Time: 12.30PM TO 2.30PM.</button>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="leave_card">
                                    <div class="content">
                                        <h6>
                                            Snacks
                                            <span>Bhelpuri, Tea/ Coffee, Milk</span>
                                        </h6>
                                        <span class="date">
                                            <i class="far fa-calendar-alt"></i> 20Aug2023 Monday
                                        </span>
                                    </div>
                                    <div class="foot_action">
                                        <button class="btn btn-sm">Time: 4.30PM TO 5.30PM.</button>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="leave_card">
                                    <div class="content">
                                        <h6>
                                            Dinner
                                            <span>Chappathi, Dhal or Alu kurma, Bisibelabaath, Onion-Raitha, Fruit salad
                                                (1 cup), IceCream, Potato chips, Pickles, Butter Milk</span>
                                        </h6>
                                        <span class="date">
                                            <i class="far fa-calendar-alt"></i> 20Aug2023 Monday
                                        </span>
                                    </div>
                                    <div class="foot_action">
                                        <button class="btn btn-sm">Time: 7.30PM TO 9.30PM</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end -->
                <!-- pie chart -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="dashboardcard bg-white">
                            <div class="head">
                                Total Students
                            </div>
                            <div id="chartO" class="chart-container"></div>
                            <div class="chart-text"></div>
                            <div class="chart-footer"> *Data from the last 12 months, includes retakes</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dashboardcard bg-white">
                            <div class="head">
                                <div class="row">
                                    <div class="col">
                                        Student Attendance
                                    </div>
                                </div>
                            </div>
                            <div>
                                <canvas width="500" id="StudAttendance"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Active Classes/Course Overview  -->
                <div class="dashboardcard bg-white mt-2">
                    <div class="head">
                        <div class="row p-2">
                            <div class="col">
                                Vacant Rooms and Availability
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-2">
                            <select class="form-select form-select-sm filter-select">
                                <option selected>Room Type</option>
                                <option value="1">AC</option>
                                <option value="2">Non-AC</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <select class="form-select form-select-sm filter-select">
                                <option selected>Occupany Type</option>
                                <option value="1">Single</option>
                                <option value="2">Double</option>
                                <option value="3">Triple</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row m-0 row-cols-3 flex-nowrap w-100 overflow-auto">
                    <div class="col">
                        <div class="card shadow rounded card1">
                            <div class="row pt-2">
                                <div class="col-6 mx-1 schl-text-blue border-bottom">
                                    I-122
                                </div>
                            </div>
                            <div class="row row-col-auto px-2">
                                <div class="myfont2">
                                    Facilities: AC,Fan,Table,Chair,Almirah,Bed
                                </div>
                                <div class="myfont2">
                                    Occupancy: Single
                                </div>
                            </div>
                            <div class="row p-2 text-end myfont"><a href="#Hos_Allotment">Allot</a></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow rounded card1">
                            <div class="row pt-2">
                                <div class="col-6 mx-1 schl-text-blue border-bottom">
                                    I-122
                                </div>
                            </div>
                            <div class="row row-col-auto px-2">
                                <div class="myfont2">
                                    Facilities: AC,Fan,Table,Chair,Almirah,Bed
                                </div>
                                <div class="myfont2">
                                    Occupancy: Single
                                </div>
                            </div>
                            <div class="row p-2 text-end myfont"><a href="#Hos_Allotment">Allot</a></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow rounded card1">
                            <div class="row pt-2">
                                <div class="col-6 mx-1 schl-text-blue border-bottom">
                                    I-122
                                </div>
                            </div>
                            <div class="row row-col-auto px-2">
                                <div class="myfont2">
                                    Facilities: AC,Fan,Table,Chair,Almirah,Bed
                                </div>
                                <div class="myfont2">
                                    Occupancy: Single
                                </div>
                            </div>
                            <div class="row p-2 text-end myfont"><a href="#Hos_Allotment">Allot</a></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow rounded card1">
                            <div class="row pt-2">
                                <div class="col-6 mx-1 schl-text-blue border-bottom">
                                    I-122
                                </div>
                            </div>
                            <div class="row row-col-auto px-2">
                                <div class="myfont2">
                                    Facilities: AC,Fan,Table,Chair,Almirah,Bed
                                </div>
                                <div class="myfont2">
                                    Occupancy: Single
                                </div>
                            </div>
                            <div class="row p-2 text-end myfont"><a href="#Hos_Allotment">Allot</a></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow rounded card1">
                            <div class="row pt-2">
                                <div class="col-6 mx-1 schl-text-blue border-bottom">
                                    I-122
                                </div>
                            </div>
                            <div class="row row-col-auto px-2">
                                <div class="myfont2">
                                    Facilities: AC,Fan,Table,Chair,Almirah,Bed
                                </div>
                                <div class="myfont2">
                                    Occupancy: Single
                                </div>
                            </div>
                            <div class="row p-2 text-end myfont"><a href="#Hos_Allotment">Allot</a></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow rounded card1">
                            <div class="row pt-2">
                                <div class="col-6 mx-1 schl-text-blue border-bottom">
                                    I-122
                                </div>
                            </div>
                            <div class="row row-col-auto px-2">
                                <div class="myfont2">
                                    Facilities: AC,Fan,Table,Chair,Almirah,Bed
                                </div>
                                <div class="myfont2">
                                    Occupancy: Single
                                </div>
                            </div>
                            <div class="row p-2 text-end myfont"><a href="#Hos_Allotment">Allot</a></div>
                        </div>
                    </div>
                </div>
                <div class="col text-end">
                    <div class="row p-2 text-end myfont"><a href="#Hos_Alloted">More Details</a></div>
                </div>
                <!-- In-Out Time  -->
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-Present-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-Present" type="button" role="tab" aria-controls="nav-Present"
                            aria-selected="true">Present</button>
                        <button class="nav-link" id="nav-Absent-tab" data-bs-toggle="tab" data-bs-target="#nav-Absent"
                            type="button" role="tab" aria-controls="nav-Absent" aria-selected="false">On Leave</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-Present" role="tabpanel"
                        aria-labelledby="nav-Present-tab" tabindex="0">
                        <div class="row p-2">
                            <table class="table table-responsive table-striped table-hover table-sm school-table"
                                id="myTable_Attendance">
                                <thead>
                                    <th class="col-3">Student Name </th>
                                    <th class="col-2">Student ID </th>
                                    <th class="col-1">Room No. </th>
                                    <th class="col-1">In Time </th>
                                    <th class="col-1">Out Time </th>
                                    <th class="col-1">Total hrs.</th>
                                </thead>
                                <tbody>
                                    <tr class="border-bottom mt-2">
                                        <td class="col-3">
                                            <div class="row">
                                                <div class="col">
                                                    <img src="<?php echo base_url('assets/images/boy2.jpg'); ?>"
                                                        class="rounded w-50" alt="Cinque Terre">
                                                </div>
                                                <div class="col-7">
                                                    <div class="row">
                                                        <div class="col-12 text-start">
                                                            Ajay Vishwanath
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 mynew">
                                                            IX
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-2">Stud002023</td>
                                        <td class="col-1">II-204</td>
                                        <td class="col-1">08:30 A.M.</td>
                                        <td class="col-1">--</td>
                                        <td class="col-1">00.00</td>
                                    </tr>
                                    <tr class="border-bottom p-2 mt-2">
                                        <td class="col-3">
                                            <div class="row">
                                                <div class="col-5">
                                                    <img src="<?php echo base_url('assets/images/girl.jpg'); ?>"
                                                        class="rounded w-50" alt="Cinque Terre">
                                                </div>
                                                <div class="col">
                                                    <div class="row">
                                                        Ashish Shrivastav
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 mynew">
                                                            VIII
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-2">Stud002023</td>
                                        <td class="col-1">I-104</td>
                                        <td class="col-1">08:30 A.M.</td>
                                        <td class="col-1">--</td>
                                        <td class="col-1">00.00</td>
                                    </tr>
                                    <tr class="border-bottom p-2 mt-2">
                                        <td>
                                            <div class="row">
                                                <div class="col-5">
                                                    <img src="<?php echo base_url('assets/images/Sir33.jpg'); ?>"
                                                        class="rounded w-50" alt="Cinque Terre">
                                                </div>
                                                <div class="col">
                                                    <div class="row">
                                                        Ashish Shrivastav
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 mynew">
                                                            XII
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Stud002023</td>
                                        <td>III-304</td>
                                        <td>08:30 A.M.</td>
                                        <td>--</td>
                                        <td>00.00</td>
                                    </tr>
                                    <tr class="border-bottom p-2 mt-2">
                                        <td>
                                            <div class="row">
                                                <div class="col-5">
                                                    <img src="<?php echo base_url('assets/images/Sir22.jpg'); ?>"
                                                        class="rounded w-50" alt="Cinque Terre">
                                                </div>
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            Kamlesh Tripathi
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 mynew">
                                                            VII
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Stud002023</td>
                                        <td>III-304</td>
                                        <td>08:30 A.M.</td>
                                        <td>--</td>
                                        <td>00.00</td>
                                    </tr>
                                    <tr class="border-bottom p-2 mt-2">
                                        <td>
                                            <div class="row">
                                                <div class="col-5">
                                                    <img src="<?php echo base_url('assets/images/maam2.jpg'); ?>"
                                                        class="rounded w-50" alt="Cinque Terre">
                                                </div>
                                                <div class="col-7">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            Vinita Ghosh
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 mynew">
                                                            VIII
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Stud002023</td>
                                        <td>III-304</td>
                                        <td>08:30 A.M.</td>
                                        <td>--</td>
                                        <td>00.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-Absent" role="tabpanel" aria-labelledby="nav-Absent-tab"
                        tabindex="0">
                        <div class="row p-2">
                            <div class="col">
                                <table class="table table-responsive table-striped table-hover table-sm school-table"
                                    id="myTable_Attendance">
                                    <thead>
                                        <th class="col-3">Student Name </th>
                                        <th class="col-2">Student ID </th>
                                        <th class="col-1">Room No. </th>
                                        <th class="col-1">No.Of Days </th>
                                        <th class="col-2">From Date </th>
                                        <th class="col-2">To Date </th>
                                    </thead>
                                    <tbody>
                                        <tr class="border-bottom p-2 mt-2">
                                            <td class="col-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <img src="<?php echo base_url('assets/images/maam4.jpg'); ?>"
                                                            class="rounded w-50" alt="Cinque Terre">
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="row">
                                                            Ajay Vishwanath
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 mynew">
                                                                XII
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="col-2">Stud002023</td>
                                            <td class="col-1">I-114</td>
                                            <td class="col-1">3</td>
                                            <td class="col-2">30-02-2023</td>
                                            <td class="col-2">04-03-2023</td>
                                        </tr>
                                        <tr class="border-bottom p-2 mt-2">
                                            <td class="col-4">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <img src="<?php echo base_url('assets/images/maam7.jpg'); ?>"
                                                            class="rounded w-50" alt="Cinque Terre">
                                                    </div>
                                                    <div class="col">
                                                        <div class="row">
                                                            Ashish Shrivastav</b>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 mynew">
                                                                XII
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="col-2">Stud002023</td>
                                            <td class="col-1">III-314</td>
                                            <td class="col-1">3</td>
                                            <td class="col-2">30-02-2023</td>
                                            <td class="col-2">04-03-2023</td>
                                        </tr>
                                        <tr class="border-bottom p-2 mt-2">
                                            <td>
                                                <div class="row">
                                                    <div class="col-5">
                                                        <img src="<?php echo base_url('assets/images/Sir23.jpg'); ?>"
                                                            class="rounded w-50" alt="Cinque Terre">
                                                    </div>
                                                    <div class="col">
                                                        <div class="row">
                                                            Ashish Shrivastav</b>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 mynew">
                                                                VIII
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Stud002023</td>
                                            <td>I-122</td>
                                            <td class="col-1">3</td>
                                            <td class="col-2">30-02-2023</td>
                                            <td class="col-2">04-03-2023</td>
                                        </tr>
                                        <tr class="border-bottom p-2 mt-2">
                                            <td>
                                                <div class="row">
                                                    <div class="col-5">
                                                        <img src="<?php echo base_url('assets/images/Sir22.jpg'); ?>"
                                                            class="rounded w-50" alt="Cinque Terre">
                                                    </div>
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                Kamlesh Tripathi</b>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 mynew">
                                                                IX
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Stud002023</td>
                                            <td>II-233</td>
                                            <td class="col-1">3</td>
                                            <td class="col-2">30-02-2023</td>
                                            <td class="col-2">04-03-2023</td>
                                        </tr>
                                        <tr class="border-bottom p-2 mt-2">
                                            <td>
                                                <div class="row">
                                                    <div class="col-5">
                                                        <img src="<?php echo base_url('assets/images/maam2.jpg'); ?>"
                                                            class="rounded w-50" alt="Cinque Terre">
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                Vinita Ghosh</b>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 mynew">
                                                                VII
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Stud002023</td>
                                            <td>II-234</td>
                                            <td class="col-1">3</td>
                                            <td class="col-2">30-02-2023</td>
                                            <td class="col-2">04-03-2023</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Rules -->
                <div class="dashboardcard bg-white mt-2">
                    <div class="head">
                        Rules
                    </div>
                    <div class="row p-2 ms-1">
                        <div class="col myfont2">
                            <ol>
                                <li>
                                    1. Loitering in the Hostel campus during the class hours will not be appreciated.
                                </li>
                                <li>
                                    2. Food will be served only in the designated Dining Hall(s) and only during the
                                    specified timings. Wasting food & water will not be encouraged.
                                </li>
                                <li>
                                    3. The Management & Staff will not be responsible for personal belongings.
                                </li>
                                <li>
                                    4. Smoking, Alcohol & Narcotic consumption is strictly prohibited in and around the
                                    Hostel premises. Strict action will be taken against offenders.
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Occupancy By Room Type  -->
                <div class="row mt-2">
                    <div class="col-7">
                        <div class="dashboardcard bg-white">
                            <div class="head">
                                <div class="row">
                                    <div class="col schl-text-green">
                                        Occupancy By Room Type
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-3">
                                    <select class="form-select form-select-sm filter-select">
                                        <option selected>Floor</option>
                                        <option value="1">I</option>
                                        <option value="2">II</option>
                                        <option value="3">III</option>
                                        <option value="3">IV</option>
                                    </select>
                                </div>
                            </div>
                            <div class="container mb-2">
                                <div class="row">
                                    <div class="col">
                                        <!-- chart -->
                                        <div class="wrap">
                                            <div class="holder">
                                                <div class="bar cf" data-percent="90%">
                                                    <span class="label light">AC</span>
                                                </div>
                                                <div class="bar cf" data-percent="90%">
                                                    <span class="label">Non-AC</span>
                                                </div>
                                                <div class="bar cf" data-percent="85%">
                                                    <span class="label">Single </span>
                                                </div>
                                                <div class="bar cf" data-percent="75%">
                                                    <span class="label light">Double </span>
                                                </div>
                                                <div class="bar cf" data-percent="65%">
                                                    <span class="label">Triple </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- chart end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="dashboardcard bg-white">
                            <div class="head">
                                <div class="row">
                                    <div class="col schl-text-green">
                                        Fee Status
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8"></div>
                                <div class="col text-end">
                                    <select class="form-select form-select-sm filter-select">
                                        <option selected>Month</option>
                                        <option value="1">I</option>
                                        <option value="2">II</option>
                                        <option value="3">III</option>
                                        <option value="3">IV</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <canvas width="500" id="chartdoughnut"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 dashboard-sidebar">
                <!-- welcome msg  user infpo-->
                <div class="welcome_msg d-flex justify-content-end">
                    <h1>
                        Have a good day, Hostel Admin!
                        <span>
                            Monday, 14 March
                        </span>
                    </h1>
                    <div class="user_img justify-content-end">
                        <img src="<?php echo base_url('assets/images/Sir.jpg'); ?>">
                    </div>
                </div>
                <!-- end -->
                <!-- upcoming events -->
                <div class="upcoming_events mt-3">
                    <div class="head schl-text-green">
                        Upcoming Events
                    </div>
                    <nav>
                        <div class="nav nav-tabs events-tab d-flex" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-Events-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-Events" type="button" role="tab" aria-controls="nav-Events"
                                aria-selected="true">Events</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                aria-selected="false">Holidays</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                                aria-selected="false">Birthdays</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-Events" role="tabpanel"
                            aria-labelledby="nav-Events-tab" tabindex="0">
                            <div class="events_box">
                                <span>25 Oct 2023</span>
                                <h4>Annual Day</h4>
                                <p>Annual Day will celebrated on 25 Oct</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                            tabindex="0">
                            <div class="events_box">
                                <span>15 Aug 2023</span>
                                <h4>Independence Day</h4>
                                <p>Independence Day is celebrated annually on 15 August as a public holiday in India</p>
                            </div>
                            <div class="events_box">
                                <span class="white-color">15 Aug 2023</span>
                                <h4>Independence Day</h4>
                                <p>Independence Day is celebrated annually on 15 August as a public holiday in India</p>
                            </div>
                            <div class="events_box">
                                <span class="orange-color">15 Aug 2023</span>
                                <h4>Independence Day</h4>
                                <p>Independence Day is celebrated annually on 15 August as a public holiday in India</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"
                            tabindex="0">
                            <div class="events_box">
                                <span>Today's Birthdays</span>
                                <div class="row row-cols-auto">
                                    <div class="leave_card">
                                        <div class="techimg">
                                            <img src="<?php echo base_url('assets/images/Sir.jpg'); ?>">
                                        </div>
                                    </div>
                                    <div class="schl-text-blue birth mt-2">
                                        Nishant Singh Gadok
                                    </div>
                                    <div class="leave_card">
                                        <div class="techimg">
                                            <img src="<?php echo base_url('assets/images/Sir.jpg'); ?>">
                                        </div>
                                    </div>
                                    <div class="schl-text-blue birth mt-2">
                                        Nishant Singh Gadok
                                    </div>
                                    <div class="leave_card">
                                        <div class="techimg">
                                            <img src="<?php echo base_url('assets/images/Sir.jpg'); ?>">
                                        </div>
                                    </div>
                                    <div class="schl-text-blue birth mt-2">
                                        Nishant Singh Gadok
                                    </div>
                                    <div class="leave_card">
                                        <div class="techimg">
                                            <img src="<?php echo base_url('assets/images/Sir.jpg'); ?>">
                                        </div>
                                    </div>
                                    <div class="schl-text-blue birth mt-2">
                                        Nishant Singh Gadok
                                    </div>
                                </div>
                            </div>
                            <div class="events_box">
                                <span class="orange-color">Upcoming Birthdays</span>
                                <div class="row m-0 leave_card row-cols-4 flex-nowrap w-100 overflow-auto">
                                    <div class="techimg">
                                        <img src="<?php echo base_url('assets/images/Sir.jpg'); ?>">
                                    </div>
                                    <div class="techimg">
                                        <img src="<?php echo base_url('assets/images/Sir.jpg'); ?>">
                                    </div>
                                    <div class="techimg">
                                        <img src="<?php echo base_url('assets/images/Sir.jpg'); ?>">
                                    </div>
                                    <div class="techimg">
                                        <img src="<?php echo base_url('assets/images/Sir.jpg'); ?>">
                                    </div>
                                    <div class="techimg">
                                        <img src="<?php echo base_url('assets/images/Sir.jpg'); ?>">
                                    </div>
                                    <div class="techimg">
                                        <img src="<?php echo base_url('assets/images/Sir.jpg'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Hostel modal popup end -->
    <div class="modal fade" id="hostelviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Add Hosteler </h5>
                    <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('MasterAdmin'); ?>" id="" enctype="multipart/form-data"
                        method="post" novalidate="novalidate">
                        <div class="mb-3">
                            <label class="form-label">
                                Date
                            </label>
                            <div >
                                <input type="date" class="form-control" name="" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                Hosteler Id
                            </label>
                            <div >
                                <br />
                                <input type="text" class="form-control" required />
                                <span class="form-label"> <i class="fa-regular fa-pen-to-square me-2"></i>Enter
                                    ID</span>
                            </div>
                        </div>
                        <div class="col text-end">
                            <button type="submit" class="btn schl-btn-white">
                                <img width="40" height="40" src="https://img.icons8.com/clouds/100/plus.png"
                                    alt="plus" />
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Hostel modal popup end -->
    <!-- Alloted STart -->
    <div class="myDiv" id="Hos_Alloted" style="display:none;">
        <div class="row">
            <div class="col-md-5">
                <h4 class="sub-heading">
                    <i class="fa-solid fa-square-plus m-1"></i>
                    <span class="underline"><b>Alloted</b>
                        <i class="fa-solid fa-circle"></i></span>
                </h4>
            </div>
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href=""><img height="15"
                                    width="15" class="mb-1"
                                    src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a></li>
                        <li class="breadcrumb-item"><a href="#">Hostel Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Alloted</li>
                    </ol>
                </nav>
            </div>
        </div>
        <form action="<?php echo base_url('MasterAdmin/') ?>" method="post" enctype="multipart/form-data">
            <div class="card card-body schl-btn-lgreen">
                <div class="row align-items-end">
                    <div class="col-md-2">
                        <div class="mb-2">
                            <select class="form-select" name="" required>
                                <option value="" disabled selected></option>
                                <option value="Hostel 1">Hostel 1</option>
                            </select>
                            
                            
                            <label class="form-label">Hostel</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-2">
                            <select class="form-select" name="" required>
                                <option value="" disabled selected></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            
                            
                            <label class="form-label"> Floor</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header schl-text-green">
                    Alloted Hostel List
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-responsive table-striped table-hover table-sm school-table"
                            id="myTable_AllotedAssign">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>FLOOR</th>
                                    <th>ROOM</th>
                                    <th>OCCUPANCY</th>
                                    <th>BED</th>
                                    <th>ASSIGN TO</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>I</td>
                                    <td>I-107</td>
                                    <td>Double Occupancy</td>
                                    <td>B1</td>
                                    <td>Student1</td>
                                    <td>
                                        <button type="submit" class="btn" data-bs-toggle="modal"
                                            data-bs-target="#hostelLeaveModal" data-toggle="tooltip"
                                            data-placement="top" title="Update">
                                            <img width="40" height="40"
                                                src="https://img.icons8.com/clouds/100/available-updates.png"
                                                alt="available-updates" />
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>I</td>
                                    <td>I-107</td>
                                    <td>Double Occupancy</td>
                                    <td>B2</td>
                                    <td>Student2</td>
                                    <td>
                                        <button type="submit" class="btn" data-bs-toggle="modal"
                                            data-bs-target="#hostelLeaveModal" data-toggle="tooltip"
                                            data-placement="top" title="Update">
                                            <img width="40" height="40"
                                                src="https://img.icons8.com/clouds/100/available-updates.png"
                                                alt="available-updates" />
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Alloted End  -->
    <!-- Hostel Admin setup End  -->
</div>




<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- This script code for facility -->
<script type="text/javascript">
$(document).ready(function() {
    window.scrollTo(0, 0);
    var maxFieldLimit = 10; //Input fields increment limitation
    var add_more_button = $('.facility_multi_button'); //Add button selector
    var Fieldwrapper = $('.multiple_facility'); //Input field wrapper
    var fieldHTML =
        '<div class="col-md-3"><div class="row multiple_facility"><div class="col-md-12"><div ><br/><input type="text" class="form-control" style="width:80%"  required/><span class="form-label"> <img  src="<?php echo base_url('assets/images/pen.png'); ?>">&nbsp;&nbsp;Enter Facility</span><a href="javascript:void(0);" <i class="fa-solid fa-square-minus remove_button" style="padding:0px 10px;color: #136695;"></i></a></div></div></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    $(add_more_button).click(function() { //Once add button is clicked
        if (x < maxFieldLimit) { //Check maximum number of input fields
            x++; //Increment field counter
            $(Fieldwrapper).append(fieldHTML); // Add field html
        }
    });
    $(Fieldwrapper).on('click', '.remove_button', function(e) { //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<!-- <-- This script code for Room - -->
<script type="text/javascript">
$(document).ready(function() {
    window.scrollTo(0, 0);
    var maxFieldLimit = 10; //Input fields increment limitation
    var add_more_button = $('.Room_multi_button'); //Add button selector
    var Fieldwrapper = $('.multiple_RoomRow'); //Input field wrapper
    var fieldHTML =
        '<div class="col-md-12"><div class="row multiple_RoomRow"><div class="col-md-2"><div ><br /><input type="text" class="form-control" required/><span class="form-label"> <i class="fa-regular fa-pen-to-square me-2"></i>Enter Room No.</span></div></div><div class="col-md-2"><div ><br /> <input type="text" class="form-control" required/><span class="form-label"> <i class="fa-regular fa-pen-to-square me-2"></i>No. Of Bed</span></div></div><div class="col-md-2"><div class="select mt-4"><select class="select-text   " name=""   required><option value="" disabled selected></option><option value="AC">AC</option> <option value="Non-AC">Non-AC</option></select><label class="form-label">Facility</label></div></div><div class="col-md-2"> <div ><br /><input type="text" class="form-control" required/><span class="form-label"> <i class="fa-regular fa-pen-to-square me-2"></i>Enter Fees/Bed</span></div></div><a style="width:90px;" href="javascript:void(0);" <i class="fa-solid fa-square-minus remove_button mt-4" style="padding:0px 10px;color: #136695;"></i></a></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    $(add_more_button).click(function() { //Once add button is clicked
        if (x < maxFieldLimit) { //Check maximum number of input fields
            x++; //Increment field counter
            $(Fieldwrapper).append(fieldHTML); // Add field html
        }
    });
    $(Fieldwrapper).on('click', '.remove_button', function(e) { //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<!-- This script code for multiple dish -->
<script type="text/javascript">
$(document).ready(function() {
    window.scrollTo(0, 0);
    var maxFieldLimit = 10; //Input fields increment limitation
    var add_more_button = $('.multi_dish_button'); //Add button selector
    var Fieldwrapper = $('.multiple_dish'); //Input field wrapper
    var fieldHTML =
        '<div class="col-md-3"><div class="row row-cols-auto align-items-center multiple_dish"><div class="col-md-10"><div ><br/><input type="text" class="form-control" required/><span class="form-label"><i class="fa-regular fa-pen-to-square me-2"></i> Dish</span></div></div><a href="javascript:void(0);"<button type="button" class="btn p-1 ps-1 pe-1 schl-btn-white remove_button"><i class="fas fa-minus-square"></i></button></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    $(add_more_button).click(function() { //Once add button is clicked
        if (x < maxFieldLimit) { //Check maximum number of input fields
            x++; //Increment field counter
            $(Fieldwrapper).append(fieldHTML); // Add field html
        }
    });
    $(Fieldwrapper).on('click', '.remove_button', function(e) { //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>


<?php $this->load->view('NewMaster/footer') ?>





<!-- owl slider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
jQuery("#card-slider").owlCarousel({
    autoplay: true,
    lazyLoad: true,
    loop: true,
    margin: 15,
    responsiveClass: true,
    autoHeight: true,
    autoplayTimeout: 7000,
    smartSpeed: 800,
    nav: true,
    responsive: {
        0: {
            items: 1
        },

        600: {
            items: 2
        },

        1024: {
            items: 2
        },

        1366: {
            items: 2.5
        }
    }
});
jQuery("#leave-slider").owlCarousel({
    autoplay: true,
    lazyLoad: true,
    loop: true,
    margin: 15,
    responsiveClass: true,
    autoHeight: true,
    autoplayTimeout: 7000,
    smartSpeed: 800,
    nav: true,
    responsive: {
        0: {
            items: 1
        },

        600: {
            items: 2
        },

        1024: {
            items: 2
        },

        1366: {
            items: 2.5
        }
    }
});
</script>

<!-- chart line and bar js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
<script>
/* chart.js chart examples */

// chart colors
var colors = ['#007bff', '#28a745', '#E92E33', '#c3e6cb', '#dc3545', '#6c757d'];

/* large line chart */
var chLine = document.getElementById("chLine");
var chartData = {
    labels: ["2019", "2020", "2021", "2022", "2023", "2024", "2025"],
    datasets: [{
            data: [589, 445, 483, 503, 689, 692, 634],
            backgroundColor: 'transparent',
            borderColor: colors[0],
            borderWidth: 4,
            pointBackgroundColor: colors[0]
        }
        //   {
        //     data: [639, 465, 493, 478, 589, 632, 674],
        //     backgroundColor: colors[3],
        //     borderColor: colors[1],
        //     borderWidth: 4,
        //     pointBackgroundColor: colors[1]
        //   }
    ]
};
if (chLine) {
    new Chart(chLine, {
        type: 'line',
        data: chartData,
        options: {
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false
            },
            responsive: true
        }
    });
}

/* bar chart */
var chBar = document.getElementById("chBar");
if (chBar) {
    new Chart(chBar, {
        type: 'bar',
        data: {
            labels: ["S", "M", "T", "W", "T", "F", "S"],
            datasets: [{
                    label: 'Breakfast',
                    data: [589, 445, 483, 503, 689, 692, 634],
                    backgroundColor: colors[0]
                },
                {
                    label: 'Lunch',
                    data: [639, 465, 493, 478, 589, 632, 674],
                    backgroundColor: colors[1]
                },
                {
                    label: 'Snack',
                    data: [639, 465, 493, 478, 589, 632, 674],
                    backgroundColor: colors[4]
                },
                {
                    label: 'Dinner',
                    data: [639, 465, 493, 478, 589, 632, 674],
                    backgroundColor: colors[5]
                }
            ]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    barPercentage: 0.4,
                    categoryPercentage: 0.5
                }]
            }
        }
    });
}
</script>

<!-- pir chart js -->
<script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script>
//overall
var dataset = [{
    name: 'Female',
    percent: 70,

}, {
    name: 'Male',
    percent: 30
}];

var pie = d3.layout.pie()
    .value(function(d) {
        return d.percent;
    })
    .sort(null)
    .padAngle(.03);

var w = 180,
    h = 180;

var outerRadius = w / 2;
var innerRadius = 50;

var color = d3.scale.ordinal().range(["#596288", "#f7b696"]);

var arc = d3.svg.arc()
    .outerRadius(outerRadius)
    .innerRadius(innerRadius);

var svg = d3.select("#chartO")
    .append("svg")
    .attr({
        width: w,
        height: h,
    }).append('g')
    .attr({
        transform: 'translate(' + w / 2 + ',' + h / 2 + ')'
    });
var path = svg.selectAll('path')
    .data(pie(dataset))
    .enter()
    .append('path')
    .attr({
        d: arc,
        fill: function(d, i) {
            return color(d.data.name);
        }
    });

path.transition()
    .duration(1000)
    .attrTween('d', function(d) {
        var interpolate = d3.interpolate({
            startAngle: 0,
            endAngle: 0
        }, d);
        return function(t) {
            return arc(interpolate(t));
        };
    });

var restOfTheData = function() {
    var text = svg.selectAll('text')
        .data(pie(dataset))
        .enter()
        .append("text")
        .transition()
        .duration(200)
        .attr("transform", function(d) {
            return "translate(" + arc.centroid(d) + ")";
        })
        .attr("dy", ".4em")
        .attr("text-anchor", "middle")
        .text(function(d) {
            return d.data.percent + "%";
        })
        .style({
            fill: '#fff',
            'font-size': '11px'
        });

    var legendRectSize = 20;
    var legendSpacing = 7;
    var legendHeight = legendRectSize + legendSpacing;

    var legend = svg.selectAll('.legend')
        .data(color.domain())
        .enter()
        .append('g')
        .attr({
            class: 'legend',
            transform: function(d, i) {
                //Just a calculation for x & y position
                return 'translate(-35,' + ((i * legendHeight) - 25) + ')';
            }
        });
    legend.append('rect')
        .attr({
            width: legendRectSize,
            height: legendRectSize,
            rx: 20,
            ry: 20
        })
        .style({
            fill: color,
            stroke: color
        });

    legend.append('text')
        .attr({
            x: 30,
            y: 15
        })
        .text(function(d) {
            return d;
        }).style({
            fill: '#16140d',
            'font-size': '12px'
        });
};

setTimeout(restOfTheData, 1000);
</script>

<!-- Employee Attendance -->
<script>
var ctx = document.getElementById("myChartTA").getContext('2d');
var myChartTA = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", ],
        datasets: [{
            label: 'On-Time',
            data: [12, 19, 3, 17, 28, 24, 7],
            backgroundColor: "#007BFF"
        }, {
            label: 'Late',
            data: [3, 2, 5, 5, 2, 3, 1],
            backgroundColor: "#2BB996"
        }, {
            label: 'On-Leave',
            data: [8, 9, 2, 5, 0, 8, 6],
            backgroundColor: "rgba(255,80,0,1)"
        }]
    }
});
</script>


<!-- Occupancy By Room Type -->
<script>
setTimeout(function start() {

    $('.bar').each(function(i) {
        var $bar = $(this);
        $(this).append('<span class="count"></span>')
        setTimeout(function() {
            $bar.css('width', $bar.attr('data-percent'));
        }, i * 100);
    });

    $('.count').each(function() {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).parent('.bar').attr('data-percent')
        }, {
            duration: 2000,
            easing: 'swing',
            step: function(now) {
                $(this).text(Math.ceil(now) + '%');
            }
        });
    });

}, 500)
</script>
<!-- New Enrollments by year -->
<script>
var ctx = document.getElementById("myChart2").getContext('2d');
var myChart2 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["2017", "2018", "2019", "2020", "2021", "2022", "2023", ],
        datasets: [{
            label: 'Year',
            data: [2212, 3119, 2173, 2147, 2778, 3124, 2447, 1424, ],
            backgroundColor: "rgba(153,255,51,1)"
        }]
    }
});
</script>
<!-- Student Attendance  -->
<script>
var ctx = document.getElementById("StudAttendance").getContext('2d');
var StudAttendance = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Absent", "Present"],
        datasets: [{
            backgroundColor: [
                "#FF5000",
                "#2ecc71"
            ],
            data: [16, 64]
        }]
    }
});
</script>
<!-- Course Completion  -->
<script>
var ctx = document.getElementById("chartdoughnut").getContext('2d');
var chartdoughnut = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Paid", "Pending"],
        datasets: [{
            backgroundColor: [
                "#2ecc71",
                "#95a5a6"
            ],
            data: [36, 64]
        }]
    }
});
</script>