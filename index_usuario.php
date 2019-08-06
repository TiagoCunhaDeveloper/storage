<!DOCTYPE html>
<?php
session_start();
	@$tipo=$_SESSION["tipo"];
	@$id_usuario=$_SESSION["id_usuario"];
include "inc/conexao.php"; 
	$sql ="SELECT * FROM tb_usuario WHERE id_usuario = '$id_usuario'";
	$usu = $conex -> prepare($sql);	
	$usu -> execute();
	foreach($usu as $u){
		$estilo=$u['estilo'];
		$qtd_pastas=$u['qtd_pastas'];
		$preview=$u['preview'];
		$emailUsu=$u['email_usu'];
	}
		$sql ="SELECT * FROM tb_arquivos_usuarios WHERE fk_usuario = '$id_usuario'";
	$arquivos_gerais = $conex -> prepare($sql);	
	$arquivos_gerais -> execute();
	$qtd_arquivos = $arquivos_gerais->rowCount();
 ?>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>My storage</title>
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
  	<style>
	#hoverimg{
		display:none;
	}
	
	#teste66{
		display:none;
	}
	<?php 
		if($preview==1){
			echo "#hoverdnv:hover #hoverimg{
		display:block;
	}
	
	";
		}
	?>
	
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
	
		if (x.indexOf("#search") != -1){
			document.getElementById("caminho_atual_arquivo").value="";
			 document.getElementById("caminho_atual_pasta").value="";
			 document.getElementById("caminhoAtual").value="";
			 document.getElementById("caminhoAtualA").value="";
		}
		else{
			document.getElementById("caminho_atual_arquivo").value=x;
			 document.getElementById("caminho_atual_pasta").value=x;
			 document.getElementById("caminhoAtual").value=x;
			 document.getElementById("caminhoAtualA").value=x;
		}
	 	 document.getElementById("caminho_atual_arquivo_compa").value=x;
	 

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
	var	caminho_filtrado = hash.replace('#Meu%20armazenamento', '');
	var	caminho_filtrado_1 = caminho_filtrado.replace(/%2F/g, "/");
	var	caminho_filtrado_2 = caminho_filtrado_1.replace(/%20/g, ' ');
	var	caminho_filtrado_final=caminho_filtrado_2+"/";
	var res = x.replace("Meu armazenamento"+caminho_filtrado_final+"", "");
	var array = x.split('/');
	var ultimo = array[array.length - 1];
	if (hash.indexOf("#search") != -1){
		res=ultimo;
	}
	document.getElementById("nome_anterior").value=res;
	document.getElementById("nome_anterior_d").value=res;
	document.getElementById("caminho_anterior_pasta").value=x;
	document.getElementById("caminho_anterior_pasta_compar").value=x;
	document.getElementById("caminho_anterior_pasta_compart").value=x;
	document.getElementById("nome_folder").value=res;
	document.getElementById("nomePastaCompart").value=res;
		$.ajax
         ({
         type:'POST',
         url:'ajax_verificacao_compart.php',
         data:'caminho='+x,
         success:function(html)
         {
         
         $('#compart').html(html);
         
         }
		  });
		  
	$('#clica2').trigger('click');
}
function myFunction2(as) {
	var x=as;
	var id= <?php echo $id_usuario;?>;
	var hash = location.hash;
	var	caminho_filtrado = hash.replace('#Meu%20armazenamento', '');
	var	caminho_filtrado_1 = caminho_filtrado.replace(/%2F/g, "/");
	var	caminho_filtrado_2 = caminho_filtrado_1.replace(/%20/g, ' ');
	var	caminho_filtrado_final=caminho_filtrado_2+"/";
	var res = x.replace("all_files/"+id+"/Meu armazenamento"+caminho_filtrado_final+"", "");
	var array = x.split('/');
	var ultimo = array[array.length - 1];
	if (hash.indexOf("#search") != -1){
		res=ultimo;
	}
	document.getElementById("nome_anterior_arquivo").value=res;
	document.getElementById("nome_anterior_d_arquivo").value=res;
	document.getElementById("nome_anterior_d_arquivo_compa").value=res;
	document.getElementById("caminho_anterior_arquivo").value=x;
	document.getElementById("caminho_anterior_arquivo_compart").value=x;
	document.getElementById("nome_arquivo_compart").value=res;
	var ext = res.split('.').pop();
	document.getElementById("ext").value=ext;
	var exMusicas=['mp3','ogg','midi'];
	var exVideos=['mp4','webm','ogg'];
	if(exMusicas.indexOf(ext) > -1){
		document.getElementById("musica").style.display="block";
		document.getElementById("video").style.display="none";
	}
	else{
		if(exVideos.indexOf(ext) > -1){
			document.getElementById("video").style.display="block";
			document.getElementById("musica").style.display="none";
			var conteudo = document.getElementById("conteuVideo");
			conteudo.innerHTML = "<center><video width='470' height='350' controls id='videoHtml'><source src='"+x+"' ></video></center>";
		}
		else{
			document.getElementById("video").style.display="none";
			document.getElementById("musica").style.display="none";
		}
		
	}
	$.ajax
         ({
         type:'POST',
         url:'ajax_verificacao_compart_a.php',
         data:'caminho='+x,
         success:function(html)
         {
         
         $('#compart1').html(html);
         
         }
		  });
   $('#clica3').trigger('click');
  
}
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>

function Mudarestado(el) {
	var estadoatual= document.getElementById(el).style.display;
	if(estadoatual=="block"){
		document.getElementById(el).style.display = 'none';
		document.getElementById('link_input').value =" ";
		document.getElementById('mudarLInk').value = 0;
	}else{
		document.getElementById(el).style.display = 'block';
	}
	var caminho_link=document.getElementById("caminho_anterior_pasta_compar").value;
	var nome_folder_link=document.getElementById("nomePastaCompart").value;
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
   url: 'ajax_link.php?caminho_link='+caminho_link+'&hash='+hash+'&nome_folder_link='+nome_folder_link,
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
	
	$( "#mudarLInk" ).change(function() {
		var link =$(this).val();
			switch(link){
			case '2':
				document.getElementById('link_input').value="http://127.0.0.1:85/Storage/link_p.php?c="+hash+"&ed=e9064b74d28acc053231170bb8c858b3&e=4f876ab4493c98f6e241355c57136259";
			break;
			case '3':
				document.getElementById('link_input').value="http://127.0.0.1:85/Storage/link_p.php?c="+hash+"&ed=e9064b74d28acc053231170bb8c858b3&e=e9064b74d28acc053231170bb8c858b3";
			break;
			default:
			document.getElementById('link_input').value="http://127.0.0.1:85/Storage/link_p.php?c="+hash+"&ed=4f876ab4493c98f6e241355c57136259&e=4f876ab4493c98f6e241355c57136259";
		}
	});
    }
	function voltaraonormal() {
		document.getElementById('link').style.display = 'none';
		document.getElementById('mudarLInk').value = 0;
		document.getElementById('link_input').value =" ";
	
	}
</script>
<script>

function Mudarestadolinkarquivo(el) {
	var estadoatual= document.getElementById(el).style.display;
	if(estadoatual=="block"){
		document.getElementById(el).style.display = 'none';
		document.getElementById('mudarLInk_arquivo').value = 0;
		document.getElementById('link_input_arquivo').value =" ";
	}else{
		document.getElementById(el).style.display = 'block';
	}
	var caminho_link_a=document.getElementById("caminho_atual_arquivo_compa").value;
	var caminho_link_a_f=caminho_link_a.replace('#', '');
	var nome_arquivo_link=document.getElementById("nome_anterior_d_arquivo_compa").value;
	function guids() {
		  return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
			s4() + '-' + s4() + s4() + s4();
		}

		function s4() {
		  return Math.floor((1 + Math.random()) * 0x10000)
			.toString(16)
			.substring(1);
	}
	var hash_a=guids();
	document.getElementById("hashArquivo").value=hash_a;
   	$.ajax({
   url: 'ajax_link_a.php?caminho_link_a='+caminho_link_a_f+'&hash_a='+hash_a+'&nome_arquivo_link='+nome_arquivo_link,
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
	
	$( "#mudarLInk_arquivo" ).change(function() {
		var link =$(this).val();
			switch(link){
			case '2':
				document.getElementById('link_input_arquivo').value="http://127.0.0.1:85/Storage/link_p.php?c="+hash_a+"&ed=e9064b74d28acc053231170bb8c858b3&e=4f876ab4493c98f6e241355c57136259&a=e9064b74d28acc053231170bb8c858b3";
			break;
			case '3':
				document.getElementById('link_input_arquivo').value="http://127.0.0.1:85/Storage/link_p.php?c="+hash_a+"&ed=e9064b74d28acc053231170bb8c858b3&e=e9064b74d28acc053231170bb8c858b3&a=e9064b74d28acc053231170bb8c858b3";
			break;
			default:
			document.getElementById('link_input_arquivo').value="http://127.0.0.1:85/Storage/link_p.php?c="+hash_a+"&ed=4f876ab4493c98f6e241355c57136259&e=4f876ab4493c98f6e241355c57136259&a=e9064b74d28acc053231170bb8c858b3";
		}
	});
    }
	function voltaraonormalArquivo() {
		document.getElementById('linkarquivo').style.display = 'none';
		document.getElementById('mudarLInk_arquivo').value = 0;
		document.getElementById('link_input_arquivo').value =" ";
	}
</script>
<script>
	function playMusic(){
		  $('#playPause').trigger('click');
	}
	function StopMusic(){
		$('#stop').trigger('click');
		document.getElementById('volume').value = 0.2;
	}
	function playVideo(){
		var vid = document.getElementById("videoHtml"); 
		vid.play();
		vid.volume = 0.2;
	}
	function stopVideo(){
		var vid = document.getElementById("videoHtml"); 
		vid.pause();
	}
</script>
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
<script type="text/javascript" src="funcs.js"></script>
<link rel="stylesheet" href="jquery.typeahead.css">

    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script src="jquery.typeahead.js"></script>
	<script>
    function ajax_cancelarCopart(numero){
      var caminhoRecupera=document.getElementById("caminhoRecupera").value;
	 
      $.ajax
         ({
         type:'POST',
         url:'ajax_cancelarCopart.php',
         data:'id='+numero+'&caminho='+caminhoRecupera,
         success:function(html)
         {
         
         $('#compart').html(html);
         
         }
		  });
    }
	 function ajax_cancelarCoparta(numero){
      var caminhoRecupera=document.getElementById("caminhoRecupera").value;
	 
      $.ajax
         ({
         type:'POST',
         url:'ajax_cancelarCopart.php',
         data:'id='+numero+'&caminho='+caminhoRecupera,
         success:function(html)
         {
         
         $('#compart1').html(html);
         
         }
		  });
    }
    </script>
	<script type="text/javascript">
          function ajax_o(opcao){
         	
		 
        var caminhoRecupera=document.getElementById("caminhoRecupera").value;
		
         $.ajax
         ({
         type:'POST',
         url:'ajaxOpcoesCompart.php',
         data:'opcao='+opcao+'&caminho='+caminhoRecupera,
         success:function(html)
         {
         
         
         }
         
         
         });
        
         
         	}
		  
      </script>
</head>

<body <?php if(@$estilo==0){echo'class="fixed-nav sticky-footer bg-dark"';}else{ echo'class="fixed-nav sticky-footer bg-light"';}?> id="page-top" onselectstart="return false" oncontextmenu="return false" ondragstart="return false" onMouseOver="window.status='..message perso .. '; return true;">
  <!-- Navigation-->
<?php
	$menu=1;
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
			<input type="search" class="form-control" placeholder="Procurar arquivo e/ou pasta.." /><br>
			<button type="button" class="btn" style="    color: #333;
    background-color: #fff;
    border-color: #ccc;" data-toggle="modal" data-target="#modalPasta" onclick="boasvindas();" id="newpasta"><i class="fa fa-folder-open" aria-hidden="true"></i> Nova pasta</button> 
	<button type="button" class="btn" style="    color: #333;
    background-color: #fff;
    border-color: #ccc;" data-toggle="modal" data-target="#modalArquivo" onclick="boasvindas();" id="newarquivo"><i class="fa fa-file" aria-hidden="true"></i> Novo arquivo</button>
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
		<div class="card-footer small text-muted">Total: <?php if ($total_pastas==1 && $tamanho_arquivo ==1 ){ echo $total_pastas." Pasta | ".$tamanho_arquivo." Arquivo"; }else { echo $total_pastas." Pastas | ".$tamanho_arquivo." Arquivos";} ?></div>
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
												<input class="form-control" type="hidden" id="verificadorCompartF" name="verificadorCompartF" value="0">
													<p class="help-block">Os nomes de arquivos e ou pastas não podem conter nenhum dos seguintes caracteres: /\:*?`´^~@|</p>
											<p class="help-block">Ao excluir uma pasta todos os arquivos contidos nela serão perdidos.</p>
											
			  </div>
			  <div class="modal-footer">
			  <button class="btn btn-secondary" type="button" data-dismiss="modal" onClick="voltaraonormal()">Cancelar</button>
				<button class="btn btn-primary" type="submit" name="excluir_pasta" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ao excluir uma pasta compartilhada o compartilhamento é perdido.">Excluir</button>
				<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal_compartilharPasta">Compartilhar</button>
				<button class="btn btn-primary" type="submit" name="renomear_pasta">Renomear</button>
				
				
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
				<p class="help-block">Pessoas com esse link irão poder: <select class="form-control"  id="mudarLInk"><option selected disabled value="0">Selecione..</option><option  value='1'>Visualizar</option><option value='2'>Editar</option><option value='3'>Editar e Excluir</option></select></p>

<label>Link</label>
				<input class="form-control" type="text" id="link_input"  disabled >
				<input class="form-control" type="hidden" id="caminho_anterior_pasta_compar" name="caminho_anterior_pasta">
				<input class="form-control" type="hidden" id="hash" name="hash">
				<input class="form-control" type="text" id="nomePastaCompart" name="nome_pastaCompart">
				<hr>
				</div>
				<br>
				<label>Pessoas</label>
				<form action="compartilharTudo.php" method="POST">
        <div class="typeahead__container">
            <div class="typeahead__field">

            <span class="typeahead__query">
                <input class="js-typeahead"
                       name="q"
                       type="search"
                       autofocus
                       autocomplete="off">
            </span>
			<select  class="form-control" style="width:120px;" name="opcoesCompar">
                                                
                                                <option selected value='0'>Visualizar</option>
                                                <option value='1'>Editar</option>
                                                <option value='2'>Editar e excluir</option>
                                               
                                            </select>
               
            </span>
<input type="hidden" id="resultado" name="resultado">
<input type="hidden" id="caminho_anterior_pasta_compart" name="caminhoCompart">
<input type="hidden"  name="tipoFolder" value="0">
<input type="hidden"  name="nome_folder" id="nome_folder">
<input type="hidden"  name="caminhoAtual" id="caminhoAtual">
            </div>
			
        </div>
   <div id="compart">
			
			</div>

				
			  
		  </div>
			  <div class="modal-footer">
			  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
			<button class="btn btn-primary" type="submit" >Compartilhar</button>
			
				
				
			  </div>
			   </form>
			   			   <script>

        var data = [
		<?php 
			$sqlU ="SELECT * FROM tb_usuario WHERE email_usu <> '$emailUsu' ORDER BY nome_usu";
			$all_users = $conex -> prepare($sqlU);	
			$all_users -> execute();
			foreach($all_users as $al_u){
				$id_usuario_c=$al_u['id_usuario'];
				$nome_usu_c=$al_u['nome_usu'];
				$email_usu_c=$al_u['email_usu'];
				
				echo '{
            "id": "'.$id_usuario_c.'",
            "name": "'.$nome_usu_c.'",
            "email": "'.$email_usu_c.'"
        },';
			}
		?>
			];

        typeof $.typeahead === 'function' && $.typeahead({
            input: ".js-typeahead",
            minLength: 1,
            maxItem: 8,
            maxItemPerGroup: 6,
            order: "asc",
            hint: true,
            searchOnFocus: true,
            multiselect: {
//                limit: 2,
//                limitTemplate: 'You can\'t select more than 2 teams',
                matchOn: ["id", "email"],
                cancelOnBackspace: true,
//                href: '/{{name}}.html',
//                data: [{
//                    "matchedKey": "name",
//                    "name": "Canadiens",
//                    "img": "canadiens",
//                    "city": "Montreal",
//                    "id": "MTL",
//                    "conference": "Eastern",
//                    "division": "Northeast",
//                    "group": "teams"
//                }],
               
                callback: {
                    onClick: function (node, item, event) {
                        event.preventDefault();
                        console.log(item);
                        alert('Email: '+item.email);
                    },
                    onCancel: function (node, item, event) {
                        console.log(item)
                    }
                }
            },
            templateValue: "{{name}}",
            display: ["email"],
            emptyTemplate: 'nemhum resultado para {{query}}',
            source: {
                teams: {
                    data: data
                }
            },
            callback: {
                onSubmit: function (node, form, item, event) {
                    event.preventDefault();
					var resultado =JSON.stringify(item) ;
					
					document.getElementById("resultado").value=resultado;
					form.submit();
                }
            }
        });

    </script>	
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
												<input class="form-control" type="hidden" id="verificadorCompartFa" name="verificadorCompartF" value="0">
													<p class="help-block">Os nomes de arquivos e ou pastas não podem conter nenhum dos seguintes caracteres: /\:*?`´^~@|</p>
											
			  </div>
			  <div class="modal-footer">
			  <button class="btn btn-secondary" type="button" data-dismiss="modal" onClick="voltaraonormalArquivo()">Cancelar</button>
				<button class="btn btn-primary" type="submit" name="excluir_arquivo" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ao excluir um arquivo compartilhado o compartilhamento é perdido.">Excluir</button>
				<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal_compartilharArquivo">Compartilhar</button>
				<button class="btn btn-primary" type="submit" name="renomear_arquivo">Renomear</button>
				<button class="btn btn-primary" type="button" style="display:none;" id="musica" data-toggle="modal" data-target="#modalMusica" onClick="playMusic()"><i class="fa fa-play-circle-o" aria-hidden="true"></i></button>
				<button class="btn btn-primary" type="button" style="display:none;" id="video" data-toggle="modal" data-target="#modalVideo" onClick="playVideo()"><i class="fa fa-play-circle-o" aria-hidden="true"></i></button>
				
			  </div>
		 </form>
        </div>
      </div>
    </div>
		    <div class="modal fade" id="modal_compartilharArquivo"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Compartilhar arquivo </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
		  <div class="modal-body">
		  <button type="button" class="btn" style="    color: #333;
    background-color: #fff;
    border-color: #ccc;" onclick="Mudarestadolinkarquivo('linkarquivo')" ><i class="fa fa-fw fa-link"></i>Link compartilhável</button>
	<div id="linkarquivo" style="display:none;">
				<p class="help-block">Pessoas com esse link irão poder: <select class="form-control"  id="mudarLInk_arquivo"><option selected disabled value="0">Selecione..</option><option  value='1'>Visualizar</option><option value='2'>Editar</option><option value='3'>Editar e Excluir</option></select></p>

<label>Link</label>
				<input class="form-control" type="text" id="link_input_arquivo"  disabled >
				<input class="form-control" type="hidden" id="nome_anterior_d_arquivo_compa" name="nome_anterior_arquivo">
				<input class="form-control" type="hidden" id="caminho_atual_arquivo_compa" name="caminho_atual_arquivo">
				<input class="form-control" type="hidden" id="hashArquivo" name="hashArquivo">
				<hr>
				</div>
				<br>
				<label>Pessoas</label>
								<form action="compartilharTudo.php" method="POST">
        <div class="typeahead__container">
            <div class="typeahead__field">

            <span class="typeahead__query">
                <input class="js-typeahead"
                       name="q"
                       type="search"
                       autofocus
                       autocomplete="off" id="headytpe">
            </span>
			<select  class="form-control" style="width:120px;" name="opcoesCompar">
                                                
                                                <option selected value='0'>Visualizar</option>
                                                <option value='1'>Editar</option>
                                                <option value='2'>Editar e excluir</option>
                                               
                                            </select>
               
            </span>
<input type="hidden" id="resultadoA" name="resultado">
<input type="hidden" id="caminho_anterior_arquivo_compart" name="caminhoCompart">
<input type="hidden"  name="tipoFolder" value="1">
<input type="hidden"  name="nome_folder" id="nome_arquivo_compart">
<input type="hidden"  name="caminhoAtual" id="caminhoAtualA">
            </div>
        </div>
   <div id="compart1">
			
			</div>

				
			  
		  </div>
			  <div class="modal-footer">
			  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
			<button class="btn btn-primary" type="submit" >Compartilhar</button>
			
				
				
			  </div>
			   </form>
			   			   <script>

        var data = [
		<?php 
			$sqlU ="SELECT * FROM tb_usuario WHERE email_usu <> '$emailUsu' ORDER BY nome_usu";
			$all_userss = $conex -> prepare($sqlU);	
			$all_userss -> execute();
			foreach($all_userss as $al_uu){
				$id_usuario_c=$al_uu['id_usuario'];
				$nome_usu_c=$al_uu['nome_usu'];
				$email_usu_c=$al_uu['email_usu'];
				
				echo '{
            "id": "'.$id_usuario_c.'",
            "name": "'.$nome_usu_c.'",
            "email": "'.$email_usu_c.'"
        },';
			}
		?>
			];

        typeof $.typeahead === 'function' && $.typeahead({
            input: "#headytpe",
            minLength: 1,
            maxItem: 8,
            maxItemPerGroup: 6,
            order: "asc",
            hint: true,
            searchOnFocus: true,
            multiselect: {
//                limit: 2,
//                limitTemplate: 'You can\'t select more than 2 teams',
                matchOn: ["id", "email"],
                cancelOnBackspace: true,
//                href: '/{{name}}.html',
//                data: [{
//                    "matchedKey": "name",
//                    "name": "Canadiens",
//                    "img": "canadiens",
//                    "city": "Montreal",
//                    "id": "MTL",
//                    "conference": "Eastern",
//                    "division": "Northeast",
//                    "group": "teams"
//                }],
               
                callback: {
                    onClick: function (node, item, event) {
                        event.preventDefault();
                        console.log(item);
                        alert('Email: '+item.email);
                    },
                    onCancel: function (node, item, event) {
                        console.log(item)
                    }
                }
            },
            templateValue: "{{name}}",
            display: ["email"],
            emptyTemplate: 'nemhum resultado para {{query}}',
            source: {
                teams: {
                    data: data
                }
            },
            callback: {
                onSubmit: function (node, form, item, event) {
                    event.preventDefault();
					var resultado =JSON.stringify(item) ;
					
					document.getElementById("resultadoA").value=resultado;
					form.submit();
                }
            }
        });

    </script>	
		
		  </div>
			 
	    </div>
      </div>
    </div>
	<div class="modal fade" id="modalMusica"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Player</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
		
			  <div class="modal-body">
			<div id="wave" >
    <p id="progress">0</p>
</div>
<br>
<center>
<button id="playPause" class="btn" style="    color: #333;
    background-color: #fff;
    border-color: #ccc;"><i class='fa fa-pause' aria-hidden='true'></i></button>
<button id="stop" class="btn" style="    color: #333;
    background-color: #fff;
    border-color: #ccc;"><i class="fa fa-stop" aria-hidden="true"></i></button>
<button id="mute" class="btn" style="    color: #333;
    background-color: #fff;
    border-color: #ccc;"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
<input type="range" id="volume" min="0" value="0.2" max="1" step="0.1" class="btn" style="    color: #333;
    background-color: #fff;
    border-color: #ccc;">
	</center>
			  </div>
			  <div class="modal-footer">
			  <button class="btn btn-secondary" type="button" data-dismiss="modal" onClick="StopMusic()" >Cancelar</button>
			
			  </div>
		
        </div>
      </div>
    </div>
		<div class="modal fade" id="modalVideo"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Player</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
		
			  <div class="modal-body" id="conteuVideo">
				
			  </div>
			  <div class="modal-footer">
			  <button class="btn btn-secondary" type="button" data-dismiss="modal" onClick="stopVideo()"  >Cancelar</button>
			
			  </div>
		
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
												<input class="form-control" placeholder="Digite o nome da pasta" name="nome_pasta" type="text" onkeypress="return sem_acento(event);" style="text-transform:capitalize;" autofocus>
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
			function formatBytes($size, $precision = 2)
			{
				$base = log($size, 1024);
				$suffixes = array('', 'K', 'M', 'G', 'T');   

				return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
			}
			$diferenca_diff=$_SESSION["diferenca"];
			$nome_arquivo_atual=$_SESSION["nome_arquivo"];
			$formato=".".$_SESSION["extensao"];
			$arquivo_anterior=$_SESSION["arquivo_anterior"];
			$caminho_filtrado=$_SESSION["caminho_filtrado"];
			$localizacao=$_SESSION["localizacao"];
			$arquivo=$_SESSION["arquivo"]['size'];
			$caminho_filtrado_somente=$_SESSION["caminho_filtrado_somente"];
			$size_arquivo_destino=$_SESSION["size_arquivo_destino"];
			$size_novo_arquivo=$_SESSION["size_novo_arquivo"];
			$array_formatos=array(".php", ".js", ".py", ".css", ".html", ".xhtml", ".js", ".cpp", ".c", ".json", ".java", ".bat", ".h", ".jar", ".jav", ".sql", ".inc", ".htaccess",".txt"); 
			  unset($_SESSION["nome_arquivo"]);
			  unset($_SESSION["diferenca"]);
			  unset($_SESSION["extensao"]);
			  unset($_SESSION["arquivo_anterior"]);
			  unset($_SESSION["caminho_filtrado"]);
			  unset($_SESSION["localizacao"]);
			  unset($_SESSION["arquivo"]);
			  unset($_SESSION["caminho_filtrado_somente"]);
			  unset($_SESSION["size_arquivo_destino"]);
			  unset($_SESSION["size_novo_arquivo"]);
			 
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
			function criarCopia ($c,$f,$i,$fk,$cmf){
				do {
					$novo_a_a=str_replace($f,' ('.$i.')',$c);
					$novo_a=$novo_a_a.$f;
					$ae=file_exists("all_files/".$fk."/Meu armazenamento".$cmf.$novo_a);
					$i++;
				} while ($ae === true);
				return $novo_a;
			}
			$novo_a=criarCopia($nome_arquivo_atual,$formato,1,$id_usuario,$caminho_filtrado_somente);
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
			if($versao_nova > 1){
				$geral=$novo_v;
			}
			else{
				$geral=$novo_v_pasta."/".$novo_v;
			}
			if (in_array($formato, $array_formatos)) { 
					
				$diferenca='<div style="border:1px solid black;overflow: scroll;height:300px;">'.$diferenca_diff.'</div> <button style="background-color:#8B0000;width:15px; height:15px;border: 1px solid;"></button> Excluido <button style="background-color:#008000;width:15px; height:15px;border: 1px solid;"></button> Inserido <button style="background-color:black;width:15px; height:15px;border: 1px solid;"></button> Não modificado';
				
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
					
					$diferenca_m='<div><b>Arquivo atual</b><br><i class="fa fa-file-o fa-5x" aria-hidden="true"></i><br>'.formatBytes($size_arquivo_destino,0).'</div><div><b>Novo arquivo</b><br><i class="fa fa-file-o fa-5x" aria-hidden="true"></i><br>'.formatBytes($size_novo_arquivo,0).$tamnho.'</div>';
					$diferenca='<div align="center">'.$diferenca_m.'</div>';
					
				}
			
			echo '<label>Foram encontradas essas diferenças do arquivo antigo para o novo arquivo:</label>'.$diferenca.'<br>';
			
		}
	?>
		
		
		
		
		<br>
		<label><b>Nome do novo arquivo</b> <?php echo $novo_a; ?></label>
		<label><b>Nome da nova versão</b> <?php echo $geral; ?></label>
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
  <script src="js/wavesurfer.min.js"></script>
  <script>
  var wavesurfer   = Object.create(WaveSurfer);
var pausePlayBtn = document.getElementById('playPause');
var stopBtn      = document.getElementById('stop');
var mute      = document.getElementById('mute');
var volume      = document.getElementById('volume');
var musica      = document.getElementById('musica');

var progress     = document.getElementById('progress');
var isPaused     = true;

wavesurfer.init({
    container: document.querySelector('#wave'),
    waveColor: '#ccc',
    progressColor: 'black'
});

wavesurfer.on('loading', function (status) {
    if (status === 100) {
        progress.innerHTML = "";
    } else {
        progress.innerHTML = status + "%";
    }
	wavesurfer.setVolume(0.2);
	
});
	volume.onchange = function() {
	var novoVolume      = document.getElementById('volume').value;
		wavesurfer.setVolume(novoVolume);
	};
	mute.onclick = function() {
		var teste =wavesurfer.getMute();
		if(teste===false){
			mute.innerHTML = "<i class='fa fa-volume-off' aria-hidden='true'></i>";	
		}
		else{
			mute.innerHTML = "<i class='fa fa-volume-up' aria-hidden='true'></i>";	
		}
		wavesurfer.toggleMute();
  };
  
wavesurfer.on('ready', function () {
    isPaused = true;

  
    pausePlayBtn.innerHTML = "<i class='fa fa-pause' aria-hidden='true'></i>";

    pausePlayBtn.onclick = function() {
       isPaused = isPaused ? false : true;

       pausePlayBtn.innerHTML = isPaused ? "<i class='fa fa-pause' aria-hidden='true'></i>" : "<i class='fa fa-play' aria-hidden='true'></i>";
       wavesurfer.playPause();
    };
    
    stopBtn.onclick = function() {
       isPaused = false;
       pausePlayBtn.innerHTML = "<i class='fa fa-play' aria-hidden='true'></i>";
       wavesurfer.stop();
    };
});


musica.onclick = function() {
	  var musica = document.getElementById("caminho_anterior_arquivo").value;
		wavesurfer.load(''+musica+'');
	wavesurfer.on('ready', function () {
    wavesurfer.play();
});
  }
var slider = document.querySelector('#slider');

var zoomLevel = Number(10);
wavesurfer.zoom(zoomLevel);

// Equalizer
wavesurfer.on('ready', function () {
  var EQ = [
    {
      f: 32,
      type: 'lowshelf'
    }, {
      f: 64,
      type: 'peaking'
    }, {
      f: 125,
      type: 'peaking'
    }, {
      f: 250,
      type: 'peaking'
    }, {
      f: 500,
      type: 'peaking'
    }, {
      f: 1000,
      type: 'peaking'
    }, {
      f: 2000,
      type: 'peaking'
    }, {
      f: 4000,
      type: 'peaking'
    }, {
      f: 8000,
      type: 'peaking'
    }, {
      f: 16000,
      type: 'highshelf'
    }
  ];

  // Create filters
  var filters = EQ.map(function (band) {
    var filter = wavesurfer.backend.ac.createBiquadFilter();
    filter.type = band.type;
    filter.gain.value = 0;
    filter.Q.value = 1;
    filter.frequency.value = band.f;
    return filter;
  });

  // Connect filters to wavesurfer
  wavesurfer.backend.setFilters(filters);

  // Bind filters to vertical range sliders
  var container = document.querySelector('#equalizer');
  filters.forEach(function (filter) {
    var input = document.createElement('input');
    wavesurfer.util.extend(input, {
      type: 'range',
      min: -40,
      max: 40,
      value: 0,
      title: filter.frequency.value
    });
    input.style.display = 'inline-block';
    input.setAttribute('orient', 'vertical');
    wavesurfer.drawer.style(input, {
      'webkitAppearance': 'slider-vertical',
      width: '50px',
      height: '150px'
    });
    container.appendChild(input);

    var onChange = function (e) {
      filter.gain.value = ~~e.target.value;
    };

    input.addEventListener('input', onChange);
    input.addEventListener('change', onChange);
  });

  // For debugging
  wavesurfer.filters = filters;
});
  </script>
    <!-- Bootstrap core JavaScript-->
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="assets/js/script.js"></script>
	
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
