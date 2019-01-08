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

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  		<link href="<?php echo base_url('assets/frontend'); ?>/css/materialize.min.css"  media="screen,projection" type="text/css" rel="stylesheet" />
  		<link href="<?php echo base_url('assets/frontend'); ?>/css/aos.css" type="text/css" rel="stylesheet" />
  		<link href="<?php echo base_url('assets/frontend'); ?>/css/main.css"  type="text/css" rel="stylesheet" />
          <link href="<?php echo base_url('assets/frontend'); ?>/css/carousel.css" type="text/css" rel="stylesheet" />  
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
                document.getElementById('time').innerHTML=" "+ curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
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
  	<body>  		
  		<div class="navbar-fixed">
			<nav>
		    	<div class="nav-wrapper teal">
		    		<div class="container">
			      		<ul id="nav-mobile" class="hide-on-med-and-down">
					        <li><?php echo anchor('main', '<i class="material-icons">school</i>'); ?></li>
					        <li><?php echo anchor('main/lulusan', 'Data Alumni'); ?></li>
					        <li><?php echo anchor('main/loker', 'Bursa Kerja'); ?></li>
                            <li><?php echo anchor('main/kegiatan', 'Kegiatan'); ?></li>                            
					        <li><?php echo anchor('main/about', 'Tentang Aplikasi'); ?></li>
		      			</ul>
		      			<ul id="nav-mobile" class="right hide-on-med-and-down">			        
                                
                                <li id="date"></li>
                                <li id="time"></li>
                            <script>
                                var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                var date = new Date();
                                var weekday = new Array(7);
                                weekday[0] = "Minggu";
                                weekday[1] = "Senin";
                                weekday[2] = "Selasa";
                                weekday[3] = "Rabu";
                                weekday[4] = "Kamis";
                                weekday[5] = "Jum'at";
                                weekday[6] = "Sabtu";

                                var nowadays = weekday[date.getDay()];
                                var day = date.getDate();
                                var month = date.getMonth();
                                var year = date.getFullYear();
                                
                                document.getElementById("date").innerHTML =" " + nowadays + ", " + day + " " + months[month] + " " + year + " Pukul :  ";
                            </script>
      						
		      			</ul>
		      		</div>
		    	</div>
		  	</nav>
		</div>		
		<?php 
        if (isset($_view) && $_view) {
            $this->load->view($_view);
        }
    ?> 
        
		<script src="<?php echo base_url('assets/frontend'); ?>/js/jquery-3.2.1.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/frontend'); ?>/js/materialize.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/frontend'); ?>/js/aos.js" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/frontend'); ?>/js/main.js" type="text/javascript"></script>
        <?php if ($this->uri->segment(2) == null):?>
            <script src="<?php echo base_url('assets/frontend'); ?>/js/carousel.js" type="text/javascript"></script>
        <?php endif; ?>
        
        <?php if (isset($_partial_js)) {
        echo $_partial_js;
    } ?>
    </body>
    
 </html>