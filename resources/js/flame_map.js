document.addEventListener("DOMContentLoaded", function () {
    const container = document.querySelector(".univ__bg");
    const score = parseInt(container.getAttribute("data-score"));
    positionElements(score);
});

function positionElements(score) {
    const logo = document.querySelector(".univ__bg--logo");
    const scoreElement = document.getElementById("score");

    let pointX, pointY;
    if (score >= 0 && score <= 333) {
        pointX = 6;
        pointY = 26.5;
        scoreElement.style.left = pointX - 1.2 + "rem";
        scoreElement.style.top = pointY - 8 + "rem";
        const style = document.createElement("style");
        style.innerHTML = `
            #score::before {
                content: "";
                position: absolute;
                top: 70px;
                bottom: -25px;
                left: 40%;
                margin-left: -10px;
                border-width: 25px 20px 0px;
                border-style: solid;
                border-color: #d23c49dd transparent transparent transparent;
            }
        `;
        document.head.appendChild(style);
    } else if (score >= 334 && score <= 666) {
        pointX = 12.5;
        pointY = 15;
        scoreElement.style.left = pointX - 1.2 + "rem";
        scoreElement.style.top = pointY + 5.6 + "rem";
    } else if (score >= 667 && score <= 999) {
        pointX = 5;
        pointY = 4;
        scoreElement.style.left = pointX - 1.2 + "rem";
        scoreElement.style.top = pointY + 5.6 + "rem";
    }

    if (pointX !== undefined && pointY !== undefined) {
        logo.style.left = pointX + "rem";
        logo.style.top = pointY + "rem";
    }
}
