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

    <section id="sec_container" class="container pt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title">My Account</div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3" id="sidebar">
                <div class="sidebar-menu">
                    <div class="list-member-menu">
                        <a href="dashboard"> <i class="bx bxs-dashboard"></i> Dashboard</a>
                    </div>
                    <div class="list-member-menu">
                        <a href="<?=$base_url?>cart"><i class="bx bxs-cart"></i> Shopping Cart</a>
                    </div>
                    <div class="list-member-menu">
                        <a href="profile"><i class="bx bxs-user"></i> My Profile</a>
                    </div>
                    <div class="list-member-menu">
                        <a  style="color:red;font-weight:bold" href="logout"><i class="bx bx-power-off" style="color:red;font-weight:bold"></i> Logout</a>
                    </div>
                    <div class="clearfix"></div><br><br>
                </div>
            </div>
            <div class="col-md-9" id="main-content">
                <h2 class="vo-main-title mb-0"><i class="bx bxs-dashboard"></i> Dashboard</h2>
                <hr style="margin-top: 6px;"><br>
                <div class="well">
                    <p>Welcome to your account. We invite you to shop our collections or make a selection from the menu
                        on the left.</p>
                    <p>We have the combined experience, expertise and network to manage the entire local supply chain for you. From sampling to differentiated quality control, to production management to warehousing and transport.</p>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->