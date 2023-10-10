
document.addEventListener('DOMContentLoaded', function() {
    const faqs = document.querySelectorAll('.faq');
    faqs.forEach(faq => {
        const pergunta1 = faq.querySelector('.pergunta');
        const resposta1 = faq.querySelector('.resposta')

        faq.addEventListener('click', () =>{
            faq.classList.toggle('active');
        });
    });
});