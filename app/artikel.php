<?php $this->layout('template') ?>

<div class="container-xxl py-5">
    <div class="container">
        <h1 class="display-6 text-primary mb-0">Artikel</h1>
        <h6 class="mb-2"><?= $namaweb ?></h6>
        <div class="bg-light p-4 py-3 mb-4 rounded d-flex justify-content-between flex-column flex-md-row">
            <!-- <h6 class="mb-0"><?= $namaweb ?></h6> -->
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo $base_url ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Artikel</li>
                </ol>
            </nav>
        </div>

        <hr class="mb-4">

        <div class="row g-4 align-items-center">
            <div class="col-12 col-md-6">
                <div class="w-100 rounded ratio ratio-16x9" style="overflow: hidden;">
                    <!-- <div class="w-100 h-100 position-absolute" style="background: linear-gradient(rgba(28, 55, 188, .0), rgba(28, 55, 188, .9)); z-index: 1;"></div> -->
                    <picture>
                        <source srcset="images/artikel/<?= $artikelterbaru['gambar'] ?>.webp" class="img-fluid" type="image/webp" style="object-fit: cover; object-position: center;">
                        <img src="images/artikel/<?= $artikelterbaru['gambar'] ?>" class="img-fluid" style="object-fit: cover; object-position: center;">
                    </picture>
                    <!-- <img class="img-fluid" src="images/artikel/<?= $artikelterbaru['gambar'] ?>.webp" alt="" style="object-fit: cover; object-position: center;"> -->
                </div>
            </div>

            <div class="col-12 col-md-6">
                <h5><a href="artikel-<?= $artikelterbaru['judul_seo'] . "-" . $artikelterbaru['id_artikel'] ?>"><?= $artikelterbaru['judul'] ?></a></h5>
                <div class="d-flex mb-3 small">
                    <div class="me-2"><i class="far fa-calendar me-1"></i><a><?= tgl2($artikelterbaru['tgl']) ?></a></div>
                    <div class="me-2"><i class="far fa-user me-1"></i><a>Admin</a></div>
                    <div><i class="far fa-eye me-2"></i><a><?= $artikelterbaru['dilihat'] ?></a></div>
                </div>
                <p><?= limit_desc($artikelterbaru['deskripsi'], 400) ?> ...</p>
                <div class="mt-auto">
                    <a href="artikel-<?= $artikelterbaru['judul_seo'] . "-" . $artikelterbaru['id_artikel'] ?>" class="btn btn-blue-outline px-4">Lihat Selengkapnya</a>
                </div>
            </div>

            <?php foreach ($artikel as $row) : ?>
                <div class="col-12 col-lg-4 d-flex align-items-stretch h-100" data-wow-delay="0.1s">
                    <div class="w-100 rounded ratio ratio-1x1" style="overflow: hidden;">
                        <div class="w-100 h-100 position-absolute" style="background: linear-gradient(rgba(28, 55, 188, .0), rgba(28, 55, 188, .9)); z-index: 1;"></div>
                        <picture>
                            <source srcset="images/artikel/<?= $row['gambar'] ?>.webp" class="img-fluid w-100 h-100" type="image/webp" style="object-fit: cover; object-position: center;">
                            <img src="images/artikel/<?= $row['gambar'] ?>" class="img-fluid w-100 h-100" style="object-fit: cover; object-position: center;">
                        </picture>
                        <!-- <img class="img-fluid" src="images/artikel/<?= $row['gambar'] ?>.webp" alt="" style="object-fit: cover; object-position: center;"> -->
                        <div class="w-100 position-absolute d-flex align-items-end" style="z-index: 1;">
                            <div class="p-4">
                                <h5><a class="text-white" href="artikel-<?= $row['judul_seo'] . "-" . $row['id_artikel'] ?>"><?= $row['judul'] ?></a></h5>
                                <div class="d-flex mb-3 small text-white">
                                    <div class="me-2"><i class="far fa-calendar me-1"></i><a><?= tgl2($row['tgl']) ?></a></div>
                                    <div class="me-2"><i class="far fa-user me-1"></i><a>Admin</a></div>
                                    <div><i class="far fa-eye me-2"></i><a><?= $row['dilihat'] ?></a></div>
                                </div>
                                <!-- <p class="text-white"><?= limit_desc($row['deskripsi'], 100) ?> ...</p> -->
                                <div class="mt-auto">
                                    <a href="artikel-<?= $row['judul_seo'] . "-" . $row['id_artikel'] ?>" class="btn btn-white-outline px-4">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>