let installPrompt;

let installButton = document.createElement('button');
installButton.classList.add('header__link');
installButton.id = 'pwa_install_button';

let installButtonIcon = document.createElement('img');
installButtonIcon.classList.add('pwa__img');
installButtonIcon.src = "/images/pwa.svg";
installButtonIcon.alt = "Télécharger la PWA";
installButton.appendChild(installButtonIcon);

const header = document.querySelector('.header');
const logo = document.querySelector('.header__logo');

window.addEventListener('DOMContentLoaded', async () => {
    // Defer install prompt
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        logo.insertAdjacentElement('afterend', installButton);
        installPrompt = e;
    });

    // Upon clicking, prompt the install
    installButton.addEventListener('click', async () => {
        if (!installPrompt) {
            return;
        }

        installPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
                installButton.remove();
            } else {
                // maybe do something when dismissed ?
            }
        });
    });

    // Upon install
    window.addEventListener('appinstalled', () => {
        installButton.remove();
    });
})
