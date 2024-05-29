<?php $this->layout('template') ?>
<?php	
$aksi="modul/page/aksi.php";
$hal = "Page";
$module = "page";

switch($act){
		case "list":
?>
<br><br>
<div class="table-responsive">
    <table id="my_table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Tgl Update</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
				$no = 1;
				$dataku = $db->connection("SELECT * FROM page WHERE tampil ='Ya' ORDER BY judul ASC")->fetchAll();
				foreach($dataku as $row) :
            ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $row['judul'] ?></td>
                <td><?php echo tgl2($row['tgl_update']) ?></td>
                <td>
                    <a href="page-edit-<?php echo $row['id_page'] ?>" class="btn btn-warning"> <i class="fas fa-pencil-alt"></i> Edit</a>
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
case "edit":
?>
<div class="content">
    <div class="row card">
        <div class="card-body">
            <div class=" col-md-12">
                <form action="page" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_page" value="<?php echo $row['id_page']; ?>">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $row['judul'] ?>" readonly>
                    </div>
                    
                    <!--<?php if( $row['id_page'] == 13 ) : ?>-->
                    <!-- <div class="form-group">-->
                    <!--    <label for="recipient-name" class="control-label">Text</label>-->
                    <!--    <input type="text" class="form-control" id="judul" name="text2" value="<?php echo $row['text2'] ?>" >-->
                    <!--</div>-->
                    <!--<?php endif; ?>-->
                    
                    <?php if($row['jenis_modul']== 'Textarea Images' OR $row['jenis_modul']== 'Judul & Textarea' OR $row['jenis_modul']== 'Textarea' OR $row['jenis_modul']== 'Textarea Keterangan'  ) { ?>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Deskripsi</label>
                        <textarea name="deskripsi" id="ckeditor"><?php echo $row['deskripsi'] ?></textarea>
                    </div>
                    <?php } ?>
                    <?php if($row['jenis_modul']== 'Textarea Keterangan'  ) { ?>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Keterangan</label>
                        <textarea name="keterangan" id="ckeditor2"><?php echo $row['keterangan'] ?></textarea>
                    </div>
                    <?php } ?>
                    <?php if(  $row['jenis_modul']== 'Text' OR  $row['jenis_modul']== 'Text Images'   ) { ?>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id=""><?php echo $row['deskripsi'] ?></textarea>
                    </div>
                    <?php } ?>
                    <?php if($row['jenis_modul']== 'Images & Link'   ) { ?>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Link</label>
                        <textarea class="form-control" name="deskripsi" id=""><?php echo $row['deskripsi'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar</label>
                        <input type="file" class="form-control" name="lopoFile">
                        <p class="help-block">*) Apabila Gambar tidak diubah, dikosongkan saja.</p>
                        <img src="../images/<?php echo $row['gambar']; ?>" width="180px">
                    </div>
                    <?php } ?>
                    <?php if($row['jenis_modul']== 'Textarea Images' OR $row['jenis_modul']== 'Text Images' OR $row['jenis_modul']== 'Images' OR $row['jenis_modul']== 'Images SEO' ) { ?>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Gambar</label>
                        <input type="file" class="form-control" name="lopoFile">
                        <p class="help-block">*) Apabila File / Gambar tidak diubah, dikosongkan saja.</p>
                        
                        <?php
                            $berkas = explode('.',$row['gambar']);
                            $berkas = $berkas[1];
                            if($berkas == 'pdf'){
                                echo "<a target='_blank' href ='../images/$row[gambar]'><i class=' fa fa-file-pdf-o fa-2x'></i> Berkas PDF</a>";
                            }else{
                                echo '<img src="../images/'.$row['gambar'].'" width="180px">';
                            }
                        
                        ?>
                    </div>
                    <?php } ?>
                    <?php if($row['jenis_modul'] == 'SEO' OR $row['jenis_modul'] == 'Images SEO' OR $row['jenis_modul'] == 'Textarea' OR $row['jenis_modul']== 'Textarea Images'  OR $row['jenis_modul']== 'Textarea Keterangan' ){ ?>

                    <p class="alert alert-warning">SEO (Search Engine Optimation)</p>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tetle" role="tab"><span class="hidden-sm-up"><i class="sl-icon-star"></i></span> <span class="hidden-xs-down">Title</span></a> </li>
                        <li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="sl-icon-key"></i></span> <span class="hidden-xs-down">Keyword</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="sl-icon-list"></i></span> <span class="hidden-xs-down">Description</span></a> </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabcontent-border">
                        <div class="tab-pane active  p-20" id="tetle" role="tabpanel">
                            <textarea rows="4" name="title" class="form-control" placeholder="SEO Title"><?php echo $row['title']  ?></textarea>
                        </div>
                        <div class="tab-pane" id="home" role="tabpanel">
                            <div class="p-20">
                                <textarea rows="4" name="keyword" class="form-control" placeholder="SEO Keyword"><?php echo $row['keyword']  ?></textarea>
                            </div>
                        </div>
                        <div class="tab-pane  p-20" id="profile" role="tabpanel">
                            <textarea rows="4" name="description" class="form-control" placeholder="SEO Description"><?php echo $row['description']  ?></textarea>
                        </div>
                    </div>
                    <?php } ?>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Save Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
break;  
}
?>