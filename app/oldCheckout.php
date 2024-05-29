<?php $this->layout('template', ['title' => 'User Profile']) ?>
<div class="bg-secondary py-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
                    <li class="breadcrumb-item"><a class="text-nowrap" href="<?=$base_url?>"><i
                                class="ci-home"></i>Home</a>
                    </li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 mb-0">Checkout</h1>
        </div>
    </div>
</div>
<main>
    <section class="about-us-area mt-4">
        <!-- Cart view section -->
        <section id="checkout">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 ">
                        <h3>Informasi Pelanggan</h3>
                        <hr>
                        <div class="panel panel-default">
                            <div class="row panel-body">
                                <form id='mipan'>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <input class="form-control" type="text" id='nama' placeholder="Nama Anda">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <input class="form-control" type="text" id='telp'
                                                placeholder="No. Hp Atau WA Anda Ex : 08xxxxxx">
                                        </div>
                                    </div> -->
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <select class="form-control" name="" id="provinsi">
                                                <?php foreach($provinsi as $row)  : ?>
                                                <option value="<?=$row['id']?>"><?= $row['name']?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <select class="form-control" name="" id="kota" >
                                                <option value="">-- Pilih Kabupaten --</option>
                                                <?php foreach($kota as $row)  : ?>
                                                <option value="<?=$row['id']?>"><?= $row['name']?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <select class="form-control" name="" id="kecamatan" disabled>
                                                <option value="">-- Pilih Kecamatan --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <textarea class="form-control" id='alamat' placeholder="Alamat Lengkap"
                                                style="height: 100px;"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <p class="btn btn-success " id='kirim-wa'><i class="fas fa-paper-plane"></i>
                                            Pesan Sekarang</p>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-7">
                        <h3>Informasi Produk</h3>
                        <hr>
                        <table class="table table-bordered table-hovered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Sub</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                          if($totalKeranjang > 0) : 
                          $no = 1;
                          $sub = 0;
                          $biaya = 0;
                          $berat = 0;
                          $totalprod = 0;
                          $totalBerat = 0;               
                          foreach ($keranjang as $items) :
                            foreach($items as $item) :
                              $price = str_replace( '.', '', $item['attributes']['price'] );
                              $sub = $item['quantity'] * $price;
                            //   echo $totalBerat;
                              $biaya += $sub;
                              $totalprod += $item['quantity'];
                              echo '<tr> ';
                              echo '<td> '.$no.'</td>';
                              echo '<td> '.$item['attributes']['nama'].'<input class="form-control" name="nama-'.$no.'" type="hidden" value="'.$item['attributes']['nama'].'"></td>';
                              echo '<td> '.$item['attributes']['price'].'<input class="form-control" name="price-'.$no.'" type="hidden" value="'.$item['attributes']['price'].'"></td>';
                              echo '<td style="width:8%"> <input class="form-control" name="idku-'.$no.'" type="hidden" value="'.$item['id'].'"> <input class="form-control" name="jml-'.$no.'" type="hidden" value="'.$item['quantity'].'">'.$item['quantity'].'</td>';
                              echo '<td style="width:20%"> Rp. '.rp($sub).'</td>';
                              echo '</tr>';
                              $no++;
                            endforeach;
                        endforeach;
                            echo "<tr>";
                            echo '<td colspan="3">Total </td>';
                            echo "<td>$totalprod</td>";
                            echo "<td>Rp. ".rp($biaya)."</td>";
                            echo '</tr>';

                        else :
                          echo '<tr> ';
                          echo '<td style="text-align:center" colspan="6">Belanjaanmu Kosong.</td>';
                          echo '</tr>';
                        endif;
                          ?>
                            </tbody>
                        </table>

                        <h3>Total Biaya : <span id="total">Rp. <?=$biaya?></span></h3>
                    </div>
                </div>
            </div>
        </section>
        <!-- / Cart view section -->
    </section>

</main>



<script>

    function formatString(str) {
        return str
            .replace(/(\B)[^ ]*/g, match => (match.toLowerCase()))
            .replace(/^[^ ]/g, match => (match.toUpperCase()));
    }


    function ribuan(uang) {
        var reverse = uang.toString().split('').reverse().join(''),
            uang = reverse.match(/\d{1,3}/g);
        uang = uang.join('.').split('').reverse().join('');
        return uang;
    }

    let btn2 = document.querySelector('#kirim-wa');

    btn2.addEventListener('click', function () {

        var nama = document.querySelector('#nama').value;
        var text = "";
        var text2 = "";
        var spasi = "\r\n";
        var pembuka = "Halo Toko Sholeh saya mau pesan " + " : " + spasi + spasi;
        var garis = "-------------------------------------------------";
        var barang = "";

        var provinsi = document.getElementById('provinsi').options[document.getElementById('provinsi')
            .selectedIndex].text;

        var kota = document.getElementById('kota').options[document.getElementById('kota')
            .selectedIndex].text;

        var kecamatan = document.getElementById('kecamatan').options[document.getElementById('kecamatan')
            .selectedIndex].text;

        <?php
        $sub = 0;
        $biaya = 0;
        $totalprod = 0;
        $no = 1;
        foreach($keranjang as $items):
            foreach($items as $item):
            $price = str_replace('.', '', $item['attributes']['price']);
        $sub = $item['quantity'] * $price;
        $biaya += $sub;
        $totalprod += $item['quantity']; ?>
        barang += "<?=$no?>. *<?= $item['attributes']['nama'] ?>* " + spasi;
        barang += "  Quantity : <?=$item['quantity']?>" + spasi;
        barang += "  Harga (@) : Rp <?=$item['attributes']['price']?>" + spasi;
        barang += "  Total Harga : Rp " + ribuan( <?= $sub ?> ) + spasi + spasi; 
        <?php
        $no++;
        endforeach;
        endforeach; 
        ?>

        var by = parseInt( <?= $biaya ?> );
        var biaya = spasi + "Sub Total Harga : *Rp. <?=rp($biaya)?>*" + spasi;
        var total_biaya = "Total : *Rp. " + ribuan(by) + "*" + spasi;
        text = pembuka + barang  + total_biaya + garis + spasi + spasi;
        text = window.encodeURIComponent(text);

        var spasi = "\r\n";
        var nama = document.querySelector('#nama').value;
        var alamat = document.querySelector('#alamat').value;




        if (kecamatan.length < 1 || nama.length < 1 ) {
            alert("Isikan Data Anda terlebih dahulu");
            return false;
        }

        var metode = "Halo " + nama + " : " + spasi;
        var prib = "";

        prib += "*Alamat Pengiriman*" + spasi;
        prib += "Nama        : " + nama + spasi ;
        prib += "Alamat      : " + alamat + ", " + spasi;
        prib += "Provinsi    : DI Yogyakarta "  + spasi;
        prib += "Kota        : " + formatString(kota) + spasi;
        prib += "Kecamatan   : " + formatString(kecamatan)  + spasi + spasi;
        prib += "Via " + "<?=$base_url?>" + spasi + garis;
        //prib += "Kurir    : " + kurir.toUpperCase() + " - " + lvl + spasi + spasi + garis;

        text2 = window.encodeURIComponent(prib);

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                window.open("https://api.whatsapp.com/send?phone=<?=$deskrip[7]?>&text=" + text + text2,
                    '_blank');
                window.location.href = "hapus-keranjang";
            }
        };
        xhttp.open("POST", "send", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("nama=" + nama);
        // xhttp.send("nama=" + nama + "&telp=" + telp + "&alamat=" + alamat +
        //     "&kota=" + kota + "&kurir=" + kurir + "&lvl=" + lvl +
        //     "&biaya=" + biaya + "&ongkir=" + ongkir + "&total_biaya=" + total_biaya +
        //     "&barang=" + barang);
    });
</script>

<script>
    let prop = document.querySelector('#provinsi');
    let prop2 = document.querySelector('#kota');
    let loader = '<option>Sedang Memuat....</option>';


    prop2.addEventListener('change', function () {
        document.getElementById('kecamatan').innerHTML = loader;
        let id = document.querySelector('#kota').value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("kecamatan").innerHTML = this.responseText;
                document.getElementById("kecamatan").removeAttribute("disabled");
            }
        };
        xhttp.open("POST", "kecamatan", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id=" + id);
    })
    function ribuan(uang) {
        var reverse = uang.toString().split('').reverse().join(''),
            uang = reverse.match(/\d{1,3}/g);
        uang = uang.join('.').split('').reverse().join('');
        return uang;
    }

</script>