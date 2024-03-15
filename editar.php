<?php
require 'config.php';
require 'dao/UsuarioDAOMysql.php'; //puxando meu usario dao
  
$usuarioDao = new UsuarioDAOMysql($pdo); //instancio minha classe dao

$usuario = false; 
$id = filter_input(INPUT_GET, 'id'); //irá receber o id que virá pela url

if($id){
    $usuario = $usuarioDao->findById($id); //Verifica se o id existe e caso exista    
}

if($usuario === false ){
    header("Location: index.php");
    exit;
}

?>

<h1>Editar Usuário</h1>

<form method="POST" action="editar_action.php">
    <input type="hidden" name="id" value="<?=$usuario->getId();?>" />
    <label>
        NOME:</br>
        <input type="text" name="name" value=<?=$usuario->getNome();?> />
    </label>
    </br>
    </br>
    <label>
        E-MAIL:</br>
        <input type="email" name="email" value=<?=$usuario->getEmail();?> />
    </label>
    </br>
    </br> 

    <input type = "submit" value = "adicionar"/>
</form>