<!DOCTYPE html>
<?php
session_start();
	$tipo=$_SESSION["tipo"];
	$id_usuario=$_SESSION["id_usuario"];
include "inc/conexao.php"; 
	$sql ="SELECT * FROM tb_usuario WHERE id_usuario = '$id_usuario'";
	$usu = $conex -> prepare($sql);	
	$usu -> execute();
	foreach($usu as $u){
		$estilo=$u['estilo'];
		$plano_atual=$u['plano'];
	}
 ?>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Planos</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link rel="shortcut icon" href="imagens_sistema/icon.png">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet"/>
  	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script>
    function ajax_plano(numero){
        if(numero > 0){
        $.ajax({
   url: 'ajax_plano.php?plano='+numero,
   data: {
      format: 'json'
   },
   error: function() {
      $('#info').html('<p>An error has occurred</p>');
   },
   dataType: 'jsonp',
   success: function(data) {
	
   },
   type: 'GET'
});
      }
	  window.location='planos.php';
    }
    </script>
</head>

<body <?php if($estilo==0){echo'class="fixed-nav sticky-footer bg-dark"';}else{ echo'class="fixed-nav sticky-footer bg-light"';}?> id="page-top">
  <!-- Navigation-->
      <?php
	$menu=0;
	if($tipo==1){
		include "naveg_adm.php";
	}
	else{
		include "naveg.php";
	}
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
         Planos
		  
        </li>
       
      </ol>
      <!-- Icon Cards-->
     <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div <?php if($plano_atual==4){echo 'style="border:2px solid black;"';} ?> class="card text-white bg-primary o-hidden h-100" >
            <div class="card-body">
              <div class="card-body-icon">
               <i class="fa fa-folder-open"></i>
              </div>
              <div class="mr-5">20 Gb (Gratuito)</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="" onclick="ajax_plano('4')" >
              <span class="float-left"><?php if($plano_atual!=4){echo 'Adquirir plano';}else{ echo 'Adquirido'; } ?></span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div <?php if($plano_atual==1){echo 'style="border:2px solid black;"';} ?> class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
               <i class="fa fa-folder-open"></i>
              </div>
                   <div class="mr-5">50 Gb (R$ 5,00 Mês)</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="" onclick="ajax_plano('1')">
              <span class="float-left"><?php if($plano_atual!=1){echo 'Adquirir plano';}else{ echo 'Adquirido'; } ?></span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div <?php if($plano_atual==2){echo 'style="border:2px solid black;"';} ?> class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-folder-open"></i>
              </div>
                 <div class="mr-5">100 Gb (R$ 10,00 Mês)</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="" onclick="ajax_plano('2')">
              <span class="float-left"><?php if($plano_atual!=2){echo 'Adquirir plano';}else{ echo 'Adquirido'; } ?></span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div <?php if($plano_atual==3){echo 'style="border:2px solid black;"';} ?> class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                 <i class="fa fa-folder-open"></i>
              </div>
                   <div class="mr-5">1Tb (R$ 100,00 Mês)</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="" onclick="ajax_plano('3')">
              <span class="float-left"><?php if($plano_atual!=3){echo 'Adquirir plano';}else{ echo 'Adquirido'; } ?></span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      
      </div>
	  </div>
      <!-- Example DataTables Card-->
   
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © GT Storage 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    
    <!-- Bootstrap core JavaScript-->
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="assets/js/script.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
<script>
$.noConflict();
// Code that uses other library's $ can follow here.
</script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
