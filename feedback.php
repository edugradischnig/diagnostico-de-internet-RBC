<?php
if($_POST['feedback'] == "s"){
    // 1 - Verificar se ja não existe uma solução igual no banco ()
    // 2 - Armazenar, ou não, esse caso ()
    echo "<h3>Que bom que funcionou, iremos armazenar seu caso para contribuir com o funcionamento do programa!</h3>";
}else{
    echo "Codigo para recuperar...";
}
?>