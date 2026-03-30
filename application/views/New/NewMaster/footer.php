<!-- marquee notification tag -->
<!-- Marquee container show olny SuperAdmin , HR Admin , Account Admin [1,4,13] -->
<!-- <#?php
$userRole = $this->session->userdata('emp_data_session')['emp_role'];
$userRolesArray = explode(',', $userRole);
if (checkRoles([1, 4, 13], $userRolesArray)) { ?>

	<div class="container <#?= (isset($_SESSION['emp_data_session']['notice_period_message']) && !empty($_SESSION['emp_data_session']['notice_period_message'])) ? "" : "d-none" ?>">

		<div class="marquee-container">
			<div class="marquee-text">
				<#?= @$_SESSION['emp_data_session']['notice_period_message'] ?? "" ?>
			</div>
		</div>
	</div>
<#?php } ?> -->
<!-- chat button -->
<a href="<?= base_url('ChatController/employee_chat_page') ?>" class="btn  chat_btn" target="_blank">
	<img src="<?php echo base_url('assets/images/chat-bot.gif'); ?>" alt="Live Chat" width="40" height="40">
</a>
<button id="backBtn" onclick="goBack()">← Back</button>
<style>
	#backBtn {
		position: fixed;
		bottom: 10px;
		right: 15px;
		background-color: #0faa7e;
		color: #fff;
		padding: 5px 12px;
		border-radius: 6px;
		z-index: 999;
	}
</style>
<!-- Load common header JS variable for PDF/Print -->

</div>

</section>
</main>

<!-- main js -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
	function goBack() {
		if (window.history.length > 1) {
			window.history.back();
		} else {
			// Optional: navigate to a fallback route
			window.location.href = '/dashboard'; // adjust based on your app
		}
	}
</script>

<script>
	window.addEventListener('DOMContentLoaded', () => {
		const backBtn = document.getElementById('backBtn');
		if (window.history.length <= 1) {
			backBtn.style.display = 'none';
		}
	});
</script>


<!-- call all js files here -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
	crossorigin="anonymous"></script>

<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<!-- data table button js links -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>

<!-- JSZip (required for CSV and Excel export buttons) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- pdfmake (required for PDF export button) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>


<!--jquery validation js file-->

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>


<!-- selectize Library CDN Links start aakash -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
	integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
	integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
	crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- selectize Library CDN Links end -->

<!-- Select2 Library CDN Links start -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
	integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
	crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
	integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Select2 Library CDN Links end -->

<!---aakash start --->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gator/1.2.4/gator.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<!---aakash End --->

<!---aakash start --->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" type="text/css"
	href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<!---aakash End --->

<!-- 12 link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- chart line and bar js 14-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

<!-- 35 -->
<link href="https://unpkg.com/singledivui/dist/singledivui.min.css" rel="stylesheet" />
<script src="https://unpkg.com/singledivui/dist/singledivui.min.js"></script>
<!-- Import Data  -->
<script src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"></script>






<!---aakash End --->

<!-- Tabulator link and JS file , buttons file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<?php $this->load->view('common_header_inject'); ?>
<script src="<?php echo base_url('assets/js/common.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/masterAdmin.js'); ?>"></script>
<?php echo $this->load->view('NewMaster/FirebaseMessagingNotification', null, true); ?>



<!-- <script src="<#?php echo base_url('assets/js/ckeditor.js'); ?>"></script> -->




<!-- //aakash start  -->
<!-- <script src="<php echo base_url('assets/js/hr/hr.js'); ?>"></script> -->
<!-- //aakash end-->
<script>
	<?php if ($this->session->flashdata('success')) { ?>
		toastr.success("<?php echo $this->session->flashdata('success'); ?>");
	<?php } else if ($this->session->flashdata('error')) { ?>
		toastr.error("<?php echo $this->session->flashdata('error'); ?>");
	<?php } else if ($this->session->flashdata('warning')) { ?>
		toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
	<?php } else if ($this->session->flashdata('info')) { ?>
		toastr.info("<?php echo $this->session->flashdata('info'); ?>");
	<?php } ?>
</script>

<!-- tooltip -->
<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>
<!-- end -->



<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Get all the table cells
		var cells = document.querySelectorAll('#normal_datatable td');

		// Loop through each cell
		cells.forEach(function(cell) {
			// Check if the cell is empty
			if (cell.innerHTML.trim() === '') {
				// If empty, set the content to '--'
				cell.innerHTML = '--';
			}
		});
	});
</script>

<!-- radio checked after reload js active -->
<script>
	document.addEventListener("DOMContentLoaded", function() {
		const radioGroups = document.querySelectorAll('input[type="radio"]');

		radioGroups.forEach(radioButton => {
			radioButton.addEventListener("click", function() {
				const groupName = this.getAttribute("name");
				// Store the selected value in local storage using group name as a key
				localStorage.setItem(groupName, this.value);
			});

			const groupName = radioButton.getAttribute("name");
			// Check if a value was previously selected for this group
			const storedValue = localStorage.getItem(groupName);
			if (storedValue === radioButton.value) {
				radioButton.checked = true;
			}
		});
	});
</script>
<!-- end -->
<!-- for menu collapse outside click close menu collapse -->
<script>
	$(document).click(function(e) {
		if (!$(e.target).is('.menu-body')) {
			$('.sidebar_menus').collapse('hide');
		}
	});
</script>
<!-- end -->


<!-- sidebar push menu js for tab view -->
<!-- Sidebar Bar Push Menu -->
<script type="text/javascript">
	$(document).ready(function() {

		$('#dismiss, .Side_overlay').on('click', function() {
			$('#sidebar').removeClass('active');
			$('.Side_overlay').fadeOut();
		});

		$('#sidebarCollapse').on('click', function() {
			$('#sidebar').addClass('active');
			$('.Side_overlay').fadeIn();
			$('.collapse.in').toggleClass('in');
			$('a[aria-expanded=true]').attr('aria-expanded', 'false');
		});
	});
</script>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Get all the table cells
		var cells = document.querySelectorAll('.sample td');

		// Loop through each cell
		cells.forEach(function(cell) {
			// Check if the cell is empty
			if (cell.innerHTML.trim() === '') {
				// If empty, set the content to '--'
				cell.innerHTML = '--';
			}
		});
	});
</script>


<!-- data table -->
<script>
	$(document).ready(function() {
		var table = $('.school-table').DataTable({
			'order': [], // Initial sorting disabled
			'columnDefs': [{
				'targets': 0,
				'orderable': false, // Sorting disabled on the checkbox column
			}],
			'lengthMenu': [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, 'All']
			], // Add 'All' option to the pagination dropdown
			'dom': 'Bflrtip', // Add this to include buttons in the DOM
			'buttons': getInlineTableExportButtons()

			// 'buttons': [
			// 	'copy', 'excel', 'pdf', 'print', 'colvis'
			// ]
		});

		$("form").each(function() {
			const $form = $(this);

			// Fetch dynamic rules and messages using data attributes
			const rulesVarName = $form.data("rules");
			const messagesVarName = $form.data("messages");

			const formRules = window[rulesVarName] || {};
			const formMessages = window[messagesVarName] || {};

			$form.validate({
				errorPlacement: function(error, element) {
					// Check for ID or fallback to name attribute
					const identifier = element.attr("id") || element.attr("name");
					if (!identifier) {
						console.warn("Neither ID nor name is available for the element:", element);
						error.insertAfter(element); // Fallback
						return;
					}

					// Construct the error span ID dynamically within the current form
					const $errorSpan = $form.find(`#${identifier}-error`);

					if ($errorSpan.length) {
						$errorSpan.html(error.text()).show(); // Show error within the current form
					} else {
						error.insertAfter(element); // Fallback if error span is not found
					}
				},
				success: function(label, element) {
					// Check for ID or fallback to name attribute
					const identifier = $(element).attr("id") || $(element).attr("name");
					if (!identifier) {
						console.warn("Neither ID nor name is available for the element:", element);
						return;
					}

					// Clear error messages specific to the current form
					const $errorSpan = $form.find(`#${identifier}-error`);
					if ($errorSpan.length) {
						$errorSpan.html("").hide();
					}
				},
				rules: formRules, // Apply rules dynamically
				messages: formMessages, // Apply messages dynamically
			});
		});



	});
</script>

<!-- end -->

</body>

</html>