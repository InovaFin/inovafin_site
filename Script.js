const slider = document.querySelectorAll('.slider');//Seleciona todas os objetos com a classe slider
const btnVoltar = document.getElementById('btnVoltar');//Pegando a seta de voltar 
const btnAvancar = document.getElementById('btnAvancar');//pegando a seta de avancar


var currentSlide = 0;//Variável que pode ser modificada posteriormente - rastreia o numero do slide

function hideSlider()//Função ocultar slide
{
    slider.forEach(item => item.classList.remove('on'));//passa por todos os componentes do slide e remove a classe on
}

function showSlider()//Função mostrar slide
{
    slider[currentSlide].classList.add('on');//Adiciona o on a classe, dependendo da posição do currentSlide atual
}


function proximoSlider()//Função para avançar um slide
{
    hideSlider()//Função ocultar slide
    if (currentSlide == slider.length -1)//Verifica se o slide atual e o ultimo do conjunto
    {
        currentSlide = 0;//CurrentSlide recebe zero
    }else{
        currentSlide++;//CurrentSlide recebe + 1
    }
    showSlider();//Exibe o slide atual
}

function voltarSlider()//Função para voltar um slide
{
    hideSlider()//ocultar slide
    if (currentSlide == 0)//se CurrentSlide for igual ao primeiro slide 
    {
        currentSlide = slider.length - 1;//currentSlide vai para o ultimo
    }else{
        currentSlide--;//subtraindo o current slide
    }
    showSlider();//Mostrando slide atual
}

btnAvancar.addEventListener('click', () => proximoSlider());//adicionando o evento no botão
btnVoltar.addEventListener('click', () => voltarSlider());//adicionando o evento no botão