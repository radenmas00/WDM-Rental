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
                $edit = $db->connection( "SELECT gambar FROM referensi WHERE id_produk='$_POST[id_produk]'" );
                $tedit = $edit->fetch( PDO::FETCH_ASSOC );
                unlink( "images/referensi/$tedit[gambar]" );
                unlink( "images/referensi/small/$tedit[gambar]" );

                // Upload Image
                $res = lopoUpload( $judul_seo.'-'.$acak, 'referensi' );
                if ( $res == true ) {
                    try {

                        $datas = array(
                            'judul' => $_POST['judul'],
                            'judul_seo' => $judul_seo,
                            'deskripsi' => $_POST['deskripsi'],
                            'harga' => $_POST['harga'],
                            'keyword' => $_POST['keyword'],
                            'description' => $_POST['description'],
                            'gambar' => $nama_file_unik,
                            'tgl' => $_POST['tgl']

                        );
                        $saved = $db->update( 'referensi', $datas, "id_produk = '$_POST[id_produk]' " );
                        $pathToImage = 'images/referensi/'.$nama_file_unik;
                        $pathSmall   =  'images/referensi/small/'.$nama_file_unik;
                        lopoCompress( 'referensi', $pathToImage, $tipe_file2, 1 );
                        lopoCompress( 'referensi/small', $pathToImage, $tipe_file2, 6 );
                        
                        $image = new ImageResize($pathSmall);
                        $image->resizeToHeight(250);
                        $image->save($pathSmall);

                        $image2 = new ImageResize($pathToImage);
                        $image2->resizeToHeight(600);
                        $image2->save($pathToImage);
                        $msg->info('Data berhasil diubah !');
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
                    'judul_seo' => $judul_seo,
                    'deskripsi' => $_POST['deskripsi'],
                    'harga' => $_POST['harga'],
                    'keyword' => $_POST['keyword'],
                    'description' => $_POST['description'],
                    'tgl' => $_POST['tgl']

                );
                $saved = $db->update( 'referensi', $datas, "id_produk = '$_POST[id_produk]' " );
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
        $res = lopoUpload( $judul_seo.'-'.$acak, 'referensi' );
        if ( $res == false ) {
            $msg->warning('Gambar Tidak Boleh Kosong Atau melebihi 2 MB');
            echo "<script>window.location(history.back(-1))</script>";
        } else {
            try {
                $datas = array(
                    'judul' => $_POST['judul'],
                    'judul_seo' => $judul_seo,
                    'harga' => $_POST['harga'],
                    'deskripsi' => $_POST['deskripsi'],
                    'keyword' => $_POST['keyword'],
                    'description' => $_POST['description'],
                    'gambar' => $nama_file_unik,
                    'tgl' => $_POST['tgl']
                );
                $saved = $db->insert( 'referensi', $datas );
                $insertId = $db->lastId();


                $pathToImage = 'images/referensi/'.$nama_file_unik;
                $pathSmall   =  'images/referensi/small/'.$nama_file_unik;

                lopoCompress( 'referensi', $pathToImage, $tipe_file2, 1 );
                lopoCompress( 'referensi/small', $pathToImage, $tipe_file2, 6 );
                
                $image = new ImageResize($pathSmall);
                $image->resizeToHeight(250);
                $image->save($pathSmall);
                        
                $image2 = new ImageResize($pathToImage);
                $image2->resizeToHeight(600);
                $image2->save($pathToImage);

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
        $edit = $db->connection( "SELECT gambar FROM referensi WHERE id_produk='$id'" );
        $rr = $edit->fetch( PDO::FETCH_ASSOC );
        unlink( "images/referensi/$rr[gambar]" );
        unlink( "images/referensi/small/$rr[gambar]" );

        $del = $db->delete( 'referensi', "id_produk='$id'" );
        $msg->success('Data berhasil dihapus');
        echo "<script>window.location = '$hal'</script>";
    }

    elseif($act=='addgallery'){
        $edit = $db->connection("SELECT judul FROM referensi WHERE id_produk='$_POST[ids]'");
        $tedit = $edit->fetch(PDO::FETCH_ASSOC);
        $lokasi_file 	= $_FILES['lopoFile']['tmp_name'];
        $tipe_file   	 	 = $_FILES['lopoFile']['type'];
        $tipe_file2   	 	 = seo2( $tipe_file );
        $seojdul             = seo($tedit["judul"]);
        $acak           	 = rand( 00, 9999 );
        $nama_file_unik      = $seojdul.'-'.$acak.".".$tipe_file2;

        $idku = $_POST['ids'];
        if (empty($lokasi_file)){
            echo "<script>window.alert('Belum ada Gambar yang Dimasukan!');
            window.location(history.back(-1))</script>";
        }else{
			try{
			    
			    $res = lopoUpload( $seojdul.'-'.$acak, 'gallery_referensi' );
				//UploadNyan($nama_file_unik,'gallery_referensi');
				
				$datas = array(
				    'id_produk' => $idku,
				    'gambar'    => $nama_file_unik,
				    'judul'     => $_POST['judul']
				);
				$db->insert('gallery_referensi', $datas);
	
				//unlink("images/gallery_referensi/$nama_file_unik");
				
				$pathToImage = 'images/gallery_referensi/'.$nama_file_unik;
                $pathSmall   =  'images/gallery_referensi/small/'.$nama_file_unik;
                lopoCompress( 'gallery_referensi/small', $pathToImage, $tipe_file2, 0 );
                $image = new ImageResize($pathSmall);
                $image->resizeToHeight(531);
                $image->save($pathSmall);
                        
                //$image2 = new ImageResize($pathToImage);
                //$image2->resizeToHeight(1062);
                //$image2->save($pathToImage);
                
				$msg->success('Gambar berhasil ditambah');
				echo "<script>window.location = 'referensi-edit-$idku'</script>";
			}catch(PDOException $e){
					echo "$e";
				}
           
        }
    }

    elseif($act=='editgallery'){
        $edit = $db->connection("SELECT judul FROM referensi WHERE id_produk='$_POST[idm]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);
		$idku = $_POST['idm'];

        $lokasi_file 	= $_FILES['lopoFile']['tmp_name'];
        $nama_file   	= $_FILES['lopoFile']['name'];
        $tipe_file   	= $_FILES['lopoFile']['type'];
        $tipe_file2   	= seo2($tipe_file);
        $seojdul        = seo($tedit["judul"]);
        $acak           = rand(00,9999);
        $nama_file_unik = $seojdul.'-'.$acak.".".$tipe_file2;

        if (empty($lokasi_file)){
            $datas = array(
				'id_produk' => $idku,
				'judul'     => $_POST['judul']
			);
			$db->update('gallery_referensi', $datas, " id_gallery = '$_POST[id]' ");
			echo "<script>alert('Slider gambar berhasil diedit!'); window.location = 'referensi-edit-$_POST[idm]#sliderreferensi'</script>";
        }else{
            
            //UploadNyan($nama_file_unik,'gallery_referensi');

            $edit = $db->connection("SELECT gambar FROM gallery_referensi WHERE id_gallery ='$_POST[id]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/gallery_referensi/$imgname1-$tedit[gambar]");
            unlink("images/gallery_referensi/small/$imgname1-$tedit[gambar]");
            
            $res = lopoUpload( $seojdul.'-'.$acak, 'gallery_referensi' );

            $datas = array(
				    'id_produk' => $idku,
				    'gambar'    => $nama_file_unik,
				    'judul'     => $_POST['judul']
				);
				$db->update('gallery_referensi', $datas, " id_gallery = '$_POST[id]' ");

            //unlink("images/gallery_referensi/$nama_file_unik");
            
            $pathToImage = 'images/gallery_referensi/'.$nama_file_unik;
            $pathSmall   =  'images/gallery_referensi/small/'.$nama_file_unik;
            lopoCompress( 'gallery_referensi/small', $pathToImage, $tipe_file2, 0 );
            $image = new ImageResize($pathSmall);
            $image->resizeToHeight(531);
            $image->save($pathSmall);
                        
            //$image2 = new ImageResize($pathToImage);
            //$image2->resizeToHeight(1062);
            //$image2->save($pathToImage);

            $msg->info('Gambar berhasil diubah');
            echo "<script> window.location = 'referensi-edit-$_POST[idm]#sliderreferensi'</script>";
        }
    }

    elseif($act=='removegallery'){
        $edit = $db->connection("SELECT id_gallery, gambar FROM gallery_referensi WHERE id_gallery=$id ");
        $tedit = $edit->fetch(PDO::FETCH_ASSOC);
        unlink("images/gallery_referensi/$imgname1-$tedit[gambar]");
        unlink("images/gallery_referensi/small/$imgname1-$tedit[gambar]");
        $id = $tedit['id_gallery'];

        $del = $db->connection("DELETE FROM gallery_referensi WHERE id_gallery=$id ");
        $del->execute();

        //echo "<script>alert('Gambar berhasil dimasukan!'); window.location = 'referensi-edit-$_POST[id]'</script>";
        $msg->info('Data berhasil dihapus');
        header('location:referensi-edit-'.$id_produk.'#sliderreferensi');
	}
?>