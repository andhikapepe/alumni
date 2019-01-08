<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>LOWONGAN</h2>
		</div>
		<?php if (isset($message)) {
    echo '<div class="alert bg-teal alert-dismissible" role="alert" id="flash-msg">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$message.'
				</div>';
}?>
        <!-- Custom Content -->
		<div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
						Daftar Lowongan dalam bulan ini
                            <small>Kami hanya menampilkan lowongan kerja pada bulan ini, jika anda berminat silahkan membaca lowongan ini lebih lanjut dan daftarkan diri anda sesuai dengan informasi yang ada.</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                    
                        <div class="row">
							<!-- halaman lowongan -->
							<?php foreach ($_get_lowongan as $row):?>
							<div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="<?php echo base_url('assets/backend'); ?>/images/we-are-hiring.png">
                                    <div class="caption">
                                        <h3><?php echo htmlspecialchars($row->job_title, ENT_QUOTES, 'UTF-8'); ?></h3>
                                        <p>	
										<?php echo character_limiter($row->deskripsi, 100); ?>
                                        </p>
                                        <p>
												<?php echo anchor('lowongan/read/'.$row->job_slug, 'Lebih Lanjut', 'class="btn btn-primary waves-effect waves-float"'); ?>
                                        </p>
                                    </div>
                                </div>
							</div>
							<?php endforeach; ?>
							<!-- halaman lowongan -->                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Custom Content -->
	</div>
</section>