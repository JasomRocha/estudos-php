<?php
require_once 'models/Usuario.php'; //Incluindo apenas uma vez 

class UsuarioDAOMysql implements UsuarioDAO{
   
    private $pdo; //criação de variável
    
    //Injeção de dependência 
    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }

    public function add(Usuario $u){

       $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:nome, :email)");
       $sql->bindValue(':nome', $u->getNome());
       $sql->bindValue(':email', $u->getEmail()); 
       $sql->execute();

       $u->setId( $this->pdo->lastInsertId());

       return $u;
    }

    public function findAll(){
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM usuarios");

        if($sql->rowCOunt() > 0){
            $data = $sql->fetchAll();

            //popular meus objetos a partir de cada retorno da consulta sql
            foreach($data as $item){
                $u = new Usuario(); //Instancio um usuario
                
                $u->setId($item['idusuarios']); //seto valores retornado pelo meu banco de dados 
                $u->setNome($item['nome']);
                $u->setEmail($item['email']);

                //populo meu array de objetos
                $array[] = $u;
            }
        }
        return $array;
    }

    public function findById($id){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE idusuarios = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch(); //Apenas um retorno especifico utiliza-se o fecth
            $u = new Usuario();
            $u->setId($data['idusuarios']);
            $u->setNome($data['nome']);
            $u->setEmail($data['email']);
            return $u;
        }else{
            return false;
        }
    }

    public function findByEmail($email){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch(); //Apenas um retorno especifico utiliza-se o fecth
            $u = new Usuario();
            $u->setId($data['idusuarios']);
            $u->setNome($data['nome']);
            $u->setEmail($data['email']);
            return $u;
        }else{
            return false;
        }
    }

    public function update(Usuario $u){
        $sql = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email WHERE idusuarios = :id");
        $sql->bindValue(':nome', $u->getNome());
        $sql->bindValue(':email', $u->getEmail());
        $sql->bindValue(':id', $u->getId());
        $sql->execute();

        return true;
    }

    public function delete($id){
        $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE idusuarios = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}

?>