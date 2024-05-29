
<?php
	$zz = $pdo->query("SELECT deskripsi FROM modul WHERE id_modul='18'");
	$zzyy = $zz->fetch(PDO::FETCH_ASSOC);
	if($zzyy["deskripsi"]=="21232f297a57a5a743894a0e4a801fc3-18"){
?>
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- FastClick
    <script src="plugins/fastclick/fastclick.min.js"></script> -->
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<?php
	}
?>