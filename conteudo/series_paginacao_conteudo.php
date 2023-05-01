
<div class="busca">
    <form id="frm_busca" name="frm_busca" method="POST" action="resultado_busca_filme.php">
        <input type="text" name="filme" id="filme" placeholder="Informe o nome de uma serie assistir">
        <input  type="button" value="buscar" onclick="valida_busca();">
    </form>
</div>
<div class="conteudo_pagina">


    <?php
       include './servicos/paginacao_serie.php';
    ?>