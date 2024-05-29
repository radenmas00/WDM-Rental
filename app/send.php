<?php
include "../system/config.php";
include "../system/fungsi_thumb.php";
include "../system/z_setting.php";

if(empty($_POST['nama'])) {
    echo "<script>window.alert('Lengkapi Data Anda !'); window.location(history.back(-1))</script>";
}else{
    try{				
        $datas = array(
            'nama' => $_POST["nama"],
            'telp' => $_POST["telp"],
            'alamat' => $_POST["alamat"],
            'rekening' => $_POST["reke"],
            'email' => $_POST["mail"],
            'provinsi' => $_POST["prov"],
            'kota' => $_POST["kota"],
            'kurir' => $_POST["kurir"],
            'level_ongkir' => $_POST["lvl"],
            'barang' => $_POST["barang"],
            'biaya' => $_POST["biaya"],
            'ongkir' => $_POST["ongkir"],
            'total_biaya' => $_POST["total_biaya"],
            'catatan' => $_POST["catatan"]
        );
        $saved = $db->insert('orderan', $datas);

        echo "berhasil";

    }catch(PDOException $e){
        echo "<script>window.alert('orderan Gagal ditambah!'); window.location(history.back(-1))</script>";
    }
}

?>