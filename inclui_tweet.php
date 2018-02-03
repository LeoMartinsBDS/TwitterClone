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

$texto_tweet = $_POST['texto_tweet'];
$id_user = $_SESSION['ID'];

if($texto_tweet == '' || $id_user == '') {
    die();
}

$objDB = new db();
$link =  $objDB-> conect_mysql();

$sql = "INSERT INTO TWEET(ID_USUARIO, TWEET) VALUES('$id_user', '$texto_tweet')";

mysqli_query($link, $sql);




?>