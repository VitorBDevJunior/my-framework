<?php

class Post {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function lerPosts(){
        $this->db->query("SELECT *,
        posts.id as postId,
        posts.created_at as postDataCadastro,
        users.id as userID,
        users.created_at as userDataCadastro
         FROM posts
         INNER JOIN users ON 
         posts.usuario_id = users.id
         ORDER BY posts.created_at DESC
         ");
        return $this->db->resultados();
    }

    public function armazenar($dados){
        $this->db->query("INSERT INTO posts (usuario_id, titulo, texto) VALUES (:usuario_id, :titulo, :texto)");
        $this->db->bind("usuario_id", $dados['usuario_id']);
        $this->db->bind("titulo", $dados['titulo']);
        $this->db->bind("texto", $dados['texto']);

        if($this->db->executar()){
            return true;
        }else{
            return false;   
         }
    }

    public function atualizar($dados){
        $this->db->query("UPDATE posts SET titulo = :titulo, texto = :texto WHERE id = :id");
        $this->db->bind("id", $dados['id']);
        $this->db->bind("titulo", $dados['titulo']);
        $this->db->bind("texto", $dados['texto']);

        if($this->db->executar()){
            return true;
        }else{
            return false;   
         }
    }


    public function lerPostPorId($id){
        $this->db->query("SELECT * FROM posts WHERE id = :id");
        $this->db->bind('id', $id);
        
        return $this->db->resultado();
    }

    public function destruir($id){
        $this->db->query("DELETE FROM posts WHERE id = :id");
        $this->db->bind("id", $id);
         if($this->db->executar()){
            return true;
        }else{
            return false;   
         }
    }

}