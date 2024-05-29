<?php $this->layout('template') ?>
<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>About Us</h2>
        <ol>
          <li><a href="<?=$base_url?>">Home</a></li>
          <li>About Us</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <section class="inner-page">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-4">
          <?=$data['deskripsi']?>
        </div>
        <div class="col-md-12 text-center">
          <h2 class="mb-4">Profile Pengelola</h2>
        </div>
        <div class="col-md-10">
          <?=$profile['deskripsi']?>
        </div>
        <div class="col-md-2">
            <img src="images/<?=$profile['gambar']?>"class="w-100">
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->


<!-- Go to www.addthis.com/dashboard to customize your tools -->
<!-- <div class="addthis_inline_share_toolbox mb-3"></div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59dc9d30b368b392"></script> -->