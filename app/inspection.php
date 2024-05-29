<?php $this->layout('template') ?>

<!-- Uni Banner Area Start -->
<section class="uni-banner" style="background-image: url('images/sizechart/<?= $header['gambar'] ?>');">
    <div class="container">
        <div class="uni-banner-text-area">
            <h1><?= $data['judul'] ?></h1>
            <ul>
                <li><a href="<?= $base_url ?>">Home</a></li>
                <li><?= $data['judul'] ?></li>
            </ul>
        </div>
    </div>
</section>
<!-- Uni Banner Area End -->
<!-- Features Area Start -->
<div class="features ptb-100">
    <div class="container">
        <div class="section-content">
            <div class="row justify-content-center">
                <?php 
                $no = 1;
                foreach($inspect as $row) : ?>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 d-flex align-items-strech">
                        <div class="feature-card" style="background: aliceblue;box-shadow: 3px 4px 5px 0px rgba(29,40,75,0.75); -webkit-box-shadow: 3px 4px 5px 0px rgba(29,40,75,0.75); -moz-box-shadow: 3px 4px 5px 0px rgba(29,40,75,0.75);">
                            <div class="feature-card-img">
                                <a href="service-<?= $row['judul_seo'] ?>-<?= $row['id_sizechart'] ?>">
                                <div class="artikle" style="background-image: url('images/sizechart/<?= $row['gambar'] ?>'); background-size: cover; background-position: center; background-repeat: no-repeat"></div>
                                <!-- <img src="assets/images/features/f1.jpg" alt="image"> -->
                                </a>
                            </div>
                            <div class="features-card-text">
                                <span style="top: 40px">0<?= $no ?></span>
                                <!-- <i class="flaticon-pipe"></i> -->
                                <h4><a href="service-<?= $row['judul_seo'] ?>-<?= $row['id_sizechart'] ?>"><?= $row['nama'] ?></a></h4>
                                <p><?=limit_desc($row['deskripsi'], 150)?></p>
                            </div>
                        </div>
                    </div>
                <?php 
                $no++;
                endforeach ?>
            </div>
        </div>
    </div>
</div>
<!-- Features Area End -->