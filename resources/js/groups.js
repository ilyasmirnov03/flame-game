const rangeInput = document.getElementById("rangeInput");
const rangeValue = document.getElementById("rangeValue");

if (rangeInput) {
    rangeInput.addEventListener("input", (e) => {
        const percent =
            (e.target.value - e.target.min) / (e.target.max - e.target.min);
        const thumbWidth = 16;
        const newPosition = percent * (e.target.offsetWidth - thumbWidth);
        rangeValue.textContent = e.target.value;
        rangeValue.style.left = `${newPosition}px`;
    });
}
