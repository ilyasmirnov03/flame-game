const funfactPopup = document.getElementById("funFactPopup");
const closePopup = document.querySelector(".close");
const funfactBtn = document.querySelector(".open-fun-fact-popup");
const homePageLi = document.querySelector(".navbar li:nth-child(3)");
const navItems = document.querySelectorAll(".navbar li");

let previousActivePage = null;

const currentDate = new Date();
const lastSeenDate = localStorage.getItem("funfact_last_seen_date");

if (
    !lastSeenDate ||
    new Date(lastSeenDate).getDate() !== currentDate.getDate()
) {
    funfactPopup.style.display = "flex";
    navItems.forEach((item) => {
        item.classList.remove("active");
    });
    funfactBtn.classList.add("active");

    localStorage.setItem("funfact_last_seen_date", currentDate.toISOString());
} else {
    localStorage.setItem("funfact_seen_today", "true");
}

funfactBtn.addEventListener("click", function () {
    previousActivePage = document.querySelector(".navbar li.active");

    funfactPopup.style.display = "flex";
    navItems.forEach((item) => {
        item.classList.remove("active");
    });
    funfactBtn.classList.add("active");
});

closePopup.addEventListener("click", function () {
    funfactPopup.style.display = "none";
    funfactBtn.classList.remove("active");

    const seenToday = localStorage.getItem("funfact_seen_today");

    if (seenToday) {
        if (previousActivePage) {
            previousActivePage.classList.add("active");
        }
    } else {
        homePageLi.classList.add("active");
    }
});
