let boutonNewsletter = document.querySelector('#bouton-newsletter');
let newsletter = document.querySelector('#newsletter');

boutonNewsletter.addEventListener('click', () => {
    if(newsletter.style.display == 'block') {
        newsletter.style.display = 'none';
    } else {
        newsletter.style.display = 'flex';
    }
})