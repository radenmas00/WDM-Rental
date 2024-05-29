<?php 

header("Content-Type: application/xml; charset=utf-8");

//sitemap.php
require_once __DIR__.'/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
include "system/database.php";
include "system/fungsi_engtgl.php";

$base_url = "https://hidrorentcartourjogja.com/";
echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 
echo '<urlset  xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

    echo "\t<url>" . PHP_EOL;
    echo "\t\t<loc>".$base_url.'</loc>' . PHP_EOL;
    echo "\t\t<changefreq>weekly</changefreq>" . PHP_EOL;
    echo "\t\t<priority>1.00</priority>" . PHP_EOL;
    echo "\t</url>" . PHP_EOL;
    
    
$lsosmed = $db->connection("SELECT * FROM artikel ");
while($row = $lsosmed->fetch(PDO::FETCH_ASSOC)){
	$title = $row["judul_seo"]."-".$row['id_artikel'];
	$jdl_seo = preg_replace("/\r|\n/", "", $title);
	
    echo "\t<url>" . PHP_EOL;
    echo "\t\t<loc>".$base_url.'blog-'.$jdl_seo.'</loc>' . PHP_EOL;
    echo "\t\t<changefreq>weekly</changefreq>" . PHP_EOL;
    echo "\t\t<lastmod>". $row["tgl"] .'</lastmod>' . PHP_EOL;
    echo "\t\t<priority>0.80</priority>" . PHP_EOL;
    echo "\t</url>" . PHP_EOL;
}

/*
$lsosmed = $db->connection("SELECT * FROM packages ");
while($row = $lsosmed->fetch(PDO::FETCH_ASSOC)){
	$title = $row["judul_seo"]."-".$row['id_property'];
	$jdl_seo = $row['judul_seo'];
	
    echo "\t<url>" . PHP_EOL;
    echo "\t\t<loc>".$base_url.'trip/'.$jdl_seo.'/</loc>' . PHP_EOL;
    echo "\t\t<changefreq>weekly</changefreq>" . PHP_EOL;
    echo "\t\t<lastmod>". $row["tgl"] .'</lastmod>' . PHP_EOL;
    echo "\t\t<priority>0.80</priority>" . PHP_EOL;
    echo "\t</url>" . PHP_EOL;
}

*/

?>

</urlset>
