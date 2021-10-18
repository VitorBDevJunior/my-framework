<?php

class User {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    
    public function checarEmail($email){
        $this->db->query("SELECT email FROM users WHERE email = :e");
        $this->db->bind(':e', $email);

        if($this->db->resultado()){ 
            return true;
        }else{
            return false;
        }
    }

    public function atualizar($dados){
            
            $this->db->query("UPDATE users SET nome = :nome, email = :email, senha = :senha, biografia = :biografia WHERE id = :id");

        $this->db->bind("id", $dados['id']);
        $this->db->bind("nome", $dados['nome']);
        $this->db->bind("email", $dados['email']);
        $this->db->bind("senha", $dados['senha']);
        $this->db->bind("biografia", $dados['biografia']);
          
        if($this->db->executar()){
                return true;
            } else {
                return false;
            }

 }

    
    public function checarLogin($email, $senha){
        $this->db->query("SELECT * FROM users WHERE email = :e");
        $this->db->bind(':e', $email);

        if($this->db->resultado()){   
            $resultado = $this->db->resultado();
            if(password_verify($senha, $resultado->senha)){
                return $resultado;
            }else{
                return false;
            }

          
        }else{
            return false;
        }
    }

    public function armazenar($dados){
        $this->db->query("INSERT INTO users (nome, email, senha) VALUES (:nome, :email, :senha)");
        $this->db->bind("nome", $dados['nome']);
        $this->db->bind("email", $dados['email']);
        $this->db->bind("senha", $dados['senha']);

        if($this->db->executar()){
            return true;
        }else{
            return false;
        }
    }

    public function lerUserPorId($id){
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind('id', $id);
        
        return $this->db->resultado();
     }
  }
