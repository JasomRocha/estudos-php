<?php

class Usuario{
    
    private $id;
    private $nome;
    private $email;

    //Meus metodos geters and seters
    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = trim($id);
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = ucWords(trim($nome));
    }

    public function getemail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = strtolower(trim($email));
    }
}

interface usuarioDAO{
    public function add(Usuario $u);
    public function findAll();
    public function findById($id);
    public function findByEmail($email);
    public function update(Usuario $id);
    public function delete($id);
}

?>