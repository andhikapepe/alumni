<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Andhika Putra Pratama">
    <title><?php echo $title; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url('assets'); ?>/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url('assets/backend'); ?>/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url('assets/backend'); ?>/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url('assets/backend'); ?>/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url('assets/backend'); ?>/css/style.css" rel="stylesheet">
</head>
<?php $page = $this->uri->segment(2); ?>
<?php if ($page == 'login') {
    ?>
<body class="login-page">
    <div class="login-box">
<?php
} elseif ($page == 'forgot_password') {
        ?>
<body class="fp-page">
    <div class="fp-box">
<?php
    } else {
        ?>	
<body class="reset-page">
    <div class="reset-box">
<?php
    } ?>
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-teal">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Please wait...</p>
            </div>
        </div>
        <!-- #END# Page Loader -->
        <div class="logo">
            <a href="javascript:void(0);"><small><?php echo $_app_name; ?></small></a>
        </div>
        <?php if (isset($message)) {
        echo '<div class="alert bg-teal alert-dismissible" role="alert" id="flash-msg">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$message.'
			</div>';
    }?>
        <div class="card">
            <div class="body">
                <?php 
                    if (isset($_view) && $_view) {
                        $this->load->view($_view);
                    }
                ?>  
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url('assets/backend'); ?>/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url('assets/backend'); ?>/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url('assets/backend'); ?>/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url('assets/backend'); ?>/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
	<script src="<?php echo base_url('assets/backend'); ?>/js/admin.js"></script>
	<?php if ($page == 'login') {
                    ?>
	<script src="<?php echo base_url('assets/backend'); ?>/js/pages/examples/sign-in.js"></script>
	<?php
                } elseif ($page == 'forgot_password') {
                    ?>	
    <script src="<?php echo base_url('assets/backend'); ?>/js/pages/examples/forgot-password.js"></script>
	<?php
                } else {
                    ?>	
    <script src="<?php echo base_url('assets/backend'); ?>/js/pages/examples/reset-password.js"></script>
	<?php
                } ?>
</body>

<script>
$(document).ready(function () {
    $("#flash-msg").delay(2000).fadeOut("slow");	
});

</script>
</html>