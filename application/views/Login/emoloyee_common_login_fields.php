<form action="" id="employee_login_form" method='post' data-messages="f_messages" data-rules="f_rules">

    <div class="form-floating mb-4">
        <input type="text" class="form-control" name="software_deployment_project_code"
            id="software_deployment_project_codes" placeholder="Enter ACCESS Code" required>
        <span class="error-message" id="software_deployment_project_code-error"></span>

        <label for="accessgroupcode">ACCESS CODE</label>
        <i class="fa-regular fa-user"></i>
    </div>
    <div class="form-floating mb-4">
        <input type="text" class="form-control" name="username" id="usernames" placeholder="Enter Username" required>
        <span class="error-message" id="username-error"></span>
        <label for="usernames">EMPLOYEE ID</label>
        <i class="fa-regular fa-user"></i>
    </div>
    <div class="">
        <button type="button" class="btn schl-btn-green w-100" class="text-center" id="nextButton">Next</button>
    </div>
    <div class="form-floating mb-4 d-none">
        <input type="text" class="form-control" name="otp" id="otps" placeholder="Enter otp" required>
        <span class="error-message" id="otp-error"></span>
        <label for="opt">OTP</label>
        <i class="fa-regular fa-otp"></i>
    </div>
    <div class="form-floating mb-3 d-none">
        <input type="password" class="form-control" id="password" name="password" placeholder="*******" required>
        <span class="error-message" id="password-error"></span>

        <label >PASSWORD</label>
        <i class="fa-solid fa-eye position-absolute" id="togglePassword"
            style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
        </i>
    </div>
    <div class="form-check d-none">
        <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe">
        <label class="form-check-label" for="rememberMe">
            Remember Me?
        </label>
    </div>
    <div class="d-none">
        <a class="form-check-label text-primary text-decoration-none" id="forgetPassword">
            Forget Password?
        </a>
    </div>

    <div class="d-none">
        <button type="button"
            onclick="CommonAjaxWithValidation('Login','Login','employee_login_form', function_url, {toastr: true, successCallback: successCallback, errorCallback: errorCallback,swal_confirmation_bypass:true})"
            class="btn schl-btn-green w-100" class="text-center" id="loginButton">
            LOGIN
        </button>
    </div>
</form>


<script>
    $(document).ready(function() {
        // Hide entire parent divs for OTP, password, rememberMe, and login button
        // $('#otps, #password, #rememberMe, #loginButton').closest('div').addClass('d-none');
        $(document).keydown(function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent default Enter key behavior
                // Check visibility of loginButton
                if ($('#loginButton').is(':visible')) {
                    $('#loginButton').click(); // Trigger login button if visible
                } else if ($('#nextButton').is(':visible')) {
                    $('#nextButton').click(); // Trigger next button if visible
                }
            }
        });
        $('#nextButton').on('click', function() {
            var software_deployment_project_code = $('#software_deployment_project_codes').val()
            const formData = {
                username: $('#usernames').val(),
                software_deployment_project_code: software_deployment_project_code
            };
            $.ajax({
                url: base_url + 'NoAuthApiController/checkEmployeeTwoFactorAuthentication',
                type: 'POST',
                data: JSON.stringify(formData),
                contentType: 'application/json',
                success: function(response) {
                    if (response.ApiResponseStatusCode === 200) {
                        toastr.success(response.message);

                        // Hide next button and make fields readonly
                        $('#nextButton').addClass('d-none');
                        $('#usernames, #software_deployment_project_codes').prop('readonly', true);

                        // Show OTP, password, and login button
                        if (response.data.is_two_factor_enabled) {
                            $('#otps').closest('div').removeClass('d-none');
                        }
                        $('#password, #rememberMe, #loginButton').closest('div').removeClass('d-none');

                        const encodedPayload = {
                            software_deployment_project_code: software_deployment_project_code
                        };
                        // ===============================
                        // To enable "Forget Password" functionality:
                        // 1. Uncomment the following lines
                        // 2. This will generate the encoded URL and set it in the forget password link
                        // 3. Also make sure to unhide #forgetPassword if needed
                        // ===============================

                        // Convert to base64 and URL encode
                        const encodedData = encodeURIComponent(btoa(JSON.stringify(encodedPayload)));

                        // Set the URL in the "Forget Password" link
                        $('#forgetPassword').attr('href', base_url + 'Login/forgetpassword?data=' + encodedData);

                        // Show the forget password link
                        $('#forgetPassword').closest('div').removeClass('d-none');

                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    // $('#nextButton').addClass('d-none'); // Ensure button hides even on error
                    // $('#usernames, #software_deployment_project_codes').prop('readonly', true);
                    toastr.error('An error occurred while checking employee data.');
                }
            });
        });
    });
</script>
