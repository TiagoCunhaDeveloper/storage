<?php
	session_start();
	include "inc/conexao.php";
	@$id_usua=$_POST["fk_usuario_compart"];
	if(isset($_POST['nova_pasta'])){
		$nome_pasta=ucwords($_POST['nome_pasta']);
		$caminho=$_POST['caminho'];
		$caminhoAtualC=$_POST['caminhoAtualC'];
		$caminho_filtrado_3 = str_replace('#Meu%20armazenamento', '', $caminho);
		$caminho_filtrado = str_replace('#Meu%20armazenamento%2F', '/', $caminho_filtrado_3);
		$caminho_filtrado_1 = str_replace('%2F', '/', $caminho_filtrado);
		$caminho_filtrado_2 = str_replace('%20', ' ', $caminho_filtrado_1);
		$caminho_filtrado_3 = str_replace('%5C', '/', $caminho_filtrado_2);
		$caminho_filtrado_final=$caminho_filtrado_3."/";
		$existe_pasta=is_dir('all_files/'.$id_usua.'/Meu armazenamento'.$caminho_filtrado_final.''.$nome_pasta.'');
		if($existe_pasta===true){
			if($_POST['raiz']==0){
				echo "<script>
							window.location='ArquivoCompartilhado.php';
							alert('A pasta já existe');
						 </script>";	
			}
			else{
				echo "<script>
							window.location='ArquivoCompartilhado.php".$caminhoAtualC."';
							alert('A pasta já existe');
						 </script>";	
			}
			
		}
		else{
			$nova_pasta=mkdir(__DIR__.'/all_files/'.$id_usua.'/Meu armazenamento'.$caminho_filtrado_final.''.$nome_pasta.'', 0777, true);
			if($nova_pasta===true){
				$sql5 = "SELECT `qtd_pastas` FROM tb_usuario where `id_usuario` =  $id_usua";
				$qtd_pastas_anterior = $conex->prepare($sql5);
				$qtd_pastas_anterior -> execute();
				foreach($qtd_pastas_anterior as $qtd_pas_a){
					$qtd_pasta_an=$qtd_pas_a['qtd_pastas'];
				}
				$sql5 = "UPDATE `tb_usuario` SET `qtd_pastas` = $qtd_pasta_an + 1 WHERE `tb_usuario`.`id_usuario` = $id_usua";
				$up_qtd_pastas = $conex->prepare($sql5);
				$up_qtd_pastas -> execute();
				if($_POST['raiz']==0){
					echo "<script>
								window.location='ArquivoCompartilhado.php';
							 </script>";	
				}
				else{
					echo "<script>
								window.location='ArquivoCompartilhado.php".$caminhoAtualC."';
							 </script>";	
				}
						
					}
		}
	}
?>