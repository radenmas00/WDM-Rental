<?php $this->layout('template') ?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <!--<h2><?=$data['judul']?></h2>-->
                <ol>
                    <li><a href="<?=$base_url?>">Home</a></li>
                    <li><?=$data['judul']?></li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->


    <section class="inner-page">
        <div class="container">
            <p>
                <?=$data['deskripsi']?>
            </p>
        </div>
    </section>

</main><!-- End #main -->