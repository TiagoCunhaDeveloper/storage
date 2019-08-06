<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();
include "inc/conexao.php";
$plano = $_GET['plano'];
$data =date('d/m/Y');
$status=0;
$data_aprov = null;
$id_usuario_p=$_SESSION['id_usuario'];
$sql = "SELECT * FROM tb_planos_usuarios WHERE fk_usuario='$id_usuario_p' AND plano='$plano' AND status=0";
$planos_cli = $conex -> prepare($sql);
$planos_cli -> execute();
$count_plano= $planos_cli->rowCount();
if($count_plano==1){
	
}
else{
	$sql1 = "INSERT INTO tb_planos_usuarios VALUES (?,?,?,?,?,?)";
	$plan = $conex -> prepare($sql1);	
	$plan -> execute(array("", $plano,$status,$data,$data_aprov,$id_usuario_p));
}
?>