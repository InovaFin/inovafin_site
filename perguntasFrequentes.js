document.addEventListener('DOMContentLoaded', function() {
    const faqs = document.querySelectorAll('.faq');
    faqs.forEach(faq => {
        const pergunta1 = faq.querySelector('.pergunta');
        const resposta1 = faq.querySelector('.resposta')

        faq.addEventListener('click', () =>{
            faq.classList.toggle('active');
        });
    });

    const faqs2 = document.querySelectorAll('.faq2');
    faqs2.forEach(faq2 => {
        const pergunta2 = faq2.querySelector('.pergunta2');
        const resposta2 = faq2.querySelector('.resposta2')

        faq2.addEventListener('click', () =>{
            faq2.classList.toggle('active2');
        });
    });

    const faqs3 = document.querySelectorAll('.faq3');
    faqs3.forEach(faq3 => {
        const pergunta3 = faq3.querySelector('.pergunta3');
        const resposta3 = faq3.querySelector('.resposta3')

        faq3.addEventListener('click', () =>{
            faq3.classList.toggle('active3');
        });
    });

    const faqs4 = document.querySelectorAll('.faq4');
    faqs4.forEach(faq4 => {
        const pergunta4 = faq4.querySelector('.pergunta4');
        const resposta4 = faq4.querySelector('.resposta4')

        faq4.addEventListener('click', () =>{
            faq4.classList.toggle('active4');
        });
    });
});