<div class="container">    
	<a class="line"><h4 class="margin h1" data-aos="zoom-out" data-aos-duration="500">Detail data dari : <?php echo $first_name; ?> <?php echo $last_name; ?></h4></a>
		
		<div id="demo">
		<?php if (isset($message)):
         echo  '<p data-aos="zoom-out" data-aos-duration="500">'.$message.'</p>';
        else:
            echo '
				<div class="table-responsive-vertical shadow-z-1">
				<table id="table" class="table table-hover table-striped table-bordered table-mc-light-blue" data-aos="zoom-out" data-aos-duration="500">					
                <tr>
                    <td colspan="3">Biodata diri;</td>
                </tr>
                <tr>
                    <td>NISN</td>
                    <td>:</td>
                    <td>'.$nisn.'</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>'.$first_name.' '.$last_name.'</td>
                </tr>
                <tr>
                    <td>Tempat Tanggal Lahir</td>
                    <td>:</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Nomor Telp.</td>
                    <td>:</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Tahun Masuk</td>
                    <td>:</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Tahun Lulus</td>
                    <td>:</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>No. Ijazah</td>
                    <td>:</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>No. SKHUN</td>
                    <td>:</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Detail status</td>
                    <td>:</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3">Orang Tua;</td>
                </tr>
                <tr>
                    <td>Nama Ayah</td>
                    <td>:</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Pekerjaan Ayah</td>
                    <td>:</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Nama Ibu</td>
                    <td>:</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Pekerjaan Ibu</td>
                    <td>:</td>
                    <td>&nbsp;</td>
                </tr>	
				
				</table>
				</div>
				';
        endif; ?>
		
		</div>
		
</div>