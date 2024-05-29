<?php
/*
 * ------------------------------------------------------
 *  Router Admin
 * ------------------------------------------------------
 */

$path = APPPATH . ADMPATH . 'modul/';

$router->get("/$_ENV[URL_LOGIN]", function () use ($login) {
    echo $login->render('login');
});

$router->post("/$_ENV[URL_LOGIN]", function () use ($login, $jmw, $db) {
    $username = $_POST['username'];
    $pass = md5($_POST['password']);
    $login = $db->read("admin", "*", "username='$username' AND password='$pass' AND status='Aktif'")->fetch();
    $ketemu = $db->read("admin", "COUNT(*)", "username='$username' AND password='$pass' AND status='Aktif'")->fetchColumn();
    $r = $login;
    if ($ketemu > 0) {
        $_SESSION['nama_admin']         = $r['username'];
        $_SESSION['email_admin']        = $r['email'];
        $_SESSION['namalengkapadmin']   = $r['nama_lengkap'];
        $_SESSION['passadmin']          = $r['password'];
        $_SESSION['leveladmin']         = $r['level'];
        $_SESSION['id_admin']           = $r['id'];
        $_SESSION['idsession']          = $r['id_session'];
        $_SESSION['halaman']            = 'Home';
        $_SESSION['IsAuthorized']       = true;
        header("location: ../$_ENV[URL_ADMIN]/dashboard");
    } else {
        header("location: ../$_ENV[URL_LOGIN]");
    }
});

/** Cek Keamanan **/
$router->before('GET|POST', "/$_ENV[URL_ADMIN]/.*", function () {
    if (!isset($_SESSION['nama_admin'])) {
        $getWholeUrl = "http://" . $_SERVER['HTTP_HOST'] . "" . $_SERVER['REQUEST_URI'] . "";
        if (substr($getWholeUrl, -1) == '/') {
            header("location: ../$_ENV[URL_LOGIN]");
        } else {
            header("location: ../$_ENV[URL_LOGIN]");
        }
        exit();
    }
});



/** Router dalam folder Admin **/
$router->mount("/$_ENV[URL_ADMIN]", function () use ($router, $db, $jmw, $path, $imgname1, $msg) {

    /** Security Lvl 2 **/
    $router->get('/', function () {
        if (!isset($_SESSION['nama_admin'])) {
            header("location: $_ENV[URL_LOGIN]");
            exit();
        } else {
            $getWholeUrl = "http://" . $_SERVER['HTTP_HOST'] . "" . $_SERVER['REQUEST_URI'] . "";
            if (substr($getWholeUrl, -1) == '/') {
                header('location: dashboard');
            } else {
                header('location: ' . ADMPATH . 'dashboard');
            }
        }
    });

    /** Logout **/
    $router->get('/logout', function () use ($jmw, $db, $path) {
        session_start();
        session_destroy();
        header("location: ../$_ENV[URL_LOGIN]");
    });

    /** Url Setting **/
    $router->get('/setting', function () use ($jmw, $db, $path) {
        $data = $db->connection("SELECT * FROM admin WHERE id = $_SESSION[id_admin] ")->fetch();
        echo $jmw->render('modul/admin/index', ['act' => 'edit', 'tedit' => $data]);
    });

    /** Setting Updated **/
    $router->post('/setting', function () use ($jmw, $db, $path) {
        $act = "update";
        $hal = "setting";
        include($path . 'admin/aksi.php');
    });

    /** Setting File Manager **/
    $router->get('/file-manager', function () use ($jmw, $db, $path) {
        echo $jmw->render('modul/filemanager/index');
    });

    /*
 * ------------------------------------------------------
 *  Router Dashboard
 * ------------------------------------------------------
 */

    /** Halaman Dashboard **/
    $router->get('/dashboard', function () use ($jmw, $db) {
        $tanggal = date("Y-m-d"); // Mendapatkan tanggal sekarang
        $bataswaktu       = time() - 300;
        $edit2 = $db->connection("SELECT COUNT(id) as totalz FROM statistik");
        $edit3 = $db->connection("SELECT hits FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal ASC");
        $edit4 = $db->connection("SELECT SUM(hits) as totalz FROM statistik");    
        $row_count3 = $edit3->rowCount(); 
        $totalpengunjung  = $edit2->fetch(PDO::FETCH_ASSOC);
        $hits             = $row_count3;
        $totalhits        = $edit4->fetch(PDO::FETCH_ASSOC);
        $tothitsgbr       = $edit4->fetch(PDO::FETCH_ASSOC);
     
        //pengunjung hari ini
        $edit1 = $db->connection("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip ASC");
        $row_count1       = $edit1->rowCount();
        $pengunjung       = $row_count1;
        //$pengunjung;
     
     
        //Hits Hari Ini
        $edit6 = $db->connection("SELECT SUM(hits) as totalz FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal ASC");
        $hits2             = $edit6->fetch(PDO::FETCH_ASSOC);
     
        //pengunjung online
        $edit5 = $db->connection("SELECT * FROM statistik WHERE online > '$bataswaktu'");
        $row_count5 = $edit5->rowCount();
        $pengunjungonline = $row_count5;
         echo $jmw->render('dashboard', ['pengunjung' => $pengunjung,'hits' => $hits2["totalz"], 'totalpengunjung' => $totalpengunjung, 'pengunjungonline' => $pengunjungonline, 'totalhits' => $totalhits['totalz'], 'totalpengunjung' => $totalpengunjung['totalz']]);
     });

    /*
 * ------------------------------------------------------
 *  Router Kendaraan
 * ------------------------------------------------------
 */

    /** Url Kendaraan **/
    $router->get('/kendaraan', function () use ($jmw, $db, $msg) {
        $dataku = $db->connection("SELECT * FROM kendaraan  ORDER BY id_kendaraan DESC");
        echo $jmw->render('modul/kendaraan/index', ['act' => 'list', 'tampil' => $dataku]);
    });

    /** Show Add Form Kendaraan **/
    $router->get('/kendaraan-add', function () use ($jmw, $db, $msg) {
        echo $jmw->render('modul/kendaraan/index', ['act' => 'add']);
    });


    /** Show Edit Form Kendaraan **/
    $router->get('/kendaraan-edit-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data       = $db->connection("SELECT * FROM kendaraan WHERE id_kendaraan = $id ")->fetch();
        echo $jmw->render('modul/kendaraan/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add Kendaraan  **/
    $router->post('/kendaraan', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_kendaraan'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "kendaraan";
        include($path . 'kendaraan/aksi.php');
    });

    /** Delete Kendaraan **/
    $router->get('/kendaraan-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        include($path . 'kendaraan/aksi.php');
    });
    
    /*
 * ------------------------------------------------------
 *  Router Kendaraan 2
 * ------------------------------------------------------
 */

    /** Url Kendaraan 2 **/
    $router->get('/kendaraan2', function () use ($jmw, $db, $msg) {
        $dataku = $db->connection("SELECT * FROM kendaraan2  ORDER BY id_kendaraan DESC");
        echo $jmw->render('modul/kendaraan2/index', ['act' => 'list', 'tampil' => $dataku]);
    });

    /** Show Add Form Kendaraan **/
    $router->get('/kendaraan2-add', function () use ($jmw, $db, $msg) {
        echo $jmw->render('modul/kendaraan2/index', ['act' => 'add']);
    });


    /** Show Edit Form Kendaraan **/
    $router->get('/kendaraan2-edit-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data       = $db->connection("SELECT * FROM kendaraan2 WHERE id_kendaraan = $id ")->fetch();
        echo $jmw->render('modul/kendaraan2/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add Kendaraan  **/
    $router->post('/kendaraan2', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_kendaraan'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "kendaraan2";
        include($path . 'kendaraan2/aksi.php');
    });

    /** Delete Kendaraan **/
    $router->get('/kendaraan2-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        include($path . 'kendaraan2/aksi.php');
    });
    
    /*
 * ------------------------------------------------------
 *  Router Kendaraan 3
 * ------------------------------------------------------
 */

    /** Url Kendaraan 3 **/
    $router->get('/kendaraan3', function () use ($jmw, $db, $msg) {
        $dataku = $db->connection("SELECT * FROM kendaraan3  ORDER BY id_kendaraan DESC");
        echo $jmw->render('modul/kendaraan3/index', ['act' => 'list', 'tampil' => $dataku]);
    });

    /** Show Add Form Kendaraan 3 **/
    $router->get('/kendaraan3-add', function () use ($jmw, $db, $msg) {
        echo $jmw->render('modul/kendaraan3/index', ['act' => 'add']);
    });


    /** Show Edit Form Kendaraan 3 **/
    $router->get('/kendaraan3-edit-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data       = $db->connection("SELECT * FROM kendaraan3 WHERE id_kendaraan = $id ")->fetch();
        echo $jmw->render('modul/kendaraan3/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add Kendaraan 3 **/
    $router->post('/kendaraan3', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_kendaraan'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "kendaraan3";
        include($path . 'kendaraan3/aksi.php');
    });

    /** Delete Kendaraan 3 **/
    $router->get('/kendaraan3-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        include($path . 'kendaraan3/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router Paket Wisata
 * ------------------------------------------------------
 */

    /** Url Paket Wisata **/
    $router->get('/paketwisata', function () use ($jmw, $db, $msg) {
        $dataku = $db->connection("SELECT * FROM paketwisata  ORDER BY id_paketwisata DESC");
        echo $jmw->render('modul/paketwisata/index', ['act' => 'list', 'tampil' => $dataku]);
    });

    /** Show Add Form Paket Wisata **/
    $router->get('/paketwisata-add', function () use ($jmw, $db, $msg) {
        echo $jmw->render('modul/paketwisata/index', ['act' => 'add']);
    });


    /** Show Edit Form Paket Wisata **/
    $router->get('/paketwisata-edit-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data       = $db->connection("SELECT * FROM paketwisata WHERE id_paketwisata = $id ")->fetch();
        echo $jmw->render('modul/paketwisata/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add Paket Wisata  **/
    $router->post('/paketwisata', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_paketwisata'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "paketwisata";
        include($path . 'paketwisata/aksi.php');
    });

    /** Delete Paket Wisata **/
    $router->get('/paketwisata-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        include($path . 'paketwisata/aksi.php');
    });

    /*
* ------------------------------------------------------
*  Router Sub Menu
* ------------------------------------------------------
*/

    /** Url Sub Menu **/
    $router->get('/(.*)-subnavmenu', function ($menu) use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM subnavmenu INNER JOIN navmenu ON subnavmenu.id_navmenu=navmenu.id_navmenu WHERE navmenu.nama_menu='$menu' ORDER BY subnavmenu.id_subnavmenu DESC");
        echo $jmw->render('modul/subnavmenu/index', ['act' => 'list', 'tampil' => $dataku, 'per' => "all", 'menu' => $menu]);
    });

    /** Show Add Form Sub Menu **/
    $router->get('/(.*)-subnavmenu-add', function ($menu) use ($jmw, $db) {
        $navmenu = $db->connection("SELECT * FROM navmenu")->fetchAll();
        $idnavmenu = $db->connection("SELECT * FROM navmenu WHERE nama_menu = '$menu'")->fetch();
        echo $jmw->render('modul/subnavmenu/index', ['act' => 'add', 'per' => "all", 'navmenu' => $navmenu, 'menu' => $menu, 'idnavmenu' => $idnavmenu]);
    });

    /** Show Edit Form Sub Menu **/
    $router->get('/subnavmenu-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM subnavmenu WHERE id_subnavmenu = $id ")->fetch();
        $navmenu = $db->connection("SELECT * FROM navmenu")->fetchAll();
        echo $jmw->render('modul/subnavmenu/index', ['act' => 'edit', 'data' => $data, 'navmenu' => $navmenu]);
    });

    /** Update dan Add Sub Menu  **/
    $router->post('/(.*)-subnavmenu', function ($menu) use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_subnavmenu'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "subnavmenu";
        include($path . 'subnavmenu/aksi.php');
    });

    /** Delete Sub Menu **/
    $router->get('/subnavmenu-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        include($path . 'subnavmenu/aksi.php');
    });

    /*
* ------------------------------------------------------
*  Router Properti
* ------------------------------------------------------
*/

    /** Url Properti **/
    $router->get('/properti', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM properti ORDER BY tgl DESC, id_properti DESC");
        echo $jmw->render('modul/properti/index', ['act' => 'list', 'tampil' => $dataku, 'per' => "all"]);
    });

    /** Show Add Form Properti **/
    $router->get('/properti-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/properti/index', ['act' => 'add', 'per' => "all"]);
    });

    /** Show Edit Form Properti **/
    $router->get('/properti-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM properti WHERE id_properti = $id ")->fetch();
        echo $jmw->render('modul/properti/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add Properti  **/
    $router->post('/properti', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_properti'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "properti";
        include($path . 'properti/aksi.php');
    });

    /** Delete Properti **/
    $router->get('/properti-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        include($path . 'properti/aksi.php');
    });

    /*
* ------------------------------------------------------
*  Router Penerbit
* ------------------------------------------------------
*/

    /** Url Penerbit **/
    $router->get('/penerbit', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM penerbit ORDER BY tgl DESC, id_penerbit DESC");
        echo $jmw->render('modul/penerbit/index', ['act' => 'list', 'tampil' => $dataku, 'per' => "all"]);
    });

    /** Show Add Form Penerbit **/
    $router->get('/penerbit-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/penerbit/index', ['act' => 'add', 'per' => "all"]);
    });

    /** Show Edit Form Penerbit **/
    $router->get('/penerbit-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM penerbit WHERE id_penerbit = $id ")->fetch();
        echo $jmw->render('modul/penerbit/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add Penerbit  **/
    $router->post('/penerbit', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_penerbit'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "penerbit";
        include($path . 'penerbit/aksi.php');
    });

    /** Delete Penerbit **/
    $router->get('/penerbit-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        include($path . 'penerbit/aksi.php');
    });

    /*
* ------------------------------------------------------
*  Router Barang & Jasa
* ------------------------------------------------------
*/

    /** Url Barang & Jasa **/
    $router->get('/barangjasa', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM barangjasa ORDER BY tgl DESC, id_barangjasa DESC");
        echo $jmw->render('modul/barangjasa/index', ['act' => 'list', 'tampil' => $dataku, 'per' => "all"]);
    });

    /** Show Add Form Barang & Jasa **/
    $router->get('/barangjasa-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/barangjasa/index', ['act' => 'add', 'per' => "all"]);
    });

    /** Show Edit Form Barang & Jasa **/
    $router->get('/barangjasa-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM barangjasa WHERE id_barangjasa = $id ")->fetch();
        echo $jmw->render('modul/barangjasa/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add Barang & Jasa  **/
    $router->post('/barangjasa', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_barangjasa'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "barangjasa";
        include($path . 'barangjasa/aksi.php');
    });

    /** Delete Barang & Jasa **/
    $router->get('/barangjasa-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        include($path . 'barangjasa/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router Submenu Links
 * ------------------------------------------------------
 */

    /** Url Submenu Links **/
    $router->get('/submenulinks', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM submenulinks")->fetchAll();
        echo $jmw->render('modul/submenulinks/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form Submenu Links **/
    $router->get('/submenulinks-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/submenulinks/index', ['act' => 'add']);
    });

    /** Show Edit Form Submenu Links **/
    $router->get('/submenulinks-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM submenulinks WHERE id_link = $id ")->fetch();
        echo $jmw->render('modul/submenulinks/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add Submenu Links  **/
    $router->post('/submenulinks', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_link'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "submenulinks";
        include($path . 'submenulinks/aksi.php');
    });

    /** Delete Submenu Links **/
    $router->get('/submenulinks-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "submenulinks";
        include($path . 'submenulinks/aksi.php');
    });

    /*
* ------------------------------------------------------
*  Router Berita
* ------------------------------------------------------
*/

    /** Url Berita **/
    $router->get('/artikel', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM artikel ORDER BY tgl DESC, id_artikel DESC");
        echo $jmw->render('modul/artikel/index', ['act' => 'list', 'tampil' => $dataku, 'per' => "all"]);
    });

    /** Show Add Form Berita **/
    $router->get('/artikel-add', function () use ($jmw, $db) {
        $kategori = $db->connection("SELECT * FROM kategori ")->fetchAll();
        $tag = $db->connection("SELECT * FROM artikel_tag ")->fetchAll();
        echo $jmw->render('modul/artikel/index', ['act' => 'add', 'per' => "all", 'kategori' => $kategori, 'tag' => $tag]);
    });

    /** Show Edit Form Berita **/
    $router->get('/artikel-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM artikel WHERE id_artikel = $id ")->fetch();
        $kategori = $db->connection("SELECT * FROM kategori ")->fetchAll();
        $tag = $db->connection("SELECT * FROM artikel_tag ");
        $artikel_tag = $db->connection("SELECT * FROM detail_tag2  WHERE id_artikel = $id ")->fetchAll();
        echo $jmw->render('modul/artikel/index', ['act' => 'edit', 'data' => $data, 'kategori' => $kategori, 'tag' => $tag, 'artikel_tag' => $artikel_tag]);
    });

    /** Update dan Add Berita  **/
    $router->post('/artikel', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_artikel'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "artikel";
        include($path . 'artikel/aksi.php');
    });

    /** Delete Berita **/
    $router->get('/artikel-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "artikel";
        include($path . 'artikel/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router Sidebar Links
 * ------------------------------------------------------
 */

    /** Url Sidebar Links **/
    $router->get('/sidebarlinks', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM sidebarlinks")->fetchAll();
        echo $jmw->render('modul/sidebarlinks/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form Sidebar Links **/
    $router->get('/sidebarlinks-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/sidebarlinks/index', ['act' => 'add']);
    });

    /** Show Edit Form Sidebar Links **/
    $router->get('/sidebarlinks-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM sidebarlinks WHERE id_link = $id ")->fetch();
        echo $jmw->render('modul/sidebarlinks/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add Sidebar Links  **/
    $router->post('/sidebarlinks', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_link'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "sidebarlinks";
        include($path . 'sidebarlinks/aksi.php');
    });

    /** Delete Sidebar Links **/
    $router->get('/sidebarlinks-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "sidebarlinks";
        include($path . 'sidebarlinks/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router Footer Links
 * ------------------------------------------------------
 */

    /** Url Footer Links **/
    $router->get('/footerlinks', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM footerlinks")->fetchAll();
        echo $jmw->render('modul/footerlinks/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form Sidebar Links **/
    $router->get('/footerlinks-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/footerlinks/index', ['act' => 'add']);
    });

    /** Show Edit Form Sidebar Links **/
    $router->get('/footerlinks-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM footerlinks WHERE id_link = $id ")->fetch();
        echo $jmw->render('modul/footerlinks/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add Sidebar Links  **/
    $router->post('/footerlinks', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_link'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "footerlinks";
        include($path . 'footerlinks/aksi.php');
    });

    /** Delete Sidebar Links **/
    $router->get('/footerlinks-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "footerlinks";
        include($path . 'footerlinks/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router Gallery
 * ------------------------------------------------------
 */

    /** Url gallery **/
    $router->get('/gallery', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM gallery")->fetchAll();
        echo $jmw->render('modul/gallery/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form gallery **/
    $router->get('/gallery-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/gallery/index', ['act' => 'add']);
    });

    /** Show Edit Form gallery **/
    $router->get('/gallery-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM gallery WHERE id_gallery = $id ")->fetch();
        echo $jmw->render('modul/gallery/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add gallery  **/
    $router->post('/gallery', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_gallery'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "gallery";
        include($path . 'gallery/aksi.php');
    });

    /** Delete gallery **/
    $router->get('/gallery-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "gallery";
        include($path . 'gallery/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router Page
 * ------------------------------------------------------
 */

    /** Url Home SEO **/
    $router->get('/home', function () use ($jmw, $db, $path) {
        $data = $db->connection("SELECT * FROM page WHERE id_page = 0 ")->fetch();
        echo $jmw->render('modul/page/index', ['act' => 'edit', 'row' => $data]);
    });

    /** Url Page **/
    $router->get('/page-edit-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data = $db->connection("SELECT * FROM page WHERE id_page = $id ")->fetch();
        echo $jmw->render('modul/page/index', ['act' => 'edit', 'row' => $data]);
    });

    /** Update Page **/
    $router->post('/page', function () use ($jmw, $db, $path, $msg) {
        $id  = $_POST['id_page'];
        $act = "update";
        if ($id == 0) {
            $hal = "home";
        } elseif ($id == 13) {
            $hal = "quote";
        } elseif ($id == 3) {
            $hal = "prakata";
        } elseif ($id == 14) {
            $hal = "profile-video";
        } elseif ($id == 8) {
            $hal = "kontak";
        }

        include('modul/page/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router Module
 * ------------------------------------------------------
 */

    /** Url Module **/
    $router->get('/module', function () use ($jmw, $db, $path) {
        $data = $db->connection("SELECT * FROM modul WHERE tampil='Ya' ORDER BY no_urut ASC");
        echo $jmw->render('modul/modul/index', ['act' => 'list', 'tampil' => $data]);
    });

    /** Edit Module **/
    $router->get('/module-edit-(\d+)', function ($id) use ($jmw, $db, $path) {
        $edit = $db->connection("SELECT * FROM modul WHERE id_modul= $id ");
        echo $jmw->render('modul/modul/index', ['act' => 'edit', 'edit' => $edit]);
    });

    /** Update Module **/
    $router->post('/module', function () use ($jmw, $db, $path, $msg) {
        $act = "update";
        $hal = "module";
        include('modul/modul/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router Sosial Media
 * ------------------------------------------------------
 */

    /** Url Module **/
    $router->get('/social-media', function () use ($jmw, $db, $path) {
        $data = $db->connection("SELECT * FROM social_media  WHERE status ='on' ");
        echo $jmw->render('modul/social_media/index', ['act' => 'list', 'tampil' => $data]);
    });

    /** Edit Module **/
    $router->get('/social-media-edit-(\d+)', function ($id) use ($jmw, $db, $path) {
        $edit = $db->connection("SELECT * FROM social_media WHERE id_social_media= $id ")->fetch();
        echo $jmw->render('modul/social_media/index', ['act' => 'edit', 'data' => $edit]);
    });

    /** Update Module **/
    $router->post('/social-media', function () use ($jmw, $db, $path) {
        $act = "update";
        $hal = "social-media";
        include('modul/social_media/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router artikel_tag
 * ------------------------------------------------------
 */

    /** Url artikel_tag **/
    $router->get('/artikel_tag', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM artikel_tag ");
        echo $jmw->render('modul/artikel_tag/index', ['act' => 'list', 'tampil' => $dataku]);
    });

    /** Show Add Form Artikel **/
    $router->get('/artikel_tag-add', function () use ($jmw, $db) {
        $artikel_tag = $db->connection("SELECT * FROM artikel_tag ")->fetchAll();
        echo $jmw->render('modul/artikel_tag/index', ['act' => 'add', 'artikel_tag' => $artikel_tag]);
    });

    /** Show Edit Form Artikel **/
    $router->get('/artikel_tag-edit-(\d+)', function ($id) use ($jmw, $db) {
        $artikel_tag = $db->connection("SELECT * FROM artikel_tag ");
        $artikel_artikel_tag = $db->connection("SELECT * FROM detail_artikel_tag  WHERE id_artikel = $id ")->fetchAll();
        $data = $db->connection("SELECT * FROM artikel WHERE id_artikel = $id ")->fetch();
        echo $jmw->render('modul/artikel_tag/index', ['act' => 'edit', 'data' => $data, 'kat' => $kat, 'artikel_tag' => $artikel_tag, 'artikel_artikel_tag' => $artikel_artikel_tag]);
    });

    /** Update dan Add Artikel  **/
    $router->post('/artikel_tag', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_artikel_tag'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "artikel_tag";
        include($path . 'artikel_tag/aksi.php');
    });

    /** Delete Artikel **/
    $router->get('/artikel_tag-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "artikel_tag";
        include($path . 'artikel_tag/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router Foto
 * ------------------------------------------------------
 */

    /** Url foto **/
    $router->get('/foto', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM foto ORDER BY tgl ASC");
        echo $jmw->render('modul/foto/index', ['act' => 'list', 'tampil' => $dataku]);
    });

    /** Show Add Form foto **/
    $router->get('/foto-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/foto/index', ['act' => 'add']);
    });

    /** Show Edit Form foto **/
    $router->get('/foto-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data    = $db->connection("SELECT * FROM foto WHERE id_foto = $id ")->fetch();
        // $gallery    = $db->connection("SELECT * FROM gallery_foto WHERE id_foto = $id ")->fetchAll();
        echo $jmw->render('modul/foto/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add foto  **/
    $router->post('/foto', function () use ($jmw, $db, $path) {
        if (isset($_POST['id_foto'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "foto";
        include($path . 'foto/aksi.php');
    });

    /** Delete foto **/
    $router->get('/foto-delete-(\d+)', function ($id) use ($jmw, $db, $path) {
        $act = "remove";
        $hal = "foto";
        include($path . 'foto/aksi.php');
    });


    /** Show Add Form client foto **/
    $router->get('/foto-addgallery-(\d+)', function ($id) use ($jmw, $db) {
        echo $jmw->render('modul/foto/index', ['act' => 'addgallery', 'id' => $id]);
    });


    /** Show Edit Form  client foto **/
    $router->get('/foto-editgallery-(\d+)', function ($id) use ($jmw, $db) {
        $data    = $db->connection("SELECT * FROM gallery_foto WHERE id_gallery = $id ")->fetch();
        echo $jmw->render('modul/foto/index', ['act' => 'editgallery', 'data' => $data]);
    });


    /** Update dan Add  client foto  **/
    $router->post('/foto-gallery', function () use ($jmw, $db, $path) {
        if (isset($_POST['id'])) {
            $act = "editgallery";
        } else {
            $act = "addgallery";
        }
        $hal = "foto";
        include($path . 'foto/aksi.php');
    });


    /** Delete client foto **/
    $router->get('/foto-client-delete-(\d+)-(\d+)', function ($id, $id_foto) use ($jmw, $db, $path, $imgname1) {
        $act = "removeclient";
        $hal = "foto";
        include($path . 'foto/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router material
 * ------------------------------------------------------
 */

    /** Url material **/
    $router->get('/material', function () use ($jmw, $db, $msg) {
        $dataku = $db->connection("SELECT * FROM material  ORDER BY tgl ASC");
        echo $jmw->render('modul/material/index', ['act' => 'list', 'tampil' => $dataku]);
    });

    /** Show Add Form material **/
    $router->get('/material-add', function () use ($jmw, $db, $msg) {
        echo $jmw->render('modul/material/index', ['act' => 'add']);
    });

    /** Show Edit Form material **/
    $router->get('/material-edit-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $gallery    = $db->connection("SELECT * FROM gallery_material WHERE id_material = $id ")->fetchAll();
        $data    = $db->connection("SELECT * FROM material WHERE id_material = $id ")->fetch();
        echo $jmw->render('modul/material/index', ['act' => 'edit', 'data' => $data, 'gallery' => $gallery]);
    });

    /** Update dan Add material  **/
    $router->post('/material', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_material'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "material";
        include($path . 'material/aksi.php');
    });

    /** Delete material **/
    $router->get('/material-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "material";
        include($path . 'material/aksi.php');
    });

    /** Show Add Form Gallery referensi **/
    $router->get('/material-addgallery-(\d+)', function ($id) use ($jmw, $db, $msg) {
        echo $jmw->render('modul/material/index', ['act' => 'addgallery', 'id' => $id]);
    });


    /** Show Edit Form  Gallery referensi **/
    $router->get('/material-editgallery-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data    = $db->connection("SELECT * FROM gallery_material WHERE id_gallery = $id ")->fetch();
        echo $jmw->render('modul/material/index', ['act' => 'editgallery', 'data' => $data]);
    });


    /** Update dan Add  Gallery referensi  **/
    $router->post('/material-gallery', function () use ($jmw, $db, $path, $msg, $imgname1) {
        if (isset($_POST['id'])) {
            $act = "editgallery";
        } else {
            $act = "addgallery";
        }
        $hal = "material";
        include($path . 'material/aksi.php');
    });

    /** Delete Gallery referensi **/
    $router->get('/material-gallery-delete-(\d+)-(\d+)', function ($id, $id_material) use ($jmw, $db, $path, $imgname1, $msg) {
        $act = "removegallery";
        $hal = "material";
        include($path . 'material/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router referensi
 * ------------------------------------------------------
 */

    /** Url referensi **/
    $router->get('/referensi', function () use ($jmw, $db, $msg) {
        $dataku = $db->connection("SELECT * FROM referensi  ORDER BY tgl ASC");
        echo $jmw->render('modul/referensi/index', ['act' => 'list', 'tampil' => $dataku]);
    });

    /** Show Add Form referensi **/
    $router->get('/referensi-add', function () use ($jmw, $db, $msg) {
        echo $jmw->render('modul/referensi/index', ['act' => 'add']);
    });

    /** Show Edit Form referensi **/
    $router->get('/referensi-edit-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data    = $db->connection("SELECT * FROM referensi WHERE id_referensi = $id ")->fetch();
        $gallery = $db->connection("SELECT * FROM gallery_referensi WHERE id_referensi='$data[id_referensi]' ORDER BY id_gallery ASC")->fetchAll();
        echo $jmw->render('modul/referensi/index', ['act' => 'edit', 'data' => $data, 'gallery' => $gallery]);
    });

    /** Update dan Add referensi  **/
    $router->post('/referensi', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_referensi'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "referensi";
        include($path . 'referensi/aksi.php');
    });

    /** Delete referensi **/
    $router->get('/referensi-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "referensi";
        include($path . 'referensi/aksi.php');
    });


    /** Show Add Form Gallery referensi **/
    $router->get('/referensi-addgallery-(\d+)', function ($id) use ($jmw, $db, $msg) {
        echo $jmw->render('modul/referensi/index', ['act' => 'addgallery', 'id' => $id]);
    });


    /** Show Edit Form  Gallery referensi **/
    $router->get('/referensi-editgallery-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data    = $db->connection("SELECT * FROM gallery_referensi WHERE id_gallery = $id ")->fetch();
        echo $jmw->render('modul/referensi/index', ['act' => 'editgallery', 'data' => $data]);
    });


    /** Update dan Add  Gallery referensi  **/
    $router->post('/referensi-gallery', function () use ($jmw, $db, $path, $msg, $imgname1) {
        if (isset($_POST['id'])) {
            $act = "editgallery";
        } else {
            $act = "addgallery";
        }
        $hal = "referensi";
        include($path . 'referensi/aksi.php');
    });

    /** Delete Gallery referensi **/
    $router->get('/referensi-gallery-delete-(\d+)-(\d+)', function ($id, $id_referensi) use ($jmw, $db, $path, $imgname1, $msg) {
        $act = "removegallery";
        $hal = "referensi";
        include($path . 'referensi/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router Video
 * ------------------------------------------------------
 */

    /** Url video **/
    $router->get('/banner', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM banner")->fetchAll();
        echo $jmw->render('modul/banner/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form video **/
    $router->get('/banner-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/banner/index', ['act' => 'add']);
    });

    /** Show Edit Form video **/
    $router->get('/banner-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM banner WHERE id_banner = $id ")->fetch();
        echo $jmw->render('modul/banner/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add video  **/
    $router->post('/banner', function () use ($jmw, $db, $path) {
        if (isset($_POST['id_banner'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "banner";
        include($path . 'banner/aksi.php');
    });

    /** Delete video **/
    $router->get('/banner-delete-(\d+)', function ($id) use ($jmw, $db, $path) {
        $act = "remove";
        $hal = "banner";
        include($path . 'banner/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router Transportasi
 * ------------------------------------------------------
 */

    /** Url Transportasi **/
    $router->get('/transportasi', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM transportasi")->fetchAll();
        echo $jmw->render('modul/transportasi/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form Transportasi **/
    $router->get('/transportasi-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/transportasi/index', ['act' => 'add']);
    });

    /** Show Edit Form Transportasi **/
    $router->get('/transportasi-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM transportasi WHERE id_transportasi = $id ")->fetch();
        echo $jmw->render('modul/transportasi/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add Transportasi  **/
    $router->post('/transportasi', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_transportasi'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "transportasi";
        include($path . 'transportasi/aksi.php');
    });

    /** Delete Transportasi **/
    $router->get('/transportasi-delete-(\d+)', function ($id) use ($jmw, $db, $path) {
        $act = "remove";
        $hal = "transportasi";
        include($path . 'transportasi/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router packages
 * ------------------------------------------------------
 */

    /** Url packages **/
    $router->get('/packages', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT *,pk.judul AS kategori FROM produk_k pk  JOIN packages p  ON pk.id_produk_k = p.id_produk_k  ORDER BY p.id_packages DESC")->fetchAll();
        echo $jmw->render('modul/packages/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form packages **/
    $router->get('/packages-add', function () use ($jmw, $db) {
        $kategori = $db->read("produk_k")->fetchAll();
        echo $jmw->render('modul/packages/index', ['act' => 'add', 'kategori' => $kategori]);
    });

    /** Show Edit Form packages **/
    $router->get('/packages-edit-(\d+)', function ($id) use ($jmw, $db) {
        $kategori = $db->read("produk_k");
        $data = $db->connection("SELECT * FROM packages WHERE id_packages = $id ")->fetch();
        $gallery = $db->connection("SELECT * FROM gallery_packages WHERE id_packages = $id ")->fetchAll();
        echo $jmw->render('modul/packages/index', ['act' => 'edit', 'data' => $data, 'kategori' => $kategori, 'gallery' => $gallery]);
    });

    /** Update dan Add packages  **/
    $router->post('/packages', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_packages'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "packages";
        include($path . 'packages/aksi.php');
    });

    /** Delete packages **/
    $router->get('/packages-delete-(\d+)', function ($id) use ($jmw, $db, $path) {
        $act = "remove";
        $hal = "packages";
        include($path . 'packages/aksi.php');
    });

    /** Show Add Form Gallery alumina **/
    $router->get('/packages-addgallery-(\d+)', function ($id) use ($jmw, $db, $msg) {
        echo $jmw->render('modul/packages/index', ['act' => 'addgallery', 'id' => $id]);
    });


    /** Show Edit Form  Gallery alumina **/
    $router->get('/packages-editgallery-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data    = $db->connection("SELECT * FROM gallery_packages WHERE id_gallery = $id ")->fetch();
        echo $jmw->render('modul/packages/index', ['act' => 'editgallery', 'data' => $data]);
    });


    /** Update dan Add  Gallery alumina  **/
    $router->post('/packages-gallery', function () use ($jmw, $db, $path, $msg, $imgname1) {
        if (isset($_POST['id'])) {
            $act = "editgallery";
        } else {
            $act = "addgallery";
        }
        $hal = "packages";
        include($path . 'packages/aksi.php');
    });


    /** Delete Gallery alumina **/
    $router->get('/packages-gallery-delete-(\d+)-(\d+)', function ($id, $id_packages) use ($jmw, $db, $path, $imgname1, $msg) {
        $act = "removegallery";
        $hal = "packages";
        include($path . 'packages/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router alumina
 * ------------------------------------------------------
 */

    /** Url alumina **/
    $router->get('/alumina', function () use ($jmw, $db, $msg) {
        $dataku = $db->connection("SELECT * FROM alumina  ORDER BY tgl ASC");

        echo $jmw->render('modul/alumina/index', ['act' => 'list', 'tampil' => $dataku]);
    });

    /** Show Add Form alumina **/
    $router->get('/alumina-add', function () use ($jmw, $db, $msg) {
        echo $jmw->render('modul/alumina/index', ['act' => 'add']);
    });

    /** Show Edit Form alumina **/
    $router->get('/alumina-edit-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data    = $db->connection("SELECT * FROM alumina WHERE id_alumina = $id ")->fetch();
        echo $jmw->render('modul/alumina/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add alumina  **/
    $router->post('/alumina', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_alumina'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "alumina";
        include($path . 'alumina/aksi.php');
    });

    /** Delete alumina **/
    $router->get('/alumina-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "alumina";
        include($path . 'alumina/aksi.php');
    });


    /** Show Add Form Gallery alumina **/
    $router->get('/alumina-addgallery-(\d+)', function ($id) use ($jmw, $db, $msg) {
        echo $jmw->render('modul/alumina/index', ['act' => 'addgallery', 'id' => $id]);
    });


    /** Show Edit Form  Gallery alumina **/
    $router->get('/alumina-editgallery-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data    = $db->connection("SELECT * FROM gallery_alumina WHERE id_gallery = $id ")->fetch();
        echo $jmw->render('modul/alumina/index', ['act' => 'editgallery', 'data' => $data]);
    });


    /** Update dan Add  Gallery alumina  **/
    $router->post('/alumina-gallery', function () use ($jmw, $db, $path, $msg, $imgname1) {
        if (isset($_POST['id'])) {
            $act = "editgallery";
        } else {
            $act = "addgallery";
        }
        $hal = "alumina";
        include($path . 'alumina/aksi.php');
    });


    /** Delete Gallery alumina **/
    $router->get('/alumina-gallery-delete-(\d+)-(\d+)', function ($id, $id_alumina) use ($jmw, $db, $path, $imgname1, $msg) {
        $act = "removegallery";
        $hal = "alumina";
        include($path . 'alumina/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router Produk
 * ------------------------------------------------------
 */

    /** Url produk **/
    $router->get('/produk', function () use ($jmw, $db, $msg) {
        $dataku = $db->connection("SELECT * FROM produk  ORDER BY id_produk DESC");
        $menu = $db->read("menu")->fetchAll();
        echo $jmw->render('modul/produk/index', ['act' => 'list', 'tampil' => $dataku, 'menu' => $menu]);
    });

    /** Show Add Form produk **/
    $router->get('/produk-add', function () use ($jmw, $db, $msg) {
        $kategori = $db->connection("SELECT * FROM produk_k ")->fetchAll();
        $menu = $db->read("menu")->fetchAll();
        $tag = $db->connection("SELECT * FROM produk_tag ")->fetchAll();
        echo $jmw->render('modul/produk/index', ['act' => 'add', 'kategori' => $kategori, 'menu' => $menu, 'tag' => $tag]);
    });


    /** Show Edit Form produk **/
    $router->get('/produk-edit-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data       = $db->connection("SELECT * FROM produk WHERE id_produk = $id ")->fetch();
        $kategori   = $db->connection("SELECT * FROM produk_k ")->fetchAll();
        $kat        = $db->connection("SELECT k.id_produk_k FROM produk_sk sk JOIN produk_k k ON sk.id_produk_k = k.id_produk_k WHERE sk.id_produk_sk = $data[id_produk_sk] ")->fetchColumn();
        // $sub        = $db->connection("SELECT * FROM produk_sk WHERE id_produk_k = $kat ")->fetchAll();
        $sub        = $db->connection("SELECT * FROM produk_sk WHERE id_produk_k = $data[id_produk_k] ")->fetchAll();
        $gallery    = $db->connection("SELECT * FROM gallery_produk WHERE id_produk = $id ")->fetchAll();

        $size = $db->connection("SELECT * FROM produk_size WHERE id_produk =$id ");
        $tag = $db->connection("SELECT * FROM produk_tag ");
        $artikel_tag = $db->connection("SELECT * FROM detail_tag  WHERE id_produk = $id ")->fetchAll();
        echo $jmw->render('modul/produk/index', ['act' => 'edit', 'data' => $data, 'kategori' => $kategori, 'sub' => $sub, 'gallery' => $gallery, 'tag' => $tag, 'produk_tag' => $artikel_tag, 'size' => $size,]);
    });

    /** Update dan Add produk  **/
    $router->post('/produk', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_produk'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "produk";
        include($path . 'produk/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router Slider
 * ------------------------------------------------------
 */

    /** Url slider **/
    $router->get('/slider', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM slider")->fetchAll();
        echo $jmw->render('modul/slider/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form slider **/
    $router->get('/slider-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/slider/index', ['act' => 'add']);
    });

    /** Show Edit Form slider **/
    $router->get('/slider-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM slider WHERE id_slider = $id ")->fetch();
        echo $jmw->render('modul/slider/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add slider  **/
    $router->post('/slider', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_slider'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "slider";
        include($path . 'slider/aksi.php');
    });

    /** Delete slider **/
    $router->get('/slider-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "slider";
        include($path . 'slider/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router sizechart
 * ------------------------------------------------------
 */

    /** Url sizechart **/
    $router->get('/inspection', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM sizechart WHERE id_sizechart != 23 AND id_sizechart != 24 AND id_sizechart != 26")->fetchAll();
        echo $jmw->render('modul/sizechart/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    $router->get('/sizechart', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM sizechart WHERE id_sizechart != 25 AND id_sizechart != 26 AND id_sizechart != 27")->fetchAll();
        echo $jmw->render('modul/sizechart/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form sizechart **/
    $router->get('/sizechart-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/sizechart/index', ['act' => 'add']);
    });

    /** Show Edit Form sizechart **/
    $router->get('/sizechart-edit-(\d+)', function ($id) use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM sizechart_sub WHERE id_sizechart = $id ");
        $data = $db->connection("SELECT * FROM sizechart WHERE id_sizechart = $id ")->fetch();
        echo $jmw->render('modul/sizechart/index', ['act' => 'edit', 'data' => $data, 'dataku' => $dataku]);
    });

    /** Update dan Add sizechart  **/
    $router->post('/sizechart', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_sizechart'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "sizechart";
        include($path . 'sizechart/aksi.php');
    });

    /** Delete sizechart **/
    $router->get('/sizechart-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "sizechart";
        include($path . 'sizechart/aksi.php');
    });

    $router->get('/service-add-(\d+)', function ($id) use ($jmw, $db, $msg) {
        //$kategori = $db->connection("SELECT * FROM produk_kategori ")->fetch();
        echo $jmw->render('modul/sizechart/index', ['act' => 'addService', 'id_sizechart' => $id]);
    });

    /** Update dan Add produk  **/
    $router->post('/sizechart-service', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_sizechart_sub'])) {
            $act = "updateService";
        } else {
            $act = "addService";
        }
        $hal = "sizechart";
        include($path . 'sizechart/aksi.php');
    });

    $router->get('/service-edit-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data = $db->connection("SELECT * FROM sizechart_sub WHERE id_sizechart_sub = $id ")->fetch();
        // $size = $db->connection("SELECT * FROM produk_size WHERE id_produk_varian = $id ")->fetchAll();
        // $gallery = $db->connection("SELECT * FROM gallery_produk_varian WHERE id_produk_varian = $id ")->fetchAll();
        echo $jmw->render('modul/sizechart/index', ['act' => 'editService', 'data' => $data]);
    });

    /** Delete produk **/
    $router->get('/service-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg, $imgname1) {
        $act = "removeService";
        $hal = "sizechart";
        include($path . 'sizechart/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router process
 * ------------------------------------------------------
 */

    /** Url process **/
    $router->get('/process', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM process")->fetchAll();
        echo $jmw->render('modul/process/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form process **/
    $router->get('/process-add', function () use ($jmw, $db) {
        $kategori = $db->connection("SELECT * FROM process_kat ")->fetchAll();

        echo $jmw->render('modul/process/index', ['act' => 'add', 'kategori' => $kategori]);
    });

    /** Show Edit Form process **/
    $router->get('/process-edit-(\d+)', function ($id) use ($jmw, $db) {
        $kategori = $db->connection("SELECT * FROM process_kat ")->fetchAll();
        $data = $db->connection("SELECT * FROM process WHERE id_process = $id ")->fetch();
        echo $jmw->render('modul/process/index', ['act' => 'edit', 'data' => $data, 'kategori' => $kategori]);
    });

    /** Update dan Add process  **/
    $router->post('/process', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_process'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "process";
        include($path . 'process/aksi.php');
    });

    /** Delete process **/
    $router->get('/process-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "process";
        include($path . 'process/aksi.php');
    });

    $router->get('/maintraining-add-(\d+)', function ($id) use ($jmw, $db, $msg) {
        //$kategori = $db->connection("SELECT * FROM produk_kategori ")->fetch();
        echo $jmw->render('modul/process/index', ['act' => 'addMainTraining', 'id_process' => $id]);
    });

    /** Update dan Add produk  **/
    $router->post('/process-maintraining', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_process_kat'])) {
            $act = "updateMainTraining";
        } else {
            $act = "addMainTraining";
        }
        $hal = "process";
        include($path . 'process/aksi.php');
    });

    $router->get('/maintraining-edit-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data = $db->connection("SELECT * FROM process_kat WHERE id_process_kat = $id ")->fetch();
        $dataku = $db->connection("SELECT * FROM process_sub WHERE id_process_kat = $id ");
        $gallery = $db->connection("SELECT * FROM gallery_process_kat WHERE id_process_kat='$data[id_process_kat]' ORDER BY id_gallery ASC")->fetchAll();
        // $size = $db->connection("SELECT * FROM produk_size WHERE id_produk_varian = $id ")->fetchAll();
        // $gallery = $db->connection("SELECT * FROM gallery_produk_varian WHERE id_produk_varian = $id ")->fetchAll();
        echo $jmw->render('modul/process/index', ['act' => 'editMainTraining', 'data' => $data, 'dataku' => $dataku, 'gallery' => $gallery]);
    });

    /** Delete produk **/
    $router->get('/maintraining-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg, $imgname1) {
        $act = "removeMainTraining";
        $hal = "process";
        include($path . 'process/aksi.php');
    });


    /** Show Add Form Gallery kategori **/
    $router->get('/process-addgallery-(\d+)', function ($id) use ($jmw, $db, $msg) {
        echo $jmw->render('modul/process/index', ['act' => 'addgallery', 'id' => $id]);
    });


    /** Show Edit Form  Gallery partner **/
    $router->get('/process-editgallery-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data    = $db->connection("SELECT * FROM gallery_process_kat WHERE id_gallery = $id ")->fetch();
        echo $jmw->render('modul/process/index', ['act' => 'editgallery', 'data' => $data]);
    });


    /** Update dan Add  Gallery partner  **/
    $router->post('/process-gallery', function () use ($jmw, $db, $path, $msg, $imgname1) {
        if (isset($_POST['id'])) {
            $act = "editgallery";
        } else {
            $act = "addgallery";
        }
        $hal = "process";
        include($path . 'process/aksi.php');
    });


    /** Delete Gallery partner **/
    $router->get('/process-gallery-delete-(\d+)-(\d+)', function ($id, $id_kategori) use ($jmw, $db, $path, $imgname1, $msg) {
        $act = "removegallery";
        $hal = "process";
        include($path . 'process/aksi.php');
    });


    $router->get('/training-add-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $id_process = $db->connection("SELECT id_process FROM process_kat WHERE id_process_kat = $id ")->fetch();
        echo $jmw->render('modul/process/index', ['act' => 'addTraining', 'id_process_kat' => $id, 'id_process' => $id_process]);
    });

    /** Update dan Add produk  **/
    $router->post('/process-training', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_process_sub'])) {
            $act = "updateTraining";
        } else {
            $act = "addTraining";
        }
        $hal = "process";
        include($path . 'process/aksi.php');
    });

    $router->get('/training-edit-(\d+)', function ($id) use ($jmw, $db, $msg) {
        $data = $db->connection("SELECT * FROM process_sub WHERE id_process_sub = $id ")->fetch();
        // $size = $db->connection("SELECT * FROM produk_size WHERE id_produk_varian = $id ")->fetchAll();
        // $gallery = $db->connection("SELECT * FROM gallery_produk_varian WHERE id_produk_varian = $id ")->fetchAll();
        echo $jmw->render('modul/process/index', ['act' => 'editTraining', 'data' => $data]);
    });

    /** Delete produk **/
    $router->get('/training-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg, $imgname1) {
        $act = "removeTraining";
        $hal = "process";
        include($path . 'process/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router process_kat
 * ------------------------------------------------------
 */

    /** Url produk_k **/
    $router->get('process_kat', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM process_kat");
        echo $jmw->render('modul/process_kat/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form produk_k **/
    $router->get('process_kat-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/process_kat/index', ['act' => 'add']);
    });

    /** Show Edit Form produk_k **/
    $router->get('process_kat-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM process_kat WHERE id_process_kat = $id ")->fetch();
        echo $jmw->render('modul/process_kat/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add produk_k  **/
    $router->post('process_kat', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_process_kat'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "process_kat";
        include($path . 'process_kat/aksi.php');
    });

    /** Delete produk_k **/
    $router->get('process_kat-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "process_kat";
        include($path . 'process_kat/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router request
 * ------------------------------------------------------
 */

    /** Url request **/
    $router->get('/request', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM quotation ORDER BY is_read DESC, id_quotation DESC");
        echo $jmw->render('modul/request/index', ['act' => 'list', 'tampil' => $dataku]);
    });

    /** Show Add Form request **/
    $router->get('/request-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/request/index', ['act' => 'add']);
    });

    /** Show Edit Form request **/
    $router->get('/request-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM request WHERE id_request = $id ")->fetch();
        echo $jmw->render('modul/request/index', ['act' => 'edit', 'data' => $data]);
    });

    $router->get('/request-view-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM quotation WHERE id_quotation = $id ")->fetch();
        $db->update("quotation", array('is_read' => 1), "id_quotation = $data[id_quotation] ");
        echo $jmw->render('modul/request/index', ['act' => 'view', 'data' => $data]);
    });

    /** Update dan Add request  **/
    $router->post('/request', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_request'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "request";
        include($path . 'request/aksi.php');
    });

    $router->get('/request-excel-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "excel";
        $hal = "request";
        include($path . 'request/aksi.php');
    });

    /** Delete request **/
    $router->get('/request-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "request";
        include($path . 'request/aksi.php');
    });
    /*
 * ------------------------------------------------------
 *  Router sliderbot
 * ------------------------------------------------------
 */

    /** Url sliderbot **/
    $router->get('/sliderbot', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM sliderbot")->fetchAll();
        echo $jmw->render('modul/sliderbot/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form sliderbot **/
    $router->get('/sliderbot-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/sliderbot/index', ['act' => 'add']);
    });

    /** Show Edit Form sliderbot **/
    $router->get('/sliderbot-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM sliderbot WHERE id_sliderbot = $id ")->fetch();
        echo $jmw->render('modul/sliderbot/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add sliderbot  **/
    $router->post('/sliderbot', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_sliderbot'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "sliderbot";
        include($path . 'sliderbot/aksi.php');
    });

    /** Delete sliderbot **/
    $router->get('/sliderbot-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "sliderbot";
        include($path . 'sliderbot/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router sliderpro
 * ------------------------------------------------------
 */

    /** Url sliderpro **/
    $router->get('/sliderpro', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM sliderpro")->fetchAll();
        echo $jmw->render('modul/sliderpro/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form sliderpro **/
    $router->get('/sliderpro-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/sliderpro/index', ['act' => 'add']);
    });

    /** Show Edit Form sliderpro **/
    $router->get('/sliderpro-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM sliderpro WHERE id_sliderpro = $id ")->fetch();
        echo $jmw->render('modul/sliderpro/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add sliderpro  **/
    $router->post('/sliderpro', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_sliderpro'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "sliderpro";
        include($path . 'sliderpro/aksi.php');
    });

    /** Delete sliderpro **/
    $router->get('/sliderpro-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "sliderpro";
        include($path . 'sliderpro/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router gallerym
 * ------------------------------------------------------
 */

    /** Url gallerym **/
    $router->get('/gallerym', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM gallerym")->fetchAll();
        echo $jmw->render('modul/gallerym/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form gallerym **/
    $router->get('/gallerym-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/gallerym/index', ['act' => 'add']);
    });

    /** Show Edit Form gallerym **/
    $router->get('/gallerym-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM gallerym WHERE id_gallerym = $id ")->fetch();
        echo $jmw->render('modul/gallerym/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add gallerym  **/
    $router->post('/gallerym', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_gallerym'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "gallerym";
        include($path . 'gallerym/aksi.php');
    });

    /** Delete gallerym **/
    $router->get('/gallerym-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "gallerym";
        include($path . 'gallerym/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router listproject
 * ------------------------------------------------------
 */

    /** Url listproject **/
    $router->get('listproject', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM listproject");
        echo $jmw->render('modul/listproject/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form listproject **/
    $router->get('listproject-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/listproject/index', ['act' => 'add']);
    });

    /** Show Edit Form listproject **/
    $router->get('listproject-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM listproject WHERE id_listproject = $id ")->fetch();
        echo $jmw->render('modul/listproject/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add listproject  **/
    $router->post('listproject', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_listproject'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "listproject";
        include($path . 'listproject/aksi.php');
    });

    /** Delete listproject **/
    $router->get('listproject-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "listproject";
        include($path . 'listproject/aksi.php');
    });

    /** Url store **/
    $router->get('store', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM store");
        echo $jmw->render('modul/store/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form store **/
    $router->get('store-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/store/index', ['act' => 'add']);
    });

    /** Show Edit Form store **/
    $router->get('store-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM store WHERE id_store = $id ")->fetch();
        echo $jmw->render('modul/store/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add store  **/
    $router->post('store', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_store'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "store";
        include($path . 'store/aksi.php');
    });

    /** Delete store **/
    $router->get('store-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "store";
        include($path . 'store/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router kinerja
 * ------------------------------------------------------
 */

    /** Url kinerja **/
    $router->get('/kinerja', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM kinerja")->fetchAll();
        echo $jmw->render('modul/kinerja/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form kinerja **/
    $router->get('/kinerja-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/kinerja/index', ['act' => 'add']);
    });

    /** Show Edit Form kinerja **/
    $router->get('/kinerja-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM kinerja WHERE id_kinerja = $id ")->fetch();
        echo $jmw->render('modul/kinerja/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add kinerja  **/
    $router->post('/kinerja', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_kinerja'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "kinerja";
        include($path . 'kinerja/aksi.php');
    });

    /** Delete kinerja **/
    $router->get('/kinerja-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "kinerja";
        include($path . 'kinerja/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router laba_rugi
 * ------------------------------------------------------
 */

    /** Url laba_rugi **/
    $router->get('laba-rugi-(\d+)', function ($id_kinerja) use ($jmw, $db) {

        $data   = $db->connection("SELECT * FROM kinerja WHERE id_kinerja = $id_kinerja ")->fetch();
        $dataku = $db->connection("SELECT * FROM laba_rugi WHERE id_kinerja = $id_kinerja ")->fetch();
        echo $jmw->render('modul/laba_rugi/index', ['act' => 'list', 'dt' => $dataku, 'data' => $data]);
    });

    /** Update dan Add laba_rugi  **/
    $router->post('laba-rugi', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_laba_rugi'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "laba-rugi";
        include($path . 'laba_rugi/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router neraca
 * ------------------------------------------------------
 */

    /** Url neraca **/
    $router->get('neraca-(\d+)', function ($id_kinerja) use ($jmw, $db) {

        $data   = $db->connection("SELECT * FROM kinerja WHERE id_kinerja = $id_kinerja ")->fetch();
        $dataku = $db->connection("SELECT * FROM neraca WHERE id_kinerja = $id_kinerja ")->fetch();
        echo $jmw->render('modul/neraca/index', ['act' => 'list', 'dt' => $dataku, 'data' => $data]);
    });

    /** Update dan Add neraca  **/
    $router->post('neraca', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_neraca'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "neraca";
        include($path . 'neraca/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router arus_kas
 * ------------------------------------------------------
 */

    /** Url arus_kas **/
    $router->get('arus-kas-(\d+)', function ($id_kinerja) use ($jmw, $db) {

        $data   = $db->connection("SELECT * FROM kinerja WHERE id_kinerja = $id_kinerja ")->fetch();
        $dataku = $db->connection("SELECT * FROM arus_kas WHERE id_kinerja = $id_kinerja ")->fetch();
        echo $jmw->render('modul/arus_kas/index', ['act' => 'list', 'dt' => $dataku, 'data' => $data]);
    });

    /** Update dan Add arus_kas  **/
    $router->post('arus-kas', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_arus_kas'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "arus-kas";
        include($path . 'arus_kas/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router key_ratio
 * ------------------------------------------------------
 */

    /** Url key_ratio **/
    $router->get('key-ratio-(\d+)', function ($id_kinerja) use ($jmw, $db) {

        $data   = $db->connection("SELECT * FROM kinerja WHERE id_kinerja = $id_kinerja ")->fetch();
        $dataku = $db->connection("SELECT * FROM key_ratio WHERE id_kinerja = $id_kinerja ")->fetch();
        echo $jmw->render('modul/key_ratio/index', ['act' => 'list', 'dt' => $dataku, 'data' => $data]);
    });

    /** Update dan Add key_ratio  **/
    $router->post('key-ratio', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_key_ratio'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "key-ratio";
        include($path . 'key_ratio/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router testimoni
 * ------------------------------------------------------
 */

    /** Url testimoni **/
    $router->get('/testimoni', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM testimoni")->fetchAll();
        echo $jmw->render('modul/testimoni/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form testimoni **/
    $router->get('/testimoni-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/testimoni/index', ['act' => 'add']);
    });

    /** Show Edit Form testimoni **/
    $router->get('/testimoni-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM testimoni WHERE id_testimoni = $id ")->fetch();
        echo $jmw->render('modul/testimoni/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add testimoni  **/
    $router->post('/testimoni', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_testimoni'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "testimoni";
        include($path . 'testimoni/aksi.php');
    });

    /** Delete testimoni **/
    $router->get('/testimoni-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "testimoni";
        include($path . 'testimoni/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router keunggulan
 * ------------------------------------------------------
 */

    /** Url keunggulan **/
    $router->get('/keunggulan', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM keunggulan")->fetchAll();
        echo $jmw->render('modul/keunggulan/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form keunggulan **/
    $router->get('/keunggulan-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/keunggulan/index', ['act' => 'add']);
    });

    /** Show Edit Form keunggulan **/
    $router->get('/keunggulan-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM keunggulan WHERE id_keunggulan = $id ")->fetch();
        echo $jmw->render('modul/keunggulan/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add keunggulan  **/
    $router->post('/keunggulan', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_keunggulan'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "keunggulan";
        include($path . 'keunggulan/aksi.php');
    });

    /** Delete keunggulan **/
    $router->get('/keunggulan-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "keunggulan";
        include($path . 'keunggulan/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router portofolio
 * ------------------------------------------------------
 */

    /** Url portofolio **/
    $router->get('/portofolio', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM portofolio")->fetchAll();
        echo $jmw->render('modul/portofolio/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form portofolio **/
    $router->get('/portofolio-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/portofolio/index', ['act' => 'add']);
    });

    /** Show Edit Form portofolio **/
    $router->get('/portofolio-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM portofolio WHERE id_portofolio = $id ")->fetch();
        echo $jmw->render('modul/portofolio/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add portofolio  **/
    $router->post('/portofolio', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_portofolio'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "portofolio";
        include($path . 'portofolio/aksi.php');
    });

    /** Delete portofolio **/
    $router->get('/portofolio-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "portofolio";
        include($path . 'portofolio/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router client
 * ------------------------------------------------------
 */

    /** Url client **/
    $router->get('/client', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM client")->fetchAll();
        echo $jmw->render('modul/client/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form client **/
    $router->get('/client-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/client/index', ['act' => 'add']);
    });

    /** Show Edit Form client **/
    $router->get('/client-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM client WHERE id_client = $id ")->fetch();
        echo $jmw->render('modul/client/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add client  **/
    $router->post('/client', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_client'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "client";
        include($path . 'client/aksi.php');
    });

    /** Delete client **/
    $router->get('/client-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "client";
        include($path . 'client/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router keunggulan
 * ------------------------------------------------------
 */

    /** Url keunggulan **/
    $router->get('/keunggulan', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM keunggulan")->fetchAll();
        $icons = $db->connection("SELECT * FROM icon")->fetchAll();
        echo $jmw->render('modul/keunggulan/index', ['act' => 'list', 'dataku' => $dataku, 'icons' => $icons]);
    });

    /** Show Add Form keunggulan **/
    $router->get('/keunggulan-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/keunggulan/index', ['act' => 'add']);
    });

    /** Show Edit Form keunggulan **/
    $router->get('/keunggulan-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM keunggulan WHERE id_keunggulan = $id ")->fetch();
        echo $jmw->render('modul/keunggulan/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add keunggulan  **/
    $router->post('/keunggulan', function () use ($jmw, $db, $path) {
        if (isset($_POST['id_keunggulan'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "keunggulan";
        include($path . 'keunggulan/aksi.php');
    });

    /** Delete keunggulan **/
    $router->get('/keunggulan-delete-(\d+)', function ($id) use ($jmw, $db, $path) {
        $act = "remove";
        $hal = "keunggulan";
        include($path . 'keunggulan/aksi.php');
    });



    $router->get('/keuntungan', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM keuntungan")->fetchAll();
        $icons = $db->connection("SELECT * FROM icon")->fetchAll();
        echo $jmw->render('modul/keuntungan/index', ['act' => 'list', 'dataku' => $dataku, 'icons' => $icons]);
    });

    /** Show Add Form keunggulan **/
    $router->get('/keuntungan-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/keuntungan/index', ['act' => 'add']);
    });

    /** Show Edit Form keunggulan **/
    $router->get('/keuntungan-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM keuntungan WHERE id_keuntungan = $id ")->fetch();
        echo $jmw->render('modul/keuntungan/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add keunggulan  **/
    $router->post('/keuntungan', function () use ($jmw, $db, $path) {
        if (isset($_POST['id_keuntungan'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "keuntungan";
        include($path . 'keuntungan/aksi.php');
    });

    /** Delete keunggulan **/
    $router->get('/keuntungan-delete-(\d+)', function ($id) use ($jmw, $db, $path) {
        $act = "remove";
        $hal = "keuntungan";
        include($path . 'keuntungan/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router Artikel
 * ------------------------------------------------------
 */

    /** Url Artikel **/
    // $router->get('/artikel', function () use ($jmw, $db) {
    //     $dataku = $db->connection("SELECT * FROM artikel ORDER BY tgl DESC, id_artikel DESC");
    //     echo $jmw->render('modul/artikel/index', ['act' => 'list', 'tampil' => $dataku, 'per' => "all"]);
    // });

    /** Show Add Form Artikel **/
    // $router->get('/artikel-add', function () use ($jmw, $db) {
    //     $kategori = $db->connection("SELECT * FROM kategori ")->fetchAll();
    //     $tag = $db->connection("SELECT * FROM artikel_tag ")->fetchAll();
    //     echo $jmw->render('modul/artikel/index', ['act' => 'add', 'per' => "all", 'kategori' => $kategori, 'tag' => $tag]);
    // });

    /** Show Edit Form Artikel **/
    // $router->get('/artikel-edit-(\d+)', function ($id) use ($jmw, $db) {
    //     $data = $db->connection("SELECT * FROM artikel WHERE id_artikel = $id ")->fetch();
    //     $kategori = $db->connection("SELECT * FROM kategori ")->fetchAll();
    //     $tag = $db->connection("SELECT * FROM artikel_tag ");
    //     $artikel_tag = $db->connection("SELECT * FROM detail_tag2  WHERE id_artikel = $id ")->fetchAll();
    //     echo $jmw->render('modul/artikel/index', ['act' => 'edit', 'data' => $data, 'kategori' => $kategori, 'tag' => $tag, 'artikel_tag' => $artikel_tag]);
    // });

    /** Update dan Add Artikel  **/
    // $router->post('/artikel', function () use ($jmw, $db, $path, $msg) {
    //     if (isset($_POST['id_artikel'])) {
    //         $act = "update";
    //     } else {
    //         $act = "add";
    //     }
    //     $hal = "artikel";
    //     include($path . 'artikel/aksi.php');
    // });

    /** Delete Artikel **/
    // $router->get('/artikel-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
    //     $act = "remove";
    //     $hal = "artikel";
    //     include($path . 'artikel/aksi.php');
    // });

    /*
 * ------------------------------------------------------
 *  Router kategori
 * ------------------------------------------------------
 */

    /** Url kategori **/
    $router->get('kategori', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM kategori");
        echo $jmw->render('modul/kategori/index', ['act' => 'list', 'dataku' => $dataku]);
    });


    /** Show Add Form kategori **/
    $router->get('kategori-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/kategori/index', ['act' => 'add']);
    });

    /** Show Edit Form kategori **/
    $router->get('kategori-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM kategori WHERE id_kategori = $id ")->fetch();
        echo $jmw->render('modul/kategori/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add kategori  **/
    $router->post('kategori', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_kategori'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "kategori";
        include($path . 'kategori/aksi.php');
    });

    /** Delete kategori **/
    $router->get('kategori-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "kategori";
        include($path . 'kategori/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router faq
 * ------------------------------------------------------
 */

    /** Url faq **/
    $router->get('faq', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM faq");
        echo $jmw->render('modul/faq/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form faq **/
    $router->get('faq-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/faq/index', ['act' => 'add']);
    });

    /** Show Edit Form faq **/
    $router->get('faq-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM faq WHERE id_faq = $id ")->fetch();
        echo $jmw->render('modul/faq/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add faq  **/
    $router->post('faq', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_faq'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "faq";
        include($path . 'faq/aksi.php');
    });

    /** Delete faq **/
    $router->get('faq-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "faq";
        include($path . 'faq/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router supply
 * ------------------------------------------------------
 */

    /** Url supply **/
    $router->get('supply', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM supply ORDER BY id_supply DESC");
        echo $jmw->render('modul/supply/index', ['act' => 'list', 'datas' => $dataku]);
    });

    /** Show Add Form supply **/
    $router->get('supply-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/supply/index', ['act' => 'add']);
    });

    /** Show Edit Form supply **/
    $router->get('supply-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM supply WHERE id_supply = $id ")->fetch();
        echo $jmw->render('modul/supply/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add supply  **/
    $router->post('supply', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_supply'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "supply";
        include($path . 'supply/aksi.php');
    });

    /** Delete supply **/
    $router->get('supply-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "supply";
        include($path . 'supply/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router galgal
 * ------------------------------------------------------
 */

    /** Url galgal **/
    $router->get('/galgal', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM galgal")->fetchAll();
        echo $jmw->render('modul/galgal/index', ['act' => 'list', 'dataku' => $dataku]);
    });

    /** Show Add Form galgal **/
    $router->get('/galgal-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/galgal/index', ['act' => 'add']);
    });

    /** Show Edit Form galgal **/
    $router->get('/galgal-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM galgal WHERE id_galgal = $id ")->fetch();
        echo $jmw->render('modul/galgal/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add galgal  **/
    $router->post('/galgal', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_galgal'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "galgal";
        include($path . 'galgal/aksi.php');
    });

    /** Delete galgal **/
    $router->get('/galgal-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "galgal";
        include($path . 'galgal/aksi.php');
    });


    /*
 * ------------------------------------------------------
 *  Router menu
 * ------------------------------------------------------
 */

    /** Url menu **/
    $router->get('menu', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM menu ORDER BY urutan ASC ");
        echo $jmw->render('modul/menu/index', ['act' => 'list', 'dataku' => $dataku]);
    });


    /** Show Add Form menu **/
    $router->get('menu-add', function () use ($jmw, $db) {
        echo $jmw->render('modul/menu/index', ['act' => 'add']);
    });

    /** Show Edit Form menu **/
    $router->get('menu-edit-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM menu WHERE id_menu = $id ")->fetch();
        echo $jmw->render('modul/menu/index', ['act' => 'edit', 'data' => $data]);
    });

    /** Update dan Add menu  **/
    $router->post('menu', function () use ($jmw, $db, $path, $msg) {
        if (isset($_POST['id_menu'])) {
            $act = "update";
        } else {
            $act = "add";
        }
        $hal = "menu";
        include($path . 'menu/aksi.php');
    });

    /** Delete menu **/
    $router->get('menu-delete-(\d+)', function ($id) use ($jmw, $db, $path, $msg) {
        $act = "remove";
        $hal = "menu";
        include($path . 'menu/aksi.php');
    });

    /*
 * ------------------------------------------------------
 *  Router Pesan Contact
 * ------------------------------------------------------
 */

    /** Url List Pesan **/
    $router->get('/pesan', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM contact ");
        echo $jmw->render('modul/pesan/index', ['act' => 'list', 'tampil' => $dataku]);
    });

    /** Show Detail Pesan **/
    $router->get('/pesan-view-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM contact WHERE id_contact = $id ")->fetch();
        $db->update("contact", array('is_read' => 1), "id_contact = $data[id_contact] ");
        echo $jmw->render('modul/pesan/index', ['act' => 'view', 'data' => $data]);
    });

    /** Delete Pesan **/
    $router->get('/pesan-delete-(\d+)', function ($id) use ($jmw, $db, $path) {
        $act = "remove";
        $hal = "pesan";
        include($path . 'pesan/aksi.php');
    });

    /** Url List Pesan **/
    $router->get('/pendaftaran', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM pendaftaran ORDER BY id_pendaftaran DESC ");
        echo $jmw->render('modul/pendaftaran/index', ['act' => 'list', 'tampil' => $dataku]);
    });

    /** Show Detail Pesan **/
    $router->get('/pendaftaran-view-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM pendaftaran WHERE id_pendaftaran = $id ")->fetch();
        $db->update("pendaftaran", array('is_read' => 1), "id_pendaftaran = $data[id_pendaftaran] ");
        echo $jmw->render('modul/pendaftaran/index', ['act' => 'view', 'data' => $data]);
    });

    /** Delete Pesan **/
    $router->get('/pendaftaran-delete-(\d+)', function ($id) use ($jmw, $db, $path) {
        $act = "remove";
        $hal = "pendaftaran";
        include($path . 'pendaftaran/aksi.php');
    });


    /** Url List Pesan **/
    $router->get('/booking', function () use ($jmw, $db) {
        $dataku = $db->connection("SELECT * FROM booking ");
        echo $jmw->render('modul/booking/index', ['act' => 'list', 'tampil' => $dataku]);
    });

    /** Show Detail Pesan **/
    $router->get('/booking-view-(\d+)', function ($id) use ($jmw, $db) {
        $data = $db->connection("SELECT * FROM booking WHERE id_booking = $id ")->fetch();
        $db->update("booking", array('is_read' => 1), "id_booking = $data[id_booking] ");
        echo $jmw->render('modul/booking/index', ['act' => 'view', 'data' => $data]);
    });

    /** Delete Pesan **/
    $router->get('/booking-delete-(\d+)', function ($id) use ($jmw, $db, $path) {
        $act = "remove";
        $hal = "booking";
        include($path . 'booking/aksi.php');
    });


    /** Ganti Background Admin **/
    $router->post('/teemo', function () use ($db) {
        $tehe = $db->connection("SELECT * FROM theme")->fetchAll();

        if ($_POST['type'] == 'logobg') {

            if (empty($_POST['data']) || $_POST['data'] == '') {
                $data = $tehe[1]['code'];
            } else {
                $data = $_POST['data'];
            }
            $datas = array(
                'code' => $data
            );
            $db->update('theme', $datas, "id = 2");
            exit;
        } elseif ($_POST['type'] == 'navbarbg') {

            if (empty($_POST['data']) || $_POST['data'] == '') {
                $data = $tehe[0]['code'];
            } else {
                $data = $_POST['data'];
            }
            $datas = array(
                'code' => $data
            );

            $db->update('theme', $datas, "id = 1");
            exit;
        } elseif ($_POST['type'] == 'sidebarbg') {

            if (empty($_POST['data']) || $_POST['data'] == '') {
                $data = $tehe[2]['code'];
            } else {
                $data = $_POST['data'];
            }
            $datas = array(
                'code' => $data
            );

            $db->update('theme', $datas, "id = 3");
            exit;
        }
    });
});
