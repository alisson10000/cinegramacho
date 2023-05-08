<!--<div class="busca">
    <form id="frm_busca" name="frm_busca" method="POST" action="./resultado_busca_filme.php?resultadoBusca=1">
        <input type="text" name="filme" id="filme" placeholder="Informe o nome de um filme para assistir">
        <input  type="button" value="buscar" onclick="valida_busca();">
    </form>
</div>-->
<div class="conteudo_pagina">

    <?php
    if (isset($_GET['resultadoBusca']) == 1) {
        require_once './servicos/classes/Conexao.php';
        require_once './estrutura/variaveisGlobais.php';
        $buscaFilmes = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);
        $buscaFilmes->conectar();
        $nome = $_POST['filme'];
        $nome = str_replace(" ", "_", $nome);

        $consultaBuscaFilme = "select * from filmes where nome_filme like '%$nome%'";
        $contagemFilmes = $buscaFilmes->listaOcorrencia($consultaBuscaFilme, "nome_filme");

        if (count($contagemFilmes) == 0) {
            echo 'Desculpe mas não possuimos este filme em nossos registros.';
        } else {

            $filme = $_POST['filme'];
            $quantidade = 15;
            $pagina = (isset($_GET['pagina'])) ? (int) $_GET['pagina'] : 1;
            $inicio = ($quantidade * $pagina) - $quantidade;
            $sql = "select * from filmes  where nome_filme like '%$filme%' order by nome_filme asc limit $inicio,$quantidade ";
            $qr = $buscaFilmes->listaOcorrencia($sql, "nome_filme");

            $consultaGeral = $buscaFilmes->listaOcorrencia("select * from filmes where nome_filme like '%$filme%'", "nome_filme");



            for ($index = 0; $index < count($qr); $index++) {
                ?>      
                <div class="poster">
                    <a href="assistir_filme.php?filme=<?php echo $qr[$index]; ?>"  title="<?php
                    $filme = $qr[$index];
                    echo strtoupper(str_replace("_", " ", $filme));
                    ?>"> <img src="img/<?php echo $qr[$index]; ?>.jpg"  ></a>
                </div>
                <?php
            }
            $sqlTotal = "select * from filmes";
            $numTotal = $buscaFilmes->contaOcorrencias($sqlTotal);
            $totalPagina = ceil($numTotal / $quantidade);


            if (count($consultaGeral) > 15) {

                echo '<div id="paginacao"><a href="?pagina=1">Primeira página</a>';

                for ($i = 1; $i <= $totalPagina; $i++) {

                    if ($i == $pagina) {
                        echo $i;
                    } else {
                        echo "<a href=\"?pagina=$i\" > &nbsp;$i&nbsp;&nbsp;&nbsp; </a>";
                    }
                }
                echo "<a href=\"?pagina=$totalPagina\">Última página</a><div/>";
            }
        }
    }
    ?>
     








