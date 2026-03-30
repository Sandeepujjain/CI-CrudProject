<?php
$css_file = !empty($software_deployment_css_file_name) ? $software_deployment_css_file_name : 'loginstyle.css';
$background_image = !empty($software_deployment_background_image) && file_exists(FCPATH . 'assets/login_images/' . $software_deployment_background_image) ? $software_deployment_background_image : 'gati_login_bg.png';
$logo_image = !empty($software_deployment_logo) && file_exists(FCPATH . 'assets/login_images/' . $software_deployment_logo) ? $software_deployment_logo : 'gati_logo.jpg';
$project_name = !empty($software_deployment_project_name) ? $software_deployment_project_name : 'School Management Software';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--Bootstrap css  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- style.css -->
  <link href="<?php echo base_url('assets/css/loginstyle.css'); ?>" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet" />


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/
    4.0.0/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/
    jquery/3.3.1/jquery.min.js">
  </script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/
    popper.js/1.12.9/umd/popper.min.js">
  </script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/
    4.0.0/js/bootstrap.min.js">
  </script>


  <style>
    * {
      margin: 0px;
      padding: 0px;
      /* overflow: hidden; */

    }

    .colors {
      color: #136695;
    }

    .colors-pink {
      color: #FF7BA7;

    }

    .form-label {
      color: #424242;
      text-transform: capitalize;
      font-size: 13px;
    }

    .form-select,
    .form-control {
      border-color: var(--base-color-green) !important;
      font-size: 13px;
      padding: 7px .75rem;
    }

    .error {
      font-size: 10px;
    }

    .login_box .form-floating i {
      top: 8px;
    }

    .btns {
      text-decoration: none;
      padding: 10px;
      border: 2px solid pink;
    }

    .btns:hover {
      background-color: #FF7BA7;
      color: white;
      padding: 10px;
      border: 2px solid pink;
      font-weight: 700;
    }

    .error {
      color: red;
    }
  </style>
</head>

<body>

  <div class="login-section" style="background-image: url(<?php echo base_url('assets/login_images/' . $background_image); ?>);">
    <div class="login_box shadow p-4">
      <div class="login-head mb-3">
        <img src="<?php echo base_url('assets/login_images/' . $logo_image); ?>" alt="GATI Logo">
        <!-- <h5>Gatti</h5> -->
        <span><b><?= ($project_name) ?></b></span>
        <span>Forget Password</span>
      </div>
      <div class="w-100">
        <form id="forgetPasswordForm" method="post">
          <input type="hidden" id="action" name="action">
          <div class="mb-2" id="Enteremail">
            <label class="form-label" for="usernames">Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="emp_emailid" id="emp_emailid" placeholder="Enter Your Email" />
            <p id="usercheck" style="color: red;"></p>
          </div>
          <div class="d-none" id="inputopt">
            <label class="form-label" for="usernames">Enter Otp<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="emp_otp" id="emp_otp" placeholder="Enter Otp" />
            <p id="usercheck" style="color: red;"></p>
          </div>

          <div class="d-none" id="passwordchange">
            <div>
              <label class="form-label" for="usernames">New Password<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="emp_password" id="emp_password" placeholder="Enter Password" />
              <p id="" style="color: red;"></p>
            </div>
            <div>
              <label class="form-label" for="usernames">Confirm Password<span class="text-danger">*</span></label>
              <div class="position-relative">
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password" />
                <i class="fa-solid fa-eye position-absolute" id="toggleConfirmPassword" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                <p id="" style="color: red;"></p>
              </div>
            </div>
          </div>

          <div class="d-none" id="passwordchange">
            <!-- <div >
                <br />
                <input type="text" class="form-control" name="emp_password" id="emp_password" placeholder="Enter Password" />
                <span class="form-label">
                  <i class="fa-regular fa-pen-to-square me-2"></i> New Password
                </span>
              </div> -->
            <br>
            <!-- <div >
                <br />
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password" />
                <span class="form-label">
                  <i class="fa-solid fa-eye position-absolute" id="toggleConfirmPassword" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i> Confirm Password
                </span>
              </div> -->
          </div>
          <input type="hidden" id="employee_id" name="employee_id">
          <div class="text-end d-none" id="fethbutton">
            <button type="button" id="OtpValidation" class="btn schl-btn-white border">
              <img width="20" height="20" src="https://img.icons8.com/clouds/100/checked--v1.png" alt="checked--v1" />Verify OTP
            </button>
          </div>
          <div class="text-end" id="sendotps">
            <button type="button" id="sendOTPButton" class="btn schl-btn-green">
              <img width="20" height="20" src="https://img.icons8.com/clouds/100/checked--v1.png" alt="checked--v1" />Send OTP
            </button>
          </div>
          <div class="text-end d-none" id="passwordbtn">
            <button type="button" id="updatepassword" class="btn schl-btn-green">
              <img width="20" height="20" src="https://img.icons8.com/clouds/100/checked--v1.png" alt="checked--v1" />Change Password
            </button>
          </div>
      </div>
      </form>
    </div>

  </div>
  </div>


</body>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
  var software_deployment_project_code = "<?= @$software_deployment_project_code ?>";
  $(document).ready(function() {
    // Send OTP 
    $('#sendOTPButton').click(function() {
      $('#action').val('sendOtp');
      $('#forgetPasswordForm').submit();
    });

    // Verify OTP 
    $('#OtpValidation').click(function() {
      $('#action').val('verifyOtp');
      $('#forgetPasswordForm').submit();
    });

    // Update Password 
    $('#updatepassword').click(function() {

      $('#action').val('updatePassword');
      $('#forgetPasswordForm').submit();
    });

    // submission handler
    $('#forgetPasswordForm').validate({
      rules: {
        emp_emailid: {
          required: function() {
            return $('#action').val() === 'sendOtp';
          },
          email: true
        },
        emp_otp: {
          required: function() {
            return $('#action').val() === 'verifyOtp';
          },
          digits: true,
          maxlength: 6
        },
        emp_password: {
          required: function() {
            return $('#action').val() === 'updatePassword';
          },
          minlength: 6
        },
        confirm_password: {
          required: function() {
            return $('#action').val() === 'updatePassword';
          },
          equalTo: "#emp_password"
        }
      },
      messages: {
        emp_emailid: {
          required: "Please enter your email address.",
          email: "Please enter a valid email address."
        },
        emp_otp: {
          required: "Please enter OTP",
          digits: "Please enter a numeric value",
          maxlength: "Please enter 6 digits"
        },
        emp_password: {
          required: "Please enter a new password",
          minlength: "Password must be at least 6 characters long"
        },
        confirm_password: {
          required: "Please confirm your password",
          equalTo: "Passwords do not match"
        }
      },
      submitHandler: function(form) {
        var action = $('#action').val();
        var emp_emailid = $('#emp_emailid').val();
        var emp_otp = $('#emp_otp').val();
        var employee_id = $('#employee_id').val();
        var emp_password = $('#emp_password').val();

        if (action === 'sendOtp') {
          $.ajax({
            url: '<?php echo base_url('Login/SendOtp'); ?>',
            method: 'POST',
            data: {
              emp_emailid: emp_emailid,
              software_deployment_project_code: software_deployment_project_code
            },
            success: function(response) {
              try {
                var val = JSON.parse(response);

                if (val.status === 'success') {
                  toastr.success(val.msg);
                  $('#inputopt, #fethbutton').removeClass('d-none');
                  $('#sendotps, #Enteremail').addClass('d-none');
                  $('#employee_id').val(val.empid);
                } else {
                  toastr.error(val.msg || 'Something went wrong');
                }
              } catch (e) {
                console.error('JSON parse error:', e);
                toastr.error('Invalid response from server');
              }
            },
            error: function(xhr, status, error) {
              console.error('AJAX Error:', xhr.responseText);
              toastr.error('Server error: ' + error);
            }
          });

        } else if (action === 'verifyOtp') {
          $.ajax({
            url: '<?php echo base_url('Login/VerifyOtp'); ?>',
            method: 'POST',
            data: {
              emp_otp: emp_otp,
              employee_id: employee_id,
              software_deployment_project_code: software_deployment_project_code

            },
            success: function(response) {
              var val = JSON.parse(response);
              if (val.emp == true) {
                toastr.success(val.msg);
                $('#passwordchange, #passwordbtn').removeClass('d-none');
                $('#fethbutton, #inputopt').addClass('d-none');

              } else {
                toastr.error(val.msg);
              }
            },
            error: function(xhr, status, error) {
              console.error(xhr.responseText);
            }
          });
        } else if (action === 'updatePassword') {
          $.ajax({
            url: '<?php echo base_url('Login/UpdatePassword'); ?>',
            method: 'POST',
            data: {
              emp_password: emp_password,
              employee_id: employee_id,
              software_deployment_project_code: software_deployment_project_code

            },
            success: function(response) {
              var val = JSON.parse(response);
              if (val.emp == true) {
                toastr.success(val.msg);
                window.location.href = 'index';
              } else {
                toastr.error(val.msg);
              }
            },
            error: function(xhr, status, error) {
              console.error(xhr.responseText);
            }
          });
        }
      }
    });
  });

  $(document).ready(function() {
    $('#toggleConfirmPassword').click(function() {
      const passwordField = $('#confirm_password');
      const passwordFieldType = passwordField.attr('type');
      const isPassword = passwordFieldType === 'password';

      passwordField.attr('type', isPassword ? 'text' : 'password');
      $(this).toggleClass('fa-eye fa-eye-slash');
    });
  });
</script>