document.addEventListener("DOMContentLoaded", function () {
    let timeoutId;
    const searchInput = document.getElementById("searchInput");
    const searchForm = document.getElementById("searchForm");

    searchInput.addEventListener("input", function () {
        clearTimeout(timeoutId);

        timeoutId = setTimeout(function () {
            searchForm.submit();
        }, 500);
    });
});
