<?php

include '../estrutura/variaveisGlobais.php';
include '../servicos/classes/Conexao.php';

/*
 * Inicia a sessão para passar as variáveis
 * com os códigos do filme e nome dos filmes excluidos
 */
session_start();



/*
 * Variável $idFilme recebe o array com a chave primária de um ou vários filmes
 *  para serem excluídos.
 * 
 */
$idFilme = $_POST['idFilme'];




foreach ($idFilme as $value) {
 
    echo $value."<br >";
}






/*
 * Criação do índice da sessão $_SESSION['filmesExcluidos']  onde recebe a(s)
 * chave(s) primária(s) do(s) filme(s) a serem excluido(s);
 */
$_SESSION['filmesExcluidos'] = $idFilme;




/*
 * Cria a instância  para a utilização do objeto excluir
 * 
 */
$excluir = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);


/*
 * Define a variável $retornofilmesExcluidos para o tipo array
 */
$retornofilmesExcluidos = array();




/*
 * Lógica onde retorna o nome(s) do(s) filme(s) excluido(s)
 */
for ($index1 = 0; $index1 < count($idFilme); $index1++) {

    (string) $idFilme[$index1];
    $nomeFilmesExcluidos = $excluir->listaOcorrencia("select * from filmes where id_filme=$idFilme[$index1]", "nome_filme");

    foreach ($nomeFilmesExcluidos as $key => $value) {
        array_push($retornofilmesExcluidos, $value);
    }
}


/*
 *  Criação do índice da sessão $_SESSION['filmesExcluidosNomes']  onde recebe(m) o(s)
 * nome(s) do(s) filme(s) a serem excluido(s);
 * 
 */
$_SESSION['filmesExcluidosNomes'] = $retornofilmesExcluidos;



/*
 * Lógica que utiliza a(s) chave(s) primária(s) para executar a rotina de exclusão
 * dos filmes.
 */
foreach ($idFilme as $key => $value) {
      $excluir->excluiOcorrencia("DELETE FROM filmes WHERE id_filme='$value'");
}



/*
 * 
 * Deletar os arquivos de imagens do s videos
 * 
 * 
 */


foreach ($retornofilmesExcluidos as $key => $value) {
    echo 'Excluir foto' . "$value";




    if (file_exists("../img/$value.jpg")) {
        unlink("../img/$value.jpg");
    }
}
















/*
 * Lógia para realizar a contagem dos filmes excluidos da base de dados:
 * 
 */
$quantidadeExcluidos = 0;
foreach ($idFilme as $key => $value) {
    if ($excluir->contaOcorrencias("select * from filmes where id_filme='$value'") == 0) {
        $quantidadeExcluidos++;
    } else {
        $quantidadeExcluidos--;
    }
}



/*
 * Função header para retornar a página excluirFilmes com as informações de 
 * resultado para habilitar a lógica para mensagem dos filmes que foram excluídos
 * 
 */


header("Location:../excluirFilmes.php?resultado=valor&excluidos=$quantidadeExcluidos");

