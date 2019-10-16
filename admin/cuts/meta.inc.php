<?php $ADMIN->secure();?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Admin <?=SITE_NAME.(($comp)?" - ".$ADMIN->breadcrumb($comp):'')?></title>
		<meta name="description" content="Free Bootstrap 4 Admin Theme | Pike Admin">
		<meta name="author" content="Pike Web Development - https://www.pikephp.com">

		<!-- Favicon -->
		<link rel="shortcut icon" href="<?=SITE_PATH_ADM?>assets/images/favicon.ico">

		<!-- Bootstrap CSS -->
		<link href="<?=SITE_PATH_ADM?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?=SITE_PATH_ADM?>assets/css/fontawesome-iconpicker.min.css" rel="stylesheet" type="text/css" />
		<!-- Font Awesome CSS -->
		<link href="<?=SITE_PATH_ADM?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="<?=SITE_PATH_ADM?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
		<!-- Custom CSS -->
		<link href="<?=SITE_PATH_ADM?>assets/css/style.css" rel="stylesheet" type="text/css" />
		
		<!-- BEGIN CSS for this page -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
		<!-- END CSS for this page -->


<!-- Page Scripts on this page -->
<script src="<?=SITE_PATH_ADM?>assets/js/modernizr.min.js"></script>
<script src="<?=SITE_PATH_ADM?>assets/js/jquery.min.js"></script>
<script src="<?=SITE_PATH_ADM?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=SITE_PATH_ADM?>assets/js/moment.min.js"></script>
		
<script src="<?=SITE_PATH_ADM?>assets/js/popper.min.js"></script>
<script src="<?=SITE_PATH_ADM?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=SITE_PATH?>lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=SITE_PATH?>lib/ckfinder/ckfinder.js"></script>
<script src="<?=SITE_PATH_ADM?>assets/js/detect.js"></script>
<script src="<?=SITE_PATH_ADM?>assets/js/fastclick.js"></script>
<script src="<?=SITE_PATH_ADM?>assets/js/jquery.blockUI.js"></script>
<script src="<?=SITE_PATH_ADM?>assets/js/jquery.nicescroll.js"></script>
<script src="<?=SITE_PATH_ADM?>assets/js/fontawesome-iconpicker.min.js"></script>
<script src="<?=SITE_PATH_ADM?>assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>
<!-- App js -->
<script src="<?=SITE_PATH_ADM?>assets/js/pikeadmin.js"></script>

<!-- BEGIN Java Script for this page -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
<script src="<?=SITE_PATH_ADM?>assets/plugins/parsleyjs/parsley.min.js"></script>
<script src="<?=SITE_PATH_ADM?>assets/js/validate.js"></script>
</head>
<body class="adminbody">
<div id="main">