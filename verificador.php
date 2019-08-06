<?php 
session_start();
			include "inc/conexao.php";
			$senha = $_POST['senha'];
			$conf = $_POST['conf'];
			$email = $_POST['email'];
			$codigo = $_SESSION['codigo_p'];
			
			
			if($senha == $conf){
				if(strlen($senha) >= 8){
					$senhamd5 = md5($senha);

					
					$query = "UPDATE tb_usuario SET senha_usu = '$senhamd5' WHERE MD5(email_usu) = '$email'";
					
					/*----------------------------------------------------*/
					$sql  = $conex->prepare($query);
					$sql->execute();
					
			              unset($_SESSION["emailParaRecuperacao"]); 
			              unset($_SESSION["codigo_p"]);
			         
			          $query = "DELETE FROM tb_recuperacao WHERE codigo = '$codigo' AND MD5(email) = '$email'";
			          
			          $sql2  = $conex->prepare($query);
								$sql2->execute();
	            	
	            
	             echo "<script>
							window.location='index.php';
							alert('Senha alterada com sucesso!');
						 </script>";	
					}
				else{
				     $_SESSION['mensagem'] = 'Senhas muito curta, insira mais que 5 caracteres!';    
   		 		   header('Location: alterarSenha.php');	
				}
			}else{
				     $_SESSION['mensagem'] = 'Senhas não conferem!';    
   		 		   header('Location: alterarSenha.php');	
			}
			
?>