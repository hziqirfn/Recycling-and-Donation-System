document.getElementById("content").addEventListener("click", () => {
    document.getElementById("cb").checked = false;
})

let activityOpen = false;
let contributorOpen = false;

function toggleActivity(){

    const items = document.querySelectorAll(".hiddenActivity");
    const button = document.querySelector("#activityList")
                    .previousElementSibling
                    .querySelector("button");

    activityOpen = !activityOpen;

    items.forEach(item=>{
        item.style.display = activityOpen ? "list-item" : "none";
    });

    button.textContent = activityOpen ? "Hide" : "View All";
}

function toggleContributor(){

    const items = document.querySelectorAll(".hiddenContributor");
    const button = document.querySelector("#contributorList")
                    .previousElementSibling
                    .querySelector("button");

    contributorOpen = !contributorOpen;

    items.forEach(item=>{
        item.style.display = contributorOpen ? "list-item" : "none";
    });

    button.textContent = contributorOpen ? "Hide" : "View All";
}