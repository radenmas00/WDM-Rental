<?php

use \Gumlet\ImageResize;

if ($act == 'update') {

    $slug = seo($_POST['nama_submenu']);

    try {
        $datas = array(
            // 'id_navmenu'    => $_POST['id_navmenu'],
            'nama_submenu'  => $_POST['nama_submenu'],
            'tipe_submenu'  => $_POST['tipe_submenu'],
            'judul_konten'  => $_POST['judul_konten'],
            'slug'          => $slug,
            'konten'        => $_POST['konten'],
            'link'          => $_POST['link'],
            'keyword'       => $_POST['keyword'],
            'description'   => $_POST['description']
        );

        $saved = $db->update('subnavmenu', $datas, "id_subnavmenu = '$_POST[id_subnavmenu]' ");
        echo "<script>alert('$hal Berhasil diedit'); window.location = '$hal-edit-$_POST[id_subnavmenu]'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('$hal Gagal diedit!'); window.location = '$hal-edit-$_POST[id_subnavmenu]'</script>";
    }
} elseif ($act == 'add') {

    $slug = seo($_POST['nama_submenu']);

    try {
        $datas = array(
            'id_navmenu'    => $_POST['id_navmenu'],
            'nama_submenu'  => $_POST['nama_submenu'],
            'tipe_submenu'  => $_POST['tipe_submenu'],
            'slug'          => $slug,
        );

        $saved = $db->insert('subnavmenu', $datas);
        $insertId = $db->lastId();

        $msg->success("$hal berhasil ditambah");
        echo "<script>window.location = '$hal-edit-$insertId'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('$hal Gagal diedit!'); window.location = '$hal'</script>";
    }
} elseif ($act == 'remove') {
    $datahapus = $db->connection("SELECT * FROM subnavmenu WHERE id_subnavmenu = $id")->fetch();
    $menu = $db->connection("SELECT * FROM navmenu WHERE id_navmenu = $datahapus[id_navmenu]")->fetch();
    if ($datahapus['tingkatan'] == 'tk') {
        $hal = "tk-guru";
    } elseif ($datahapus['tingkatan'] == 'sd') {
        $hal = "sd-guru";
    } elseif ($datahapus['tingkatan'] == 'smp') {
        $hal = "smp-guru";
    } elseif ($datahapus['tingkatan'] == 'sma') {
        $hal = "sma-guru";
    } elseif ($datahapus['tingkatan'] == 'smk') {
        $hal = "smk-guru";
    }
    
    $del = $db->delete('subnavmenu', "id_subnavmenu='$id'");
    echo "<script>alert('$hal Berhasil dihapus'); window.location = '".strtolower($menu['nama_menu'])."-subnavmenu'</script>";
}
