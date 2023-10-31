var modal = document.getElementById("modalAdm");
var responderBtns = document.getElementsByClassName("responder");
var closeBtn = document.getElementsByClassName("close")[0];

// Ocultar o modal ao carregar a página
modal.style.display = "none";

// recupera e atribui dados da tabela ao modal
for (var i = 0; i < responderBtns.length; i++) {
    responderBtns[i].addEventListener("click", function(event) {
        var tr = event.target.closest("tr");
        var nome = tr.querySelector(".nome").textContent;
        var email = tr.querySelector(".email").textContent;
        var mensagem = tr.querySelector(".mensagem").textContent;

        document.getElementById("modal-nome").textContent = nome;
        document.getElementById("modal-email").textContent = email;
        document.getElementById("modal-mensagem").textContent = mensagem;

        // Exiba o modal quando o botão "Responder" for clicado
        modal.style.display = "flex";
    });
}

// Quando o botão "Fechar" do modal é clicado, feche o modal
closeBtn.addEventListener("click", function() {
    modal.style.display = "none";
});

