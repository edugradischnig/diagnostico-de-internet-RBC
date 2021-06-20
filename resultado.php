<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solucione o seu problema de internet</title>
</head>
<body>
    
</body>
</html>


<?php
include_once "conexao.php";

$query = "SELECT * FROM RESPOSTAS;";
$resultadosBD = mysqli_query($connection, $query);
$registros = [];

for ($i=0; $i < mysqli_num_rows($resultadosBD); $i++) { 
  $registros[$i] = mysqli_fetch_row($resultadosBD);
}

$casoUsuario = [$_POST["q1"],$_POST["q2"],$_POST["q3"],$_POST["q4"],$_POST["q5"],$_POST["q6"]]; //Os novo caso é armazenado no mesmo formato dos casos do banco recuperados, só sem os id's
$valoresDeSimilaridade = array_fill(0, sizeof($registros), 0);

for ($z=0; $z < sizeof($registros); $z++) { 
  for ($i=1; $i < 7; $i++) { 
    $valoresDeSimilaridade[$z]+= abs($casoUsuario[$i - 1] - intval($registros[$z][$i]));
  }
}

$menorValorDeSimilaridade = 6; // Esse é o caso menos similar
$posicaoCasoMaisSimilar = 0;

for ($i=0; $i < sizeof($valoresDeSimilaridade); $i++) { 
  if($valoresDeSimilaridade[$i] < $menorValorDeSimilaridade){
    $menorValorDeSimilaridade = $valoresDeSimilaridade[$i];
    $posicaoCasoMaisSimilar = $i;
  }
}
$solucao = $registros[$posicaoCasoMaisSimilar][7];

switch ($solucao) {
  case 10:
    echo "<h3>Possivelmente o problema não é na internet ou nos aparelhos de internet, mas sim no seu dispositivo. 
    Tente reiniciá-lo, esquecer a rede WiFi novamente e se o problema persistir, entre em contato com a provedora 
    ou leve-o à uma assistência técnica.</h3>";
    break;
  case 11:
    echo "<h3>Possivelmente o problema está nesse cabo mal conectado ou danificado, então tente reconectá-lo. 
    Se mesmo assim não funcionar ele está danificado, providencie a troca deste cabo ou entre em contato com 
    a provedora solicitando uma visita técnica. </h3>";
    break;
  case 12:
    echo "<h3>Possivelmente o problema é no link de internet da sua provedora. Aguarde resolução do problema ou entre 
    em contato com a sua provedora para que possam providenciar a manutenção.</h3>";
    break;
  case 13:
    echo "<h3>Possivelmente algum equipamento de internet da sua residência foi danificado ou está queimado. 
    Entre em contato com a provedora para que prestem assistência técnica para você.</h3>";
    break;
  default:
    echo "<h3>Não conseguimos propor uma solução para o seu problema.</h3>";
    break;
}

echo "<label>Essa solução funcionou?</label>";
echo "<form action='feedback.php' method='POST'>";
echo "<input type='radio' id='feedS' name='feedback' value='s' required>";
echo "<label for='feedS'>Sim</label><br>";
echo "<input type='radio' id='feedN' name='feedback' value='n' required>";
echo "<label for='feedN'>Não</label><br>";
echo "<input type='submit' value='Enviar'>";
echo "</form>";
var_dump($_POST); // Se for necessário, setar cookie com o caso do usuário
?>