<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
session_name("CAKEPHP");
session_start();
// Load our autoloader & database
require_once BASEPATH.'database.php';

//Load helpers
require_once BASEPATH.'helper_base.php';
require_once BASEPATH.'helper_paging.php';
require_once BASEPATH.'helper_csrf.php';
require_once BASEPATH.'z_setting.php';
require_once BASEPATH.'fungsi_umum.php';
require_once BASEPATH.'fungsi_thumb.php';
require_once BASEPATH.'ImgCompressor.php';
require_once BASEPATH.'helper_email.php';
require_once BASEPATH.'helper_cart.php';
require_once BASEPATH.'helper_webp.php';
require_once BASEPATH.'flash_message.php';
require_once BASEPATH.'show_stat.php';

// Security for Form POST
$csrf = new CSRF();

// Instantiate the class Flash Message
$msg = new \Plasticbrain\FlashMessages\FlashMessages();

// Error Display
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
//$whoops->register();

// Initialize Cart object
$cart = new Cart([
    // Can add unlimited number of item to cart
    'cartMaxItem'      => 0,
    
    // Set maximum quantity allowed per item to 99
    'itemMaxQuantity'  => 99,
    
    // Do not use cookie, cart data will lost when browser is closed
    'useCookie'        => true,
  ]);

$totalKeranjang = $cart->getTotalItem();
$jmlItem = $cart->getTotalQuantity();


$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

// Create Router instance
$router = new \Bramus\Router\Router();

// Before Router Middleware
$router->before('GET', '/.*', function () {
    header('X-Powered-By: bramus/router');
});

// Create new Plates instance
$templates = new League\Plates\Engine(APPPATH);
$jmw       = new League\Plates\Engine(APPPATH.'admin');
$login     = new League\Plates\Engine(APPPATH.'admin/login');

// Module Setting
$sosmed             = $db->connection("SELECT * FROM social_media")->fetchAll();
$menu               = $db->connection("SELECT * FROM produk_k ")->fetchAll();
$layanan            = $db->connection("SELECT * FROM transportasi ")->fetchAll();
$tags               = $db->connection("SELECT * FROM produk_tag ")->fetchAll();
$service            = $db->connection("SELECT * FROM sizechart WHERE id_sizechart = 26 ")->fetchAll();
$cta                = $db->connection("SELECT * FROM page WHERE id_page = 3 ")->fetch();
$fta                = $db->connection("SELECT * FROM artikel ORDER BY RAND()  LIMIT 3 ")->fetchAll();
$subnavprofile      = $db->connection("SELECT * FROM subnavmenu WHERE id_navmenu = 1 ORDER BY id_subnavmenu")->fetchAll();
$subnavpelayanan    = $db->connection("SELECT * FROM subnavmenu WHERE id_navmenu = 2 ORDER BY id_subnavmenu")->fetchAll();
$sidebarlinks       = $db->connection("SELECT * FROM sidebarlinks ORDER BY id_link")->fetchAll();
$footerlinks        = $db->connection("SELECT * FROM footerlinks ORDER BY id_link")->fetchAll();
$slider             = $db->connection("SELECT * FROM slider ")->fetchAll();

$data = array(
    'namaweb'   => $namaweb,
    'deskrip'   =>$deskrip,
    'imgname1'  =>$imgname1
);
$templates->addData($data);
$jmw->addData($data);
$login->addData($data);
$templates->addData([
    'db'                => $db,
    'seo'               => '',
    'base_url'          => $base_url,
    'csrf'              => $csrf,
    'sosmed'            => $sosmed,
    'deskrip'           => $deskrip,
    'cta'               => $cta,
    'menus'             => $menu,
    'tags'              => $tags,
    'layanan'           => $layanan,
    'service'           => $service,
    'subnavprofile'     => $subnavprofile,
    'subnavpelayanan'   => $subnavpelayanan,
    'sidebarlinks'      => $sidebarlinks,
    'footerlinks'       => $footerlinks,
    'slider'            => $slider,
]);

$theme = $db->connection("SELECT * FROM theme")->fetchAll();
$jmw->addData(['tehe' => $theme, 'seo' => '', 'msg' => $msg]);



// Button Floating Whatsapp 
$textBtnWa = "Halo ".$namaweb.", Bisa minta informasi lebih lanjut?";

$stat = array(
    'pengunjung'        => $pengunjung,
    'totalpengunjung'   => $totalpengunjung['totalz'],
    'online'            => $pengunjungonline,
    'totalhits'         => $totalhits,
    'hits'              => $hits,
    'ip'                => $ip
);
$templates->addData(['textBtnWa' => $textBtnWa,'stat' => $stat,'totalKeranjang' => $totalKeranjang,'jmlItem' => $jmlItem]);