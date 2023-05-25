let boutonNewsletter = document.querySelector('#bouton-newsletter');
let newsletter = document.querySelector('#newsletter');
let closeButton = document.querySelector('#close-button');
if(boutonNewsletter) {
    boutonNewsletter.addEventListener('click', () => {
        if(newsletter.style.display == 'block') {
            newsletter.style.display = 'none';
        } else {
            newsletter.style.display = 'flex';
        }
    })
}

if (closeButton) {
    closeButton.addEventListener('click', () => {
            newsletter.style.display = 'none';      
    })
}
