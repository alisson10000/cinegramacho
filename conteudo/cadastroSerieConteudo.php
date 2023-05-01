<div id="cadastroSerieConteudoGeral">

    <h1>Ambiente De Cadastro das Séries</h1>
    <input type="button" att="series"  value="serie" onclick="selecionaCadastroSerie('cadastroSerie', 'cadastroTemporada', 'cadastroEpisodio')">
    <input type="button" att="series" value="temporada"  onclick="selecionaCadastroSerie('cadastroTemporada', 'cadastroEpisodio', 'cadastroSerie')">
    <input type="button" att="series" value="episodios" onclick="selecionaCadastroSerie('cadastroEpisodio', 'cadastroSerie', 'cadastroTemporada')">



    <!-- Cadastro da Série -->
    <div id="cadastroSerie">

        <fieldset>
            <legend>
                Cadastro série
            </legend>

            <form id="frmCadastroSerie" enctype="multipart/form-data" name="frmCadastroSerie" method="POST" 
                  action="./servicos/cadastrarSerie.php">


                <table >
                    <tr>
                        <td>titulo</td>
                        <td><input type="text" name="tituloSerie" id="tituloSerie" ></td>  <td><span id="mensagemTituloSerie"></span></td>
                    </tr>
                    <tr>
                        <td>ano</td>
                        <td><input type="date" name="dataSerie" id="dataSerie" ></td>  <td><span id="mensagemDataSerie"></span></td>
                    </tr>
                    <tr>
                        <td>sinopse</td>
                        <td><textarea name="sinopseSerie" id="sinopseSerie"></textarea></td>  <td><span id="mensagemSinopseSerie"></span></td>
                    </tr>
                    <tr>
                        <td>poster</td>
                        <td><input type="file" name="posterSerie" id="posterSerie" ></td>  <td><span id="mensagemPosterSerie"></span></td>
                    </tr>
                    <tr>

                        <td colspan="2"><input type="button" value="cadastrar" onclick="validaSerie()"></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </div>
    <!-- Fim do cadastro da Série -->


    <!-- Início do cadastro da temporada -->
    <div id="cadastroTemporada">

        <fieldset>
            <legend>
                Cadastro Temporada
            </legend>

            <form id="frmCadastroTemporada" name="frmCadastroTemporada" method="POST" 
                  action="./servicos/cadastrarTemporadaSerie.php">


                <table>
                    <tr>
                        <td>serie</td>
                        <td>

                            <select name="idSerie" id="idSerie">
                                <option value="" > -- selecione uma serie -- </option>
                                <?php
                                $buscaSeries = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);
                                $buscaSeries->conectar();



                                $consultaBuscaSeries = "select * from series";
                                $idSerie = $buscaSeries->listaOcorrencia($consultaBuscaSeries, "id_serie");
                                $nomeSerie = $buscaSeries->listaOcorrencia($consultaBuscaSeries, "nome_serie");

                                for ($index = 0; $index < count($idSerie); $index++) {




                                    //while ($row = mysql_fetch_array($buscaSeries)) {
                                    ?>
                                    <option value="<?php echo $idSerie[$index]; ?>" ><?php echo$nomeSerie[$index]; ?> </option>
                                    <?php
                                }
                                ?>


                            </select>


                        </td>
                        <td><span id="mensagemSerie"></span></td>
                    </tr>
                    <tr>
                        <td>temporada</td>
                        <td>

                            <select name="numeroTemporada" id="numeroTemporada">

                                <option value="" > -- selecione uma temporada -- </option>
                                <?php
                                for ($i = 1; $i < 20; $i++) {
                                    ?>
                                    <option value="<?php echo $i ?>" ><?php echo $i ?> </option>
                                    <?php
                                }
                                ?>


                            </select> 



                        </td>
                        <td> <span id="mensagemTemporada"></span></td>
                    </tr>
                    <tr>
                        <td>ano</td>
                        <td><input type="date" name="dataTemporada" id="dataTemporada"> </td>
                        <td><span id="mensagemData"></span></td>
                    </tr>
                    <tr>
                        <td>sinopse</td>
                        <td><textarea name="sinopseTemporada" id="sinopseTemporada" placeholder="Descreva resumo da temporada ...."></textarea> 
                        </td><td> <span id="mensagemSinopse"></span></td>
                    </tr>

                    <tr>

                        <td colspan="2"><input type="button" value="cadastrar" onclick="validaTemporada();selecionaCadastroSerie('cadastroTemporada', 'cadastroEpisodio', 'cadastroSerie');" ></td>
                    </tr>

                </table>
            </form>
        </fieldset>
    </div>
    <!-- Fim do cadastro da temporada -->
    <!-- Inicio do cadastro do episódio -->


    <div id="cadastroEpisodio">

        <fieldset>
            <legend>
                Cadastro Episódio
            </legend>

            <form id="frmCadastroEpisodio" name="frmCadastroEpisodio" method="POST" action="./servicos/cadastrarEpisodio.php">
                <table>
                    <tr>
                        <td>titulo</td>
                        <td><input type="text" name="tituloEpisodio" id="tituloEpisodio" ></td> <td><span id="mensagemTituloEpisodio"></span></td>
                    </tr>
                    <tr>
                        <td>serie</td>
                        <td>
                            <?php
                            ?>                       

                            <select name='serie' id='serie'>
                                <option value=''><-- Selecione uma série --></option>


                                <?php
                                for ($index = 0; $index < count($idSerie); $index++) {




                                    
                                    ?>
                                    <option value="<?php echo $idSerie[$index]; ?>" ><?php echo$nomeSerie[$index]; ?> </option>
                                    <?php
                                }
                                ?>


                            </select>




                        </td> <td><span id="mensagemNomeSerie"></span></td>
                    </tr>

                    <tr>
                        <td>selecione a temporada</td>
                        <td>
                            <!--
                               
                               Progamação para pegar o indice da temporada
                               está no arquivo servicos/selecionaTemporadaSerie.php
                            -->
                            <!-- /*Nessa programação o objetivo é buscar o ID da temporada 
  * que relaciona com a série para realizar o cadastro do episódio.
  * 
  */-->
                            <div id="temporada">
                                <select name="temporada">
                                    <option value=""> -- selecione a temporada -- </option>
                                </select>
                            </div>

                            <!--
                               
                               Fim da progamação para pegar o indice da temporada
                               está no arquivo servicos/selecionaTemporadaSerie.php
                            -->

                        </td> <td><span id="mensagemTemporadaEpisodio"></span></td>
                    </tr>
                    <tr>
                        <td>
                            capítulo
                        </td>
                        <td>
                            <select name="numeroEpisodio" id="numeroEpisodio">
                                <option value=""> <-- selecione o número do capítulo do espisódio --> </option>

                                <?php
                                for ($i = 1; $i < 30; $i++) {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?>º capitulo</option>

                                    <?php
                                }
                                ?>

                            </select>
                        </td> <td><span id="mensagemCapituloEpisodio"></span></td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>ano</td>
                        <td><input type="date" name="dataEpisodio" id="dataEpisodio" ></td> <td><span id="mensagemDataEpisodio"></span></td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top;">sinopse</td>
                        <td><textarea name="sinopseEpisodio" id="sinopseEpisodio"></textarea></td> <td><span id="mensagemSinopseEpisodio"></span></td>
                    </tr>

                    <tr>

                        <td colspan="2"><input type="button" value="cadastrar" onclick="validaEpisodio()" ></td>
                    </tr>
                </table>
            </form>
        </fieldset>


    </div>
    <div id="listagemFilmes">

        <?php
        $titulosSerie = $buscaSeries->listaOcorrencia("select * from series order by nome_serie asc", "nome_serie");



        for ($index1 = 0; $index1 < count($titulosSerie); $index1++) {
            ?>  <img src="img/<?php echo $titulosSerie[$index1]; ?>.jpg" >

            <?php
            echo ucwords($titulosSerie[$index1]) . "<hr />";
        }
        ?>

    </div>

    <div id="resultadoCadastroSerie">

    </div>


    <!-- Fim do cadastro do episódio -->

    <?php
    if (isset($_GET['mensagem'])) {

        $mensagem = filter_input(INPUT_GET, 'mensagem', FILTER_DEFAULT);

        if ($mensagem == 0) {
            echo 'Temporada já cadastrada no sistema!';
        } else if ($mensagem == 1) {
            echo 'Cadastro de temporada realiza com sucesso!';
        } else if ($mensagem == 2) {
            echo 'Série já cadastrada no sistema!';
        } else if ($mensagem == 3) {
            echo 'Cadastro não realizado pois o poster já está no sistema!';
        } else if ($mensagem == 4) {
            echo 'Cadastro série realizado com sucesso!';
        } else if ($mensagem == 5) {
            echo 'Episódio já cadastrado no sistema!';
        } else if ($mensagem == 6) {
            echo 'Episódio já cadastrado com sucesso!';
        }
    }
    if (isset($_GET['selecionaFormulario'])) {
        $formularioTemporada = $_GET['selecionaFormulario'];

        if ($formularioTemporada == 1) {
            ?>
            <script>
                document.getElementById("cadastroTemporada").onload = selecionaCadastroSerie('cadastroTemporada', 'cadastroEpisodio', 'cadastroSerie');
            </script>
            <?php
        }
        if ($formularioTemporada == 2) {
            ?>
            <script>
                document.getElementById("cadastroEpisodio").onload = selecionaCadastroSerie('cadastroEpisodio', 'cadastroTemporada', 'cadastroSerie');
            </script>
            <?php
        }
    }