<?php

require_once './classes/Conexao.php';
require_once '../estrutura/variaveisGlobais.php';

$cadastrarEpisodioSerie = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo "<br>".$tituloEpisodio = $_POST['tituloEpisodio'];
echo "<br>".$codigoSerie = $_POST['serie']; // Obs.: Aqui é informado o ID('código') da série e não o titulo.
echo "<br>".$idTemporada = $_POST['temporada'];//Obs.: Aqui é informado o ID('código') da temporada
echo "<br>".$capituloEpisodio = $_POST['numeroEpisodio'];//Número informado pelo cliente ao relizar cadastro 
echo "<br>".$dataEpisodio = $_POST['dataEpisodio'];
echo "<br>".$sinopseEpisodio = $_POST['sinopseEpisodio'];
$tituloEpisodio = utf8_decode($tituloEpisodio);
$tituloEpisodio = addcslashes($tituloEpisodio,"'");
$sinopseEpisodio = addcslashes($sinopseEpisodio,"'");





$sinopseEpisodio = utf8_decode($sinopseEpisodio);
$consulta=(
        "SELECT * from series s 
INNER JOIN temporadas t
on
s.id_serie=t.id_serie
INNER JOIN episodios e 
ON
t.id_temporada=e.id_temporada
WHERE
t.id_temporada='$idTemporada'
and
numero_episodio='$capituloEpisodio'
        ");

echo "<br >Contagem do episódio: ".$cadastrarEpisodioSerie->contaOcorrencias($consulta);

$inserir ="INSERT INTO episodios VALUES ('','$idTemporada','$tituloEpisodio','$sinopseEpisodio','$capituloEpisodio','$dataEpisodio')";


if($cadastrarEpisodioSerie->contaOcorrencias($consulta) > 0){
    header("location: ../cadastroSerie.php?mensagem=5&&selecionaFormulario=2");
}else{
   
 $cadastrarEpisodioSerie->salvaOcorrencia($inserir);
    
    if($cadastrarEpisodioSerie->contaOcorrencias($consulta) > 0){
        header("location: ../cadastroSerie.php?mensagem=6&selecionaFormulario=2");
    }
    
    
    
    
}