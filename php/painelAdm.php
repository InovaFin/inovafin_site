<?php
    include "protectAdm.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel ADM - InovaFin</title>
</head>
<body>
    <p>Bem Vindo <?php echo $_SESSION['nomeAdm'] ?> ao Painel ADM </p>

    <p><a href="logout.php">Sair</a></p>
</body>
</html>