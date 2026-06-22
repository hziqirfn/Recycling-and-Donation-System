document.getElementById("content").addEventListener("click", () => {
    document.getElementById("cb").checked = false;
})

function toggleActivity() {
    const hiddenItems = document.querySelectorAll(".hiddenActivity");
    const btn = document.getElementById("activityBtn");

    if (btn.textContent === "View All") {
        hiddenItems.forEach(item => {
            item.style.display = "list-item";
        });
        btn.textContent = "Hide";
    } else {
        hiddenItems.forEach(item => {
            item.style.display = "none";
        });
        btn.textContent = "View All";
    }
}

function toggleContributor() {
    const hiddenItems = document.querySelectorAll(".hiddenContributor");
    const btn = document.getElementById("contributorBtn");

    if (btn.textContent === "View All") {
        hiddenItems.forEach(item => {
            item.style.display = "list-item";
        });
        btn.textContent = "Hide";
    } else {
        hiddenItems.forEach(item => {
            item.style.display = "none";
        });
        btn.textContent = "View All";
    }
}
