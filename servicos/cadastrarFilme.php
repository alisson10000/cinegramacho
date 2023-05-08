<?php

require_once '../servicos/classes/Conexao.php';
require_once '../estrutura/variaveisGlobais.php';
$cadastrarFilme = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);
$cadastrarFilme->conectar();

$titulo = $_POST['titulo'];
$titulo = strtolower($titulo);
$poster = $_FILES['poster']['name'];
$sinopse = $_POST['sinopse'];
$sinopse = addcslashes($sinopse, "'");
$sinopse = utf8_decode($sinopse);
$ano = $_POST['ano'];
$generos = $_POST['generos'];



/*
 * 
 * Lógica que verifica se o filme já foi cadastrado
 */
$buscaOcorrenciaFilme = "select * from filmes where nome_filme='$titulo'";
//echo "ocorrencias = ".contaOcorrencias($buscaOcorrenciaFilme);

/* @var $contaOcorrencia type recebe o valor se o filme já foi cadastrado */
$contaOcorrencia = $cadastrarFilme->contaOcorrencias($buscaOcorrenciaFilme);

if ($contaOcorrencia > 0) {
    header("location: ../cadastroFilme.php?mensagem=3");
} else {

    /*
     * Lógica que salva o título na tabela filmes.
     * 
     */
    $insereFilme = "insert into filmes values ('','$titulo','$sinopse','$ano')";
    $cadastrarFilme->salvaOcorrencia($insereFilme);



    /*
     * Lógica que busca o codigo do filme para depois salvar um ou mais 
     * generos que ele tiver.
     * 
     */
    $buscaCodigoFilme = "select * from filmes where nome_filme='$titulo'";
    $codigoFilme = $cadastrarFilme->listaOcorrencia($buscaCodigoFilme, "id_filme");
    foreach ($generos as $key => $value) {
        echo "<br >" . "$value" . "<br >";

        $cadastrarFilme->salvaOcorrencia("insert into filmes_has_generos values ('','$codigoFilme[0]','$value')");
    }




    /*
     * L´gica que verifica se o filme foi salvo e após realiza a ação de salvar o 
     * poster.
     * 
     */
    $consulta = "select * from filmes where nome_filme='$titulo'";
    $contaOcorrencias = $cadastrarFilme->contaOcorrencias($consulta);
    if ($contaOcorrencias > 0) {
        if (is_file("../img/" . $poster)) {
            header("location: ../cadastroFilme.php?mensagem=1&&mensagemPoster=2");
        } else {
            move_uploaded_file($_FILES['poster']['tmp_name'], "../img/" . $poster);
            if (is_file("../img/" . $poster)) {
                header("location: ../cadastroFilme.php?mensagem=1&&mensagemPoster=1");
            }
        }
    } else {
        header("location: ../cadastroFilme.php?mensagem=2&&mensagemPoster=1");
    }
}
    


  