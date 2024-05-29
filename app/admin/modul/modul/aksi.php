<?php

    if ( $act == 'update' ) {

        if ( ( $_POST['jenis_modul'] == 'Images' )OR( $_POST['jenis_modul'] == 'Text Images' )OR( $_POST['jenis_modul'] == 'Textarea Images' ) ) {

            $lokasi_file 	 = $_FILES['fupload']['tmp_name'];
            $nama_file   	 = $_FILES['fupload']['name'];
            $acak           = rand( 00, 99 );
            $nama_file_unik = $acak.$nama_file;

            $edit = $db->connection( "SELECT gambar FROM modul WHERE id_modul='$_POST[id_modul]'" );
            $tedit = $edit->fetch( PDO::FETCH_ASSOC );
            //unlink( "images/$tedit[gambar]" );

            if ( empty( $lokasi_file ) ) {
                $gambar = $_POST['gambar'];
            } else {
                UploadModul( $nama_file_unik );
                $gambar = $nama_file_unik;

                

            }
        }

        $nama_seo  = seo( trim( $_POST['nama'] ) );

        try {

            $datas = array(
                'nama' => $_POST['nama'],
                'deskripsi' => $_POST['deskripsi'],
                'gambar' => $gambar,
                'tgl_update' => date( 'Y-m-d' )
            );
            $db->update( 'modul', $datas, "id_modul = $_POST[id_modul]" );

            $msg->success('Modul berhasil di Update');

            echo "<script> window.location = '$hal'</script>";
        } catch( PDOException $e ) {
            echo 'Updated failed!';
            echo 'Error: ' . $e->getMessage();

            $this->pdo->rollback();

            return false;
        }
    }

?>