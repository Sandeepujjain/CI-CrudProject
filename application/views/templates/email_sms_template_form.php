<div class="card border-card">
    <form id="<?= $template_type ?>" data-messages="f_messages" data-rules="f_rules" method="post"
        enctype="multipart/form-data">
        <input type="hidden" name="template_id" value="<?= $template_id ?>">
        <!-- Card Header with Logo -->
        <div class="card-header">
            <div class="row">
                <div class="col-9">
                    <h3 class="mb-0"><?= $template_heading ?></h3>
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-outline-info"
                        onclick="modalCreateAndShow('<?= $template_id ?>','<?= $template_heading ?> Placeholders','<?= $template_placeholder ?>')">Placeholder</button>
                </div>
            </div>
        </div>
        <!-- Card Body -->
            <div class="card-body">
                    <div class="shadow-sm p-5 mb-5 rounded">
                        <h5 class="text-blue">Email Template</h5>
                        <div class="row">
                            <div class="form-group col-12 mb-3">
                                <label class="form-label" for="email_subject">Email Subject</label>
                                <input type="text" placeholder="Email Subject" id="email_subject" name="email_subject"
                                    class="form-control" value="<?= @$email_subject ?>">
                                <span class="error-message" id="email_subject-error"></span>
                            </div>

                            <div class="form-group col-12 mb-3">
                                <label class="form-label" for="email_cc">Email CC</label>
                                <input type="email" placeholder="Email CC" id="email_cc" name="email_cc"
                                    class="form-control" value="<?= @$email_cc ?>">
                                <span class="error-message" id="email_cc-error"></span>
                            </div>

                            <div class="form-group col-12 mb-3">
                                <label class="form-label" for="email_body">Email Body</label>
                                <textarea type="text" placeholder="Email Body" id="email_body" name="email_body"
                                    class="form-control ckeditor"><?= @$email_body ?></textarea>
                                <span class="error-message" id="email_body-error"></span>
                            </div>
                            <div class="d-flex">
                                <div class="form-check form-switch mb-3 w-50">
                                    <input type="hidden" name="email_attachment" value="0">
                                    <input class="form-check-input" type="checkbox" id="email_attachment"
                                        name="email_attachment" <?= ($email_attachment == 1) ? "checked" : "" ?>>
                                    <label for="email_attachment">Email Attachment</label>
                                </div>
                                <div class="form-check form-switch mb-3 w-50">
                                    <input type="hidden" name="email_send" value="0">
                                    <input class="form-check-input" type="checkbox" id="email_send" name="email_send"
                                        <?= ($email_send == 1) ? "checked" : "" ?>>
                                    <label for="email_send">Send Email</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SMS -->
                    <div class="shadow-sm p-5 mb-5 rounded">
                        <h5 class="text-blue">Sms Mode</h5>
                        <div class="row">
                            <div class="form-group col-12 mb-3">
                                <label class="form-label" for="sms_template_name">Sms Template Name</label>
                                <input type="text" placeholder="Sms Template Name" id="sms_template_name"
                                    name="sms_template_name" class="form-control" value="<?= @$sms_template_name ?>">
                                <span class="error-message" id="sms_template_name-error"></span>
                            </div>

                            <div class="form-group col-12 mb-3">
                                <label class="form-label" for="sms_dlt_id">Sms DLT Template ID</label>
                                <input type="text" placeholder="Sms Message" id="sms_dlt_id" name="sms_dlt_id"
                                    class="form-control" value="<?= @$sms_dlt_id ?>">
                                <span class="error-message" id="sms_dlt_id-error"></span>
                            </div>

                            <div class="form-group col-12 mb-3">
                                <label title="Each Sms Length 160 Character including Space" class="form-label"
                                    for="sms_message">Sms Message</label>
                                <textarea placeholder="Sms Message" rows="5" id="sms_message" name="sms_message"
                                    class="form-control sms-textarea"><?= @$sms_message ?></textarea>
                                <span class="error-message" id="sms_message-error"></span>
                            </div>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="sms_send" value="0">
                                    <input class="form-check-input" type="checkbox" id="sms_send" name="sms_send"
                                        <?= ($sms_send == 1) ? "checked" : "" ?>>
                                    <label for="sms_send">Send Sms</label>
                                </div>
                        </div>
                    </div>

                     <!-- Notification -->
                     <div class="shadow-sm p-5 mb-5 rounded">
                        <h5 class="text-blue">Notification Mode</h5>
                        <div class="row">
                            <div class="form-group col-12 mb-3">
                                <label class="form-label" for="notification_title">Notification Title</label>
                                <input type="text" placeholder="Notification Title" id="notification_title"
                                    name="notification_title" class="form-control" value="<?= @$notification_title ?>">
                                <span class="error-message" id="notification_title-error"></span>
                            </div>

                            <div class="form-group col-12 mb-3">
                                <label class="form-label" for="notification_body">Notification Body</label>
                                <textarea type="text" placeholder="Notification Body" id="notification_body" name="notification_body"
                                    class="form-control ckeditor"><?= @$notification_body ?></textarea>
                                <span class="error-message" id="notification_body-error"></span>
                            </div>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="notification_send" value="0">
                                    <input class="form-check-input" type="checkbox" id="notification_send" name="notification_send"
                                        <?= ($notification_send == 1) ? "checked" : "" ?>>
                                    <label for="notification_send">Send Notification</label>
                                </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <div class="col-12">
                    <?php $button = "Save " .@$template_heading . " Setting"?>
                    <button type="button" class="btn schl-btn-white"
                        onclick="CommonAjaxWithValidation('Email Sms Template?','<?= $button ?>','<?=$template_type?>', function_url,{toastr:true,successCallback:successCallback,errorCallback:errorCallback})">
                        <img width="35" height="35" src="https://img.icons8.com/clouds/100/checkmark--v1.png"
                            alt="checkmark--v1" />
                        <b><?= $button ?></b>
                    </button>
                </div>
            </div>
    </form>
</div>

<script>
    var function_url = base_url + "MasterAdmin/insertUpdateEmailSmsTemplate";
    function successCallback(response) {
        location.reload();
        window.location.href = `<?= base_url('PageController/template') ?>`
    }

    function errorCallback(response) {
        console.log(response);
    }
</script>