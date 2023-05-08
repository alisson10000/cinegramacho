
<?php
require_once './servicos/classes/Conexao.php';
require_once './estrutura/variaveisGlobais.php';
require_once './servicos/verifica.php';



header('Content-Type: text/html; charset=utf-8');
/*mysql_query("SET NAMES 'utf-8'");
mysql_query('SET charset_set_connection=utf8');
mysql_query('SET charset_set_client=utf8');
mysql_query('SET charset_set_results=utf8');*/
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="icon" type="image/ico" href="img/camera.png" />
        <style>
            @import url('css/topoAdministrador.css');
            @import url('css/cadastroSeries.css');
            @import url('css/cadastroFilmes.css');
            @import url('css/menuSistema.css');
            @import url('css/exclusaoFilmes.css');
            @import url('css/exclusaoSeries.css');
            @import url('css/edicaoFilmes.css');
            @import url('css/edicaoSeries.css');
            @import url('css/containerGeralAdministrativo.css');



        </style>
        <script src="./js/funcoesCadastroFilme.js" lang="text/javascript"></script>
        <script src="./js/funcoes.js" lang="text/javascript"></script>
        <script src="./js/funcoesExcluirFilmes.js" lang="text/javascript"></script>
        <script src="./js/funcoesExcluirSeries.js" lang="text/javascript"></script>
        <script src="./js/funcoesCadastroSeries.js" lang="text/javascript"></script>
        <script src="./js/funcoesEditarFilmes.js" lang="text/javascript"></script>
        <script src="./js/funcoesEditarSeries.js" lang="text/javascript"></script>
        <script src="./js/tinymce.min.js"></script>
        <script>tinymce.init({selector: 'texto'});</script>
        <script src="./js/funcoes_series.js" lang="text/javascript"></script>
        <script src="./js/ajax.js" lang="text/javascript"></script>
        <script type="text/javascript" src="./js/jquery-1.6.4.min.js"></script> 
        <script type="text/javascript">
            $(document.frm_cadastro).ready(function () {
                $('#serie').change(function () {
                    var id = $('#serie').val();
                    $('#temporada').load('./servicos/selecionaTemporadaSerie.php?id=' + id);
                });
            });
        </script>
    </head>
    <body>


        <div id="conteudoTopo">

            <h1>  Sistema Cinegramacho</h1>


        </div>
        <div id="navegacaoSistemaConteudo">
            <div id="navegacaoSistema">
                <a href="cadastroFilme.php">  <span>cadastro filme</span></a>
                <a href="cadastroSerie.php"><span>cadastro serie</span></a>
                <a href="editarFilmes.php"><span>editar filme</span></a>
                <a href="editarSeries.php"><span>editar serie</span></a>
                <a href="excluirFilmes.php"><span>excluir filme</span></a>
                <a href="excluirSeries.php"><span>excluir série</span></a>
                <a href="./index.php" target="_blank"> <span>site cine gramacho</span></a>
                <a href="./servicos/sair.php"> <span>SAIR</span></a>
                <br >
                <h4>MENU</h4>
            </div>
        </div> 


        <div id="conteudo_geral">