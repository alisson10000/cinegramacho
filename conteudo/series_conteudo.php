<div class="conteudo_pagina">
    <?php
    $id_serie = $_GET['id'];
    $nome_serie = $_GET['serie'];

    $seriesConteudo = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);



    $resumo = "select DISTINCT nome_serie,s.id_serie, descricao_serie,ano_lancamento_serie  from series s
inner join
temporadas t
on
s.id_serie=t.id_serie
where 
s.id_serie='$id_serie'";





    $nomeSerie = $seriesConteudo->listaOcorrencia($resumo, "nome_serie");
    $idSerie = $seriesConteudo->listaOcorrencia($resumo, "id_serie");
    $descricaoSerie = $seriesConteudo->listaOcorrencia($resumo, "descricao_serie");
    $anoSerie = $seriesConteudo->listaOcorrencia($resumo, "ano_lancamento_serie");
    ?>
    <div class="descricao_serie_principal">
        <img src="./img/<?php echo $nome_serie; ?>.jpg">


        <?php
        echo "<h1 title='$nome_serie'>" . ucwords($nome_serie) . "</h1>";






//while ($row = mysql_fetch_array($resumo)) {

        for ($index = 0; $index < count($idSerie); $index++) {





            echo "<h2>Série:" . ucwords($nomeSerie[$index]) . "</h2>";
            echo "<h2>Lançamento :" . $anoSerie[$index] . "</h2>";


            echo "<p>Sinopse:<br>" . utf8_encode($descricaoSerie[$index]) . "</p>";
        }
        ?>

    </div>
    <div class="conteudo_series">
        <?php
        $busca_temporadas = "SELECT * FROM temporadas WHERE id_serie=$id_serie";

        $numeroTemporada = $seriesConteudo->listaOcorrencia($busca_temporadas, "numero_temporada");
        $idTemporada = $seriesConteudo->listaOcorrencia($busca_temporadas, "id_temporada");
        $anoTemporada = $seriesConteudo->listaOcorrencia($busca_temporadas, "ano_temporada");
        $descricaoTemporada = $seriesConteudo->listaOcorrencia($busca_temporadas, "descricao_temporada");




        $contador = 0;
// $valor=$_GET['valor'];



        for ($index = 0; $index < count($numeroTemporada); $index++) {




//while ($row = mysql_fetch_array($busca_temporadas)) {

            $numeroTemporada[$index];
            $descricaoTemporada[$index];
            ?>
        
        
            <input type="button"
                   onclick="processaEpisodio(<?php echo $id_serie; ?>,<?php echo $numeroTemporada[$index]; ?>)"   


                   onmouseover="processaDescricaoF(<?php echo $id_serie; ?>,<?php echo $numeroTemporada[$index]; ?>)" value="<?php echo 'temporada ' . $numeroTemporada[$index]; ?>" >
    <?php
    if (($contador % 6 == 0) and $contador = !1) {
        ?>
                <br><br>
                       <?php
                   }

                   $contador++;
               }
               ?>










        <div  id="textos_temporadas" onclick="fechaDescricao('textos_temporadas')"  >


        </div>


        <div id="episodios"     ondblclick="fechaDescricao('episodios');" >


        </div>


        <div id="descricao_episodio" >


        </div>

    </div>







