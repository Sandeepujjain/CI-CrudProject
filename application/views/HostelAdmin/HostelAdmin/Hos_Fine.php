<!-- FIne Fee STart  -->
<div class="content_wrapper">
	<div class="myDiv" id="Hos_Fine">
		<div class="row">
			<div class="col d-flex">
				<h4 class="sub-heading">
					<i class="fa-solid fa-square-plus m-1"></i>
					<span class="underline"><b>Fine</b>
						<i class="fa-solid fa-circle"></i></span>
				</h4>
				<nav aria-label="breadcrumb" class="ms-3">
					<ol class="breadcrumb justify-content-end">
						<li class="breadcrumb-item"><a href=""><img height="15" width="15" class="mb-1"	src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a></li>
						<li class="breadcrumb-item"><a href="#">Hostel Admin</a></li>
						<li class="breadcrumb-item active" aria-current="page">Fine</li>
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
							<option value="Student Id">Student Id</option>
						</select>
						
						
						<label class="form-label">Student Id</label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="mb-2">
						<input type="text" class="form-control" id="hos_fine_type" placeholder="Fine Type" />
						<label for="hos_fine_type" class="form-label"><i
								class="fa-regular fa-pen-to-square "></i> Fine Type</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="mb-2">
						<input type="text" class="form-control" id="hos_fine_amt" placeholder="Fine Amount" />
						<label for="hos_fine_amt" class="form-label"><i class="fa-regular fa-pen-to-square "></i>
							Fine Amount</label>
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
						id="myTable_HostelFine">
						<thead>
							<tr>
								<th>SN</th>
								<th>STUDENT ID</th>
								<th>FINE TYPE</th>
								<th>FINE AMOUNT</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>#S231</td>
								<td></td>
								<td>2,000</td>
								<td>
									<button type="button" class="btn" data-bs-toggle="modal"
										data-bs-target="#editFinetModal" data-toggle="tooltip" data-placement="top"
										title="Edit">
										<img width="40" height="40"
											src="https://img.icons8.com/clouds/100/edit-user.png" alt="edit-user" />
									</button>
									<a href="<?php echo base_url('MasterAdmin/') ?>"
										onclick="return confirm('Confirm You Want To Delete Fine');"
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
<!-- FIne Fee End -->

<!-- Edit Fine Fee modal popup end -->
<div class="modal fade" id="editFinetModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row modal-title align-items-end mt-1 w-100">
					<div class="col-11">
						<i class="fa-regular fa-pen-to-square me-2"></i><span>Update Fine</span>
					</div>
					<div class="col text-end  p-0">
						<button type="button" class="btn-close myfont" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
				</div>                    
			</div>
			<div class="modal-body p-0">
				<div class="row align-items-end bordery mb-1 p-1 m-0">
					<div class="col-1">
						<img src="<?php echo base_url('assets/images/boy.jpg'); ?>" height="40" class="rounded" alt="Cinque Terre">
					</div>
					<div class="col">
						<div class="row">
							<div class="col-12 text-start">
								<span class="mycolor2">Rajesh Kumar</span>
							</div>
						</div>
						<div class="row">
							<div class="col-12 mycolor">
								SI002023
							</div>
						</div>
					</div>
					<div class="col text-end myfont mb-3">
						<span class="mycolor">12-02-2023</span>
					</div>
				</div>
				<div class="p-2">
					<div class="mb-3">
						<div class="mb-2">
							<select class="form-select" name="" required>
								<option value="" disabled selected></option>
								<option value="Student Id">Student Id</option>
							</select>
							
							
							<label class="form-label">Select Student Id</label>
						</div>
					</div>
					<div class="mb-3">
						<div class="mb-2">
							<input type="text" class="form-control" id="Hos_mod_Fine_type" placeholder="Enter Fine Type" />
							<label for="Hos_mod_Fine_type" class="form-label"><i class="fa-regular fa-pen-to-square "></i> Enter Fine Type</label>
						</div>
					</div>
					<div class="mb-3">
						<div class="mb-2">
							<input type="text" class="form-control" id="Hos_mod_Fine_Amount" placeholder="Enter Fine Amount" />
							<label for="Hos_mod_Fine_Amount" class="form-label"><i class="fa-regular fa-pen-to-square "></i> Enter Fine Amount</label>
						</div>
					</div>
					<div class="col text-end">
						<button type="submit" class="btn schl-btn-white">
							<img width="40" height="40" src="https://img.icons8.com/clouds/100/checked--v1.png"
								alt="checked--v1" /> Update
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Edit FIne Fee modal popup end -->