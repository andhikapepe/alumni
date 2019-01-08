<section class="content">
<div class="container-fluid">
            <div class="block-header">
                <h2><?php echo strtoupper(lang('index_heading')); ?></h2>
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
                                <?php echo lang('index_subheading'); ?>
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
											<th><?php echo lang('index_fname_th'); ?></th>
											<th><?php echo lang('index_lname_th'); ?></th>
											<th><?php echo lang('index_email_th'); ?></th>
											<th><?php echo lang('index_groups_th'); ?></th>
											<th><?php echo lang('index_status_th'); ?></th>
											<th><?php echo lang('index_action_th'); ?></th>
										</tr>
                                    </thead>                                    
                                    <tbody>                                        
										<?php foreach ($users as $user):?>
											<tr>
												<td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
												<td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
												<td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
												<td>
													<?php foreach ($user->groups as $group):?>
														<?php echo anchor('user/edit_group/'.$group->id, htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8')); ?><br />
													<?php endforeach; ?>
												</td>
												<td><?php echo ($user->active) ? anchor('user/deactivate/'.$user->id, lang('index_active_link')) : anchor('user/activate/'.$user->id, lang('index_inactive_link')); ?></td>
												<td>
												<?php foreach ($user->groups as $group):?>
												
												<?php endforeach; ?>
												<?php echo anchor('user/edit_user/'.$user->id, '<button type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float">
													<i class="material-icons" data-toggle="tooltip" data-placement="top" title="Edit">edit</i>
												</button>'); ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
									<tfoot>
                                        <tr>
											<th><?php echo lang('index_fname_th'); ?></th>
											<th><?php echo lang('index_lname_th'); ?></th>
											<th><?php echo lang('index_email_th'); ?></th>
											<th><?php echo lang('index_groups_th'); ?></th>
											<th><?php echo lang('index_status_th'); ?></th>
											<th><?php echo lang('index_action_th'); ?></th>
										</tr>
                                    </tfoot>
								</table>								
							</div>
							
						</div>
					</div>
				</div>
            <!-- #END# Basic Alerts -->
		</div>
</section>