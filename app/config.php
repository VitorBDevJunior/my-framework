<?php
//arquivo de configuração

define('DB', [
    'HOST' => 'localhost',
    'USUARIO' => 'root',
    'SENHA' => '',
    'DATABASE' => 'my_frame',
    'PORT' => '3306'
]);


// __FILE__ -- Constante Mágica. Retorna o caminho completo e o nome do arquivo
// dirname -- retorna o caminho/path do diretório pai


// define e const -- Define uma constante. As constantes não podem ser alteradas depois de declaradas.
define('APP', dirname(__FILE__));

define('URL', 'http://localhost/my-framework-mvc');

define('APP_NOME', 'Php Orientado a Objetos e MVC');

const APP_VERSAO ='Versão: 1.0.0.';

?>