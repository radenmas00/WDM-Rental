<?php
ob_start("minifier");

include "system/show_stat.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#07a0c3">
    <meta name="msapplication-TileColor" content="#FFCB01">
    <meta name="theme-color" content="#fff">

    <!-- SEO Meta Tags-->
    <?= $this->insert('seo') ?>
    <?= $this->insert('stat') ?>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" /> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />-->

    <!-- Libraries Stylesheet -->
    <link href="assets/theme/lib/animate/animate.min.css" rel="stylesheet" />
    <link href="assets/theme/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/theme/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    <!-- Template Stylesheet -->
    <link href="assets/theme/css/style.css?v=<?= date("Y-m-d H:i:s") ?>" rel="stylesheet" />

    <?= $deskrip[84] ?>

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div class="container-fluid bg-dark text-white-50 py-2 px-0">
        <div class="container">
            <div class="row gx-0 align-items-center">
                <div class="col-7 text-start">
                    <div class="h-100 d-inline-flex align-items-center me-4 d-none d-lg-inline">
                        <small class="fa fa-phone-alt me-2"></small>
                        <small><?= $deskrip[10] ?></small>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center me-4 d-none d-lg-inline">
                        <small class="fab fa-whatsapp me-2"></small>
                        <small><?= $deskrip[7] ?></small>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center me-4">
                        <small class="far fa-envelope-open me-2"></small>
                        <small><?= $deskrip[9] ?></small>
                    </div>
                </div>
                <div class="col-5 text-end">
                    <div class="h-100 d-inline-flex align-items-center">
                        <a class="text-white-50 ms-3" href="<?= $sosmed[3]['link'] ?>"><i class="fab fa-instagram"></i></a>
                        <a class="text-white-50 ms-3" href="<?= $sosmed[9]['link'] ?>"><i class="fab fa-instagram"></i></a>
                         <a class="text-white-50 ms-3" href="<?= $sosmed[0]['link'] ?>"><i class="fab fa-facebook-f"></i></a> 
                         <a class="text-white-50 ms-3" href="<?= $sosmed[2]['link'] ?>"><i class="fab fa-youtube"></i></a> 
                         <a class="text-white-50 ms-3" href="<?= $sosmed[1]['link'] ?>"><i class="fab fa-tiktok"></i></a> 
                        <!-- <a class="text-white-50 ms-3" href="<?= $sosmed[8]['link'] ?>"><i class="fab fa-twitter"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top">
        <div class="container">
            <a href="<?php echo $base_url ?>" class="navbar-brand d-flex align-items-center">
                <h1 class="m-0">
                    <img class="img-fluid me-3" src="images/<?= $deskrip[2] ?>" alt="" style="height: 40px;" />
                </h1>
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-lg-0">
                    <a href="<?php echo $base_url ?>" class="nav-item nav-link <?= ($page == 'home') ? 'active' : '' ?>">Home</a>
                    <a href="profile" class="nav-item nav-link <?= ($page == 'profile') ? 'active' : '' ?>">Profile</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?= ($menu == 'rental') ? 'active' : '' ?>" data-bs-toggle="dropdown">Rental Mobil</a>
                        <div class="dropdown-menu bg-light border-0 m-0">
                            <a href="rentaldriver" class="dropdown-item <?= ($page == 'rentaldriver') ? 'active' : '' ?>">Rental Plus Driver</a>
                            <a href="rentalallin" class="dropdown-item <?= ($page == 'rentalallin') ? 'active' : '' ?>">Rental All In</a>
                            <a href="rentallepaskunci" class="dropdown-item <?= ($page == 'rentallepaskunci') ? 'active' : '' ?>">Rental Lepas Kunci</a>
                        </div>
                    </div>
                    <a href="paketwisata" class="nav-item nav-link <?= ($page == 'paketwisata') ? 'active' : '' ?>">Paket Wisata</a>
                    <a href="galeri" class="nav-item nav-link <?= ($page == 'galeri') ? 'active' : '' ?>">Galeri</a>
                    <a href="artikel" class="nav-item nav-link <?= ($page == 'artikel') ? 'active' : '' ?>">Artikel</a>
                    <a href="kontak" class="nav-item nav-link <?= ($page == 'kontak') ? 'active' : '' ?>">Kontak Kami</a>
                </div>
            </div>
        </div>
    </nav>

    <?= $this->section('content') ?>

    <div class="container-fluid overflow-hidden mt-5 py-5"  style="background: linear-gradient(rgba(28, 55, 188, .75), rgba(28,35,74, .9)), url(images/<?= $cta['gambar'] ?>) center center; background-size: cover;">
        <div class="container py-5">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-12 wow fadeIn bg-white p-5 rounded shadow" data-wow-delay="0.1s">
                    <div class="h-100 px-4 ps-lg-0 text-center">
                        <div class="text-primary"><?= $cta['deskripsi'] ?></div>
                        <a href="kontak" class="align-self-start btn btn-blue-outline px-5">Klik Disini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid footer pt-5 wow fadeIn" data-wow-delay="0.1s" style="background-color:#1c234a !important;">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-5">
                    <h5 class="text-white mb-4"><?= $namaweb ?></h5>
                    <p><?= $deskrip[18] ?></p>
                    <div>Sosial Media Kami :</div>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square me-1" href="<?= $sosmed[3]['link'] ?>"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-square me-1" href="<?= $sosmed[9]['link'] ?>"><i class="fab fa-instagram"></i></a>
                         <a class="btn btn-square me-1" href="<?= $sosmed[0]['link'] ?>"><i class="fab fa-facebook-f"></i></a> 
                         <a class="btn btn-square me-1" href="<?= $sosmed[2]['link'] ?>"><i class="fab fa-youtube"></i></a> 
                         <a class="btn btn-square me-1" href="<?= $sosmed[1]['link'] ?>"><i class="fab fa-tiktok"></i></a> 
                        <!-- <a class="btn btn-square me-1" href="<?= $sosmed[8]['link'] ?>"><i class="fab fa-twitter"></i></a> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Kontak</h5>
                    <div class="d-flex">
                        <i class="fa fa-map-marker-alt me-3"></i>
                        <p><?= $deskrip[22] ?></p>
                    </div>
                    <div class="d-flex">
                        <i class="fa fa-phone-alt me-3"></i>
                        <p><?= $deskrip[10] ?></p>
                    </div>
                    <div class="d-flex">
                        <i class="fa fa-envelope me-3"></i>
                        <p><?= $deskrip[9] ?></p>
                    </div>
                </div>
                <!-- <div class="col-lg-2 col-md-6">
                    <h5 class="text-light mb-4">Navigasi</h5>
                    <a class="btn btn-link" href="home">Home</a>
                    <a class="btn btn-link" href="profile">Profile</a>
                    <a class="btn btn-link" href="artikel">Artikel</a>
                    <a class="btn btn-link" href="kontak">Kontak</a>
                    <a class="btn btn-link" href="galeri">Galeri</a>
                </div> -->
                <div class="col-lg-4 col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3953.222949594061!2d110.3563237!3d-7.7661658!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7af940ef5046a5%3A0xde6ecbd2aac845e8!2sHIDRO%20RENT%20CAR%20AND%20TOUR%20JOGJA!5e0!3m2!1sid!2sid!4v1690350546627!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center mb-3 mb-md-0">
                        <div class="text-white" style="font-size: 10px;">
                            Copyright © <script>
                                document.write(new Date().getFullYear());
                            </script> <?= $namaweb ?>. All rights reserved. Developed with ❤️ by <a href="https://jogjamediaweb.com" target="_blank" title="Jasa Buat Website Jogja | JOGJA MEDIA WEB (JMW) | www.jogjamediaweb.com" class="text-white"> JMW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <!--<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>-->

    <div class="contact-btn">
        <div class="d-grid gap-2 d-md-block">
            <a href="https://api.whatsapp.com/send?phone=<?= $deskrip[7] ?>&text=<?= $textBtnWa ?>" class="button-33 px-4" type="button"><i class="fab fa-whatsapp"></i> Hubungi Via Whatsapp</a>
            <!-- <a href="https://api.whatsapp.com/send?phone=<?= $deskrip[87] ?>&text=<?= $textBtnWa ?>" class="button-33 px-4 ms-0 ms-md-2" type="button"><i class="fab fa-whatsapp"></i> Whatsapp 2</a> -->
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script src="assets/theme/lib/wow/wow.min.js"></script>
    <script src="assets/theme/lib/easing/easing.min.js"></script>
    <script src="assets/theme/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/theme/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="assets/theme/lib/counterup/counterup.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets/theme/js/main.js"></script>

</body>

</html>

<?php ob_end_flush() ?>