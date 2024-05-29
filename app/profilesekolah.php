<?php $this->layout('template') ?>

<!-- Header Start -->
<div class="container-fluid bg-primary">
    <div class="d-flex flex-column align-items-center justify-content-center text-center" style="min-height: 300px">
        <h3 class="display-4 font-weight-bold text-white"><?= $pagetitle ?></h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="<?php echo $base_url ?>">Home</a></p>
            <p class="m-0 px-2">/</p>
            <p class="m-0"><?= $pagetitle ?></p>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <p class="section-title pr-5">
            <span class="pr-2">Profile Sekolah</span>
        </p>
        <div class="row">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="row h-100">
                    <div class=" col-12 p-2 d-flex flex-column text-center">
                        <div class="shadow-sm rounded w-100 embed-responsive embed-responsive-1by1" style="background-image: url('images/<?= $profilekepsek['gambar'] ?>'); background-size : cover; background-position : center center;"></div>
                        <!-- <h4 class="mt-4">Kepala Sekolah</h4> -->
                        <div class="display-5 font-weight-bold mt-4">Kepala Sekolah</div>
                        <div class="display-5 font-weight-bold"><?= $profilekepsek['nama_kepsek'] ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <!-- <p class="section-title pr-5">
                    <span class="pr-2">Profile Sekolah</span>
                </p> -->
                <?= $profilesekolah['deskripsi'] ?>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col">
                <!-- <p class="section-title pr-5">
                    <span class="pr-2">Profile Sekolah</span>
                </p> -->
                <?= $profilesekolah2['deskripsi'] ?>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Testimonial Start -->
<div class="container-fluid py-5">
    <div class="container p-0 text-center">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2">Profile Guru</span>
            </p>
            <h1 class="mb-4">Profile Pengajar Yang Ada Di Sekolah Kami</h1>
        </div>

        <?php
        if ($guru) { ?>

            <div class="owl-carousel guru-carousel">

                <?php foreach ($guru as $row) : ?>
                    <div class="testimonial-item px-3 w-100">
                        <div class="card border-0 shadow-sm mb-2 w-100">
                            <!-- <img class="card-img-top embed-responsive embed-responsive-4by3" src="images/testing-slider.png" alt="" /> -->
                            <a href="" class="card-img-top embed-responsive embed-responsive-1by1" alt="" style="background-image: url('images/guru/<?= $row['gambar'] ?>.webp'); background-size : cover; background-position : center center;"></a>
                            <div class="card-body bg-light text-center p-4 d-flex flex-column">
                                <h5 class=""><?= $row['nama'] ?></h5>
                                <p>
                                    <strong><?= $row['jabatan'] ?></strong><br>
                                    <!--Mulai Mengajar Tahun <?= $row['tahun_mengajar'] ?>-->
                                </p>
                            </div>
                        </div>
                    </div>

                <?php endforeach ?>

            </div>

        <?php } else { ?>
            <div class="testimonial-item px-3 w-100">
                <div class="card border-0 mb-2 w-100">
                    <div class="card-body text-center p-4 d-flex flex-column bg-light">
                        <div class="text-muted display-5">
                            Belum ada data guru yang tersedia.
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>
<!-- Testimonial End -->

<!-- Testimonial Start -->
<div class="container-fluid py-5">
    <div class="container p-0">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2">Prestasi</span>
            </p>
            <!-- <h1 class="mb-4">Latest Articles From Blog</h1> -->
        </div>

        <?php
        if ($prestasi) { ?>

            <div class="owl-carousel prestasi-carousel portfolio-container">

                <?php foreach ($prestasi as $row) : ?>
                    <div class="col portfolio-item">
                        <div class="position-relative overflow-hidden mb-2">
                            <div class="card-img-top embed-responsive embed-responsive-1by1" alt="" style="background-image: url('images/prestasi/<?= $row['gambar'] ?>.webp'); background-size : cover; background-position : center center;"></div>
                            <!-- <img class="img-fluid w-100" src="images/prestasi/<?= $row['gambar'] ?>.webp" alt="" style="height: 250px; object-fit: cover;" /> -->
                            <div class="portfolio-btn bg-primary d-flex align-items-center justify-content-center">
                                <a href="images/prestasi/<?= $row['gambar'] ?>.webp" data-lightbox="portfolio">
                                    <i class="fa fa-plus text-white" style="font-size: 60px"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endforeach ?>

            </div>

        <?php } else { ?>
            <div class="testimonial-item px-3 w-100">
                <div class="card border-0 mb-2 w-100">
                    <div class="card-body text-center p-4 d-flex flex-column bg-light">
                        <div class="text-muted display-5">
                            Belum ada data prestasi yang tersedia.
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<!-- Testimonial End -->

<!-- Berita Start -->
<div class="container-fluid py-5">
    <div class="container p-0 text-center">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2">Berita Terbaru</span>
            </p>
            <!-- <h1 class="mb-4">Latest Articles From Blog</h1> -->
        </div>

        <?php
        if ($berita) { ?>

            <div class="row justify-content-center">

                <?php foreach ($berita as $row) : ?>
                    <div class="col-12 col-md-6 col-lg-4 py-3 d-flex align-items-stretch">
                        <div class="card border-0 shadow-sm mb-2">
                            <!-- <img class="card-img-top embed-responsive embed-responsive-4by3" src="images/testing-slider.png" alt="" /> -->
                            <a href="blog-<?= $row['judul_seo'] . "-" . $row['id_artikel'] ?>" class="card-img-top embed-responsive embed-responsive-4by3" alt="" style="background-image: url('images/artikel/<?= $row['gambar'] ?>'); background-size : cover; background-position : center center;"></a>
                            <div class="card-body bg-light text-center p-4 d-flex flex-column">
                                <a href="blog-<?= $row['judul_seo'] . "-" . $row['id_artikel'] ?>" class="h4"><?= $row['judul'] ?></a>
                                <div class="d-flex justify-content-center mb-3">
                                    <small class="mr-3"><i class="fa fa-user text-primary"></i> Admin</small>
                                    <!-- <small class="mr-3"><i class="fa fa-folder text-primary"></i> <?= $row['tingkatan'] ?></small> -->
                                    <small class="mr-3"><i class="fa fa-calendar text-primary"></i> <?= tgl2($row['tgl']) ?></small>
                                </div>
                                <p>
                                    <?= limit_desc($row['deskripsi'], 100) ?> ...
                                </p>
                                <a href="blog-<?= $row['judul_seo'] . "-" . $row['id_artikel'] ?>" class="btn btn-primary px-4 mx-auto my-2 mt-auto">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>

            <div class="small mt-4">Menampilkan <?= $jmlberita ?> dari <?= $jmlberitaall ?> berita yang tersedia</div>
            <a href="berita-<?= $tingkatan ?>" class="btn btn-transparent-primary px-5 py-2 my-2">Lihat Berita Selengkapnya <i class="bi-arrow-right-short"></i></a>

        <?php } else { ?>
            <div class="testimonial-item px-3 w-100">
                <div class="card border-0 mb-2 w-100">
                    <div class="card-body text-center p-4 d-flex flex-column bg-light">
                        <div class="text-muted display-5"> 
                            Belum ada berita yang tersedia.
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

        <!-- <div class="row">
            <div class="col-12 col-md-6 col-lg-4 py-3 d-flex align-items-stretch">
                <div class="card border-0 shadow-sm mb-2">
                    <a href="" class="card-img-top embed-responsive embed-responsive-4by3" alt="" style="background-image: url('assets/theme/img/blog-2.jpg'); background-size : cover; background-position : center center;"></a>
                    <div class="card-body bg-light text-center p-4 d-flex flex-column">
                        <h4 class="">Diam amet eos at no eos</h4>
                        <div class="d-flex justify-content-center mb-3">
                            <small class="mr-3"><i class="fa fa-user text-primary"></i> Admin</small>
                            <small class="mr-3"><i class="fa fa-folder text-primary"></i> TK</small>
                            <small class="mr-3"><i class="fa fa-calendar text-primary"></i> 15 Juni 2023</small>
                        </div>
                        <p>
                            Sed kasd sea sed at elitr sed ipsum justo, sit nonumy diam
                            eirmod, duo et sed sit eirmod kasd clita tempor dolor stet
                            lorem. Tempor ipsum justo amet stet...
                        </p>
                        <a href="" class="btn btn-primary px-4 mx-auto my-2 mt-auto">Read More</a>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
<!-- Berita End -->

<!-- Gallery Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="container text-center">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2">Galeri Kami</span>
            </p>
            <h1 class="mb-4">Beberapa Momen Yang Kami Abadikan</h1>
        </div>

        <?php
        if ($gallery) { ?>

            <div class="row portfolio-container justify-content-center">

                <?php foreach ($gallery as $row) : ?>
                    <div class="col-lg-4 col-md-6 mb-4 portfolio-item">
                        <div class="position-relative overflow-hidden mb-2">
                            <img class="img-fluid w-100" src="images/gallery/<?= $row['gambar'] ?>.webp" alt="" style="height: 250px; object-fit: cover;" />
                            <div class="portfolio-btn bg-primary d-flex align-items-center justify-content-center">
                                <a href="images/gallery/<?= $row['gambar'] ?>.webp" data-lightbox="portfolio">
                                    <i class="fa fa-plus text-white" style="font-size: 60px"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>

            <!-- <div class="small mt-4">Menampilkan <?= $jmlgallery ?> dari <?= $jmlgalleryall ?> gambar yang tersedia</div>
            <a href="" class="btn btn-transparent-primary px-5 py-2 my-2">Lihat Galeri Selengkapnya <i class="bi-arrow-right-short"></i></a> -->

        <?php } else { ?>
            <div class="card border-0 mb-2 w-100">
                <div class="card-body text-center p-4 d-flex flex-column bg-light">
                    <div class="text-muted display-5">
                        Belum ada gambar yang tersedia.
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<!-- Gallery End -->