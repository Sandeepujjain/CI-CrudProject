<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://cdn.tailwindcss.com"></script>


<style>
    .owl-dots {
        display: none;
    }

    .divide_border {
        border-bottom: 1px solid #ffd701;
    }

    .overflow-auto {
        white-space: nowrap;
        /* Prevents wrapping */
        overflow-x: auto;
        /* Enables horizontal scrolling */
        padding-bottom: 10px;
        /* Space for scrollbar */
    }



    .DSh_profile_container img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
    }

    .DSh_student_medal img {
        width: 40px;
        margin-top: 10px;
    }

    .marks {
        font-weight: bold;
        color: #333;
        font-size: 1.2rem;
    }

    /* Animation: Slide up and fade in */
    @keyframes fadeSlideUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .DSh_Top_student_box {
        width: 200px;
        transition: all 0.3s ease;
        animation: fadeSlideUp 0.5s ease forwards;
        opacity: 0;
        /* Start invisible */
    }



    /* Trigger animation when visible */
    #top_students_container .DSh_Top_student_box {
        animation-delay: 0.2s;
        opacity: 1;
    }

    /* Responsive adjustments */
    @media screen and (max-width: 768px) {
        #top_students_container {
            flex-direction: column;
            align-items: center;
        }

        .DSh_Top_student_box {
            width: 100%;
            max-width: 300px;
            transform: none !important;
        }

        .first-place,
        .second-place,
        .third-place {
            transform: none;
        }
    }
</style>


<div class="content_wrapper">
    <div class="mt-4 border-bottom">
        <!-- <h2>Welcome</h2> -->
        <div class="owl-slider">
            <div id="card-slider" class="owl-carousel py-4">
                <!-- Total Staff -->
                <div class="item">
                    <div class="cards border rounded">
                        <a href="<?= base_url('Teacher/ViewHomeWork') ?>" target="_blank">
                            <div class="card_one flex justify-between items-center px-4 mt-2">
                                <div class="icon !size-12 bg-white shadow-sm">
                                    <img src="<?php echo base_url('assets/images/principal/staff.png'); ?>"
                                        class="!w-8">
                                </div>
                                <h4 class="text-[#000]">
                                    <span class="font-bold text-3xl"><?= formatNumberShort($totalempcount); ?></span>
                                </h4>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h3>Total Staff</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Total Employee Leave -->
                <div class="item">
                    <div class="cards border rounded">
                        <a href="<?= base_url('HR/LeaveApproval') ?>" target="_blank">
                            <div class="card_one flex justify-between items-center px-4 mt-2">
                                <div class="icon !size-12 bg-white shadow-sm">
                                    <img src="<?php echo base_url('assets/images/principal/employee_leave.jpg'); ?>"
                                        class="!w-8">
                                </div>
                                <h4 class="text-[#000]">
                                    <span
                                        class="font-bold text-3xl"><?= formatNumberShort($employeeleavecount); ?></span>
                                </h4>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h3>Employee Leave</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Total Student -->
                <div class="item">
                    <div class="cards border rounded">
                        <a href="#" target="_blank">
                            <div class="card_one flex justify-between items-center px-4 mt-2">
                                <div class="icon !size-12 bg-white shadow-sm">
                                    <img src="<?php echo base_url('assets/images/principal/total_student.jpg'); ?>"
                                        class="!w-8">
                                </div>
                                <h4 class="text-[#000]">
                                    <span class="font-bold text-3xl"><?= formatNumberShort($totalstucount); ?></span>
                                </h4>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h3>Total Student</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Students Leave -->
                <div class="item">
                    <div class="cards border rounded">
                        <a href="<?= base_url('Teacher/Student_Leave') ?>" target="_blank">
                            <div class="card_one flex justify-between items-center px-4 mt-2">
                                <div class="icon !size-12 bg-white shadow-sm">
                                    <img src="<?php echo base_url('assets/images/principal/student_leave.jpg'); ?>"
                                        class="!w-8">
                                </div>
                                <h4 class="text-[#000]">
                                    <span
                                        class="font-bold text-3xl"><?= formatNumberShort($totalleavestudentscount); ?></span>
                                </h4>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h3>Students Leave</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Students Present -->
                <div class="item">
                    <div class="cards border rounded">
                        <a
                            href="<?php echo base_url('StudentSection/StudentAttendance?data=' . urlencode(base64_encode(json_encode(["for" => "AdminPanel"])))); ?>">
                            <div class="card_one flex justify-between items-center px-4 mt-2">
                                <div class="icon !size-12 bg-white shadow-sm">
                                    <img src="<?php echo base_url('assets/images/principal/student_present.jpg'); ?>"
                                        class="!w-8">
                                </div>
                                <h4 class="text-[#000]">
                                    <span
                                        class="font-bold text-3xl"><?= formatNumberShort($totalpresentstudentscount); ?></span>
                                </h4>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h3>Students Present</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Students Absent -->
                <div class="item">
                    <div class="cards border rounded">
                        <a
                            href="<?php echo base_url('StudentSection/StudentAttendance?data=' . urlencode(base64_encode(json_encode(["for" => "AdminPanel"])))); ?>">
                            <div class="card_one flex justify-between items-center px-4 mt-2">
                                <div class="icon !size-12 bg-white shadow-sm">
                                    <img src="<?php echo base_url('assets/images/principal/student_absent.png'); ?>"
                                        class="!w-8">
                                </div>
                                <h4 class="text-[#000]">
                                    <span
                                        class="font-bold text-3xl"><?= formatNumberShort($totalabsentstudentscount); ?></span>
                                </h4>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h3>Students Absent</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- New Registration -->
                <div class="item">
                    <div class="cards border rounded">
                        <a href="<?= base_url('Studentsection/NewAdmissionList') ?>" target="_blank">
                            <div class="card_one flex justify-between items-center px-4 mt-2">
                                <div class="icon !size-12 bg-white shadow-sm">
                                    <img src="<?php echo base_url('assets/images/principal/registration.jpg'); ?>"
                                        class="!w-8">
                                </div>
                                <h4 class="text-[#000]">
                                    <span
                                        class="font-bold text-3xl"><?= formatNumberShort($newregisterstudentcount); ?></span>
                                </h4>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h3>New Registration</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Fee Pending -->
                <div class="item">
                    <div class="cards border rounded">
                        <a href="<?= base_url('AccountAdmin/LibraryDueFineList') ?>" target="_blank">
                            <div class="card_one flex justify-between items-center px-4 mt-2">
                                <div class="icon !size-12 bg-white shadow-sm">
                                    <img src="<?php echo base_url('assets/images/principal/fee_pending.jpg'); ?>"
                                        class="!w-8">
                                </div>
                                <h4 class="text-[#000]">
                                    <span class="font-bold text-3xl"><?= formatNumberShort($totalpendingfees); ?></span>
                                </h4>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h3>Fee Pending</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Total Visit -->
                <div class="item">
                    <div class="cards border rounded">
                        <a href="<?= base_url('GateEntryAdmin/GateentryVisitorsList') ?>" target="_blank">
                            <div class="card_one flex justify-between items-center px-4 mt-2">
                                <div class="icon !size-12 bg-white shadow-sm">
                                    <img src="<?php echo base_url('assets/images/principal/total_visit.jpg'); ?>"
                                        class="!w-8">
                                </div>
                                <h4 class="text-[#000]">
                                    <span
                                        class="font-bold text-3xl"><?= formatNumberShort($todayvisitorcount); ?></span>
                                </h4>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h3>Total Visit</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Total Requisition -->
                <div class="item">
                    <div class="cards border rounded">
                        <a href="<?= requisition_url_helper('hrAdmin') ?>">
                            <div class="card_one flex justify-between items-center px-4 mt-2">
                                <div class="icon !size-12 bg-white shadow-sm">
                                    <img src="<?php echo base_url('assets/images/principal/requisition.jpg'); ?>"
                                        class="!w-8">
                                </div>
                                <h4 class="text-[#000]">
                                    <span
                                        class="font-bold text-3xl"><?= formatNumberShort($totalrequisitioncount); ?></span>
                                </h4>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h3>Total Requisition</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Total Fees -->
                <div class="item">
                    <div class="cards border rounded">
                        <a href="<?= base_url('AccountAdmin/FeeCollection') ?>" target="_blank">
                            <div class="card_one flex justify-between items-center px-4 mt-2">
                                <div class="icon !size-12 bg-white shadow-sm">
                                    <img src="<?php echo base_url('assets/images/principal/total_fees.jpg'); ?>"
                                        class="!w-8">
                                </div>
                                <h4 class="text-[#000]">
                                    <span class="font-bold text-3xl"><?= formatNumberShort($totalfees); ?></span>
                                </h4>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h3>Total Fees</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Total Paid Fees -->
                <div class="item">
                    <div class="cards border rounded">
                        <a href="<?= base_url('AccountAdmin/StudentFeesDetails') ?>" target="_blank">
                            <div class="card_one flex justify-between items-center px-4 mt-2">
                                <div class="icon !size-12 bg-white shadow-sm">
                                    <img src="<?php echo base_url('assets/images/principal/crowd.jpg'); ?>"
                                        class="!w-8">
                                </div>
                                <h4 class="text-[#000]">
                                    <span class="font-bold text-3xl"><?= formatNumberShort($totalpaidfees); ?></span>
                                </h4>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h3>Total Paid Fees</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- charts -->
    <div class="row mt-3">
        <div class="col-md-8">
            <!-- ---------Employee Attendance--------- -->
            <div class="p-3">
                <h3>Employee's Attendance</h3>
                <p class="font-semibold text-gray-500 xs:text-xs sm:text-xs md:text-sm">This bar chart shows today's
                    employee
                    attendance by department. Green bars represent present employees, and yellow bars show those on
                    leave, helping
                    track attendance easily.</p>
                <div id="Emp_attendance_chart"></div>
            </div>

            <!-- Top Ranking Header -->
            <div class="flex justify-between border-b border-gray-200 my-4 pb-3">
                <h3>Top Ranking Student</h3>
                <a href="<?= base_url('Studentsection/StudentRankingList'); ?>">
                    <div class="flex items-center text-sm text-gray-600 font-semibold gap-1 mb-[2px]">
                        <span>View All</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </a>
            </div>
            <p class="font-semibold text-gray-500 xs:text-xs sm:text-xs md:text-sm">This chart shows the top 3 students
                based on exam performance. It displays their names, classes, and scores. Users can filter by exam and
                class to
                see rankings easily.</p>
            <!-- Filters -->
            <div class="flex justify-between gap-2">
                <!-- Academic Year -->
                <div class="col-md-4">
                    <label class="form-label">Select Academic Year</label>
                    <?= selectAcademicYearPreSelect([
                        "select_name" => "academic_year_id",
                        "select_id" => "academic_year_id",
                        // "select_attribute" => 'onchange="getTopStudentPerformanceShow()"',
                        "option_label" => "Select Academic Year",
                        "select_classes" => 'form-select',
                    ]); ?>
                </div>
                <div>
                    <label class="form-label">Select Class</label>
                    <select class="form-select" id="clist_assignid" name="clist_assignid">
                        <option value="">Select Class:</option>
                        <?php
                        if (!empty($classsectionlistdata)) {
                            $isFirst = true;
                            foreach ($classsectionlistdata as $Classsectionlist) { ?>
                                <option value="<?= $Classsectionlist['clist_assignid']; ?>" <?= $isFirst ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($Classsectionlist['class_section_name'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php
                                $isFirst = false;
                            }
                        } else { ?>
                            <option value="">No Class available</option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="exam_list">Select Exam:</label>
                    <select class="form-select" id="exam_id" name="exam_id" onchange="getTopStudentPerformanceShow()">
                        <option value="">Select Exam:</option>
                        <?php
                        if (!empty($ExamListData)) {
                            $isFirstExam = true;
                            foreach ($ExamListData as $exam) { ?>
                                <option value="<?= $exam['exam_id']; ?>" <?= $isFirstExam ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($exam['exam_name'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php
                                $isFirstExam = false;
                            }
                        } else { ?>
                            <option value="">No exams available</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <!-- Top Students -->
            <div class="overflow-auto">
                <div id="top_students_container" class="d-flex mt-5 gap-1 flex-nowrap">

                </div>
            </div>



            <!-- -----Students gender propertions -->
            <div class="mb-5 divide_border p-3">
                <h4 class="mb-2">Students Gender Propertions</h4>
                <p class="mb-3 FS-13">This chart shows the total count of male and female student. The yellow circle
                    represents males, and the blue circle represents females for easy comparison.</p>
                <div class="d-flex">
                    <div id="male_student_chart"></div>
                    <div id="female_student_chart"></div>
                </div>
            </div>
            <!--School Performance-->
            <div class="p-3">
                <h3>School Performance</h3>
                <p class="font-semibold text-gray-500 xs:text-xs sm:text-xs md:text-sm">This chart presents an overview
                    of school performance metrics, covering student performance (top, failed, first grades), student
                    attendance (present, absent, leave), teacher attendance (present, leave), and teacher performance
                    (good, bad, average).</p>
                <div id="School_performance_chart"></div>
            </div>


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
        <div class="col-md-4 p-3 bg-[#f9fafc] rounded-3">
            <!-- --------Student Attendance------- -->
            <div class="mb-5 divide_border bg-[#f9fafc] p-3">
                <div id="not_attendance"></div>
                <h4>Attendance Summary for This Month</h4>
                <div id="monthly-attendnace"></div>
            </div>
            <h4 class="mb-2">Student Attendance Chart</h4>
            <p class="mb-3 FS-13">This Donut chart visually represents today's student attendance displaying the
                count and
                percentage of present, absent and leave students with patterns </p>
            <div id="student_attendance_chart"></div>

            <!--house wise performance-->
            <div class="max-w-sm w-full bg-white rounded-lg p-4">
                <h3>House Wise Performance Report</h3>
                <div id="house_performance_chart"></div>
            </div>
            <!--employee birtday-->
            <div id="Emp_Bdy_id"></div>

            <!--student birthday-->
            <div id="Stu_Bdy_id"></div>

            <!-- academic current month calendar -->
            <div id="academic_month_calendar_id"></div>
            <!-- Annoucement and events, News -->
            <div id="event_announcement_id">
            </div>

            <!-- News Component -->
            <div id="news_id">

            </div>

        </div>


    </div>
</div>
</div>


<!-- </?php $this->load->view('NewMaster/footer') ?> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
        get_Attendnace_Popup();
        get_CurrentMonth_Attendance();
        get_Student_birthday();
        get_Employee_birthday();
        get_events_announcement_data();
        get_news_data();
        get_academic_month_calendar_data();
        getTopStudentPerformanceShow();
        TodayEmployeeAttendance();
        get_social_activity_data();
        SchoolPerfromanceChart();
    });
</script>


<script>
</script>

<!-- ----Employee Attendance Chart--------- -->
<script>
    function TodayEmployeeAttendance() {
        $.ajax({
            url: "<?= base_url('HR/employeeTodayAttendance') ?>",
            method: "POST",
            dataType: "json",
            success: function(response) {
                console.log("API Response:", response);
                var employeeAttendanceData = response.data;
                if (response.ApiResponseStatusCode === 200 && Array.isArray(employeeAttendanceData) && employeeAttendanceData.length > 0) {


                    var categories = [];
                    var presentData = [];
                    var absentData = [];
                    var leaveData = [];

                    employeeAttendanceData.forEach(function(item) {
                        categories.push(item.department_name);
                        presentData.push(item.present);
                        absentData.push(item.absent);
                        leaveData.push(item.leave);
                    });

                    var options = {
                        series: [{
                                name: 'Present',
                                data: presentData
                            },
                            {
                                name: 'Absent',
                                data: absentData
                            },
                            {
                                name: 'Leave',
                                data: leaveData
                            }
                        ],
                        chart: {
                            type: 'bar',
                            height: 400,
                            toolbar: {
                                show: false
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '55%',
                                borderRadius: 5,
                                borderRadiusApplication: 'end'
                            }
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
                            categories: categories,
                            labels: {
                                rotate: -45,
                                style: {
                                    fontSize: '12px',
                                    fontWeight: 500
                                }
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Employee Count'
                            }
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val + " employees";
                                }
                            }
                        },
                        legend: {
                            position: 'bottom'
                        }
                    };

                    // Destroy old chart if exists
                    if (window.empAttendanceChart) {
                        window.empAttendanceChart.destroy();
                    }

                    window.empAttendanceChart = new ApexCharts(document.querySelector("#Emp_attendance_chart"), options);
                    window.empAttendanceChart.render();
                } else {
                    $("#Emp_attendance_chart").html("<div class='text-center text-red-500'>No employee attendance data available.</div>");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                $("#Emp_attendance_chart").html("<div class='text-center text-red-500'>Failed to fetch data. Please try again.</div>");
            }
        });
    }
</script>


<!-- ---------- STudent Attendance Chart--------->
<script>
    var monthWiseAttendance = <?php echo json_encode($monthWiseAttendancePercentageData[0]); ?>;

    // Extract counts and check if data is valid
    var totalPresent = parseInt(monthWiseAttendance.total_present_students) || 0;
    var totalAbsent = parseInt(monthWiseAttendance.total_absent_students) || 0;
    var totalLeave = parseInt(monthWiseAttendance.total_leave_students) || 0;
    var totalStudents = parseInt(monthWiseAttendance.total_students) || 0;

    var presentPercentage = parseFloat(monthWiseAttendance.present_percentage) || 0;
    var absentPercentage = parseFloat(monthWiseAttendance.absent_percentage) || 0;
    var leavePercentage = parseFloat(monthWiseAttendance.leave_percentage) || 0;

    var seriesData = [presentPercentage, absentPercentage, leavePercentage];

    var options = {
        series: seriesData,
        chart: {
            width: 380,
            type: 'donut',
            dropShadow: {
                enabled: true,
                color: '#111',
                top: -1,
                left: 3,
                blur: 3,
                opacity: 0.5
            }
        },
        noData: {
            text: 'No Data Available',
            align: 'center',
            verticalAlign: 'middle',
            style: {
                color: '#ff0000', // 🔴 Red color
                fontSize: '16px',
                fontWeight: 'bold'
            }
        },
        stroke: {
            width: 0,
        },
        labels: ['Present', 'Absent', 'Leave'],
        colors: ['#0faa7e', '#f87171', '#ffbf21'],
        fill: {
            type: 'pattern',
            opacity: 1,
            pattern: {
                enabled: true,
                style: ['verticalLines', 'squares', 'horizontalLines'],
            },
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        total: {
                            showAlways: true,
                            show: true,
                            label: 'Total Students',
                            formatter: function() {
                                return totalStudents.toString();
                            }
                        }
                    }
                }
            }
        },
        tooltip: {
            y: {
                formatter: function(val, opts) {
                    let index = opts.seriesIndex;
                    let counts = [totalPresent, totalAbsent, totalLeave];
                    return counts[index] + " Students";
                }
            }
        },
        dataLabels: {
            dropShadow: {
                blur: 3,
                opacity: 1
            }
        },
        states: {
            hover: {
                filter: 'none'
            }
        },
        theme: {
            palette: 'palette2'
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

    var chart = new ApexCharts(document.querySelector("#student_attendance_chart"), options);
    chart.render();
</script>


<!-- -------female comparison----------- -->
<script>
    var studentGenderData = <?= json_encode($studentgenderdata); ?>;

    var femaleCount = studentGenderData.female_count;

    var options = {
        series: [100], // Just to fill the chart visually
        chart: {
            height: 150,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '70%',
                },
                dataLabels: {
                    name: {
                        show: true,
                        fontSize: '16px',
                        color: '#111',
                        offsetY: -10
                    },
                    value: {
                        show: true,
                        fontSize: '20px',
                        color: '#000',
                        offsetY: 5,
                        formatter: function() {
                            return femaleCount;
                        }
                    }
                }
            },
        },
        labels: ['Female'],
        colors: ["#3f83f8"],
    };

    var chart = new ApexCharts(document.querySelector("#female_student_chart"), options);
    chart.render();
</script>
<!-- -------male comparison----------- -->
<script>
    // var studentGenderData = </?= json_encode($studentgenderdata); ?>;

    var maleCount = studentGenderData.male_count;

    var options = {
        series: [100], // Just to fill the chart (not used as percentage here)
        chart: {
            height: 150,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '70%',
                },
                dataLabels: {
                    name: {
                        show: true,
                        fontSize: '16px',
                        color: '#111',
                        offsetY: -10
                    },
                    value: {
                        show: true,
                        fontSize: '20px',
                        color: '#000',
                        offsetY: 5,
                        formatter: function() {
                            return maleCount;
                        }
                    }
                }
            },
        },
        labels: ['Male'],
        colors: ["#F4D03F"],
    };

    var chart = new ApexCharts(document.querySelector("#male_student_chart"), options);
    chart.render();
</script>

<!-- -------------School Performance----------- -->
<script>
    function SchoolPerfromanceChart() {

        $.ajax({
            url: base_url + "HR/SchoolPerformance",
            method: "POST",
            success: function(response) {
                if (response.ApiResponseStatusCode === 200 || response.ApiResponseStatusCode === 201) {
                    // Optionally update some element with response data
                    $('#School_performance_chart').html('');

                    // Extract subjects data from the API response
                    var schoolData = response.data;
                    console.log(schoolData);
                    const employee_present = parseFloat(schoolData.attendance_record.employee_attendance_record
                        .present_percent || 0);
                    const employee_leave = parseFloat(schoolData.attendance_record.employee_attendance_record
                        .leave_percent || 0);
                    const student_present = parseFloat(schoolData.attendance_record.student_attendance_record
                        .present_percentage || 0);
                    const student_absent = parseFloat(schoolData.attendance_record.student_attendance_record
                        .absent_percentage || 0);
                    const student_leave = parseFloat(schoolData.attendance_record.student_attendance_record
                        .leave_percentage || 0);
                    const new_admission = parseFloat(schoolData.school_growth.no_of_admission_percentage || 0);
                    const dropout = parseFloat(schoolData.school_growth.dropout_rate || 0);
                    const avergae_grade = parseFloat(schoolData.student_performance_data
                        .average_percentage_cat || 0);
                    const first_percentage = parseFloat(schoolData.student_performance_data.first_percentage ||
                        0);
                    const top_percentage = parseFloat(schoolData.student_performance_data.top_percentage || 0);
                    const failed_percentage = parseFloat(schoolData.student_performance_data
                        .failed_percentage || 0);
                    const emp_bad = parseFloat(schoolData.employee_performance.Bad.percentage || 0);
                    const emp_good = parseFloat(schoolData.employee_performance.Good.percentage || 0);
                    const emp_average = parseFloat(schoolData.employee_performance.Average.percentage || 0);

                    var options = {
                        series: [{
                                name: "Average Grades",
                                data: [avergae_grade, 0, 0, 0, 0]
                            },
                            {
                                name: "First Grades",
                                data: [first_percentage, 0, 0, 0, 0]
                            },
                            {
                                name: "Top Students",
                                data: [top_percentage, 0, 0, 0, 0]
                            },
                            {
                                name: "Failed Grades",
                                data: [failed_percentage, 0, 0, 0, 0]
                            },
                            {
                                name: "Student Present",
                                data: [0, student_present, 0, 0, 0]
                            },
                            {
                                name: "Student Absent",
                                data: [0, student_absent, 0, 0, 0]
                            },
                            {
                                name: "Student Leave",
                                data: [0, student_leave, 0, 0, 0]
                            },
                            {
                                name: "Teacher Present",
                                data: [0, 0, employee_present, 0, 0]
                            },
                            {
                                name: "Teacher Leave",
                                data: [0, 0, employee_leave, 0, 0]
                            },
                            {
                                name: "Good Performance",
                                data: [0, 0, 0, emp_good, 0]
                            },
                            {
                                name: "Average Performance",
                                data: [0, 0, 0, emp_average, 0]
                            },
                            {
                                name: "Bad Performance",
                                data: [0, 0, 0, emp_bad, 0]
                            },
                            {
                                name: "Admissions",
                                data: [0, 0, 0, 0, new_admission]
                            },
                            {
                                name: "Dropouts",
                                data: [0, 0, 0, 0, dropout]
                            }
                        ],
                        chart: {
                            type: "bar",
                            height: 500,
                            stacked: true,
                            toolbar: {
                                show: true
                            },
                            zoom: {
                                enabled: true
                            }
                        },
                        colors: [
                            "#5DADE2", "#d0ff87", "#fab47d", "#E74C3C",
                            "#58D68D", "#ff3333", "#F4D03F",
                            "#1832ef", "#11447a",
                            "#2ECC71", "#F39C12", "#C0392B",
                            "#11447a", "#A569BD"
                        ],
                        xaxis: {
                            type: "category",
                            categories: [
                                "Student Performance",
                                "Student Attendance",
                                "Teacher Attendance",
                                "Teacher Performance",
                                "School Growth"
                            ],
                            labels: {
                                rotate: -45,
                                rotateAlways: true,
                                hideOverlappingLabels: false,
                                offsetY: 10,
                                style: {
                                    colors: "#333",
                                    fontSize: "11px",
                                    fontWeight: 600
                                }
                            }
                        },
                        yaxis: {
                            min: 0,
                            max: 120,
                            labels: {
                                formatter: function(val) {
                                    return Math.round(val) + "%";
                                }
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: "60%",
                                barHeight: "100%",
                                endingShape: "rounded"
                            }
                        },
                        legend: {
                            position: "bottom",
                            offsetY: 10,
                            markers: {
                                width: 12,
                                height: 12,
                                radius: 3
                            },
                            labels: {
                                colors: "#333"
                            },
                            itemMargin: {
                                horizontal: 5,
                                vertical: 3
                            }
                        },
                        fill: {
                            opacity: 0.85
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#School_performance_chart"), options);
                    chart.render();
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data:", error);
                showNoDataMessage();
            }
        });
    }
</script>

<!-- -------------House Performance----- -->
<script>
    // PHP data ko JS variable me laa rahe hain
    const data = <?= json_encode($housewiseperformancedata) ?>;

    // Series (percentage values)
    const series = data.map((item) => parseFloat(item.percentage));

    // Labels (House name + ratio)
    const labels = data.map(
        (item) =>
        `${item.house_name}\n(${item.total_students_in_house}/${item.total_students})`
    );

    // Dynamic colors based on house_name
    const colors = data.map((item) => {
        const name = item.house_name.toLowerCase();
        if (name.includes("pink")) return "#ff69b4"; // Pink
        if (name.includes("red")) return "#ff0000"; // Red
        if (name.includes("blue")) return "#0000ff"; // Blue
        if (name.includes("green")) return "#008000"; // Green
        if (name.includes("yellow")) return "#ffff00"; // Yellow
        if (name.includes("orange")) return "#ffa500"; // Orange
        if (name.includes("purple")) return "#800080"; // Purple
        return "#999999"; // Default grey
    });

    // Chart Options
    var options = {
        series: series,
        chart: {
            height: 350,
            type: "radialBar",
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: "14px",
                    },
                    value: {
                        fontSize: "16px",
                        formatter: function(val) {
                            return parseFloat(val).toFixed(2) + "%"; // 2 decimals
                        },
                    },
                    total: {
                        show: true,
                        label: "Average %",
                        formatter: function(w) {
                            const total =
                                w.globals.seriesTotals.reduce((a, b) => a + b, 0) /
                                w.globals.series.length;
                            return total.toFixed(2) + "%"; // average in 2 decimals
                        },
                    },
                },
            },
        },
        colors: colors,
        labels: labels,
    };

    var chart = new ApexCharts(
        document.querySelector("#house_performance_chart"),
        options
    );
    chart.render();
</script>
<script src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



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
                items: 1.5
            },

            600: {
                items: 2.5
            },

            1024: {
                items: 3.5
            },

            1366: {
                items: 3.5
            }
        }
    });
</script>

<script>
    function getTopStudentPerformanceShow() {
        var academic_year_id = $('#academic_year_id').val();
        var exam_id = document.getElementById("exam_id").value;
        var class_section_id = document.getElementById("clist_assignid").value;
        var school_id = "<?= $_SESSION['emp_data_session']['emp_schoolid'] ?>";

        if (exam_id && class_section_id) {
            $.ajax({
                url: "<?= base_url('HR/getTopstudentPerformanceData') ?>",
                method: 'POST',
                data: {
                    academic_year_id: academic_year_id,
                    exam_school: school_id,
                    class_section_id: class_section_id,
                    exam_id: exam_id
                },
                dataType: "json",
                success: function(response) {
                    if (response.ApiResponseStatusCode === 200 && response.data && response.data.top_students) {
                        var students = response.data.top_students;

                        if (students.length > 0) {
                            students.sort(function(a, b) {
                                return parseFloat(b.percentage) - parseFloat(a.percentage);
                            });

                            var top3 = students.slice(0, 3);

                            // Sort top3 to show first-place in the middle
                            let ordered = [top3[1], top3[0], top3[2]]; // middle, left, right
                            if (top3.length === 2) ordered = [top3[1], top3[0]];
                            if (top3.length === 1) ordered = [top3[0]];

                            var positionClasses = ['second-place', 'first-place', 'third-place'];
                            var medalImages = ['medal2.jpg', 'medal1.jpg', 'medal3.jpg'];

                            var studentHtml = "";

                            ordered.forEach(function(student, index) {
                                var positionClass = positionClasses[index];
                                var medal = "<?= base_url('assets/images/') ?>" + medalImages[index];
                                var profileImage = student.student_profile ? student.student_profile :
                                    "<?= base_url('assets/images/boy.jpg') ?>";

                                studentHtml += `
                                <div class="DSh_Top_student_box text-center ${positionClass}">
                                    <div class="DSh_profile_container">
                                        <img src="${profileImage}" alt="Profile">
                                    </div>
                                    <div class="DSh_student_medal">
                                        <img src="${medal}" alt="Medal">
                                    </div>
                                    <div class="bg-gray rounded p-3">
                                        <h4>${student.student_name}</h4>
                                        <div>
                                            <span>${student.student_roll_number}</span>
                                            <span>${student.division || ''}</span>
                                            <p class="marks">${parseFloat(student.percentage).toFixed(2)}%</p>
                                        </div>
                                    </div>
                                </div>
                            `;
                            });

                            // $("#top_students_container").html(studentHtml);
                            $("#top_students_container").hide().html(studentHtml).fadeIn(600);
                        } else {
                            $("#top_students_container").html("<p class='text-center'>No students found.</p>");
                        }
                    } else {
                        $("#top_students_container").html("<p class='text-center'>No students found.</p>");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    $("#top_students_container").html(
                        "<p class='text-center text-danger'>An error occurred while fetching data.</p>");
                }
            });
        } else {
            toastr.warning("Please select a valid exam and class section.");
        }
    }
</script>