<?php $this->layout('template') ?>
<div class="bg-secondary">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
                    <li class="breadcrumb-item"><a class="text-nowrap" href="<?=$base_url?>"><i
                                class="ci-home"></i>Home</a>
                    </li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">FAQ</li>
                </ol>
            </nav>
        </div>
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 mb-0">FAQ</h1>
        </div>
    </div>
</div>
<main>
    <section class="about-us-area faq">
        <div class="container">
            <!-- <div class="row justify-content-center">
                <div class="col-md-6 mb-5 text-center">
                    <a href="#" target="_self" class="buto secondary is-underline is-larger expand"
                        style="border-radius:10px;">
                        <span>FAQ</span>
                    </a>
                </div>
            </div> -->
            <div class="row justify-content-center mt-4">
                <div class="col-md-12">
                    <ul class="faq-list">
                        <?php foreach($faq as $r) : ?>
                        <li>
                            <div data-bs-toggle="collapse" class="collapsed question" href="#faq<?=$r['id_faq']?>">
                                <?=$r['judul']?> <i class="ci-arrow-up icon-show"></i><i
                                    class="ci-arrow-down icon-close"></i></div>
                            <div id="faq<?=$r['id_faq']?>" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    <?=$r['deskripsi']?>
                                </p>
                            </div>
                        </li>
                        <?php endforeach ?>

                    </ul>
                </div>
            </div>
        </div>
    </section>

</main>