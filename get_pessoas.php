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

$nome_pessoa = $_POST['nome_pessoa'];
$id_user = $_SESSION['ID'];

$objDB = new db();
$link =  $objDB-> conect_mysql();

$sql = " SELECT U.*, US.* ";
$sql.= " FROM usuarios u ";
$sql.= " LEFT JOIN usuarios_seguidores AS US ";
$sql.= " ON US.ID_USUARIO = $id_user AND U.ID = US.SEGUINDO_ID_USUARIO ";
$sql.= " WHERE U.USUARIO LIKE '%$nome_pessoa%' AND U.ID <> $id_user ";

$resultado_select = mysqli_query($link, $sql);

if($resultado_select){

    while($registro = mysqli_fetch_array($resultado_select, MYSQLI_ASSOC)){
        echo '<a href=# class="list-group-item">';
            echo '<strong>'.$registro['USUARIO'].'</strong><small>-'.$registro['EMAIL'].'</small>';
            echo '<p class="list-group-item-text pull-right">';

                $esta_seguindo_usuario_sn = isset($registro['ID_USUARIO_SEGUIDOR']) && !empty($registro['ID_USUARIO_SEGUIDOR']) ? 'S' : 'N';

                $btn_seguir_display = 'block';
                $btn_deixar_seguir_display = 'block';

                if($esta_seguindo_usuario_sn == "N"){
                    $btn_deixar_seguir_display = 'none';
                }
                else
                {
                    $btn_seguir_display = 'none';
                }

                echo '<button type="button" id="btn_seguir_'.$registro['ID'].'" class="btn btn-default btn_seguir"  style="display:'.$btn_seguir_display.'" data-id_usuario="'.$registro['ID'].'">Seguir</button>';
                echo '<button type="button" id="btn_deixar_seguir_'.$registro['ID'].'" class="btn btn-primary btn_deixar_seguir" style="display:'.$btn_deixar_seguir_display.'" data-id_usuario="'.$registro['ID'].'">Deixar de Seguir</button>';
        echo '</p>';
            echo '<div class="clearfix"></div>';
        echo '</a>';
    }
}
else{
    echo 'Erro na consulta de usuários no banco de dados';
}
?>

