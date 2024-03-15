<?php
//Esse arquivo php tem por objetivo processar as inforamções recebidas via requisição HTTP
//o arquivo que faz as requisições é o arquivo editar.php

require 'config.php';
require 'dao/UsuarioDAOMysql.php'; //puxando meu usario dao
  
$usuarioDao = new UsuarioDAOMysql($pdo); //instancio minha classe dao


//Recebo os valores digitados no formulário, fazendo um filtro do que foi digitado
$id = filter_input(INPUT_POST, 'id'); //Essa informação vem da pagina editar por meio de post, mas poderia vir por meio de get
$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

//Testo se os valores existem e atenderam aos filtros
if($id && $name && $email){
    
    $usuario = $usuarioDao->findById($id); //variavel usuario recebe o objeto encontrado
    $usuario->setNome($name); // seta o nome igual o do objeto
    $usuario->setEmail($email); // seta o email igual o do objeto

    $usuarioDao->update( $usuario );
    
    header("location:index.php"); //retorna para o index para exibir as alterações já na tabela 
    exit;
}
else{
    header("location:editar.php?id=".$id); //Caso algum parametro do if não atenda ou não seja recebido
    exit;
};

?>