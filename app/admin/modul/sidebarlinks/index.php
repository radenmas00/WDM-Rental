<?php $this->layout('template', ['hal' => 'Sidebar Links']) ?>
<?php
$module = "sidebarlinks";

switch ($act) {
    case "list":
?>
        <a href="sidebarlinks-add" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data</a>
        <br><br>
        <div class="table-responsive">
            <table id="my_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Link</th>
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
                            <td><?php echo $row['nama'] ?></td>
                            <td><img src="../images/sidebarlinks/small/<?php echo $row['gambar']; ?>" style="width:100px;margin:0 auto;display:block">
                            </td>
                            <td style="width:19%"><a href="sidebarlinks-edit-<?php echo $row['id_link'] ?>" class="btn btn-warning"> <i class="fas fa-pencil-alt"></i> Edit</a>
                                <a onClick="javascript: return confirm('Yakin untuk Menghapus data ?');" href="<?php echo $module; ?>-delete-<?php echo $row['id_link']; ?>" class="btn btn-danger " role="button" aria-pressed="true" style="min-width: 60px;"> <i class="fa fa-trash"></i> Delete</a>
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
                <form action="sidebarlinks" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nama Link</label>
                                <input type="text" class="form-control" name="nama" value="Link">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Link</label>
                                <textarea id="" style="width:100%" cols="30" rows="5" name="link"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Gambar</label>
                                <input type="file" class="form-control" name="lopoFile">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" id="btn-gallery" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            document.querySelector('#btn-gallery').addEventListener('click', function(e) {
                loadingSweet();
            })
        </script>
    <?php
        break;
    case "edit":
    ?>
        <div class="card">
            <div class="card-body">
                <form action="sidebarlinks" id="form-gallery" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_link" value="<?php echo $data['id_link'] ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nama Link</label>
                                <input type="text" class="form-control" name="nama" value="<?php echo $data['nama'] ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Link</label>
                                <textarea id="" style="width:100%" cols="30" rows="5" name="link"><?php echo $data['link'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Gambar</label>
                                <input type="file" class="form-control" name="lopoFile">
                                <div class="" id="img-lopo">
                                    <img style="width:100px" src="../images/sidebarlinks/small/<?php echo $data['gambar'] ?>">
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="btn-gallery" class="btn btn-primary" value="Simpan Data">
                    </div>
                </form>
            </div>
        </div>
        <script>
            document.querySelector('#btn-gallery').addEventListener('click', function(e) {
                loadingSweet();
            })
        </script>
<?php
        break;
}
?>