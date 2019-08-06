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
	if(isset($_GET['search'])){
		$pesquisar=$_GET['search'];
		$sql ="SELECT * FROM tb_arquivos_usuarios WHERE fk_usuario = '$id_usuario' AND status=1 AND  nome_arquivo LIKE '%$pesquisar%'";
	}
	else{
		$sql ="SELECT * FROM tb_arquivos_usuarios WHERE fk_usuario = '$id_usuario' AND status=1 GROUP BY nome_arquivo";
	}
	$arquivos_gerais = $conex -> prepare($sql);	
	$arquivos_gerais -> execute();
		
 ?>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <title>Lixeira</title>
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
	$menu=4;
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
         Arquivos excluidos
		  
        </li>
       
      </ol>
      <!-- Icon Cards-->
          <div class="card mb-3">
        
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Tipo</th>
                  <th>Nome</th>
                  <th>Tamanho</th>
                  <th>Data de exclusão</th>
                  <th>Hora da exclusão</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Tipo</th>
                  <th>Nome</th>
                  <th>Tamanho</th>
                  <th>Data de exclusão</th>
                  <th>Hora da exclusão</th>
                  <th colspan="2">Ações</th>
                </tr>
              </tfoot>
              <tbody>
			  <?php
				foreach($arquivos_gerais as $a_g){
					date_default_timezone_set('America/Sao_Paulo');
					$data_hoje=date('Y/m/d');
					$nome_arquivo=$a_g['nome_arquivo'];
					$tamanho_arquivo=$a_g['tamanho_arquivo'];
					$data_exclusao=$a_g['data_exclusao'];
					$data_exclusao_padrao= str_replace("/", "-", $data_exclusao);
					$data_final = date('Y/m/d', strtotime('+7 days', strtotime($data_exclusao_padrao)));
					$hora_exclusao=$a_g['hora_exclusao'];
					$caminho=$a_g['caminho'];
					$id_arquivos_usuarios=$a_g['id_arquivos_usuarios'];
					if(strtotime($data_hoje) >= strtotime($data_final)){
					    $sql ="DELETE FROM `tb_arquivos_usuarios` WHERE `tb_arquivos_usuarios`.`id_arquivos_usuarios` =  $id_arquivos_usuarios";
	                    $deleta_arquivo = $conex -> prepare($sql);	
	                    $deleta_arquivo -> execute();
						@unlink('all_files/'.$id_usuario.'/Lixeira/'.$nome_arquivo.'');
					}
					else{
						echo ' <tr>                                                                                                                                                                                                                  
                  <td><i class="fa fa-file"></i></td>                                                                                                                                                                                 
                  <td>'.$nome_arquivo.'</td>                                                                                                                                                                                                   
                  <td>'.By2M($tamanho_arquivo).'</td>                                                                                                                                                                                                        
                   <td>'.$data_exclusao.'</td>                                                                                                                                                                                                
                   <td>'.$hora_exclusao.'</td>
					<form action="recuperar_arquivo.php" method="POST">
					<input type="hidden" name="caminho" value="'.$caminho.'">
					<input type="hidden" name="id_arquivos_usuarios" value="'.$id_arquivos_usuarios.'">
					<input type="hidden" name="nome_arquivo" value="'.$nome_arquivo.'">
                  <td><a href="all_files/'.$id_usuario.'/Lixeira/'.$nome_arquivo.'" download data-toggle="tooltip" data-placement="top" title="" data-original-title="Baixar" style="background-color: #fff;border: 1px solid transparent;border-color: #ccc;padding: 3px 10px;text-decoration:none;color:black;" class="fa fa-download" id="teste"></a><button type="submit" name="recuperar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Recuperar" style="background-color: #fff;border: 1px solid transparent;border-color: #ccc;padding: 3px 10px;" class="fa fa-repeat" id="teste"></button></td>
				</form>
				</tr>';
					}
				}
			  ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Os arquivos excluidos serão excluidos permanentemente após 7 dias da data de exclusão. </div>
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
