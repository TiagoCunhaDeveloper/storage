<!DOCTYPE html>
<?php
session_start();
@$error=$_SESSION["Error"];
@$msg_error=$_SESSION["Msg_error"];
@$email_digitado=$_SESSION["Email_digitado"];
session_destroy();
?>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Entrar</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="imagens_sistema/icon.png">
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
  <noscript>
	<meta http-equiv="Refresh" content="0;URL=erros/erroJava.html" />
	</noscript>	
</head>

<body>
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header"><i class="fa fa-folder-open" aria-hidden="true"></i> Bem Vindo</div>
      <div class="card-body">
        <form action="login.php" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" name="email" placeholder="Digite seu email"  <?php if($error==1){ echo "style='border-color: #ec0400;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);box-shadow: inset 0 1px 1px rgba(0,0,0,.075);}'value='".$email_digitado."';";}else{ echo"autofocus";} ?>>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input class="form-control" id="exampleInputPassword1" type="password" name="senha" placeholder="Senha" <?php if($error==1){ echo "style='border-color: #ec0400;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);box-shadow: inset 0 1px 1px rgba(0,0,0,.075);}'";} ?>>
          </div>
		  <?php if($error==1){ echo "<b>Email e ou senha errados!</b><script>document.getElementById('exampleInputPassword1').focus();</script>";} ?>
           <button class="btn btn-primary btn-block" type="submit" name="logar">Entrar</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Crie sua conta</a>
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
