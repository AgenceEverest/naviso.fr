let boutonNewsletter = document.querySelector('#bouton-newsletter');
let newsletter = document.querySelector('#newsletter');
let closeButton = document.querySelector('#close-button');
let htmlElement = document.querySelector('html');
if (boutonNewsletter) {
    boutonNewsletter.addEventListener('click', () => {
        if (newsletter.style.display == 'block') {
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




let boutonNewsletterFooter = document.querySelector('#newsletter-button-footer');
let newsletterFooter = document.querySelector('#newsletter-footer');
let closeButtonFooter = document.querySelector('#close-button-footer');
if (boutonNewsletterFooter) {
    boutonNewsletterFooter.addEventListener('click', () => {
        if (newsletterFooter.style.display == 'block') {
            newsletterFooter.style.display = 'none';
            htmlElement.style.overflow = 'visible';
        } else {
            newsletterFooter.style.display = 'flex';
            htmlElement.style.overflow = 'hidden';

        }
    })
}

if (closeButtonFooter) {
    closeButtonFooter.addEventListener('click', () => {
        newsletterFooter.style.display = 'none';
        htmlElement.style.overflow = 'visible';
    })
}
