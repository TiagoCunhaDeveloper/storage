<?php
	session_start();
	$id_usuario=$_SESSION["id_usuario"];
	include "inc/conexao.php"; 
	$caminho=$_POST['caminho'];
	
	$sql = "SELECT * FROM tb_compartilhados_interno INNER JOIN tb_usuario ON tb_compartilhados_interno.receptor_interno=tb_usuario.id_usuario WHERE caminho_compartilhado_interno='$caminho' AND fk_usuario= $id_usuario";
	$foiCompart = $conex -> prepare($sql);
	$foiCompart -> execute();
	$contfoiCompart=$foiCompart->rowCount();
	if($contfoiCompart>=1){
		echo '<br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered ">
                                    <thead>
                                        <tr>
											<th>Nome</th>
                                            <th>Email</th>
                                            <th>Permições</th>
                                            <th>Ações</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>';
		foreach($foiCompart as $f_c){
			$id_compartilhados_interno=$f_c['id_compartilhados_interno'];
			$receptor=$f_c['receptor_interno'];
			$nome_usu=$f_c['nome_usu'];
			$email_usu=$f_c['email_usu'];
			if(strlen($email_usu)>15){
				$nomeo = $email_usu;
				$nome_15 = substr($nomeo,0,15);
				$email_usu = $nome_15."<span title='$nomeo' style='cursor:pointer;'> ...</span>";
			}
			
			$opcoes_compart=$f_c['opcoes_compart'];
			switch ($opcoes_compart) {
					case 0:
						$opcoes_compartTxt='<option selected value="0">Visualizar</option><option value="1">Editar</option>
                                                <option value="2">Editar e excluir</option>';
						break;
					case 1:
						$opcoes_compartTxt='<option value="0">Visualizar</option><option selected value="1">Editar</option><option value="2">Editar e excluir</option>';
						break;
					case 2:
						$opcoes_compartTxt='<option value="0">Visualizar</option><option value="1">Editar</option><option selected value="2">Editar e excluir</option>';
					break;
				}
			echo '<tr>
                    <td>'.$nome_usu.'</td>
                    <td>'.$email_usu.'</td>
                    <td><select  class="form-control" style="width:120px;" id="opcoesCompar" onchange="ajax_o(this.value)">'.$opcoes_compartTxt.'</select></td>
                    <td><button type="button" title="Cancelar compartilhamento" onclick="ajax_cancelarCoparta('.$id_compartilhados_interno.')" style="background-color: #fff;border: 1px solid transparent;border-color: #ccc;padding: 3px 10px;"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button><input type="hidden" id="caminhoRecupera" value="'.$caminho.'"></td>
                  </tr>';
                                       
                              
		}
		 echo'     </tbody>
                                </table>
                            </div>
							<script>document.getElementById("verificadorCompartFa").value=1;</script>
                            <!-- /.table-responsive -->
                  ';
	}
	else{
		echo '<script>document.getElementById("verificadorCompartFa").value=0</script>';
	}
	
?>