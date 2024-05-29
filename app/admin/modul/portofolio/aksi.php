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
            $edit = $db->connection("SELECT gambar FROM portofolio WHERE id_portofolio='$_POST[id_portofolio]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/portofolio/$tedit[gambar]");
            unlink("images/portofolio/small/$tedit[gambar]");
            unlink("images/portofolio/$tedit[gambar].webp");
            unlink("images/portofolio/small/$tedit[gambar].webp");

            $res = lopoUpload($seojdul . '-' . $acak, 'portofolio');

            if ($res == true) {
                try {
                    $datas = array(
                        // 'judul_seo' => $nama_seo,
                        'nama' => $_POST["nama"],
                        'gambar' => $nama_file_unik,
                        'subtitle' => $_POST["subtitle"],
                        'url' => $_POST["url"],
                    );
                    $db->update("portofolio", $datas, "id_portofolio= '$_POST[id_portofolio]' ");

                    $pathToImage = 'images/portofolio/' . $nama_file_unik;
                    $pathSmall = 'images/portofolio/small/' . $nama_file_unik;
                    lopoCompress('portofolio', $pathToImage, $tipe_file2);
                    lopoCompress('portofolio/small', $pathToImage, $tipe_file2, 3);

                    $image = new ImageResize($pathSmall);
                    $image->resizeToHeight(640);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    $image2->resizeToWidth(1366);
                    $image2->save($pathToImage);
                    
                     // Convert to WEBP
                    $destination  = $pathToImage . '.webp';
                    $destination2 = $pathSmall . '.webp';

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathToImage, $destination, 75 );

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathSmall, $destination2, 75 );
                    $msg->info('portofolio successfully updated');
                    echo "<script> window.location = '$hal-edit-$_POST[id_portofolio]'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('portofolio Gagal diedit!'); window.location = '$hal-edit-$_POST[id_portofolio]'</script>";
                }
            } else {
                echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
            }
        }
    } else {
        try {

            $edit = $db->connection("SELECT gambar FROM portofolio WHERE id_portofolio='$_POST[id_portofolio]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);
            $datas = array();

            $datas = array(
                // 'judul_seo' => $nama_seo,
                'nama' => $_POST["nama"],
                'subtitle' => $_POST["subtitle"],
                'url' => $_POST["url"],
            );
            $db->update("portofolio", $datas, "id_portofolio= '$_POST[id_portofolio]' ");
            $msg->info('portofolio successfully updated');
            echo "<script>window.location = '$hal-edit-$_POST[id_portofolio]'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('portofolio Gagal diedit!'); window.location = '$hal-edit-$_POST[id_portofolio]'</script>";
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
            $res = lopoUpload($seojdul . '-' . $acak, 'portofolio');
            if ($res == true) {
                try {

                    $datas = array(
                        // 'judul_seo' => $nama_seo,
                        'nama' => $_POST["nama"],
                        'gambar' => $nama_file_unik,
                        'subtitle' => $_POST["subtitle"],
                        'url' => $_POST["url"],
                    );
                    $saved = $db->insert('portofolio', $datas);
                    $insertId = $db->lastId();

                    $pathToImage = 'images/portofolio/' . $nama_file_unik;
                    $pathSmall = 'images/portofolio/small/' . $nama_file_unik;
                    lopoCompress('portofolio', $pathToImage, $tipe_file2, 1);
                    lopoCompress('portofolio/small', $pathToImage, $tipe_file2, 3);

                    $image = new ImageResize($pathSmall);
                    $image->resizeToHeight(640);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    $image2->resizeToWidth(1366);
                    $image2->save($pathToImage);
                    
                     // Convert to WEBP
                    $destination  = $pathToImage . '.webp';
                    $destination2 = $pathSmall . '.webp';

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathToImage, $destination, 75 );

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathSmall, $destination2, 75 );
                    $msg->success('portofolio berhasil ditambah');
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
    $edit = $db->connection("SELECT gambar FROM portofolio WHERE id_portofolio=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/portofolio/$rr[gambar]");
    unlink("images/portofolio/small/$rr[gambar]");

    $del = $db->delete("portofolio", "id_portofolio=$id ");

    echo "<script>alert('Data Berhasil dihapus'); window.location = '$hal'</script>";

}