<?php

$judul_seo = seo($_POST["name"]);
// Update modul
if ($act == 'update') {
    try {
        $datas = array(
            'name' => $_POST["name"],
            'judul_seo' => $judul_seo,
        );
        $db->update('produk_tag', $datas, "id_produk_tag = $_POST[id_produk_tag] ");

        $msg->info('Data berhasil diubah');
        echo "<script>window.location = '$hal'</script>";

    } catch (PDOException $e) {
        $msg->warning('Data Gagal diubah');
        echo "<script>window.location = '$hal'</script>";
    }
}

// add modul
elseif ($act == 'add') {
    try {
        $datas = array(
            'name' => $_POST["name"],
            'judul_seo' => $judul_seo,
        );
        $saved = $db->insert('produk_tag', $datas);

        $msg->success('Data berhasil ditambah');
        echo "<script>window.location = '$hal'</script>";

    } catch (PDOException $e) {
        $msg->warning('Data Gagal ditambah!');
        echo "<script>window.location(history.back(-1))</script>";
    }
}

// remove modul
elseif ($act == 'remove') {
    $db->delete("produk_tag", "id_produk_tag='$id' ");

    $msg->success('Data Berhasil dihapus');
    echo "<script>window.location = '$hal'</script>";
}
