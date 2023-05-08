<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tela de acesso</title>
        <style>
           @import url('css/estruturaLongin.css');
        </style>
         <link rel="icon" type="image/ico" href="img/camera.ico" />
        <script>
            function validaLogin() {
                var login, senha;
                login = document.getElementById('login').value;
                senha = document.getElementById('senha').value;

                if (login == "") {

                    document.getElementById('mensagemLogin').innerHTML = "Campo login vazio";
                    document.frm_login.login.focus();
                } else if (senha == "") {
                    document.getElementById('mensagemLogin').innerHTML = "";
                    document.getElementById('mensagemSenha').innerHTML = "Campo senha vazio";
                    document.frm_login.senha.focus();
                } else {
                    document.frm_login.submit();
                }

            }
        </script>
    </head>
    <body>
        <div id="topoLogin">
            <h1>Login Cinegramacho</h1>
        </div>