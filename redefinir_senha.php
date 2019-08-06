<?php
	include "inc/conexao.php"; 
	$id_usu=$_POST['id_usu'];
	$senha=MD5($_POST['senha']);
	$sql ="UPDATE `tb_usuario` SET `senha_usu` = '$senha' WHERE `tb_usuario`.`id_usuario` = $id_usu";
	$up_senha = $conex -> prepare($sql);	
	$up_senha -> execute();
	
		echo "<script>
							window.location='configuracoes.php';
							alert('Senha alterada com sucesso!');
						 </script>";	
?>