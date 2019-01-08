 
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Profil</h2>
            </div>
			<?php if (isset($message)) {
    echo '<div class="alert bg-teal alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					'.$message.'
			    </div>';
}?>
            <div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">                    
						<div class="body">
							<div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
								<?php echo anchor('profil', 'Akun', 'class="btn btn-lg bg-blue waves-effect" role="button"'); ?>
								<?php echo anchor('profil/profil_user', 'Data Diri', 'class="btn btn-lg bg-purple waves-effect" role="button"'); ?>
								<?php echo anchor('profil/status_alumni', 'Status Alumni', 'class="btn btn-lg bg-pink waves-effect" role="button"'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Basic Alerts -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Silakan Lengkapi data Profil anda di bawah ini.
                            </h2>
                            
                        </div>
                        <div class="body">
						<?php echo form_open($action, 'class = "form-horizontal"'); ?>
						  
						  	<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('Jenis Kelamin'); ?>
								</div>
						  		<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
										<?php echo form_error('jenis_kelamin');
                                            echo
                                            form_dropdown($jenis_kelamin, array('Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan'), $jenis_kelamin['value']);

                                        ?>
										</div>
									</div>
								</div>
							</div>
						  	<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('Nisn'); ?>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
										<?php echo form_error('nisn');
                                            echo form_input($nisn);
                                        ?>
										</div>
									</div>
								</div>
							</div>
						  	<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('Tempat Lahir'); ?>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
										<?php echo form_error('tempat_lahir');
                                            echo form_input($tempat_lahir);
                                        ?>
										</div>
									</div>
								</div>
							</div>
						  	<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('Tanggal Lahir'); ?>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
										<?php echo form_error('tanggal_lahir');
                                            echo form_input($tanggal_lahir);
                                        ?>
										</div>
									</div>
								</div>
							</div>
					  		<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('Alamat Domisili'); ?>
								</div>
					 			<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
										<?php echo form_error('alamat');
                                            echo form_textarea($alamat);
                                        ?>
										</div>
									</div>
								</div>
							</div>
						  	<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('No Telp'); ?>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
										<?php echo form_error('no_telp');
                                            echo form_input($no_telp);
                                        ?>
										</div>
									</div>
								</div>
							</div>
						  	<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('Nama Ayah'); ?>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
										<?php echo form_error('nama_ayah');
                                            echo form_input($nama_ayah);
                                        ?>
										</div>
									</div>
								</div>
							</div>
						  	<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('Pekerjaan Ayah'); ?>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
										<?php echo form_error('pekerjaan_ayah');

                                            $row_profesi = array();
                                            foreach ($_ref_pekerjaan as $ref) {
                                                $row_profesi[$ref->nama_profesi] = $ref->nama_profesi;
                                            }
                                            echo form_dropdown($pekerjaan_ayah, $row_profesi, $pekerjaan_ayah['value']);
                                        ?>
										</div>
									</div>
								</div>
							</div>
						  	<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('Nama Ibu'); ?>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
										<?php echo form_error('nama_ibu');
                                            echo form_input($nama_ibu);
                                        ?>
										</div>
									</div>
								</div>
							</div>
						  	<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('Pekerjaan Ibu'); ?>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
										<?php echo form_error('pekerjaan_ibu');

                                            $row_profesi = array();
                                            foreach ($_ref_pekerjaan as $ref) {
                                                $row_profesi[$ref->nama_profesi] = $ref->nama_profesi;
                                            }
                                            echo form_dropdown($pekerjaan_ibu, $row_profesi, $pekerjaan_ibu['value']);
                                        ?>									
										</div>
									</div>
								</div>
							</div>
						  	<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('Tahun Masuk'); ?>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
									<div class="form-line">
										<?php echo form_error('tahun_masuk');

                                            $row_tahun = array();
                                            foreach ($_ref_tahun as $ref) {
                                                $row_tahun[$ref->ref_tahun] = $ref->ref_tahun;
                                            }
                                            echo form_dropdown($tahun_masuk, $row_tahun, $tahun_masuk['value']);
                                        ?>
										
									</div>
									</div>
								</div>
							</div>
						  	<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('Tahun Lulus'); ?>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
									<div class="form-line">
										<?php echo form_error('tahun_lulus');

                                            $row_tahun = array();
                                            foreach ($_ref_tahun as $ref) {
                                                $row_tahun[$ref->ref_tahun] = $ref->ref_tahun;
                                            }
                                            echo form_dropdown($tahun_lulus, $row_tahun, $tahun_lulus['value']);
                                        ?>
										
									</div>
									</div>
								</div>
							</div>
						  	<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('No Ijazah'); ?>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
										<?php echo form_error('no_ijazah');
                                            echo form_input($no_ijazah);
                                        ?>
										</div>
									</div>
								</div>
							</div>
						  	<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('No Skhun'); ?>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
										<?php echo form_error('no_skhun');
                                            echo form_input($no_skhun);
                                        ?>
										</div>
									</div>
								</div>
							</div>
					    <?php 
                                echo form_input($id);
                                echo form_input($id_user);
                                ?>
					    	
							<div class="row clearfix">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <?php echo form_submit('submit', $button, array('class' => 'btn btn-flat btn-primary'));
                                            ?>
                                </div>
                            </div>
						<?php echo form_close(); ?>
						</div>
					</div>
				</div>
            <!-- #END# Basic Alerts -->
		</div>
	</section>
    