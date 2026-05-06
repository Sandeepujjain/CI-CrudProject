<!DOCTYPE html>
<html>

<head>
    <title>Employee Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="<?php echo base_url('assets/js/masterAdmin.js'); ?>"></script>

</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">

                <h3 class="text-center">Login</h3>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <form id="StockLoginFormId" method="post">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required autocomplete="email">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required autocomplete="current-password">
                    </div>
                    <button type="button"
                        onclick="CommonAjaxWithValidation('Login','Login','StockLoginFormId', function_url, {toastr: true, successCallback: successCallback, errorCallback: errorCallback,swal_confirmation_bypass:true})"
                        class="btn schl-btn-green w-100" class="text-center" id="">
                        LOGIN
                    </button>


                    <div id="error-message" class="text-danger mt-2"></div>
                </form>

            </div>
        </div>
    </div>

</body>

</html>


<script>
    var base_url = "<?= base_url() ?>";
    var function_url = base_url + "LoginController/employee_login";

    function successCallback(response) {
        // ✅ CORRECTED: Use base_url variable
        window.location.href = base_url + "LoginController/StockProductDashboard";
    }

    function errorCallback(response) {
        console.log(response);
    }
</script>