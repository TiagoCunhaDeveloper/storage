<?php
	if(isset($_POST['recuperar'])){
		session_start();
		$id_usuario=$_SESSION["id_usuario"];
		$caminho=$_POST['caminho'];
		$id_arquivos_usuarios=$_POST['id_arquivos_usuarios'];
		$nome_arquivo=$_POST['nome_arquivo'];
		$caminho_lixeira="all_files/".$id_usuario."/Lixeira/".$nome_arquivo."";
		if (copy($caminho_lixeira, $caminho)){
			@$excluir_arquivo=unlink("".$caminho_lixeira."");
			include "inc/conexao.php";
			$sql ="UPDATE `tb_arquivos_usuarios` SET `status` = '0' WHERE `tb_arquivos_usuarios`.`id_arquivos_usuarios` = $id_arquivos_usuarios";
			$up_status_arquivo = $conex -> prepare($sql);	
			$up_status_arquivo -> execute();
			header('Location:lixeira.php');
		}
		
	}
?>