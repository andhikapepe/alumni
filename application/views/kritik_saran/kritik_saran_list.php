
   <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Daftar Kritik & Saran
                </h2>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Di bawah ini adalah list data dari kritik & saran
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-exportable dataTable">
               
								<thead>
										<tr>
											<th>Nama</th>
											<th width = "150">Kritik</th>
											<th width = "150">Saran</th>
											<th>Tanggal Posting</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($_get_kritiksaran as $row):?>
											<tr>
												<td><?php echo htmlspecialchars(humanize($row->first_name), ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars(humanize($row->last_name), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo character_limiter($row->kritik, 50); ?></td>
                                                <td><?php echo character_limiter($row->saran, 50); ?></td>
												<td><?php echo htmlspecialchars(indonesian_date($row->tanggal_posting), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>	
												<?php echo anchor('kritik_saran/read/'.$row->id_kritiksaran, '<button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
													<i class="material-icons" data-toggle="tooltip" data-placement="top" title="Detail">list</i>
                                                </button>'); ?>
												<?php echo anchor('kritik_saran/delete/'.$row->id_kritiksaran, '<button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
													<i class="material-icons" data-toggle="tooltip" data-placement="top" title="Hapus">delete</i>
                                                </button>'); ?>
												
                                                </td>
											</tr>
										<?php endforeach; ?>
									</tbody>
									<tfoot>
										<tr>
											<th>Nama</th>
											<th width = "150">Kritik</th>
											<th width = "150">Saran</th>
											<th>Tanggal Posting</th>
											<th>Aksi</th>
										</tr>
									</tfoot>
			
           
							</div>
						</div>
					</div>
				</div>
            <!-- #END# Basic Alerts -->
		</div>
	</section>
	