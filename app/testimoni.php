<?php $this->layout('template') ?>
<main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><?=$data['judul']?></h2>
                <ol>
                    <li><a href="<?=$base_url?>">Home</a></li>
                    <li><?=$data['judul']?></li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Set up your HTML -->
                    <div class="owl-carousel testimoni owl-theme">
                        <?php foreach($testimoni as $r) : ?>
                        <div class="icon-box testimonial-box icon-box-left text-left">
                            <div class="icon-box-img testimonial-image circle" style="width: 121px">
                                <img src="images/testimoni/<?=$r['gambar']?>"
                                    class="attachment-thumbnail size-thumbnail" alt="" loading="lazy"
                                    srcset="images/testimoni/<?=$r['gambar']?> 186w, images/testimoni/<?=$r['gambar']?> 100w"
                                    sizes="(max-width: 186px) 100vw, 186px">
                            </div>
                            <div class="icon-box-text p-last-0">
                                <div class="star-rating"><span style="width:100%"><strong
                                            class="rating"></strong></span></div>
                                <div
                                    class="testimonial-text line-height-small italic test_text first-reset last-reset is-italic">

                                    <p><?=$r['deskripsi']?></p>
                                </div>
                                <div class="testimonial-meta pt-half">
                                    <strong class="testimonial-name test_name"><?=$r['nama']?></strong>
                                    <span class="testimonial-name-divider"> / </span> <span
                                        class="testimonial-company test_company"><?=$r['asal']?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->