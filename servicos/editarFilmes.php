<?php

include '../estrutura/variaveisGlobais.php';
include '../servicos/classes/Conexao.php';

$editar = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);
$editar->conectar();


$totalCampos = $_POST['totalCampos'] . "ocorrencias<br ><br ><br ><br >";
$codFilme = $_POST['idFilme'];
$titulo = $_POST['nomeFilme'];
$descricao = $_POST['descricaoFilme'];
$ano = $_POST['anoFilme'];
$poster = $_FILES['foto']['name'];
var_dump($poster);

for ($i = 0; $i < $totalCampos; $i++) {


    if ($poster[$i] != "") {
        echo "codigo: $codFilme[$i] , poster : $poster[$i] <br >";
        if(file_exists($totalCampos)) {
            
        }
    } else if ($poster[$i] === "") {
        echo 'Nehuma foto foi atualizada!';
    }
}



for ($i = 0; $i < $totalCampos; $i++) {

    //   utf8_decode($descricao[$i]);
}


for ($i = 0; $i < $totalCampos; $i++) {
    $editar->editarOcorrencia("UPDATE filmes SET nome_filme='$titulo[$i]', descricao_filme='$descricao[$i]', ano_filme='$ano[$i]' WHERE id_filme='$codFilme[$i]'");
}
