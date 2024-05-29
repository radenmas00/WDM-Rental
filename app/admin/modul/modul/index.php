<?php $this->layout('template',['hal' => 'Module']) ?>
<?php
	$module = 'module';
	switch($act){
	  // Tampil Modul
	  case "list":
?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<!-- <button class="btn bg-olive margin" onclick="window.location.href='?module=modul&act=add';">Tambah Halaman</button> -->
							<div class="card-body table-wrapper">
								<table id="my_table" class="table display responsive nowrap table-striped table-bordered">
								<thead>
								<tr>
									<th width="2%">No</th>
									<th width="23%">Module</th>
									<th width="15%">Tanggal Update</th>
									<th width="15%" class="text-center">Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$no = 1;
								while($r = $tampil->fetch(PDO::FETCH_ASSOC)){  
									$tanggal2=tgl2($r['tgl_update']);
								?>
									<tr>
										<td align="center"><?php echo  $no; ?></td>
										<td><?php echo  $r['nama']; ?></td>
										<td><?php echo  $tanggal2; ?></td>
										<td align="center">
											<a href="<?php echo $module; ?>-edit-<?php echo $r['id_modul']; ?>" style="min-width: 50px;margin-bottom: 5px;" class="btn btn-secondary btn-block" role="button" aria-pressed="true" style=""><i class="fa fa-edit"></i> Edit</a>
										</td>
										<?php
										if($r['hapus']=="Yes"){
										?>
										<td align="center">
											<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="modul/modul/aksi.php?module=<?php echo $module; ?>&act=remove&id=<?php echo $r['id_modul']; ?>"  class="btn btn-danger btnadmin" role="button" aria-pressed="true" style="min-width: 70px;margin-bottom: 5px;">Delete</a>
										</td>
										<?php
										}
										?>
									</tr>
								<?php
								$no++;
								}
								?>
								</tbody>
							</table>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
			   
					</div><!-- /.col -->
				</div><!-- /.row -->
			
	<?php
		break;
		case "edit":
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);
	?>
			<section class="content">
			  <div class="row">
			  
				<!-- left column -->
				<div class="col-md-12 card">
					<!-- general form elements -->
					<div class="card-body">
						<!-- form start -->
						<form role="form" action="module" method="POST" enctype="multipart/form-data" >
							<input type="hidden" name="id_modul" value="<?php echo $tedit['id_modul']; ?>">
							<input type="hidden" name="jenis_modul" value="<?php echo $tedit['jenis_modul']; ?>">
							
							<div class="box-body table-responsive">			
								<?php
								if( ($tedit['jenis_modul']=='Judul & Text') OR ($tedit['jenis_modul']=='Judul & Textarea')){
								?>
								<div class="form-group">
									<label for="exampleInputEmail1">Nama Halaman</label>
									<input name="nama" type="text" class="form-control" value="<?php echo $tedit['nama']; ?>">
								</div>
								<?php
								}else{
								?>
								<div class="form-group">
									<label for="exampleInputEmail1">Nama Halaman</label>
									<input name="nama" type="text" class="form-control" value="<?php echo $tedit['nama']; ?>" readonly>
								</div>
								<?php
								}
								?>
								
								
								<?php
								if(($tedit['jenis_modul']=='Text')OR($tedit['jenis_modul']=='Judul & Text')OR($tedit['jenis_modul']=='Text Images')){
								?>
								<div class="form-group">
									<label for="exampleInputEmail1">Deskripsi</label><br>
									<textarea name="deskripsi" id="" style="width:100%" cols="30" rows="10"><?php echo $tedit['deskripsi']; ?></textarea>
									<!-- <input type="text" value="<?php echo $tedit['deskripsi']; ?>" name="deskripsi" class="form-control"> -->
									<!-- <textarea class="ckeditor" id="ckeditor" name="deskripsi" style="width: 100%; height: 100px;"><?php echo $tedit['deskripsi']; ?></textarea> -->
								</div>
								<?php
								}elseif(($tedit['jenis_modul']=='Textarea')OR($tedit['jenis_modul']=='Judul & Textarea')OR($tedit['jenis_modul']=='Textarea Images')){
								?>
								<div class="form-group">
									<label for="exampleInputEmail1">Deskripsi</label>
									<textarea  id="ckeditor" name="deskripsi"><?php echo $tedit['deskripsi']; ?></textarea>
								</div>
								<?php
								}else{
									echo '<input type="hidden" name="deskripsi" value="'.$tedit['deskripsi'].'">';
								}
								
								if(($tedit['jenis_modul']=='Images')OR($tedit['jenis_modul']=='Text Images')OR($tedit['jenis_modul']=='Textarea Images')){
								?>
								<div class="form-group">
									<label for="exampleInputFile">Ganti Foto</label>
									<p class="help-block"><img src="../images/<?php echo $tedit['gambar']; ?>" width="200px"></p>
									<input name="fupload" type="file">
									<p class="help-block">*) Maksimal Lebar Foto 670pixel</p>
									<p class="help-block">*) Apabila Foto tidak diubah, dikosongkan saja.</p>
								</div>
								<?php
								}else{
									echo '<input type="hidden" name="gambar" value="'.$tedit['gambar'].'">';
								}
								?>
								
								
							</div><!-- /.box-body -->
		
							<div class="box-footer">
								<button type="submit" class="btn btn-primary">Update</button>
								<input type="button" class="btn btn-success" value="Kembali" onclick="location.href='module'">
							</div>
						</form>
					</div><!-- /.box -->
				</div>
			</section>
			
	<?php
		break;  
	}
?>
