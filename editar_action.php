<?php
//Esse arquivo php tem por objetivo processar as inforamções recebidas via requisição HTTP
//o arquivo que faz as requisições é o arquivo editar.php

require 'config.php'; //Recupera os dados de conexão definidos no arquivo config.php

//Recebo os valores digitados no formulário, fazendo um filtro do que foi digitado
$id = filter_input(INPUT_POST, 'id'); //Essa informação vem da pagina editar por meio de post, mas poderia vir por meio de get
$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

//Testo se os valores existem e atenderam aos filtros
if($id && $name && $email){
    $sql = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email WHERE idusuarios = :id"); //Consulta SQL
    $sql->bindValue(':nome', $name); //Faço a associação do dado ocultado no comando sql
    $sql->bindValue(':email', $email);
    $sql->bindValue(':id', $id);

    $sql->execute();

    header("location:index.php"); //retorna para o index para exibir as alterações já na tabela 
    exit;
}
else{
    header("location:index.php"); //Caso algum parametro do if não atenda ou não seja recebido
    exit;
};

?>