<div class="container">
    <div class="row">			
		<a class="line"><h4 class="margin h1" data-aos="zoom-out" data-aos-duration="500">Bursa Kerja Bulan Ini</h4></a>
		<?php foreach ($_get_lowongan as $row):?>
		<div class="col s12 m4">
        	<div class="icon-block">
            	<h5 class="center" data-aos="zoom-in-down" data-aos-duration="500"><?php echo htmlspecialchars($row->job_title, ENT_QUOTES, 'UTF-8'); ?></h5>
            	<p class="light justify" data-aos="zoom-in-down" data-aos-duration="500"><?php echo character_limiter($row->deskripsi, 100); ?></p>
				<?php echo anchor('main/loker_detail/'.$row->job_slug, 'Lebih Lanjut', 'class="btn btn-primary waves-effect waves-float"'); ?>
			</div>
        </div>
        <?php endforeach;?>
				<p data-aos="zoom-out" data-aos-duration="500">
				<?php echo (isset($message)? $message : '');?>
				</p>
	</div>    
</div>