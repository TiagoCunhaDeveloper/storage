<?php
      session_start();
      $email = $_SESSION['emailParaRecuperacao'];
      date_default_timezone_set("America/Sao_Paulo");
      
      include 'inc/conexao.php';
      
        if( isset( $_SESSION['mensagem'] ) )
          {
              $msg = $_SESSION['mensagem'];
              unset($_SESSION["mensagem"]);  
              
              echo "<script>alert('$msg')</script>";
          }
      ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Recuperar senha</title>
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
  <noscript>
	<meta http-equiv="Refresh" content="0;URL=erros/erroJava.html" />
	</noscript>	
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Alterar senha</div>
	   <form  action="verificador.php" class="form-horizontal" method="post" role="form">
      <div class="card-body">
        <div class="text-center mt-4 mb-5">
          <h4>Redefina sua senha!</h4>
          <p>Informe sua nova senha e confirme-a.</p>
		   <input class="form-control" data-val="true" id="password" name="senha" placeholder="Digite uma nova senha" required="required" type="password" maxlength="16" value="" /> 
                          <br><input class="form-control" data-val="true" id="password" name="conf" placeholder="Confirme sua nova senha" required="required" type="password" maxlength="16" value="" />
        
        </div>
         <div class="text-center">
          <button class="btn btn-primary btn-block" type="submit">Redefinir senha</button>
          <input type="hidden" name="acao" value="recuperar" /> 
                           <input type="hidden" name="email" value="<?php echo $email; ?>" /> 
        </div>
      </div>
	  </form>
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
