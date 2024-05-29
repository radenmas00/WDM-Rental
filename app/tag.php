<?php $this->layout('template') ?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Tag : <?=$data['name']?></h2>
                <ol>
                    <li><a href="<?=$base_url?>">Home</a></li>
                    <li>Tag</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <section>
        <div class="container">
        <div class="lp-posts-grid-wrapper lp-posts-grid-columns-3 truncate-title-yes">
                <ul class="clearfix">
                    <?php foreach($artikel as $r) : ?>
                    <li class="arti-li">
                        <a href="artikel-<?=$r['judul_seo']."-".$r['id_artikel']?>">
                            <img width="300" height="200"
                                src="images/artikel/<?=$r['gambar']?>"
                                class="attachment-post-thumbnail-medium size-post-thumbnail-medium" alt="">
                        </a>
                        <h4>
                            <a href="artikel-<?=$r['judul_seo']."-".$r['id_artikel']?>"
                                rel="bookmark"><?=$r['judul']?></a>
                        </h4>
                        <p><?=limit_desc($r['deskripsi'],150)?>...</p>
                        <a class="readmore" href="artikel-<?=$r['judul_seo']."-".$r['id_artikel']?>">Read
                            More</a>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>

            <div class="row">
              <?php if(  $pagination['jmldata'] > $pagination['batas'] ) : ?>
              <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px">
                <div class="wp-pagenavi">
                  <center><?= $pagination['linkHalaman'] ?></center>
                </div>
              </div>
              <?php endif ?>
            </div>
        </div>
    </section>

</main><!-- End #main -->
