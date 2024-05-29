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
            echo "<script>window.location(history.back(-1))</script>";
        } else {
            $edit = $db->connection("SELECT gambar FROM client WHERE id_client='$_POST[id_client]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/client/$tedit[gambar]");
            unlink("images/client/small/$tedit[gambar]");

            $res = lopoUpload($seojdul . '-' . $acak, 'client');

            if ($res == true) {
                try {
                    $datas = array(
                        'nama' => $_POST["nama"],
                        'gambar' => $nama_file_unik
                    );
                    $db->update("client", $datas, "id_client= '$_POST[id_client]' ");

                    $pathToImage = 'images/client/' . $nama_file_unik;
                    $pathSmall = 'images/client/small/' . $nama_file_unik;
                    lopoCompress('client', $pathToImage, $tipe_file2, 2);
                    lopoCompress('client/small', $pathToImage, $tipe_file2, 6);

                    $image = new ImageResize($pathSmall);
                    $image->resizeToHeight(60);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    $image2->resizeToHeight(120);
                    $image2->save($pathToImage);
                    
                    $msg->info('Data berhasil diedit');
                    echo "<script>window.location = '$hal'</script>";
                } catch (PDOException $e) {
                    $msg->error('client Gagal diedit!');
                    echo "<script> window.location = '$hal-edit-$_POST[id_client]'</script>";
                }
            } else {
                $msg->error('Something error with this image');
                echo "<script>window.location(history.back(-1))</script>";
            }
        }
    } else {
        try {

            $edit = $db->connection("SELECT gambar FROM client WHERE id_client='$_POST[id_client]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);
            $datas = array();

            $datas = array(
                'nama' => $_POST["nama"]
            );
            $db->update("client", $datas, "id_client= '$_POST[id_client]' ");
            $msg->info('Data berhasil diedit');
            echo "<script> window.location = '$hal'</script>";
        } catch (PDOException $e) {
            $msg->error('client Gagal diedit!');
            echo "<script>window.location = '$hal-edit-$_POST[id_client]'</script>";
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
            $res = lopoUpload($seojdul . '-' . $acak, 'client');
            if ($res == true) {
                try {

                    $datas = array(
                        'nama' => $_POST["nama"],
                        'gambar' => $nama_file_unik,
                    );
                    $saved = $db->insert('client', $datas);
                    $insertId = $db->lastId();

                    $pathToImage = 'images/client/' . $nama_file_unik;
                    $pathSmall = 'images/client/small/' . $nama_file_unik;
                    lopoCompress('client', $pathToImage, $tipe_file2, 2);
                    lopoCompress('client/small', $pathToImage, $tipe_file2, 6);

                    $image = new ImageResize($pathSmall);
                    $image->resizeToHeight(60);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    $image2->resizeToHeight(120);
                    $image2->save($pathToImage);
                    
                    $msg->success('Data berhasil ditambah');
                    echo "<script> window.location = '$hal'</script>";

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
    $edit = $db->connection("SELECT gambar FROM client WHERE id_client=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/client/$rr[gambar]");
    unlink("images/client/small/$rr[gambar]");

    $del = $db->delete("client", "id_client=$id ");

    echo "<script>alert('Data Berhasil dihapus'); window.location = '$hal'</script>";

} 
