$(document).ready(function() {
    // Adiciona animação de rolagem suave aos links do menu
    $('a').click(function(e) {
        e.preventDefault();

        const targetId = $(this).attr('href');
        const targetPosition = $(targetId).offset().top;

        // Subtrai a altura do cabeçalho fixo e um valor adicional de margem
        const headerHeight = $('header').outerHeight();
        const margin = 25; // Valor adicional de margem (ajuste conforme necessário)

        $('html, body').animate({
            scrollTop: targetPosition - headerHeight - margin
        }, 'slow');
    });
});
