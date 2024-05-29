<?php
$jodol = "Properti";
$this->layout('template', ['hal' => $jodol])
?>
<?php
$module = "properti";

switch ($act) {
    case "list":
?>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <?php if ($per == 'all') : ?>
                        <button class="btn btn-primary" onclick="window.location.href='properti-add';"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</button>
                    <?php else : ?>
                        <button class="btn btn-primary" onclick="window.location.href='properti-add';"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</button>
                    <?php endif; ?>
                    <div class="card" style="margin-top:10px">
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table id="my_table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="2%" class="center">No</th>
                                            <th width="30%" class="center">Judul </th>
                                            <th width="10%" class="center">Gambar</th>
                                            <th width="15%" class="center">Published</th>
                                            <th width="20%" class="center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while ($r = $tampil->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <tr>
                                                <td align="center"><?php echo  $no; ?></td>
                                                <td><?php echo  $r['judul']; ?></td>
                                                <td align="center"><img src="../images/<?php echo "properti/small/$r[gambar]"; ?>" width="180px">
                                                </td>
                                                <td width="20%" align="center"><?php echo  tgl2($r['tgl']); ?></td>

                                                <td align="center" width="20%">
                                                    <a href="properti-edit-<?php echo $r['id_properti']; ?>" class="btn btn-warning " role="button" aria-pressed="true" style="min-width: 50px;margin-bottom: 5px;"> <i class="fa fa-pencil"></i> Edit</a>

                                                    <a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="properti-delete-<?php echo $r['id_properti']; ?>" class="btn btn-danger " role="button" aria-pressed="true" style="min-width: 60px;margin-bottom: 5px;"> <i class="fa fa-trash"></i> Delete</a>
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
                    </div>
                </div>
            </div>
        </section>

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
                <div class="col-md-12 ">
                    <div class="card">
                        <form role="form" action="properti" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Judul<span title="wajib" style="color: red;">*</span></label>
                                            <input name="judul" type="text" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Gambar</label>
                                            <br />
                                            <input type="file" name="lopoFile" id="lopoFile" class="form-control">
                                            <p style="margin-top: 5px;margin-bottom:0;" class="help-block">*) Ukuran Gambar
                                                Minimal Lebar 750px dan Tinggi 350px</p>
                                            <p class="help-block">*) Maksimal Size Gambar 2MB</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tgl Publish</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                                <input name='tgl' type="text" class="form-control fc-datepicker" placeholder="DD/MM/YYYY">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Harga</label>
                                            <input name="harga" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Deskripsi</label>
                                            <textarea id="ckeditor" name="deskripsi"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <p class="alert alert-warning">SEO (Search Engine Optimation)</p>
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="sl-icon-key"></i></span>
                                                    <span class="hidden-xs-down">Keyword</span></a> </li>
                                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="sl-icon-list"></i></span>
                                                    <span class="hidden-xs-down">Description</span></a> </li>
                                        </ul>

                                        <div class="tab-content tabcontent-border">
                                            <div class="tab-pane active" id="home" role="tabpanel">
                                                <div class="p-20">
                                                    <textarea rows="4" name="keyword" class="form-control" placeholder="SEO Keyword"></textarea>
                                                </div>
                                            </div>
                                            <div class="tab-pane  p-20" id="profile" role="tabpanel">
                                                <textarea rows="4" name="description" class="form-control" placeholder="SEO Description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer pb-5">
                                <button type="submit" class="mb-2 btn btn-primary float-left">Simpan</button>
                                <input type="button" class="mb-2 btn btn-secondary float-right" value="Kembali" onclick="location.href='properti' ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    <?php
        break;
    case "edit":
        $tgl     = explode("-", $data['tgl']);
        $tgl1 = $tgl[1];
        $bln = $tgl[2];
        $thn = $tgl[0];
        $tangalo = $tgl1 . "/" . $bln . "/" . $thn;
        $keywordo = $data['keyword'];
        $unggulan = $data['unggulan'];
        $desc     = $data['description']
    ?>

        <section class="content">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="card">
                        <form role="form" action="properti" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_properti" value="<?php echo $data['id_properti'] ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Judul<span title="wajib" style="color: red;">*</span></label>
                                            <input name="judul" type="text" class="form-control" value="<?php echo $data['judul'] ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Gambar</label>
                                            <br />
                                            <input type="file" name="lopoFile" id="lopoFile" class="form-control ">
                                            <p style="margin-top: 5px;margin-bottom:0;" class="help-block">*) Ukuran Gambar
                                                Minimal Lebar 750px dan Tinggi 350px</p>
                                            <p class="help-block">*) Maksimal Size Gambar 2MB</p>
                                            <img style="height: 150px;" src="../images/properti/small/<?php echo $data['gambar'] ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tgl Publish</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                                <input type="text" name="tgl" class="form-control fc-datepicker" placeholder="DD/MM/YYYY" value="<?php echo $tangalo ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Harga</label>
                                            <input name="harga" type="text" class="form-control" value="<?php echo $data['harga'] ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Deskripsi</label>
                                            <textarea id="ckeditor" name="deskripsi"><?php echo $data['deskripsi'] ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="alert alert-primary" role="alert">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <i class="icon ion-ios-information alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                                                <span><strong>SEO (Search Engine Optimation)</strong></span>
                                            </div>
                                        </div>

                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="desc-tab" data-toggle="tab" href="#desc" role="tab" aria-controls="desc" aria-selected="true">Description</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="keyword-tab" data-toggle="tab" href="#keyword" role="tab" aria-controls="profile" aria-selected="false">Keyword</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="desc" role="tabpanel" aria-labelledby="desc-tab">
                                                <textarea rows="4" name="description" class="form-control" placeholder="SEO Description"><?php echo $data['description'] ?></textarea>
                                            </div>
                                            <div class="tab-pane fade" id="keyword" role="tabpanel" aria-labelledby="keyword-tab">
                                                <textarea rows="4" name="keyword" class="form-control" placeholder="SEO Keyword"><?php echo $data['keyword'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer pb-5">
                                <button type="submit" class="mb-2 btn btn-success float-left">Simpan</button>
                                <input type="button" class="mb-2 btn btn-secondary float-right" value="Kembali" onclick="location.href='properti' ">
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