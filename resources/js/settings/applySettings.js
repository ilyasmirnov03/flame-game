import {SETTINGS_LOCAL_STORAGE} from "../constants/settings.local-storage.constant.js";

/**
 * Apply stored settings from local storage
 * @event DOMContentLoaded
 */
export function applyStoredSettings() {
    const storedFontSize = localStorage.getItem(SETTINGS_LOCAL_STORAGE.FONT_SIZE);
    if (storedFontSize) {
        applyFontSize(storedFontSize);
    }

    const storedDyslexia = localStorage.getItem(SETTINGS_LOCAL_STORAGE.DYSLEXIA);
    if (storedDyslexia === "true") {
        toggleDyslexia();
    }

    const storedColorBlindness = localStorage.getItem(SETTINGS_LOCAL_STORAGE.COLOR_BLINDNESS);
    if (storedColorBlindness) {
        applyColorBlindness(storedColorBlindness);
    }

    const storedDarkMode = localStorage.getItem(SETTINGS_LOCAL_STORAGE.DARK_MODE);
    if (storedDarkMode === "true") {
        applyDarkMode(true);
    }
}

/**
 * Apply font size setting from local storage
 * @param value{string}
 */
export function applyFontSize(value) {
    document.documentElement.style.fontSize = `${value}px`;
    localStorage.setItem("fontSize", value);
}

/**
 * Apply color blindness setting
 * @param value{string}
 */
export function applyColorBlindness(value) {
    document.body.classList.remove(
        "cb-protanopia",
        "cb-deuteranopia",
        "cb-tritanopia",
        "cb-achromatopsia"
    );
    value !== "none" && document.body.classList.add(`cb-${value}`);
    localStorage.setItem(SETTINGS_LOCAL_STORAGE.COLOR_BLINDNESS, value);
}

/**
 * Apply dark mode setting
 * @param isDarkMode{boolean}
 */
export function applyDarkMode(isDarkMode) {
    document.documentElement.classList.toggle('sl-theme-dark', isDarkMode);
    localStorage.setItem(SETTINGS_LOCAL_STORAGE.DARK_MODE, isDarkMode.toString());
}

/**
 * Toggle dyslexia setting
 */
export function toggleDyslexia() {
    document.body.classList.toggle('dyslexia');
    const isDyslexiaEnabled = document.body.classList.contains("dyslexia");
    localStorage.setItem(SETTINGS_LOCAL_STORAGE.DYSLEXIA, isDyslexiaEnabled.toString());
}

window.addEventListener('DOMContentLoaded', applyStoredSettings);
