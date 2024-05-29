<?php $this->layout('template') ?>

<!-- Uni Banner Area Start -->
<div class="uni-banner" style="background-image: url('images/<?= $cta['gambar'] ?>.webp')">
    <div class="container">
        <div class="uni-banner-text-area">
            <h1>Projects</h1>
        </div>
    </div>
</div>
<!-- Uni Banner Area End -->


<!-- Project Area Start -->
<div class="project ptb-100">
    <div class="container">
        <div class="section-content">
            <div class="row">
                <?php foreach($foto as $row) : ?>
                    <div class="col-lg-6 col-12">
                        <div class="project-card-2">
                            <img src="images/foto/<?=  $row['gambar'] ?>.webp" alt="image">
                            <div class="project-card-text-2">
                                <span>Our Project</span>
                                <h4><a href="projects"><?= $row['judul'] ?></a></h4>
                                <p><?= $row['kode_produk'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<!-- Project Area End -->
