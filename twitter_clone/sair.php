<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 28/01/2018
 * Time: 14:10
 */

session_start();

unset($_SESSION['USUARIO']);
unset($_SESSION['EMAIL']);

echo 'Esperamos você de volta!';

header('Location: index.php');
?>