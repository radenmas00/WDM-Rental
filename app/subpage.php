<?php $this->layout('template') ?>

<div class="container-fluid">
    <div class="h6 border-bottom border-2 mb-2 text-muted"><?= $data2['nama_menu'] ?> - <?= $data['nama_submenu'] ?></div>
    <div class="container-fluid p-0">
        <h1><?= $data['judul_konten'] ?></h1>
        <div>
            <?= $data['konten'] ?>
        </div>
    </div>
</div>