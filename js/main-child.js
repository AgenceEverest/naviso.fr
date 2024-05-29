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




function reorderTarteaucitronButtons() {
    // Sélectionner le conteneur des boutons
    let container = document.getElementById("tarteaucitronAlertBig");
    
    if (container) {
        // Sélectionner le texte des cookies à conserver
        let texteCookies = document.getElementById("tarteaucitronDisclaimerAlert");
        
        // Sélectionner les boutons individuels
        let closeButton = document.getElementById("tarteaucitronCloseAlert");
        let personalizeButton = document.getElementById("tarteaucitronPersonalize2");
        let denyButton = document.getElementById("tarteaucitronAllDenied2");
    
        // Créer un fragment pour les nouveaux éléments
        let fragment = document.createDocumentFragment();

        // Ajouter le texte des cookies au fragment
        fragment.appendChild(texteCookies);
    
        // Ajouter les boutons dans l'ordre souhaité
        fragment.appendChild(closeButton);
        fragment.appendChild(personalizeButton);
        fragment.appendChild(denyButton);
    
        // Vider le conteneur actuel des boutons tout en gardant le texte des cookies
        while (container.firstChild) {
            container.removeChild(container.firstChild);
        }
    
        // Ajouter le texte et les boutons réorganisés au conteneur
        container.appendChild(fragment);
    }
}
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        reorderTarteaucitronButtons();
    }, "600");
});