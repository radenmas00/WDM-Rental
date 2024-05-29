<?php $this->layout('template') ?>

<style>
    .desc p{
        color: #fff !important;
    }
    .tabel table{
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
    }
    .tabel th, td {
        text-align: left;
        padding: 16px;
    }

    .tabel tr:nth-child(odd) {
        background-color: #e6e6ff;
    }
    .tabel tbody tr:first-child td {
        background-color: #e6e6ff;
    }
    .lir ul li::before {
        content: "\f00c";
        font-family: 'Font Awesome 6 Free';
        display: inline-block;
        color: #433ede;
        font-size: 20px;
        position: absolute;
        left: 25px;
        font-weight: 900;
    }
    .lir ul li{
        margin-left: 20px;
        list-style: none;
    }
    
    .lur ul li::before {
        content: "\f14a";
        font-family: 'Font Awesome 6 Free';
        display: inline-block;
        color: #433ede;
        font-size: 20px;
        position: absolute;
        left: 25px;
        font-weight: 900;
    }
    .lur ul li{
        margin-left: 20px;
        list-style: none;
    }
</style>

<!-- Uni Banner Area Start --> 
<section class="uni-banner" style="background-image: url('images/process_kat/<?= $data['gambar'] ?>');">
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

<section class="bg-f8f8f8 ptb-100">
    <div class="container" style="background: #fff">
        <!-- About Area Start -->
        <div class="about ptb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-text-area pl-20">
                            <div class="default-section-title">
                                <!--<span>20 Years of Experience</span>-->
                                <h3 style="text-align: center"><?= $data['judul'] ?></h3>
                                <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>-->
                            </div>
                            <!-- faq Area Start -->
                            <section class="faq">
                                <div class="container-fluid" style="padding: 0px">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12">
                                            <div class="accordion" id="accordionExample">
                                                <?php 
                                                $no = 1;
                                                foreach($training as $row) : ?>
                                                <?php if($no == 1) { ?> 
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading<?= $row['id_process_sub'] ?>">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $row['id_process_sub'] ?>" aria-expanded="true" aria-controls="collapse<?= $row['id_process_sub'] ?>"><?= $row['judul'] ?><i class="fas fa-arrow-up"></i></button>
                                                        </h2>
                                                        <div id="collapse<?= $row['id_process_sub'] ?>" class="accordion-collapse collapse show" aria-labelledby="heading<?= $row['id_process_sub'] ?>" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <?= $row['deskripsi'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading<?= $row['id_process_sub'] ?>">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $row['id_process_sub'] ?>" aria-expanded="true" aria-controls="collapse<?= $row['id_process_sub'] ?>"><?= $row['judul'] ?><i class="fas fa-arrow-up"></i></button>
                                                        </h2>
                                                        <div id="collapse<?= $row['id_process_sub'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $row['id_process_sub'] ?>" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
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
                            <!--<a class="default-button" href="images/process_kat/<?= $data['gambar'] ?>" download style="display: block; text-align: center; background: var(--secondColor); border-color: var(--secondColor)">Download Brosur Pendaftaran <i class="flaticon-arrow-right"></i></a>-->
                            <a class="default-button" href="https://api.whatsapp.com/send?phone=<?=$deskrip[7]?>&text=Halo <?=$namaweb?> saya ingin mendaftar pelatihan <?= $data['judul'] ?>  " target="_blank" style="display: block; text-align: center">Daftar Sekarang <i class="flaticon-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-4" style="overflow: hidden">
                        <!--<div class="about-img inner-about-img">-->
                            <!--<img src="images/process_kat/<?= $data['gambar'] ?>.webp" alt="image" style="display: block !important">-->
                            <ul id="lightSlider">
                                <?php 
                                //   $no 	= 0;
                                  foreach($multi as $tsubpro) : ?>
                                  <!--<?php if($no == 0){?>-->
                                  <!--  <li data-thumb="images/process_kat/<?= $data['gambar'] ?>.webp" title="<?=$data['judul']?>">-->
                                  <!--    <a href="images/process_kat/<?= $data['gambar'] ?>.webp" class="test-popup-link">-->
                                  <!--      <img src="images/process_kat/<?= $data['gambar'] ?>.webp"/>-->
                                  <!--    </a>-->
                                  <!--  </li>-->
                                  <!--  <?php } else {?> -->
                                    <li data-thumb="images/gallery_process_kat/<?php echo "$imgname1-$tsubpro[gambar]"; ?>" title="<?=$header['judul']?>">
                                      <a href="images/gallery_process_kat/<?php echo "$imgname1-$tsubpro[gambar]"; ?>" class="test-popup-link">
                                        <img src="images/gallery_process_kat/<?php echo "$imgname1-$tsubpro[gambar]"; ?>" />
                                      </a>
                                    </li>
                                    <!--<?php } ?> -->
                                  <?php 
                                  $no++;
                                  endforeach ?>
                            </ul>
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- About Area End -->
    </div>
    <div class="container" style="background: #fff; margin-top: 75px">
        <!-- About Area Start -->
        <div class="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about-text-area text-center">
                            <div class="tabel table-responsive pt-70">
                                <?= $data['jadwal'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Area End -->
    </div>
    <div class="container" style="background: #fff; margin-top: 75px">
        <!-- About Area Start -->
        <div class="about">
            <div class="container">
                <div class="row lir">
                    <div class="col-lg-4">
                        <div class="about-text-area">
                            <div class="default-section-title text-center mb-2">
                                <h3 style="font-size: 25px">Fasilitas Pelatihan</h3>
                            </div>
                           <?= $data['fasilitas_pelatihan'] ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="about-text-area">
                            <div class="default-section-title text-center mb-2">
                                <h3 style="font-size: 25px">Fasilitas Alumni</h3>
                            </div>
                           <?= $data['fasilitas_alumni'] ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="about-text-area">
                            <div class="default-section-title text-center mb-2">
                                <h3 style="font-size: 25px">Syarat Training Online</h3>
                            </div>
                           <?= $data['syarat_training'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Area End -->
    </div>
    
     <div class="container" style="background: #fff; margin-top: 75px">
        <!-- About Area Start -->
        <div class="about">
            <div class="container">
                <div class="row lur">
                    <div class="col-lg-12">
                        <div class="about-text-area">
                            <div class="default-section-title text-center mb-2">
                                <h3 style="font-size: 25px">Tata Cara Pendaftaran</h3>
                            </div>
                           <?= $data['tatacara'] ?>
                        </div>
                    </div> 
                </div>
                <!--
                <a class="default-button" href="form-pendaftaran-<?= $data['judul_seo'] ?>-<?= $data['id_process_kat'] ?>" style="display: block; text-align: center">Daftar Sekarang <i class="flaticon-arrow-right"></i></a>
                -->
                
                  <a class="default-button" href="https://api.whatsapp.com/send?phone=<?=$deskrip[7]?>&text=Halo <?=$namaweb?> saya ingin mendaftar pelatihan <?= $data['judul'] ?>" style="display: block; text-align: center" target="_blank">Daftar Sekarang <i class="flaticon-arrow-right"></i></a>
                
                
            </div>
        </div>
        
        <!-- About Area End -->
    </div>

</section>