<?php $this->layout('template', ['hal'=>'Lokasi Tempat Wisata']) ?>
<?php
	$module = 'lokasi';
	switch($act){
		case "list":
	?>      
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModal" > <i class="fa fa-plus"></i> Tambah Data</button>
			<section class="content" style="margin-top:10px">
				<div class="row">
				<div class="col-md-12">
				  <div>
					<div class="table-responsive">
						<table id="my_table2" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th width="5%" class="center">No</th>
							<th width="23%" class="center">Nama</th>               
							<th width="20%"  class="center">Aksi</th>
						  </tr>
						</thead>
						<tbody>
						<?php
						$no = 1;
						while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
						?>
							<tr>
								<td width="5%" align="center"><?php echo  $no; ?></td>
								<td><?php echo  $r['judul']; ?></td>               
								<td align="center" style="width:20%">
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#<?php echo $r['id_lokasi'] ?>" > <i class="fas fa-pencil-alt"></i> Edit</button>
									<a onClick="javascript: return confirm('Yakin untuk Menghapus data ?');" href="<?php echo $module; ?>-delete-<?php echo $r['id_lokasi']; ?>"  class="btn btn-danger btnadmin" role="button" aria-pressed="true" style="min-width: 60px;"> <i class="fa fa-trash"></i> Delete</a>
								</td>
							</tr>
						<!-- modal edit content -->
						<div id="<?php echo $r['id_lokasi'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">Edit Data </h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<form action="lokasi" method="POST" enctype="multipart/form-data">
										<input type="hidden" name="id_lokasi" value="<?php echo $r['id_lokasi']; ?>">
											<div class="form-group">
												<label for="recipient-name" class="control-label">Judul</label>
												<input type="text" class="form-control" id="judul" name="judul" value="<?php echo $r['judul'] ?>">
											</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-danger waves-effect waves-light">Save Data</button>
										</form>
										<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
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

		<!-- modal add portofolio_kategori content -->
		<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form action="lokasi" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nama</label>
                                <input type="text" class="form-control" id="judul" name="judul">
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
					<form role="form" action="modul/portofolio_kategori/aksi.php?module=<?php echo $module; ?>&act=add" method="POST" enctype="multipart/form-data" >
						<div class="box-body table-responsive">
							<div class="col-md-12">
								<div class="form-group">
									<label for="exampleInputEmail1">judul portofolio_kategori <span title="wajib" style="color: red;">*</span></label>
                                    <input name="portofolio_kategori" type="hidden" class="form-control" value="<?php echo $kat_nyan; ?>">
									<input name="judul" type="text" class="form-control" required>
								</div>
							</div>

						</div><!-- /.box-body -->

						<div class="box-footer">
							<button type="submit" class="btn btn-secondary">Save</button>

							<input type="button" class="btn btn-success" value="Back" onclick="location.href='<?php echo $module; ?>' ">
						</div>
					</form>
				  </div><!-- /.box -->
				</div>
			</section>

	<?php
		break;
		case "edit":
		$edit = $db->connection("SELECT * FROM portofolio_kategori WHERE id_lokasi='$_GET[id]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);


	?>

			<section class="content">
			  <div class="row">

				<!-- left column -->
				<div class="col-md-12 card">
				  <!-- general form elements -->
				  <div class="ccard-body">
					<!-- form start -->
					<form role="form" action="modul/portofolio_kategori/aksi.php?module=<?php echo $module; ?>&act=update" method="POST" enctype="multipart/form-data" >
						<input type="hidden" name="id_lokasi" value="<?php echo $tedit['id_lokasi']; ?>">

						<div class="box-body table-responsive">

							<div class="col-md-12">
								<div class="form-group">
									<label for="exampleInputEmail1">judul portofolio_kategori <span title="wajib" style="color: red;">*</span></label>
									<input name="judul" type="text" class="form-control" value="<?php echo $tedit['judul']; ?>" required>
								</div>
							</div>



							<div class="box-footer">
								<button type="submit" class="btn btn-secondary">Save</button>

								<input type="button" class="btn btn-success" value="Back" onclick="location.href='<?php echo $module; ?>' ">
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
						  <h1><a title="Back" class="btnback" onclick="location.href='<?php echo $module; ?>-edit-<?php echo $_GET['id']; ?>#sliderproduk'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> Tambah Gallery</h1>
						  <ol class="breadcrumb">
							<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
							<li class="active"> Tambah Gambar</li>
						  </ol>
						</section>

						<section class="content">
						  <div class="row">
							<!-- left column -->
							<form role="form" action="modul/portofolio_kategori/aksi.php?module=<?php echo $module; ?>&act=addgallery" method="POST" enctype="multipart/form-data" >
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
			          <h1><a title="Back" class="btnback" onclick="location.href='<?php echo $module; ?>-edit-<?php echo $_GET['idm']; ?>#sliderproduk'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> Edit Gambar</h1>
			          <ol class="breadcrumb">
			            <li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
			            <li class="active"> Edit Gambar</li>
			          </ol>
			        </section>

					<section class="content">
			          <div class="row">
			            <!-- left column -->
			            <form role="form" action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=editgallery" method="POST" enctype="multipart/form-data" >
							<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
							<input type="hidden" name="idm" value="<?php echo $_GET['idm']; ?>">

			            <div class="col-md-12">
			              <!-- general form elements -->
			              <div class="box box-success">
			                <!-- form start -->
								<div class="box-body table-responsive">

									<div class="form-group">
										<div class="gallery photo">
											<a href="../images/slideproduk/<?php echo "$imgname1-$tedit[gambar]"; ?>" rel="prettyPhoto[gallery1]" style="width: 200px; height: 150px;">
												<img src="../images/slideproduk/<?php echo "$imgname2-$tedit[gambar]"; ?>" >
											</a>
										</div>
									</div>

									<script type="text/javascript" charset="utf-8">
									$(document).ready(function(){

										$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
										$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
										$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({overlay_gallery: false, theme:'facebook', social_tools: false});
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
