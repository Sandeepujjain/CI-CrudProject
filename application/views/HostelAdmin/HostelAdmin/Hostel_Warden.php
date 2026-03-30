<!-- Add Hostel Warden start -->
<div class="content_wrapper">
    <div class="myDiv" id="Hostel_Warden">
        <div class="row">
            <div class="col d-flex">
                <h4 class="sub-heading"> <i class="fa-solid fa-square-plus m-1"></i> <span class="underline"><b>Hostel
                            Warden</b> <i class="fa-solid fa-circle"></i></span> </h4>
                <nav aria-label="breadcrumb" class="ms-3">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href=""><img height="15"
                                    width="15" class="mb-1"
                                    src="<?php echo base_url('assets/images/schoolicon2.png'); ?>"></a></li>
                        <li class="breadcrumb-item"><a href="#">Hostel Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Warden</li>
                    </ol>
                </nav>
            </div>
        </div>
        <form action="<?php echo base_url('MasterAdmin/'); ?>" enctype="multipart/form-data" method="post"
            novalidate="novalidate">
            <div class="card schl-btn-lgreen p-2">
                <div class="row align-items-end">
                    <div class="col-2">
                        <div class="mb-2">
                            <input type="text" class="form-control" id="all_audit_date" placeholder="Warden Name " />
                            <label for="all_audit_date" class="form-label"><i class="fa-regular fa-pen-to-square"></i> Warden Name</label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="mb-2">
                            <input type="time" class="form-control" id="all_audit_date" placeholder="From Time " />
                            <label for="all_audit_date" class="form-label"><i  class="fa-regular fa-pen-to-square"></i> From Time</label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="mb-2">
                            <input type="time" class="form-control" id="all_audit_date" placeholder="To Time" />
                            <label for="all_audit_date" class="form-label"><i class="fa-regular fa-pen-to-square"></i> To Time</label>
                        </div>
                    </div>
                    <div class="col text-end">
                        <button type="submit" class="btn schl-btn-white p-2">
                            Add Warden
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row mt-2">
            <div class="col">
                <table class="table table-responsive table-striped table-hover table-sm school-table"
                    id="mytable_LibRack">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>WARDEN NAME</th>
                            <th>FROM TIME</th>
                            <th>TO TIME</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>ABC</td>
                            <td>10:00</td>
                            <td>12:00</td>
                            <td>
                                <a href="<?php echo base_url('HostelAdmin/view_profile_emp'); ?>">
                                    <button type="button" class="btn"
                                        onclick="Viewemp_divshow(<?= $val->employee_id ?>)" data-toggle="tooltip"
                                        data-placement="top" title="View Profile">
                                        <img width="40" height="40"
                                            src="https://img.icons8.com/clouds/100/search-in-list.png"
                                            alt="search-in-list" />
                                    </button>
                                </a>
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#Hostel_UpdateWarden" onclick="updaterack(<?= $val->rack_id ?>)"
                                    data-toggle="tooltip" data-placement="top" title="Edit">
                                    <img width="40" height="40" src="https://img.icons8.com/clouds/100/edit-user.png"
                                        alt="edit-user" />
                                </button>
                                <a href="<?php echo base_url('MasterAdmin/delete_rack/') . $val->rack_id; ?>"
                                    onclick="return confirm('Confirm You Want To Delete  ?');" data-toggle="tooltip"
                                    data-placement="top" title="Delete">
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
<!-- Add Hostel Warden ends -->

<!-- Modal Hostel Warden  -->
<div class="modal fade" id="Hostel_UpdateWarden" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row modal-title align-items-end mt-1 w-100">
                    <div class="col-11">
                        <i class="fa-regular fa-pen-to-square me-2"></i><span>Update Warden</span>
                    </div>
                    <div class="col text-end  p-0">
                        <button type="button" class="btn-close myfont" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>                    
            </div>
            <div class="modal-body p-0">
                <div class="row row-cols-auto bordery mb-1 p-1 m-0">
                    <div class="col">
                        <img src="<?php echo base_url('assets/images/Sir23.jpg'); ?>" height="40" class="rounded" alt="Cinque Terre">
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-12 text-start">
                                <span class="mycolor2">Rajesh Kumar</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mycolor">
                                EMP002023
                            </div>
                        </div>
                    </div>
                    <div class="col text-end myfont mb-3">
                        <span class="mycolor">12-02-2023</span>
                    </div>
                </div>
                <div class="p-2">
                    <div class="row mt-2">
                        <div class="col">
                            <div class="mb-2">
                                <select class="form-select" name="rack_room" id="" required>
                                    <option value="" disabled selected></option>
                                    <?php foreach ($Libraryroomshow as $val) { ?>
                                        <option value="<?php echo $val->library_room_id ?>">
                                            <?php echo $val->library_room_no ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                
                                
                                <label class="form-label">Hostel Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <!-- <div class="col mt-2">
                            <input type="hidden" name="Edit_rackid" id="Edit_rackid">
                            <input type="text" id="Edit_rackno" name="Edit_rackno" class="form-control valid filled " placeholder="Warden" aria-invalid="false">
                        </div> -->
                        <div class="col">
                            <div class="mb-2">
                                <input type="text" class="form-control" id="Warden_modal_warden_name" placeholder="Warden Name " />
                                <label for="Warden_modal_warden_name" class="form-label"><i class="fa-regular fa-pen-to-square me-2"></i> Warden Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="mb-2">
                                <input type="time" class="form-control" id="Warden_modal_from_time" placeholder="From Time " />
                                <label for="Warden_modal_from_time" class="form-label"><i class="fa-regular fa-pen-to-square me-2"></i> From Time</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <input type="time" class="form-control" id="Warden_modal_To_time" placeholder="To Time " />
                                <label for="Warden_modal_To_time" class="form-label"><i class="fa-regular fa-pen-to-square me-2"></i> To Time</label>
                            </div>
                        </div>
                    </div>
                    <div class="col mt-2 text-end">
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
<!-- Ends Modal Floor Warden -->