<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 28/01/2018
 * Time: 12:20
 */
class db{

    private $host = 'localhost';

    private $usuario = 'root';

    private $senha = '';

    private $database = 'twitter_clone';

    public function conect_mysql(){

        //conexao com bd
        $con = mysqli_connect($this -> host, $this-> usuario, $this->senha, $this->database);

        //ajusta o charset de comunicação entre app e bd
        mysqli_set_charset($con, 'utf8');

        //verificar se ouve erro
        if(mysqli_connect_errno())
        {
            echo 'Ouve um erro ao tentar se conectar com o banco de dados MySQL: '.mysqli_connect_error();
        }

        return $con;
    }
}

?>