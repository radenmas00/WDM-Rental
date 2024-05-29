<?php $this->layout('template') ?>

<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background: linear-gradient(rgba(19, 58, 98, .9), rgba(19, 58, 98, .9)), url(images/page-header.jpg) center center; background-size: cover;">
    <div class="container py-5">
        <h1 class="display-4 animated slideInDown mb-4"><?= $data['judul'] ?></h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?php echo $base_url ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="barangjasa">Barang & Jasa</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $data['judul'] ?></li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 wow fadeInUp pe-lg-4" data-wow-delay="0.1s">
                <img src="images/barangjasa/<?= $data['gambar'] ?>" alt="" class="img-fluid w-100 mb-4">
                <small class="mb-2"><span><i class="far fa-calendar me-1"></i> <?= tgl2($data['tgl']) ?></span> <span><i class="far fa-user ms-2 me-1"></i> Admin</span><span><i class="far fa-eye ms-2 me-1"></i> <?= $data['dilihat'] ?> Views</span></small>
                <h2 class="mb-3 text-blue-primary"><?= $data['judul'] ?></h2>
                <hr>
                <div>
                    <?= $data['deskripsi'] ?>
                </div>
                <a href="https://api.whatsapp.com/send?phone=<?= $deskrip[7] ?>&text=Halo <?= $namaweb ?>, Saya mau ingin informasi lebih lanjut tentang pengadaan *<?= $data['judul'] ?>*." target="_blank" class="btn btn-blue-outline px-5"><i class="fab fa-whatsapp"></i> Hubungi Kami</a>
                <hr>
                <div class="d-flex justify-content-between">
                    <a class="text-muted me-2 lh-base"><i class="bi bi-share my-float">&nbsp;</i> Bagikan : </a>
                    <div class="a2a_kit a2a_kit_size_24 a2a_default_style mt-2 mb-4 pb-4">
                        <!-- <a class="a2a_dd" href="https://www.addtoany.com/share"></a> -->
                        <a class="a2a_button_facebook"></a>
                        <a class="a2a_button_twitter"></a>
                        <a class="a2a_button_email"></a>
                        <a class="a2a_button_whatsapp"></a>
                        <a class="a2a_button_google_gmail"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow fadeInUp pt-0 px-sm-0 ms-sm-0 me-sm-0" data-wow-delay="0.5s">
                <div class="sidebar-box shadow">
                    <h3 class="text-blue-primary">Barang & Jasa Lainnya</h3>
                    <?php foreach ($barangjasa as $row) : ?>
                        <div class="block-21 mb-4 d-flex justify-content-between">
                            <a href="barangjasa-<?= $row['judul_seo'] . "-" . $row['id_barangjasa'] ?>" class="blog-img mr-4" style="background-image: url(images/barangjasa/<?= $row['gambar'] ?>.webp);"></a>
                            <div class="text justify-content-between">
                                <h3 class="heading"><a href="barangjasa-<?= $row['judul_seo'] . "-" . $row['id_barangjasa'] ?>"><?= $row['judul'] ?></a></h3>
                                <div class="meta">
                                    <div><a><i class="far fa-calendar"></i> <?= tgl2($row['tgl']) ?></a></div>
                                    <div><a><i class="far fa-user"></i> Admin</a></div>
                                    <div><a><i class="far fa-eye"></i> <?= $row['dilihat'] ?></a></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script async src="https://static.addtoany.com/menu/page.js"></script>