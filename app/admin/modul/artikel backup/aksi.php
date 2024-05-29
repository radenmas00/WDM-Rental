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

        $tags  	= explode(",",$_POST["id_tag"] );
        if($_POST["id_tag"] != 0){

            $db->delete( 'detail_tag2', "id_artikel= $_POST[id_artikel] " );
    
            foreach($tags as $tag){

                $datas = array(
                    'id_tag' => $tag,
                    'id_artikel' => $_POST['id_artikel'],
                );
                $saved = $db->insert( 'detail_tag2', $datas );
            }
    
        }

        if ( !empty( $nama_file ) ) {
            if ( ( $ukuran == 0 ) OR ( $ukuran == 02 ) OR ( $ukuran>9060817 ) ) {
                echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
            } else {
                $edit = $db->connection( "SELECT gambar FROM artikel WHERE id_artikel='$_POST[id_artikel]'" );
                $tedit = $edit->fetch( PDO::FETCH_ASSOC );
                unlink( "images/artikel/$tedit[gambar]" );
                unlink( "images/artikel/small/$tedit[gambar]" );
                unlink( "images/artikel/$tedit[gambar].webp" );
                unlink( "images/artikel/small/$tedit[gambar].webp" );

                // Upload Image
                $res = lopoUpload( $judul_seo.'-'.$acak, 'artikel' );
                if ( $res == true ) {
                    try {

                        $datas = array(
                            // 'id_kategori' => $_POST['id_kategori'],
                            'judul' => $_POST['judul'],
                            'judul_seo' => $judul_seo,
                            'deskripsi' => $_POST['deskripsi'],
                            // 'id_admin' => $_SESSION['id_admin'],
                            'tingkatan' => $_POST['tingkatan'],
                            'status' => $_POST['status'],
                            'keyword' => $_POST['keyword'],
                            'description' => $_POST['description'],
                            'gambar' => $nama_file_unik,
                            'tgl' => $tgl_post

                        );
                        $saved = $db->update( 'artikel', $datas, "id_artikel = '$_POST[id_artikel]' " );
                        $pathToImage = 'images/artikel/'.$nama_file_unik;
                        $pathSmall   =  'images/artikel/small/'.$nama_file_unik;
                        lopoCompress( 'artikel', $pathToImage, $tipe_file2, 1 );
                        lopoCompress( 'artikel/small', $pathToImage, $tipe_file2, 6 );
                        
                        $image = new ImageResize($pathSmall);
                        $image->resize(250, 250);
                        $image->save($pathSmall);

                        $image2 = new ImageResize($pathToImage);
                        //$image2->resize(1349, 700);
                        $image2->save($pathToImage);

                        // Convert to WEBP
                        $destination  = $pathToImage . '.webp';
                        $destination2 = $pathSmall . '.webp';

                        $jw = new ImageToWebp(); 
                        $jw->convert( $pathToImage, $destination, 75 );

                        $jw = new ImageToWebp(); 
                        $jw->convert( $pathSmall, $destination2, 75 );

                        echo "<script>alert('$hal Berhasil diedit'); window.location = '$hal-edit-$_POST[id_artikel]'</script>";
                    } catch( PDOException $e ) {
                        echo "<script>alert('$hal Gagal diedit!'); window.location = '$hal-edit-$_POST[id_artikel]'</script>";
                    }
                } else {
                    echo "<script>alert('Something error with this image'); window.location = '$hal-edit-$_POST[id_artikel]'</script>";
                }

            }
        } else {
            try {
                $datas = array(
                    // 'id_kategori' => $_POST['id_kategori'],
                    'judul' => $_POST['judul'],
                    // 'id_admin' => $_SESSION['id_admin'],
                    'judul_seo' => $judul_seo,
                    'deskripsi' => $_POST['deskripsi'],
                    'tingkatan' => $_POST['tingkatan'],
                    'status' => $_POST['status'],
                    'keyword' => $_POST['keyword'],
                    'description' => $_POST['description'],
                    'tgl' => $tgl_post

                );
                $saved = $db->update( 'artikel', $datas, "id_artikel = '$_POST[id_artikel]' " );

                echo "<script>alert('$hal Berhasil diedit'); window.location = '$hal-edit-$_POST[id_artikel]'</script>";
            } catch( PDOException $e ) {
                echo "<script>alert('$hal Gagal diedit!'); window.location = '$hal-edit-$_POST[id_artikel]'</script>";
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

        $tgl_post = convertDate('/', $_POST['tgl']);
        

        // Upload Image
        $res = lopoUpload( $judul_seo.'-'.$acak, 'artikel' );
        if ( $res == false ) {
            echo "<script>window.alert('Gambar Tidak Boleh Kosong Atau melebihi 2 MB'); window.location(history.back(-1))</script>";
        } else {
            try {
                $datas = array(
                    // 'id_kategori' => $_POST['id_kategori'],
                    'judul' => $_POST['judul'],
                    // 'id_admin' => $_SESSION['id_admin'],
                    'judul_seo' => $judul_seo,
                    'deskripsi' => $_POST['deskripsi'],
                    'tingkatan' => $_POST['tingkatan'],
                    'status' => $_POST['status'],
                    'keyword' => $_POST['keyword'],
                    'description' => $_POST['description'],
                    'gambar' => $nama_file_unik,
                    'tgl' => $tgl_post
                );
                //die($db->insert( 'artikel', $datas ));
                $saved = $db->insert( 'artikel', $datas );
                $insertId = $db->lastId();

                $pathToImage = 'images/artikel/'.$nama_file_unik;
                $pathSmall   =  'images/artikel/small/'.$nama_file_unik;

                lopoCompress( 'artikel', $pathToImage, $tipe_file2, 1 );
                lopoCompress( 'artikel/small', $pathToImage, $tipe_file2, 6 );
                
                $image = new ImageResize($pathSmall);
                $image->resize(250, 250);
                $image->save($pathSmall);
                        
                $image2 = new ImageResize($pathToImage);
                //$image2->resize(1349, 700);
                $image2->save($pathToImage);

                // Convert to WEBP
                $destination  = $pathToImage . '.webp';
                $destination2 = $pathSmall . '.webp';

                $jw = new ImageToWebp(); 
                $jw->convert( $pathToImage, $destination, 75 );

                $jw = new ImageToWebp(); 
                $jw->convert( $pathSmall, $destination2, 75 );

                $tags 	= explode(",",$_POST["id_tag"] );
				foreach($tags as $tag){
                    $datas = array(
                        'id_tag' => $tag,
                        'id_artikel' => $insertId,
                    );
                    $saved = $db->insert( 'detail_tag2', $datas );
				}

                $msg->success("$hal berhasil ditambah");
                echo "<script>window.location = '$hal-edit-$insertId'</script>";


            } catch( PDOException $e ) {
                echo "<script>alert('$hal Gagal diedit!'); window.location = '$hal'</script>";
            }
        }

    }


    // add modul
    elseif (  $act == 'add2' ) {

        $judul_seo 		 	 = seo( $_POST['judul'] );

        $tgl_post = convertDate('/', $_POST['tgl']);
        
        $cabang = explode(PHP_EOL,$_POST['judul']);

        // Upload Image
            try {
                foreach($cabang as $r) {
                    $judul = "Pengobatan Alat Vital $r, $_POST[kota]";
                    $judul_seo = seo( $judul );
                    $datas = array(
                        'judul' => $judul,
                        'judul_seo' => $judul_seo,
                        'deskripsi' => $_POST['deskripsi'],
                        'status' => $_POST['status'],
                        'keyword' => $judul,
                        'description' => $judul,
                        'tgl' => $tgl_post
                    );
                    $saved = $db->insert( 'artikel', $datas );
                    $insertId = $db->lastId();
                }
                

                $msg->success("$hal berhasil ditambah");
                echo "<script>window.location = '$hal'</script>";


            } catch( PDOException $e ) {
                echo "<script>alert('$hal Gagal diedit!'); window.location = '$hal'</script>";
            }
        

    }

    // remove modul
    elseif ( $act == 'remove' ) {
        $edit = $db->connection( "SELECT gambar FROM artikel WHERE id_artikel='$id'" );
        $rr = $edit->fetch( PDO::FETCH_ASSOC );
        unlink( "images/artikel/$rr[gambar]" );
        unlink( "images/artikel/small/$rr[gambar]" );
        unlink( "images/artikel/$rr[gambar].webp" );
        unlink( "images/artikel/small/$rr[gambar].webp" );

        $del = $db->delete( 'artikel', "id_artikel='$id'" );

        echo "<script>alert('$hal Berhasil dihapus'); window.location = '$hal'</script>";
    }
?>
