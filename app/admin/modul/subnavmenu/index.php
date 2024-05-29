<?php
$jodol = "Sub Nav Menu";
$this->layout('template', ['hal' => $jodol])
?>
<?php
$module = "subnavmenu";

switch ($act) {
    case "list":
?>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <?php if ($per == 'all') : ?>
                        <button class="btn btn-primary" onclick="window.location.href='<?= $menu ?>-<?php echo $module; ?>-add';"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</button>
                    <?php else : ?>
                        <button class="btn btn-primary" onclick="window.location.href='<?= $menu ?>-<?php echo $urk; ?>-add';"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</button>
                    <?php endif; ?>
                    <div class="card" style="margin-top:10px">
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table id="my_table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="2%" class="center">No</th>
                                            <th width="30%" class="center">Nama Submenu</th>
                                            <!-- <th width="10%" class="center">Menu</th> -->
                                            <th width="15%" class="center">Tipe</th>
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
                                                <td><?php echo  $r['nama_submenu']; ?></td>
                                                <!-- <td><?php echo  $r['nama_menu']; ?></td> -->
                                                <td><?php echo  $r['tipe_submenu']; ?></td>
                                                <td align="center" width="20%">
                                                    <a href="<?php echo $module; ?>-edit-<?php echo $r['id_subnavmenu']; ?>" class="btn btn-warning " role="button" aria-pressed="true" style="min-width: 50px;margin-bottom: 5px;"> <i class="fa fa-pencil"></i> Edit</a>

                                                    <a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="<?php echo $module; ?>-delete-<?php echo $r['id_subnavmenu']; ?>" class="btn btn-danger " role="button" aria-pressed="true" style="min-width: 60px;margin-bottom: 5px;"> <i class="fa fa-trash"></i> Delete</a>
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
                        <form role="form" action="<?= $menu ?>-subnavmenu" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_navmenu" value="<?php echo $idnavmenu['id_navmenu'] ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Submenu<span title="wajib" style="color: red;">*</span></label>
                                            <input name="nama_submenu" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Menu</label>
                                            <select class="form-control" name="id_navmenu">
                                                <?php foreach ($navmenu as $row) : ?>
                                                    <option value="<?= $row['id_navmenu'] ?>"><?= $row['nama_menu'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tipe</label>
                                            <select name="tipe_submenu" class="form-control">
                                                <option value="halaman">Halaman</option>
                                                <option value="link">Link</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer pb-5">
                                <button type="submit" class="mb-2 btn btn-primary float-left">Simpan</button>
                                <input type="button" class="mb-2 btn btn-secondary float-right" value="Kembali" onclick="location.href='<?php echo $module; ?>' ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    <?php
        break;
    case "edit":
    ?>
        <section class="content">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="card">
                        <form role="form" action="<?= $menu ?>-subnavmenu" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_subnavmenu" value="<?php echo $data['id_subnavmenu'] ?>">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Submenu<span title="wajib" style="color: red;">*</span></label>
                                            <input name="nama_submenu" type="text" class="form-control" value="<?php echo $data['nama_submenu'] ?>" required>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Menu</label>
                                            <select class="form-control" name="id_navmenu">
                                                <?php foreach ($navmenu as $row) : ?>
                                                    <option value="<?= $row['id_navmenu'] ?>" <?php echo ($data['id_navmenu'] == $row['id_navmenu']) ? 'selected' : '' ?>><?= $row['nama_menu'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tipe</label>
                                            <select name="tipe_submenu" class="form-control">
                                                <option value="halaman" <?php echo ($data['tipe_submenu'] == 'halaman') ? 'selected' : '' ?>>Halaman</option>
                                                <option value="link" <?php echo ($data['tipe_submenu'] == 'link') ? 'selected' : '' ?>>Link</option>
                                            </select>
                                        </div>
                                    </div>

                                    <?php if ($data['tipe_submenu'] == 'link') { ?>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Link</label>
                                                <textarea id="" style="width:100%" cols="30" rows="5" name="link"><?php echo $data['link'] ?></textarea>
                                            </div>
                                        </div>

                                    <?php } elseif ($data['tipe_submenu'] == 'halaman') { ?>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Judul Isi Halaman<span title="wajib" style="color: red;">*</span></label>
                                                <input name="judul_konten" type="text" class="form-control" value="<?php echo $data['judul_konten'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Isi Halaman</label>
                                                <textarea id="ckeditor" name="konten"><?php echo $data['konten'] ?></textarea>
                                            </div>
                                        </div>

                                    <?php } ?>

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
                                <input type="button" class="mb-2 btn btn-secondary float-right" value="Kembali" onclick="location.href='<?php echo $module; ?>' ">
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