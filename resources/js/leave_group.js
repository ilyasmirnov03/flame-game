const params = document.getElementById("params");
const popup = document.getElementById("groupSettingsPopup");
const Popupclose = document.getElementById("close");

params.addEventListener("click", function () {
    popup.classList.toggle("hidden");
});

Popupclose.addEventListener("click", function () {
    popup.classList.toggle("hidden");
});
