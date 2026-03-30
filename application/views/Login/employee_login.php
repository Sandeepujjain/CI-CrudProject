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
	<title>Gati Login</title>
	<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.webp'); ?>" type="image/x-icon">
	<!-- <link rel="manifest" href="/manifest.json"> -->
	<link rel="manifest" href="<?php echo base_url('manifest.php?logo_image=' . $logo_image); ?>">

	<meta name="theme-color" content="#0faa7e">

	<script>
		if ('serviceWorker' in navigator) {
			navigator.serviceWorker.register('/sw.js').then(function() {
				console.log("Service Worker Registered");
			});
		}
	</script>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
		integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />

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

	</script>
	<script>
		var base_url = "<?php echo base_url(); ?>";
	</script>

	<script src="<?php echo base_url('assets/js/masterAdmin.js'); ?>"></script>



	<style>
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
				<span>Employee Login</span>
			</div>
			<!-- Employee Login Common Field  -->
			<?php $this->load->view('Login/emoloyee_common_login_fields.php'); ?>

		</div>
		<div class="mt-3 social-media-links">
			<?php if (!empty($software_deployment_facebook_link)) : ?>
				<a href="<?= ($software_deployment_facebook_link) ?>" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" class="" viewBox="0 0 512 512" stroke="currentColor" fill="currentColor">
						<path d="M480 257.35c0-123.7-100.3-224-224-224s-224 100.3-224 224c0 111.8 81.9 204.47 189 221.29V322.12h-56.89v-64.77H221V208c0-56.13 33.45-87.16 84.61-87.16 24.51 0 50.15 4.38 50.15 4.38v55.13H327.5c-27.81 0-36.51 17.26-36.51 35v42h62.12l-9.92 64.77H291v156.54c107.1-16.81 189-109.48 189-221.31z" fill-rule="evenodd"></path>
					</svg>
				</a>
			<?php endif; ?>
			<?php if (!empty($software_deployment_instagram_link)) : ?>
				<a href="<?= ($software_deployment_instagram_link) ?>" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" class="" viewBox="0 0 512 512" stroke="currentColor" fill="currentColor">
						<path d="M349.33 69.33a93.62 93.62 0 0193.34 93.34v186.66a93.62 93.62 0 01-93.34 93.34H162.67a93.62 93.62 0 01-93.34-93.34V162.67a93.62 93.62 0 0193.34-93.34h186.66m0-37.33H162.67C90.8 32 32 90.8 32 162.67v186.66C32 421.2 90.8 480 162.67 480h186.66C421.2 480 480 421.2 480 349.33V162.67C480 90.8 421.2 32 349.33 32z"></path>
						<path d="M377.33 162.67a28 28 0 1128-28 27.94 27.94 0 01-28 28zM256 181.33A74.67 74.67 0 11181.33 256 74.75 74.75 0 01256 181.33m0-37.33a112 112 0 10112 112 112 112 0 00-112-112z"></path>
					</svg>
				</a>
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
				<a href="tel:<?= ($software_deployment_contact_no) ?>">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 3.75v4.5m0-4.5h-4.5m4.5 0-6 6m3 12c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z" />
					</svg>

				</a>
			<?php endif; ?>
			<?php if (!empty($software_deployment_email)) : ?>
				<a href="mailto:<?= ($software_deployment_email) ?>">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
					</svg>
				</a>
			<?php endif; ?>
		</div>
		<div id="installBox">
			<div class="logo">
				<img src="<?php echo base_url('assets/login_images/' . $logo_image); ?>" alt="Gati School ERP Logo">
				<h4>Install Gati School ERP on your device!</h4>
			</div>
			<p>Easy and faster access to your school login and updates. Get desktop & mobile notifications instantly.</p>
			<div class="buttons">
				<button class="btn btn-install" id="installBtn">Install</button>
				<button class="btn btn-dismiss" onclick="document.getElementById('installBox').style.display='none';">Not now</button>
			</div>
		</div>

		<style>
			#installBox {
				position: fixed;
				top: 30px;
				right: 30px;
				width: 360px;
				background-color: #fff;
				box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
				border-radius: 8px;
				padding: 16px 20px;
				z-index: 9999;
				display: none;
				font-family: 'Segoe UI', sans-serif;
			}

			#installBox h4 {
				margin: 0;
				font-size: 16px;
				font-weight: 600;
			}

			#installBox p {
				font-size: 13px;
				color: #444;
				margin: 6px 0 16px 0;
			}

			#installBox .buttons {
				text-align: right;
			}

			#installBox .buttons button {
				padding: 6px 12px;
				border: none;
				border-radius: 4px;
				cursor: pointer;
				font-weight: 500;
			}

			#installBox .btn-install {
				background-color: var(--base-color-green);
				color: #fff;
				margin-right: 8px;
			}

			#installBox .btn-dismiss {
				background-color: #e0e0e0;
			}

			#installBox .close-btn {
				position: absolute;
				top: 8px;
				right: 10px;
				background: none;
				border: none;
				font-size: 18px;
				cursor: pointer;
				color: #888;
			}

			#installBox .logo {
				display: flex;
				align-items: center;
				margin-bottom: 10px;
			}

			#installBox .logo img {
				height: 40px;
				margin-right: 10px;
			}

			#installBox .logo h4 {
				margin: 0;
				font-size: 15px;
			}
		</style>

</body>

<script>
	let deferredPrompt;
	window.addEventListener('beforeinstallprompt', (e) => {
		e.preventDefault();
		deferredPrompt = e;
		document.getElementById('installBox').style.display = 'block';

		document.getElementById('installBtn').addEventListener('click', () => {
			deferredPrompt.prompt();
			deferredPrompt.userChoice.then((choiceResult) => {
				if (choiceResult.outcome === 'accepted') {
					console.log('App Installed');
				}
				deferredPrompt = null;
			});
		});
	});
</script>
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





	var function_url = base_url + "Login/employee_login";

	function successCallback(response) {
		window.location.href = "<?= base_url('MyAttendance') ?>";
	}


	function errorCallback(response) {
		console.log(response);
	}
</script>
