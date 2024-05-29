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
            $edit = $db->connection("SELECT gambar FROM keunggulan WHERE id_keunggulan='$_POST[id_keunggulan]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/keunggulan/$tedit[gambar]");
            unlink("images/keunggulan/small/$tedit[gambar]");

            unlink("images/keunggulan/$tedit[gambar].webp");
            unlink("images/keunggulan/small/$tedit[gambar].webp");

            $res = lopoUpload($seojdul . '-' . $acak, 'keunggulan');

            if ($res == true) {
                try {
                    $datas = array(
                        'judul' => $_POST["nama"],
                        'gambar' => $nama_file_unik,
                        'deskripsi' => $_POST["deskripsi"],
                        'icon' => $_POST["icon"],
                    );
                    $db->update("keunggulan", $datas, "id_keunggulan= '$_POST[id_keunggulan]' ");

                    $pathToImage = 'images/keunggulan/' . $nama_file_unik;
                    $pathSmall = 'images/keunggulan/small/' . $nama_file_unik;
                    lopoCompress('keunggulan', $pathToImage, $tipe_file2);
                    lopoCompress('keunggulan/small', $pathToImage, $tipe_file2, 3);

                    $image = new ImageResize($pathSmall);
                    $image->resize(125, 125);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    $image2->save($pathToImage);

                    // Convert to WEBP
                    $destination  = $pathToImage . '.webp';
                    $destination2 = $pathSmall . '.webp';

                    $jw = new ImageToWebp();
                    $jw->convert($pathToImage, $destination, 75);

                    $jw = new ImageToWebp();
                    $jw->convert($pathSmall, $destination2, 75);

                    $msg->info('Data berhasil diubah');
                    echo "<script> window.location = '$hal'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('keunggulan Gagal diedit!'); window.location = '$hal-edit-$_POST[id_keunggulan]'</script>";
                }
            } else {
                echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
            }
        }
    } else {
        try {

            $edit = $db->connection("SELECT gambar FROM keunggulan WHERE id_keunggulan='$_POST[id_keunggulan]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);
            $datas = array();

            $datas = array(
                'judul' => $_POST["nama"],
                'deskripsi' => $_POST["deskripsi"],
                'icon' => $_POST["icon"],
            );
            $db->update("keunggulan", $datas, "id_keunggulan= '$_POST[id_keunggulan]' ");
            $msg->info('Data berhasil diubah');
            echo "<script>window.location = '$hal'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('keunggulan Gagal diedit!'); window.location = '$hal-edit-$_POST[id_keunggulan]'</script>";
        }
    }
}

// add modul
elseif ($act == 'add') {

    // $lokasi_file = $_FILES['lopoFile']['tmp_name'];
    // $nama_file = $_FILES['lopoFile']['name'];
    // $tipe_file = $_FILES['lopoFile']['type'];
    // $ukuran = $_FILES['lopoFile']['size'];
    // $tipe_file2 = seo2($tipe_file);
    $seojdul = seo($_POST["nama"]);
    $acak = rand(00, 99);
    // $nama_file_unik = $seojdul . "-" . $acak . "." . $tipe_file2;
    $nama_seo = seo($_POST["nama"]);
    date_default_timezone_set('Asia/Jakarta');

    // $res = lopoUpload($seojdul . '-' . $acak, 'keunggulan');
    try {

        $datas = array(
            'judul' => $_POST["nama"],
            // 'gambar' => $nama_file_unik,
            'deskripsi' => $_POST["deskripsi"],
            'icon' => $_POST["icon"],
        );
        $saved = $db->insert('keunggulan', $datas);
        $insertId = $db->lastId();

        echo "<script>alert('keunggulan Berhasil ditambah'); window.location = '$hal-edit-$insertId'</script>";
    } catch (PDOException $e) {
        echo "$e";
    }


    // if (empty($nama_file)) {
    //     echo "<script>window.alert('Gambar Tidak Boleh Kosong!'); window.location(history.back(-1))</script>";
    // } else {
    //     if (($ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)) {
    //         echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
    //     } else {
    //         $res = lopoUpload($seojdul . '-' . $acak, 'keunggulan');
    //         if ($res == true) {
    //             try {

    //                 $datas = array(
    //                     'judul' => $_POST["nama"],
    //                     'gambar' => $nama_file_unik,
    //                     'deskripsi' => $_POST["deskripsi"],
    //                     'icon' => $_POST["icon"],
    //                 );
    //                 $saved = $db->insert('keunggulan', $datas);
    //                 $insertId = $db->lastId();

    //                 $pathToImage = 'images/keunggulan/' . $nama_file_unik;
    //                 $pathSmall = 'images/keunggulan/small/' . $nama_file_unik;
    //                 lopoCompress('keunggulan', $pathToImage, $tipe_file2, 0);
    //                 lopoCompress('keunggulan/small', $pathToImage, $tipe_file2, 3);

    //                 $image = new ImageResize($pathSmall);
    //                 $image->resize(125, 125);
    //                 $image->save($pathSmall);

    //                 $image2 = new ImageResize($pathToImage);
    //                 $image2->save($pathToImage);

    //                 // Convert to WEBP
    // 				$destination  = $pathToImage . '.webp';
    // 				$destination2 = $pathSmall . '.webp';

    // 				$jw = new ImageToWebp(); 
    // 				$jw->convert( $pathToImage, $destination, 75 );

    // 				$jw = new ImageToWebp(); 
    // 				$jw->convert( $pathSmall, $destination2, 75 );

    //                 echo "<script>alert('keunggulan Berhasil ditambah'); window.location = '$hal-edit-$insertId'</script>";

    //             } catch (PDOException $e) {
    //                 echo "$e";
    //             }
    //         } else {
    //             echo "<script>alert('Format Gambar Salah !'); window.location = '$hal'</script>";
    //         }
    //     }
    // }
}

// remove modul
elseif ($act == 'remove') {
    $edit = $db->connection("SELECT gambar FROM keunggulan WHERE id_keunggulan=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/keunggulan/$rr[gambar]");
    unlink("images/keunggulan/small/$rr[gambar]");
    unlink("images/keunggulan/$rr[gambar].webp");
    unlink("images/keunggulan/small/$rr[gambar].webp");

    $del = $db->delete("keunggulan", "id_keunggulan=$id ");

    echo "<script>alert('Data Berhasil dihapus'); window.location = '$hal'</script>";
} elseif ($module == $module2 and $act == 'addgallery') {
    $edit = $db->connection("SELECT nama FROM keunggulan WHERE id_keunggulan='$_POST[id]'");
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
            UploadNyan($nama_file_unik, 'gallery_keunggulan');

            $datas = array(
                'id_keunggulan' => $idku,
                'gambar' => $nama_file_unik,
                'nama' => $_POST['nama'],
            );
            $db->insert('gallery_keunggulan', $datas);

            unlink("../../../images/gallery_keunggulan/$nama_file_unik");

            echo "<script>alert('Gambar berhasil dimasukan!'); window.location = '../../$module-edit-$_POST[id]#gallery_keunggulan'</script>";
        } catch (PDOException $e) {
            echo "$e";
        }
    }
} elseif ($act == 'editgallery') {
    $edit = $db->connection("SELECT nama FROM keunggulan WHERE id_keunggulan='$_POST[idm]'");
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

        UploadNyan($nama_file_unik, 'gallery_keunggulan');

        $edit = $db->connection("SELECT gambar FROM gallery_keunggulan WHERE id_gallery ='$_POST[id]'");
        $tedit = $edit->fetch(PDO::FETCH_ASSOC);

        unlink("../../../images/gallery_keunggulan/$imgname1-$tedit[gambar]");
        unlink("../../../images/gallery_keunggulan/small/$imgname2-$tedit[gambar]");

        $datas = array(
            'id_keunggulan' => $idku,
            'gambar' => $nama_file_unik,
            'nama' => $_POST['nama'],
        );
        $db->update('gallery_keunggulan', $datas, " id_gallery = '$_POST[id]' ");

        unlink("../../../images/gallery_keunggulan/$nama_file_unik");

        echo "<script>alert('keunggulan gambar berhasil diedit!'); window.location = '../../$module-edit-$_POST[idm]#keunggulankeunggulan'</script>";
    }
} elseif ($act == 'removegallery') {
    $edit = $db->connection("SELECT id_gallery, gambar FROM gallery_keunggulan WHERE id_gallery='$_GET[id]'");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("../../../images/gallery_keunggulan/$imgname1-$tedit[gambar]");
    unlink("../../../images/gallery_keunggulan/small/$imgname1-$tedit[gambar]");
    $id = $tedit['id_gallery_keunggulan'];

    $del = $db->connection("DELETE FROM gallery_keunggulan WHERE id_gallery='$_GET[id]'");
    $del->execute();

    header('location:../../' . $module . '-edit-' . $_GET['idm'] . '#keunggulankeunggulan');
}
