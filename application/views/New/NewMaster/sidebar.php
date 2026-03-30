<aside class="pb-3 col-2 px-0" id="sidebar">
        <?php
        $userRole = $this->session->userdata('emp_data_session')['emp_role'];
        $userRolesArray = explode(',', $userRole);
        $modules = $this->session->userdata('emp_data_session')['emp_module'];
        $moduleName = explode(',', $modules);

        $this->db->select('*');
        $this->db->from('setting_employee_role');
        $this->db->where('role_id', $userRole);
        $roleData = $this->db->get()->row();
        ?>
        <div id="dismiss">
                <i class="fa fa-arrow-left"></i>
        </div>
        <div class="profile text-center d-flex align-items-center mb-3">
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" class="school-logo">
                <h3><?= $roleData->role_name ?? 'Default Name' ?></h3>
        </div>
        <ul class="row m-0 flex-row gap-2 menu">
                <?php if (in_array(1, $userRolesArray)) { ?>
                        <!-- DashBoard  -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" name="radioGroup1" value="option0" id="Dashboard" />
                                <!-- <label for="Dashboard"></label> -->
                                <a href="<?php echo base_url('SuperAdmin/Dashboard'); ?>">
                                        <img src="<?php echo base_url('assets/images/layout.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Dashboard
                                                <span>Super Admin</span>
                                        </p>
                                </a>
                        </li>
                <?php } ?>

                <?php if (in_array(7, $userRolesArray)) { ?>
                        <!-- DashBoard  -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" name="radioGroup1" value="option0" id="Dashboard" />

                                <a href="<?php echo base_url('Principal/Dashboard'); ?>">
                                        <img src="<?php echo base_url('assets/images/layout.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Dashboard
                                                <span>Principal Admin</span>
                                        </p>
                                </a>
                        </li>
                <?php } ?>
                <?php if (in_array("Counseling", $moduleName) || checkRoles([1, 2, 7, 3, 11], $userRolesArray)) { ?>
                        <!-- Counseling  -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" id="Counseling" name="radioGroup1" value="option1" />
                                <label for="Counseling" class="label-for-check" data-bs-toggle="collapse" href="#Counseling" role="button"
                                        aria-expanded="false" aria-controls="Counseling">
                                </label>
                                <button>
                                        <img src="<?php echo base_url('assets/images/Counseling.svg'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Counseling
                                                <span>Leads Management</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse p-2 dropdown-menu row" id="Counseling">
                                        <div class="col-md-12 menu-body">
                                                <h3>Counseling</h3>
                                                <ol>
                                                        <li class="border-0"><a href="<?php echo base_url('CounselingAdmin/Dashboard'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Dashboard</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('CounselingAdmin/AddLeadForm'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>New
                                                                        Lead</a></li>

                                                        <li class="border-0"> <a href="<?php echo base_url('CounselingAdmin/UnAssignedLeads'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Unassigned
                                                                        Leads</a></li>

                                                        <li class="border-0"> <a href="<?php echo base_url('CounselingAdmin/UntouchedLeads'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Untouched
                                                                        Leads</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('CounselingAdmin/AllLeads'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>All
                                                                        Leads</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('CounselingAdmin/VisitedLeads'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Visited</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('CounselingAdmin/AdmittedLeads'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Pre-Admitted
                                                                        Leads</a></li>

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('CounselingAdmin/AssignCounselor'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Assign Counselor</a></li> -->

                                                        <li class="border-0"><a href="<?php echo base_url('CounselingAdmin/Counselor'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Counselor</a>
                                                        </li>
                                                        <li class="border-0">
                                                                <a href="<?= requisition_url_helper('counsellingAdmin') ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Requisition
                                                                        Generation
                                                                </a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('CounselingAdmin/EmployeeTaskPage'); ?>"><i class="fa-solid fa-angles-right me-2"></i>Employee Task Management</a></li>

                                                </ol>
                                        </div>
                                        <div class="col-12">
                                                <h3>Report</h3>
                                                <ol>
                                                        <li class="border-0"><a href="<?php echo base_url('CounselingAdmin/LeadStatusReport'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Lead Status
                                                                        Report</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('CounselingAdmin/LeadSourceReport'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Lead Source
                                                                        Report</a></li>

                                                        <li class="border-0"><a
                                                                        href="<?php echo base_url('CounselingAdmin/CounselorPerformanceReport'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Counselor
                                                                        Performance</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('CounselingAdmin/DailyReport'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Daily
                                                                        Report</a></li>



                                                        <li class="border-0"><a href="<?php echo base_url('CounselingAdmin/FollowupReport'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Followup
                                                                        Report</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('CounselingAdmin/Reportedleads'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Reported
                                                                        Leads</a></li>
                                                </ol>
                                        </div>
                                </div>
                                <!-- <div class="menu_close" id="Counseling"></div> -->
                        </li>
                <?php } ?>
                <?php if (in_array("HR", $moduleName) || checkRoles([1, 2, 7, 4, 12], $userRolesArray)) { ?>
                        <!-- HR  -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" id="HR" name="radioGroup1" value="option2" />
                                <label for="HR" class="label-for-check" data-bs-toggle="collapse" href="#HR" role="button"
                                        aria-expanded="false" aria-controls="HR"></label>
                                <button>
                                        <img src="<?php echo base_url('assets/images/hr.png'); ?>" class="" alt="" srcset="">
                                        <p class="mb-0">
                                                HR Manager
                                                <span>Staff Management</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse p-2 row dropdown-menu" id="HR">
                                        <div class="col-md-12">
                                                <h3>HR</h3>
                                                <ol>
                                                        <li class="border-0"><a href="<?php echo base_url('HR/Dashboard'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Dashboard</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('HR/Employee'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Add New
                                                                        Employee</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('HR/ViewEmployee'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>View
                                                                        Employee</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('HR/RoleManage'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Manage
                                                                        Role</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('HR/SubjectExpertise'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Teacher
                                                                        Expertise</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('HR/LeaveApproval'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Leave
                                                                        Approvals</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('HR/Attendance'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Staff
                                                                        Attendance</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('HR/AttendanceApproval'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Attendance
                                                                        Approvals</a></li>

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('HR/interview_schedule'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Create
                                                                        Interview</a></li> -->

                                                        <li class="border-0"><a href="<?php echo base_url('HR/Employee_Gate_Pass'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Employee
                                                                        Gate Pass</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('HR/Interview_Gate_Pass'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Interview
                                                                        Gate Pass</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('HR/Assets'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Managing
                                                                        Asset</a></li>

                                                        <!-- <li class="border-0"><a href="<#?php echo base_url('HR/EmployeeSalary'); ?>">
                                    <i class="fa-solid fa-angles-right me-2"></i>Employee Salary</a></li> -->


                                                        <li class="border-0"><a href="<?php echo base_url('HR/EmployeeSalaryComponent'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Employee
                                                                        Salary Component</a></li>


                                                        <li class="border-0"><a href="<?php echo base_url('HR/Payroll'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Payroll
                                                                        Management</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('HR/SalaryList'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Employee
                                                                        Salary
                                                                        List</a></li>
                                                        <!-- <li class="border-0"><a href="<?php echo base_url('HR/SalarySlip'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Salary Slip
                                                                </a></li> -->

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('HR/Increment'); ?>">
                                    <i class="fa-solid fa-angles-right me-2"></i>Increment
                                    Form</a></li> -->

                                                        <li class="border-0"><a href="<?php echo base_url('HR/JobPosting'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Job
                                                                        Postings</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('HR/JobApplicationList'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Job
                                                                        Application List</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('HR/School_feedback'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>School Feedback List
                                                                </a></li>
                                                        <li class="border-0"><a href="<?php echo base_url('HR/EmployeeTaskPage'); ?>"><i class="fa-solid fa-angles-right me-2"></i>Employee Task Management</a></li>






                                                        <!-- <li class="border-0"><a href="</?php echo base_url('HR/EmployeeManage'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Exit
                                                                        Management</a>
                                                        </li> -->
                                                        <li class="border-0">
                                                                <a href="<?= requisition_url_helper('hrAdmin') ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Requisition
                                                                        Generation
                                                                </a>
                                                        </li>
                                                </ol>
                                        </div>
                                        <!-- <div class="col-md-12">
                                                <h3>Report</h3> -->
                                        <!-- <ol> -->
                                        <!-- <li class="border-0"><a
                                                                        href="</?php echo base_url('HR/AttendanceReport'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Teacher
                                                                        Attendance</a></li> -->

                                        <!-- <li class="border-0"><a href="</?php echo base_url('HR/RegisteredEmpReport'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Registered/New
                                                                        Employee Details</a></li> -->

                                        <!-- <li class="border-0"><a href="</?php echo base_url('HR/ExEmployeeReport'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Exit
                                                                        Report</a></li> -->

                                        <!-- <li class="border-0"><a href="</?php echo base_url('HR/VacantSeatReport'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Vacant
                                                                        Seats Report</a></li> -->
                                        <!-- </ol> -->
                                        <!-- </div> -->

                                </div>
                                </div>
                        </li>
                <?php } ?>
                <?php if (in_array("StudentSection", $moduleName) || checkRoles([1, 2, 7, 8, 29], $userRolesArray)) { ?>
                        <!-- Student Section  -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" id="StudentSection" name="radioGroup1" value="option3" />
                                <label for="StudentSection" class="label-for-check" data-bs-toggle="collapse" href="#StudentSection"
                                        role="button" aria-expanded="false" aria-controls="StudentSection"></label>
                                <button>
                                        <img src="<?php echo base_url('assets/images/admission.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Student Section
                                                <span>Student Admin Portal</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse p-2 dropdown-menu row" id="StudentSection">
                                        <div class="col-md-12">
                                                <h3>Student Section</h3>
                                                <ol>
                                                        <li class="border-0"><a
                                                                        href="<?php echo base_url('Studentsection/StudentsectionDashboard'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Dashboard</a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/NewAdmissionForm'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>New
                                                                        Admission Form</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/NewAdmissionList'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>New
                                                                        Admissions</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/AdmittedList'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Admitted
                                                                        Students</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/ClassWiseStudentList'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Classes</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/AllStudentList'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>All Students List</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/AssignRollNumber'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Assign
                                                                        RollNumber</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/AssignFeesStructure'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Assign Fees
                                                                        Structure</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/StudentFees'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>School Fees Record</a>
                                                        </li>

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('Studentsection/StudentPayFees'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Student Pay
                                                                        Fees fees</a></li> -->
                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/AssignClassTeacher'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Assign
                                                                        Class Teacher</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/AssignTimeTable'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Assign Time
                                                                        Table</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/ViewTimeTable'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>View Time
                                                                        Table</a></li>
                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/EditTimeTable'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Edit Time
                                                                        Table</a></li>
                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/SubstituteClass'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Substitute
                                                                        Class(Engage)</a></li>

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('Studentsection/StudentAttendance'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Student Attendance</a></li> -->

                                                        <li class="border-0"><a
                                                                        href="<?php echo base_url('StudentSection/StudentAttendance?data=' . urlencode(base64_encode(json_encode(["for" => "AdminPanel"])))); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i> Student
                                                                        Attendance</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/PromoteStudentList'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Promote
                                                                        Students</a></li>

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('Studentsection/StudentFine'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Fine</a>
                                                        </li> -->

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/TC_Migration'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>TC/Migration/CC</a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/tc_issued_students_list'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Tc Issued Students</a>
                                                        </li>
                                                        <li class="border-0"><a
                                                                        href="<?php echo base_url('Studentsection/StudentAchievementsApprovals'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Student
                                                                        Achievements Approval</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/Teacher_performance'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Teacher
                                                                        Performance</a>
                                                        </li>
                                                        <li class="border-0"><a
                                                                        href="<?php echo base_url('Studentsection/Teacher_performance_List'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Teacher
                                                                        Performance List</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/Student_Scholarship'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Student Scholarship</a>

                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/student_gate_pass'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Student
                                                                        Gate Pass</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/StudentRankingList'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Student Ranking List</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/house_captains'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>House
                                                                        Captains</a>
                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/Assign_House'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Assign House
                                                                </a>

                                                                <a href="<?= requisition_url_helper('admissionsectionAdmin') ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Requisition
                                                                        Generation
                                                                </a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/EmployeeTaskPage'); ?>"><i class="fa-solid fa-angles-right me-2"></i>Employee Task Management</a></li>

                                                </ol>
                                        </div>
                                        <div class="col-md-12">
                                                <h3>Report</h3>
                                                <ol>
                                                        <!-- <li class="border-0"><a href="</?php echo base_url('Studentsection/Stud_Attendance'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Attendance</a></li> -->

                                                        <li class="border-0"><a
                                                                        href="<?php echo base_url('StudentSection/StudentAttendance?data=' . urlencode(base64_encode(json_encode(["for" => "AdminPanel"])))); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Attendance</a>
                                                        </li>

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('Studentsection/StudentClass'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Class</a></li> -->

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/ActiveClass'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Active
                                                                        Classes</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/Rejected_Admissions'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Rejected
                                                                        Admissions</a></li>

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('Studentsection/TC_Alumni'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Alumni
                                                                        Students</a></li> -->



                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/alumni_students_list'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Alumni
                                                                        Students</a></li>



                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/Class_courseReports'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Class-Section
                                                                        Wise Course Completion
                                                                        Report</a></li>

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('Studentsection/Test_ExamReports'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Test/Exam
                                                                        Report</a></li> -->

                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/StudentHomeWorkReport'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Student
                                                                        HomeWork Report</a>
                                                        </li>


                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/Admission_data'); ?>"><i class="fa-solid fa-angles-right me-2"></i>AdmissionsData</a></li>
                                                        <li class="border-0"><a href="<?php echo base_url('Studentsection/studentRegistrationReport'); ?>"><i class="fa-solid fa-angles-right me-2"></i>Student Registration Report</a></li>
                                                </ol>
                                        </div>
                                </div>
                        </li>
                <?php } ?>
                <!-- </?php if (in_array("Student", $moduleName) || checkRoles([1, 10], $userRolesArray)) { ?> -->
                <!-- Student -->
                <!-- <li class="dropmenu">
                                <input type="radio" name="tabs" id="Student" name="radioGroup1" value="option4" />
                                <label for="Student" data-bs-toggle="collapse" href="#Student" role="button" aria-expanded="false" aria-controls="Student"></label>
                                <button>
                                        <img src="</?php echo base_url('assets/images/student.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Student
                                                <span>Student Individual</span>
                                        </p>
                                </button> -->
                <!-- <div class="sidebar_menus collapse p-2 dropdown-menu row" id="Student">
                                        <div class="col-md-12">
                                                <h3>Student</h3>
                                                <ol>
                                                        <li class="border-0"><a href="</?php echo base_url('Student/Stud_Dashboard'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Dashboard</a></li>

                                                        <li class="border-0"><a href="</?php echo base_url('Student/MyPerformance'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Academic Details</a></li>

                                                        <li class="border-0"><a href="</?php echo base_url('Student/My_Profile_Stud'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>My Profile</a></li>

                                                        <li class="border-0"><a href="</?php echo base_url('Student/My_Attendance_Stud'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Attendance</a></li>

                                                        <li class="border-0"><a href="</?php echo base_url('Student/Leaveapplication'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Leave Application</a></li>

                                                        <li class="border-0"><a href="</?php echo base_url('Student/Timetable_student'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>TimeTable</a></li>

                                                        <li class="border-0"><a href="</?php echo base_url('Student/MyFee_STud'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Fees Details</a></li>

                                                        <li class="border-0"><a href="</?php echo base_url('Student/My_Syllabus'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Syllabus Details</a></li>

                                                        <li class="border-0"><a href="</?php echo base_url('Student/My_Assignments'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Assignment Details</a></li>

                                                        <li class="border-0"><a href="</?php echo base_url('Student/My_Grades'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Grades/Results</a></li>

                                                        <li class="border-0"><a href="</?php echo base_url('Student/My_AchievementsSTud'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Achievements</a></li>

                                                        <li class="border-0"><a href="</?php echo base_url('Student/MyLibrary_DetailStud'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Library Details</a></li>

                                                        <li class="border-0"><a href="</?php echo base_url('Student/MyTransport_DetailStud'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Transport Details</a></li>

                                                        <li class="border-0"><a href="</?php echo base_url('Student/MyHostel_DetailStud'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Hostel Details</a></li>
                                                </ol>
                                        </div>
                                        <div class="col-md-12">
                                                <h3>Report</h3>
                                                <ol>
                                                        <li class="border-0">
                                                                <a href="">
                                                                        <i class="fa-solid fa-angles-right me-2"></i> Item one
                                                                </a>
                                                        </li>
                                                </ol>
                                        </div>
                                </div> -->
                <!-- </li>
                </?php } ?> -->
                <?php if (in_array("StudentSection", $moduleName) || checkRoles([1, 2, 7, 6], $userRolesArray)) { ?>
                        <!-- Teacher -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" id="Teacher" name="radioGroup1" value="option5" />
                                <label for="Teacher" data-bs-toggle="collapse" href="#Teacher" role="button" aria-expanded="false"
                                        aria-controls="Teacher"></label>
                                <button>
                                        <img src="<?php echo base_url('assets/images/Teacher1.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Teacher
                                                <span>Teacher Individual</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse p-2 dropdown-menu row" id="Teacher">
                                        <div class="col-md-12">


                                                <h3>Teacher &nbsp; (<?= getClassTeacherClassSubjectName([], [], 'string') ?>)</h3>



                                                <ol>
                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/Dashboard_Teach'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Dashboard</a>
                                                        </li>

                                                        <li class="border-0"><a
                                                                        href="<?php echo base_url('Teacher/StudentAttendance?data=' . urlencode(base64_encode(json_encode(["for" => "TeacherPanel"])))); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>
                                                                        Attendance</a></li>




                                                        <!-- <li class="border-0"><a href="<?php echo base_url('Teacher/ViewAttendance'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>View Class Attendance</a></li> -->

                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/StudentPerformance'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Student
                                                                        Performance</a></li>
                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/StudentPerformanceList'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Student
                                                                        Performance List</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/Studymaterial'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Study Material
                                                                </a></li>
                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/Socialactivity'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Social Activity
                                                                </a></li>
                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/student_gate_pass'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Student
                                                                        Gate Pass</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/StuSyllabus'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Syllabus</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/TimeTable'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>TimeTable</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/StudentList'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Student List Class Wise</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/PtmList'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>PTM List</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/SubstituteClasses'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Substitute
                                                                        Classes(Engage)</a></li>



                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/CreateHomeWork'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Create
                                                                        Homework</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/ViewHomeWork'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>View
                                                                        Homework</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/ExamSchedule'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Create Exam
                                                                        Schedule</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/AddMarks'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Add
                                                                        Marks</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/ViewReportCardExam'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>View
                                                                        Grades</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Teacher/Student_Leave'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Student's
                                                                        Leave Application</a></li>

                                                </ol>
                                        </div>
                                        <!-- <div class="col-md-12">
                                                <h3>Report</h3>
                                                <ol>
                                                        <li class="border-0">
                                                                <a href="">
                                                                        <i class="fa-solid fa-angles-right me-2"></i> Item one
                                                                </a>
                                                        </li>
                                                </ol>
                                        </div> -->
                                </div>
                        </li>
                <?php } ?>
                <?php if (in_array(5, $userRolesArray)) { ?>
                        <!-- Counselor -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" id="Counselor" name="radioGroup1" value="option6" />
                                <label for="Counselor" data-bs-toggle="collapse" href="#Counselor" role="button" aria-expanded="false"
                                        aria-controls="Counselor"></label>
                                <button>
                                        <img src="<?php echo base_url('assets/images/operator.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Counselor
                                                <span>Counselor Individual</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse p-2 dropdown-menu row" id="Counselor">
                                        <div class="col-md-12">
                                                <h3>Counselor</h3>
                                                <ol>
                                                        <li class="border-0"><a href="<?php echo base_url('Counselor/Dashboard'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Dashboard</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('Counselor/AddLeadForm'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>New
                                                                        Lead</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Counselor/UntouchedLeads'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Untouched
                                                                        Leads</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Counselor/Followup'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Follow
                                                                        Ups</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Counselor/VisitedLeads'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Visited</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('Counselor/ManageLead'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Manage
                                                                        Leads</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Counselor/PreAdmitted'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Pre-Admitted
                                                                        Students</a></li>
                                                </ol>
                                        </div>
                                        <div class="col-md-12">
                                                <h3>Report</h3>
                                                <ol>
                                                        <li class="border-0"><a href="<?php echo base_url('Counselor/LeadStatusReport'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Lead Status
                                                                        Report</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Counselor/LeadSourceReport'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Lead Source
                                                                        Report</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('Counselor/DailyReport'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Daily
                                                                        Report</a></li>



                                                        <li class="border-0"><a href="<?php echo base_url('Counselor/Reportedleads'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Reported
                                                                        Leads</a></li>


                                                </ol>
                                        </div>
                                </div>
                        </li>
                <?php } ?>
                <?php if (in_array("AlumniPortal", $moduleName) || checkRoles([1, 2, 7, 9, 22], $userRolesArray)) { ?>
                        <!-- Alumni -->
                        <!-- <li class="dropmenu">
                                <input type="radio" name="tabs" id="Alumni_In" name="radioGroup1" value="option7" />
                                <label for="Alumni_In" data-bs-toggle="collapse" href="#Alumni_In" role="button" aria-expanded="false"
                                        aria-controls="Alumni_In"></label>
                                <button>
                                        <img src="<?php echo base_url('assets/images/graduated.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Alumni
                                                <span>Alumni Individual</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse p-2 dropdown-menu row" id="Alumni_In">
                                        <div class="col-md-12">
                                                <h3>Alumni</h3>
                                                <ol>
                                                        <li class="border-0"><a
                                                                        href="<?php echo base_url('AlumniIndividual/dashboard'); ?>#aLUMNI_Dashboard">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Dashboard</a>
                                                        </li>



                                                        <li class="border-0"><a href="<?php echo base_url('AlumniIndividual/News_events'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>News &
                                                                        Events</a></li>



                                                        <li class="border-0"><a href="<?php echo base_url('AlumniIndividual/giving'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Givings To
                                                                        School</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('AlumniIndividual/edit_info'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Edit
                                                                        Info</a></li>


                                                </ol>
                                        </div>
                                </div>
                        </li> -->
                <?php } ?>
                <?php if (in_array("Account", $moduleName) || checkRoles([1, 2, 7, 13, 14], $userRolesArray)) { ?>
                        <!-- Account -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" id="Accounts" name="radioGroup1" value="option8" />
                                <label for="Accounts" data-bs-toggle="collapse" href="#Accounts" role="button" aria-expanded="false"
                                        aria-controls="Accounts"></label>
                                <button>
                                        <img src="<?php echo base_url('assets/images/calculator.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Accounts
                                                <span>Fee,Expenditure</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse row p-2 dropdown-menu" id="Accounts">
                                        <div class="col-md-12">
                                                <h3>Account </h3>
                                                <ol>
                                                        <li class="border-0"> <a href="<?php echo base_url('AccountAdmin/dashboard'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Dashboard</a>
                                                        </li>

                                                        <!-- <li class="border-0"> <a href="</?php echo base_url('AccountAdmin/Admin_Banking'); ?>">
                                    <i class="fa-solid fa-angles-right me-2"></i>Banking</a></li>

                            <li class="border-0"><a href="</?php echo base_url('AccountAdmin/Admin_Cashing'); ?>">
                                    <i class="fa-solid fa-angles-right me-2"></i>Cash</a></li> -->

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('AccountAdmin/Acc_FeeDeposites'); ?>">
                                    <i class="fa-solid fa-angles-right me-2"></i>Fee Deposits</a></li> -->

                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/StudentPayFees'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Fee
                                                                        Deposits</a></li>


                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/StudentTransportFees'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Transport fee
                                                                        Deposits</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/StudentRegistrationFees'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Student Registration Fees
                                                                        Deposits</a></li>






                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/purchase_payment'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Payment</a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/LibraryDueFineList'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Library Fine</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/Paid_finemanage'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Library Paid Fine</a>
                                                        </li>



                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/AccountEntry'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Account
                                                                        Entry</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/LedgerBookList'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Ledger Book
                                                                        List</a></li>

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('AccountAdmin/Acc_Receipt'); ?>">
                                    <i class="fa-solid fa-angles-right me-2"></i>Receipt</a></li> -->

                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/Acc_Payroll'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Payroll</a>
                                                        </li>


                                                        <!-- <li class="border-0"><a href="</?php echo base_url('AccountAdmin/Admin_Import'); ?>">
                                    <i class="fa-solid fa-angles-right me-2"></i>Import</a>
                            </li> -->
                                                        <li class="border-0">
                                                                <a href="<?= requisition_url_helper('accountAdmin') ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Requisition
                                                                        Generation
                                                                </a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/EmployeeTaskPage'); ?>"><i class="fa-solid fa-angles-right me-2"></i>Employee Task Management</a></li>

                                                </ol>
                                        </div>
                                        <!-- <div class="col-md-12">
                        <h3>Budget</h3>
                        <ol>
                            <li class="border-0"> <a href="<?php echo base_url('AccountAdmin/Acc_BudDashboard'); ?>">
                                    <i class="fa-solid fa-angles-right me-2"></i>Budget Dashboard</a></li>

                            <li class="border-0"><a href="<?php echo base_url('AccountAdmin/Acc_BudAdd'); ?>">
                                    <i class="fa-solid fa-angles-right me-2"></i>Add Budget</a></li>

                            <li class="border-0"><a href="<?php echo base_url('AccountAdmin/Acc_BudView'); ?>">
                                    <i class="fa-solid fa-angles-right me-2"></i>View Budget</a></li>
                        </ol>
                    </div> -->
                                        <div class="col-md-12">
                                                <h3>Report</h3>
                                                <ol>

                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/StudentFeesReceipt'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Student Fee
                                                                        Receipt</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/FeeCollection'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Fee
                                                                        Collection</a></li>


                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/LibraryFineCollection'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Library Fine
                                                                        Collection</a></li>





                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/StudentFeesDetails'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i> Daily
                                                                        Fees Details</a></li>


                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/StudentFees'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Student Fees Status (School Fees Record)</a>
                                                        </li>


                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/StudentPendingDueFeesDetails'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>
                                                                        Pending Fees Details (Installment Wise)</a></li>


                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/StudentTotalDueFeesAmountDetails'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i> Student Total DueFees Amount Details</a></li>




                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/TransportFeesReport'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Transport Fees Report</a></li>



                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/FinancialReport'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Financial Report</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/class_section_wise_fees_summary_page'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Class-Section Fees Summary</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/installment_wise_fees_summary_page'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>InstallmentWise Fees Summary</a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/fees_structure_wise_fees_summary_page'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Fees Structure Wise Fees Summary</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('AccountAdmin/TransportSummaryFees'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Transport Fees Summary(Vehicle Wise)</a>
                                                        </li>
                                                </ol>
                                        </div>
                                </div>
                        </li>
                <?php } ?>
                <?php if (in_array("Purchase", $moduleName) || checkRoles([1, 2, 7, 15, 16], $userRolesArray)) { ?>
                        <!-- Purchase  -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" id="Purchase" name="radioGroup1" value="option9" />
                                <label for="Purchase" data-bs-toggle="collapse" href="#Purchase" role="button" aria-expanded="false"
                                        aria-controls="Purchase"></label>
                                <button>
                                        <img src="<?php echo base_url('assets/images/add-to-cart.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Purchase
                                                <span>Inventory Management</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse row p-2 dropdown-menu" id="Purchase">
                                        <div class="col-md-12">
                                                <h3>Purchase</h3>
                                                <ol>
                                                        <li class="border-0"><a href="<?php echo base_url('PurchaseAdmin/dashboard'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Dashboard</a>
                                                        </li>


                                                        <li class="border-0">
                                                                <a href="<?= requisition_url_helper('purchaseAdmin') ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Requisition
                                                                        Generation
                                                                </a>
                                                        </li>


                                                        <li class="border-0">
                                                                <?php
                                                                $purchaseType = 'purchaseType';
                                                                $encodedPurchaseType = urlencode(base64_encode(json_encode($purchaseType)));
                                                                ?>
                                                                <a
                                                                        href="<?php echo base_url('PurchaseAdmin/PendingRequisition') . '?data=' . $encodedPurchaseType; ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Pending
                                                                        Requisition
                                                                </a>
                                                        </li>



                                                        <li class="border-0"><a href="<?php echo base_url('PurchaseAdmin/RateComparision'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Rate
                                                                        Comparision </a></li>

                                                        <li class="border-0"><a
                                                                        href="<?php echo base_url('PurchaseAdmin/RateComparisionApproval') . '?data=' . $encodedPrincipalType; ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Principal
                                                                        Rate Comparision Approval</a>
                                                        </li>

                                                        <li class="border-0"><a
                                                                        href="<?php echo base_url('PurchaseAdmin/RateComparisionApproval') . '?data=' . $encodedSuperAdminType; ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Super Admin
                                                                        Rate Comparision Approval</a>
                                                        </li>

                                                        <li class="border-0">
                                                                <?php
                                                                $principalType = 'principalType';
                                                                $encodedPrincipalType = urlencode(base64_encode(json_encode($principalType)));
                                                                ?>
                                                                <a
                                                                        href="<?php echo base_url('PurchaseAdmin/PendingRequisition') . '?data=' . $encodedPrincipalType; ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Principal
                                                                        Pending Requisition
                                                                </a>
                                                        </li>

                                                        <li class="border-0">
                                                                <?php
                                                                $superAdminType = 'superAdminType';
                                                                $encodedSuperAdminType = urlencode(base64_encode(json_encode($superAdminType)));
                                                                ?>
                                                                <a
                                                                        href="<?php echo base_url('PurchaseAdmin/PendingRequisition') . '?data=' . $encodedSuperAdminType; ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>SuperAdmin
                                                                        Pending Requisition
                                                                </a>
                                                        </li>


                                                        <li class="border-0"><a href="<?php echo base_url('PurchaseAdmin/View_Requisition'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>View
                                                                        Requisition</a></li>


                                                        <li class="border-0"><a href="<?php echo base_url('PurchaseAdmin/purchaseOrder'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Order</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('PurchaseAdmin/order_placed_details'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Order
                                                                        Placed</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('PurchaseAdmin/Regenerate-Order'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Rejected
                                                                        Orders</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('PurchaseAdmin/Purchase-Invoice'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Purchase
                                                                        Invoice</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('PurchaseAdmin/Pur_Notesheet'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Payment
                                                                        Notesheet </a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('PurchaseAdmin/Stock-Issued-Received'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Stock
                                                                        Issue/Receive</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('PurchaseAdmin/Stock-Details'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i> Stock
                                                                        Details</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('PurchaseAdmin/Stock-Issue'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Issued
                                                                        Stock </a></li>


                                                        <li class="border-0"><a href="<?php echo base_url('PurchaseAdmin/Stock-Summary'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i> Stock
                                                                        Summary</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('PurchaseAdmin/Inven_importstock'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Import
                                                                        Stock </a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('PurchaseAdmin/EmployeeTaskPage'); ?>"><i class="fa-solid fa-angles-right me-2"></i>Employee Task Management</a></li>

                                                </ol>
                                        </div>
                                        <!-- <div class="col-md-12">
                        <h3>Report</h3>

                        <ol>


                            <li class="border-0"><a href="<?php echo base_url('PurchaseAdmin/Pur_OrderReports'); ?>">
                                    <i class="fa-solid fa-angles-right me-2"></i>Order Reports </a></li>

                            <li class="border-0"><a
                                    href="<?php echo base_url('AccountAdmin/dashboard'); ?>#Sale_PurchaseRep">
                                    <i class="fa-solid fa-angles-right me-2"></i>Sales/Purchase Reports</a></li>
                        </ol>
                    </div> -->
                                </div>
                        </li>
                <?php } ?>
                <?php if (in_array("Library", $moduleName) || checkRoles([1, 2, 7, 17, 18], $userRolesArray)) { ?>
                        <!-- Library -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" id="Library" name="radioGroup1" value="option10" />
                                <label for="Library" data-bs-toggle="collapse" href="#Library" role="button" aria-expanded="false"
                                        aria-controls="Library"></label>
                                <button>
                                        <img src="<?php echo base_url('assets/images/books_sidebar.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Library
                                                <span>Library Management</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse p-2 dropdown-menu row" id="Library">
                                        <div class="col-md-12">
                                                <h3>Library </h3>
                                                <ol>
                                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/Dashboard'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Dashboard</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/Library_registration'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Book
                                                                        Registration</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/Library_registered'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Registered
                                                                        Book</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/Import_books'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Import
                                                                        Books</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/Library_Issue'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Issue
                                                                        Book</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/Library_ReIssue'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Re-Issue
                                                                        Books</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/Library_Requested'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Requested
                                                                        Books</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/library_issued'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Issued
                                                                        Books</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/Return_Book'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Return
                                                                        Book</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/DueFine'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Fine
                                                                        Due</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/Paid_finemanage'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Fine
                                                                        Paid</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/Book_Exit'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Book
                                                                        Exit</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/Audit'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Audit</a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/Assign_Books'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Assign
                                                                        Rack</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/Assigned_Books'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Assigned
                                                                        Rack</a></li>



                        </li>
                        <li class="border-0">
                                <a href="<?= requisition_url_helper('libraryAdmin') ?>">
                                        <i class="fa-solid fa-angles-right me-2"></i>Requisition Generation
                                </a>
                        </li>
                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/EmployeeTaskPage'); ?>"><i class="fa-solid fa-angles-right me-2"></i>Employee Task Management</a></li>

                        </ol>
                        </div>
                        <div class="col-md-12">
                                <h3>Report</h3>
                                <ol>
                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/Borrowers'); ?>">
                                                        <i class="fa-solid fa-angles-right me-2"></i>Borrowers</a></li>

                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/Lost_Books'); ?>">
                                                        <i class="fa-solid fa-angles-right me-2"></i>Lost Books</a></li>

                                        <li class="border-0"><a href="<?php echo base_url('LibraryAdmin/All_Audit'); ?>">
                                                        <i class="fa-solid fa-angles-right me-2"></i>All Audit</a></li>
                                </ol>
                        </div>
                        </div>

                        </li>
                <?php } ?>
                <?php if (in_array("Exam", $moduleName) || checkRoles([1, 2, 7, 19, 20], $userRolesArray)) { ?>
                        <!-- Exam  -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" id="Exam" name="radioGroup1" value="option11" />
                                <label for="Exam" data-bs-toggle="collapse" href="#Exam" role="button" aria-expanded="false"
                                        aria-controls="Exam"></label>
                                <button>
                                        <img src="<?php echo base_url('assets/images/exam.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Exam
                                                <span>Exam Management</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse p-2 dropdown-menu row" id="Exam">
                                        <div class="col-md-12">
                                                <h3>Exam </h3>
                                                <ol>
                                                        <li class="border-0"><a href="<?php echo base_url('ExamModuleAdmin/CreateExam'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Create
                                                                        Exam</a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('ExamModuleAdmin/ExamSchedule'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Exam
                                                                        Schedule</a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('ExamModuleAdmin/MarkSheet'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Marksheet</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('ExamModuleAdmin/ExamSeating'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Exam Seating</a>
                                                        </li>

                                                        <!-- <li class="border-0"><a href="<#?php echo base_url('ExamModuleAdmin/View_reportCard_exam'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>View Report Card</a>
                                                        </li> -->
                                                        <li class="border-0">
                                                                <a href="<?= requisition_url_helper('examAdmin') ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Requisition
                                                                        Generation
                                                                </a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('ExamModuleAdmin/EmployeeTaskPage'); ?>"><i class="fa-solid fa-angles-right me-2"></i>Employee Task Management</a></li>

                                                </ol>
                                        </div>
                                        <!-- <div class="col-md-12">
                        <h3>Report</h3>
                        <ol>
                            <li class="border-0"><a href="<#?php echo base_url('ExamModuleAdmin/dashboard'); ?>#Promoted/Demoted_Students">
                                <i class="fa-solid fa-angles-right me-2"></i>Promoted/Demoted Students</a></li>
                            </ol>
                        </div> -->
                                </div>
                        </li>
                <?php } ?>
                <?php if (in_array("AlumniPortal", $moduleName) || checkRoles([1, 2, 7, 9, 22], $userRolesArray)) { ?>
                        <!-- Alumni Portal -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" id="Alumni" name="radioGroup1" value="option12" />
                                <label for="Alumni" data-bs-toggle="collapse" href="#Alumni" role="button" aria-expanded="false"
                                        aria-controls="Alumni"></label>
                                <button>
                                        <img src="<?php echo base_url('assets/images/graduated.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Alumni Portal
                                                <span>Alumni Portal</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse dropdown-menu row" id="Alumni">
                                        <div class="col-md-12">
                                                <h3> Alumni</h3>
                                                <ol>
                                                        <li class="border-0"><a href="<?php echo base_url('AlumniPortal/alumni_students_list'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Alumni
                                                                        Students</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('AlumniPortal/Create_EventAlumni'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Create
                                                                        Event</a></li>

                                                        <!-- <li class="border-0"><a href="<//?php echo base_url('AlumniPortal/Discussion_Forum'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Discussion
                                                                        Forum</a></li> -->

                                                        <!-- <li class="border-0"><a href="<//?php echo base_url('AlumniPortal/Career_Forum'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Career
                                                                        Forum</a></li> -->
                                                        <li class="border-0"><a href="<?php echo base_url('AlumniPortal/fund_request'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Fund Request
                                                                </a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('AlumniPortal/fund_donation'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Fund Donation
                                                                </a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('AlumniPortal/EmployeeTaskPage'); ?>"><i class="fa-solid fa-angles-right me-2"></i>Employee Task Management</a></li>


                                                        <!-- <li class="border-0"><a href="</?php echo base_url('AlumniPortal/View_Fundraise'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Raise
                                                                        Fund</a></li> -->

                                                        <!-- <li class="border-0"><a href="<//?php echo base_url('AlumniPortal/manage_alumni'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Manage
                                                                        Alumni</a></li> -->

                                                        <!-- <li class="border-0"><a href="<//?php echo base_url('AlumniPortal/PhotoG_alumni'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Photo
                                                                        Gallery</a></li> -->

                                                        <!-- <li class="border-0"><a href="<//?php echo base_url('AlumniPortal/import_alumni'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Import
                                                                        Alumni</a></li> -->
                                                </ol>
                                        </div>
                                        <!-- <div class="col-md-12">
                                                <h3>Report</h3>
                                                <ol>
                                                        <li class="border-0">
                                                                <a href="">
                                                                        <i class="fa-solid fa-angles-right me-2"></i> Item one
                                                                </a>
                                                        </li>
                                                </ol>
                                        </div> -->
                                </div>
                        </li>
                <?php } ?>
                <?php if (in_array("Hostel", $moduleName) || checkRoles([1, 2, 7, 23, 24], $userRolesArray)) { ?>
                        <!-- Hostel -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" id="Hostel" name="radioGroup1" value="option12" />
                                <label for="Hostel" data-bs-toggle="collapse" href="#Hostel" role="button" aria-expanded="false"
                                        aria-controls="Hostel"></label>
                                <button>
                                        <img src="<?php echo base_url('assets/images/hostel_sidebar.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Hostel
                                                <span>Hostel Management</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse dropdown-menu row" id="Hostel">
                                        <div class="col-md-12">
                                                <h3>Hostel</h3>
                                                <ol>
                                                        <li class="border-0"><a href="<?php echo base_url('HostelAdmin/HostelDashboard'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Dashboard</a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('HostelAdmin/HostelFacilitylist'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Eligible Employee/Student</a></li>

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('HostelAdmin/Hostel_Warden'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Warden</a></li> -->

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('HostelAdmin/Hos_Fee_structure'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Fee Structure</a></li> -->

                                                        <li class="border-0"><a href="<?php echo base_url('HostelAdmin/Hostel_Allotment'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i> Hostel
                                                                        Allotment</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('HostelAdmin/Hos_Alloted'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Alloted</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('HostelAdmin/Hos_View_Hostel'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>View
                                                                        Hostel</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('HostelAdmin/Hos_Past_Hostellers'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Past
                                                                        Hostellers</a></li>

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('HostelAdmin/Hos_Fee_Pay'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Fee Pay</a></li> -->

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('HostelAdmin/Hos_Status'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Status</a></li> -->
                                                        <!-- 
                                                        <li class="border-0"><a href="</?php echo base_url('HostelAdmin/Hos_Fine'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Fine</a></li> -->

                                                        <li class="border-0"><a href="<?php echo base_url('HostelAdmin/HostelMessMenu'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Hostel Mess
                                                                        Menu</a></li>

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('HostelAdmin/Hos_Mess_Attendance'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Mess Attendance</a></li>

                                                        <li class="border-0"><a href="</?php echo base_url('HostelAdmin/Hos_Attendance_Report'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Attendance Report</a></li> -->

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('HostelAdmin/Hos_Gatepass'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Gatepass</a>
                                                        </li> -->
                                                        <li class="border-0">
                                                                <a href="<?= requisition_url_helper('hostelAdmin') ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Requisition
                                                                        Generation
                                                                </a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('HostelAdmin/EmployeeTaskPage'); ?>"><i class="fa-solid fa-angles-right me-2"></i>Employee Task Management</a></li>


                                                </ol>
                                        </div>

                                </div>
                        </li>
                <?php } ?>
                <?php if (in_array("Transport", $moduleName) || checkRoles([1, 2, 7, 25, 26], $userRolesArray)) { ?>
                        <!-- Transport -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" id="Transport" name="radioGroup1" value="option13" />
                                <label for="Transport" data-bs-toggle="collapse" href="#Transport" role="button" aria-expanded="false"
                                        aria-controls="Transport"></label>
                                <button>
                                        <img src="<?php echo base_url('assets/images/bus.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Transport
                                                <span>Transport Management</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse dropdown-menu row" id="Transport">
                                        <div class="col-md-12">
                                                <h3>Transport</h3>
                                                <ol>
                                                        <li class="border-0"><a href="<?php echo base_url('TransportAdmin/dashboard'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Dashboard</a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('TransportAdmin/Facilitylist'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Eligible Employee/Student
                                                                </a>
                                                        </li> <!-- <li class="border-0"><a href="</?php echo base_url('TransportAdmin/AddDriverConductor'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Driver And Conductor</a></li> -->

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('TransportAdmin/Permit_Vehicle'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Add Permit</a></li> -->

                                                        <li class="border-0"><a href="<?php echo base_url('TransportAdmin/AssignDriverRoute'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Assign
                                                                        Driver Route</a></li>

                                                        <li class="border-0"><a
                                                                        href="<?php echo base_url('TransportAdmin/AssignVehicleStudentTeacher'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Assign
                                                                        Students/Teacher</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('TransportAdmin/AssignDailyRoute'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Assign
                                                                        Daily Route</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('TransportAdmin/VehicleList'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Vehicle
                                                                        List</a></li>




                                                        <li class="border-0">
                                                                <a href="<?= requisition_url_helper('transportAdmin') ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Requisition
                                                                        Generation
                                                                </a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('TransportAdmin/EmployeeTaskPage'); ?>"><i class="fa-solid fa-angles-right me-2"></i>Employee Task Management</a></li>


                                                </ol>
                                        </div>

                                </div>
                        </li>
                <?php } ?>
                <?php if (in_array("GateEntry", $moduleName) || checkRoles([1, 2, 7, 27, 28], $userRolesArray)) { ?>

                        <!-- Gate Entry -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" id="GateEntry" name="radioGroup1" value="option14" />
                                <label for="GateEntry" data-bs-toggle="collapse" href="#GateEntry" role="button" aria-expanded="false"
                                        aria-controls="GateEntry"></label>
                                <button for="GateEntry">
                                        <img src="<?php echo base_url('assets/images/gate.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Gate Entry
                                                <span>Gate Entry Management</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse dropdown-menu row" id="GateEntry">
                                        <div class="col-md-12">
                                                <h3>Gate Entry</h3>
                                                <ol>
                                                        <li class="border-0"><a href="<?php echo base_url('GateEntryAdmin/dashboard'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Dashboard</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('GateEntryAdmin/GateentryVisitors'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Visitors</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('GateEntryAdmin/GateentryVisitorsList'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Visitor
                                                                        List</a>
                                                        </li>


                                                        <!-- <li class="border-0"><a
                                    href="<?php echo base_url('GateEntryAdmin/GateentryGatepass'); ?>">
                                    <i
                                        class="fa-solid fa-angles-right me-2"></i>Gatepass</a>
                            </li> -->

                                                        <!-- <li class="border-0"><a href="<?php echo base_url('GateEntryAdmin/GE_Stock_in_out'); ?>">

                                <i class="fa-solid fa-angles-right me-2"></i>Stock In/Out</a></li> -->

                                                        <li class="border-0"><a href="<?php echo base_url('GateEntryAdmin/GateentryBusinout'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Bus
                                                                        In/Out</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('GateEntryAdmin/GateentryBusTiming'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Bus
                                                                        Timing</a></li>

                                                        <li class="border-0"><a href="<?php echo base_url('GateEntryAdmin/GateEntryKeys'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Keys</a>
                                                        </li>
                                                        <li class="border-0">
                                                                <a href="<?= requisition_url_helper('gateEntryAdmin') ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Requisition
                                                                        Generation
                                                                </a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('GateEntryAdmin/EmployeeTaskPage'); ?>"><i class="fa-solid fa-angles-right me-2"></i>Employee Task Management</a></li>

                                                </ol>
                                        </div>

                                </div>
                        </li>
                <?php } ?>
                <?php if (in_array("Updates", $moduleName) || checkRoles([1, 2, 7, 4, 8], $userRolesArray)) { ?>
                        <!-- Updates -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" id="Updates" name="radioGroup1" value="option15" />
                                <label for="Updates" data-bs-toggle="collapse" href="#Updates" role="button" aria-expanded="false"
                                        aria-controls="Updates"></label>
                                <button for="">
                                        <img src="<?php echo base_url('assets/images/news.png'); ?>" alt="" srcset="">
                                        <p class="mb-0">
                                                Updates
                                                <span>News & Announcements</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse dropdown-menu row" id="Updates">
                                        <div class="col-md-12">
                                                <h3>Updates </h3>
                                                <ol>
                                                        <li class="border-0"><a href="<?php echo base_url('Updates/News'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>News</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('Updates/Announcements'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Announcements</a>
                                                        </li>

                                                        <li class="border-0"><a href="<?php echo base_url('Updates/Events'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Events</a>
                                                        </li>

                                                        <!-- <li class="border-0"><a href="</?php echo base_url('Updates/Holidays'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Holidays</a></li> -->
                                                </ol>
                                        </div>
                                        <!-- <div class="col-md-12">
                                                <h3>Report</h3>
                                                <ol>

                                                </ol>
                                        </div> -->
                                </div>
                        </li>
                <?php } ?>
                <?php if (in_array("StoreManagment", $moduleName) || checkRoles([1, 2, 7, 15, 32, 33], $userRolesArray)) { ?>
                        <!--Store Managment -->
                        <li class="dropmenu">
                                <input type="radio" name="tabs" id="StoreManagment" name="radioGroup1" value="option15" />
                                <label for="StoreManagment" data-bs-toggle="collapse" href="#StoreManagment" role="button" aria-expanded="false"
                                        aria-controls="StoreManagment"></label>
                                <button for="">
                                        <img src="<?php echo base_url('assets/images/add-to-cart.png'); ?>" alt="" srcset="">
                                        <p class="mb-0"> Store Managment <span>Store Managment</span>
                                        </p>
                                </button>
                                <div class="sidebar_menus collapse dropdown-menu row" id="StoreManagment">
                                        <div class="col-md-12">
                                                <h3>Store Managment </h3>
                                                <ol>
                                                        <li class="border-0"><a href="<?php echo base_url('Store/student_sale_item_page'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Sale Item</a>
                                                        </li>
                                                        <li class="border-0"><a href="<?php echo base_url('Store/student_sale_item_list'); ?>">
                                                                        <i class="fa-solid fa-angles-right me-2"></i>Sale Item List</a>
                                                        </li>
                                                </ol>
                                        </div>
                                </div>
                        </li>
                <?php } ?>
        </ul>
</aside>
<div class="Side_overlay"></div>