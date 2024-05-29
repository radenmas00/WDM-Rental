<?php $this->layout('template') ?>
<?php 
$warta      = $db->connection("SELECT  * FROM artikel ORDER BY id_artikel DESC  LIMIT 3 ")->fetchAll();
$pengumuman = $db->connection("SELECT * FROM produk ORDER BY id_produk DESC  LIMIT 3 ")->fetchAll();
$harga = $db->connection("SELECT * FROM foto ORDER BY id_foto DESC LIMIT 3")->fetchAll();
?>
<div class="post-sidebar-area card mt-4 bg-white">

    <!-- ##### Single Widget Area ##### -->
    <div class="single-widget-area p-2 bg-grey">
        <!-- Title -->
        <div class="widget-title">
            <h2>Related Blog</h2>
            <hr>
        </div>
        <?php foreach($warta as $row) : ?>
        <!-- Single Latest Posts -->
        <div class="single-latest-post mb-4">
            <div class="post-thumb">
                <img src="images/artikel/<?=$row['gambar']?>" class="w-100 d-block">
            </div>
            <div class="post-content text-center my-2">
                <a href="blog-<?=$row['judul_seo']?>-<?=$row['id_artikel']?>" class="post-title">
                    <h6><?=$row['judul']?></h6>
                </a>
            </div>
        </div>
        <?php endforeach ?>
    </div>

</div>