<div class="container">    
	<a class="line"><h4 class="margin h1" data-aos="zoom-out" data-aos-duration="500">Pencarian Data Alumni</h4></a>
		<br/>
		<br/>
		<?php echo form_open('main/lulusan'); ?>
		<?php echo

            form_input('keyword', '', 'placeholder = "Cari data berdasarkan nisn, nama, tahun lulus, jenis kelamin, nomor ijazah, nomor SKHUN" class = "form-control" data-aos="zoom-out" data-aos-duration="500" autocomplete="off"');
        ?>
		<center>
			<?php echo form_submit('Cari', 'cari', array('class' => 'btn btn-default waves-effect', 'data-aos' => 'zoom-out', 'data-aos-duration' => '500')); ?>
		</center>
		
		<?php echo form_close(); ?>
		<br/>
		<br/>
		<div id="demo">
		<?php if (isset($message)):
         echo  '<p data-aos="zoom-out" data-aos-duration="500">'.$message.'</p>';
        else:
            echo '
				<div class="table-responsive-vertical shadow-z-1">
				<table id="table" class="table table-hover table-mc-light-blue" data-aos="zoom-out" data-aos-duration="500">					
						
				<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>NISN</th>
					<th>Jenis Kelamin</th>
					<th>Tahun Lulus</th>
					<th>No. Ijazah</th>
					<th>No. SKHUN</th>
					<th>Detail</th>
				</tr>
				</thead>
				<tbody>
							
						';
                $i = 1;
                foreach ($_get_keyword as $key) {
                    echo '
					
					<tr>
						<td>'.$i++.'</td>
						<td>'.$key->first_name.' '.$key->last_name.'</td>
						<td>'.$key->nisn.'</td>
						<td>'.$key->jenis_kelamin.'</td>
						<td>'.$key->tahun_lulus.'</td>
						<td>'.$key->no_ijazah.'</td>
						<td>'.$key->no_skhun.'</td>
						<td>'.anchor('main/detail_pencarian/'.$key->id_user.'', 'Lihat Detail').'</td>
					</tr>				
					
					';
                }
                echo '</tbody>
				</table>
				</div>
				';
        endif; ?>
		
		</div>
		
</div>