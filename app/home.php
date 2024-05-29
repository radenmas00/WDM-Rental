<?php $this->layout('template') ?>

<div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel carousel-fade slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $counter = 1;
            foreach ($slider as $row) :
            ?>
                <div class="carousel-item <?= ($counter <= 1) ? 'active' : ''; ?>">
                    <picture>
                        <source srcset="images/slider/<?= $row['gambar'] ?>.webp" class="img-fluid w-100" type="image/webp">
                        <img src="images/slider/<?= $row['gambar'] ?>" class="img-fluid w-100">
                    </picture>
                    <!-- <img class="img-fluid w-100" src="images/slider/<?= $row['gambar'] ?>" alt="Image" /> -->
                </div>
            <?php
                $counter++;
            endforeach;
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="rounded-pill bg-light d-inline-block px-5 py-2 mb-4 fw-bold text-uppercase small text-center">
                    Welcome to <?= $namaweb ?>
                </div>
                <div class="desc-box"><?= $welcome['deskripsi'] ?></div>
            </div>
            <div class="col-lg-6" data-wow-delay="0.1s">

                <h3 class="text-primary">Testimoni Kami</h3>
                <p>Testimoni langsung dari para klien kami.</p>
                <hr>

                <div class="owl-carousel testimoni-carousel wow fadeInUp" data-wow-delay="0.1s">
                    <?php foreach ($testimoni as $row) : ?>
                        <div class="gallery-item d-flex flex-column align-items-stretch h-100 p-4" data-wow-delay="0.1s">
                            <div class="d-flex align-items-center">
                                <!-- <picture>
                                    <source srcset="images/testimoni/<?= $row['gambar'] ?>.webp" class="rounded-circle me-3" type="image/webp" style="height: 50px; width: 50px;">
                                    <img src="images/testimoni/<?= $row['gambar'] ?>" class="rounded-circle me-3" style="height: 50px; width: 50px;">
                                </picture> -->
                                <picture>
                                    <source srcset="images/testimoni/<?= $row['gambar'] ?>.webp" class="rounded-circle me-3" type="image/webp" style="height: 50px; width: 50px;">
                                    <img src="images/testimoni/<?= $row['gambar'] ?>" class="rounded-circle me-3" style="height: 50px; width: 50px;">
                                </picture>
                                <!--<img src="images/testimoni/<?= $row['gambar'] ?>" alt="" class="rounded-circle me-3" style="height: 50px; width: 50px;">-->
                                <div>
                                    <h5 class="mb-0"><?= $row['nama'] ?></h5>
                                    <small class="fst-italic">Testimoni ini diambil dari Google Review</small>
                                </div>
                            </div>
                            <div class="mt-4 bg-light p-4 rounded">
                                <?= $row['deskripsi'] ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>

                <div class="review-widget_net mt-4" data-uuid="f0ba530c-5ffb-4e7a-a64e-5a2f7c859502" data-template="2" data-filter="" data-lang="en" data-theme="light"><a href="https://www.review-widget.net/" target="_blank" rel="noopener"><img src="https://grwapi.net/assets/spinner/spin.svg" title="Google Review Widget" alt="Google Review Widget"></a></div>
                <script async type="text/javascript" src="https://grwapi.net/widget.min.js"></script>

                <!-- <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
                <div class="elfsight-app-2edc3659-3ba4-4cce-ac8e-e8ec503103e1"></div> -->
            </div>
        </div>
    </div>
</div>

<div class="container-fluid overflow-hidden py-5" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(images/<?= $headerpaket['gambar'] ?>) center center; background-size: cover;">
    <div class="container text-center">
        <div class="wow fadeIn rounded-pill bg-primary d-inline-block px-5 py-2 mb-4 fw-bold text-uppercase small text-white-50" data-wow-delay="0.1s">
            Paket WIsata <?= $namaweb ?>
        </div>
        <div class="wow fadeIn mb-4 text-center" data-wow-delay="0.1s">
            <h1 class="text-primary">Paket Wisata</h1>
            <div><?= $headerpaket['deskripsi'] ?></div>
        </div>

        <div class="row g-4 justify-content-center">
            <?php foreach ($paketwisata as $row) : ?>
                <div class="col-lg-4 col-md-12 wow fadeInUp d-flex align-items-stretch" data-wow-delay="0.1s">
                    <div class="card rounded shadow w-100 border-0 h-100 text-start">
                        <picture>
                            <source srcset="images/paketwisata/<?= $row['gambar'] ?>.webp" class="card-img-top rounded-top" type="image/webp">
                            <img src="images/paketwisata/<?= $row['gambar'] ?>" class="card-img-top rounded-top">
                        </picture>
                        <!-- <img src="images/paketwisata/<?= $row['gambar'] ?>.webp" class="card-img-top rounded-top" alt="..."> -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $row['judul'] ?></h5>
                            <div class="text-blue-primary fw-bold">Rp. <?= number_format($row['harga']) ?></div>
                            <!-- <div class="card-text">
                                <?= $row['deskripsi'] ?>
                            </div> -->
                            <div class="mt-auto">
                                <hr>
                                <div class="d-grid gap-2 d-md-flex">
                                    <a href="paketwisata-<?= $row['judul_seo'] . "-" . $row['id_paketwisata'] ?>" class="btn btn-blue-outline px-4 flex-md-fill"><i class="fas fa-info-circle"></i> Details</a>
                                    <a href="https://api.whatsapp.com/send?phone=<?= $deskrip[7] ?>&text=Halo <?= $namaweb ?>, Saya mau booking paket wisata *<?= $row['judul'] ?>*." target="_blank" class="btn btn-blue px-4 flex-md-fill"><i class="fab fa-whatsapp"></i> Book</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container text-center">
        <div class="rounded-pill bg-light d-inline-block px-5 py-2 mb-4 fw-bold text-uppercase small">
            Rental Mobil <?= $namaweb ?>
        </div>
        
        <div class="wow fadeIn mb-4 text-center" data-wow-delay="0.1s">
            <h1 class="text-primary">Rental Mobil Plus Driver</h1>
            <div><?= $headerdriver['deskripsi'] ?></div>
        </div>
        <div class="row g-4 justify-content-center">
            <?php foreach ($kendaraan2 as $row) : ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp d-flex align-items-stretch" data-wow-delay="0.1s">
                    <div class="card rounded shadow w-100 border-0 h-100 text-start">
                        <picture>
                            <source srcset="images/kendaraan2/<?= $row['gambar'] ?>.webp" class="card-img-top rounded-top" type="image/webp">
                            <img src="images/kendaraan2/<?= $row['gambar'] ?>" class="card-img-top rounded-top">
                        </picture>
                        <!-- <img src="images/kendaraan/<?= $row['gambar'] ?>.webp" class="card-img-top rounded-top" alt="..."> -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $row['judul'] ?></h5>
                            
                            <?php if($row['harga'] && $row['harga'] != 0) { ?>
                                <div class="text-blue-primary fw-bold">Rp. <?= number_format($row['harga']) ?> / 12 Jam</div>
                            <?php } ?>
                            
                            <?php if($row['harga2'] && $row['harga2'] != 0) { ?>
                                <div class="text-blue-primary fw-bold">Rp. <?= number_format($row['harga2']) ?> / 24 Jam</div>
                            <?php } ?>
                            
                            <!--<div class="mt-2 fst-italic">*Tambahan 25K untuk Matic</div>-->
                            <!-- <div class="card-text">
                                <?= $row['deskripsi'] ?>
                            </div> -->
                            <div class="mt-auto">
                                <hr>
                                <a href="https://api.whatsapp.com/send?phone=<?= $deskrip[7] ?>&text=Halo <?= $namaweb ?>, Saya mau booking mobil *<?= $row['judul'] ?>*." target="_blank" class="d-block btn btn-blue px-4"><i class="fab fa-whatsapp"></i> Booking Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <a href="rentaldriver" class="btn btn-blue-outline px-4 flex-md-fill mt-4 wow fadeInUp" data-wow-delay="0.1s">Lihat Semua List Kendaraan <i class="fas fa-arrow-right ms-2"></i></a>
        
        <hr>
        
        <div class="wow fadeIn my-4 text-center" data-wow-delay="0.1s">
            <h1 class="text-primary">Rental Mobil All In</h1>
            <div><?= $headerallin['deskripsi'] ?></div>
        </div>
        <div class="row g-4 justify-content-center">
            <?php foreach ($kendaraan3 as $row) : ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp d-flex align-items-stretch" data-wow-delay="0.1s">
                    <div class="card rounded shadow w-100 border-0 h-100 text-start">
                        <picture>
                            <source srcset="images/kendaraan3/<?= $row['gambar'] ?>.webp" class="card-img-top rounded-top" type="image/webp">
                            <img src="images/kendaraan3/<?= $row['gambar'] ?>" class="card-img-top rounded-top">
                        </picture>
                        <!-- <img src="images/kendaraan/<?= $row['gambar'] ?>.webp" class="card-img-top rounded-top" alt="..."> -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $row['judul'] ?></h5>
                            <?php if($row['harga'] && $row['harga'] != 0) { ?>
                                <div class="text-blue-primary fw-bold">Rp. <?= number_format($row['harga']) ?> / 12 Jam</div>
                            <?php } ?>
                            
                            <?php if($row['harga2'] && $row['harga2'] != 0) { ?>
                                <div class="text-blue-primary fw-bold">Rp. <?= number_format($row['harga2']) ?> / 24 Jam</div>
                            <?php } ?>
                            <!--<div class="mt-2 fst-italic">*Tambahan 25K untuk Matic</div>-->
                            <!-- <div class="card-text">
                                <?= $row['deskripsi'] ?>
                            </div> -->
                            <div class="mt-auto">
                                <hr>
                                <a href="https://api.whatsapp.com/send?phone=<?= $deskrip[7] ?>&text=Halo <?= $namaweb ?>, Saya mau booking mobil *<?= $row['judul'] ?>*." target="_blank" class="d-block btn btn-blue px-4"><i class="fab fa-whatsapp"></i> Booking Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <a href="rentalallin" class="btn btn-blue-outline px-4 flex-md-fill mt-4 wow fadeInUp" data-wow-delay="0.1s">Lihat Semua List Kendaraan <i class="fas fa-arrow-right ms-2"></i></a>
        
        <hr>
        
        <div class="wow fadeIn my-4 text-center" data-wow-delay="0.1s">
            <h1 class="text-primary">Rental Mobil Lepas Kunci</h1>
            <div><?= $headerrental['deskripsi'] ?></div>
        </div>
        <div class="row g-4 justify-content-center">
            <?php foreach ($kendaraan as $row) : ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp d-flex align-items-stretch" data-wow-delay="0.1s">
                    <div class="card rounded shadow w-100 border-0 h-100 text-start">
                        <picture>
                            <source srcset="images/kendaraan/<?= $row['gambar'] ?>.webp" class="card-img-top rounded-top" type="image/webp">
                            <img src="images/kendaraan/<?= $row['gambar'] ?>" class="card-img-top rounded-top">
                        </picture>
                        <!-- <img src="images/kendaraan/<?= $row['gambar'] ?>.webp" class="card-img-top rounded-top" alt="..."> -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $row['judul'] ?></h5>
                            <div class="text-blue-primary fw-bold">Rp. <?= number_format($row['harga']) ?> / 12 Jam</div>
                            <div class="text-blue-primary fw-bold">Rp. <?= number_format($row['harga2']) ?> / 24 Jam</div>
                            <div class="mt-2 fst-italic">*Tambahan 25K untuk Matic</div>
                            <!-- <div class="card-text">
                                <?= $row['deskripsi'] ?>
                            </div> -->
                            <div class="mt-auto">
                                <hr>
                                <a href="https://api.whatsapp.com/send?phone=<?= $deskrip[7] ?>&text=Halo <?= $namaweb ?>, Saya mau booking mobil *<?= $row['judul'] ?>*." target="_blank" class="d-block btn btn-blue px-4"><i class="fab fa-whatsapp"></i> Booking Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <a href="rentallepaskunci" class="btn btn-blue-outline px-4 flex-md-fill mt-4 wow fadeInUp" data-wow-delay="0.1s">Lihat Semua List Kendaraan <i class="fas fa-arrow-right ms-2"></i></a>
    </div>
</div>

<div class="container-xxl">
    <div class="container">
        <hr>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="rounded-pill bg-light d-inline-block px-5 py-2 mb-4 fw-bold text-uppercase small text-center">
                Artikel Terkini <?= $namaweb ?>
            </div>
        </div>
        <div class="wow fadeIn mb-4 text-center" data-wow-delay="0.1s">
            <h1 class="text-primary">Artikel Terkini</h1>
        </div>

        <div class="row g-4 align-items-center">
            <div class="col-12 col-md-6">
                <div class="w-100 rounded ratio ratio-16x9" style="overflow: hidden;">
                    <!-- <div class="w-100 h-100 position-absolute" style="background: linear-gradient(rgba(28, 55, 188, .0), rgba(28, 55, 188, .9)); z-index: 1;"></div> -->
                    <picture class="w-100 h-100">
                        <source srcset="images/artikel/<?= $artikelterbaru['gambar'] ?>.webp" class="img-fluid w-100 h-100" type="image/webp" style="object-fit: cover; object-position: center;">
                        <img src="images/artikel/<?= $artikelterbaru['gambar'] ?>" class="img-fluid w-100 h-100" style="object-fit: cover; object-position: center;">
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

<div class="container-xxl">
    <div class="container">
        <hr>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="rounded-pill bg-light d-inline-block px-5 py-2 mb-4 fw-bold text-uppercase small">
                Galeri <?= $namaweb ?>
            </div>
        </div>
        <div class="wow fadeIn mb-4 text-center" data-wow-delay="0.1s">
            <h1 class="text-primary">Galeri</h1>
        </div>

        <div class="owl-carousel gallery-carousel wow fadeInUp" data-wow-delay="0.1s">
            <?php foreach ($gallery as $row) : ?>
                <div class="gallery-item d-flex align-items-stretch h-100" data-wow-delay="0.1s">
                    <div class="w-100 rounded ratio ratio-1x1" style="overflow: hidden;">
                        <div class="w-100 h-100 position-absolute d-flex align-items-end gallery-overlay" style="background: linear-gradient(rgba(28, 55, 188, .75), rgba(28, 55, 188, .75)); z-index: 1;">
                            <div class="p-4">
                                <h5 class="text-white"><?= $row['nama'] ?></h5>
                                <div class="mt-auto">
                                    <a href="images/gallery/<?= $row['gambar'] ?>" class="btn btn-white-outline px-4 glightbox" data-glightbox="title: <?= $row['nama'] ?>;"><i class="fas fa-search-plus me-1"></i>Lihat</a>
                                </div>
                            </div>
                        </div>

                        <picture>
                            <source srcset="images/gallery/<?= $row['gambar'] ?>.webp" class="img-fluid w-100 h-100" type="image/webp" style="object-fit: cover; object-position: center;">
                            <img src="images/gallery/<?= $row['gambar'] ?>" class="img-fluid w-100 h-100" style="object-fit: cover; object-position: center;">
                        </picture>
                        <!-- <img class="img-fluid" src="images/gallery/<?= $row['gambar'] ?>.webp" alt="" style="object-fit: cover; object-position: center;"> -->
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>