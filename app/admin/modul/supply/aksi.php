<?php


// Update modul
if ($act == 'update') {
    try {
        $datas = array(
            'variable_name'         => $_POST["variable_name"],
            'group_supply'          => $_POST["group_supply"],
            'definition'            => $_POST["definition"],
            'price'                 => $_POST["price"],
            'year_coverage'         => $_POST["year_coverage"],
            'availability_status'   => $_POST["availability_status"],
        );
        $db->update('supply', $datas, "id_supply = $_POST[id_supply] ");
        $msg->info('supply berhasil diedit');
        echo "<script>window.location = '$hal'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Data Gagal diedit!'); window.location = '$hal'</script>";
    }
}

// add modul
elseif ($act == 'add') {
    try {
        $datas = array(
            'variable_name'         => $_POST["variable_name"],
            'group_supply'          => $_POST["group_supply"],
            'definition'            => $_POST["definition"],
            'price'                 => $_POST["price"],
            'year_coverage'         => $_POST["year_coverage"],
            'availability_status'   => $_POST["availability_status"],
        );
        $saved = $db->insert('supply', $datas);
        $msg->success('supply berhasil ditambah');
        echo "<script> window.location = '$hal'</script>";

    } catch (PDOException $e) {
        echo "<script>window.alert('Data Gagal ditambah!'); window.location(history.back(-1))</script>";
    }
}

// remove modul
elseif ($act == 'remove') {
    $db->delete("supply", "id_supply='$id' ");
    $msg->info('supply berhasil dihapus');
    echo "<script>window.location = '$hal'</script>";
}