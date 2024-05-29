<?php $this->layout('template', ['hal'=>'Sub Kategori Produk']) ?>
<?php
	$module = "produk_sk";
	switch($act){
        case "list":
?>

<a href="produk_sk-add" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data</a>

<br><br>
<div class="table-responsive">
    <table id="my_table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kategori</th>
                <!-- <th>Gambar</th> -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
				$no 	= 1;
				foreach($dataku as $row) :
            ?>
            <tr>
                <td width="6%"><?php echo $no ?></td>
                <td><?php echo $row['judul'] ?></td>
                <td><?php echo $row['kategori'] ?></td>
                <!-- <td><img src="../images/produk_sub_kategori/small/<?php echo $row['gambar']; ?>"
                        style="height:115px;margin:0 auto;display:block">
                </td> -->
                <td style="width:19%"><a href="produk_sk-edit-<?php echo $row['id_produk_sk'] ?>"
                        class="btn btn-warning "> <i class="fas fa-pencil-alt"></i> Edit</a>
                    <a onClick="javascript: return confirm('Yakin untuk Menghapus data ?');"
                        href="<?php echo $module; ?>-delete-<?php echo $row['id_produk_sk']; ?>"
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
        <form action="produk_sk" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kategori</label>
                        <select name="id_produk_k" class="form-control">
                            <?php foreach($kategori as $r) : ?>
                            <option value="<?=$r['id_produk_k']?>"><?=$r['judul']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Background Color</label>
                        <input type="text" class="colorPicker form-control" name="background_color" value="#000">
                    </div>
                </div> -->
                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea id="ckeditor2" class="ckeditor2" name="deskripsi"></textarea>
                    </div>
                </div> -->
                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar</label>
                        <input type="file" class="form-control" name="lopoFile" required>
                        <small style="color:red">*) ukuran minimal 115 x 120 px</small>
                    </div>
                </div> -->
                <div class="col-md-12">
                    <button type="submit" id="btn-produk_sub_kategori" class="btn btn-primary"><i
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
        <form action="produk_sk" id="form-produk_sub_kategori" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_produk_sk" value="<?php echo $data['id_produk_sk'] ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $data['judul'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kategori</label>
                        <select name="id_produk_k" class="form-control">
                            <?php foreach($kategori as $r) : ?>
                            <option value="<?=$r['id_produk_k']?>"
                                <?php echo ($data['id_produk_k'] == $r['id_produk_k'])? 'selected' : '' ?>>
                                <?=$r['judul']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Background Color</label>
                        <input type="text" class="form-control colorPicker" name="background_color"
                            value="<?php echo $data['background_color'] ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar </label>
                        <input type="file" class="form-control" name="lopoFile">
                        <div class="" id="img-lopo">
                            <img style="height:200px" src="../images/produk_sub_kategori/<?php echo $data['gambar'] ?>">
                        </div>
                        <small style="color:red">*) ukuran minimal 115 x 120 px</small>
                    </div>
                </div> -->

                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea id="ckeditor3" class="ckeditor2"
                            name="deskripsi"><?php echo $data['deskripsi'] ?></textarea>
                    </div>
                </div> -->

                <input type="submit" id="btn-produk_sub_kategori" class="btn btn-primary" value="Simpan Data">
            </div>
        </form>
    </div>
</div>
<?php
    break;
	case "addgallery":
?>
<form action="modul/produk_sub_kategori/aksi.php?module=<?php echo $module; ?>&act=addgallery" method="POST"
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
	$gam =  $db->connection("SELECT * FROM gallery_produk_sub_kategori WHERE id_gallery = '$_GET[id]'  ")->fetch();
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
                        src="../images/gallery_produk_sub_kategori/<?php echo $imgname2."-".$gam['gambar']?>">
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