	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2><?php echo strtoupper(lang('edit_user_heading')); ?></h2>
            </div>
			<?php if (isset($message)) {
    echo '<div class="alert bg-teal alert-dismissible" role="alert" id="flash-msg">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					'.$message.'
			    </div>';
}?>
            
            <div class="row clearfix">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header bg-cyan">
							<h2>
								Informasi Akun
							</h2>
							<ul class="header-dropdown m-r--5">
								<li>
									<a href="javascript:void(0);">
										<i class="material-icons">mic</i>
									</a>
								</li>
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
							<?php echo form_open(uri_string()); ?>
								<div class="form-group form-float">
									<div class="form-line">									
										<?php echo form_input($first_name); ?><?php echo lang('edit_user_fname_label', 'first_name', 'class="form-label"'); ?> 
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">									
										<?php echo form_input($last_name); ?><?php echo lang('edit_user_lname_label', 'last_name', 'class="form-label"'); ?> 
									</div>
								</div>							
								<div class="form-group form-float">
									<div class="form-line">									
										<?php echo form_input($email); ?><?php echo lang('edit_user_email_label', 'email', 'class="form-label"'); ?> 
									</div>
								</div>							
								<div class="form-group form-float">
									<div class="form-line">									
										<?php echo form_input($password); ?><?php echo lang('edit_user_password_label', 'password', 'class="form-label"'); ?> 
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">									
										<?php echo form_input($password_confirm); ?><?php echo lang('edit_user_password_confirm_label', 'password_confirm', 'class="form-label"'); ?>
									</div>
								</div>
														
									<?php echo form_hidden('id', $user->id); ?>
									<?php echo form_hidden($csrf); ?>
									<div class="form-group form-float">
									<?php echo form_submit('submit', lang('edit_user_submit_btn'), 'class="btn btn-primary waves-effect"'); ?>	
								</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
                
				
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header bg-purple">
							<h2>Informasi Profil</h2>
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
								<?php echo form_open($aksi); ?>
									<div class="form-group form-float">
										<div class="form-line">																
											<?php echo form_input($nisn); ?>
											<?php echo form_label('NISN', 'nisn', 'class="form-label"'); ?>	
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-md-12">
											<?php 
                                            echo form_dropdown($jenis_kelamin, array('laki-laki' => 'laki-laki', 'perempuan' => 'perempuan'), $jenis_kelamin['value']);
                                            ?>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">																
											<?php echo form_input($alamat); ?>
											<?php echo form_label('Alamat Domisili', 'alamat', 'class="form-label"'); ?>	
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">																
											<?php echo form_input($nama_ayah); ?>
											<?php echo form_label('Nama Ayah', 'nama_ayah', 'class="form-label"'); ?>	
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">																
											<?php echo form_input($pekerjaan_ayah); ?>
											<?php echo form_label('Pekerjaan Ayah', 'pekerjaan_ayah', 'class="form-label"'); ?>	
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">																
											<?php echo form_input($nama_ibu); ?>
											<?php echo form_label('Nama Ibu', 'nama_ibu', 'class="form-label"'); ?>	
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">																
											<?php echo form_input($pekerjaan_ibu); ?>
											<?php echo form_label('Pekerjaan Ibu', 'pekerjaan_ibu', 'class="form-label"'); ?>	
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">																
											<?php echo form_input($tahun_masuk); ?>
											<?php echo form_label('Tahun Masuk', 'tahun_masuk', 'class="form-label"'); ?>	
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">																
											<?php echo form_input($tahun_lulus); ?>
											<?php echo form_label('Tahun Lulus', 'tahun_lulus', 'class="form-label"'); ?>	
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">																
											<?php echo form_input($no_ijazah); ?>
											<?php echo form_label('No. Seri Ijazah', 'no_ijazah', 'class="form-label"'); ?>	
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">																
											<?php echo form_input($no_skhun); ?>
											<?php echo form_label('No. SKHUN', 'no_skhun', 'class="form-label"'); ?>	
										</div>
									</div>
									<br/>
													
										<?php echo form_hidden('id_user', $user->id); ?>
										<?php echo form_hidden($id); ?>
										<?php echo form_hidden($csrf); ?>

									<div class="form-group form-float">
										<?php echo form_submit('submit', $button, 'class="btn btn-primary waves-effect"'); ?>	
										
									</div>

									<?php echo form_close(); ?>                        

                            
                        </div>
                    </div>
                </div>
			</div>
			
		</div>
	</section>
