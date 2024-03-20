const svgReady = () => {
    const svgObject = document.querySelector(".univ__bg--img").contentDocument;
    const marker = svgObject.getElementById("repere");
    const children = Array.from(marker.children);
    children.shift();
    children.pop();
    const totalScore = parseInt(
        document.querySelector(".univ__bg").getAttribute("data-total-score")
    );
    const minScore = parseInt(
        document.querySelector(".univ__bg").getAttribute("data-min-score")
    );
    const userScore = parseInt(
        document.querySelector(".univ__bg").getAttribute("data-score")
    );

    const scoreInterval = (totalScore - minScore) / children.length;

    let closestChildIndex = 0;
    let closestScore = minScore;

    for (let i = 0; i < children.length; i++) {
        const score = minScore + scoreInterval * i;
        if (score <= userScore) {
            closestChildIndex = i;
            closestScore = score;
        } else {
            break;
        }
    }

    const closestChild = children[closestChildIndex];
    const cx = closestChild.getAttribute("cx");
    const cy = closestChild.getAttribute("cy");

    const svgNS = "http://www.w3.org/2000/svg";

    const text = document.createElementNS(svgNS, "text");
    text.setAttribute("x", cx);
    text.setAttribute("y", cy);
    text.setAttribute("text-anchor", "middle");
    text.setAttribute("fill", "#f1f1f1");
    text.setAttribute("font-family", '"Baloo", sans-serif');
    text.setAttribute("font-size", "8rem");
    text.textContent = userScore;

    const markerPlace = svgObject.getElementById("route");
    markerPlace.appendChild(text);
};

document.addEventListener("DOMContentLoaded", svgReady);
