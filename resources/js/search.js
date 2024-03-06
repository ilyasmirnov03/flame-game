function searchGroups() {
    const searchTerm = document.getElementById("searchInput").value;
    const groupSearchRoute = document.head.querySelector(
        'meta[name="groupSearchRoute"]'
    ).content;

    fetch(groupSearchRoute + "?search=" + searchTerm)
        .then((response) => response.text())
        .then((data) => {
            document.open();
            document.write(data);
            document.close();

            document
                .getElementById("searchInput")
                .addEventListener("input", function () {
                    clearTimeout(this.timer);
                    this.timer = setTimeout(searchGroups, 500);
                });
        });
}

document.getElementById("searchInput").addEventListener("input", function () {
    clearTimeout(this.timer);
    this.timer = setTimeout(searchGroups, 500);
});
