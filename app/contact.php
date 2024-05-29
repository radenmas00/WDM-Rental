<?php $this->layout('template') ?>

<div class="container-xxl py-5">
	<div class="container">
		<h1 class="display-6 text-primary mb-0">Kontak Kami</h1>
		<h6 class="mb-2"><?= $namaweb ?></h6>
		<div class="bg-light p-4 py-3 mb-4 rounded d-flex justify-content-between flex-column flex-md-row">
			<!-- <h6 class="mb-0"><?= $namaweb ?></h6> -->
			<nav aria-label="breadcrumb animated slideInDown">
				<ol class="breadcrumb mb-0">
					<li class="breadcrumb-item"><a href="<?php echo $base_url ?>">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Kontak Kami</li>
				</ol>
			</nav>
		</div>

		<hr class="mb-4">

		<div class="row g-5 align-items-center">
			<div class="col-lg-7 wow fadeInUp" data-wow-delay="0.5s">
				<div class="desc-box me-0 me-lg-4">
					<?= $kontak['deskripsi'] ?>
				</div>
				<div class="ratio ratio-16x9">
					<picture>
						<source srcset="images/<?= $kontak['gambar'] ?>.webp" class="img-fluid shadow" type="image/webp" style="object-fit: cover; object-position: center;">
						<img src="images/<?= $kontak['gambar'] ?>" class="img-fluid shadow" style="object-fit: cover; object-position: center;">
					</picture>
					<!-- <img class="img-fluid shadow" src="images/<?= $kontak['gambar'] ?>.webp" alt="" style="object-fit: cover; object-position: center;" /> -->
				</div>
			</div>
			<div class="col-lg-5 wow fadeInUp ps-lg-0" data-wow-delay="0.1s">
				<div class="row m-0 p-0 g-4">
					<div class="col-12 bg-light p-4 rounded wow fadeInUp" data-wow-delay="0.5s">
						<div class="d-flex flex-column">
							<div class="h5 text-blue-primary">
								<i class="fa fa-map-marker-alt me-2"></i> Alamat
							</div>
							<div><?= $deskrip[22] ?></div>
						</div>
					</div>

					<div class="col-12 bg-light p-4 rounded wow fadeInUp" data-wow-delay="0.5s">
						<div class="d-flex flex-column">
							<div class="h5 text-blue-primary">
								<i class="fa fa-phone-alt me-2"></i> Telepon
							</div>
							<div><?= $deskrip[10] ?></div>
						</div>
					</div>

					<div class="col-12 bg-light p-4 rounded wow fadeInUp" data-wow-delay="0.5s">
						<div class="d-flex flex-column">
							<div class="h5 text-blue-primary">
								<i class="fab fa-whatsapp me-2"></i> Whatsapp
							</div>
							<div><?= $deskrip[7] ?></div>
						</div>
					</div>

					<div class="col-12 bg-light p-4 rounded wow fadeInUp" data-wow-delay="0.5s">
						<div class="d-flex flex-column">
							<div class="h5 text-blue-primary">
								<i class="fa fa-envelope me-2"></i> E-mail
							</div>
							<div><?= $deskrip[9] ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>