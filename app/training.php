<?php $this->layout('template') ?>
<!-- Uni Banner Area Start -->
<div class="uni-banner" style="background-image: url('images/<?= $cta['gambar'] ?>.webp')">
    <div class="container">
        <div class="uni-banner-text-area">
            <h1><?= $data['judul'] ?></h1>
        </div>
    </div>
</div>
<!-- Uni Banner Area End -->

<!-- Services Area Start -->
<div class="services pt-100 pb-70" style="background: #09935524">
    <div class="container">
        <?php foreach($kategori as $kat) : ?>
            <h2 style="border-bottom: 2px solid;padding-bottom: 15px;"><?php echo $kat['judul'] ?></h2>
            <div class="section-content mb-5">
                <div class="row">
                    <?php 
                    $service  = $db->connection("SELECT process.judul as judul, process.gambar as gambar, process.deskripsi as deskripsi FROM process JOIN process_kat ON process.id_process_kat = process_kat.id_process_kat WHERE process.id_process_kat = '$kat[id_process_kat]' ")->fetchAll();
                    foreach($service as $row) : 
                    ?>
                    <?php if($kat['id_process_kat'] == '1') { ?>
                        <div class="col-lg-6 col-12 d-flex align-items-stretch">
                            <div class="service-card-3 slider-card-margin">
                                <div class="service-card-img-3">
                                 <img src="images/process/<?= $row['gambar'] ?>.webp" alt="<?= $row['judul'] ?>"> 
                                </div>
                                <div class="service-card-text-3">
                                    <i class="s3-icon">
                                        <img src="images/<?= $deskrip['2'] ?>" alt="<?= $row['judul'] ?>" style="width: 50px;">
                                    </i>
                                    <h4><?= $row['judul'] ?></h4>
                                    <?= $row['deskripsi'] ?>
                                    <!--<a class="default-button default-button-2" href="projects">See Our Latest Work <i class="fas fa-angle-right"></i></a>-->
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-4 col-12 d-flex align-items-stretch">
                            <div class="service-card-3 slider-card-margin">
                                <div class="service-card-img-3">
                                     <img src="images/process/<?= $row['gambar'] ?>.webp" alt="<?= $row['judul'] ?>"> 
                                </div>
                                <div class="service-card-text-3">
                                    <i class="s3-icon">
                                        <img src="images/<?= $deskrip['2'] ?>" alt="<?= $row['judul'] ?>" style="width: 50px;">
                                    </i>
                                    <h4> <?= $row['judul'] ?> </h4>
                                    <?= $row['deskripsi'] ?>
                                    <!--<a class="default-button default-button-2" href="projects">See Our Latest Work <i class="fas fa-angle-right"></i></a>-->
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<!-- Services Area End -->