<?php
class Database{

private $host = DB['HOST'];
private $usuario = DB['USUARIO'];
private $senha = DB['SENHA'];
private $banco = DB['DATABASE'];
private $port = DB['PORT'];
private $dbh;
private $stmt;

public function __construct(){

    $dsn = 'mysql:host='. $this->host. ';port=' .$this->port. ';dbname='. $this->banco;
    $opcoes = [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
/*Se o aplicativo não capturar a exceção lançada do construtor PDO(/\), a ação padrão executada pelo mecanismo zend é encerrar o script e exibir um rastreio de volta. Esse rastreamento provavelmente revelará todos os detalhes da conexão do banco de dados, incluindo o nome de usuário e a senha.
Para que isso não ocorra, após o app não capturar a exeption, deve-se capturar essa exceção, explicitamente (por meio de uma instrução catch como está abaixo)
capturar essa exeption, mostrar um erro e matar a sessão*/ 

    try {
        $this->dbh = new PDO($dsn, $this->usuario, $this->senha, $opcoes);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

}

//Prepared statement com query
public function query($sql){
    //prepara uma consulta sql
    $this->stmt = $this->dbh->prepare($sql);
}
//vincula um valor a um parâmetro
public function bind($param, $value, $type = null){
    if(is_null($type)){
        switch(true){
            case is_int($value):
                $type = PDO::PARAM_INT;
            break;  
            case is_bool($value): 
                $type = PDO::PARAM_BOOL; 
            break; 
            case is_null($value): 
                $type = PDO::PARAM_NULL;
            break; 
            default: 
                $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    //executa prepared statement
    public function executar(){
        return $this->stmt->execute();
    }

    //obtém um único registro
    public function resultado(){
        $this->executar();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    //obtém um conjunto de registros fetchAll
    public function resultados(){
        $this->executar();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    //retorna o número de linhas afetadas pela nossa instrução SQL
    public function totalResultados(){
        return $this->stmt->rowCount();
    }
    //retorna o último ID inserido no banco de dados
    public function ultimoIdInserido(){
        return $this->dbh->lastInsertId();
    }

    


}
?>