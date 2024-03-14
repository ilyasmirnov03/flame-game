import {getCSRFToken} from "./app.js";
import htmx from "htmx.org";

document.addEventListener("DOMContentLoaded", function () {
    const startButton = document.getElementById("startButton");
    const timeDisplay = document.getElementById("timeDisplay");
    const distanceDisplay = document.getElementById("distanceDisplay");
    const mainSection = document.getElementById("mainSection");
    const group = document.querySelector('input[name="group"]');

    let timer;
    let totalTime = 0;
    let totalDistance = 0;
    let isRaceStarted = false;
    let startedAt;
    let finishedAt;

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
        if (!mainSection.classList.contains("section-filtered ")) {
            mainSection.classList.remove("section-filtered");
        }
        totalTime = 0;
        totalDistance = 0;
        startedAt = new Date().toISOString();

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
        distanceDisplay.textContent = `Distance parcourue : ${ totalDistance.toFixed(1)} m`;
    }

    function stopRace() {
        isRaceStarted = false;
        clearInterval(timer);

        finishedAt = new Date().toISOString();

        if (totalDistance >= 1000) {
            const body = {
                startedAt: startedAt,
                finishedAt: finishedAt,
                game: "running",
            }
            if (group?.value != null) {
                body['group_id'] = group.value;
            }

            htmx.ajax('POST', '/user_score', {
                headers: {
                    'X-CSRF-TOKEN': getCSRFToken(),
                },
                swap: 'innerHTML',
                target: '#scoreResult',
                values: body,
            });
        }
    }
});
