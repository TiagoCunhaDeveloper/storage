<?php
	session_start();
	include_once "inc/conexao.php";
	$nome_arquivo_link=$_GET['nome_arquivo_link'];
	$caminho=$_GET['caminho_link_a'];
	$pos = strpos($caminho, "Meu armazenamento");
	if ($pos === false) {
		$caminho_final="Meu armazenamento/".$nome_arquivo_link;
	}
	else{
		$caminho_final=$caminho."/".$nome_arquivo_link;
	}
	$hash=$_GET['hash_a'];
	$id_usuario=$_SESSION['id_usuario'];
	$sql ="SELECT * FROM tb_compartilhados WHERE caminho_compartilhado='$caminho_final' AND fk_usuario = '$id_usuario'";
	$jafoicompartilhado = $conex -> prepare($sql);	
	$jafoicompartilhado -> execute();
	$caminho_existe = $jafoicompartilhado->rowCount();
	if($caminho_existe==0){
		$sql = "INSERT INTO tb_compartilhados VALUES (?,?,?,?,?)";
		$comp = $conex -> prepare($sql);	
		$comp -> execute(array("",$hash,$caminho_final,$nome_arquivo_link,$_SESSION['id_usuario']));
		$comp = null; //Encerra a conexão com o BD
	}
	else{
		$sql = "UPDATE `tb_compartilhados` SET `hash` = '$hash',`caminho_compartilhado`='$caminho_final',`pessoas`='$nome_arquivo_link' WHERE `tb_compartilhados`.`caminho_compartilhado` = '$caminho_final' AND `tb_compartilhados`.`fk_usuario`='$id_usuario'";
		$comp = $conex -> prepare($sql);	
		$comp -> execute();
		$comp = null; //Encerra a conexão com o BD
	}
		
?>