<?php
 if(!isset($hal)){
     $hal = '';
 }
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="../images/fav.png"> -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <title><?php echo $namaweb; ?></title>

    <!-- Custom CSS -->
    <link href="../assets/admin/theme/assets/libs/select2/select2.min.css?ver=1.22ss" rel="stylesheet">
    <link href="../assets/admin/theme/dist/css/style.min.css?ver=1.22s" rel="stylesheet">

    <!-- This page plugin CSS -->
    <link href="../assets/admin/theme/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/admin/theme/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" />
    <script src="../assets/admin/theme/assets/libs/jquery/dist/jquery.min.js?ver1"></script>
    <script src="../assets/admin/theme/Chart.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" />
    <!-- <script src="../assets/js/serialize.js?v<?=date('i:s')?>"></script> -->
    <!--<script src="../assets/js/jmw.js?v<?=date('i:s')?>"></script>-->
    <link href="../assets/admin/theme/jquery.datetimepicker.css?vs" rel="stylesheet">

    <style>
    .toast {
        opacity: 1 !important;
    }
    .select2-results__option[aria-selected=true] {
    display: none;
    }
    .select2-container--default .select2-selection--multiple {
    height: auto;
    }   
    </style>
</head>


<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <?=$this->insert('topbar')?>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <?=$this->insert('sidebar')?>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title"><?=$hal?></h4>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="home">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page"><?=$hal?> </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid code-vein">
                <?=$this->section('content')?>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <!-- <footer class="footer text-center">
                All Rights Reserved by AdminBite. Designed and Developed by
                <a href="https://jogjamediaweb.com">Jogja Media Web</a>.
            </footer> -->
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <?//=$this->insert('custom')?>
    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

    <!-- Bootstrap tether Core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.3.2/jquery-migrate.min.js"
        integrity="sha512-3fMsI1vtU2e/tVxZORSEeuMhXnT9By80xlmXlsOku7hNwZSHJjwcOBpmy+uu+fyWwGCLkMvdVbHkeoXdAzBv+w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assets/admin/theme/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/admin/theme/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="../assets/admin/theme/dist/js/app.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../assets/admin/theme/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/admin/theme/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../assets/admin/theme/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../assets/admin/theme/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../assets/admin/theme/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->



    <!--This page plugins -->
    <script src="../assets/admin/theme/assets/extra-libs/DataTables/datatables.min.js"></script>
    <!-- This Page JS -->
    <script src="../assets/admin/theme/assets/libs/select2/select2.min.js"></script>
    <script src="../assets/admin/theme/assets/libs/moment/moment.js"></script>
    <script src="../assets/admin/theme/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-mask-number@1.0.1/jquery.masknumber.js"></script>
    <script src="../assets/admin/theme/jquery.datetimepicker.full.min.js?vb"></script>

    <!--
    <script>
        
        function loadContent(module,act){
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  document.querySelector(".code-vein").innerHTML = this.responseText;
                    $('#my_table').DataTable().clear();
                    $('#my_table').DataTable().destroy();
                    $('#my_table').DataTable({
                        responsive: true,
                    });
                }
              };
              
              
              xhttp.open("GET", "zelda.php?module="+ module +"&act="+ act, true);
              xhttp.send();
        }
        
        function btnSide(id,module,act){
            let btnFasilitas = document.getElementById(id);
            btnFasilitas.addEventListener('click', function(e){
                e.preventDefault();
                let act = this.getAttribute("data");
                loadContent(module,act);
            });
        }
         btnSide('fasilitas','fasilitas','list');
        
    
    </script>
    -->

    <script>
    $(function() {
        'use strict';

        $('.preloader').fadeOut();

        // Summernote editor
        //

        $('.ninjin').maskNumber({
            integer: true,
            thousands: ','
        });



        $('.fc-datepicker').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: 'dd/mm/yy'
        });

        $('.date_time').datetimepicker({
            format: 'Y-m-d H:i:s',
            formatTime: 'H:i:s',
            formatDate: 'Y-m-d',
        });




        $('#main-wrapper').AdminSettings({
            Theme: false, // this can be true or false ( true means dark and false means light ),
            Layout: 'vertical',
            LogoBg: '<?= $tehe[1]['code'] ?>', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
            NavbarBg: '<?= $tehe[0]['code'] ?>', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
            SidebarType: 'full', // You can change it full / mini-sidebar / iconbar / overlay
            SidebarColor: '<?= $tehe[2]['code'] ?>', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
            SidebarPosition: true, // it can be true / false ( true means Fixed and false means absolute )
            HeaderPosition: true, // it can be true / false ( true means Fixed and false means absolute )
            BoxedLayout: false // it can be true / false ( true means Boxed and false means Fluid )
        });

        //****************************
        /* Left header Theme Change function Start */
        //****************************
        function handlelogobg() {
            $('.theme-color .theme-item .theme-link').on("click", function() {
                var logobgskin = $(this).attr("data-logobg");
                $('.topbar .top-navbar .navbar-header').attr("data-logobg", logobgskin);
                $.post('teemo', {
                    data: logobgskin,
                    type: 'logobg'
                }, function(response) {

                });
            });
        };
        handlelogobg();
        //****************************
        /* Top navbar Theme Change function Start */
        //****************************
        function handlenavbarbg() {
            if ($('#main-wrapper').attr('data-navbarbg') == 'skin6') {
                // do this
                $(".topbar .navbar").addClass('navbar-light');
                $(".topbar .navbar").removeClass('navbar-dark');
            } else {
                // do that

            }
            $('.theme-color .theme-item .theme-link').on("click", function() {
                var navbarbgskin = $(this).attr("data-navbarbg");
                $('#main-wrapper').attr("data-navbarbg", navbarbgskin);
                $('.topbar .navbar-collapse').attr("data-navbarbg", navbarbgskin);
                $.post('teemo', {
                    data: navbarbgskin,
                    type: 'navbarbg'
                }, function(response) {

                });
                if ($('#main-wrapper').attr('data-navbarbg') == 'skin6') {
                    // do this
                    $(".topbar .navbar").addClass('navbar-light');
                    $(".topbar .navbar").removeClass('navbar-dark');
                } else {
                    // do that
                    $(".topbar .navbar").removeClass('navbar-light');
                    $(".topbar .navbar").addClass('navbar-dark');
                }
            });

        };

        handlenavbarbg();

        //****************************
        // ManageSidebar Type
        //****************************
        function handlesidebartype() {

        };
        handlesidebartype();


        //****************************
        /* Manage sidebar bg color */
        //****************************
        function handlesidebarbg() {
            $('.theme-color .theme-item .theme-link').on("click", function() {
                var sidebarbgskin = $(this).attr("data-sidebarbg");
                $.post('teemo', {
                    data: sidebarbgskin,
                    type: 'sidebarbg'
                }, function(response) {});
                $('.left-sidebar').attr("data-sidebarbg", sidebarbgskin);
            });
        };
        handlesidebarbg();

    });
    </script>

    <!-- plugin wysiwyg -->

    <script src="../assets/ckeditor/ckeditor.js?ver=<?php echo date('H:i:s') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"></script>



    <script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    // Check if there are any INFO messages
    <?php if ( $msg->hasMessages($msg::SUCCESS) ) : ?>
    toastr.success('<?=$msg->display()?>', 'Success');
    <?php endif ?>
    <?php if ( $msg->hasMessages($msg::INFO) ) : ?>
    toastr.info('<?=$msg->display()?>', 'Information');
    <?php endif ?>

    <?php if ( $msg->hasMessages($msg::WARNING) ) : ?>
    toastr.warning('<?=$msg->display()?>', 'Attention');
    <?php endif ?>

    <?php if ( $msg->hasMessages($msg::ERROR) ) : ?>
    toastr.error('<?=$msg->display()?>', 'Warning');
    <?php endif ?>


    $(document).ready(function() {

        CKEDITOR.replace('ckeditor', {
            filebrowserBrowseUrl: '../images/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            filebrowserUploadUrl: '../images/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            filebrowserImageBrowseUrl: '../images/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        });
        
        var toolbarGroups = [{
                name: 'basicstyles',
                groups: ['basicstyles', 'cleanup']
            },
            {
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align', 'bidi']
            },
            {
                name: 'links'
            },
            {
                name: 'insert'
            },
            {
                name: 'styles'
            },
            {
                name: 'colors'
            },
            {
                name: 'tools'
            },
            {
                name: 'others'
            }
        ];

        CKEDITOR.replace('cksimple', {
            removeButtons: 'Image,Flash,Iframe,Youtube,clipboard,editing',
        });

        
        
        



    });

    function loadBootstrap(event) {
        if (event.name == 'mode' && event.editor.mode == 'source')
            return; // Skip loading jQuery and Bootstrap when switching to source mode.

        var jQueryScriptTag = document.createElement('script');
        var bootstrapScriptTag = document.createElement('script');

        jQueryScriptTag.src = 'https://code.jquery.com/jquery-1.11.3.min.js';
        bootstrapScriptTag.src = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js';

        var editorHead = event.editor.document.$.head;

        editorHead.appendChild(jQueryScriptTag);
        jQueryScriptTag.onload = function() {
            editorHead.appendChild(bootstrapScriptTag);
        };
    }
    </script>


    <!-- datatables -->
    <?php if( isset($_GET['act']) && $_GET['act'] == 'list') : ?>

    <script>
    $(function() {
        'use strict';

        $('#datatable1').DataTable({
            responsive: true,
        });

    });

    $('#datatable2').DataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false
    });
    </script>
    <?php endif; ?>

    <script>
    $('#my_table').DataTable({
        responsive: true,
    });
    $('#my_table2').DataTable({
        responsive: true,
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "searching": false,
    });
    $(".select2").select2();

    $('.select2').on('change', function() {
        data = $(this).val();
        $('#id_tag').val(data);
          
    });

    $(".select3").select2();
    $('.select3').on('change', function() {

        data = $(this).val();
        $('#id_tag').val(data);
                      
    });
    </script>
    <link href="../assets/admin/dist/css/asColorPicker.css?vs" rel="stylesheet">
    <style>
    .asColorPicker-dropdown {
        min-width: 225px;
        max-width: 270px;
        padding: 10px;
        background: #fefefe;
        border: 1px solid #bbb;
    }

    .asColorPicker-wrap {
        position: relative;
        display: block;
    }
    </style>
    <script src="../assets/admin/dist/jquery-asColor.min.js?vs"></script>
    <script src="../assets/admin/dist/jquery-asGradient.min.js?vs"></script>
    <script src="../assets/admin/dist/jquery-asColorPicker.js?vs"></script>
    <script>
    $(document).ready(function() {
        $(".colorPicker").asColorPicker({
            mode: 'gradient',
            gradient: {
                switchable: false
            }
        });
    });
    </script>
</body>

</html>