		
		<div class="bg"></div>
		<div class="title">
			<span class="subtitle  white-text"><h2 data-aos="fade-down">Sistem Informasi Alumni</h2></span><br>
			<?php echo anchor('#testimoni', 'testimoni', 'class="waves-effect waves-light btn-large blue accent-4" data-aos="fade-left"'); ?>
			<?php echo anchor('auth/login', 'Login', 'class="waves-effect waves-light btn-large teal accent-4" data-aos="fade-left"'); ?>
		</div>
		<div class="container">
			<div class="row">			
				<a id="testimoni" class="line"><h4 class="margin h1" data-aos="zoom-out" data-aos-duration="500">Testimoni Alumni</h4></a>
				
				<!-- Slideshow container -->
				<div class="slideshow-container" data-aos="zoom-in-down" data-aos-duration="500">

				<!-- Full-width slides/quotes -->
				<?php foreach ($_get_is_tampil as $row) :?>
				<div class="mySlides" data-aos="zoom-in-down" data-aos-duration="500">
				<q class="light justify" data-aos="zoom-in-down" data-aos-duration="500"><?php echo $row->testimoni; ?></q>
				<p class="author" data-aos="zoom-in-down" data-aos-duration="500"><?php echo ucfirst($row->first_name); ?> <?php echo ucfirst($row->last_name); ?>- Alumni <?php echo $row->tahun_lulus; ?></p>
				</div>
				<?php endforeach; ?>


				<!-- Next/prev buttons -->
				<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
				<a class="next" onclick="plusSlides(1)">&#10095;</a>
				</div>

				<!-- Dots/bullets/indicators -->
				<div class="dot-container">
					<?php foreach ($_get_is_tampil as $row) :?>
						<span class="dot" onclick="currentSlide(<?php echo $row->id_testimoni; ?>)"></span> 
					<?php endforeach; ?>
				</div>

				
			</div>
		</div>
		
</div>