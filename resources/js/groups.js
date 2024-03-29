window.addEventListener("DOMContentLoaded", function () {
    const rangeInput = document.getElementById("rangeInput");
    const rangeValue = document.getElementById("rangeValue");
    const choice = document.getElementById("group-choice");
    const popup = document.getElementById("group-popup");

    if (rangeInput != null) {
        rangeInput.addEventListener("input", (e) => {
            const percent =
                (e.target.value - e.target.min) / (e.target.max - e.target.min);
            const thumbWidth = 16;
            const newPosition = percent * (e.target.offsetWidth - thumbWidth);
            rangeValue.textContent = e.target.value;
            rangeValue.style.left = `${newPosition}px`;
        });
    }

    const groupIconContainer = document.getElementById("groupIcon");
    const selectedIconInput = document.getElementById("icon");
    groupIcons.forEach((icon) => {
        const iconElement = document.createElement("div");
        iconElement.classList.add("group__form--icon-option");
        iconElement.style.backgroundImage = `url('/images/group_icons/${icon}')`;

        iconElement.addEventListener("click", function () {
            selectedIconInput.value = icon;
            popup.classList.toggle("hidden");
            choice.style.backgroundImage = `url('/images/group_icons/${icon}')`;
        });

        groupIconContainer.appendChild(iconElement);
    });

    choice.addEventListener("click", function () {
        popup.classList.toggle("hidden");
    });
});
