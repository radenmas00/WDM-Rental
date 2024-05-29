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

    $tgl_post = convertDate('/', $_POST['tgl_posting']);
    $tgl_batas = convertDate('/', $_POST['tgl_batas']);

    if (!empty($lokasi_file)) {
        if (($ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)) {
            echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
        } else {
            $edit = $db->connection("SELECT gambar FROM process WHERE id_process='$_POST[id_process]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/process/$tedit[gambar]");
            unlink("images/process/small/$tedit[gambar]");
            unlink("images/process/$tedit[gambar].webp");
            unlink("images/process/small/$tedit[gambar].webp");

            $res = lopoUpload($seojdul . '-' . $acak, 'process');

            if ($res == true) { 
                try {
                    $datas = array(
                        'judul_seo' => $nama_seo,
                        'judul' => $_POST["nama"],
                        'id_process_kat' => $_POST["id_process_kat"],
                        'url' => $_POST["url"],
                        'gambar' => $nama_file_unik,
                        'tgl_posting' => $tgl_post,
                        'tgl_batas' => $tgl_batas,
                        'berkas' => $_POST["berkas"],
                        'deskripsi' => $_POST["deskripsi"],
                    );
                    $db->update("process", $datas, "id_process= '$_POST[id_process]' ");

                    $pathToImage = 'images/process/' . $nama_file_unik;
                    $pathSmall = 'images/process/small/' . $nama_file_unik;
                    lopoCompress('process', $pathToImage, $tipe_file2);
                    lopoCompress('process/small', $pathToImage, $tipe_file2, 3);

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
                    $msg->info('Data successfully updated');
                    echo "<script> window.location = '$hal-edit-$_POST[id_process]'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('process Gagal diedit!'); window.location = '$hal-edit-$_POST[id_process]'</script>";
                }
            } else {
                echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
            }
        }
    } else {
        try {

            $edit = $db->connection("SELECT gambar FROM process WHERE id_process='$_POST[id_process]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);
            $datas = array();

            $datas = array(
                'judul_seo' => $nama_seo,
                'judul' => $_POST["nama"],
                'id_process_kat' => $_POST["id_process_kat"],
                'deskripsi' => $_POST["deskripsi"],
            );
            $db->update("process", $datas, "id_process= '$_POST[id_process]' ");
            $msg->info('process successfully updated');
            echo "<script>window.location = '$hal-edit-$_POST[id_process]'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('process Gagal diedit!'); window.location = '$hal-edit-$_POST[id_process]'</script>";
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

    $tgl_post = convertDate('/', $_POST['tgl_posting']);
    $tgl_batas = convertDate('/', $_POST['tgl_batas']);



    if (empty($nama_file)) {
        echo "<script>window.alert('Gambar Tidak Boleh Kosong!'); window.location(history.back(-1))</script>";
    } else {
        if (($ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)) {
            echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
        } else {
            $res = lopoUpload($seojdul . '-' . $acak, 'process');
            if ($res == true) {
                try {

                    $datas = array(
                        'judul_seo' => $nama_seo,
                        'judul' => $_POST["nama"],
                        'gambar' => $nama_file_unik,
                        'tgl_posting' => $tgl_post,
                        'tgl_batas' => $tgl_batas,
                        'id_process_kat' => $_POST["id_process_kat"],
                        'url' => $_POST["url"],
                        'berkas' => $_POST["berkas"],
                        'deskripsi' => $_POST["deskripsi"],
                    );
                    $saved = $db->insert('process', $datas);
                    $insertId = $db->lastId();

                    $pathToImage = 'images/process/' . $nama_file_unik;
                    $pathSmall = 'images/process/small/' . $nama_file_unik;
                    lopoCompress('process', $pathToImage, $tipe_file2, 1);
                    lopoCompress('process/small', $pathToImage, $tipe_file2, 3);

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
                    $msg->success('Data berhasil ditambah');
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
    $edit = $db->connection("SELECT gambar FROM process WHERE id_process=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/process/$rr[gambar]");
    unlink("images/process/small/$rr[gambar]");
    unlink("images/process/$rr[gambar].webp");
    unlink("images/process/small/$rr[gambar].webp");

    $del = $db->delete("process", "id_process=$id ");

    echo "<script>alert('Data Berhasil dihapus'); window.location = '$hal'</script>";

}elseif($act=='addgallery'){
    $edit = $db->connection("SELECT judul FROM process_kat WHERE id_process_kat='$_POST[ids]'");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    
    $lokasi_file 	= $_FILES['nyanpload']['tmp_name'];
    $nama_file   	= $_FILES['nyanpload']['name'];
    $tipe_file   	= $_FILES['nyanpload']['type'];
    $tipe_file2   	= seo2($tipe_file); 
    $seojdul        = seo($tedit["judul"]);
    $acak           = rand(00,99);
    $nama_file_unik = $seojdul.$acak.".".$tipe_file2;
    $idku = $_POST['ids'];
    if (empty($lokasi_file)){
        echo "<script>window.alert('Ukuran Gambar Terlalu Besar !');
        window.location(history.back(-1))</script>";
    }else{
        try{
            UploadNyan($nama_file_unik,'gallery_process_kat');
            
            $datas = array(
                'id_process_kat' => $idku,
                'gambar'    => $nama_file_unik,
                'judul'     => $_POST['judul']
            );
            $db->insert('gallery_process_kat', $datas);

            unlink("images/gallery_process_kat/$nama_file_unik");
            
            echo "<script>alert('Gambar berhasil dimasukan!'); window.location = 'maintraining-edit-$idku'</script>";
        }catch(PDOException $e){
                echo "$e";
            }
    }
}

elseif($act=='editgallery'){
    $edit = $db->connection("SELECT judul FROM process_kat WHERE id_process_kat='$_POST[idm]'");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    $idku = $_POST['idm'];

    $lokasi_file 	= $_FILES['nyanpload']['tmp_name'];
    $nama_file   	= $_FILES['nyanpload']['name'];
    $tipe_file   	= $_FILES['nyanpload']['type'];
    $tipe_file2   	= seo2($tipe_file);
    $seojdul        = seo($tedit["judul"]);
    $acak           = rand(00,99);
    $nama_file_unik = $seojdul.$acak.".".$tipe_file2;

    if (empty($lokasi_file)){
        $datas = array(
            'id_process_kat' => $idku,
            'judul'     => $_POST['judul']
        );
        $db->update('gallery_process_kat', $datas, " id_gallery = '$_POST[id]' ");
        echo "<script>alert('Data gambar berhasil diedit!'); window.location = 'maintraining-edit-$_POST[idm]#sliderkategori'</script>";
    }else{

        UploadNyan($nama_file_unik,'gallery_process_kat');

        $edit = $db->connection("SELECT gambar FROM gallery_process_kat WHERE id_gallery ='$_POST[id]'");
        $tedit = $edit->fetch(PDO::FETCH_ASSOC);

        unlink("images/gallery_process_kat/$imgname1-$tedit[gambar]");
        unlink("images/gallery_process_kat/small/$imgname1-$tedit[gambar]");

        $datas = array(
                'id_process_kat' => $idku,
                'gambar'    => $nama_file_unik,
                'judul'     => $_POST['judul']
            );
            $db->update('gallery_process_kat', $datas, " id_gallery = '$_POST[id]' ");

        unlink("images/gallery_process_kat/$nama_file_unik");

        echo "<script>alert('Data gambar berhasil diedit!'); window.location = 'maintraining-edit-$_POST[idm]#sliderkategori'</script>";
    }
}

elseif($act=='removegallery'){
    $edit = $db->connection("SELECT id_gallery, gambar FROM gallery_process_kat WHERE id_gallery=$id ");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/gallery_process_kat/$imgname1-$tedit[gambar]");
    unlink("images/gallery_process_kat/small/$imgname1-$tedit[gambar]");
    $id = $tedit['id_gallery'];

    $del = $db->connection("DELETE FROM gallery_process_kat WHERE id_gallery =$id ");
    $del->execute();

    echo "<script>alert('Gambar berhasil dihapus!'); window.location(history.back(-1))</script>";

    // header('location:maintraining-edit-'.$id_process_kat.'#sliderpartner');
}// add modul
elseif ($act == 'addTraining') {
    // $lokasi_file = $_FILES['lopoFile']['tmp_name'];
    // $judul_file = $_FILES['lopoFile']['name'];
    // $tipe_file = $_FILES['lopoFile']['type'];
    // $ukuran = $_FILES['lopoFile']['size'];
    // $tipe_file2 = seo2($tipe_file);
    // $seojdul = seo($_POST["judul"]);
    // $acak = rand(00, 99);
    // $tipe = seo2($_FILES['gambar_mobile']['type']);
    // $nama_file_unik = $seojdul . "-" . $acak . "." . $tipe_file2;
    // $nama_file_unik2 = $seojdul  . "." . $tipe;
    $nama_seo = seo($_POST["judul"]);
    date_default_timezone_set('Asia/Jakarta');

    // if (empty($judul_file)) {
    //     echo "<script>window.alert('Gambar Tidak Boleh Kosong!'); window.location(history.back(-1))</script>";
    // } else {
    //     if (($ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)) {
    //         echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
    //     } else {
    //         $res = lopoUpload($seojdul . '-' . $acak, 'produk_varian');
            // $res2 = uploadGambar($seojdul, 'slider', "gambar_mobile");
            // if ($res == true) {
                try {

                    $datas = array(
                        'judul' => $_POST["judul"],
                        'judul_seo' => $nama_seo,
                        // 'gambar' => $nama_file_unik,
                        'deskripsi' => $_POST["deskripsi"],
                        'id_process' => $_POST["id_process"],
                        'id_process_kat' => $_POST["id_process_kat"],
                    );
                    $saved = $db->insert('process_sub', $datas);
                    $insertId = $db->lastId();

                    // $pathToImage = 'images/produk_varian/' . $nama_file_unik;
                    // $pathSmall = 'images/produk_varian/small/' . $nama_file_unik;
                    // lopoCompress('produk_varian', $pathToImage, $tipe_file2, 1);
                    // lopoCompress('produk_varian/small', $pathToImage, $tipe_file2, 3);

                    // $image = new ImageResize($pathSmall);
                    // $image->resize(75, 75);
                    // $image->save($pathSmall);

                    // $image2 = new ImageResize($pathToImage);
                    // $image2->save($pathToImage);

                    echo "<script>alert('Data Berhasil ditambah'); window.location = 'maintraining-edit-$_POST[id_process_kat]'</script>";

                } catch (PDOException $e) {
                    echo "$e";
                }
    //         } else {
    //             echo "<script>alert('Format Gambar Salah !'); window.location = '$hal'</script>";
    //         }
    //     }
    // }
}

// Update modul
if ($act == 'updateTraining') {
    // $jdl2 = substr($_POST["judul"], 0, 100);

    // $lokasi_file = $_FILES['lopoFile']['tmp_name'];
    // $judul_file = $_FILES['lopoFile']['name'];
    // $tipe_file = $_FILES['lopoFile']['type'];
    // $ukuran = $_FILES['lopoFile']['size'];
    // $tipe_file2 = seo2($tipe_file);
    // $tipe = seo2($_FILES['gambar_mobile']['type']);
    // $seojdul = seo($jdl2);
    // $acak = rand(00, 99);
    // $nama_file_unik = $seojdul . "-" . $acak . "." . $tipe_file2;
    // $nama_file_unik = $seojdul . "-" . $acak . "." . $tipe_file2;
    // $nama_file_unik2 = $seojdul  . "." . $tipe;
    $nama_seo = seo($_POST["judul"]);

    // if (!empty($lokasi_file)) {
    //     if (($ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)) {
    //         echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
    //     } else {
    //         $edit = $db->connection("SELECT gambar FROM produk_varian WHERE id_produk_varian='$_POST[id_produk_varian]'");
    //         $tedit = $edit->fetch(PDO::FETCH_ASSOC);

    //         unlink("images/produk_varian/$tedit[gambar]");
    //         unlink("images/produk_varian/small/$tedit[gambar]");

    //         $res = lopoUpload($seojdul . '-' . $acak, 'produk_varian');

    //         if ($res == true) {
                try {
                    $datas = array(
                        'judul' => $_POST["judul"],
                        'judul_seo' => $nama_seo,
                        // 'gambar' => $nama_file_unik,
                        'deskripsi' => $_POST["deskripsi"],
                        'id_process' => $_POST["id_process"],
                        'id_process_kat' => $_POST["id_process_kat"],

                    );
                    $db->update("process_sub", $datas, "id_process_sub= '$_POST[id_process_sub]' ");

                    // $pathToImage = 'images/produk_varian/' . $nama_file_unik;
                    // $pathSmall = 'images/produk_varian/small/' . $nama_file_unik;
                    // lopoCompress('produk_varian', $pathToImage, $tipe_file2);
                    // lopoCompress('produk_varian/small', $pathToImage, $tipe_file2, 3);

                    // $image = new ImageResize($pathSmall);
                    // $image->resize(75, 75);
                    // $image->save($pathSmall);

                    // $image2 = new ImageResize($pathToImage);
                    
                    // $image2->save($pathToImage);

                    echo "<script>alert('Data Berhasil diedit'); window.location = 'maintraining-edit-$_POST[id_process_kat]'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('Data Gagal diedit!'); window.location = 'maintraining-edit-$_POST[id_process_kat]'</script>";
                }
    //         } else {
    //             echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
    //         }
    //     }
    // } else {
    //     try {

    //         $edit = $db->connection("SELECT gambar FROM produk_varian WHERE id_produk_varian='$_POST[id_produk_varian]'");
    //         $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    //         $datas = array();

    //         $datas = array(
    //             'judul' => $_POST["judul"],
    //             'judul_seo' => $nama_seo,
    //             'deskripsi' => $_POST["deskripsi"],
    //             'id_kategori' => $_POST["id_kategori"],
    //             'harga' => $_POST["harga"],
    //             'url' => $_POST["url"],

    //         );
    //         $db->update("produk_varian", $datas, "id_produk_varian= '$_POST[id_produk_varian]' ");

    //         echo "<script>alert('Data Berhasil diedit'); window.location = 'kategori-edit-$_POST[id_kategori]'</script>";
    //     } catch (PDOException $e) {
    //         echo "<script>alert('Data Gagal diedit!'); window.location = 'kategori-edit-$_POST[id_kategori]'</script>";
    //     }
    // }

}

// remove modul
elseif ($act == 'removeTraining') {
    // $edit = $db->connection("SELECT gambar FROM produk_varian WHERE id_produk_varian=$id ");
    // $rr = $edit->fetch(PDO::FETCH_ASSOC);
    // unlink("images/produk_varian/$rr[gambar]");
    // unlink("images/produk_varian/small/$rr[gambar]");

    $del = $db->delete("process_sub", "id_process_sub=$id ");

    echo "<script>alert('Data Berhasil dihapus'); window.location(history.back(-1))</script>";
}
elseif ($act == 'addMainTraining') {
    
    $lokasi_file = $_FILES['lopoFile']['tmp_name'];
    $judul_file = $_FILES['lopoFile']['name'];
    $tipe_file = $_FILES['lopoFile']['type'];
    $ukuran = $_FILES['lopoFile']['size'];
    $tipe_file2 = seo2($tipe_file);
    $seojdul = seo($_POST["judul"]);
    $acak = rand(00, 99);
    // $tipe = seo2($_FILES['gambar_mobile']['type']);
    $nama_file_unik = $seojdul . "-" . $acak . "." . $tipe_file2;
    // $nama_file_unik2 = $seojdul  . "." . $tipe;
    $nama_seo = seo($_POST["judul"]);
    date_default_timezone_set('Asia/Jakarta');

    if (empty($judul_file)) {
        echo "<script>window.alert('Gambar Tidak Boleh Kosong!'); window.location(history.back(-1))</script>";
    } else {
        if (($ukuran == 0) or ($ukuran == 02) or ($ukuran > 2060817)) {
            echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
        } else {
            $res = lopoUpload($seojdul . '-' . $acak, 'process_kat');
            // $res2 = uploadGambar($seojdul, 'slider', "gambar_mobile");
            if ($res == true) {
                try {

                    $datas = array(
                        'judul' => $_POST["judul"],
                        'judul_seo' => $nama_seo,
                        'gambar' => $nama_file_unik,
                        'singkat' => $_POST["singkat"],
                        'fasilitas_pelatihan' => $_POST["fasilitas_pelatihan"],
                        'syarat_training' => $_POST["syarat_training"],
                        'jadwal' => $_POST["jadwal"],
                        'fasilitas_alumni' => $_POST["fasilitas_alumni"],
                        'tatacara' => $_POST["tatacara"],
                        'id_process' => $_POST["id_process"],
                    );
                    $saved = $db->insert('process_kat', $datas);
                    $insertId = $db->lastId();

                    $pathToImage = 'images/process_kat/' . $nama_file_unik;
                    $pathSmall = 'images/process_kat/small/' . $nama_file_unik;
                    lopoCompress('process_kat', $pathToImage, $tipe_file2, 1);
                    lopoCompress('process_kat/small', $pathToImage, $tipe_file2, 3);

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
                    

                    echo "<script>alert('Data Berhasil ditambah'); window.location = 'maintraining-edit-$insertId'</script>";

                } catch (PDOException $e) {
                    echo "$e";
                }
            } else {
                echo "<script>alert('Format Gambar Salah !'); window.location = '$hal'</script>";
            }
        }
    }
}

// Update modul
if ($act == 'updateMainTraining') {
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
            $edit = $db->connection("SELECT gambar FROM process_kat WHERE id_process_kat='$_POST[id_process_kat]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/process_kat/$tedit[gambar]");
            unlink("images/process_kat/small/$tedit[gambar]");
            unlink("images/process_kat/$tedit[gambar].webp");
            unlink("images/process_kat/small/$tedit[gambar].webp");

            $res = lopoUpload($seojdul . '-' . $acak, 'process_kat');

            if ($res == true) {
                try {
                    $datas = array(
                        'judul' => $_POST["judul"],
                        'judul_seo' => $nama_seo,
                        'gambar' => $nama_file_unik,
                        'singkat' => $_POST["singkat"],
                        'fasilitas_pelatihan' => $_POST["fasilitas_pelatihan"],
                        'syarat_training' => $_POST["syarat_training"],
                        'jadwal' => $_POST["jadwal"],
                        'fasilitas_alumni' => $_POST["fasilitas_alumni"],
                        'tatacara' => $_POST["tatacara"],
                        'id_process' => $_POST["id_process"],

                    );
                    $db->update("process_kat", $datas, "id_process_kat= '$_POST[id_process_kat]' ");

                    $pathToImage = 'images/process_kat/' . $nama_file_unik;
                    $pathSmall = 'images/process_kat/small/' . $nama_file_unik;
                    lopoCompress('process_kat', $pathToImage, $tipe_file2);
                    lopoCompress('process_kat/small', $pathToImage, $tipe_file2, 3);

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

                    echo "<script>alert('Data Berhasil diedit'); window.location = 'maintraining-edit-$_POST[id_process_kat]'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('Data Gagal diedit!'); window.location = 'maintraining-edit-$_POST[id_process_kat]'</script>";
                }
            } else {
                echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
            }
        }
    } else {
        try {

            $edit = $db->connection("SELECT gambar FROM process_kat WHERE id_process_kat='$_POST[id_process_kat]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);
            $datas = array();

            $datas = array(
                'judul' => $_POST["judul"],
                'judul_seo' => $nama_seo,
                // 'gambar' => $nama_file_unik,
                'singkat' => $_POST["singkat"],
                'fasilitas_pelatihan' => $_POST["fasilitas_pelatihan"],
                'syarat_training' => $_POST["syarat_training"],
                'jadwal' => $_POST["jadwal"],
                'fasilitas_alumni' => $_POST["fasilitas_alumni"],
                'tatacara' => $_POST["tatacara"],
                'id_process' => $_POST["id_process"],

            );
            $db->update("process_kat", $datas, "id_process_kat= '$_POST[id_process_kat]' ");

            echo "<script>alert('Data Berhasil diedit'); window.location = 'maintraining-edit-$_POST[id_process_kat]'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Data Gagal diedit!'); window.location = 'maintraining-edit-$_POST[id_process]'</script>";
        }
    }

}

// remove modul
elseif ($act == 'removeMainTraining') {
    $edit = $db->connection("SELECT gambar FROM process_kat WHERE id_process_kat=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/process_kat/$rr[gambar]");
    unlink("images/process_kat/small/$rr[gambar]");

    $del = $db->delete("process_kat", "id_process_kat=$id ");

    echo "<script>alert('Data Berhasil dihapus'); window.location(history.back(-1))</script>";
}
