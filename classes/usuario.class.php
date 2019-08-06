<?php
	class Usuario{
			public $nome_usu;
			public $sobrenome_usu;
			public $email_usu;
			public $senha_usu;
			public $tipo;
		
		public function cadastrar_usuario($nome_usu, $sobrenome_usu, $email_usu, $senha_usu){			
			try{				
				include "inc/conexao.php";
				$senha_c=MD5($senha_usu);
				$tipo=0;
				$estilo=0;
				$plano=4;
				$scan=0;
				$pastas=0;
				$preview=0;
				$status_email=0;
				$email_cript=MD5($email_usu);
				$sql = "INSERT INTO tb_usuario VALUES (?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?)";				
				$Usuarios = $conex->prepare($sql);				
				$Usuarios->execute(array('',$nome_usu, $sobrenome_usu, $email_usu, $senha_c, $tipo,$estilo,$preview,$plano,$scan,$pastas,$email_cript,$status_email));
				$sql5 = "SELECT id_usuario FROM tb_usuario ORDER BY id_usuario DESC LIMIT 1";
				$last_id = $conex->prepare($sql5);
				$last_id -> execute();
				foreach($last_id as $bola){
					$ultimo = $bola['id_usuario'];
				}				
				$cria_pasta=mkdir(__DIR__.'/../all_files/'.$ultimo.'/Meu armazenamento', 0777, true);
				$cria_pasta_arquivos_temporarios=mkdir(__DIR__.'/../arquivos_temporarios/'.$ultimo.'', 0777, true);
				$cria_pasta_lixeira=mkdir(__DIR__.'/../all_files/'.$ultimo.'/Lixeira', 0777, true);
				$cria_pasta_arquivos_zipados=mkdir(__DIR__.'/../arquivos_zipados/'.$ultimo.'', 0777, true);
				$conex=null;
				// ENVIO DE EMAIL PARA CONFIRMAÇÃO DE CONTA
				
				$emailsender = "contato@catalogotempario.com.br";
							
				$assunto   = "Confirmação de conta GT Storage"; #Variável para o assunto do E-mail.
					
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
												<h1>Confirmação de conta!</h1>
                                                  </td>
                                                 </tr>
                                                 <tr>
                                                  <td style="padding: 20px 0 30px 0;">
												Olá '.$nome_usu.', obrigado por se cadastrar no sistema GT Storage.<br>
												Para ativar sua conta <font style="font-weight: bold;"><a href="/validar_conta.php?h='.$email_cript.'">clique aqui</a></font>.
												<br>
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
                if(!mail($email_usu, $assunto, $mensagem, $headers ,"-r".$emailsender)){ // Se for Postfix
                    $headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "não for Postfix"
                    mail($email_usu, $assunto, $mensagem, $headers );
                }
				// FIM ENVIO DE EMAIL PARA CONFIRMAÇÃO DE CONTA	
				
				if($cria_pasta===true){
					if($cria_pasta_arquivos_temporarios===true){
						echo "<script>
							window.location='cadastrado.php';
						 </script>";	
					}
					
				}
				
				
						
			
			}catch (Exception $e) {			
				echo 'Exceção capturada: ',  
				$e->getMessage(), "\n";			
				
			}
		}	
	}
?>