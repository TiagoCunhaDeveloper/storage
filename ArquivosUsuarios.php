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
	$id_usuario_banco=$_GET['id_usu'];
	$_SESSION["id_usuario_arquivo"]=$id_usuario_banco;
	$sql1 ="SELECT * FROM tb_usuario WHERE id_usuario=$id_usuario_banco";
	$usu_geral = $conex -> prepare($sql1);	
	$usu_geral -> execute();
	foreach($usu_geral as $u_g){
		$nome_usu  =$u_g['nome_usu'];
		$email_usu =$u_g['email_usu'];
		$plano     =$u_g['plano'];
		switch ($plano) {
						case 4:
			$tamanho_disponivel="20 Gb";
			$bytes=21474836480;
		break;
		case 1:
			$tamanho_disponivel="50 Gb";
			$bytes=53687091200;
		break;
		case 2:
			$tamanho_disponivel="100 Gb";
			$bytes=107374182400;
		break;
		case 3:
			$tamanho_disponivel="1 Tb";
			$bytes=1099511627776;
		break;
					}
	}
?>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Arquivos usuario <?php echo $nome_usu;?></title>
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
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
        ['Disponível',     100],
          ['Utilizado',      <?php echo $total_porcentagem ?>]
          
        ]);

        var options = {
          title: 'Armazenamento utilizado',
		   colors:['#3399ff','#212529'],
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
	<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Pastas',     <?php echo $total_pastas ?>],
          ['Arquivos',      <?php echo $tamanho_arquivo ?>]
         
        ]);

        var options = {
          title: 'Pastas e arquivos',
		 colors:['#3399ff','#212529'],
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3dd'));
        chart.draw(data, options);
      }
    </script>
</head>

<body <?php if($estilo==0){echo'class="fixed-nav sticky-footer bg-dark"';}else{ echo'class="fixed-nav sticky-footer bg-light"';}?> id="page-top">
  <!-- Navigation-->
     <?php
	 $menu=5;
	include "naveg_adm.php";
?>

  <div class="content-wrapper">
    <div id="content">
    <div class="container-fluid">
	<input type="hidden" value="<?php echo $id_usuario_banco;?>" id="fkCompart">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
      <a href="usuarios.php">Usuários</a> /  <div class="breadcrumbs"></div>
		  
        </li>
       
      </ol>
		
          <div class="card mb-3">
			<center><h3>Usuário <b><?php echo $email_usu;?></b></h3></center>
        <div class="card-body">
		  	<div class="filemanager">

		
		<div class="search">
		
		<input type="search" class="form-control" placeholder="Procurar arquivo.." />
			

	
		</div>

		

		<ul class="data"></ul>

		<div class="nothingfound">
			<div class="nofiles"></div>
			<span>Nenhum arquivo encontrado</span>
		</div>

	</div>
       
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
    
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="assets/js/script_usuarios.js"></script>
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
