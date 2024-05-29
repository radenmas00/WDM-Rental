<?php $this->layout('template') ?>
<div class="bg-secondary py-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
                    <li class="breadcrumb-item"><a class="text-nowrap" href="<?=$base_url?>"><i
                                class="ci-home"></i>Home</a>
                    </li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">Wishlist</li>
                </ol>
            </nav>
        </div>
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 mb-0">Wishlist</h1>
        </div>
    </div>
</div>
<div class="container py-5 mt-md-2 mb-2">
    <div class="row">
        <div class="col-lg-3">
            <!-- Related articles sidebar-->
            <div class="offcanvas offcanvas-collapse border-end" id="help-sidebar">
                <div class="offcanvas-header align-items-center shadow-sm">
                    <h2 class="h5 mb-0">Related articles</h2>
                    <button class="btn-close ms-auto" type="button" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body py-grid-gutter py-lg-1" data-simplebar="init"
                    data-simplebar-auto-hide="true">
                    <div class="simplebar-wrapper" style="margin: -4px 0px;">
                        <div class="simplebar-height-auto-observer-wrapper">
                            <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask">
                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                    aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                    <div class="simplebar-content" style="padding: 4px 0px;">
                                        <!-- Links-->
                                        <div class="widget widget-links">
                                            <h3 class="widget-title d-none d-lg-block">Kategori</h3>
                                            <ul class="widget-list">
                                                <?php foreach($sub as $r) : ?>
                                                <li class="widget-list-item"><a class="widget-list-link"
                                                        href="kategori-<?=$r['judul_seo']."-".$r['id_produk_k']?>"><i
                                                            class="ci-arrow-right opacity-60 align-middle mt-n1 me-1"></i><?=$r['judul']?></a>
                                                </li>
                                                <?php  endforeach ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="simplebar-placeholder" style="width: auto; height: 386px;"></div>
                    </div>
                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                    </div>
                    <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                        <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <?php foreach($_SESSION['wishlist'] as $w) : 
                $r = $db->connection("SELECT *,k.judul AS jdl,k.judul_seo AS seo FROM produk_k k  JOIN produk p  ON k.id_produk_k = p.id_produk_k  WHERE p.id_produk = $w ")->fetch();
                ?>
                
                <div class="col-md-3 mb-4">
                    <div class="item">
                        <div class="each-product">
                            <div class="wrp-img">
                                <a href="produk-<?=$r['judul_seo']."-".$r['id_produk']?>">
                                    <img src="images/produk/<?=$r['gambar']?>" alt="">
                                </a>
                            </div>
                            <div class="wrp-content">
                                <span class="sendbyProduct">
                                    <img class="icon-typesend loading"
                                        src="https://www.klikindomaret.com/Assets/image/send_by_store.png"
                                        data-was-processed="true">
                                    <span class="send-store"><?=$r['jdl']?></span>
                                </span>
                                <a href="produk-<?=$r['judul_seo']."-".$r['id_produk']?>">
                                    <div class="title"><?=$r['judul']?></div>
                                </a>
                                <div class="wrp-price one">
                                    <div class="vmiddle">
                                        <div class="col-md-12 nopadding nomargin vmiddle">
                                            <?php if($r['harga_diskon'] != '') : ?>
                                            <div class="price">
                                                <span class="strikeout disc-price">
                                                    Rp <?=$r['harga']?>
                                                    <!-- <span class="discount">11%</span> -->
                                                </span>
                                                <span class="normal price-value">Rp <?=$r['harga_diskon']?></span>
                                            </div>
                                            <?php else : ?>
                                            <div class="price noDisc">
                                                <span class="normal price-value">Rp <?=$r['harga']?></span>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrp-btn">
                                    <button class="btn btn-primary btn-sm btn-block"
                                        onclick="AddToCart(<?=$r['id_produk']?>)"><i class="ci-cart fs-sm me-1"></i> Add
                                        to Cart</button>
                                </div>
                            </div>
                            <div class="sendby oksendby classsendby6"
                                onclick="AddToWishlist(this, <?=$r['id_produk']?>)">
                                <span
                                    class="navbar-tool-icon <?= (empty($_SESSION['wishlist'][$r['id_produk']]))? 'ci-heart' : 'ci-heart-filled' ?> floatR classaddFavorit6"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>