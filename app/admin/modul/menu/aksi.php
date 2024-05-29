<?php

$judul_seo = seo($_POST["judul"]);
// Update modul
if ($act == 'update') {
    try {
        $datas = array(
            'judul' => $_POST["judul"],
            'urutan' => $_POST["urutan"],
            'deskripsi' => $_POST["deskripsi"],
            'judul_seo' => $judul_seo,
        );
        $db->update('menu', $datas, "id_menu = $_POST[id_menu] ");
        $msg->info('menu berhasil diedit');
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
            'urutan' => $_POST["urutan"],
            'deskripsi' => $_POST["deskripsi"],
            'judul_seo' => $judul_seo,
        );
        $saved = $db->insert('menu', $datas);
        $msg->success('menu berhasil ditambah');
        echo "<script> window.location = '$hal'</script>";

    } catch (PDOException $e) {
        echo "<script>window.alert('Data Gagal ditambah!'); window.location(history.back(-1))</script>";
    }
}

// remove modul
elseif ($act == 'remove') {
    $db->delete("menu", "id_menu='$id' ");
    $msg->info('menu berhasil dihapus');
    echo "<script>window.location = '$hal'</script>";
}