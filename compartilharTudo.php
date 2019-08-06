<?php
	session_start();
	include "inc/conexao.php"; 
	$compartilhados=$_POST['resultado'];
	$opcoes=$_POST['opcoesCompar'];
	$caminho=$_POST['caminhoCompart'];
	$tipo=$_POST['tipoFolder'];
	$nome_folder=$_POST['nome_folder'];
	date_default_timezone_set('America/Sao_Paulo');
	$data = date("d/m/Y");
	$caminhoAtual=$_POST['caminhoAtual'];
	$id_usuario=$_SESSION['id_usuario'];
	$bodytag = str_replace('{"matchedKey":"email","',"",$compartilhados);
	$final = str_replace(',"group":"teams"}',"",$bodytag);
	$final1 = str_replace('"name":"',"",$final);
	$final2 = str_replace('"email":"',"",$final1);
	$final3 = str_replace('id":',"",$final2);
	$final4 = str_replace('"',"",$final3);
	$final5 = str_replace('[',"",$final4);
	$final6 = str_replace(']',"",$final5);
	$teste=explode (",",$final6);
	$result = count($teste)-3;
	
	for ($i = 0;$i<=$result;) {
		@$finalMsm=$teste[$i];
		$sql ="SELECT * FROM tb_compartilhados_interno WHERE caminho_compartilhado_interno='$caminho' AND receptor_interno = '$finalMsm' AND fk_usuario = '$id_usuario' ";
		$jafoicompartilhado = $conex -> prepare($sql);	
		$jafoicompartilhado -> execute();
		$caminho_existe = $jafoicompartilhado->rowCount();
		$i=$i+3;
		if($caminho_existe==0){
			$sql = "INSERT INTO tb_compartilhados_interno VALUES (?,?,?,?,?,?,?,?)";
			$comp = $conex -> prepare($sql);	
			$comp -> execute(array("",$finalMsm,$caminho,$data,$tipo,$nome_folder,$opcoes,$_SESSION['id_usuario']));
			$comp = null; //Encerra a conexão com o BD
		}
		else{
			$sql = "UPDATE `tb_compartilhados_interno` SET `data_compartilhamento_interno` = '$data',`opcoes_compart`='$opcoes' WHERE caminho_compartilhado_interno='$caminho' AND receptor_interno = '$finalMsm' AND fk_usuario = '$id_usuario'";
			$comp = $conex -> prepare($sql);	
			$comp -> execute();
			$comp = null; //Encerra a conexão com o BD
		}
		
	}
	echo "<script>
							window.location='index_usuario.php".$caminhoAtual."';
							alert('Compartilhado com sucesso!');
						 </script>";	
	
		
	
	
?>