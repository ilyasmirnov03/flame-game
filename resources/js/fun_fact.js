import {SETTINGS_LOCAL_STORAGE} from "./constants/settings.local-storage.constant.js";

/**
 * Open the dialog
 * @param popup{HTMLDialogElement}
 * @event click
 */
function openDialog(popup) {
    popup.show();
}

/**
 * Close the dialog
 * @param popup{HTMLDialogElement}
 * @event click
 */
function closeDialog(popup) {
    popup.hide();
}

function init() {
    const $dialog = document.querySelector('sl-dialog.fun-fact');
    const $openBtn = document.querySelector('.open-fun-fact-popup');
    const $closeBtn = document.querySelector(".close-fun-fact");

    const currentDate = new Date();
    const lastSeenDate = localStorage.getItem(SETTINGS_LOCAL_STORAGE.FUN_FACT_LAST_SEEN_DATE);

    if (lastSeenDate == null && new Date(lastSeenDate).getDate() !== currentDate.getDate()) {
        $dialog.show();
        localStorage.setItem(SETTINGS_LOCAL_STORAGE.FUN_FACT_LAST_SEEN_DATE, currentDate.toISOString());
    }

    $openBtn.addEventListener('click', () => openDialog($dialog));
    $closeBtn.addEventListener('click', () => closeDialog($dialog));

    // Update open btn state
    $dialog.addEventListener('sl-hide', () => $openBtn.classList.remove('active'));
    $dialog.addEventListener('sl-show', () => $openBtn.classList.add('active'));
}

window.addEventListener('DOMContentLoaded', init);
