<?php
require_once '../estrutura/variaveisGlobais.php';
require_once './classes/Conexao.php';

$processarEpisodios = new ConexaoProjeto($_local, $_senha, $_usuario, $_banco);
$processarEpisodios->conectar();


$id_serie=$_POST['cod_serie'];
$numero_temporada=$_POST['numero_temporada'];
        






$titulo_episodio = " 


select  numero_episodio,id_episodio,nome_episodio,descricao_episodio from series s 
INNER JOIN temporadas t 
ON
s.id_serie=t.id_serie
INNER JOIN episodios e 
ON
t.id_temporada=e.id_temporada
WHERE
s.id_serie='$id_serie'
AND
t.numero_temporada='$numero_temporada' order by numero_episodio asc

        ";


echo '<ul>';

$nomeEpisodio = $processarEpisodios->listaOcorrencia($titulo_episodio, "nome_episodio");
$numeroEpisodio = $processarEpisodios->listaOcorrencia($titulo_episodio, "numero_episodio");


//while ($row1 = mysql_fetch_array($titulo_episodio)) {

for ($index = 0;
$index < count($nomeEpisodio);
$index++) {




  $numeroEpisodio[$index];
    
    ?>
<li onclick="processaDescricaoEpisodio(<?php echo $id_serie; ?>,<?php echo $numero_temporada; ?>,<?php echo $numeroEpisodio[$index]; ?>)" >episódio  <?php
echo $numeroEpisodio[$index]." :". utf8_encode($nomeEpisodio[$index]);
?>
    <a href="assistir_episodio.php?serie=<?php echo $id_serie?>&temporada=<?php echo $numero_temporada;?>&episodio=<?php echo $numeroEpisodio[$index]; ?>">assistir</a>   </li>
<?php
    
    
 
}
              
echo '</ul>';
