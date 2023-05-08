

<?php
$catalogoGenero = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);
$quantidade = 15;
$pagina = (isset($_GET['pagina'])) ? (int) $_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;
$sql = "select * from filmes f 
INNER JOIN 
filmes_has_generos fg
on
f.id_filme=fg.id_filme
INNER JOIN generos g 
ON
fg.id_genero=g.id_genero

WHERE g.id_genero=$genero_filme 
order by nome_filme asc limit $inicio,$quantidade ";

$idFilme = $catalogoGenero->listaOcorrencia($sql, "id_filme");
$nomeFilme = $catalogoGenero->listaOcorrencia($sql, "nome_filme");
$descricaoFilme = $catalogoGenero->listaOcorrencia($sql, "descricao_filme");
$anoFilme = $catalogoGenero->listaOcorrencia($sql, "ano_filme");

for ($index = 0; $index < count($idFilme); $index++) {
    ?>

    <div class="poster"  onmouseover="mostrar_descricao(<?php
    $idFilme[$index];
    echo $idFilme[$index];
    ?>,<?php echo $contador; ?>)" onmouseout="tirar_descricao(<?php
         $idFilme[$index];
         echo $idFilme[$index];
         ?>)">



        <a href="assistir_filme.php?filme=<?php echo $nomeFilme[$index]; ?>"  title="<?php
        $nomeFilme[$index];
        echo strtoupper(str_replace("_", " ", $nomeFilme[$index]))
        ?>"> <img src="img/<?php echo $nomeFilme[$index]; ?>.jpg"  ></a>
        <div id="<?php
        $idFilme[$index];
        echo $idFilme[$index];
        ?>" style="display: none;text-indent:3cm;">


            <?php
            echo "<p>Ano : " . $anoFilme[$index] . "</p>";
            $descricao = $descricaoFilme[$index];
            $descricao = utf8_encode($descricao);
            echo $descricao = substr($descricao, 0, 102) . " ...";
            ?>


        </div>
    </div>
    <?php
   
}


$sqlTotal = "select * from filmes";
$qrTotal = $catalogoGenero->contaOcorrencias($sqlTotal);
$numTotal = $qrTotal;
$totalPagina = ceil($numTotal / $quantidade);
$contagemGeralGeneros = "select * from filmes f 
INNER JOIN 
filmes_has_generos fg
on
f.id_filme=fg.id_filme
INNER JOIN generos g 
ON
fg.id_genero=g.id_genero
WHERE g.id_genero=$genero_filme";
$resultadoContagemGenero = $catalogoGenero->contaOcorrencias($contagemGeralGeneros);

if($resultadoContagemGenero == 0){
    echo 'Desculpe ainda não possuimos este genero nos nossos registros!';
}

if ($resultadoContagemGenero > 15) {
    echo "<div id=\"paginacao\"><a href=\"?pagina=1&genero=$genero_filme\">Primeira página</a>";
    for ($i = 1; $i <= $totalPagina; $i++) {
        if ($i == $pagina) {
            echo $i;
        } else {
            echo "<a href=\"?pagina=$i&genero=$genero_filme\" > &nbsp;$i&nbsp;&nbsp;&nbsp; </a>";
        }
    }
    echo "<a href=\"?pagina=$totalPagina&genero=$genero_filme\">Última página</a><div/>";
}


