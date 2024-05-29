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
                $edit = $db->connection( "SELECT gambar FROM properti WHERE id_properti='$_POST[id_properti]'" );
                $tedit = $edit->fetch( PDO::FETCH_ASSOC );
                unlink( "images/properti/$tedit[gambar]" );
                unlink( "images/properti/small/$tedit[gambar]" );
                unlink( "images/properti/$tedit[gambar].webp" );
                unlink( "images/properti/small/$tedit[gambar].webp" );

                // Upload Image
                $res = lopoUpload( $judul_seo.'-'.$acak, 'properti' );
                if ( $res == true ) {
                    try {

                        $datas = array(
                            'judul'         => $_POST['judul'],
                            'judul_seo'     => $judul_seo,
                            'harga'         => $_POST['harga'],
                            'deskripsi'     => $_POST['deskripsi'],
                            'keyword'       => $_POST['keyword'],
                            'description'   => $_POST['description'],
                            'gambar'        => $nama_file_unik,
                            'tgl'           => $tgl_post

                        );
                        $saved = $db->update( 'properti', $datas, "id_properti = '$_POST[id_properti]' " );
                        $pathToImage = 'images/properti/'.$nama_file_unik;
                        $pathSmall   =  'images/properti/small/'.$nama_file_unik;
                        lopoCompress( 'properti', $pathToImage, $tipe_file2, 1 );
                        lopoCompress( 'properti/small', $pathToImage, $tipe_file2, 6 );
                        
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

                        echo "<script>alert('Properti Berhasil diedit'); window.location = 'properti-edit-$_POST[id_properti]'</script>";
                    } catch( PDOException $e ) {
                        echo "<script>alert('properti Gagal diedit!'); window.location = 'properti-edit-$_POST[id_properti]'</script>";
                    }
                } else {
                    echo "<script>alert('Something error with this image'); window.location = 'properti-edit-$_POST[id_properti]'</script>";
                }

            }
        } else {
            try {
                $datas = array(
                    'judul'         => $_POST['judul'],
                    'judul_seo'     => $judul_seo,
                    'harga'         => $_POST['harga'],
                    'deskripsi'     => $_POST['deskripsi'],
                    'keyword'       => $_POST['keyword'],
                    'description'   => $_POST['description'],
                    'tgl'           => $tgl_post
                );
                $saved = $db->update( 'properti', $datas, "id_properti = '$_POST[id_properti]' " );

                echo "<script>alert('properti Berhasil diedit'); window.location = 'properti-edit-$_POST[id_properti]'</script>";
            } catch( PDOException $e ) {
                echo "<script>alert('properti Gagal diedit!'); window.location = 'properti-edit-$_POST[id_properti]'</script>";
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
        $res = lopoUpload( $judul_seo.'-'.$acak, 'properti' );
        if ( $res == false ) {
            echo "<script>window.alert('Gambar Tidak Boleh Kosong Atau melebihi 2 MB'); window.location(history.back(-1))</script>";
        } else {
            try {
                $datas = array(
                    'judul'         => $_POST['judul'],
                    'judul_seo'     => $judul_seo,
                    'deskripsi'     => $_POST['deskripsi'],
                    'harga'         => $_POST['harga'],
                    'keyword'       => $_POST['keyword'],
                    'description'   => $_POST['description'],
                    'gambar'        => $nama_file_unik,
                    'tgl'           => $tgl_post
                );
                //die($db->insert( 'properti', $datas ));
                $saved = $db->insert( 'properti', $datas );
                $insertId = $db->lastId();

                $pathToImage = 'images/properti/'.$nama_file_unik;
                $pathSmall   =  'images/properti/small/'.$nama_file_unik;

                lopoCompress( 'properti', $pathToImage, $tipe_file2, 1 );
                lopoCompress( 'properti/small', $pathToImage, $tipe_file2, 6 );
                
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

                $msg->success("properti berhasil ditambah");
                echo "<script>window.location = 'properti-edit-$insertId'</script>";


            } catch( PDOException $e ) {
                echo "<script>alert('properti Gagal diedit!'); window.location = '$hal'</script>";
            }
        }
    }

    // remove modul
    elseif ( $act == 'remove' ) {
        $edit = $db->connection( "SELECT gambar FROM properti WHERE id_properti='$id'" );
        $datahapus = $db->connection("SELECT * FROM properti WHERE id_properti = $id")->fetch();
        $rr = $edit->fetch( PDO::FETCH_ASSOC );
        unlink( "images/properti/$rr[gambar]" );
        unlink( "images/properti/small/$rr[gambar]" );
        unlink( "images/properti/$rr[gambar].webp" );
        unlink( "images/properti/small/$rr[gambar].webp" );

        $del = $db->delete( 'properti', "id_properti='$id'" );

        $hal = "properti";

        echo "<script>alert('$hal Berhasil dihapus'); window.location = '$hal'</script>";
    }
