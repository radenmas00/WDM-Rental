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
                $edit = $db->connection( "SELECT gambar FROM penerbit WHERE id_penerbit='$_POST[id_penerbit]'" );
                $tedit = $edit->fetch( PDO::FETCH_ASSOC );
                unlink( "images/penerbit/$tedit[gambar]" );
                unlink( "images/penerbit/small/$tedit[gambar]" );
                unlink( "images/penerbit/$tedit[gambar].webp" );
                unlink( "images/penerbit/small/$tedit[gambar].webp" );

                // Upload Image
                $res = lopoUpload( $judul_seo.'-'.$acak, 'penerbit' );
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
                        $saved = $db->update( 'penerbit', $datas, "id_penerbit = '$_POST[id_penerbit]' " );
                        $pathToImage = 'images/penerbit/'.$nama_file_unik;
                        $pathSmall   =  'images/penerbit/small/'.$nama_file_unik;
                        lopoCompress( 'penerbit', $pathToImage, $tipe_file2, 1 );
                        lopoCompress( 'penerbit/small', $pathToImage, $tipe_file2, 6 );
                        
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

                        echo "<script>alert('penerbit Berhasil diedit'); window.location = 'penerbit-edit-$_POST[id_penerbit]'</script>";
                    } catch( PDOException $e ) {
                        echo "<script>alert('penerbit Gagal diedit!'); window.location = 'penerbit-edit-$_POST[id_penerbit]'</script>";
                    }
                } else {
                    echo "<script>alert('Something error with this image'); window.location = 'penerbit-edit-$_POST[id_penerbit]'</script>";
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
                $saved = $db->update( 'penerbit', $datas, "id_penerbit = '$_POST[id_penerbit]' " );

                echo "<script>alert('penerbit Berhasil diedit'); window.location = 'penerbit-edit-$_POST[id_penerbit]'</script>";
            } catch( PDOException $e ) {
                echo "<script>alert('penerbit Gagal diedit!'); window.location = 'penerbit-edit-$_POST[id_penerbit]'</script>";
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
        $res = lopoUpload( $judul_seo.'-'.$acak, 'penerbit' );
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
                //die($db->insert( 'penerbit', $datas ));
                $saved = $db->insert( 'penerbit', $datas );
                $insertId = $db->lastId();

                $pathToImage = 'images/penerbit/'.$nama_file_unik;
                $pathSmall   = 'images/penerbit/small/'.$nama_file_unik;

                lopoCompress( 'penerbit', $pathToImage, $tipe_file2, 1 );
                lopoCompress( 'penerbit/small', $pathToImage, $tipe_file2, 6 );
                
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

                $msg->success("penerbit berhasil ditambah");
                echo "<script>window.location = 'penerbit-edit-$insertId'</script>";


            } catch( PDOException $e ) {
                echo "<script>alert('penerbit Gagal diedit!'); window.location = '$hal'</script>";
            }
        }
    }

    // remove modul
    elseif ( $act == 'remove' ) {
        $edit = $db->connection( "SELECT gambar FROM penerbit WHERE id_penerbit='$id'" );
        $rr = $edit->fetch( PDO::FETCH_ASSOC );
        unlink( "images/penerbit/$rr[gambar]" );
        unlink( "images/penerbit/small/$rr[gambar]" );
        unlink( "images/penerbit/$rr[gambar].webp" );
        unlink( "images/penerbit/small/$rr[gambar].webp" );

        $del = $db->delete( 'penerbit', "id_penerbit='$id'" );

        $hal = "penerbit";

        echo "<script>alert('$hal Berhasil dihapus'); window.location = '$hal'</script>";
    }
