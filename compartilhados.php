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
	$sql ="SELECT * FROM tb_compartilhados_interno INNER JOIN tb_usuario ON tb_compartilhados_interno.fk_usuario = tb_usuario.id_usuario WHERE receptor_interno = '$id_usuario' group by email_usu";
	$compartilhadosCmg = $conex -> prepare($sql);	
	$compartilhadosCmg -> execute();
	$sql ="SELECT * FROM tb_compartilhados_interno  WHERE receptor_interno = '$id_usuario' ";
	$compartilhadosCmgAll = $conex -> prepare($sql);	
	$compartilhadosCmgAll -> execute();
	$countCompartilhadosCmg = $compartilhadosCmgAll->rowCount();
 ?>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Compartilhados</title>
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
  #teste{
	visibility: hidden;
}
 #teste2{
	visibility: hidden;
}
.folders:hover #teste {
    visibility: visible;
}
.files:hover #teste2 {
    visibility: visible;
}
  </style>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

  <?php
		if(isset($_SESSION["nome_arquivo"])){
			echo "<script>$(function () { $('#clica').trigger('click');});</script>";
		}
	?>
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
	 <style>
    .diff td{
      vertical-align : top;
      font-family    : monospace;
	  border-left: 1px solid black;
    }
    .diffUnmodified { background-color: #F8F9FA; }
    .diffDeleted { background-color:#F8F9FA;color:#8B0000;}
    .diffInserted { background-color: #F8F9FA;color:#008000; }
    </style>
	<style type="text/css">
			
			
			.example {
				float: left;
				margin: 15px;
			}
			
			.demo {
				width: 200px;
				height: 400px;
				border-top: solid 1px #BBB;
				border-left: solid 1px #BBB;
				border-bottom: solid 1px #FFF;
				border-right: solid 1px #FFF;
				background: #FFF;
				overflow: scroll;
				padding: 5px;
			}
			
		</style>
</head>

<body <?php if($estilo==0){echo'class="fixed-nav sticky-footer bg-dark"';}else{ echo'class="fixed-nav sticky-footer bg-light"';}?> id="page-top">
  <!-- Navigation-->
   <?php
	$menu=2;
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
         Compartilhados comigo
		  
        </li>
       
      </ol>
      <!-- Icon Cards-->
	 
     <div class="card mb-3">
        <?php	
			foreach ($compartilhadosCmg as $c_cmg){
				$nome_usuario=$c_cmg['nome_usu'];
				$email_usu=$c_cmg['email_usu'];
				$fk_usuarioCompart=$c_cmg['fk_usuario'];
				$sql ="SELECT * FROM tb_compartilhados_interno WHERE fk_usuario = '$fk_usuarioCompart' AND receptor_interno= '$id_usuario' ";
				$compartilhadosCmg2 = $conex -> prepare($sql);	
				$compartilhadosCmg2 -> execute();
			
				echo '<div class="card-body">
	Compartilhado por:<h2>'.$nome_usuario.' &lt;'.$email_usu.'&gt;</h2><div class="table-responsive">
            <table class="table table-bordered" id="dataTable'.$fk_usuarioCompart.'" width="100%" cellspacing="0" >
              <thead>
                <tr>
                  <th>Tipo</th>
                  <th>Nome</th>
                  
                  <th>Data</th>
                  <th>Permições</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Tipo</th>
                  <th>Nome</th>
                
                  <th>Data</th>
                  <th>Permições</th>
                  <th>Ações</th>
                </tr>
              </tfoot>
              <tbody>
			  ';
			foreach($compartilhadosCmg2 as $c_cmg2 ){
				$nome_arquivo=$c_cmg2['nome_folder'];
				$id_compartilhados_interno=$c_cmg2['id_compartilhados_interno'];
				$tipo=$c_cmg2['tipo'];
				$data_compartilhamento_interno=$c_cmg2['data_compartilhamento_interno'];
				$opcoes_compart=$c_cmg2['opcoes_compart'];
				$caminho_compartilhado_interno=$c_cmg2['caminho_compartilhado_interno'];
				switch ($tipo) {
					case 0:
						$imgTipo='<i class="fa fa-folder"></i>';
						$botaoDownload=' <button type="submit" name="baixar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Baixar" style="background-color: #fff;border: 1px solid transparent;border-color: #ccc;padding: 3px 10px;"><i class="fa fa-download" aria-hidden="true"></i></button> <button type="submit" name="addMystorage" data-toggle="tooltip" data-placement="top" title="" data-original-title="Adcionar em meu armazenamento" style="background-color: #fff;border: 1px solid transparent;border-color: #ccc;padding: 3px 10px;"><i class="fa fa-plus" aria-hidden="true"></i></button>';
						break;
					case 1:
						$imgTipo='<i class="fa fa-file"></i>';
						$botaoDownload=' <button type="button" onclick="document.getElementById(\''.$id_compartilhados_interno.'\').click()"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Baixar" style="background-color: #fff;border: 1px solid transparent;border-color: #ccc;padding: 3px 10px;text-decoration:none;color:black;" download><i class="fa fa-download" aria-hidden="true"></i></button> <button type="submit" name="addMystorage" data-toggle="tooltip" data-placement="top" title="" data-original-title="Adcionar em meu armazenamento" style="background-color: #fff;border: 1px solid transparent;border-color: #ccc;padding: 3px 10px;"><i class="fa fa-plus" aria-hidden="true"></i></button> <a id="'.$id_compartilhados_interno.'" href="'.$caminho_compartilhado_interno.'"  download style="display:none;"></a>';
						break;
				}
				switch ($opcoes_compart) {
					case 0:
						$opcoes_compartTxt='Visualizar';
						break;
					case 1:
						$opcoes_compartTxt='Editar';
						break;
					case 2:
						$opcoes_compartTxt='Editar e excluir';
					break;
				}
				echo '
          	 
						 <tr>                                                                                                                                                                                                                  
                                                                                                                                                                                                
                  <td>'.$imgTipo.'</td>                                                                                                                                                                                                   
                  <td>'.$nome_arquivo.'</td>                                                                                                                                                                                                        
                   <td>'.$data_compartilhamento_interno.'</td>                                                                                                                                                                                                
                   <td>'.$opcoes_compartTxt.'</td>
					<form action="ArquivoCompartilhadoAux.php" method="POST">
					<input type="hidden" name="arquivo_compart" value="'.$nome_arquivo.'">
					<input type="hidden" name="email_usu" value="'.$email_usu.'">
					<input type="hidden" name="nome_usuario" value="'.$nome_usuario.'">
					<input type="hidden" name="permicoes" value="'.$opcoes_compart.'">
					<input type="hidden" name="caminho_compartilhado_interno" value="'.$caminho_compartilhado_interno.'">
					<input type="hidden" name="tipo" value="'.$tipo.'">
					<input type="hidden" name="fk_usuarioCompart" value="'.$fk_usuarioCompart.'">
                  <td><button type="submit" name="ver" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver" style="background-color: #fff;border: 1px solid transparent;border-color: #ccc;padding: 3px 10px;"><i class="fa fa-eye" aria-hidden="true"></i></button>'.$botaoDownload.'</td>
				</form>
				';
			}
	        echo '</tr>
			
              </tbody>
            </table>
          </div>
        </div>
		<hr><script>
	$(document).ready(function() {
		
    $("#dataTable'.$fk_usuarioCompart.'").DataTable();
} );
  </script>';
			}
		?>	
        
		      
        <div class="card-footer small text-muted"><?php echo $countCompartilhadosCmg; ?> itens compartilhados</div>
      </div>

      </div>
	  </div>
      <button type="button" style="display:none;" data-toggle="modal" data-target="#modalArquivoexistente" id="clica"><i class="fa fa-file" aria-hidden="true"></i></button>
   <div class="modal fade" id="modalArquivoexistente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?php if($_SESSION["tipoExiste"]==1){ echo "O arquivo ";}else{  echo "A pasta "; }  if(isset($_SESSION["nome_arquivo"])){ echo "( ".$_SESSION["nome_arquivo"]." )"; } ?> já existe !</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
		   <div class="modal-body">
		 
		   
			<?php
		if(isset($_SESSION["nome_arquivo"])){
			
			function tamanho_arquivo_compart($arquivo) {
				$tamanhoarquivo = filesize($arquivo);
			 
				
			 
				return $tamanhoarquivo;
			}
			function formatBytes($size, $precision = 2)
			{
				$base = log($size, 1024);
				$suffixes = array('', 'K', 'M', 'G', 'T');   

				return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
			}
			if($_SESSION["tipoExiste"]==1){
				$nome_tipo="do seu arquivo ";
				$nome_tipo2="o novo arquivo";
				$novoBotao="Novo arquivo";
			}
			else{
				$nome_tipo="da sua pasta";
				$nome_tipo2="a nova pasta";
				$novoBotao="Nova pasta";
			}
			$arquivo_temporario=$_SESSION["arquivo_temporario"];
			$arquivo_destino=$_SESSION["arquivo_destino"];
			$extensao=strrchr($_SESSION["nome_arquivo"],'.');
			$size_novo_arquivo=$_SESSION["arquivo_temporario_size"];
			$size_arquivo_destino=tamanho_arquivo_compart(''.$arquivo_destino.'');
			date_default_timezone_set('America/Sao_Paulo');
			$data = date("d_m_Y");
			$bodytag=$_SESSION["nome_arquivo"];
			$nome_novo_arquivo = str_replace($extensao,'_'.$data,$bodytag).$extensao;
			$tipoDiretorio=$_SESSION["tipoExiste"];
			$array_formatos=array(".php", ".js", ".py", ".css", ".html", ".xhtml", ".js", ".cpp", ".c", ".json", ".java", ".bat", ".h", ".jar", ".jav", ".sql", ".inc", ".htaccess",".txt");
			if($_SESSION["tipoExiste"]==0){
				$diferenca='<div class="example">
			<h5>Sua pasta</h5>
			<div id="fileTreeDemo_1" class="demo"></div>
		</div>
		
		<div class="example">
			<h5>Nova pasta</h5>
			<div id="fileTreeDemo_2" class="demo"></div>
		</div>';
				$nome_novo_arquivo=$bodytag.' '.$data;
				//-----------------------------------------------------------------------------------------------------------------------------------------------------
			}
			else{
				if (in_array($extensao, $array_formatos)) { 
					require_once 'class.Diff.php';
					$diferenca_m=Diff::toTable( Diff::compareFiles(''.$arquivo_destino.'',''.$arquivo_temporario.'') );
					$diferenca='<div style="border:1px solid black;overflow: scroll;height:300px;">'.$diferenca_m.'</div> <button style="background-color:#8B0000;width:15px; height:15px;border: 1px solid;"></button> Excluido <button style="background-color:#008000;width:15px; height:15px;border: 1px solid;"></button> Inserido <button style="background-color:black;width:15px; height:15px;border: 1px solid;"></button> Não modificado';
				}
				else{
					switch ($size_novo_arquivo) {
						case $size_novo_arquivo > $size_arquivo_destino:
							$tamnho="(Maior)";
							break;
						case $size_novo_arquivo <$size_arquivo_destino:
							$tamnho="(Menor)";
							break;
						case $size_novo_arquivo == $size_arquivo_destino:
							$tamnho="(Igual)";
							break;
					}
					switch ($size_arquivo_destino) {
						case $size_arquivo_destino>$size_novo_arquivo:
							$tamnhoo="(Maior)";
							break;
						case $size_arquivo_destino<$size_novo_arquivo:
							$tamnhoo="(Menor)";
							break;
						case $size_arquivo_destino == $size_novo_arquivo:
							$tamnhoo="(Igual)";
							break;
					}
					$diferenca_m='<div><i class="fa fa-file-o fa-5x" aria-hidden="true"></i><br>'.formatBytes($size_novo_arquivo,0).$tamnho.'</div><div><i class="fa fa-file-o fa-5x" aria-hidden="true"></i><br>'.formatBytes($size_arquivo_destino,0).$tamnhoo.'</div>';
					$diferenca='<div align="center">'.$diferenca_m.'</div>';
					
				}
			}
			unset($_SESSION["nome_arquivo"]);
			 unset($_SESSION["tipoExiste"]);
			 unset($_SESSION["arquivo_destino"]);
			 unset($_SESSION["arquivo_temporario"]);
			 unset($_SESSION["arquivo_temporario_size"]);
					echo '<label>Foram encontradas essas diferenças '.$nome_tipo.' para '.$nome_tipo2.':</label>'.$diferenca.'<br>';
		
		
				
			
			
			
			
		}
	?>
		
		
		
		
		<br>
		<label><b>Nome d<?php echo $nome_tipo2.'</b> '.$nome_novo_arquivo; ?> </label>
	  </div>
		  <form action="controle_ja_existente.php" method="POST" enctype='multipart/form-data'>
		   <div class="modal-footer">
			<input value="<?php echo $tipoDiretorio;?>" name="tipo" type="hidden" >
			<input type="hidden" value="<?php echo $fk_usuarioCompart;?>" name="fk_usuarioCompart">
			<input type="hidden" value="<?php echo $size_novo_arquivo;?>" name="size">
			<input type="hidden" value="<?php echo $arquivo_destino;?>" name="arquivo_destino_substituir">
			<input type="hidden" value="<?php echo $arquivo_temporario;?>" name="arquivo_temporario">
			<input type="hidden" value="<?php echo $nome_novo_arquivo;?>" name="nome_novo_arquivo">
			<input type="hidden" value="<?php echo $bodytag;?>" name="nome_antigo">
			<input type="hidden" value="<?php echo $tipoDiretorio;?>" name="tipo">
			
           <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
			<button class="btn btn-primary" type="submit" name="novo_arquivo" ><?php echo $novoBotao; ?></button>
            
             <button class="btn btn-primary" type="submit" name="substituir" >Substituir</button>
          </div>
		  </form>
        </div>
      </div>
    </div>
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
	 <script src="js/pace.min.js"></script>
	
	  <script src="jquery.js" type="text/javascript"></script><!--BIBLIOTECA COM PROBLEMAS -->
		<script src="jquery.easing.js" type="text/javascript"></script>
		<script src="jqueryFileTree.js" type="text/javascript"></script>
		<link href="jqueryFileTree.css" rel="stylesheet" type="text/css" media="screen" />
		<script>
$.noConflict();

</script>
		<script type="text/javascript">
			
			
		jQuery( document ).ready(function( $ ) {
				$('#fileTreeDemo_1').fileTree({ root: '../<?php echo $arquivo_destino;?>/', script: 'connectors/jqueryFileTree.php' }, function(file) { 
					
				});
				
				$('#fileTreeDemo_2').fileTree({ root: '../<?php echo $arquivo_temporario;?>/', script: 'connectors/jqueryFileTree.php'}, function(file) { 
					
				});
				
					
			});
			
		</script>
  </div>
</body>

</html>
