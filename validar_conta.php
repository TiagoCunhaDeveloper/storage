<?php
	$hash=$_GET['h'];
	include 'inc/conexao.php';
	$sql5 = "UPDATE `tb_usuario` SET `status_email` = '1' WHERE `tb_usuario`.`hash_email` = '$hash'";
	$up_status = $conex->prepare($sql5);
	$up_status -> execute();
	
	echo "<script>
							window.location='contaAtivada.php';
						 </script>";
?>