import {SETTINGS_LOCAL_STORAGE} from "../constants/settings.local-storage.constant.js";
import {applyColorBlindness, applyDarkMode, applyFontSize, toggleDyslexia} from "./applySettings.js";

/**
 * Select a language from menu
 * @param e{Event}
 */
function selectLanguage(e) {
    if (typeof e.detail.item.value !== 'string') {
        console.error('Error: menu item doesn\'t have proper value.');
        return;
    }
    fetch(e.detail.item.value)
        .then(() => {
            window.location.reload();
        })
        .catch(() => {
            console.error('Error: error on language change request.');
        });
}

/**
 * Setup event listeners
 * @event DOMContentLoaded
 */
function setupHandlers() {
    const fontSizeElement = document.getElementById("fontSize");
    const dyslexiaElement = document.getElementById("dyslexia");
    const selectColorBlindness = document.getElementById("selectColorBlindness");
    const darkModeToggle = document.getElementById("dark");

    document.getElementById("resetButton")?.addEventListener("click", resetSettings);
    document.getElementById('languageSelect')?.addEventListener('sl-select', selectLanguage);

    fontSizeElement?.addEventListener("sl-change", () =>
        applyFontSize(fontSizeElement.value)
    );
    dyslexiaElement?.addEventListener("sl-input", toggleDyslexia);
    selectColorBlindness?.addEventListener("sl-input", () =>
        applyColorBlindness(selectColorBlindness.value)
    );
    darkModeToggle?.addEventListener("sl-input", () => {
        applyDarkMode(darkModeToggle.checked)
    });
}

/**
 * Reset settings
 */
function resetSettings() {
    localStorage.clear();
    updateFormValues();
    window.location.reload();
}

/**
 * Update values on inputs from local storage on load
 */
function updateFormValues() {
    const fontSizeElement = document.getElementById("fontSize");
    const dyslexiaElement = document.getElementById("dyslexia");
    const selectColorBlindness = document.getElementById("selectColorBlindness");
    const darkModeToggle = document.getElementById("dark");

    if (localStorage.getItem(SETTINGS_LOCAL_STORAGE.FONT_SIZE) != null) {
        fontSizeElement.value = localStorage.getItem(SETTINGS_LOCAL_STORAGE.FONT_SIZE);
    }

    dyslexiaElement.checked = localStorage.getItem(SETTINGS_LOCAL_STORAGE.DYSLEXIA) === "true";
    selectColorBlindness.value = localStorage.getItem(SETTINGS_LOCAL_STORAGE.COLOR_BLINDNESS) || "none";
    darkModeToggle.checked = localStorage.getItem(SETTINGS_LOCAL_STORAGE.DARK_MODE) === "true";
}

document.addEventListener("DOMContentLoaded", function () {
    updateFormValues();
    setupHandlers();
});
