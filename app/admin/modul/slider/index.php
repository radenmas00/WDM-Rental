<?php $this->layout('template', ['hal' => 'Slider']) ?>
<?php
$module = "slider";

switch ($act) {
    case "list":
?>
        <a href="slider-add" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data</a>
        <br><br>
        <div class="table-responsive">
            <table id="my_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no     = 1;
                    foreach ($dataku as $row) :
                    ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $row['judul'] ?></td>
                            <td><img src="../images/slider/small/<?php echo $row['gambar']; ?>" style="width:100px;margin:0 auto;display:block">
                            </td>
                            <td style="width:19%"><a href="slider-edit-<?php echo $row['id_slider'] ?>" class="btn btn-warning "> <i class="fas fa-pencil-alt"></i> Edit</a>
                                <a onClick="javascript: return confirm('Yakin untuk Menghapus data ?');" href="<?php echo $module; ?>-delete-<?php echo $row['id_slider']; ?>" class="btn btn-danger " role="button" aria-pressed="true" style="min-width: 60px;"> <i class="fa fa-trash"></i> Delete</a>
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
                <form action="slider" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Judul</label>
                                <input type="text" class="form-control" name="nama" required value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Gambar</label>
                                <input type="file" class="form-control" name="lopoFile" required>
                                <p style="color:red; font-weight: bold;">*) Disarankan ratio gambar 16 : 9</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" id="btn-slider" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Simpan</button>
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
                <form action="slider" id="form-slider" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_slider" value="<?php echo $data['id_slider'] ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Judul</label>
                                <input type="text" class="form-control" name="nama" value="<?php echo $data['judul'] ?>">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi"><?php echo $data['deskripsi'] ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Gambar </label>
                                <input type="file" class="form-control" name="lopoFile">
                                <div class="" id="img-lopo">
                                    <img style="height:200px" src="../images/slider/small/<?php echo $data['gambar'] ?>">

                                </div>
                                <br>
                                <p style="color:red; font-weight: bold;">*) Disarankan ratio gambar 16 : 9</p>
                            </div>
                        </div>

                        <input type="submit" id="btn-slider" class="btn btn-primary" value="Simpan Data">
                    </div>
                </form>
            </div>
        </div>
    <?php
        break;
    case "addgallery":
    ?>
        <form action="modul/slider/aksi.php?module=<?php echo $module; ?>&act=addgallery" method="POST" enctype="multipart/form-data">
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
        $gam =  $db->connection("SELECT * FROM gallery_slider WHERE id_gallery = '$_GET[id]'  ")->fetch();
    ?>
        <form action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=editgallery" method="POST" enctype="multipart/form-data">
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
                            <img style="height:300px" src="../images/gallery_slider/<?php echo $imgname2 . "-" . $gam['gambar'] ?>">
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