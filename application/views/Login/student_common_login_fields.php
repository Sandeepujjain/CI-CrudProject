<form action="" id="student_login_form" method='post'>

  <div class="form-floating mb-4">
    <input type="text" class="form-control" name="software_deployment_project_code"
      id="software_deployment_project_code" placeholder="Enter Acces Code">
    <span class="error-message" id="software_deployment_project_code-error"></span>

    <label for="accessgroupcode">ACCESS CODE</label>
    <i class="fa-regular fa-user"></i>
  </div>

  <div class="form-floating mb-4">
    <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username">
    <span class="error-message" id="username-error"></span>
    <label for="username">STUDENT ID</label>
    <i class="fa-regular fa-user"></i>
  </div>

  <div class="">
    <button type="button" class="btn schl-btn-green w-100" class="text-center" id="nextButton">Next</button>
  </div>

  <div class="form-floating mb-4 d-none">
    <input type="text" class="form-control" name="otp" id="otp" placeholder="Enter otp" required>
    <span class="error-message" id="otp-error"></span>
    <label for="opt">OTP</label>
    <i class="fa-regular fa-otp"></i>
  </div>
  <div class="form-floating mb-3 d-none">
    <input type="password" class="form-control" id="password" name="password" placeholder="*******">
    <span class="error-message" id="password-error"></span>
    <label >PASSWORD</label>
    <i class="fa-solid fa-eye position-absolute" id="togglePassword"
      style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
  </div>
  <div class="row row-cols-auto justify-content-between mb-3 mx-0 d-none">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe">
      <label class="form-check-label" for="rememberMe">
        Remember Me?
      </label>
    </div>

  </div>
  <div class="d-none">
    <button type="button"
      onclick="CommonAjaxWithValidation('Login','Login','student_login_form', function_url, {toastr: true, successCallback: successCallback, errorCallback: errorCallback,swal_confirmation_bypass:true})"
      class="btn schl-btn-green w-100" class="text-center" id="loginButton">
      LOGIN
    </button>
  </div>
</form>


<script>
  $(document).ready(function () {
    // Hide entire parent divs for OTP, password, rememberMe, and login button
    // $('#otp, #password, #rememberMe, #loginButton').closest('div').addClass('d-none');

    $(document).keydown(function (event) {
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

    $('#nextButton').on('click', function () {
      const formData = {
        username: $('#username').val(),
        software_deployment_project_code: $('#software_deployment_project_code').val()
      };

      $.ajax({
        url: base_url + 'NoAuthApiController/checkStudentTwoFactorAuthentication',
        type: 'POST',
        data: JSON.stringify(formData),
        contentType: 'application/json',
        success: function (response) {
          if (response.ApiResponseStatusCode === 200) {
            toastr.success(response.message);

            // Hide next button and make fields readonly
            $('#nextButton').addClass('d-none');
            $('#username, #software_deployment_project_code').prop('readonly', true);

            // Show OTP, password, and login button
            if (response.data.is_two_factor_enabled) {
              $('#otp').closest('div').removeClass('d-none');
            }

            $('#password, #rememberMe, #loginButton').closest('div').removeClass('d-none');
          } else {
            toastr.error(response.message);
          }
        },
        error: function () {
          // $('#nextButton').addClass('d-none'); // Ensure button hides even on error
          // $('#usernames, #software_deployment_project_codes').prop('readonly', true);
          toastr.error('An error occurred while checking employee data.');
        }
      });
    });
  });


</script>
