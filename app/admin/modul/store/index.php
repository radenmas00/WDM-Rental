<?php $this->layout('template', ['hal'=>'Store']) ?>
<?php
	$module = "store";
	switch($act){
        case "list":
?>

<a href="store-add" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data</a>

<br><br>
<div class="table-responsive">
    <table id="my_table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Cabang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
				$no 	= 1;
				foreach($dataku as $row) :
            ?>
            <tr>
                <td width="7%"><?php echo $no ?></td>
                <td><?php echo $row['judul'] ?></td>
                <td width="18%" style="width:19%"><a
                        href="store-edit-<?php echo $row['id_store'] ?>" class="btn btn-warning ">
                        <i class="fas fa-pencil-alt"></i> Edit</a>
                    <a onClick="javascript: return confirm('Yakin untuk Menghapus data ?');"
                        href="<?php echo $module; ?>-delete-<?php echo $row['id_store']; ?>"
                        class="btn btn-danger " role="button" aria-pressed="true" style="min-width: 60px;"> <i
                            class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>
            <?php 
			    $no++;
				endforeach
			?>
        </tbody>
    </table>
</div>
<?php
		break;
		case "add":
?>
<div class="card">
    <div class="card-body">
        <form action="store" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Cabang</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">FB</label>
                        <input type="text" class="form-control" name="facebook" >
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">IG</label>
                        <input type="text" class="form-control" name="ig" >
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" >
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">WA</label>
                        <input type="text" class="form-control" name="wa" >
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Shopee</label>
                        <input type="text" class="form-control" name="shopee" >
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name="alamat" >
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">No. Telp</label>
                        <input type="text" class="form-control" name="no_telp" >
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Jam Buka</label>
                        <input type="text" class="form-control" name="jam_buka" >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Google Map</label>
                        <input type="text" class="form-control" name="google_map" >
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" id="btn-produk_kategori" class="btn btn-primary"><i
                            class="fa fa-paper-plane"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
	break;
	case "edit":
?>
<div class="card">
    <div class="card-body">
        <form action="store" id="form-produk_kategori" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_store" value="<?php echo $data['id_store'] ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $data['judul'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">FB</label>
                        <input type="text" class="form-control" name="facebook" value="<?php echo $data['facebook'] ?>">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">IG</label>
                        <input type="text" class="form-control" name="ig" value="<?php echo $data['ig'] ?>">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email"  value="<?php echo $data['email'] ?>">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">WA</label>
                        <input type="text" class="form-control" name="wa" value="<?php echo $data['wa'] ?>">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Shopee</label>
                        <input type="text" class="form-control" name="shopee" value="<?php echo $data['shopee'] ?>">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat'] ?>">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">No. Telp</label>
                        <input type="text" class="form-control" name="no_telp" value="<?php echo $data['no_telp'] ?>">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Jam Buka</label>
                        <input type="text" class="form-control" name="jam_buka" value="<?php echo $data['jam_buka'] ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Google Map</label>
                        <input type="text" class="form-control" name="google_map" value="<?php echo $data['google_map'] ?>">
                    </div>
                </div>


          
                <input type="submit" id="btn-produk_kategori" class="btn btn-primary" value="Simpan Data">
            </div>
        </form>
    </div>
</div>
<?php
    break;
	case "addgallery":
?>
<form action="modul/produk_kategori/aksi.php?module=<?php echo $module; ?>&act=addgallery" method="POST"
    enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-body">
                <div class="form-group">
                    <label>nama</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="form-group ">
                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                    <label for="">Gambar</label>
                    <input type="file" name="nyanpload" class="form-control">
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-info" value="Simpan Data">
    </div>
</form>
<?php
    break;
	case "editgallery":
	$gam =  $db->connection("SELECT * FROM gallery_produk_kategori WHERE id_gallery = '$_GET[id]'  ")->fetch();
?>
<form action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=editgallery" method="POST"
    enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-body">
                <div class="form-group">
                    <label>nama</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $gam['nama'] ?>">
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                    <input type="hidden" name="idm" value="<?php echo $_GET['idm']; ?>">
                    <label for="">Gambar</label>
                    <input type="file" name="nyanpload" class="form-control">
                    <br><br>
                    <img style="height:300px"
                        src="../images/gallery_produk_kategori/<?php echo $imgname2."-".$gam['gambar']?>">
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-info" value="Simpan Data">
    </div>
</form>
<?php
		break;  
	}
?>