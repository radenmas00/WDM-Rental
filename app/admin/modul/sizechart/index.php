<?php $this->layout('template', ['hal'=>'Our Service']) ?>
<?php
	$module = "sizechart";

	switch($act){
        case "list":
?>
<!--<a href="sizechart-add" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data</a>-->
<br><br>
<div class="table-responsive">
    <table id="my_table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <!-- <th>Ukuran</th> -->
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
                <!-- <td><label for="" class="label label-info"
                        style="font-size: 14px;"><?= getSize('images/sizechart/'.$row['gambar']) ?> MB</label></td> -->
                <td><img src="../images/sizechart/small/<?php echo $row['gambar']; ?>"
                    style="width:100px;margin:0 auto;display:block">
                </td>
                <td style="width:20%"><a href="sizechart-edit-<?php echo $row['id_sizechart'] ?>"
                        class="btn btn-warning"> <i class="fas fa-pencil-alt"></i> Edit</a>
                    <a onClick="javascript: return confirm('Yakin untuk Menghapus data ?');"
                        href="<?php echo $module; ?>-delete-<?php echo $row['id_sizechart']; ?>" class="btn btn-danger "
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
        <form action="sizechart" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Judul</label>
                        <input type="text" class="form-control" name="nama" value="Berkas">
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Berkas</label>
                        <input type="file" class="form-control" name="lopoFilex">
                    </div>
                </div> -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Deskripsi</label>
                        <textarea id="ckeditor" name="deskripsi"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar</label>
                        <input type="file" class="form-control" name="lopoFile" required>
                        <small style="color:red">*) ukuran minimal 1920 x 600 px</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" id="btn-sizechart" class="btn btn-primary"><i class="fa fa-paper-plane"></i>
                        Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.querySelector('#btn-sizechart').addEventListener('click', function (e) {
        loadingSweet();
    })
</script>
<?php
	break;
	case "edit":
?>
<div class="card">
    <div class="card-body">
        <form action="sizechart" id="form-sizechart" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_sizechart" value="<?php echo $data['id_sizechart'] ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Judul</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $data['nama'] ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Deskripsi</label>
                        <textarea id="ckeditor" name="deskripsi"><?php echo $data['deskripsi'] ?></textarea>
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Berkas</label>
                        <input type="file" class="form-control" name="lopoFilex">
                        <p style="margin-top: 5px;margin-bottom:0;" class="help-block text-red">*) Maksimal Ukuran File adalah 10 MB</p>
                        <p style="margin-top: 5px;margin-bottom:0;" class="help-block text-red">*) Apabila Berkas tidak
                            diubah, dikosongkan saja.</p>
                        <div class="" id="img-lopo">
                            <!-- <img style="height:200px" src="../images/sizechart/small/<?php echo $data['gambar'] ?>"> -->
                            <!-- <i class="fa fa-file-pdf-o fa-2x"></i>
                            <br> -->
                            <!-- <a href="../images/sizechart/<?php echo $data['gambar'] ?>" class="btn btn-info mt-3" download>
                                <i class="fas fa-download"></i> </a>
                            <a target="_blank" href="../images/sizechart/<?php echo $data['gambar'] ?>"
                                class="btn btn-secondary mt-3 " role="button" aria-pressed="true"> <i class="fa fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar </label>
                        <input type="file" class="form-control" name="lopoFile">
                        <div class="" id="img-lopo">
                            <img style="height:200px" src="../images/sizechart/small/<?php echo $data['gambar'] ?>">
                            
                        </div>
                        <br>
                        <small style="color:red">*) ukuran minimal 1920 x 600 px</small>
                    </div>
                </div>
                <div class="col-md-12 mt-3 ">
                <label for="">Sub Service</label><br>
                    <a href="service-add-<?=$data['id_sizechart']?>" class="btn btn-warning mb-3"> <i
                            class="fas fa-plus"></i> Tambah Layanan</a>
                    <div class="table-responsive">
                        <table id="my_table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = $dataku->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td align="center"><?php echo $no; ?></td>
                                        <td width="80%"><?php echo $row['judul']; ?></td>
                                        

                                        <td align="center" width="20%">
                                            <a href="service-edit-<?php echo $row['id_sizechart_sub']; ?>"
                                                class="btn btn-warning " role="button" aria-pressed="true"
                                                style="min-width: 50px;margin-bottom: 5px;"> <i class="fa fa-pencil"></i>
                                                Edit</a>

                                            <a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');"
                                                href="service-delete-<?php echo $row['id_sizechart_sub']; ?>"
                                                class="btn btn-danger " role="button" aria-pressed="true"
                                                style="min-width: 60px;margin-bottom: 5px;"> <i class="fa fa-trash"></i>
                                                Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                        $no++;
                                        }
                                        ?>
                                </tbody>
                        </table>
                    </div>
                </div>
                <input type="submit" id="btn-sizechart" class="btn btn-primary" value="Simpan Data">
            </div>
        </form>
    </div>
</div>
<script>
    document.querySelector('#btn-sizechart').addEventListener('click', function (e) {
        loadingSweet();
    })
</script>
<?php
    break;
	case "addsizechart":
?>
<form action="modul/sizechart/aksi.php?module=<?php echo $module; ?>&act=addsizechart" method="POST"
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
	case "editsizechart":
	$gam =  $db->connection("SELECT * FROM sizechart_sizechart WHERE id_sizechart = '$_GET[id]'  ")->fetch();
?>
<form action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=editsizechart" method="POST"
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
                        src="../images/sizechart_sizechart/<?php echo $imgname2."-".$gam['gambar']?>">
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-info" value="Simpan Data">
    </div>
</form>
<?php
    break;
    case "addService":
        ?>
<form action="sizechart-service" method="POST" enctype="multipart/form-data">
    <div class="row card">
        <div class="col-md-12">
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Sub Service</label>
                    <input type="hidden" name="id_sizechart" value="<?php echo $id_sizechart ?>">
                    <input type="text" class="form-control" name="judul" required>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="message-text" class="control-label">Gambar</label>
                <input type="file" class="form-control" name="lopoFile" required>
                <small style="color:red">*) ukuran minimal 400 x 400 px</small>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Deskripsi</label>
                <textarea id="ckeditor" name="deskripsi"></textarea>
            </div>
        </div>
        <input type="submit" class="btn btn-info" value="Simpan Data">
    </div>
</form>
<?php
    break;
    case "editService":
        ?>
<a href="<?php echo $module; ?>-edit-<?php echo $data['id_sizechart'] ?>" class="btn btn-success mb-2"><i
        class="fa fa-arrow-left" aria-hidden="true"></i> Kembali Ke Layanan</a>
<form action="sizechart-service" method="POST" enctype="multipart/form-data">
    <div class="row card">
        <div class="col-md-12">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama Sub Service</label>
                        <input type="hidden" name="id_sizechart" value="<?php echo $data['id_sizechart'] ?>">
                        <input type="hidden" name="id_sizechart_sub" value="<?php echo $data['id_sizechart_sub'] ?>">
                        <input type="text" class="form-control" name="judul" value="<?=$data['judul']?>" required>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="message-text" class="control-label">Gambar</label>
                    <input type="file" class="form-control" name="lopoFile">
                    <div class="" id="img-lopo">
                        <img style="height:200px" src="../images/sizechart_sub/<?php echo $data['gambar'] ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea id="ckeditor" name="deskripsi"><?php echo $data['deskripsi'] ?></textarea>
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