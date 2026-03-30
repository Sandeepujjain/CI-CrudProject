	<!-- Past Hostellers STart -->
	<div class="content_wrapper">
		<div class="myDiv" id="Hos_Past_Hostellers">
			<div class="row">
				<div class="col-12 justify-content-between d-flex">
					<h4 class="sub-heading">
						<i class="fa-solid fa-square-plus m-1"></i>
						<span class="underline"><b>Past Hostellers</b>
							<i class="fa-solid fa-circle"></i></span>
					</h4>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb justify-content-end">
							<li class="breadcrumb-item"><a href=""><img height="15" width="15" class="mb-1" src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a></li>
							<li class="breadcrumb-item"><a href="#">Hostel Admin</a></li>
							<li class="breadcrumb-item active" aria-current="page">Past Hostellers</li>
						</ol>
					</nav>
				</div>
			</div>

			<div class="card card-body schl-btn-lgreen">
				<div class="row mt-3">
					<div class="col-md-2">
							<label class="form-label">Hostel <span class="text-danger">*</span> </label>
							<?= selectHostel(
								[
									'select_name' => 'hostel_id',
									'select_id' => 'hostel_id',
									'option_label' => "Select Hostel",
									'select_classes' => 'form-select',
									'option_selected' => "",
									"select_attribute" => "onchange=HostelLeave()",
								],
								[
									'hostel_school' => $_SESSION['emp_data_session']['emp_schoolid']
								]

							) ?>
					</div>
				</div>
			</div>

			<div class="card mt-2">
				<div class="card-header schl-text-green">
					Hostel Name
				</div>
				<div class="row table_width">
					<div class="col">						
						<table class="table table-responsive table-striped table-hover school-table-1 table-sm" id="HostelLeaveTable">
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Past Hostellers End -->

	<script>
		$(document).ready(function() {
			HostelLeave();
		});

		function HostelLeave(parameter = {}) {
			var school_id = "<?= $_SESSION['emp_data_session']['emp_schoolid'] ?>";
			var hostel_id = $('#hostel_id').val();
			var parameter = {
				'school_id': school_id,
				'hostel_id': hostel_id,
			}
			DataTableInitialized(
				'HostelLeaveTable', // table_id
				"<?= base_url('HostelAdmin/getHostelLeaveData') ?>", // url
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
					title: "HOSTELLERS ID",
					data: function(row) {
						return row.empautonumber || row.stu_admission_id || 'N/A';
					}
				},
				{
					title: "HOSTELLERS NAME",
					data: function(row) {
						return row.hostellers_employeename || row.allot_studentname || 'N/A';
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
					title: "ALLOTMENT DATE",
					data: "alloted_date"
				},
				{
					title: "LEAVE DATE",
					data: "hostel_leave_date"
				},
				{
					title: "LEAVE REMARK",
					data: "hostel_leave_remark"
				},



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
	</script>