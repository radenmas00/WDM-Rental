<?php
ini_set("memory_limit", "-1");
set_time_limit(0);
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
            $edit = $db->connection("SELECT gambar FROM slider WHERE id_slider='$_POST[id_slider]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/slider/$tedit[gambar]");
            unlink("images/slider/small/$tedit[gambar]");
            unlink("images/slider/$tedit[gambar].webp");
            unlink("images/slider/small/$tedit[gambar].webp");

            $res = lopoUpload($seojdul . '-' . $acak, 'slider');

            if ($res == true) {
                try {
                    $datas = array(
                        'judul' => $_POST["nama"],
                        'gambar' => $nama_file_unik,
                        'deskripsi' => $_POST["deskripsi"],
                    );
                    $db->update("slider", $datas, "id_slider= '$_POST[id_slider]' ");

                    $pathToImage = 'images/slider/' . $nama_file_unik;
                    $pathSmall = 'images/slider/small/' . $nama_file_unik;
                    lopoCompress('slider', $pathToImage, $tipe_file2);
                    lopoCompress('slider/small', $pathToImage, $tipe_file2, 3);

                    $image = new ImageResize($pathSmall);
                    $image->resizeToHeight(200);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    $image2->resizeToHeight(823);
                    $image2->save($pathToImage);
                    
                     // Convert to WEBP
                    $destination  = $pathToImage . '.webp';
                    $destination2 = $pathSmall . '.webp';

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathToImage, $destination, 75 );

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathSmall, $destination2, 75 );
                    $msg->info('Slider successfully updated');
                    echo "<script> window.location = '$hal-edit-$_POST[id_slider]'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('slider Gagal diedit!'); window.location = '$hal-edit-$_POST[id_slider]'</script>";
                }
            } else {
                echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
            }
        }
    } else {
        try {

            $edit = $db->connection("SELECT gambar FROM slider WHERE id_slider='$_POST[id_slider]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);
            $datas = array();

            $datas = array(
                'judul' => $_POST["nama"],
                'deskripsi' => $_POST["deskripsi"],
            );
            $db->update("slider", $datas, "id_slider= '$_POST[id_slider]' ");
            $msg->info('Slider successfully updated');
            echo "<script>window.location = '$hal-edit-$_POST[id_slider]'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('slider Gagal diedit!'); window.location = '$hal-edit-$_POST[id_slider]'</script>";
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
            $res = lopoUpload($seojdul . '-' . $acak, 'slider');
            if ($res == true) {
                try {

                    $datas = array(
                        'judul' => $_POST["nama"],
                        'gambar' => $nama_file_unik,
                        'deskripsi' => $_POST["deskripsi"],
                    );
                    $saved = $db->insert('slider', $datas);
                    $insertId = $db->lastId();

                    $pathToImage = 'images/slider/' . $nama_file_unik;
                    $pathSmall = 'images/slider/small/' . $nama_file_unik;
                    lopoCompress('slider', $pathToImage, $tipe_file2, 0);
                    lopoCompress('slider/small', $pathToImage, $tipe_file2, 3);

                    $image = new ImageResize($pathSmall);
                    $image->resizeToHeight(200);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    $image2->resizeToHeight(823);
                    $image2->save($pathToImage);
                    
                     // Convert to WEBP
                    $destination  = $pathToImage . '.webp';
                    $destination2 = $pathSmall . '.webp';

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathToImage, $destination, 75 );

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathSmall, $destination2, 75 );
                    $msg->success('Slider berhasil ditambah');
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
    $edit = $db->connection("SELECT gambar FROM slider WHERE id_slider=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/slider/$rr[gambar]");
    unlink("images/slider/small/$rr[gambar]");
    unlink("images/slider/$rr[gambar].webp");
    unlink("images/slider/small/$rr[gambar].webp");

    $del = $db->delete("slider", "id_slider=$id ");

    echo "<script>alert('Data Berhasil dihapus'); window.location = '$hal'</script>";

} elseif ($module == $module2 and $act == 'addgallery') {
    $edit = $db->connection("SELECT nama FROM slider WHERE id_slider='$_POST[id]'");
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
            UploadNyan($nama_file_unik, 'gallery_slider');

            $datas = array(
                'id_slider' => $idku,
                'gambar' => $nama_file_unik,
                'nama' => $_POST['nama'],
            );
            $db->insert('gallery_slider', $datas);

            unlink("../../../images/gallery_slider/$nama_file_unik");

            echo "<script>alert('Gambar berhasil dimasukan!'); window.location = '../../$module-edit-$_POST[id]#gallery_slider'</script>";
        } catch (PDOException $e) {
            echo "$e";
        }

    }
} elseif ($act == 'editgallery') {
    $edit = $db->connection("SELECT nama FROM slider WHERE id_slider='$_POST[idm]'");
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

        UploadNyan($nama_file_unik, 'gallery_slider');

        $edit = $db->connection("SELECT gambar FROM gallery_slider WHERE id_gallery ='$_POST[id]'");
        $tedit = $edit->fetch(PDO::FETCH_ASSOC);

        unlink("../../../images/gallery_slider/$imgname1-$tedit[gambar]");
        unlink("../../../images/gallery_slider/small/$imgname2-$tedit[gambar]");

        $datas = array(
            'id_slider' => $idku,
            'gambar' => $nama_file_unik,
            'nama' => $_POST['nama'],
        );
        $db->update('gallery_slider', $datas, " id_gallery = '$_POST[id]' ");

        unlink("../../../images/gallery_slider/$nama_file_unik");

        echo "<script>alert('Slider gambar berhasil diedit!'); window.location = '../../$module-edit-$_POST[idm]#sliderslider'</script>";
    }
} elseif ($act == 'removegallery') {
    $edit = $db->connection("SELECT id_gallery, gambar FROM gallery_slider WHERE id_gallery='$_GET[id]'");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("../../../images/gallery_slider/$imgname1-$tedit[gambar]");
    unlink("../../../images/gallery_slider/small/$imgname1-$tedit[gambar]");
    $id = $tedit['id_gallery_slider'];

    $del = $db->connection("DELETE FROM gallery_slider WHERE id_gallery='$_GET[id]'");
    $del->execute();

    header('location:../../' . $module . '-edit-' . $_GET['idm'] . '#sliderslider');
}
