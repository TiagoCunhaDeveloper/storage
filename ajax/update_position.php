<?php

// Error reporting
error_reporting(E_ALL^E_NOTICE);

include "../inc/conexao.php";

// Validating the input data:
if(!is_numeric($_GET['id']) || !is_numeric($_GET['x']) || !is_numeric($_GET['y']) || !is_numeric($_GET['z']))
die("0");

// Escaping:
$id = (int)$_GET['id'];
$x = (int)$_GET['x'];
$y = (int)$_GET['y'];
$z = (int)$_GET['z'];

// Saving the position and z-index of the note:
$sql = "UPDATE notes SET xyz='".$x."x".$y."x".$z."' WHERE id=".$id;
$upNotes = $conex-> prepare($sql);
$upNotes -> execute();
echo "1";
?>