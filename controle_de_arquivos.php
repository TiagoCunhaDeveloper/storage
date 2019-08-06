<?php
	if(isset($_POST['renomear_arquivo'])){
		session_start();
		if(isset($_POST['paginaCompart']) && $_POST['paginaCompart']==1 ){
			@$id_usua=$_POST["fk_usuarioCompart"];
		}
		else{
			@$id_usua=$_SESSION["id_usuario"];
		}
		@$arquivo_link=$_SESSION["arquivo_link"];
		@$tipo=$_SESSION["tipoFile"];
		@$arquivo_antigo=$_POST['caminho_anterior_arquivo'];
		@$extensao=$_POST['extensao'];
		@$nome_anterior=$_POST['nome_anterior_arquivo'];
		@$caminho_novo_arquivo=$_POST['caminho_novo_arquivo'];
		@$existeExtensao=strpos($caminho_novo_arquivo, $extensao);
		if($existeExtensao === false){
			$caminho_novo_arquivo=$_POST['caminho_novo_arquivo'].".".$extensao;
		}
		else{
			$caminho_novo_arquivo=$_POST['caminho_novo_arquivo'];
		}
		@$caminho_atual_arquivo=$_POST['caminho_atual_arquivo'];
		@$arquivo_nova = str_replace($nome_anterior,$caminho_novo_arquivo, $arquivo_antigo);
		@$renomear=rename("".$arquivo_antigo."","".$arquivo_nova."");
		if($renomear===true){
			include "inc/conexao.php";
			$sql ="UPDATE `tb_arquivos_usuarios` SET `nome_arquivo` = '$caminho_novo_arquivo' WHERE `tb_arquivos_usuarios`.`nome_arquivo` = '$nome_anterior' AND `tb_arquivos_usuarios`.`fk_usuario` =$id_usua";
			$up_nome_arquivo = $conex -> prepare($sql);	
			$up_nome_arquivo -> execute();
			if(@$_POST['verificadorCompartF']==1){
				$sql = "UPDATE `tb_compartilhados_interno` SET `caminho_compartilhado_interno` = '$arquivo_nova',`nome_folder` = '$caminho_novo_arquivo' WHERE `tb_compartilhados_interno`.`caminho_compartilhado_interno` = '$arquivo_antigo' AND `tb_compartilhados_interno`.`fk_usuario` =$id_usua";
				$upCompart = $conex -> prepare($sql);
				$upCompart -> execute();
			}
			if(isset($_POST['paginalink']) && $_POST['paginalink']==1 ){
				if($arquivo_link=='0'){
					echo "<script>
								window.location='link.php".$caminho_atual_arquivo."';
					</script>";
				}
				else{
						$arquivo_compart_filt=str_replace("(","\(",$caminho_novo_arquivo);
						$arquivo_compart_filt1=str_replace(")","\)",$arquivo_compart_filt);
						$arquivo_compart_filt2=str_replace("[","\[",$arquivo_compart_filt1);
						$arquivo_compart_filt3=str_replace("]","\]",$arquivo_compart_filt2);
						$finalLocation="#search=".$arquivo_compart_filt3."";
						$_SESSION["arquivo_link"]=$caminho_novo_arquivo;
						header("Location:link.php".$finalLocation."");
					
				}
			}
			else{
					if(isset($_POST['paginaCompart']) && $_POST['paginaCompart']==1 ){
						if($tipo==1){
							$sql ="UPDATE `tb_compartilhados_interno` SET `nome_folder` = '$caminho_novo_arquivo',`caminho_compartilhado_interno` = '$arquivo_nova' WHERE `tb_compartilhados_interno`.`nome_folder` = '$nome_anterior' AND `tb_compartilhados_interno`.`caminho_compartilhado_interno` = '$arquivo_antigo' AND `tb_compartilhados_interno`.`fk_usuario` = '$id_usua'";
							$up_nome_arq = $conex -> prepare($sql);	
							$up_nome_arq -> execute();
							$arquivo_compart_filt=str_replace("(","\(",$caminho_novo_arquivo);
							$arquivo_compart_filt1=str_replace(")","\)",$arquivo_compart_filt);
							$arquivo_compart_filt2=str_replace("[","\[",$arquivo_compart_filt1);
							$arquivo_compart_filt3=str_replace("]","\]",$arquivo_compart_filt2);
							$finalLocation="#search=".$arquivo_compart_filt3."";
							header("Location:ArquivoCompartilhado.php".$finalLocation."");
							
						}
						else{
							echo "<script>
								window.location='ArquivoCompartilhado.php".$caminho_atual_arquivo."';
					</script>";
						}
						
					}
					else{
						echo "<script>
											window.location='index_usuario.php".$caminho_atual_arquivo."';
							 </script>";
					}
			}
		}
		
	}
	if(isset($_POST['excluir_arquivo'])){
		session_start();
		if(isset($_POST['paginaCompart']) && $_POST['paginaCompart']==1 ){
			@$id_usua=$_POST["fk_usuarioCompart"];
		}
		else{
			@$id_usua=$_SESSION["id_usuario"];
		}
		@$arquivo_link=$_SESSION["arquivo_link"];
		@$tipo=$_SESSION["tipoFile"];
		@$arquivo_antigo=$_POST['caminho_anterior_arquivo'];
		@$caminho_atual_arquivo=$_POST['caminho_atual_arquivo'];
		@$nome_anterior_d_arquivo=$_POST['nome_anterior_arquivo'];
		$arquivo_destino="all_files/".$id_usua."/lixeira/".$nome_anterior_d_arquivo;
		date_default_timezone_set('America/Sao_Paulo');
		$data_exclusao=date('d/m/Y');
		$hora_exclusao=date('H:i:s');
		
		if (copy($arquivo_antigo, $arquivo_destino)){
			@$excluir_arquivo=unlink("".$arquivo_antigo."");
			include "inc/conexao.php";
			$sql ="UPDATE `tb_arquivos_usuarios` SET `status` = '1',`data_exclusao` = '$data_exclusao',`hora_exclusao` = '$hora_exclusao',`caminho` = '$arquivo_antigo' WHERE `tb_arquivos_usuarios`.`nome_arquivo` = '$nome_anterior_d_arquivo' AND `tb_arquivos_usuarios`.`fk_usuario` =$id_usua";
			$up_status_arquivo = $conex -> prepare($sql);	
			$up_status_arquivo -> execute();
			if($_POST['verificadorCompartF']==1){
				$sql = "DELETE FROM `tb_compartilhados_interno` WHERE `tb_compartilhados_interno`.`caminho_compartilhado_interno` = '$arquivo_antigo' AND `tb_compartilhados_interno`.`fk_usuario` =$id_usua";
				$upCompart = $conex -> prepare($sql);
				$upCompart -> execute();
			}
			if(isset($_POST['paginalink']) && $_POST['paginalink']==1 ){
				if($arquivo_link=='0'){
					echo "<script>
								window.location='link.php".$caminho_atual_arquivo."';
					</script>";
				}
				else{
					echo "<script>
								window.location='link.php#search=".$nome_anterior_d_arquivo."';
				 </script>";
				}
			}
			else{
					if(isset($_POST['paginaCompart']) && $_POST['paginaCompart']==1 ){
						if($tipo==1){
							echo "<script>
								window.location='ArquivoCompartilhado.php#search=".$nome_anterior_d_arquivo."';
					</script>";
						}
						else{
							echo "<script>
								window.location='ArquivoCompartilhado.php".$caminho_atual_arquivo."';
					</script>";
						}
					}
					else{
						echo "<script>
											window.location='index_usuario.php".$caminho_atual_arquivo."';
							 </script>";
					}
			}
		
		}
	}
?>