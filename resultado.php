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

//1. Ler dados do BD em um array (X)
//2. Calcular o nivel de similaridade de cada registro do array com o novo caso (x)
//3. Calcular qual será a saída

$query = "SELECT * FROM RESPOSTAS;";
$resultadosBD = mysqli_query($connection, $query);
$registros = [];

for ($i=0; $i < mysqli_num_rows($resultadosBD); $i++) { 
  $registros[$i] = mysqli_fetch_row($resultadosBD);
}

$casoUsuario = [$_POST["q1"],$_POST["q2"],$_POST["q3"],$_POST["q4"],$_POST["q5"],$_POST["q6"]]; //Os novo caso é armazenado no mesmo formato dos casos do banco recuperados, só sem os id's
$valoresDeSimilaridade = array_fill(0, sizeof($registros), 0);

for ($z=0; $z < sizeof($registros); $z++) { 
  echo "<br> Linha: ".$z."<br>";
  for ($i=1; $i < 7; $i++) { 
    echo "value: ".$casoUsuario[$i - 1]." - ".$registros[$z][$i]."<br>";
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

var_dump($valoresDeSimilaridade);
//echo "<br>Posição array caso mais similar: ".$posicaoCasoMaisSimilar;

$solucao = $registros[$posicaoCasoMaisSimilar][7];
echo $solucao;

?>