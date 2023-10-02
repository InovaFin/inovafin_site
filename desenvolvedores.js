document.addEventListener("DOMContentLoaded", function(){

    const button = document.getElementById("button")
    const modal = document.querySelector("dialog")
    const seta = document.getElementById("setaButton")
    
    button.onclick = function () 
    {
        if (modal.open) {
            modal.close()
            seta.classList.add("rotacionada")
            
        }
        else
        {
            modal.show()
            seta.classList.remove("rotacionada")
        }
    }
});