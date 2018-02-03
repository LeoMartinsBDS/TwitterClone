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
$deixar_seguir_id_usuario = $_POST['deixar_seguir_id_usuario'];

if($id_user == '' || $deixar_seguir_id_usuario == '') {
    die();
}

$objDB = new db();
$link =  $objDB-> conect_mysql();

$sql = "DELETE FROM USUARIOS_SEGUIDORES WHERE ID_USUARIO = $id_user AND SEGUINDO_ID_USUARIO = $deixar_seguir_id_usuario";


mysqli_query($link, $sql);




?>