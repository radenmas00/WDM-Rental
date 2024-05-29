<?php
	$tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
	$waktu   = time(); // 
	$ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
	
	$bataswaktu       = time() - 300;
	$edit1 = $db->connection("SELECT COUNT(*) FROM statistik WHERE tanggal='$tanggal' GROUP BY ip ASC")->fetchColumn();
	//$edit1 = $db->connection("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip ASC");
	$edit2 = $db->connection("SELECT COUNT(hits) as totalz FROM statistik");
	$edit3 = $db->connection("SELECT COUNT(hits) FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal ASC")->fetchColumn();
	// $edit3 = $db->connection("SELECT hits FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal ASC");
	$edit4 = $db->connection("SELECT SUM(hits) as totalz FROM statistik");
	$edit5 = $db->connection("SELECT * FROM statistik WHERE online > '$bataswaktu'");
	
	//die($edit1);
	$row_count1 = $edit1;
	$row_count3 = $edit3;
	$row_count5 = $edit3;

	$pengunjung       = $row_count1;
	$totalpengunjung  = $edit2->fetch(PDO::FETCH_ASSOC);
	$hits             = $row_count3;
	$totalhits        = $edit4->fetch(PDO::FETCH_ASSOC);
	$tothitsgbr       = $edit4->fetch(PDO::FETCH_ASSOC);
	$online = $row_count5;


	$pengunjung = $db->connection("SELECT COUNT(*) FROM statistik WHERE tanggal='$tanggal' GROUP BY ip ASC")->fetchColumn();
    $totalpengunjung = $db->connection("SELECT COUNT(hits) as totalz FROM statistik")->fetch();
    $pengunjungonline = $db->connection("SELECT COUNT(hits) FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal ASC")->fetchColumn();
    $totalhits = $db->connection("SELECT SUM(hits) FROM statistik")->fetchColumn();
    $hits = $db->connection("SELECT SUM(hits) FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal DESC LIMIT 1")->fetchColumn();

?>