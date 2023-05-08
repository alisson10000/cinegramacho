<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$verificaUsuario = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);
$verificaUsuario->conectar();
session_start();
echo $login = $_SESSION['login'];
echo $senha = $_SESSION['senha'];

$consultaClienteLogado = "select * from administradores where loginAdministrador='$login'                
and
senhaAdministrador='$senha'";

echo $contagemUsuarioLogado = $verificaUsuario->contaOcorrencias($consultaClienteLogado);

if ($contagemUsuarioLogado < 1) {
    header("Location: ./servicos/forcar_login.php");
}



      