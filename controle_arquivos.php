<?php 
session_start();
$id_usua=$_SESSION["id_usuario"];
$arquivo_anterior=$_POST['arquivo_anterior'];
$arquivo_temporario_i=$_POST['arquivo_temporario'];
$arquivo_temporario='arquivos_temporarios/'.$id_usua."/".$arquivo_temporario_i;
$caminho_filtrado=$_POST['caminho_filtrado'];
$localizacao=$_POST['localizacao'];
$size        = $_POST["arquivo"];
$nome_novo_arquivo        = $_POST["nome_novo_arquivo"];
$formato        = $_POST["formato"];
$copia_nova        = $_POST["copia_nova"];
$versao_nova        = $_POST["versao_nova"];
$existe_versao        = $_POST["existe_versao"];
$id_arquivo= $_POST["id_arquivo"];
$caminho_filtrado_somente        = $_POST["caminho_filtrado_somente"];
$arquivo_destino='all_files/'.$id_usua.'/Meu armazenamento'.$caminho_filtrado_somente.$nome_novo_arquivo;
$arquivo_destino_substituir='all_files/'.$id_usua.'/Meu armazenamento'.$caminho_filtrado_somente.$arquivo_temporario_i;
$nome_pasta= ucwords($_POST["nome_versao"]);
date_default_timezone_set('America/Sao_Paulo');
$data_hoje=date('d-m-Y');
$nome_novo_arquivo_final=str_replace($formato,' - '.$data_hoje,$nome_novo_arquivo);
$nome_novo_arquivo_versao=$nome_novo_arquivo_final.$formato;
$versao_ja_existe=$_POST["versao_ja_existe"];
$arquivo_destino_versao='all_files/'.$id_usua.'/Meu armazenamento'.$caminho_filtrado_somente.$nome_pasta."/".$nome_novo_arquivo_versao;
$arquivo_destino_versao_jaexiste='all_files/'.$id_usua.'/Meu armazenamento'.$caminho_filtrado_somente.$versao_ja_existe;
$arquivo_anterior_versao='all_files/'.$id_usua.'/Meu armazenamento'.$caminho_filtrado_somente.$nome_pasta."/".$arquivo_temporario_i;
if(isset($_POST['substituir'])){
	if (copy($arquivo_temporario, $arquivo_destino_substituir)){
		unlink($arquivo_temporario);
		include "inc/conexao.php"; 
			$sql99 ="UPDATE `tb_arquivos_usuarios` SET `tamanho_arquivo` = '$size' WHERE `tb_arquivos_usuarios`.`id_arquivos_usuarios` =$id_arquivo";
			$up_novo_arquivo = $conex -> prepare($sql99);	
			$up_novo_arquivo -> execute();
		echo "<script>
										window.location='index_usuario.php".$localizacao."';
					 </script>";
	}
	
}
if(isset($_POST['novo_arquivo'])){
	if (copy($arquivo_temporario, $arquivo_destino)){
		unlink('arquivos_temporarios/'.$id_usua."/".$arquivo_temporario_i);
		include "inc/conexao.php"; 
		$caminho=$arquivo_destino;
			$sql99 ="UPDATE `tb_arquivos_usuarios` SET `copia` = '$copia_nova' WHERE `tb_arquivos_usuarios`.`id_arquivos_usuarios` =$id_arquivo";
			$up_novo_arquivo = $conex -> prepare($sql99);	
			$up_novo_arquivo -> execute();
			date_default_timezone_set('America/Sao_Paulo');
					$status=0;
					$backup=0;
					$data_upload=date('d/m/Y');
					$hora_upload=date('H:i:s');
					$data_exclusao=null;
					$hora_exclusao=null;
					$versao=null;
					$copia=$copia_nova ;
					$sql = "INSERT INTO tb_arquivos_usuarios VALUES (?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?)";				
						$novo_arquivo = $conex->prepare($sql);				
						$novo_arquivo->execute(array('',$nome_novo_arquivo,$size,$status,$backup,$data_upload,$hora_upload,$data_exclusao,$hora_exclusao,$versao,$copia,$caminho,$id_usua));
		echo "<script>
										window.location='index_usuario.php".$localizacao."';
					 </script>";
	}
}
if(isset($_POST['nova_versao'])){
	if($existe_versao==1){
		if (copy($arquivo_temporario,$arquivo_destino_versao_jaexiste)){
			unlink($arquivo_temporario);
							include "inc/conexao.php"; 
			$sql99 ="UPDATE `tb_arquivos_usuarios` SET `versao` = '$versao_nova' WHERE `tb_arquivos_usuarios`.`id_arquivos_usuarios` =$id_arquivo";
			$up_novo_arquivo = $conex -> prepare($sql99);	
			$up_novo_arquivo -> execute();
			$sql5 = "SELECT `qtd_pastas` FROM tb_usuario where `id_usuario` =  $id_usua";
				$qtd_pastas_anterior = $conex->prepare($sql5);
				$qtd_pastas_anterior -> execute();
				foreach($qtd_pastas_anterior as $qtd_pas_a){
					$qtd_pasta_an=$qtd_pas_a['qtd_pastas'];
				}
				$sql5 = "UPDATE `tb_usuario` SET `qtd_pastas` = $qtd_pasta_an + 1 WHERE `tb_usuario`.`id_usuario` = $id_usua";
				$up_qtd_pastas = $conex->prepare($sql5);
				$up_qtd_pastas -> execute();
						echo "<script>
								window.location='index_usuario.php".$localizacao."';
							 </script>";	
					}
						
	}
	else{
		$nova_pasta=mkdir(__DIR__.'/all_files/'.$id_usua.'/Meu armazenamento'.$caminho_filtrado_somente.$nome_pasta.'', 0777, true);
			if($nova_pasta===true){
				
					if (copy($arquivo_anterior, $arquivo_anterior_versao)){
						unlink(''.$arquivo_anterior.'');
						if (copy($arquivo_temporario, $arquivo_destino_versao)){
							include "inc/conexao.php"; 
			$sql99 ="UPDATE `tb_arquivos_usuarios` SET `versao` = '$versao_nova' WHERE `tb_arquivos_usuarios`.`id_arquivos_usuarios` =$id_arquivo";
			$up_novo_arquivo = $conex -> prepare($sql99);	
			$up_novo_arquivo -> execute();
			$sql5 = "SELECT `qtd_pastas` FROM tb_usuario where `id_usuario` =  $id_usua";
				$qtd_pastas_anterior = $conex->prepare($sql5);
				$qtd_pastas_anterior -> execute();
				foreach($qtd_pastas_anterior as $qtd_pas_a){
					$qtd_pasta_an=$qtd_pas_a['qtd_pastas'];
				}
				$sql5 = "UPDATE `tb_usuario` SET `qtd_pastas` = $qtd_pasta_an + 1 WHERE `tb_usuario`.`id_usuario` = $id_usua";
				$up_qtd_pastas = $conex->prepare($sql5);
				$up_qtd_pastas -> execute();
						echo "<script>
								window.location='index_usuario.php".$localizacao."';
							 </script>";	
					}
						}
		
			}
	}
	
				
				
				
}

?>