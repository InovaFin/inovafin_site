<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["controleAdm"]) && $_SESSION["controleAdm"] == "logado") {
    header("Location: /inovafin-jean/php/painelAdm.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ADM</title>
</head>
<body>
    <form action="logadoAdm.php" method="POST">
        <p>*O acesso a esta sessão é restrito a administradores.</p>
        
        <label for="Usuários">Usuário</label>
        <input type="email" placeholder="Preencher E-mail" name="usuario_login" required><br><br>

        <label for="Senha">Senha</label>
        <input type="password" placeholder="Preencher Senha" name="senha_login" required><br><br>

        <input type="submit" value="Logar" name="botao">
    </form>
</body>
</html>