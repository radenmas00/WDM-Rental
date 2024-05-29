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
            $edit = $db->connection("SELECT gambar FROM transportasi WHERE id_transportasi='$_POST[id_transportasi]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/transportasi/$tedit[gambar]");
            unlink("images/transportasi/small/$tedit[gambar]");

            $res = lopoUpload($seojdul . '-' . $acak, 'transportasi');

            if ($res == true) {
                try {
                    $datas = array(
                        'judul' => $_POST["nama"],
                        'gambar' => $nama_file_unik,
                        'harga_mulai' => $_POST["harga_mulai"],
                        'deskripsi' => $_POST["deskripsi"],
                    );
                    $db->update("transportasi", $datas, "id_transportasi= '$_POST[id_transportasi]' ");

                    $pathToImage = 'images/transportasi/' . $nama_file_unik;
                    $pathSmall = 'images/transportasi/small/' . $nama_file_unik;
                    lopoCompress('transportasi', $pathToImage, $tipe_file2);
                    lopoCompress('transportasi/small', $pathToImage, $tipe_file2, 3);

                    $image = new ImageResize($pathSmall);
                    $image->resize(150, 150);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    
                    $image2->save($pathToImage);

                    $msg->info('Data berhasil diubah');
                    echo "<script> window.location = '$hal'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('Data Gagal diedit!'); window.location = '$hal-edit-$_POST[id_transportasi]'</script>";
                }
            } else {
                echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
            }
        }
    } else {
        try {

            $edit = $db->connection("SELECT gambar FROM transportasi WHERE id_transportasi='$_POST[id_transportasi]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);
            $datas = array();

            $datas = array(
                'judul' => $_POST["nama"],
                'deskripsi' => $_POST["deskripsi"],
                'judul_seo' => $seojdul,
            );
            $db->update("transportasi", $datas, "id_transportasi= '$_POST[id_transportasi]' ");
            $msg->info('Data berhasil diubah');
            echo "<script>window.location = '$hal'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Data Gagal diedit!'); window.location = '$hal-edit-$_POST[id_transportasi]'</script>";
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



    // if (empty($nama_file)) {
    //     echo "<script>window.alert('Gambar Tidak Boleh Kosong!'); window.location(history.back(-1))</script>";
    // } else {
    //     if (($ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)) {
    //         echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
    //     } else {
    //         $res = lopoUpload($seojdul . '-' . $acak, 'transportasi');
    //         if ($res == true) {
                try {

                    $datas = array(
                        'judul' => $_POST["nama"],
                        'judul_seo' => $seojdul,
                        // 'gambar' => $nama_file_unik,
                        // 'harga_mulai' => $_POST["harga_mulai"],
                        'deskripsi' => $_POST["deskripsi"],
                    );
                    $saved = $db->insert('transportasi', $datas);
                    $insertId = $db->lastId();

                    // $pathToImage = 'images/transportasi/' . $nama_file_unik;
                    // $pathSmall = 'images/transportasi/small/' . $nama_file_unik;
                    // lopoCompress('transportasi', $pathToImage, $tipe_file2, 0);
                    // lopoCompress('transportasi/small', $pathToImage, $tipe_file2, 3);

                    // $image = new ImageResize($pathSmall);
                    // $image->resize(150, 150);
                    // $image->save($pathSmall);

                    // $image2 = new ImageResize($pathToImage);
                    // $image2->save($pathToImage);

                    echo "<script>alert('Data Berhasil ditambah'); window.location = '$hal-edit-$insertId'</script>";

                } catch (PDOException $e) {
                    echo "$e";
                }
    //         } else {
    //             echo "<script>alert('Format Gambar Salah !'); window.location = '$hal'</script>";
    //         }
    //     }
    // }
}

// remove modul
elseif ($act == 'remove') {
    $edit = $db->connection("SELECT gambar FROM transportasi WHERE id_transportasi=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/transportasi/$rr[gambar]");
    unlink("images/transportasi/small/$rr[gambar]");

    $del = $db->delete("transportasi", "id_transportasi=$id ");

    echo "<script>alert('Data Berhasil dihapus'); window.location = '$hal'</script>";

} elseif ($module == $module2 and $act == 'addgallery') {
    $edit = $db->connection("SELECT nama FROM transportasi WHERE id_transportasi='$_POST[id]'");
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
            UploadNyan($nama_file_unik, 'gallery_transportasi');

            $datas = array(
                'id_transportasi' => $idku,
                'gambar' => $nama_file_unik,
                'nama' => $_POST['nama'],
            );
            $db->insert('gallery_transportasi', $datas);

            unlink("../../../images/gallery_transportasi/$nama_file_unik");

            echo "<script>alert('Gambar berhasil dimasukan!'); window.location = '../../$module-edit-$_POST[id]#gallery_transportasi'</script>";
        } catch (PDOException $e) {
            echo "$e";
        }

    }
} elseif ($act == 'editgallery') {
    $edit = $db->connection("SELECT nama FROM transportasi WHERE id_transportasi='$_POST[idm]'");
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

        UploadNyan($nama_file_unik, 'gallery_transportasi');

        $edit = $db->connection("SELECT gambar FROM gallery_transportasi WHERE id_gallery ='$_POST[id]'");
        $tedit = $edit->fetch(PDO::FETCH_ASSOC);

        unlink("../../../images/gallery_transportasi/$imgname1-$tedit[gambar]");
        unlink("../../../images/gallery_transportasi/small/$imgname2-$tedit[gambar]");

        $datas = array(
            'id_transportasi' => $idku,
            'gambar' => $nama_file_unik,
            'nama' => $_POST['nama'],
        );
        $db->update('gallery_transportasi', $datas, " id_gallery = '$_POST[id]' ");

        unlink("../../../images/gallery_transportasi/$nama_file_unik");

        echo "<script>alert('transportasi gambar berhasil diedit!'); window.location = '../../$module-edit-$_POST[idm]#transportasitransportasi'</script>";
    }
} elseif ($act == 'removegallery') {
    $edit = $db->connection("SELECT id_gallery, gambar FROM gallery_transportasi WHERE id_gallery='$_GET[id]'");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("../../../images/gallery_transportasi/$imgname1-$tedit[gambar]");
    unlink("../../../images/gallery_transportasi/small/$imgname1-$tedit[gambar]");
    $id = $tedit['id_gallery_transportasi'];

    $del = $db->connection("DELETE FROM gallery_transportasi WHERE id_gallery='$_GET[id]'");
    $del->execute();

    header('location:../../' . $module . '-edit-' . $_GET['idm'] . '#transportasitransportasi');
}
