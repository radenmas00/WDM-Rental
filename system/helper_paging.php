<?php
class pagingAll{
	function cariPosisi($batas,$id){
		if(empty($id)){
			$posisi=0;
			$id=1;
		}else{
			$posisi = ($id-1) * $batas;
		}
		return $posisi;
	}

	// Fungsi untuk menghitung total page
	function jmlhalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3 (untuk admin)
	function navHalaman($halaman_aktif, $jmlhalaman,$url){
		$link_halaman = "";

		// Link ke halaman pertama (first) dan sebelumnya (prev)
		if($halaman_aktif == 1){
			
			$link_halaman .= "<span class='pages'>Page $halaman_aktif of $jmlhalaman:</span>";
		}elseif($halaman_aktif > 1){
			$prev = $halaman_aktif-1;
			$link_halaman .= "<span class='pages'>Page $halaman_aktif of $jmlhalaman:</span>
							<a href='$url-page-1'><i class='icofont-stylish-left' aria-hidden='true'></i> First</a> 
							<a href='$url-page-$prev' title='Previous'><i class='ci-arrow-left' aria-hidden='true'></i></a> ";
		}else{ 
			$link_halaman .= "<span class='pages'>Page $halaman_aktif of $jmlhalaman:</span>
							<i class='icofont-stylish-left' aria-hidden='true'></i> First < Prev | ";
		}

		// Link halaman 1,2,3, ...
		$angka = ($halaman_aktif > 3 ? " ... " : " "); 
		for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
			if ($i < 1)
				continue;
				$angka .= "<a href=$url-page-$i>$i</a> ";
			}
			  $angka .= " <strong class='current-pag'><b>$halaman_aktif</b></strong>";
			  
			for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
			if($i > $jmlhalaman)
			  break;
			  $angka .= "<a href=$url-page-$i>$i</a> ";
			}
			  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... <a href=$url-page-$jmlhalaman>$jmlhalaman</a> " : " ");

		$link_halaman .= "$angka";

		// Link ke halaman berikutnya (Next) dan terakhir (Last) 
		if($halaman_aktif < $jmlhalaman){
			$next = $halaman_aktif+1;
			$link_halaman .= " <a href='$url-page-$next' title='Next'><i class='ci-arrow-right' aria-hidden='true'></i></i></a>
							 <a href='$url-page-$jmlhalaman'>Last </a>
							 ";
		}else{
			$link_halaman .= "";
		}
		return $link_halaman;
	}
}

class pagingPortofolio{
	function cariPosisi($batas,$id){
		if(empty($id)){
			$posisi=0;
			$id=1;
		}else{
			$posisi = ($id-1) * $batas;
		}
		return $posisi;
	}

	// Fungsi untuk menghitung total page
	function jmlhalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3 (untuk admin)
	function navHalaman($halaman_aktif, $jmlhalaman,$url){
		$link_halaman = "";
		// Link ke halaman berikutnya (Next) dan terakhir (Last) 
		if($halaman_aktif < $jmlhalaman){
			$next = $halaman_aktif+1;
			$link_halaman .= " <a href='$url-page-$next' title='Next'><div class='portfolio-item  next-btn'><h2>Next</h2></div></a>";
		}else{
			$link_halaman .= "";
		}
		return $link_halaman;
	}
}

class pagingGallery{
	function cariPosisi($batas){
		if(empty($_GET['page'])){
			$posisi=0;
			$_GET['page']=1;
		}else{
			$posisi = ($_GET['page']-1) * $batas;
		}
		return $posisi;
	}

	// Fungsi untuk menghitung total page
	function jmlhalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3 (untuk admin)
	function navHalaman($halaman_aktif, $jmlhalaman){
		$link_halaman = "";

		// Link ke halaman pertama (first) dan sebelumnya (prev)
		if($halaman_aktif == 1){
			
			$link_halaman .= "<span class='pages'>Page $halaman_aktif of $jmlhalaman:</span>";
		}elseif($halaman_aktif > 1){
			$prev = $halaman_aktif-1;
			$link_halaman .= "<span class='pages'>Page $halaman_aktif of $jmlhalaman:</span>
							<a href='galeri-page-1'><i class='icofont-stylish-left' aria-hidden='true'></i> First</a> 
							<a href='galeri-page-$prev' title='Previous'><i class='icofont-stylish-left' aria-hidden='true'></i></a> ";
		}else{ 
			$link_halaman .= "<span class='pages'>Page $halaman_aktif of $jmlhalaman:</span>
							<i class='icofont-stylish-left' aria-hidden='true'></i> First < Prev | ";
		}

		// Link halaman 1,2,3, ...
		$angka = ($halaman_aktif > 3 ? " ... " : " "); 
		for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
			if ($i < 1)
				continue;
				$angka .= "<a href=galeri-page-$i>$i</a> ";
			}
			  $angka .= " <strong class='current-pag'><b>$halaman_aktif</b></strong>";
			  
			for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
			if($i > $jmlhalaman)
			  break;
			  $angka .= "<a href=galeri-page-$i>$i</a> ";
			}
			  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... <a href=galeri-page-$jmlhalaman>$jmlhalaman</a> " : " ");

		$link_halaman .= "$angka";

		// Link ke halaman berikutnya (Next) dan terakhir (Last) 
		if($halaman_aktif < $jmlhalaman){
			$next = $halaman_aktif+1;
			$link_halaman .= " <a href='galeri-page-$next' title='Next'><i class='ci-arrow-right' aria-hidden='true'></i></i></a>
							 <a href='galeri-page-$jmlhalaman'>Last <i class='ci-arrow-right' aria-hidden='true'></i></a>
							 ";
		}else{
			$link_halaman .= "";
		}
		return $link_halaman;
	}
}

class pagingProduk{
	function cariPosisi($batas){
		if(empty($_GET['page'])){
			$posisi=0;
			$_GET['page']=1;
		}else{
			$posisi = ($_GET['page']-1) * $batas;
		}
		return $posisi;
	}

	// Fungsi untuk menghitung total page
	function jmlhalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3 (untuk admin)
	function navHalaman($halaman_aktif, $jmlhalaman){
		$link_halaman = "";

		// Link ke halaman pertama (first) dan sebelumnya (prev)
		if($halaman_aktif == 1){
			
			$link_halaman .= "<span class='pages'>Page $halaman_aktif of $jmlhalaman:</span>";
		}elseif($halaman_aktif > 1){
			$prev = $halaman_aktif-1;
			$link_halaman .= "<span class='pages'>Page $halaman_aktif of $jmlhalaman:</span>
							<a href='produk-page-1'><i class='icofont-stylish-left' aria-hidden='true'></i> First</a> 
							<a href='produk-page-$prev' title='Previous'><i class='icofont-stylish-left' aria-hidden='true'></i></a> ";
		}else{ 
			$link_halaman .= "<span class='pages'>Page $halaman_aktif of $jmlhalaman:</span>
							<i class='icofont-stylish-left' aria-hidden='true'></i> First < Prev | ";
		}

		// Link halaman 1,2,3, ...
		$angka = ($halaman_aktif > 3 ? " ... " : " "); 
		for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
			if ($i < 1)
				continue;
				$angka .= "<a href=produk-page-$i>$i</a> ";
			}
			  $angka .= " <strong class='current-pag'><b>$halaman_aktif</b></strong>";
			  
			for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
			if($i > $jmlhalaman)
			  break;
			  $angka .= "<a href=produk-page-$i>$i</a> ";
			}
			  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... <a href=produk-page-$jmlhalaman>$jmlhalaman</a> " : " ");

		$link_halaman .= "$angka";

		// Link ke halaman berikutnya (Next) dan terakhir (Last) 
		if($halaman_aktif < $jmlhalaman){
			$next = $halaman_aktif+1;
			$link_halaman .= " <a href='produk-page-$next' title='Next'></i></a>
							 <a href='produk-page-$jmlhalaman'>Last </a>
							 ";
		}else{
			$link_halaman .= "";
		}
		return $link_halaman;
	}
}

?>