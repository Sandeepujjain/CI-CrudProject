<!-- Fee Satus STart -->
<div class="content_wrapper">
	<div class="myDiv" id="Hos_Status">
		<div class="row">
			<div class="col d-flex">
				<h4 class="sub-heading">
					<i class="fa-solid fa-square-plus m-1"></i>
					<span class="underline"><b>Status</b>
						<i class="fa-solid fa-circle"></i></span>
				</h4>
				<nav aria-label="breadcrumb" class="ms-3">
					<ol class="breadcrumb justify-content-end">
						<li class="breadcrumb-item"><a href=""><img height="15"
									width="15" class="mb-1"
									src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a></li>
						<li class="breadcrumb-item"><a href="#">Hostel Admin</a></li>
						<li class="breadcrumb-item active" aria-current="page">Status</li>
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
							<option value="Hostel 1">Hostel 1</option>
						</select>
						
						
						<label class="form-label"> Hostel</label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="mb-2">
						<select class="form-select" name="" required>
							<option value="" disabled selected></option>
							<option value="1">1</option>
							<option value="2">2</option>
						</select>
						
						
						<label class="form-label"> Floor</label>
					</div>
				</div>
			</div>
		</div>
		<div class="card mt-2">
			<div class="card-header">
				<div class="row">
					<div class="col-2">
						<b>Hostel Name </b>
					</div>
					<div class="col"></div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<table class="table table-responsive table-striped table-hover table-sm school-table"
						id="myTable_HostelStatus">
						<thead>
							<tr>
								<th>SN</th>
								<th>ROOM</th>
								<th>STUDENT NAME</th>
								<th>TOTAL FEE</th>
								<th>FINE</th>
								<th>FEE PAY</th>
								<th>DUE MONTH</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>II-203</td>
								<td>Pari</td>
								<td>10,000</td>
								<td></td>
								<td>2,000</td>
								<td>8,000</td>
								<td>
									<button type="button" class="btn" data-bs-toggle="modal"
										data-bs-target="#viewHostelerDetail" data-toggle="tooltip"
										data-placement="top" title="View">
										<img width="40" height="40"
											src="https://img.icons8.com/clouds/100/search-in-list.png"
											alt="search-in-list" />
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Fee Satus End -->


<!-- Hosteler Deatils modal popup end -->
<div class="modal fade" id="viewHostelerDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Hosteler Details</h5>
				<button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="row">
				<div class="col-md-2">
					<img src="http://localhost/school/assets/images/maam2.jpg" class="img-responsive w-100">
				</div>
				<div class="col-md-10">
					<div class="row mt-3">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-4 schl-text-blue">Name</div>
								<div class="col-md-8">Pari</div>
							</div>
							<div class="row">
								<div class="col-md-4 schl-text-blue">Father Name</div>
								<div class="col-md-8">Father Name</div>
							</div>
							<div class="row">
								<div class="col-md-4 schl-text-blue">Contact No</div>
								<div class="col-md-8">9893853234</div>
							</div>
							<div class="row">
								<div class="col-md-4 schl-text-blue">Addhar No</div>
								<div class="col-md-8">9893 8532 3434</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-4 schl-text-blue">Blood Group</div>
								<div class="col-md-8">Pari</div>
							</div>
							<div class="row">
								<div class="col-md-4 schl-text-blue">Class</div>
								<div class="col-md-8">11th</div>
							</div>
							<div class="row">
								<div class="col-md-4 schl-text-blue">Address</div>
								<div class="col-md-8">22/3, Jagdish Gali, Chandani Chowk Delhi</div>
							</div>
							<div class="row">
								<div class="col-md-4 schl-text-blue">From Date</div>
								<div class="col-md-8">12-3-2020</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr class="mt-3">
			<div class="row">
				<div class="col">
					<h4>Hostel Details</h4>
				</div>
			</div>
			<div class="row p-2">
				<div class="col">
					<table class="table table-responsive table-striped table-hover table-sm school-table"
						id="myTable_HostelerDetail">
						<thead>
							<tr>
								<th>HOSTEL NAME</th>
								<th>FEE/MONTH</th>
								<th>MONTH</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Hostel 1</td>
								<td>4000</td>
								<td>July To December</td>
							</tr>
							<tr>
								<td>Hostel 1</td>
								<td>4000</td>
								<td>January To June</td>
							</tr>
							<tr>
								<td>Hostel 1</td>
								<td>4000</td>
								<td>Caution</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<h4>Fee Status</h4>
				</div>
			</div>
			<div class="row p-2">
				<div class="col">
					<table class="table table-responsive table-striped table-hover table-sm school-table"
						id="myTable_HostelerFeeDetails">
						<thead>
							<tr>
								<th>DATE</th>
								<th>FEE PAY</th>
								<th>REMARK</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>12-10-2023</td>
								<td>4000</td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Hosteler Deatils  modal popup end -->