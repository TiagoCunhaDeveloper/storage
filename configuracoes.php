<!DOCTYPE html>
<?php
session_start();
	$tipo=$_SESSION["tipo"];
	$id_usuario=$_SESSION["id_usuario"];
include "inc/conexao.php"; 
	$sql ="SELECT * FROM tb_usuario WHERE id_usuario = '$id_usuario'";
	$usu = $conex -> prepare($sql);	
	$usu -> execute();
	foreach($usu as $u){
		$estilo=$u['estilo'];
	}
 ?>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Configurações</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link rel="shortcut icon" href="imagens_sistema/icon.png">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet"/>
  <style>
  .switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 21px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 19px;
  width: 19px;
  left: 2px;
  bottom: 1px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
  </style>
  	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script>
    function ajax_estilo(numero){
      //var grupo = $('#grupo').val();
      if(numero > 0){
        $.ajax({
   url: 'ajax_estilo.php?id_usu='+numero,
   data: {
      format: 'json'
   },
   error: function() {
      $('#info').html('<p>An error has occurred</p>');
   },
   dataType: 'jsonp',
   success: function(data) {
      var $title = $('<h1>').text(data.talks[0].talk_title);
      var $description = $('<p>').text(data.talks[0].talk_description);
      $('#info')
         .append($title)
         .append($description);
   },
   type: 'GET'
});
      }
    }
    </script>
	<script>
  function ver_senha(){
	var senha      = document.getElementById("exampleInputPassword1").value;
	var conf_senha = document.getElementById("exampleConfirmPassword").value;
	if(senha != conf_senha){
		alert("Atenção, as senhas não coincidem.");
		document.getElementById("exampleInputPassword1").focus();
	}
	}
  </script>
</head>

<body <?php if($estilo==0){echo'class="fixed-nav sticky-footer bg-dark"';}else{ echo'class="fixed-nav sticky-footer bg-light"';}?> id="page-top">
  <!-- Navigation-->
  <?php
	$menu=0;
	if($tipo==1){
		include "naveg_adm.php";
	}
	else{
		include "naveg.php";
	}
	
	?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
         Configurações
		  
        </li>
        
      </ol>
      <!-- Icon Cards-->
     <div class="card-body">
        <form action="redefinir_senha.php" method="POST">
		<input type="hidden" value="<?php echo $id_usuario; ?>" name="id_usu">
		  <div class="form-group">
		  <label for="exampleConfirmPassword"><b>Mudar estilo</b></label>
            <div class="form-row">
			
              <div class="col-md-3">
                <label class="switch">
  <input type="checkbox" id="toggleNavColor" <?php echo'onclick="ajax_estilo('.$id_usuario.')"'; ?> <?php if($estilo==0){ echo "checked";} ?>  >
  <span class="slider round"></span>
</label>
              </div>
			     </div>
				  <label for="exampleConfirmPassword"><b>Redefinir senha</b></label>
				  		  <div class="form-row">
              <div class="col-md-3">
                
				<label for="exampleInputPassword1">Senha antiga</label>
                <input class="form-control" id="exampleInputPassword3" type="password" placeholder="Senha" minlength='8' required>
              </div>
          </div>
				  <div class="form-row">
              <div class="col-md-3">
                
				<label for="exampleInputPassword1">Nova senha</label>
                <input class="form-control" id="exampleInputPassword1" name="senha" type="password" placeholder="Senha" minlength='8' required>
              </div>
          </div>
      
             <div class="form-row">
              <div class="col-md-3">
                <label for="exampleConfirmPassword">Confirmar nova senha</label>
                <input class="form-control" id="exampleConfirmPassword" type="password" onChange="ver_senha()"  placeholder="Confirme sua senha" minlength='8' required>
              </div>
			     </div><br>
				 <div class="form-row">
              <div class="col-md-1">
               <button class="btn btn-primary btn-block" type="submit" name="salvar">Salvar</button>
              </div>
			     </div>
				 
          </div>
          
        </form>
       
      </div>
      
      </div>
	  </div>
      <!-- Example DataTables Card-->
   
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © GT Storage 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    
    <!-- Bootstrap core JavaScript-->
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="assets/js/script.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
<script>
$.noConflict();
// Code that uses other library's $ can follow here.
</script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
	<script>
    $('#toggleNavPosition').click(function() {
      $('body').toggleClass('fixed-nav');
      $('nav').toggleClass('fixed-top static-top');
    });

    </script>
    <!-- Toggle between dark and light navbar-->
    <script>
    $('#toggleNavColor').click(function() {
      $('nav').toggleClass('navbar-dark navbar-light');
      $('nav').toggleClass('bg-dark bg-light');
      $('body').toggleClass('bg-dark bg-light');
    });

    </script>
  </div>
</body>

</html>
