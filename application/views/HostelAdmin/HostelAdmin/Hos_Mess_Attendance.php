	<!-- Mess_Attendance STart -->
<div class="content_wrapper">
	<div class="myDiv" id="Hos_Mess_Attendance">
		<div class="row">
			<div class="col-12 d-flex justify-content-between">
				<h4 class="sub-heading">
					<i class="fa-solid fa-square-plus m-1"></i>
					<span class="underline"><b>Mess Attendance</b>
						<i class="fa-solid fa-circle"></i></span>
				</h4>
				<nav aria-label="breadcrumb" class="ms-2">
					<ol class="breadcrumb justify-content-end">
						<li class="breadcrumb-item"><a href=""><img height="15" width="15" class="mb-1" src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a></li>
						<li class="breadcrumb-item"><a href="#">Hostel Admin</a></li>
						<li class="breadcrumb-item active" aria-current="page">Mess Attendance</li>
					</ol>
				</nav>
			</div>
		</div>
		<form action="<?php echo base_url('MasterAdmin/') ?>" method="post" enctype="multipart/form-data">
			<div class="card card-body schl-btn-lgreen">
				<div class="row align-items-end">
					<div class="col-md-2 mb-2">
						<label for="hos_mess_attendance_date" class="form-label"><i class="fa-regular fa-pen-to-square "></i>Date</label>
						<input type="date" class="form-control" id="hos_mess_attendance_date" placeholder="Date" />
					</div>
					<div class="col-md-2 mb-2">
						<label class="form-label">Select </label>
						<select class="form-select" name="" required>
							<option value="" selected>Select Type</option>
							<option value="BreakFast">BreakFast</option>
							<option value="Lunch">Lunch</option>
							<option value="Dinner">Dinner</option>
						</select>
					</div>
					<div class="col-md-2 mb-2">
						<label class="form-label"> Hostel</label>
						<select class="form-select" name="" required>
							<option value="" selected> Select Hostel</option>
							<option value="Hostel1">Hostel1</option>
							<option value="Hostel2">Hostel2</option>
						</select>
					</div>
				</div>
			</div>
			<div class="card mt-2">
				<div class="card-header schl-text-green">
					Add Mess Attendance 
				</div>
				<div class="row">
					<div class="col">
						<table class="table table-responsive table-striped table-hover table-sm school-table" id="myTable_MessAttendance">
							<thead>
								<tr>
									<th>SN</th>
									<th>STUDENT NAME</th>
									<th>STATUS</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Pari</td>
									<td>
										<div class="row">
											<div class="col-md-4">
												<input type="radio" name="status">
												<label>Present</label>
											</div>
											<div class="col-md-4">
												<input type="radio" name="status">
												<label>Absent</label>
											</div>
											<div class="col-md-4">
												<input type="radio" name="status">
												<label>Leave</label>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row mt-2 mb-1">
					<div class="col text-end mx-2">
						<button type="submit" class="btn schl-btn-white">
							<img width="35" height="35" src="https://img.icons8.com/clouds/100/checkmark--v1.png" alt="checkmark--v1"/> <b>SAVE </b>
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
	<!-- Mess_Attendance End -->