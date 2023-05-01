<div class="conteudoGeralAdministrativo">
    <div class="conteudoExcluirFilme">
        <h1>Ambiente De Exclusão Dos Filmes</h1>
        <form name="frmExcluirFilme" id="frmEditarFilme" method="POST" action="excluirFilmes.php?listaFilmes=1">
            <input type="text" placeholder="INFORME O TÍTULO A BUSCAR" name="nomeFilme" id="nomeFilme">
            <button type="button" onclick="validaFrmExclusao(frmEditarFilme.nomeFilme.value)">Buscar</button>
        </form>
        <?php
        if (isset($_GET['listaFilmes']) != "") {
            if (isset($_POST['nomeFilme'])) {
                $titulo = $_POST['nomeFilme'];


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
                $nomeFilme = $listaFilmes->listaOcorrencia("select * from filmes where nome_filme like '%$titulo%'", "nome_filme");
                $idFilme = $listaFilmes->listaOcorrencia("select * from filmes where nome_filme like '%$titulo%'", "id_filme");
        
                ?>
                <form name="frmExclusao" id="frmExclusao" method="POST" id="frmExclusao" action="./servicos/excluirFilme.php" >
                    <div class="listaFilmesExclusao">

                        <?php
                        for ($index = 0; $index < count($idFilme); $index++) {
                            ?>

                            <input  type="checkbox" name="idFilme[]" value="<?php echo $idFilme[$index]; ?>" ><?php echo $nomeFilme[$index] . "<br >"; ?>
                            <?php
                        }
                        ?>
                    </div>
                    <button type="button" onclick="validaListaExclusao()" >Excluir</button>
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
            <div class="resultadoExclusao">
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