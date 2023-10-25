<?php

//$dbHost = 'localhost';
//$dbUsername = 'id21296824_inovafin';
//$dbPassword ='Papaga!olistrado7';
//$dbName = 'id21296824_db_inovafin';

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword ='';
$dbName = 'dbcontato';

$conexao = mysqli_connect ($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

?>