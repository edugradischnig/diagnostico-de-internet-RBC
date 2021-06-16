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
function getElementPostByID($y){
  switch ($y){
    case 1:
      return intval($_POST["q1"]);
      break;
    case 2:
      return intval($_POST["q2"]);
      break;
    case 3:
      return intval($_POST["q3"]);
      break;
    case 4:
      return intval($_POST["q4"]);
      break;
    case 5:
      return intval($_POST["q5"]);
      break;
    case 6:
      return intval($_POST["q6"]);
      break;
  }
}

include_once "conexao.php";
/** Possiveis solucoes:
* ID  -> Mensagem da solucao
* 100 -> Provavelmente o problema não está na Internet, mas sim no seu aparelho. Faça...
*/

//1. Ler dados do BD em um array (X)
//2. Calcular o nivel de similaridade de cada registro do array com o novo caso
//3. Calcular qual será a saída

$query = "SELECT * FROM RESPOSTAS;";
$resultadosBD = mysqli_query($connection, $query);
$registros = [];

for ($i=0; $i < mysqli_num_rows($resultadosBD); $i++) { 
  $registros[$i] = mysqli_fetch_row($resultadosBD);
}

$casoUsuario = [$_POST["q1"],$_POST["q2"],$_POST["q3"],$_POST["q4"],$_POST["q5"],$_POST["q6"]]; //Os novo caso é armazenado no mesmo formato dos casos do banco recuperados, só sem os id's
$valoresDeSimilaridade = array_fill(0, sizeof($registros), 0);

foreach ($registros as $value) { //$value = cada linha do banco
  for ($z=0; $z < sizeof($valoresDeSimilaridade) - 1; $z++) { 
    for ($i=1; $i < 6; $i++) { 
      $valoresDeSimilaridade[$z]+= abs(getElementPostByID($i) - intval($value[$i]));
    }
  }
  echo $valoresDeSimilaridade[0]; /////////// Apresenta BUG!
}
?>