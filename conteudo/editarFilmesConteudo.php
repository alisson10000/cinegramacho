<div class="conteudoGeralAdministrativo">
    <div class="conteudoEditarFilme">
        <h1>Ambiente De Edição Dos Filmes</h1>
        <form name="frmEditarFilme" id="frmEditarFilme" method="POST" action="editarFilmes.php?listaFilmes=1">
            <input type="text" placeholder="INFORME O TÍTULO A BUSCAR" name="nomeFilme" id="nomeFilme">
            <button type="button" onclick="validaFrmEdicao(frmEditarFilme.nomeFilme.value)">Buscar</button>
        </form>
        <?php
        if (isset($_GET['listaFilmes']) != "") {
            if (isset($_POST['nomeFilme'])) {
                $titulo = $_POST['nomeFilme'];
                $cod = array();

                /*
                 * Instância da classe conexão.
                 * 
                 */
                $listaFilmes = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);

                /*
                 * Fim da instância
                 * 
                 */

                /*
                 * Método da classe para conectar ao banco
                 */
                $listaFilmes->conectar();



                /*
                 * 
                 * Métodos para listar nome dos filmes e id dos mesmos
                 */
                $idFilme = $listaFilmes->listaOcorrencia("select * from filmes where nome_filme like '%$titulo%'", "id_filme");
                $nomeFilme = $listaFilmes->listaOcorrencia("select * from filmes where nome_filme like '%$titulo%'", "nome_filme");
                $descricaoFilme = $listaFilmes->listaOcorrencia("select * from filmes where nome_filme like '%$titulo%'", "descricao_filme");
                $anoFilme = $listaFilmes->listaOcorrencia("select * from filmes where nome_filme like '%$titulo%'", "ano_filme");
                ?>
                <form name="frmEdicao" id="frmEdicao" method="POST" id="frmExclusao" target="_blank" action="./servicos/editarFilmes.php" enctype="multipart/form-data">
                    <table>
                        <tr><td class="codigo">CODIGO</td>  <td class="nomeFilme">TITULO </td> <td class="descricaoFilme">DESCRIÇÃO</td> <td class="anoFilme">ANO DE LANÇAMENTO</td></tr>
                    </table>
                    <div class="listaFilmesEdicao">

                        <?php
                        for ($index = 0; $index < count($idFilme); $index++) {
                            ?>
                            <TABLE>

                                <tr>
                                    <td class="codigo"><input att="codigo" readonly="readonly" name="idFilme[]" type="text"value="<?php echo $idFilme[$index]; ?>" ></td>
                                    <td class="nomeFilme"> <input att="titulo"  type="text" name="nomeFilme[]" value="<?php echo $nomeFilme[$index]; ?>" ></td>
                                    <td class="descricaoFilme"><textarea att="descricao"    name="descricaoFilme[]"  ><?php echo $descricaoFilme[$index]; ?></textarea></td>
                                    <td class="anoFilme"> <input att="ano"  type="text" name="anoFilme[]" value="<?php echo $anoFilme[$index]; ?>" ></td>
                                    <td class="anoFilme"> <input att="poster" type="file" name="foto[]"   multiple/></td>
                                    <td> <img src="img/<?php echo $nomeFilme[$index]; ?>.jpg" ></td>
                                </tr>



                                <?php
                                if ($index == 0) {
                                    ?>

                                    <tr> <td colspan="2"><input type="hidden" name="totalCampos" value="" </td></tr>


                                    <?php
                                }
                                ?>
                            </TABLE>

                            <?php
                        }
                        ?>
                    </div>
                    <button type="button" onclick="validaListaEdicao()" >Editar</button>
                </form>
                <?php
            }
        }
        ?>

        <?php
        if (isset($_GET['resultado']) == "valor") {









            include './estrutura/variaveisGlobais.php';
            /*
             * Variável excluído recebe o valor da quantidade de filmes excluídos
             * 
             */
            $excluidos = $_GET['excluidos'];



            /*
             * A variável $idFilmesExcluidos recebe por sessão as chaves primárias 
             * dos filmes excluidos.
             */
            $idFilmesExcluidos = $_SESSION['filmesExcluidos'];





            /*
             * A variável $filmesExcluidosNomes recebe por sessão os nomes dos 
             * filmes excluídos.
             */
            $filmesExcluidosNomes = $_SESSION['filmesExcluidosNomes'];




            /*
             * Resultado dos filmes excluidos
             */
            ?>
            <div class="resultadoEdicao">
                <?php
                echo "Foram excluídos $excluidos filmes sendo ele(s): <br>";
                foreach ($filmesExcluidosNomes as $key => $value) {
                    echo $value . "<br >";
                }
            }
            ?>
        </div>
    </div>
</div>
