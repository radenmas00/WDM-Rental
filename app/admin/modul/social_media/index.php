<?php $this->layout('template', ['hal'=>'Social Media']) ?>
<?php
	$module = "social-media";

	switch($act){
		case "list":
	?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!--            <button class="btn btn-primary" onclick="window.location.href='<?php echo $module; ?>-add';"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</button>-->
            <div class="card" style="margin-top:10px">
                <div class="card-body ">
                    <div class="table-wrapper">
                        <table id="my_table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%" class="center">No</th>
                                    <th width="23%" class="center">Title </th>
                                    <th width="20%" class="center">Status</th>
                                    <th width="15%" class="text-center">Published</th>
                                    <th width="15%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $no = 1;
                            while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <tr>
                                    <td align="center"><?php echo  $no; ?></td>
                                    <td><?php echo  $r['judul']; ?></td>
                                    <td><?php echo  $r['status']; ?></td>
                                    <td align="center"><?php echo  tgl2($r['tgl_update']); ?></td>

                                    <td align="center">
                                        <a href="<?php echo $module; ?>-edit-<?php echo $r['id_social_media']; ?>" class="btn btn-success btnadmin" role="button" aria-pressed="true" style="min-width: 50px;margin-bottom: 5px;">Edit</a>

                                        <!--                                        <a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="modul/social_media/aksi.php?module=<?php echo $module; ?>&act=remove&id=<?php echo $r['id_social_media']; ?>" class="btn btn-danger btnadmin" role="button" aria-pressed="true" style="min-width: 60px;margin-bottom: 5px;">Delete</a>-->
                                    </td>
                                </tr>
                                <?php
						$no++;
						}
						?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.col-md-12 -->
    </div>
</section><!-- /.section -->

<?php
		break;
		case "add":
		
		date_default_timezone_set('Asia/Jakarta');
		$tgl = date("d-m-Y");
		$skrng = date("d/m/Y");
		$time = date("H:i");
	?>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12 ">
            <div class="card">
                <!-- form start -->
                <form role="form" action="modul/social_media/aksi.php?module=<?php echo $module; ?>&act=add" method="POST" enctype="multipart/form-data">
                    <!-- general form elements -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title<span title="wajib" style="color: red;">*</span></label>
                                    <input name="judul" type="text" class="form-control" required>
                                </div>
                            </div>
                            <!--
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Gambar</label>
                                    <br />
                                    <label class="custom-file form-control">
                                        <input type="file" name="lopoFile" id="lopoFile" class="custom-file-input ">
                                        <span class="custom-file-control custom-file-control-primary"></span>
                                    </label>
                                    <p style="margin-top: 5px;margin-bottom:0;" class="help-block">*) Ukuran Gambar
                                        Minimal Lebar 460px dan Tinggi 360px</p>
                                    <p class="help-block">*) Maksimal Size Gambar 2MB</p>
                                </div>
                            </div>
                            -->
                            <!-- <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Deskripsi</label>
                                    <textarea rows="2" class="form-control" name="deskripsi"></textarea>
                                </div>
                            </div>
                            -->
                            <div class="col-md-6">
                                <div class="form-group">

                                    <input name='tgl' type="hidden" class="form-control fc-datepicker" placeholder="DD/MM/YYYY">
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                    </div><!-- /.card-body -->
                    <div class="card-footer ">
                        <button type="submit" class="mb-2 btn btn-teal float-left">Save</button>
                        <input type="button" class="mb-2 btn btn-secondary float-right" value="Back" onclick="location.href='<?php echo $module; ?>' ">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
		break;
		case "edit":
		$tgl 	= explode("-", $data['tgl_update']);
		$tgl1=$tgl[2];
		$bln=$tgl[1];
		$thn=$tgl[0];
		$tangalo = $tgl1."/".$bln."/".$thn;	
    ?>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12 ">
            <div class="card">
                <!-- form start -->
                <form role="form" action="social-media" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_social_media" value="<?php echo $data['id_social_media'] ?>">
                    <!-- general form elements -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title </label>
                                    <input name="judul" type="text" class="form-control" value="<?php echo $data['judul'] ?>" required readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status </label>
                                    <select name="status" class="form-control">
                                        <option value="off" <?php echo ($data['status'] == 'off')? 'selected' : '' ?> >Off</option>
                                        <option value="on" <?php echo ($data['status'] == 'on')? 'selected' : '' ?> >On</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Social Media Link</label>
                                    <input name="link" type="text" class="form-control" value="<?php echo $data['link'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                    <input type="hidden" name="tgl" class="form-control fc-datepicker" placeholder="DD/MM/YYYY" value="<?php echo $tangalo ?>">
                                </div>
                            </div>
                            <!-- <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Gambar</label>
                                    <br />
                                    <label class="custom-file form-control">
                                        <input type="file" name="lopoFile" id="lopoFile" class="custom-file-input ">
                                        <span class="custom-file-control custom-file-control-primary"></span>
                                    </label>
                                    <p style="margin-top: 5px;margin-bottom:0;" class="help-block">*) Ukuran Gambar
                                        Minimal Lebar 460px dan Tinggi 360px</p>
                                    <p class="help-block">*) Maksimal Size Gambar 2MB</p>
                                    <img style="height: 150px;"
                                        src="../images/social_media/small/<?php echo $data['gambar'] ?>" alt="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Deskripsi</label>
                                    <textarea rows="2" class="form-control" name="deskripsi"><?php echo $data['deskripsi'] ?></textarea>
                                </div>
                            </div> -->
                        </div><!-- /.box-body -->

                    </div><!-- /.card-body -->
                    <div class="card-footer  bg-white">
                        <button type="submit" class="mb-2 btn btn-primary float-left"> <i class="fa fa-paper-plane"></i> Save</button>
                        <input type="button" class="mb-2 btn btn-secondary float-right" value="Back" onclick="location.href='<?php echo $module; ?>' ">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
		break;  
	}
?>