//New School Setup Validation
$(document).ready(function () {
	$("#assignModuleForm").validate({
		rules: {
			schoolid: {
				required: true,
				remote: {
					url: base_url + "PageController/schoolCheckInAssignModule", // Replace with your server-side script
					type: "POST",
					data: {
						schoolid: function () {
							return $("#schoolid").val();
						},
					},
				},
			},
			module_list: {
				required: true,
			},
		},
		messages: {
			schoolid: {
				required: "This Field is required.",
				remote: "In this school, the modules are already assigned.",
			},
			module_list: {
				required: "This Field is required.",
			},
		},
		errorClass: "error-message", // Set the CSS class for error messages
		errorElement: "div", // Wrap the error message in a <div> element
	});
});

//Role Master Setup Validation
$(document).ready(function () {
	$("#assignRoleForm").validate({
		rules: {
			selected_employee: {
				required: true,
				remote: {
					url: base_url + "PageController/employeeCheckInRoleMaster", // Replace with your server-side script
					type: "POST",
					data: {
						selected_employee: function () {
							return $("#selected_employee").val();
						},
					},
				},
			},
		},
		messages: {
			selected_employee: {
				required: "This Field is required.",
				remote: "This employee already has a role assigned.",
			},
		},
		errorClass: "error-message", // Set the CSS class for error messages
		errorElement: "div", // Wrap the error message in a <div> element
	});

	$("#updateRoleForm").validate({
		rules: {
			edit_selected_employee: {
				required: true,
			},
			edit_selected_schools: {
				required: true,
			},
			edit_modle_list: {
				required: true,
			},
		},
		messages: {
			edit_selected_employee: {
				required: "This Field is required.",
			},
		},
		errorClass: "error-message", // Set the CSS class for error messages
		errorElement: "div", // Wrap the error message in a <div> element
	});
});

//Hr Setup Validation
$(document).ready(function () {
	//Job Description Validation
	$("#jobDescriptionForm").validate({
		rules: {
			job_desc_designation_id: {
				required: true,
			},
			job_desc_paygrades_id: {
				required: true,
			},
			eligibility_criteria: {
				required: true,
			},
			job_description_name: {
				required: true,
			},
		},
		messages: {
			job_desc_designation_id: {
				required: "This Field is required.",
			},
		},
		errorClass: "error-message", // Set the CSS class for error messages
		errorElement: "div", // Wrap the error message in a <div> element
	});

	$("#updateJobDescriptionForm").validate({
		rules: {
			Edit_jobdescdesignationid: {
				required: true,
			},
			editPaygrade: {
				required: true,
			},
			editCriteria: {
				required: true,
			},
			Edit_jobdescriptionname: {
				required: true,
			},
		},
		messages: {
			Edit_jobdescdesignationid: {
				required: "This Field is required.",
			},
		},
		errorClass: "error-message", // Set the CSS class for error messages
		errorElement: "div", // Wrap the error message in a <div> element
	});

	//LeaveType Validation
	$("#LeaveTypeForm").validate({
		rules: {
			leave_name: {
				required: true,
				validName: true,
				remote: {
					url: base_url + "PageController/leaveTypeCheck",
					type: "POST",
					data: {
						leave_name: function () {
							return $("#leave_name").val();
						},
					},
				},
			},
			leave_shortname: {
				required: true,
				validName: true,
			},
		},
		messages: {
			leave_name: {
				required: "This Field is required.",
				validName: "Invalid format",
				remote: "This value already exists.",
			},
			leave_shortname: {
				required: "This Field is required.",
				validName: "Invalid format",
			},
		},
		errorClass: "error-message",
		errorElement: "div",
	});

	$("#updateLeaveTypeForm").validate({
		rules: {
			Edit_leavename: {
				required: true,
				validName: true,
				remote: {
					url: base_url + "PageController/leaveTypeCheck",
					type: "POST",
					data: {
						leave_name: function () {
							return $("#Edit_leavename").val();
						},
					},
				},
			},
			Edit_leaveshortname: {
				required: true,
				validName: true,
			},
		},
		messages: {
			Edit_leavename: {
				required: "This Field is required.",
				validName: "Invalid format",
				remote: "This value already exists.",
			},
			Edit_leaveshortname: {
				required: "This Field is required.",
				validName: "Invalid format",
			},
		},
		errorClass: "error-message",
		errorElement: "div",
	});

	$.validator.addMethod(
		"validName",
		function (value, element) {
			return this.optional(element) || /^[a-zA-Z\s.,'()\-]+$/.test(value);
		},
		"Invalid format",
	);

	//Holiday Validation
	$("#HolidayForm").validate({
		rules: {
			holiday_acdemicyearid: {
				required: true,
			},
			holidayname: {
				required: true,
				pattern: "^[a-zA-Z .,'()'-]+$",
			},

			holiday_date: {
				required: true,
			},
			holiday_daysname: {
				required: true,
			},
		},
		messages: {
			holiday_acdemicyearid: {
				required: "This Field is required.",
			},

			holidayname: {
				required: "This Field is required.",
				pattern: "Invalid format",
			},
		},
		errorClass: "error-message", // Set the CSS class for error messages
		errorElement: "div", // Wrap the error message in a <div> element
	});

	$("#updateHolidayForm").validate({
		rules: {
			Edit_holidaysname: {
				required: true,
				pattern: "^[a-zA-Zs.,'()'-]+$",
			},
			Edit_holidaydate: {
				required: true,
			},
			Edit_holidaydays: {
				required: true,
			},
		},
		messages: {
			Edit_holidaysname: {
				required: "This Field is required.",
				pattern: "Invalid format",
			},
		},
		errorClass: "error-message", // Set the CSS class for error messages
		errorElement: "div", // Wrap the error message in a <div> element
	});

	//PayGrade Validation
	$("#PaygradeForm").validate({
		rules: {
			pay_grades_name: {
				required: true,
				pattern: "^[a-zA-Z .,'()'-]+$",
				remote: {
					url: base_url + "PageController/PayGradeCheck", // Replace with your server-side script
					type: "POST",
					data: {
						pay_grades_name: function () {
							return $("#pay_grades_name").val();
						},
					},
				},
			},
			grade_range_from: {
				required: true,
			},
			grade_range_to: {
				required: true,
			},
		},
		messages: {
			pay_grades_name: {
				required: "This Field is required.",
				pattern: "Invalid format",
				remote: "This value already exists.",
			},
		},
		errorClass: "error-message", // Set the CSS class for error messages
		errorElement: "div", // Wrap the error message in a <div> element
	});

	$("#updatePayGradeForm").validate({
		rules: {
			Edit_paygradename: {
				required: true,
				pattern: "^[a-zA-Zs.,'()'-]+$",
				remote: {
					url: base_url + "PageController/PayGradeCheck", // Replace with your server-side script
					type: "POST",
					data: {
						pay_grades_name: function () {
							return $("#Edit_paygradename").val();
						},
					},
				},
			},
			Edit_paygraderangefrom: {
				required: true,
			},
			Edit_paygraderangeto: {
				required: true,
			},
		},
		messages: {
			Edit_paygradename: {
				required: "This Field is required.",
				pattern: "Invalid format",
				remote: "This value already exists.",
			},
		},
		errorClass: "error-message", // Set the CSS class for error messages
		errorElement: "div", // Wrap the error message in a <div> element
	});
});

//Purchase Setup Validation
$(document).ready(function () {
	$("#vendorForm").validate({
		rules: {
			owner_contact: {
				required: true,
				remote: {
					url: base_url + "PageController/vendorMobileCheck", // Replace with your server-side script
					type: "POST",
					data: {
						owner_contact: function () {
							return $("#owner_contact").val();
						},
					},
				},
				pattern: /^[0-9]+$/,
				minlength: 10, // Minimum length of 10 characters
				maxlength: 10, // Maximum length of 10 characters
			},
			business_name: {
				required: true,
				pattern: /^[a-zA-Z\s]+$/,
			},
			business_owner_name: {
				required: true,
				pattern: /^[a-zA-Z\s]+$/,
			},
			manager_name: {
				required: true,
				pattern: /^[a-zA-Z\s]+$/,
			},
			manager_contact: {
				required: true,
				pattern: /^[0-9]+$/,
				minlength: 10,
				maxlength: 10,
			},

			vendor_acc_holder_name: {
				required: true,
				pattern: /^[a-zA-Z\s]+$/,
			},
			vendor_bank_name: {
				required: true,
				pattern: /^[a-zA-Z\s]+$/,
			},
			vendor_account_no: {
				required: true,
				pattern: /^[0-9]+$/,
			},
			vendor_ifsc_no: {
				required: true,
				pattern: /^[A-Z0-9]{11}$/, // Only uppercase letters and numbers, exactly 11 characters
				maxlength: 11,
				minlength: 11,
			},

			vendor_gstn_no: {
				required: true,
				pattern: /^[A-Z0-9]{15}$/, // Only uppercase letters and digits, exactly 15 characters
				maxlength: 15,
				minlength: 15,
			},
		},
		messages: {
			owner_contact: {
				required: "This Field is required.",
				remote: "Mobile already registered",
				pattern: "Only Numbers allowed.",
				minlength: "Mobile number must be exactly 10 digits.",
				maxlength: "Mobile number must be exactly 10 digits.",
			},
			business_name: {
				required: "This Field is required.",
				pattern: "Only letters and spaces are allowed.",
			},
			business_owner_name: {
				required: "This Field is required.",
				pattern: "Only letters and spaces are allowed.",
			},
			manager_name: {
				required: "This Field is required.",
				pattern: "Only letters and spaces are allowed.",
			},
			manager_contact: {
				required: "This Field is required.",
				pattern: "Only Numbers allowed.",
				minlength: "Mobile number must be exactly 10 digits.",
				maxlength: "Mobile number must be exactly 10 digits.",
			},
			vendor_acc_holder_name: {
				required: "This Field is required.",
				pattern: "Only letters and spaces are allowed.",
			},
			vendor_bank_name: {
				required: "This Field is required.",
				pattern: "Only letters and spaces are allowed.",
			},
			vendor_account_no: {
				required: "This Field is required.",
				pattern: "Only Numbers allowed.",
			},
			vendor_ifsc_no: {
				required: "IFSC code is required.",
				pattern:
					"IFSC code must be exactly 11 characters, uppercase letters and numbers only.",
				maxlength: "IFSC code must be exactly 11 characters.",
				minlength: "IFSC code must be exactly 11 characters.",
			},
			vendor_gstn_no: {
				required: "This Field is required.",
				pattern: "Alphabetic characters with numbers allowed",
				maxlength: "IFSC code must be exactly 15 characters.",
				minlength: "IFSC code must be exactly 15 characters.",
			},
		},
		errorClass: "error-message", // Set the CSS class for error messages
		errorElement: "div", // Wrap the error message in a <div> element
	});

	$("#updateVendorForm").validate({
		rules: {
			Edit_ownercontact: {
				required: true,
				remote: {
					url: base_url + "PageController/vendorMobileCheck", // Replace with your server-side script
					type: "POST",
					data: {
						owner_contact: function () {
							return $("#Edit_ownercontact").val();
						},
					},
				},
				pattern: /^[0-9]+$/,
				minlength: 10, // Minimum length of 10 characters
				maxlength: 10, // Maximum length of 10 characters
			},
			Edit_businessname: {
				required: true,
				pattern: /^[a-zA-Z\s]+$/,
			},
			Edit_businessownername: {
				required: true,
				pattern: /^[a-zA-Z\s]+$/,
			},
			Edit_managername: {
				required: true,
				pattern: /^[a-zA-Z\s]+$/,
			},
			Edit_managercontact: {
				required: true,
				pattern: /^[0-9]+$/,
				minlength: 10,
				maxlength: 10,
			},
			Edit_vendoraccholdername: {
				required: true,
				pattern: /^[a-zA-Z\s]+$/,
			},
			Edit_vendorbankname: {
				required: true,
				pattern: /^[a-zA-Z\s]+$/,
			},
			Edit_vendoraccountno: {
				required: true,
				pattern: /^[0-9]+$/,
			},
			Edit_vendorifscno: {
				required: true,
				pattern: /^[a-zA-Z0-9]+$/,
			},
			Edit_vendorgstnno: {
				required: true,
				pattern: /^[a-zA-Z0-9]+$/,
			},
		},
		messages: {
			Edit_ownercontact: {
				required: "This Field is required.",
				remote: "Mobile already registered",
				pattern: "Only Numbers allowed.",
				minlength: "Mobile number must be exactly 10 digits.",
				maxlength: "Mobile number must be exactly 10 digits.",
			},
			Edit_businessname: {
				required: "This Field is required.",
				pattern: "Only letters and spaces are allowed.",
			},
			Edit_businessownername: {
				required: "This Field is required.",
				pattern: "Only letters and spaces are allowed.",
			},
			Edit_managername: {
				required: "This Field is required.",
				pattern: "Only letters and spaces are allowed.",
			},
			Edit_managercontact: {
				required: "This Field is required.",
				pattern: "Only Numbers allowed.",
				minlength: "Mobile number must be exactly 10 digits.",
				maxlength: "Mobile number must be exactly 10 digits.",
			},
			Edit_vendoraccholdername: {
				required: "This Field is required.",
				pattern: "Only letters and spaces are allowed.",
			},
			Edit_vendorbankname: {
				required: "This Field is required.",
				pattern: "Only letters and spaces are allowed.",
			},
			Edit_vendoraccountno: {
				required: "This Field is required.",
				pattern: "Only Numbers allowed.",
			},
			Edit_vendorifscno: {
				required: "This Field is required.",
				pattern: "Alphabetic characters with numbers allowed",
			},
			Edit_vendorgstnno: {
				required: "This Field is required.",
				pattern: "Alphabetic characters with numbers allowed",
			},
		},
		errorClass: "error-message", // Set the CSS class for error messages
		errorElement: "div", // Wrap the error message in a <div> element
	});

	$("#itemMasterForm").validate({
		rules: {
			item_code: {
				required: true,
			},
			item_name: {
				required: true,
			},
			item_type: {
				required: true,
			},
			item_unit: {
				required: true,
			},
			item_category: {
				required: true,
			},
			item_subcategory: {
				required: true,
			},
		},
		messages: {
			item_code: {
				required: "This Field is required.",
			},
			item_name: {
				required: "This Field is required.",
			},
			item_type: {
				required: "This Field is required.",
			},
			item_unit: {
				required: "This Field is required.",
			},
			item_category: {
				required: "This Field is required.",
			},
			item_subcategory: {
				required: "This Field is required.",
			},
		},
		errorClass: "error-message", // Set the CSS class for error messages
		errorElement: "div", // Wrap the error message in a <div> element
	});
});

//Account Setup Validation

$(document).ready(function () {
	$("#ledgerForm").validate({
		rules: {
			ledgerSchool: {
				required: true,
			},
			ledger_name: {
				required: true,
			},
			ledger_type: {
				required: true,
			},
			under_group: {
				required: true,
			},
		},
		messages: {
			emp_type: {
				required: "This Field is required.",
				remote: "This value already exists.",
			},
		},
		errorClass: "error-message", // Set the CSS class for error messages
		errorElement: "div", // Wrap the error message in a <div> element
	});

	$("#FeesStructureFormID").validate({
		rules: {
			ledgerSchool: {
				required: true,
			},
			feesClassId: {
				required: true,
			},
			feesAcadmicYear: {
				required: true,
			},
			feesHead: {
				required: true,
			},
			structureName: {
				required: true,
			},
		},
		messages: {
			fee_type_name: {
				required: "This Field is required.",
				remote: "This value already exists.",
			},
		},
		errorClass: "error-message", // Set the CSS class for error messages
		errorElement: "div", // Wrap the error message in a <div> element
	});
});

/**
 * Function to insert data after validation and confirmation.
 * @param {string} formId - The ID of the form to be submitted.
 * @param {string} confirmMessage - The confirmation message to display.
 * @param {string} routeUrl - The URL where the data should be submitted.
 */

function insertValidationForm(formId, confirmMessage, routeUrl) {
	var formData = $("#" + formId).serialize();

	if ($("#" + formId).valid()) {
		// Form is valid, submit it
		Swal.fire({
			title: "Confirm Data Insertion",
			html: confirmMessage,
			icon: "question",
			showCancelButton: true,
			confirmButtonText: "Insert",
			confirmButtonColor: "#0faa7e",
			cancelButtonText: "Cancel",
			cancelButtonColor: "#d33",
			customClass: {
				popup: "rounded-border",
				content: "small-text",
			},
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "POST",
					url: base_url + routeUrl,
					data: formData,
					success: function (response) {
						var data = JSON.parse(response);
						if (data.success) {
							Swal.fire({
								text: data.message,
								icon: "success",
								showConfirmButton: false,
								timer: 500,
								customClass: {
									popup: "rounded-border",
									content: "small-text",
								},
							}).then(() => {
								location.reload();
							});
						} else {
							Swal.fire({
								text: data.message,
								icon: "error",
								showConfirmButton: false,
								timer: 500,
								customClass: {
									popup: "rounded-border",
									content: "small-text",
								},
							}).then(() => {
								location.reload();
							});
						}
					},
					error: function (error) {
						Swal.fire({
							text: "An error occurred during the request.",
							icon: "error",
							showConfirmButton: false,
							timer: 500,
							customClass: {
								popup: "rounded-border",
								content: "small-text",
							},
						});
						location.reload();
					},
				});
			}
		});
	}
}

/**
 * Function to Update data after validation and confirmation.
 * @param {string} formId - The ID of the form to be submitted.
 * @param {string} confirmMessage - The confirmation message to display.
 * @param {string} routeUrl - The URL where the data should be submitted.
 */

function UpdateValidationForm(formId, confirmMessage, routeUrl) {
	var formData = $("#" + formId).serialize();

	if ($("#" + formId).valid()) {
		// Form is valid, submit it
		Swal.fire({
			title: "Confirm Data Update",
			html: confirmMessage,
			icon: "question",
			showCancelButton: true,
			confirmButtonText: "Update",
			confirmButtonColor: "#0faa7e",
			cancelButtonText: "Cancel",
			cancelButtonColor: "#d33",
			customClass: {
				popup: "rounded-border",
				content: "small-text",
			},
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "POST",
					url: base_url + routeUrl,
					data: formData,
					success: function (response) {
						var data = JSON.parse(response);
						if (data.success) {
							Swal.fire({
								text: data.message,
								icon: "success",
								showConfirmButton: false,
								timer: 500,
								customClass: {
									popup: "rounded-border",
									content: "small-text",
								},
							}).then(() => {
								location.reload();
							});
						} else {
							Swal.fire({
								text: data.message,
								icon: "error",
								showConfirmButton: false,
								timer: 500,
								customClass: {
									popup: "rounded-border",
									content: "small-text",
								},
							}).then(() => {
								location.reload();
							});
						}
					},
					error: function (error) {
						Swal.fire({
							text: "An error occurred during the request.",
							icon: "error",
							showConfirmButton: false,
							timer: 500,
							customClass: {
								popup: "rounded-border",
								content: "small-text",
							},
						});
						location.reload();
					},
				});
			}
		});
	}
}

var originalTextMap = {};

function textChangeFunction(category, buttonId) {
	var button = document.getElementById(buttonId);

	if (!originalTextMap[buttonId]) {
		originalTextMap[buttonId] = button.innerHTML;
	}

	if (button.innerHTML === "Please fill the fields to Add " + category) {
		button.innerHTML = originalTextMap[buttonId];
	} else {
		button.innerHTML = "Please fill the fields to Add " + category;
	}
}

function showDeleteConfirmation(name, id, controllerName, functionName) {
	Swal.fire({
		title: "Confirm Deletion",
		text: "Confirm You Want To Delete " + name + " ?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#3085d6",
		confirmButtonText: "Delete",
		cancelButtonText: "Cancel",
		customClass: {
			popup: "rounded-border",
			content: "small-text",
		},
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: base_url + controllerName + "/" + functionName + "/" + id, // Replace with your actual delete endpoint
				type: "DELETE", // Use POST or DELETE depending on your server configuration
				success: function (response) {
					var data = JSON.parse(response);
					if (data.success) {
						// Success case
						Swal.fire({
							text: data.message, // Text of the message
							icon: "success", // Icon for the message
							showConfirmButton: false, // Remove the "OK" button
							timer: 500, // Auto-close the message after 1500ms (1.5 seconds)
							customClass: {
								popup: "rounded-border", // Custom class for the popup
								content: "small-text", // Custom class for the text content
							},
						}).then(() => {
							location.reload(); // not Refresh the page
						});
					} else {
						Swal.fire({
							text: data.message, // Text of the message
							icon: "error", // Icon for the message
							showConfirmButton: false, // Remove the "OK" button
							timer: 500, // Auto-close the message after 1500ms (1.5 seconds)
							customClass: {
								popup: "rounded-border", // Custom class for the popup
								content: "small-text", // Custom class for the text content
							},
						}).then(() => {
							location.reload(); //not  Refresh the page
						});
					}
				},
				error: function () {
					Swal.fire({
						text: "An error occurred during the request.", // Text of the message
						icon: "error", // Icon for the message
						showConfirmButton: false, // Remove the "OK" button
						timer: 500, // Auto-close the message after 1500ms (1.5 seconds)
						customClass: {
							popup: "rounded-border", // Custom class for the popup
							content: "small-text", // Custom class for the text content
						},
					});
					location.reload(); //not  Refresh the page
				},
			});
		}
	});

	return false; // Prevent default link behavior
}

function updateSociety(selectId, inputId) {
	const selectElement = document.getElementById(selectId);
	const societyIdInput = document.getElementById(inputId);

	const selectedOption = selectElement.options[selectElement.selectedIndex];
	const societyId = selectedOption.getAttribute("data-society-id");

	// Set societyId value to the input field
	societyIdInput.value = societyId;
}

/**
 * Get form data as a structured object from a HTML form.
 * @param {string} formId - The ID of the HTML form element.
 * @returns {Object} - The structured form data as an object.
 */
function getFormData(formId) {
	// Initialize an empty object to store the form data
	var formData = {};

	// Get the HTML form element by its ID
	var form = document.getElementById(formId);

	// Serialize the form data into an array of objects
	var formArray = $(form).serializeArray();

	// Loop through the formArray and process each field
	formArray.forEach(function (field) {
		// Get the name and value of the field
		var name = field.name;
		var value = field.value;

		// Remove closing square brackets from the field name
		name = name.replaceAll("]", "");

		// Split the field name into parts using square brackets
		var parts = name.split("[");

		// Remove empty parts
		parts = parts.filter(function (part) {
			return part.trim() !== "";
		});

		// Initialize the current object as formData
		var currentObj = formData;

		// Traverse through the parts to create the nested structure
		parts.forEach(function (part, index) {
			// Check if it's the last part
			if (index === parts.length - 1) {
				// If it's the last part, set the value
				currentObj[part] = value;
			} else {
				// If it's not the last part, initialize an object if it doesn't exist
				currentObj[part] = currentObj[part] || {};
				// Move to the next nested object
				currentObj = currentObj[part];
			}
		});
	});

	// Return the structured form data object
	return formData;
}

function showDeleteDataConfirmation(name, id, controllerName, functionName) {
	Swal.fire({
		title: "Confirm Deletion",
		text: "Confirm You Want To Delete " + name + " ?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#3085d6",
		confirmButtonText: "Delete",
		cancelButtonText: "Cancel",
		customClass: {
			popup: "rounded-border",
			content: "small-text",
		},
	}).then((result) => {
		if (result.isConfirmed) {
			// alert('teena');
			$.ajax({
				url: base_url + controllerName + "/" + functionName + "/" + id, // Replace with your actual delete endpoint
				type: "DELETE", // Use POST or DELETE depending on your server configuration
				success: function (response) {
					var data = JSON.parse(response);
					if (data.success) {
						// Success case

						Swal.fire({
							text: data.message, // Text of the message
							icon: "success", // Icon for the message
							showConfirmButton: false, // Remove the "OK" button
							timer: 3000, // Auto-close the message after 1500ms (1.5 seconds)
							customClass: {
								popup: "rounded-border", // Custom class for the popup
								content: "small-text", // Custom class for the text content
							},
						}).then(() => {
							location.reload();
						});
					} else {
						Swal.fire({
							text: data.message, // Text of the message
							icon: "error", // Icon for the message
							showConfirmButton: false, // Remove the "OK" button
							timer: 3000, // Auto-close the message after 1500ms (1.5 seconds)
							customClass: {
								popup: "rounded-border", // Custom class for the popup
								content: "small-text", // Custom class for the text content
							},
						});
					}
				},
				error: function () {
					Swal.fire({
						text: "An error occurred during the request.", // Text of the message
						icon: "error", // Icon for the message
						showConfirmButton: false, // Remove the "OK" button
						timer: 3000, // Auto-close the message after 1500ms (1.5 seconds)
						customClass: {
							popup: "rounded-border", // Custom class for the popup
							content: "small-text", // Custom class for the text content
						},
					});
					//   customFunction(); //not Refresh the page
				},
			});
		}
	});

	return false; // Prevent default link behavior
}

function showConfirmationDialog(confirmMessage) {
	return Swal.fire({
		title: "Confirm Data Insertion",
		html: confirmMessage,
		icon: "question",
		showCancelButton: true,
		confirmButtonText: "Insert",
		confirmButtonColor: "#0faa7e",
		cancelButtonText: "Cancel",
		cancelButtonColor: "#d33",
		customClass: {
			popup: "rounded-border",
			content: "small-text",
		},
	}).then((result) => {
		return result.isConfirmed;
	});
}

/**
 * Shows a message using SweetAlert2.
 *
 * @param {Boolean} isSuccess - Indicates if the message is a success message.
 * @param {String} message - The message to display.
 * @returns {Promise} - A promise that resolves after showing the alert.
 */
function showAlertMessage(isSuccess, message) {
	return Swal.fire({
		text: message,
		icon: isSuccess ? "success" : "error",
		showConfirmButton: false,
		timer: 3000,
		customClass: {
			popup: "rounded-border",
			content: "small-text",
		},
	});
}

/**
 * Validates a form based on provided validation rules.
 *
 * @param {jQuery} form - The jQuery object representing the form to be validated.
 * @param {Object} rules - An object containing validation rules for the form fields.
 *                          Example:
 *                          {
 *                              field1: { required: true },
 *                              field2: { required: true },
 *                              image_field: {
 *                                  extension: "jpg|jpeg|png|gif|pdf", // Allowed file extensions
 *                                  accept: "image/jpeg, image/png, image/gif,application/pdf" // Accepted MIME types
 *                              }
 *                          }
 * @returns {Boolean} - Returns true if the form is valid, otherwise false.
 *
 * @example
 * const form = $('#getFormData');
 * const rules = {
 *     field1: { required: true },
 *     field2: { required: true },
 *     image_field: {
 *         extension: "jpg|jpeg|png|gif|pdf",
 *         accept: "image/jpeg, image/png, image/gif,application/pdf"
 *     }
 * };
 *
 * if (validateForm(form, rules)) {
 *     // Form is valid, proceed with submission
 * } else {
 *     // Form is invalid, display an error message
 * }
 */
function validateForm(form, rules) {
	form.validate({
		rules: rules,
	});
	return form.valid();
}

/**
 * Performs an AJAX request with the given URL, form data, and request type.
 *
 * @param {String} url - The URL to which the AJAX request is sent.
 *                       Example: 'https://example.com/submitForm'
 * @param {FormData} formData - The FormData object containing the form data to be sent.
 *                              Example:
 *                              const formData = new FormData();
 *                              formData.append('field1', 'value1');
 *                              formData.append('field2', 'value2');
 * @param {String} [type="POST"] - The HTTP method to be used for the request (e.g., "GET", "POST").
 *                                 Default is "POST".
 *                                 Example: 'POST'
 */
function callAjax(url, formData, type = "POST") {
	$.ajax({
		url: url,
		type: type,
		data: formData,
		contentType: false,
		processData: false,
	});
}
/**
 * Function to validate form and submit data via AJAX with optional confirmation.
 *
 * @param {string} formId - The ID of the form to validate and submit.
 * @param {string} function_url - The function_url in the controller to handle the form submission.
 * @param {object} options - The confirmation message to display before form submission. Default is null.
 * options = toastr,swal,successCallback,errorCallback
 */
function CommonAjaxWithValidation(
	confirmTitle,
	successButton,
	formId,
	function_url,
	options = {},
) {
	// Prevent default form submission
	$("#" + formId).on("submit", function (event) {
		event.preventDefault();
	});

	// Check if swal_confirmation_bypass is true
	if (options.swal_confirmation_bypass) {
		performAjaxRequest(); // Skip the confirmation dialog
		return;
	}

	// Show confirmation dialog
	Swal.fire({
		title: confirmTitle,
		icon: "question",
		showCancelButton: true,
		confirmButtonText: successButton,
		confirmButtonColor: "#0faa7e",
		cancelButtonText: "Cancel",
		cancelButtonColor: "#d33",
		customClass: {
			popup: "rounded-border",
			content: "small-text",
		},
	}).then((result) => {
		if (result.isConfirmed) {
			performAjaxRequest(); // Proceed with the AJAX request
		}
	});

	// Function to handle the AJAX request
	function performAjaxRequest() {
		var formData = new FormData($("#" + formId)[0]);
		$.ajax({
			url: function_url,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function (response) {
				if (
					response.ApiResponseStatusCode == 200 ||
					response.ApiResponseStatusCode == 201
				) {
					if (options.swal) {
						Swal.fire({
							text: response.message,
							icon: "success",
							showConfirmButton: false,
							timer: 3000,
							customClass: {
								popup: "rounded-border",
								content: "small-text",
							},
						});
					}
					if (options.toastr) {
						toastr.success(response.message);
					}
					if (options.successCallback) {
						if (typeof options.successCallback == "function") {
							options.successCallback(response);
						}
					}
				} else if (response.ApiResponseStatusCode == 422) {
					$("#" + formId)
						.find(".error-message")
						.addClass("d-block")
						.html("");
					$.each(response.errors, function (key, value) {
						$("#" + formId + " #" + key + "-error").html(value);
					});
					if (options.errorCallback) {
						if (typeof options.errorCallback == "function") {
							options.errorCallback(response);
						}
					}
					if (options.swal) {
						Swal.fire({
							text: response.message,
							icon: "error",
							timer: 3000,
							confirmButtonColor: "#0faa7e",
							customClass: {
								popup: "rounded-border",
								content: "small-text",
							},
						});
					}
					if (options.toastr) {
						toastr.error(response.message);
					}
				} else {
					if (options.swal) {
						Swal.fire({
							text: response.message,
							icon: "error",
							timer: 3000,
							confirmButtonColor: "#0faa7e",
							customClass: {
								popup: "rounded-border",
								content: "small-text",
							},
						});
					}
					if (options.toastr) {
						toastr.error(response.message);
					}
					if (options.errorCallback) {
						if (typeof options.errorCallback == "function") {
							options.errorCallback(response);
						}
					}
				}
			},
			error: function (xhr, status, error) {
				if (options.errorCallback) {
					if (typeof options.errorCallback == "function") {
						options.errorCallback(xhr.responseText);
					}
				}
			},
		});
	}
}

// * @param {object} options - The confirmation message to display before form submission. Default is null.
// * options = toastr,swal,successCallback,errorCallback

function CommonAjaxDelete(name, id, function_url, options = {}) {
	Swal.fire({
		title: "Confirm Deletion",
		text: "Confirm You Want To Delete " + name + " ?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#3085d6",
		confirmButtonText: "Delete",
		cancelButtonText: "Cancel",
		customClass: {
			popup: "rounded-border",
			content: "small-text",
		},
	}).then((result) => {
		if (result.isConfirmed) {
			// alert('teena');
			$.ajax({
				url: function_url + "/" + id, // Replace with your actual delete endpoint
				type: "DELETE", // Use POST or DELETE depending on your server configuration
				success: function (response) {
					if (
						response.ApiResponseStatusCode == 200 ||
						response.ApiResponseStatusCode == 201
					) {
						if (options.swal) {
							Swal.fire({
								text: response.message,
								icon: "success",
								showConfirmButton: false,
								timer: 3000,
								customClass: {
									popup: "rounded-border",
									content: "small-text",
								},
							});
						}
						if (options.toastr) {
							toastr.success(response.message);
						}
						if (options.successCallback) {
							if (typeof options.successCallback == "function") {
								options.successCallback(response);
							}
						}
					}
					if (
						!(
							response.ApiResponseStatusCode == 200 ||
							response.ApiResponseStatusCode == 201
						)
					) {
						if (options.swal) {
							Swal.fire({
								text: response.message,
								icon: "error",
								timer: 3000,
								customClass: {
									popup: "rounded-border",
									content: "small-text",
								},
							});
						}
						if (options.toastr) {
							toastr.error(response.message);
						}
						if (options.errorCallback) {
							if (typeof options.errorCallback == "function") {
								options.errorCallback(response);
							}
						}
					}
				},
				error: function (xhr, status, error) {
					if (options.swal) {
						Swal.fire({
							text:
								xhr.responseJSON?.message ||
								"An error occurred while deleting the data.",
							icon: "error",
							timer: 3000,
							customClass: {
								popup: "rounded-border",
								content: "small-text",
							},
						});
					}
					if (options.toastr) {
						toastr.error(
							xhr.responseJSON?.message ||
								"An error occurred while deleting the data.",
						);
					}
					if (options.errorCallback) {
						if (typeof options.errorCallback === "function") {
							options.errorCallback(xhr);
						}
					}
				},
			});
		}
	});

	return false; // Prevent default link behavior
}

/**
 * Initializes a Select2 dropdown on the specified select element with optional data loading from an API.
 *
 * @param {string} selectId - ID of the select element to initialize Select2 on.
 * @param {object} options - Additional options for Select2 initialization.
 *                           - placeholder: Placeholder text for the select input.
 *                           - allowClear: Whether to allow clearing the selected option.
 * @param {string} apiUrl - Optional URL to fetch data from an API.
 * @param {object} apiData - Additional data to send with the API request (POST data).
 * @param {string} valueField - Field name to use as the value in Select2 options (default: "id").
 * @param {string} textField - Field name to use as the display text in Select2 options (default: "text").
 * @param {mixed} defaultSelectedValues - Default selected values (single value or array).
 * @param {string} optionGroupingFieldName - Field name for grouping options (optional).
 * @returns {object} An object with methods to interact with the initialized Select2 instance:
 *                   - onchange(callback): Sets a callback function to handle change events.
 *                   - clearOptions(): Clears the selected options in the Select2 dropdown.
 */
function initializeSelect2(
	selectId, // ID of the select element to initialize Select2 on
	options = {}, // Additional options for Select2 initialization
	apiUrl = "", // URL to fetch data from (optional)
	apiData = {}, // Additional data to send with the API request (optional)
	valueField = "id", // Field name to use as the value in Select2 options
	textField = "text", // Field name to use as the display text in Select2 options
	defaultSelectedValues = null, // Default selected values (single value or array)
	optionGroupingFieldName = null, // Field name for grouping options (optional)
	staticOptions = [], // Array of static options to add (optional)
) {
	// Convert single defaultSelectedValue to an array
	if (defaultSelectedValues !== null && !Array.isArray(defaultSelectedValues)) {
		defaultSelectedValues = [defaultSelectedValues];
	}

	var enableMultiple = options.hasOwnProperty("multiple")
		? options.multiple
		: defaultSelectedValues && defaultSelectedValues.length > 1;

	// Initialize Select2
	var $select = $("#" + selectId).select2({
		placeholder: options.placeholder || "Select an option",
		allowClear: true,
		multiple: enableMultiple, // Enable multiple selection if multiple values provided
		data: staticOptions, // Add static options here
	});

	// Trigger validation on change
	// $select.on("change", function () {
	// 	$(this).valid();
	// });

	$select.on("change", function () {
		// Check if the select box is inside a form and has the 'required' attribute
		if (
			$(this).closest("form").length > 0 &&
			$(this).attr("required") !== undefined
		) {
			$(this).valid(); // Call valid() only if criteria are met
		}
	});

	// Load data from API if apiUrl is provided
	if (apiUrl !== "") {
		$.ajax({
			url: apiUrl,
			type: "POST",
			data: apiData, // Additional data to send with the request
			dataType: "json",
			success: function (response) {
				if (response.ApiResponseStatusCode == 200) {
					var data = response.data;
					if (Array.isArray(data) && data.length > 0) {
						// Check if grouping is needed
						if (optionGroupingFieldName) {
							// Group data by the specified field
							var groupedData = {};
							$.each(data, function (index, item) {
								var group = item[optionGroupingFieldName];
								if (!groupedData[group]) {
									groupedData[group] = [];
								}
								groupedData[group].push(item);
							});

							// Add grouped options to Select2
							$.each(groupedData, function (group, items) {
								var groupData = [];
								$.each(items, function (index, item) {
									groupData.push({
										id: item[valueField],
										text: item[textField],
									});
								});
								$select.append('<optgroup label="' + group + '">').select2({
									data: groupData,
									placeholder: options.placeholder || "Select an option", // Reapply the placeholder
									allowClear: true,
								});
							});
						} else {
							// Populate Select2 dropdown with data from API
							var selectData = [];
							$.each(data, function (index, item) {
								selectData.push({
									id: item[valueField],
									text: item[textField],
								});
							});
							$select.select2({
								data: selectData,
								placeholder: options.placeholder || "Select an option", // Reapply the placeholder
								allowClear: true,
							});
						}
					} else {
						$select
							.empty()
							.append("<option></option>")
							.val(null)
							.trigger("change.select2");
					}
					// Set default selected values if provided
					if (
						defaultSelectedValues !== null &&
						defaultSelectedValues.length > 0
					) {
						$select.val(defaultSelectedValues).trigger("change.select2");
					}
				} else {
					$select
						.empty()
						.append("<option></option>")
						.val(null)
						.trigger("change.select2");
				}
			},
			error: function (xhr, status, error) {
				console.error("Error fetching data from API:", error);
			},
		});
	}

	// Return an object with methods
	return {
		onchange: function (callback) {
			$select.on("change", function () {
				var selectedValues = $select.val();
				callback(selectedValues);
			});
		},
		clearOptions: function () {
			return new Promise(function (resolve) {
				$select.val(null).trigger("change.select2");
				resolve();
			});
		},
	};
}

// var DeleteApiUrl = "";
function deleteRow(data) {
	return new Promise((resolve, reject) => {
		Swal.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, delete it!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: DeleteApiUrl,
					type: "POST",
					contentType: "application/json",
					data: JSON.stringify(data),
					success: function (response) {
						// Handle success response
						if (response.status == 422) {
							toastr.error(response.message);
							reject(response.message); // Reject promise on specific condition
						} else if (response.status == 200) {
							toastr.success(response.message);
							resolve(response); // Resolve promise with response object
						} else {
							toastr.error(response.message);
							console.error(response);
							reject(response.message); // Reject promise on unexpected response
						}
					},
					error: function (xhr, status, error) {
						// Handle error response
						console.error(xhr.responseText);
						toastr.error("Error deleting row"); // Optionally show a generic error message
						reject(error); // Reject promise on error
					},
				});
			} else {
				// User clicked cancel, handle as needed
				reject("Deletion cancelled by user");
			}
		});
	});
}

//common for DataTable
/**
 * Initializes or refreshes a DataTable with data fetched from an API.
 * @param {string} table_id - The ID of the HTML table element to initialize or refresh as a DataTable.
 * @param {string} url - The URL of the API endpoint to fetch data from.
 * @param {string} [method="POST"] - The HTTP method for the API request (default is "POST").
 * @param {Object} [parameter={}] - The parameters to send with the API request.
 * @param {function} dataTableSuccessCallBack - A callback function that processes the API response and returns necessary data for DataTable.
 * @param {Object} [headers={}] - The headers to include in the API request.
 */
// function DataTableInitialized(
// 	table_id,
// 	url,
// 	method = "POST",
// 	parameter = {},
// 	dataTableSuccessCallBack = null,
// 	headers = {},
// 	afterTableViewCallbackFunction = null
// ) {
// 	// Check if DataTable is already initialized
// 	if ($.fn.DataTable.isDataTable("#" + table_id)) {
// 		// DataTable is already initialized, update data
// 		DataTableApiCall(url, method, parameter, dataTableSuccessCallBack, headers)
// 			.then(function (data) {
// 				var dataTable = $("#" + table_id).DataTable();

// 				// Clear existing data and add new data
// 				dataTable.clear().rows.add(data.rowData).draw();

// 				// Call the success callback function if provided
// 				// if (typeof dataTableSuccessCallBack === "function") {
// 				// 	dataTableSuccessCallBack(data);
// 				// }
// 				if (typeof afterTableViewCallbackFunction === "function") {
// 					afterTableViewCallbackFunction(data);
// 				}
// 			})
// 			.catch(function (error) {
// 				console.log("DataTable Error fetching data from server");
// 			});
// 	} else {
// 		// DataTable not initialized, initialize it with API data
// 		DataTableApiCall(url, method, parameter, dataTableSuccessCallBack, headers)
// 			.then(function (data) {
// 				var dataTable = $("#" + table_id).DataTable({
// 					data: data.rowData, // Initialize DataTable with data
// 					columns: data.columns, // Define columns if available
// 					dom:
// 						"<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +
// 						"<'row m-0'<'col-sm-12'tr>>" +
// 						"<'row m-0'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
// 					buttons: ["copy", "excel", "pdf", "print", "colvis"],
// 					scrollX: true, // Enable horizontal scrolling
// 					paging: true,
// 					lengthMenu: [
// 						[10, 25, 50, 100, -1],
// 						[10, 25, 50, 100, "All"],
// 					], // Page length options
// 					pageLength: 50, // Initial page length
// 					initComplete: function () {
// 						// Callback function after DataTable initialization
// 						// if (typeof dataTableSuccessCallBack === "function") {
// 						// 	dataTableSuccessCallBack(data);
// 						// }
// 						if (typeof afterTableViewCallbackFunction === "function") {
// 							afterTableViewCallbackFunction(data);
// 						}
// 					},
// 				});

// 				// Append buttons to DataTable wrapper
// 				dataTable
// 					.buttons()
// 					.container()
// 					.appendTo("#" + table_id + "_wrapper .col-md-6:eq(0)");

// 				// Add form-select class to the length dropdown
// 				$("#" + table_id + "_length select").addClass(
// 					"form-select form-select-sm"
// 				);
// 			})
// 			.catch(function (error) {
// 				console.log("DataTable Error fetching data from server");
// 			});
// 	}
// }

function DataTableInitialized(
	table_id,
	url,
	method = "POST",
	parameter = {},
	dataTableSuccessCallBack = null,
	headers = {},
	afterTableViewCallbackFunction = null,
) {
	var headerData = window.COMMON_SCHOOL_HEADER || {};

	if ($.fn.DataTable.isDataTable("#" + table_id)) {
		DataTableApiCall(url, method, parameter, dataTableSuccessCallBack, headers)
			.then(function (data) {
				var dt = $("#" + table_id).DataTable();
				dt.clear().rows.add(data.rowData).draw();
				if (typeof afterTableViewCallbackFunction === "function") {
					afterTableViewCallbackFunction(data);
				}
			})
			.catch(function (error) {
				console.log("DataTable Error fetching data from server", error);
			});
	} else {
		DataTableApiCall(url, method, parameter, dataTableSuccessCallBack, headers)
			.then(function (data) {
				var dt = $("#" + table_id).DataTable({
					data: data.rowData,
					columns: data.columns,
					dom:
						"<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +
						"<'row m-0'<'col-sm-12'tr>>" +
						"<'row m-0'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
					scrollX: true,
					paging: true,

					lengthMenu: [
						[10, 25, 50, 100, -1],
						[10, 25, 50, 100, "All"],
					],
					pageLength: 50,
					buttons: [
						"copy",
						"excel",
						{
							extend: "pdfHtml5",
							title: "",
							pageSize: "A4",
							exportOptions: {
								columns: ":visible",
								modifier: { page: "all" },
							},
							orientation: "portrait", // default
							action: function (e, dt, node, config) {
								// 🔹 Step 1: Get visible column count before export
								var data = dt.buttons.exportData(config.exportOptions);
								var columnCount = data.header.length;

								// 🔹 Step 2: Set orientation BEFORE calling built-in pdfHtml5
								if (columnCount > 8) {
									config.orientation = "landscape";
									config.pageSize = "A4";
								} else {
									config.orientation = "portrait";
									config.pageSize = "A4";
								}

								// 🔹 Step 3: Call original export
								$.fn.dataTable.ext.buttons.pdfHtml5.action.call(
									this,
									e,
									dt,
									node,
									config,
								);
							},
							customize: function (doc) {
								var columnCount = doc.content[1]?.table?.body[0]?.length || 0;

								// 🔹 Adjust font size for readability
								doc.defaultStyle.fontSize = columnCount > 8 ? 7 : 9;

								// 🔹 Adjust margins
								doc.pageMargins = [20, 60, 20, 30];

								// 🔹 Fix column width auto
								if (doc.content[1] && doc.content[1].table) {
									var tableHeader = doc.content[1].table.body[0];
									if (tableHeader) {
										doc.content[1].table.widths = Array(
											tableHeader.length,
										).fill("*");
									}
								}

								// 🔹 Add header with logo and info
								if (headerData?.logo) {
									doc.content.unshift({
										columns: [
											{
												image: headerData.logo,
												width: 60,
												height: 60,
												alignment: "center",
											},
											{
												width: "*",
												stack: [
													{ text: headerData.campus, style: "headerName" },
													{
														text:
															headerData.address +
															(headerData.city
																? " | City: " + headerData.city
																: "") +
															(headerData.state
																? " | State: " + headerData.state
																: ""),
														style: "headerDetails",
													},
													{
														text:
															"Phone: " +
															headerData.phone +
															(headerData.email
																? " | Email: " + headerData.email
																: ""),
														style: "headerDetails",
													},
												],
												alignment: "center",
											},
										],
										margin: [0, 0, 0, 10],
									});
								}

								// 🔹 Header styles
								doc.styles = {
									headerName: {
										fontSize: 14,
										bold: true,
										color: "#1a8f3d",
										alignment: "center",
									},
									headerDetails: { fontSize: 10, alignment: "center" },
								};
							},
						},

						{
							extend: "print",
							title: "",
							customize: function (win) {
								if (headerData.campus) {
									var html = `
            <div style="display:flex; align-items:center; justify-content:center;">
                <img src="${headerData.logo}" style="max-height:60px;" />
                <div style="flex:1; text-align:center;">
                    <div style="font-weight:bold; font-size:14px; color:#1a8f3d;">${
											headerData.campus
										}</div>
                    <div style="font-size:11px;">
                        ${headerData.address} &nbsp;|&nbsp; City: ${
													headerData.city || ""
												} &nbsp;|&nbsp; State: ${headerData.state || ""}<br>
                        Phone: ${headerData.phone} &nbsp;|&nbsp; Email: ${
													headerData.email || ""
												}
                    </div>
                </div>
            </div>
        `;
									$(win.document.body).prepend(html);

									$(win.document.body).find("table").css("font-size", "12px");
								}
							},
						},
						"colvis",
					],
					initComplete: function () {
						if (typeof afterTableViewCallbackFunction === "function") {
							afterTableViewCallbackFunction(data);
						}
					},
				});

				dt.buttons()
					.container()
					.appendTo("#" + table_id + "_wrapper .col-md-6:eq(0)");
				$("#" + table_id + "_length select").addClass(
					"form-select form-select-sm",
				);
			})
			.catch(function (error) {
				console.log("DataTable Error fetching data from server", error);
			});
	}
}

/**
 * Makes an AJAX request to fetch data from an API.
 * @param {string} url - The URL of the API endpoint.
 * @param {string} [method="POST"] - The HTTP method for the API request (default is "POST").
 * @param {Object} [parameter={}] - The parameters to send with the API request.
 * @param {function} dataTableSuccessCallBack - A callback function that processes the API response and returns necessary data for DataTable.
 * @param {Object} [headers={}] - The headers to include in the API request.
 * @returns {Promise<{rowData: Array, columns: Array}>} A promise that resolves with an object containing rowData (array of objects) and columns (array of column definitions).
 */
function DataTableApiCall(
	url,
	method = "POST",
	parameter = {},
	dataTableSuccessCallBack,
	headers = {},
) {
	return new Promise(function (resolve, reject) {
		$.ajax({
			type: method,
			url: url,
			data: parameter,
			headers: headers,
			success: function (response) {
				if (typeof dataTableSuccessCallBack === "function") {
					var callbackResult = dataTableSuccessCallBack(response);
					var statusValue =
						"status" in callbackResult ? callbackResult.status : null;
					var columns =
						"columns" in callbackResult ? callbackResult.columns : null;
					var rowData = "data" in callbackResult ? callbackResult.data : null;
					if (statusValue === null || columns === null || rowData === null) {
						reject("Invalid callback result");
						return;
					}
					if (statusValue === 200) {
						resolve({
							rowData: rowData,
							columns: columns,
						});
					} else {
						resolve({
							rowData: {},
							columns: columns,
						});
						toastr.error(response.message);
						// reject(response.message);
					}
				} else {
					toastr.error("Success Callback Function Not Found");
					reject("Success Callback Function Not Found");
				}
			},
			error: function (xhr, status, error) {
				console.error("Error occurred: ", error);
				console.log("DataTable Error fetching data from server");
				reject(error);
			},
		});
	});
}

$(document).ready(function () {
	$(".ckeditor-active").each(function () {
		var textareaId = $(this).attr("id");
		CKEDITOR.replace(textareaId, {
			extraAllowedContent: "*[style]",
			allowedContent: true,
			htmlSupport: {
				allow: [
					{
						name: "div",
						attributes: true, // Allow all attributes including style
					},
					{
						name: "span",
						attributes: true, // Allow all attributes including style
					},
					{
						name: "table",
						attributes: true, // Allow all attributes including style and align
					},
					{
						name: "tr",
						attributes: true, // Allow attributes for table rows
					},
					{
						name: "td",
						attributes: true, // Allow attributes for table cells
					},
				],
			},
		});

		// Handle CKEditor change event
		CKEDITOR.instances[textareaId].on("change", function () {
			// Update corresponding textarea's value with CKEditor's data
			$("#" + textareaId).val(CKEDITOR.instances[textareaId].getData());
		});
	});
});
// Initialize CKEditor on textareas with class 'ckeditor-active'

function clearJqueryValidationsMessages(formId) {
	// Select the form using the provided formId
	const $form = $("#" + formId);

	if ($form.length) {
		$form.find(".error-message").text("");
		// Loop through all input fields in the form
		$form.find("input, select, textarea").each(function () {
			const $input = $(this);

			// Get the ID and name attributes of the input
			const inputId = $input.attr("id");
			const inputName = $input.attr("name");

			// Clear messages based on the ID attribute
			if (inputId) {
				// Find label or span elements associated with the input ID
				const $errorLabel = $form.find(`label#${inputId}-error`);
				const $errorSpan = $form.find(`span#${inputId}-error`);

				if ($errorLabel.length) {
					$errorLabel.html("").removeClass("d-block").css("display", "none"); // Clear label and hide
				}
				if ($errorSpan.length) {
					$errorSpan.html("").removeClass("d-block").css("display", "none"); // Clear span and hide
				}
			}

			// Clear messages based on the Name attribute (fallback)
			if (inputName) {
				// Find label or span elements associated with the input Name
				const $errorLabel = $form.find(`label[for="${inputName}"]`);
				const $errorSpan = $form.find(`span[name="${inputName}-error"]`);

				if ($errorLabel.length) {
					$errorLabel.html("").removeClass("d-block").css("display", "none"); // Clear label and hide
				}
				if ($errorSpan.length) {
					$errorSpan.html("").removeClass("d-block").css("display", "none"); // Clear span and hide
				}
			}
		});

		// Optionally, reset validation styles
		$form.find(".error").removeClass("error"); // Remove error class
	} else {
		console.warn('Form with ID "' + formId + '" not found.');
	}
}

function get_events_announcement_data() {
	$.ajax({
		url: base_url + "Teacher/get_events_announcement_data_api",
		type: "POST",
		data: {},
		success: function (response) {
			if (
				response.ApiResponseStatusCode === 200 ||
				response.ApiResponseStatusCode === 201
			) {
				$("#event_announcement_id").html("");
				$("#event_announcement_id").html(response.data);
				// toastr.success(response.message);
			} else {
				toastr.error(response.message);
			}
		},
		error: function (xhr, status, error) {
			toastr.error("An error occurred while updating the data.");
		},
	});
}

function get_news_data() {
	$.ajax({
		url: base_url + "Teacher/get_news_data_api",
		type: "POST",
		data: {},
		success: function (response) {
			if (
				response.ApiResponseStatusCode === 200 ||
				response.ApiResponseStatusCode === 201
			) {
				$("#news_id").html("");
				$("#news_id").html(response.data);
				// toastr.success(response.message);
			} else {
				toastr.error(response.message);
			}
		},
		error: function (xhr, status, error) {
			toastr.error("An error occurred while updating the data.");
		},
	});
}

function get_academic_month_calendar_data() {
	$.ajax({
		url: base_url + "Teacher/get_academic_month_calendar_data_api",
		type: "POST",
		data: {},
		success: function (response) {
			if (
				response.ApiResponseStatusCode === 200 ||
				response.ApiResponseStatusCode === 201
			) {
				$("#academic_month_calendar_id").html("");
				$("#academic_month_calendar_id").html(response.data);
				// toastr.success(response.message);
			} else {
				toastr.error(response.message);
			}
		},
		error: function (xhr, status, error) {
			toastr.error("An error occurred while updating the data.");
		},
	});
}

function get_social_activity_data() {
	$.ajax({
		url: base_url + "Teacher/get_social_activity_data_api",
		type: "POST",
		data: {},
		success: function (response) {
			if (
				response.ApiResponseStatusCode === 200 ||
				response.ApiResponseStatusCode === 201
			) {
				$(".print_social_news").html("");
				$(".print_social_news").html(response.data);
				// toastr.success(response.message);
			} else {
				toastr.error(response.message);
			}
		},
		error: function (xhr, status, error) {
			toastr.error("An error occurred while updating the data.");
		},
	});
}

function get_Employee_birthday() {
	$.ajax({
		url: base_url + "Teacher/get_emp_birthday",
		type: "POST",
		data: {},
		success: function (response) {
			if (
				response.ApiResponseStatusCode === 200 ||
				response.ApiResponseStatusCode === 201
			) {
				$("#Emp_Bdy_id").html("");
				$("#Emp_Bdy_id").html(response.data);
				// toastr.success(response.message);
			} else {
				// toastr.error(response.message);
			}
		},
		error: function (xhr, status, error) {
			toastr.error("An error occurred while updating the data.");
		},
	});
}

function get_Student_birthday() {
	$.ajax({
		url: base_url + "Teacher/get_stu_birthday",
		type: "POST",
		data: {},
		success: function (response) {
			if (
				response.ApiResponseStatusCode === 200 ||
				response.ApiResponseStatusCode === 201
			) {
				$("#Stu_Bdy_id").html("");
				$("#Stu_Bdy_id").html(response.data);
				// toastr.success(response.message);
			} else {
				// toastr.error(response.message);
			}
		},
		error: function (xhr, status, error) {
			toastr.error("An error occurred while updating the data.");
		},
	});
}

function get_CurrentMonth_Attendance() {
	$.ajax({
		url: base_url + "HR/get_currentmonth_attendnace",
		type: "POST",
		data: {},
		success: function (response) {
			if (
				response.ApiResponseStatusCode === 200 ||
				response.ApiResponseStatusCode === 201
			) {
				$("#monthly-attendnace").html("");
				$("#monthly-attendnace").html(response.data);
				// toastr.success(response.message);
			} else {
				toastr.error(response.message);
			}
		},
		error: function (xhr, status, error) {
			toastr.error("An error occurred while updating the data.");
		},
	});
}
function get_Attendnace_Popup() {
	$.ajax({
		url: base_url + "HR/get_attendance_popup",
		type: "POST",
		data: {},
		success: function (response) {
			if (
				response.ApiResponseStatusCode === 200 ||
				response.ApiResponseStatusCode === 201
			) {
				$("#not_attendance").html("");
				$("#not_attendance").html(response.data);
				// toastr.success(response.message);
			} else {
				toastr.error(response.message);
			}
		},
		error: function (xhr, status, error) {
			toastr.error("An error occurred while updating the data.");
		},
	});
}

function getAllStudentIdCardTemplates() {
	return new Promise(function (resolve, reject) {
		$.ajax({
			url: base_url + "Studentsection/getAllStudentIdCardTemplates",
			type: "POST",
			dataType: "json", // ensures response is already parsed
			data: {},
			success: function (response) {
				if (response.status === 200 || response.ApiResponseStatusCode === 200) {
					// Return only the data array
					resolve(response.data);
				} else {
					reject(response);
				}
			},
			error: function (err) {
				reject(err);
			},
		});
	});
}

function selectStudentIdCardTemplate(student_id) {
	getAllStudentIdCardTemplates()
		.then(function (templates) {
			if (!templates || templates.length === 0) {
				Swal.fire("No templates found!", "", "warning");
				return;
			}

			// Build HTML for SweetAlert2
			var html = '<div style="display:flex; flex-wrap:wrap; gap:10px;">';
			templates.forEach(function (url, index) {
				var templateName = url.split("/").pop(); // get file name
				html += `
                    <div style="text-align:center; cursor:pointer;" class="template-wrapper">
                        <h6>${templateName}</h6>
                        <img src="${url}" 
                             style="width:150px; border:1px solid #ccc; border-radius:5px;" 
                             data-url="${url}" 
                             data-name="${templateName}">
                        <br>
                        <input type="radio" name="selected_template" value="${url}" ${
													index === 0 ? "checked" : ""
												}>
                    </div>
                `;
			});
			html += "</div>";

			// Show SweetAlert2 modal
			Swal.fire({
				title: "Select ID Card Template",
				html: html,
				showCancelButton: true,
				confirmButtonText: "Confirm",
				width: "800px",
				didOpen: () => {
					const content = Swal.getHtmlContainer();
					content.style.overflowY = "auto";
					content.style.maxHeight = "400px";

					// Add click-to-download functionality for images
					$(content)
						.find("img")
						.on("click", function () {
							const imgUrl = $(this).data("url");
							const imgName = $(this).data("name") || "ID_Card";

							// Create temporary link for download
							const link = document.createElement("a");
							link.href = imgUrl;
							link.download = imgName;
							document.body.appendChild(link);
							link.click();
							document.body.removeChild(link);
						});
				},
			}).then((result) => {
				if (result.isConfirmed) {
					// Get selected template
					var selectedTemplate = $(
						'input[name="selected_template"]:checked',
					).val();
					if (!selectedTemplate) {
						Swal.fire("Please select a template!", "", "warning");
						return;
					}

					// Call ShowIdCard with selected template
					ShowIdCardWithTemplate(student_id, selectedTemplate);
				}
			});
		})
		.catch(function (err) {
			console.error(err);
			Swal.fire("Error fetching templates", "", "error");
		});
}

function ShowIdCardWithTemplate(student_id, svg_template_url) {
	$.ajax({
		url: base_url + "Studentsection/ShowIdCardDataNew",
		type: "POST",
		data: {
			student_id: student_id,
			svg_template_url: svg_template_url,
		},
		success: function (response) {
			if (response.ApiResponseStatusCode === 200) {
				debugger;
				// var val = JSON.parse(response);
				var data = response.data;
				$("#single_student_id_card_html").html(data.svg);

				var modal = new bootstrap.Modal(
					document.getElementById("student_id_card_modal"),
				);
				modal.show();
			} else {
				toastr.error(response.message);
			}
		},
		error: function (err) {
			toastr.error("Failed to load ID card!", "", "error");
		},
	});
}

// Download SVG (Print-ready)
// Download SVG (Print-ready, Centered, Full-size)
$("#student_id_card_download_svg").on("click", function () {
	const svgContainer = document.querySelector("#single_student_id_card_html");
	const svgElement = svgContainer?.querySelector("svg");
	if (!svgElement) {
		Swal.fire({ icon: "warning", title: "No ID Card Found!" });
		return;
	}

	// Clone SVG for download (no resizing)
	const clone = svgElement.cloneNode(true);
	clone.setAttribute("xmlns", "http://www.w3.org/2000/svg");

	// --- Add print alignment styles ---
	const style = document.createElement("style");
	style.textContent = `
		@page { margin: 0; }
		svg {
			display: block;
			margin: auto;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}
		body {
			margin: 0;
			padding: 0;
			width: 100vw;
			height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			background: #fff;
		}
	`;
	clone.insertBefore(style, clone.firstChild);

	// --- Serialize and download ---
	const serializer = new XMLSerializer();
	const svgData = serializer.serializeToString(clone);
	const blob = new Blob([svgData], { type: "image/svg+xml;charset=utf-8" });
	const url = URL.createObjectURL(blob);

	const link = document.createElement("a");
	link.href = url;
	link.download = "Student_ID_Card.svg";
	document.body.appendChild(link);
	link.click();

	document.body.removeChild(link);
	URL.revokeObjectURL(url);
});

// For Bulk Download Student ID Cards

function bulkDownloadIdCards() {
	if (selectedStudentIds.length === 0) {
		Swal.fire(
			"No students selected",
			"Please select at least one student.",
			"warning",
		);
		return;
	}

	// Fetch templates (reuse existing function)
	getAllStudentIdCardTemplates()
		.then(function (templates) {
			if (!templates || templates.length === 0) {
				Swal.fire("No templates found!", "", "warning");
				return;
			}

			// Build template selection HTML
			var html = '<div style="display:flex; flex-wrap:wrap; gap:10px;">';
			templates.forEach(function (url, index) {
				var templateName = url.split("/").pop();
				html += `
                    <div style="text-align:center; cursor:pointer;" class="template-wrapper">
                        <h6>${templateName}</h6>
                        <img src="${url}" 
                             style="width:150px; border:1px solid #ccc; border-radius:5px;" 
                             data-url="${url}" 
                             data-name="${templateName}">
                        <br>
                        <input type="radio" name="selected_template" value="${url}" ${index === 0 ? "checked" : ""}>
                    </div>
                `;
			});
			html += "</div>";

			// Show template selection modal
			Swal.fire({
				title: "Select ID Card Template",
				html: html,
				showCancelButton: true,
				confirmButtonText: "Download All",
				width: "800px",
				didOpen: () => {
					const content = Swal.getHtmlContainer();
					content.style.overflowY = "auto";
					content.style.maxHeight = "400px";
				},
			}).then((result) => {
				if (result.isConfirmed) {
					var selectedTemplate = $(
						'input[name="selected_template"]:checked',
					).val();
					if (!selectedTemplate) {
						Swal.fire("Please select a template!", "", "warning");
						return;
					}

					// Process each student sequentially
					Swal.fire({
						title: "Downloading...",
						html: "Please wait while we generate ID cards.",
						allowOutsideClick: false,
						didOpen: () => {
							Swal.showLoading();
						},
					});

					// Use a recursive function to avoid overwhelming the server
					function downloadNext(index) {
						if (index >= selectedStudentIds.length) {
							Swal.close();
							toastr.success("All ID cards downloaded!");
							return;
						}
						var studentId = selectedStudentIds[index];
						downloadIdCardSVG(studentId, selectedTemplate)
							.then(() => {
								// Small delay to avoid browser blocking multiple downloads
								setTimeout(() => downloadNext(index + 1), 500);
							})
							.catch((err) => {
								console.error("Failed for student " + studentId, err);
								toastr.error("Failed for student ID: " + studentId);
								downloadNext(index + 1); // continue with next
							});
					}
					downloadNext(0);
				}
			});
		})
		.catch(function (err) {
			console.error(err);
			Swal.fire("Error fetching templates", "", "error");
		});
}

// Helper function to download a single ID card as SVG
function downloadIdCardSVG(studentId, templateUrl) {
	return new Promise(function (resolve, reject) {
		$.ajax({
			url: base_url + "Studentsection/ShowIdCardDataNew",
			type: "POST",
			data: {
				student_id: studentId,
				svg_template_url: templateUrl,
				"<?= $this->security->get_csrf_token_name() ?>":
					"<?= $this->security->get_csrf_hash() ?>",
			},
			dataType: "json",
			success: function (response) {
				if (response.ApiResponseStatusCode === 200) {
					var svgString = response.data.svg;
					// Create a blob and trigger download
					var blob = new Blob([svgString], {
						type: "image/svg+xml;charset=utf-8",
					});
					var url = URL.createObjectURL(blob);
					var link = document.createElement("a");
					link.href = url;
					link.download = "ID_Card_Student_" + studentId + ".svg";
					document.body.appendChild(link);
					link.click();
					document.body.removeChild(link);
					URL.revokeObjectURL(url);
					resolve();
				} else {
					reject(response.message);
				}
			},
			error: function (err) {
				reject(err);
			},
		});
	});
}

function getInlineTableExportButtons() {
	console.log("✅ getInlineTableExportButtons() CALLED");

	var headerData = window.COMMON_SCHOOL_HEADER || {};
	console.log("HEADER DATA =>", headerData);

	return [
		"copy",
		"excel",

		// ================= PDF =================
		{
			extend: "pdfHtml5",
			title: "",
			pageSize: "A4",
			orientation: "portrait",
			exportOptions: {
				columns: ":visible",
			},
			customize: function (doc) {
				doc.pageMargins = [20, 90, 20, 30];

				if (headerData && headerData.campus) {
					doc.content.unshift({
						margin: [0, 0, 0, 15],
						table: {
							widths: [80, "*"],
							body: [
								[
									headerData.logo
										? {
												image: headerData.logo, // ✅ FULL base64
												width: 60,
												alignment: "center",
											}
										: "",
									{
										stack: [
											{
												text: headerData.campus,
												fontSize: 14,
												bold: true,
												color: "#1a8f3d",
												alignment: "center",
											},
											{
												text:
													(headerData.address || "") +
													(headerData.city
														? " | City: " + headerData.city
														: "") +
													(headerData.state
														? " | State: " + headerData.state
														: ""),
												fontSize: 10,
												alignment: "center",
											},
											{
												text:
													"Phone: " +
													(headerData.phone || "") +
													(headerData.email
														? " | Email: " + headerData.email
														: ""),
												fontSize: 10,
												alignment: "center",
											},
										],
									},
								],
							],
						},
						layout: "noBorders",
					});
				}
			},
		},

		// ================= PRINT =================
		{
			extend: "print",
			title: "",
			customize: function (win) {
				if (window.COMMON_SCHOOL_HEADER_HTML) {
					$(win.document.body).css("margin", "20px");

					$(win.document.body).prepend(`
						<div style="border-bottom:1px solid #ddd; padding-bottom:10px; margin-bottom:10px;">
							${window.COMMON_SCHOOL_HEADER_HTML}
						</div>
					`);

					$(win.document.body).find("table").css("font-size", "12px");
				}
			},
		},

		"colvis",
	];
}

document.addEventListener("DOMContentLoaded", function () {
	if (document.querySelectorAll(".multi_date_picker").length > 0) {
		flatpickr(".multi_date_picker", {
			mode: "multiple",
			dateFormat: "Y-m-d",
			allowInput: true,
			closeOnSelect: false,
		});
	}
});
