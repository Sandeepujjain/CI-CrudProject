<style>
    .border-card {
        border: 2px solid #000;
    }

    .logo-image {
        width: auto;
        height: 30px;
        margin-right: 0.5rem;
    }

    .text-blue {
        color: blue;
    }
</style>
<div class="content_wrapper">
    <div class="myDiv" id="Library_registered"></div>
    <div class="row">
        <h4>Third Party Integration Page</h4>
        <?php if (isset($email_integration)): ?>
            <!-- email_integration -->
            <div class="container">
                <?php $this->load->view('MasterAdmin/ThirdPartyIntegration/integration_form', ['form_id' => 'email_integration', 'integration' => $email_integration]) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($sms_integration)): ?>
            <!-- sms_integration -->
            <div class="container">
                <?php $this->load->view('MasterAdmin/ThirdPartyIntegration/integration_form', ['form_id' => 'sms_integration', 'integration' => $sms_integration]) ?>
            </div>
        <?php endif; ?>
        <!-- googleoauth_integration -->
        <!-- <#?php if (isset($googleoauth_integration)): ?>
    <div class="container">
        <#?= view('MasterAdmin/ThirdPartyIntegration/integration_form', ['form_id' => 'googleoauth_integration', 'integration' => $googleoauth_integration]) ?>
    </div>
<#?php endif; ?> -->
        <?php if (isset($firebase_integration)): ?>
            <!-- firebase_integration -->
            <div class="container">
                <?php $this->load->view('MasterAdmin/ThirdPartyIntegration/integration_form', ['form_id' => 'firebase_integration', 'integration' => $firebase_integration]) ?>
            </div>
        <?php endif; ?>
        <?php if (isset($rozorpay_integration)): ?>
            <!-- rozorpay_integration -->
            <div class="container">
                <?php $this->load->view('MasterAdmin/ThirdPartyIntegration/integration_form', ['form_id' => 'rozorpay_integration', 'integration' => $rozorpay_integration]) ?>
            </div>
        <?php endif; ?>
        <?php if (isset($whatsapp_integration)): ?>
            <!-- whatsapp_integration -->
            <div class="container">
                <?php $this->load->view('MasterAdmin/ThirdPartyIntegration/integration_form', ['form_id' => 'whatsapp_integration', 'integration' => $whatsapp_integration]) ?>
            </div>
        <?php endif; ?>
        <?php if (isset($gps_integration)): ?>
            <!-- gps_integration -->
            <div class="container">
                <?php $this->load->view('MasterAdmin/ThirdPartyIntegration/integration_form', ['form_id' => 'gps_integration', 'integration' => $gps_integration]) ?>
            </div>
        <?php endif; ?>
    </div>

</div>


<script>
    function successCallback(response) {
        console.log(response);
    }

    function errorCallback(response) {
        console.log(response);
    }
</script>