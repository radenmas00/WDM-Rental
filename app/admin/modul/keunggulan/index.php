<?php $this->layout('template', ['hal'=>'Keunggulan']) ?>
<?php
	$module = "keunggulan";
	switch($act){
        case "list":
?>

<a href="keunggulan-add" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data</a>

<br><br>
<p class="fw-bold">Untuk mengganti icon silahkan kunjungi link berikut : </p>
<a href="https://icons.getbootstrap.com/">https://icons.getbootstrap.com/</a>
<div class="table-responsive">
    <table id="my_table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Icon</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
				$no 	= 1;
				foreach($dataku as $row) :
            ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $row['judul'] ?></td>
                <!-- <td align="center">
                    <img src="../images/<?php echo "keunggulan/small/$row[gambar]"; ?>" width="100px">
                </td> -->
                <td><i class="bi bi-<?php echo $row['icon'] ?>"></i></td>
                <td><?php echo $row['deskripsi'] ?></td>
                </td>
                <td style="width:19%"><a href="keunggulan-edit-<?php echo $row['id_keunggulan'] ?>"
                        class="btn btn-warning "> <i class="fas fa-pencil-alt"></i> Edit</a>
                    <a onClick="javascript: return confirm('Yakin untuk Menghapus data ?');"
                        href="<?php echo $module; ?>-delete-<?php echo $row['id_keunggulan']; ?>"
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
<p class="fw-bold">Untuk mengganti icon silahkan kunjungi link berikut : </p>
<a href="https://icons.getbootstrap.com/">https://icons.getbootstrap.com/</a>
<div class="card">
    <div class="card-body">
        <form action="keunggulan" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Icon</label>
                        <input type="text" class="form-control" name="icon" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea id="" style="width:100%" cols="30" rows="5" name="deskripsi"></textarea>
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar</label>
                        <input type="file" class="form-control" name="lopoFile" required>
                        <small style="color:red">*) ukuran minimal 150 x 150 px</small>
                    </div>
                </div> -->
                <div class="col-md-12">
                    <button type="submit" id="btn-keunggulan" class="btn btn-primary"><i class="fa fa-paper-plane"></i>
                        Simpan</button>
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
        <form action="keunggulan" id="form-keunggulan" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_keunggulan" value="<?php echo $data['id_keunggulan'] ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $data['judul'] ?>">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Icon</label>
                        <input type="text" class="form-control" name="icon" value="<?php echo $data['icon'] ?>">
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar </label>
                        <input type="file" class="form-control" name="lopoFile">
                        <div class="" id="img-lopo">
                            <img style="height:200px" src="../images/keunggulan/<?php echo $data['gambar'] ?>">
                        </div>
                    </div>
                </div> -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea id="" style="width:100%" cols="30" rows="5"
                            name="deskripsi"><?php echo $data['deskripsi'] ?></textarea>
                    </div>
                </div>
                <input type="submit" id="btn-keunggulan" class="btn btn-primary" value="Simpan Data">
            </div>
        </form>
    </div>
</div>
<?php
    break;
	case "addgallery":
?>
<form action="modul/keunggulan/aksi.php?module=<?php echo $module; ?>&act=addgallery" method="POST"
    enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-body">
                <div class="form-group">
                    <label>nama</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <!-- <div class="form-group ">
                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                    <label for="">Gambar</label>
                    <input type="file" name="nyanpload" class="form-control">
                </div> -->
            </div>
        </div>
        <input type="submit" class="btn btn-info" value="Simpan Data">
    </div>
</form>
<?php
    break;
	case "editgallery":
	$gam =  $db->connection("SELECT * FROM gallery_keunggulan WHERE id_gallery = '$_GET[id]'  ")->fetch();
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
                    <!-- <label for="">Gambar</label>
                    <input type="file" name="nyanpload" class="form-control"> -->
                    <br><br>
                    <img style="height:300px"
                        src="../images/gallery_keunggulan/<?php echo $imgname2."-".$gam['gambar']?>">
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