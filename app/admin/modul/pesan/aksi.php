<?php
	
	// remove modul
	if ($act=='remove'){
		
        $db->delete('contact', "id_contact = '$id' ");
		
		echo "<script>alert('Pesan Berhasil Dihapus'); window.location = '$hal'</script>";
	}

?>
