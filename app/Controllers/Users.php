<?php

class Users extends Controller{

    public function __construct(){
        $this->userModel = $this->model('User');
    }

    public function perfil($id){
        //busca o usuario no model pelo seu ID
        $usuario = $this->userModel->lerUserPorId($id);

        //recebe os dados do formulário e os filtra
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($form)){
            //define os dados
            $dados = [
                'id' => $id,
                'nome' => trim($form['nome']),
                'email' => trim($form['email']),
                'senha' => trim($form['senha']),
                'biografia' => trim($form['biografia'])
            ]; 
            //checa se o campo de senha está vazio
            if(empty($form['senha'])){
                //define a senha como a senha do usuário no banco de dados
                $dados['senha'] = $usuario->senha;

            } else {
                //se o campo de senha não tiver vazio, codifica a senha
                $dados['senha'] = password_hash($form['senha'], PASSWORD_DEFAULT);
            }
            //se a biografia estiver vazia receba a mesma biografia do banco
            if(empty($form['biografia'])){
                $dados['biografia'] = $usuario->biografia;
            }
            //checa se existe campos em branco
            if(in_array("", $dados)){

                if(empty($form['nome'])){
                    $dados['nome_erro'] = 'Preencha o campo nome';
                }
                if(empty($form['email'])){
                    $dados['email_erro'] = 'Preencha o campo email';
                }

            } else{
                //checa se o email do formulário é do usuario do banco de dados
                if($form['email'] == $usuario->email){
                    $this->userModel->atualizar($dados);
                    Session::msgAlerta('usuario', 'Perfil atualizado com sucesso');
                } elseif(!$this->userModel->checarEmail($form['email'])){
                    $this->userModel->atualizar($dados);
                    Session::msgAlerta('usuario', 'Perfil atualizado com sucesso');
                } else{
                    $dados['email_erro'] = 'O e-mail informado já está cadastrado';
                }
            }
    } else {      
            //verifica se o usuario tem autorização pra editar seu perfil 
            if($usuario->id != $_SESSION['usuario_id']){
                Session::msgAlerta('posts', 'Você não tem autorização para editar esse perfil', 'alert alert-danger');
                Url::redirect('posts');
            } 
            //define os dados da view
            $dados = [
                'id' => $usuario->id,
                'nome' => $usuario->nome,
                'email' => $usuario->email,
                'biografia' => $usuario->biografia,
                'nome_erro' => '',
                'email_erro' => '',
                'senha_erro' => ''
            ];
        }
    
            print_r($id);
        return $this->view('usuarios/perfil', $dados);
               

 }

    public function cadastrar(){

        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($form)) {
            $dados = [
                'nome' => trim($form['nome']),
                'email' => trim($form['email']),
                'senha' => trim($form['senha']),
                'confirmar_senha' => trim($form['confirmar_senha'])
            ];

            if (in_array('', $form)) {

                if (empty($form['nome'])) {
                    $dados['nome_erro'] = 'Preencha o campo nome';
                }

                if (empty($form['email'])) {
                    $dados['email_erro'] = 'Preencha o campo email';
                }

                if (empty($form['senha'])) {
                    $dados['senha_erro'] = 'Preencha o campo senha';
                }

                if (empty($form['confirmar_senha'])) {
                    $dados['confirmar_senha_erro'] = 'Confirme a senha';
                }
            } else {
                if (Validate::validarNome($form['nome'])) {
                    $dados['nome_erro'] = 'O nome informado é inválido';
                } elseif (Validate::validarEmail($form['email'])) {
                    $dados['email_erro'] = 'O E-mail informado é inválido';
                } elseif ($this->userModel->checarEmail($form['email'])) {
                    $dados['email_erro'] = 'O E-mail informado já está cadastrado';
                } elseif (strlen($form['senha']) < 6) {
                    $dados['senha_erro'] = 'A senha deve ter no mínimo 6 caracteres';
                } elseif ($form['senha'] != $form['confirmar_senha']) {
                    $dados['confirmar_senha_erro'] = 'A senha e a confirmação devem ser idênticas';
                } else {
                    $dados['senha'] = password_hash($form['senha'], PASSWORD_ARGON2ID);

                    if ($this->userModel->armazenar($dados)) {
                        Session::msgAlerta('usuario', 'Cadastro realizado com sucesso');
                        Url::redirect('Users/login');
                    } else {
                        die('Erro ao armazenar usuário no banco de dados');
                    }
                }
            }

            //  echo $form['senha'];
            print_r($form);
        } else {
            $dados = [
                'nome' => null,
                'email' => null,
                'senha' => null,
                'confirmar_senha' => null,
                'nome_erro' => null,
                'email_erro' => null,
                'password_erro' => null,
                'confirmar_senha_erro' => null
            ];
        }

        $this->view('usuarios/cadastrar', $dados);
    }

    public function login() {

        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($form)) {
            $dados = [
                'email' => trim($form['email']),
                'senha' => trim($form['senha']),
            ];

            if (in_array('', $form)) {

                if (empty($form['email'])) {
                    $dados['email_erro'] = 'Preencha o campo email';
                }

                if (empty($form['senha'])) {
                    $dados['senha_erro'] = 'Preencha o campo senha';
                }
            } else {

                if (Validate::validarEmail($form['email'])) {
                    $dados['email_erro'] = 'O E-mail informado é inválido';
                } else {

                    $usuario = $this->userModel->checarLogin($form['email'], $form['senha']);

                    if ($usuario) {
                        $this->createSession($usuario);
                    } else {
                        Session::msgAlerta('usuario', 'Usuário e/ou senha inválidos', 'alert alert-danger');
                    }
                }
            }
        } else {
            $dados = [
                'email' => null,
                'senha' => null,
                'email_erro' => null,
                'senha_erro' => null
            ];
        }

        $this->view('usuarios/login', $dados);
    }

    private function createSession($usuario)
    {
        $_SESSION['usuario_id'] = $usuario->id;
        $_SESSION['usuario_nome'] = $usuario->nome;
        $_SESSION['usuario_email'] = $usuario->email;

        Url::redirect('Posts/index');
    }

    public function sair()
    {
        unset($_SESSION['usuario_id']);
        unset($_SESSION['usuario_nome']);
        unset($_SESSION['usuario_email']);

        session_destroy();

        Url::redirect('Users/login'); //Controlador->metodo e o método carrega a view
    }
}
