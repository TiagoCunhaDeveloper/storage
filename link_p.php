<?php
session_start();
include "inc/conexao.php"; 
	$hash=$_GET['c'];
	$editar=$_GET['ed'];
	$excluir=$_GET['e'];
	$arquivo=$_GET['a'];
	$sql00 ="SELECT * FROM tb_compartilhados WHERE hash = '$hash'";
	$link_recebido = $conex -> prepare($sql00);	
	$link_recebido -> execute();
	$existe = $link_recebido->rowCount();
	if($existe==0){
		header("Location:erros/erro_link.html");
	}
	else{
		if($editar!="e9064b74d28acc053231170bb8c858b3" && $editar!="4f876ab4493c98f6e241355c57136259" ){
			header("Location:erros/erro_link.html");
		}
		else{
			if($excluir!="e9064b74d28acc053231170bb8c858b3" && $excluir!="4f876ab4493c98f6e241355c57136259" ){
				header("Location:erros/erro_link.html");
			}
			else{
				foreach($link_recebido as $l_r){
					$id_usu=$l_r['fk_usuario'];
					$caminho_compartilhado=$l_r['caminho_compartilhado'];
					$nome_arquivo=$l_r['pessoas'];
				}
				if($editar=='e9064b74d28acc053231170bb8c858b3'){
					$editar="s";
				}
				else{
					$editar="n";
				}
				if($excluir=='e9064b74d28acc053231170bb8c858b3'){
					$excluir="s";
				}
				else{
					$excluir="n";
				}
				$_SESSION["id_usuario"]=$id_usu;
				$_SESSION["ed"]=$editar;
				$_SESSION["e"]=$excluir;
				if($arquivo=='e9064b74d28acc053231170bb8c858b3'){
					$_SESSION["arquivo_link"]=$nome_arquivo;
					$caminho_compartilhado_final_aux=str_replace("/".$nome_arquivo."","",$caminho_compartilhado);
					$caminho_compartilhado_final=str_replace("/","\\",$caminho_compartilhado_final_aux);
					$_SESSION["caminho_compartilhado"]=$caminho_compartilhado_final;
					$arquivo_compart_filt=str_replace("(","\(",$nome_arquivo);
					$arquivo_compart_filt1=str_replace(")","\)",$arquivo_compart_filt);
					$arquivo_compart_filt2=str_replace("[","\[",$arquivo_compart_filt1);
					$arquivo_compart_filt3=str_replace("]","\]",$arquivo_compart_filt2);
					header("Location:link.php#search=".$arquivo_compart_filt3);
				}
				else{
					$_SESSION["arquivo_link"]=0;
					$_SESSION["folder_link"]=$nome_arquivo;
					$caminho_compartilhado_final=str_replace("/","\\",$caminho_compartilhado);
					$_SESSION["caminho_compartilhado"]=$caminho_compartilhado_final;
					header("Location:link.php");
				}
			}
		}
	}
	
?>