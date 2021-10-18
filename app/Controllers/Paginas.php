<?php

class Paginas extends Controller{

    public function index(){

        if(Session::estaLogado()){
            Url::redirect('posts');
            }

    $dados =  [
        'tituloPagina' => 'Página inicial'
        ];

        $this->view('paginas/home', $dados);
    }

    public function sobre(){
        $dados = [
            'tituloPagina' => APP_NOME 
        ];
    
            $this->view('paginas/sobre', $dados);
        
    }

}