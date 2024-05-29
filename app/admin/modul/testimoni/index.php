<?php $this->layout('template', ['hal'=>'Testimoni']) ?>
<?php
	$module = "testimoni";

	switch($act){
        case "list":
?>
<a href="testimoni-add" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data</a>
<br><br>
<div class="table-responsive">
    <table id="my_table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Testimoni</th>
                <th>Gambar</th>
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
                <td><?php echo $row['nama'] ?></td>
                <td><?php echo $row['deskripsi'] ?></td>
                <td><img src="../images/testimoni/small/<?php echo $row['gambar']; ?>"
                        style="width:60px;margin:0 auto;display:block">
                </td>
                <td style="width:19%"><a href="testimoni-edit-<?php echo $row['id_testimoni'] ?>"
                        class="btn btn-warning"> <i class="fas fa-pencil-alt"></i> Edit</a>
                    <a onClick="javascript: return confirm('Yakin untuk Menghapus data ?');"
                        href="<?php echo $module; ?>-delete-<?php echo $row['id_testimoni']; ?>" class="btn btn-danger "
                        role="button" aria-pressed="true" style="min-width: 60px;"> <i class="fa fa-trash"></i>
                        Delete</a>
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
        <form action="testimoni" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" value="Testi">
                    </div>
                </div>
                <!--<div class="col-md-12">-->
                <!--    <div class="form-group">-->
                <!--        <label for="">Pekerjaan</label>-->
                <!--        <input type="text" class="form-control" name="asal" value="Wiraswasta">-->
                <!--    </div>-->
                <!--</div>-->
                
                <!--<div class="col-md-12">-->
                <!--    <div class="form-group">-->
                <!--        <label for="exampleInputEmail1">Deskripsi</label>-->
                <!--        <textarea id="ckeditor" name="deskripsi"></textarea>-->
                <!--    </div>-->
                <!--</div>-->
                            
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar</label>
                        <input type="file" class="form-control" name="lopoFile">
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" id="btn-testimoni" class="btn btn-primary"><i class="fa fa-paper-plane"></i>
                        Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
document.querySelector('#btn-testimoni').addEventListener('click', function(e) {
    loadingSweet();
})
</script>
<?php
	break;
	case "edit":
?>
<div class="card">
    <div class="card-body">
        <form action="testimoni" id="form-testimoni" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
            <input type="hidden" name="id_testimoni" value="<?php echo $data['id_testimoni'] ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $data['nama'] ?>">
                    </div>
                </div>
                <!--<div class="col-md-12">-->
                <!--    <div class="form-group">-->
                <!--        <label for="">Pekerjaan</label>-->
                <!--        <input type="text" class="form-control" name="asal" value="<?php echo $data['asal'] ?>">-->
                <!--    </div>-->
                <!--</div>-->
                
                <!--<div class="col-md-12">-->
                <!--    <div class="form-group">-->
                <!--        <label for="exampleInputEmail1">Deskripsi</label>-->
                <!--        <textarea id="ckeditor" name="deskripsi"><?php echo $data['deskripsi'] ?></textarea>-->
                <!--    </div>-->
                <!--</div>-->
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control"
                            rows="3"><?php echo $data['deskripsi'] ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar</label>
                        <input type="file" class="form-control" name="lopoFile">
                        <div class="" id="img-lopo">
                            <img style="height:200px" src="../images/testimoni/small/<?php echo $data['gambar'] ?>">
                        </div>
                    </div>
                </div>
                <input type="submit" id="btn-testimoni" class="btn btn-primary" value="Simpan Data">
            </div>
        </form>
    </div>
</div>
<script>
document.querySelector('#btn-testimoni').addEventListener('click', function(e) {
    loadingSweet();
})
</script>
<?php
    break;
	case "addgallery":
?>
<form action="modul/testimoni/aksi.php?module=<?php echo $module; ?>&act=addgallery" method="POST"
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
	$gam =  $db->connection("SELECT * FROM gallery_testimoni WHERE id_gallery = '$_GET[id]'  ")->fetch();
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
                        src="../images/gallery_testimoni/<?php echo $imgname2."-".$gam['gambar']?>">
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