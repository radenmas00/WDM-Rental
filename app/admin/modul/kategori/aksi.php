<?php

$judul_seo = seo($_POST["judul"]);
// Update modul
if ($act == 'update') {
    try {
        $datas = array(
            'judul' => $_POST["judul"],
            'deskripsi' => $_POST["deskripsi"],
            'judul_seo' => $judul_seo,
        );
        $db->update('kategori', $datas, "id_kategori = $_POST[id_kategori] ");
        $msg->info('kategori berhasil diedit');
        echo "<script>window.location = '$hal'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Data Gagal diedit!'); window.location = '$hal'</script>";
    }
}

// add modul
elseif ($act == 'add') {
    try {
        $datas = array(
            'judul' => $_POST["judul"],
            'deskripsi' => $_POST["deskripsi"],
            'judul_seo' => $judul_seo,
        );
        $saved = $db->insert('kategori', $datas);
        $msg->success('kategori berhasil ditambah');
        echo "<script> window.location = '$hal'</script>";

    } catch (PDOException $e) {
        echo "<script>window.alert('Data Gagal ditambah!'); window.location(history.back(-1))</script>";
    }
}

// remove modul
elseif ($act == 'remove') {
    $db->delete("kategori", "id_kategori='$id' ");
    $msg->info('kategori berhasil dihapus');
    echo "<script>window.location = '$hal'</script>";
}