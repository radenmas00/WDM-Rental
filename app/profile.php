<?php $this->layout('template') ?>

<div class="container-xxl py-5">
    <div class="container">
        <h1 class="display-6 text-primary mb-0">Profile</h1>
        <h6 class="mb-2"><?= $namaweb ?></h6>
        <div class="bg-light p-4 py-3 mb-4 rounded d-flex justify-content-between flex-column flex-md-row">
            <!-- <h6 class="mb-0"><?= $namaweb ?></h6> -->
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo $base_url ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>

        <hr class="mb-4">

        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <picture>
                    <source srcset="images/<?= $welcome['gambar'] ?>.webp" class="img-fluid shadow" type="image/webp">
                    <img src="images/<?= $welcome['gambar'] ?>" class="img-fluid shadow">
                </picture>
                <!-- <img class="img-fluid shadow" src="images/<?= $welcome['gambar'] ?>.webp" alt="" /> -->
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="desc-box ms-4"><?= $welcome['deskripsi'] ?></div>
            </div>
        </div>
    </div>
</div>