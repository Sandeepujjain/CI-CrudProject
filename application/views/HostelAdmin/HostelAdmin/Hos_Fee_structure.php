<!-- Fee Structure Start -->
<div class="content_wrapper">
	<div class="myDiv" id="Hos_Fee_structure">
		<div class="row">
			<div class="col d-flex">
				<h4 class="sub-heading">
					<i class="fa-solid fa-square-plus m-1"></i>
					<span class="underline"><b>Fee Structure</b>
						<i class="fa-solid fa-circle"></i></span>
				</h4>
				<nav aria-label="breadcrumb" class="ms-3">
					<ol class="breadcrumb justify-content-end">
						<li class="breadcrumb-item"><a href=""><img height="15"
									width="15" class="mb-1" src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a></li>
						<li class="breadcrumb-item"><a href="#">Hostel Admin</a></li>
						<li class="breadcrumb-item active" aria-current="page">Fee Structure</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="card card-body schl-btn-lgreen">
			<div class="row align-items-end">
				<div class="col-md-2">
					<div class="mb-2">
						<select class="form-select" name="" required>
							<option value="" disabled selected></option>
							<option value="AY 20-21">AY 20-21</option>
							<option value="AY 19-20">AY 19-20</option>
						</select>
						
						
						<label class="form-label">Acedemic Year</label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="mb-2">
						<select class="form-select" name="" required>
							<option value="" disabled selected></option>
							<option value="Hostel1">Hostel1</option>
						</select>
						
						
						<label class="form-label">Hostel</label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="mb-2">
						<select class="form-select" name="rack_room" id="" required>
							<option value="" disabled selected></option>
							<?php foreach ($Libraryroomshow as $val) { ?>
								<option value="<?php echo $val->library_room_id ?>">
									<?php echo $val->library_room_no ?>
								</option>
							<?php } ?>
						</select>
						
						
						<label class="form-label">Room Type</label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="mb-2">
						<select class="form-select" name="rack_room" id="" required>
							<option value="" disabled selected></option>
							<?php foreach ($Libraryroomshow as $val) { ?>
								<option value="<?php echo $val->library_room_id ?>">
									<?php echo $val->library_room_no ?>
								</option>
							<?php } ?>
						</select>
						
						
						<label class="form-label">Occupancy Type</label>
					</div>
				</div>
				<div class="col text-end">
					<button type="submit" class="btn schl-btn-white">
						<img width="40" height="40" src="https://img.icons8.com/clouds/100/checked--v1.png"
							alt="checked--v1" /> Add
					</button>
				</div>
			</div>
		</div>
		<div class="card p-2 mt-2">
			<div class="row">
				<div class="col">
					<table class="table table-responsive table-striped table-hover table-sm school-table"
						id="mytable_CategoryName">
						<thead>
							<tr>
								<th>SN</th>
								<th>ROOM TYPE</th>
								<th>AMOUNT</th>
								<th>MESS CHARGES</th>
								<th>TOTAL</th>
							</tr>

						</thead>
						<tbody>
							<tr class="align-middle">
								<td>1</td>
								<td>AC</td>
								<td>
									<div class="form-floating school-input my-2">
										<input type="text" class="form-control" id="Hos_Room_Rate"
											placeholder="Rate" />
										<label for="Hos_Room_Rate" class="form-label"><i class="fa-regular fa-pen-to-square me-2"></i>
											Rate</label>
									</div>
								</td>
								<td>
									<div class="form-floating school-input my-2">
										<input type="text" class="form-control" id="Hos_mess_rate"
											placeholder="Rate" />
										<label for="Hos_mess_rate" class="form-label"><i class="fa-regular fa-pen-to-square me-2"></i>
											Rate</label>
									</div>
								</td>
								<td>5,000</td>
							</tr>
							<tr class="align-middle">
								<td>2</td>
								<td>Non-AC</td>
								<td>
									<div class="form-floating school-input my-2">
										<input type="text" class="form-control" id="Hos_Room_Rate2"
											placeholder="Rate" />
										<label for="Hos_Room_Rate2" class="form-label"><i
												class="fa-regular fa-pen-to-square me-2"></i> Rate</label>
									</div>
								</td>
								<td>
									<div class="form-floating school-input my-2">
										<input type="text" class="form-control" id="Hos_mess_rate2"
											placeholder="Rate" />
										<label for="Hos_mess_rate2" class="form-label"><i
												class="fa-regular fa-pen-to-square me-2"></i> Rate</label>
									</div>
								</td>
								<td>4,000</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col text-end">
				<button type="submit" class="btn schl-btn-white">
					<img width="35" height="35" src="https://img.icons8.com/clouds/100/checkmark--v1.png"
						alt="checkmark--v1" /> <b>SAVE </b>
				</button>
			</div>
		</div>
		<div class="card mt-2">
			<div class="card-header schl-text-green">
				View Fee Structure
			</div>
			<div class="row p-2 align-items-end">
				<div class="col-md-2">
					<div class="mb-2">
						<select class="form-select" name="" required>
							<option value="" disabled selected></option>
							<option value="Hostel1">Hostel1</option>
						</select>
						
						
						<label class="form-label">Hostel</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<table class="table table-responsive table-striped table-hover table-sm school-table"
						id="myTable_ViewFeeStructure">
						<thead>
							<tr>
								<th>S.NO</th>
								<th>ROOM TYPE</th>
								<th>OCCUPANCY TYPE</th>
								<th>FEE</th>
								<th>MESS FEE</th>
								<th>TOTAL</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1.</td>
								<td>AC</td>
								<td>Single Occupancy</td>
								<td>3000</td>
								<td>2000</td>
								<td>5000</td>
								<td>
									<button type="button" class="btn" data-bs-toggle="modal"
										data-bs-target="#ViewfeeCategoryEditModal" data-toggle="tooltip"
										data-placement="top" title="Edit">
										<img width="40" height="40"
											src="https://img.icons8.com/clouds/100/edit-user.png" alt="edit-user" />
									</button>
									<a href="<?php echo base_url('MasterAdmin/') ?>"
										onclick="return confirm('Confirm You Want To Delete Fee Structure');"
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
	</div>
</div>
<!-- Fee Structure End -->

<!-- Edit Fee structure modal popup end -->
<div class="modal fade" id="ViewfeeCategoryEditModal" tabindex="-1" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row modal-title align-items-end mt-1 w-100">
					<div class="col-11">
						<i class="fa-regular fa-pen-to-square me-2"></i><span>Update Fee</span>
					</div>
					<div class="col text-end  p-0">
						<button type="button" class="btn-close myfont" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
				</div>                    
			</div>
			<div class="modal-body p-0">
				<div class="row align-items-center bordery mb-1 p-1 m-0">
					<div class="col-1">
						<img src="<?php echo base_url('assets/images/Sir65.jpg'); ?>" height="40" width="40"
							class="rounded" alt="Cinque Terre">
					</div>
					<div class="col">
						<span class="mycolor2">Hostel Name</span>
					</div>
					<div class="col text-end myfont">
						<span class="mycolor">12-02-2023</span>
					</div>
				</div>
				<div class="p-3">
					<div class="mb-3">
						<div class="mb-2">
							<select class="form-select" name="" required>
								<option value="" disabled selected></option>
								<option value="Hostel1">Hostel1</option>
							</select>
							
							
							<label class="form-label">Room Type</label>
						</div>
					</div>
					<div class="mb-3">
						<div class="mb-2">
							<select class="form-select" name="" required>
								<option value="" disabled selected></option>
								<option value="Hostel1">Hostel1</option>
							</select>
							
							
							<label class="form-label">Occupancy Type</label>
						</div>
					</div>
					<div class="mb-3">
						<div class="mb-2">
							<input type="text" class="form-control" id="fee_struct_edit_fee" placeholder="Fee" />
							<label for="fee_struct_edit_fee" class="form-label"><i class="fa-regular fa-pen-to-square me-2"></i> Fee</label>
						</div>
					</div>
					<div class="mb-3">
						<div class="mb-2">
							<input type="text" class="form-control" id="fee_struct_edit_mess_fee" placeholder="Mess Fee" />
							<label for="fee_struct_edit_mess_fee" class="form-label"><i class="fa-regular fa-pen-to-square me-2"></i>Mess Fee</label>
						</div>
					</div>
					<div class="mb-3">
						<div class="mb-2">
							<input type="text" class="form-control" id="fee_struct_edit_total_fee" placeholder="Total Fee" />
							<label for="fee_struct_edit_total_fee" class="form-label"><i class="fa-regular fa-pen-to-square me-2"></i>Total Fee</label>
						</div>
					</div>
					<div class="col text-end">
						<button type="submit" class="btn schl-btn-white">
							<img width="40" height="40" src="https://img.icons8.com/clouds/100/checked--v1.png"	alt="checked--v1" /> Update
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Edit Fee structure modal popup end -->

