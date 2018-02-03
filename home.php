<?php

    session_start();

    if(!isset($_SESSION['USUARIO']))
    {
        header('Location: index.php?erro=1');
    }

    $id_usuario = $_SESSION['ID'];
    //echo $id_usuario;

    //qtd de tweets
    $sql = "SELECT COUNT(*) AS QTD_TWEETS FROM TWEET WHERE ID_USUARIO = $id_usuario";

    //echo $sql;
    require_once('db.class.php');

    $objDB = new db();
    $link =  $objDB-> conect_mysql();

    $resultado_select = mysqli_query($link, $sql);

    $qtdTweets = 0;


    if($resultado_select)
    {
        $registro = mysqli_fetch_array($resultado_select, MYSQLI_ASSOC);
        $qtdTweets =  $registro['QTD_TWEETS'];
    }
    else
    {
        echo 'Erro ao executar query';
    }

    //qtd de seguidores
    $sql = "SELECT COUNT(*) AS QTD_SEGUIDORES FROM USUARIOS_SEGUIDORES WHERE seguindo_id_usuario = $id_usuario";

    //echo $sql;
    require_once('db.class.php');

    $objDB = new db();
    $link =  $objDB-> conect_mysql();

    $resultado_select = mysqli_query($link, $sql);

    $qtdSeguidores = 0;


    if($resultado_select)
    {
        $registro = mysqli_fetch_array($resultado_select, MYSQLI_ASSOC);
        $qtdSeguidores =  $registro['QTD_SEGUIDORES'];
    }
    else
    {
        echo 'Erro ao executar query';
    }
?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <title>Twitter clone</title>

    <!-- jquery - link cdn -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

    <!-- bootstrap - link cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <script type="text/javascript">
        $(document).ready(function () {
            //associar o evento de click ao botão
            $('#btn_tweet').click( function () {
               if($('#text_tweet').val().length > 0)
               {
                    $.ajax({
                        url: 'inclui_tweet.php',
                        method: 'post',
                        data: $('#form_tweet').serialize(),
                        success: function (data) {
                                $('#text_tweet').val('');
                                atualizaTweet();
                        }
                    });
               }
            });

            function atualizaTweet(){
                //carrega os tweets

                $.ajax({
                   url: 'get_Tweet.php',
                    success: function(data){
                       $('#tweets').html(data);

                    }
                });
            }

            atualizaTweet();
        });
    </script>


</head>

<body>

<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img src="imagens/icone_twitter.png" />
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="sair.php">Sair</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>


<div class="container">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
               <h4> <?= $_SESSION['USUARIO']?> </h4>

                <hr/>

                <div class="col-md-6">
                    TWEETS<BR/> <?=$qtdTweets?>
                </div>
                <div class="col-md-6">
                    SEGUIDORES<BR/> <?=$qtdSeguidores?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <form id="form_tweet" class="input-group">
                    <input type="text" name="texto_tweet" class="form-control" placeholder="O que está acontecendo agora?" maxlength="140" id="text_tweet">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="btn_tweet">Tweet</button>
                    </span>
                </form>
            </div>

            <div id="tweets" class="list-group">

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <h4><a href="procurar_pessoas.php">Procurar por pessoas</a></h4>
            </div>
        </div>
    </div>
</div>




<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>