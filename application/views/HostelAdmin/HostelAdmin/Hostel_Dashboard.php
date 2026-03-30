<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<!-- datatable links end -->
<div class="content_wrapper">
    <!-- Dashboard -->
    <div class="myDiv" id="Hos_Dashboard">
        <div class="row">
            <div class="col-md-12 py-3">
                <div class="owl-slider">
                    <div id="card-slider" class="owl-carousel pt-4">
                        <div class="item">
                            <div class="cards border rounded-lg">
                                <div class="card_one bg-transparent flex justify-between items-center px-4">
                                    <div class="icon !size-12 bg-white shadow-sm">
                                        <img src="<?php echo base_url('assets/images/teacher.png'); ?>" class="!w-8">
                                    </div>
                                    <h4 class="text-[#4D53E0]">
                                        <span class="num text-3xl"><?= $grandtotalrooms ?></span>
                                    </h4>
                                </div>
                                <div class="flex justify-between items-center px-4 mb-3">
                                    <span class="text-sm">Total Rooms</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <a href="<?= base_url('HostelAdmin/Hos_Alloted') ?>" target="_blank">
                                <div class="cards border rounded-lg">
                                    <div class="card_one bg-transparent flex justify-between items-center px-4">
                                        <div class="icon !size-12 bg-white shadow-sm">
                                            <img src="<?php echo base_url('assets/images/students.svg'); ?>" class="!w-8">
                                        </div>
                                        <h4 class="text-[#4D53E0]">
                                            <span class="num text-3xl"><?= $AlllotedHostelData ?></span>
                                        </h4>
                                    </div>
                                    <div class="flex justify-between items-center px-4 mb-3">
                                        <span class="text-sm"> Allocated Rooms</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="item">
                            <div class="cards border rounded-lg">
                                <div class="card_one bg-transparent flex justify-between items-center px-4">
                                    <div class="icon !size-12 bg-white shadow-sm">
                                        <img src="<?php echo base_url('assets/images/students.svg'); ?>" class="!w-8">
                                    </div>
                                    <h4 class="text-[#4D53E0]">
                                        <span class="num text-3xl"><?= $grandvacantrooms ?></span>
                                    </h4>
                                </div>
                                <div class="flex justify-between items-center px-4 mb-3">
                                    <span class="text-sm">Vacant Rooms</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <a href="<?= base_url('HostelAdmin/Hos_Past_Hostellers') ?>" target="_blank">
                                <div class="cards border rounded-lg">
                                    <div class="card_one bg-transparent flex justify-between items-center px-4">
                                        <div class="icon !size-12 bg-white shadow-sm">
                                            <img src="<?php echo base_url('assets/images/students.svg'); ?>" class="!w-8">
                                        </div>
                                        <h4 class="text-[#4D53E0]">
                                            <span class="num text-3xl"><?= $ExHostellerCount ?></span>
                                        </h4>
                                    </div>
                                    <div class="flex justify-between items-center px-4 mb-3">
                                        <span class="text-sm">Ex-Hosteller</span>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="item">
                            <div class="cards border rounded-lg">
                                <div class="card_one bg-transparent flex justify-between items-center px-4">
                                    <div class="icon !size-12 bg-white shadow-sm">
                                        <img src="<?php echo base_url('assets/images/students.svg'); ?>" class="!w-8">
                                    </div>
                                    <h4 class="text-[#4D53E0]">
                                        <span class="num text-3xl"><?= $grandtotalbeds ?></span>
                                    </h4>
                                </div>
                                <div class="flex justify-between items-center px-4 mb-3">
                                    <span class="text-sm">Total Beds</span>
                                </div>
                            </div>
                        </div>


                        <div class="item">
                            <div class="cards border rounded-lg">
                                <div class="card_one bg-transparent flex justify-between items-center px-4">
                                    <div class="icon !size-12 bg-white shadow-sm">
                                        <img src="<?php echo base_url('assets/images/students.svg'); ?>" class="!w-8">
                                    </div>
                                    <h4 class="text-[#4D53E0]">
                                        <span class="num text-3xl"><?= $grandavailablebeds ?></span>
                                    </h4>
                                </div>
                                <div class="flex justify-between items-center px-4 mb-3">
                                    <span class="text-sm">Available Beds</span>
                                </div>
                            </div>
                        </div>











                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-8">
                        <!-- -----hosteller By Year -->
                        <div class="bg-white rounded-lg p-3 my-3">
                            <div class="d-flex justify-between pb-3 mb-2 border-b border-gray-200 dark:border-gray-200">
                                <div class="d-flex items-center">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-100 flex items-center justify-center me-3">
                                        <svg class="w-6 h-6 text-gray-500 dark:text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                                            <path
                                                d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                            <path
                                                d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-gray-900 pb-1">
                                            Hosteller By Year</h5>
                                    </div>
                                </div>

                            </div>
                            <div>
                                <div id="Hosteller_recordByYear"></div>
                            </div>
                        </div>

                        <!-- -----Occupancy By Room Type------- -->
                        <div class="bg-white rounded-lg p-3 my-3">
                            <div class="d-flex justify-between pb-3 mb-2 border-b border-gray-200 dark:border-gray-200">
                                <div class="d-flex items-center">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-100 flex items-center justify-center me-3">
                                        <svg class="w-6 h-6 text-gray-500 dark:text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                                            <path
                                                d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                            <path
                                                d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-gray-900 pb-1">
                                            Occupancy By Room Type</h5>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div id="Occupancy_By_Room_Type"></div>
                            </div>
                        </div>
                        <!-- ------------Mess Menu --------- -->

                        <div class="col-12 bg-[#f9fafc] p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h2 class="mb-0">Mess Menu List</h2>
                                <a href="<?= base_url('HostelMessMenu'); ?>" class="btn schl-btn-yellow btn-sm" target="_blank">
                                    View All
                                </a>
                            </div>
                            <table class="table table-responsive table-striped table-hover school-table-1 table-sm"
                                id="HostelMessMenuTable">
                            </table>
                        </div>
                        <!-- -------------->
                        <!-- Social Activity Component -->
                        <div class="flex justify-between border-gray-200 border-b my-4 pb-3 bg-[#f9fafc]">
                            <dl>
                                <dt class="text-base font-normal text-black pb-1"> Social Activity</dt>
                                <span class="text-sm font-normal text-gray-400">Daily updates lists class wise</span>
                            </dl>
                            <div>

                                <a href="<?= base_url('EmployeeSocialActivityList'); ?>" class="btn schl-btn-yellow btn-sm"
                                    target="_blank">View All</a>
                            </div>
                        </div>
                        <div class="owl-slider">

                            <div id="social-slider" class="owl-carousel print_social_news">


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 bg-[#f9fafc] rounded-3">
                        <!--  Vacant Room and allocated room graph -->
                        <div class="bg-white rounded-lg p-3 m-3">
                            <div class="d-flex justify-between pb-3 mb-2 border-b border-gray-200 dark:border-gray-200">
                                <div class="d-flex items-center">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-100 flex items-center justify-center me-3">
                                        <svg class="w-6 h-6 text-gray-500 dark:text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                                            <path
                                                d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                            <path
                                                d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-gray-900 pb-1">
                                            Total Rooms </h5>
                                    </div>
                                </div>
                                <div>
                                    <h4> <span class="schl-text-green"><?= $grandtotalrooms ?></span></h4>
                                </div>
                            </div>
                            <div>
                                <div id="room_Status_chart"></div>
                            </div>
                        </div>
                        <!-- schedule -->
                        <div class="schedule-box py-2 px-3 shadow-sm rounded-md bg-white my-3">
                            <div class="flex text-sm mt-3 justify-content-between">
                                <h2 class="text-sm font-bold text-green-800"> Today Schedule </h2>
                            </div>

                            <!-- Schedule-box -->
                            <?php if (!empty($faculty_timetable)) : ?>
                                <?php foreach ($faculty_timetable as $timetable) : ?>
                                    <div
                                        class="shadow-sm text-sm mt-3 border-l-2 border-blue-300 p-3 relative rounded-sm flex flex-col gap-1 items-start">
                                        <label for="classname">
                                            <?php echo htmlspecialchars($timetable['subject_name']) . ' (' . htmlspecialchars($timetable['subject_code']) . ')'; ?>
                                        </label>
                                        <h5><?php echo date('d-m-Y', strtotime($timetable['lecture_date'])); ?></h5>
                                        <span><?php echo htmlspecialchars($timetable['classlist_name']) . ' ' . htmlspecialchars($timetable['section_name']); ?></span>
                                        <time class="bg-yellow-200 text-black text-xs p-1">
                                            <?php echo date('h:i A', strtotime($timetable['config_start_time'])) . ' to ' . date('h:i A', strtotime($timetable['config_end_time'])); ?>
                                        </time>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p class="text-gray-500">No timetable data available.</p>
                            <?php endif; ?>
                        </div>

                        <div id="academic_month_calendar_id"></div>
                        <!-- Annoucement and events, News -->
                        <div id="event_announcement_id">
                        </div>
                        <!-- News Component -->
                        <div id="news_id">
                        </div>
                        <!-- end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('NewMaster/footer') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- ------------slider=-------------- -->


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
                    items: 1.5
                },

                600: {
                    items: 2.5
                },

                1024: {
                    items: 4
                },

                1366: {
                    items: 4
                }
            }
        });

        jQuery("#social-slider").owlCarousel({
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


        $(document).ready(function() {
            // get_events_announcement_data();
            // get_news_data();
            // get_academic_month_calendar_data();
            get_social_activity_data();
        });
    </script>



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
                    items: 4
                },

                1366: {
                    items: 4
                }
            }
        });
    </script>
    <!-- -------------vacant allocated rrom graph -->
    <script>
        var allocated = <?= $AlllotedHostelData ?>;
        var totalRooms = <?= $grandtotalrooms ?>;
        var vacant = <?= $grandvacantrooms ?>;

        var options = {
            series: [vacant, allocated],
            chart: {
                width: 300,
                type: 'pie',
            },
            labels: [
                `Vacant (${vacant} / ${totalRooms}) - ${((vacant / totalRooms) * 100).toFixed(1)}%`,
                `Allocated (${allocated} / ${totalRooms}) - ${((allocated / totalRooms) * 100).toFixed(1)}%`
            ],
            legend: {
                position: 'bottom'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#room_Status_chart"), options);
        chart.render();
    </script>


    <!-- -----------hosteller by year-------- -->
    <script>
        var chartData = <?= $chartData ?>;

        // Extract categories (years) and series data
        var years = [];
        var maleData = [];
        var femaleData = [];

        chartData.forEach(function(item) {
            years.push(item.year);
            maleData.push(item.male);
            femaleData.push(item.female);
        });

        var options = {
            series: [{
                name: 'Girls',
                data: femaleData
            }, {
                name: 'Boys',
                data: maleData
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            colors: ['#FF69B4', '#007BFF'],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    borderRadius: 5,
                    borderRadiusApplication: 'end'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: years
            },
            yaxis: {
                title: {
                    text: 'Number of Students'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " students";
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#Hosteller_recordByYear"), options);
        chart.render();
    </script>


    <!-- -------------occuancy by room type=-------------- -->
    <script>
        var options = {
            series: [{
                    name: 'Total Rooms',
                    data: <?= $total_rooms_data; ?>
                },
                {
                    name: 'Allotted Rooms',
                    data: <?= $allotted_rooms_data; ?>
                }
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '35%',
                    borderRadius: 5,
                    borderRadiusApplication: 'end'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: <?= $room_type_names; ?> // Dynamic labels like ["AC", "Non-AC"]
            },
            yaxis: {
                title: {
                    text: 'Room Count'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " rooms"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#Occupancy_By_Room_Type"), options);
        chart.render();
    </script>

    <script>
        $(document).ready(function() {
            HostelMessShowData();
        });

        // function HostelMessShowData(parameter = {}) {
        //     // var school_id = "</?= $_SESSION['emp_data_session']['emp_schoolid'] ?>";
        //     // var hostel_id = $('#hostel_id').val();
        //     // var hostel_mess_date = $('#hostel_mess_date').val();
        //     var parameter = {
        //         // 'hostel_id': hostel_id,
        //         // 'school_id': school_id,
        //         // 'hostel_mess_date': hostel_mess_date,

        //     }
        //     DataTableInitialized(
        //         'HostelMessMenuTable', // table_id
        //         "</?= base_url('HostelAdmin/getHostelMessData') ?>", // url
        //         'POST', // method
        //         parameter, // parameter
        //         successDataTableCallbackFunction,
        //         null, // 👈 if your wrapper expects this position
        //         {
        //             searching: false,
        //             lengthChange: false,
        //             paging: false,
        //             info: false,
        //             dom: 't', // Show only table
        //             buttons: [], // Disable buttons
        //             responsive: true // Optional
        //         }



        //     );
        // }

        // function successDataTableCallbackFunction(response) {
        //     var columns = [{
        //             title: "S.No.",
        //             data: null,
        //             render: function(data, type, row, meta) {
        //                 return meta.row + 1; // Returns the row index starting from 1
        //             },
        //             visible: true
        //         },
        //         {
        //             title: "HOSTEL NAME",
        //             data: "hostel_name"
        //         },
        //         {
        //             title: "DATE",
        //             data: "hostel_mess_date"
        //         },

        //         {
        //             title: "DISH NAME",
        //             data: "hostel_mess_dishname"
        //         },
        //     ];

        //     if (response.ApiResponseStatusCode == 200) {
        //         return {
        //             status: response.ApiResponseStatusCode,
        //             columns: columns,
        //             data: response.data
        //         };
        //     } else {
        //         return {
        //             status: response.ApiResponseStatusCode,
        //             columns: columns,
        //             data: []
        //         };
        //     }
        // }

        function HostelMessShowData(parameter = {}) {
            if ($.fn.DataTable.isDataTable('#HostelMessMenuTable')) {
                $('#HostelMessMenuTable').DataTable().clear().destroy();
            }

            $.ajax({
                url: "<?= base_url('HostelAdmin/getHostelMessData') ?>",
                method: "POST",
                data: parameter,
                dataType: "json",
                success: function(response) {
                    if (response.ApiResponseStatusCode == 200) {
                        var serialNumber = 1;
                        $('#HostelMessMenuTable').DataTable({
                            data: response.data,
                            columns: [{
                                    title: "S.No.",
                                    data: null,
                                    render: function(data, type, row, meta) {
                                        return serialNumber++;
                                    }
                                },
                                {
                                    title: "HOSTEL NAME",
                                    data: "hostel_name"
                                },
                                {
                                    title: "DATE",
                                    data: "hostel_mess_date"
                                },
                                {
                                    title: "DISH NAME",
                                    data: "hostel_mess_dishname"
                                }
                            ],
                            drawCallback: function() {
                                serialNumber = 1; // reset counter on each draw
                            },
                            searching: false,
                            lengthChange: false,
                            paging: true, // Enable pagination
                            pageLength: 10, // Show only 10 records
                            info: false,
                            dom: 't',
                            buttons: []
                        });
                    } else {
                        $('#HostelMessMenuTable').DataTable({
                            data: [],
                            columns: [],
                            searching: false,
                            lengthChange: false,
                            paging: true,
                            pageLength: 10,
                            info: false,
                            dom: 't',
                            buttons: []
                        });
                    }
                }
            });
        }
    </script>