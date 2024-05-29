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
            $edit = $db->connection("SELECT gambar FROM store WHERE id_store='$_POST[id_store]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/store/$tedit[gambar]");
            unlink("images/store/small/$tedit[gambar]");

            $res = lopoUpload($seojdul . '-' . $acak, 'store');

            if ($res == true) {
                try {
                    $datas = array(
                        'judul' => $_POST["nama"],
                        'judul_seo' => $nama_seo,
                        'gambar' => $nama_file_unik,
                        'deskripsi' => $_POST["deskripsi"],
                    );
                    $db->update("store", $datas, "id_store= '$_POST[id_store]' ");

                    $pathToImage = 'images/store/' . $nama_file_unik;
                    $pathSmall = 'images/store/small/' . $nama_file_unik;
                    lopoCompress('store', $pathToImage, $tipe_file2);
                    lopoCompress('store/small', $pathToImage, $tipe_file2, 3);

                    $image = new ImageResize($pathSmall);
                    $image->resize(150, 150);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    
                    $image2->save($pathToImage);

                    $msg->info('Data berhasil diubah');
                    echo "<script> window.location = '$hal'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('store Gagal diedit!'); window.location = '$hal-edit-$_POST[id_store]'</script>";
                }
            } else {
                echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
            }
        }
    } else {
        try {

            $edit = $db->connection("SELECT gambar FROM store WHERE id_store='$_POST[id_store]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);
            $datas = array();

            $datas = array(
                'judul' => $_POST["nama"],
                'judul_seo' => $nama_seo,
                'facebook' => $_POST["facebook"],
                'ig' => $_POST["ig"],
                'email' => $_POST["email"],
                'wa' => $_POST["wa"],
                'shopee' => $_POST["shopee"],
                'facealamatbook' => $_POST["alamat"],
                'no_telp' => $_POST["no_telp"],
                'jam_buka' => $_POST["jam_buka"],
                'google_map' => $_POST["google_map"],
                
            );
            $db->update("store", $datas, "id_store= '$_POST[id_store]' ");
            $msg->info('Data berhasil diubah');
            echo "<script>window.location = '$hal'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('store Gagal diedit!'); window.location = '$hal-edit-$_POST[id_store]'</script>";
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



    if (!empty($nama_file)) {
        echo "<script>window.alert('Gambar Tidak Boleh Kosong!'); window.location(history.back(-1))</script>";
    } else {
        if (!empty($nama_file)) {
        // if (($ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)) {
            echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
        } else {
            //$res = lopoUpload($seojdul . '-' . $acak, 'store');
            $res = true;
            if ($res == true) {
                try {

                    $datas = array(
                        'judul' => $_POST["nama"],
                        'judul_seo' => $nama_seo,
                        'facebook' => $_POST["facebook"],
                        'ig' => $_POST["ig"],
                        'email' => $_POST["email"],
                        'wa' => $_POST["wa"],
                        'shopee' => $_POST["shopee"],
                        'facealamatbook' => $_POST["alamat"],
                        'no_telp' => $_POST["no_telp"],
                        'jam_buka' => $_POST["jam_buka"],
                        'google_map' => $_POST["google_map"],
                    );
                    $saved = $db->insert('store', $datas);
                    $insertId = $db->lastId();


                    echo "<script>alert('Store Berhasil ditambah'); window.location = '$hal'</script>";

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
    $edit = $db->connection("SELECT gambar FROM store WHERE id_store=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/store/$rr[gambar]");
    unlink("images/store/small/$rr[gambar]");

    $del = $db->delete("store", "id_store=$id ");

    echo "<script>alert('Data Berhasil dihapus'); window.location = '$hal'</script>";

} elseif ($module == $module2 and $act == 'addgallery') {
    $edit = $db->connection("SELECT nama FROM store WHERE id_store='$_POST[id]'");
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
            UploadNyan($nama_file_unik, 'gallery_store');

            $datas = array(
                'id_store' => $idku,
                'gambar' => $nama_file_unik,
                'nama' => $_POST['nama'],
            );
            $db->insert('gallery_store', $datas);

            unlink("../../../images/gallery_store/$nama_file_unik");

            echo "<script>alert('Gambar berhasil dimasukan!'); window.location = '../../$module-edit-$_POST[id]#gallery_store'</script>";
        } catch (PDOException $e) {
            echo "$e";
        }

    }
} elseif ($act == 'editgallery') {
    $edit = $db->connection("SELECT nama FROM store WHERE id_store='$_POST[idm]'");
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

        UploadNyan($nama_file_unik, 'gallery_store');

        $edit = $db->connection("SELECT gambar FROM gallery_store WHERE id_gallery ='$_POST[id]'");
        $tedit = $edit->fetch(PDO::FETCH_ASSOC);

        unlink("../../../images/gallery_store/$imgname1-$tedit[gambar]");
        unlink("../../../images/gallery_store/small/$imgname2-$tedit[gambar]");

        $datas = array(
            'id_store' => $idku,
            'gambar' => $nama_file_unik,
            'nama' => $_POST['nama'],
        );
        $db->update('gallery_store', $datas, " id_gallery = '$_POST[id]' ");

        unlink("../../../images/gallery_store/$nama_file_unik");

        echo "<script>alert('store gambar berhasil diedit!'); window.location = '../../$module-edit-$_POST[idm]#storestore'</script>";
    }
} elseif ($act == 'removegallery') {
    $edit = $db->connection("SELECT id_gallery, gambar FROM gallery_store WHERE id_gallery='$_GET[id]'");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("../../../images/gallery_store/$imgname1-$tedit[gambar]");
    unlink("../../../images/gallery_store/small/$imgname1-$tedit[gambar]");
    $id = $tedit['id_gallery_store'];

    $del = $db->connection("DELETE FROM gallery_store WHERE id_gallery='$_GET[id]'");
    $del->execute();

    header('location:../../' . $module . '-edit-' . $_GET['idm'] . '#storestore');
}
