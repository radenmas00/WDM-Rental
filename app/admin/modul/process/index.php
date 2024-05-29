<?php $this->layout('template', ['hal'=>'Services']) ?>
<?php
	$module = "process";

	switch($act){
        case "list":
?>
<a href="process-add" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data</a>
<br><br>
<div class="table-responsive">
    <table id="my_table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
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
                <td><?php echo $row['judul'] ?></td>
                <!-- <td><?= $row['url']?></td> -->
                <td><img src="../images/process/small/<?php echo $row['gambar']; ?>"
                        style="width:100px;margin:0 auto;display:block">
                </td>
                <td style="width:19%"><a href="process-edit-<?php echo $row['id_process'] ?>"
                        class="btn btn-warning "> <i class="fas fa-pencil-alt"></i> Edit</a>
                    <a onClick="javascript: return confirm('Yakin untuk Menghapus data ?');"
                        href="<?php echo $module; ?>-delete-<?php echo $row['id_process']; ?>"
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
        <form action="process" method="POST" enctype="multipart/form-data" >
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Judul</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kategori</label>
                        <select name="id_process_kat" class="form-control" id="kategori" required>
                            <option value="">-- Select Kategori</option>
                            <?php foreach($kategori as $r) : ?>
                            <option value="<?=$r['id_process_kat']?>"><?=$r['judul']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Daerah</label>
                        <input type="text" class="form-control" name="url" required>
                    </div>
                </div> -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea id="ckeditor" name="deskripsi"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tgl Publish</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i
                                    class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                            <input name='tgl_posting' type="text" class="form-control fc-datepicker"
                                placeholder="DD/MM/YYYY">
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Batas Pendaftaran</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i
                                    class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                            <input name='tgl_batas' type="text" class="form-control fc-datepicker"
                                placeholder="DD/MM/YYYY">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Link Pendaftaran</label>
                        <input type="text" class="form-control" name="berkas" required>
                    </div>
                </div> -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar</label>
                        <input type="file" class="form-control" name="lopoFile" required>
                        <small style="color:red">*) ukuran minimal 1920 x 600 px</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" id="btn-process" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.querySelector('#btn-process').addEventListener('click', function (e) {
        loadingSweet();
    })
</script>
<?php
	break;
	case "edit":
    $tgl 	= explode("-", $data['tgl_posting']);
    $tgl1=$tgl[1];
    $bln=$tgl[2];
    $thn=$tgl[0];
    $tangalo = $tgl1."/".$bln."/".$thn;	

    $tgl01 	= explode("-", $data['tgl_batas']);
    $tgl02=$tgl01[1];
    $bln01=$tgl01[2];
    $thn01=$tgl01[0];
    $tangalo01 = $tgl02."/".$bln01."/".$thn01;	
?>
<div class="card">
    <div class="card-body">
        <form action="process" id="form-process"  method="POST" enctype="multipart/form-data" >
            <input type="hidden" name="id_process" value="<?php echo $data['id_process'] ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $data['judul'] ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kategori</label>
                        <select name="id_process_kat" class="form-control" id="kategori" required>
                            <?php foreach($kategori as $r) : ?>
                            <option value="<?=$r['id_process_kat']?>"
                                <?php echo ($data['id_process_kat'] == $r['id_process_kat'])? 'selected' : '' ?>>
                                <?=$r['judul']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Daerah</label>
                        <input type="text" class="form-control" name="url" value="<?php echo $data['url'] ?>">
                    </div>
                </div> -->
                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Berkas</label>
                        <input type="file" class="form-control" name="lopoFilex">
                        <p style="margin-top: 5px;margin-bottom:0;" class="help-block text-red">*) Apabila Berkas tidak diubah, dikosongkan saja.</p>
                        <div class="" id="img-lopo"> -->
                            <!-- <img style="height:200px" src="../images/sizechart/small/<?php echo $data['gambar'] ?>"> -->
                            <!-- <i class="fa fa-file-pdf-o fa-2x"></i>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar </label>
                        <input type="file" class="form-control" name="lopoFile">
                        <div class="" id="img-lopo">
                            <img style="height:200px" src="../images/process/small/<?php echo $data['gambar'] ?>">
                            
                        </div>
                        <br>
                        <small style="color:red">*) ukuran minimal 1920 x 600 px</small>
                    </div>
                </div>

                <!-- <div class="col-md-12 mt-3 "> -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tgl Publish</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i
                                    class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                            <input type="text" name="tgl_posting" class="form-control fc-datepicker"
                                placeholder="DD/MM/YYYY" value="<?php echo $tangalo ?>">
                        </div>
                    </div>
                </div>

                <!-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Batas Pendaftaran</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i
                                    class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                            <input type="text" name="tgl_batas" class="form-control fc-datepicker"
                                placeholder="DD/MM/YYYY" value="<?php echo $tangalo01 ?>">
                        </div>
                    </div>
                </div> -->

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea  id="ckeditor" name="deskripsi"><?php echo $data['deskripsi'] ?></textarea>
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Link Pendaftaran</label>
                        <input type="text" class="form-control" name="berkas" value="<?php echo $data['berkas'] ?>">
                    </div>
                </div> -->
                <input type="submit" id="btn-process" class="btn btn-primary" value="Simpan Data">
            </div>
        </form>
    </div>
</div>
<script>
    document.querySelector('#btn-process').addEventListener('click', function (e) {
        loadingSweet();
    })
</script>
<?php
    break;
	case "addgallery":
?>
<form action="process-gallery" method="POST"
    enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-body">
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="judul">
                </div>
                <div class="form-group ">
                    <input type="hidden" name="ids" value="<?php echo $id ?>">
                    <label for="">Gambar</label>
                    <input type="file" name="nyanpload" class="form-control">
                    <!--<small style="color:red">*) ukuran minimal 1920 x 600 px</small>-->
                    <small style="color:red">*) TIDAK LEBIH 2 MB</small>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-info" value="Simpan Data">
    </div>
</form>
<?php
    break;
	case "editgallery":
	
?>
<form action="process-gallery" method="POST" 
    enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-body">
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="judul" value="<?php echo $data['judul'] ?>">
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $data['id_gallery'] ?>">
                    <input type="hidden" name="idm" value="<?php echo $data['id_process_kat']; ?>">
                    <label for="">Gambar</label>
                    <input type="file" name="nyanpload" class="form-control">
                    <!--<small style="color:red">*) ukuran minimal 1920 x 600 px</small>-->
                    <small style="color:red">*) TIDAK LEBIH 2 MB</small>
                    <br><br>
                    <img style="height:300px" src="../images/gallery_process_kat/<?php echo $imgname1."-".$data['gambar']?>">
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-info" value="Simpan Data">
    </div>
</form>
<?php
    break;
    case "addTraining":
        ?>
<form action="process-training" method="POST" enctype="multipart/form-data">
    <div class="row card">
        <div class="col-md-12">
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Training</label>
                    <input type="hidden" name="id_process_kat" value="<?php echo $id_process_kat ?>">
                    <input type="hidden" name="id_process" value="<?php echo $id_process['id_process'] ?>">
                    <input type="text" class="form-control" name="judul" required>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-12">
            <div class="form-group">
                <label for="message-text" class="control-label">Gambar</label>
                <input type="file" class="form-control" name="lopoFile" required>
                <small style="color:red">*) ukuran minimal 400 x 400 px</small>
            </div>
        </div> -->
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
    case "editTraining":
        ?>
<a href="<?php echo $module; ?>-edit-<?php echo $data['id_process'] ?>" class="btn btn-success mb-2"><i
        class="fa fa-arrow-left" aria-hidden="true"></i> Kembali Ke Layanan</a>
<form action="process-training" method="POST" enctype="multipart/form-data">
    <div class="row card">
        <div class="col-md-12">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama Training</label>
                        <input type="hidden" name="id_process" value="<?php echo $data['id_process'] ?>">
                        <input type="hidden" name="id_process_kat" value="<?php echo $data['id_process_kat'] ?>">
                        <input type="hidden" name="id_process_sub" value="<?php echo $data['id_process_sub'] ?>">
                        <input type="text" class="form-control" name="judul" value="<?=$data['judul']?>" required>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-12">
                <div class="form-group">
                    <label for="message-text" class="control-label">Gambar</label>
                    <input type="file" class="form-control" name="lopoFile">
                    <div class="" id="img-lopo">
                        <img style="height:200px" src="../images/produk_varian/<?php echo $data['gambar'] ?>">
                    </div>
                </div>
            </div> -->
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
    case "addMainTraining":
        ?>
<form action="process-maintraining" method="POST" enctype="multipart/form-data">
    <div class="row card">
        <div class="col-md-12">
            <div class="card-body">
                <div class="form-group">
                    <label>Judul Training</label>
                    <input type="hidden" name="id_process" value="<?php echo $id_process ?>">
                    <input type="text" class="form-control" name="judul" required>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="message-text" class="control-label">Gambar Ilustrasi</label>
                <input type="file" class="form-control" name="lopoFile" required>
                <small style="color:red">*) ukuran minimal 400 x 400 px</small>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Deskripsi Singkat</label>
                <textarea class="ckeditor" name="singkat"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Jadwal & Biaya</label>
                <textarea id="ckeditor" name="jadwal"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Fasilitas Pelatihan</label>
                <textarea class="ckeditor" name="fasilitas_pelatihan"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Fasilitas Alumni</label>
                <textarea class="ckeditor" name="fasilitas_alumni"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Syarat Training Online</label>
                <textarea class="ckeditor" name="syarat_training"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Tata Cara Pendaftaran</label>
                <textarea class="ckeditor" name="tatacara"></textarea>
            </div>
        </div>
        <input type="submit" class="btn btn-info" value="Simpan Data">
    </div>
</form>
<?php
    break;
    case "editMainTraining":
        ?>
<a href="<?php echo $module; ?>-edit-<?php echo $data['id_process'] ?>" class="btn btn-success mb-2"><i
        class="fa fa-arrow-left" aria-hidden="true"></i> Kembali Ke Layanan</a>
<form action="process-maintraining" method="POST" enctype="multipart/form-data">
    <div class="row card">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama Training</label>
                        <input type="hidden" name="id_process" value="<?php echo $data['id_process'] ?>">
                        <input type="hidden" name="id_process_kat" value="<?php echo $data['id_process_kat'] ?>">
                        <input type="text" class="form-control" name="judul" value="<?=$data['judul']?>" required>
                    </div>
                </div>
                <div class="col-md-12 mt-3 ">
                <label for="">Syarat Pendaftaran</label><br>
                    <a href="training-add-<?=$data['id_process_kat']?>" class="btn btn-warning mb-3"> <i
                            class="fas fa-plus"></i> Tambah Syarat Pendaftaran</a>
                    <div class="table-responsive">
                        <table class="table table-striped">
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
                                            <a href="training-edit-<?php echo $row['id_process_sub']; ?>"
                                                class="btn btn-warning " role="button" aria-pressed="true"
                                                style="min-width: 50px;margin-bottom: 5px;"> <i class="fa fa-pencil"></i>
                                                Edit</a>

                                            <a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');"
                                                href="training-delete-<?php echo $row['id_process_sub']; ?>"
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
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Deskripsi Singkat</label>
                        <textarea class="ckeditor" name="singkat"><?php echo $data['singkat'] ?></textarea>
                    </div>
                </div
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar Ilustrasi</label>
                        <input type="file" class="form-control" name="lopoFile">
                        <div class="" id="img-lopo">
                            <img style="height:200px" src="../images/process_kat/<?php echo $data['gambar'] ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-bottom:10px">
                    <div class="box-body table-responsive"
                        style="border: 1px solid #bfbfbf;min-height: 300px;padding:10px">
                        <label for="exampleInputFile" id="gallery_produk">Brosur Lainnya</label><br>
                        <!--<p style="margin-top: 5px;margin-bottom:0;" class="help-block">*) Ukuran Gambar-->
                        <!--    Minimal Lebar 1000px dan Tinggi 1000px</p>-->
                        <!--<p class="help-block">*) Maksimal Size Gambar 2MB</p>-->
                        <a href="process-addgallery-<?=$data['id_process_kat']?>" class="btn btn-info">Tambah
                            Gambar Brosur</a>
                        <div class="form-group">
                            <div class="row">
                                <?php
                                    foreach($gallery as $tsubpro):
                                ?>
                                <div class="col-md-2 col-xs-12"
                                    style="height: 200px;overflow: hidden;margin: 10px 0px;">
                                    <div class="photo" style="margin-bottom:10px">
                                        <a href="#"
                                            style="width: 100%; height: 150px;overflow: hidden;float: left;overflow: hidden;">
                                            <img src="../images/gallery_process_kat/<?php echo "$imgname1-$tsubpro[gambar]"; ?>"
                                                style="width: 100%; min-height: 150px;overflow: hidden;">
                                        </a>
                                    </div>
                                    <br />
                                    <a style="margin-top:10px" class="btn btn-warning"
                                        href="<?php echo $module; ?>-editgallery-<?php echo $tsubpro['id_gallery']; ?>">Edit</a>
                                    |
                                    <a style="margin-top:10px" class="btn btn-danger"
                                        onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');"
                                        href='process-gallery-delete-<?php echo $tsubpro['id_gallery']; ?>-<?php echo $data['id_process_kat']; ?>'>Hapus</a>
                                </div>
                                <?php
                                    endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Jadwal & Biaya</label>
                        <textarea id="ckeditor" name="jadwal"><?php echo $data['jadwal'] ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Fasilitas Pelatihan</label>
                        <textarea class="ckeditor" name="fasilitas_pelatihan"><?php echo $data['fasilitas_pelatihan'] ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Fasilitas Alumni</label>
                        <textarea class="ckeditor" name="fasilitas_alumni"><?php echo $data['fasilitas_alumni'] ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Syarat Training Online</label>
                        <textarea class="ckeditor" name="syarat_training"><?php echo $data['syarat_training'] ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Tata Cara Pendaftaran</label>
                        <textarea class="ckeditor" name="tatacara"><?php echo $data['tatacara'] ?></textarea>
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