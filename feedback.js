document.querySelector('form').addEventListener('submit', function(event) {
    const rating = document.querySelector('input[name="estrela"]:checked');
    const comment = document.querySelector('textarea').value;

    if (!rating) {
        alert('Por favor, selecione uma avaliação.');
        event.preventDefault();
    }
});