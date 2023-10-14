<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {    // Verifica se a solicitação HTTP é do tipo POST.

    if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["mensagem"])) { // Verifica se os campos "nome", "email" e "mensagem" estão definidos na solicitação.

        // Atribui os valores dos campos POST a variáveis locais.
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $msg = $_POST["mensagem"];

        include("conexao.php");  // Inclui o arquivo de conexão com o banco de dados.

        if ($conexao) {
            $comando = "INSERT INTO TB_FALECONOSCO (NOME_CONTATO, EMAIL_CONTATO, MSG_CONTATO) VALUES (?, ?, ?)";
            
            try {
                $stmt = mysqli_prepare($conexao, $comando);  // Tenta preparar a instrução SQL.

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $msg);  // Vincula os parâmetros à instrução preparada.
                    $resultado = mysqli_stmt_execute($stmt);  // Tenta executar a instrução preparada.

                    if ($resultado) {
                        $dados = array("status" => "ok");  // Se a inserção for bem-sucedida, define um status "ok".
                    } else {
                        $dados = array("status" => "erro");  
                    }

                    mysqli_stmt_close($stmt);  // Fecha a instrução preparada.
                } else {
                    $dados = array("status" => "erro_preparacao");  
                }

                $close = mysqli_close($conexao);  // Tenta fechar a conexão com o banco de dados.

                if (!$close) {
                    $dados = array("status" => "erro_fechamento_conexao");  
                }
            } catch (Exception) {
                $dados = array("status" => "erro_exception");  
            }
        } else {
            $dados = array("status" => "erro_conexao");  
        }
    } else {
        $dados = array("status" => "parametros_faltando");  
    }
} else {
    $dados = array("status" => "metodo_invalido");  
}

echo json_encode($dados);  // Converte a resposta em formato JSON e a envia de volta ao cliente.
?>
