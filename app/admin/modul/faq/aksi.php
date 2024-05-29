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
        $db->update('faq', $datas, "id_faq = $_POST[id_faq] ");
        $msg->info('FAQ berhasil diedit');
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
        $saved = $db->insert('faq', $datas);
        $msg->success('FAQ berhasil ditambah');
        echo "<script> window.location = '$hal'</script>";

    } catch (PDOException $e) {
        echo "<script>window.alert('Data Gagal ditambah!'); window.location(history.back(-1))</script>";
    }
}

// remove modul
elseif ($act == 'remove') {
    $db->delete("faq", "id_faq='$id' ");
    echo "<script>alert('Data Berhasil dihapus'); window.location = '$hal'</script>";
}