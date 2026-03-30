	<!-- Attendance_Report STart -->
<div class="content_wrapper">
	<div class="myDiv" id="Hos_Attendance_Report">
		<div class="row">
			<div class="col d-flex">
				<h4 class="sub-heading">
					<i class="fa-solid fa-square-plus m-1"></i>
					<span class="underline"><b>Attendance Report</b>
						<i class="fa-solid fa-circle"></i></span>
				</h4>
				<nav aria-label="breadcrumb" class="ms-3">
					<ol class="breadcrumb justify-content-end">
						<li class="breadcrumb-item"><a href=""><img height="15" width="15" class="mb-1" src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a></li>
						<li class="breadcrumb-item"><a href="#">Hostel Admin</a></li>
						<li class="breadcrumb-item active" aria-current="page">Attendance Report</li>
					</ol>
				</nav>
			</div>
		</div>
		<form action="<?php echo base_url('MasterAdmin/') ?>" method="post" enctype="multipart/form-data">
			<div class="card card-body schl-btn-lgreen">
				<div class="row align-items-end mt-3">
					<div class="col-md-2">
						<div class="mb-2">
							<select class="form-select" name="" required>
								<option value="" disabled selected></option>
								<option value="Hostel1">Hostel1</option>
								<option value="Hostel2">Hostel2</option>
							</select>
							
							
							<label class="form-label"> Hostel </label>
						</div>
					</div>
					<div class="col-md-2">
						<div class="mb-2">
							<input type="text" class="form-control" id="hos_allotment_report_date" placeholder="Date" />
							<label for="hos_allotment_report_date" class="form-label"><i class="fa-regular fa-pen-to-square "></i> Date</label>
						</div>
					</div>
				</div>
			</div>
			<div class="card mt-2">
				<div class="card-header schl-text-green">
					2022-01-01 TO 2022-01-31
				</div>
				<div class="row m-0 overflow-auto">
					<div class="col">
						<table class="table table-responsive table-striped table-hover table-sm school-table" id="myTable_ReportAttemdance">
							<thead>
								<tr>
									<th rowspan="3">S. N</th>
									<th rowspan="3">Date/Day/ S.Name</th>
									<th colspan="3"><span>Sat</span></th>
									<th colspan="3"><span>Sun</span></th>
									<th colspan="3"><span>Mon</span></th>
									<th colspan="3"><span>Tue</span></th>
									<th colspan="3"><span>Wed</span></th>
									<th colspan="3"><span>Thu</span></th>
									<th colspan="3"><span>Fri</span></th>
									<th colspan="3"><span>Sat</span></th>
									<th colspan="3"><span>Sun</span></th>
									<th colspan="3"><span>Mon</span></th>
									<th colspan="3"><span>Tue</span></th>
									<th colspan="3"><span>Wed</span></th>
									<th colspan="3"><span>Thu</span></th>
									<th colspan="3"><span>Fri</span></th>
									<th colspan="3"><span>Sat</span></th>
									<th colspan="3"><span>Sun</span></th>
									<th colspan="3"><span>Mon</span></th>
									<th colspan="3"><span>Tue</span></th>
									<th colspan="3"><span>Wed</span></th>
									<th colspan="3"><span>Thu</span></th>
									<th colspan="3"><span>Fri</span></th>
									<th colspan="3"><span>Sat</span></th>
									<th colspan="3"><span>Sun</span></th>
									<th colspan="3"><span>Mon</span></th>
									<th colspan="3"><span>Tue</span></th>
									<th colspan="3"><span>Wed</span></th>
									<th colspan="3"><span>Thu</span></th>
									<th colspan="3"><span>Fri</span></th>
									<th colspan="3"><span>Sat</span></th>
									<th colspan="3"><span>Sun</span></th>
									<th colspan="3"><span>Mon</span></th>
								</tr>
								<tr>
									<th colspan="3"><span>01</span></th>
									<th colspan="3"><span>02</span></th>
									<th colspan="3"><span>03</span></th>
									<th colspan="3"><span>04</span></th>
									<th colspan="3"><span>05</span></th>
									<th colspan="3"><span>06</span></th>
									<th colspan="3"><span>07</span></th>
									<th colspan="3"><span>08</span></th>
									<th colspan="3"><span>09</span></th>
									<th colspan="3"><span>10</span></th>
									<th colspan="3"><span>11</span></th>
									<th colspan="3"><span>12</span></th>
									<th colspan="3"><span>13</span></th>
									<th colspan="3"><span>14</span></th>
									<th colspan="3"><span>15</span></th>
									<th colspan="3"><span>16</span></th>
									<th colspan="3"><span>17</span></th>
									<th colspan="3"><span>18</span></th>
									<th colspan="3"><span>19</span></th>
									<th colspan="3"><span>20</span></th>
									<th colspan="3"><span>21</span></th>
									<th colspan="3"><span>22</span></th>
									<th colspan="3"><span>23</span></th>
									<th colspan="3"><span>24</span></th>
									<th colspan="3"><span>25</span></th>
									<th colspan="3"><span>26</span></th>
									<th colspan="3"><span>27</span></th>
									<th colspan="3"><span>28</span></th>
									<th colspan="3"><span>29</span></th>
									<th colspan="3"><span>30</span></th>
									<th colspan="3"><span>31</span></th>
								</tr>
								<tr class="col span=2">
									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>

									<th>Break</th>
									<th>Lunch</th>
									<th>Dinner</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td rowspan="3">1</td>
									<td rowspan="3">Student Name</td>
									<td colspan="3"><span>--</span></td>
									<td colspan="3"><span>--</span></td>
									<td colspan="3"><span>--</span></td>
									<td colspan="3"><span>--</span></td>
									<td colspan="3"><span>--</span></td>
									<td colspan="3"><span>--</span></td>
								<tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
	<!-- Attendance_Report End -->