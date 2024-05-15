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

let boutonsNewsletterFooter = document.querySelectorAll('.newsletter-button-footer'); // il y a 2 boutons, l'un pour le mobile, l'autre pour desktop
let newsletterFooter = document.querySelector('#newsletter-footer');
let closeButtonFooter = document.querySelector('#close-button-footer');
if (boutonsNewsletterFooter.length > 0) {
    boutonsNewsletterFooter.forEach(button => {
        button.addEventListener('click', () => {
            if (newsletterFooter.style.display == 'block') {
                newsletterFooter.style.display = 'none';
                htmlElement.style.overflow = 'visible';
            } else {
                newsletterFooter.style.display = 'flex';
                htmlElement.style.overflow = 'hidden';
            }
        })
    })
}


closeButtonFooter.addEventListener('click', () => {
    newsletterFooter.style.display = 'none';
    htmlElement.style.overflow = 'visible';
})


document.addEventListener('DOMContentLoaded', function() {
    document.querySelector(".phone_number").addEventListener('click', (event) => {
        document.querySelector(".phone_number #afficherNumeroTelephone").style.display = 'none'
        document.querySelector(".phone_number #numeroTelephone").style.display = 'inline-block'
    })
});