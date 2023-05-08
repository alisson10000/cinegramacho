<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.

 * Rotina que apaga do banco de dados tudo que não possui imagem na pasta img
 * 
 *  */




require_once '../servicos/classes/Conexao.php';
require_once '../estrutura/variaveisGlobais.php';
$limpaArquivos = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);


$limpaArquivos->conectar();

$consulta="select * from filmes";

$todosTitulos = $limpaArquivos->listaOcorrencia($consulta, "nome_filme");




for($i=0;$i< count($todosTitulos);$i++){
    
    
    //echo "$todosTitulos[$i].<br>";
    
     if (is_file("../img/$todosTitulos[$i].jpg")) {
         echo "O titulo ".$todosTitulos[$i]."possui imagem<br >";
     }else{
        echo "O titulo ".$todosTitulos[$i]." não possui imagem<br >";
        
          $limpaArquivos->excluiOcorrencia("DELETE FROM filmes WHERE nome_filme='$todosTitulos[$i]'");
        
        
        
     }
    
    
    
}
