<?php

class Session {

    public static function msgAlerta($nome, $texto = null, $class = null){
        if(!empty($nome)){
            if(!empty($texto) && empty($_SESSION[$nome])){
                if(!empty($_SESSION[$nome])){
                    unset($_SESSION[$nome]);
                }
                $_SESSION[$nome] = $texto;
                $_SESSION[$nome. 'class'] = $class;

            }elseif(!empty($_SESSION[$nome]) && empty($texto)){
                $class = !empty($_SESSION[$nome. 'class']) ? $_SESSION[$nome. 'class'] :'alert alert-success';
                echo '<div class="'.$class.'">'.$_SESSION[$nome].'</div>';

                unset($_SESSION[$nome]);
                unset($_SESSION[$nome. 'class']);
            }
        }

    }

    public static function estaLogado(){
        if(isset($_SESSION['usuario_id'])){
           return true;
        } else{
            return false;
        }   
    }
}
