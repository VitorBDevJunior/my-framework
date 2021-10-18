<?php

class Url {
    public static function redirect($url){
        header('location: '.URL.DIRECTORY_SEPARATOR.$url);
    }
}
