document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");

    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.toLowerCase();

        const groupElements = document.querySelectorAll(".group");

        groupElements.forEach(function (groupElement) {
            const groupName = groupElement
                .querySelector("h2")
                .textContent.toLowerCase();

            if (groupName.includes(searchTerm)) {
                groupElement.style.display = "flex";
            } else {
                groupElement.style.display = "none";
            }
        });
    });
});
