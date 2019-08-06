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
	}
	@$plano=$_POST['plano'];
	@$fk_usuario=$_POST['fk_usuario'];
	@$id_plano=$_POST['id_plano'];
	$sql ="SELECT * FROM tb_usuario WHERE id_usuario = '$fk_usuario'";
					$usu_pla = $conex -> prepare($sql);	
					$usu_pla -> execute();
					foreach($usu_pla as $u_p){
						$nome=$u_p['nome_usu'];
						$email=$u_p['email_usu'];
					}
	if(isset($_POST['sim'])){
		date_default_timezone_set('America/Sao_Paulo');
		$plano_d=$_POST['plano_d'];
		$id_plano_d=$_POST['id_plano_d'];
		$fk_usuario_d=$_POST['fk_usuario_d'];
		$data_aprovacao=date('d/m/Y');
		$sql ="UPDATE `tb_planos_usuarios` SET `status` = '1', `data_aprovacao` = '$data_aprovacao',`plano` = '$plano_d' WHERE `tb_planos_usuarios`.`id_planos_usuarios` = $id_plano_d";
		$up_plano = $conex -> prepare($sql);	
		$up_plano -> execute();
		$sql1 ="UPDATE `tb_usuario` SET `plano` = '$plano_d' WHERE `tb_usuario`.`id_usuario` = $fk_usuario_d";
		$up_plano_usuario = $conex -> prepare($sql1);	
		$up_plano_usuario -> execute();
		echo "<script>
							window.location='planos_espera.php';
							alert('Aprovado com sucesso!');
						 </script>";	
	}
 ?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Aprovar plano</title>
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
  <style>
  .label-warning {
  background-color: #f0ad4e;
}
.label {
  display: inline;
  padding: .2em .6em .3em;
  font-size: 75%;
  font-weight: bold;
  line-height: 1;
  color: #fff;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: .25em;
}
  </style>
</head>

<body <?php if($estilo==0){echo'class="fixed-nav sticky-footer bg-dark"';}else{ echo'class="fixed-nav sticky-footer bg-light"';}?> id="page-top">
  <!-- Navigation-->
     <?php
	include "naveg_adm.php";
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
         Aprovar plano do <?php echo $nome ?> &lt; <?php echo $email?> &gt;
		  
        </li>
        
      </ol>
      <!-- Icon Cards-->
          <div class="card mb-3">
        
        <div class="card-body">
     <form action="" method="POST">
	 <input type="hidden" name="plano_d" value="<?php echo $plano;?>">
	 <input type="hidden" name="id_plano_d" value="<?php echo $id_plano;?>">
	 <input type="hidden" name="fk_usuario_d" value="<?php echo $fk_usuario;?>">
		<button class="btn btn-primary btn-block" type="submit" name="sim">Sim</button>
		<a class="btn btn-primary btn-block" href="planos_espera.php" style="background-color:white;color:black;border:1px solid #ccc;" >Não</a>
		</form>
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
	<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
	    
  </div>
</body>

</html>
