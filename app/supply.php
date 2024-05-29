<?php $this->layout('template') ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Supply Data</h2>
                <ol>
                    <li><a href="<?=$base_url?>">Home</a></li>
                    <li>Supply Data</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-3">
                    <form action="supply-data" method="get">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                aria-label="Text input with segmented dropdown button" placeholder="Search">
                            <button type="submit" class="btn btn-success"><i class="bx bxs-search"></i></button>
                            <button type="button"
                                class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <div class="dropdown-item">
                                        <span class="fw-bold">Search In</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item">
                                        <div class="form-check">
                                            <input class="form-check-input" name="filter[]" type="checkbox"
                                                value="variable_name" id="variable_name" checked>
                                            <label class="form-check-label w-100" for="variable_name"> VARIABLE
                                                NAME</label>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item">
                                        <div class="form-check">
                                            <input class="form-check-input" name="filter[]" type="checkbox"
                                                value="group_supply" id="group_supply" checked>
                                            <label class="form-check-label w-100" for="group_supply"> GROUP</label>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item">
                                        <div class="form-check">
                                            <input class="form-check-input" name="filter[]" type="checkbox"
                                                value="definition" id="definition" checked>
                                            <label class="form-check-label w-100" for="definition">
                                                DEFINITION/MEASUREMENT</label>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item">
                                        <div class="form-check">
                                            <input class="form-check-input" name="filter[]" type="checkbox" value="price"
                                                id="price" checked>
                                            <label class="form-check-label w-100" for="price"> PRICE (PER CELL)</label>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item">
                                        <div class="form-check">
                                            <input class="form-check-input" name="filter[]" type="checkbox"
                                                value="year_coverage" id="year_coverage" checked>
                                            <label class="form-check-label w-100" for="year_coverage"> YEAR
                                                COVERAGE</label>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item">
                                        <div class="form-check">
                                            <input class="form-check-input" name="filter[]" type="checkbox"
                                                value="availability_status" id="availability_status" checked>
                                            <label class="form-check-label w-100" for="availability_status">
                                                AVAILABILITY
                                                STATUS</label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">

                    <div>
                        <div class="table-responsive">
                            <table id="table-supply" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th>No</th> -->
                                        <th width="23%" class="center">VARIABLE NAME</th>
                                        <th width="23%" class="center">GROUP</th>
                                        <th width="23%" class="center">DEFINITION/MEASUREMENT</th>
                                        <th width="23%" class="center">PRICE (PER CELL)</th>
                                        <th width="23%" class="center">YEAR COVERAGE</th>
                                        <th width="23%" class="center">AVAILABILITY STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $no = 1;
                                foreach($supply as $r){
                                ?>
                                    <tr>
                                        <!-- <td style="width:5%"><?=$no?></td> -->
                                        <td><?php echo  $r['variable_name']; ?></td>
                                        <td><?php echo  $r['group_supply']; ?></td>
                                        <td style="width:25%"><?php echo  $r['definition']; ?></td>
                                        <td><?php echo  $r['price']; ?></td>
                                        <td style="width:10%"><?php echo  $r['year_coverage']; ?></td>
                                        <td style="width:10%"><?php echo  $r['availability_status']; ?></td>
                                    </tr>
                                    <?php
                                $no++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                </div><!-- /.col -->
            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php $this->start('script') ?>
<link href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#table-supply').DataTable({
            searching: false,
            info: false,
            "lengthChange": false
        });
    });
    $(document).on('click', 'someyourContainer .dropdown-menu', function (e) {
        e.stopPropagation();
    });
</script>
<?php $this->stop() ?>