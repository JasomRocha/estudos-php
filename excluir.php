<?php
require 'config.php';
require 'dao/UsuarioDAOMysql.php'; //puxando meu usario dao
  
$usuarioDao = new UsuarioDAOMysql($pdo); //instancio minha classe dao

$id = filter_input(INPUT_GET, 'id'); //irá receber o id que virá pela url

if($id){

   $usuarioDao->delete($id);

}

header('location:index.php'); //retorna para a página inicial
exit;

?>