<?php
require_once '../servicos/classes/Conexao.php';
require_once '../estrutura/variaveisGlobais.php';

$buscaTemporada = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);
$buscaTemporada->conectar();




$consulta =("
SELECT s.id_serie,nome_serie,numero_temporada, id_temporada from series as s
INNER JOIN temporadas t
on
s.id_serie=t.id_serie
WHERE
s.id_serie=".$_GET['id'] );


$numeroTemporada = $buscaTemporada->listaOcorrencia($consulta, "numero_temporada");
$idTemporada = $buscaTemporada->listaOcorrencia($consulta, "id_temporada");
$nomeSerie = $buscaTemporada->listaOcorrencia($consulta, "nome_serie");


echo "<select name='temporada' id='temporada'>";
/*Nessa programação o objetivo é buscar o ID da temporada 
 * que relaciona com a série para realizar o cadastro do episódio.
 * 
 */

for ($index = 0; $index < count($numeroTemporada); $index++) {
    



//while ($fila = mysql_fetch_array($consulta)) {
    echo "<option value='" . $idTemporada[$index] . "'>" . utf8_encode($numeroTemporada[$index]) . "ª temporada</option>";
}
echo "</select>";
?>