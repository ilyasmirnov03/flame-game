window.addEventListener("DOMContentLoaded", function () {
    const choice = document.getElementById("group-choice");
    const dialog = document.querySelector("sl-dialog");
    const selectedIconInput = document.getElementById("icon");
    const $previewImage = document.querySelector('.group__icon--choice>img');

    const groupIcons = document.querySelectorAll('#groupIcons>img');
    groupIcons.forEach((icon) => {
        icon.addEventListener("click", function () {
            selectedIconInput.value = icon.src.split('/').pop();
            $previewImage.src = icon.src;
            dialog.hide();
        });
    });

    choice.addEventListener("click", function () {
        dialog.show();
    });
});
