<?php	
	$id_usu_di=$_SESSION["id_usuario"];
	$sql ="SELECT * FROM tb_usuario WHERE id_usuario = '$id_usu_di'";
	$usu_tamanho_d = $conex -> prepare($sql);	
	$usu_tamanho_d -> execute();
	foreach($usu_tamanho_d as $u_d){
		$plano_atual_d=$u_d['plano'];
	}
	switch ($plano_atual_d) {
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
	function By2M($size){
    $filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    return $size ? round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i] : '0 Bytes';
}
function diretorio($path) {

global $tamanho_arquivo, $tamanho_total, $total_pastas;

if ($dir = opendir($path)) {

while (false !== ($file = readdir($dir))) {

if (is_dir($path."/".$file)) {

if ($file != '.' && $file != '..') {

 '<li><b>' . $file . '</b></li><ul>';

diretorio($path."/".$file);

 '</ul>';

$total_pastas++;

}

}

else {

$tab = " ";

$filesize = $tab . '(' . filesize ($path.'/'.$file) . ' kb)';

'<li>' . $file . $filesize . '</li>';

$tamanho_total = $tamanho_total + filesize ($path.'/'.$file);

$tamanho_arquivo++;

}

}

closedir($dir);

}

}

diretorio("all_files/".$id_usu_di."/Meu armazenamento");//path da sua pasta
diretorio("all_files/".$id_usu_di."/Lixeira");
$porcentagem=$tamanho_total*100;
	$total_porcentagem=$porcentagem/$bytes;
?>
<noscript>
	<meta http-equiv="Refresh" content="0;URL=erros/erroJava.html" />
	</noscript>	
  <nav <?php if(@$estilo==0){echo'class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top "';}else{ echo'class="navbar navbar-expand-lg fixed-top navbar-light bg-light "';}?> id="mainNav">
    <a class="navbar-brand" href="index.php"><img src="imagens_sistema/logo.png" width="40px" height="40px"> Storage</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Meu armazenamento (Efetue login para acessar)">
          <a class="nav-link">
            <i class="fa fa-folder-open" aria-hidden="true"></i>
            <span class="nav-link-text">Meu armazenamento</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Compartilhados comigo (Efetue login para acessar)">
          <a class="nav-link" >
            <i class="fa fa-share-square-o" aria-hidden="true"></i>
            <span class="nav-link-text">Compartilhados comigo</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Anotações (Efetue login para acessar)">
          <a class="nav-link" >
           <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
            <span class="nav-link-text">Anotações</span>
          </a>
        </li>
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Arquivos excluidos (Efetue login para acessar)">
          <a class="nav-link" >
          <i class="fa fa-trash-o" aria-hidden="true"></i>
            <span class="nav-link-text">Arquivos excluidos</span>
          </a>
        </li>
	  </ul>
   <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-sign-in"></i>Logar</a>
        </li>
      </ul>
    </div>
  </nav>
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Deseja mesmo sair?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="logout.php">Sair</a>
          </div>
        </div>
      </div>
    </div>