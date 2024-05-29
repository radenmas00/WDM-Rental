<?php
	//error_reporting(0);
	
	//session code unique
	$code = "khmi";

	$sql7 = $db->read("modul", "id_modul, deskripsi, gambar, jenis_modul", "status='On' ORDER BY id_modul ASC");
	foreach($sql7->fetchAll() as $tsql7) {
		if($tsql7['jenis_modul']!='Images'){
			$deskrip[$tsql7['id_modul']] = $tsql7['deskripsi'];
		}elseif($tsql7['jenis_modul']!='Video'){
			$deskrip[$tsql7['id_modul']] = $tsql7['gambar'];
		}else{
			$deskrip[$tsql7['id_modul']] = $tsql7['gambar'];
		}
	}
	$nmgweb 	= explode(",", $deskrip[0]);
	$ng1=$nmgweb[0];
	$ng2=$nmgweb[1];
	$ng3=$nmgweb[2];
	
	$namaweb  	= $ng1;
	$imgname1  	= $ng2;
	$imgname2  	= $ng3;
	$imgname3  	= $ng3;
	
?>