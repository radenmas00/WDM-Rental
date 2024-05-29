<?php $this->layout('template') ?>

<div class="container-fluid">
    <div class="h6 border-bottom border-2 mb-2 text-muted">Menampilkan Pencarian "<?= $data ?>"</div>
    <div class="row">
        <?php foreach ($cariberita as $row) : ?>
            <div class="col-12 py-3 border-bottom border-2">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <a href="berita-<?= $row['judul_seo'] . "-" . $row['id_artikel'] ?>" class="card-img-top ratio ratio-4x3">
                            <img class="img-fluid" alt="" src="images/artikel/<?= $row['gambar'] ?>" style="object-fit: cover; object-position: center;">
                        </a>
                    </div>

                    <div class="col-12 col-lg-6 d-flex flex-column">
                        <a href="berita-<?= $row['judul_seo'] . "-" . $row['id_artikel'] ?>" class="h3"><?= $row['judul'] ?></a>
                        <div class="d-flex mb-3">
                            <!-- <small class="me-3"><i class="fa fa-user text-primary"></i> Admin</small> -->
                            <small class="me-3"><i class="fa fa-calendar text-muted"></i> <?= tgl2($row['tgl']) ?></small>
                        </div>
                        <p>
                            <?= limit_desc($row['deskripsi'], 450) ?> ...
                        </p>
                        <a href="berita-<?= $row['judul_seo'] . "-" . $row['id_artikel'] ?>" class="my-2 mt-auto">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

        <?php foreach ($carihalaman as $row) : ?>
            <div class="col-12 py-3 border-bottom border-2">
                <div class="row">
                    <div class="col-12 col-lg-12 d-flex flex-column">
                        <a href="hal-<?= $row['slug'] ?>-<?= $row['id_subnavmenu'] ?>" class="h3"><?= $row['nama_submenu'] ?></a>
                        <p>
                            <?= limit_desc($row['konten'], 450) ?> ...
                        </p>
                        <a href="hal-<?= $row['slug'] ?>-<?= $row['id_subnavmenu'] ?>" class="my-2 mt-auto">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>