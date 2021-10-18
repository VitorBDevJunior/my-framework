<?php

/*
    *classe Rota
    *Cria as URL, Carrega os controladores, métodos e parâmetros
    *FORMATO URL - /controlador/metodos/parametros



*/

class Rota{
    //atributos da classe
    private $controlador = 'Paginas';
    private $metodo = 'index';
    private $parametros = [];
    public function __construct(){
        //se a variavel existir joga a função url na variavel $url
        $url = $this->url() ? $this->url() : [0];

        //checando se o controlador existe \/
        if (file_exists('../app/Controllers/' . ucwords($url[0]) . '.php')) {
            //se existir seta como controlador \/
            //ucwords pega o 1º caractter e transforma em maiúsculo
            $this->controlador = ucwords($url[0]);
            //unset() -- Destrói a variavel especificada
            unset($url[0]);
        }
        //requere o controlador
        require_once '../app/Controllers/' . $this->controlador . '.php';
        //instancia o controlador
        $this->controlador = new $this->controlador;

        //checa se os métodos existem, segunda parte da url
        if (isset($url[1])) {
            //method_exists( checa se o parametro da classe existe)
            if (method_exists($this->controlador, $url[1])) {
                $this->metodo = $url[1];
                unset($url[1]);
            }
        }

        //checando se os parametros existem
        $this->parametros = $url ? array_values($url) : [];

        // call_user_func_array -- chama uma dada função de usuário com um array de parametros
        call_user_func_array([$this->controlador, $this->metodo], $this->parametros);
        //retorna a url em um array
    }
    public function url()
    {
        //p filtro FILTER_SANITIZE_URL remove todos os caracteres ilagais de uma url
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
        //verifica se a url existe
        if (isset($url)) {
            //trim() retira o espaço no início e final de uma string
            //rtrim() retira o espaço em branco (ou outros caracteres) do final da string
            $url = trim(rtrim($url, '/'));
            //explode($var) divide uma string em strings, retorna um array
            $url = explode('/', $url);
            return $url;
        }
    }
}
