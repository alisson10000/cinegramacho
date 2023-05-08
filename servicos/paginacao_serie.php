<?php
$quantidade = 15;
$pagina = (isset($_GET['pagina'])) ? (int) $_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;
$consulta = "select * from series order by nome_serie asc limit $inicio,$quantidade ";
$catalogoSeries = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);



$idSerie = $catalogoSeries->listaOcorrencia($consulta, "id_serie");
$nomeSerie = $catalogoSeries->listaOcorrencia($consulta, "nome_serie");
$descricaoSerie = $catalogoSeries->listaOcorrencia($consulta, "descricao_serie");
$anoSerie = $catalogoSeries->listaOcorrencia($consulta, "ano_lancamento_serie");






$contador = 1;


//while ($row = mysql_fetch_array($qr)) {

for ($index = 0; $index < count($idSerie); $index++) {
    

    ?>

   <div class="poster"  onmouseover="mostrar_descricao(<?php
    echo $idSerie[$index];
    ?>,<?php echo $contador; ?>)" onmouseout="tirar_descricao(<?php 
     echo $idSerie[$index];
     ?>)">



        <a href="assistir_series.php?id=<?php echo $idSerie[$index]; ?>&serie=<?php echo $nomeSerie[$index]; ?>"  title="<?php $nomeSerie[$index]; echo strtoupper(str_replace("_", " ", $nomeSerie[$index])); ?>"> <img src="img/<?php echo $nomeSerie[$index]; ?>.jpg"></a>

        <div id="<?php  echo $idSerie[$index]; ?>" style="display: none;text-indent:3cm;" onmouseover="tirar_descricao(<?php echo $idSerie[$index]; ?>)">


            <?php
            
            
            echo "<p> Ano: ".$anoSerie[$index]."</p>";
          
            $descricaoSerie[$index] = utf8_encode($descricaoSerie[$index]);
            echo $descricaoSerie[$index]= substr($descricaoSerie[$index], 0,102)." ..." ;
           
            ?>


        </div>

    </div>

    <?php
    $contador = $contador + 1;
}







$sqlTotal = "select * from filmes";

$numTotal = $catalogoSeries->contaOcorrencias($sqlTotal);



$totalPagina = ceil($numTotal / $quantidade);

echo '<div id="paginacao"><a href="?pagina=1">Primeira página</a>';

for ($i = 1; $i <= $totalPagina; $i++) {

    if ($i == $pagina) {
        echo $i;
    } else {
        echo "<a href=\"?pagina=$i\" > &nbsp;$i&nbsp;&nbsp;&nbsp; </a>";
    }
}
echo "<a href=\"?pagina=$totalPagina\">Última página</a><div/>";





