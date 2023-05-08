<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once './classes/Conexao.php';
require_once '../estrutura/variaveisGlobais.php';
$cadastrarSerie = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);
$cadastrarSerie->conectar();


echo $nomeSerie = $_POST['tituloSerie'];
echo$dataSerie = $_POST['dataSerie'];
echo $sinopseSerie = $_POST['sinopseSerie'];
$poster = $_FILES['posterSerie']['name'];
$consulta = "select * from series where nome_serie='$nomeSerie'";


$salvarSerie = "insert into series values ('','$nomeSerie','$dataSerie','$sinopseSerie')";



if ($cadastrarSerie->contaOcorrencias($consulta) > 0) {

    header("location: ../cadastroSerie.php?mensagem=2");

    
} else {
    
    if (is_file("../img/" . $poster)) {
        header("location: ../cadastroSerie.php?mensagem=3");
    } else {

        $cadastrarSerie->salvaOcorrencia($salvarSerie);
        move_uploaded_file($_FILES['posterSerie']['tmp_name'], "../img/" . $poster);
       header("location: ../cadastroSerie.php?mensagem=4");
    }
}




