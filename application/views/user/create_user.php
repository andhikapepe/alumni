	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2><?php echo strtoupper(lang('create_user_heading')); ?></h2>
            </div>
			<?php if (isset($message)) {
    echo '<div class="alert bg-teal alert-dismissible" role="alert" id="flash-msg">
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
                                <?php echo lang('create_user_subheading'); ?>
                            </h2>
                        </div>
                        <div class="body">
							
							<?php echo form_open('user/create_user'); ?>

							<div class="form-group form-float">
								<div class="form-line">
									<?php echo lang('create_user_fname_label', 'first_name', 'class="form-label"'); ?>
									<?php echo form_input($first_name); ?>
								</div>
							</div>

							<div class="form-group form-float">
								<div class="form-line">
									<?php echo lang('create_user_lname_label', 'last_name', 'class="form-label"'); ?>
									<?php echo form_input($last_name); ?>
								</div>
							</div>
								  
								  <?php
                                  if ($identity_column !== 'email') {
                                      echo '<div class="form-group form-float">
											<div class="form-line">';
                                      echo lang('create_user_identity_label', 'identity', 'class="form-label"');
                                      echo form_error('identity');
                                      echo form_input($identity);
                                      echo '</div>
											</div>';
                                  }
                                  ?>
							
							<div class="form-group form-float">
								<div class="form-line">
									<?php echo lang('create_user_email_label', 'email', 'class="form-label"'); ?>
									<?php echo form_input($email); ?>
							    </div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<?php echo lang('create_user_password_label', 'password', 'class="form-label"'); ?>
									<?php echo form_input($password); ?>
  							    </div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<?php echo lang('create_user_password_confirm_label', 'password_confirm', 'class="form-label"'); ?>
									<?php echo form_input($password_confirm); ?>
								</div>
							</div>
							<div class="form-group form-float">
								<?php echo form_submit('submit', lang('create_user_submit_btn'), 'class="btn btn-primary waves-effect"'); ?>
								<?php echo anchor('user', 'Kembali', 'class="btn btn-warning waves-effect"'); ?>
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
            <!-- #END# Basic Alerts -->
		</div>
	</section>