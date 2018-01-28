<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 28/01/2018
 * Time: 17:13
 */

    session_start();

    if(!isset($_SESSION['USUARIO']))
    {
    header('Location: index.php?erro=1');
    }

    require_once('db.class.php');

    $id_user = $_SESSION['ID'];

    $objDB = new db();
    $link =  $objDB-> conect_mysql();

    //se quiser mostrar só de seu usuario, só colocar o id no select... SE COLOCAR .= CONCATENA A QUERY
    $sql = "SELECT DATE_FORMAT(T.DATA_INCLUSAO, '%d %b %Y %T ') AS DATA_INCLUSAO_FORMATADA, T.TWEET, U.USUARIO ";
    $sql.= " FROM TWEET T INNER JOIN USUARIOS U ON U.ID = T.ID_USUARIO";
    $sql.= " ORDER BY DATA_INCLUSAO DESC";


    $resultado_select = mysqli_query($link, $sql);

    if($resultado_select){

        while($registro = mysqli_fetch_array($resultado_select, MYSQLI_ASSOC)){
            echo '<a href=# class="list-group-item">';
                echo '<h4 class="list-group-item-heading">'.$registro['USUARIO']. '<small> -'.$registro['DATA_INCLUSAO_FORMATADA'].'</small></h4>';
                echo '<p class="list-group-item-text">'.$registro['TWEET'].'</p>';
            echo '</a>';
        }
    }
    else{
        echo 'Erro na consulta de tweets no banco de dados';
    }
?>

