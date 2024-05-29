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
                $edit = $db->connection( "SELECT gambar FROM kendaraan3 WHERE id_kendaraan='$_POST[id_kendaraan]'" );
                $tedit = $edit->fetch( PDO::FETCH_ASSOC );
                unlink( "images/kendaraan3/$tedit[gambar]" );
                unlink( "images/kendaraan3/small/$tedit[gambar]" );

                // Upload Image
                $res = lopoUpload( $judul_seo.'-'.$acak, 'kendaraan3' );
                if ( $res == true ) {
                    try {

                        $datas = array(
                            'judul'         => $_POST['judul'],
                            'judul_seo'     => $judul_seo,
                            'deskripsi'     => $_POST['deskripsi'],
                            'unggulan'      => $_POST['unggulan'],
                            'harga'         => $_POST['harga'],
                            'harga2'        => $_POST['harga2'],
                            'keyword'       => $_POST['keyword'],
                            'description'   => $_POST['description'],
                            'gambar'        => $nama_file_unik,
                            'tgl'           => $tgl_post

                        );
                        $saved = $db->update( 'kendaraan3', $datas, "id_kendaraan = '$_POST[id_kendaraan]' " );
                        $pathToImage = 'images/kendaraan3/'.$nama_file_unik;
                        $pathSmall   =  'images/kendaraan3/small/'.$nama_file_unik;
                        lopoCompress( 'kendaraan3', $pathToImage, $tipe_file2, 1 );
                        lopoCompress( 'kendaraan3/small', $pathToImage, $tipe_file2, 6 );
                        
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
                        echo "<script>window.location = '$hal-edit-$_POST[id_kendaraan]'</script>";
                    } catch( PDOException $e ) {
                        $msg->warning("$hal Gagal diedit!");
                        echo "<script> window.location = '$hal-edit-$_POST[id_kendaraan]'</script>";
                    }
                } else {
                    $msg->warning('Something error with this image');
                    echo "<script>window.location = '$hal-edit-$_POST[id_kendaraan]'</script>";
                }

            }
        } else {
            try {
                $datas = array(
                    'judul'         => $_POST['judul'],
                    'judul_seo'     => $judul_seo,
                    'deskripsi'     => $_POST['deskripsi'],
                    'unggulan'      => $_POST['unggulan'],
                    'harga'         => $_POST['harga'],
                    'harga2'        => $_POST['harga2'],
                    'keyword'       => $_POST['keyword'],
                    'description'   => $_POST['description'],
                    'tgl'           => $tgl_post

                );
                $saved = $db->update( 'kendaraan3', $datas, "id_kendaraan = '$_POST[id_kendaraan]' " );
                $msg->info('Data berhasil diubah');
                echo "<script>window.location = '$hal-edit-$_POST[id_kendaraan]'</script>";
            } catch( PDOException $e ) {
                $msg->error('Data gagal diubah');
                echo "<script>window.location = '$hal-edit-$_POST[id_kendaraan]'</script>";
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
        $res = lopoUpload( $judul_seo.'-'.$acak, 'kendaraan3' );
        if ( $res == false ) {
            $msg->warning('Gambar Tidak Boleh Kosong Atau melebihi 2 MB');
            echo "<script>window.location(history.back(-1))</script>";
        } else {
            try {
                $datas = array(
                    'judul'         => $_POST['judul'],
                    'judul_seo'     => $judul_seo,
                    'deskripsi'     => $_POST['deskripsi'],
                    'unggulan'      => $_POST['unggulan'],
                    'harga'         => $_POST['harga'],
                    'harga2'        => $_POST['harga2'],
                    'keyword'       => $_POST['keyword'],
                    'description'   => $_POST['description'],
                    'gambar'        => $nama_file_unik,
                    'tgl'           => date('Y-m-d')
                );
                
                $saved = $db->insert( 'kendaraan3', $datas );
                $insertId = $db->lastId();


                $pathToImage = 'images/kendaraan3/'.$nama_file_unik;
                $pathSmall   =  'images/kendaraan3/small/'.$nama_file_unik;

                lopoCompress( 'kendaraan3', $pathToImage, $tipe_file2, 1 );
                lopoCompress( 'kendaraan3/small', $pathToImage, $tipe_file2, 4 );
                
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
        $edit = $db->connection( "SELECT gambar FROM kendaraan3 WHERE id_kendaraan='$id'" );
        $rr = $edit->fetch( PDO::FETCH_ASSOC );
        unlink( "images/kendaraan3/$rr[gambar]" );
        unlink( "images/kendaraan3/small/$rr[gambar]" );

        $del = $db->delete( 'kendaraan3', "id_kendaraan='$id'" );

        $msg->success('Data berhasil dihapus');
        echo "<script>window.location = 'kendaraan3'</script>";
    }
