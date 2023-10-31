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
        <script src="/inovafin_site/script/painelAdm.js" defer></script>
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
                    
                    <div class="content-table">
                        <?php
                        include "conexao.php";
                        try {
                            $query = "SELECT * FROM TB_FALECONOSCO WHERE RESP_CONTATO IS NULL OR RESP_CONTATO = ''";
                            $stmt = $conexao->prepare($query);
                            if ($stmt->execute()) {
                                $result = $stmt->get_result();
                        
                                if ($result->num_rows > 0) {
                                ?>
                                    <table>
                                        <tbody>
                                            <?php
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td class=\"id\">" . $row['ID_CONTATO'] . "</td>";
                                                    echo "<td class=\"nome\">" . $row['NOME_CONTATO'] . "</td>";
                                                    echo "<td class=\"email\">" . $row['EMAIL_CONTATO'] . "</td>";
                                                    echo "<td class=\"mensagem\">" . $row['MSG_CONTATO'] . "</td>";
                                                    echo "<td class=\"responder\">
                                                        <button class=\"btnRespFC\">
                                                        <img src=\"/inovafin_site/img/iconRespFC.png\" alt=\"Responder\">
                                                        </button></td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php
                                } else {
                                    echo "<div class='sem-mensagem'>
                                            <p class='sem-mensagem'>Não existem mensagens para responder</p>
                                            <img class='sem-mensagem' src=\"/inovafin_site/img/iconSem-msg.png\" alt=\"Sem Mensagens\">
                                        </div>";

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
                    </div>
                </div>
            </div>
            <div id="modalAdm" class="modal-hidden">
            <div class="modalAdm-content">
                <span class="close">FECHAR</span>
                <p>Dados do Contato</p>
                <p>Nome: <span id="modal-nome"></span></p>
                <p>Email: <span id="modal-email"></span></p>
                <p>Mensagem: <span id="modal-mensagem"></span></p>
                <p>Resposta</p>
                <textarea id="resposta"></textarea>
                <button id="enviar">Enviar Resposta</button>
            </div>
        </div>
        </section>
    </body>

    </html>
