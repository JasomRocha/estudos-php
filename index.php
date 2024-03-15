<?php
  require 'config.php';
  require 'dao/UsuarioDAOMysql.php'; //puxando meu usario dao
  
  $usuarioDao = new UsuarioDAOMysql($pdo); //instancio minha classe dao
  $lista = $usuarioDao->findAll(); //Retorna todos os usuarios da Tabela usuarios no banco
  
?>

<a href="adicionar.php">ADICIONAR USUÁRIO</a>
<table border="1" width=100%>
  <tr>
    <th>ID</th>
    <th>NOME</th>
    <th>EMAIL</th>
    <th>AÇÕES</th>
  </tr>

  <?php foreach($lista as $usuario): ?>
    <tr>
      <td><?=$usuario->getId();?></td>
      <td><?=$usuario->getNome(); ?></td>
      <td><?=$usuario->getEmail(); ?></td>
      <td>
        <a href="editar.php?id=<?=$usuario->getId(); ?>"> [ EDITAR ] </a> 
        <a href="excluir.php?id=<?=$usuario->getId(); ?> " onclick="return confirm('Deseja realmente excluir esse usuario?')"> [ EXCLUIR ] </a>
      </td>
    </tr>
  <?php endforeach; ?> 
</table>

