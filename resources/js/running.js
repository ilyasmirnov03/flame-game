document.addEventListener("DOMContentLoaded", function () {
    const startButton = document.getElementById("startButton");
    const timeDisplay = document.getElementById("timeDisplay");
    const distanceDisplay = document.getElementById("distanceDisplay");
    const resultValue = document.getElementById("resultValue");
    const resultMessage = document.getElementById("result");

    let timer;
    let totalTime = 0;
    let totalDistance = 0;
    let isRaceStarted = false;

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
        totalTime = 0;
        totalDistance = 0;
        resultValue.textContent = "-";
        resultMessage.style.display = "none";

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                isRaceStarted = true;

                timer = setInterval(function () {
                    totalTime += 1;
                    updateTimerDisplay();
                }, 1000);

                const startLatitude = position.coords.latitude;
                const startLongitude = position.coords.longitude;

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
        const φ1 = (lat1 * Math.PI) / 180;
        const φ2 = (lat2 * Math.PI) / 180;
        const Δφ = ((lat2 - lat1) * Math.PI) / 180;
        const Δλ = ((lon2 - lon1) * Math.PI) / 180;

        const a =
            Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
            Math.cos(φ1) * Math.cos(φ2) * Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
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
        resultMessage.style.display = "block";

        if (totalDistance >= 1000 && totalTime <= 131) {
            const points = calculatePoints(totalTime);
            resultValue.textContent = points;
        } else {
            resultValue.textContent = "Aucun point (distance insuffisantes)";
        }
    }

    function calculatePoints(time) {
        return Math.max(0, 100 - time);
    }
});
