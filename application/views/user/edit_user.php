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
            <!-- Basic Alerts -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo lang('edit_user_subheading'); ?>
                            </h2>
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
							<div>
                                <?php if ($this->ion_auth->is_admin()): ?>

									  <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
									  <?php foreach ($groups as $group):?>
										  
										  <?php
                                              $gID = $group['id'];
                                              $checked = null;
                                              $item = null;
                                              foreach ($currentGroups as $grp) {
                                                  if ($gID == $grp->id) {
                                                      $checked = ' checked="checked"';
                                                      break;
                                                  }
                                              }
                                          ?>
										  <input type="checkbox" name="groups[]" class="filled-in" id="checkbox-<?php echo $group['id']; ?>" value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
										  <label for="checkbox-<?php echo $group['id']; ?>"><?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?></label>
										  <br/>
									  <?php endforeach; ?>

								  <?php endif; ?>
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
			</div>
            <!-- #END# Basic Alerts -->
		</div>
	</section>
