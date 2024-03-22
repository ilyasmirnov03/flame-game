document.addEventListener("DOMContentLoaded", function () {
    const fontSizeElement = document.getElementById("fontSize");
    const dyslexieElement = document.getElementById("dyslexie");
    const selectDaltonisme = document.getElementById("selectDaltonisme");
    const daltonismContainer = document.querySelector(".daltonism-container");
    const htmlElement = document.documentElement;
    const allText = document.querySelectorAll(".font");
    const darkModeToggle = document.getElementById("dark");
    const pwaImage = document.querySelector(".pwa__img");
    const resetButton = document.getElementById("resetButton");

    applyStoredSettings();
    updateFormValues();

    fontSizeElement?.addEventListener("change", () =>
        applyFontSize(fontSizeElement.value)
    );
    dyslexieElement?.addEventListener("click", toggleDyslexie);
    selectDaltonisme?.addEventListener("change", () =>
        applyDaltonisme(selectDaltonisme.value)
    );
    darkModeToggle?.addEventListener("change", () =>
        applyDarkMode(darkModeToggle.checked)
    );
    resetButton?.addEventListener("click", resetSettings);

    function applyStoredSettings() {
        const storedFontSize = localStorage.getItem("fontSize");
        if (storedFontSize) {
            applyFontSize(storedFontSize);
        }

        const storedDyslexie = localStorage.getItem("dyslexie");
        if (storedDyslexie === "true") {
            toggleDyslexie();
        }

        const storedDaltonisme = localStorage.getItem("daltonisme");
        if (storedDaltonisme) {
            applyDaltonisme(storedDaltonisme);
        }

        const storedDarkMode = localStorage.getItem("darkMode");
        if (storedDarkMode === "true") {
            applyDarkMode(true);
        }
    }

    function updateFormValues() {
        if (!fontSizeElement) {
            return;
        }

        fontSizeElement.value =
            localStorage.getItem("fontSize") !== null
                ? localStorage.getItem("fontSize")
                : 4;

        dyslexieElement.checked = localStorage.getItem("dyslexie") === "true";
        selectDaltonisme.value = localStorage.getItem("daltonisme") || "none";
        darkModeToggle.checked = localStorage.getItem("darkMode") === "true";
    }

    function applyFontSize(value) {
        const minMultiplier = 0.7;
        const maxMultiplier = 3;
        const adjustedValue =
            minMultiplier +
            (maxMultiplier - minMultiplier) * (parseFloat(value) / 20);
        allText.forEach((textElement) => {
            textElement.style.fontSize = `${adjustedValue}em`;
        });
        localStorage.setItem("fontSize", value);
    }

    function toggleDyslexie() {
        const elementsToStyle = document.querySelectorAll(".dyslexie");
        elementsToStyle.forEach(function (element) {
            element.classList.toggle("dyslexique");
        });
        const isDyslexieEnabled =
            elementsToStyle[0].classList.contains("dyslexique");
        localStorage.setItem("dyslexie", isDyslexieEnabled.toString());
    }

    function applyDaltonisme(value) {
        daltonismContainer.classList.remove(
            "daltonism-protanopia",
            "daltonism-deuteranopia",
            "daltonism-tritanopia",
            "daltonism-achromatopsia"
        );
        value !== "none" &&
            daltonismContainer.classList.add(`daltonism-${value}`);
        localStorage.setItem("daltonisme", value);
    }

    function applyDarkMode(isDarkMode) {
        const whiteValue = isDarkMode ? "#020d19" : "#f1f1f1";
        const blackValue = isDarkMode ? "#f1f1f1" : "#020d19";

        htmlElement.style.setProperty("--white", whiteValue);
        htmlElement.style.setProperty("--black", blackValue);
        localStorage.setItem("darkMode", isDarkMode?.toString());
    }

    function resetSettings() {
        localStorage.clear();
        updateFormValues();
        location.reload();
    }
});
