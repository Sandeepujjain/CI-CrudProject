	<!-- Fee pay STart -->
<div class="content_wrapper">
	<div class="myDiv" id="Hos_Fee_Pay">
		<div class="row">
			<div class="col d-flex">
				<h4 class="sub-heading">
					<i class="fa-solid fa-square-plus m-1"></i>
					<span class="underline"><b>Fee Pay</b>
						<i class="fa-solid fa-circle"></i></span>
				</h4>
				<nav aria-label="breadcrumb" class="ms-3">
					<ol class="breadcrumb justify-content-end">
						<li class="breadcrumb-item"><a href=""><img height="15" width="15" class="mb-1" src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a></li>
						<li class="breadcrumb-item"><a href="#">Hostel Admin</a></li>
						<li class="breadcrumb-item active" aria-current="page">Fee Pay</li>
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
						<input type="text" class="form-control" id="hos_fee_pay_hosteler_id" placeholder="Hosteler Id" />
						<label for="hos_fee_pay_hosteler_id" class="form-label"><i class="fa-regular fa-pen-to-square "></i> Hosteler Id</label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="mb-2">
						<select class="form-select" name="" required>
							<option value="" disabled selected></option>
							<option value="July to December">July to December</option>
							<option value="January to June">January to June</option>
						</select>
						
						
						<label class="form-label">Pay</label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="mb-2">
						<input type="date" class="form-control" id="hos_fee_pay_date" placeholder="Date" />
						<label for="hos_fee_pay_date" class="form-label"><i class="fa-regular fa-pen-to-square "></i> Date</label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="mb-2">
						<input type="text" class="form-control" id="hos_pay_amt" placeholder="Date" />
						<label for="hos_pay_amt" class="form-label"><i class="fa-regular fa-pen-to-square "></i> Pay Amount</label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="mb-2">
						<input type="text" class="form-control" id="hos_fee_pay_remark" placeholder="Remark" />
						<label for="hos_fee_pay_remark" class="form-label"><i class="fa-regular fa-pen-to-square "></i> Remark</label>
					</div>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col text-end">
					<button type="submit" class="btn schl-btn-white">
						<img width="35" height="35" src="https://img.icons8.com/clouds/100/checkmark--v1.png" alt="checkmark--v1"/> <b>SAVE </b>
					</button>
				</div>
			</div>
		</div>
		<div class="card p-2 mt-2">
			<div class="row">
				<div class="col">
					<table class="table table-responsive table-striped table-hover table-sm school-table" id="myTable_FeePayHostel">
						<thead>
							<tr>
								<th>HOSTEL</th>
								<th>HOSTELLER ID</th>
								<th>SESSION</th>
								<th>PAY DATE</th>
								<th>FEE</th>
								<th>FINE</th>
								<th>PAY</th>
								<th>DUE</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Hostel Name</td>
								<td>H123</td>
								<td>July to December</td>
								<td>17-06-2023</td>
								<td>5000</td>
								<td></td>
								<td>2000</td>
								<td>3000</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
	<!-- Fee pay End -->