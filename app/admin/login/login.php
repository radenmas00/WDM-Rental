<?php $this->layout('layout') ?>
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
    style="background:url(../assets/admin/theme/assets/images/big/bg.jpg) no-repeat center center;">
    <div class="auth-box" style="background-color:#fff">
        <div id="loginform">
            <div class="logo">
                <!-- <span class="db"><img style="max-height:100px; width: 150px;"
                        src="../assets/images/<?php echo $deskrip[1]."?".date("H:i:s") ?>" alt="logo" /></span> -->
                <br><br>
                <h5 class="font-medium m-b-20" style="color:#000"><?php echo $namaweb; ?></h5>
            </div>
            <!-- Form -->
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal m-t-20" id="loginform" action="login" method="POST"
                        onSubmit="return validasi(this)">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="sl-icon-user"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control" placeholder="Username"
                                onBlur="if (jQuery(this).val() == &quot;&quot;) { jQuery(this).val(&quot;username&quot;); }"
                                onClick="jQuery(this).val(&quot;&quot;);">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="sl-icon-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                onBlur="if (jQuery(this).val() == &quot;&quot;) { jQuery(this).val(&quot;asdf1234&quot;); }"
                                onClick="jQuery(this).val(&quot;&quot;);">
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info" type="submit" value="submit">Log
                                    In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>