<?php $this->layout('template') ?>

<div class="container-xxl py-5">
    <div class="container">
        <h1 class="display-6 text-primary mb-0">Galeri</h1>
        <h6 class="mb-2"><?= $namaweb ?></h6>
        <div class="bg-light p-4 py-3 mb-4 rounded d-flex justify-content-between flex-column flex-md-row">
            <!-- <h6 class="mb-0"><?= $namaweb ?></h6> -->
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo $base_url ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <?php foreach ($galeri as $row) : ?>
                <div class="col-md-6 col-lg-4 p-2 m-0">
                    <div class="gallery-item w-100 rounded ratio ratio-1x1" style="overflow: hidden;">
                        <div class="w-100 h-100 position-absolute d-flex align-items-end gallery-overlay" style="background: linear-gradient(rgba(28, 55, 188, .75), rgba(28, 55, 188, .75)); z-index: 1;">
                            <div class="p-4">
                                <h5 class="text-white"><?= $row['nama'] ?></h5>
                                <div class="mt-auto">
                                    <a href="images/gallery/<?= $row['gambar'] ?>" class="btn btn-white-outline px-4 glightbox" data-glightbox="title: <?= $row['nama'] ?>;"><i class="fas fa-search-plus me-1"></i>Lihat</a>
                                </div>
                            </div>
                        </div>
                        <picture>
                            <source srcset="images/gallery/<?= $row['gambar'] ?>.webp" class="img-fluid w-100 h-100" type="image/webp"  style="object-fit: cover; object-position: center;">
                            <img src="images/gallery/<?= $row['gambar'] ?>" class="img-fluid w-100 h-100"  style="object-fit: cover; object-position: center;">
                        </picture>
                        <!-- <img class="img-fluid" src="images/gallery/<?= $row['gambar'] ?>.webp" alt="" style="object-fit: cover; object-position: center;"> -->
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>