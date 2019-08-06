<?php
	if(isset($_POST['renomear_pasta'])){
		session_start();
		include "inc/conexao.php"; 
		@$id_usua=$_SESSION["id_usuario"];
		$pasta_antiga=$_POST['caminho_anterior_pasta'];
		$nome_anterior=$_POST['nome_anterior'];
		$pasta_nova_f=ucwords($_POST['caminho_novo_pasta']);
		$caminho_atual_pasta=$_POST['caminho_atual_pasta'];
		$pasta_nova = str_replace($nome_anterior,$pasta_nova_f, $pasta_antiga);
		$renomear=rename("all_files/".$id_usua."/".$pasta_antiga."", "all_files/".$id_usua."/".$pasta_nova."");
		if($renomear===true){
			if($_POST['verificadorCompartF']==1){
				$sql = "UPDATE `tb_compartilhados_interno` SET `caminho_compartilhado_interno` = '$pasta_nova',`nome_folder` = '$pasta_nova_f' WHERE `tb_compartilhados_interno`.`caminho_compartilhado_interno` = '$pasta_antiga' AND `tb_compartilhados_interno`.`fk_usuario` =$id_usua";
				$upCompart = $conex -> prepare($sql);
				$upCompart -> execute();
			}
			if(isset($_POST['paginalink']) && $_POST['paginalink']==1 ){
				echo "<script>
								window.location='link.php".$caminho_atual_pasta."';
				 </script>";
			}
			else{
				echo "<script>
								window.location='index_usuario.php".$caminho_atual_pasta."';
				 </script>";
			}
			
		}
		
	}
	if(isset($_POST['excluir_pasta'])){
		function unlinkRecursive($dir, $deleteRootToo) 
{ 
    if(!$dh = @opendir($dir)) 
    { 
        return; 
    } 
    while (false !== ($obj = readdir($dh))) 
    { 
        if($obj == '.' || $obj == '..') 
        { 
            continue; 
        } 

        if (!@unlink($dir . '/' . $obj)) 
        { 
            unlinkRecursive($dir.'/'.$obj, true); 
        } 
    } 
    closedir($dh); 
    if ($deleteRootToo) 
    { 
        @rmdir($dir); 
    } 
    return; 
} 
		session_start();
		include "inc/conexao.php"; 
		$caminho_atual_pasta=$_POST['caminho_atual_pasta'];
		$id_usua=$_SESSION["id_usuario"];
		$pasta_antiga=$_POST['caminho_anterior_pasta'];
		$excluir_pasta=unlinkRecursive( "all_files/".$id_usua."/".$pasta_antiga."", true );
		if($_POST['verificadorCompartF']==1){
			$sql = "DELETE FROM `tb_compartilhados_interno` WHERE `tb_compartilhados_interno`.`caminho_compartilhado_interno` = '$pasta_antiga' AND `tb_compartilhados_interno`.`fk_usuario` =$id_usua";
			$upCompart = $conex -> prepare($sql);
			$upCompart -> execute();
		}
		if(isset($_POST['paginalink']) && $_POST['paginalink']==1 ){
				echo "<script>
								window.location='link.php".$caminho_atual_pasta."';
				 </script>";
			}
			else{
			echo "<script>
					window.location='index_usuario.php".$caminho_atual_pasta."';
		 </script>";
			}
		
	}
?>