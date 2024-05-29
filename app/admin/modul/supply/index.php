<?php $this->layout('template', ['hal'=>'Supply Data']) ?>
<?php
	$module = 'supply';
	switch($act){
		case "list":
	?>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModal"> <i class="fa fa-plus"></i>
    Tambah Data</button>
<section class="content" style="margin-top:10px">
    <div class="row">
        <div class="col-md-12">
            <div>
                <div class="table-responsive">
                    <table id="my_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="23%" class="center">Variable Name</th>
                                <th width="23%" class="center">Group</th>
                                <th width="23%" class="center">Definition</th>
                                <th width="23%" class="center">Price</th>
                                <th width="23%" class="center">Year Coverage</th>
                                <th width="23%" class="center">Availability Status</th>
                                <th width="20%" class="center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
						$no = 1;
						foreach($datas as $r){
						?>
                            <tr>
                                <td style="width:5%"><?=$no?></td>
                                <td><?php echo  $r['variable_name']; ?></td>
                                <td><?php echo  $r['group_supply']; ?></td>
                                <td style="width:25%"><?php echo  $r['definition']; ?></td>
                                <td><?php echo  $r['price']; ?></td>
                                <td style="width:10%"><?php echo  $r['year_coverage']; ?></td>
                                <td style="width:10%"><?php echo  $r['availability_status']; ?></td>
                                <td align="center" style="width:6%">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#<?php echo $r['id_supply'] ?>"> <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <a onClick="javascript: return confirm('Yakin untuk Menghapus data ?');"
                                        href="<?php echo $module; ?>-delete-<?php echo $r['id_supply']; ?>"
                                        class="btn btn-danger btn-sm" role="button" aria-pressed="true"
                                        > <i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>
                            <!-- modal edit content -->
                            <div id="<?php echo $r['id_supply'] ?>" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Data </h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="supply" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="id_supply"
                                                    value="<?php echo $r['id_supply']; ?>">
                                                <div class="form-group">
                                                    <label class="control-label">Variable Name</label>
                                                    <input type="text" class="form-control" name="variable_name" value="<?=$r['variable_name']?>"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Group</label>
                                                    <input type="text" class="form-control" name="group_supply" value="<?=$r['group_supply']?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Definition</label>
                                                    <input type="text" class="form-control" name="definition" value="<?=$r['definition']?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Price</label>
                                                    <input type="number" class="form-control" name="price" value="<?=$r['price']?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Year
                                                        Coverage</label>
                                                    <input type="text" class="form-control" name="year_coverage" value="<?=$r['year_coverage']?>"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Availability
                                                        Status</label>
                                                    <input type="text" class="form-control" name="availability_status" value="<?=$r['availability_status']?>"
                                                        required>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger waves-effect waves-light">Save
                                                Data</button>
                                            </form>
                                            <button type="button" class="btn btn-default waves-effect"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal -->
                            <?php
						$no++;
						}
						?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div>
</section><!-- /.col -->

<!-- modal add supply content -->
<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="supply" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label">Variable Name</label>
                        <input type="text" class="form-control" name="variable_name" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Group</label>
                        <input type="text" class="form-control" name="group_supply" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Definition</label>
                        <input type="text" class="form-control" name="definition" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Price</label>
                        <input type="number" class="form-control" name="price" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Year Coverage</label>
                        <input type="text" class="form-control" name="year_coverage" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Availability Status</label>
                        <input type="text" class="form-control" name="availability_status" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger waves-effect waves-light">Simpan</button>
                </form>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->

<?php
		break;
		case "add":
	?>
<section class="content">
    <div class="row">

        <!-- left column -->
        <div class="col-md-12 card">
            <!-- general form elements -->
            <div class="card-body">
                <!-- form start -->
                <form role="form" action="modul/supply/aksi.php?module=<?php echo $module; ?>&act=add" method="POST"
                    enctype="multipart/form-data">
                    <div class="box-body table-responsive">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">judul supply <span title="wajib"
                                        style="color: red;">*</span></label>
                                <input name="supply" type="hidden" class="form-control"
                                    value="<?php echo $kat_nyan; ?>">
                                <input name="judul" type="text" class="form-control" required>
                            </div>
                        </div>

                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-secondary">Save</button>

                        <input type="button" class="btn btn-success" value="Back"
                            onclick="location.href='<?php echo $module; ?>' ">
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
</section>

<?php
		break;
		case "edit":
		$edit = $db->connection("SELECT * FROM supply WHERE id_supply='$_GET[id]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);


	?>

<section class="content">
    <div class="row">

        <!-- left column -->
        <div class="col-md-12 card">
            <!-- general form elements -->
            <div class="ccard-body">
                <!-- form start -->
                <form role="form" action="modul/supply/aksi.php?module=<?php echo $module; ?>&act=update" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id_supply" value="<?php echo $tedit['id_supply']; ?>">

                    <div class="box-body table-responsive">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">judul supply <span title="wajib"
                                        style="color: red;">*</span></label>
                                <input name="judul" type="text" class="form-control"
                                    value="<?php echo $tedit['judul']; ?>" required>
                            </div>
                        </div>



                        <div class="box-footer">
                            <button type="submit" class="btn btn-secondary">Save</button>

                            <input type="button" class="btn btn-success" value="Back"
                                onclick="location.href='<?php echo $module; ?>' ">
                        </div>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>

<?php
					break;
					case "addgallery":
				?>

<section class="content-header">
    <h1><a title="Back" class="btnback"
            onclick="location.href='<?php echo $module; ?>-edit-<?php echo $_GET['id']; ?>#sliderproduk'"><i
                class="fa fa-arrow-left" aria-hidden="true"></i></a> Tambah Gallery</h1>
    <ol class="breadcrumb">
        <li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Tambah Gambar</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <form role="form" action="modul/supply/aksi.php?module=<?php echo $module; ?>&act=addgallery" method="POST"
            enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-success">
                    <!-- form start -->
                    <div class="box-body table-responsive">

                        <div class="form-group">
                            <label for="exampleInputFile">Gambar</label>
                            <input name="nyanpload" type="file" id="exampleInputFile">
                            <p class="help-block">*) Maksimal Size Foto 1MB</p>
                            <p class="help-block">*) Apabila Foto tidak diubah, dikosongkan saja.</p>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div><!-- /.box -->
            </div><!-- /.box -->
        </form><!-- /.box -->
    </div>
</section>

<?php
					break;
					case "editgallery":
					$id_slideproduk = $_GET["id"];
					$edit = $db->connection("SELECT * FROM slideproduk WHERE id_slideproduk='$id_slideproduk'");
					$tedit = $edit->fetch();
				?>

<link rel="stylesheet" id="vcss-css" href="../sys/css/v-css.css" type="text/css" media="all">
<script src="../sys/slider/jquery.js"></script>

<section class="content-header">
    <h1><a title="Back" class="btnback"
            onclick="location.href='<?php echo $module; ?>-edit-<?php echo $_GET['idm']; ?>#sliderproduk'"><i
                class="fa fa-arrow-left" aria-hidden="true"></i></a> Edit Gambar</h1>
    <ol class="breadcrumb">
        <li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Edit Gambar</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <form role="form" action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=editgallery"
            method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" name="idm" value="<?php echo $_GET['idm']; ?>">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-success">
                    <!-- form start -->
                    <div class="box-body table-responsive">

                        <div class="form-group">
                            <div class="gallery photo">
                                <a href="../images/slideproduk/<?php echo "$imgname1-$tedit[gambar]"; ?>"
                                    rel="prettyPhoto[gallery1]" style="width: 200px; height: 150px;">
                                    <img src="../images/slideproduk/<?php echo "$imgname2-$tedit[gambar]"; ?>">
                                </a>
                            </div>
                        </div>

                        <script type="text/javascript" charset="utf-8">
                            $(document).ready(function () {

                                $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({
                                    animation_speed: 'normal',
                                    theme: 'light_square',
                                    slideshow: 3000,
                                    autoplay_slideshow: true
                                });
                                $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({
                                    animation_speed: 'fast',
                                    slideshow: 10000,
                                    hideflash: true
                                });
                                $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({
                                    overlay_gallery: false,
                                    theme: 'facebook',
                                    social_tools: false
                                });
                            });
                        </script>

                        <div class="form-group">
                            <label for="exampleInputFile">Ganti Gambar</label>
                            <input name="nyanpload" type="file" id="exampleInputFile">
                            <p class="help-block">*) Maksimal Lebar Foto 670pixel</p>
                            <p class="help-block">*) Apabila Foto tidak diubah, dikosongkan saja.</p>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div><!-- /.box -->
            </div><!-- /.box -->
        </form><!-- /.box -->
    </div>
</section>

<?php
		break;
	}
?>