<div id="conteudoGeralLogin"> 
    <div id="conteudoLogin">


        <form name="frm_login" id="frm_login" method="POST"
              action=""
              >

            <table>

                <tr>
                    <td>login</td>
                    <td><input type="text" name="login" id="login" placeholder="LOGIN"></td>
                    <td><span id="mensagemLogin"></span></td>
                </tr>
                <tr>
                    <td>senha</td>
                    <td> <input type="password" name="senha" id="senha" placeholder="SENHA" ></td>
                    <td><span id="mensagemSenha"></span></td>
                </tr>
                <tr>
                    <td align="center" colspan="2"><input type="button" value="logar" onclick="validaLogin()" ></td>


                </tr>




            </table>
        </form>
        <?php
        if (isset($_POST['login']) and isset($_POST['senha'])) {
            require_once './estrutura/variaveisGlobais.php';
            require_once './servicos/classes/Conexao.php';

            $login = $_POST['login'];
            $senha = $_POST['senha'];


            $logarUsuario = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);

            $logarUsuario->conectar();
            $consultaLoginAluno = "select * from administradores where loginAdministrador='$login' 
            and senhaAdministrador='$senha'";


            $contagemUsuario = $logarUsuario->contaOcorrencias($consultaLoginAluno);

            if ($contagemUsuario > 0) {

                $loginBanco = $logarUsuario->listaOcorrencia($consultaLoginAluno, "loginAdministrador");
                $senhaBanco = $logarUsuario->listaOcorrencia($consultaLoginAluno, "senhaAdministrador");

                session_start();

                $_SESSION['login'] = $loginBanco[0];
                $_SESSION['senha'] = $senhaBanco[0];

                header("location: cadastroFilme.php");
            } else {
                echo 'Login ou senha incorreta.';
            }
        }
        ?>






