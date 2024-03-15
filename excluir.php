<?php
require 'config.php'; //incluo os dados da conexão com o banco de dados 

$id = filter_input(INPUT_GET, 'id'); //irá receber o id que virá pela url

if($id){

    $sql = $pdo->prepare("DELETE FROM usuarios WHERE idusuarios = :id");
    $sql->bindValue(':id', $id);
    $sql->execute(); //Executa o comando sql

}

header('location:index.php'); //retorna para a página inicial
exit;

?>