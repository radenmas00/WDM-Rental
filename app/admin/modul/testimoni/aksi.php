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
            $edit = $db->connection("SELECT gambar FROM testimoni WHERE id_testimoni='$_POST[id_testimoni]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/testimoni/$tedit[gambar]");
            unlink("images/testimoni/small/$tedit[gambar]");

            $res = lopoUpload($seojdul . '-' . $acak, 'testimoni');

            if ($res == true) {
                try {
                    $datas = array(
                        'nama' => $_POST["nama"],
                        'asal' => $_POST["asal"],
                        'deskripsi' => $_POST["deskripsi"],
                        'gambar' => $nama_file_unik
                    );
                    $db->update("testimoni", $datas, "id_testimoni= '$_POST[id_testimoni]' ");

                    $pathToImage = 'images/testimoni/' . $nama_file_unik;
                    $pathSmall = 'images/testimoni/small/' . $nama_file_unik;
                    lopoCompress('testimoni', $pathToImage, $tipe_file2, 1);
                    lopoCompress('testimoni/small', $pathToImage, $tipe_file2, 6);

                    $image = new ImageResize($pathSmall);
                    $image->resizeToWidth(200);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    $image2->save($pathToImage);
                    
                    $destination  = $pathToImage . '.webp';
                    $destination2 = $pathSmall . '.webp';

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathToImage, $destination, 75 );

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathSmall, $destination2, 75 );
                    
                    $msg->info("Testimoni berhasil diedit");
                    echo "<script>window.location = '$hal'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('testimoni Gagal diedit!'); window.location = '$hal-edit-$_POST[id_testimoni]'</script>";
                }
            } else {
                echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
            }
        }
    } else {
        try {

            $edit = $db->connection("SELECT gambar FROM testimoni WHERE id_testimoni='$_POST[id_testimoni]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);
            $datas = array();

            $datas = array(
                'nama' => $_POST["nama"],
                'asal' => $_POST["asal"],
                'deskripsi' => $_POST["deskripsi"],
            );
            
            $db->update("testimoni", $datas, "id_testimoni= '$_POST[id_testimoni]' ");
            $msg->info("Testimoni berhasil diedit");
            echo "<script>window.location = '$hal'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('testimoni Gagal diedit!'); window.location = '$hal-edit-$_POST[id_testimoni]'</script>";
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
            $res = lopoUpload($seojdul . '-' . $acak, 'testimoni');
            if ($res == true) {
                try {

                    $datas = array(
                        'nama' => $_POST["nama"],
                        'asal' => $_POST["asal"],
                        'deskripsi' => $_POST["deskripsi"],
                        'gambar' => $nama_file_unik,
                    );
                    $saved = $db->insert('testimoni', $datas);
                    $insertId = $db->lastId();

                    $pathToImage = 'images/testimoni/' . $nama_file_unik;
                    $pathSmall = 'images/testimoni/small/' . $nama_file_unik;
                    lopoCompress('testimoni', $pathToImage, $tipe_file2, 1);
                    lopoCompress('testimoni/small', $pathToImage, $tipe_file2, 6);

                    $image = new ImageResize($pathSmall);
                    $image->resizeToWidth(200);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    $image2->save($pathToImage);
                    
                    $destination  = $pathToImage . '.webp';
                    $destination2 = $pathSmall . '.webp';

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathToImage, $destination, 75 );

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathSmall, $destination2, 75 );
                    
                    $msg->success("Testimoni berhasil ditambah ");
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
    $edit = $db->connection("SELECT gambar FROM testimoni WHERE id_testimoni=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/testimoni/$rr[gambar]");
    unlink("images/testimoni/small/$rr[gambar]");

    $del = $db->delete("testimoni", "id_testimoni=$id ");

    echo "<script>alert('Data Berhasil dihapus'); window.location = '$hal'</script>";

} 