<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {    // Verifica se a solicitação HTTP é do tipo POST.

    $botao = $_POST["botao"];

    if ($botao == "Logar") {
                
        include "logadoAdm.php";
    }
      
}
?>


