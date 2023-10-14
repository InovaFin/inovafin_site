
document.addEventListener('DOMContentLoaded', function() {
    const faqs = document.querySelectorAll('.faq');
    faqs.forEach(faq => {
        const pergunta = faq.querySelector('.pergunta');
        const resposta = faq.querySelector('.resposta')

        faq.addEventListener('click', () =>{
            faq.classList.toggle('active');
        });
    });
});