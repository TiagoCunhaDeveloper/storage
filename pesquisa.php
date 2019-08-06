<?php
	session_start();
	$id_usuario=$_SESSION["id_usuario"];
	include "inc/conexao.php";
	$pesquisar=$_POST['pesquisar'];
	$sql ="SELECT * FROM tb_arquivos_usuarios WHERE nome_arquivo LIKE '%$pesquisar%' AND fk_usuario = '$id_usuario' ";
	$arquivos_gerais = $conex -> prepare($sql);	
	$arquivos_gerais -> execute();
	$count = $arquivos_gerais->rowCount();
	if($count==1){
		foreach($arquivos_gerais as $a_g){
			$status=$a_g['status'];
		}
		if($status==1){
			header('Location:lixeira.php?search='.$pesquisar.'');
		}
		else{
			header('Location:index_usuario.php#search='.$pesquisar.'');
		}
	}
	else{
		echo "<script>
						alert('Arquivo não encontrado');
							window.history.back();
					
						 </script>";	
	}
?>