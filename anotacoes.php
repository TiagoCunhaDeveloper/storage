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
	

$query = "SELECT * FROM notes WHERE fk_usuario =$id_usuario ORDER BY id DESC ";
$notesSelect = $conex-> prepare($query);
$notesSelect -> execute();

$notes = '';
$left='';
$top='';
$zindex='';

foreach($notesSelect as $n_s)
{
	// The xyz column holds the position and z-index in the form 200x100x10:
	list($left,$top,$zindex) = explode('x',$n_s['xyz']);

	$notes.= '
	<div class="note '.$n_s['color'].'" style="left:'.$left.'px;top:'.$top.'px;z-index:'.$zindex.';" ondblclick="excluir(\''.$n_s['id'].'\')">
		<div class="author" >'.htmlspecialchars($n_s['name']).'</div>
		'.htmlspecialchars($n_s['text']).'
		
		<span class="data">'.$n_s['id'].'</span>
		
	</div>';
}

?>

<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Anotações</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link rel="shortcut icon" href="imagens_sistema/icon.png">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.2.6.css" media="screen" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="fancybox/jquery.fancybox-1.2.6.pack.js"></script>

<script type="text/javascript" src="js/script.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>
	function excluir(id){
		var msg = confirm("Deseja excluir essa anotação ?");
		if(msg == true){
			$.ajax({
			   url: 'ajax_anotacao.php?id='+id,
			   data: {
				  format: 'json'
			   },
			   error: function() {
				  $('#info').html('<p>An error has occurred</p>');
			   },
			   dataType: 'jsonp',
			   success: function(data) {
				
			   },
			   type: 'GET'
		});
		 // objeto com id alvo que recebe o click
setTimeout(function () {
        window.location.reload(1);
    }, 250);
}
      }
	  
	
</script>
</head>

<body <?php if($estilo==0){echo'class="fixed-nav sticky-footer bg-dark"';}else{ echo'class="fixed-nav sticky-footer bg-light"';}?> id="page-top" >
  <!-- Navigation-->
       <?php
	$menu=3;
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
         Anotações
		  
        </li>
       
      </ol>
      <div class="card mb-3">
	   <div   style="height:600px;" id="main">
        <a id="addButton" class="green-button" href="add_note.html">Add <i class="fa fa-sticky-note" aria-hidden="true"></i></a>
    
	<?php echo $notes; ?>
      
	  </div>
	  <div class="card-footer small text-muted">Para excluir uma anotação clique duas vezes nela.</div>
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
	
	
   <!-- <script src="vendor/jquery/jquery.min.js"></script>-->

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->

    <!-- Page level plugin JavaScript-->
   
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->

    <!-- Core plugin JavaScript-->
   
  </div>
</body>

</html>
