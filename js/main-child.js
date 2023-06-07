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
console.log('ok');
if (boutonNewsletterFooter) {
    boutonNewsletterFooter.addEventListener('click', () => {
        console.log(boutonNewsletterFooter);
        console.log(newsletterFooter);
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

let afficherNumeroTelephone = document.querySelector('#afficherNumeroTelephone');
let numeroTelephone = document.querySelector('#numeroTelephone');

if (afficherNumeroTelephone && numeroTelephone) {
    afficherNumeroTelephone.addEventListener('click', () => {
        numeroTelephone.style.display = 'block';
        afficherNumeroTelephone.style.display = 'none';
    })
}

