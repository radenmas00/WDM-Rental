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

    // if (!empty($lokasi_file)) {
    //     if (($ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)) {
    //         echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
    //     } else {
    //         $edit = $db->connection("SELECT gambar FROM process_kat WHERE id_process_kat='$_POST[id_process_kat]'");
    //         $tedit = $edit->fetch(PDO::FETCH_ASSOC);

    //         unlink("images/process_kat/$tedit[gambar]");
    //         unlink("images/process_kat/small/$tedit[gambar]");

    //         $res = lopoUpload($seojdul . '-' . $acak, 'process_kat');

    //         if ($res == true) {
                try {
                    $datas = array(
                        'judul' => $_POST["nama"],
                        'judul_seo' => $nama_seo,
                        'gambar' => $nama_file_unik,
                        // 'title' => $_POST["title"],
                        // 'keyword' => $_POST["keyword"],
                        // 'deskripsi' => $_POST["deskripsi"],
                    );
                    $db->update("process_kat", $datas, "id_process_kat= '$_POST[id_process_kat]' ");

                    // $pathToImage = 'images/process_kat/' . $nama_file_unik;
                    // $pathSmall = 'images/process_kat/small/' . $nama_file_unik;
                    // lopoCompress('process_kat', $pathToImage, $tipe_file2);
                    // lopoCompress('process_kat/small', $pathToImage, $tipe_file2, 3);

                    // $image = new ImageResize($pathSmall);
                    // $image->resize(250, 250);
                    // $image->save($pathSmall);

                    // $image2 = new ImageResize($pathToImage);
                    // $image2->resize(500, 500);
                    // $image2->save($pathToImage);

                    $msg->info('Data berhasil diubah');
                    echo "<script> window.location = '$hal'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('process_kat Gagal diedit!'); window.location = '$hal-edit-$_POST[id_process_kat]'</script>";
                }
    //         } else {
    //             echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
    //         }
    //     }
    // } else {
    //     try {

    //         $edit = $db->connection("SELECT gambar FROM process_kat WHERE id_process_kat='$_POST[id_process_kat]'");
    //         $tedit = $edit->fetch(PDO::FETCH_ASSOC);

    //         $datas = array(
    //             'judul' => $_POST["nama"],
    //             'judul_seo' => $nama_seo,
    //             // 'title' => $_POST["title"],
				// 'keyword' => $_POST["keyword"],
				// 'deskripsi' => $_POST["deskripsi"],
    //         );
    //         $db->update("process_kat", $datas, "id_process_kat= '$_POST[id_process_kat]' ");
    //         $msg->info('Data berhasil diubah');
    //         echo "<script>window.location = '$hal-edit-$_POST[id_process_kat]'</script>";
    //     } catch (PDOException $e) {
    //         echo "<script>alert('process_kat Gagal diedit!'); window.location = '$hal-edit-$_POST[id_process_kat]'</script>";
    //     }
    // }
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



    // if (!empty($nama_file)) {
    //     echo "<script>window.alert('Gambar Tidak Boleh Kosong!'); window.location(history.back(-1))</script>";
    // } else {
    //     // if (empty($nama_file)) {
    //     // /$ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)
    //     if (!empty($nama_file)) {
    //         echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
    //     } else {
    //         //$res = lopoUpload($seojdul . '-' . $acak, 'process_kat');
    //         $res = true;
    //         if ($res == true) {
                try {

                    $datas = array(
                        'judul' => $_POST["nama"],
                        'judul_seo' => $nama_seo,
                        // 'gambar' => $nama_file_unik,
        //                 'title' => $_POST["title"],
					   // 'keyword' => $_POST["keyword"],
					   // 'deskripsi' => $_POST["deskripsi"]
                    );
                    $saved = $db->insert('process_kat', $datas);
                    $insertId = $db->lastId();

                    // $pathToImage = 'images/process_kat/' . $nama_file_unik;
                    // $pathSmall = 'images/process_kat/small/' . $nama_file_unik;
                    // lopoCompress('process_kat', $pathToImage, $tipe_file2, 0);
                    // lopoCompress('process_kat/small', $pathToImage, $tipe_file2, 3);

                    // $image = new ImageResize($pathSmall);
                    // $image->resize(250, 250);
                    // $image->save($pathSmall);

                    // $image2 = new ImageResize($pathToImage);
                    // $image2->resize(500, 500);
                    // $image2->save($pathToImage);

                    $msg->success('Data berhasil ditambah');
				    echo "<script>window.location = '$hal'</script>";

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
    $edit = $db->connection("SELECT gambar FROM process_kat WHERE id_process_kat=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/process_kat/$rr[gambar]");
    unlink("images/process_kat/small/$rr[gambar]");

    $del = $db->delete("process_kat", "id_process_kat=$id ");

    $msg->success('Data berhasil dihapus');
    echo "<script> window.location = '$hal'</script>";

    //echo "<script>alert('Data Berhasil dihapus'); window.location = '$hal'</script>";

} elseif ($module == $module2 and $act == 'addgallery') {
    $edit = $db->connection("SELECT nama FROM process_kat WHERE id_process_kat='$_POST[id]'");
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
            UploadNyan($nama_file_unik, 'gallery_process_kat');

            $datas = array(
                'id_process_kat' => $idku,
                'gambar' => $nama_file_unik,
                'nama' => $_POST['nama'],
            );
            $db->insert('gallery_process_kat', $datas);

            unlink("../../../images/gallery_process_kat/$nama_file_unik");

            echo "<script>alert('Gambar berhasil dimasukan!'); window.location = '../../$module-edit-$_POST[id]#gallery_process_kat'</script>";
        } catch (PDOException $e) {
            echo "$e";
        }

    }
} elseif ($act == 'editgallery') {
    $edit = $db->connection("SELECT nama FROM process_kat WHERE id_process_kat='$_POST[idm]'");
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

        UploadNyan($nama_file_unik, 'gallery_process_kat');

        $edit = $db->connection("SELECT gambar FROM gallery_process_kat WHERE id_gallery ='$_POST[id]'");
        $tedit = $edit->fetch(PDO::FETCH_ASSOC);

        unlink("../../../images/gallery_process_kat/$imgname1-$tedit[gambar]");
        unlink("../../../images/gallery_process_kat/small/$imgname2-$tedit[gambar]");

        $datas = array(
            'id_process_kat' => $idku,
            'gambar' => $nama_file_unik,
            'nama' => $_POST['nama'],
        );
        $db->update('gallery_process_kat', $datas, " id_gallery = '$_POST[id]' ");

        unlink("../../../images/gallery_process_kat/$nama_file_unik");

        echo "<script>alert('process_kat gambar berhasil diedit!'); window.location = '../../$module-edit-$_POST[idm]#process_katprocess_kat'</script>";
    }
} elseif ($act == 'removegallery') {
    $edit = $db->connection("SELECT id_gallery, gambar FROM gallery_process_kat WHERE id_gallery='$_GET[id]'");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("../../../images/gallery_process_kat/$imgname1-$tedit[gambar]");
    unlink("../../../images/gallery_process_kat/small/$imgname1-$tedit[gambar]");
    $id = $tedit['id_gallery_process_kat'];

    $del = $db->connection("DELETE FROM gallery_process_kat WHERE id_gallery='$_GET[id]'");
    $del->execute();

    header('location:../../' . $module . '-edit-' . $_GET['idm'] . '#process_katprocess_kat');
}
