<?php 

require_once("config.php");


//Carrega 1 usuário
//$jose = new Usuario();
//$jose->loadbyId(5);
//echo $jose;

//Carrega uma lista de usuários
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega uma lista de usuários buscando pelo login
//$search = Usuario::search("o");
//echo json_encode($search);

//Carrega um usuário usando o login e a senha
$usuario = new Usuario();
$usuario->login("root", "123");
echo $usuario;


 ?>