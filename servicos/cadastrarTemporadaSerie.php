<?php

require_once './classes/Conexao.php';
require_once '../estrutura/variaveisGlobais.php';
$cadastrarTemporada = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo $idSerie = filter_input(INPUT_POST, 'idSerie', FILTER_DEFAULT);
echo $temporada = filter_input(INPUT_POST, 'numeroTemporada', FILTER_DEFAULT);
echo $dataTemporada = filter_input(INPUT_POST, 'dataTemporada', FILTER_DEFAULT);
echo $sinopseTemporada = filter_input(INPUT_POST, 'sinopseTemporada', FILTER_DEFAULT);


$sinopseTemporada = utf8_decode($sinopseTemporada);


$consulta = "select * from temporadas where id_serie='$idSerie' and 
numero_temporada='$temporada'";
$salvarTemporada="INSERT INTO temporadas VALUES ('','$idSerie','$temporada','$dataTemporada','$sinopseTemporada')";



if ($cadastrarTemporada->contaOcorrencias($consulta) > 0) {
    header("location: ../cadastroSerie.php?mensagem=0&selecionaFormulario=1");
} else {


$cadastrarTemporada->salvaOcorrencia($salvarTemporada);


   header("location: ../cadastroSerie.php?mensagem=1&selecionaFormulario=1");
}

