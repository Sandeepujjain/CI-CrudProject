<!-- Gatepass STart -->
<div class="content_wrapper">
	<div class="myDiv" id="Hos_Gatepass">
		<div class="row">
			<div class="col d-flex">
				<h4 class="sub-heading">
					<i class="fa-solid fa-square-plus m-1"></i>
					<span class="underline"><b>Gatepass</b>
						<i class="fa-solid fa-circle"></i></span>
				</h4>
				<nav aria-label="breadcrumb" class="ms-3">
					<ol class="breadcrumb justify-content-end">
						<li class="breadcrumb-item"><a href=""><img height="15"
									width="15" class="mb-1"
									src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a></li>
						<li class="breadcrumb-item"><a href="#">Hostel Admin</a></li>
						<li class="breadcrumb-item active" aria-current="page">Gatepass</li>
					</ol>
				</nav>
			</div>
		</div>
		<form action="<?php echo base_url('MasterAdmin/') ?>" method="post" enctype="multipart/form-data">
			<div class="card card-body schl-btn-lgreen">
				<div class="row align-items-end">
					<div class="col-md-2">
						<div class="mb-2">
							<input type="date" class="form-control" id="hos_Gatepass_date" placeholder="Date" />
							<label for="hos_Gatepass_date" class="form-label"><i
									class="fa-regular fa-pen-to-square "></i>Date</label>
						</div>
					</div>
					<div class="col-md-2">
						<div class="mb-2">
							<input type="time" class="form-control" id="hos_gatepass_time" placeholder="Time" />
							<label for="hos_gatepass_time" class="form-label"><i
									class="fa-regular fa-pen-to-square "></i> Time</label>
						</div>
					</div>
					<div class="col">
						<div class="row">
							<div class="col-md-3 fw-bold">No =</div>
							<div class="col-md-9"></div>
						</div>
					</div>
				</div>
				<div class="row align-items-end mt-4">
					<div class="col-md-3">
						<div class="mb-2">
							<input type="text" class="form-control" id="hos_gatepass_supplier_name"
								placeholder="Name Of Supplier" />
							<label for="hos_gatepass_supplier_name" class="form-label"><i
									class="fa-regular fa-pen-to-square "></i> Name Of Supplier</label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="mb-2">
							<input type="text" class="form-control" id="hos_gatepass_vehicle_no"
								placeholder="Vehicle No" />
							<label for="hos_gatepass_vehicle_no" class="form-label"><i
									class="fa-regular fa-pen-to-square "></i> Vehicle No</label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="mb-2">
							<input type="text" class="form-control" id="hos_gatepass_perticular"
								placeholder="Perticular" />
							<label for="hos_gatepass_perticular" class="form-label"><i
									class="fa-regular fa-pen-to-square "></i> Perticular</label>
						</div>
					</div>
					<div class="col-2">
						<button type="submit" class="btn schl-btn-white">
							<img width="35" height="35" src="https://img.icons8.com/clouds/100/checkmark--v1.png"
								alt="checkmark--v1" /> <b>SAVE </b>
						</button>
					</div>
				</div>
			</div>
			<div class="card mt-2">
				<div class="row">
					<div class="col">
						<table class="table table-responsive table-striped table-hover table-sm school-table"
							id="mytable_Gatepass">
							<thead>
								<tr>
									<th>SN</th>
									<th>DATE</th>
									<th>TIME</th>
									<th>SUPPLIER</th>
									<th>VEHICLE NO</th>
									<th>PARTICULAR</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>12-12-2021</td>
									<td>11:10</td>
									<td>Supplier</td>
									<td>MP13</td>
									<td>Particular</td>
									<td>
										<button type="button" class="btn" data-bs-toggle="modal"
											data-bs-target="#editGatePasstModal" data-toggle="tooltip"
											data-placement="top" title="Edit">
											<img width="40" height="40"
												src="https://img.icons8.com/clouds/100/edit-user.png" alt="edit-user" />
										</button>
										<a href="<?php echo base_url('MasterAdmin/') ?>"
											onclick="return confirm('Confirm You Want To Delete');"
											data-toggle="tooltip" data-placement="top" title="Delete">
											<img width="40" height="40"
												src="https://img.icons8.com/clouds/100/delete-forever.png"
												alt="delete-forever" />
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- Gatepass End -->

<!-- Edit Hostel Menu modal popup end -->
<div class="modal fade" id="editGatePasstModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"> Update Gatepass </h5>
				<button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url('MasterAdmin'); ?>" id="" enctype="multipart/form-data" method="post"
					novalidate="novalidate">
					<div class="mb-3">
						<label class="form-label">
							Date
						</label>
						<div class="user-input-wrp mt-4">
							<input type="date" class="form-control" name="" required />
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">
							Time
						</label>
						<div class="user-input-wrp mt-4">
							<input type="time" class="form-control" name="" required />
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">
							Name Of Supplier
						</label>
						<div >
							<br />
							<input type="text" class="form-control" required />
							<span class="form-label"> <i class="fa-regular fa-pen-to-square me-2"></i>Enter Name Of
								Supplier
							</span>
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">
							Vehicle No
						</label>
						<div >
							<br />
							<input type="text" class="form-control" required />
							<span class="form-label"> <i class="fa-regular fa-pen-to-square me-2"></i>Enter Vehicle
								No
							</span>
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">
							Enter Perticular
						</label>
						<div >
							<br />
							<input type="text" class="form-control" required />
							<span class="form-label"> <i class="fa-regular fa-pen-to-square me-2"></i>Enter
								Perticular
							</span>
						</div>
					</div>
					<div class="col text-end mt-3 mx-2">
						<button type="submit" class="btn schl-btn-white">
							<img width="40" height="40" src="https://img.icons8.com/clouds/100/checked--v1.png"
								alt="checked--v1" /> Update
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Edit Hostel Menu modal popup end -->