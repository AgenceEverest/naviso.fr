let boutonNewsletter = document.querySelector('#bouton-newsletter');
let newsletter = document.querySelector('#newsletter');
let closeButton = document.querySelector('#close-button');
let htmlElement = document.querySelector('html');
if(boutonNewsletter) {
    boutonNewsletter.addEventListener('click', () => {
        if(newsletter.style.display == 'block') {
            newsletter.style.display = 'none';
            htmlElement.style.overflow = 'visible';
        } else {
            newsletter.style.display = 'flex';
            htmlElement.style.overflow = 'hidden';

        }
    })
}

if (closeButton) {
    closeButton.addEventListener('click', () => {
            newsletter.style.display = 'none';
            htmlElement.style.overflow = 'visible';  
    })
}
