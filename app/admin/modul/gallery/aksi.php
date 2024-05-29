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
            $msg->warning('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !');
            echo "<script> window.location(history.back(-1))</script>";
        } else {
            $edit = $db->connection("SELECT gambar FROM gallery WHERE id_gallery='$_POST[id_gallery]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/gallery/$tedit[gambar]");
            unlink("images/gallery/small/$tedit[gambar]");

            $res = lopoUpload($seojdul . '-' . $acak, 'gallery');

            if ($res == true) {
                try {
                    $datas = array(
                        'nama' => $_POST["nama"],
                        'gambar' => $nama_file_unik
                    );
                    $db->update("gallery", $datas, "id_gallery= '$_POST[id_gallery]' ");

                    $pathToImage = 'images/gallery/' . $nama_file_unik;
                    $pathSmall = 'images/gallery/small/' . $nama_file_unik;
                    lopoCompress('gallery', $pathToImage, $tipe_file2, 1);
                    lopoCompress('gallery/small', $pathToImage, $tipe_file2, 6);

                    $image = new ImageResize($pathSmall);
                    $image->resizeToHeight(200);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    $image2->resizeToHeight(800);
                    $image2->save($pathToImage);
                    
                     // Convert to WEBP
                    $destination  = $pathToImage . '.webp';
                    $destination2 = $pathSmall . '.webp';

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathToImage, $destination, 75 );

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathSmall, $destination2, 75 );

                    $msg->info('Data berhasil diubah');
                    echo "<script>window.location = '$hal-edit-$_POST[id_gallery]'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('gallery Gagal diedit!'); window.location = '$hal-edit-$_POST[id_gallery]'</script>";
                }
            } else {
                echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
            }
        }
    } else {
        try {

            $edit = $db->connection("SELECT gambar FROM gallery WHERE id_gallery='$_POST[id_gallery]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);
            $datas = array();

            $datas = array(
                'nama' => $_POST["nama"]
            );
            $db->update("gallery", $datas, "id_gallery= '$_POST[id_gallery]' ");
            $msg->info('gallery Berhasil diedit');
            echo "<script>alert('gallery Berhasil diedit'); window.location = '$hal-edit-$_POST[id_gallery]'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('gallery Gagal diedit!'); window.location = '$hal-edit-$_POST[id_gallery]'</script>";
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
    // $tgl = explode("/", $_POST['tgl']);
    // $tgl1 = $tgl[0];
    // $bln = $tgl[1];
    // $thn = $tgl[2];
    date_default_timezone_set('Asia/Jakarta');

    // if ($_POST['tgl'] != '') {$tgl_post = "$thn-$bln-$tgl1";} else { $tgl_post = date('Y-m-d');}

    if (empty($nama_file)) {
        echo "<script>window.alert('Gambar Tidak Boleh Kosong!'); window.location(history.back(-1))</script>";
    } else {
        if (($ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)) {
            echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
        } else {
            $res = lopoUpload($seojdul . '-' . $acak, 'gallery');
            if ($res == true) {
                try {

                    $datas = array(
                        'nama' => $_POST["nama"],
                        'gambar' => $nama_file_unik,
                    );
                    $saved = $db->insert('gallery', $datas);
                    $insertId = $db->lastId();

                    $pathToImage = 'images/gallery/' . $nama_file_unik;
                    $pathSmall = 'images/gallery/small/' . $nama_file_unik;
                    lopoCompress('gallery', $pathToImage, $tipe_file2, 1);
                    lopoCompress('gallery/small', $pathToImage, $tipe_file2, 6);

                    $image = new ImageResize($pathSmall);
                    $image->resizeToHeight(200);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    $image2->resizeToHeight(800);
                    $image2->save($pathToImage);
                    
                     // Convert to WEBP
                    $destination  = $pathToImage . '.webp';
                    $destination2 = $pathSmall . '.webp';

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathToImage, $destination, 75 );

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathSmall, $destination2, 75 );
                    $msg->success('gallery Berhasil ditambah');
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
    $edit = $db->connection("SELECT gambar FROM gallery WHERE id_gallery=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/gallery/$rr[gambar]");
    unlink("images/gallery/small/$rr[gambar]");

    $del = $db->delete("gallery", "id_gallery=$id ");
    $msg->info('Data Berhasil dihapus');
    echo "<script>window.location = '$hal'</script>";

} 
