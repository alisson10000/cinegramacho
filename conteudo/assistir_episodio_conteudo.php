<?php
$id_serie = $_GET['serie'];
$numero_temporada = $_GET['temporada'];
$numero_episodio = $_GET['episodio'];

$assistirEpisodio = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);
$assistirEpisodio->conectar();


$busca_episodio = " 
select * from series s 
INNER JOIN temporadas t 
ON
s.id_serie=t.id_serie
INNER JOIN episodios e 
ON
t.id_temporada=e.id_temporada
WHERE
s.id_serie=$id_serie
AND
t.numero_temporada=$numero_temporada
and
e.numero_episodio=$numero_episodio";



$buscaQuantidadeEpisodio = "select nome_serie, nome_episodio from series s 
inner JOIN temporadas t 
ON
s.id_serie=t.id_serie
inner JOIN episodios e 
ON
t.id_temporada=e.id_temporada
WHERE
s.id_serie=$id_serie
AND
t.numero_temporada=$numero_temporada";



$nome_serie = $assistirEpisodio->listaOcorrencia($busca_episodio, "nome_serie");
$ano_temporada = $assistirEpisodio->listaOcorrencia($busca_episodio, "ano_temporada");
$nome_episodio = $assistirEpisodio->listaOcorrencia($busca_episodio, "nome_episodio");
$descricao_episodio = $assistirEpisodio->listaOcorrencia($busca_episodio, "descricao_episodio");
$quantidadeEpisodio = $assistirEpisodio->listaOcorrencia($buscaQuantidadeEpisodio, "nome_episodio");
$data_episodio = $assistirEpisodio->listaOcorrencia($busca_episodio, "data_episodio");
?>
<div class="conteudo_pagina">
    <div id="assistindo_episodio">


        <video width="400px" controls autoplay  preload="auto" >

            <source src="./series/<?php echo $nome_serie[0]; ?>/<?php echo $numero_temporada; ?>/<?php echo "$numero_episodio[0]"; ?>.mp4" type="video/mp4" preload="metadata" >
            <source src="./series/<?php echo $nome_serie[0]; ?>/<?php echo $numero_temporada; ?>/<?php echo "$numero_episodio"; ?>.mkv" >
            <track label="Portugues" kind="subtitles" srclang="pt" src="./series/<?php echo $nome_serie[0]; ?>/<?php echo $numero_temporada; ?>/<?php echo "$numero_episodio"; ?>.vtt">
        </video>

        <img src="./img/<?php echo $nome_serie[0]; ?>.jpg" >

        <?php
        if ($numero_episodio > 1) {
            $numero_episodio = (int) $numero_episodio;
            $numero_episodio_anterior = $numero_episodio - 1;
            ?>

            <a href="assistir_episodio.php?serie=<?php echo $id_serie ?>&temporada=<?php echo $numero_temporada; ?>&episodio=<?php echo $numero_episodio_anterior; ?>">anterior</a> 
            <?php
        }if ($numero_episodio < count($quantidadeEpisodio)) {

            $numero_episodio = (int) $numero_episodio;
            $numero_episodio_proximo = $numero_episodio + 1;
            ?>
            <a href="assistir_episodio.php?serie=<?php echo $id_serie ?>&temporada=<?php echo $numero_temporada; ?>&episodio=<?php echo $numero_episodio_proximo; ?>">proximo</a> 
            <?php
        }
        echo "<br F>Essa temporada tem " . count($quantidadeEpisodio) . " de episódios";



        echo "<h2>episodio {$numero_episodio}  :<br> $nome_episodio[0]</h2>";
        echo "<h3>serie: $nome_serie[0] </h3> ";
        echo "<h3>temporada $numero_temporada ª </h3>";
        echo "<h3>ano temporada : $ano_temporada[0]</h3>";
        echo "<h3>data de lançamento: " . date("d/m/Y", strtotime($data_episodio[0])) . "</h3>";
        echo "<h3>sinopse:</h3><p>  $descricao_episodio[0]  </p>";
        ?>

    </div>