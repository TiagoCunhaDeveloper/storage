<?php
	if(isset($_POST['renomear_pasta'])){
		session_start();
		if(isset($_POST['paginaCompart']) && $_POST['paginaCompart']==1 ){
			@$id_usua=$_POST["fk_usuarioCompart"];
		}
		else{
			@$id_usua=$_SESSION["id_usuario"];
		}
		$pasta_antiga=$_POST['caminho_anterior_pasta'];
		$nome_anterior=$_POST['nome_anterior'];
		$pasta_nova_f=ucwords($_POST['caminho_novo_pasta']);
		$caminho_atual_pasta=$_POST['caminho_atual_pasta'];
		$pasta_nova = str_replace($nome_anterior,$pasta_nova_f,$pasta_antiga);
		$renomear=rename($pasta_antiga,$pasta_nova);
		if($renomear===true){
			if(isset($_POST['paginalink']) && $_POST['paginalink']==1 ){
				echo "<script>
								window.location='link.php".$caminho_atual_pasta."';
				 </script>";
			}
			else{
				if(isset($_POST['paginaCompart']) && $_POST['paginaCompart']==1 ){
						echo "<script>
								window.location='ArquivoCompartilhado.php".$caminho_atual_pasta."';
					</script>";
					}
					else{
						echo "<script>
											window.location='index_usuario.php".$caminho_atual_pasta."';
							 </script>";
					}
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
		$caminho_atual_pasta=$_POST['caminho_atual_pasta'];
		if(isset($_POST['paginaCompart']) && $_POST['paginaCompart']==1 ){
			@$id_usua=$_POST["fk_usuarioCompart"];
		}
		else{
			@$id_usua=$_SESSION["id_usuario"];
		}
		$pasta_antiga=$_POST['caminho_anterior_pasta'];
		$excluir_pasta=unlinkRecursive($pasta_antiga, true );
		if(isset($_POST['paginalink']) && $_POST['paginalink']==1 ){
				echo "<script>
								window.location='link.php".$caminho_atual_pasta."';
				 </script>";
			}
			else{
			if(isset($_POST['paginaCompart']) && $_POST['paginaCompart']==1 ){
						echo "<script>
								window.location='ArquivoCompartilhado.php".$caminho_atual_pasta."';
					</script>";
					}
					else{
						echo "<script>
											window.location='index_usuario.php".$caminho_atual_pasta."';
							 </script>";
					}
			}
		
	}
?>