<?php
$default 	= "HIDRO RENT CAR TOUR JOGJA";
$default2 	= "HIDRO RENT CAR TOUR JOGJA";
$judul  	= "HIDRO RENT CAR TOUR JOGJA";
$default3 	= "https://www.hidrorentcartourjogja.com";
$default4 	= "https://hidrorentcartourjogja.com";
$seourl     = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$urlshare   = $seourl ; 
if($seo=='home' ){
	$tseo = $db->connection("SELECT * FROM page WHERE id_page='1' ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	$judul= "$seo[title]   ";
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];
	$imageshare = "images/default-share.png";
	$urlshare = $seourl ;
}
elseif($seo=='about'){
	$tseo = $db->connection("SELECT * FROM page WHERE id_page='1' ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$judul= "$seo[title]  ";
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];

	$imageshare = "images/default-share.png";
	$urlshare = $seourl ;
}
elseif($seo=='galeri'){
	$tseo = $db->connection("SELECT * FROM page WHERE id_page='6' ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$judul= "$seo[title]";
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];

	$imageshare = "images/default-share.png";
	$urlshare = $seourl ;
}
elseif($seo=='artikel'){
	$tseo = $db->connection("SELECT * FROM page WHERE id_page='7' ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$judul= "$seo[title]";
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];

	$imageshare = "images/default-share.png";
	$urlshare = $seourl ;
}
elseif($seo=='produk'){
	$tseo = $db->connection("SELECT * FROM page WHERE id_page='4' ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$judul= "$seo[title]  | $default ";
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];

	$imageshare = "images/default-share.png";
	$urlshare = $seourl ;
}
elseif($seo=='harga'){
	$tseo = $db->connection("SELECT * FROM page WHERE id_page= 12 ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC); 
	
	$judul= "$seo[title] ";
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];

	$imageshare = "images/default-share.png";
		$urlshare = $seourl ;

}elseif($seo=='hubungi'){
	$tseo = $db->connection("SELECT * FROM page WHERE id_page= 8 ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC); 
	
	$judul= "$seo[title] ";
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];

	$imageshare = "images/default-share.png";
		$urlshare = $seourl ;

}
elseif($seo=='detCat'){
	$tseo = $db->connection("SELECT * FROM produk_k WHERE id_produk_k = $id ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC); 
	$judul= "$seo[judul] | $default";
    $gbr =  $seo['gambar'];
	$tseo = $db->connection("SELECT * FROM page WHERE id_page= 1 ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC); 
	
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];

	$imageshare = "images/produk_k/$gbr";
	$urlshare = $seourl ;

}
elseif($seo=='sub'){
	$tseo = $db->connection("SELECT * FROM produk_sub_kategori WHERE id_produk_sub_kategori = $id ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC); 
	$judul= "$seo[judul] | $default";

	$tseo = $db->connection("SELECT * FROM page WHERE id_page= 1 ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC); 
	
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];

	$imageshare = "images/default-share.png";
	$urlshare = $seourl ;

}
elseif($seo=='detpackage'){
	$tseo = $db->connection("SELECT * FROM packages WHERE id_packages = $id_seo ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC); 
	
	$judul= "$seo[judul] | $default";

	//$tseo = $db->connection("SELECT * FROM page WHERE id_page= 1 ");
	//$seo = $tseo->fetch(PDO::FETCH_ASSOC); 
	
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];

	$imageshare = "images/packages/$seo[gambar]";
	$urlshare = $seourl ;

}
elseif($seo=='detkategori'){
	$tseo = $db->connection("SELECT * FROM produk_kategori WHERE id_produk_kategori = $id ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC); 
	if($seo['title'] == ''){
	    $seo['title'] = $seo['judul'] ;
	}
	$judul= "$seo[title] | $default";

	//$tseo = $db->connection("SELECT * FROM page WHERE id_page= 1 ");
	//$seo = $tseo->fetch(PDO::FETCH_ASSOC); 
	
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];

	$imageshare = "images/default-share.png";
	$urlshare = $seourl ;

}
elseif($seo=='contact'){
	$tseo = $db->connection("SELECT * FROM page WHERE id_page= 8 ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$judul= "$seo[title]  | $default ";
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];

	$imageshare = "images/default-share.png";
	$urlshare = $seourl ;
}elseif($seo=='referensi'){
	$tseo = $db->connection("SELECT * FROM referensi WHERE id_referensi = $id ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	
	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$seo["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));
 

	$judul= "$seo[judul] | $default";
	$keyword = $seo['keyword'];
	$description = $des2;

	$imageshare = "images/referensi/".$seo['gambar'];
	$urlshare = $seourl ;

	
}elseif($seo=='detalumina'){
	$tirl = $db->read('alumina', '*', "id_alumina = $id_seo ");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/alumina/$ttirl[gambar]";
	$urlshare = $seourl ;
}elseif($seo=='detproduk'){
	$tirl = $db->read('produk', '*', "id_produk = $id_seo ");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/produk/$ttirl[gambar]";
	$urlshare = $seourl ;
}elseif($seo=='detartikel'){
	$tirl = $db->connection("SELECT * FROM artikel WHERE id_artikel= $id_seo ");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/artikel/$ttirl[gambar]";
	$urlshare = $seourl ;
}elseif($seo=='detpaketwisata'){
	$tirl = $db->connection("SELECT * FROM paketwisata WHERE id_paketwisata= $id_seo ");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/artikel/$ttirl[gambar]";
	$urlshare = $seourl ;
}elseif($seo=='detproperti'){
	$tirl = $db->connection("SELECT * FROM properti WHERE id_properti= $id_seo ");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/properti/$ttirl[gambar]";
	$urlshare = $seourl ;
}elseif($seo=='detpenerbit'){
	$tirl = $db->connection("SELECT * FROM penerbit WHERE id_penerbit= $id_seo ");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/penerbit/$ttirl[gambar]";
	$urlshare = $seourl ;
}elseif($seo=='dettraining'){
	$tirl = $db->connection("SELECT * FROM process WHERE id_process= $id_seo ");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/process/$ttirl[gambar]";
	$urlshare = $seourl ;
}elseif($seo=='trainingdet'){
	$tirl = $db->connection("SELECT * FROM process_kat WHERE id_process_kat= $id_seo ");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/process_kat/$ttirl[gambar]";
	$urlshare = $seourl ;
}
elseif($seo=='detkonsul'){
	$tirl = $db->connection("SELECT * FROM sizechart WHERE id_sizechart= $id_seo ");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[nama] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/sizechart/$ttirl[gambar]";
	$urlshare = $seourl ;
}elseif($seo=='detproduk'){
	$tirl = $db->connection("SELECT * FROM produk WHERE id_produk= $id_seo ");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/produk/$ttirl[gambar]";
	$urlshare = $seourl ;
}elseif($seo=='detpage'){
	$tirl = $db->connection("SELECT * FROM page WHERE id_page = $id ");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/default-share.png";
	$urlshare = $seourl ;
}elseif($seo=='subpage'){
	$tirl = $db->connection("SELECT * FROM subnavmenu WHERE id_subnavmenu = $id ");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["konten"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[nama_submenu] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/default-share.png";
	$urlshare = $seourl ;
}else{
	$tseo = $db->connection("SELECT * FROM page WHERE id_page='1'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);

	$judul= "$seo[title]";
	$keyword = "$seo[keyword]";
	$description = "$seo[description]";

	$imageshare = "images/default-share.png";
		$urlshare = $seourl ;
}

?>


<title><?php echo $judul; ?></title>
<meta name="keywords" content="<?php echo $keyword; ?>">
<meta name="description" content="<?php echo $description; ?>">

<meta name="googlebot" content="index,follow">
<meta name="googlebot-news" content="index,follow">
<meta name="robots" content="index,follow">
<meta name="Slurp" content="all">
<meta property="fb:app_id" content="501046580289991">
<meta property="og:title" content="<?php echo $judul; ?>">
<meta property="og:type" content="article">
<meta property="og:site_name" content="<?php echo $default; ?>">

<meta name="image_src" content="<?php echo $default3 ?>/<?php echo $imageshare ?>">
<meta property="og:image" content="<?php echo $default3 ?>/<?php echo $imageshare ?>">
<meta property="og:image:alt" content="<?php echo $default3 ?>/<?php echo $imageshare ?>">
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="620" />
<meta property="og:image:height" content="413" />
<meta property="og:url" content="<?php echo $urlshare ?>">

<link rel="canonical" href="<?php echo $urlshare ?>">

<meta property="og:description" content="<?php echo $description; ?>">
<meta name="news_keywords" content="<?php echo $keyword; ?>">
<link rel="shortlink" href="<?php echo $default3 ?>">