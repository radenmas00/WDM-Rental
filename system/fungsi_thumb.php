<?php

function UploadNyan($fupload_name, $lokasi)
{
    global $imgname1;
    global $imgname2;

    //direktori gambar
    $vdir_upload = "images/$lokasi/";
    $vdir_upload2 = "images/$lokasi/small/";
    $vfile_upload = $vdir_upload . $fupload_name;
    $tipe_file = $_FILES['nyanpload']['type'];

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["nyanpload"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipe_file == "image/jpeg") {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } elseif ($tipe_file == "image/png") {
        $im_src = imagecreatefrompng($vfile_upload);
    } elseif ($tipe_file == "image/gif") {
        $im_src = imagecreatefromgif($vfile_upload);
    } elseif ($tipe_file == "image/wbmp") {
        $im_src = imagecreatefromwbmp($vfile_upload);
    }
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    if ($src_width > 1000) {$dst_width = 1062;} else { $dst_width = $src_width;}
    $dst_height = ($dst_width / $src_width) * $src_height;

    $im = imagecreatetruecolor($dst_width, $dst_height);

    // Turn off transparency blending (temporarily)
    imagealphablending($im, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($im, 0, 0, 0, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($im, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($im, true);
    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    if ($_FILES["nyanpload"]["type"] == "image/jpeg") {
        imagejpeg($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["nyanpload"]["type"] == "image/png") {
        imagepng($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["nyanpload"]["type"] == "image/gif") {
        imagegif($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["nyanpload"]["type"] == "image/wbmp") {
        imagewbmp($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    }

    $dst_height2 = 531;
    $dst_width2 = ($dst_height2 / $src_height) * $src_width;

    $im2 = imagecreatetruecolor($dst_width2, $dst_height2);

    imagealphablending($im2, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($im2, 0, 0, 0, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($im2, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($im2, true);

    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

    if ($_FILES["nyanpload"]["type"] == "image/jpeg") {
        imagejpeg($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["nyanpload"]["type"] == "image/png") {
        imagepng($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["nyanpload"]["type"] == "image/gif") {
        imagegif($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["nyanpload"]["type"] == "image/wbmp") {
        imagewbmp($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    }

    imagedestroy($im_src);
    imagedestroy($im);
    imagedestroy($im2);
}

function UploadRuby($fupload_name, $lokasi)
{
    global $imgname1;
    global $imgname2;

    //direktori gambar
    $vdir_upload = "images/$lokasi/";
    $vdir_upload2 = "images/$lokasi/small/";
    $vfile_upload = $vdir_upload . $fupload_name;
    $tipe_file = $_FILES['fupload']['type'];

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipe_file == "image/jpeg") {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } elseif ($tipe_file == "image/png") {
        $im_src = imagecreatefrompng($vfile_upload);
    } elseif ($tipe_file == "image/gif") {
        $im_src = imagecreatefromgif($vfile_upload);
    } elseif ($tipe_file == "image/wbmp") {
        $im_src = imagecreatefromwbmp($vfile_upload);
    }
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    if ($src_width > 751) {$dst_width = 750;} else { $dst_width = $src_width;}
    $dst_height = ($dst_width / $src_width) * $src_height;

    $im = imagecreatetruecolor($dst_width, $dst_height);

    // Turn off transparency blending (temporarily)
    imagealphablending($im, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($im, 0, 0, 0, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($im, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($im, true);
    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im, $vdir_upload . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im, $vdir_upload  . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im, $vdir_upload  . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im, $vdir_upload . $fupload_name);
    }

    $dst_height2 = 347;
    $dst_width2 = ($dst_height2 / $src_height) * $src_width;

    $im2 = imagecreatetruecolor($dst_width2, $dst_height2);

    imagealphablending($im2, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($im2, 0, 0, 0, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($im2, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($im2, true);

    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im2, $vdir_upload2   . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im2, $vdir_upload2 . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im2, $vdir_upload2  . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im2, $vdir_upload2  . $fupload_name);
    }

    imagedestroy($im_src);
    imagedestroy($im);
    imagedestroy($im2);
}

function UploadRuby2($fupload_name, $lokasi)
{
    global $imgname1;
    global $imgname2;

    //direktori gambar
    $vdir_upload = "images/$lokasi/";
    $vdir_upload2 = "images/$lokasi/small/";
    $vfile_upload = $vdir_upload . $fupload_name;
    $tipe_file = $_FILES['fupload']['type'];

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipe_file == "image/jpeg") {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } elseif ($tipe_file == "image/png") {
        $im_src = imagecreatefrompng($vfile_upload);
    } elseif ($tipe_file == "image/gif") {
        $im_src = imagecreatefromgif($vfile_upload);
    } elseif ($tipe_file == "image/wbmp") {
        $im_src = imagecreatefromwbmp($vfile_upload);
    }
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    if ($src_width > 751) {$dst_width = 1349;} else { $dst_width = $src_width;}
    $dst_height = ($dst_width / $src_width) * $src_height;

    $im = imagecreatetruecolor($dst_width, $dst_height);

    // Turn off transparency blending (temporarily)
    imagealphablending($im, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($im, 0, 0, 0, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($im, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($im, true);
    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    }

    $dst_height2 = 625;
    $dst_width2 = ($dst_height2 / $src_height) * $src_width;

    $im2 = imagecreatetruecolor($dst_width2, $dst_height2);

    imagealphablending($im2, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($im2, 0, 0, 0, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($im2, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($im2, true);

    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    }

    imagedestroy($im_src);
    imagedestroy($im);
    imagedestroy($im2);
}

function UploadTour($fupload_name)
{
    global $imgname1;
    global $imgname2;

    //direktori gambar
    $vdir_upload = "images/tour/";
    $vdir_upload2 = "images/tour/small/";
    $vfile_upload = $vdir_upload . $fupload_name;
    $tipe_file = $_FILES['fupload']['type'];

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipe_file == "image/jpeg") {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } elseif ($tipe_file == "image/png") {
        $im_src = imagecreatefrompng($vfile_upload);
    } elseif ($tipe_file == "image/gif") {
        $im_src = imagecreatefromgif($vfile_upload);
    } elseif ($tipe_file == "image/wbmp") {
        $im_src = imagecreatefromwbmp($vfile_upload);
    }
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    if ($src_width > 751) {$dst_width = 750;} else { $dst_width = $src_width;}
    $dst_height = ($dst_width / $src_width) * $src_height;

    $im = imagecreatetruecolor($dst_width, $dst_height);

    // Turn off transparency blending (temporarily)
    imagealphablending($im, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($im, 0, 0, 0, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($im, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($im, true);
    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    }

    $dst_height2 = 347;
    $dst_width2 = ($dst_height2 / $src_height) * $src_width;

    $im2 = imagecreatetruecolor($dst_width2, $dst_height2);

    imagealphablending($im2, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($im2, 0, 0, 0, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($im2, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($im2, true);

    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    }

    imagedestroy($im_src);
    imagedestroy($im);
    imagedestroy($im2);
}

function Uploadinformasi($fupload_name)
{
    global $imgname1;

    //direktori gambar
    $vdir_upload = "images/informasi/";
    $vfile_upload = $vdir_upload . $fupload_name;
    $tipe_file = $_FILES['fupload']['type'];

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipe_file == "image/jpeg") {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } elseif ($tipe_file == "image/png") {
        $im_src = imagecreatefrompng($vfile_upload);
    } elseif ($tipe_file == "image/gif") {
        $im_src = imagecreatefromgif($vfile_upload);
    } elseif ($tipe_file == "image/wbmp") {
        $im_src = imagecreatefromwbmp($vfile_upload);
    }
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    if ($src_width > 751) {$dst_width = 750;} else { $dst_width = $src_width;}
    $dst_height = ($dst_width / $src_width) * $src_height;

    $im = imagecreatetruecolor($dst_width, $dst_height);

    // Turn off transparency blending (temporarily)
    imagealphablending($im, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($im, 0, 0, 0, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($im, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($im, true);
    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    }

    imagedestroy($im_src);
    imagedestroy($im);
}

function UploadAbout($fupload_name)
{
    global $imgname1;
    global $imgname2;

    //direktori gambar
    $vdir_upload = "images/about/";
    $vdir_upload2 = "images/about/small/";
    $vfile_upload = $vdir_upload . $fupload_name;
    $tipe_file = $_FILES['fupload']['type'];

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipe_file == "image/jpeg") {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } elseif ($tipe_file == "image/png") {
        $im_src = imagecreatefrompng($vfile_upload);
    } elseif ($tipe_file == "image/gif") {
        $im_src = imagecreatefromgif($vfile_upload);
    } elseif ($tipe_file == "image/wbmp") {
        $im_src = imagecreatefromwbmp($vfile_upload);
    }
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    $dst_width = 1000;
    $dst_height = ($dst_width / $src_width) * $src_height;

    $im = imagecreatetruecolor($dst_width, $dst_height);

    // Turn off transparency blending (temporarily)
    imagealphablending($im, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($im, 0, 0, 0, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($im, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($im, true);
    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    }

    $dst_height2 = 347;
    $dst_width2 = ($dst_height2 / $src_height) * $src_width;

    $im2 = imagecreatetruecolor($dst_width2, $dst_height2);

    imagealphablending($im2, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($im2, 0, 0, 0, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($im2, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($im2, true);

    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    }

    imagedestroy($im_src);
    imagedestroy($im);
    imagedestroy($im2);
}

function UploadGallery($fupload_name)
{
    global $imgname1;
    global $imgname2;

    //direktori gambar
    $vdir_upload = "images/gallery/";
    $vdir_upload2 = "images/gallery/small/";
    $vfile_upload = $vdir_upload . $fupload_name;
    $tipe_file = $_FILES['fupload']['type'];

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipe_file == "image/jpeg") {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } elseif ($tipe_file == "image/png") {
        $im_src = imagecreatefrompng($vfile_upload);
    } elseif ($tipe_file == "image/gif") {
        $im_src = imagecreatefromgif($vfile_upload);
    } elseif ($tipe_file == "image/wbmp") {
        $im_src = imagecreatefromwbmp($vfile_upload);
    }
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    if ($src_width > 1200) {
        $dst_width = 1200;
    } else {
        $dst_width = $src_width;
    }
    $dst_height = ($dst_width / $src_width) * $src_height;

    $im = imagecreatetruecolor($dst_width, $dst_height);

    // Turn off transparency blending (temporarily)
    imagealphablending($im, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($im, 0, 0, 0, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($im, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($im, true);
    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    }

    $dst_width2 = 250;
    $dst_height2 = ($dst_width2 / $src_width) * $src_height;

    $im2 = imagecreatetruecolor($dst_width2, $dst_height2);

    imagealphablending($im2, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($im2, 0, 0, 0, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($im2, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($im2, true);

    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    }

    imagedestroy($im_src);
    imagedestroy($im);
    imagedestroy($im2);
}

function UploadSlider($fupload_name)
{
    global $imgname1;
    global $imgname2;

    //direktori gambar
    $vdir_upload = "images/slider/";
    $vdir_upload2 = "images/slider/small/";
    $vfile_upload = $vdir_upload . $fupload_name;
    $tipe_file = $_FILES['fupload']['type'];

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipe_file == "image/jpeg") {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } elseif ($tipe_file == "image/png") {
        $im_src = imagecreatefrompng($vfile_upload);
    } elseif ($tipe_file == "image/gif") {
        $im_src = imagecreatefromgif($vfile_upload);
    } elseif ($tipe_file == "image/wbmp") {
        $im_src = imagecreatefromwbmp($vfile_upload);
    }
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    $dst_width = 1350;
    if ($src_height < 620) {
        $dst_height = 620;
    } else {
        //$dst_height = $src_height;
        $dst_height = ($dst_width / $src_width) * $src_height;
    }

    $im = imagecreatetruecolor($dst_width, $dst_height);

    //tambahan untuk warna background
    $bgc = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
    imagefilledrectangle($im, 0, 0, $dst_width, $dst_height, $bgc);
    //tambahan

    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    }

    $dst_width2 = 270;
    $dst_height2 = 128;

    $im2 = imagecreatetruecolor($dst_width2, $dst_height2);

    //tambahan untuk warna background
    $bgc = imagecolorallocate($im2, 0xFF, 0xFF, 0xFF);
    imagefilledrectangle($im2, 0, 0, $dst_width2, $dst_height2, $bgc);
    //tambahan

    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    }

    imagedestroy($im_src);
    imagedestroy($im);
    imagedestroy($im2);
}

function UploadBlog($fupload_name)
{
    global $imgname1;
    global $imgname2;

    //direktori gambar
    $vdir_upload = "images/blog/";
    $vdir_upload2 = "images/blog/small/";
    $vfile_upload = $vdir_upload . $fupload_name;
    $tipe_file = $_FILES['fupload']['type'];

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipe_file == "image/jpeg") {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } elseif ($tipe_file == "image/png") {
        $im_src = imagecreatefrompng($vfile_upload);
    } elseif ($tipe_file == "image/gif") {
        $im_src = imagecreatefromgif($vfile_upload);
    } elseif ($tipe_file == "image/wbmp") {
        $im_src = imagecreatefromwbmp($vfile_upload);
    }
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    if ($src_width >= 752) {
        $dst_width = 751;
    } else {
        $dst_width = $src_width;
    }
    $dst_height = ($dst_width / $src_width) * $src_height;

    $im = imagecreatetruecolor($dst_width, $dst_height);

    //tambahan untuk warna background
    $bgc = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
    imagefilledrectangle($im, 0, 0, $dst_width, $dst_height, $bgc);
    //tambahan

    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    }

    $dst_width2 = 250;
    $dst_height2 = ($dst_width2 / $src_width) * $src_height;

    $im2 = imagecreatetruecolor($dst_width2, $dst_height2);

    //tambahan untuk warna background
    $bgc = imagecolorallocate($im2, 0xFF, 0xFF, 0xFF);
    imagefilledrectangle($im2, 0, 0, $dst_width2, $dst_height2, $bgc);
    //tambahan

    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im2, $vdir_upload2 . $imgname2 . "-" . $fupload_name);
    }

    imagedestroy($im_src);
    imagedestroy($im);
    imagedestroy($im2);
}

function UploadModul($fupload_name)
{
    //direktori gambar
    $vdir_upload = "images/";
    $vfile_upload = $vdir_upload . $fupload_name;
    $tipe_file = $_FILES['fupload']['type'];

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}


function UploadPagan($fupload_name)
{
    //direktori gambar
    $vdir_upload = "images/";
    $vfile_upload = $vdir_upload . $fupload_name;
    $tipe_file = $_FILES['lopoFile']['type'];

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["lopoFile"]["tmp_name"], $vfile_upload);
}

function UploadKeunggulan($fupload_name)
{
    global $imgname1;

    //direktori gambar
    $vdir_upload = "images/keunggulan/";
    $vfile_upload = $vdir_upload . $fupload_name;
    $tipe_file = $_FILES['fupload']['type'];

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipe_file == "image/jpeg") {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } elseif ($tipe_file == "image/png") {
        $im_src = imagecreatefrompng($vfile_upload);
    } elseif ($tipe_file == "image/gif") {
        $im_src = imagecreatefromgif($vfile_upload);
    } elseif ($tipe_file == "image/wbmp") {
        $im_src = imagecreatefromwbmp($vfile_upload);
    }
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    $dst_width = 423;
    $dst_height = ($dst_width / $src_width) * $src_height;

    $im = imagecreatetruecolor($dst_width, $dst_height);

    // Turn off transparency blending (temporarily)
    imagealphablending($im, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($im, 0, 0, 0, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($im, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($im, true);
    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    }

    imagedestroy($im_src);
    imagedestroy($im);
}

function UploadPage($fupload_name)
{
    global $imgname1;

    //direktori gambar
    $vdir_upload = "images/";
    $vfile_upload = $vdir_upload . $fupload_name;
    $tipe_file = $_FILES['fupload']['type'];

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipe_file == "image/jpeg") {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } elseif ($tipe_file == "image/png") {
        $im_src = imagecreatefrompng($vfile_upload);
    } elseif ($tipe_file == "image/gif") {
        $im_src = imagecreatefromgif($vfile_upload);
    } elseif ($tipe_file == "image/wbmp") {
        $im_src = imagecreatefromwbmp($vfile_upload);
    }
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    $dst_width = $src_width;
    $dst_height = $src_height;

    $im = imagecreatetruecolor($dst_width, $dst_height);

    // Turn off transparency blending (temporarily)
    imagealphablending($im, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($im, 0, 0, 0, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($im, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($im, true);
    //0, 0, 0, 0 letak gambar
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    if ($_FILES["fupload"]["type"] == "image/jpeg") {
        imagejpeg($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/png") {
        imagepng($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/gif") {
        imagegif($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    } elseif ($_FILES["fupload"]["type"] == "image/wbmp") {
        imagewbmp($im, $vdir_upload . $imgname1 . "-" . $fupload_name);
    }

    imagedestroy($im_src);
    imagedestroy($im);
}