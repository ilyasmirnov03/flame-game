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
    const dyslexieElement = document.getElementById("dyslexia");
    const selectColorBlindness = document.getElementById("selectColorBlindness");
    const darkModeToggle = document.getElementById("dark");

    document.getElementById("resetButton")?.addEventListener("click", resetSettings);
    document.getElementById('languageSelect').addEventListener('sl-select', selectLanguage);

    fontSizeElement?.addEventListener("sl-change", () =>
        applyFontSize(fontSizeElement.value)
    );
    dyslexieElement?.addEventListener("sl-input", toggleDyslexia);
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

    if (!fontSizeElement) {
        return;
    }

    fontSizeElement.value =
        localStorage.getItem("fontSize") !== null
            ? localStorage.getItem("fontSize")
            : 4;

    dyslexiaElement.checked = localStorage.getItem("dyslexia") === "true";
    selectColorBlindness.value = localStorage.getItem("colorBlindness") || "none";
    darkModeToggle.checked = localStorage.getItem("darkMode") === "true";
}

/**
 * Apply stored settings from local storage
 * @event DOMContentLoaded
 */
function applyStoredSettings() {
    const storedFontSize = localStorage.getItem("fontSize");
    if (storedFontSize) {
        applyFontSize(storedFontSize);
    }

    const storedDyslexia = localStorage.getItem("dyslexia");
    if (storedDyslexia === "true") {
        toggleDyslexia();
    }

    const storedColorBlindness = localStorage.getItem("colorBlindness");
    if (storedColorBlindness) {
        applyColorBlindness(storedColorBlindness);
    }

    const storedDarkMode = localStorage.getItem("darkMode");
    if (storedDarkMode === "true") {
        applyDarkMode(true);
    }
}

/**
 * Apply font size setting from local storage
 * @param value{string}
 */
function applyFontSize(value) {
    document.documentElement.style.fontSize = `${value}px`;
    localStorage.setItem("fontSize", value);
}

/**
 * Toggle dyslexia setting
 */
function toggleDyslexia() {
    document.body.classList.toggle('dyslexia');
    const isDyslexiaEnabled = document.body.classList.contains("dyslexia");
    localStorage.setItem("dyslexia", isDyslexiaEnabled.toString());
}

/**
 * Apply color blindness setting
 * @param value{string}
 */
function applyColorBlindness(value) {
    document.body.classList.remove(
        "cb-protanopia",
        "cb-deuteranopia",
        "cb-tritanopia",
        "cb-achromatopsia"
    );
    value !== "none" && document.body.classList.add(`cb-${value}`);
    localStorage.setItem("colorBlindness", value);
}

/**
 * Apply dark mode setting
 * @param isDarkMode{boolean}
 */
function applyDarkMode(isDarkMode) {
    const whiteValue = isDarkMode ? "#020d19" : "#f1f1f1";
    const blackValue = isDarkMode ? "#f1f1f1" : "#020d19";

    document.documentElement.style.setProperty("--white", whiteValue);
    document.documentElement.style.setProperty("--black", blackValue);
    document.documentElement.classList.toggle('sl-theme-dark', isDarkMode);
    localStorage.setItem("darkMode", isDarkMode.toString());
}

document.addEventListener("DOMContentLoaded", function () {
    applyStoredSettings();
    updateFormValues();
    setupHandlers();
});
