<?php

$judul_seo = seo($_POST["judul"]);
// Update modul
if ($act == 'update') {
    try {
        $datas = array(
            'judul' => $_POST["judul"],
            'judul_seo' => $judul_seo,
            'deskripsi' => $_POST["deskripsi"],
            'gambar' => $_POST["gambar"],
        );
        $db->update('keuntungan', $datas, "id_keuntungan = $_POST[id_keuntungan] ");

        echo "<script>alert('Data Berhasil diedit'); window.location = '$hal'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Data Gagal diedit!'); window.location = '$hal'</script>";
    }
}

// add modul
elseif ($act == 'add') {
    try {
        $datas = array(
            'judul' => $_POST["judul"],
            'judul_seo' => $judul_seo,
            'deskripsi' => $_POST["deskripsi"],
            'gambar' => $_POST["gambar"],
        );
        $saved = $db->insert('keuntungan', $datas);

        echo "<script>alert('Datai Berhasil ditambah'); window.location = '$hal'</script>";

    } catch (PDOException $e) {
        echo "<script>window.alert('Data Gagal ditambah!'); window.location(history.back(-1))</script>";
    }
}

// remove modul
elseif ($act == 'remove') {
    $db->delete("keuntungan", "id_keuntungan='$id' ");
    echo "<script>alert('Data Berhasil dihapus'); window.location = '$hal'</script>";
}
