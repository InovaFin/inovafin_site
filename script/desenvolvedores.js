document.addEventListener("DOMContentLoaded", function(){
    const button = document.getElementById("button");
    const modal = document.getElementById("modal");
    const seta = document.getElementById("setaButton");
   

    button.onclick = function () {
        if (modal.style.display == "block") 
        {
            modal.style.display = "none";
            seta.classList.remove("animacaoSetaAbre");
            seta.classList.add("animacaoSetaFecha");

        } else {
            modal.style.display = "block";
            modal.classList.add("abreModal");
            seta.classList.remove("animacaoSetaFecha");
            seta.classList.add("animacaoSetaAbre");
        }
    }
});



