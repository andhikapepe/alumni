 
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Status Alumni</h2>
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
                                Silakan masukan Status anda di bawah ini.
                            </h2>
                            
                        </div>
                        <div class="body">
						
						<?php echo form_open($action, 'class = "form-horizontal"'); ?>
						 
						  <div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('Status'); ?>
								</div>
						  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
									<?php echo form_error('status');
                                        echo
                                        form_dropdown($status, array('Bekerja' => 'Bekerja', 'Kuliah' => 'Kuliah', 'Belum / tidak bekerja' => 'Belum / tidak bekerja', 'Bekerja sambil kuliah' => 'Bekerja sambil kuliah'), $status['value']);
                                    ?>
								 	</div>
								</div>
							</div>
						</div>
					  <div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<?php echo form_label('Deskripsi'); ?>
							</div>
					 <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
									<?php echo form_error('deskripsi');
                                        echo form_textarea($deskripsi);
                                    ?>
									</div>
								</div>
							</div>
						</div>
					    <?php 
                                echo form_input($id_user);
                                echo form_input($id);
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
    