<?php $this->layout('template') ?>

<div class="row row-sm">
    <div class="col-lg-12">
        <div class="row row-sm">
            <div class="col-lg-3">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="m-r-10">
                                <span class="btn btn-circle btn-lg bg-danger">
                                    <i class="sl-icon-people text-white"></i>
                                </span>
                            </div>
                            <div class="pl-2 tx-primary">
                                Pengunjung Hari Ini
                            </div>
                            <div class="ml-auto">
                                <h2 class="m-b-0 font-light"><?php echo $pengunjung  ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card -->
            </div><!-- col-6 -->
            <div class="col-lg-3">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="m-r-10">
                                <span class="btn btn-circle btn-lg bg-warning">
                                    <i class="sl-icon-star text-white"></i>
                                </span>
                            </div>
                            <div class="pl-2 tx-primary">
                                Hits Hari Ini
                            </div>
                            <div class="ml-auto">
                                <h2 class="m-b-0 font-light"><?php echo $hits  ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card -->
            </div><!-- col-6 -->
            <div class="col-lg-3">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="m-r-10">
                                <span class="btn btn-circle btn-lg bg-info">
                                    <i class="sl-icon-energy text-white"></i>
                                </span>
                            </div>
                            <div class="pl-2 tx-primary">
                                Pengunjung Online
                            </div>
                            <div class="ml-auto">
                                <h2 class="m-b-0 font-light"><?php echo $pengunjungonline  ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card -->
            </div><!-- col-6 -->
            <div class="col-lg-3">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="m-r-10">
                                <span class="btn btn-circle btn-lg bg-primary">
                                    <i class="sl-icon-graph text-white"></i>
                                </span>
                            </div>
                            <div class="pl-2 tx-primary">
                                Total Pengunjung
                            </div>
                            <div class="ml-auto">
                                <h2 class="m-b-0 font-light"><?php echo $totalpengunjung  ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card -->
            </div><!-- col-6 -->
        </div><!-- row -->

    </div><!-- col-12 -->

</div><!-- row -->

<div class="row">



</div>



