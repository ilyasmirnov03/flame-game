if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/js/serviceworker.js')
        .then(registration => {
            console.log('Service Worker registered with scope:', registration.scope);
        })
        .catch(error => {
            console.error('Service Worker registration failed:', error);
        });
}
