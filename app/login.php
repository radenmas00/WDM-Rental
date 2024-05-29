<?php $this->layout('template') ?>
<section
    class="hongo-main-title-wrap bg-very-light-gray bg-opacity-color hongo-page-title-wrap page-title-style-6 parallax top-space-padding skrollable skrollable-between"
    data-start="background-position:0px 0px;" data-end="background-position:0px 0px;"
    data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -75px;"
    style="background-image: url('images/<?=$deskrip[19]?>'); background-repeat: no-repeat; background-position: 0px 0px; padding-top: 128px;"
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

    <section class="breadcrumbs mt-0">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Login</h2>
                <ol>
                    <li><a href="<?=$base_url?>">Home</a></li>
                    <li>Login</li>
                </ol>
            </div>

        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2>Member Login Area</h2>
                    <hr>
                    <form action="login" method="post" role="form" class="">
                    <?=$csrf->input('my-form');?>
                        <div class="form-group">
                            <label for="">Email Address</label>
                            <input type="email" name="email" class="form-control" id="name" placeholder="Your Email"
                                required>
                        </div>
                        <div class="form-group mt-3 mb-2">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Your Password" required>
                        </div>

                        <div class="text-left"><button class="btn btn-default2" type="submit"><i class="bx bxs-lock"></i> SIGN IN</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->