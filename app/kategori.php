<?php $this->layout('template') ?>

<div class="inner-banner inner-banner-bg">
    <div class="container">
        <div class="inner-title">
            <h3><?=$data['judul']?></h3>
            <ul>
                <li>
                    <a href="<?=$base_url?>">Home</a>
                </li>
                <li>Kategori</li>
                <li><?=$data['judul']?></li>
            </ul>
        </div>
    </div>
</div>

<div class="best-seller-area section-bg pt-100 pb-70">
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach($produk as $r) : ?>
                <div class="col-lg-3 col-6">
                    <div class="best-seller-card">
                        <div class="best-seller-img">
                            <img src="images/produk/<?php echo $r['gambar'] ?>" alt="Products">
                            <a href="buku-<?=$r['judul_seo']."-".$r['id_produk']?>"" class="addcart">Detail</a>
                        </div>
                        <div class="content">
                            <!-- <div class="rating">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </div> -->
                            <span><a href="kategori-<?=$r['seo']."-".$r['id_produk_k']?>"><?=$r['jdl']?></a></span>
                            <h3><a href="buku-<?=$r['judul_seo']."-".$r['id_produk']?>"><?=$r['judul']?></a></h3>
                            
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>