<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 28/01/2018
 * Time: 16:44
 */
session_start();

if(!isset($_SESSION['USUARIO']))
{
    header('Location: index.php?erro=1');
}

require_once('db.class.php');


$id_user = $_SESSION['ID'];
$seguir_id_usuario = $_POST['seguir_id_usuario'];

if($id_user == '' || $seguir_id_usuario == '') {
    die();
}

$objDB = new db();
$link =  $objDB-> conect_mysql();

$sql = "INSERT INTO USUARIOS_SEGUIDORES(ID_USUARIO, SEGUINDO_ID_USUARIO) VALUES($id_user, $seguir_id_usuario)";


mysqli_query($link, $sql);




?>