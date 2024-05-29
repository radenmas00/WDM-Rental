<?php $this->layout('template', ['title' => 'User Profile']) ?>
<section
    class="hongo-main-title-wrap bg-very-light-gray bg-opacity-color hongo-page-title-wrap page-title-style-6 parallax top-space-padding skrollable skrollable-between"
    data-start="background-position:0px 0px;" data-end="background-position:0px 0px;"
    data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -75px;"
    style="background-image: url('images/<?=$deskrip[19]?>'); background-repeat: no-repeat; background-position: 0px 0px; padding-top: 128px;background:black"
    data-padding-top="28px">
    <div class="hongo-overlay bg-opacity-color"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 display-table small-screen">
                <div class="display-table-cell vertical-align-middle text-center">
                    <!-- <h1 class="alt-font hongo-main-title text-dark-gray text-uppercase hongo-page-title">Login
                        </h1> -->
                </div>
            </div>
        </div>
    </div>
</section>
<main id="main">

    <section class="inner-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="form-container field">
                        <div class="row">
                            <form method="post" action="quotation">
                            <?=$csrf->input('my-form');?>
                                <div class="col-xs-12">
                                    <div class="row transaction-card-holder">
                                        <div class="transaction-card col-md-12">
                                            <div class="row" id="transaction-card-body-0">
                                                <div class="col-xs-12">
                                                    <div aria-label="Close" class="modal-header">
                                                        <h4 class="modal-title"><b>Your Request</b></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row field">
                                                            <p class="col-sm-3 field-name">First Name <span
                                                                    style="color: red;" title="required">*</span>
                                                            </p>
                                                            <div class="col-sm-9"><input name="first_name" type="text"
                                                                    class="form-control" value="<?=$_SESSION['member']['first_name']?>" style="margin-bottom: 20px;"
                                                                    required></div>
                                                        </div>
                                                        <div class="row field">
                                                            <p class="col-sm-3 field-name">Last Name <span
                                                                    style="color: red;" title="required">*</span>
                                                            </p>
                                                            <div class="col-sm-9"><input name="last_name" type="text"
                                                                    class="form-control" value="<?=$_SESSION['member']['last_name']?>" style="margin-bottom: 20px;"
                                                                    required></div>
                                                        </div>
                                                        <div class="row field">
                                                            <p class="col-sm-3 field-name">Email <span
                                                                    style="color: red;" title="required">*</span>
                                                            </p>
                                                            <div class="col-sm-9"><input name="email" type="text"
                                                                    class="form-control" value="<?=$_SESSION['member']['email']?>" style="margin-bottom: 20px;"
                                                                    required></div>
                                                        </div>
                                                        <!-- <div class="row field">
                                                            <p class="col-sm-3 field-name">Company</p>
                                                            <div class="col-sm-9"><input name="company" type="text"
                                                                    class="form-control" style="margin-bottom: 20px;">
                                                            </div>
                                                        </div>
                                                        <div class="row field">
                                                            <p class="col-sm-3 field-name">Website</p>
                                                            <div class="col-sm-9"><input name="website" type="text"
                                                                    class="form-control" style="margin-bottom: 20px;">
                                                            </div>
                                                        </div> -->
                                                        <div class="row field">
                                                            <p class="col-sm-3 field-name">Phone<span
                                                                    style="color: red;" title="required">*</span>
                                                            </p>
                                                            <div class="col-sm-9"><input name="phone" type="text"
                                                                    class="form-control" value="<?=$_SESSION['member']['phone']?>" style="margin-bottom: 20px;"
                                                                    required></div>
                                                        </div>
                                                        <div class="row field">
                                                            <p class="col-sm-3 field-name">Message</p>
                                                            <div class="col-sm-9"><textarea name="message"
                                                                    class="form-control" maxlength="300"
                                                                    style="height: 155px;"></textarea></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row transaction-card-holder">
                                            <div class="col-sm-8"></div>
                                            <div class="col-sm-4"> <button type="submit"
                                                    class="btn btn-success btn-md btn-block">Send Quotation</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->



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

        <
        ?
        php
        $sub = 0;
        $biaya = 0;
        $totalprod = 0;
        $no = 1;
        foreach($keranjang as $items):
            foreach($items as $item):
            $price = str_replace('.', '', $item['attributes']['price']);
        $sub = $item['quantity'] * $price;
        $biaya += $sub;
        $totalprod += $item['quantity']; ? >
        barang += "<?=$no?>. *<?= $item['attributes']['nama'] ?>* " + spasi;
        barang += "  Quantity : <?=$item['quantity']?>" + spasi;
        barang += "  Harga (@) : Rp <?=$item['attributes']['price']?>" + spasi;
        barang += "  Total Harga : Rp " + ribuan( < ? = $sub ? > ) + spasi + spasi; <
        ?
        php
        $no++;
        endforeach;
        endforeach; ?
        >

        var by = parseInt( < ? = $biaya ? > );
        var biaya = spasi + "Sub Total Harga : *Rp. <?=rp($biaya)?>*" + spasi;
        var total_biaya = "Total : *Rp. " + ribuan(by) + "*" + spasi;
        text = pembuka + barang + total_biaya + garis + spasi + spasi;
        text = window.encodeURIComponent(text);

        var spasi = "\r\n";
        var nama = document.querySelector('#nama').value;
        var alamat = document.querySelector('#alamat').value;




        if (kecamatan.length < 1 || nama.length < 1) {
            alert("Isikan Data Anda terlebih dahulu");
            return false;
        }

        var metode = "Halo " + nama + " : " + spasi;
        var prib = "";

        prib += "*Alamat Pengiriman*" + spasi;
        prib += "Nama        : " + nama + spasi;
        prib += "Alamat      : " + alamat + ", " + spasi;
        prib += "Provinsi    : DI Yogyakarta " + spasi;
        prib += "Kota        : " + formatString(kota) + spasi;
        prib += "Kecamatan   : " + formatString(kecamatan) + spasi + spasi;
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