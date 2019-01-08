	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2><?php echo strtoupper(lang('deactivate_heading')); ?></h2>
            </div>

            <!-- Basic Alerts -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo sprintf(lang('deactivate_subheading'), $user->username); ?>
                            </h2>
                        </div>
                        <div class="body">
							<?php echo form_open('user/deactivate/'.$user->id); ?>
  						    <div>									
								<input type="radio" name="confirm" id="confirm1" value="yes" class="with-gap" checked="checked" />
								<?php echo lang('deactivate_confirm_y_label', 'confirm1'); ?>									
								<input type="radio" name="confirm" id="confirm2" value="no" class="with-gap"/>
								<?php echo lang('deactivate_confirm_n_label', 'confirm2'); ?>
							</div>
							    <?php echo form_hidden($csrf); ?>
								<?php echo form_hidden(array('id' => $user->id)); ?>
  							    <?php echo form_submit('submit', lang('deactivate_submit_btn'), 'class="btn btn-primary waves-effect"', 'onsubmit="alert()"'); ?>
								  
								<?php echo form_close();?>
						</div>
					</div>
				</div>
			</div>
            <!-- #END# Basic Alerts -->
		</div>
	</section>