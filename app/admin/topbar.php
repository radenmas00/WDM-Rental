<nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="sl-icon-menu"></i>
                    </a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="page-edit-1">
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon">
       
                            <img style="height:50px;" src="../images/<?php echo $deskrip[1]."?".date("H:i:s") ?>" alt="homepage" class="dark-logo" />
                           
                            <img style="height:50px;" src="../images/<?php echo $deskrip[1]."?".date("H:i:s") ?>"" alt="homepage" class="light-logo" />
                        </b> -->
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <?= $namaweb ?>
                            <!-- dark Logo text 
                            <img src="theme/assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                            Light Logo text 
                            <img src="theme/assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                            -->
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="sl-icon-list"></i>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                                <i class="sl-icon-menu font-20"></i>
                            </a>
                        </li>

                        <!-- ============================================================== -->
                        <!-- Surat -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End Surat-->
                        <!-- ============================================================== -->


                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <!-- Negara
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="flag-icon flag-icon-us font-18"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right  animated bounceInDown" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item" href="#">
                                    <i class="flag-icon flag-icon-us"></i> English</a>
                                <a class="dropdown-item" href="#">
                                    <i class="flag-icon flag-icon-fr"></i> French</a>
                                <a class="dropdown-item" href="#">
                                    <i class="flag-icon flag-icon-es"></i> Spanish</a>
                                <a class="dropdown-item" href="#">
                                    <i class="flag-icon flag-icon-de"></i> German</a>
                            </div>
                        </li>
                        -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <img src="../images/avatar1.png?<?php echo date("H:i:s") ?>" alt="user" class="rounded-circle" width="31">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow">
                                    <span class="bg-primary"></span>
                                </span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class="">
                                        <img src="../images/avatar1.png?<?php echo date("H:i:s") ?>" alt="user" class="img-circle" width="60">
                                    </div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0"><?php echo $_SESSION['namalengkapadmin']; ?></h4>
                                        <p class=" m-b-0"><?php echo $_SESSION['email_admin']; ?></p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="admin">
                                    <i class="sl-icon-user m-r-5 m-l-5"></i> My Profile</a>
                                <!--
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="sl-icon-present m-r-5 m-l-5"></i> Inbox</a>
                                -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout">
                                    <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>