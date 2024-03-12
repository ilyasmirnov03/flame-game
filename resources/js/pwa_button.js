let installPrompt;

const installButton = document.querySelector('#pwa_install_button');

window.addEventListener('DOMContentLoaded', async () => {
    const relatedApps = await navigator.getInstalledRelatedApps();
    console.log(relatedApps);
    if (relatedApps.length > 0) {
        installButton.remove();
    } else {
        // Defer install prompt
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            installPrompt = e;
        });

        // Upon clicking, prompt the install
        installButton.addEventListener('click', async () => {
            if (!installPrompt) {
                return;
            }
            const result = await installPrompt.prompt();
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
    }
})
