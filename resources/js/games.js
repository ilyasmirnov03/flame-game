document.addEventListener("DOMContentLoaded", function () {
    const infoButtons = document.querySelectorAll(".games__info");

    infoButtons.forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const gameId = this.dataset.gameId;
            getGameDescription(gameId);
        });
    });

    function getGameDescription(gameId) {
        fetch(`/flame/games/${gameId}/description`)
            .then((response) => response.json())
            .then((data) => {
                const description = data.description;
                const modal = document.getElementById("gameModal");
                const descriptionElement =
                    document.getElementById("gameDescription");
                descriptionElement.textContent = description;
                modal.classList.remove("hidden");
            })
            .catch((error) => {
                console.error(
                    "Une erreur s'est produite lors de la récupération de la description du jeu :",
                    error
                );
            });
    }
    const closeModal = document.querySelector(".close");
    closeModal.addEventListener("click", function () {
        const modal = document.getElementById("gameModal");
        modal.classList.add("hidden");
    });

    window.addEventListener("click", function (event) {
        const modal = document.getElementById("gameModal");
        if (event.target == modal) {
            modal.classList.add("hidden");
        }
    });
});
