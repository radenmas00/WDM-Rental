<?php

use \Gumlet\ImageResize;
// Update modul
if ($act == 'update') {
    try {
        $datas = array(
            'nama' => $_POST["nama"],
            'link' => $_POST["link"],
        );
        $db->update("footerlinks", $datas, "id_link= '$_POST[id_link]' ");

        $msg->info('Data berhasil diubah');
        echo "<script>window.location = '$hal-edit-$_POST[id_link]'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Sidebar Links Gagal diedit!'); window.location = '$hal-edit-$_POST[id_link]'</script>";
    }
}

// add modul
elseif ($act == 'add') {
    try {

        $datas = array(
            'nama' => $_POST["nama"],
            'link' => $_POST["link"],
        );
        $saved = $db->insert('footerlinks', $datas);
        $insertId = $db->lastId();

        $msg->success('Sidebar Links Berhasil ditambah');
        echo "<script>window.location = '$hal'</script>";
    } catch (PDOException $e) {
        echo "$e";
    }
}

// remove modul
elseif ($act == 'remove') {
    $del = $db->delete("footerlinks", "id_link=$id ");
    $msg->info('Data Berhasil dihapus');
    echo "<script>window.location = '$hal'</script>";
}
