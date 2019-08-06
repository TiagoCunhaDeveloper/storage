<?php
session_start();
include "inc/conexao.php"; 
$id_usuario=$_SESSION["id_usuario"];
$tipo=$_POST['tipo'];
$fk_usuarioCompart=$_POST['fk_usuarioCompart'];
$size=$_POST['size'];
$arquivo_temporario=$_POST['arquivo_temporario'];
$nome_novo_arquivo_n=$_POST['nome_novo_arquivo'];
$nome_antigo=$_POST['nome_antigo'];
$arquivo_destino_substituir=$_POST['arquivo_destino_substituir'];
$arquivo_destino_substituir_novo=str_replace($nome_antigo,$nome_novo_arquivo_n,$arquivo_destino_substituir);
if(isset($_POST['novo_arquivo'])){
			if($tipo==1){
				if (copy($arquivo_temporario, $arquivo_destino_substituir_novo)){
					include "inc/conexao.php"; 
					$caminho=$arquivo_destino_substituir;
						
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
					header("Location:compartilhados.php");
				}
			}
			else{
				function tamanho_arquivo($arquivo) {
					$tamanhoarquivo = filesize($arquivo);
				 
					
				 
					return $tamanhoarquivo;
				}
				function copyr($source, $dest){
				   // COPIA UM ARQUIVO
				   if (is_file($source)) {
					  return copy($source, $dest);
				   }
				 
				   // CRIA O DIRETÓRIO DE DESTINO
				   if (!is_dir($dest)) {
					  mkdir($dest);
					  
				   }
				 
				   // FAZ LOOP DENTRO DA PASTA
				   $dir = dir($source);
				   while (false !== $entry = $dir->read()) {
					  // PULA "." e ".."
					  if ($entry == '.' || $entry == '..') {
						 continue;
					  }
				 
					  // COPIA TUDO DENTRO DOS DIRETÓRIOS
					  if ($dest !== "$source/$entry") {
						 copyr("$source/$entry", "$dest/$entry");
						 $id_us=$_SESSION["id_usuario"];
						 $caminho=$dest."/".$entry;
						 $arquivo_compart=$entry;
						 $sizee=tamanho_arquivo(''.$caminho.'');
							include "inc/conexao.php"; 
									date_default_timezone_set('America/Sao_Paulo');
									$status=0;
									$backup=0;
									$data_upload=date('d/m/Y');
									$hora_upload=date('H:i:s');
									$data_exclusao=null;
									$hora_exclusao=null;
									$versao=null;
									$copia=null ;
									$sql = "INSERT INTO tb_arquivos_usuarios VALUES (?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?)";				
										$novo_arquivo = $conex->prepare($sql);				
										$novo_arquivo->execute(array('',$arquivo_compart,$sizee,$status,$backup,$data_upload,$hora_upload,$data_exclusao,$hora_exclusao,$versao,$copia,$caminho,$id_us));
						
					  }
				   }
				 
				   $dir->close();
				   return true;
				
				}
				copyr(''.$arquivo_temporario.'',''.$arquivo_destino_substituir_novo.''); 
			header("Location:compartilhados.php");
		}
}

if(isset($_POST['substituir'])){
	if($tipo==1){
		if (copy($arquivo_temporario, $arquivo_destino_substituir)){
			include "inc/conexao.php"; 
			$sql99 ="UPDATE `tb_arquivos_usuarios` SET `tamanho_arquivo` = '$size' WHERE `tb_arquivos_usuarios`.`id_arquivos_usuarios` =$id_arquivo";
			$up_novo_arquivo = $conex -> prepare($sql99);	
			$up_novo_arquivo -> execute();
			header("Location:compartilhados.php");
		}
	}
	else{
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
		unlinkRecursive($arquivo_destino_substituir,true);
		function tamanho_arquivo($arquivo) {
				$tamanhoarquivo = filesize($arquivo);
			 
				
			 
				return $tamanhoarquivo;
		}
		function copyr($source, $dest){
			   // COPIA UM ARQUIVO
			   if (is_file($source)) {
				  return copy($source, $dest);
			   }
			 
			   // CRIA O DIRETÓRIO DE DESTINO
			   if (!is_dir($dest)) {
				  mkdir($dest);
				  
			   }
			 
			   // FAZ LOOP DENTRO DA PASTA
			   $dir = dir($source);
			   while (false !== $entry = $dir->read()) {
				  // PULA "." e ".."
				  if ($entry == '.' || $entry == '..') {
					 continue;
				  }
			 
				  // COPIA TUDO DENTRO DOS DIRETÓRIOS
				  if ($dest !== "$source/$entry") {
					 copyr("$source/$entry", "$dest/$entry");
					 $id_us=$_SESSION["id_usuario"];
					 $caminho=$dest."/".$entry;
					 $arquivo_compart=$entry;
					 $sizee=tamanho_arquivo(''.$caminho.'');
						include "inc/conexao.php"; 
								date_default_timezone_set('America/Sao_Paulo');
								$status=0;
								$backup=0;
								$data_upload=date('d/m/Y');
								$hora_upload=date('H:i:s');
								$data_exclusao=null;
								$hora_exclusao=null;
								$versao=null;
								$copia=null ;
								$sql = "INSERT INTO tb_arquivos_usuarios VALUES (?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?)";				
									$novo_arquivo = $conex->prepare($sql);				
									$novo_arquivo->execute(array('',$arquivo_compart,$sizee,$status,$backup,$data_upload,$hora_upload,$data_exclusao,$hora_exclusao,$versao,$copia,$caminho,$id_us));
					
				  }
			   }
			 
			   $dir->close();
			   return true;
			 
			}
		copyr(''.$arquivo_temporario.'',''.$arquivo_destino_substituir.''); 
		header("Location:compartilhados.php");
	}
}
?>