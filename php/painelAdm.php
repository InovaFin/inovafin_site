<?php
include "protectAdm.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel ADM - InovaFin</title>
    <link rel="stylesheet" href="/inovafin_site/css/styleFC.css">
</head> 

<header>
    <div class="logo">
        <a href="/inovafin_site/index.html"><img src="/inovafin_site/img/InovaFin.png" alt="logoInovafin"></a>
    </div>
    <div class="painelAdm">
        <img src="/inovafin_site/img/iconPainelAdm.png" alt="">
        <p>Painel ADM</p>
    </div>
    <div class="btnSair">
        <button>
            <a href="logout.php"><img src="/inovafin_site/img/iconBtnSair.png" alt="logout">Sair</a>
        </button>
    </div>
</header>
<body class="fundoPainelAdm">    
<section class="main-painelAdm">

    <div class="container-adm">
        <div class="container-menuAdm">
            <p>Bem Vindo <?php echo $_SESSION['nomeAdm'] ?></p>
            <div class="iconRespAdm">icon</div>
        </div>
        
        <div class="container-table">
            <p>Mensagens a serem respondidas</p>
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
                                    echo "<td class=\"nome\">" . $row['NOME_CONTATO'] . "</td>";
                                    echo "<td class=\"email\">" . $row['EMAIL_CONTATO'] . "</td>";
                                    echo "<td class=\"mensagem\">" . $row['MSG_CONTATO'] . "</td>";
                                    echo "<td class=\"responder\"><button>Responder</button></td>";
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
        </div>
    </div>
</section>
</body>
</html>