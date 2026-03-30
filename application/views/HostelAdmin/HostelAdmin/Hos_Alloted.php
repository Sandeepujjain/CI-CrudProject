<!-- Alloted STart -->
<div class="content_wrapper">
	<div class="myDiv" id="Hos_Alloted">
		<div class="row">
			<div class="col-12 justify-content-between d-flex">
				<h4 class="sub-heading">
					<i class="fa-solid fa-square-plus m-1"></i>
					<span class="underline"><b>Alloted</b>
						<i class="fa-solid fa-circle"></i></span>
				</h4>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-end">
						<li class="breadcrumb-item">
							<a href=""><img height="15"
									width="15" class="mb-1" src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a>
						</li>
						<li class="breadcrumb-item"><a href="#">Hostel Admin</a></li>
						<li class="breadcrumb-item active" aria-current="page">Alloted</li>
					</ol>
				</nav>
			</div>
		</div>
		<form action="<?php echo base_url('MasterAdmin/') ?>" method="post" enctype="multipart/form-data">
			<div class="card card-body schl-btn-lgreen p-0">
				<div class="card-header schl-text-green">
					Filter
				</div>
				<div class="row align-items-end p-3">

					<div class="col-md-2 mb-2">
						<input type="hidden" id="school_id" name="school_id" value="<?= @$school_id ?>">
						<label class="form-label">Hostel <span class="text-danger">*</span> </label>
						<?= selectHostel(
							[
								'select_name' => 'hostel_id',
								'select_id' => 'hostel_id',
								'option_label' => "Select Hostel",
								'select_classes' => 'form-select',
								'option_selected' => "",
								"select_attribute" => "onchange=HostelAllotedRooms()",
							],
							[
								'hostel_school' => $_SESSION['emp_data_session']['emp_schoolid']
							]

						) ?>
					</div>
					<div class="col-md-2 mb-2">
						<label for="" class="form-label">Select Floor</label>
						<select class="form-select" id="hostel_floor_id" name="hostel_floor_id"
							onchange="HostelAllotedRooms();">
							<option value="">Select Floor</option>
						</select>
					</div>
				</div>
			</div>


			<div class="card mt-2">
				<div class="card-header schl-text-green">
					Alloted Hostel List
				</div>
				<div class="row table_width">
					<div class="col">
						<table class="table table-responsive table-striped table-hover school-table-1 table-sm"
							id="AllotedHostelListTable">
						</table>
					</div>
				</div>
			</div>

		</form>
	</div>
</div>
<!-- Alloted End  -->

<div class="modal fade" id="studentRegistrationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
	aria-hidden="true"><a href=""><img height="15" width="15" class="mb-1"
			src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a>
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<div class="d-flex justify-content-between w-100 modal-title">
					<h5 class="mb-0">Student Registration Form</h5>
					<div class="col text-end  p-0">
						<button type="button" class="btn-close myfont" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
				</div>
			</div>

			<div id="View_AllotmentDataShow">
			</div>

		</div>
	</div>
</div>

<!-- Hostel Leave modal popup end -->
<div class="modal fade" id="hostelLeaveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"> Hostel Leave </h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body">
				<form id="hostelleaveformid">

					<div class="mb-3">
						<label class="form-label">
							Leave Date
						</label>
						<div class="user-input-wrp mt-4">
							<input type="hidden" name="allotment_status" id="allotment_status" value="1">
							<input type="hidden" name="alloted_id" id="alloted_id">
							<input type="date" class="form-control" name="hostel_leave_date" id="hostel_leave_date"
								required />
						</div>
						<span class="error-message hide-error-message" id="hostel_leave_date-error"></span>
					</div>
					<div class="mb-3">
						<label class="form-label">
							Leave Remark
						</label>
						<div>
							<input type="text" name="hostel_leave_remark" id="hostel_leave_remark" class="form-control"
								required />
						</div>
						<span class="error-message hide-error-message" id="hostel_leave_remark-error"></span>
					</div>

					<div class="col text-end">
						<button type="button"
							onclick="CommonAjaxWithValidation('Hostel Leave ?','Update','hostelleaveformid', function_url, {swal: false, successCallback: successCallback, errorCallback: errorCallback})"
							class="btn schl-btn-white">
							<img width="40" height="40" src="https://img.icons8.com/clouds/100/checked--v1.png"
								alt="checked--v1" /> Hostel Leave
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Hostel Leave modal popup end -->

<script>
	var function_url = "<?= base_url('HostelAdmin/Update_Hostel_LeaveAllotment') ?>";

	function successCallback(response) {
		window.location.href = "<?= base_url('HostelAdmin/Hos_Alloted') ?>";
	}

	function errorCallback(response) {
		console.log(response);
	}


	$(document).ready(function() {

		// initializeSelect2('acdemic_year_id', {
		// 	placeholder: "Select Year",
		// }, "</?= base_url('ApiController/getAcademicyearListApi') ?>", {}, "acdemic_year_id", "acdemic_year_name");


		$('#hostel_id').on('change', function() {

			$('#hostel_floor_id').empty();
			var hostel_id = $(this).val();
			initializeSelect2('hostel_floor_id', {
				placeholder: "Select Floor ",
			}, "<?= base_url('ApiController/getFloorByHostel') ?>", {
				'hostel_id': hostel_id
			}, "hostel_floor_id", "hostel_floor_name");
		});

	});


	$(document).ready(function() {
		HostelAllotedRooms();
	});

	function HostelAllotedRooms(parameter = {}) {

		var school_id = $('#school_id').val();
		// var acdemic_year_id = $('#acdemic_year_id').val();
		var hostel_id = $('#hostel_id').val();
		var hostel_floor_id = $('#hostel_floor_id').val();

		var parameter = {
			'school_id': school_id,
			// 'acdemic_year_id': acdemic_year_id,
			'hostel_id': hostel_id,
			'hostel_floor_id': hostel_floor_id,
		}
		DataTableInitialized(
			'AllotedHostelListTable', // table_id
			"<?= base_url('HostelAdmin/getAllotedHostelRoomsData') ?>", // url
			'POST', // method
			parameter, // parameter
			successDataTableCallbackFunction // dataTableSuccessCallBack
		);
	}

	function successDataTableCallbackFunction(response) {
		var columns = [{
				title: "S.No.",
				data: null,
				render: function(data, type, row, meta) {
					return meta.row + 1; // Returns the row index starting from 1
				},
				visible: true
			},
			{
				title: "USER ID",
				data: function(row) {
					return row.empautonumber || row.stu_admission_id || 'N/A';
				}
			},
			{
				title: "USER NAME",

				data: function(row) {
					return row.hostelallot_employeename || row.allot_studentname || 'N/A';
				}
			},
			{
				title: "HOSTEL NAME",
				data: "hostel_name"
			},

			{
				title: "FLOOR",
				data: "hostel_floor_name"
			},
			{
				title: "ROOM",
				data: "hostel_room_name"

			},
			{
				title: "OCCUPANCY NAME",
				data: "occupancy_name"
			},
			{
				title: "ALLOTMENT DATE",
				data: "alloted_date"
			},

			{
				title: "View Info",
				data: null,
				render: function(data, type, row) {
					var encoded_id = btoa(row.alloted_id); // Encode the ID
					var viewAllotmentButton = '';
					var updateButton = `
			<button type="button" onclick="HostelLeaveOnclick('${row.alloted_id}')" class="btn" data-bs-toggle="modal" data-bs-target="#hostelLeaveModal" data-toggle="tooltip" data-placement="top" title="Update">
				<img width="40" height="40" src="https://img.icons8.com/clouds/100/available-updates.png" alt="available-updates" />Leave Hostel
			</button>
		`;

					// Show "View Allotment" button only if stu_admission_id is present
					if (row.stu_admission_id) {
						viewAllotmentButton = `
				<a data-bs-toggle="modal" onclick="AllotmentViewData('${row.alloted_id}')" data-bs-target="#studentRegistrationModal" class="btn schl-btn-white">
					<img width="40" height="40" src="https://img.icons8.com/clouds/100/checked--v1.png" alt="checked--v1" /> View Allotment
				</a>
			`;
					}

					return viewAllotmentButton + updateButton;
				}
			}


		];

		if (response.ApiResponseStatusCode == 200) {
			return {
				status: response.ApiResponseStatusCode,
				columns: columns,
				data: response.data
			};
		} else {
			return {
				status: response.ApiResponseStatusCode,
				columns: columns,
				data: []
			};
		}
	}

	function AllotmentViewData(alloted_id) {
		$.ajax({
			url: base_url + 'HostelAdmin/getAllotmentViewData',
			data: {
				alloted_id: alloted_id
			}, // Pass the ID as an object
			type: 'POST',
			success: function(response) {
				$("#View_AllotmentDataShow").html(response);
			}
		});
	}

	function HostelLeaveOnclick(alloted_id) {
		$('.hide-error-message').html('');
		$.ajax({
			url: base_url + 'HostelAdmin/getAllotMentLeaveHostelData',
			data: {
				alloted_id: alloted_id
			},
			type: 'POST',
			success: function(response) {
				if (response.ApiResponseStatusCode === 200 || response.ApiResponseStatusCode === 201) {
					// toastr.success(response.message);

					$('#alloted_id').val(response.data.alloted_id);
					$('#hostel_leave_date').val(response.data.hostel_leave_date);
					$('#hostel_leave_remark').val(response.data.hostel_leave_remark);
				} else {
					toastr.error(response.errors);
				}
			},
			error: function(xhr, status, error) {
				Swal.fire({
					icon: 'error',
					title: 'Action Failed',
					text: 'There was an error while processing the request. Please try again.'
				});
			}
		});
	}
</script>