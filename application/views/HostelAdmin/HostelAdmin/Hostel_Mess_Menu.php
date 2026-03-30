<!-- Hostel menu STart -->
<div class="content_wrapper">
    <div class="myDiv" id="Hos_Menu">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="sub-heading">
                    <i class="fa-solid fa-square-plus m-1"></i>
                    <span class="underline"><b>Mess</b>
                        <i class="fa-solid fa-circle"></i></span>
                </h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href=""><img height="15" width="15" class="mb-1"
                                    src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a></li>
                        <li class="breadcrumb-item"><a href="#">Hostel Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Mess Menu</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card schl-btn-lgreen pb-3 px-0">
            <div class="card-header schl-text-green">
                Filter
            </div>
            <form id="hostelmess_formid">
                <div class="row input_field_wrapper px-3">
                    <div class="col-md-2 mb-2">
                        <!-- <input type="text" name="school_id" value="</?= $_SESSION['emp_data_session']['emp_schoolid'] ?>"> -->
                        <input type="hidden" name="hostel_mess_id" id="hostel_mess_id" value="<?= @$hostel_mess_id ?>">
                        <div>
                            <label class="form-label">Hostel <span class="text-danger">*</span> </label>
                            <?= selectHostel(
                                [
                                    'select_name' => 'hostel_id',
                                    'select_id' => 'hostel_id',
                                    'option_label' => "Select Hostel",
                                    'select_classes' => 'form-select',
                                    'option_selected' => "$hostel_id",
                                    "select_attribute" => "",
                                ],
                                [
                                    'hostel_school' => $_SESSION['emp_data_session']['emp_schoolid']
                                ]

                            ) ?>
                            <span class="error-message" id="hostel_id-error"></span>
                        </div>
                    </div>

                    <div class="col-md-2 mb-2">
                        <label for="hostel_mess_date" class="form-label">Date <span class="text-danger">*</span>
                        </label>
                        <input type="date" class="form-control" id="hostel_mess_date" name="hostel_mess_date"
                            value="<?= @$hostel_mess_date ?>" placeholder=Date />
                        <span class="error-message" id="hostel_mess_date-error"></span>
                    </div>
                    <div class="col-md-5 mb-2">
                        <div class="row multiple_dish">
                            <div class="col-md-12">
                                <label for="hostel_mess_dishname" class="form-label"> Dish Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="hostel_mess_dishname"
                                    name="hostel_mess_dishname" value="<?= @$hostel_mess_dishname ?>"
                                    placeholder="Dish Name" />
                                <span class="error-message" id="hostel_mess_dishname-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2 text-end">
                        <?php $message = !empty(@$hostel_mess_id) ? 'Update' : 'Save' ?>
                        <button type="button"
                            onclick="CommonAjaxWithValidation('<?= $message ?> Dish ?','<?= $message ?>','hostelmess_formid', function_url, {swal: true, successCallback: successCallback, errorCallback: errorCallback})"
                            class="btn schl-btn-white mt-4">
                            <img width="40" height="40" src="https://img.icons8.com/clouds/100/checked--v1.png"
                                alt="checked--v1" /> <?= !empty(@$hostel_mess_id) ? 'Update' : 'Save' ?>
                        </button>
                    </div>

                </div>
            </form>
        </div>

        <div class="card mt-2">
            <div class="card-header schl-text-green">
                Hostel Mess Menu
            </div>
            <div class="row table_width">
                <div class="col">
                    <table class="table table-responsive table-striped table-hover school-table-1 table-sm"
                        id="HostelMessMenuTable">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Hostel menu End -->

<!-- Edit Hostel Menu modal popup end -->
<div class="modal fade" id="editmenutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row modal-title align-items-end mt-1 w-100">
                    <div class="col-11">
                        <i class="fa-regular fa-pen-to-square me-2"></i><span>Update Menu</span>
                    </div>
                    <div class="col text-end  p-0">
                        <button type="button" class="btn-close myfont" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <div class="modal-body p-0">
                <div class="row align-items-end bordery mb-1 p-1 m-0">
                    <div class="col">
                        <span class="mycolor2">Hostel Name</span>
                    </div>
                    <div class="col text-end myfont">
                        <span class="mycolor">12-02-2023</span>
                    </div>
                </div>
                <div class="p-2">
                    <div class="card schl-btn-lgreen p-2">
                        <div class="row input_field_wrapper align-items-end">
                            <div class="col-md-3 mb-3">
                                <div class="mb-2">
                                    <input type="date" class="form-control" id="hos_menu_dish" placeholder="date" />
                                    <label for="hos_menu_dish" class="form-label"><i
                                            class="fa-regular fa-pen-to-square "></i> date</label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="hos_menu_dish"
                                        placeholder="Enter Fee" />
                                    <label for="hos_menu_dish" class="form-label"><i
                                            class="fa-regular fa-pen-to-square "></i> Enter Fee</label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="mb-2">
                                    <select class="select-text   " name="" required>
                                        <option value="" disabled selected></option>
                                        <option value="July to December">July to December</option>
                                    </select>


                                    <label class="form-label">Select Session</label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="hos_menu_dish"
                                        placeholder="Enter Fee" />
                                    <label for="hos_menu_dish" class="form-label"><i
                                            class="fa-regular fa-pen-to-square "></i> Enter Fee</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <select class="select-text   " name="" required>
                                        <option value="" disabled selected></option>
                                        <option value="January to June">January to June</option>
                                    </select>


                                    <label class="form-label">Select Session</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="hos_menu_dish"
                                        placeholder="Enter Fee" />
                                    <label for="hos_menu_dish" class="form-label"><i
                                            class="fa-regular fa-pen-to-square "></i> Enter Fee</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <select class="form-select" name="" required>
                                        <option value="" disabled selected></option>
                                        <option value="Caution">Caution</option>
                                    </select>


                                    <label class="form-label">Caution</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="hos_menu_dish"
                                        placeholder="enter fee" />
                                    <label for="hos_menu_dish" class="form-label"><i
                                            class="fa-regular fa-pen-to-square "></i> Enter Fee</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
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
    </div>
</div>
<!-- Edit Hostel Menu modal popup end -->


<script>
var function_url = base_url + "HostelAdmin/Insert_Update_HostelMess";
var delete_url = base_url + 'HostelAdmin/delete_HostelMess';

function successCallback(response) {
    window.location.href = "<?= base_url('HostelMessMenu') ?>";
}

function errorCallback(response) {
    console.log(response);
}


$(document).ready(function() {
    HostelMessShowData();
});

function HostelMessShowData(parameter = {}) {
    // var school_id = "</?= $_SESSION['emp_data_session']['emp_schoolid'] ?>";
    var hostel_id = $('#hostel_id').val();
    var hostel_mess_date = $('#hostel_mess_date').val();
    var parameter = {
        'hostel_id': hostel_id,
        // 'school_id': school_id,
        'hostel_mess_date': hostel_mess_date,

    }
    DataTableInitialized(
        'HostelMessMenuTable', // table_id
        "<?= base_url('HostelAdmin/getHostelMessData') ?>", // url
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
            title: "HOSTEL NAME",
            data: "hostel_name"
        },
        {
            title: "DATE",
            data: "hostel_mess_date"
        },

        {
            title: "DISH NAME",
            data: "hostel_mess_dishname"
        },
        {
            title: "Actions",
            data: null,
            render: function(data, type, row) {
                var encoded_id = btoa(row.alloted_id); // Encode the ID
                return `
               
                <a href="<?= base_url('HostelAdmin/HostelMessMenu') ?>/${row.hostel_mess_id}">
                    <button type="button" class="btn p-0 me-0 ms-0" data-toggle="tooltip" data-placement="top" title="Edit">
                        <img width="40" height="40" src="https://img.icons8.com/clouds/100/edit-user.png" alt="edit-user"/>
                    </button>
                </a>
                <a onclick="CommonAjaxDelete('${row.hostel_mess_dishname}', '${row.hostel_mess_id}', delete_url, {swal: true, successCallback: successCallback, errorCallback: errorCallback});" data-toggle="tooltip" data-placement="top" title="Delete">
                    <img width="40" height="40" src="https://img.icons8.com/clouds/100/delete-forever.png" alt="delete-forever" />
                </a>
                `;
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
</script>