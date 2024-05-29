<?php $this->layout('template') ?>

<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background: linear-gradient(rgba(19, 58, 98, .9), rgba(19, 58, 98, .9)), url(images/page-header.jpg) center center; background-size: cover;">
    <div class="container py-5">
        <h1 class="display-4 animated slideInDown mb-4">Penerbit</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?php echo $base_url ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Penerbit</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5 wow fadeInUp pe-lg-0" data-wow-delay="0.1s">
                <div class="ratio ratio-1x1">
                    <img class="img-fluid shadow" src="images/<?= $welcome['gambar'] ?>.webp" alt="" style="object-fit: cover; object-position: center;" />
                </div>
            </div>
            <div class="col-lg-7 wow fadeInUp ps-0" data-wow-delay="0.5s">
                <div class="heading-section mb-5 heading-section-with-line">
                    <span class="subheading ms-4">PRODUK & PELAYANAN - Penerbit</span>
                </div>
                <div class="desc-box ms-4"><?= $welcome['deskripsi'] ?></div>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row mb-5 pb-3 justify-content-center">
            <div class="col-md-9 heading-section heading-section-with-line">
                <span class="subheading">Buku yang diterbitkan</span>
                <small class="text-muted">Menampilkan <?= $jmlpenerbit ?> buku yang telah kami terbitkan.</small>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($penerbit as $row) : ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp d-flex align-items-stretch" data-wow-delay="0.1s">
                    <div class="card rounded-0 shadow w-100 border-0 h-100">
                        <a href="penerbit-<?= $row['judul_seo'] . "-" . $row['id_penerbit'] ?>"><img src="images/penerbit/<?= $row['gambar'] ?>.webp" class="card-img-top rounded-0" alt="..." style="aspect-ratio:4/3; object-fit:cover; object-position:center;"></a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><a href="penerbit-<?= $row['judul_seo'] . "-" . $row['id_penerbit'] ?>"><?= $row['judul'] ?></a></h5>
                            <div class="d-flex mb-3 small">
                                <div class="me-2"><i class="far fa-calendar me-1"></i><a><?= tgl2($row['tgl']) ?></a></div>
                                <div class="me-2"><i class="far fa-user me-1"></i><a>Admin</a></div>
                                <div><i class="far fa-eye me-2"></i><a><?= $row['dilihat'] ?></a></div>
                            </div>
                            <p class="card-text"><?= limit_desc($row['deskripsi'], 100) ?> ...</p>
                            <div class="mt-auto">
                                <hr>
                                <a href="penerbit-<?= $row['judul_seo'] . "-" . $row['id_penerbit'] ?>" class="btn btn-blue-outline px-4">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>