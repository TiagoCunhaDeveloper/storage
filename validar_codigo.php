<?php 
			include "inc/conexao.php";
			$email = $_GET['e'];
			$codigo = $_GET['c'];
			$data_atual = date("Y-m-d");
			$sqlVerificador  = $conex->prepare("SELECT * FROM tb_recuperacao  WHERE MD5(email) = '$email' AND codigo = '$codigo' AND
			data_expiracao >= '$data_atual'");
			$sqlVerificador->execute();
			$contar = $sqlVerificador->rowCount();
			
			if($contar == 1){
				session_start();
				$_SESSION['emailParaRecuperacao'] = $email;  
				$_SESSION['codigo_p'] = $codigo;
				header('Location: alterarSenha.php');
				exit;
			}else{
				header('Location: codigoExpirado.php');
			}
?>