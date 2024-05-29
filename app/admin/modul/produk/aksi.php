<?php
use \Gumlet\ImageResize;
    // Update modul
    if ( $act == 'update' ) {

        $jdl2 				 = substr( $_POST['judul'], 0, 80 );
        $tipe_file   	 	 = $_FILES['lopoFile']['type'];
        $nama_file   		 = $_FILES['lopoFile']['name'];
        $ukuran   			 = $_FILES['lopoFile']['size'];
        $tipe_file2   	 	 = seo2( $tipe_file );
        $judul_seo 		 	 = seo( $_POST['judul'] );
        $acak           	 = rand( 00, 99 );
        $nama_file_unik 	 = $judul_seo.'-'.$acak.'.'.$tipe_file2;

        $tgl_post = convertDate('/', $_POST['tgl']);

        // $tags  	= explode(",",$_POST["id_tag"] );
        // if($_POST["id_tag"] != 0){

        //     $db->delete( 'detail_tag', "id_produk= $_POST[id_produk] " );
    
        //     foreach($tags as $tag){

        //         $datas = array(
        //             'id_tag' => $tag,
        //             'id_produk' => $_POST['id_produk'],
        //         );
        //         $saved = $db->insert( 'detail_tag', $datas );
        //     }
    
        // }

        if ( !empty( $nama_file ) ) {
            if ( ( $ukuran == 0 ) OR ( $ukuran == 02 ) OR ( $ukuran>9060817 ) ) {
                echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
            } else {
                $edit = $db->connection( "SELECT gambar FROM produk WHERE id_produk='$_POST[id_produk]'" );
                $tedit = $edit->fetch( PDO::FETCH_ASSOC );
                unlink( "images/produk/$tedit[gambar]" );
                unlink( "images/produk/small/$tedit[gambar]" );

                // Upload Image
                $res = lopoUpload( $judul_seo.'-'.$acak, 'produk' );
                if ( $res == true ) {
                    try {

                        $datas = array(
                            'judul' => $_POST['judul'],
                            // 'id_produk_k' => $_POST['id_produk_k'],
                            // 'id_produk_sk' => $_POST['id_produk_sk'],
                            'item_number' => $_POST['item_number'],
                            'judul_seo' => $judul_seo,
                            'deskripsi' => $_POST['deskripsi'],
                            'deskripsi_singkat' => $_POST['deskripsi_singkat'],
                            'harga' => $_POST['harga'],
                            'harga_diskon' => $_POST['harga_diskon'],
                            'stok' => $_POST['stok'],
                            'unggulan' => $_POST['unggulan'],
                            'keyword' => $_POST['keyword'],
                            'description' => $_POST['description'],
                            'gambar' => $nama_file_unik,
                            'material' => $_POST['material'],
                            'moq' => $_POST['moq'],
                            'shopee' => $_POST['shopee'],
                            'tokopedia' => $_POST['tokopedia'],
                            'terbit' => $_POST['terbit'],
                            'ukuran' => $_POST['ukuran'],
                            'kutipan' => $_POST['kutipan'],
                            'tgl' => $tgl_post

                        );
                        $saved = $db->update( 'produk', $datas, "id_produk = '$_POST[id_produk]' " );
                        $pathToImage = 'images/produk/'.$nama_file_unik;
                        $pathSmall   =  'images/produk/small/'.$nama_file_unik;
                        lopoCompress( 'produk', $pathToImage, $tipe_file2, 1 );
                        lopoCompress( 'produk/small', $pathToImage, $tipe_file2, 6 );
                        
                        $image = new ImageResize($pathSmall);
                        $image->resizeToBestFit(250, 250);
                        $image->save($pathSmall);

                        $image2 = new ImageResize($pathToImage);
                        $image2->resizeToHeight(500);
                        $image2->save($pathToImage);

                        // Convert to WEBP
                        $destination  = $pathToImage . '.webp';
                        $destination2 = $pathSmall . '.webp';

                        $jw = new ImageToWebp(); 
                        $jw->convert( $pathToImage, $destination, 75 );

                        $jw = new ImageToWebp(); 
                        $jw->convert( $pathSmall, $destination2, 75 );

                        $msg->info('Data berhasil diubah');
                        echo "<script>window.location = '$hal-edit-$_POST[id_produk]'</script>";
                    } catch( PDOException $e ) {
                        $msg->warning("$hal Gagal diedit!");
                        echo "<script> window.location = '$hal-edit-$_POST[id_produk]'</script>";
                    }
                } else {
                    $msg->warning('Something error with this image');
                    echo "<script>window.location = '$hal-edit-$_POST[id_produk]'</script>";
                }

            }
        } else {
            try {
                $datas = array(
                    'judul' => $_POST['judul'],
                    'id_produk_k' => $_POST['id_produk_k'],
                    // 'id_produk_sk' => $_POST['id_produk_sk'],
                    'item_number' => $_POST['item_number'],
                    'judul_seo' => $judul_seo,
                    'deskripsi' => $_POST['deskripsi'],
                    'deskripsi_singkat' => $_POST['deskripsi_singkat'],
                    'harga' => $_POST['harga'],
                    'harga_diskon' => $_POST['harga_diskon'],
                    'stok' => $_POST['stok'],
                    'unggulan' => $_POST['unggulan'],
                    'keyword' => $_POST['keyword'],
                    'description' => $_POST['description'],
                    'material' => $_POST['material'],
                    'moq' => $_POST['moq'],
                    'shopee' => $_POST['shopee'],
                    'tokopedia' => $_POST['tokopedia'],
                    'terbit' => $_POST['terbit'],
                    'ukuran' => $_POST['ukuran'],
                    'kutipan' => $_POST['kutipan'],
                    'tgl' => $tgl_post

                );
                $saved = $db->update( 'produk', $datas, "id_produk = '$_POST[id_produk]' " );
                $msg->info('Data berhasil diubah');
                echo "<script>window.location = '$hal-edit-$_POST[id_produk]'</script>";
            } catch( PDOException $e ) {
                $msg->error('Data gagal diubah');
                echo "<script>window.location = '$hal-edit-$_POST[id_produk]'</script>";
            }
        }
    }

    // add modul
    elseif (  $act == 'add' ) {
        $jdl2 				 = substr( $_POST['judul'], 0, 80 );
        $tipe_file   	 	 = $_FILES['lopoFile']['type'];
        $tipe_file2   	 	 = seo2( $tipe_file );
        $judul_seo 		 	 = seo( $_POST['judul'] );
        $acak           	 = rand( 00, 99 );
        $nama_file_unik 	 = $judul_seo.'-'.$acak.'.'.$tipe_file2;

        //$tgl_post = convertDate('/', $_POST['tgl']);
        

        // Upload Image
        $res = lopoUpload( $judul_seo.'-'.$acak, 'produk' );
        if ( $res == false ) {
            $msg->warning('Gambar Tidak Boleh Kosong Atau melebihi 2 MB');
            echo "<script>window.location(history.back(-1))</script>";
        } else {
            try {
                $datas = array(
                    'id_produk_k' => $_POST['id_produk_k'],
                    // 'id_produk_sk' => $_POST['id_produk_sk'],
                    'item_number' => $_POST['item_number'],
                    'judul' => $_POST['judul'],
                    'judul_seo' => $judul_seo,
                    'deskripsi' => $_POST['deskripsi'],
                    'deskripsi_singkat' => $_POST['deskripsi_singkat'],
                    'stok' => $_POST['stok'],
                    'unggulan' => $_POST['unggulan'],
                    'harga' => $_POST['harga'],
                    'harga_diskon' => $_POST['harga_diskon'],
                    'keyword' => $_POST['keyword'],
                    'description' => $_POST['description'],
                    'gambar' => $nama_file_unik,
                    'material' => $_POST['material'],
                    'moq' => $_POST['moq'],
                    'shopee' => $_POST['shopee'],
                    'tokopedia' => $_POST['tokopedia'],
                    'terbit' => $_POST['terbit'],
                    'ukuran' => $_POST['ukuran'],
                    'kutipan' => $_POST['kutipan'],
                    'tgl' => date('Y-m-d')
                );
                //die($db->insert( 'produk', $datas ));
                $saved = $db->insert( 'produk', $datas );
                $insertId = $db->lastId();


                $pathToImage = 'images/produk/'.$nama_file_unik;
                $pathSmall   =  'images/produk/small/'.$nama_file_unik;

                lopoCompress( 'produk', $pathToImage, $tipe_file2, 1 );
                lopoCompress( 'produk/small', $pathToImage, $tipe_file2, 4 );
                
                $image = new ImageResize($pathSmall);
                $image->resizeToBestFit(250, 250);
                $image->save($pathSmall);
                        
                $image2 = new ImageResize($pathToImage);
                $image2->resizeToHeight(500);
                $image2->save($pathToImage);

                // Convert to WEBP
                $destination  = $pathToImage . '.webp';
                $destination2 = $pathSmall . '.webp';

                $jw = new ImageToWebp(); 
                $jw->convert( $pathToImage, $destination, 75 );

                $jw = new ImageToWebp(); 
                $jw->convert( $pathSmall, $destination2, 75 );

                // $tags 	= explode(",",$_POST["id_tag"] );
				// foreach($tags as $tag){
                //     $datas = array(
                //         'id_tag' => $tag,
                //         'id_produk' => $insertId,
                //     );
                //     $saved = $db->insert( 'detail_tag', $datas );
				// }

                $msg->success('Data berhasil ditambah');

                echo "<script>window.location = '$hal-edit-$insertId'</script>";

            } catch( PDOException $e ) {
                $msg->error('Data gagal ditambah');
                echo "<script>window.location = '$hal'</script>";
            }
        }

    }

// add modul
elseif ($act == 'addSize') {

    $id      = $_POST["id_produk"];
    try {
        $datas = array(
            'id_produk' => $_POST["id_produk"],
            'l'         => $_POST["l"],
            'w'         => $_POST["w"],
            'h'         => $_POST["h"],
            'berat'     => $_POST["berat"],
        );
        $saved = $db->insert('produk_size', $datas);
        $insertId = $db->lastId();

        //$msg->success('Data berhasil ditambah');

        // echo "<script>window.location = '$hal-edit-$id#size'</script>";

        return true;

    } catch (PDOException $e) {
        echo "$e";
    }
}


// Update modul
if ($act == 'updateSize') {

    try {
        $datas = array(
            'l'         => $_POST["l"],
            'w'         => $_POST["w"],
            'h'         => $_POST["h"],
            'berat'     => $_POST["berat"],
        );
        $db->update('produk_size', $datas, "id_produk_size = $_POST[id_produk_size] ");
        return true;
        //$msg->info('Varian berhasil diedit');
        //echo "<script>window.location = '$hal-edit-$_POST[id_produk_varian]'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Data Gagal diedit!'); window.location = '$hal-edit-$_POST[id_produk_varian]'</script>";
    }
}


// remove modul
elseif ($act == 'removeSize') {
    $id_varian = $db->connection( "SELECT id_produk_size FROM produk_size WHERE id_produk_size= $id " )->fetchColumn();
    $db->delete("produk_size", "id_produk_size= $id ");
    echo "<script>alert('Size Berhasil dihapus'); window.location = '$hal-edit-$id_produk'</script>";
}

// add modul
elseif ($act == 'addWarna') {

    $id      = $_POST["id_produk_size"];
    try {
        $datas = array(
            'id_produk_size' => $_POST["id_produk_size"],
            'warna'     => $_POST["warna"],
            'harga'     => $_POST["harga"],
        );
        $saved = $db->insert('produk_warna', $datas);
        $insertId = $db->lastId();

        $msg->success('Warna berhasil ditambah');

        echo "<script>window.location = '$hal-$id'</script>";


    } catch (PDOException $e) {
        echo "$e";
    }
}

// Update modul
if ($act == 'updateWarna') {

    $id      = $_POST["id_produk_size"];
    try {
        $datas = array(
            'warna'     => $_POST["warna"],
            'harga'     => $_POST["harga"],
        );
        $db->update('produk_warna', $datas, "id_produk_warna = $_POST[id_produk_warna] ");

        $msg->info('Warna berhasil diubah');
        echo "<script>window.location = '$hal-$id'</script>";

    } catch (PDOException $e) {
        echo "<script>alert('Data Gagal diedit!'); window.location = '$hal-edit-$_POST[id_produk_varian]'</script>";
    }
}


elseif ($act == 'removeWarna') {
    $id_varian = $db->connection( "SELECT id_produk_warna FROM produk_warna WHERE id_produk_warna= $id " )->fetchColumn();
    $db->delete("produk_warna", "id_produk_warna= $id ");
    $msg->info('Warna berhasil dihapus');
    echo "<script>window.location = '$hal-$id_produk_size'</script>";
}


// remove modul
elseif ( $act == 'removeVarian' ) {
    $edit = $db->connection( "SELECT * FROM produk_varian WHERE id_produk_varian='$id'" );
    $rr = $edit->fetch( PDO::FETCH_ASSOC );

    $id_produk = $rr['id_produk'];

    $gallery = $db->connection( "SELECT * FROM gallery_produk_varian WHERE id_produk_varian = $id" )->fetchAll();
    foreach($gallery as $g){
        unlink( "images/gallery_produk_varian/$imgname1-$g[gambar]" );
        unlink( "images/gallery_produk_varian/small/$imgname1-$g[gambar]" );
    }
    

    $del = $db->delete( 'produk_size', "id_produk_varian='$id'" );
    $del = $db->delete( 'gallery_produk_varian', "id_produk_varian='$id'" );

    $del = $db->delete( 'produk_varian', "id_produk_varian='$id'" );
    
    $msg->success('Varian berhasil dihapus');
    echo "<script>window.location = '$hal-edit-$id_produk'</script>";
}

// Update modul
if ($act == 'updateSize') {
    $harga = str_replace( ',', '', $_POST["harga"] );
    
    $diskon = str_replace( ',', '', $_POST["diskon"] );
    
    if($diskon > $harga) {
        echo "<script>window.alert('Harga Diskon harus lebih kecil dari Harga Normal'); window.location(history.back(-1))</script>";
        exit;
    }
    $seojdul = seo($_POST["judul"]);
    try {
        $datas = array(
            'judul' => $_POST["judul"],
            'judul_seo' => $seojdul,
            'stok' => $_POST["stok"],
            'sku' => $_POST["sku"],
            'harga' => $_POST["harga"],
            'diskon' => $_POST["diskon"],
        );
        $db->update('produk_size', $datas, "id_produk_size = $_POST[id_produk_size] ");
        $msg->info('Ukuran berhasil diedit');
        echo "<script>window.location = 'varian-edit-$_POST[id_produk_varian]'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Data Gagal diedit!'); window.location = '$varian-edit-$_POST[id_produk_varian]'</script>";
    }
}



// add modul
elseif ($act == 'addSize') {
    $harga = str_replace( ',', '', $_POST["harga"] );
    
    $diskon = str_replace( ',', '', $_POST["diskon"] );
    
    if($diskon > $harga) {
        echo "<script>window.alert('Harga Diskon harus lebih kecil dari Harga Normal'); window.location(history.back(-1))</script>";
        exit;
    }
    
    $seojdul = seo($_POST["judul"]);
    $id      = $_POST["id_produk"];
                try {
                    $datas = array(
                        'id_produk' => $_POST["id_produk"],
                        'id_produk_varian' => $_POST["id_produk_varian"],
                        'judul' => $_POST["judul"],
                        'judul_seo' => $seojdul,
                        'stok' => $_POST["stok"],
                        'sku' => $_POST["sku"],
                        'harga' => $_POST["harga"],
                        'diskon' => $_POST["diskon"],
                    );
                    $saved = $db->insert('produk_size', $datas);
                    $insertId = $db->lastId();

                    echo "<script>alert('Ukuran Berhasil ditambah'); window.location = '$hal-edit-$_POST[id_produk_varian]'</script>";

                } catch (PDOException $e) {
                    echo "$e";
                }
}

elseif($act=='addgalleryvarian'){
    $edit = $db->connection("SELECT * FROM produk_varian WHERE id_produk_varian = $_POST[id_produk_varian]");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    
    $lokasi_file 	= $_FILES['nyanpload']['tmp_name'];
    $nama_file   	= $_FILES['nyanpload']['name'];
    $tipe_file   	= $_FILES['nyanpload']['type'];
    $tipe_file2   	= seo2($tipe_file);
    $seojdul        = seo($tedit["judul"]);
    $acak           = rand(00,99);
    $nama_file_unik = $seojdul.$acak.".".$tipe_file2;
    $idku = $_POST['id_produk_varian'];
    if (empty($lokasi_file)){
        echo "<script>window.alert('Belum ada Gambar yang Dimasukan!');
        window.location(history.back(-1))</script>";
    }else{
        try{
            UploadNyan($nama_file_unik,'gallery_produk_varian');
            
            $datas = array(
                'id_produk_varian' => $idku,
                'gambar'    => $nama_file_unik,
                'judul'     => $_POST['judul'],
                'id_produk' => $tedit['id_produk']
            );
            $db->insert('gallery_produk_varian', $datas);

            unlink("images/gallery_produk_varian/$nama_file_unik");
            $msg->success('Gambar berhasil ditambah');
            echo "<script>window.location = 'varian-edit-$idku'</script>";
        }catch(PDOException $e){
                echo "$e";
            }
       
    }
}

elseif($act=='editgalleryvarian'){
    $edit = $db->connection("SELECT judul FROM gallery_produk_varian WHERE id_galleryvarian ='$_POST[id]'");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    $idku = $_POST['id'];

    $lokasi_file 	= $_FILES['nyanpload']['tmp_name'];
    $nama_file   	= $_FILES['nyanpload']['name'];
    $tipe_file   	= $_FILES['nyanpload']['type'];
    $tipe_file2   	= seo2($tipe_file);
    $seojdul        = seo($tedit["judul"]);
    $acak           = rand(00,99);
    $nama_file_unik = $seojdul.$acak.".".$tipe_file2;

    if (empty($lokasi_file)){
        $datas = array(
            'judul'     => $_POST['judul']
        );
        $db->update('gallery_produk_varian', $datas, " id_galleryvarian = '$_POST[id]' ");
        echo "<script>alert('gambar berhasil diedit!'); window.location = 'varian-edit-$_POST[id]'</script>";
    }else{

        UploadNyan($nama_file_unik,'gallery_produk_varian');

        $edit = $db->connection("SELECT gambar FROM gallery_produk_varian WHERE id_galleryvarian ='$_POST[id]'");
        $tedit = $edit->fetch(PDO::FETCH_ASSOC);

        unlink("images/gallery_produk_varian/$imgname1-$tedit[gambar]");
        unlink("images/gallery_produk_varian/small/$imgname1-$tedit[gambar]");

        $datas = array(
                'gambar'    => $nama_file_unik,
                'judul'     => $_POST['judul']
            );
            $db->update('gallery_produk_varian', $datas, " id_galleryvarian = '$_POST[id]' ");

        unlink("images/gallery_produk_varian/$nama_file_unik");

        $msg->info('Gambar berhasil diubah');
        echo "<script> window.location = 'varian-edit-$_POST[id]'</script>";
    }
}


elseif($act=='removegalleryvarian'){
    $edit = $db->connection("SELECT id_galleryvarian, gambar, id_produk_varian FROM gallery_produk_varian WHERE id_galleryvarian=$id ");
    $tedit = $edit->fetch(PDO::FETCH_ASSOC);
    unlink("images/gallery_produk_varian/$imgname1-$tedit[gambar]");
    unlink("images/gallery_produk_varian/small/$imgname1-$tedit[gambar]");
    $id = $tedit['id_galleryvarian'];

    $id_varian = $tedit['id_produk_varian'];

    $del = $db->connection("DELETE FROM gallery_produk_varian WHERE id_galleryvarian=$id ");
    $del->execute();

    //echo "<script>alert('Gambar berhasil dimasukan!'); window.location = 'produk-edit-$_POST[id]'</script>";
    $msg->info('Gambar berhasil dihapus');
    header('location:varian-edit-'.$id_varian);
}

    // remove modul
    elseif ( $act == 'remove' ) {
        $edit = $db->connection( "SELECT gambar FROM produk WHERE id_produk='$id'" );
        $rr = $edit->fetch( PDO::FETCH_ASSOC );
        unlink( "images/produk/$rr[gambar]" );
        unlink( "images/produk/small/$rr[gambar]" );
        $id_produk_size = $db->connection("SELECT id_produk_size FROM produk_size WHERE id_produk = $id ")->fetchColumn();

        $gallery = $db->connection( "SELECT * FROM gallery_produk WHERE id_produk = $id " )->fetchAll();
        foreach($gallery as $g){
            unlink( "images/gallery_produk/$imgname1-$g[gambar]" );
            unlink( "images/gallery_produk/small/$imgname1-$g[gambar]" );
        }

        $del = $db->delete( 'gallery_produk', "id_produk='$id'" );
        $del = $db->delete( 'produk_size', "id_produk='$id'" );
        $del = $db->delete( 'produk_warna', "id_produk_size='$id_produk_size'" );
        $del = $db->delete( 'produk', "id_produk='$id'" );

        $msg->success('Data berhasil dihapus');
        echo "<script>window.location = '$hal'</script>";
    }

    elseif($act=='addgallery'){
        $edit = $db->connection("SELECT judul FROM produk WHERE id_produk='$_POST[ids]'");
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
            echo "<script>window.alert('Belum ada Gambar yang Dimasukan!');
            window.location(history.back(-1))</script>";
        }else{
			try{
				UploadNyan($nama_file_unik,'gallery_produk');
				
				$datas = array(
				    'id_produk' => $idku,
				    'gambar'    => $nama_file_unik,
				    'judul'     => $_POST['judul']
				);
				$db->insert('gallery_produk', $datas);
	
				unlink("images/gallery_produk/$nama_file_unik");
				$msg->success('Gambar berhasil ditambah');
				echo "<script>window.location = 'produk-edit-$idku'</script>";
			}catch(PDOException $e){
					echo "$e";
				}
           
        }
    }

    elseif($act=='editgallery'){
        $edit = $db->connection("SELECT judul FROM produk WHERE id_produk='$_POST[idm]'");
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
				'id_produk' => $idku,
				'judul'     => $_POST['judul']
			);
			$db->update('gallery_produk', $datas, " id_gallery = '$_POST[id]' ");
			echo "<script>alert('Slider gambar berhasil diedit!'); window.location = 'produk-edit-$_POST[idm]#sliderproduk'</script>";
        }else{

            UploadNyan($nama_file_unik,'gallery_produk');

            $edit = $db->connection("SELECT gambar FROM gallery_produk WHERE id_gallery ='$_POST[id]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/gallery_produk/$imgname1-$tedit[gambar]");
            unlink("images/gallery_produk/small/$imgname1-$tedit[gambar]");

            $datas = array(
				    'id_produk' => $idku,
				    'gambar'    => $nama_file_unik,
				    'judul'     => $_POST['judul']
				);
				$db->update('gallery_produk', $datas, " id_gallery = '$_POST[id]' ");

            unlink("images/gallery_produk/$nama_file_unik");

            $msg->info('Gambar berhasil diubah');
            echo "<script> window.location = 'produk-edit-$_POST[idm]#sliderproduk'</script>";
        }
    }

    elseif($act=='removegallery'){
        $edit = $db->connection("SELECT id_gallery, gambar FROM gallery_produk WHERE id_gallery=$id ");
        $tedit = $edit->fetch(PDO::FETCH_ASSOC);
        unlink("images/gallery_produk/$imgname1-$tedit[gambar]");
        unlink("images/gallery_produk/small/$imgname1-$tedit[gambar]");
        $id = $tedit['id_gallery'];

        $del = $db->connection("DELETE FROM gallery_produk WHERE id_gallery=$id ");
        $del->execute();

        //echo "<script>alert('Gambar berhasil dimasukan!'); window.location = 'produk-edit-$_POST[id]'</script>";
        $msg->info('Data berhasil dihapus');
        header('location:produk-edit-'.$id_produk.'#sliderproduk');
	}
?>