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
	$sql1 = "SELECT * FROM tb_planos_usuarios WHERE status=0";
	$planos_cli_e = $conex -> prepare($sql1);
	$planos_cli_e -> execute();
	
	$sql2 = "SELECT * FROM tb_planos_usuarios WHERE status=0 AND plano=4";
	$planos_cli_basico = $conex -> prepare($sql2);
	$planos_cli_basico -> execute();
	$count_planos_cli_basico = $planos_cli_basico->rowCount();
	
	$sql3 = "SELECT * FROM tb_planos_usuarios WHERE status=0 AND plano=1";
	$planos_cli_intermediario = $conex -> prepare($sql3);
	$planos_cli_intermediario -> execute();
	$count_planos_cli_intermediario = $planos_cli_intermediario->rowCount();
	
	$sql4 = "SELECT * FROM tb_planos_usuarios WHERE status=0 AND plano=2";
	$planos_cli_avancado = $conex -> prepare($sql4);
	$planos_cli_avancado -> execute();
	$count_planos_cli_avancado = $planos_cli_avancado->rowCount();
	
	$sql5 = "SELECT * FROM tb_planos_usuarios WHERE status=0 AND plano=3";
	$planos_cli_premium = $conex -> prepare($sql5);
	$planos_cli_premium -> execute();
	$count_planos_cli_premium = $planos_cli_premium->rowCount();
 ?>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Planos em liberação</title>
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
	 $menu=6;
	include "naveg_adm.php";
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
         Planos em liberação
		  
        </li>
       
      </ol>
      <!-- Icon Cards-->
          <div class="card mb-3">
        
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
				<th>Situação</th>
                  <th>Solicitante</th>
                  <th>Email</th>
                  
                  <th>Data Solicitação</th>
                  <th>Plano</th>
                  <th>Valor</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				 <th>Situação</th>
				  <th>Solicitante</th>
                  <th>Email</th>
                 
                  <th>Data Solicitação</th>
                  <th>Plano</th>
                  <th>Valor</th>
                  <th>Ações</th>
                </tr>
              </tfoot>
              <tbody>
			  <?php
				foreach($planos_cli_e as $p_c_e){
					
					$plano=$p_c_e['plano'];
					$data_solicitacao=$p_c_e['data_solicitacao'];
					$fk_usuario=$p_c_e['fk_usuario'];
					$id_plano=$p_c_e['id_planos_usuarios'];
					switch ($plano) {
						case 4:
							$tamanho_disponivel="20 Gb";
							$valor="Gratuito";
						break;
						case 1:
							$tamanho_disponivel="50 Gb";
							$valor="R$ 5,00";
						break;
						case 2:
							$tamanho_disponivel="100 Gb";
							$valor="R$ 10,00";
						break;
						case 3:
							$tamanho_disponivel="1 Tb";
							$valor="R$ 100,00";
						break;
					}
					$sql ="SELECT * FROM tb_usuario WHERE id_usuario = '$fk_usuario'";
					$usu_pla = $conex -> prepare($sql);	
					$usu_pla -> execute();
					foreach($usu_pla as $u_p){
						$nome=$u_p['nome_usu'];
					$email=$u_p['email_usu'];
					}
					echo '<tr>
					  <td><small class="label label-warning">PENDENTE</small></td>
                  <td>'.$nome.'</td>
                
                  <td>'.$email.'</td>
                  <td>'.$data_solicitacao.'</td>
				  <td>'.$tamanho_disponivel.'</td>
				  <td>'.$valor.'</td>
                  <td><form action="aprovar_plano.php" method="POST"><input type="hidden" name="id_plano" value="'.$id_plano.'"><input type="hidden" name="plano" value="'.$plano.'"><input type="hidden" name="fk_usuario" value="'.$fk_usuario.'"><button type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Aprovar" style="background-color: #fff;border: 1px solid transparent;border-color: #ccc;padding: 3px 10px;" class="fa fa-check" id="teste"></button></form>
				</tr>';
				}
			  ?>
              </tbody>
            </table>
          </div>
        </div>
       
      </div>
 <center><div id="columnchart_values" style="width: 900px; height: 300px;"></div><center>
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
	    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
          ["Plano", "Pedidos", { role: "style" } ],
        ["Basico", <?php echo $count_planos_cli_basico; ?>, "#007BFF"],
        ["Intermediario", <?php echo $count_planos_cli_intermediario; ?>, "#FFC107"],
        ["Avançado", <?php echo $count_planos_cli_avancado; ?>, "#28A745"],
        ["Premium", <?php echo $count_planos_cli_premium; ?>, "color: #DC3545"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Planos mais pedidos",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
  </div>
</body>

</html>
