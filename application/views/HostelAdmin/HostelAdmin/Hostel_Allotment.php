<!-- Allotment Start -->
<div class="content_wrapper">
    <div class="myDiv" id="Hos_Allotment">
        <div class="row">
            <div class="col-12 justify-content-between d-flex">
                <h4 class="sub-heading">
                    <i class="fa-solid fa-square-plus m-1"></i>
                    <span class="underline"><b>Allotment</b>
                        <i class="fa-solid fa-circle"></i></span>
                </h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href=""><img height="15"
                                    width="15" class="mb-1"
                                    src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a></li>
                        <li class="breadcrumb-item"><a href="#">Hostel Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Allotment</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card schl-btn-lgreen p-4">
            <form id="Allotment_formid" method="post">
                <div class="row">
                    <div class="col-md-2 mb-2">
                        <input type="hidden" name="alloted_id" id="alloted_id" value="<?= @$alloted_id ?>">
                        <input type="hidden" name="created_by" id="employee_id" value="<?= @$employee_id ?>">
                        <input type="hidden" name="school_id" id="school_id" value="<?= @$school_id ?>">
                        <input type="hidden" name="alloted_student_id" id="alloted_student_id"
                            value="<?= @$alloted_student_id ?>">

                        <input type="hidden" name="academic_year_id" id="academic_year_id"
                            value="<?= isset($academic_year_id) ? $academic_year_id : '' ?>">

                        <input type="hidden" name="alloted_employee_id" id="alloted_employee_id"
                            value="<?= @$alloted_employee_id ?>">

                        <div class="">
                            <label for="" class="form-label">Date </label>
                            <input type="Date" class="form-control" id="alloted_date" name="alloted_date"
                                value="<?= @$alloted_date ?>" placeholder="Date" />
                            <span class="error-message" id="alloted_date-error"></span>
                        </div>
                    </div>
                    <?php
                    // Check if alloted_id is set and not empty
                    $readonly = !empty($alloted_id) ? 'readonly' : '';
                    ?>


                    <?php
                    $readonly_selecttype = (!empty($alloted_id)) ? 'disabled' : '';
                    ?>
                    <div class="col-2 mb-3">
                        <label for="type" class="form-label">Select Type</label>
                        <select name="type" id="type" <?= $readonly_selecttype ?> class="form-control" onchange="loadStudentEmployeeList()">
                            <option value="">Select type</option>
                            <option value="student" <?= $type == 'student' ? 'selected' : '' ?>>Student</option>
                            <option value="employee" <?= $type == 'employee' ? 'selected' : '' ?>>Employee</option>
                        </select>
                        <!-- <span class="error-message" id="type-error"></span> -->
                    </div>

                    <!-- <div class="col-md-2 mb-2">
                        <label for="" class="form-label"> Enter ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" oninput="StudentOninput()" id="stu_emp_id"
                            name="stu_emp_id"
                            value="</?= !empty($stu_admission_id) ? htmlspecialchars($stu_admission_id) : htmlspecialchars($empautonumber) ?>"
                            placeholder="Enter ID" </?= $readonly ?> />
                        <span class="error-message" id="stu_emp_id-error"></span>
                    </div> -->








                    <div class="col-md-2 mb-3">
                        <label for="" class="form-label">Enter ID </label>
                        <input type="search"
                            class="form-control"
                            id="stu_emp_id"
                            placeholder="Enter ID / Name"
                            list="stu_emp_list"
                            value="<?= htmlspecialchars($display_name_with_id ?? '') ?>"
                            autocomplete="off"
                            <?= $readonly ?>>

                        <input type="hidden"
                            name="stu_emp_id"
                            id="actual_stu_emp_id"
                            value="<?= htmlspecialchars($stu_admission_id ?? $empautonumber ?? '') ?>">

                        <datalist id="stu_emp_list"></datalist>
                        <!-- <span class="error-message" id="stu_emp_id-error"></span> -->
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="form-label">Hostel <span class="text-danger">*</span> </label>
                        <?= selectHostel(
                            [
                                'select_name' => 'alloted_hostel_id',
                                'select_id' => 'alloted_hostel_id',
                                'option_label' => "Select Hostel",
                                'select_classes' => 'form-select',
                                'option_selected' => "$alloted_hostel_id",
                                "select_attribute" => "",
                            ],
                            [
                                'hostel_school' => $_SESSION['emp_data_session']['emp_schoolid']
                            ]

                        ) ?>
                        <span class="error-message" id="alloted_hostel_id-error"></span>

                    </div>
                    <div class="col-md-2 mb-2">
                        <label for="" class="form-label">Select Floor</label>
                        <select class="form-select" id="hostel_floor_id" name="alloted_floor_id">
                            <option value="" disabled selected>Select floor</option>
                        </select>
                        <span class="error-message" id="alloted_floor_id-error"></span>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label for="" class="form-label">Select Room</label>
                        <select class="form-select" id="hostel_room_id" name="alloted_room_id"
                            onchange="check_hostelroom_available();">
                            <option value="" disabled selected>Select Room</option>
                        </select>
                        <span class="error-message" id="alloted_room_id-error"></span>
                        <div id="View_AvailableRoom" class="text-sm"></div>
                    </div>

                    <div id="Allot_buttonId" class="col-md-2 text-end mb-2">
                        <?php $message = !empty(@$alloted_id) ? 'Update' : 'Allot' ?>
                        <button type="button"
                            onclick="CommonAjaxWithValidation('<?= $message ?> Room ?','<?= $message ?>','Allotment_formid', function_url, {swal: true, successCallback: successCallback, errorCallback: errorCallback})"
                            class="btn schl-btn-white mt-4">
                            <img width="40" height="40" src="https://img.icons8.com/clouds/100/checked--v1.png"
                                alt="checked--v1" /> <?= !empty(@$alloted_id) ? 'Update' : 'Allot' ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row  table_width">
            <div class="col">
                <table class="table table-responsive table-striped table-hover school-table-1 table-sm"
                    id="HostelRoomsAllotTable">
                </table>
            </div>
        </div>

    </div>
</div>
<!-- Allotment End  -->


<!-- Student Registration  modal popup end -->
<div class="modal fade" id="studentRegistrationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true"><a href=""><img height="15" width="15" class="mb-1"
            src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row modal-title align-items-end mt-1 w-100">
                    <div class="col-11">
                        <i class="fa-regular fa-pen-to-square me-2"></i><span>Student
                            Registration Form</span>
                    </div>
                    <div class="col text-end  p-0">
                        <button type="button" class="btn-close myfont" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>

            <div id="View_AllotmentDataShow">
            </div>

        </div>
    </div>
</div>
<!-- Student Registration  modal popup end -->


<!-- SweetAlert2 CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var selected_alloted_hostel_id = '<?= @$alloted_hostel_id ?>';
    var selected_floor_id = '<?= @$alloted_floor_id ?>';
    var selected_room_id = '<?= @$alloted_room_id ?>';
    $(document).ready(function() {
        if (selected_alloted_hostel_id) {
            var hostel_id = {
                "hostel_id": selected_alloted_hostel_id
            }
            initializeSelect2('hostel_floor_id', {
                    placeholder: "Select Floor ",
                }, "<?= base_url('ApiController/getFloorByHostel') ?>", hostel_id, "hostel_floor_id",
                "hostel_floor_name", selected_floor_id);
        }
        $('#alloted_hostel_id').on('change', function() {

            $('#hostel_floor_id').html('<option value=""></option>');
            var hostel_id = $(this).val();
            initializeSelect2('hostel_floor_id', {
                placeholder: "Select Floor ",
            }, "<?= base_url('ApiController/getFloorByHostel') ?>", {
                'hostel_id': hostel_id
            }, "hostel_floor_id", "hostel_floor_name");

        });


        if (selected_floor_id) {
            var hostel_floor_id = {
                "hostel_floor_id": selected_floor_id
            }
            initializeSelect2('hostel_room_id', {
                    placeholder: "Select Room ",
                }, "<?= base_url('ApiController/getRoomByFloor') ?>", hostel_floor_id, "hostel_room_id",
                "hostel_room_name", selected_room_id);
        }
        $('#hostel_floor_id').on('change', function() {
            var hostel_floor_id = $(this).val();

            initializeSelect2('hostel_room_id', {
                placeholder: "Select Floor ",
            }, "<?= base_url('ApiController/getRoomByFloor') ?>", {
                'hostel_floor_id': hostel_floor_id
            }, "hostel_room_id", "hostel_room_name");


        });
    });


    var function_url = base_url + "HostelAdmin/Insert_Update_HostelAllotment";
    var delete_url = base_url + 'HostelAdmin/delete_HostelAllotment';


    // function successCallback(response) {

    //     window.location.href = "</?= base_url('Hostel_Allotment') ?>";
    // }


    // function errorCallback(response) {
    //     debugger;
    //     console.log(response);

    // }





    function successCallback(response) {
        if (response.ApiResponseStatusCode === 200 || response.ApiResponseStatusCode === 201) {
            // Redirect only if successful
            window.location.href = "<?= base_url('HostelAdmin/Hostel_Allotment') ?>";
        } else {
            // Fallback in case of unexpected non-200/201 responses
            showSweetErrors(response);
        }
    }

    function errorCallback(response) {
        try {

            showSweetErrors(response);
        } catch (e) {
            Swal.fire('Error', 'Unexpected error occurred.', 'error');
        }
    }

    function showSweetErrors(response) {
        let errorList = '';

        if (response.errors) {
            for (const key in response.errors) {
                if (response.errors.hasOwnProperty(key)) {
                    errorList += `<li>${response.errors[key]}</li>`;
                }
            }
        }

        Swal.fire({
            icon: 'error',
            title: response.message || 'Validation Error',

        });
    }


    $(document).ready(function() {
        ShowHostelAllotmentData();
    });

    function ShowHostelAllotmentData(parameter = {}) {
        parameter['school_id'] = "<?= $_SESSION['emp_data_session']['emp_schoolid'] ?>"
        DataTableInitialized(
            'HostelRoomsAllotTable', // table_id
            "<?= base_url('HostelAdmin/getHostelAllotDataShowApi') ?>", // url
            'POST', // method
            parameter, // parameter
            successDataTableCallbackFunction // dataTableSuccessCallBack
        );
    }



    function successDataTableCallbackFunction(response) {
        var columns = [{
                title: "S.No.",
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + 1; // Returns the row index starting from 1
                },
                visible: true
            },
            {
                title: "USER ID",
                data: function(row) {
                    return row.empautonumber || row.stu_admission_id ||
                        'N/A'; // Display employee ID or student ID or N/A
                }
            },
            {
                title: "USER NAME",
                data: "unified_username" // Use the unified username field
            },
            {
                title: "CONTACT NO",
                data: function(row) {
                    return row.emp_contactno || row.stu_fathermobile ||
                        'N/A'; // Display employee contact or student father contact or N/A
                }
            },
            {
                title: "HOSTEL NAME",
                data: "hostel_name"
            },
            {
                title: "FLOOR NAME",
                data: "hostel_floor_name"
            },
            {
                title: "ROOM NO",
                data: "hostel_room_name"
            },
            {
                title: "Actions",
                data: null,
                render: function(data, type, row) {
                    var actionButtons = '';

                    // Check if student ID and student name exist
                    if (row.stu_admission_id && row.unified_username) {
                        actionButtons += `
                        <a data-bs-toggle="modal" onclick="AllotmentViewData(${row.alloted_id})" data-bs-target="#studentRegistrationModal" class="btn schl-btn-white">
                            <img width="40" height="40" src="https://img.icons8.com/clouds/100/checked--v1.png" alt="checked--v1" /> View Allotment
                        </a>
                    `;
                    }

                    // Additional action buttons that should be visible for both students and employees
                    actionButtons += `
                    <a href="<?= base_url('HostelAdmin/Hostel_Allotment') ?>/${row.alloted_id}">
                        <button type="button" class="btn p-0 me-0 ms-0" data-toggle="tooltip" data-placement="top" title="Edit">
                            <img width="40" height="40" src="https://img.icons8.com/clouds/100/edit-user.png" alt="edit-user"/>
                        </button>
                    </a>
                    <a onclick="CommonAjaxDelete('${row.hostel_room_name}', '${row.alloted_id}', delete_url, {swal: true, successCallback: successCallback, errorCallback: errorCallback});" data-toggle="tooltip" data-placement="top" title="Delete">
                        <img width="40" height="40" src="https://img.icons8.com/clouds/100/delete-forever.png" alt="delete-forever" />
                    </a>
                `;

                    return actionButtons;
                }
            }
        ];

        if (response.ApiResponseStatusCode == 200) {
            return {
                status: response.ApiResponseStatusCode,
                columns: columns,
                data: response.data
            };
        } else {
            return {
                status: response.ApiResponseStatusCode,
                columns: columns,
                data: []
            };
        }
    }




    // function StudentOninput() {
    //     var stu_emp_id = $('#stu_emp_id').val().trim().toUpperCase();

    //     // Define maximum lengths
    //     const maxLengthSTU = 14;
    //     const maxLengthEMP = 12;

    //     // Validate length based on prefix
    //     if (stu_emp_id.startsWith("STU")) {
    //         if (stu_emp_id.length > maxLengthSTU) {
    //             $('#stu_emp_id').val(stu_emp_id.substring(0, maxLengthSTU));
    //             stu_emp_id = $('#stu_emp_id').val();
    //         }
    //     } else if (stu_emp_id.startsWith("EMP")) {
    //         if (stu_emp_id.length > maxLengthEMP) {
    //             $('#stu_emp_id').val(stu_emp_id.substring(0, maxLengthEMP));
    //             stu_emp_id = $('#stu_emp_id').val();
    //         }
    //     }

    //     // Proceed with AJAX call if valid length
    //     if ((stu_emp_id.startsWith("STU") && stu_emp_id.length === maxLengthSTU) ||
    //         (stu_emp_id.startsWith("EMP") && stu_emp_id.length === maxLengthEMP)) {

    //         $.ajax({
    //             url: base_url + "HostelAdmin/getStudentDataByOninput",
    //             data: {
    //                 stu_emp_id: stu_emp_id,
    //             },
    //             type: "POST",
    //             success: function(response) {
    //                 if (response.ApiResponseStatusCode == 200 || response.ApiResponseStatusCode == 201) {
    //                     var studentData = response.data[0];

    //                     $('#alloted_student_id').val(studentData.student_id);



    //                     if (studentData.stu_academic_year) {
    //                         $('#academic_year_id').val(studentData.stu_academic_year);
    //                     }

    //                     if (studentData.employee_id) {
    //                         $('#alloted_employee_id').val(studentData.employee_id);
    //                     }



    //                     // else: Do nothing, retain the default value from PHP
    //                 } else {
    //                     toastr.error(response.message);
    //                 }
    //             },

    //             error: function(xhr, status, error) {
    //                 toastr.error('An error occurred: ' + error);
    //             }
    //         });
    //     }
    // }


    function loadStudentEmployeeList() {
        let type = $('#type').val();
        let school_id = "<?= $_SESSION['emp_data_session']['emp_schoolid'] ?>"


        $('#stu_emp_id').val('');
        $('#stu_emp_list').empty();

        if (type === '') {
            return;
        }

        $.ajax({
            url: base_url + "HostelAdmin/getStudentEmployeeList",
            type: "POST",
            data: {
                type: type,
                school_id: school_id
            },
            success: function(response) {

                if (response.ApiResponseStatusCode == 200) {
                    let options = '';

                    $.each(response.data, function(i, row) {

                        if (type === 'student') {
                            options += `
                          <option 
                            data-id="${row.stu_admission_id}" 
                            value="${row.studentfullname} (${row.stu_admission_id})">
                          </option>`;
                        }

                        if (type === 'employee') {
                            options += `
                          <option 
                            data-id="${row.empautonumber}" 
                            value="${row.emp_name} (${row.empautonumber})">
                          </option>`;
                        }
                    });

                    $('#stu_emp_list').html(options);
                }
            }
        });
    }



    function AllotmentViewData(alloted_id) {
        $.ajax({
            url: base_url + 'HostelAdmin/getAllotmentViewData',
            data: {
                alloted_id: alloted_id
            }, // Pass the ID as an object
            type: 'POST',
            success: function(response) {
                $("#View_AllotmentDataShow").html(response);
            }
        });
    }


    function check_hostelroom_available() {
        var hostel_room_id = $('#hostel_room_id').val(); // Corrected the selector
        $('#View_AvailableRoom').html('');
        $.ajax({
            url: base_url + 'HostelAdmin/check_hostelroom_available',
            data: {
                hostel_room_id: hostel_room_id
            },
            type: 'POST',
            success: function(response) {
                // Assuming response is JSON
                var data = typeof response === 'string' ? JSON.parse(response) : response;

                // Extract the available rooms data
                var availableRooms = response.data.available_rooms;

                // Display the data in the HTML element
                $('#View_AvailableRoom').html('<div class="fw-bold schl-text-blue">Available Bed = ' +
                    availableRooms + '</div>');


                // Hide or show the button based on available rooms
                var buttonContainer = $('#Allot_buttonId');
                if (availableRooms <= 0) {
                    buttonContainer.hide(); // Hide button container if no available rooms
                } else {

                    buttonContainer.show(); // Show button container if there are available rooms
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                $('#View_AvailableRoom').html(
                    '<div class="col-md-2 error schl-text-blue">An error occurred. Please try again.</div>');
                $('#Allot_buttonId').hide(); // Hide button container on error
            }
        });
    }


    $(document).ready(function() {
        // Trigger validation when the type is changed
        $('#type').on('change', function() {
            $('#stu_emp_id').val(''); // Clear the ID input when type is changed
            $('#error-type').text(''); // Clear previous error message
        });

        $('#stu_emp_id').on('input', function() {
            StudentOninput(); // Call the validation function on input
        });
    });

    

    function StudentOninput() {

        let inputVal = $('#stu_emp_id').val().trim();
        let selectedType = $('#type').val();

        if (inputVal === '') return;

        $('#error-type').text('');

        /* =====================
           STEP 1: Extract ID
           ===================== */
        let match = inputVal.match(/\(([^)]+)\)$/);

        // agar datalist se select hua
        if (!match) {
            return; // abhi full select nahi hua
        }

        let stu_emp_id = match[1].toUpperCase(); // STUxxxx / EMPxxxx

        // 🔥 ID ko hidden field me rakho
        $('#actual_stu_emp_id').val(stu_emp_id);

        /* =====================
           STEP 2: Prefix check
           ===================== */
        if (selectedType === 'student' && !stu_emp_id.startsWith("STU")) {
            $('#error-type').text('Invalid ID: For Students, ID must start with STU');
            return;
        }

        if (selectedType === 'employee' && !stu_emp_id.startsWith("EMP")) {
            $('#error-type').text('Invalid ID: For Employees, ID must start with EMP');
            return;
        }

        /* =====================
           STEP 3: Length check
           ===================== */
        const maxLengthSTU = 14;
        const maxLengthEMP = 12;

        if (
            (stu_emp_id.startsWith("STU") && stu_emp_id.length !== maxLengthSTU) ||
            (stu_emp_id.startsWith("EMP") && stu_emp_id.length !== maxLengthEMP)
        ) {
            return;
        }

        /* =====================
           STEP 4: AJAX
           ===================== */
        $.ajax({
            url: base_url + "HostelAdmin/getStudentDataByOninput",
            type: "POST",
            data: {
                stu_emp_id: stu_emp_id
            },
            success: function(response) {

                if (response.ApiResponseStatusCode == 200) {
                    let data = response.data[0] || {};

                    $('#alloted_student_id').val(data.student_id || '');
                    $('#alloted_employee_id').val(data.employee_id || '');
                   
                } else {
                    toastr.error(response.message);
                }
            },
            error: function() {
                toastr.error('An error occurred');
            }
        });
    }
</script>