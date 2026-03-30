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
  <title>Student - Parent Login</title>
  <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.webp'); ?>" type="image/x-icon">


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--Bootstrap css  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- style.css -->
  <link href="<?php echo base_url('assets/css/' . $css_file); ?>" rel="stylesheet">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

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

  <script>
    var base_url = "<?php echo base_url(); ?>";
  </script>

  <script src="<?php echo base_url('assets/js/masterAdmin.js'); ?>"></script>


  <style>
    * {
      margin: 0px;
      padding: 0px;
      overflow: hidden;

    }

    .colors {
      color: #136695;
    }

    .colors-pink {
      color: #FF7BA7;

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

    .error-message {
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
        <span> Student Login</span>
      </div>
      <!-- Student Login Common Field  -->
      <?php $this->load->view('Login/student_common_login_fields.php'); ?>

      <div class="d-flex gap-3 justify-content-center mt-3">
        <?php if (!empty($software_deployment_facebook_link)) : ?>
          <a href="<?= ($software_deployment_facebook_link) ?>" target="_blank">Facebook</a>
        <?php endif; ?>
        <?php if (!empty($software_deployment_instagram_link)) : ?>
          <a href="<?= ($software_deployment_instagram_link) ?>" target="_blank">Instagram</a>
        <?php endif; ?>
        <?php if (!empty($software_deployment_youtube_link)) : ?>
          <a href="<?= ($software_deployment_youtube_link) ?>" target="_blank">Youtube</a>
        <?php endif; ?>
        <?php if (!empty($software_deployment_linkedin_link)) : ?>
          <a href="<?= ($software_deployment_linkedin_link) ?>" target="_blank">LinkedIn</a>
        <?php endif; ?>
        <?php if (!empty($software_deployment_twitter_link)) : ?>
          <a href="<?= ($software_deployment_twitter_link) ?>" target="_blank">Twitter</a>
        <?php endif; ?>
        <?php if (!empty($software_deployment_contact_no)) : ?>
          <a href="tel:<?= ($software_deployment_contact_no) ?>"><?= ($software_deployment_contact_no) ?></a>
        <?php endif; ?>
        <?php if (!empty($software_deployment_email)) : ?>
          <a href="mailto:<?= ($software_deployment_email) ?>"><?= ($software_deployment_email) ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>

<!-- <div>
            <a href="<#?php echo base_url('Login/forgetpassword'); ?>" title="Edit Name">Forget Password</a>
          </div>JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" type="text/css"
  href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script type="text/javascript">
  <?php if ($this->session->flashdata('success')) { ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
  <?php } else if ($this->session->flashdata('error')) { ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
  <?php } else if ($this->session->flashdata('warning')) { ?>
    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
  <?php } else if ($this->session->flashdata('info')) { ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
  <?php } ?>
</script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
  $(document).ready(function() {
    $('#togglePassword').click(function() {
      const passwordField = $('#password');
      const passwordFieldType = passwordField.attr('type');
      const isPassword = passwordFieldType === 'password';

      passwordField.attr('type', isPassword ? 'text' : 'password');
      $(this).toggleClass('fa-eye fa-eye-slash');
    });

  });

  $(document).ready(function() {
    // Get cookies
    var username = getCookie("username");
    var password = getCookie("password");
    var accessGroupCode = getCookie("software_deployment_project_code");

    // Set cookies to the form fields
    if (username) {
      $("#usernames").val(username);
    }
    if (password) {
      $("#password").val(password);
    }
    if (accessGroupCode) {
      $("#software_deployment_project_codes").val(accessGroupCode);
    }

    // Function to get cookie value by name
    function getCookie(name) {
      var nameEq = name + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEq) == 0) return c.substring(nameEq.length, c.length);
      }
      return null;
    }
  });

  var function_url = base_url + "Login/student_login_form";

  function successCallback(response) {
    window.location.href = "<?= base_url('Student/StudentDashboard') ?>";
  }


  function errorCallback(response) {
    console.log(response);
  }
</script>