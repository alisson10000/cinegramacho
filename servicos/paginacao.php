

<?php
$quantidade = 15;
$pagina = (isset($_GET['pagina'])) ? (int) $_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;
$consulta = "select * from filmes order by nome_filme asc limit $inicio,$quantidade ";
$catalogoPrincipal = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);


$retornoCatologo = array();

$idFilme = $catalogoPrincipal->listaOcorrencia($consulta, "id_filme");
$titulo = $catalogoPrincipal->listaOcorrencia($consulta, "nome_filme");
$descricao = $catalogoPrincipal->listaOcorrencia($consulta, "descricao_filme");
$ano = $catalogoPrincipal->listaOcorrencia($consulta, "ano_filme");

for ($index = 0; $index < count($idFilme); $index++) {
    ?>
    <div class="poster"  onmouseover="mostrar_descricao(<?php echo $idFilme[$index]; ?>,<?php echo $contador; ?>)" onmouseout="tirar_descricao(<?php echo $idFilme[$index]; ?>)">
        <a href="assistir_filme.php?filme=<?php echo $titulo[$index]; ?>"  title="<?php
        echo $titulo[$index];
        /* echo strtoupper(str_replace("_", " ",  $titulo[$index] )); */
        ?>"> <img src="img/<?php echo $titulo[$index]; ?>.jpg"  ></a>
        <div id="<?php echo $idFilme[$index]; ?>" style="display: none;text-indent:3cm;" onmouseover="tirar_descricao(<?php echo $idFilme[$index]; ?>)">
            <?php
            echo "<p> Ano: " . $ano[$index] . "</p>";
            $descricao[$index];
            utf8_encode($descricao[$index]);
            echo $descricao[$index] = substr($descricao[$index], 0, 102) . " ...";
            ?>
        </div>
    </div>
    <?php
    
}
$consultaTotal = $catalogoPrincipal->contaOcorrencias("select * from filmes");
$numTotal = $consultaTotal;
$totalPagina = ceil($numTotal / $quantidade);

echo '<div class="paginacao"><a href="?pagina=1">Primeira página</a>';

for ($i = 1; $i <= $totalPagina; $i++) {

    if ($i == $pagina) {
        echo $i;
    } else {
        echo "<a href=\"?pagina=$i\" > &nbsp;$i&nbsp;&nbsp;&nbsp; </a>";
    }
}
echo "<a href=\"?pagina=$totalPagina\">Última página</a><div/>";






