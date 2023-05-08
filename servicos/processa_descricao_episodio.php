<?php

require_once '../estrutura/variaveisGlobais.php';
require_once './classes/Conexao.php';

$processaDescricaoEpisodio = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);
$processaDescricaoEpisodio->conectar();


$id_serie=$_POST['cod_serie'];
$numero_temporada=$_POST['numero_temporada'];
$episodio=$_POST['episodio'];


$descricao_temporada = "select numero_temporada, numero_episodio, nome_episodio,descricao_episodio from series s INNER JOIN temporadas t ON s.id_serie=t.id_serie INNER JOIN episodios e ON t.id_temporada=e.id_temporada WHERE s.id_serie=$id_serie AND t.numero_temporada=$numero_temporada AND e.numero_episodio=$episodio";



$numeroTemporada = $processaDescricaoEpisodio->listaOcorrencia($descricao_temporada, "numero_temporada");
$nomeEpisodio = $processaDescricaoEpisodio->listaOcorrencia($descricao_temporada, "nome_episodio");
$numeroEpisodio = $processaDescricaoEpisodio->listaOcorrencia($descricao_temporada, "numero_episodio");
$descricaoEpisodio = $processaDescricaoEpisodio->listaOcorrencia($descricao_temporada, "descricao_episodio");



for ($index = 0; $index < count($numeroTemporada); $index++) {
 
    echo "<h3>{$numeroTemporada[$index] } ª temporada <br> episódio {$numeroEpisodio[$index]}: ".utf8_encode($nomeEpisodio[$index])."</h3>";
    echo "<p>".utf8_encode($descricaoEpisodio[$index])."</p>";
}
              
  








