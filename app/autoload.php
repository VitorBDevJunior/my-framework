<?php
    spl_autoload_register(function ($class){

        $diretorios = [
            'Libraries',
            'Helpers'
        ];

        foreach($diretorios as $diretorio){
            $arquivo = (__DIR__.DIRECTORY_SEPARATOR.$diretorio.DIRECTORY_SEPARATOR.$class.'.php');
            if(file_exists($arquivo)){
                require_once $arquivo;
            }
        }

    });

