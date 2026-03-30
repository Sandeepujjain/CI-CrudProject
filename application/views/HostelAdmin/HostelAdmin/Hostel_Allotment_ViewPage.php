<div class="modal-body" id="printableArea">
    <div class="container">
        <div class="row">
			<div class="row col-md-6 border m-0 mb-3 py-3 px-0 rounded-2">
				<div class="col-md-12">
					<h5>Student Details</h5>
				</div>
				<div class="col-md-6 mb-2">
					<label for="" class="form-label">Student Name</label>
					<input class="form-control" readonly type="text" value="<?= ($data['allot_studentname']) ?>" name="">
				</div>
				<div class="col-md-6 mb-2">
					<label for="" class="form-label">Class</label>
					<input class="form-control" readonly type="text" value="<?= ($data['classlist_name']) ?>" name="">
				</div>
				<div class="col-md-6 mb-2">
					<label for="" class="form-label">Father's Name</label>
					<input class="form-control" readonly type="text" value="<?= ($data['stu_fathername']) ?>" name="">
				</div>
				<div class="col-md-6 mb-2">
					<label for="" class="form-label">Hostel Join Date</label>
					<input class="form-control" type="date" value="<?= ($data['hostel_admission_date']) ?>" name="HostelAdmissionDate">
				</div>
			</div>
			<div class="row col-md-6 border m-0 mb-3 py-3 px-0 rounded-2">
				<div class="col-md-12">
					<h5>Contact Details</h5>
				</div>
				<div class="col-md-6 mb-2">
					<label for="" class="form-label">Email ID</label>
					<input class="form-control" readonly type="email" value="<?= ($data['stu_fatheremail']) ?>" name="">
				</div>
				<div class="col-md-6 mb-2">
					<label for="" class="form-label">Mobile Number</label>
					<input class="form-control" readonly type="text" value="<?= ($data['stu_fathermobile']) ?>" name="">
				</div>
				<div class="col-md-12 mb-2">
					<label for="" class="form-label">Address</label>
					<input class="form-control" readonly type="text" value="<?= ($data['present_streetno']) ?>" name="">
				</div>
			</div>
			<div class="row col-12 border m-0 mb-3 py-3 px-0 rounded-2">
				<div class="col-md-12">
					<h5>Hostel Allot Details</h5>
				</div>
				<div class="col-md-4 mb-2">
					<label for="" class="form-label">Hostel Name</label>
					<input class="form-control" readonly type="text" value="<?= ($data['hostel_name']) ?>" name="">
				</div>
				<div class="col-md-4 mb-2">
					<label for="" class="form-label">Floor No.</label>
					<input class="form-control" readonly type="text" value="<?= ($data['hostel_floor_name']) ?>" name="">
				</div>
				<div class="col-md-4 mb-2">
					<label for="" class="form-label">Room No.</label>
					<input class="form-control" readonly type="text" value="<?= ($data['hostel_room_name']) ?>" name="">
				</div>
			</div>
        </div>
        <div class="row">
            <div class="col text-center">
                <button type="button" class="btn schl-btn-green" onclick="printContent()">
                    <img width="35" height="35" src="https://img.icons8.com/clouds/100/print.png" alt="print" /> <b>PRINT</b>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function printContent() {
        var printWindow = window.open('', '', 'height=800,width=600');
        var printContent = document.getElementById('printableArea').innerHTML;

        // Add a basic CSS reset and any other custom styles
        var css = `
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .row {
            margin-bottom: 15px;
        }
        .border-bottom {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .text-center {
            text-align: center;
        }
        h4, h5 {
            margin: 10px 0;
        }
        input.form-control {
            border: 1px solid #ccc;
            padding: 8px;
            width: 100%;
        }
    `;

        printWindow.document.write('<html><head><title>Print</title>');
        printWindow.document.write('<style>' + css + '</style>');
        // Add external CSS if needed
        // printWindow.document.write('<link rel="stylesheet" type="text/css" href="path/to/your/styles.css">');
        printWindow.document.write('</head><body >');
        printWindow.document.write(printContent);
        printWindow.document.write('</body></html>');

        printWindow.document.close(); // Necessary for IE >= 10
        printWindow.focus(); // Necessary for IE >= 10

        printWindow.print();
    }
</script>