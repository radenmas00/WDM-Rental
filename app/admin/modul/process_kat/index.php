<?php $this->layout('template', ['hal'=>'Kategori Service']) ?>
<?php
	$module = "process_kat";
	switch($act){
        case "list":
?>

<a href="process_kat-add" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data</a>

<br><br>
<div class="table-responsive">
    <table id="my_table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
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
                <td width="7%"><?php echo $no ?></td>
                <td><?php echo $row['judul'] ?></td>
                <!-- <td>
                    <img src="../images/process_kat/small/<?php echo $row['gambar']; ?>"
                        style="width:100px;margin:0 auto;display:block">
                </td> -->
                <td width="18%" style="width:19%"><a
                        href="process_kat-edit-<?php echo $row['id_process_kat'] ?>" class="btn btn-warning ">
                        <i class="fas fa-pencil-alt"></i> Edit</a>
                    <a onClick="javascript: return confirm('Yakin untuk Menghapus data ?');"
                        href="<?php echo $module; ?>-delete-<?php echo $row['id_process_kat']; ?>"
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
        <form action="process_kat" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar</label>
                        <input type="file" class="form-control" name="lopoFile" required>
                        <p style="color:red">*) ukuran minimal 200 x 200 px</p>
                        <p class="help-block">*) Maksimal Size Gambar 2MB</p>
                    </div>
                </div> -->
                <div class="col-md-12">
                <p class="alert alert-warning">SEO (Search Engine Optimation)</p>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tetle" role="tab"><span class="hidden-sm-up"><i class="sl-icon-star"></i></span> <span class="hidden-xs-down">Title</span></a> </li>
                        <li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="sl-icon-key"></i></span> <span class="hidden-xs-down">Keyword</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="sl-icon-list"></i></span> <span class="hidden-xs-down">Description</span></a> </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabcontent-border">
                        <div class="tab-pane active  p-20" id="tetle" role="tabpanel">
                            <textarea rows="4" name="title" class="form-control" placeholder="SEO Title"></textarea>
                        </div>
                        <div class="tab-pane" id="home" role="tabpanel">
                            <div class="p-20">
                                <textarea rows="4" name="keyword" class="form-control" placeholder="SEO Keyword"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane  p-20" id="profile" role="tabpanel">
                            <textarea rows="4" name="description" class="form-control" placeholder="SEO Description"></textarea>
                        </div>
                    </div>
                    </div>
                <div class="col-md-12">
                    <button type="submit" id="btn-process_kat" class="btn btn-primary"><i
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
        <form action="process_kat" id="form-process_kat" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_process_kat" value="<?php echo $data['id_process_kat'] ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $data['judul'] ?>">
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar </label>
                        <input type="file" class="form-control" name="lopoFile">
                        <div class="" id="img-lopo">
                            <img style="height:200px" src="../images/process_kat/<?php echo $data['gambar'] ?>">
                        </div>
                        <p style="margin-top: 5px;margin-bottom:0;" class="help-block">*) Ukuran Gambar
                            Minimal Lebar 200px dan Tinggi 200px</p>
                        <p class="help-block">*) Maksimal Size Gambar 2MB</p>
                    </div>
                </div> -->
                <div class="col-md-12">
                <p class="alert alert-warning">SEO (Search Engine Optimation)</p>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tetle" role="tab"><span class="hidden-sm-up"><i class="sl-icon-star"></i></span> <span class="hidden-xs-down">Title</span></a> </li>
                        <li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="sl-icon-key"></i></span> <span class="hidden-xs-down">Keyword</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="sl-icon-list"></i></span> <span class="hidden-xs-down">Description</span></a> </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabcontent-border">
                        <div class="tab-pane active  p-20" id="tetle" role="tabpanel">
                            <textarea rows="4" name="title" class="form-control" placeholder="SEO Title"><?php echo $data['title']  ?></textarea>
                        </div>
                        <div class="tab-pane" id="home" role="tabpanel">
                            <div class="p-20">
                                <textarea rows="4" name="keyword" class="form-control" placeholder="SEO Keyword"><?php echo $data['keyword']  ?></textarea>
                            </div>
                        </div>
                        <div class="tab-pane  p-20" id="profile" role="tabpanel">
                            <textarea rows="4" name="description" class="form-control" placeholder="SEO Description"><?php echo $data['description']  ?></textarea>
                        </div>
                    </div>
</div>
                <input type="submit" id="btn-process_kat" class="btn btn-primary" value="Simpan Data">
            </div>
        </form>
    </div>
</div>
<?php
    break;
	case "addgallery":
?>
<form action="modul/process_kat/aksi.php?module=<?php echo $module; ?>&act=addgallery" method="POST"
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
	$gam =  $db->connection("SELECT * FROM gallery_process_kat WHERE id_gallery = '$_GET[id]'  ")->fetch();
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
                        src="../images/gallery_process_kat/<?php echo $imgname2."-".$gam['gambar']?>">
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