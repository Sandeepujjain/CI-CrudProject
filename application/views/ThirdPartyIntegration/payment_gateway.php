<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 24px;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:checked+.slider:before {
    transform: translateX(26px);
  }
</style>

<div class="content_wrapper">
  <div class="row">

    <!-- ================= RAZORPAY FORM ================= -->
    <div class="col-md-6">
      <div class="card shadow-sm mb-3">
        <div class="card-header fw-bold">Razorpay Payment Gateway</div>
        <div class="card-body">
          <form id="razorpay_form">
            <input type="hidden" name="payment_gateway_id" value="<?= @$razor_pay_data['payment_gateway_id'] ?>">
            <input type="hidden" name="school_id" value="<?= $_SESSION['emp_data_session']['emp_schoolid'] ?>">
            <input type="hidden" name="payment_gateway_type" value="RAZORPAY">

            <div class="mb-2">
              <label class="form-label">API Key</label>
              <input type="text" class="form-control" name="payment_gateway_razorpay_api_key"
                value="<?= @$razor_pay_data['payment_gateway_razorpay_api_key'] ?>">
              <span class="error-message text-danger" id="payment_gateway_razorpay_api_key-error"></span>
            </div>

            <div class="mb-2">
              <label class="form-label">API Secret Key</label>
              <input type="text" class="form-control" name="payment_gateway_razorpay_api_secret_key"
                value="<?= @$razor_pay_data['payment_gateway_razorpay_api_secret_key'] ?>">
              <span class="error-message text-danger" id="payment_gateway_razorpay_api_secret_key-error"></span>
            </div>

            <div class="mb-2">
              <label class="form-label">Is production</label><br>
              <label class="switch">
                <input type="checkbox" id="razorpay_is_production" name="is_production" value="1" <?= (@$razor_pay_data['is_production'] == 1) ? 'checked' : '' ?>>

                <span class="slider"></span>
              </label>
              <span class="error-message text-danger" id="is_production-error"></span>
            </div>

            <div class="mb-2">
              <label class="form-label">Is Active</label><br>
              <label class="switch">
                <input type="checkbox" name="is_active"
                  value="1" <?= (@$razor_pay_data['is_active'] == 1) ? 'checked' : '' ?>>
                <span class="slider"></span>
              </label>
              <span class="error-message text-danger" id="is_active-error"></span>
            </div>

            <div class="text-end mt-3">
              <?php $btn = !empty($razor_pay_data) ? 'UPDATE' : 'SAVE'; ?>
              <button type="button" class="btn schl-btn-white"
                onclick="CommonAjaxWithValidation(
                  'Confirm ?',
                  '<?= $btn ?>',
                  'razorpay_form',
                  '<?= base_url('PageController/save_payment_gateway') ?>',
                  {toastr:true,successCallback:successCallback,errorCallback:errorCallback}
                )">
                <b><?= $btn ?></b>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- ================= CCAVENUE FORM ================= -->
    <div class="col-md-6">
      <div class="card shadow-sm mb-3">
        <div class="card-header fw-bold">CCAvenue Payment Gateway</div>
        <div class="card-body">
          <form id="ccavenue_form">
            <input type="hidden" name="payment_gateway_id" value="<?= @$ccavenue_data['payment_gateway_id'] ?>">
            <input type="hidden" name="school_id" value="<?= $_SESSION['emp_data_session']['emp_schoolid'] ?>">
            <input type="hidden" name="payment_gateway_type" value="CCAVENUE">

            <div class="mb-2">
              <label class="form-label">Merchant ID</label>
              <input type="text" class="form-control" name="payment_gateway_ccavenue_merchant_id"
                value="<?= @$ccavenue_data['payment_gateway_ccavenue_merchant_id'] ?>">
              <span class="error-message text-danger" id="payment_gateway_ccavenue_merchant_id-error"></span>
            </div>

            <div class="mb-2">
              <label class="form-label">Access Code</label>
              <input type="text" class="form-control" name="payment_gateway_ccavenue_access_code"
                value="<?= @$ccavenue_data['payment_gateway_ccavenue_access_code'] ?>">
              <span class="error-message text-danger" id="payment_gateway_ccavenue_access_code-error"></span>
            </div>

            <div class="mb-2">
              <label class="form-label">Working Key</label>
              <input type="text" class="form-control" name="payment_gateway_ccavenue_working_key"
                value="<?= @$ccavenue_data['payment_gateway_ccavenue_working_key'] ?>">
              <span class="error-message text-danger" id="payment_gateway_ccavenue_working_key-error"></span>
            </div>

            <div class="mb-2">
              <label class="form-label">Is Production</label><br>
              <label class="switch">
                <input type="checkbox" id="ccavenue_is_production" name="is_production" value="1" <?= (@$ccavenue_data['is_production'] == 1) ? 'checked' : '' ?>>

                <span class="slider"></span>
              </label>
              <span class="error-message text-danger" id="is_production-error"></span>
            </div>

            <div class="mb-2">
              <label class="form-label">Is Active</label><br>
              <label class="switch">
                <input type="checkbox" name="is_active"
                  value="1" <?= (@$ccavenue_data['is_active'] == 1) ? 'checked' : '' ?>>
                <span class="slider"></span>
              </label>
              <span class="error-message text-danger" id="is_active-error"></span>
            </div>

            <div class="text-end mt-3">
              <?php $btn = !empty($ccavenue_data) ? 'UPDATE' : 'SAVE'; ?>
              <button type="button" class="btn schl-btn-white"
                onclick="CommonAjaxWithValidation(
                  'Confirm ?',
                  '<?= $btn ?>',
                  'ccavenue_form',
                  '<?= base_url('PageController/save_payment_gateway') ?>',
                  {toastr:true,successCallback:successCallback,errorCallback:errorCallback}
                )">
                <b><?= $btn ?></b>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
  function successCallback(response) {
    if (response.ApiResponseStatusCode == 200 || response.ApiResponseStatusCode == 201) {
      location.reload();
    }
  }

  function errorCallback(response) {
    console.log(response);
  }

  document.addEventListener('DOMContentLoaded', function() {

    const razorpayProd = document.getElementById('razorpay_is_production');
    const ccavenueProd = document.getElementById('ccavenue_is_production');

    const razorpayActive = document.querySelector('#razorpay_form input[name="is_active"]');
    const ccavenueActive = document.querySelector('#ccavenue_form input[name="is_active"]');

    /* ================= PRODUCTION TOGGLE ================= */
    razorpayProd?.addEventListener('change', function() {
      if (this.checked) {
        ccavenueProd.checked = false;
        toastr.info('Only one Payment Gateway can be Production at a time');
      }
    });

    ccavenueProd?.addEventListener('change', function() {
      if (this.checked) {
        razorpayProd.checked = false;
        toastr.info('Only one Payment Gateway can be Production at a time');
      }
    });

    /* ================= ACTIVE TOGGLE ================= */
    razorpayActive?.addEventListener('change', function() {
      if (this.checked) {
        ccavenueActive.checked = false;
        toastr.info('Only one Payment Gateway can be Active at a time');
      }
    });

    ccavenueActive?.addEventListener('change', function() {
      if (this.checked) {
        razorpayActive.checked = false;
        toastr.info('Only one Payment Gateway can be Active at a time');
      }
    });

  });
</script>