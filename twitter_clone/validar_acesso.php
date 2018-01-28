<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 28/01/2018
 * Time: 12:52
 */

session_start();

require_once('db.class.php');

$user = $_POST['usuario'];
$pass = md5($_POST['senha']);

$sql = "SELECT ID, USUARIO, EMAIL FROM USUARIOS WHERE USUARIO= '$user' AND SENHA= '$pass'";

$objDB = new db();
$link =  $objDB-> conect_mysql();

//executa a query
$resultado_id = mysqli_query($link, $sql);

if($resultado_id){
    //cria um array para 'salvar' os resultados da query
    $dados_user = mysqli_fetch_array($resultado_id);

    if(isset($dados_user['USUARIO'])){

        $_SESSION['USUARIO'] = $dados_user['USUARIO'];
        $_SESSION['EMAIL'] = $dados_user['EMAIL'];
        $_SESSION['ID'] = $dados_user['ID'];

        header('Location: home.php');
    }
    else
    {
        header('Location: index.php?erro=1');
    }
}else{
    echo 'Erro na execução da consulta, favor entrar em contato com o admin do site';
}





?>