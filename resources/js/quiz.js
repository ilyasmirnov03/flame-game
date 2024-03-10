import {getCSRFToken} from "./app.js";

const answers = [];
let startedAt = null;
let finishedAt = null;

function init() {
    document.querySelector('.begin').addEventListener('click', startGame);
}

function startGame() {
    startedAt = new Date().toISOString();
}

/**
 * Go to next question.
 */
function nextQuestion() {

}

/**
 * Stops the game no matter the quiz progress.
 */
function stopGame() {

}

/**
 * Finish the game by saving user's score.
 */
function finishGame() {
    finishedAt = new Date().toISOString();
    const body = {
        startedAt,
        finishedAt,
        game: 'quiz',
    }
    fetch('/user_score', {
        method: 'post',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCSRFToken(),
        },
        body: JSON.stringify(body),
    })
        .then(res => res.json())
        .then(data => {

        });
}

window.addEventListener('DOMContentLoaded', init);