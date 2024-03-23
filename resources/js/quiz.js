import {getCSRFToken} from "./app.js";
import htmx from 'htmx.org';

/**
 * Started at ISO string date.
 * @type {string}
 */
let startedAt;

/**
 * Finished at ISO string date.
 * @type {string}
 */
let finishedAt;

/**
 * Current answer
 * @type {{answerId: string, quizId: string} | null}
 */
let currentAnswer = null;

/**
 * Current quiz index
 */
let currentQuizIndex = 0;

/**
 * Answers map
 * @type {Map<string, string>}
 */
const answers = new Map();

const $quizQuestions = document.querySelectorAll('article[data-quiz-id]');
const $quizAnswers = document.querySelectorAll('input[name="answer"]');
const $confirmButton = document.querySelector('button.confirm');

/**
 * Initialize handlers.
 */
function init() {
    document.querySelector('.begin').addEventListener('click', startGame);
    $confirmButton.addEventListener('click', nextQuestion);
    for (const answer of $quizAnswers) {
        answer.addEventListener('change', selectAnswer);
    }
}

/**
 * Start the game sequence.
 * @param e{Event}
 */
function startGame(e) {
    e.target.remove();
    startedAt = new Date().toISOString();
    $quizQuestions[0].classList.remove('hidden');
    $confirmButton.classList.remove('hidden');
}

/**
 * Select answer on button click.
 * @param e{Event}
 */
function selectAnswer(e) {
    const answerId = e.target.value;
    const quizId = e.target.closest('article').dataset['quizId'];
    if (typeof answerId === 'undefined' || typeof quizId === 'undefined') {
        console.error('quizId or answerId is undefined.');
    }
    currentAnswer = {
        answerId,
        quizId
    }
    $confirmButton.removeAttribute('disabled');
}

/**
 * Change to quiz of specified index
 * @param index{number}
 */
function selectQuizByIndex(index) {
    $quizQuestions[currentQuizIndex].classList.add('hidden');
    // If last quiz
    if (index > $quizQuestions.length - 1) {
        return;
    }
    currentQuizIndex = index;
    $quizQuestions[index].classList.remove('hidden');
}

/**
 * Go to next question.
 * @param e{Event}
 */
function nextQuestion(e) {
    const answer = answers.get(currentAnswer.quizId);
    if (typeof answer !== 'undefined') {
        answers.set(currentAnswer.quizId, currentAnswer.answerId);
        return;
    }
    answers.set(currentAnswer.quizId, currentAnswer.answerId);
    e.target.setAttribute('disabled', 'true');
    if ($quizQuestions.length === answers.size) {
        finishGame(answers);
    }
    selectQuizByIndex(currentQuizIndex + 1);
}

/**
 * Finish the game by saving user's score.
 * @param answers{Map<string, string>}
 */
function finishGame(answers) {
    finishedAt = new Date().toISOString();
    const body = {
        startedAt,
        finishedAt,
        game: 'quiz',
        answers: Object.fromEntries(answers),
    }

    const group = document.querySelector('input[name="group"]');
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
    }).then(() => {
        $confirmButton.remove();
    });
}

window.addEventListener('DOMContentLoaded', init);
