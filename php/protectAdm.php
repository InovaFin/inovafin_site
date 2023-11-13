<?php

if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION["controleAdm"]) || $_SESSION["controleAdm"] !== "logado") {
    $error_message = "Você não pode acessar essa página porque não está logado.";
    echo "
        <style>
            a:focus {
                outline: none !important;
            }
        </style>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Você precisa fazer login antes de acessar esta página.',
                showConfirmButton: false,
                footer: '<a href=\"/inovafin_site/index.html\">Voltar</a>'
            }).then(function() {
                window.location.href = '/inovafin_site/index.html';
            });
          </script>";
    exit;
}
?>
