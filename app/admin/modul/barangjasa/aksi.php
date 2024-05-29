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

        if ( !empty( $nama_file ) ) {
            if ( ( $ukuran == 0 ) OR ( $ukuran == 02 ) OR ( $ukuran>9060817 ) ) {
                echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
            } else {
                $edit = $db->connection( "SELECT gambar FROM barangjasa WHERE id_barangjasa='$_POST[id_barangjasa]'" );
                $tedit = $edit->fetch( PDO::FETCH_ASSOC );
                unlink( "images/barangjasa/$tedit[gambar]" );
                unlink( "images/barangjasa/small/$tedit[gambar]" );
                unlink( "images/barangjasa/$tedit[gambar].webp" );
                unlink( "images/barangjasa/small/$tedit[gambar].webp" );

                // Upload Image
                $res = lopoUpload( $judul_seo.'-'.$acak, 'barangjasa' );
                if ( $res == true ) {
                    try {

                        $datas = array(
                            'judul' => $_POST['judul'],
                            'judul_seo' => $judul_seo,
                            'deskripsi' => $_POST['deskripsi'],
                            'keyword' => $_POST['keyword'],
                            'description' => $_POST['description'],
                            'gambar' => $nama_file_unik,
                            'tgl' => $tgl_post

                        );
                        $saved = $db->update( 'barangjasa', $datas, "id_barangjasa = '$_POST[id_barangjasa]' " );
                        $pathToImage = 'images/barangjasa/'.$nama_file_unik;
                        $pathSmall   =  'images/barangjasa/small/'.$nama_file_unik;
                        lopoCompress( 'barangjasa', $pathToImage, $tipe_file2, 1 );
                        lopoCompress( 'barangjasa/small', $pathToImage, $tipe_file2, 6 );
                        
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

                        echo "<script>alert('barangjasa Berhasil diedit'); window.location = 'barangjasa-edit-$_POST[id_barangjasa]'</script>";
                    } catch( PDOException $e ) {
                        echo "<script>alert('barangjasa Gagal diedit!'); window.location = 'barangjasa-edit-$_POST[id_barangjasa]'</script>";
                    }
                } else {
                    echo "<script>alert('Something error with this image'); window.location = 'barangjasa-edit-$_POST[id_barangjasa]'</script>";
                }

            }
        } else {
            try {
                $datas = array(
                    'judul' => $_POST['judul'],
                    'judul_seo' => $judul_seo,
                    'deskripsi' => $_POST['deskripsi'],
                    'keyword' => $_POST['keyword'],
                    'description' => $_POST['description'],
                    'tgl' => $tgl_post
                );
                $saved = $db->update( 'barangjasa', $datas, "id_barangjasa = '$_POST[id_barangjasa]' " );

                echo "<script>alert('barangjasa Berhasil diedit'); window.location = 'barangjasa-edit-$_POST[id_barangjasa]'</script>";
            } catch( PDOException $e ) {
                echo "<script>alert('barangjasa Gagal diedit!'); window.location = 'barangjasa-edit-$_POST[id_barangjasa]'</script>";
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
        $res = lopoUpload( $judul_seo.'-'.$acak, 'barangjasa' );
        if ( $res == false ) {
            echo "<script>window.alert('Gambar Tidak Boleh Kosong Atau melebihi 2 MB'); window.location(history.back(-1))</script>";
        } else {
            try {
                $datas = array(
                    'judul' => $_POST['judul'],
                    'judul_seo' => $judul_seo,
                    'deskripsi' => $_POST['deskripsi'],
                    'keyword' => $_POST['keyword'],
                    'description' => $_POST['description'],
                    'gambar' => $nama_file_unik,
                    'tgl' => $tgl_post
                );
                //die($db->insert( 'barangjasa', $datas ));
                $saved = $db->insert( 'barangjasa', $datas );
                $insertId = $db->lastId();

                $pathToImage = 'images/barangjasa/'.$nama_file_unik;
                $pathSmall   =  'images/barangjasa/small/'.$nama_file_unik;

                lopoCompress( 'barangjasa', $pathToImage, $tipe_file2, 1 );
                lopoCompress( 'barangjasa/small', $pathToImage, $tipe_file2, 6 );
                
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

                $msg->success("barangjasa berhasil ditambah");
                echo "<script>window.location = 'barangjasa-edit-$insertId'</script>";


            } catch( PDOException $e ) {
                echo "<script>alert('barangjasa Gagal diedit!'); window.location = '$hal'</script>";
            }
        }
    }

    // remove modul
    elseif ( $act == 'remove' ) {
        $edit = $db->connection( "SELECT gambar FROM barangjasa WHERE id_barangjasa='$id'" );
        $datahapus = $db->connection("SELECT * FROM barangjasa WHERE id_barangjasa = $id")->fetch();
        $rr = $edit->fetch( PDO::FETCH_ASSOC );
        unlink( "images/barangjasa/$rr[gambar]" );
        unlink( "images/barangjasa/small/$rr[gambar]" );
        unlink( "images/barangjasa/$rr[gambar].webp" );
        unlink( "images/barangjasa/small/$rr[gambar].webp" );

        $del = $db->delete( 'barangjasa', "id_barangjasa='$id'" );

        $hal = "barangjasa";

        echo "<script>alert('$hal Berhasil dihapus'); window.location = '$hal'</script>";
    }
