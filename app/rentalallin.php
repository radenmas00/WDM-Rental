<?php $this->layout('template') ?>

<div class="container-xxl py-5">
    <div class="container">
        <h1 class="display-6 text-primary mb-0">Rental Mobil All In</h1>
        <h6 class="mb-2"><?= $namaweb ?></h6>
        <div class="mb-4"><?= $welcome['deskripsi'] ?></div>
        <div class="bg-light p-4 py-3 mb-4 rounded d-flex justify-content-between flex-column flex-md-row">
            <!-- <h6 class="mb-0"><?= $namaweb ?></h6> -->
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo $base_url ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rental Mobil All In</li>
                </ol>
            </nav>
            <span class="text-muted">Menampilkan <?= $jmlkendaraan ?> kendaraan yang tersedia.</span>
        </div>

        <hr class="mb-4">

        <div class="row g-4 justify-content-center">
            <?php foreach ($kendaraan as $row) : ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp d-flex align-items-stretch" data-wow-delay="0.1s">
                    <div class="card rounded shadow w-100 border-0 h-100">
                        <picture>
                            <source srcset="images/kendaraan3/<?= $row['gambar'] ?>.webp" class="card-img-top rounded-top" type="image/webp">
                            <img src="images/kendaraan3/<?= $row['gambar'] ?>" class="card-img-top rounded-top">
                        </picture>
                        <!-- <img src="images/kendaraan2/<?= $row['gambar'] ?>.webp" class="card-img-top rounded-top" alt="..."> -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $row['judul'] ?></h5>
                            <div class="text-blue-primary fw-bold">Rp. <?= number_format($row['harga']) ?> / Fullday</div>
                            <!--<div class="mt-2 fst-italic">*Dengan BBM Tambahan Rp. 150.000</div>-->
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
    </div>
</div>