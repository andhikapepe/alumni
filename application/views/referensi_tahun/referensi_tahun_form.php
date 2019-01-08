 
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Referensi Tahun</h2>
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
                                Silakan masukan data referensi tahun di bawah ini.
                            </h2>
                            
                        </div>
                        <div class="body">
						<?php echo form_open($action, 'class = "form-horizontal"'); ?>
						  <div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<?php echo form_label('Referensi Tahun'); ?>
								</div>
						  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
                                        <?php
                                        echo form_input($ref_tahun);
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
                                            echo anchor('referensi_tahun', 'Batal', array('class' => 'btn btn-flat btn-default'));
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
    