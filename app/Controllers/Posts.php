<?php

class Posts extends Controller{

    public function __construct(){

        if (!Session::estaLogado()) {
            Url::redirect('Users/login');
        } else {
            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');
        }
    }

    public function index(){
        $dados = [
            'posts' => $this->postModel->lerPosts()
              ];

        $this->view('posts/index', $dados);
    }

    public function cadastrarPost(){

        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($form)) {
            $dados = [
                'titulo' => trim($form['titulo']),
                'texto' => trim($form['texto']),
                'usuario_id' => $_SESSION['usuario_id']
            ];

            if (in_array('', $form)) {

                if (empty($form['titulo'])) {
                    $dados['titulo_erro'] = 'Preencha o campo Título';
                }

                if (empty($form['texto'])) {
                    $dados['texto_erro'] = 'Preencha o campo Texto';
                }
            } else {
                if ($this->postModel->armazenar($dados)) {
                    Session::msgAlerta('posts', 'Post armazenado no Banco de dados');
                    Url::redirect('Posts/index');
                } else {
                    die('Erro ao armazenar o post no banco de dados');
                }
            }
        } else {
            $dados = [
                'titulo' => null,
                'texto' => null,
                'tutulo_erro' => null,
                'texto_erro' => null
            ];
        }

        $this->view('posts/cadastrar', $dados);
    }

    public function editarPost($id){

        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($form)) {
            $dados = [
                'id' => $id,
                'titulo' => trim($form['titulo']),
                'texto' => trim($form['texto'])

            ];

            if (in_array('', $form)) {

                if (empty($form['titulo'])) {
                    $dados['titulo_erro'] = 'Preencha o campo Título';
                }

                if (empty($form['texto'])) {
                    $dados['texto_erro'] = 'Preencha o campo Texto';
                }
            } else {
                if ($this->postModel->atualizar($dados)) {
                    Session::msgAlerta('posts', 'Post editado com sucesso');
                    Url::redirect('Posts/index');
                } else {
                    die('Erro ao atualizar o post');
                }
            }
        } else {

            $post = $this->postModel->lerPostPorId($id);

            if ($post->usuario_id != $_SESSION['usuario_id']) {
                Session::msgAlerta('posts', 'Você não tem autorização pra editar esse post', 'alert alert-danger');
                Url::redirect('posts');
            }

            $dados = [
                'id' => $post->id,
                'titulo' => $post->titulo,
                'texto' => $post->texto,
                'tutulo_erro' => null,
                'texto_erro' => null
            ];
        }

        $this->view('posts/editar', $dados);
    }

    public function show($id){
        $post = $this->postModel->lerPostPorId($id);
        $usuario = $this->userModel->lerUserPorId($post->usuario_id);

        $dados = [
            'post' => $post,
            'usuario' => $usuario
        ];

        $this->view('posts/show', $dados);
    }

    public function delete($id){

       if(!$this->checarAutorizacao($id)){

        $id = filter_var($id, FILTER_VALIDATE_INT);
        $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

        if($id && $metodo == 'POST'){
            if($this->postModel->destruir($id)){
                Session::msgAlerta('posts', 'Post deletado com sucesso');
                Url::redirect('posts');
            }

           } else {
            Session::msgAlerta('posts', 'Você não tem autorização pra deletar esse post', 'alert alert-danger');
            Url::redirect('posts');
         }
    
    } else {
          Session::msgAlerta('posts', 'Você não tem autorização pra deletar esse post', 'alert alert-danger');
              Url::redirect('posts');
        }

        echo "<hr>";
        var_dump($metodo);
        echo "<hr>";
        var_dump($id);
       
}         

         private function checarAutorizacao($id){
           
            $post = $this->postModel->lerPostPorId($id);

            if ($post->usuario_id != $_SESSION['usuario_id']) {
                return true;
         } else {
             return false;
         }

    }
}

