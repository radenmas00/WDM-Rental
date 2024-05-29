<?php $this->layout('template', ['hal'=>'Our Client']) ?>
<?php
	$module = "client";

	switch($act){
        case "list":
?>
<a href="client-add" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data</a>
<br><br>
<div class="table-responsive">
    <table id="my_table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
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
                <td><img src="../images/client/small/<?php echo $row['gambar']; ?>"
                        style="width:60px;margin:0 auto;display:block">
                </td>
                <td style="width:19%"><a href="client-edit-<?php echo $row['id_client'] ?>"
                        class="btn btn-warning"> <i class="fas fa-pencil-alt"></i> Edit</a>
                    <a onClick="javascript: return confirm('Yakin untuk Menghapus data ?');"
                        href="<?php echo $module; ?>-delete-<?php echo $row['id_client']; ?>"
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
        <form action="client" method="POST" enctype="multipart/form-data" >
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Judul</label>
                        <input type="text" class="form-control" name="nama" value="galeri">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar</label>
                        <input type="file" class="form-control" name="lopoFile">
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" id="btn-client" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.querySelector('#btn-client').addEventListener('click',function(e){
        loadingSweet();
    })
</script>
<?php
	break;
	case "edit":
?>
<div class="card">
    <div class="card-body">
        <form action="client" id="form-client"  method="POST" enctype="multipart/form-data" >
            <input type="hidden" name="id_client" value="<?php echo $data['id_client'] ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Judul</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $data['nama'] ?>">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar</label>
                        <input type="file" class="form-control" name="lopoFile">
                        <div class="" id="img-lopo">
                            <img style="height:120px" src="../images/client/small/<?php echo $data['gambar'] ?>">
                        </div>
                    </div>
                </div>
                <input type="submit" id="btn-client" class="btn btn-primary" value="Simpan Data">
            </div>
        </form>
    </div>
</div>
<script>
    document.querySelector('#btn-client').addEventListener('click',function(e){
        loadingSweet();
    })
</script>
<?php
    break;
	case "addclient":
?>
<form action="modul/client/aksi.php?module=<?php echo $module; ?>&act=addclient" method="POST"
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
	case "editclient":
	$gam =  $db->connection("SELECT * FROM client_client WHERE id_client = '$_GET[id]'  ")->fetch();
?>
<form action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=editclient" method="POST"
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
                    <img style="height:100px"
                        src="../images/client_client/<?php echo $imgname2."-".$gam['gambar']?>">
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