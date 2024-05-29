<?php
error_reporting(0);

// error_reporting(E_ALL);
// ini_set('display_errors', '1');

$application_folder = 'app';
$system_path = 'system';
$admin_folder = 'admin';

if (($_temp = realpath($system_path)) !== FALSE) {
    $system_path = $_temp . DIRECTORY_SEPARATOR;
}

// Path to the system directory
define('APPPATH', $application_folder . DIRECTORY_SEPARATOR);
define('BASEPATH', $system_path);
define('ADMPATH', $admin_folder . DIRECTORY_SEPARATOR);

require_once __DIR__ . '/vendor/autoload.php';

use JasonGrimes\Paginator;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
require_once BASEPATH . 'jogjamediaweb.php';


// Custom 404 Handler
$router->set404(function () use ($base_url) {
    header('location:  ' . $base_url . '404');
});


/*
 * ------------------------------------------------------
 *  Router Front End
 * ------------------------------------------------------
 */

$router->get('/', function () use ($templates, $db) {
    // SEO
    $templates->addData(['seo' => '', 'menu' => 'home', 'page' => 'home']);

    $slider             = $db->connection("SELECT * FROM slider ")->fetchAll();
    $welcome            = $db->connection("SELECT * FROM page WHERE id_page = 1 ")->fetch();
    $produklayanan      = $db->connection("SELECT * FROM page WHERE id_page = 2 ")->fetch();
    $testimoni          = $db->connection("SELECT * FROM testimoni")->fetchAll();
    $submenulinks       = $db->connection("SELECT * FROM submenulinks")->fetchAll();
    $headerpaket        = $db->connection("SELECT * FROM page WHERE id_page = 7 ")->fetch();
    $paketwisata        = $db->connection("SELECT * FROM paketwisata")->fetchAll();
    $headerdriver       = $db->connection("SELECT * FROM page WHERE id_page = 4 ")->fetch();
    $headerallin        = $db->connection("SELECT * FROM page WHERE id_page = 5 ")->fetch();
    $headerrental       = $db->connection("SELECT * FROM page WHERE id_page = 6 ")->fetch();
    $kendaraan          = $db->connection("SELECT * FROM kendaraan WHERE unggulan = 'ya'")->fetchAll();
    $kendaraan2         = $db->connection("SELECT * FROM kendaraan2 WHERE unggulan = 'ya'")->fetchAll();
    $kendaraan3         = $db->connection("SELECT * FROM kendaraan3 WHERE unggulan ='ya'")->fetchAll();
    $gallery            = $db->connection("SELECT * FROM gallery")->fetchAll();
    $artikelterbaru     = $db->connection("SELECT * FROM artikel ORDER BY tgl DESC LIMIT 1")->fetch();
    $idartikelterbaru   = $artikelterbaru['id_artikel'];
    $artikel            = $db->connection("SELECT * FROM artikel WHERE id_artikel != '$idartikelterbaru' ORDER BY tgl DESC LIMIT 3")->fetchAll();
    $kontak             = $db->read('page', '*', "id_page = 9 ")->fetch(PDO::FETCH_ASSOC);

    $data = array(
        'slider'            => $slider,
        'welcome'           => $welcome,
        'testimoni'         => $testimoni,
        'produklayanan'     => $produklayanan,
        'headerpaket'       => $headerpaket,
        'paketwisata'       => $paketwisata,
        'headerdriver'      => $headerdriver,
        'headerallin'       => $headerallin,
        'headerrental'      => $headerrental,
        'kendaraan'         => $kendaraan,
        'kendaraan2'        => $kendaraan2,
        'kendaraan3'        => $kendaraan3,
        'gallery'           => $gallery,
        'submenulinks'      => $submenulinks,
        'artikelterbaru'    => $artikelterbaru,
        'artikel'           => $artikel,
        'kontak'            => $kontak,
    );

    echo $templates->render('home', $data);
});

$router->get('/profile', function () use ($templates, $db) {
    // SEO
    $templates->addData(['seo' => 'detpage', 'id' => 10, 'menu' => 'home', 'page' => 'profile']);

    $welcome    = $db->connection("SELECT * FROM page WHERE id_page = 10 ")->fetch();

    $data = array(
        'welcome'   => $welcome,
    );

    echo $templates->render('profile', $data);
});

$router->get('/rentaldriver', function () use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 4, 'page' => 'rentaldriver', 'menu' => 'rental']);
    $welcome        = $db->connection("SELECT * FROM page WHERE id_page = 4 ")->fetch();
    $kendaraan      = $db->connection("SELECT * FROM kendaraan2 ORDER BY id_kendaraan ASC")->fetchAll();
    $jmlkendaraan   = count($kendaraan);

    echo $templates->render('rentaldriver', [
        'welcome'       => $welcome,
        'kendaraan'     => $kendaraan,
        'jmlkendaraan'  => $jmlkendaraan,
    ]);
});

$router->get('/rentalallin', function () use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 5, 'page' => 'rentalallin', 'menu' => 'rental']);
    $welcome        = $db->connection("SELECT * FROM page WHERE id_page = 5 ")->fetch();
    $kendaraan      = $db->connection("SELECT * FROM kendaraan3 ORDER BY id_kendaraan ASC")->fetchAll();
    $jmlkendaraan   = count($kendaraan);

    echo $templates->render('rentalallin', [
        'welcome'       => $welcome,
        'kendaraan'     => $kendaraan,
        'jmlkendaraan'  => $jmlkendaraan,
    ]);
});

$router->get('/rentallepaskunci', function () use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 6, 'page' => 'rentallepaskunci', 'menu' => 'rental']);
    $welcome        = $db->connection("SELECT * FROM page WHERE id_page = 6 ")->fetch();
    $kendaraan      = $db->connection("SELECT * FROM kendaraan ORDER BY id_kendaraan ASC")->fetchAll();
    $jmlkendaraan   = count($kendaraan);

    echo $templates->render('rental', [
        'welcome'       => $welcome,
        'kendaraan'     => $kendaraan,
        'jmlkendaraan'  => $jmlkendaraan,
    ]);
});

$router->get('/rental-(.*)-(\d+)', function ($slug, $id) use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detartikel', 'id_seo' => $id, 'page' => 'rental', 'menu' => 'produklayanan']);

    $datas = $db->read('artikel', '*', "id_artikel = '$id' ")->fetch(PDO::FETCH_ASSOC);
    $artikel = $db->connection("SELECT * FROM artikel WHERE id_artikel != $id AND tgl <= CURDATE() ORDER BY tgl DESC, id_artikel DESC LIMIT 4 ")->fetchAll();
    $dilihat = $datas['dilihat'] + 1;
    $db->update(" artikel", array('dilihat' => $dilihat), "id_artikel = $datas[id_artikel]");

    echo $templates->render('detartikel', ['data' => $datas, 'artikel' => $artikel]);
});

$router->get('/paketwisata', function () use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 7, 'page' => 'paketwisata', 'menu' => 'produklayanan']);
    $welcome        = $db->connection("SELECT * FROM page WHERE id_page = 7 ")->fetch();
    $paketwisata      = $db->connection("SELECT * FROM paketwisata ORDER BY id_paketwisata ASC")->fetchAll();
    $jmlpaketwisata   = count($paketwisata);

    echo $templates->render('paketwisata', [
        'welcome'       => $welcome,
        'paketwisata'     => $paketwisata,
        'jmlpaketwisata'  => $jmlpaketwisata,
    ]);
});

$router->get('/paketwisata-(.*)-(\d+)', function ($slug, $id) use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detpaketwisata', 'id_seo' => $id, 'page' => 'paketwisata']);

    $datas = $db->read('paketwisata', '*', "id_paketwisata = '$id' ")->fetch(PDO::FETCH_ASSOC);
    $paketwisata = $db->connection("SELECT * FROM paketwisata WHERE id_paketwisata != $id AND tgl <= CURDATE() ORDER BY tgl DESC, id_paketwisata DESC ")->fetchAll();

    echo $templates->render('detpaketwisata', ['data' => $datas, 'paketwisata' => $paketwisata]);
});

$router->get('/properti', function () use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 4, 'page' => 'properti', 'menu' => 'produklayanan']);
    $welcome        = $db->connection("SELECT * FROM page WHERE id_page = 4 ")->fetch();
    $properti       = $db->connection("SELECT * FROM properti ORDER BY tgl DESC")->fetchAll();
    $jmlproperti    = count($properti);

    echo $templates->render('properti', [
        'welcome'       => $welcome,
        'properti'      => $properti,
        'jmlproperti'   => $jmlproperti,
    ]);
});

$router->get('/properti-(.*)-(\d+)', function ($slug, $id) use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detproperti', 'id_seo' => $id, 'page' => 'properti', 'menu' => 'produklayanan']);

    $datas = $db->read('properti', '*', "id_properti = '$id' ")->fetch(PDO::FETCH_ASSOC);
    $properti = $db->connection("SELECT * FROM properti WHERE id_properti != $id AND tgl <= CURDATE() ORDER BY tgl DESC, id_properti DESC LIMIT 4 ")->fetchAll();
    $dilihat = $datas['dilihat'] + 1;
    $db->update(" properti", array('dilihat' => $dilihat), "id_properti = $datas[id_properti]");

    echo $templates->render('detproperti', ['data' => $datas, 'properti' => $properti]);
});

$router->get('/penerbit', function () use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 5, 'page' => 'penerbit', 'menu' => 'produklayanan']);
    $welcome        = $db->connection("SELECT * FROM page WHERE id_page = 5 ")->fetch();
    $penerbit       = $db->connection("SELECT * FROM penerbit ORDER BY tgl DESC")->fetchAll();
    $jmlpenerbit    = count($penerbit);

    echo $templates->render('penerbit', [
        'welcome'       => $welcome,
        'penerbit'      => $penerbit,
        'jmlpenerbit'   => $jmlpenerbit,
    ]);
});

$router->get('/penerbit-(.*)-(\d+)', function ($slug, $id) use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detpenerbit', 'id_seo' => $id, 'page' => 'penerbit', 'menu' => 'produklayanan']);

    $datas = $db->read('penerbit', '*', "id_penerbit = '$id' ")->fetch(PDO::FETCH_ASSOC);
    $penerbit = $db->connection("SELECT * FROM penerbit WHERE id_penerbit != $id AND tgl <= CURDATE() ORDER BY tgl DESC, id_penerbit DESC LIMIT 4 ")->fetchAll();
    $dilihat = $datas['dilihat'] + 1;
    $db->update(" penerbit", array('dilihat' => $dilihat), "id_penerbit = $datas[id_penerbit]");

    echo $templates->render('detpenerbit', ['data' => $datas, 'penerbit' => $penerbit]);
});

$router->get('/barangjasa', function () use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 7, 'page' => 'barangjasa', 'menu' => 'produklayanan']);
    $welcome        = $db->connection("SELECT * FROM page WHERE id_page = 7 ")->fetch();
    $barangjasa     = $db->connection("SELECT * FROM barangjasa ORDER BY tgl DESC")->fetchAll();
    $jmlbarangjasa  = count($barangjasa);

    echo $templates->render('barangjasa', [
        'welcome'       => $welcome,
        'barangjasa'    => $barangjasa,
        'jmlbarangjasa' => $jmlbarangjasa,
    ]);
});

$router->get('/barangjasa-(.*)-(\d+)', function ($slug, $id) use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detbarangjasa', 'id_seo' => $id, 'page' => 'barangjasa', 'menu' => 'produklayanan']);

    $datas = $db->read('barangjasa', '*', "id_barangjasa = '$id' ")->fetch(PDO::FETCH_ASSOC);
    $barangjasa = $db->connection("SELECT * FROM barangjasa WHERE id_barangjasa != $id AND tgl <= CURDATE() ORDER BY tgl DESC, id_barangjasa DESC LIMIT 4 ")->fetchAll();
    $dilihat = $datas['dilihat'] + 1;
    $db->update(" barangjasa", array('dilihat' => $dilihat), "id_barangjasa = $datas[id_barangjasa]");

    echo $templates->render('detbarangjasa', ['data' => $datas, 'barangjasa' => $barangjasa]);
});

$router->get('/artikel', function () use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 12, 'page' => 'artikel']);
    $artikelterbaru     = $db->connection("SELECT * FROM artikel ORDER BY tgl DESC LIMIT 1")->fetch();
    $idartikelterbaru   = $artikelterbaru['id_artikel'];
    $artikel            = $db->connection("SELECT * FROM artikel WHERE id_artikel != '$idartikelterbaru' ORDER BY tgl DESC")->fetchAll();

    echo $templates->render('artikel', [
        'artikelterbaru' => $artikelterbaru,
        'artikel' => $artikel,
    ]);
});

$router->get('/artikel-kategori-(.*)', function ($kategori) use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 7, 'page' => 'artikel']);

    $beritaterbaru      = $db->connection("SELECT * FROM artikel WHERE tipe = '$kategori' ORDER BY tgl DESC LIMIT 1")->fetch();
    $idberitaterbaru    = $beritaterbaru['id_artikel'];
    $berita             = $db->connection("SELECT * FROM artikel WHERE id_artikel != '$idberitaterbaru' AND tipe = '$kategori' ORDER BY tgl DESC")->fetchAll();

    echo $templates->render('artikel', [
        'beritaterbaru'     => $beritaterbaru,
        'berita'            => $berita,
        'kategori'          => $kategori,
    ]);
});

$router->get('/artikel-(.*)-(\d+)', function ($slug, $id) use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detartikel', 'id_seo' => $id, 'page' => 'artikel']);

    $datas = $db->read('artikel', '*', "id_artikel = '$id' ")->fetch(PDO::FETCH_ASSOC);
    $artikel = $db->connection("SELECT * FROM artikel WHERE id_artikel != $id AND tgl <= CURDATE() ORDER BY tgl DESC, id_artikel DESC LIMIT 4 ")->fetchAll();
    $dilihat = $datas['dilihat'] + 1;
    $db->update(" artikel", array('dilihat' => $dilihat), "id_artikel = $datas[id_artikel]");

    echo $templates->render('detartikel', ['data' => $datas, 'artikel' => $artikel]);
});

$router->get('/kontak', function () use ($templates, $db) {
    /** SEO */
    $kontak = $db->connection("SELECT * FROM page WHERE id_page = 14")->fetch();
    $templates->addData(['seo' => 'detpage', 'id' => 14, 'menu' => 'kontak', 'page' => 'kontak', 'kontak' => $kontak]);
    echo $templates->render('contact', []);
});

$router->get('/hal-(.*)-(\d+)', function ($slug, $id) use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'subpage', 'id' => $id, 'page' => $slug]);
    $datas = $db->read('subnavmenu', '*', "id_subnavmenu = '$id' ")->fetch(PDO::FETCH_ASSOC);
    $datas2 = $db->read('navmenu', '*', "id_navmenu = '$datas[id_navmenu]' ")->fetch(PDO::FETCH_ASSOC);
    $templates->addData(['menu' => $datas2['nama_menu']]);
    echo $templates->render('subpage', ['data' => $datas, 'data2' => $datas2]);
});

$router->get('/galeri', function () use ($templates, $db) {
    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 13, 'page' => 'galeri']);
    $galeri = $db->connection("SELECT * FROM gallery ")->fetchAll();
    echo $templates->render('galeri', ['galeri' => $galeri]);
});

$router->post('/search', function () use ($templates, $db) {
    $templates->addData(['seo' => '', 'id' => 12]);
    if ($_POST['q']) {
        $data           = $_POST['q'];
        $cariberita     = $db->connection("SELECT * FROM artikel WHERE judul LIKE '%$_POST[q]%' OR deskripsi LIKE '%$_POST[q]%'")->fetchAll();
        $carihalaman    = $db->connection("SELECT * FROM subnavmenu WHERE nama_submenu LIKE '%$_POST[q]%' OR judul_konten LIKE '%$_POST[q]%' OR konten LIKE '%$_POST[q]%' AND tipe_submenu = 'halaman'")->fetchAll();
        $sub            = $db->connection("SELECT * FROM produk_k ")->fetchAll();
        $cari2          = $db->connection("SELECT *,k.judul AS jdl,k.judul_seo AS seo FROM produk_k k  JOIN produk p  ON k.id_produk_k = p.id_produk_k WHERE p.judul LIKE '%$_POST[q]%' ")->fetchAll();
        echo $templates->render('cari', [
            'data'          => $data,
            'cariberita'    => $cariberita,
            'carihalaman'   => $carihalaman,
            'produk'        => $cari2,
            'sub'           => $sub
        ]);
    } else {
        $carikos        = '';
        $data           = $carikos;
        $cariberita     = $db->connection("SELECT * FROM artikel WHERE judul LIKE '%$carikos%'")->fetchAll();
        $carihalaman    = $db->connection("SELECT * FROM subnavmenu WHERE nama_submenu LIKE '%$carikos%' OR judul_konten LIKE '%$carikos%' AND tipe_submenu = 'halaman'")->fetchAll();
        $sub            = $db->connection("SELECT * FROM produk_k ")->fetchAll();
        $cari2          = $db->connection("SELECT *,k.judul AS jdl,k.judul_seo AS seo FROM produk_k k  JOIN produk p  ON k.id_produk_k = p.id_produk_k WHERE p.judul LIKE '%$carikos%' ")->fetchAll();
        echo $templates->render('cari', [
            'data'          => $data,
            'cariberita'    => $cariberita,
            'carihalaman'   => $carihalaman,
            'produk'        => $cari2,
            'sub'           => $sub
        ]);
    }
});

$router->get('/search', function () use ($templates, $db) {
    $templates->addData(['seo' => '', 'id' => 12]);
    $carikos        = '';
    $data           = $carikos;
    $cariberita     = $db->connection("SELECT * FROM artikel WHERE judul LIKE '%$carikos%'")->fetchAll();
    $carihalaman    = $db->connection("SELECT * FROM subnavmenu WHERE nama_submenu LIKE '%$carikos%' AND tipe_submenu = 'halaman'")->fetchAll();
    $sub            = $db->connection("SELECT * FROM produk_k ")->fetchAll();
    $cari2          = $db->connection("SELECT *,k.judul AS jdl,k.judul_seo AS seo FROM produk_k k  JOIN produk p  ON k.id_produk_k = p.id_produk_k WHERE p.judul LIKE '%$carikos%' ")->fetchAll();
    echo $templates->render('cari', [
        'data'          => $data,
        'cariberita'    => $cariberita,
        'carihalaman'   => $carihalaman,
        'produk'        => $cari2,
        'sub'           => $sub
    ]);
});

$router->get('/blog', function () use ($templates, $db) {

    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 16, 'page' => 'blog']);

    /** Paging foto */
    $page           = new pagingAll;
    $batas             = 12;
    $idPag          = 1;
    $posisi         = $page->cariPosisi($batas, $idPag);
    $jmldata        = $db->connection('SELECT * FROM artikel   ')->rowCount();
    $jmlhalaman     = $page->jmlhalaman($jmldata, $batas);
    $linkHalaman    = $page->navHalaman($idPag, $jmlhalaman, 'blog');
    $pagination     = array(
        'batas'         => $batas,
        'jmldata'       => $jmldata,
        'jmlhalaman'    => $jmlhalaman,
        'linkHalaman'   => $linkHalaman
    );

    // $foto  = $db->connection("SELECT *,DAY(tgl) as day, MONTHNAME(tgl) as month, YEAR(tgl) as year FROM artikel  ORDER BY tgl DESC LIMIT $posisi,$batas ")->fetchAll();
    $foto  = $db->connection("SELECT *,DAY(tgl) as day, MONTHNAME(tgl) as month, YEAR(tgl) as year FROM artikel  ORDER BY tgl DESC")->fetchAll();
    $header  = $db->connection("SELECT * FROM artikel ORDER BY id_artikel DESC Limit 1")->fetch();
    $data  = $db->connection("SELECT * FROM page  WHERE id_page = 9 ")->fetch(PDO::FETCH_ASSOC);
    echo $templates->render('artikel', ['artikel' => $foto, 'pagination' => $pagination, 'data' => $data, 'header' => $header]);
});

$router->get('/blog-page-(\d+)', function ($id) use ($templates, $db) {

    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 9]);

    /** Paging foto */
    $page           = new pagingAll;
    $batas             = 12;
    $idPag          = $id;
    $posisi         = $page->cariPosisi($batas, $idPag);
    $jmldata        = $db->connection('SELECT * FROM artikel   ')->rowCount();
    $jmlhalaman     = $page->jmlhalaman($jmldata, $batas);
    $linkHalaman    = $page->navHalaman($idPag, $jmlhalaman, 'artikel');
    $pagination     = array(
        'batas'         => $batas,
        'jmldata'       => $jmldata,
        'jmlhalaman'    => $jmlhalaman,
        'linkHalaman'   => $linkHalaman
    );

    $foto  = $db->connection("SELECT * FROM artikel  ORDER BY tgl DESC LIMIT $posisi,$batas ")->fetchAll();
    $data  = $db->connection("SELECT * FROM page  WHERE id_page = 9 ")->fetch(PDO::FETCH_ASSOC);
    echo $templates->render('artikel', ['artikel' => $foto, 'pagination' => $pagination, 'data' => $data]);
});

$router->get('/404', function () use ($templates, $db) {
    echo $templates->render('404');
});

$router->get('/layanan-(.*)-(\d+)', function ($slug, $id) use ($templates, $db) {

    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 2, 'menu' => 'kontak']);

    $data        = $db->read('transportasi', '*', "id_transportasi = $id ")->fetch(PDO::FETCH_ASSOC);

    echo $templates->render('transportasi', ['data' => $data]);
});

$router->post('/cari', function () use ($templates, $db) {
    $templates->addData(['seo' => 'detpage', 'id' => 12]);
    $data = $_POST['q'];
    $sub    = $db->connection("SELECT * FROM produk_k ")->fetchAll();
    $cari2 = $db->connection("SELECT *,k.judul AS jdl,k.judul_seo AS seo FROM produk_k k  JOIN produk p  ON k.id_produk_k = p.id_produk_k WHERE p.judul LIKE '%$_POST[q]%' ")->fetchAll();
    echo $templates->render('cari', ['data' => $data, 'produk' => $cari2, 'sub' => $sub]);
});

$router->get('/contact-us', function () use ($templates, $db) {

    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 4, 'menu' => 'kontak']);

    $data        = $db->read('page', '*', "id_page = 4 ")->fetch(PDO::FETCH_ASSOC);

    $header        = $db->read('page', '*', "id_page = 1 ")->fetch(PDO::FETCH_ASSOC);

    echo $templates->render('detpage', ['data' => $data, 'header' => $header]);
});

$router->post('/contact', function () use ($templates, $db, $csrf, $base_url) {

    // Validate that a correct token was given
    if ($csrf->validate('my-form')) {
        $datas = array(
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'subject' => $_POST['subject'],
            'message' => $_POST['message'],
        );
        $sender = array(
            'host' => $_ENV['MAIL_HOST'],
            'user' => $_ENV['MAIL_USER'],
            'pass' => $_ENV['MAIL_PASS'],
            'from' => $_ENV['MAIL_FROM'],
            'subject' => $_ENV['MAIL_SUBJECT'],
        );
        $admin = $db->connection("SELECT * FROM admin WHERE id = 2")->fetch();
        //$res = sendEmail($datas,$admin,$sender);
        $res = true;
        if ($res) {
            $db->insert("contact", $datas);

            echo "<script>
    window.alert('Your message has been sent. Thank you!!');
    window.location = '$base_url'
    </script>";
        } else {
            echo "<script>
    window.alert('Your message failed to send');
    window.location(history.back(-1))
    </script>";
        }
    } else {
        header("Location: contact-us");
    }
});

$router->post('/search', function () use ($templates, $db) {


    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 15, 'menu' => 'tentang-kami']);
    $packages = $db->connection("SELECT *,pk.judul AS kategori FROM produk_kategori pk JOIN packages p ON pk.id_produk_kategori = p.id_produk_kategori WHERE p.judul LIKE '%$_POST[s]%'  ORDER BY CASE WHEN p.urutan = 0 THEN 1 ELSE 0 END, p.urutan ASC  ")->fetchAll();

    $header = $db->connection("SELECT * FROM page WHERE id_page = 2 ")->fetch();
    $deskripsi = $db->connection("SELECT * FROM page WHERE id_page = 3 ")->fetch();
    $data['judul'] = "Search";

    echo $templates->render('cari', ['data' => $header, 'packages' => $packages, 'header' => $header, 'deskripsi' => $deskripsi, 'data' => $data]);
});

$router->get('/sub-kategori-(\d+)', function ($id) use ($templates, $db) {

    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 9]);

    /** Paging foto */
    $page           = new pagingAll;
    $batas             = 12;
    $idPag          = 1;
    $posisi         = $page->cariPosisi($batas, $idPag);
    $jmldata        = $db->connection("SELECT * FROM produk WHERE id_produk_sk = $id   ")->rowCount();
    $jmlhalaman     = $page->jmlhalaman($jmldata, $batas);
    $linkHalaman    = $page->navHalaman($idPag, $jmlhalaman, 'artikel');
    $pagination     = array(
        'batas'         => $batas,
        'jmldata'       => $jmldata,
        'jmlhalaman'    => $jmlhalaman,
        'linkHalaman'   => $linkHalaman
    );

    $foto   = $db->connection("SELECT *,k.judul AS jdl,k.judul_seo AS seo FROM produk_k k  JOIN produk p  ON k.id_produk_k = p.id_produk_k  WHERE p.id_produk_sk = $id LIMIT $posisi,$batas ")->fetchAll();

    $data   = $db->connection("SELECT * FROM produk_sk  WHERE id_produk_sk = $id ")->fetch(PDO::FETCH_ASSOC);

    $dk     = $db->connection("SELECT * FROM produk_k  WHERE id_produk_k = $data[id_produk_k] ")->fetch(PDO::FETCH_ASSOC);

    $sub    = $db->connection("SELECT * FROM produk_sk  WHERE id_produk_k = $data[id_produk_k] ")->fetchAll();

    echo $templates->render('sub', ['produk' => $foto, 'pagination' => $pagination, 'data' => $data, 'dk' => $dk, 'sub' => $sub]);
});

$router->get('/sub-kategori-(\d+)-page-(\d+)', function ($id, $idP) use ($templates, $db) {

    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 9]);

    /** Paging foto */
    $page           = new pagingAll;
    $batas             = 12;
    $idPag          = $idP;
    $posisi         = $page->cariPosisi($batas, $idPag);
    $jmldata        = $db->connection('SELECT * FROM produk WHERE id_produk_sk = $id   ')->rowCount();
    $jmlhalaman     = $page->jmlhalaman($jmldata, $batas);
    $linkHalaman    = $page->navHalaman($idPag, $jmlhalaman, 'artikel');
    $pagination     = array(
        'batas'         => $batas,
        'jmldata'       => $jmldata,
        'jmlhalaman'    => $jmlhalaman,
        'linkHalaman'   => $linkHalaman
    );

    $foto   = $db->connection("SELECT *,k.judul AS jdl,k.judul_seo AS seo FROM produk_k k  JOIN produk p  ON k.id_produk_k = p.id_produk_k  WHERE p.id_produk_sk = $id LIMIT $posisi,$batas ")->fetchAll();

    $data   = $db->connection("SELECT * FROM produk_sk  WHERE id_produk_sk = $id ")->fetch(PDO::FETCH_ASSOC);

    $dk     = $db->connection("SELECT * FROM produk_k  WHERE id_produk_k = $data[id_produk_k] ")->fetch(PDO::FETCH_ASSOC);

    $sub    = $db->connection("SELECT * FROM produk_sk  WHERE id_produk_k = $data[id_produk_k] ")->fetchAll();

    echo $templates->render('sub', ['produk' => $foto, 'pagination' => $pagination, 'data' => $data, 'dk' => $dk, 'sub' => $sub]);
});



$router->get('/kategori-(.*)-(\d+)', function ($slug, $id) use ($templates, $db) {

    /** SEO */
    $templates->addData(['seo' => 'detCat', 'id' => $id]);

    /** Paging foto */
    $page           = new pagingAll;
    $batas             = 12;
    $idPag          = 1;
    $posisi         = $page->cariPosisi($batas, $idPag);
    $jmldata        = $db->connection("SELECT * FROM produk WHERE id_produk_k = $id   ")->rowCount();
    $jmlhalaman     = $page->jmlhalaman($jmldata, $batas);
    $linkHalaman    = $page->navHalaman($idPag, $jmlhalaman, 'artikel');
    $pagination     = array(
        'batas'         => $batas,
        'jmldata'       => $jmldata,
        'jmlhalaman'    => $jmlhalaman,
        'linkHalaman'   => $linkHalaman
    );

    $foto   = $db->connection("SELECT *,k.judul AS jdl,k.judul_seo AS seo FROM produk_k k  JOIN produk p  ON k.id_produk_k = p.id_produk_k  WHERE p.id_produk_k = $id LIMIT $posisi,$batas ")->fetchAll();

    $data   = $db->connection("SELECT * FROM produk_k  WHERE id_produk_k = $id ")->fetch(PDO::FETCH_ASSOC);

    $dk     = $db->connection("SELECT * FROM produk_k  WHERE id_produk_k = $data[id_produk_k] ")->fetch(PDO::FETCH_ASSOC);

    $sub    = $db->connection("SELECT * FROM produk_sk  WHERE id_produk_k = $data[id_produk_k] ")->fetchAll();

    echo $templates->render('kategori', ['produk' => $foto, 'pagination' => $pagination, 'data' => $data, 'dk' => $dk, 'sub' => $sub]);
});

$router->get('/kategori-(.*)-(\d+)-page-(\d+)', function ($slug, $id, $idP) use ($templates, $db) {

    /** SEO */
    $templates->addData(['seo' => 'detCat', 'id' => $id]);

    /** Paging foto */
    $page           = new pagingAll;
    $batas             = 12;
    $idPag          = $idP;
    $posisi         = $page->cariPosisi($batas, $idPag);
    $jmldata        = $db->connection("SELECT * FROM produk WHERE id_produk_k = $id   ")->rowCount();
    $jmlhalaman     = $page->jmlhalaman($jmldata, $batas);
    $linkHalaman    = $page->navHalaman($idPag, $jmlhalaman, 'artikel');
    $pagination     = array(
        'batas'         => $batas,
        'jmldata'       => $jmldata,
        'jmlhalaman'    => $jmlhalaman,
        'linkHalaman'   => $linkHalaman
    );

    $foto   = $db->connection("SELECT *,k.judul AS jdl,k.judul_seo AS seo FROM produk_k k  JOIN produk p  ON k.id_produk_k = p.id_produk_k  WHERE p.id_produk_k = $id LIMIT $posisi,$batas ")->fetchAll();

    $data   = $db->connection("SELECT * FROM produk_k  WHERE id_produk_k = $id ")->fetch(PDO::FETCH_ASSOC);

    $dk     = $db->connection("SELECT * FROM produk_k  WHERE id_produk_k = $data[id_produk_k] ")->fetch(PDO::FETCH_ASSOC);

    $sub    = $db->connection("SELECT * FROM produk_sk  WHERE id_produk_k = $data[id_produk_k] ")->fetchAll();

    echo $templates->render('kategori', ['produk' => $foto, 'pagination' => $pagination, 'data' => $data, 'dk' => $dk, 'sub' => $sub]);
});


$router->get('/tag-(.*)-(\d+)', function ($slug, $id) use ($templates, $db) {

    /** SEO */
    $templates->addData(['seo' => 'detCat', 'id' => $id]);

    /** Paging foto */
    $page           = new pagingAll;
    $batas             = 12;
    $idPag          = 1;
    $posisi         = $page->cariPosisi($batas, $idPag);
    $jmldata        = $db->connection("SELECT * FROM produk p JOIN detail_tag dt ON dt.id_produk = p.id_produk WHERE dt.id_tag = $id  GROUP BY p.id_produk ")->rowCount();
    $jmlhalaman     = $page->jmlhalaman($jmldata, $batas);
    $linkHalaman    = $page->navHalaman($idPag, $jmlhalaman, 'artikel');
    $pagination     = array(
        'batas'         => $batas,
        'jmldata'       => $jmldata,
        'jmlhalaman'    => $jmlhalaman,
        'linkHalaman'   => $linkHalaman
    );

    $foto   = $db->connection("SELECT *,k.judul AS jdl,k.judul_seo AS seo FROM produk_k k  JOIN produk p  ON k.id_produk_k = p.id_produk_k JOIN detail_tag dt ON dt.id_produk = p.id_produk   WHERE dt.id_tag = $id GROUP BY p.id_produk LIMIT $posisi,$batas ")->fetchAll();

    $data   = $db->connection("SELECT * FROM produk_tag  WHERE id_produk_tag = $id ")->fetch(PDO::FETCH_ASSOC);



    echo $templates->render('tag', ['produk' => $foto, 'pagination' => $pagination, 'data' => $data,]);
});

$router->get('/tag-(.*)-(\d+)-page-(\d+)', function ($slug, $id, $idP) use ($templates, $db) {

    /** SEO */
    $templates->addData(['seo' => 'detCat', 'id' => $id]);

    /** Paging foto */
    $page           = new pagingAll;
    $batas             = 12;
    $idPag          = $idP;
    $posisi         = $page->cariPosisi($batas, $idPag);
    $jmldata        = $db->connection("SELECT * FROM produk p JOIN detail_tag dt ON dt.id_produk = p.id_produk WHERE dt.id_tag = $id  GROUP BY p.id_produk  ")->rowCount();
    $jmlhalaman     = $page->jmlhalaman($jmldata, $batas);
    $linkHalaman    = $page->navHalaman($idPag, $jmlhalaman, 'artikel');
    $pagination     = array(
        'batas'         => $batas,
        'jmldata'       => $jmldata,
        'jmlhalaman'    => $jmlhalaman,
        'linkHalaman'   => $linkHalaman
    );

    $foto   = $db->connection("SELECT *,k.judul AS jdl,k.judul_seo AS seo FROM produk_k k  JOIN produk p  ON k.id_produk_k = p.id_produk_k JOIN detail_tag dt ON dt.id_produk = p.id_produk   WHERE dt.id_tag = $id GROUP BY p.id_produk LIMIT $posisi,$batas ")->fetchAll();

    $data   = $db->connection("SELECT * FROM produk_tag  WHERE id_produk_tag = $id ")->fetch(PDO::FETCH_ASSOC);



    echo $templates->render('tag', ['produk' => $foto, 'pagination' => $pagination, 'data' => $data,]);
});


$router->get('/products', function () use ($templates, $db) {

    /** SEO */
    $templates->addData(['seo' => 'detpage', 'id' => 10]);

    /** Paging foto */
    $page           = new pagingAll;
    $batas             = 12;
    $idPag          = 1;
    $posisi         = $page->cariPosisi($batas, $idPag);
    $jmldata        = $db->connection("SELECT * FROM produk   ")->rowCount();
    $jmlhalaman     = $page->jmlhalaman($jmldata, $batas);
    $linkHalaman    = $page->navHalaman($idPag, $jmlhalaman, 'buku');
    $pagination     = array(
        'batas'         => $batas,
        'jmldata'       => $jmldata,
        'jmlhalaman'    => $jmlhalaman,
        'linkHalaman'   => $linkHalaman
    );

    $kategori = $db->connection("SELECT * FROM produk_k")->fetchAll();

    $foto   = $db->connection("SELECT *,k.judul AS jdl,k.judul_seo AS seo FROM produk_k k  JOIN produk p  ON k.id_produk_k = p.id_produk_k ")->fetchAll();


    echo $templates->render('products', ['produk' => $foto, 'pagination' => $pagination, 'kategori' => $kategori]);
});

/*
* ------------------------------------------------------
* Router Admin
* ------------------------------------------------------
*/
include(APPPATH . 'admin/router.php');

$router->run();
