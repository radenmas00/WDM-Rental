<?php $this->layout('template') ?>

<div class="container-xxl py-5">
    <div class="container">
        <h1 class="display-6 text-primary mb-0">Paket Wisata</h1>
        <h6 class="mb-2"><?= $namaweb ?></h6>
        <div class="mb-4"><?= $welcome['deskripsi'] ?></div>
        <div class="bg-light p-4 py-3 mb-4 rounded d-flex justify-content-between flex-column flex-md-row">
            <!-- <h6 class="mb-0"><?= $namaweb ?></h6> -->
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo $base_url ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Paket Wisata</li>
                </ol>
            </nav>
            <span class="text-muted">Menampilkan <?= $jmlpaketwisata ?> paket wisata yang tersedia.</span>
        </div>

        <hr class="mb-4">

        <div class="row g-4">
            <?php foreach ($paketwisata as $row) : ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp d-flex align-items-stretch" data-wow-delay="0.1s">
                    <div class="card rounded shadow w-100 border-0 h-100">
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