<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<link href="https://unpkg.com/tabulator-tables/dist/css/tabulator.min.css" rel="stylesheet">
<script type="text/javascript" src="https://unpkg.com/tabulator-tables/dist/js/tabulator.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- <script src="<#?php echo base_url('assets/js/ckeditor/ckeditor.js'); ?>"></script> -->
<!-- Froala CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/js/froala_editor_4.3.1/css/froala_editor.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/js/froala_editor_4.3.1/css/froala_style.min.css'); ?>">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


<!-- Froala JS -->
<script src="<?php echo base_url('assets/js/froala_editor_4.3.1/js/froala_editor.pkgd.min.js'); ?>"></script>
<style>
    /* Preloader-------------------------------------------------------*/

    .loader-mask {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #66666647;
        z-index: 9999;
    }

    .loader {
        position: absolute;
        left: 50%;
        top: 50%;
        width: 50px;
        height: 50px;
        font-size: 0;
        color: #fff;
        display: inline-block;
        margin: -25px 0 0 -25px;
        text-indent: -9999em;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
    }

    .lead {
        font-size: 13px;
    }

    .loader div {
        background-color: #017941;
        display: inline-block;
        float: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100px;
        height: 100px;
        opacity: .7;
        border-radius: 50%;
        -webkit-animation: ballPulseDouble 3s ease-in-out infinite;
        animation: ballPulseDouble 3s ease-in-out infinite;
    }

    .loader div:last-child {
        -webkit-animation-delay: -1s;
        animation-delay: -1s;
    }

    @-webkit-keyframes ballPulseDouble {

        0%,
        100% {
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        50% {
            -webkit-transform: scale(1);
            transform: scale(1);
        }
    }

    @keyframes ballPulseDouble {

        0%,
        100% {
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        50% {
            -webkit-transform: scale(1);
            transform: scale(1);
        }
    }

    @keyframes scroll {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }
</style>

<!-- Preloader -->
<div class="loader-mask" id="preloader">
    <div class="loader" id="status">
        <div></div>
        <div></div>
    </div>
</div>
<!-- Preloader End -->
<?php

$userRole = $_SESSION['emp_data_session']['emp_role'];
$userRolesArray = explode(',', $userRole);

?>

<section id="header_fix">
    <header class="p-2">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-5">
                <div class="d-flex gap-md-2 gap-lg-3 align-items-center">
                    <button type="button" id="sidebarCollapse" class="btn schl-btn-yellow bg-[#ffd701]">
                        <i class="fa fa-align-left"></i>
                    </button>

                    <?php
                    $current_uri = uri_string();
                    $currentURL = $_SERVER['REQUEST_URI'];

                    $urlParts = explode('/', $current_uri);

                    $heading = $urlParts[0];

                    if ($current_uri != 'MasterAdmin/settings' && $heading != 'PageController') {

                        if ($heading == "NewMaster") {
                            $HeadingName = "DASHBOARD";
                        } else if ($heading == "CounselingAdmin") {
                            $HeadingName = "COUNSELING";
                        } else if ($heading == "Counselor") {
                            $HeadingName = "COUNSELOR";
                        } else if ($heading == "AlumniIndividual") {
                            $HeadingName = "ALUMNI";
                        } else if ($heading == "AccountAdmin") {
                            $HeadingName = "ACCOUNT";
                        } else if ($heading == "PurchaseAdmin") {
                            $HeadingName = "PURCHASE";
                        } else if ($heading == "LibraryAdmin") {
                            $HeadingName = "LIBRARY";
                        } else if ($heading == "ExamModuleAdmin") {
                            $HeadingName = "EXAM";
                        } else if ($heading == "HostelAdmin") {
                            $HeadingName = "HOSTEL";
                        } else if ($heading == "TransportAdmin") {
                            $HeadingName = 'TRANSPORT';
                        } else if ($heading == "GateEntryAdmin") {
                            $HeadingName = "GATE ENTRY";
                        } else if ($heading == "Studentsection") {
                            $HeadingName = "STUDENT SECTION";
                        } else if ($heading == "AlumniPortal") {
                            $HeadingName = "ALUMNI PORTAL";
                        } else if ($heading == "Student") {
                            $HeadingName = "STUDENT";
                        } else {
                            $HeadingName = strtoupper($heading);
                        }

                        if (substr($HeadingName, -5) === "SETUP") {
                            $HeadingName = str_replace("SETUP", " SETUP", $HeadingName);
                        }
                    ?>
                        <h1 class="mb-0 sub-heading d-md-none d-lg-block"><b><?= $HeadingName ?></b></h1>
                    <?php } else {
                    ?>
                        <?php
                        $userRole = $this->session->userdata('emp_data_session')['emp_role'];
                        $userRolesArray = explode(',', $userRole);
                        $whereRole = array('role_id' => $userRolesArray[0]);
                        $rolesData = $this->MasterAdminModel->getSingleRowByWhere('setting_employee_role', $whereRole);
                        ?>
                        <h1 class="mb-0 sub-heading" id="pageTitle"><b><?= strtoupper($rolesData->role_name) ?> SETUP</b>
                        </h1>

                    <?php } ?>
                    <div class="position-relative">
                        <!-- School Full Name -->
                        <span id="" class="school_full_name"> <?= $_SESSION['emp_data_session']['school_name'] ?></span>
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <?php
                                $role = $this->session->userdata('emp_data_session')['emp_role'];
                                $societyID = $this->session->userdata('emp_data_session')['emp_societyid'];
                                $societyModel = _LM_SocietyModel();

                                if ($role == 1) {
                                    $societyData = $societyModel->findAll();
                                ?>
                                    <select class="btn btn-sm schl-btn-green" aria-expanded="false"
                                        onchange="Societyswitch(this.value)">
                                        <option selected disabled>Select Society</option>
                                        <?php
                                        if (!empty($societyData)) {
                                            foreach ($societyData as $society) {
                                                $selected = ($society['society_id'] == $societyID) ? 'selected' : '';
                                        ?>

                                                <option title='<?php echo $society['society_name']; ?>'
                                                    value='<?php echo $society['society_id']; ?>' <?php echo $selected; ?>>
                                                    <?php echo $society['societyshortname']; ?>
                                                </option>
                                            <?php
                                            }
                                        } else { ?>
                                            <option selected disabled>Society Data Not Found</option>


                                        <?php }
                                        ?>
                                    </select>
                                    <?php
                                } else {
                                    $employee_id = $this->session->userdata('emp_data_session')['employee_id'];
                                    $emoloyeeModel = _LM_NewEmployeeModel();
                                    $employeeData = $emoloyeeModel->tableAlias('employee');

                                    $employeeData = $emoloyeeModel->select('employee.*,empCurrent.emp_societyid,empCurrent.emp_schoolid');
                                    $employeeData = $emoloyeeModel->where('employee.employee_id', $employee_id);
                                    $employeeData = $emoloyeeModel->join('emp_currentemployementdetails as empCurrent ', 'empCurrent.employee_id = employee.employee_id', 'left');
                                    $employeeData = $emoloyeeModel->findAll();


                                    $assignRoleModel = _LM_AssignRoleModel();
                                    $assignRoleData = $assignRoleModel->where('assign_emp_id', $employeeData[0]['employee_id']);
                                    $assignRoleData = $assignRoleModel->findAll();

                                    if (!empty($assignRoleData)) {
                                        //Only this if block code is not working proerly
                                        $this->db->select('add_newemployee.*, assign_role.*, GROUP_CONCAT(DISTINCT con_assign_role.assign_society_id) AS unique_society_ids, GROUP_CONCAT(DISTINCT con_assign_role.assign_sch_id) AS unique_common_sch_ids, GROUP_CONCAT(con_assign_role.module_name) AS comma_separated_module_names');
                                        $this->db->from('add_newemployee');
                                        $this->db->join('assign_role', 'add_newemployee.employee_id = assign_role.assign_emp_id');
                                        $this->db->join('con_assign_role', 'assign_role.assign_role_id = con_assign_role.assign_role_id');
                                        $this->db->where('add_newemployee.employee_id', $employeeData[0]['employee_id']);
                                        $this->db->where('con_assign_role.delete_status', 0);


                                        $this->db->group_by('add_newemployee.employee_id, assign_role.assign_role_id');

                                        $query = $this->db->get();



                                        if ($query->num_rows() == 1) {
                                            $row = $query->row();
                                        }
                                        $stringValueSchool = $row->unique_common_sch_ids;
                                        $societyIds = explode(',', $row->unique_society_ids);
                                    } else {
                                        $societyIds = explode(',', $employeeData[0]['emp_societyid']);
                                        $societyIds = array_filter($societyIds);
                                    ?>
                                    <?php } ?>

                                    <select class="btn btn-sm schl-btn-green" aria-expanded="false"
                                        onchange="Societyswitch(this.value)">
                                        <option selected disabled>Select Society</option>

                                        <?php
                                        if (!empty($societyIds)) {
                                            foreach ($societyIds as $societyId) {
                                                $societyData = $societyModel->where('society_id', $societyId)->findAll();
                                                $selected = ($societyId == $societyID) ? 'selected' : '';
                                        ?>

                                                <option title='<?php echo $societyData[0]['society_name']; ?>'
                                                    value='<?php echo $societyData[0]['society_id']; ?>' <?php echo $selected; ?>>
                                                    <?php echo $societyData[0]['societyshortname']; ?>
                                                </option>
                                            <?php }
                                        } else { ?>
                                            <option selected disabled>Society Data Not Found</option>



                                        <?php }
                                        ?>
                                    </select>

                                <?php } ?>
                            </div>
                            <div class="dropdown">
                                <?php
                                $schoolID = $this->session->userdata('emp_data_session')['emp_schoolid'];
                                $societyID = explode(',', $this->session->userdata('emp_data_session')['emp_societyid']);
                                $employee_id = $this->session->userdata('emp_data_session')['employee_id'];
                                $emoloyeeModel = _LM_NewEmployeeModel();
                                $employeeData = $emoloyeeModel->tableAlias('employee');

                                $employeeData = $emoloyeeModel->select('employee.*,empCurrent.emp_societyid,empCurrent.emp_schoolid');
                                $employeeData = $emoloyeeModel->where('employee.employee_id', $employee_id);
                                $employeeData = $emoloyeeModel->join('emp_currentemployementdetails as empCurrent ', 'empCurrent.employee_id = employee.employee_id', 'left');
                                $employeeData = $emoloyeeModel->findAll();
                                $employeeSchoolIDs = explode(',', $employeeData[0]['emp_schoolid']);

                                ?>
                                <select class="btn btn-sm schl-btn-green" aria-expanded="false"
                                    onchange="schoolSwitch(this.value)">
                                    <option selected disabled>Select School</option>
                                    <?php if (!empty($societyID) && count($societyID) == 1) {
                                        $schoolModel = _LM_SchoolModel();
                                        $schoolData = $schoolModel->where('sch_societyId', $societyID[0]);
                                        $schoolData = $schoolModel->findAll();


                                    ?>
                                        <?php
                                        if (!empty($schoolData)) {
                                            foreach ($schoolData as $school_item) {

                                        ?>
                                                <?php $selected = ($school_item['school_id'] == $schoolID) ? 'selected' : '';

                                                if ($role == 1) {

                                                ?>
                                                    <option title="<?php echo $school_item['sch_campusname']; ?>"
                                                        value="<?php echo $school_item['school_id']; ?>" <?php echo $selected; ?>>
                                                        <?php echo $school_item['campusshortname']; ?>
                                                    </option>
                                                <?php } else if (in_array($school_item['school_id'], $employeeSchoolIDs)) { ?>
                                                    <option title="<?php echo $school_item['sch_campusname']; ?>"
                                                        value="<?php echo $school_item['school_id']; ?>" <?php echo $selected; ?>>
                                                        <?php echo $school_item['campusshortname']; ?>
                                                    </option>
                                                <?php } ?>
                                            <?php }
                                        } else { ?>
                                            <option selected disabled>School Data Not Found</option>


                                        <?php } ?>
                                    <?php } else { ?>

                                        <option selected disabled>Please Select a Society First</option>


                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-7">
                <ul class="d-flex gap-md-2 gap-lg-3 align-items-center justify-content-end">
                    <li>
                        <a href="<?php echo base_url('HR/TicketGenerate') ?>"
                            class="btn schl-btn-yellow bg-[#ffd701]">Ticket
                            Generate
                        </a>
                    </li>
                    <li class="position-relative">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle schl-btn-border-green d-block" type="button"
                                id="Notification_Container" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-regular fa-bell"></i>
                                <span class="position-absolute p-1 rounded-pill bg-danger notify-count" id="notificationcount">
                                    0
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="Notification_Container"
                                style="width: 265px; left: -60px;">
                                <div class="p-2 px-3">
                                    <div class="card-header d-flex justify-content-between">
                                        <h5 class="FS_13 mb-1">Notifications</h5>
                                        <a href="<?php echo base_url('Notification/Notificationlist') ?>"
                                            class="text-dark FS_13">View All</a>
                                    </div>
                                    <div class="card-body" id="notificationdetail">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </li>




                    <li>
                        <?php
                        $userRole = $this->session->userdata('emp_data_session')['emp_role'];
                        $userRolesArray = explode(',', $userRole);
                        $modules = $this->session->userdata('emp_data_session')['emp_module'];
                        $moduleName = explode(',', $modules);
                        // if (!in_array(6, $userRolesArray)) {
                        if (checkRoles([1, 2, 3, 4, 7, 8, 9, 13, 15, 17, 19, 23, 25, 27], $userRolesArray) || checkModuleNameInArray([
                            "CounselingSetup",
                            "HRSetup",
                            "StudentSectionSetup",
                            "AccountSetup",
                            "PurchaseSetup",
                            "LibrarySetup",
                            "HostelSetup",
                            "TransportSetup",
                            "ExamSetup",
                            "GateEntrySetup",
                            "UpdatesSetup",
                            "AlumniSetup"
                        ], $moduleName)) {


                            $current_uri = uri_string();
                            $currentURL = $_SERVER['REQUEST_URI'];

                            $urlParts = explode('/', $current_uri);

                            $heading = $urlParts[0];


                            // Redirect based on role
                            if (in_array(1, $userRolesArray)) {
                                $dashboardURL = base_url("SuperAdmin/Dashboard");
                            } elseif (in_array(7, $userRolesArray)) {
                                $dashboardURL = base_url("PrincipalAdminDashboard");
                            } else {
                                $dashboardURL = base_url("MyAttendance");
                            }

                            if (strpos(strtolower($current_uri), 'setup') !== false || strtolower($heading) === 'dashboard' || $heading == 'PageController') {


                        ?>

                                <a href="<?php echo $dashboardURL; ?>">
                                    <button class="btn schl-btn-border-green">
                                        <svg fill="#0faa7e" className="w-6 h-6" strokeWidth={1.5} stroke="currentColor"
                                            version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="20px"
                                            viewBox="0 0 448.512 448.512" xml:space="preserve">
                                            <g>
                                                <path d="M444.277,215.253L242.72,52.441l-11.186-9.289c-4.22-3.506-10.34-3.506-14.559,0l-58.162,48.301V71.031
										c0-6.294-5.104-11.397-11.396-11.397h-43.449c-6.293,0-11.396,5.104-11.396,11.397v75.233L4.191,218.371
										c-4.875,3.979-5.605,11.157-1.625,16.035c2.254,2.764,5.531,4.193,8.836,4.193c2.533,0,5.082-0.841,7.203-2.565l34.477-28.126
										v188.684c0,6.294,5.102,11.397,11.396,11.397h121.789c6.295,0,11.398-5.104,11.398-11.397v-88.426h53.18v88.426
										c0,6.294,5.104,11.397,11.398,11.397h121.789c6.295,0,11.397-5.104,11.397-11.397V205.101l34.521,27.884
										c2.108,1.702,4.643,2.532,7.158,2.532c3.321,0,6.622-1.447,8.87-4.235C449.937,226.384,449.173,219.208,444.277,215.253z
										M115.366,82.428h20.652v27.164l-20.652,16.716V82.428z M372.636,189.958v195.235h-98.994v-88.427
										c0-6.294-5.104-11.396-11.397-11.396h-75.977c-6.295,0-11.396,5.104-11.396,11.396v88.427H75.877V189.958l44.309-36.798
										c0,0,103.748-85.009,104.41-86.141L372.636,189.958z" />
                                            </g>
                                        </svg>
                                    </button>
                                </a>

                            <?php } else { ?>
                                <a href="<?php echo base_url("DashBoard"); ?>">
                                    <button class="btn schl-btn-border-green">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                                            <path strokeLinecap="round" strokeLinejoin="round"
                                                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                            <path strokeLinecap="round" strokeLinejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                </a>

                        <?php }
                        } ?>
                    </li>
                    <li>
                        <div class="dropdown">
                            <?php
                            $empID = $this->session->userdata('emp_data_session')['employee_id'];

                            $this->db->select('*');
                            $this->db->from('add_newemployee');
                            $this->db->where('employee_id', $empID);
                            $EmpData = $this->db->get()->row();

                            if ($EmpData->emp_title) {
                                $ftitlename = $EmpData->emp_title;
                            } else {
                                $ftitlename = "";
                            }

                            if ($EmpData->emp_firstname) {
                                $fname = $EmpData->emp_firstname;
                            } else {
                                $fname = "";
                            }
                            if ($EmpData->emp_middlename) {
                                $mname = ' ' . $EmpData->emp_middlename;
                            } else {
                                $mname = "";
                            }
                            if ($EmpData->emp_lastname) {
                                $lname = ' ' . $EmpData->emp_lastname;
                            } else {
                                $lname = "";
                            }
                            $name = $ftitlename . $fname . $mname . $lname;
                            $names = ucfirst($EmpData->emp_title) . ' ' . ucfirst($EmpData->emp_firstname) . ' ' . ucfirst($EmpData->emp_lastname);
                            ?>
                            <button class="btn dropdown-toggle user-dropdown" style="background:transparent;"
                                type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- <i class="fa-regular fa-user me-2"></i> -->
                                <!-- Profile -->
                                <!-- <div class="row"> -->
                                <div class="user-img">
                                    <?php
                                    $empimagePath = 'uploads/' . $_SESSION['emp_data_session']['software_deployment_project_code'] . '/employeedocouments/' . $EmpData->empimage;
                                    if (empty($EmpData->empimage) or !file_exists($empimagePath)) {
                                        $firstLetterFirstname = isset($EmpData->emp_firstname) ? ucfirst(substr($EmpData->emp_firstname, 0, 1)) : '';
                                        $firstLetterLastname = isset($EmpData->emp_lastname) ? ucfirst(substr($EmpData->emp_lastname, 0, 1)) : '';
                                        // Initialize empname
                                        $empnames = '';
                                        // If you want to keep the rest of the names as they are
                                        if (!empty($firstLetterFirstname)) {
                                            if (empty($firstLetterLastname)) {
                                                $firstLetterLastname = '';
                                            }
                                            $empnames = $firstLetterFirstname . '' . $firstLetterLastname;
                                        }
                                    ?>
                                        <span class=""><?= $empnames ?></span>
                                    <?php } else { ?>
                                        <img src="<?php echo base_url('uploads/' . $_SESSION['emp_data_session']['software_deployment_project_code'] . '/employeedocouments/' . $EmpData->empimage); ?>"
                                            height="40" width="40" class="rounded">
                                    <?php } ?>
                                </div>
                                <div class="user__name">
                                    <text class="mycolor"><?= $names ?></text>
                                    <span>
                                        <?= $EmpData->empautonumber ?>
                                    </span>
                                </div>
                                <!-- </div> -->
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item active" href="#"><?= $name ?></a></li>

                                <li>
                                    <ul class="ms-4">
                                        <li>
                                            <a href="<?php echo base_url('Teacher/MyTeacher_Profile'); ?>"
                                                title="Personal Details">
                                                <span class="mycolor">Personal Details</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('Teacher/EmployeePerformance'); ?>"
                                                title="Performance">
                                                <span class="mycolor">Performance</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('Teacher/MySalaryDetails'); ?>"
                                                title="My Salary (Bank)">
                                                <span class="mycolor">My Salary (Bank)</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('MyAttendance'); ?>" title="My Attendance">
                                                <span class="mycolor">My Attendance</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('Teacher/ApplyLeave'); ?>" title="Apply Leave">
                                                <span class="mycolor">Apply Leave</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('Teacher/BookRequest'); ?>"
                                                title="Book Request">
                                                <span class="mycolor">Book Request</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('Request'); ?>"
                                                title="Engaged Lecture Request">
                                                <span class="mycolor">Substitute Class(Engage)</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('Teacher/Achievements_Teacher'); ?>"
                                                title="My Achievement">
                                                <span class="mycolor">My Achievement</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('GateEntryAdmin/General_gate_entry'); ?>"
                                                title="My Achievement">
                                                <span class="mycolor">VIP Gate Pass</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('MyTask'); ?>"
                                                title="My Achievement">
                                                <span class="mycolor">My task</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('Teacher/ExitForm'); ?>" title="Exit Form">
                                                <span class="mycolor">Exit Form</span>
                                            </a>
                                        </li>




                                    </ul>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item active"
                                        href="#">
                                        Approvals
                                    </a>
                                </li>
                                <!-- Pending Requisition Button -->
                                <li>
                                    <?php
                                    // Get the user's role and module information from session data
                                    $userRole = $this->session->userdata('emp_data_session')['emp_role'];
                                    $userRolesArray = explode(',', $userRole);

                                    // Check if userRolesArray contains role 1 (superadmin) or role 7 (principal)
                                    if (in_array(1, $userRolesArray) || in_array(7, $userRolesArray)) {
                                        // Define the allowed roles for Pending Requisition
                                        $allowedRolesForPending = [1, 7]; // Combined roles for both types

                                        // Check if the user has the required role for either Purchase or Principal Type
                                        if (checkRoles($allowedRolesForPending, $userRolesArray)) {
                                            // Initialize an empty array for pending types

                                            // Check if userRolesArray contains role 1 (superadmin) or role 7 (principal)
                                            if (in_array(1, $userRolesArray)) {
                                                $pendingTypes = 'superAdminType';
                                            } else if (in_array(7, $userRolesArray)) {
                                                $pendingTypes = 'principalType';
                                            }

                                            // Encode the array if it is not empty
                                            if (!empty($pendingTypes)) {
                                                $encodedPendingTypes = urlencode(base64_encode(json_encode($pendingTypes))); // Encode the array
                                    ?>
                                                <a
                                                    href="<?php echo base_url('PurchaseAdmin/PendingRequisition') . '?data=' . $encodedPendingTypes; ?>">
                                                    <span class="mycolor">Pending Requisition</span>
                                                </a>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </li>
                                <!-- Rate Camparison Approval Button -->
                                <li>
                                    <?php
                                    // Get the user's role and module information from session data
                                    $userRole = $this->session->userdata('emp_data_session')['emp_role'];
                                    $userRolesArray = explode(',', $userRole);
                                    $modules = $this->session->userdata('emp_data_session')['emp_module'];
                                    $moduleName = explode(',', $modules);

                                    // Define the allowed roles for Rate Comparison Approval
                                    $allowedRolesForApproval = [1, 2, 3, 4, 5, 7, 8]; // Example roles for Principal and Super Admin

                                    // Check if userRolesArray contains at least role 1 (superadmin) or role 7 (principal)
                                    if (in_array(1, $userRolesArray) || in_array(7, $userRolesArray)) {
                                        // Check if the user has the required role for Rate Comparison Approval
                                        if (checkRoles($allowedRolesForApproval, $userRolesArray)) {
                                            // Initialize an empty array for approval types

                                            // Check if userRolesArray contains role 1 (superadmin)
                                            if (in_array(1, $userRolesArray)) {
                                                $approvalTypes = 'superAdminType';
                                            } else if (in_array(7, $userRolesArray)) {
                                                $approvalTypes = 'principalType';
                                            }

                                            // Encode the array if it is not empty
                                            if (!empty($approvalTypes)) {
                                                $encodedApprovalTypes = urlencode(base64_encode(json_encode($approvalTypes))); // Encode the array
                                    ?>
                                                <a
                                                    href="<?php echo base_url('PurchaseAdmin/RateComparisionApproval') . '?data=' . $encodedApprovalTypes; ?>">
                                                    <span class="mycolor">Rate Comparison Approval</span>
                                                </a>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item active" href="#">
                                        Facilities
                                    </a>
                                    <ul class="ms-4">
                                        <li>
                                            <a href="<?php echo base_url('Teacher/MyLibrary_DetailTeacher'); ?>">
                                                <span class="mycolor">Library Facility</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('Teacher/MyHostel_DetailTeacher'); ?>">
                                                <span class="mycolor">Hostel Facility</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('Teacher/MyTransport_DetailTeacher'); ?>">
                                                <span class="mycolor">Transport Facility</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?php echo base_url('EmployeeLogout'); ?>"> <span
                                            class="text-dark">Logout</span></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
    </header>
</section>

<script>
    var base_url = "<?php echo base_url(); ?>";

    function Show_notification() {
        $.ajax({
            url: "<?= base_url('Studentsection/firebase_message_notification_view_api') ?>",
            type: "POST",
            dataType: "json",
            success: function(response) {
                if (response.ApiResponseStatusCode === 200 || response.ApiResponseStatusCode === 201) {
                    let notifications = response.data;
                    let total_count = notifications.length;
                    let notificationHtml = "";

                    $("#notificationcount").text(total_count);

                    if (total_count > 0) {
                        notifications.forEach(function(notification) {
                            let webUrl = notification.web_url && notification.web_url.trim() !== "" ?
                                notification.web_url :
                                "Notification/Notificationlist";
                            notificationHtml += `
                        <a href="${base_url + webUrl}" target="_blank" class="text-decoration-none text-reset">
                            <div class="border-bottom py-2 d-flex align-items-start notification-item position-relative" 
                                 id="notif-${notification.firebase_messaging_notification_id}">
                                <div class="d-flex">
                                    <img src="${notification.image}" alt="Notification Image" class="me-2" 
                                        style="width: 35px; height: 35px; border-radius: 50%;">
                                    <div style="flex-grow: 1;">
                                        <h5 class="FS_13 mb-1">${notification.title}</h5>
                                        <p class="FS_13 mb-1 text-wrap" style="white-space: normal; word-wrap: break-word; max-width: 100%; color: var(--bs-body-color);">
                                            ${notification.body}
                                        </p>
                                    </div>
                                </div>
                                <button onclick="event.stopPropagation(); event.preventDefault(); update_notification(${notification.firebase_messaging_notification_id})" 
                                    class="btn-close position-absolute top-0 end-0 p-2 text-danger">
                                </button>
                            </div>
                        </a>`;
                        });
                    } else {
                        notificationHtml = `<p class="text-center py-2">No new notifications</p>`;
                    }

                    $('#notificationdetail').html(notificationHtml);
                }
            }
        });
    }




    function update_notification(notification_id) {
        $.ajax({
            url: "<?= base_url('Studentsection/firebase_message_notification_update_api') ?>",
            type: "POST",
            data: {
                firebase_messaging_notification_id: notification_id
            },
            dataType: "json",
            success: function(response) {
                if (response.ApiResponseStatusCode === 200 || response.ApiResponseStatusCode === 201) {
                    $("#notif-" + notification_id).fadeOut("slow", function() {
                        $(this).remove();


                    });

                    Show_notification();
                } else {
                    toastr.error("Failed to remove notification.");
                }
            },

        });
    }



    $(document).ready(function() {
        Show_notification();
    });



    function Societyswitch(societyid) {
        $.ajax({
            url: base_url + "NewMaster/Societyswitch",
            data: {
                societyid: societyid
            },
            type: "POST",
            success: function(data) {
                var data = JSON.parse(data);
                if (data.value == "1") {
                    // If failed, show SweetAlert error popup
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: 'Failed to update Society',
                        showConfirmButton: false,
                        timer: 1000,
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    // If successful, show SweetAlert success popup and refresh page on OK click
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Society Updated Successfully',
                        showConfirmButton: false,
                        timer: 500,
                    }).then(() => {
                        location.reload();
                    });
                }
            },
        });
    }

    function schoolSwitch(schoolid) {
        $.ajax({
            url: base_url + "NewMaster/schoolSwitch",
            data: {
                schoolid: schoolid
            },
            type: "POST",
            success: function(data) {
                var data = JSON.parse(data);
                if (data.value == "1") {
                    // If failed, show SweetAlert error popup
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: 'Failed to update school',
                        showConfirmButton: false,
                        timer: 1000,
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    // If successful, show SweetAlert success popup and refresh page on OK click
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'School Updated Successfully',
                        showConfirmButton: false,
                        timer: 500,
                    }).then(() => {
                        location.reload();
                    });
                }
            },
        });
    }

    function Roleswitch(roleid) {
        $.ajax({
            url: base_url + "NewMaster/Roleswitch",
            data: {
                roleid: roleid
            },
            type: "POST",
            success: function(data) {
                var data = JSON.parse(data);
                if (data.value == "1") {
                    // If failed, show SweetAlert error popup
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: 'Failed to update school',
                        confirmButtonColor: '#0faa7e', // Set the color of OK button
                    });
                } else {
                    // If successful, show SweetAlert success popup and refresh page on OK click
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Role Updated Successfully',
                        confirmButtonColor: '#0faa7e', // Set the color of OK button
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload(); // Refresh the page
                        }
                    });
                }
            },
        });
    }
</script>

<!-- loader -->
<script>
    $(document).ready(function() {
        $("#preloader").hide();


        $(document).ajaxStart(function() {
            $("#preloader").show();
            $('#status').css('display', 'block');

        });

        $(document).ajaxComplete(function() {
            $("#preloader").hide();

        });

        $(window).on('load', function() {
            $("#status").fadeOut(); // will first fade out the loading animation
            $("#preloader").delay(500).fadeOut(
                "slow"); // will fade out the white DIV that covers the website.
            var targetElement = document.getElementById('preloader');
            targetElement.style.display = 'none';
        });
    });
</script>