<?php
// Incluir aquivo de conexão
include "inc/conexao.php";
 
// Recebe o valor enviado
$valor = $_GET['valor'];
 
// Procura titulos no banco relacionados ao valor
$sql ="SELECT * FROM tb_usuario WHERE email_usu = '".$valor."'";
$noticias = $conex-> prepare($sql);
$noticias -> execute();
$count = $noticias->rowCount();
// Exibe todos os valores encontrados
if($count==0){
	
}
else{
	echo "<div class='form-control'>";
foreach($noticias as $n){
	$id=$n['id_usuario'];
	$titulo=$n['email_usu'];
	echo "<a href=\"javascript:func()\" onclick=\"exibirConteudo('".$id."')\">" . $titulo . "</a><br />";
}
echo "</div>";
}
// Acentuação
header("Content-Type: text/html; charset=ISO-8859-1",true);
?>