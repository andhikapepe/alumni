
   <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Detail Kritik & Saran
                </h2>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Berikut ini adalah detail data Kritik dan Saran dari <i><?php echo htmlspecialchars(humanize($first_name), ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars(humanize($last_name), ENT_QUOTES, 'UTF-8'); ?></i>
                            </h2>
                            
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover">
                               
                                <tr><td>Kritik</td><td><?php echo $kritik; ?></td></tr>
                                <tr><td>Saran</td><td><?php echo $saran; ?></td></tr>
                                <tr><td></td><td><a href="<?php echo site_url('kritik_saran/list_admin'); ?>" class="btn btn-flat btn-default">Kembali</a></td></tr>
                            </table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>