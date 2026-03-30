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
    <div class="mt-4">

        <!-- Counts statics boxs -->
        <div class="border-bottom">
            <div class="owl-slider">
                <div id="card-slider" class="owl-carousel py-1 d-block">
                    <div class="item">
                        <div class="cards border-r border-gray-300 border-solid">
                            <a href="<?= base_url('HR/ViewEmployee') ?>" target="_blank">
                                <div class="bg-transparent flex items-center gap-2 px-4 mb-2">
                                    <img src="<?php echo base_url('assets/images/employees.png'); ?>"
                                        alt="total Employees" class="!size-10">
                                    <h3>Total Employee's</h3>
                                </div>
                                <div class="flex justify-between items-center px-4 mb-3">
                                    <h4 class="text-[#000]">
                                        <span class="font-bold text-3xl">
                                            <?= formatNumberShort($totalemployeecount); ?></span>
                                    </h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="cards border-r border-gray-300 border-solid">
                            <a href="">
                                <div class="bg-transparent flex items-center gap-2 px-4 mb-2">
                                    <img src="<?php echo base_url('assets/images/employees.png'); ?>"
                                        alt="total Teacher" class="!size-10">
                                    <h3>Total Teacher</h3>
                                </div>
                                <div class="flex justify-between items-center px-4 mb-3">
                                    <h4 class="text-[#000]">
                                        <span class="font-bold text-3xl"><?= formatNumberShort($totalteachercount); ?></span>
                                    </h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="cards border-r border-gray-300 border-solid">
                            <a href="<?= base_url('Studentsection/ClassWiseStudentList') ?>" target="_blank">
                                <div class="bg-transparent flex items-center gap-2 px-4 mb-2">
                                    <img src="<?php echo base_url('assets/images/students.png'); ?>"
                                        alt="total Students" class="!size-10">
                                    <h3>Total Student's</h3>
                                </div>
                                <div class="flex justify-between items-center px-4 mb-3">
                                    <h4 class="text-[#000]">
                                        <span class="font-bold text-3xl"><?= formatNumberShort($totalstudentcount); ?></span>
                                    </h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="cards border-r border-gray-300 border-solid">
                            <a href="<?= base_url(
                                            'Studentsection/studentRegistrationReport'
                                                . '?registration_from_date=' . urlencode($registration_from_date)
                                                . '&registration_to_date=' . urlencode($registration_to_date)
                                        ) ?>" target="_blank">
                                <div class="bg-transparent flex items-center gap-2 px-4 mb-2">
                                    <img src="<?php echo base_url('assets/images/registration.png'); ?>"
                                        alt="total Employees" class="!size-10">
                                    <h3>New Registration</h3>
                                </div>
                                <div class="flex justify-between items-center px-4 mb-3">
                                    <h4 class="text-[#000]">
                                        <span class="font-bold text-3xl"><?= formatNumberShort($newregistrationcount); ?></span>
                                    </h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="cards border-r border-gray-300 border-solid">
                            <a href="<?= base_url('GateEntryAdmin/GateentryVisitorsList') ?>" target="_blank">
                                <div class="bg-transparent flex items-center gap-2 px-4 mb-2">
                                    <img src="<?php echo base_url('assets/images/visit.png'); ?>" alt="total visit"
                                        class="!size-10">
                                    <h3>Total Visit</h3>
                                </div>
                                <div class="flex justify-between items-center px-4 mb-3">
                                    <h4 class="text-[#000]">
                                        <span class="font-bold text-3xl"><?= formatNumberShort($todayvisitorcount); ?></span>
                                    </h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="cards border-r border-gray-300 border-solid">
                            <a href="<?= base_url('AccountAdmin/AccountEntry ') ?>" target="_blank">
                                <div class="bg-transparent flex items-center gap-2 px-4 mb-2">
                                    <img src="<?php echo base_url('assets/images/Expense.png'); ?>" alt="total Expense"
                                        class="!size-10">
                                    <h3>Total Expense</h3>
                                </div>
                                <div class="flex justify-between items-center px-4 mb-3">
                                    <h4 class="text-[#000]">
                                        <span class="font-bold text-3xl"><?= formatNumberShort($totalexpenseamount); ?></span>
                                    </h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="cards border-r border-gray-300 border-solid">
                            <a href="<?= base_url('AccountAdmin/AccountEntry') ?>" target="_blank">
                                <div class="bg-transparent flex items-center gap-2 px-4 mb-2">
                                    <img src="<?php echo base_url('assets/images/pendingFee.png'); ?>" alt="Pending Fee"
                                        class="!size-10">
                                    <h3>Pending Fee</h3>
                                </div>
                                <div class="flex justify-between items-center px-4 mb-3">
                                    <h4 class="text-[#000]">
                                        <span class="font-bold text-3xl"><?= formatNumberShort($totalpendingfees); ?></span>
                                    </h4>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="cards border-r border-gray-300 border-solid">
                            <a href="<?= requisition_url_helper('hrAdmin') ?>">
                                <div class="bg-transparent flex items-center gap-2 px-4 mb-2">
                                    <img src="<?php echo base_url('assets/images/requistion.png'); ?>"
                                        alt="total Expense" class="!size-10">
                                    <h3>Total Requisition</h3>
                                </div>
                                <div class="flex justify-between items-center px-4 mb-3">
                                    <h4 class="text-[#000]">
                                        <span class="font-bold text-3xl"><?= formatNumberShort($totalexpenseamount); ?></span>
                                    </h4>
                                </div>
                            </a>
                        </div>
                    </div>



                    <!-- Total Transport Original Fees -->
                    <div class="item">
                        <div class="cards border-r border-gray-300 border-solid">
                            <a href="<?= base_url('AccountAdmin/TransportSummaryFees') ?>" target="_blank">
                                <div class="bg-transparent flex justify-between items-center px-4 mb-2">
                                    <img src="<?= base_url('assets/images/present-stu.png'); ?>" alt="total fees" class="!size-10">
                                    <h3>Total Transport Original Fees</h3>
                                </div>
                                <div class="flex justify-between items-center px-4 mb-3">
                                    <h4 class="text-[#000]">
                                        <span class="font-bold text-3xl">
                                            <?= formatNumberShort($TransportFeesSummary[0]['total_fee_amount'] ?? 0); ?>
                                        </span>
                                    </h4>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Total Concession -->
                    <div class="item">
                        <div class="cards border-r border-gray-300 border-solid">
                            <div class="bg-transparent flex justify-between items-center px-4 mb-2">
                                <img src="<?= base_url('assets/images/present-stu.png'); ?>" alt="concession" class="!size-10">
                                <h3>Total Transport Concession</h3>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h4 class="text-[#000]">
                                    <span class="font-bold text-3xl">
                                        <?= formatNumberShort($TransportFeesSummary[0]['total_concession_amount'] ?? 0); ?>
                                    </span>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- Net Payable -->
                    <div class="item">
                        <div class="cards border-r border-gray-300 border-solid">
                            <div class="bg-transparent flex justify-between items-center px-4 mb-2">
                                <img src="<?= base_url('assets/images/present-stu.png'); ?>" alt="net payable" class="!size-10">
                                <h3>Total Transport Net Payable</h3>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h4 class="text-[#000]">
                                    <span class="font-bold text-3xl">
                                        <?= formatNumberShort($TransportFeesSummary[0]['total_final_fee_amount'] ?? 0); ?>
                                    </span>
                                </h4>
                            </div>
                        </div>
                    </div>




                    <!-- Total Paid Amount -->
                    <div class="item">
                        <div class="cards border-r border-gray-300 border-solid">
                            <div class="bg-transparent flex justify-between items-center px-4 mb-2">
                                <img src="<?= base_url('assets/images/present-stu.png'); ?>" alt="paid amount" class="!size-10">
                                <h3>Total Transport Paid Amount</h3>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h4 class="text-[#000]">
                                    <span class="font-bold text-3xl">
                                        <?= formatNumberShort($TransportFeesSummary[0]['total_paid_amount'] ?? 0); ?>
                                    </span>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pending Amount -->
                    <div class="item">
                        <div class="cards border-r border-gray-300 border-solid">
                            <div class="bg-transparent flex justify-between items-center px-4 mb-2">
                                <img src="<?= base_url('assets/images/present-stu.png'); ?>" alt="pending amount" class="!size-10">
                                <h3>Total Transport Pending Amount</h3>
                            </div>
                            <div class="flex justify-between items-center px-4 mb-3">
                                <h4 class="text-[#000]">
                                    <span class="font-bold text-3xl">
                                        <?= formatNumberShort($TransportFeesSummary[0]['total_pending_amount'] ?? 0); ?>
                                    </span>
                                </h4>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="row mt-3">
            <!-- Left Column -->
            <div class="col-md-8">
                <div class="w-full p-3 bg-[#f9fafc] rounded-3">
                    <!-- Top Ranking Header -->
                    <div class="flex justify-between border-b border-gray-200 my-4 pb-3">
                        <h3>Top Ranking Student</h3>
                        <a href="<?= base_url('Studentsection/StudentRankingList'); ?>">
                            <div class="flex items-center text-sm text-gray-600 font-semibold gap-1 mb-[2px]">
                                <span>View All</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </div>
                        </a>
                    </div>
                    <p class="font-semibold text-gray-500 xs:text-xs sm:text-xs md:text-sm">This chart shows the top 3 students
                        based on exam performance. It displays their names, classes, and scores. Users can filter by exam and class to
                        see rankings easily.</p>
                    <!-- Filters -->
                    <!-- <div class="flex justify-between gap-2">
                        <div> -->



                    <!-- <label class="form-label">Select Class</label>
                            <select class="form-select" id="TopStudent_class_id" name="TopStudent_class_id" onchange="getTopStudentPerformanceShow()">
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
                            </select> -->
                    <!-- </div> -->
                    <!-- <div>
                            <label for="exam_list">Select Exam:</label>
                            <select class="form-select" id="TopStudent_exam_id" name="TopStudent_exam_id" onchange="getTopStudentPerformanceShow()">
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
                            </div> -->

                    <!-- <div>
                                <label class="form-label">Select Exam <span class="text-danger">*</span></label>
                                <select class="form-select" name="exam_id" id="exam_id" onchange="getTopStudentPerformanceShow()">
                                    <option value="" selected>Select Exam</option>
                                </select>
                            </div> -->
                    <!-- </div> -->
                    <!-- </div> -->




                    <div class="row g-3 align-items-end mb-3">
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

                        <!-- Class -->
                        <div class="col-md-4">
                            <label class="form-label">Select Class</label>
                            <select class="form-select" id="TopStudent_class_id" name="TopStudent_class_id" onchange="getTopStudentPerformanceShow()">
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

                        <!-- Exam -->
                        <div class="col-md-4">
                            <label class="form-label">Select Exam <span class="text-danger">*</span></label>
                            <select class="form-select" name="exam_id" id="exam_id" onchange="getTopStudentPerformanceShow()">
                                <option value="" selected>Select Exam</option>
                            </select>
                        </div>
                    </div>
                    <!-- Top Students -->
                    <div class=" overflow-auto">
                        <div id="top_students_container" class="d-flex mt-5 gap-1 flex-nowrap">

                        </div>
                    </div>

                    <!-- profit and loss -->
                    <div class="p-3">
                        <div class="flex justify-between">
                            <h3>Financing Fee Report</h3>
                            <a href="<?php echo base_url('AccountAdmin/FeeCollection'); ?>">
                                <div class="flex items-center justify-center text-sm text-gray-600 font-semibold  gap-1 mb-[2px]">
                                    <span class="text-sm">View All</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>

                                </div>
                            </a>
                        </div>
                        <p class="font-semibold mb-1 text-gray-500 xs:text-xs sm:text-xs md:text-sm">This chart shows the yearly paid fee
                            report from January to December. The graph highlights monthly ups and downs.</p>
                        <div class="d-flex justify-content-between">
                            <p>Yearly Report</p>
                            <p>12%

                            </p>
                        </div>
                        <div id="DShFinance_chart" style="width: 100%; max-width: 1000px;"></div>
                    </div>
                    <!--today attendance employee-->
                    <div class="p-3">
                        <h3>Employee's Attendance</h3>
                        <p class="font-semibold text-gray-500 xs:text-xs sm:text-xs md:text-sm">This bar chart shows today's employee
                            attendance by department. Green bars represent present employees, and yellow bars show those on leave, helping
                            track attendance easily.</p>
                        <div id="Emp_attendance_chart"></div>
                    </div>

                    <!--School Performance-->
                    <div class="p-3">
                        <h3>School Performance</h3>
                        <p class="font-semibold text-gray-500 xs:text-xs sm:text-xs md:text-sm">This chart presents an overview of school performance metrics, covering student performance (top, failed, first grades), student attendance (present, absent, leave), teacher attendance (present, leave), and teacher performance (good, bad, average).</p>
                        <div id="School_performance_chart"></div>
                    </div>

                    <!--social activity-->

                    <div class="flex justify-between border-gray-200 border-b my-4 pb-3">
                        <dl>
                            <dt class="text-base font-normal text-black pb-1"> Social Activity</dt>
                            <span class="text-sm font-normal text-gray-400">Daily updates lists class wise</span>
                        </dl>
                        <div>

                            <?php if (empty($is_list_page) && $is_list_page == false): ?>
                                <a href="<?= base_url('EmployeeSocialActivityList'); ?>" class="btn schl-btn-yellow btn-sm"
                                    target="_blank">View All</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="owl-slider">

                        <div id="social-slider" class="owl-carousel print_social_news">


                        </div>
                    </div>

                    <div class="mb-5 p-3">
                        <h3>Student Performance By Subject</h3>
                        <p class="font-semibold text-gray-500 xs:text-xs sm:text-xs md:text-sm">
                            This chart shows student performance by subject based on class and exam filters. Different colors represent
                            grades from E to A+. It helps track subject-wise progress easily.
                        </p>

                        <div class="flex justify-between gap-4 flex-wrap">
                            <div class="col-md-3">
                                <label class="form-label">Select Class</label>
                                <select class="form-select" id="subjectby_class_id" name="subjectby_class_id" onchange="StudentPerformanceBySubject()">
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


                            <div class="col-md-3">
                                <label class="form-label">Select Academic Year</label>
                                <?= selectAcademicYearPreSelect([
                                    "select_name" => "academicyearid",
                                    "select_id" => "academicyearid",
                                    // "select_attribute" => 'onchange=""',
                                    "option_label" => "Select Academic Year",
                                    "select_classes" => 'form-select',
                                ]); ?>
                            </div>


                            <div class="col-md-3">
                                <label class="form-label">Select Exam <span class="text-danger">*</span></label>
                                <select class="form-select" name="exam_listexam_id" id="exam_listexam_id" onchange="StudentPerformanceBySubject()">
                                    <option value="" selected>Select Exam</option>
                                </select>
                            </div>







                            <!-- <div class="col-md-3"> -->
                            <!-- <label class="form-label" for="exam_listexam_id">Select Exam:</label> -->
                            <!-- <select class="form-select" id="subjectby_exam_id" name="subjectby_exam_id" onchange="StudentPerformanceBySubject()">
                                    <option value="">Select Exam:</option>
                                    </?php
                                    if (!empty($ExamListData)) {
                                        $isFirstExam = true;
                                        foreach ($ExamListData as $exam) { ?>
                                            <option value="</?= $exam['exam_id']; ?>" </?= $isFirstExam ? 'selected' : ''; ?>>
                                                </?= htmlspecialchars($exam['exam_name'], ENT_QUOTES, 'UTF-8'); ?>
                                            </option>
                                        </?php
                                            $isFirstExam = false;
                                        }
                                    } else { ?>
                                        <option value="">No exams available</option>
                                    </?php } ?>
                                </select> -->
                            <!-- </div> -->
                        </div>

                        <!-- Chart render area -->
                        <div id="DSh_student_performance" class="mt-5">
                            <!-- Chart or no data message will load here -->
                        </div>
                    </div>

                    <!-- -------Course Completion Report----- -->
                    <div class="mb-5  p-3">
                        <div class="flex justify-between border-b border-gray-200 my-4 pb-3">
                            <h3>Course Completion Report</h3>
                            <a href="<?= base_url('Studentsection/Class_courseReports'); ?>">
                                <div class="flex items-center text-sm text-gray-600 font-semibold gap-1 mb-[2px]">
                                    <span>View All</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <p class="font-semibold text-gray-500 xs:text-xs sm:text-xs md:text-sm">
                            This chart shows course completion status by subject based on class selection. Green bars show completed
                            courses, while orange bars show incomplete ones. It helps track progress easily.
                        </p>
                        <div class="w-full">
                            <label class="form-label">Select Class</label>
                            <select class="form-select" id="course_class_id" name="course_class_id" onchange="CourseCompletionReport()">
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

                        <div id="Course_complition_chart"></div>
                    </div>

                    <!--requisition-->
                    <div class="card p-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">Requisition Generation List</h3>
                            <a href="<?= base_url('PurchaseAdmin/View_Requisition'); ?>" class="btn schl-btn-yellow btn-sm" target="_blank">
                                View All
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-responsive table-striped table-hover table-sm school-table-1" id="">
                                <thead>
                                    <tr>
                                        <th>S.NO.</th>
                                        <th>School</th>
                                        <th>REQ.NO.</th>
                                        <th>DATE</th>
                                        <th>Vendor</th>
                                        <th>STATUS</th>
                                        <th>TIMELINE</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($ViewRequistions as $key => $req): ?>
                                        <?php if ($key >= 10) break; ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td><?php echo $req->campusshortname; ?></td>
                                            <td><?php echo $req->req_number; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($req->req_date)); ?></td>
                                            <td><?php echo $req->ledger_name; ?></td>
                                            <td>
                                                <?php
                                                $status = 'Pending';
                                                if ($req->req_approval_status == 1) {
                                                    $status = 'Approved';
                                                } else if ($req->req_approval_status == 2) {
                                                    $status = 'Rejected';
                                                }
                                                echo $status;
                                                ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn"
                                                    onclick="requisitionTimeLine(<?= $req->req_id ?>,'<?= $req->req_number ?>')"
                                                    data-toggle="tooltip" data-placement="top" title="View">
                                                    <img width="40" height="40"
                                                        src="https://img.icons8.com/clouds/100/search-in-list.png"
                                                        alt="search-in-list" />
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-4">
                <div class="max-w-sm w-full bg-white rounded-lg p-4">
                    <!--dropout and register student-->
                    <div class="max-w-sm w-full bg-white rounded-lg p-4">
                        <h4>Student Registration & Dropout Analysis</h4>
                        <!-- Academic Year -->
                        <div class="col-md-4">
                            <label class="form-label">Select Academic Year</label>
                            <?= selectAcademicYearPreSelect([
                                "select_name" => "student_registration_dropout_analysis_academic_year_id",
                                "select_id" => "student_registration_dropout_analysis_academic_year_id",
                                "select_attribute" => 'onchange="getStudentRegistrationDropoutAnalysis()"',
                                "option_label" => "Select Academic Year",
                                "select_classes" => 'form-select',
                            ]); ?>
                        </div>
                        <p class="font-semibold text-gray-500 xs:text-xs sm:text-xs md:text-sm">This chart displays yearly new student
                            admissions (green) and exits (red) with percentages, helping to track student growth and dropout trends for
                            better analysis.</p>
                        <div class="py-4" id="donut-chart"></div>
                    </div>


                    <!--finance report-->
                    <div class="max-w-sm w-full justify-center bg-white rounded-lg p-4">
                        <div class="flex justify-between">
                            <h3>Financial Report</h3>
                            <a href="<?= base_url('HR/FinancialReport'); ?>">
                                <div class="flex items-center text-sm text-gray-600 font-semibold gap-1 mb-[2px]">
                                    <span>View All</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <p class="font-semibold text-gray-500 text-sm">This financial report chart shows purchase with vertical lines, earnings with squares, and expenses with circles. Each category is in a different color for easy understanding.</p>
                        <!-- Chart wrapper for centering -->
                        <div class="flex justify-center items-center">
                            <div id="Finance_chart" class="w-[300px] h-auto"></div>
                        </div>
                    </div>

                    <!--gender proportaion-->
                    <div class="max-w-sm w-full bg-white rounded-lg p-4">
                        <h4>Employee's Gender Proportion</h4>
                        <p class="font-semibold text-gray-500 xs:text-xs sm:text-xs md:text-sm">This chart shows the total count of male
                            and female employees. The blue colour represents males, and the green colour represents females for easy
                            comparison.</p>
                        <div class="py-4" id="department_chart"></div>
                    </div>
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
</div>

<div class="modal fade" id="viewtimelineViewRequisition" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalID">TimeLine</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="timeLineModalBody">

            </div>
        </div>
    </div>
</div>

<?php if (!empty($ViewRequistions)) { ?>
    <script>
        $(document).ready(function() {
            if ($.fn.DataTable.isDataTable('.school-table')) {
                $('.school-table').DataTable().destroy();
            }

            var table = $('.school-table').DataTable({
                'order': [], // Initial sorting disableds
                'columnDefs': [{
                    'targets': 0,
                    'orderable': false, // Sorting disabled on the checkbox column
                }],
                'lengthMenu': [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'All']
                ], // Add 'All' option to the pagination dropdown
                'dom': 'Bflrtip', // Add this to include buttons in the DOM
                'buttons': [
                    'copy', 'excel', 'pdf', 'print', 'colvis'
                ]
            });
        });
    </script><?php } ?>


<script>
    var exam_id = $('#exam_id').val();
    var academic_year_id = $('#academic_year_id').val();
    $(document).ready(function() {
        $("#academic_year_id").select2();
        // Initialize exam select2 first time
        initializeSelect2('exam_id', {
            placeholder: "Select Exam",
        }, "<?= base_url('Teacher/getExamCreatedListApi') ?>", {
            exam_academic_year: $('#academic_year_id').val(),
        }, "exam_id", "exam_name");

        $('#academic_year_id').on('change', function() {
            var updatedAcademicYearId = $(this).val();

            $('#exam_id').empty().trigger('change');

            initializeSelect2('exam_id', {
                placeholder: "Select Exam",
            }, "<?= base_url('Teacher/getExamCreatedListApi') ?>", {
                exam_academic_year: updatedAcademicYearId,
            }, "exam_id", "exam_name");
        });
    });



    var exam_listexam_id = $('#exam_listexam_id').val();
    var academicyearid = $('#academicyearid').val();
    $(document).ready(function() {
        $("#academicyearid").select2();
        // Initialize exam select2 first time
        initializeSelect2('exam_listexam_id', {
            placeholder: "Select Exam",
        }, "<?= base_url('Teacher/getExamCreatedListApi') ?>", {
            exam_academic_year: $('#academicyearid').val(),
        }, "exam_id", "exam_name");

        $('#academicyearid').on('change', function() {
            var updatedacademicyearid = $(this).val();

            $('#exam_listexam_id').empty().trigger('change');

            initializeSelect2('exam_listexam_id', {
                placeholder: "Select Exam",
            }, "<?= base_url('Teacher/getExamCreatedListApi') ?>", {
                exam_academic_year: updatedacademicyearid,
            }, "exam_id", "exam_name");
        });
    });


    $(document).ready(function() {
        get_Attendnace_Popup();
        get_CurrentMonth_Attendance();
        getTopStudentPerformanceShow();
    });


    function getTopStudentPerformanceShow() {
        var academic_year_id = $('#academic_year_id').val();
        var exam_id = $('#exam_id').val();
        var class_section_id = document.getElementById("TopStudent_class_id").value;
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
                                var profileImage = student.student_profile ? student.student_profile : "<?= base_url('assets/images/boy.jpg') ?>";

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
                            $("#top_students_container").html("<p class='text-center text-danger'>No students found.</p>");
                        }
                    } else {
                        $("#top_students_container").html("<p class='text-center text-danger'>No students found.</p>");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    $("#top_students_container").html("<p class='text-center text-danger'>An error occurred while fetching data.</p>");
                }
            });
        }
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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




<!-- --------------Financial Report Chart--------- -->
<div id="Finance_chart" style="padding: 20px;"></div> <!-- Added padding -->
<script>
    var totalexpenseamount = <?= json_encode($totalexpenseamount) ?>;
    var totalpurchaseexpenseamount = <?= json_encode($totalpurchaseexpenseamount) ?>;
    var totalearningamount = <?= json_encode($totalearningamount) ?>;

    // Total sum calculate karna
    var totalSum = totalexpenseamount + totalpurchaseexpenseamount + totalearningamount;

    // Series data aur labels
    var seriesData = [totalpurchaseexpenseamount, totalearningamount, totalexpenseamount];
    var labelsData = ["Purchase", "Earning", "Expense"];

    var options = {
        series: seriesData,
        chart: {
            width: 300,
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
        stroke: {
            width: 0,
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: "Total",
                            formatter: function() {
                                return totalSum; // Total sum show karega
                            }
                        }
                    }
                }
            }
        },
        labels: labelsData,
        legend: {
            position: 'bottom', // <-- This ensures labels are shown below the chart
        },
        dataLabels: {
            dropShadow: {
                blur: 3,
                opacity: 1
            }
        },
        fill: {
            type: 'pattern',
            opacity: 1,
            pattern: {
                enabled: true,
                style: ['verticalLines', 'horizontalLines', 'slantedLines'],
            },
        },
        tooltip: {
            y: {
                formatter: function(value, {
                    seriesIndex
                }) {
                    var percentage = ((value / totalSum) * 100).toFixed(2); // Percentage calculation
                    return value + " (" + percentage + "%)"; // Value + Percentage show karega
                }
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

    var chart = new ApexCharts(document.querySelector("#Finance_chart"), options);
    chart.render();
</script>



<script>
    // Fetch data from PHP
    var feesData = <?php echo $month_wise_fees_json; ?>;

    var options = {
        series: [{
            name: "Fees Collected",
            data: feesData.prices
        }],
        chart: {
            type: 'area',
            height: 250,
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },

        xaxis: {
            categories: feesData.months,
            labels: {
                rotate: -45,
                show: true,
                trim: false,
                style: {
                    fontSize: '12px'
                }
            },
            tickPlacement: 'between'
        },
        yaxis: {
            opposite: false
        },
        legend: {
            horizontalAlign: 'left'
        }
    };

    var chart = new ApexCharts(document.querySelector("#DShFinance_chart"), options);
    chart.render();
</script>


<!-- ----------Department Wise Male Female -->
<script>
    var employeeGenderData = <?php echo json_encode($employeegenderdata); ?>;

    var maleCount = employeeGenderData.male_count || 0;
    var femaleCount = employeeGenderData.female_count || 0;

    // ApexCharts options
    var options = {
        series: [maleCount, femaleCount],
        chart: {
            width: 300,
            type: 'pie',
        },
        labels: ['Male', 'Female'],
        legend: {
            position: 'bottom', // <-- This ensures labels are shown below the chart
        },
        dataLabels: {
            formatter: function(val, opts) {
                return opts.w.config.series[opts.seriesIndex];
            }
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " Employees";
                }
            }
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

    // Chart render karein
    var chart = new ApexCharts(document.querySelector("#department_chart"), options);
    chart.render();
</script>

<!-- -------------Course Complition----- -->
<script>
    function CourseCompletionReport() {
        var class_section_id = document.getElementById("course_class_id").value;
        $.ajax({
            url: "<?= base_url('HR/GetCourseCompletionReportdata') ?>",
            method: "POST",
            data: {
                class_section_id: class_section_id,
            },
            dataType: "json",
            success: function(response) {
                console.log("API Response:", response);

                if (response.ApiResponseStatusCode === 200) {
                    if (response.data) {
                        var courseData = response.data;

                        if (courseData && courseData.length > 0) {
                            const subjects = courseData.map((item) => item.subject_name || `${item.subject_name}`); // Replace with actual subject names if available
                            const completedData = courseData.map((item) => {
                                const val = item.subject_completion_percentage || 0;
                                return Number(parseFloat(val).toFixed(2));
                            });

                            const incompleteData = courseData.map((item) => {
                                const val = item.incomplete_percentage !== undefined ?
                                    item.incomplete_percentage :
                                    (100 - item.subject_completion_percentage);
                                return Number(parseFloat(val).toFixed(2));
                            });

                            var chartOptions = {
                                series: [{
                                        name: "Completed",
                                        data: completedData,
                                    },
                                    {
                                        name: "Incomplete",
                                        data: incompleteData,
                                    },
                                ],
                                chart: {
                                    height: 350,
                                    type: "bar",
                                },
                                plotOptions: {
                                    bar: {
                                        columnWidth: "60%",
                                        borderRadius: 5,
                                        dataLabels: {
                                            position: "top",
                                        },
                                    },
                                },
                                dataLabels: {
                                    enabled: true,
                                    formatter: (val) => val + "%",
                                    offsetY: -15,
                                    style: {
                                        fontSize: "12px",
                                        colors: ["#304758"],
                                    },
                                },
                                xaxis: {
                                    categories: subjects,
                                    position: "bottom",
                                    labels: {
                                        rotate: -45,
                                    },
                                    axisBorder: {
                                        show: false
                                    },
                                    axisTicks: {
                                        show: false
                                    },
                                    tooltip: {
                                        enabled: true
                                    },
                                },
                                yaxis: {
                                    labels: {
                                        formatter: (val) => val + "%",
                                    },
                                },
                                colors: ["#0e9c34", "#ffa56a"], // Completed (green), Incomplete (yellow)
                            };

                            var chart = new ApexCharts(document.querySelector("#Course_complition_chart"), chartOptions);
                            chart.render();
                        }
                    } else {
                        $("#Course_complition_chart").html("<div class='text-center text-gray-500'>No course completion data available.</div>");
                    }
                } else {
                    $("#Course_complition_chart").html("<div class='text-center text-red-500'>Unexpected API response.</div>");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                $("#Course_complition_chart").html("<div class='text-center text-red-500'>Failed to fetch data. Please try again.</div>");
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
    $(document).ready(function() {
        get_Student_birthday();
        get_Employee_birthday();
        get_events_announcement_data();
        get_news_data();
        get_academic_month_calendar_data();
        get_social_activity_data();
        TodayEmployeeAttendance();
        StudentPerformanceBySubject();
        CourseCompletionReport();
        SchoolPerfromanceChart();


    });
</script>

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
                    const employee_present = parseFloat(schoolData.attendance_record.employee_attendance_record.present_percent || 0);
                    const employee_leave = parseFloat(schoolData.attendance_record.employee_attendance_record.leave_percent || 0);
                    const student_present = parseFloat(schoolData.attendance_record.student_attendance_record.present_percentage || 0);
                    const student_absent = parseFloat(schoolData.attendance_record.student_attendance_record.absent_percentage || 0);
                    const student_leave = parseFloat(schoolData.attendance_record.student_attendance_record.leave_percentage || 0);
                    const new_admission = parseFloat(schoolData.school_growth.no_of_admission_percentage || 0);
                    const dropout = parseFloat(schoolData.school_growth.dropout_rate || 0);
                    const avergae_grade = parseFloat(schoolData.student_performance_data.average_percentage_cat || 0);
                    const first_percentage = parseFloat(schoolData.student_performance_data.first_percentage || 0);
                    const top_percentage = parseFloat(schoolData.student_performance_data.top_percentage || 0);
                    const failed_percentage = parseFloat(schoolData.student_performance_data.failed_percentage || 0);
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

<script>
    function StudentPerformanceBySubject() {
        var class_section_id = document.getElementById("subjectby_class_id").value;
        // var exam_listexam_id = document.getElementById("subjectby_exam_id").value;
        var exam_listexam_id = $('#exam_listexam_id').val();

        $.ajax({
            url: "<?= base_url('HR/getSubjectPerformanceStats') ?>",
            method: "POST",
            data: {
                class_section_id: class_section_id,
                exam_listexam_id: exam_listexam_id,
            },
            dataType: "json",
            success: function(response) {
                console.log("API Response:", response);

                if (response.ApiResponseStatusCode === 200) {
                    if (response.data && response.data.subject_performance) {
                        const performanceData = response.data.subject_performance;
                        const subjects = Object.keys(performanceData);

                        if (subjects.length === 0) {
                            $("#DSh_student_performance").html("<div class='text-center text-gray-500'>No subject performance data found.</div>");
                            return;
                        }

                        const gradeCategories = Object.keys(performanceData[subjects[0]]);
                        const gradeColors = {
                            "A+": '#b0ff6a',
                            A: '#f5fb3d',
                            B: '#007bff',
                            C: '#ff6ad9',
                            D: '#ffd06a',
                            E: '#ff6a6a'
                        };

                        const series = gradeCategories.map(grade => ({
                            name: grade,
                            data: subjects.map(subject => performanceData[subject]?.[grade] || 0)
                        }));

                        // Clear previous chart
                        $("#DSh_student_performance").html('<div id="studentPerformanceChart"></div>');

                        var options = {
                            chart: {
                                type: 'bar',
                                height: 400,
                                stacked: true
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: true,
                                    barHeight: '70%'
                                }
                            },
                            stroke: {
                                width: 1,
                                colors: ['#fff']
                            },
                            xaxis: {
                                categories: subjects,
                                labels: {
                                    style: {
                                        fontSize: "10px"
                                    },
                                    offsetX: -5
                                }
                            },

                            fill: {
                                opacity: 0.9
                            },
                            legend: {
                                position: 'top',
                                horizontalAlign: 'left',
                                offsetX: 40
                            },
                            colors: gradeCategories.map(grade => gradeColors[grade] || '#000000'),
                            series: series
                        };

                        var chart = new ApexCharts(document.querySelector("#studentPerformanceChart"), options);
                        chart.render();
                    } else {
                        $("#DSh_student_performance").html("<div class='text-center text-gray-500'>No subject performance data available.</div>");
                    }
                } else {
                    $("#DSh_student_performance").html(
                        `<div class='text-center text-red-500'>${response.message || "Unexpected API response."}</div>`
                    );

                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                $("#DSh_student_performance").html("<div class='text-center text-red-500'>Failed to fetch data. Please try again.</div>");
            }
        });
    }
</script>

<script>
    function requisitionTimeLine(req_id, req_number) {
        $("#viewtimelineViewRequisition").modal('show');
        $("#modalID").html(req_number.toString());
        var data = {
            req_id: req_id,
        };

        $.ajax({
            type: "POST",
            url: base_url + "PurchaseAdmin/requisitionTimeLine",
            data: data,
            success: function(response) {
                $("#timeLineModalBody").html(response.view);
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            },
        });
    }
</script><?php if (!empty($ViewRequistions)) { ?>
    <script>
        $(document).ready(function() {
            if ($.fn.DataTable.isDataTable('.school-table')) {
                $('.school-table').DataTable().destroy();
            }

            var table = $('.school-table').DataTable({
                'order': [], // Initial sorting disableds
                'columnDefs': [{
                    'targets': 0,
                    'orderable': false, // Sorting disabled on the checkbox column
                }],
                'lengthMenu': [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'All']
                ], // Add 'All' option to the pagination dropdown
                'dom': 'Bflrtip', // Add this to include buttons in the DOM
                'buttons': [
                    'copy', 'excel', 'pdf', 'print', 'colvis'
                ]
            });
        });
    </script><?php } ?>



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

<!-- Student Registration Dropout Analysis Report -->
<script>
    var school_id = "<?= $_SESSION['emp_data_session']['emp_schoolid'] ?>";

    function getStudentRegistrationDropoutAnalysis() {
        var academic_year_id = $("#student_registration_dropout_analysis_academic_year_id").val();

        if (school_id && academic_year_id) {
            $.ajax({
                url: "<?= base_url('HR/getStudentRegistrationDropoutAnalysisDataApi') ?>",
                method: 'POST',
                data: {
                    school_id: school_id,
                    academic_year_id: academic_year_id,
                },
                dataType: "json",
                success: function(response) {
                    if (response.ApiResponseStatusCode === 200 && response.data && response.data.length > 0) {
                        let row = response.data[0]; // get first item
                        let newStudent = parseInt(row.new_student_count) || 0;
                        let exitStudent = parseInt(row.exit_count) || 0;
                        renderStudentCountChart(newStudent, exitStudent);
                    } else {
                        $("#donut-chart").html("<p class='text-center text-red-500'>No data available for the selected filters.</p>");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    $("#donut-chart").html("<p class='text-center text-red-500'>An error occurred while fetching the data.</p>");
                }
            });
        }
    }

    function renderStudentCountChart(newStudent, exitStudent) {
        let chartOptions = {
            series: [newStudent, exitStudent],
            labels: ['New Register Student', 'Exit Student'],
            colors: ['#28b463', '#ff3933'],
            chart: {
                height: 350,
                width: '100%',
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                formatter: function(w) {
                                    return newStudent + exitStudent;
                                }
                            }
                        }
                    }
                }
            },
            legend: {
                position: 'bottom',
                fontFamily: 'Inter, sans-serif'
            }
        };

        if (document.getElementById('donut-chart') && typeof ApexCharts !== 'undefined') {
            $("#donut-chart").html(""); // Clear old chart
            const chart = new ApexCharts(document.getElementById('donut-chart'), chartOptions);
            chart.render();
        }
    }
    $(document).ready(function() {

        $("#student_registration_dropout_analysis_academic_year_id").select2();
        getStudentRegistrationDropoutAnalysis();

    });
</script>