<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Super Admin Setup</title>
	<!--Bootstrap css  -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<!-- style.css -->
	<link href="<?= base_url('assets/css/newstyle.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/responsive.css'); ?>" rel="stylesheet">


	<!-- data table css -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">
	<!-- font awesome icon -->
	<script src="https://kit.fontawesome.com/b79797c1bc.js" crossorigin="anonymous"></script>
	<!-- owl slider css -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
</head>

<body class="container-fluid">
	<?php
	$current_uri = uri_string();

	$urlParts = explode('/', $current_uri);

	$heading = $urlParts[0];
	?>
	<main class="school-wrapper row justify-content-end">
		<aside class="pb-3 col-2 px-0" id="sidebar">
			<div id="dismiss">
				<i class="fa fa-arrow-left"></i>
			</div>
			<div class="profile text-center d-flex align-items-center mb-3">
				<img src="<?php echo base_url('assets/images/logo.png'); ?>" class="school-logo">
				<h4 class="sub-heading1">SUPER ADMIN SETUP</h4>
			</div>
			<ul class="row m-0 flex-row gap-2">
				<!-- DashBoard -->
				<li class="dropmenu">
					<input type="radio" name="radioGroup1" value="option0" id="Dashboard" />
					<a href="<?php echo base_url('DashBoard'); ?>" for="Dashboard">
						<p class="mb-0 <?php echo ($heading === 'DashBoard') ? 'active-tab' : ''; ?>">
							Dashboard
							<span></span>
						</p>
					</a>
				<li class="border-0"></li>
				</li>
				<?php
				$userRole = $this->session->userdata('emp_data_session')['emp_role'];
				$userRolesArray = explode(',', $userRole);
				$modules = $this->session->userdata('emp_data_session')['emp_module'];
				$moduleName = explode(',', $modules);




				?>
				<!-- New School Setup  -->
				<?php if (checkRoles([1], $userRolesArray)) { ?>
					<li class="dropmenu" id="menu1">
						<input type="radio" name="radioGroup1" value="option1" id="NewSchool" />
						<label onclick="changeHeaderText('New School Setup')" for="NewSchool" data-bs-toggle="collapse"
							href="#NewSchool" role="button" aria-expanded="false" aria-controls="Counseling">
						</label>
						<button>
							<p class="mb-0 <?php echo ($heading === 'NewSchoolSetup') ? 'active-tab' : ''; ?>">
								New School Setup
							</p>
						</button>
						<div class="sidebar_menus collapse dropdown-menu row" id="NewSchool">
							<div class="col">
								<h3>New School Setup</h3>
								<ol>
									<!-- <li class="border-0"><a
											href="</?php echo base_url('NewSchoolSetup/newSchoolDashboard'); ?>"><i
												class="fa-solid fa-angles-right me-2"></i>Dashboard</a></li> -->

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/state'); ?>"><i
												class="fa-solid fa-angles-right me-2"></i>State</a></li>

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/Division'); ?>"><i
												class="fa-solid fa-angles-right me-2"></i>Division</a></li>

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/District'); ?>"><i
												class="fa-solid fa-angles-right me-2"></i>District</a></li>

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/Block'); ?>"><i
												class="fa-solid fa-angles-right me-2"></i>Block</a></li>

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/City'); ?>"><i
												class="fa-solid fa-angles-right me-2"></i> City</a></li>

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/Area'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Area </a></li>

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/Society'); ?>"><i
												class="fa-solid fa-angles-right me-2"></i>Society</a></li>

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/schoolType'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>School Type</a></li>

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/school'); ?>"><i
												class="fa-solid fa-angles-right me-2"></i>School</a></li>



									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/Board'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i> Board</a></li>

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/assignBoard'); ?>"><i
												class="fa-solid fa-angles-right me-2"></i>Assign Board</a></li>
									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/nepLevels'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>NEP Levels</a></li>

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/class'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Classes </a></li>

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/sections'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Sections </a></li>

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/assignSection'); ?>">
											<i class="fa-solid fa-angles-right me-2"></i>Assign Section</a></li>

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/practicalBatch'); ?>">
											<i class="fa-solid fa-angles-right me-2"></i>Practical Batch</a></li>

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/shift'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Shifts </a></li>

									<li class="border-0"><a href="<?php echo base_url('PageController/Assign_shift'); ?>">
											<i class="fa-solid fa-angles-right me-2"></i>Assign Shifts </a></li>

									<li class="border-0"><a href="<?php echo base_url('PageController/premisestype'); ?>">
											<i class="fa-solid fa-angles-right me-2"></i>Premises Type </a></li>

									<li class="border-0"><a href="<?php echo base_url('NewSchoolSetup/createClass'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Premises Allocation</a></li>

									<li class="border-0"><a
											href="<?php echo base_url('NewSchoolSetup/assignClassroom'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Allocate Premises</a></li>

									<li class="border-0"><a href="<?php echo base_url('PageController/Assign_roomNo'); ?>">
											<i class="fa-solid fa-angles-right me-2"></i>Assign ClassRoom No.</a></li>

									<!-- <li class="border-0"><a href="<//?php echo base_url('PageController/third_party_integration'); ?>"><i class="fa-solid fa-angles-right me-2"></i>Third Party Integration Setup</a></li>

									<li class="border-0"><a href="<//?php echo base_url('PageController/template'); ?>"><i class="fa-solid fa-angles-right me-2"></i>Message Template Setup</a></li> -->

									<li class="border-0"><a href="<?php echo base_url('PageController/payment_gateway'); ?>"><i class="fa-solid fa-angles-right me-2"></i>Payment Gateway Setup</a></li>

									<!-- <li class="border-0"><a href="<#?php echo base_url('NewSchoolSetup/assignModule'); ?>"> <i class="fa-solid fa-angles-right me-2"></i>Assign Module</a></li> -->

								</ol>
							</div>
						</div>
					</li>
				<?php } ?>
				<?php if (checkRoles([1], $userRolesArray)) { ?>
					<!-- Person Setup  -->
					<li class="dropmenu">
						<input type="radio" name="radioGroup1" value="option2" id="Person" />
						<label for="Person" onclick="changeHeaderText('Person Setup')" data-bs-toggle="collapse"
							href="#Person" role="button" aria-expanded="false" aria-controls="Counseling">
						</label>
						<button for="Person">
							<p class="mb-0 <?php echo ($heading === 'PersonSetup') ? 'active-tab' : ''; ?>">
								Person Setup
							</p>
						</button>
						<div class="sidebar_menus collapse dropdown-menu row" id="Person">
							<div class="col">
								<h3>Person Setup</h3>
								<ol>
									<li class="border-0"><a href="<?php echo base_url('PersonSetup/CasteCategory'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Caste Category</a></li>
									<li class="border-0"><a
											href="<?php echo base_url('PersonSetup/ScholarshipCategory'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Scholarship Category</a></li>

									<li class="border-0"><a href="<?php echo base_url('PersonSetup/Occupation'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Occupation </a></li>

									<li class="border-0"><a href="<?php echo base_url('PersonSetup/QualificationType'); ?>">
											<i class="fa-solid fa-angles-right me-2"></i>Qualification Type </a></li>

									<li class="border-0"><a href="<?php echo base_url('PersonSetup/IncomeRange'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Income range</a></li>

									<li class="border-0"><a href="<?php echo base_url('PersonSetup/Religion'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Religion </a></li>

									<li class="border-0"><a href="<?php echo base_url('PersonSetup/Institute'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Institute</a></li>

									<li class="border-0"><a href="<?php echo base_url('PersonSetup/AchievementLevel'); ?>">
											<i class="fa-solid fa-angles-right me-2"></i>Achievement Level</a></li>

									<li class="border-0"><a href="<?php echo base_url('PersonSetup/AchievementType'); ?>">
											<i class="fa-solid fa-angles-right me-2"></i>Achievement Type</a></li>

									<li class="border-0"><a
											href="<?php echo base_url('PersonSetup/AchievementCategory'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Achievement Category</a></li>

									<li class="border-0"><a
											href="<?php echo base_url('PersonSetup/AchievementsubCategory'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Achievement Sub Category</a></li>

								</ol>
							</div>
						</div>
					</li>
				<?php } ?>
				<!-- <#?php if (checkRoles([1], $userRolesArray)) { ?>
					<li class="dropmenu">
						<input type="radio" name="radioGroup1" value="option2" id="RoleMaster" />
						<label for="RoleMaster" onclick="changeHeaderText('Role Master')" data-bs-toggle="collapse" href="#RoleMaster" role="button" aria-expanded="false" aria-controls="RoleMaster">
						</label>
						<button for="RoleMaster">
							<p class="mb-0 <#?php echo ($heading === 'RoleMaster') ? 'active-tab' : ''; ?>">
								Role Master
							</p>
						</button>
						<div class="sidebar_menus collapse dropdown-menu row" id="RoleMaster">
							<div class="col">
								<h3>Role Master</h3>
								<ol>

									<li class="border-0"><a href="<#?php echo base_url('RoleMaster/assignRole'); ?>"> <i class="fa-solid fa-angles-right me-2"></i>Assign Role</a></li>


								</ol>
							</div>
						</div>
					</li>
				<#?php } ?> -->
				<?php if (in_array("CounselingSetup", $moduleName) || checkRoles([1, 2, 7, 3], $userRolesArray)) { ?>
					<!-- Counseling Setup  -->
					<li class="dropmenu">
						<input type="radio" name="radioGroup1" value="option3" id="Counseling" />
						<label for="Counseling" onclick="changeHeaderText('Counseling Setup')" data-bs-toggle="collapse"
							href="#Counseling" role="button" aria-expanded="false" aria-controls="Counseling">
						</label>
						<button>
							<p class="mb-0 <?php echo ($heading === 'CounselingSetup') ? 'active-tab' : ''; ?>">
								Counseling Setup
							</p>
						</button>
						<div class="sidebar_menus collapse dropdown-menu row" id="Counseling">
							<div class="col">
								<h3>Counseling Setup</h3>
								<ol>
									<li class="border-0"><a href="<?php echo base_url('CounselingSetup/LeadSource'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Lead Source</a></li>
									<li class="border-0"><a href="<?php echo base_url('CounselingSetup/LeadStatus'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Lead Status</a></li>
									<li class="border-0"><a
											href="<?php echo base_url('CounselingSetup/AdmissionStatus'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Admission Status </a></li>
									<li class="border-0"><a href="<?php echo base_url('CounselingSetup/EnquiryLabel'); ?>">
											<i class="fa-solid fa-angles-right me-2"></i>Enquiry Label</a></li>
								</ol>
							</div>
						</div>
					</li>
				<?php } ?>
				<?php if (in_array("StudentSectionSetup", $moduleName) || checkRoles([1, 2, 7, 8], $userRolesArray)) { ?>

					<!--  Academic Setup  -->
					<li class="dropmenu">
						<input type="radio" name="radioGroup1" value="option4" id="Student" />
						<label for="Student" onclick="changeHeaderText('Academic Setup')" data-bs-toggle="collapse"
							href="#Student" role="button" aria-expanded="false" aria-controls="Counseling">
						</label>
						<button>
							<p class="mb-0 <?php echo ($heading === 'AcademicSetup') ? 'active-tab' : ''; ?>">
								Academic Setup
							</p>
						</button>
						<div class="sidebar_menus collapse dropdown-menu row" id="Student">
							<div class="col">
								<h3>Academic Setup</h3>
								<ol>
									<li class="border-0"><a href="<?php echo base_url('AcademicSetup/Year'); ?>"><i
												class="fa-solid fa-angles-right me-2"></i>Academic Year</a></li>
									
									<li class="border-0"><a href="<?php echo base_url('AcademicSetup/Course'); ?>"><i
												class="fa-solid fa-angles-right me-2"></i>Course</a></li>

									<li class="border-0"><a href="<?php echo base_url('AcademicSetup/ImportCourse'); ?>"><i
												class="fa-solid fa-angles-right me-2"></i>Import Subject Unit & Chapter</a></li>



									<li class="border-0"><a href="<?php echo base_url('AcademicSetup/Instance'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Instance Type</a></li>
									<li class="border-0"><a href="<?php echo base_url('PageController/createset'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Create Set</a></li>
									<li class="border-0"><a href="<?php echo base_url('PageController/scholarship'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Scholarships</a></li>
									<li class="border-0"><a href="<?php echo base_url('AcademicSetup/House'); ?>"><i
												class="fa-solid fa-angles-right me-2"></i>House</a></li>
									<li class="border-0"><a href="<?php echo base_url('AcademicSetup/StudentTemplateIdCard'); ?>"><i
												class="fa-solid fa-angles-right me-2"></i>Student Template Id Card</a></li>
								</ol>
							</div>
						</div>
					</li>
				<?php } ?>
				<?php if (in_array("HRSetup", $moduleName) || checkRoles([1, 2, 7, 4], $userRolesArray)) { ?>
					<!-- HR Setup  -->
					<li class="dropmenu">
						<input type="radio" name="radioGroup1" value="option5" id="HR" />
						<label for="HR" data-bs-toggle="collapse" onclick="changeHeaderText('HR Setup')" href="#HR"
							role="button" aria-expanded="false" aria-controls="Counseling">
						</label>
						<button>
							<p class="mb-0 <?php echo ($heading === 'HRSetup') ? 'active-tab' : ''; ?>">
								HR Setup
							</p>
						</button>
						<div class="sidebar_menus collapse dropdown-menu row" id="HR">
							<div class="col">
								<h3> HR Setup</h3>
								<ol>
									<li class="border-0"><a href="<?php echo base_url('HRSetup/EmployeeType'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Employee Type </a></li>
									<li class="border-0"><a href="<?php echo base_url('HRSetup/EmployeeLevel'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Employee Level </a></li>
									<li class="border-0"><a href="<?php echo base_url('HRSetup/Department'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Department</a></li>
									<li class="border-0"><a href="<?php echo base_url('HRSetup/Designation'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Designation </a></li>
									<li class="border-0"><a href="<?php echo base_url('HRSetup/paygrade'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Pay Grade</a></li>
									<li class="border-0"><a href="<?php echo base_url('HRSetup/holidays'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Holidays</a></li>
									<li class="border-0"><a href="<?php echo base_url('HRSetup/jobDescription'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Job Description </a></li>
									<li class="border-0"><a href="<?php echo base_url('HRSetup/leavestype'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i> Leave Type</a></li>
									<!-- <li class="border-0"><a href="</?php echo base_url('HRSetup/EmpShift'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Employee Shift</a></li> -->
									<li class="border-0"><a href="<?php echo base_url('HRSetup/SalaryComponent'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Salary Component</a></li>
									<!-- <li class="border-0"><a href="</?php echo base_url('PageController/PayFormat'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Pay Slip Format</a></li> -->
									<li class="border-0"><a href="<?php echo base_url('HRSetup/HRPolicy'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>HR Policy</a></li>


								</ol>
							</div>
						</div>
					</li>
				<?php } ?>
				<?php if (in_array("AccountSetup", $moduleName) || checkRoles([1, 2, 7, 13], $userRolesArray)) { ?>
					<!-- Accounts Setup	 -->
					<li class="dropmenu">
						<input type="radio" name="radioGroup1" value="option6" id="Accounts" />
						<label for="Accounts" onclick="changeHeaderText('Account Setup')" data-bs-toggle="collapse"
							href="#Accounts" role="button" aria-expanded="false" aria-controls="Counseling">
						</label>
						<button>
							<p class="mb-0 <?php echo ($heading === 'AccountSetup') ? 'active-tab' : ''; ?>">
								Accounts Setup
							</p>
						</button>
						<div class="sidebar_menus collapse dropdown-menu row" id="Accounts">

							<div class="col">
								<h3>Accounts Setup</h3>
								<ol>


									<li class="border-0"><a href="<?php echo base_url('AccountSetup/chartofaccount'); ?>">
											<i class="fa-solid fa-angles-right me-2"></i>COA Groups </a></li>
									<li class="border-0"><a href="<?php echo base_url('AccountSetup/CreateLedger'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Create Ledger </a></li>
									<!-- <li class="border-0"><a href="<?php echo base_url('PageController/bank'); ?>"> <i class="fa-solid fa-angles-right me-2"></i>Bank </a></li> -->
									<!-- <li class="border-0"><a href="<?php echo base_url('PageController/cash'); ?>"> <i class="fa-solid fa-angles-right me-2"></i>Cash </a></li> -->
									<li class="border-0"><a href="<?php echo base_url('AccountSetup/accountCategory'); ?>">
											<i class="fa-solid fa-angles-right me-2"></i>Category </a></li>
									<li class="border-0"><a
											href="<?php echo base_url('AccountSetup/accountSubcategory'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Sub Category </a></li>
									<li class="border-0"><a href="<?php echo base_url('AccountSetup/feeheads'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Fee Heads </a></li>
									<li class="border-0"><a href="<?php echo base_url('AccountSetup/feestructure'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Fee Structure </a></li>

									<!-- <li class="border-0"><a href="<//?php echo base_url('AccountSetup/fine'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Fine </a></li> -->

									<li class="border-0"><a href="<?php echo base_url('AccountSetup/StudentAcademicFeesFine'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Student Academic Fees Fine </a></li>

									<li class="border-0"><a href="<?php echo base_url('AccountSetup/StudentTransportFeesFine'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Student Transport Fees Fine </a></li>

									<li class="border-0"><a href="<?php echo base_url('AccountSetup/waiver'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Waiver Category </a></li>

									<li class="border-0"><a href="<?php echo base_url('AccountSetup/GST_Master'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>GST Master </a></li>
								</ol>
							</div>
						</div>

					</li>
				<?php } ?>

				<?php if (in_array("PurchaseSetup", $moduleName) || checkRoles([1, 2, 7, 15], $userRolesArray)) { ?>
					<!-- Purchase Setup -->
					<li class="dropmenu">
						<input type="radio" name="radioGroup1" value="option7" id="Purchase" />
						<label for="Purchase" onclick="changeHeaderText('Purchase Setup')" data-bs-toggle="collapse"
							href="#Purchase" role="button" aria-expanded="false" aria-controls="Counseling">
						</label>
						<button>
							<p class="mb-0 <?php echo ($heading === 'PurchaseSetup') ? 'active-tab' : ''; ?>">
								Purchase Setup
							</p>
						</button>
						<div class="sidebar_menus collapse dropdown-menu row" id="Purchase">
							<div class="col">
								<h3>Purchase Setup</h3>
								<ol>

									<!-- <li class="border-0"><a href="<//?php echo base_url('PurchaseSetup/vendor'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Vendor </a></li> -->
									<li class="border-0"><a href="<?php echo base_url('PurchaseSetup/unit'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Unit </a></li>
									<li class="border-0"><a href="<?php echo base_url('PurchaseSetup/condition'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Condition </a></li>
									<li class="border-0"><a href="<?php echo base_url('PurchaseSetup/brand'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Manufacturer </a></li>
									<li class="border-0"><a href="<?php echo base_url('PurchaseSetup/store'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Store </a></li>
									<li class="border-0"><a href="<?php echo base_url('PurchaseSetup/concern'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Concern </a></li>
									<li class="border-0"><a href="<?php echo base_url('PurchaseSetup/group'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Group </a></li>
									<li class="border-0"><a href="<?php echo base_url('PurchaseSetup/itemMaster'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>ItemMaster </a></li>
								</ol>
							</div>
						</div>
					</li>
				<?php } ?>
				<?php if (in_array("LibrarySetup", $moduleName) || checkRoles([1, 2, 7, 17], $userRolesArray)) { ?>
					<!-- Library Setup-->
					<li class="dropmenu">
						<input type="radio" name="radioGroup1" value="option8" id="Library" />
						<label for="Library" onclick="changeHeaderText('Library Setup')" data-bs-toggle="collapse"
							href="#Library" role="button" aria-expanded="false" aria-controls="Counseling">
						</label>
						<button onclick="changeHeaderText('Library Setup')">
							<p class="mb-0 <?php echo ($heading === 'LibrarySetup') ? 'active-tab' : ''; ?>">
								Library Setup
							</p>
						</button>
						<div class="sidebar_menus collapse dropdown-menu row" id="Library">
							<div class="col">
								<h3>Library Setup</h3>
								<ol>

									<li class="border-0"><a href="<?php echo base_url('LibrarySetup/Author'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Author </a></li>
									<li class="border-0"><a href="<?php echo base_url('LibrarySetup/Publisher'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Publisher </a></li>
									<li class="border-0"><a href="<?php echo base_url('LibrarySetup/Edition'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Edition </a></li>
									<li class="border-0"><a href="<?php echo base_url('LibrarySetup/BookType'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Book Type </a></li>
									<li class="border-0"><a href="<?php echo base_url('LibrarySetup/BCategory'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Book Category </a></li>
									<li class="border-0"><a href="<?php echo base_url('LibrarySetup/BsubCategory'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Book SubCategory </a></li>
									<li class="border-0"><a href="<?php echo base_url('LibrarySetup/BLanguage'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Language </a></li>
									<li class="border-0"><a href="<?php echo base_url('PageController/BookLimit'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Book/Days Limit </a></li>
									<!-- <li class="border-0"><a href="<#?php echo base_url('PageController/DaysLimit'); ?>"> <i class="fa-solid fa-angles-right me-2"></i>Days Limit </a></li> -->
									<li class="border-0"><a href="<?php echo base_url('LibrarySetup/Fine'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Library Fine </a></li>
									<li class="border-0"><a href="<?php echo base_url('LibrarySetup/LRoom'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Room </a></li>
									<li class="border-0"><a href="<?php echo base_url('LibrarySetup/LRow'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Row </a></li>
									<li class="border-0"><a href="<?php echo base_url('LibrarySetup/LShelf'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Shelf </a></li>
									<li class="border-0"><a href="<?php echo base_url('LibrarySetup/LRack'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Rack </a></li>
								</ol>
							</div>
						</div>
					</li>
				<?php } ?>
				<?php if (in_array("HostelSetup", $moduleName) || checkRoles([1, 2, 7, 23], $userRolesArray)) { ?>

					<!-- Hostel Setup-->
					<li class="dropmenu">
						<input type="radio" name="radioGroup1" value="option9" id="Hostel" />
						<label for="Hostel" onclick="changeHeaderText('Hostel Setup')" data-bs-toggle="collapse"
							href="#Hostel" role="button" aria-expanded="false" aria-controls="Counseling">
						</label>
						<button>
							<p class="mb-0 <?php echo ($heading === 'HostelSetup') ? 'active-tab' : ''; ?>">
								Hostel Setup
							</p>
						</button>
						<div class="sidebar_menus collapse dropdown-menu row" id="Hostel">
							<div class="col">
								<h3>Hostel Setup</h3>
								<ol>

									<li class="border-0"><a href="<?php echo base_url('HostelSetup/Hostel'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Hostel</a></li>

									<li class="border-0"><a href="<?php echo base_url('HostelSetup/Occupancy'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Occupancy Type</a></li>
									<li class="border-0"><a href="<?php echo base_url('HostelSetup/room'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Room Type</a></li>
									<li class="border-0"><a
											href="<?php echo base_url('HostelSetup/HostelRoomStructure'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Room Structure</a></li>
									<li class="border-0"><a href="<?php echo base_url('HostelSetup/Rules'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Rules</a></li>
								</ol>
							</div>
						</div>
					</li>
				<?php } ?>
				<?php if (in_array("TransportSetup", $moduleName) || checkRoles([1, 2, 7, 25], $userRolesArray)) { ?>

					<!-- Transport Setup-->
					<li class="dropmenu">
						<input type="radio" name="radioGroup1" value="option10" id="Transport" />
						<label for="Transport" onclick="changeHeaderText('Transport Setup')" data-bs-toggle="collapse"
							href="#Transport" role="button" aria-expanded="false" aria-controls="Counseling">
						</label>
						<button>
							<p class="mb-0 <?php echo ($heading === 'TransportSetup') ? 'active-tab' : ''; ?>">
								Transport Setup
							</p>
						</button>
						<div class="sidebar_menus collapse dropdown-menu row" id="Transport">
							<div class="col">
								<h3>Transport Setup</h3>
								<ol>

									<li class="border-0"><a href="<?php echo base_url('TransportSetup/Route'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Create Route</a></li>
									<li class="border-0"><a href="<?php echo base_url('TransportSetup/Vehicle'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Add Vehicle</a></li>
								</ol>
							</div>
						</div>
					</li>
				<?php } ?>

				<?php if (in_array("ExamSetup", $moduleName) || checkRoles([1, 2, 7, 19], $userRolesArray)) { ?>

					<!-- Exam Setup-->
					<li class="dropmenu">
						<input type="radio" name="radioGroup1" value="option11" id="Exam" />
						<label for="Exam" onclick="changeHeaderText('Exam Setup')" data-bs-toggle="collapse" href="#Exam"
							role="button" aria-expanded="false" aria-controls="Counseling">
						</label>
						<button>
							<p class="mb-0 <?php echo ($heading === 'ExamSetup') ? 'active-tab' : ''; ?>">
								Exam Setup
							</p>
						</button>
						<div class="sidebar_menus collapse dropdown-menu row" id="Exam">
							<div class="col">
								<h3>Exam Setup</h3>
								<ol>

									<li class="border-0"><a href="<?php echo base_url('ExamSetup/ExamType'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Exam/Test Type</a></li>
									<!-- <li class="border-0"><a href="<#?php echo base_url('ExamSetup/ExamTypeName'); ?>"> <i class="fa-solid fa-angles-right me-2"></i>Exam/Test Name</a></li> -->
									<li class="border-0"><a href="<?php echo base_url('ExamSetup/Grades'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Grades</a></li>
								</ol>
							</div>
						</div>
					</li>
				<?php } ?>

				<?php if (in_array("GateEntrySetup", $moduleName) || checkRoles([1, 2, 7, 27], $userRolesArray)) { ?>

					<!-- Gate Entry Setup-->
					<li class="dropmenu">
						<input type="radio" name="radioGroup1" value="option12" id="GateEntry" />
						<label for="GateEntry" onclick="changeHeaderText('GateEntry Setup')" data-bs-toggle="collapse"
							href="#GateEntry" role="button" aria-expanded="false" aria-controls="Counseling">
						</label>
						<button>
							<p class="mb-0 <?php echo ($heading === 'GateEntrySetup') ? 'active-tab' : ''; ?>">
								Gate Entry Setup
							</p>
						</button>
						<div class="sidebar_menus collapse dropdown-menu row" id="GateEntry">
							<div class="col">
								<h3>Gate Entry Setup</h3>
								<ol>

									<li class="border-0"><a href="<?php echo base_url('GateEntrySetup/visitor'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Visitor Type</a></li>
									<li class="border-0"><a href="<?php echo base_url('GateEntrySetup/gates'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Gates</a></li>
									<li class="border-0"><a href="<?php echo base_url('GateEntrySetup/bunch'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Bunch</a></li>
									<li class="border-0"><a href="<?php echo base_url('GateEntrySetup/keys'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>keys</a></li>
								</ol>
							</div>
						</div>
					</li>
				<?php } ?>

				<?php if (in_array("AlumniSetup", $moduleName) || checkRoles([1, 2, 7, 9], $userRolesArray)) { ?>

					<!-- Alumni Setup-->
					<li class="dropmenu">
						<input type="radio" name="radioGroup1" value="option13" id="Alumni" />
						<label for="Alumni" onclick="changeHeaderText('Alumni Setup')" data-bs-toggle="collapse"
							href="#Alumni" role="button" aria-expanded="false" aria-controls="Counseling">
						</label>
						<button>
							<p class="mb-0 <?php echo ($heading === 'AlumniSetup') ? 'active-tab' : ''; ?>">
								Alumni Setup
							</p>
						</button>
						<div class="sidebar_menus collapse dropdown-menu row" id="Alumni">
							<div class="col">
								<h3>Alumni Setup</h3>
								<ol>

									<li class="border-0"><a href="<?php echo base_url('AlumniSetup/college'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Colleges</a></li>
									<li class="border-0"><a href="<?php echo base_url('AlumniSetup/companies'); ?>"> <i
												class="fa-solid fa-angles-right me-2"></i>Companies</a></li>
								</ol>
							</div>
						</div>
					</li>
				<?php } ?>

			</ul>
		</aside>
		<div class="Side_overlay"></div>

		<section class="content-wrapper col-md-12 col-lg-10">
			<div class="container">
				<?php $this->load->view('NewMaster/header') ?>

				<script>
					function changeHeaderText(newText) {

						document.getElementById("pageTitle").textContent = newText;
					}
				</script>