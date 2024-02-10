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

    fontSizeElement.addEventListener("input", function () {
        applyFontSize(this.value);
    });

    dyslexieElement.addEventListener("click", function () {
        toggleDyslexie();
    });

    selectDaltonisme.addEventListener("change", function () {
        applyDaltonisme(this.value);
    });

    darkModeToggle.addEventListener("change", function () {
        applyDarkMode(this.checked);
    });

    resetButton.addEventListener("click", function () {
        resetSettings();
    });

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
        fontSizeElement.value = localStorage.getItem("fontSize") || 4;
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
        if (value !== "none") {
            daltonismContainer.classList.add(`daltonism-${value}`);
        }
        localStorage.setItem("daltonisme", value);
    }

    function applyDarkMode(isDarkMode) {
        if (isDarkMode) {
            htmlElement.style.setProperty("--white", "#020d19");
            htmlElement.style.setProperty("--black", "#f1f1f1");
            pwaImage.src = window.pwaWhiteImagePath;
        } else {
            htmlElement.style.setProperty("--white", "#f1f1f1");
            htmlElement.style.setProperty("--black", "#020d19");
            pwaImage.src = window.pwaImagePath;
        }
        localStorage.setItem("darkMode", isDarkMode.toString());
    }

    function resetSettings() {
        localStorage.clear();
        updateFormValues();
        location.reload();
    }
});
