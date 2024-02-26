document.addEventListener("DOMContentLoaded", function () {
    const startButton = document.getElementById("startButton");
    const timeDisplay = document.getElementById("timeDisplay");
    const distanceDisplay = document.getElementById("distanceDisplay");
    const resultValue = document.getElementById("resultValue");
    const popup = document.getElementById("popup");
    const popupMessage = document.getElementById("popupMessage");
    const popupResult = document.getElementById("popupResult");
    const mainSection = document.getElementById("mainSection");
    const bonusPoint = document.getElementById("bonusPoint");

    let timer;
    let totalTime = 0;
    let totalDistance = 0;
    let isRaceStarted = false;
    let startedAt;
    let finishedAt;
    let popupVisible = false;

    function getCSRFToken() {
        return $('meta[name="csrf-token"]').attr("content");
    }

    startButton.addEventListener("click", function () {
        if (!isRaceStarted) {
            startRace();
            startButton.textContent = "Arrêter";
        } else {
            stopRace();
            startButton.textContent = "Commencer";
        }
    });

    function startRace() {
        if (!popup.classList.contains("hidden")) {
            popup.classList.add("hidden");
        }
        if (!mainSection.classList.contains("section-filtered ")) {
            mainSection.classList.remove("section-filtered");
        }
        totalTime = 0;
        totalDistance = 0;
        startedAt = new Date().toISOString();
        resultValue.textContent = "-";

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function () {
                isRaceStarted = true;

                timer = setInterval(function () {
                    totalTime += 1;
                    updateTimerDisplay();
                }, 1000);

                let lastPosition;

                function updatePosition() {
                    navigator.geolocation.getCurrentPosition(function (
                        position
                    ) {
                        if (isRaceStarted) {
                            if (lastPosition) {
                                const distanceDelta = calculateDistance(
                                    lastPosition.coords.latitude,
                                    lastPosition.coords.longitude,
                                    position.coords.latitude,
                                    position.coords.longitude
                                );
                                totalDistance += distanceDelta;
                                updateDistanceDisplay();
                                if (totalDistance >= 1000) {
                                    stopRace();
                                }
                            }
                            lastPosition = position;
                        }
                    },
                    handleGeolocationError);
                }
                setInterval(updatePosition, 5000);
            }, handleGeolocationError);
        } else {
            alert(
                "La géolocalisation n'est pas prise en charge par votre navigateur."
            );
            stopRace();
        }
    }

    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371e3;
        const phi1 = (lat1 * Math.PI) / 180;
        const phi2 = (lat2 * Math.PI) / 180;
        const deltaPhi = ((lat2 - lat1) * Math.PI) / 180;
        const deltaLambda = ((lon2 - lon1) * Math.PI) / 180;

        const a =
            Math.sin(deltaPhi / 2) * Math.sin(deltaPhi / 2) +
            Math.cos(phi1) *
                Math.cos(phi2) *
                Math.sin(deltaLambda / 2) *
                Math.sin(deltaLambda / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        return R * c;
    }

    function handleGeolocationError(error) {
        console.error(`Erreur de géolocalisation : ${error.message}`);
        alert(
            "Erreur de géolocalisation. Assurez-vous d'activer la géolocalisation."
        );
        stopRace();
    }

    function updateTimerDisplay() {
        const minutes = Math.floor(totalTime / 60);
        const seconds = totalTime % 60;
        timeDisplay.textContent = `${minutes}:${
            seconds < 10 ? "0" : ""
        }${seconds}`;
    }

    function updateDistanceDisplay() {
        let distanceToShow;
        const distanceInKilometers = totalDistance / 1000;
        distanceToShow = distanceInKilometers.toFixed(1);
        distanceDisplay.textContent = `Distance parcourue : ${distanceToShow} KM`;
    }

    function stopRace() {
        isRaceStarted = false;
        clearInterval(timer);

        finishedAt = new Date().toISOString();

        if (totalDistance >= 1000) {
            $.ajax({
                url: "/run_result",
                method: "POST",
                data: {
                    startedAt: startedAt,
                    finishedAt: finishedAt,
                    game: "running",
                },
                headers: {
                    "X-CSRF-TOKEN": getCSRFToken(),
                },
                success: function (response) {
                    console.log(response);

                    popup.style.borderColor = "green";
                    popupMessage.textContent = "Course réussie!";
                    popupResult.classList.remove("hidden");
                    resultValue.textContent =
                        response.scoreWithoutBonus + " points";
                    if (response.scoreWithBonus !== 0) {
                        bonusPoint.textContent = ` + ${
                            response.scoreWithBonus - response.scoreWithoutBonus
                        }`;
                        bonusPoint.classList.add = "bonus__point";
                    } else {
                        bonusPoint.classList.add = "withoutbonus__point";
                    }
                    popup.classList.remove("hidden");

                    mainSection.classList.add("section-filtered");

                    popupVisible = true;
                },
                error: function (error) {
                    console.error(error);

                    popup.style.borderColor = "red";
                    popupMessage.textContent =
                        "Une erreur est survenue! Nous sommes désolé...";
                    popupResult.classList.add("hidden");
                    popup.classList.remove("hidden");

                    mainSection.classList.add("section-filtered");

                    popupVisible = true;
                },
            });
        } else {
            popup.style.borderColor = "red";
            popupMessage.textContent = "Aucun point (distance insuffisante)";
            popupResult.classList.add("hidden");
            popup.classList.remove("hidden");

            mainSection.classList.add("section-filtered");

            popupVisible = true;
        }

        setTimeout(function () {
            mainSection.addEventListener("click", function (event) {
                if (popupVisible && !popup.contains(event.target)) {
                    closePopup();
                }
            });
        }, 2000);
    }

    function closePopup() {
        popup.classList.add("hidden");

        mainSection.classList.remove("section-filtered");

        popupVisible = false;
    }
});
