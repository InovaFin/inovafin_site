<?php
include "protectAdm.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel ADM - InovaFin</title>
    <link rel="stylesheet" href="/inovafin-jean/css/styleFC.css">
</head>
<p>Bem Vindo <?php echo $_SESSION['nomeAdm'] ?> ao Painel ADM</p>
<p><a href="logout.php">Sair</a></p>

<h1>Painel ADM</h1>

<table>
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Mensagem</th>
    </tr>

    <?php
        include "conexao.php";

        try {
            $query = "SELECT * FROM TB_FALECONOSCO";
            $stmt = mysqli_prepare($conexao, $query);
        
            if ($stmt) {
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
        
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['NOME_CONTATO'] . "</td>";
                        echo "<td>" . $row['EMAIL_CONTATO'] . "</td>";
                        echo "<td>" . $row['MSG_CONTATO'] . "</td>";
                        echo '<td><button>Responder</button></td>';
                        echo "</tr>";
                    }
                } else {
                    echo '<script>alert("Erro na consulta SQL.");</script>';
                }
                mysqli_stmt_close($stmt);
            } else {
                echo '<script>alert("Erro na preparação da consulta SQL.");</script>';
            }
        } catch (Exception $e) {
            echo '<script>alert("Erro: ' . $e->getMessage() . '");</script>';
        }
        mysqli_close($conexao);        
    ?>
</table>
</body>
</html>