<!DOCTYPE html>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar'])){
			include "classes/usuario.class.php";
			$usuarios = new Usuario();
			$usuarios->cadastrar_usuario($_POST['nome_usu'], $_POST['sobrenome_usu'], $_POST['email_usu'], $_POST['senha_usu']);
	}
?>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Cadastro</title>
    <link rel="shortcut icon" href="imagens_sistema/icon.png">
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
   <style>
  body {
  /* Location of the image */
  background-image: url("imagens_sistema/fundo.jpg");
  
  /* Background image is centered vertically and horizontally at all times */
  background-position: center center;
  
  /* Background image doesn't tile */
  background-repeat: no-repeat;
  
  /* Background image is fixed in the viewport so that it doesn't move when 
     the content's height is greater than the image's height */
  background-attachment: fixed;
  
  /* This is what makes the background image rescale based
     on the container's size */
  background-size: cover;
  
  /* Set a background color that will be displayed
     while the background image is loading */
  background-color: #464646;
}
  </style>
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
  <noscript>
	<meta http-equiv="Refresh" content="0;URL=erros/erroJava.html" />
	</noscript>	
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Crie sua conta</div>
      <div class="card-body">
        <form action="" method="POST">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Nome*</label>
                <input class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" name="nome_usu" placeholder="Digite seu primeiro nome" required autofocus>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Sobrenome*</label>
                <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" name="sobrenome_usu" placeholder="Digite seu sobrenome" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email*</label>
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" name="email_usu" placeholder="Digite seu email" required>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Senha*</label>
                <input class="form-control" id="exampleInputPassword1" type="password" name="senha_usu"  placeholder="Senha" minlength='8' required>
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Confirmar senha*</label>
                <input class="form-control" id="exampleConfirmPassword" type="password" name="conf_senha" onChange="ver_senha()" placeholder="Confirme sua senha" minlength='8' required>
              </div>
            </div>
          </div>
		    <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" required>Eu li e concordo com os <a href="termos.php" target="_blank">termos de uso</a></label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" type="submit" name="registrar">Registrar</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="index.php">Voltar</a>
          <a class="d-block small" href="forgot-password.php">Esqueceu sua senha?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/popper/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
