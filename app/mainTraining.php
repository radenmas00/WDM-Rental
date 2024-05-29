<?php $this->layout('template') ?>
<style>
    .fyuh{
        padding: 0px 30px;
    }
    .plid{
        padding: 20px 10px;
    }
    .desc p{
        color: var(--bodyColor);
    }
    .desc h2{
        color: var(--bodyColor);
    }
    .desc ol li{
        color: var(--bodyColor);
    }
    @media(max-width: 764px){
        .fyuh{
            text-align: center;
        }
        .dete{
            margin-bottom: 20px;
            margin-right: 0px;
        }
        .aple{
            padding: 25px 0px;
        }
        .judul{
            padding-top: 25px;
        }
    }
</style>
<div class="page-banner-area jarallax" data-jarallax='{"speed": 0.3}' >
    <div class="container">
        <div class="single-page-banner-content">
            <h1>Apply Karir</h1>
            <ul>
                <li><a href="<?= $base_url ?>">Home</a></li>
                <li><a href="karir">Karir</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="about-area pt-100 pb-100">
    <div class="container fyuh">
        <div class="row align-items-center mb-4 plid"  data-cue="slideInLeft" data-duration="2000" style="box-shadow: 2px 2px 5px 2px rgba(0, 0, 0, 0.42);border-radius: 5px;background: rgba(35, 43, 62, 0.86)">
            <div class="col-lg-7">
                <div class="judul">
                    <h2 style="color: #fff"><?= $data['judul'] ?></h2>
                    <p style="color: #fff"><?= $data['url'] ?></p>
                </div>
            </div>
            <div class="col-lg-5 d-block d-lg-flex aple">
                <div class="dete" style="margin-right: 20px">
                    <h5 style="color: #fff">Apply Before <?= tgl2($data['tgl_batas']) ?></h5>
                    <p style="color: #fff">Posted On <?= tgl2($data['tgl_posting']) ?></p>
                </div>
                <div class="aply" style="margin-left: 10px">
                    <a href="<?= $data['berkas'] ?>" class="default-btn" target="_blank">Apply</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container desc" data-cue="slideInRight" data-duration="2000" >
        <?= $data['deskripsi'] ?>
        <br>
        <div class="text-center">
            <a href="<?= $data['berkas'] ?>" class="default-btn" target="_blank">Apply</a>
        </div>
    </div>
</div>