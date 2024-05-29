<?php
$default 	= "Journal Jogja";
$default2 	= "Journal Jogja";
$judul  	= "Journal Jogja";
$default3 	= "https://www.journaljogja.com";
$default4 	=  "https://journaljogja.com";
$seourl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$urlshare = $seourl ; 
if(empty($_GET['module']) ){
	$tseo = $db->connection("SELECT * FROM page WHERE id_page='0'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	$judul= "$seo[title]";
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];
	$imageshare = "images/default-share.jpg";
	$urlshare = $seourl ;

}
elseif(($_GET['module']=='blog')OR($_GET['module']=='paket')OR($_GET['module']=='produk')OR($_GET['module']=='news')OR($_GET['module']=='kontak')){
	$tseo = $db->connection("SELECT * FROM page WHERE id_page='$_GET[id]'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	if($seo['id_page'] != 0){
		$judul= "$seo[title]";
	}else{
		$judul= $seo['title'];
	}
	$keyword = "$seo[keyword]";
	$description = "$seo[description]";

	$imageshare = "images/default-share.jpg";
	$urlshare = $seourl ;
	
}
elseif($_GET['module']=='kategori'){
	$tseo = $db->connection("SELECT * FROM page WHERE id_page='0' ");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);

	$title = $db->connection("SELECT judul FROM kategori WHERE id_kategori='$_GET[id]' ")->fetchColumn();
	
	$judul= "$title | $default ";
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];

	$imageshare = "images/default-share.jpg";
	$urlshare = $seourl ;
}
elseif($_GET['module']=='tentang'){
	$tseo = $db->connection("SELECT * FROM page WHERE id_page='$_GET[id]'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$judul= "$seo[title]";
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];

	$imageshare = "images/default-share.jpg";
	$urlshare = $seourl ;
}
elseif($_GET['module']=='info'){
	$tseo = $db->connection("SELECT * FROM page WHERE id_page='$_GET[id]'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$judul= "$seo[title]";
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];

	$imageshare = "images/default-share.jpg";
		$urlshare = $seourl ;

}
elseif($_GET['module']=='rental'){
	$tseo = $db->connection("SELECT * FROM page WHERE id_page='$_GET[id]'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$judul= "$seo[title]";
	$keyword = 	$seo['keyword'];
	$description = 	$seo['description'];

	$imageshare = "images/default-share.jpg";
	$urlshare = $seourl ;
}elseif($_GET['module']=='detinfo'){
	$tseo = $db->connection("SELECT * FROM blog WHERE id_blog ='$_GET[id]'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	
	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$seo["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));
 

	$judul= "$seo[judul]";
	$keyword = $seo['keyword'];
	$description = $des2;

	$imageshare = "images/blog/sewa-mobil-".$seo['gambar'];
	$urlshare = $seourl ;


}elseif($_GET['module']=='detkategori'){
	$tseo = $db->connection("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);

	$hmm = $db->connection("SELECT * FROM page WHERE id_page= 3 ")->fetch(); 

	$judul= "$seo[judul]";
	$keyword = $hmm['keyword'];
	$description = $hmm['description'];

	$imageshare = "images/default-share.jpg";
		$urlshare = $seourl ;
}elseif($_GET['module']=='detmaterial'){
	$tseo = $db->connection("SELECT * FROM material WHERE id_material='$_GET[id]'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);

	//$hmm = $db->connection("SELECT * FROM page WHERE id_page= 3 ")->fetch(); 

	$judul= "dsadsa";
	$keyword = $seo['keyword'];
	$description = $seo['description'];

	$imageshare = "images/material/$seo[gambar]";
	$urlshare = $seourl ;
	
}elseif($_GET['module']=='dettour'){
	$tirl = $db->connection("SELECT id_tour,judul,judul_seo,keyword,gambar,deskripsi FROM tour WHERE id_tour='$_GET[id]'");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$des2";

	$imageshare = "images/tour/small/$imgname2-$ttirl[gambar]";
		$urlshare = $seourl ;
	
}elseif($_GET['module']=='detproduk'){
	$tirl = $db->connection("SELECT * FROM produk WHERE judul_seo='$_GET[seo]'");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/produk/$imgname2-$ttirl[gambar]";
		$urlshare = $seourl ;
	
}elseif($_GET['module']=='detblog'){
	$tirl = $db->connection("SELECT * FROM artikel WHERE id_artikel='$_GET[id]'");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/artikel/$imgname2-$ttirl[gambar]";
	$urlshare = $seourl ;
}elseif($_GET['module']=='detpage'){
	$tirl = $db->connection("SELECT * FROM page WHERE id_page='$_GET[id]'");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/default-share.jpg";
	$urlshare = $seourl ;
}elseif($_GET['module']=='detpromo'){
	$tirl = $db->connection("SELECT * FROM promo WHERE judul_seo='$_GET[seo]'");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/promo/$imgname2-$ttirl[gambar]";
	$urlshare = $seourl ;
}elseif($_GET['module']=='detlayanan'){
	$tirl = $db->connection("SELECT * FROM layanan WHERE id_layanan='$_GET[id]'");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/layanan/$imgname2-$ttirl[gambar]";
	$urlshare = $seourl ;

}elseif($_GET['module']=='newsdet'){
	$tirl = $db->connection("SELECT id_news,judul,judul_seo,keyword,gambar,deskripsi FROM news WHERE id_news='$_GET[id]'");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$des = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$ttirl["deskripsi"])));
	$des2 = substr($des,0,strrpos(substr($des,0,177)," "));

	$judul= "$ttirl[judul] | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$des2";

	$imageshare = "images/news/$imgname1-$ttirl[gambar]";
	$urlshare = $seourl ;

}elseif($_GET['module']=='about'){
	$tirl = $db->connection("SELECT * FROM page WHERE id_page='1'");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$judul= "$ttirl[title]";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/default-share.jpg";
		$urlshare = $seourl ;

}elseif($_GET['module']=='blog'){
	$tirl = $db->connection("SELECT * FROM page WHERE id_page='$_GET[id]'");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$judul= "blog | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/default-share.jpg";
	$urlshare = $seourl ;

}elseif($_GET['module']=='galeri'){
	$tirl = $db->connection("SELECT * FROM page WHERE id_page='$_GET[id]'");
	$ttirl = $tirl->fetch(PDO::FETCH_ASSOC);

	$judul= "Galeri | $default";
	$keyword = "$ttirl[keyword]";
	$description = "$ttirl[description]";

	$imageshare = "images/default-share.jpg";
		$urlshare = $seourl ;

}elseif($_GET['module']=='search'){
	$judul= "Search | $default";
	$keyword = "search $default";
	$description = "search $default";

	$imageshare = "images/default-share.jpg";
	$urlshare = $seourl ;

}elseif($_GET['module']=='carlist'){
	$tseo = $db->connection("SELECT judul, keyword, description FROM page WHERE id_page='5'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);

	$judul= "$seo[judul]";
	$keyword = "$seo[keyword]";
	$description = "$seo[description]";

	$imageshare = "images/default-share.jpg";

}elseif($_GET['module']=='pembelian' || $_GET['module']=='bookingPembelian'){
	$tseo = $db->connection("SELECT judul, keyword, description FROM page WHERE id_page='0'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);

	$judul= "Booking Pembelian";
	$keyword = "$seo[keyword]";
	$description = "$seo[description]";

	$imageshare = "images/default-share.jpg";

}else{
	$tseo = $db->connection("SELECT judul, keyword, description FROM page WHERE id_page='0'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);

	$judul= $default;
	$keyword = "$seo[keyword]";
	$description = "$seo[description]";

	$imageshare = "images/default-share.jpg";
		$urlshare = $seourl ;
}
?>

		<title><?php echo $judul; ?></title>
		<meta name="keywords" content="<?php echo $keyword; ?>">
		<meta name="description" content="<?php echo $description; ?>">
		<link rel="icon" type="image/x-icon" href="images/icon.jpg" />


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
