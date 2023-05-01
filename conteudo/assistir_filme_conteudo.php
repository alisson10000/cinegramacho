<div class="conteudo_pagina">

    <div class="descricao">

        <video width="400" controls autoplay>
            <source src="./filmes/<?php echo $assistir_filme = $_GET['filme']; ?>.3gp" type="video/3gp" preload="metadata">
            <source src="./filmes/<?php echo $assistir_filme = $_GET['filme']; ?>.mp4" type="video/mp4" preload="metadata" >
            <source src="./filmes/<?php echo $assistir_filme = $_GET['filme']; ?>.ogg" type="video/ogg" preload="metadata">
            <source src="./filmes/<?php echo $assistir_filme = $_GET['filme']; ?>.mkv"   preload="metadata" >
            <track label="Portugues" kind="subtitles" srclang="pt" src="./vtt/<?php echo $assistir_filme = $_GET['filme']; ?>.vtt">
             <track label="Portugues" kind="subtitles" srclang="pt" src="./vtt/<?php echo $assistir_filme = $_GET['filme']; ?>.srt">
            Your browser does not support HTML5 video.
        </video>
        <?php
        $assistirFilme = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);
        $filme = $_GET['filme'];
        ?>
        <img src="./img/<?php echo $filme; ?>.jpg">
        <?php
        echo "<h1 title='$filme'>" . $filme . "</h1>";
        $resumo = "select  DISTINCT nome_filme ,descricao_filme,ano_filme  from generos g 
inner JOIN filmes_has_generos fg
ON
g.id_genero=fg.id_genero
INNER JOIN filmes f 
ON
f.id_filme=fg.id_filme
WHERE nome_filme='$filme'
";
        $titulo = $assistirFilme->listaOcorrencia($resumo, "nome_filme");
        $descricao = $assistirFilme->listaOcorrencia($resumo, "descricao_filme");
        $ano = $assistirFilme->listaOcorrencia($resumo, "ano_filme");
        $buscaGenero = "select  nome_genero from generos g 
inner JOIN filmes_has_generos fg
ON
g.id_genero=fg.id_genero
INNER JOIN filmes f 
ON
f.id_filme=fg.id_filme
WHERE nome_filme='$filme'";
        $genero = $assistirFilme->listaOcorrencia($buscaGenero, "nome_genero");
        echo "<h2>ano : " . $ano[0] . "</h2>";
        ?>
        <h2>genero:
            <?php
            $virgula = $assistirFilme->contaOcorrencias($buscaGenero);

            $contador = 1;

            foreach ($genero as $key => $value) {
                echo utf8_encode($value);

                if ($contador < $virgula) {
                    ?>
                    ,&nbsp;&nbsp;&nbsp;

                    <?php
                    $contador++;
                }
            }
            ?>.</h2>
        <?php
        echo "<p>" . utf8_encode($descricao[0]) . "</p>";
        ?>
    </div>
