<?php
// Incluir aquivo de conexão
include "inc/conexao.php";
 
// Recebe a id enviada no método GET
$id = $_GET['id'];
 
// Seleciona a noticia que tem essa ID
$sql ="SELECT * FROM tb_usuario WHERE id_usuario = '".$id."'";
$usuarios_exibir = $conex-> prepare($sql);
$usuarios_exibir -> execute();	
// Pega os dados e armazena em uma variável
foreach($usuarios_exibir as $n_e){
	$nome_usu=$n_e['nome_usu'];
	$email=$n_e['email_usu'];
	$letra=substr($nome_usu,0,1);
	$id_usuario=$n_e['id_usuario'];
}
echo'	<div class="card-body small bg-faded">
                <div class="media">
                 
				  <div style="width: 45px;
	height: 45px;
	background: #696969;" class="d-flex mr-3">
	<h3 style="margin-top:5px;margin-left:12px;color:#fff;">'.strtoupper($letra).'</h3>
				  </div>
                  <div class="media-body">
				  <input type="hidden" value="'.$id_usuario.'">
                    <h6 class="mt-0 mb-1"><a href="#">'.$nome_usu.'</a> <a class="fa fa-trash-o" style="float:right;margin-right:200px;" ></a></h6>'.$email.'
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item">
                        <a ><b>Editar</b> <input type="checkbox" id="toggleNavColor"> <b>Excluir</b> <input type="checkbox" id="toggleNavColor"></a>
                      </li>
                    </ul>
                    </div>
                </div>
              </div>';
// Acentuação
header("Content-Type: text/html; charset=ISO-8859-1",true);
?>