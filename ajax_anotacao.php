<?php
include "inc/conexao.php";
$id = $_GET['id'];
$sql = "DELETE FROM `notes` WHERE `notes`.`id` = $id";
$del_nota = $conex -> prepare($sql);
$del_nota -> execute();
?>