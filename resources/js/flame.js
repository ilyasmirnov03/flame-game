const popup = document.getElementById("popupGroup");
const openPopup = document.getElementById("openPopup");
const closePopup = document.getElementById("closePopup");

if (openPopup) {
    openPopup.addEventListener("click", function () {
        popup.classList.remove("hidden");
    });
}

if (closePopup) {
    closePopup.addEventListener("click", function () {
        popup.classList.add("hidden");
    });
}
