<!DOCTYPE html>
<?php
session_start();
include "inc/conexao.php"; 
//http://127.0.0.1:85/Storage/link_p.php?c=6b912b63-ac8a-b962-1b68-91c096291ddd&ed=e9064b74d28acc053231170bb8c858b3&e=e9064b74d28acc053231170bb8c858b3
	@$id_usuario=$_SESSION["id_usuario"];
	$editar=$_SESSION["ed"];
	$excluir=$_SESSION["e"];
	$sql ="SELECT * FROM tb_usuario WHERE id_usuario = '$id_usuario'";
	$usu = $conex -> prepare($sql);	
	$usu -> execute();
	foreach($usu as $u){
		$estilo=$u['estilo'];
		$qtd_pastas=$u['qtd_pastas'];
		$nome_usu=$u['nome_usu'];
		$email=$u['email_usu'];
		$preview=$u['preview'];
	}
		$sql ="SELECT * FROM tb_arquivos_usuarios WHERE fk_usuario = '$id_usuario'";
	$arquivos_gerais = $conex -> prepare($sql);	
	$arquivos_gerais -> execute();
	$qtd_arquivos = $arquivos_gerais->rowCount();
	$aux=$_SESSION["caminho_compartilhado"];
	$hashdobanco=str_replace("\\","",$aux);
	$arquivo_link=$_SESSION["arquivo_link"];
	$folder_link=$_SESSION["folder_link"];
	$caminhoDiretorioFinal=str_replace($folder_link,"",$aux);
	$arquivo_compart_filt=str_replace("(","\(",$arquivo_link);
	$arquivo_compart_filt1=str_replace(")","\)",$arquivo_compart_filt);
	$arquivo_compart_filt2=str_replace("[","\[",$arquivo_compart_filt1);
	$arquivo_compart_filt3=str_replace("]","\]",$arquivo_compart_filt2);
 ?>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo $nome_usu;?> storage</title>
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
 #teste3{
	visibility: hidden;
}
.folders:hover #teste {
    visibility: visible;
}
.files:hover #teste2 {
    visibility: visible;
}
.files:hover #teste3 {
    visibility: visible;
}
  </style>
  <link href="https://swisnl.github.io/jQuery-contextMenu/dist/jquery.contextMenu.css" rel="stylesheet" type="text/css" />
  
		    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			
    <script src="https://swisnl.github.io/jQuery-contextMenu/dist/jquery.contextMenu.js" type="text/javascript"></script>

    <script src="https://swisnl.github.io/jQuery-contextMenu/dist/jquery.ui.position.min.js" type="text/javascript"></script>

    <script src="https://swisnl.github.io/jQuery-contextMenu/js/main.js" type="text/javascript"></script>
	<script src="jquery.cookie.js"></script>
	<script>
	 $.cookie('id_usuario', '<?php echo $id_usuario;?>');
	 function boasvindas() {
		  var x = location.hash;
	 document.getElementById("caminho").value=x;
	 document.getElementById("caminho_arquivo").value=x;
	 document.getElementById("caminho_atual_pasta").value=x;
	 document.getElementById("caminho_atual_arquivo").value=x;

	 }
	
	</script>
	<script>
	function sem_acento(e,args)
{		
	if (document.all){var evt=event.keyCode;} // caso seja IE
	else{var evt = e.charCode;}	// do contrário deve ser Mozilla
	var valid_chars = '0123456789abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYK- '+args;	// criando a lista de teclas permitidas
	var chr= String.fromCharCode(evt);	// pegando a tecla digitada
	if (valid_chars.indexOf(chr)>-1 ){return true;}	// se a tecla estiver na lista de permissão permite-a
	// para permitir teclas como <BACKSPACE> adicionamos uma permissão para 
	// códigos de tecla menores que 09 por exemplo (geralmente uso menores que 20)
	if (valid_chars.indexOf(chr)>-1 || evt < 9){return true;}	// se a tecla estiver na lista de permissão permite-a
	return false;	// do contrário nega
}
	</script>
	<?php
		if(isset($_SESSION["nome_arquivo"])){
			echo "<script>$(function () { $('#clica').trigger('click');});</script>";
		}
	?>
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
	<style>
	#hoverimg{
		display:none;
	}
	<?php 
		if($preview==1){
			echo "#hoverdnv:hover #hoverimg{
		display:block;
	}";
		}
	?>
	
	</style>
	<style>
	/* This is a compiled file, you should be editing the file in the templates directory */
.pace {
  -webkit-pointer-events: none;
  pointer-events: none;

  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}

.pace-inactive {
  display: none;
}

.pace .pace-progress {
  <?php if(@$estilo==0){echo' background: #ffffff;';}else{ echo' background: #000;';}?>
  position: fixed;
  z-index: 2000;
  top: 0;
  right: 100%;
  width: 100%;
  height: 2px;
}

	</style>
	<script>
function myFunction(as) {
	var x=as;
	var hash = location.hash;
	var semhash='<?php echo $hashdobanco;?>/';
	var	caminho_filtrado = hash.replace('#Meu%20armazenamento', '');
	var	caminho_filtrado_1 = caminho_filtrado.replace(/%2F/g, "/");
	var	caminho_filtrado_2 = caminho_filtrado_1.replace(/%5C/g, '');
	var	caminho_filtrado_3 = caminho_filtrado_2.replace(/%20/g, ' ');

	var teste=x.replace("Meu armazenamento", "Meu armazenamento/");
	if(hash==""){
		var	caminho_filtrado_final=caminho_filtrado_3+"";
		var res = x.replace(semhash+caminho_filtrado_final+"", "");
	}
	else{
		var	caminho_filtrado_final=caminho_filtrado_3+"/";
		var res = x.replace("Meu armazenamento"+caminho_filtrado_final+"", "");
	}
	
	document.getElementById("nome_anterior").value=res;
	document.getElementById("nome_anterior_d").value=res;
	document.getElementById("caminho_anterior_pasta").value=teste;
	document.getElementById("caminho_anterior_pasta_compar").value=teste;
	$('#clica2').trigger('click');
}
function myFunction2(as) {
	var x=as;
	var id= <?php echo $id_usuario;?>;
	var semhash='<?php echo $hashdobanco;?>';
	var arquivolink='<?php echo $arquivo_compart_filt3;?>';
	var hash = location.hash;
	var	caminho_filtrado = hash.replace('#Meu%20armazenamento', '');
	var	caminho_filtrado_1 = caminho_filtrado.replace(/%2F/g, "/");
	var	caminho_filtrado_2 = caminho_filtrado_1.replace(/%5C/g, '');
	var	caminho_filtrado_3 = caminho_filtrado_2.replace(/%20/g, ' ');
	var	caminho_filtrado_final=caminho_filtrado_3+"/";
	var teste=x.replace("Meu armazenamento", "Meu armazenamento/");
	if(hash==""){
		var res = x.replace("all_files/"+id+"/"+semhash+caminho_filtrado_final+"", "");
	}
	else{
		var res = x.replace("all_files/"+id+"/Meu armazenamento"+caminho_filtrado_final+"", "");
	}
	if(arquivolink!='0'){
		var res =arquivolink;
	}
	document.getElementById("nome_anterior_arquivo").value=res;
	document.getElementById("nome_anterior_d_arquivo").value=res;
	document.getElementById("caminho_anterior_arquivo").value=teste;
	var ext = res.split('.').pop();
	document.getElementById("ext").value=ext;
	//all_files/1/Meu armazenamentoUmaPasta/seilanevaiqdnv.txt
	// /
   $('#clica3').trigger('click');
  
}
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>

function Mudarestado(el) {
	var estadoatual= document.getElementById(el).style.display;
	if(estadoatual=="block"){
		document.getElementById(el).style.display = 'none';
	}else{
		document.getElementById(el).style.display = 'block';
	}
	var caminho_link=document.getElementById("caminho_anterior_pasta_compar").value;
	function guid() {
		  return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
			s4() + '-' + s4() + s4() + s4();
		}

		function s4() {
		  return Math.floor((1 + Math.random()) * 0x10000)
			.toString(16)
			.substring(1);
	}
	var hash=guid();
	document.getElementById("hash").value=hash;
   	$.ajax({
   url: 'ajax_link.php?caminho_link='+caminho_link+'&hash='+hash,
   data: {
      format: 'json'
   },
   error: function() {
      $('#info').html('<p>An error has occurred</p>');
   },
   dataType: 'jsonp',
   success: function(data) {
      var $title = $('<h1>').text(data.talks[0].talk_title);
      var $description = $('<p>').text(data.talks[0].talk_description);
      $('#info')
         .append($title)
         .append($description);
   },
   type: 'GET'
});
var hash_atual=document.getElementById("hash").value;
document.getElementById('link_input').value="http://127.0.0.1:85/Storage/link.php?c="+hash_atual+"&ed=4f876ab4493c98f6e241355c57136259&e=4f876ab4493c98f6e241355c57136259";
    }
	function MudarLink(l){
		var link = l;
		var hash_atual=document.getElementById("hash").value;
		switch(link){
			case '2':
				document.getElementById('link_input').value="http://127.0.0.1:85/Storage/link.php?c="+hash_atual+"&ed=e9064b74d28acc053231170bb8c858b3&e=4f876ab4493c98f6e241355c57136259";
			break;
			case '3':
				document.getElementById('link_input').value="http://127.0.0.1:85/Storage/link.php?c="+hash_atual+"&ed=e9064b74d28acc053231170bb8c858b3&e=e9064b74d28acc053231170bb8c858b3";
			break;
			default:
			document.getElementById('link_input').value="http://127.0.0.1:85/Storage/link.php?c="+hash_atual+"&ed=4f876ab4493c98f6e241355c57136259&e=4f876ab4493c98f6e241355c57136259";
		}
	}
</script>
   <style>
  .switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 21px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 19px;
  width: 19px;
  left: 2px;
  bottom: 1px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
  </style>
   <script>
    function ajax_preview(numero){
     
      if(numero > 0){
	    $.ajax({
   url: 'ajax_preview.php?id_usu='+numero,
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
	  
    }
    </script>
	<script>
$(document).ready(function() {

$("#toggleNavColor").click(function() { // objeto com id alvo que recebe o click
setTimeout(function () {
        window.location.reload(1);
    }, 250);
}); // fecha click

}); // fecha ready
</script>

</head>

<body <?php if(@$estilo==0){echo'class="fixed-nav sticky-footer bg-dark sidenav-toggled"';}else{ echo'class="fixed-nav sticky-footer bg-light sidenav-toggled"';}?> id="page-top" onselectstart="return false" oncontextmenu="return false" ondragstart="return false" onMouseOver="window.status='..message perso .. '; return true;">
  <!-- Navigation-->
<?php
	include "naveg_link.php";
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
	  
      <ol class="breadcrumb">
	   <label class="switch" style="float:right;">
	   
  <input type="checkbox" id="toggleNavColor" <?php echo'onclick="ajax_preview('.$id_usuario.')"'; if($preview==1){ echo "checked";} ?>>
  <span class="slider round"></span>
</label>
		<label style="float:right;">Ativar preview de arquivos &nbsp;</label>
	
        <li class="breadcrumb-item">
         
		  <div class="breadcrumbs"></div>
	    </li>
       
      </ol>
      <!-- Icon Cards-->
    



      <div class="context-menu-one card mb-3">
        
        <div class="card-body">
		
          	<div class="filemanager">

		
		<div class="search">
		<?php 
			if($arquivo_link=='0'){
				echo '<input type="search" class="form-control" placeholder="Procurar arquivo.." />';
			}
			else{
				
			}
		?>
				

	<button type="button" style="display:none;" data-toggle="modal" data-target="#modalArquivoexistente" id="clica"><i class="fa fa-file" aria-hidden="true"></i></button>
	<button type="button" style="display:none;" data-toggle="modal" data-target="#modal_excluirPasta" id="clica2" onclick="boasvindas();"><i class="fa fa-file" aria-hidden="true"></i></button>
	<button type="button" style="display:none;" data-toggle="modal" data-target="#modal_excluirArquivo" id="clica3" onclick="boasvindas();"><i class="fa fa-file" aria-hidden="true"></i></button>
		
		</div>

		

		<ul class="data"></ul>

		<div class="nothingfound">
			<div class="nofiles"></div>
			<span>Nenhum arquivo encontrado</span>
		</div>

	</div>
        </div>
		<div class="card-footer small text-muted">Compartilhado por <?php echo $nome_usu." (".$email.")."; ?></div>
       <!-- <div class="card-footer small text-muted"></div>-->
      </div>
      </div>
	  </div>
      <!-- Example DataTables Card-->
	    <div class="modal fade" id="modal_excluirPasta"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Oque deseja fazer com essa pasta ?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
		 <form action="controle_de_pastas.php" method="POST">
			  <div class="modal-body">
			 <label>Nome</label>
												<input class="form-control" type="text" id="nome_anterior" onclick="document.getElementById('nome_anterior').select();" name="caminho_novo_pasta" style="text-transform:capitalize;">
												<input class="form-control" type="hidden" id="caminho_anterior_pasta" name="caminho_anterior_pasta">
												<input class="form-control" type="hidden" id="nome_anterior_d" name="nome_anterior">
												<input class="form-control" type="hidden" id="caminho_atual_pasta" name="caminho_atual_pasta">
												<input class="form-control" type="hidden" value="1" name="paginalink">
												<input class="form-control" type="hidden" value="<?php echo $caminhoDiretorioFinal;?>" id="caminhoDiretorioFinal">
													<p class="help-block">Os nomes de arquivos e ou pastas não podem conter nenhum dos seguintes caracteres: /\:*?`´^~@|</p>
											<p class="help-block">Ao excluir uma pasta todos os arquivos contidos nela serão perdidos.</p>
											
			  </div>
			  <div class="modal-footer">
			  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
				<?php if($excluir=="s"){ echo '<button class="btn btn-primary" type="submit" name="excluir_pasta">Excluir</button>';}?> 
				<?php if($editar=="s"){ echo '<button class="btn btn-primary" type="submit" name="renomear_pasta">Renomear</button>';}?> 
				
				
			  </div>
		 </form>
        </div>
      </div>
    </div>
		    <div class="modal fade" id="modal_compartilharPasta"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Compartilhar pasta </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
		  <div class="modal-body">
		  <button type="button" class="btn" style="    color: #333;
    background-color: #fff;
    border-color: #ccc;" onclick="Mudarestado('link')" ><i class="fa fa-fw fa-link"></i>Link compartilhável</button>
	<div id="link" style="display:none;">
				<p class="help-block">Pessoas com esse link irão poder: <select class="form-control" onchange='MudarLink(this.value)' id="mudarLInk"><option  value='1'>Visualizar</option><option value='2'>Editar</option><option value='3'>Editar e Excluir</option></select></p>

<label>Link</label>
				<input class="form-control" type="text" id="link_input"  disabled >
				<input class="form-control" type="hidden" id="caminho_anterior_pasta_compar" name="caminho_anterior_pasta">
				<input class="form-control" type="hidden" id="hash" name="hash">
				<hr>
				</div>
				<br>
				<label>Pessoas</label>
				<input class="form-control" type="text" placeholder="Digite o email da pessoa">
				<div class="card-body small bg-faded">
                <div class="media">
                 
				  <div style="width: 45px;
	height: 45px;
	background: #696969;" class="d-flex mr-3">
	<h3 style="margin-top:5px;margin-left:12px;color:#fff;">G</h3>
				  </div>
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"><a href="#">Gustavo</a> <a class="fa fa-trash-o" style="float:right;margin-right:200px;" ></a></h6>g.pendeza@gmail.com
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item">
                        <a ><b>Editar</b> <input type="checkbox" id="toggleNavColor"> <b>Excluir</b> <input type="checkbox" id="toggleNavColor"></a>
                      </li>
                    </ul>
                    </div>
                </div>
              </div>
			  <div class="card-body small bg-faded">
                <div class="media">
                 
				  <div style="width: 45px;
	height: 45px;
	background: #696969;" class="d-flex mr-3">
	<h3 style="margin-top:5px;margin-left:15px;color:#fff;">J</h3>
				  </div>
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"><a href="#">Jose</a> <a class="fa fa-trash-o" style="float:right;margin-right:200px;" ></a></h6>jose@gmail.com
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item">
                        <a ><b>Editar</b> <input type="checkbox" id="toggleNavColor"> <b>Excluir</b> <input type="checkbox" id="toggleNavColor"></a>
                      </li>
                    </ul>
                    </div>
                </div>
              </div>
		  </div>
			  <div class="modal-footer">
			  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
			<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal_compartilharPasta">Compartilhar</button>
			
				
				
			  </div>
	    </div>
      </div>
    </div>
	    <div class="modal fade" id="modal_excluirArquivo"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Oque deseja fazer com esse arquivo ?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
		 <form action="controle_de_arquivos.php" method="POST">
			  <div class="modal-body">
			 <label>Nome</label>
												<input class="form-control" type="text" id="nome_anterior_arquivo" name="caminho_novo_arquivo">
												<input class="form-control" type="hidden" id="caminho_anterior_arquivo" name="caminho_anterior_arquivo">
												<input class="form-control" type="hidden" id="nome_anterior_d_arquivo" name="nome_anterior_arquivo">
												<input class="form-control" type="hidden" id="caminho_atual_arquivo" name="caminho_atual_arquivo">
												<input class="form-control" type="hidden" id="ext" name="extensao">
												<input class="form-control" type="hidden" value="1" name="paginalink">
													<p class="help-block">Os nomes de arquivos e ou pastas não podem conter nenhum dos seguintes caracteres: /\:*?`´^~@|</p>
											
			  </div>
			  <div class="modal-footer">
			  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
				<?php if($excluir=="s"){ echo '<button class="btn btn-primary" type="submit" name="excluir_arquivo">Excluir</button>';}?> 
				<?php if($editar=="s"){ echo '<button class="btn btn-primary" type="submit" name="renomear_arquivo">Renomear</button>';}?> 
				
				
			  </div>
		 </form>
        </div>
      </div>
    </div>
     <div class="modal fade" id="modalPasta"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nova pasta</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
		  <form action="criar_pasta.php" method="POST">
			  <div class="modal-body">
			  <div class="form-group">
			  
												<label>Nome</label>
												<input class="form-control" placeholder="Digite o nome da pasta" name="nome_pasta" type="text" onkeypress="return sem_acento(event);" autofocus>
												<input class="form-control" id="caminho" name="caminho" type="hidden" >
												<p class="help-block">Os nomes de arquivos e ou pastas não podem conter nenhum dos seguintes caracteres: /\:*?`´^~@|</p>
											</div>
			  </div>
			  <div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary" name="nova_pasta">Criar</button>
			  </div>
		  </form>
        </div>
      </div>
    </div>
	   <div class="modal fade" id="modalArquivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Novo arquivo</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
		  <form action="novo_arquivo.php" method="POST" enctype='multipart/form-data'>
		  <div class="modal-body">
			<div class="form-group">
                                            
                                            <input type="file" class="btn" style="    color: #333;
    background-color: #fff;
    border-color: #ccc;" name="arquivo">
	<input class="form-control" id="caminho_arquivo" name="caminho_arquivo" type="hidden" >
                                        </div>
		  </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-primary" type="submit" name="novo_arquivo">Confirmar</button>
          </div>
		  </form>
        </div>
      </div>
    </div>
	<div class="modal fade" id="modalArquivoexistente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">O arquivo <?php if(isset($_SESSION["nome_arquivo"])){ echo "( ".$_SESSION["nome_arquivo"]." )"; } ?> já existe !</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
		   <div class="modal-body">
		 
		   
			<?php
		if(isset($_SESSION["nome_arquivo"])){
			$diferenca=$_SESSION["diferenca"];
			$nome_arquivo_atual=$_SESSION["nome_arquivo"];
			$formato=".".$_SESSION["extensao"];
			$arquivo_anterior=$_SESSION["arquivo_anterior"];
			$caminho_filtrado=$_SESSION["caminho_filtrado"];
			$localizacao=$_SESSION["localizacao"];
			$arquivo=$_SESSION["arquivo"]['size'];
			$caminho_filtrado_somente=$_SESSION["caminho_filtrado_somente"];
			$array_formatos=array(".php", ".js", ".py", ".css", ".html", ".xhtml", ".js", ".cpp", ".c", ".json", ".java", ".bat", ".h", ".jar", ".jav", ".sql", ".inc", ".htaccess",".txt"); 
			  unset($_SESSION["nome_arquivo"]);
			  unset($_SESSION["diferenca"]);
			  unset($_SESSION["extensao"]);
			  unset($_SESSION["arquivo_anterior"]);
			  unset($_SESSION["caminho_filtrado"]);
			  unset($_SESSION["localizacao"]);
			  unset($_SESSION["arquivo"]);
			  unset($_SESSION["caminho_filtrado_somente"]);
			 
			    session_write_close();
			
		
			include_once "inc/conexao.php"; 
			$sql99 ="SELECT * FROM tb_arquivos_usuarios WHERE nome_arquivo='$nome_arquivo_atual' AND fk_usuario = '$id_usuario'";
			$controle_de_arquivos = $conex -> prepare($sql99);	
			$controle_de_arquivos -> execute();
			foreach($controle_de_arquivos as $c_d_a){
				$versao=$c_d_a['versao'];
				$copia=$c_d_a['copia'];
				$id_arquivo=$c_d_a['id_arquivos_usuarios'];
			}
			date_default_timezone_set('America/Sao_Paulo');
			$data_nova = date("d-m-Y");
			$versao_nova=$versao+1;
			$copia_nova=$copia+1;
			$novo_a_a=str_replace($formato,' ('.$copia_nova.')',$nome_arquivo_atual);
			$novo_a=$novo_a_a.$formato;
			if($versao>=1){
				$novo_v_pasta=str_replace($formato,'(Versoes)',$nome_arquivo_atual);
				$existe_versao=1;
			}
			else{
				$novo_v_pasta=str_replace($formato,'(Versoes)',$nome_arquivo_atual);
				$existe_versao=0;
			}
			
			$novo_v_v=str_replace($formato,' ('.$versao_nova.') - '.$data_nova.'',$nome_arquivo_atual);
			$novo_v=$novo_v_v.$formato;
			
			if (in_array($formato, $array_formatos)) { 
					echo '<label>Foram encontradas essas diferenças do arquivo antigo para o novo arquivo:</label><div style="border:1px solid black;overflow: scroll;height:300px;">'.$diferenca.'</div><br>
		
		<button style="background-color:#8B0000;width:15px; height:15px;border: 1px solid;"></button> Excluido <button style="background-color:#008000;width:15px; height:15px;border: 1px solid;"></button> Inserido <button style="background-color:black;width:15px; height:15px;border: 1px solid;"></button> Não modificado';
				}
			
			
			
			
		}
	?>
		
		
		
		
		<br>
		<label><b>Nome do novo arquivo</b> <?php echo $novo_a; ?></label>
		<label><b>Nome da nova versão</b> <?php echo $novo_v_pasta."/".$novo_v; ?></label>
		  </div>
		  <form action="controle_arquivos.php" method="POST" enctype='multipart/form-data'>
		   <div class="modal-footer">
		   <input type="hidden" name="arquivo_anterior" value="<?php echo $arquivo_anterior;?>">
		   <input type="hidden" name="caminho_filtrado" value="<?php echo $caminho_filtrado;?>">
		   <input type="hidden" name="localizacao" value="<?php echo $localizacao;?>">
		   <input type="hidden" name="arquivo" value="<?php echo $arquivo;?>">
		   <input type="hidden" name="nome_novo_arquivo" value="<?php echo $novo_a;?>">
		   <input type="hidden" name="caminho_filtrado_somente" value="<?php echo $caminho_filtrado_somente;?>">
		   <input type="hidden" name="copia_nova" value="<?php echo $copia_nova;?>">
		   <input type="hidden" name="versao_nova" value="<?php echo $versao_nova;?>">
		   <input type="hidden" name="id_arquivo" value="<?php echo $id_arquivo;?>">
		   <input type="hidden" name="nome_versao" value="<?php echo $novo_v_pasta;?>">
		   <input type="hidden" name="arquivo_temporario" value="<?php echo $nome_arquivo_atual;?>">
		   <input type="hidden" name="existe_versao" value="<?php echo $existe_versao;?>">
		   <input type="hidden" name="formato" value="<?php echo $formato;?>">
		   <input type="hidden" name="versao_ja_existe" value="<?php echo $novo_v;?>">
           <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
			<button class="btn btn-primary" type="submit" name="novo_arquivo" >Novo arquivo</button>
            
           <button class="btn btn-primary" type="submit" name="nova_versao" >Nova versão</button>
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
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="assets/js/script_compartilhados.js"></script>
	
    <script src="vendor/jquery/jquery.min.js"></script>
<script>
$.noConflict();
// Code that uses other library's $ can follow here.

</script>

<script type="text/javascript" >
    $(function() {
        $.contextMenu({
            selector: '.context-menu-one', 
            callback: function(key, options) {
                var m = "clicked: " + key;
               if(m=="clicked: edit"){
					$('#newarquivo').trigger('click');
				}
				if(m=="clicked: cut"){
					$('#newpasta').trigger('click');
				}				
            },
            items: {
                "edit": {name: "Novo arquivo", icon: "copy"},
                "cut": {name: "Nova pasta", icon: "paste"}
            }
        });

        $('.context-menu-one').on('click', function(e){
            console.log('clicked', this);
        })    
    });
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
	 <script src="js/pace.min.js"></script>
  </div>
</body>

</html>
