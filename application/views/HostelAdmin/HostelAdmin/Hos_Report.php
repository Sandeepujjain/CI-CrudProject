<script src="https://cdn.tailwindcss.com"></script>

<!-- Fee Report STart  -->
<div class="content_wrapper">
	<div class="myDiv" id="Hos_Report">
		<div class="row py-3">
			<!-- Left Column: Monthly Chart (col-8) -->
			<div class="col-md-8">
				<div class="bg-white rounded-lg p-3 my-3">
					<div class="d-flex justify-between pb-3 mb-2 border-bottom border-gray-200">
						<div class="d-flex align-items-center">
							<h5 class="leading-none text-xl font-bold text-gray-900 pb-1">
								MonthWise Hostel Finance Report
							</h5>
						</div>
					</div>
					<div>
						<div id="Monthly_Report"></div>
					</div>
				</div>


			</div>

			<!-- Right Column: Annual Chart (col-4) -->
			<div class="col-md-4">
				<div class="bg-white rounded-lg p-3 my-3">
					<div class="d-flex justify-between pb-3 mb-2 border-bottom border-gray-200">
						<div class="d-flex align-items-center">
							<h5 class="leading-none text-xl font-bold text-gray-900 pb-1">
								Annual Hostel Fee Collection Report
							</h5>
						</div>
					</div>
					<div>
						<div id="hostel_colletion_chart"></div>
					</div>
				</div>


			</div>
		</div>
		<div class="row py-3">
			<!--room table-->
			<section>
				<h5 class="leading-none text-xl font-bold text-gray-900 mb-2 pb-1">
					Room Details
				</h5>

				<div class="card-body p-0">
					<table class="table table-responsive table-striped table-hover table-sm school-table-1" id="">
						<thead>
							<tr>
								<th>S.NO.</th>
								<th>Hostel Name</th>
								<th>Floor Name</th>
								<th>Total Room</th>
								<th>Total Alloted Room</th>
								<th>Total Unallotted Room</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td> 1</td>
								<td>Shivaji</td>
								<td>first </td>
								<td>20</td>
								<td>15</td>
								<td>5</td>
							</tr>
							<tr>
								<td> 2</td>
								<td>Shivaji</td>
								<td>Second </td>
								<td>18</td>
								<td>10</td>
								<td>8</td>
							</tr>
						</tbody>

					</table>
				</div>
			</section>


			<!--financial year table-->
			<section>
				<h5 class="leading-none text-xl font-bold text-gray-900 mb-2 pb-1">
					Financial Year Details
				</h5>
				<div class="card-body p-0">
					<table class="table table-responsive table-striped table-hover table-sm school-table-1" id="">
						<thead>
							<tr>
								<th>S.NO.</th>
								<th>Hostel Name</th>
								<th>Floor Name</th>
								<th>Room No</th>
								<th>Student Name</th>
								<th>Phone No</th>
								<th>Total Amount</th>
								<th>Payed Amount</th>
								<th>Pending Amount</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td> 1</td>
								<td>Shivaji</td>
								<td>first </td>
								<td>101</td>
								<td>Reyansh Malhotra</td>
								<td>9876543210</td>
								<td>10000</td>
								<td>8000</td>
								<td>2000</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Shivaji</td>
								<td>first </td>
								<td>102</td>
								<td>Kabir Gupta</td>
								<td>9876611010</td>
								<td>8000</td>
								<td>8000</td>
								<td>0</td>
							</tr>
						</tbody>

					</table>
				</div>
			</section>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
	var options = {
		series: [{
			name: 'Amount',
			data: [2000, 3100, 4200, 1000, 5500, 300, 3800, 2100, 4400, 100, 600, 1600] // values as numbers
		}],
		chart: {
			height: 350,
			type: 'bar',
		},
		colors: ["#FFC300"],
		plotOptions: {
			bar: {
				borderRadius: 10,
				dataLabels: {
					position: 'top',
				},
			}
		},
		dataLabels: {
			enabled: true,
			formatter: function(val) {
				return (val >= 1000) ? (val / 1000).toFixed(1).replace('.0', '') + 'k' : val;
			},
			offsetY: -20,
			style: {
				fontSize: '12px',
				colors: ["#304758"]
			}
		},
		xaxis: {
			categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			position: 'top',
			axisBorder: {
				show: false
			},
			axisTicks: {
				show: false
			},
			crosshairs: {
				fill: {
					type: 'gradient',
					gradient: {
						colorFrom: '#D8E3F0',
						colorTo: '#BED1E6',
						stops: [0, 100],
						opacityFrom: 0.4,
						opacityTo: 0.5,
					}
				}
			},
			tooltip: {
				enabled: true,
			}
		},
		yaxis: {
			labels: {
				show: true,
				formatter: function(val) {
					return val.toLocaleString(); // adds commas like 4,000
				},
				style: {
					colors: '#777',
					fontSize: '12px'
				}
			},
			axisBorder: {
				show: false
			},
			axisTicks: {
				show: false
			}
		},
		title: {
			text: 'Hostel Finance Report',
			floating: true,
			offsetY: 330,
			align: 'center',
			style: {
				color: '#444'
			}
		}
	};

	var chart = new ApexCharts(document.querySelector("#Monthly_Report"), options);
	chart.render();
</script>

<script>
	var options = {
		series: [44, 55],
		colors: ['#139d03', '#ff4233'],
		chart: {
			width: 400,
			type: 'pie',
		},
		labels: ['Payed Amount', 'Pending Amount'],
		legend: {
			position: 'bottom'
		},
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					width: 200
				}

			}
		}]
	};

	var chart = new ApexCharts(document.querySelector("#hostel_colletion_chart"), options);
	chart.render();
</script>