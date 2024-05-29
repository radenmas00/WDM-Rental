<?php

$judul_seo = seo($_POST["judul"]);
// Update modul
if ($act == 'update') {
    try {
        $datas = array(
            'judul' => $_POST["judul"],
            'kategori' => $_POST["kategori"],
            'judul_seo' => $judul_seo,
        );
        $db->update('listproject', $datas, "id_listproject = $_POST[id_listproject] ");
        $msg->info('Kategori berhasil diedit');
        echo "<script>window.location = '$hal'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Data Gagal diedit!'); window.location = '$hal'</script>";
    }
}

// add modul
elseif ($act == 'add') {
    
    
    try {
       $judul = explode('.' , $_POST['judul']);
    /*
    foreach($judul as $j){
        $judul_seo = seo($j);
        $datas = array(
            'judul' => $j,
            'kategori' => $_POST["kategori"],
            'judul_seo' => $judul_seo,
        );
        $saved = $db->insert('listproject', $datas);
    }*/
    
    $datas = array(
            'judul' => $_POST["judul"],
            'kategori' => $_POST["kategori"],
            'judul_seo' => $judul_seo,
        );
        $saved = $db->insert('listproject', $datas);
        $msg->success('Kategori berhasil ditambah');
        echo "<script> window.location = '$hal'</script>";

    } catch (PDOException $e) {
        echo "<script>window.alert('Data Gagal ditambah!'); window.location(history.back(-1))</script>";
    }
}

// remove modul
elseif ($act == 'remove') {
    $db->delete("listproject", "id_listproject='$id' ");
    echo "<script>alert('Data Berhasil dihapus'); window.location = '$hal'</script>";
}