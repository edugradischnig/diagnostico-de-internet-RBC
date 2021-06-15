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
/** Possiveis solucoes:
* ID  -> Mensagem da solucao
* 100 -> Provavelmente o problema não está na Internet, mas sim no seu aparelho. Faça...
*/

//1. Ler dados do BD em um array
//2. Calcular o nivel de similaridade de cada registro do array com o novo caso
//3. Calcular qual será a saída

$query = "SELECT * FROM RESPOSTAS;";
$resultadosBD = mysqli_query($connection, $query);
$registros = [];

for ($i=0; $i < mysqli_num_rows($resultadosBD); $i++) { 
  $registros[$i] = mysqli_fetch_row($resultadosBD);
}

//echo($registros[0][1]);
//abs()
?>