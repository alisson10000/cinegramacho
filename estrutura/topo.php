<?php
header('Content-Type: text/html; charset=utf-8');
/* mysql_query("SET NAMES 'utf-8'");
  mysql_query('SET charset_set_connection=utf8');
  mysql_query('SET charset_set_client=utf8');
  mysql_query('SET charset_set_results=utf8');
 */
require_once './servicos/classes/Conexao.php';
require_once './estrutura/variaveisGlobais.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="utf-8">
        <title>cinegramacho</title>
        <link rel="icon" type="image/ico" href="img/camera.png" />

        <style>
            @import url('css/raiz.css');
        </style>
        <script src="./js/funcoes.js" lang="text/javascript"></script>
        <script src="./js/funcoesCadastroFilme.js" lang="text/javascript"></script>
        <script src="./js/funcoesCadastroSeries.js" lang="text/javascript"></script>
        <script src="./js/tinymce.min.js"></script>
        <script>tinymce.init({selector: 'texto'});</script>
        <script src="./js/funcoes_series.js" lang="text/javascript"></script>
        <script src="./js/ajax.js" lang="text/javascript"></script>
    </head>
    <body onload="apagaMensagemOk()">
        <div class="topo">
            <div class="conteudo_topo">
               
               <a style="text-decoration: none;" class="conteudo_topo" href="index.php"> cine gramacho</a>

            </div>

            <div class="busca">
                <form id="frm_busca" name="frm_busca" method="POST" action="resultado_busca_filme.php?resultadoBusca=1">
                    <input type="text" name="filme" id="filme" placeholder="Informe o nome de um filme para assistir">
                    <input  type="button" value="" onclick="valida_busca();">
                </form>
            </div>

        </div>

        <div class="conteudo_geral">

