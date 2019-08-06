<?php
     session_start();
     
         date_default_timezone_set("America/Sao_Paulo");
         include 'inc/conexao.php';
			
        
        if(isset($_POST['acao']) && $_POST['acao'] == 'recuperar'){
      	    $email = strip_tags(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
            $data_atual = date("Y-m-d");
			$sqlVerificador  = $conex->prepare("SELECT * FROM tb_recuperacao  WHERE email = '$email' AND
			data_expiracao >= '$data_atual'");
			$sqlVerificador->execute();
			$contar = $sqlVerificador->rowCount();
			$usu = $conex->prepare("SELECT * FROM tb_usuario WHERE email_usu = '$email'");
			$usu->execute();
			$contarUsuarios = $usu->rowCount();
		
		  if($contar > 0){
      	          $_SESSION['mensagem'] = 'Já existe uma solicitação de recuperação de senha para este e-mail!';    
      	          header("Location: forgot-password.php");
      	  }else{
			  if($contarUsuarios==0){
				   $_SESSION['mensagem'] = 'E-mail não cadastrado!';    
      	          header("Location: forgot-password.php");
			  }
			  else{
				  
			 
				$sql4 = "INSERT INTO tb_recuperacao VALUES (?, ?, ?, ?)";
          		$token = md5(uniqid(rand(), true));
          		$dt = date("Y-m-d");
          		$data_exp = date( "Y-m-d", strtotime( "$dt +1 day" ) ); 
          		$em = $conex->prepare($sql4);
          		$em->execute(array("", $email, $token, $data_exp));
          		$emd5 = md5($email); 
				$sql = "SELECT * FROM tb_usuario WHERE  email_usu = '$email'";
         					
        					$in = $conex -> prepare($sql);	
        					$in -> execute();		
     
        					foreach($in as $dados){
        						$nome = $dados['nome_usu'];
        					}
							
							$emailsender = "contato@catalogotempario.com.br";
							
							$assunto   = "Recuperação de senha GT Storage"; #Variável para o assunto do E-mail.
							
							$mensagem = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                        <html xmlns="http://www.w3.org/1999/xhtml">
                                         <head>
                                          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                          <title>GT Storage</title>
                                          <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
										  <link href="https://fonts.googleapis.com/css?family=Encode+Sans:300,400,600" rel="stylesheet">
										  <style>*{font-family: "Encode Sans", sans-serif;line-height: 28px;}</style>
                                        </head>
                                        <body style="margin: 0; padding: 0;">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                                        <td align="center" bgcolor="#343a40" style="padding: 40px 0 30px 0;">
                                         <img src="/imagens_sistema/logo_email.png" alt="GT Storage" width="250" height="86.4" style="display: block;" />
                                        </td>
                                         <tr>
                                             <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                                                  <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                   <tr>
                                                    <td>
														<h1>Recuperação de senha!</h1>
                                                    </td>
                                                   </tr>
                                                   <tr>
                                                    <td style="padding: 20px 0 30px 0;">
														Olá '.$nome.', este é um e-mail de recuperação de senha do sistema GT Storage.<br>
														Para recuperar sua senha <font style="font-weight: bold;"><a href="/validar_codigo.php?e='.$emd5.'&c='.$token.'">clique aqui</a></font> e escolha uma nova senha.
														<br>Caso não tenha solicitado a recuperação de senha, ignore este e-mail.
                                                    </td>
                                                   </tr>
                                                  </table>
                                             </td>
                                         </tr>
                                         <tr>
											<td bgcolor="#343a40" style="padding: 30px 30px 30px 30px;">
											 <table border="0" cellpadding="0" cellspacing="0" width="100%">
												 <tr>
													<td width="75%">
													 <font color="#FFFFFF">&reg; GT Storage 2018<br/></font>
													
													</td>
													<td align="right">
													</td>
												 </tr>
												</table>

											</td>
                                         </tr>
                                        </table>
                                        </body>
                                        </html>';
			// Este sempre deverá existir para garantir a exibição correta dos caracteres
                		$headers = "MIME-Version: 1.1\n";
                		 
                		// Para enviar o e-mail em formato texto com codificação de caracteres Europeu Ocidental (usado no Brasil)
                		//$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
                		 
                		// Para enviar o e-mail em formato HTML com codificação de caracteres Europeu Ocidental (usado no Brasil)
                		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
                		 
                		// Para enviar o e-mail em formato HTML com codificação de caracteres Unicode (Usado em todos os países)
                		//$headers .= "Content-type: text/html; charset=utf-8\n";
                		 
                		// E-mail que receberá a resposta quando se clicar no 'Responder' de seu leitor de e-mails
                		$headers .= "Reply-To: GT Storage<contato@catalogotempario.com.br>\n";
                		 
                		// para enviar a mensagem em prioridade máxima
                		$headers .= "X-Priority: 1\n";
                		 
                		// para enviar a mensagem em prioridade mínima
                		$headers .= "X-Priority: 5\n";
                		 
                		// para enviar a mensagem em prioridade normal (valor padrão caso não seja especificada)
                		$headers .= "X-Priority: 3\n";
                		if(!mail($email, $assunto, $mensagem, $headers ,"-r".$emailsender)){ // Se for Postfix
                		    $headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "não for Postfix"
                		    mail($email, $assunto, $mensagem, $headers );
                		}						
						echo "<script>
                              window.location.href='solicitacao_senha.php';
                         </script>";
}
	
    		
                		
		  }
		   }
		  
?>