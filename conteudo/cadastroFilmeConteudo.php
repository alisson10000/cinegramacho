<div id="conteudoCadastroFilme">
    <div id="cadastroFilme"> 
        <h1>Ambiente De Cadastro Dos Filmes</h1>

        <form method="POST" id="frmCadastroFilme" name="frmCadastroFilme" enctype="multipart/form-data" action="./servicos/cadastrarFilme.php" >
            <fieldset>
                <table>
                    <legend>Informações do filme</legend>
                    <tr><td> Título:</td><td><input  required type="text" name="titulo" id="titulo" ></td></tr>
                    <tr><td> Ano:</td><td><input type="date" required name="ano" id="ano"></td></tr>
                    <tr><td> Poster filme:</td><td><input required type="file" name="poster" id="poster"></td></tr>
                    <tr><td style="vertical-align: top;"> sinopse</td><td><textarea placeholder="Descreva resumo da temporada ...." name="sinopse" id="sinopse" ></textarea></td></tr>

                    <tr>
                        <td style="vertical-align: top;">selecione os generos</td>
                        <td >

                            <table ><tr>
                                    <?php
                                    $generos = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);
                              
                                    $consulta = "select * from generos";

                                    $nomeGeneros = $generos->listaOcorrencia($consulta, "nome_genero");
                                    $idGenero = $generos->listaOcorrencia($consulta, "id_genero");

                                    $contador = 0;
                                    for ($index = 0; $index < count($nomeGeneros); $index++) {

                                        echo "<td> <input value=" . $idGenero[$index] . " name='generos[]' type=checkbox>  " . utf8_encode($nomeGeneros[$index]) . "</td>";
                                        if ($contador % 4 == 0) {
                                            echo '</tr><tr>';
                                        }
                                        $contador++;
                                    }
                                    ?>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr><td colspan="2" align="center"><button  type="button" onclick="validaCadastroFilme()">salvar</button></td></tr>
                </table>
            </fieldset>
        </form>

        <div id="listagemFilmes">

            <?php
            $listaFilmes = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);

          
            $consultaFilmes = "select * from filmes order by nome_filme asc";



            $retornoFilmes = $listaFilmes->listaOcorrencia($consultaFilmes, "nome_filme");


            for ($index = 0; $index < count($retornoFilmes); $index++) {
                ?>  <img src="img/<?php echo $retornoFilmes[$index]; ?>.jpg" >
                <?php
                echo ucwords($retornoFilmes[$index]) . "<hr />";
            }
            ?>

        </div>

        <?php
        if (isset($_GET['mensagem'])) {
            $mensagem = $_GET['mensagem'];
            if ($mensagem == 1) {
                ?>
                <div id="cadastroFilmeOk">
                    <p>  Cadastro filme realizado com sucesso!</p>
                </div>
                <?php
            } else if ($mensagem == 2) {
                ?>
                <div id="cadastroFilmeOk">
                    <p>Cadastro filme não realizado. </p>
                </div>
                <?php
            } else if ($mensagem == 3) {
                ?>
                <div id="cadastroFilmeOk">
                    <p>Filme já cadastrado no sistema. </p>
                </div>
                <?php
            } else if ($mensagem == 4) {
                ?>
                <div id="cadastroFilmeOk">
                    <p>Nome para poster já foi utilizado </p>
                </div>
                <?php
            }
        }

        if (isset($_GET['mensagemPoster'])) {

            $poster = $_GET['mensagemPoster'];

            if ($poster == 1) {
                ?>
                <div id="cadastroFilmeOk">
                    <p>  Poster salvo!</p>
                </div>
                <?php
            } else if ($poster == 2) {
                ?>
                <div id="cadastroFilmeOk">
                    <p> Poster não foi salvo por favor escolha outro nome! . </p>
                </div>
                <?php
            }
        }
        ?>

    </div>
</div>