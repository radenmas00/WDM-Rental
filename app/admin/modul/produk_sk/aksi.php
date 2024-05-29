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
            $edit = $db->connection("SELECT gambar FROM produk_sk WHERE id_produk_sk='$_POST[id_produk_sk]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/produk_sk/$tedit[gambar]");
            unlink("images/produk_sk/small/$tedit[gambar]");

            $res = lopoUpload($seojdul . '-' . $acak, 'produk_sk');

            if ($res == true) {
                try {
                    $datas = array(
                        'judul' => $_POST["nama"],
                        'judul_seo' => $nama_seo,
                        'id_produk_k' => $_POST["id_produk_k"],
                        // 'gambar' => $nama_file_unik,
                        // 'background_color' => $_POST["background_color"],
                        // 'deskripsi' => $_POST["deskripsi"],
                    );
                    $db->update("produk_sk", $datas, "id_produk_sk= '$_POST[id_produk_sk]' ");

                    $pathToImage = 'images/produk_sk/' . $nama_file_unik;
                    $pathSmall = 'images/produk_sk/small/' . $nama_file_unik;
                    lopoCompress('produk_sk', $pathToImage, $tipe_file2);
                    lopoCompress('produk_sk/small', $pathToImage, $tipe_file2, 3);

                    $image = new ImageResize($pathSmall);
                    $image->resize(150, 150);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    
                    $image2->save($pathToImage);

                    $msg->info('Data berhasil diubah');
                    echo "<script> window.location = '$hal'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('produk_sk Gagal diedit!'); window.location = '$hal-edit-$_POST[id_produk_sk]'</script>";
                }
            } else {
                echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
            }
        }
    } else {
        try {

            $edit = $db->connection("SELECT gambar FROM produk_sk WHERE id_produk_sk='$_POST[id_produk_sk]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);
            $datas = array();

            $datas = array(
                'judul' => $_POST["nama"],
                'judul_seo' => $nama_seo,
                'id_produk_k' => $_POST["id_produk_k"],
                // 'background_color' => $_POST["background_color"],
                // 'deskripsi' => $_POST["deskripsi"],
            );
            $db->update("produk_sk", $datas, "id_produk_sk= '$_POST[id_produk_sk]' ");
            $msg->info('Data berhasil diubah');
            echo "<script>window.location = '$hal'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('produk_sk Gagal diedit!'); window.location = '$hal-edit-$_POST[id_produk_sk]'</script>";
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
            //(($ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)) {
            
            echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
        } else {
            //$res = lopoUpload($seojdul . '-' . $acak, 'produk_sk');
            $res = true;
            if ($res == true) {
                try {

                    $datas = array(
                        'judul' => $_POST["nama"],
                        'judul_seo' => $nama_seo,
                        'id_produk_k' => $_POST["id_produk_k"],
                        // 'gambar' => $nama_file_unik,
                        // 'deskripsi' => $_POST["deskripsi"],
                        // 'background_color' => $_POST["background_color"],
                    );
                    $saved = $db->insert('produk_sk', $datas);
                    $insertId = $db->lastId();

                    // $pathToImage = 'images/produk_sk/' . $nama_file_unik;
                    // $pathSmall = 'images/produk_sk/small/' . $nama_file_unik;
                    // lopoCompress('produk_sk', $pathToImage, $tipe_file2, 0);
                    // lopoCompress('produk_sk/small', $pathToImage, $tipe_file2, 3);

                    // $image = new ImageResize($pathSmall);
                    // $image->resize(150, 150);
                    // $image->save($pathSmall);

                    // $image2 = new ImageResize($pathToImage);
                    // $image2->save($pathToImage);

                    $msg->success('Produk Sub Kategori Berhasil Ditambah');
                    echo "<script>window.location = '$hal'</script>";

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
    $edit = $db->connection("SELECT gambar FROM produk_sk WHERE id_produk_sk=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/produk_sk/$rr[gambar]");
    unlink("images/produk_sk/small/$rr[gambar]");

    $del = $db->delete("produk_sk", "id_produk_sk=$id ");

    echo "<script>alert('Data Berhasil dihapus'); window.location = '$hal'</script>";

} elseif ($module == $module2 and $act == 'addgallery') {
    $edit = $db->connection("SELECT nama FROM produk_sk WHERE id_produk_sk='$_POST[id]'");
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
            UploadNyan($nama_file_unik, 'gallery_produk_sk');

            $datas = array(
                'id_produk_sk' => $idku,
                'gambar' => $nama_file_unik,
                'nama' => $_POST['nama'],
            );
            $db->insert('gallery_produk_sk', $datas);

            unlink("../../../images/gallery_produk_sk/$nama_file_unik");

            echo "<script>alert('Gambar berhasil dimasukan!'); window.location = '../../$module-edit-$_POST[id]#gallery_produk_sk'</script>";
        } catch (PDOException $e) {
            echo "$e";
        }

    }
} elseif ($act == 'editgallery') {
    $edit = $db->connection("SELECT nama FROM produk_sk WHERE id_produk_sk='$_POST[idm]'");
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

        UploadNyan($nama_file_unik, 'gallery_produk_sk');

        $edit = $db->connection("SELECT gambar FROM gallery_produk_sk WHERE id_gallery ='$_POST[id]'");
        $tedit = $edit->fetch(PDO::FETCH_ASSOC);

        unlink("../../../images/gallery_produk_sk/$imgname1-$tedit[gambar]");
        unlink("../../../images/gallery_produk_sk/small/$imgname2-$tedit[gambar]");

        $datas = array(
            'id_produk_sk' => $idku,
            'gambar' => $nama_file_unik,
            'nama' => $_POST['nama'],
        );
        $db->update('gallery_produk_sk', $datas, " id_gallery = '$_POST[id]' ");

        unlink("../../../images/gallery_produk_sk/$nama_file_unik");

        echo "<script>alert('produk_sk gambar berhasil diedit!'); window.location = '../../$module-edit-$_POST[idm]#produk_skproduk_sk'</script>";
    }
} elseif ($act == 'removegallery') {
    $edit = $db->connection("SELECT id_gallery, gambar FROM gallery_produk_sk WHERE id_gallery='$_GET[id]'");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("../../../images/gallery_produk_sk/$imgname1-$tedit[gambar]");
    unlink("../../../images/gallery_produk_sk/small/$imgname1-$tedit[gambar]");
    $id = $tedit['id_gallery_produk_sk'];

    $del = $db->connection("DELETE FROM gallery_produk_sk WHERE id_gallery='$_GET[id]'");
    $del->execute();

    header('location:../../' . $module . '-edit-' . $_GET['idm'] . '#produk_skproduk_sk');
}