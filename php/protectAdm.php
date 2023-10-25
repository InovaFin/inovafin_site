<?php

if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION["controleAdm"]) || $_SESSION["controleAdm"] !== "logado") {
    die("Você não pode acessar essa pagina porque não esta logado. <p><a href=\"/inovafin-jean/index.html\"> Voltar </a></p>");
}

?>