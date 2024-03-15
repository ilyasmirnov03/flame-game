import {getCSRFToken} from "./app.js";
import htmx from "htmx.org";

document.addEventListener("DOMContentLoaded", function () {
    const startButton = document.getElementById("startButton");
    const timeDisplay = document.getElementById("timeDisplay");
    const distanceDisplay = document.getElementById("distanceDisplay");
    const group = document.querySelector('input[name="group"]');

    let timer;
    let watchPositionTimer;
    let totalTime = 0;
    let totalDistance = 0;
    let isRaceStarted = false;
    let startedAt;
    let finishedAt;
    let lastPosition;

    startButton.addEventListener("click", function () {
        if (!isRaceStarted) {
            startRace();
            startButton.textContent = "Arrêter";
        } else {
            stopRace();
            startButton.textContent = "Commencer";
        }
    });

    /**
     * Update ran distance
     * @param position{GeolocationPosition}
     */
    function updateDistance(position) {
        if (typeof lastPosition !== "undefined") {
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

    function startRace() {
        if (!navigator.geolocation) {
            alert("La géolocalisation n'est pas prise en charge par votre navigateur.");
            stopRace();
            return;
        }

        isRaceStarted = true;

        startedAt = new Date().toISOString();
        watchPositionTimer = navigator.geolocation.watchPosition(updateDistance, handleGeolocationError);
        timer = setInterval(updateTimerDisplay, 1000);
    }

    /**
     * Calculate distance from two coordinates and return in meters.
     * @param lat1{number} Last position latitude
     * @param lon1{number} Last position longitude
     * @param lat2{number} New position latitude
     * @param lon2{number} New position longitude
     * @returns {number}
     */
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

    /**
     * watchPosition error callback.
     * @param error{GeolocationPositionError}
     */
    function handleGeolocationError(error) {
        console.error(`Erreur de géolocalisation : ${error.message}`);
        alert(
            "Erreur de géolocalisation. Assurez-vous d'activer la géolocalisation."
        );
        stopRace();
    }

    function updateTimerDisplay() {
        totalTime++;
        const minutes = Math.floor(totalTime / 60);
        const seconds = totalTime % 60;
        timeDisplay.textContent = `${minutes}:${
            seconds < 10 ? "0" : ""
        }${seconds}`;
    }

    function updateDistanceDisplay() {
        distanceDisplay.textContent = `Distance parcourue : ${totalDistance.toFixed(1)} m`;
    }

    function stopRace() {
        clearInterval(timer);
        finishedAt = new Date().toISOString();
        isRaceStarted = false;

        if (navigator.geolocation) {
            navigator.geolocation.clearWatch(watchPositionTimer);
        }

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
