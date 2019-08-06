<?php

// Error reporting
error_reporting(E_ALL^E_NOTICE);


include "../inc/conexao.php";
session_start();
	$id_usuario=$_SESSION["id_usuario"];
// Checking whether all input variables are in place:
if(!is_numeric($_POST['zindex']) || !isset($_POST['author']) || !isset($_POST['body']) || !in_array($_POST['color'],array('yellow','green','blue')))
die("0");

if(ini_get('magic_quotes_gpc'))
{
	// If magic_quotes setting is on, strip the leading slashes that are automatically added to the string:
	$_POST['author']=stripslashes($_POST['author']);
	$_POST['body']=stripslashes($_POST['body']);
}

// Escaping the input data:

$author = $_POST['author'];
$body = $_POST['body'];
$color = $_POST['color'];
$zindex = (int)$_POST['zindex'];


/* Inserting a new record in the notes DB: */
$sql = '	INSERT INTO notes (text,name,color,xyz,fk_usuario)
				VALUES ("'.$body.'","'.$author.'","'.$color.'","0x0x'.$zindex.'","'.$id_usuario.'")';
$insetNotes = $conex-> prepare($sql);
$insetNotes -> execute();
if(mysql_affected_rows($link)==1)
{
	// Return the id of the inserted row:
	echo mysql_insert_id($link);
}
else{
	echo '0';
} 

?>