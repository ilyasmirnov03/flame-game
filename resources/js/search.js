function searchGroups() {
    const searchTerm = document.getElementById("searchInput").value;
    const groupSearchRoute = document.head.querySelector(
        'meta[name="groupSearchRoute"]'
    ).content;

    fetch(groupSearchRoute + "?search=" + searchTerm)
        .then((response) => response.text())
        .then((data) => {
            const container = document.createElement("div");
            container.innerHTML = data;
            const groupContent =
                container.querySelector("#groupContainer").innerHTML;

            document.getElementById("groupContainer").innerHTML = groupContent;

            if (container.querySelector(".group") === null) {
                document.getElementById("groupContainer").innerHTML =
                    "<p>Aucun groupe trouvé.</p>";
            }
        });
}

document.getElementById("searchInput").addEventListener("input", function () {
    clearTimeout(this.timer);
    this.timer = setTimeout(searchGroups, 500);
});
