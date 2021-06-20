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
        echo "VOU ADICIONAR!!!!!!<br>";
        echo $_COOKIE['solucao'];
        $query = "INSERT INTO RESPOSTAS (quest1, quest2, quest3, quest4, quest5, quest6, idSolucao) VALUES (".$_COOKIE['casoUsuario'][0]
        .",".$_COOKIE['casoUsuario'][1].",".$_COOKIE['casoUsuario'][2].",".$_COOKIE['casoUsuario'][3].",".$_COOKIE['casoUsuario'][4]
        .",".$_COOKIE['casoUsuario'][5].",".$_COOKIE['solucao'].")";

        //mysqli_query($connection, $query); LINHA DE ACIÇÃO NO BANCO FUNCIONANDO
    }
   
}else{
    echo "<h3>Desculpe por não informar a solução correta. Quem sabe você respondeu alguma pergunta de forma equivocada.</h3>";
    echo "<a href='index.html'><button>Responder novamente</button></a>";
}
?>