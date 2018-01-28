<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 28/01/2018
 * Time: 12:13
 */

require_once('db.class.php');

$user = $_POST['usuario'];
$mail = $_POST['email'];
$pass = md5($_POST['senha']);


    $objDB = new db();
    $link =  $objDB-> conect_mysql();

    $usuario_existe = false;
    $email_existe = false;

    //verificar se o usuario já existe
    $sql = "SELECT *FROM USUARIOS WHERE USUARIO = '$user'";
    if($resultado_id = mysqli_query($link, $sql))
    {
        $dados_usuario = mysqli_fetch_array($resultado_id);

        if(isset($dados_usuario['USUARIO'])){
            echo 'Usuário já cadastrado';
            $usuario_existe = true;
        }
    }
    else{
        echo 'Erro ao tentar localizar o registro';
    }

    //verificar se o email já existe
    $sql = "SELECT *FROM USUARIOS WHERE EMAIL = '$mail'";
    if($resultado_id = mysqli_query($link, $sql))
    {
        $dados_usuario = mysqli_fetch_array($resultado_id);

        if(isset($dados_usuario['USUARIO'])){
            echo 'Email já cadastrado';
            $email_existe = true;
        }
    }
    else{
        echo 'Erro ao tentar localizar o registro';
    }


    if($usuario_existe || $email_existe)
    {
        $retorno_get = '';

        if($usuario_existe)
        {
            $retorno_get.= "erro_usuario=1&";
        }
        if($email_existe)
        {
            $retorno_get.= "erro_email=1&";
        }
        header('Location: inscrevase.php?'.$retorno_get);
        die();
    }



    $sql = "INSERT INTO USUARIOS(USUARIO,EMAIL,SENHA) VALUES('$user', '$mail', '$pass')";

    if(mysqli_query($link,$sql)){

        header('Location: index.php?ok=1');
        echo 'Usuário registrado com sucesso!';
    }
    else{
        echo 'Erro ao regisrar o usuário';
    }

 ?>