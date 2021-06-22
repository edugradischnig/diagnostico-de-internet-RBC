<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Titillium+Web&display=swap" rel="stylesheet">

    <title>Document</title>
    <style>
      body{
        background-color:lightblue;
      }
      h3{
        font-size:30px;
        text-align: center;
        font-family: 'Lora', serif;
      }
      button {
        font-family: 'Titillium Web', sans-serif;
        font-size: 22px;
        margin-left: 42%;
        background-color: rgb(211, 211, 211);
        cursor:pointer;
        font-weight: bold;
        border: 1px solid #000
      }button:hover{
        background-color: rgb(31, 162, 68);
      }

    </style>
</head>
</style>
<body>
</body>
</html>
<?php
include_once "conexao.php";

if($_POST['feedback'] == "s"){
    echo "<h3>Que bom que funcionou, iremos armazenar seu caso para contribuir com o funcionamento do programa!</h3>";
    
    $query = "SELECT * FROM RESPOSTAS;";
    $resultadosBD = mysqli_query($connection, $query);
    $registros = [];

    for ($i=0; $i < mysqli_num_rows($resultadosBD); $i++) { 
        $registros[$i] = mysqli_fetch_row($resultadosBD);
    }

    $linhaBD = array_fill(0, sizeof($registros), "");
    $casoAtualJaEstaNoBanco = false;
    for ($x=0; $x < sizeof($registros); $x++) { 
        for ($y=1; $y < 7; $y++) { 
            $linhaBD[$x] .= $registros[$x][$y];
        }
        if($_COOKIE["casoUsuario"] == $linhaBD[$x]){
            $casoAtualJaEstaNoBanco = true;
            $x = sizeof($registros);
            break;
        }
    }
    if(!$casoAtualJaEstaNoBanco){
        $query = "INSERT INTO RESPOSTAS (quest1, quest2, quest3, quest4, quest5, quest6, idSolucao) VALUES (".$_COOKIE['casoUsuario'][0]
        .",".$_COOKIE['casoUsuario'][1].",".$_COOKIE['casoUsuario'][2].",".$_COOKIE['casoUsuario'][3].",".$_COOKIE['casoUsuario'][4]
        .",".$_COOKIE['casoUsuario'][5].",".$_COOKIE['solucao'].")";

        mysqli_query($connection, $query);
    }
    echo "<br><br>";
    echo "<a type= 'submit' href='index.html'><button>Voltar a página inicial</button></a>";
   
}else{
    echo "<h3>Desculpe por não informar a solução correta. Quem sabe você respondeu alguma pergunta de forma equivocada.</h3>";
    echo "<a type= 'submit' href='index.html'><button>Responder novamente</button></a>";
}
?>