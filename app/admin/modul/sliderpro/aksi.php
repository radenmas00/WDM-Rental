<?php
use \Gumlet\ImageResize;
// Update modul
if ($act == 'update') {
    $jdl2 = substr($_POST["nama"], 0, 100);

    $lokasi_file = $_FILES['lopoFile']['tmp_name'];
    $nama_file = $_FILES['lopoFile']['name'];
    $tipe_file = $_FILES['lopoFile']['type'];
    $ukuran = $_FILES['lopoFile']['size'];
    $tipe_file2 = seo2($tipe_file);
    $seojdul = seo($jdl2);
    $acak = rand(00, 99);
    $nama_file_unik = $seojdul . "-" . $acak . "." . $tipe_file2;
    $nama_file_unik = $seojdul . "-" . $acak . "." . $tipe_file2;
    $nama_seo = seo($_POST["nama"]);

    if (!empty($lokasi_file)) {
        if (($ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)) {
            echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
        } else {
            $edit = $db->connection("SELECT gambar FROM sliderpro WHERE id_sliderpro='$_POST[id_sliderpro]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/sliderpro/$tedit[gambar]");
            unlink("images/sliderpro/small/$tedit[gambar]");

            $res = lopoUpload($seojdul . '-' . $acak, 'sliderpro');

            if ($res == true) {
                try {
                    $datas = array(
                        'judul' => $_POST["nama"],
                        'gambar' => $nama_file_unik,
                        'deskripsi' => $_POST["deskripsi"],
                    );
                    $db->update("sliderpro", $datas, "id_sliderpro= '$_POST[id_sliderpro]' ");

                    $pathToImage = 'images/sliderpro/' . $nama_file_unik;
                    $pathSmall = 'images/sliderpro/small/' . $nama_file_unik;
                    lopoCompress('sliderpro', $pathToImage, $tipe_file2);
                    lopoCompress('sliderpro/small', $pathToImage, $tipe_file2, 3);

                    $image = new ImageResize($pathSmall);
                    $image->resizeToHeight(640);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    $image2->resizeToWidth(1366);
                    $image2->save($pathToImage);
                    $msg->info('sliderpro successfully updated');
                    echo "<script> window.location = '$hal-edit-$_POST[id_sliderpro]'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('sliderpro Gagal diedit!'); window.location = '$hal-edit-$_POST[id_sliderpro]'</script>";
                }
            } else {
                echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
            }
        }
    } else {
        try {

            $edit = $db->connection("SELECT gambar FROM sliderpro WHERE id_sliderpro='$_POST[id_sliderpro]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);
            $datas = array();

            $datas = array(
                'judul' => $_POST["nama"],
                'deskripsi' => $_POST["deskripsi"],
            );
            $db->update("sliderpro", $datas, "id_sliderpro= '$_POST[id_sliderpro]' ");
            $msg->info('sliderpro successfully updated');
            echo "<script>window.location = '$hal-edit-$_POST[id_sliderpro]'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('sliderpro Gagal diedit!'); window.location = '$hal-edit-$_POST[id_sliderpro]'</script>";
        }
    }
}

// add modul
elseif ($act == 'add') {

    $lokasi_file = $_FILES['lopoFile']['tmp_name'];
    $nama_file = $_FILES['lopoFile']['name'];
    $tipe_file = $_FILES['lopoFile']['type'];
    $ukuran = $_FILES['lopoFile']['size'];
    $tipe_file2 = seo2($tipe_file);
    $seojdul = seo($_POST["nama"]);
    $acak = rand(00, 99);
    $nama_file_unik = $seojdul . "-" . $acak . "." . $tipe_file2;
    $nama_seo = seo($_POST["nama"]);
    date_default_timezone_set('Asia/Jakarta');



    if (empty($nama_file)) {
        echo "<script>window.alert('Gambar Tidak Boleh Kosong!'); window.location(history.back(-1))</script>";
    } else {
        if (($ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)) {
            echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
        } else {
            $res = lopoUpload($seojdul . '-' . $acak, 'sliderpro');
            if ($res == true) {
                try {

                    $datas = array(
                        'judul' => $_POST["nama"],
                        'gambar' => $nama_file_unik,
                        'deskripsi' => $_POST["deskripsi"],
                    );
                    $saved = $db->insert('sliderpro', $datas);
                    $insertId = $db->lastId();

                    $pathToImage = 'images/sliderpro/' . $nama_file_unik;
                    $pathSmall = 'images/sliderpro/small/' . $nama_file_unik;
                    lopoCompress('sliderpro', $pathToImage, $tipe_file2, 1);
                    lopoCompress('sliderpro/small', $pathToImage, $tipe_file2, 3);

                    $image = new ImageResize($pathSmall);
                    $image->resizeToHeight(640);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    $image2->resizeToWidth(1366);
                    $image2->save($pathToImage);
                    $msg->success('sliderpro berhasil ditambah');
                    echo "<script>window.location = '$hal-edit-$insertId'</script>";

                } catch (PDOException $e) {
                    echo "$e";
                }
            } else {
                echo "<script>alert('Format Gambar Salah !'); window.location = '$hal'</script>";
            }
        }
    }
}

// remove modul
elseif ($act == 'remove') {
    $edit = $db->connection("SELECT gambar FROM sliderpro WHERE id_sliderpro=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/sliderpro/$rr[gambar]");
    unlink("images/sliderpro/small/$rr[gambar]");

    $del = $db->delete("sliderpro", "id_sliderpro=$id ");

    echo "<script>alert('Data Berhasil dihapus'); window.location = '$hal'</script>";

} elseif ($module == $module2 and $act == 'addgallery') {
    $edit = $db->connection("SELECT nama FROM sliderpro WHERE id_sliderpro='$_POST[id]'");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);

    $lokasi_file = $_FILES['nyanpload']['tmp_name'];
    $nama_file = $_FILES['nyanpload']['name'];
    $tipe_file = $_FILES['nyanpload']['type'];
    $tipe_file2 = seo2($tipe_file);
    $seojdul = seo($tedit["nama"]);
    $acak = rand(00, 99);
    $nama_file_unik = $seojdul . $acak . "." . $tipe_file2;
    $idku = $_POST['id'];
    if (empty($lokasi_file)) {
        echo "<script>window.alert('Belum ada Gambar yang Dimasukan!');
            window.location(history.back(-1))</script>";
    } else {
        try {
            UploadNyan($nama_file_unik, 'gallery_sliderpro');

            $datas = array(
                'id_sliderpro' => $idku,
                'gambar' => $nama_file_unik,
                'nama' => $_POST['nama'],
            );
            $db->insert('gallery_sliderpro', $datas);

            unlink("../../../images/gallery_sliderpro/$nama_file_unik");

            echo "<script>alert('Gambar berhasil dimasukan!'); window.location = '../../$module-edit-$_POST[id]#gallery_sliderpro'</script>";
        } catch (PDOException $e) {
            echo "$e";
        }

    }
} elseif ($act == 'editgallery') {
    $edit = $db->connection("SELECT nama FROM sliderpro WHERE id_sliderpro='$_POST[idm]'");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    $idku = $_POST['idm'];

    $lokasi_file = $_FILES['nyanpload']['tmp_name'];
    $nama_file = $_FILES['nyanpload']['name'];
    $tipe_file = $_FILES['nyanpload']['type'];
    $tipe_file2 = seo2($tipe_file);
    $seojdul = seo($tedit["nama"]);
    $acak = rand(00, 99);
    $nama_file_unik = $seojdul . $acak . "." . $tipe_file2;

    if (empty($lokasi_file)) {
        echo "<script>window.alert('Belum ada Gambar yang Dimasukan!');
            window.location(history.back(-1))</script>";
    } else {

        UploadNyan($nama_file_unik, 'gallery_sliderpro');

        $edit = $db->connection("SELECT gambar FROM gallery_sliderpro WHERE id_gallery ='$_POST[id]'");
        $tedit = $edit->fetch(PDO::FETCH_ASSOC);

        unlink("../../../images/gallery_sliderpro/$imgname1-$tedit[gambar]");
        unlink("../../../images/gallery_sliderpro/small/$imgname2-$tedit[gambar]");

        $datas = array(
            'id_sliderpro' => $idku,
            'gambar' => $nama_file_unik,
            'nama' => $_POST['nama'],
        );
        $db->update('gallery_sliderpro', $datas, " id_gallery = '$_POST[id]' ");

        unlink("../../../images/gallery_sliderpro/$nama_file_unik");

        echo "<script>alert('sliderpro gambar berhasil diedit!'); window.location = '../../$module-edit-$_POST[idm]#sliderprosliderpro'</script>";
    }
} elseif ($act == 'removegallery') {
    $edit = $db->connection("SELECT id_gallery, gambar FROM gallery_sliderpro WHERE id_gallery='$_GET[id]'");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("../../../images/gallery_sliderpro/$imgname1-$tedit[gambar]");
    unlink("../../../images/gallery_sliderpro/small/$imgname1-$tedit[gambar]");
    $id = $tedit['id_gallery_sliderpro'];

    $del = $db->connection("DELETE FROM gallery_sliderpro WHERE id_gallery='$_GET[id]'");
    $del->execute();

    header('location:../../' . $module . '-edit-' . $_GET['idm'] . '#sliderprosliderpro');
}
