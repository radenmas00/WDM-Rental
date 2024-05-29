<?php
use \Gumlet\ImageResize;
// $mimes = new \Mimey\MimeTypes;

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
            $edit = $db->connection("SELECT gambar FROM sizechart WHERE id_sizechart='$_POST[id_sizechart]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/sizechart/$tedit[gambar]");
            unlink("images/sizechart/small/$tedit[gambar]");

            $res = lopoUpload($seojdul . '-' . $acak, 'sizechart');

            if ($res == true) {
                try {
                    $datas = array(
                        'nama' => $_POST["nama"],
                        'gambar' => $nama_file_unik,
                        'deskripsi' => $_POST["deskripsi"],
                        'judul_seo' => $nama_seo,
                    );
                    $db->update("sizechart", $datas, "id_sizechart= '$_POST[id_sizechart]' ");

                    $pathToImage = 'images/sizechart/' . $nama_file_unik;
                    $pathSmall = 'images/sizechart/small/' . $nama_file_unik;
                    lopoCompress('sizechart', $pathToImage, $tipe_file2);
                    lopoCompress('sizechart/small', $pathToImage, $tipe_file2, 3);

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
                    $msg->info('sizechart successfully updated');
                    echo "<script> window.location = '$hal-edit-$_POST[id_sizechart]'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('sizechart Gagal diedit!'); window.location = '$hal-edit-$_POST[id_sizechart]'</script>";
                }
            } else {
                echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
            }
        }
    } else {
        try {

            $edit = $db->connection("SELECT gambar FROM sizechart WHERE id_sizechart='$_POST[id_sizechart]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);
            $datas = array();

            $datas = array(
                'nama' => $_POST["nama"],
                'judul_seo' => $nama_seo,
                'deskripsi' => $_POST["deskripsi"],
            );
            $db->update("sizechart", $datas, "id_sizechart= '$_POST[id_sizechart]' ");
            $msg->info('sizechart successfully updated');
            echo "<script>window.location = '$hal-edit-$_POST[id_sizechart]'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('sizechart Gagal diedit!'); window.location = '$hal-edit-$_POST[id_sizechart]'</script>";
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
            $res = lopoUpload($seojdul . '-' . $acak, 'sizechart');
            if ($res == true) {
                try {

                    $datas = array(
                        'nama' => $_POST["nama"],
                        'gambar' => $nama_file_unik,
                        'judul_seo' => $nama_seo,
                        'deskripsi' => $_POST["deskripsi"],
                    );
                    $saved = $db->insert('sizechart', $datas);
                    $insertId = $db->lastId();

                    $pathToImage = 'images/sizechart/' . $nama_file_unik;
                    $pathSmall = 'images/sizechart/small/' . $nama_file_unik;
                    lopoCompress('sizechart', $pathToImage, $tipe_file2, 1);
                    lopoCompress('sizechart/small', $pathToImage, $tipe_file2, 3);

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
                    $msg->success('sizechart berhasil ditambah');
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
    $edit = $db->connection("SELECT gambar FROM sizechart WHERE id_sizechart=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/sizechart/$rr[gambar]");
    unlink("images/sizechart/small/$rr[gambar]");

    $del = $db->delete("sizechart", "id_sizechart=$id ");

    echo "<script>alert('Data Berhasil dihapus'); window.location(history.back(-1))</script>";

}elseif ($act == 'addService') {
    $lokasi_file = $_FILES['lopoFile']['tmp_name'];
    $judul_file = $_FILES['lopoFile']['name'];
    $tipe_file = $_FILES['lopoFile']['type'];
    $ukuran = $_FILES['lopoFile']['size'];
    $tipe_file2 = seo2($tipe_file);
    $seojdul = seo($_POST["judul"]);
    $acak = rand(00, 99);
    $tipe = seo2($_FILES['gambar_mobile']['type']);
    $nama_file_unik = $seojdul . "-" . $acak . "." . $tipe_file2;
    $nama_file_unik2 = $seojdul  . "." . $tipe;
    $nama_seo = seo($_POST["judul"]);
    date_default_timezone_set('Asia/Jakarta');

    if (empty($judul_file)) {
        echo "<script>window.alert('Gambar Tidak Boleh Kosong!'); window.location(history.back(-1))</script>";
    } else {
        if (($ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)) {
            echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
        } else {
            $res = lopoUpload($seojdul . '-' . $acak, 'sizechart_sub');
            $res2 = uploadGambar($seojdul, 'slider', "gambar_mobile");
            if ($res == true) {
                try {

                    $datas = array(
                        'judul' => $_POST["judul"],
                        'judul_seo' => $nama_seo,
                        'gambar' => $nama_file_unik,
                        'deskripsi' => $_POST["deskripsi"],
                        'id_sizechart' => $_POST["id_sizechart"],
                    );
                    $saved = $db->insert('sizechart_sub', $datas);
                    $insertId = $db->lastId();

                    $pathToImage = 'images/sizechart_sub/' . $nama_file_unik;
                    $pathSmall = 'images/sizechart_sub/small/' . $nama_file_unik;
                    lopoCompress('sizechart_sub', $pathToImage, $tipe_file2, 1);
                    lopoCompress('sizechart_sub/small', $pathToImage, $tipe_file2, 3);

                    $image = new ImageResize($pathSmall);
                    $image->resize(75, 75);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    $image2->save($pathToImage);
                    
                     // Convert to WEBP
                    $destination  = $pathToImage . '.webp';
                    $destination2 = $pathSmall . '.webp';

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathToImage, $destination, 75 );

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathSmall, $destination2, 75 );

                    echo "<script>alert('Data Berhasil ditambah'); window.location = 'sizechart-edit-$_POST[id_sizechart]'</script>";

                } catch (PDOException $e) {
                    echo "$e";
                }
            } else {
                echo "<script>alert('Format Gambar Salah !'); window.location(history.back(-1))</script>";
            }
        }
    }
}

// Update modul
if ($act == 'updateService') {
    $jdl2 = substr($_POST["judul"], 0, 100);

    $lokasi_file = $_FILES['lopoFile']['tmp_name'];
    $judul_file = $_FILES['lopoFile']['name'];
    $tipe_file = $_FILES['lopoFile']['type'];
    $ukuran = $_FILES['lopoFile']['size'];
    $tipe_file2 = seo2($tipe_file);
    $tipe = seo2($_FILES['gambar_mobile']['type']);
    $seojdul = seo($jdl2);
    $acak = rand(00, 99);
    $nama_file_unik = $seojdul . "-" . $acak . "." . $tipe_file2;
    $nama_file_unik = $seojdul . "-" . $acak . "." . $tipe_file2;
    $nama_file_unik2 = $seojdul  . "." . $tipe;
    $nama_seo = seo($_POST["judul"]);

    if (!empty($lokasi_file)) {
        if (($ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)) {
            echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
        } else {
            $edit = $db->connection("SELECT gambar FROM sizechart_sub WHERE id_sizechart_sub='$_POST[id_sizechart_sub]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/sizechart_sub/$tedit[gambar]");
            unlink("images/sizechart_sub/small/$tedit[gambar]");

            $res = lopoUpload($seojdul . '-' . $acak, 'sizechart_sub');

            if ($res == true) {
                try {
                    $datas = array(
                        'judul' => $_POST["judul"],
                        'judul_seo' => $nama_seo,
                        'gambar' => $nama_file_unik,
                        'deskripsi' => $_POST["deskripsi"],
                        'id_sizechart' => $_POST["id_sizechart"],

                    );
                    $db->update("sizechart_sub", $datas, "id_sizechart_sub= '$_POST[id_sizechart_sub]' ");

                    $pathToImage = 'images/sizechart_sub/' . $nama_file_unik;
                    $pathSmall = 'images/sizechart_sub/small/' . $nama_file_unik;
                    lopoCompress('sizechart_sub', $pathToImage, $tipe_file2);
                    lopoCompress('sizechart_sub/small', $pathToImage, $tipe_file2, 3);

                    $image = new ImageResize($pathSmall);
                    $image->resize(75, 75);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    
                    $image2->save($pathToImage);
                    
                     // Convert to WEBP
                    $destination  = $pathToImage . '.webp';
                    $destination2 = $pathSmall . '.webp';

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathToImage, $destination, 75 );

                    $jw = new ImageToWebp(); 
                    $jw->convert( $pathSmall, $destination2, 75 );

                    echo "<script>alert('Data Berhasil diedit'); window.location = '$hal-edit-$_POST[id_sizechart]'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('Data Gagal diedit!'); window.location = '$hal-edit-$_POST[id_sizechart]'</script>";
                }
            } else {
                echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
            }
        }
    } else {
        try {

            $edit = $db->connection("SELECT gambar FROM sizechart_sub WHERE id_sizechart_sub='$_POST[id_sizechart_sub]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);
            $datas = array();

            $datas = array(
                'judul' => $_POST["judul"],
                'judul_seo' => $nama_seo,
                // 'gambar' => $nama_file_unik,
                'deskripsi' => $_POST["deskripsi"],
                'id_sizechart' => $_POST["id_sizechart"],

                // 'judul' => $_POST["judul"],
                // 'judul_seo' => $nama_seo,
                // 'deskripsi' => $_POST["deskripsi"],
                // 'id_sizechart' => $_POST["id_sizechart"],
                // 'harga' => $_POST["harga"],
                // 'url' => $_POST["url"],

            );
            $db->update("sizechart_sub", $datas, "id_sizechart_sub= '$_POST[id_sizechart_sub]' ");

            echo "<script>alert('Data Berhasil diedit'); window.location = 'sizechart-edit-$_POST[id_sizechart]'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Data Gagal diedit!'); window.location = 'sizechart-edit-$_POST[id_sizechart]'</script>";
        }
    }

}

// remove modul
elseif ($act == 'removeService') {
    $edit = $db->connection("SELECT gambar FROM sizechart_sub WHERE id_sizechart_sub=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/sizechart_sub/$rr[gambar]");
    unlink("images/sizechart_sub/small/$rr[gambar]");

    $del = $db->delete("sizechart_sub", "id_sizechart_sub=$id ");

    echo "<script>alert('Data Berhasil dihapus'); window.location(history.back(-1))</script>";
}
