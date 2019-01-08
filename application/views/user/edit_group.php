	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2><?php echo strtoupper(lang('edit_group_heading')); ?></h2>
            </div>
			<?php if (isset($message)) {
    echo '<div class="alert bg-cyan alert-dismissible" role="alert" id="flash-msg">
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
                                <?php echo lang('edit_group_subheading'); ?>
                            </h2>
                        </div>
                        <div class="body">
						<?php echo form_open(current_url()); ?>
							<div class="form-group form-float">
								<div class="form-line">
									<?php echo lang('edit_group_name_label', 'group_name', 'class="form-label"'); ?> 
									<?php echo form_input($group_name); ?>
							    </div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<?php echo lang('edit_group_desc_label', 'description', 'class="form-label"'); ?> 
									<?php echo form_input($group_description); ?>
							    </div>
							</div>
							<div class="form-group form-float">
								<?php echo form_submit('submit', lang('edit_group_submit_btn'), 'class="btn btn-primary waves-effect"'); ?>
								<?php echo anchor('user', 'Kembali', 'class="btn btn-warning waves-effect"'); ?>
							</div>
						<?php echo form_close();?>
						</div>
					</div>
				</div>
			</div>
            <!-- #END# Basic Alerts -->
		</div>
	</section>
