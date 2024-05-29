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
            $edit = $db->connection("SELECT gambar FROM packages WHERE id_packages= $_POST[id_packages] ");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/packages/$tedit[gambar]");
            unlink("images/packages/small/$tedit[gambar]");

            $res = lopoUpload($seojdul . '-' . $acak, 'packages');

            if ($res == true) {
                try {
                    $datas = array(
                        'judul' => $_POST["nama"],
                        'id_produk_kategori' => $_POST["id_produk_kategori"],
                        'gambar' => $nama_file_unik,
                        'travel_plan' => $_POST["travel_plan"],
                        'vacation_type' => $_POST["vacation_type"],
                        'lama' => $_POST["lama"],
                        'urutan' => $_POST['urutan'],
                        'deskripsi' => $_POST["deskripsi"],
                        'about' => $_POST["about"],
                        'keyword' => $_POST['keyword'],
                        'description' => $_POST['description'],
                    );
                    $db->update("packages", $datas, "id_packages= '$_POST[id_packages]' ");

                    $pathToImage = 'images/packages/' . $nama_file_unik;
                    $pathSmall = 'images/packages/small/' . $nama_file_unik;
                    lopoCompress('packages', $pathToImage, $tipe_file2);
                    lopoCompress('packages/small', $pathToImage, $tipe_file2, 3);

                    $image = new ImageResize($pathSmall);
                    $image->resize(150, 150);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    
                    $image2->save($pathToImage);

                    $msg->info('Data berhasil diubah');
                    echo "<script> window.location = '$hal-edit-$_POST[id_packages]'</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('packages Gagal diedit!'); window.location = '$hal-edit-$_POST[id_packages]'</script>";
                }
            } else {
                echo "<script>alert('Something error with this image'); window.location(history.back(-1))</script>";
            }
        }
    } else {
        try {

            $edit = $db->connection("SELECT gambar FROM packages WHERE id_packages='$_POST[id_packages]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);
            $datas = array();

            $datas = array(
                'judul' => $_POST["nama"],
                'id_produk_kategori' => $_POST["id_produk_kategori"],
                'travel_plan' => $_POST["travel_plan"],
                'vacation_type' => $_POST["vacation_type"],
                'lama' => $_POST["lama"],
                'urutan' => $_POST['urutan'],
                'deskripsi' => $_POST["deskripsi"],
                'keyword' => $_POST['keyword'],
                'description' => $_POST['description'],
                'about' => $_POST["about"],
            );
            $db->update("packages", $datas, "id_packages= '$_POST[id_packages]' ");
            $msg->info('Data berhasil diubah');
            echo "<script>window.location = '$hal-edit-$_POST[id_packages]'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('packages Gagal diedit!'); window.location = '$hal-edit-$_POST[id_packages]'</script>";
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
            $res = lopoUpload($seojdul . '-' . $acak, 'packages');
            if ($res == true) {
                try {

                    $datas = array(
                        'judul' => $_POST["nama"],
                        'id_produk_kategori' => $_POST["id_produk_kategori"],
                        'gambar' => $nama_file_unik,
                        'travel_plan' => $_POST["travel_plan"],
                        'vacation_type' => $_POST["vacation_type"],
                        'lama' => $_POST["lama"],
                        'about' => $_POST["about"],
                        'urutan' => $_POST['urutan'],
                        'deskripsi' => $_POST["deskripsi"],
                        'keyword' => $_POST['keyword'],
                        'description' => $_POST['description'],
                    );
                    $saved = $db->insert('packages', $datas);
                    $insertId = $db->lastId();

                    $pathToImage = 'images/packages/' . $nama_file_unik;
                    $pathSmall = 'images/packages/small/' . $nama_file_unik;
                    lopoCompress('packages', $pathToImage, $tipe_file2, 0);
                    lopoCompress('packages/small', $pathToImage, $tipe_file2, 3);

                    $image = new ImageResize($pathSmall);
                    $image->resize(150, 150);
                    $image->save($pathSmall);

                    $image2 = new ImageResize($pathToImage);
                    $image2->save($pathToImage);

                    $msg->info('packages berhasil diubah');
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
    $edit = $db->connection("SELECT gambar FROM packages WHERE id_packages=$id ");
    $rr = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/packages/$rr[gambar]");
    unlink("images/packages/small/$rr[gambar]");

    $del = $db->delete("packages", "id_packages=$id ");

    echo "<script>alert('Data Berhasil dihapus'); window.location = '$hal'</script>";

} elseif ($act == 'addgallery') {
    $edit = $db->connection("SELECT judul FROM packages WHERE id_packages='$_POST[id_packages]'");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);

    $lokasi_file = $_FILES['nyanpload']['tmp_name'];
    $nama_file = $_FILES['nyanpload']['name'];
    $tipe_file = $_FILES['nyanpload']['type'];
    $tipe_file2 = seo2($tipe_file);
    $seojdul = seo($tedit["judul"]);
    $acak = rand(00, 99);
    $nama_file_unik = $seojdul . $acak . "." . $tipe_file2;
    $idku = $_POST['id_packages'];
    if (empty($lokasi_file)) {
        echo "<script>window.alert('Belum ada Gambar yang Dimasukan!');
            window.location(history.back(-1))</script>";
    } else {
        try {
            UploadNyan($nama_file_unik, 'gallery_packages');

            $datas = array(
                'id_packages' => $idku,
                'gambar' => $nama_file_unik,
                'judul' => $_POST['judul'],
            );
            $db->insert('gallery_packages', $datas);

            unlink("images/gallery_packages/$nama_file_unik");

            echo "<script>alert('Gambar berhasil dimasukan!'); window.location = '$hal-edit-$_POST[id_packages]#gallery_packages'</script>";
        } catch (PDOException $e) {
            echo "$e";
        }

    }
} elseif ($act == 'editgallery') {
    $edit = $db->connection("SELECT judul FROM packages WHERE id_packages='$_POST[idm]'");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    $idku = $_POST['idm'];

    $lokasi_file = $_FILES['nyanpload']['tmp_name'];
    $nama_file = $_FILES['nyanpload']['name'];
    $tipe_file = $_FILES['nyanpload']['type'];
    $tipe_file2 = seo2($tipe_file);
    $seojdul = seo($tedit["judul"]);
    $acak = rand(00, 99);
    $nama_file_unik = $seojdul . $acak . "." . $tipe_file2;

    if (empty($lokasi_file)) {
        echo "<script>window.alert('Belum ada Gambar yang Dimasukan!');
            window.location(history.back(-1))</script>";
    } else {

        UploadNyan($nama_file_unik, 'gallery_packages');

        $edit = $db->connection("SELECT gambar FROM gallery_packages WHERE id_gallery ='$_POST[id]'");
        $tedit = $edit->fetch(PDO::FETCH_ASSOC);

        unlink("images/gallery_packages/$imgname1-$tedit[gambar]");
        unlink("images/gallery_packages/small/$imgname1-$tedit[gambar]");

        $datas = array(
            'id_packages' => $idku,
            'gambar' => $nama_file_unik,
            'judul' => $_POST['judul'],
        );
        $db->update('gallery_packages', $datas, " id_gallery = '$_POST[id]' ");

        unlink("images/gallery_packages/$nama_file_unik");

        echo "<script>alert('packages gambar berhasil diedit!'); window.location = '$hal-edit-$_POST[idm]#packagespackages'</script>";
    }
} elseif ($act == 'removegallery') {
    $edit = $db->connection("SELECT id_gallery, gambar FROM gallery_packages WHERE id_gallery='$id'");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/gallery_packages/$imgname1-$tedit[gambar]");
    unlink("images/gallery_packages/small/$imgname1-$tedit[gambar]");
    $id = $tedit['id_gallery'];

    $del = $db->connection("DELETE FROM gallery_packages WHERE id_gallery='$id'");
    $del->execute();

    header('location:' . $hal . '-edit-' . $id_packages . '#packagespackages');
}