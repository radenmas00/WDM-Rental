<?php $this->layout('template') ?>

<!-- Uni Banner Area Start -->
<section class="uni-banner" style="background-image: url('images/sizechart/<?= $data['gambar'] ?>');">
    <div class="container">
        <div class="uni-banner-text-area">
            <h1><?= $data['nama'] ?></h1>
            <ul>
                <li><a href="<?= $base_url ?>">Home</a></li>
                <li><?= $data['nama'] ?></li>
            </ul>
        </div>
    </div>
</section>
<!-- Uni Banner Area End -->

<!-- faq Area Start -->
<section class="faq ptb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="accordionExample">
                    <?php 
                    $no = 1;
                    foreach($konsul as $row) : ?>
                    <?php if($no == 1) { ?> 
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?= $row['id_sizechart_sub'] ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $row['id_sizechart_sub'] ?>" aria-expanded="true" aria-controls="collapse<?= $row['id_sizechart_sub'] ?>"><?= $row['judul'] ?><i class="fas fa-arrow-up"></i></button>
                            </h2>
                            <div id="collapse<?= $row['id_sizechart_sub'] ?>" class="accordion-collapse collapse show" aria-labelledby="heading<?= $row['id_sizechart_sub'] ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="artikle mb-3" style="background-image: url('images/sizechart_sub/<?= $row['gambar'] ?>.webp'); background-size: cover; background-position: center; background-repeat: no-repeat"></div>
                                    <?= $row['deskripsi'] ?>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?= $row['id_sizechart_sub'] ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $row['id_sizechart_sub'] ?>" aria-expanded="true" aria-controls="collapse<?= $row['id_sizechart_sub'] ?>"><?= $row['judul'] ?><i class="fas fa-arrow-up"></i></button>
                            </h2>
                            <div id="collapse<?= $row['id_sizechart_sub'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $row['id_sizechart_sub'] ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="artikle mb-3" style="background-image: url('images/sizechart_sub/<?= $row['gambar'] ?>.webp'); background-size: cover; background-position: center; background-repeat: no-repeat"></div>
                                    <?= $row['deskripsi'] ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php 
                    $no++;
                    endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Faq Area End -->
