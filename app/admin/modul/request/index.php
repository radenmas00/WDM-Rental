<?php $this->layout('template', ['hal'=>'Request Order']) ?>
<?php
    $module = 'request';
	switch($act){
		case "list":
	?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="my_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="2%" class="center">No</th>
                                <th width="23%" class="center">First Name</th>
                                <th width="23%" class="center">Last Name</th>
                                <th width="23%" class="center">Email</th>
                                <th width="23%" class="center">Phone</th>
                                <th width="10%" class="center">Dibaca</th>
                                <th width="20%" class="center">Tanggal Masuk</th>
                                <th width="18%" class="center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
						$no = 1;
						while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
						?>
                            <tr>
                                <td align="center"><?php echo  $no; ?></td>
                                <td><?php echo  $r['first_name']; ?></td>
                                <td><?php echo  $r['last_name']; ?></td>
                                <td><?php echo  $r['email']; ?></td>
                                <td align="center"><?php echo  $r['phone']; ?></td>
                                <td align="center">
                                    <?php echo  ($r['is_read'] == 0)? '<p class="label label-danger">Belum</p>' : '<p class="label label-info">Sudah</p>'; ?>
                                </td>
                                <td align="center"><?php echo  tgl2($r['tgl']); ?></td>

                                <td align="center" width="17%">
                                    <a href="<?php echo $module; ?>-excel-<?php echo $r['id_quotation']; ?>"
                                        class="btn btn-success btnadmin" role="button"><i class="fa fa-file-excel"></i></a>
                                    <a href="<?php echo $module; ?>-view-<?php echo $r['id_quotation']; ?>"
                                        class="btn btn-primary btnadmin" role="button"><i class="fa fa-eye"></i></a>

                                    <a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');"
                                        href="modul/<?php echo $module; ?>-delete-<?php echo $r['id_quotation']; ?>"
                                        class="btn btn-danger btnadmin" role="button"><i class="fa fa-trash"></i></a>
                                </td>

                            </tr>
                            <?php
						$no++;
						}
						?>
                        </tbody>
                    </table>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div>
    </div><!-- /.col -->
</section><!-- /.col -->


<?php
        $module = 'pesan';
		break;
		case "view":
?>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body no-padding">
                    <div class="mailcard-read-info">
                        <table>
                            <tr>
                                <td>First Name</td>
                                <td width="10px">:</td>
                                <td><?php echo $data['first_name']; ?></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td width="10px">:</td>
                                <td><?php echo $data['last_name']; ?></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td width="10px">:</td>
                                <td><?php echo $data['phone']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td width="10px">:</td>
                                <td><?php echo $data['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td width="10px">:</td>
                                <td><?php echo tgl($data['tgl']); ?></td>
                            </tr>
                            <tr>
                                <td>Message</td>
                            </tr>

                        </table>

                    </div><!-- /.mailcard-read-info -->
                    <div class="alert alert-success mt-4">
                        <?php echo $data['message']; ?>
                    </div><!-- /.mailcard-read-message -->
                </div><!-- /.card-body -->
                <div class="card-footer">
                    <!-- <div class="pull-right">
						<button class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
						<button class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
					  </div> -->
                    <a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');"
                        href="<?php echo $module; ?>-delete-<?php echo $data['id_quotation']; ?>" title="Hapus"><button
                            class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button></a>
                    <!-- <button class="btn btn-default"><i class="fa fa-print"></i> Print</button> -->

                    <input type="button" class="btn btn-success" value="Back" onclick="location.href='pesan'">
                </div><!-- /.card-footer -->
            </div><!-- /. card -->
        </div>
</section>
<?php
		break;  
	}
?>