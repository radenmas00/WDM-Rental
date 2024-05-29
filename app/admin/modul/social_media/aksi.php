<?php

    // Update modul
    if (  $act == 'update' ) {

        $tgl_post = convertDate('/', $_POST['tgl']);

        if ( !empty( $nama_file ) ) {
            if ( ( $ukuran == 0 ) OR ( $ukuran == 02 ) OR ( $ukuran>2060817 ) ) {
                echo "<script>window.alert('Gagal Upload Gambar, ukuran gambar lebih dari 2 MB !'); window.location(history.back(-1))</script>";
            } else {
                $edit = $db->connection( "SELECT gambar FROM social_media WHERE id_social_media='$_POST[id_social_media]'" );
                $tedit = $edit->fetch( PDO::FETCH_ASSOC );
                unlink( "../../../images/social_media/$tedit[gambar]" );
                unlink( "../../../images/social_media/small/$tedit[gambar]" );

                // Upload Image
                $res = lopoUpload( $judul_seo.'-'.$acak, 'social_media' );
                if ( $res == true ) {
                    try {

                        $datas = array(
                            'judul' => $_POST['judul'],
                            'link' => $_POST['link'],
                            'status' => $_POST['status'],
                            'gambar' => $nama_file_unik,
                            'tgl_update' => $tgl_post

                        );
                        $saved = $db->update( 'social_media', $datas, "id_social_media = '$_POST[id_social_media]' " );
                        $pathToImage = '../../../images/social_media/'.$nama_file_unik;
                        lopoCompress( 'social_media', $pathToImage, $tipe_file2, 2 );
						lopoCompress( 'social_media/small', $pathToImage, $tipe_file2, 9 );

                        echo "<script>alert('$hal Berhasil diedit'); window.location = '$hal'</script>";
                    } catch( PDOException $e ) {
                        echo "<script>alert('$hal Gagal diedit!'); window.location = '$hal'</script>";
                    }
                } else {
                    echo "<script>alert('Something error with this image $tipe_file2'); window.location = '$hal'</script>";
                }

            }
        } else {
            try {
                $datas = array(
                    'judul' => $_POST['judul'],
                    'link' => $_POST['link'],
                    'status' => $_POST['status'],
                    'tgl_update' => $tgl_post

                );
                $saved = $db->update( 'social_media', $datas, "id_social_media = '$_POST[id_social_media]' " );

                echo "<script>alert('$hal Berhasil diedit'); window.location = '$hal'</script>";
            } catch( PDOException $e ) {
                echo "<script>alert('$hal Gagal diedit!'); window.location = '$hal'</script>";
            }
        }
    }

    // add modul
    elseif ( $act == 'add' ) {

            $tgl_post = convertDate('/', $_POST['tgl']);
        
            try {
                $datas = array(
                    'judul' => $_POST['judul'],
                    'tgl_update' => $tgl_post
                );
                $saved = $db->insert( 'social_media', $datas );

                echo "<script>alert('$hal Berhasil ditambah'); window.location = '$hal'</script>";

            } catch( PDOException $e ) {
                echo "<script>alert('$hal Gagal diedit!'); window.location = '$hal'</script>";
            }        

    }

    // remove modul
    elseif ( $act == 'remove' ) {

        $del = $db->delete( 'social_media', "id_social_media='$_GET[id]'" );

        echo "<script>alert('$hal Berhasil dihapus'); window.location = '$hal'</script>";
    }


?>
