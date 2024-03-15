<?php
require 'config.php'; //incluo os dados da conexão com o banco de dados 

$info = []; //Declaro uma lista vazia que irá receber os valores do usuário a ser editado
$id = filter_input(INPUT_GET, 'id'); //irá receber o id que virá pela url

if($id){
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE idusuarios = :id"); //consulta sql 
    $sql->bindValue(':id', $id); 
    
    $sql->execute(); //executa a consulta

    //verifica se a consulta retornou uma tabela com a quantidade de linahs maior que zero
    if($sql->rowCount()>0){
        $info = $sql->fetch(PDO::FETCH_ASSOC); //o fetch só pega o primeiro resultado retornado
    }else{
        header('location:index.php'); //retorna para a página inicial
        exit; 
    }
}else{
    header('location:index.php'); //retorna para a página inicial
    exit;
}
?>



<h1>Editar Usuário</h1>

<form method="POST" action="editar_action.php">
    <input type="hidden" name="id" value="<?=$info['idusuarios'];?>" />
    <label>
        NOME:</br>
        <input type="text" name="name" value=<?=$info['nome'];?> />
    </label>
    </br>
    </br>
    <label>
        E-MAIL:</br>
        <input type="email" name="email" value=<?=$info['email'];?> />
    </label>
    </br>
    </br> 

    <input type = "submit" value = "adicionar"/>
</form>