<?php $this->layout('template') ?>

<style>
    .krim{
        max-width: 50%;
    }
    .desc p{
        color: #fff !important;
    }
    .desc h2{
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
    @media(max-width: 762px){
        .krim{
            max-width: 100%;
        }
    }
</style>

<?php if($data['id_page'] == 4) { ?> 

<!-- Uni Banner Area Start -->
<div class="uni-banner" style="background-image: url('images/<?= $cta['gambar'] ?>.webp')">
    <div class="container">
        <div class="uni-banner-text-area">
            <h1><?= $data['judul'] ?></h1>
        </div>
    </div>
</div>
<!-- Uni Banner Area End -->

 <!-- Contact Area Start -->
 <div class="contact ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-xl-4">
                <div class="contact-card-area">
                    <div class="row g-4 justify-content-center">
                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="contact-card">
                                <i class="fas fa-phone-alt"></i>
                                <h5>Phone Number</h5>
                                <p><a href="tel:<?= $deskrip['10'] ?>"><?= $deskrip['10'] ?></a></p>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="contact-card">
                                <i class="far fa-envelope"></i>
                                <h5>Our Email</h5>
                                <p><a href="mailto:<?= $deskrip['9'] ?>"><?= $deskrip['9'] ?></a></p>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="contact-card">
                                <i class="fas fa-map-marker-alt"></i>
                                <h5>Our Location</h5>
                                <p><a href="#"><?= $deskrip['22'] ?></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="contact-page-form-area pl-20 pt-30">
                    <div class="default-section-title">
                        <span>Get In Touch</span>
                        <h3>Add Your Address In The Form Below</h3>
                        <p>You can send your questions via our contact column on the side, or directly email us about the project you want to make.</p>
                    </div>
                    <div class="contact-form-text-area">
                        <form method="POST" action="contact">
                        <?=$csrf->input('my-form');?>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name" id="name" name="name" required data-error="Please enter your name"> 
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email" id="email" required data-error="Please enter your Email"> 
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" id="phone_number" required data-error="Please enter your phone number">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" name="subject" class="form-control" placeholder="Subject" id="msg_subject" required data-error="Please enter your subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" class="form-control" placeholder="Your Messages.." cols="30" rows="5" required data-error="Please enter your message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12">
                                    <button class="default-button" type="submit"><span>Send Message</span></button>
                                    <div id="msgSubmit" class="h6 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Area end -->

<!-- google Map Area Start -->
<div class="google-map">
    <?= $deskrip['81'] ?>
</div>
<!-- google Map Area End -->

<?php } else if($data['id_page'] == 3 ) {?>
    <!-- Uni Banner Area Start -->
    <div class="uni-banner" style="background-image: url('images/<?= $cta['gambar'] ?>.webp')">
        <div class="container">
            <div class="uni-banner-text-area">
                <h1><?= $data['judul'] ?></h1>
            </div>
        </div>
    </div>
    <!-- Uni Banner Area End -->

    <!-- About Area Start -->
    <div class="about ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="about-img-4" style="background-image: url('images/<?= $data['gambar'] ?>.webp')">
                        <img src="images/<?= $data['gambar'] ?>.webp" alt="image">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="about-text-area-2 pl-20">
                        <div class="default-section-title">
                            <span>About Us</span>
                            <h3><?= $namaweb ?></h3>
                            <?= $data['deskripsi'] ?>
                        </div>
                        <div class="about-text-card-area">
                            <div class="row">
                                <div class="col-xl-6 col-lg-5 col-md-6 col-sm-6 col-12">
                                    <div class="about-text-card about-card-border">
                                        <i class="fa fa-phone"></i>
                                        <h4><?= $deskrip['10'] ?></h4>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-5 col-md-6 col-sm-6 col-12">
                                    <div class="about-text-card">
                                        <i class="fa fa-envelope-open"></i>
                                        <h4><?= $deskrip['9'] ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Area End -->

    <!-- Features Area Start -->
    <div class="features features-2 pb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="features-card-text-area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="features-card-2">
                                    <span></span>
                                    <?= $visi['deskripsi'] ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="features-card-2">
                                    <span></span>
                                    <?= $misi['deskripsi'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features Area End -->


<?php } else { ?>
    <!-- Uni Banner Area Start -->
    <div class="uni-banner" style="background-image: url('images/<?= $cta['gambar'] ?>.webp')">
        <div class="container">
            <div class="uni-banner-text-area">
                <h1><?= $data['judul'] ?></h1>
            </div>
        </div>
    </div>
    <!-- Uni Banner Area End -->

    <div class="about-area pt-100 pb-100" style="background: #f2f2f8" id="profil-management">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12" data-cue="slideInRight" data-duration="2000">
                    <div class="single-about-right-content about-page-content">
                        <div class="section-title left-title">
                            <span class="top-title"><?= $data['judul'] ?></span>
                            <h2><?= $namaweb ?></h2>
                            <?= $data['deskripsi'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About Us Area -->
<?php } ?>


