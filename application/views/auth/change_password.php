<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2><?php echo strtoupper(lang('change_password_heading')); ?></h2>
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
                                Ganti kata sandi anda dengan pola yang rumit namun mudah diingat.
                            </h2>
                        </div>
                        <div class="body">						
							<?php echo form_open('auth/change_password'); ?>

							<div class="form-group form-float">
								<div class="form-line">
										<?php echo lang('change_password_old_password_label', 'old_password', 'class="form-label"'); ?>
										<?php echo form_input($old_password); ?>
								  </div>
							</div>

							<div class="form-group form-float">
								<div class="form-line">
										<?php echo sprintf(lang('change_password_new_password_label', 'new_password', 'class="form-label"'), $min_password_length); ?>
										<?php echo form_input($new_password); ?>
								  </div>
							</div>

							<div class="form-group form-float">
								<div class="form-line">
										<?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm', 'class="form-label"'); ?>
										<?php echo form_input($new_password_confirm); ?>
								  </div>
							</div>

								  <?php echo form_input($user_id); ?>
								  <div class="form-group form-float">
								<?php echo form_submit('submit', lang('change_password_submit_btn'), 'class="btn btn-primary waves-effect"'); ?>
							</div>

							<?php echo form_close(); ?>
							</div>
					</div>
				</div>
			</div>
            <!-- #END# Basic Alerts -->
		</div>
	</section>

