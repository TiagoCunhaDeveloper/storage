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
	$sql1 ="SELECT * FROM tb_usuario ORDER BY nome_usu";
	$usu_geral = $conex -> prepare($sql1);	
	$usu_geral -> execute();
 ?>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Usuários</title>
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
</head>

<body <?php if($estilo==0){echo'class="fixed-nav sticky-footer bg-dark"';}else{ echo'class="fixed-nav sticky-footer bg-light"';}?> id="page-top">
  <!-- Navigation-->
     <?php
	 $menu=5;
	include "naveg_adm.php";
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
         Usuários / 
		  
        </li>
       
      </ol>
      <!-- Icon Cards-->
          <div class="card mb-3">
        
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Plano</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Plano</th>
                  <th>Ações</th>
                </tr>
              </tfoot>
              <tbody>
			  <?php 
				foreach($usu_geral as $u_g){
					$nome_usu  =$u_g['nome_usu'];
					$email_usu =$u_g['email_usu'];
					$id_usuario_banco=$u_g['id_usuario'];
					$plano     =$u_g['plano'];
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
					echo'<tr>
                  <td>'.$nome_usu  .'</td>
                  <td>'.$email_usu .'</td>
                  <td>'.$tamanho_disponivel.'</td>
                  <td id="ajax"><a href="GraficosUsuarios.php?id_usu='.$id_usuario_banco.'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver gráficos"  style="background-color: #fff;border: 1px solid transparent;border-color: #ccc;padding: 3px 10px;" class="fa fa-bar-chart" ></a><a href="ArquivosUsuarios.php?id_usu='.$id_usuario_banco.'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver arquivos" style="background-color: #fff;border: 1px solid transparent;border-color: #ccc;padding: 3px 10px;" class="fa fa-folder-open-o" id="teste"></a></td>
                </tr>';
				}
			  ?>
			  <!-- <button type="submit" title="Excluir" style="background-color: #fff;border: 1px solid transparent;border-color: #ccc;padding: 3px 10px;" class="fa fa-trash-o" id="teste"></button>-->
              </tbody>
            </table>
          </div>
        </div>
       </div>

      </div>
	  	<div id="content"  >
				
				
				
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

	  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	  
	<script type="text/javascript">
	$.noConflict();
	jQuery( document ).ready(function( $ ) {
		var content = $('#content');

		//pre carregando o gif
		loading = new Image(); loading.src = 'imagens_sistema/loading_a.gif';
		$('').live('click', function( e ){
			e.preventDefault();
			content.html( '<center><img src="imagens_sistema/loading_a.gif" width="600px" ></center>' );

			var href = $( this ).attr('href');
			$.ajax({
				url: href,
				success: function( response ){
					//forÃ§ando o parser
					var data = $( '<div>'+response+'</div>' ).find('#content').html();

					//apenas atrasando a troca, para mostrarmos o loading
					window.setTimeout( function(){
						content.fadeOut('slow', function(){
							content.html( data ).fadeIn();
						});
					}, 4000 );
				}
			});

		});
	});
	</script>
  </div>
</body>

</html>
