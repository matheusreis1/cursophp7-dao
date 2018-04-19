<?php 

require_once("config.php");

$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tbUsuario");

echo json_encode($usuarios);

 ?>