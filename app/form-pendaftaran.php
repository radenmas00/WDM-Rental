<?php $this->layout('template') ?>

<!-- Uni Banner Area Start --> 
<section class="uni-banner" style="background-image: url('images/process_kat/<?= $data['gambar'] ?>');">
    <div class="container">
        <div class="uni-banner-text-area">
            <h1>Form Pendaftaran</h1>
            <ul>
                <li><a href="<?= $base_url ?>">Home</a></li> 
                <li>Form Pendaftaran</li>
            </ul>
        </div>
    </div>
</section>
<!-- Uni Banner Area End -->

<section>
    <div class="container ptb-100">
        <div class="row justify-content-center">
            <div class="default-section-title text-center mb-4">
                <h3 style="font-size: 25px">Formulir Pendaftaran Pelatihan <?= $data['judul'] ?></h3>
            </div>
            <div class="col-lg-12">
                <div class="contact-form-area pt-30">
                    <form action="kirim-pelatihan" class="form-horizontal" role="form" enctype="multipart/form-data" method="post"
                        accept-charset="utf-8">
                        <?=$csrf->input('my-form');?>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nama Lengkap (Sesuai KTP)" name="nama_lengkap" required data-error="Masukkan Nama Lengkap Anda"> 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nomor Induk Kependudukan ( NIK )" name="nik" required data-error="Masukkan NIK Anda"> 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Tempat dan Tanggal Lahir (Yogyakarta, DD/MM/YYYY)" name="ttl" required data-error="Masukkan Tempat dan Tanggal Lahir Anda"> 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="form-control" name="jenis_kelamin">
                                        <option>Jenis Kelamin</option>
                                        <option value="Perempuan">Perempuan</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <select class="form-control" name="nama_pelatihan" required>
                                        <option>-- Pilih Pelatihan --</option>
                                        <?php foreach($pelatihan as $row) : ?>
                                            <option value="<?= $row['judul'] ?>"><?= $row['judul'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="form-group">
                                    <select class="form-control" name="pendidikan" required>
                                        <option>Pendidikan Terakhir</option>
                                        <option value="SMA/K">SMA/K</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Alamat Email*" id="email" required data-error="Masukkan Alamat Email"> 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="form-group">
                                    <input type="text" name="telepon" class="form-control" placeholder="Nomor Telepon / WA" id="phone_number" required data-error="Masukkan Nomor Telepon / WA Anda">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <textarea name="alamat" id="message" class="form-control" placeholder="Alamat Lengkap" cols="30" rows="5" required data-error="Masukkan Alamat Lengkap"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <span class="py-2" style="font-size: 13px; color: #ff5d22">Informasi Lainnya</span>
                             <div class="col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <input type="text" name="perusahaan" class="form-control" placeholder="Asal Perusahaan (Khusus Untuk Yang Saat Ini Bekerja)" id="phone_number">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <textarea name="sertifikat" id="message" class="form-control" placeholder="Alamat Pengiriman Sertifikat" cols="30" rows="3" required data-error="Masukkan Alamat Pengiriman Sertifikat"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <button class="default-button" type="submit"><span>Daftar Sekarang</span></button>
                                <div id="msgSubmit" class="h6 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>