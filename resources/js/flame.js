function init() {
    const popup = document.querySelector('sl-dialog.group-join');
    const openPopup = document.getElementById("openPopup");

    openPopup.addEventListener("click", () => popup.show());
}

window.addEventListener('DOMContentLoaded', init);
