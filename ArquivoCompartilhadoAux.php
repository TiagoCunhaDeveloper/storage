<?php
session_start();
include "inc/conexao.php"; 
	$id_usuario=$_SESSION["id_usuario"];
	$arquivo_compart=$_POST['arquivo_compart'];
	$nome_usuario=$_POST['nome_usuario'];
	$email_usu=$_POST['email_usu'];
	$permicoes=$_POST['permicoes'];
	$caminho_compartilhado_interno=$_POST['caminho_compartilhado_interno'];
	$tipo=$_POST['tipo'];
	$fk_usuarioCompart=$_POST['fk_usuarioCompart'];
	$zipFile="all_files/".$fk_usuarioCompart."/".$caminho_compartilhado_interno;
	$nomeZipFiles=$arquivo_compart.".zip";
	if(isset($_POST['baixar'])){
			function createZip ( 
 $path = 'arquivo.zip', 
 $files = array(), 
 $deleleOriginal = false 
) {
 /**
 * Cria o arquivo .zip
 */
 $zip = new ZipArchive;
 $zip->open( $path, ZipArchive::CREATE);
 
 /**
 * Checa se o array não está vazio e adiciona os arquivos
 */
 if ( !empty( $files ) ) {
 /**
 * Loop do(s) arquivo(s) enviado(s) 
 */
 foreach ( $files as $file ) {
 /**
 * Adiciona os arquivos ao zip criado
 */
 @$zip->addFile( $file, basename( $file ) );
 
 /**
 * Verifica se $deleleOriginal está setada como true,
 * se sim, apaga os arquivos
 */
 if ( $deleleOriginal === true ) {
 /**
 * Apaga o arquivo
 */
 unlink( $file );
 
 /**
 * Seta o nome do diretório
 */
 $dirname = dirname( $file );
 }
 }
 
 /**
 * Verifica se $deleleOriginal está setada como true,
 * se sim, apaga a pasta dos arquivos
 */
 if ( $deleleOriginal === true && !empty( $dirname ) ) {
 rmdir( $dirname );
 }
 }
 
 /**
 * Fecha o arquivo zip
 */
 $zip->close();
}


$directory = ''.$zipFile.''; //diretorio para compactar
$zipfile = ''.$nomeZipFiles.''; // nome do zip gerado

$filenames = array();
function browse($dir) {
global $filenames;
   if ($handle = opendir($dir)) {
       while (false !== ($file = readdir($handle))) {
           if ($file != "." && $file != ".." && is_file($dir.'/'.$file)) {
               $filenames[] = $dir.'/'.$file;
           }
           else if ($file != "." && $file != ".." && is_dir($dir.'/'.$file)) {
               browse($dir.'/'.$file);
           }
       }
       closedir($handle);
   }
   return $filenames;
}

browse($directory);
// cria zip, adiciona arquivos...
$zip = new ZipArchive();
foreach ($filenames as $filename) {
    @$teste.=$filename.",";
}
$pieces = explode(",", $teste);
createZip( 'arquivos_zipados/'.$fk_usuarioCompart.'/'.$nomeZipFiles.'', $pieces );
		$arquivo = "arquivos_zipados/".$fk_usuarioCompart."/".$nomeZipFiles."";

		header("Content-Type: application/octetstream");
		header("Content-Disposition: attachment; filename=" . basename($arquivo));
		header("Pragma: no-cache");
		header("Expires: 0");
		header("Content-Length: " . filesize($arquivo));

		readfile($arquivo);
		unlink("arquivos_zipados/".$fk_usuarioCompart."/".$nomeZipFiles."");
		header("Location:compartilhados.php");
	}
	else{
		if(isset($_POST['addMystorage'])){
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
					 $size=tamanho_arquivo(''.$caminho.'');
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
									$novo_arquivo->execute(array('',$arquivo_compart,$size,$status,$backup,$data_upload,$hora_upload,$data_exclusao,$hora_exclusao,$versao,$copia,$caminho,$id_us));
					
				  }
			   }
			 
			   $dir->close();
			   return true;
			 
			}
			function tamanho_arquivo($arquivo) {
				$tamanhoarquivo = filesize($arquivo);
			 
				
			 
				return $tamanhoarquivo;
			}
			$arquivo_destino='all_files/'.$id_usuario.'/Meu armazenamento/'.$arquivo_compart;
			if($tipo==1){
				$arquivo_temporario=$caminho_compartilhado_interno;
				$size=tamanho_arquivo(''.$caminho_compartilhado_interno.'');
				if (file_exists($arquivo_destino)) {
					$_SESSION["tipoExiste"]=1;
					$_SESSION["nome_arquivo"]=$arquivo_compart;
					$_SESSION["arquivo_temporario"]=$arquivo_temporario;
					$_SESSION["arquivo_destino"]=$arquivo_destino;
					$_SESSION["arquivo_temporario_size"]=$size;
					header("Location:compartilhados.php");
				}
				else{
					if (copy($arquivo_temporario, $arquivo_destino)){
						
									include "inc/conexao.php"; 
									$caminho=$arquivo_destino;
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
										$novo_arquivo->execute(array('',$arquivo_compart,$size,$status,$backup,$data_upload,$hora_upload,$data_exclusao,$hora_exclusao,$versao,$copia,$caminho,$id_usuario));
						
						
						
						echo "<script>
								window.location='compartilhados.php';
								alert('Adcionado com sucesso!');
							 </script>";	
					}
				}
			}
			else{
				$arquivo_temporario='all_files/'.$fk_usuarioCompart.'/'.$caminho_compartilhado_interno;
				if(is_dir($arquivo_destino)){
					$_SESSION["tipoExiste"]=0;
					$_SESSION["nome_arquivo"]=$arquivo_compart;
					$_SESSION["arquivo_temporario"]=$arquivo_temporario;
					$_SESSION["arquivo_destino"]=$arquivo_destino;
					$_SESSION["arquivo_temporario_size"]=$size;
					header("Location:compartilhados.php");
				}
				else{
					copyr(''.$arquivo_temporario.'',''.$arquivo_destino.'');  
				
				echo "<script>
							window.location='compartilhados.php';
							alert('Adcionado com sucesso!');
						 </script>";
				}
			}
		}
		else{
			if ($tipo==1){
				$_SESSION["arquivo_link"]=$arquivo_compart;
				$_SESSION["fk_usuarioCompart"]=$fk_usuarioCompart;
				$_SESSION["permicoes"]=$permicoes;
				$caminho_compartilhado_final_aux=str_replace("/".$arquivo_compart."","",$caminho_compartilhado_interno);
				$caminho_compartilhado_final1=str_replace("/","\\",$caminho_compartilhado_final_aux);
				$caminho_compartilhado_final=str_replace("all_files\\".$fk_usuarioCompart."\\","",$caminho_compartilhado_final1);
				$_SESSION["caminho_compartilhado"]=$caminho_compartilhado_final;
				$_SESSION["tipoFile"]=$tipo;
				$arquivo_compart_filt=str_replace("(","\(",$arquivo_compart);
				$arquivo_compart_filt1=str_replace(")","\)",$arquivo_compart_filt);
				$arquivo_compart_filt2=str_replace("[","\[",$arquivo_compart_filt1);
				$arquivo_compart_filt3=str_replace("]","\]",$arquivo_compart_filt2);
				header("Location:ArquivoCompartilhado#search=".$arquivo_compart_filt3);
			}
			else{
				$_SESSION["arquivo_link"]=$arquivo_compart;
				$_SESSION["fk_usuarioCompart"]=$fk_usuarioCompart;
				$_SESSION["permicoes"]=$permicoes;
				$_SESSION["tipoFile"]=$tipo;
				$caminho_compartilhado_final=str_replace("/","\\",$caminho_compartilhado_interno);
				$_SESSION["caminho_compartilhado"]=$caminho_compartilhado_final;
				header("Location:ArquivoCompartilhado.php");
			}
		}
	}
	
	
?>