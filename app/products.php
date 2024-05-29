<?php $this->layout('template') ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Paket Wisata Pindul</h2>
                <ol>
                    <li><a href="<?php echo $base_url ?>">Home</a></li>
                    <li>Paket Wisata Pindul</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
        <!-- <div class="container" data-aos="fade-up"> -->
        <div class="container">

            <div class="section-title">
                <h2>Paket Wisata Pindul</h2>
                <?= $headlayanan['deskripsi'] ?>
            </div>

            <div class="row justify-content-center">

                <?php foreach ($products as $row) : ?>
                    <!-- <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100"> -->
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="member w-100 d-flex flex-column">
                            <div class="member-img ratio ratio-1x1">
                                <img src="images/produk/<?= $row['gambar'] ?>.webp" class="img-fluid" alt="">
                                <!-- <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div> -->
                            </div>
                            <div class="member-info">
                                <h4><?= $row['judul'] ?></h4>
                                <span class="fs-6 fw-bolder" style="color: #ff6532 !important;"><i class="bi bi-wallet2 my-float">&nbsp;</i> <?= $row['harga'] ?></span>
                            </div>
                            <div class="p-2 mt-auto">
                                <a href="paket-wisata-<?php echo $row['judul_seo']?>-<?php echo $row['id_produk']?>" class="btn btn-green px-2 py-2 w-100"><i class="bi bi-info-circle my-float">&nbsp;</i> Info Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>

        </div>
    </section><!-- End Team Section -->

</main><!-- End #main -->