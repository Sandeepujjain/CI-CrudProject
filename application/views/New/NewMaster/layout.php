<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.webp'); ?>" type="image/x-icon">
	<!-- <title>Super Admin</title> -->
	<title><?php echo isset($title) ? $title : 'School'; ?></title>
	<!--Bootstrap css  -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<!-- style.css -->
	<link href="<?php echo base_url('assets/css/newstyle.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/responsive.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/filter.css'); ?>" rel="stylesheet">
	<!-- font awesome icon -->
	<script src="https://kit.fontawesome.com/b79797c1bc.js" crossorigin="anonymous"></script>

	<!-- data table css -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">

	<!-- owl slider css -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">

</head>

<body class="container-fluid">
	<main class="school-wrapper row justify-content-end">
		<?php $this->load->view('NewMaster/sidebar') ?>
		<section class="content-wrapper col-md-12 col-lg-10">
			<?php $this->load->view('NewMaster/header') ?>
			<div class="container">