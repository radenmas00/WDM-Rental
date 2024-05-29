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
                $edit = $db->connection( "SELECT gambar FROM material WHERE id_material='$_POST[id_material]'" );
                $tedit = $edit->fetch( PDO::FETCH_ASSOC );
                unlink( "images/material/$tedit[gambar]" );
                unlink( "images/material/small/$tedit[gambar]" );

                // Upload Image
                $res = lopoUpload( $judul_seo.'-'.$acak, 'material' );
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
                        $saved = $db->update( 'material', $datas, "id_material = '$_POST[id_material]' " );
                        $pathToImage = 'images/material/'.$nama_file_unik;
                        $pathSmall   =  'images/material/small/'.$nama_file_unik;
                        lopoCompress( 'material', $pathToImage, $tipe_file2, 1 );
                        lopoCompress( 'material/small', $pathToImage, $tipe_file2, 6 );
                        
                        $image = new ImageResize($pathSmall);
                        $image->resizeToHeight(250);
                        $image->save($pathSmall);

                        $image2 = new ImageResize($pathToImage);
                        $image2->resizeToHeight(600);
                        $image2->save($pathToImage);
                        $msg->info('Data berhasil diubah !');
                        echo "<script>window.location = '$hal-edit-$_POST[id_material]'</script>";
                    } catch( PDOException $e ) {
                        $msg->warning("$hal Gagal diedit!");
                        echo "<script> window.location = '$hal-edit-$_POST[id_material]'</script>";
                    }
                } else {
                    $msg->warning('Something error with this image');
                    echo "<script>window.location = '$hal-edit-$_POST[id_material]'</script>";
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
                $saved = $db->update( 'material', $datas, "id_material = '$_POST[id_material]' " );
                $msg->info('Data berhasil diubah');
                echo "<script>window.location = '$hal-edit-$_POST[id_material]'</script>";
            } catch( PDOException $e ) {
                $msg->error('Data gagal diubah');
                echo "<script>window.location = '$hal-edit-$_POST[id_material]'</script>";
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
        $res = lopoUpload( $judul_seo.'-'.$acak, 'material' );
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
                $saved = $db->insert( 'material', $datas );
                $insertId = $db->lastId();


                $pathToImage = 'images/material/'.$nama_file_unik;
                $pathSmall   =  'images/material/small/'.$nama_file_unik;

                lopoCompress( 'material', $pathToImage, $tipe_file2, 1 );
                lopoCompress( 'material/small', $pathToImage, $tipe_file2, 6 );
                
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
        $edit = $db->connection( "SELECT gambar FROM material WHERE id_material='$id'" );
        $rr = $edit->fetch( PDO::FETCH_ASSOC );
        unlink( "images/material/$rr[gambar]" );
        unlink( "images/material/small/$rr[gambar]" );

        $del = $db->delete( 'material', "id_material='$id'" );
        $msg->success('Data berhasil dihapus');
        echo "<script>window.location = '$hal'</script>";
    }

    elseif($act=='addgallery'){
        $edit = $db->connection("SELECT judul FROM material WHERE id_material='$_POST[ids]'");
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
			    
			    $res = lopoUpload( $seojdul.'-'.$acak, 'gallery_material' );
				//UploadNyan($nama_file_unik,'gallery_material');
				
				$datas = array(
				    'id_material' => $idku,
				    'gambar'    => $nama_file_unik,
				    'judul'     => $_POST['judul']
				);
				$db->insert('gallery_material', $datas);
	
				//unlink("images/gallery_material/$nama_file_unik");
				
				$pathToImage = 'images/gallery_material/'.$nama_file_unik;
                $pathSmall   =  'images/gallery_material/small/'.$nama_file_unik;
                lopoCompress( 'gallery_material/small', $pathToImage, $tipe_file2, 0 );
                $image = new ImageResize($pathSmall);
                $image->resizeToHeight(531);
                $image->save($pathSmall);
                        
                //$image2 = new ImageResize($pathToImage);
                //$image2->resizeToHeight(1062);
                //$image2->save($pathToImage);
                
				$msg->success('Gambar berhasil ditambah');
				echo "<script>window.location = 'material-edit-$idku'</script>";
			}catch(PDOException $e){
					echo "$e";
				}
           
        }
    }

    elseif($act=='editgallery'){
        $edit = $db->connection("SELECT judul FROM material WHERE id_material='$_POST[idm]'");
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
				'id_material' => $idku,
				'judul'     => $_POST['judul']
			);
			$db->update('gallery_material', $datas, " id_gallery = '$_POST[id]' ");
			echo "<script>alert('Slider gambar berhasil diedit!'); window.location = 'material-edit-$_POST[idm]#slidermaterial'</script>";
        }else{
            
            //UploadNyan($nama_file_unik,'gallery_material');

            $edit = $db->connection("SELECT gambar FROM gallery_material WHERE id_gallery ='$_POST[id]'");
            $tedit = $edit->fetch(PDO::FETCH_ASSOC);

            unlink("images/gallery_material/$imgname1-$tedit[gambar]");
            unlink("images/gallery_material/small/$imgname1-$tedit[gambar]");
            
            $res = lopoUpload( $seojdul.'-'.$acak, 'gallery_material' );

            $datas = array(
				    'id_material' => $idku,
				    'gambar'    => $nama_file_unik,
				    'judul'     => $_POST['judul']
				);
				$db->update('gallery_material', $datas, " id_gallery = '$_POST[id]' ");

            //unlink("images/gallery_material/$nama_file_unik");
            
            $pathToImage = 'images/gallery_material/'.$nama_file_unik;
            $pathSmall   =  'images/gallery_material/small/'.$nama_file_unik;
            lopoCompress( 'gallery_material/small', $pathToImage, $tipe_file2, 0 );
            $image = new ImageResize($pathSmall);
            $image->resizeToHeight(531);
            $image->save($pathSmall);
                        
            //$image2 = new ImageResize($pathToImage);
            //$image2->resizeToHeight(1062);
            //$image2->save($pathToImage);

            $msg->info('Gambar berhasil diubah');
            echo "<script> window.location = 'material-edit-$_POST[idm]#slidermaterial'</script>";
        }
    }

    elseif($act=='removegallery'){
        $edit = $db->connection("SELECT id_gallery, gambar FROM gallery_material WHERE id_gallery=$id ");
        $tedit = $edit->fetch(PDO::FETCH_ASSOC);
        unlink("images/gallery_material/$imgname1-$tedit[gambar]");
        unlink("images/gallery_material/small/$imgname1-$tedit[gambar]");
        $id = $tedit['id_gallery'];

        $del = $db->connection("DELETE FROM gallery_material WHERE id_gallery=$id ");
        $del->execute();

        //echo "<script>alert('Gambar berhasil dimasukan!'); window.location = 'material-edit-$_POST[id]'</script>";
        $msg->info('Data berhasil dihapus');
        header('location:material-edit-'.$id_material.'#slidermaterial');
	}
?>