function exibirAlerta($titulo, $mensagem, $icone, $corBotao, $redirecionar) {
    Swal.fire({
        title: $titulo,
        text: $mensagem,
        icon: $icone,
        confirmButtonColor: $corBotao
    }).then(function () {
        window.location.href = $redirecionar;
    });
}


