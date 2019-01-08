 
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Event</h2>
            </div>
			<?php if (isset($message)) {
    echo '<div class="alert bg-teal alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					'.$message.'
			    </div>';
}?>
            <!-- Basic Alerts -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Silakan masukan data Event di bawah ini.
                            </h2>
                            
                        </div>
                        <div class="body">
						<?php echo form_open($action, 'class = "form-horizontal"'); ?>
						  <div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('Nama Kegiatan'); ?>
								</div>
						  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
									<?php 
                                        echo form_input($nama_event);
                                    ?>
								 	</div>
								</div>
							</div>
						</div>
						  <div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('Judul kegiatan'); ?>
								</div>
						  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
									<?php 
                                        echo form_input($event_title);
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
									<?php 
                                        echo form_textarea($deskripsi);
                                    ?>
									</div>
								</div>
							</div>
						</div>
					    <?php 
                                echo form_input($id);
                                ?>
					    	
								<div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <?php echo form_submit('submit', $button, array('class' => 'btn btn-flat btn-primary'));
                                            echo anchor('event/list_admin', 'Batal', array('class' => 'btn btn-flat btn-default'));
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
    