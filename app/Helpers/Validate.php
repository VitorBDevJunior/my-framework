<?php

class Validate{

    public static function validarNome($nome){
        if(!preg_match('/^([áÁàÀãÃéEèÈêÊíÍìÌóÓòÒõÕôÔúÚùÙçÇaA-zZ]+)+((\s[áÁàÀãÃéEèÈêÊíÍìÌóÓòÒõÕôÔúÚùÙçÇaA-zZ]+)+)?$/', $nome)){
            return true;
        }else {
            return false;
        }
    }

    public static function validarEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }

    public static function dataBr($data){
        if(isset($data)){
            return date('d/m/Y H:i', strtotime($data));
        }
    }


}