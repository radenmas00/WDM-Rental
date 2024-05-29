<?php
	
	// remove modul
	if ($act=='remove'){
		
        $db->delete('booking', "id_booking = '$id' ");
		
		echo "<script>alert('Pesan Berhasil Dihapus'); window.location = '$hal'</script>";
	}

?>
