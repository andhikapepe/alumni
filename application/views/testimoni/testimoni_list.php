
   <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Testimoni
                </h2>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Di bawah ini adalah list data dari testimoni
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
               
									<thead>
										<tr>
											<th>Nama</th>
											<th width="300px">Testimoni</th>
											<th>Tampilkan di publik</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($_get_testimoni as $row):?>
											<tr>
												<td><?php echo htmlspecialchars(humanize($row->first_name), ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars(humanize($row->last_name), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo character_limiter($row->testimoni, 100); ?></td>
                                               	<td><?php echo htmlspecialchars($row->is_tampil, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>	
												<?php echo anchor('testimoni/read_admin/'.$row->id_testimoni, '<button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
													<i class="material-icons" data-toggle="tooltip" data-placement="top" title="Detail">list</i>
                                                </button>'); ?>
												<?php echo anchor('testimoni/update_admin/'.$row->id_testimoni, '<button type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float">
													<i class="material-icons" data-toggle="tooltip" data-placement="top" title="Edit">edit</i>
                                                </button>'); ?>
												
                                                </td>
											</tr>
										<?php endforeach; ?>
									</tbody>
									<tfoot>
										<tr>
											<th>Nama</th>
											<th width="300px">Testimoni</th>
											<th>Tampilkan di publik</th>
											<th>Aksi</th>
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
	