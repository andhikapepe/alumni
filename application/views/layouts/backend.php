<?php 
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
$segment3 = $this->uri->segment(3);
$uri_string = $this->uri->uri_string();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Andhika Putra Pratama">
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url('assets'); ?>/favicon.ico" type="image/x-icon">

    <title><?php echo $title; ?></title>
    
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

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url('assets/backend'); ?>/css/themes/all-themes.css" rel="stylesheet" />

    <?php if (isset($_partial_css)) {
    echo $_partial_css;
} ?>
    
    <script type="text/javascript">
            function showTime() {
                var a_p = "";
                var today = new Date();
                var curr_hour = today.getHours();
                var curr_minute = today.getMinutes();
                var curr_second = today.getSeconds();
                if (curr_hour < 12) {
                    a_p = "AM";
                } else {
                    a_p = "PM";
                }
                if (curr_hour == 0) {
                    curr_hour = 12;
                }
                if (curr_hour > 12) {
                    curr_hour = curr_hour - 12;
                }
                curr_hour = checkTime(curr_hour);
                curr_minute = checkTime(curr_minute);
                curr_second = checkTime(curr_second);
                document.getElementById('time').innerHTML=" "+ curr_hour + ":" + curr_minute +  a_p;
            }
             
            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }
            setInterval(showTime, 500);         
        </script>
</head>

<body class="theme-teal">
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
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="home"><?php echo $_app_name; ?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->  
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?php echo base_url('assets/backend'); ?>/images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo isset($is_user->first_name) ? $is_user->first_name : ''; ?></div>
                    <div class="email"><?php echo isset($is_user->email) ? $is_user->email : ''; ?></div>
                                      
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li <?php echo $segment1 == 'home' ? 'class="active"' : ''; ?>>
                        <?php echo anchor('home', '<i class="material-icons">home</i><span>Home</span>'); ?>
                    </li>
                    <?php if ($this->ion_auth->in_group('members')) {
    ?>
                    <li <?php echo $segment1 == 'profil' ? 'class="active"' : ''; ?>>
                        <?php echo anchor('profil', '<i class="material-icons">person</i><span>Profil Pengguna</span>'); ?>
                    </li>
                    <li <?php echo $segment1 == 'lowongan' ? 'class="active"' : ''; ?>>
                        <?php echo anchor('lowongan', '<i class="material-icons">work</i><span>Lowongan</span>'); ?>
                    </li>
                    <li <?php echo $segment1 == 'event' ? 'class="active"' : ''; ?>>
                        <?php echo anchor('event', '<i class="material-icons">event</i><span>Event</span>'); ?>
                    </li>
                   
                    <li <?php echo $segment1 == 'testimoni' ? 'class="active"' : ''; ?>>
                        <?php echo anchor('testimoni', '<i class="material-icons">record_voice_over</i><span>Testimoni</span>'); ?>
                    </li>
                    <li <?php echo $segment1 == 'kritik_saran' ? 'class="active"' : ''; ?>>
                        <?php echo anchor('kritik_saran', '<i class="material-icons">sentiment_neutral</i><span>Kritik dan Saran</span>'); ?>
                    </li>
<?php
} ?> 
                    
                    
                    <?php if ($this->ion_auth->is_admin()) {
        ?>
                    
                    
                    <li <?php echo $segment1 == 'lowongan' ? 'class="active"' : ''; ?>>
                        <?php echo anchor('lowongan/list_admin', '<i class="material-icons">work</i><span>Lowongan</span>'); ?>
                    </li>
                    <li <?php echo $segment1 == 'event' ? 'class="active"' : ''; ?>>
                        <?php echo anchor('event/list_admin', '<i class="material-icons">event</i><span>event</span>'); ?>
                    </li>
                    <li <?php echo $segment1 == 'testimoni' ? 'class="active"' : ''; ?>>
                        <?php echo anchor('testimoni/list_admin', '<i class="material-icons">record_voice_over</i><span>Testimoni</span>'); ?>
                    </li>
                    <li <?php echo $segment1 == 'kritik_saran' ? 'class="active"' : ''; ?>>
                        <?php echo anchor('kritik_saran/list_admin', '<i class="material-icons">sentiment_neutral</i><span>Kritik dan Saran</span>'); ?>
                    </li>
                    <li <?php echo $segment1 == 'rekapitulasi' ? 'class="active"' : ''; ?>>
                        <?php echo anchor('rekapitulasi', '<i class="material-icons">report</i><span>Rekapitulasi Data</span>'); ?>
                    </li>
                    <li <?php echo $segment1 == 'user' ? 'class="active"' : ''; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">people</i>
                            <span>Users</span>
                        </a>
                        <ul class="ml-menu">
							<li <?php echo $uri_string == 'user' || $this->uri->uri_string() && $segment3 ? 'class="active"' : ''; ?>>
							<?php echo anchor('user', 'Daftar Pengguna'); ?>
                            </li>
							<li <?php echo $segment2 == 'create_user' ? 'class="active"' : ''; ?>>
							<?php echo anchor('user/create_user', 'Buat Pengguna'); ?>
                            </li>							
						</ul>
                    </li>
                    
                    
                    <li <?php echo $segment1 == 'referensi_tahun' || $segment1 == 'referensi_profesi' ? 'class="active"' : ''; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">search</i>
                            <span>Referensi</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo $segment1 == 'referensi_tahun' ? 'class="active"' : ''; ?>>
                                <?php echo anchor('referensi_tahun', 'Ref Tahun'); ?>
                            </li> 						
                            <li <?php echo $segment1 == 'referensi_profesi' ? 'class="active"' : ''; ?>>
                                <?php echo anchor('referensi_profesi', 'Ref Profesi'); ?>
                            </li> 						
						</ul>
                    </li>
                    
                    <?php
    } ?>
                    <li <?php echo $segment2 == 'change_password' ? 'class="active"' : ''; ?>>
                        <?php echo anchor('auth/change_password', '<i class="material-icons">lock</i><span>'.$this->lang->line('change_password_heading').'</span>'); ?>
                    </li>    
                    <?php if (isset($is_user)) {
        ?>
                    <li <?php echo $uri_string == 'auth/logout' ? 'class="active"' : ''; ?>>
                        <?php echo anchor('auth/logout', '<i class="material-icons">input</i><span>'.$this->lang->line('logout_heading').'</span>'); ?>
                    </li> 
                    <?php
    }?>   
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; <?php echo date('Y'); ?> <a href="javascript:void(0);">Andhika Putra Pratama</a>.
                </div>
                <div class="version">
                    <b>Version: </b> beta
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
       
    </section>
    
    <?php 
        if (isset($_view) && $_view) {
            $this->load->view($_view);
        }
    ?> 

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url('assets/backend'); ?>/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url('assets/backend'); ?>/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?php echo base_url('assets/backend'); ?>/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url('assets/backend'); ?>/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url('assets/backend'); ?>/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url('assets/backend'); ?>/js/admin.js"></script>

    <!-- Demo Js -->
    <script src="<?php echo base_url('assets/backend'); ?>/js/demo.js"></script>

    <?php if (isset($_partial_js)) {
        echo $_partial_js;
    } ?>
</body>
<script>
	$(document).ready(function () {
		$("#flash-msg").delay(2000).fadeOut("slow");

        
    });
</script>
</html>