<?php

$link = mysql_connect("localhost", "root", "", "");
$bd = mysql_select_db("cinegramacho", $link);

$id_serie=$_POST['cod_serie'];
$numero_temporada=$_POST['numero_temporada'];
        






$descricao_temporada = mysql_query("SELECT numero_temporada, descricao_temporada FROM temporadas WHERE id_serie='$id_serie' and numero_temporada='$numero_temporada'");
?>
<button type="button" onclick="fechaDescricao('textos_temporadas');">FECHAR</button>
<?php
while ($row1 = mysql_fetch_array($descricao_temporada)) {
    echo "<h3>Sinopse da {$row1['numero_temporada']}ª temporada</h3>";
    echo "<p>".utf8_encode($row1['descricao_temporada'])."</p>";
}
              
                    