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
                $edit = $db->connection( "SELECT gambar FROM paketwisata WHERE id_paketwisata='$_POST[id_paketwisata]'" );
                $tedit = $edit->fetch( PDO::FETCH_ASSOC );
                unlink( "images/paketwisata/$tedit[gambar]" );
                unlink( "images/paketwisata/small/$tedit[gambar]" );

                // Upload Image
                $res = lopoUpload( $judul_seo.'-'.$acak, 'paketwisata' );
                if ( $res == true ) {
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
                        $saved = $db->update( 'paketwisata', $datas, "id_paketwisata = '$_POST[id_paketwisata]' " );
                        $pathToImage = 'images/paketwisata/'.$nama_file_unik;
                        $pathSmall   =  'images/paketwisata/small/'.$nama_file_unik;
                        lopoCompress( 'paketwisata', $pathToImage, $tipe_file2, 1 );
                        lopoCompress( 'paketwisata/small', $pathToImage, $tipe_file2, 6 );
                        
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
                        echo "<script>window.location = '$hal-edit-$_POST[id_paketwisata]'</script>";
                    } catch( PDOException $e ) {
                        $msg->warning("$hal Gagal diedit!");
                        echo "<script> window.location = '$hal-edit-$_POST[id_paketwisata]'</script>";
                    }
                } else {
                    $msg->warning('Something error with this image');
                    echo "<script>window.location = '$hal-edit-$_POST[id_paketwisata]'</script>";
                }

            }
        } else {
            try {
                $datas = array(
                    'judul'         => $_POST['judul'],
                    'judul_seo'     => $judul_seo,
                    'deskripsi'     => $_POST['deskripsi'],
                    'harga'         => $_POST['harga'],
                    'keyword'       => $_POST['keyword'],
                    'description'   => $_POST['description'],
                    'tgl'           => $tgl_post

                );
                $saved = $db->update( 'paketwisata', $datas, "id_paketwisata = '$_POST[id_paketwisata]' " );
                $msg->info('Data berhasil diubah');
                echo "<script>window.location = '$hal-edit-$_POST[id_paketwisata]'</script>";
            } catch( PDOException $e ) {
                $msg->error('Data gagal diubah');
                echo "<script>window.location = '$hal-edit-$_POST[id_paketwisata]'</script>";
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
        $res = lopoUpload( $judul_seo.'-'.$acak, 'paketwisata' );
        if ( $res == false ) {
            $msg->warning('Gambar Tidak Boleh Kosong Atau melebihi 2 MB');
            echo "<script>window.location(history.back(-1))</script>";
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
                    'tgl'           => date('Y-m-d')
                );
                
                $saved = $db->insert( 'paketwisata', $datas );
                $insertId = $db->lastId();


                $pathToImage = 'images/paketwisata/'.$nama_file_unik;
                $pathSmall   =  'images/paketwisata/small/'.$nama_file_unik;

                lopoCompress( 'paketwisata', $pathToImage, $tipe_file2, 1 );
                lopoCompress( 'paketwisata/small', $pathToImage, $tipe_file2, 4 );
                
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

                $msg->success('Data berhasil ditambah');

                echo "<script>window.location = '$hal-edit-$insertId'</script>";

            } catch( PDOException $e ) {
                $msg->error('Data gagal ditambah');
                echo "<script>window.location = '$hal'</script>";
            }
        }

    }

    // remove modul
    elseif ( $act == 'remove' ) {
        $edit = $db->connection( "SELECT gambar FROM paketwisata WHERE id_paketwisata='$id'" );
        $rr = $edit->fetch( PDO::FETCH_ASSOC );
        unlink( "images/paketwisata/$rr[gambar]" );
        unlink( "images/paketwisata/small/$rr[gambar]" );

        $del = $db->delete( 'paketwisata', "id_paketwisata='$id'" );

        $msg->success('Data berhasil dihapus');
        echo "<script>window.location = 'paketwisata'</script>";
    }
