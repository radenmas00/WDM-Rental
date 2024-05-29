<?php $this->layout('template', ['hal'=>'Products']) ?>
<?php
	$module = "produk";

	switch($act){
		case "list":
	?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary" onclick="window.location.href='<?php echo $module; ?>-add';"><i
                    class="fa fa-plus" aria-hidden="true"></i> Tambah Data</button>
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
                            while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <tr>
                                    <td align="center"><?php echo  $no; ?></td>
                                    <td><?php echo  $r['judul']; ?></td>
                                    <td align="center"><img src="../images/<?php echo "produk/small/$r[gambar]"; ?>"
                                            width="60px">
                                    </td>
                                    <td width="20%" align="center"><?php echo  tgl2($r['tgl']); ?></td>

                                    <td align="center" width="20%">
                                        <a href="<?php echo $module; ?>-edit-<?php echo $r['id_produk']; ?>"
                                            class="btn btn-warning " role="button" aria-pressed="true"
                                            style="min-width: 50px;margin-bottom: 5px;"> <i class="fa fa-pencil"></i>
                                            Edit</a>

                                        <a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');"
                                            href="<?php echo $module; ?>-delete-<?php echo $r['id_produk']; ?>"
                                            class="btn btn-danger " role="button" aria-pressed="true"
                                            style="min-width: 60px;margin-bottom: 5px;"> <i class="fa fa-trash"></i>
                                            Delete</a>
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
                <form role="form" action="produk" method="POST" enctype="multipart/form-data">
                    <!-- general form elements -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Layanan<span title="wajib"
                                            style="color: red;">*</span></label>
                                    <input name="judul" type="text" class="form-control" required>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">URL Official<span title="wajib"
                                            style="color: red;">*</span></label>
                                    <input name="item_number" type="text" class="form-control" required>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kategori</label>
                                    <select name="id_produk_k" class="form-control" id="kategori" required>
                                        <option value="">-- Select Kategori --</option>
                                        <?php foreach($kategori as $r) : ?>
                                        <option value="<?=$r['id_produk_k']?>"><?=$r['judul']?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tag</label>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <select class="select2 m-b-10 select2-multiple " multiple="multiple"
                                                data-placeholder="Pilih Tag" style="width:100%">
                                                <?php 
                                                foreach ($tag as $row): ?>
                                                <option value="<?php echo $row['id_produk_tag'] ?>">
                                                    <?php echo $row['name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <a class="btn btn-info" href="produk_tag"><i class="fa fa-plus"></i> Tag
                                            </a>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_tag" id="id_tag" class="myTag">
                                </div>
                            </div> -->
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Penulis</label>
                                    <input name="material" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jumlah Halaman</label>
                                    <input name="moq" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ukuran</label>
                                    <input name="ukuran" type="text" class="form-control">
                                </div>
                            </div> -->
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Terbit</label>
                                    <input name="terbit" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Kutipan</label>
                                    <textarea  class="form-control"
                                        name="kutipan" maxlength="300"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Sinopsis</label>
                                    <textarea id="ckeditor" class="cksimple form-control"
                                        name="deskripsi_singkat"></textarea>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sub Kategori</label>
                                    <select name="id_produk_sk" class="form-control" id="sub-kategori" required
                                        disabled>
                                    </select>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Shopee</label>
                                    <input name="shopee" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Tokopedia</label>
                                    <input name="tokopedia" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Stok</label>
                                    <select name="stok" class="form-control">
                                        <option value="tersedia">Tersedia
                                        </option>
                                        <option value="Habis">
                                            Habis</option>
                                        <option value="Terbatas">Terbatas
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Unggulan</label>
                                    <select name="unggulan" class="form-control">
                                        <option value="ya">Ya
                                        </option>
                                        <option value="tidak">Tidak</option>
                                    </select>
                                </div>
                            </div> 
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga Diskon</label>
                                    <input name="harga_diskon" type="text" class="form-control ninjin">
                                </div>
                            </div> -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga</label>
                                    <input name="harga" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Gambar</label>
                                    <br />
                                    <input type="file" name="lopoFile" id="lopoFile" class="form-control">
                                    <p style="margin-top: 5px;margin-bottom:0;" class="help-block">*) Ukuran Gambar
                                        Minimal Lebar 1000px dan Tinggi 1000px</p>
                                    <p class="help-block">*) Maksimal Size Gambar 2MB</p>
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
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home"
                                            role="tab"><span class="hidden-sm-up"><i class="sl-icon-key"></i></span>
                                            <span class="hidden-xs-down">Keyword</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile"
                                            role="tab"><span class="hidden-sm-up"><i class="sl-icon-list"></i></span>
                                            <span class="hidden-xs-down">Description</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane active" id="home" role="tabpanel">
                                        <div class="p-20">
                                            <textarea rows="4" name="keyword" class="form-control"
                                                placeholder="SEO Keyword"></textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane  p-20" id="profile" role="tabpanel">
                                        <textarea rows="4" name="description" class="form-control"
                                            placeholder="SEO Description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.card-body -->
                    <div class="card-footer pb-5">
                        <button type="submit" class="mb-2 btn btn-primary float-left">Simpan</button>
                        <input type="button" class="mb-2 btn btn-secondary float-right" value="Kembali"
                            onclick="location.href='<?php echo $module; ?>' ">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    let kategori = document.querySelector("#kategori");
    kategori.addEventListener("change", function () {
        let value = this.value;
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {

            if (this.responseText.length > 1) {
                document.getElementById("sub-kategori").disabled = false;
                document.getElementById("sub-kategori").innerHTML = this.responseText;
            } else {
                document.getElementById("sub-kategori").disabled = true;
                document.getElementById("sub-kategori").innerHTML = "<option value=''></option>";
            }

        }
        xhttp.open("POST", "getKategori");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id=" + value);
    });
</script>
<?php
		break;
		case "edit":
		$tgl 	= explode("-", $data['tgl']);
		$tgl1=$tgl[2];
		$bln=$tgl[1];
		$thn=$tgl[0];
		$tangalo = $tgl1."/".$bln."/".$thn;	
		$keywordo = $data['keyword'];
		$unggulan = $data['unggulan'];
		$desc     = $data['description']
    ?>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12 ">
            <div class="card">
                <!-- form start -->
                <form id="formyku" role="form" action="produk" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_produk" id="id_produk" value="<?php echo $data['id_produk'] ?>">
                    <!-- general form elements -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Layanan<span title="wajib"
                                            style="color: red;">*</span></label>
                                    <input name="judul" type="text" class="form-control"
                                        value="<?php echo $data['judul'] ?>" required>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">URL Official<span title="wajib"
                                            style="color: red;">*</span></label>
                                    <input name="item_number" type="text" class="form-control"
                                        value="<?php echo $data['item_number'] ?>" required>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kategori</label>
                                    <select name="id_produk_k" class="form-control" id="kategori" required>
                                        <?php foreach($kategori as $r) : ?>
                                        <option value="<?=$r['id_produk_k']?>"
                                            <?php echo ($data['id_produk_k'] == $r['id_produk_k'])? 'selected' : '' ?>>
                                            <?=$r['judul']?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Penulis</label>
                                    <input name="material" type="text" class="form-control"
                                        value="<?php echo $data['material'] ?>" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jumlah Halaman</label>
                                    <input name="moq" type="text" class="form-control"
                                        value="<?php echo $data['moq'] ?>" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ukuran</label>
                                    <input name="ukuran" type="text" class="form-control" value="<?php echo $data['ukuran'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Terbit</label>
                                    <input name="terbit" type="text" class="form-control" value="<?php echo $data['terbit'] ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Kutipan</label>
                                    <textarea  class="form-control"
                                        name="kutipan" maxlength="300"><?php echo $data['kutipan'] ?>"</textarea>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>tag</label>
                                    <div class="row">
                                        <div class="col-md-10">

                                            <select style="width:100%" name="tagNyan"
                                                class="select3 m-b-10 select2-multiple " multiple="multiple"
                                                data-placeholder="Pilih Tag">
                                                <?php if(empty($artikel_tag)){ ?>
                                                <?php foreach ($tag->fetchAll() as $row): ?>
                                                <option value="<?php echo $row['id_produk_tag'] ?>">
                                                    <?php echo $row['name'] ?>
                                                </option>
                                                <?php endforeach ?>
                                                <?php }else{ ?>
                                                <?php foreach ($tag->fetchAll() as $row): ?>

                                                <option value="<?php echo $row['id_tag'] ?>" <?php 
                                                    foreach($artikel_tag as $tag){
                                                        if($tag['id_tag'] == $row['id_produk_tag'])
                                                        {
                                                            echo "selected";
                                                        }else{
                                                            echo "";
                                                        }
                                                    } 
                                                ?>>
                                                    <?php echo $row['name'] ?></option>
                                                <?php endforeach ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <a class="btn btn-info" href="tag-add"><i class="fa fa-plus"></i> Tag </a>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id_tag" id="id_tag" class="myTag" value="0">
                                </div>
                            </div> -->



                            <!-- <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Detail Produk</label>
                                    <textarea id="ckeditor"
                                        name="deskripsi_singkat"><?php echo $data['deskripsi_singkat'] ?></textarea>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sub Kategori</label>
                                    <select name="id_produk_sk" class="form-control" id="sub-kategori" required>
                                        <?php foreach($sub as $r) : ?>
                                        <option value="<?=$r['id_produk_sk']?>"
                                            <?php echo ($data['id_produk_sk'] == $r['id_produk_sk'])? 'selected' : '' ?>>
                                            <?=$r['judul']?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Shopee</label>
                                    <input name="shopee" type="text" class="form-control" value="<?php echo $data['shopee'] ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Tokopedia</label>
                                    <input name="tokopedia" type="text" class="form-control" value="<?php echo $data['tokopedia'] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Stok</label>
                                    <select name="stok" class="form-control">
                                        <option value="tersedia"
                                            <?php echo ($data['stok'] == 'tersedia')? 'selected' : '' ?>>Tersedia
                                        </option>
                                        <option value="Habis" <?php echo ($data['stok'] == 'Habis')? 'selected' : '' ?>>
                                            Habis</option>
                                        <option value="Terbatas"
                                            <?php echo ($data['stok'] == 'Terbatas')? 'selected' : '' ?>>Terbatas
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Unggulan</label>
                                    <select name="unggulan" class="form-control">
                                        <option value="ya" <?php echo ($data['unggulan'] == 'ya')? 'selected' : '' ?>>Ya
                                        </option>
                                        <option value="tidak"
                                            <?php echo ($data['unggulan'] == 'tidak')? 'selected' : '' ?>>Tidak</option>
                                    </select>
                                </div>
                            </div> 

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga</label>
                                    <input name="harga" type="text" class="form-control ninjin"
                                        value="<?php echo $data['harga'] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga Diskon</label>
                                    <input name="harga_diskon" type="text" class="form-control ninjin"
                                        value="<?php echo $data['harga_diskon'] ?>">
                                </div>
                            </div> -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga</label>
                                    <input name="harga" type="text" class="form-control"
                                        value="<?php echo $data['harga'] ?>">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Gambar</label>
                                    <br />
                                    <input type="file" name="lopoFile" id="lopoFile" class="form-control ">
                                    <p style="margin-top: 5px;margin-bottom:0;" class="help-block">*) Ukuran Gambar
                                        Minimal Lebar 1000px dan Tinggi 1000px</p>
                                    <p class="help-block">*) Maksimal Size Gambar 2MB</p>
                                    <img style="height: 150px;" src="../images/produk/<?php echo $data['gambar'] ?>"
                                        alt="">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Deskripsi</label>
                                    <textarea id="ckeditor" name="deskripsi"><?php echo $data['deskripsi'] ?></textarea>
                                </div>
                            </div>


                            <!-- <div class="col-md-12" style="margin-bottom:10px">
                                <div class="box-body table-responsive"
                                    style="border: 1px solid #bfbfbf;min-height: 300px;padding:10px">
                                    <label for="exampleInputFile" id="gallery_produk">Gambar Lainnya</label><br>
                                    <p style="margin-top: 5px;margin-bottom:0;" class="help-block">*) Ukuran Gambar
                                        Minimal Lebar 1000px dan Tinggi 1000px</p>
                                    <p class="help-block">*) Maksimal Size Gambar 2MB</p>
                                    <a href="produk-addgallery-<?=$data['id_produk']?>" class="btn btn-info">Tambah
                                        Gambar</a>
                                    <div class="form-group">
                                        <div class="row">
                                            <?php
                                                foreach($gallery as $tsubpro):
                                            ?>
                                            <div class="col-md-2 col-xs-12"
                                                style="height: 200px;overflow: hidden;margin: 10px 0px;">
                                                <div class="photo" style="margin-bottom:10px">
                                                    <a href="#"
                                                        style="width: 100%; height: 150px;overflow: hidden;float: left;overflow: hidden;">
                                                        <img src="../images/gallery_produk/<?php echo "$imgname1-$tsubpro[gambar]"; ?>"
                                                            style="width: 100%; min-height: 150px;overflow: hidden;">
                                                    </a>
                                                </div>
                                                <br />
                                                <a style="margin-top:10px" class="btn btn-warning"
                                                    href="<?php echo $module; ?>-editgallery-<?php echo $tsubpro['id_gallery']; ?>">Edit</a>
                                                |
                                                <a style="margin-top:10px" class="btn btn-danger"
                                                    onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');"
                                                    href='produk-gallery-delete-<?php echo $tsubpro['id_gallery']; ?>-<?php echo $data['id_produk']; ?>'>Hapus</a>
                                            </div>
                                            <?php
                                                endforeach;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div> -->



                            <div class="col-md-12">
                                <div class="alert alert-primary" role="alert">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-information alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                                        <span><strong>SEO (Search Engine Optimation)</strong></span>
                                    </div><!-- d-flex -->
                                </div><!-- alert -->

                                <!-- Tab panes -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="desc-tab" data-toggle="tab" href="#desc"
                                            role="tab" aria-controls="desc" aria-selected="true">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="keyword-tab" data-toggle="tab" href="#keyword"
                                            role="tab" aria-controls="profile" aria-selected="false">Keyword</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="desc" role="tabpanel"
                                        aria-labelledby="desc-tab">
                                        <textarea rows="4" name="description" class="form-control"
                                            placeholder="SEO Description"><?php echo $data['description'] ?></textarea>
                                    </div>
                                    <div class="tab-pane fade" id="keyword" role="tabpanel"
                                        aria-labelledby="keyword-tab">
                                        <textarea rows="4" name="keyword" class="form-control"
                                            placeholder="SEO Keyword"><?php echo $data['keyword'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                    </div><!-- /.card-body -->
                    <div class="card-footer pb-5">
                        <button id="btn-testimoni" class="mb-2 btn btn-success float-left">Simpan</button>
                        <input type="button" class="mb-2 btn btn-secondary float-right" value="Kembali"
                            onclick="location.href='<?php echo $module; ?>' ">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    document.querySelector('#btn-testimoni').addEventListener('click', function(e) {
        let formy = document.querySelector("#formyku");
        formy.submit();
    })

    let kategori = document.querySelector("#kategori");
    let produk = document.querySelector("#id_produk").value;

    kategori.addEventListener("change", getData);
    //document.addEventListener("DOMContentLoaded", getData);

    function getData() {
        let value = kategori.value;
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {

            if (this.responseText.length > 1) {
                document.getElementById("sub-kategori").disabled = false;
                document.getElementById("sub-kategori").innerHTML = this.responseText;
            } else {
                document.getElementById("sub-kategori").disabled = true;
                document.getElementById("sub-kategori").innerHTML = "<option value=''></option>";
            }

        }
        xhttp.open("POST", "getKategori");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id=" + value);
    }
</script>
<?php
    break;
	case "addgallery":
?>
<form action="produk-gallery" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-body">
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="judul" value="galeri">
                </div>

                <div class="form-group ">
                    <input type="hidden" name="ids" value="<?php echo $id ?>">
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
	
?>
<form action="produk-gallery" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-body">
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="judul" value="<?php echo $data['judul'] ?>">
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $data['id_gallery'] ?>">
                    <input type="hidden" name="idm" value="<?php echo $data['id_produk']; ?>">
                    <label for="">Gambar</label>
                    <input type="file" name="nyanpload" class="form-control">
                    <br><br>
                    <img style="height:300px" src="../images/gallery_produk/<?php echo $imgname1."-".$data['gambar']?>">
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-info" value="Simpan Data">
    </div>
</form>
<?php
    break;
	case "listWarna":
?>
        <a class="btn btn-secondary" href="produk-edit-<?=$produk['id_produk']?>"><i class="fa fa-arrow-left"></i> Back</a>
        <hr>
        <h4 ><?=$produk['judul']?> </h4>
        <h5 class="mb-4">(L x W x H) : <?=$data['l']?>cm x <?=$data['w']?>cm x <?=$data['h']?>cm</h5>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModal" > <i class="fa fa-plus"></i> Tambah Data</button>
			<section class="content" style="margin-top:10px">
				<div class="row">
				<div class="col-md-12">
				  <div>
					<div class="table-responsive">
						<table id="my_table" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th width="5%" class="center">No</th>
                            <th width="5%" class="center">(L x W x H) cm </th>
							<th width="23%" class="center">Color</th>
                            <th width="23%" class="center">Price</th>                       
							<th width="20%"  class="center">Aksi</th>
						  </tr>
						</thead>
						<tbody>
						<?php
						$no = 1;
						foreach($tampil as $r){
						?>
							<tr>
								<td width="5%" align="center"><?php echo  $no; ?></td>
                                <td><?=$data['l']?> x <?=$data['w']?> x <?=$data['h']?></td>  
								<td><?php echo  $r['warna']; ?></td>   
                                <td>$ <?php echo  $r['harga']; ?></td>             
								<td align="center" style="width:20%">
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#<?php echo $r['id_produk_warna'] ?>" > <i class="fas fa-pencil-alt"></i> Edit</button>
									<a onClick="javascript: return confirm('Yakin untuk Menghapus data ?');" href="produk-warna-delete-<?=$r['id_produk_warna']?>-<?=$r['id_produk_size']?>"  class="btn btn-danger btnadmin" role="button" aria-pressed="true" style="min-width: 60px;"> <i class="fa fa-trash"></i> Delete</a>
								</td>
							</tr>
						<!-- modal edit content -->
						<div id="<?php echo $r['id_produk_warna'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">Edit Data </h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<form action="produk_warna" method="POST" enctype="multipart/form-data">
										<input type="hidden" name="id_produk_warna" value="<?php echo $r['id_produk_warna']; ?>">
                                        <input type="hidden" name="id_produk_size" value="<?php echo $r['id_produk_size']; ?>">
											<div class="form-group">
												<label for="recipient-name" class="control-label">Color</label>
												<input type="text" class="form-control" id="name" name="warna" value="<?php echo $r['warna'] ?>">
											</div>
                                            <div class="form-group">
												<label for="recipient-name" class="control-label">Price</label>
												<input type="text" class="form-control" id="name" name="harga" value="<?php echo $r['harga'] ?>">
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

		<!-- modal add artikel_kategori content -->
		<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form action="produk_warna" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_produk_size" value="<?php echo $data['id_produk_size']; ?>">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Color</label>
                                <input type="text" class="form-control" id="name" name="warna">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Price</label>
                                <input type="text" class="form-control" id="name" name="harga">
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
	case "addgalleryvarian":
?>
<input class="btn btn-danger mb-2" action="action" onclick="window.history.go(-1); return false;" type="submit"
    value="Kembali" />
<form action="produk-galleryvarian" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Gambar</label>
                    <input type="text" class="form-control" name="judul" value="gambar">
                </div>

                <div class="form-group ">
                    <input type="hidden" name="id_produk_varian" value="<?php echo $id ?>">
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
	case "editgalleryvarian":
	
?>
<input class="btn btn-danger mb-2" action="action" onclick="window.history.go(-1); return false;" type="submit"
    value="Kembali" />
<form action="produk-galleryvarian" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 card">
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Gambar</label>
                    <input type="text" class="form-control" name="judul" value="<?php echo $data['judul'] ?>">
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $data['id_galleryvarian'] ?>">
                    <input type="hidden" name="id_produk_varian" value="<?php echo $data['id_produk_varian']; ?>">
                    <label for="">Gambar</label>
                    <input type="file" name="nyanpload" class="form-control">
                    <br><br>
                    <img style="height:300px"
                        src="../images/gallery_produk_varian/<?php echo $imgname1."-".$data['gambar']?>">
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