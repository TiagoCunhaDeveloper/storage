<?php
	session_start();
	include "inc/conexao.php";
	@$id_usua=$_SESSION["id_usuario"];
	$sql ="SELECT * FROM tb_usuario WHERE id_usuario = '$id_usua'";
	$usu_tamanho_d = $conex -> prepare($sql);	
	$usu_tamanho_d -> execute();
	foreach($usu_tamanho_d as $u_d){
		$plano_atual_d=$u_d['plano'];
	}
	switch ($plano_atual_d) {
		case 4:
			
			$bytes=21474836480;
		break;
		case 1:
			
			$bytes=53687091200;
		break;
		case 2:
			
			$bytes=107374182400;
		break;
		case 3:
			
			$bytes=1099511627776;
		break;
	}
	function By2M($size){
    $filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    return $size ? round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i] : '0 Bytes';
}
function diretorio($path) {

global $tamanho_arquivo, $tamanho_total, $total_pastas;

if ($dir = opendir($path)) {

while (false !== ($file = readdir($dir))) {

if (is_dir($path."/".$file)) {

if ($file != '.' && $file != '..') {

 '<li><b>' . $file . '</b></li><ul>';

diretorio($path."/".$file);

 '</ul>';

$total_pastas++;

}

}

else {

$tab = " ";

$filesize = $tab . '(' . filesize ($path.'/'.$file) . ' kb)';

'<li>' . $file . $filesize . '</li>';

$tamanho_total = $tamanho_total + filesize ($path.'/'.$file);

$tamanho_arquivo++;

}

}

closedir($dir);

}

}

diretorio("all_files/".$id_usua."/Meu armazenamento");//path da sua pasta
	if(isset($_POST['novo_arquivo'])){
		$caminho=$_POST['caminho_arquivo'];
		$caminho_filtrado_3 = str_replace('#Meu%20armazenamento', '', $caminho);
		$caminho_filtrado = str_replace('#Meu%20armazenamento%2F', '/', $caminho_filtrado_3);
		$caminho_filtrado_1 = str_replace('%2F', '/', $caminho_filtrado);
		$caminho_filtrado_2 = str_replace('%20', ' ', $caminho_filtrado_1);
		$caminho_filtrado_final=$caminho_filtrado_2."/";
	
			$morango=$_FILES['arquivo'];
			$tamanho_arquivo_a=$_FILES['arquivo']['size'];
			$total_atual=$tamanho_arquivo_a+$tamanho_total;
		if($tamanho_total>=$bytes || $total_atual>$bytes ){
			echo "<script>
								window.location='index_usuario.php".$caminho."';
								alert('Você não possui espaço suficiente');
							 </script>";
		}
		else{
			$titulo_img = $morango['name'];
			$formato    = pathinfo($titulo_img, PATHINFO_EXTENSION);
			$arquivo_existe='all_files/'.$id_usua.'/Meu armazenamento'.$caminho_filtrado_final.$titulo_img;
			if (file_exists($arquivo_existe)) {
				function tamanho_arquivo_compart($arquivo) {
					$tamanhoarquivo = filesize($arquivo);
				 	return $tamanhoarquivo;
				}
				$arquivo_destino='arquivos_temporarios/'.$id_usua."/".$titulo_img;
				@$size_novo_arquivo=tamanho_arquivo_compart(''.$arquivo_destino.'');
				@$size_arquivo_existente=tamanho_arquivo_compart(''.$arquivo_existe.'');
				$tmp_temporario        = $morango['tmp_name'];
				$upload_temporario = move_uploaded_file($tmp_temporario,'arquivos_temporarios/'.$id_usua."/".$titulo_img);
				if($upload_temporario===true){
					$array_formatos=array("php", "js", "py", "css", "html", "xhtml", "js", "cpp", "c", "json", "java", "bat", "h", "jar", "jav", "sql", "inc", "htaccess","txt");
					if (in_array($formato, $array_formatos)) { 
						require_once 'class.Diff.php';
						
						$diferenca=Diff::toTable( Diff::compareFiles('all_files/'.$id_usua.'/Meu armazenamento'.$caminho_filtrado_final.''.'/'.$titulo_img.'', 'arquivos_temporarios/'.$id_usua."/".$titulo_img.'') );
					}
					else{
						$diferenca="";
						
					}
					
				}
				$_SESSION["diferenca"]=$diferenca;
				$_SESSION["nome_arquivo"]=$titulo_img;
				$_SESSION["extensao"]=$formato;
				$_SESSION["arquivo_anterior"]=$arquivo_existe;
				$_SESSION["caminho_filtrado"]    =$caminho_filtrado_final.$titulo_img;
				$_SESSION["caminho_filtrado_somente"]    =$caminho_filtrado_final;
				$_SESSION["localizacao"]    =$caminho;
				$_SESSION["arquivo"]    =$morango;
				$_SESSION["arquivo_temporario"]    =$titulo_img;
				$_SESSION["size_arquivo_destino"]    =$size_arquivo_existente;
				$_SESSION["size_novo_arquivo"]    =$size_novo_arquivo;
				
				echo "<script>
										window.location='index_usuario.php".$caminho."';
					 </script>";
			}
			else{
				$tmp        = $morango['tmp_name'];
				$formato    = pathinfo($titulo_img, PATHINFO_EXTENSION);
				$upload = move_uploaded_file($tmp,'all_files/'.$id_usua.'/Meu armazenamento'.$caminho_filtrado_final.$titulo_img);
		
				if($upload===true){
					date_default_timezone_set('America/Sao_Paulo');
					$status=0;
					$backup=0;
					$data_upload=date('d/m/Y');
					$hora_upload=date('H:i:s');
					$data_exclusao=null;
					$hora_exclusao=null;
					$caminhos=null;
					$versao=null;
					$copia=null;
					$sql = "INSERT INTO tb_arquivos_usuarios VALUES (?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?)";				
						$novo_arquivo = $conex->prepare($sql);				
						$novo_arquivo->execute(array('',$titulo_img,$tamanho_arquivo_a,$status,$backup,$data_upload,$hora_upload,$data_exclusao,$hora_exclusao,$versao,$copia,$caminhos,$id_usua));
						
					echo "<script>
										window.location='index_usuario.php".$caminho."';
									 </script>";
				}
			}
			
		}
			
		
	}
?>