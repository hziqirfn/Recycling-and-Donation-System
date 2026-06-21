document.addEventListener("DOMContentLoaded", function () {

    const itemSelect = document.getElementById("itemSelect");
    const statusBadge = document.getElementById("statusBadge");
    const progressFill = document.querySelector(".progress-fill");
    const progressText = document.querySelector(".progress-text");

    itemSelect.addEventListener("change", function () {
        
        let selectedId = this.value;
        let status = "Processing";

        statusBadge.textContent = status;

        if (status === "Pending") 
        {
            progressFill.style.width = "25%";
            progressText.textContent = "25% complete";
        } 
        else if (status === "Collected") 
        {
            progressFill.style.width = "50%";
            progressText.textContent = "50% complete";
        } 
        else if (status === "Processing") 
        {
            progressFill.style.width = "75%";
            progressText.textContent = "75% complete";
        } 
        else if (status === "Completed") 
        {
            progressFill.style.width = "100%";
            progressText.textContent = "100% complete";
        }
    });
});

document.getElementById("itemSelect").addEventListener("change", function () {
    document.getElementById("track-card").style.display = "block";

    let selectedName = this.options[this.selectedIndex].text;
    document.getElementById("itemName").textContent = selectedName;
});