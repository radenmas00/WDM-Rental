<?php $this->layout('template') ?>

<main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><?= $data['judul'] ?></h2>
                <ol>
                    <li><a href="<?php echo $base_url ?>">Home</a></li>
                    <li><a href="paket-wisata">Paket Wisata Pindul</a></li>
                    <li><?= $data['judul'] ?></li>
                </ol>
            </div>

        </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <img src="images/produk/<?= $data['gambar'] ?>" alt="" class="img-fluid rounded w-100" style="object-fit: cover;">
                        </div>
                    </div>
                    <div class="portfolio-description">
                        <div class="text-muted mb-3 fs-6" role="alert">
                            <small><i class="bi bi-calendar my-float">&nbsp;</i> Diposting pada tanggal <strong><?= tgl2($data['tgl']) ?></strong> oleh <strong>Admin</strong></small>
                        </div>

                        <h2><?= $data['judul'] ?></h2>
                        <h4 style="color: #ff6532;" class="fw-bold"><?= $data['harga'] ?></h4>
                        <div class="mt-4">
                            <?= $data['deskripsi'] ?>
                        </div>

                        <a href="https://api.whatsapp.com/send?phone=<?= $deskrip[7] ?>&text=Halo <?= $namaweb ?>, Saya mau memesan layanan *<?= $data['judul'] ?>*." target="_blank" class="btn btn-success px-5 py-2 mb-3 d-block d-lg-inline-block"><i class="bi bi-whatsapp my-float">&nbsp;</i> Booking Sekarang!</a>

                        <!-- AddToAny BEGIN -->
                        <div class="alert alert-light" role="alert">
                            <div class="a2a_kit a2a_kit_size_24 a2a_default_style">
                                <a class="fw-bold text-muted me-2 lh-base"><i class="bi bi-share my-float">&nbsp;</i> Bagikan : </a>
                                <!-- <a class="a2a_dd" href="https://www.addtoany.com/share"></a> -->
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_email"></a>
                                <a class="a2a_button_whatsapp"></a>
                                <a class="a2a_button_google_gmail"></a>
                            </div>
                        </div>

                        <!-- AddToAny END -->
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info">
                        <h3>Paket Wisata Lainnya</h3>

                        <?php foreach ($products as $row) : ?>
                            <div class="card border-0">
                                <div class="card-body p-2 d-flex align-items-center justify-content-between">
                                    <div class="bg-dark">
                                        <img src="images/produk/<?= $row['gambar'] ?>" alt="" class="img-fluid" style="max-width: 75px; object-fit: cover;">
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <a href="paket-wisata-<?php echo $row['judul_seo']?>-<?php echo $row['id_produk']?>" class="fw-bold"><?= $row['judul'] ?></a> <br>
                                        <div class="mt-1" style="font-size: 12px;"><i class="bi bi-calendar my-float">&nbsp;</i> Diposting tanggal <strong><?= tgl2($row['tgl']) ?></strong></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>

                        <div class="mt-3">
                            <a href="paket-wisata">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

<script async src="https://static.addtoany.com/menu/page.js"></script>