
   <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Detail Referensi Tahun
                </h2>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Berikut ini adalah detail data dari Referensi Tahun
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons" data-toggle="tooltip" data-placement="top" title="More Action">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><?php echo anchor(site_url('referensi_tahun/create'), 'Tambah Data'); ?></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover">
	    <tr><td>Ref Tahun</td><td><?php echo $ref_tahun; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('referensi_tahun'); ?>" class="btn btn-flat btn-default">Kembali</a></td></tr>
	</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>