
   <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Referensi profesi
                </h2>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Di bawah ini adalah list data dari referensi profesi
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons" data-toggle="tooltip" data-placement="top" title="More Action">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><?php echo anchor(site_url('referensi_profesi/tambah_data'), 'Add Data'); ?></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="myTable">
               
									<thead>
										<tr>
											<th>Nama Profesi</th>
											<th width="200px">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($_get_ref as $hasil) :?>
										<tr>
											<td><?php echo htmlspecialchars($hasil->nama_profesi, ENT_QUOTES, 'UTF-8'); ?></td>
											<td><?php echo anchor('referensi_profesi/ubah_data/'.$hasil->id_profesi, '<button type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float">
												<i class="material-icons" data-toggle="tooltip" data-placement="top" title="Edit">edit</i>
											</button>'); ?> 
											
											</td>
											
										</tr>
										<?php endforeach; ?>
									</tbody>
									<tfoot>
										<tr>
											<th>Nama Profesi</th>
											<th width="200px">Aksi</th>
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
	