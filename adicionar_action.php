<?php
  require 'config.php';
  require 'dao/UsuarioDAOMysql.php'; //puxando meu usario dao
  $usuarioDao = new UsuarioDAOMysql($pdo); //instancio minha classe dao

//Recebo os valores digitados no formulário, fazendo um filtro do que foi digitado
$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

//Testo se os valores existem e atenderam aos filtros
if($name && $email){
    
    if($usuarioDao->findByEmail($email) === false){
        $novoUsuario = new Usuario();
        $novoUsuario->setNome($name);
        $novoUsuario->setEmail($email);

        $usuarioDao->add($novoUsuario);

        header("Location: index.php");
        exit();
    }else {
        header("Location: adicionar.php");
    }


    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email"); //Consulto se na  minha tabela já existe alguem cadastrado com esse email
    $sql->bindValue(':email', $email);
    $sql->execute(); //Executo o comando no banco de dados que irá retornar uma tabela 

    $retornos = $sql->rowCount(); //Conto as linhas dessa tabela que foi retornada pela consulta do prepare()
    
    if($retornos === 0){
        $sql = $pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:name, :email)"); //Monto meu comando sql
        $sql->bindValue(':name', $name); //digo quem são os valores omitidos
        $sql->bindValue(':email', $email); //mesma coisa da loinha anterior

        $sql->execute(); //executo meu comando sql

        header("location:index.php"); //retorno para minha página de cadastro 
        exit;
    } else {
        header("location:index.php"); //retorno para minha página de cadastro 
        exit;
    }
}else{
    header("location:index.php");
    exit;
};

?>