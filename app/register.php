<?php $this->layout('template') ?>
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

    <section class="breadcrumbs mt-0">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Register</h2>
                <ol>
                    <li><a href="<?=$base_url?>">Home</a></li>
                    <li>Register</li>
                </ol>
            </div>

        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2>Create an Account</h2>
                    <hr>
                    <form action="register" method="post" role="form" class="">
                    <?=$csrf->input('my-form');?>
                        <div class="form-group mt-3 mb-2">
                            <label for="">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group mt-3 mb-2">
                            <label for="">Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group mt-3 mb-2">
                            <label for="">Email Address</label>
                            <input type="email" name="email" class="form-control" id="name" placeholder="ex: youmail@domain.com"
                                required>
                        </div>
                        <div class="form-group mt-3 mb-2">
                            <label for="">Phone</label>
                            <input type="text" name="phone" class="form-control" id="name" required>
                        </div>
                        <div class="form-group mt-3 mb-2">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="form-group mt-3 mb-2">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control" name="password2" id="password" required>
                        </div>
                        <div class="text-left"><button class="btn btn-default2" type="submit"><i
                                    class="bx bxs-user"></i> CREATE ACCOUNT</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->