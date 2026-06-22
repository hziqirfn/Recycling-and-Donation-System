document.addEventListener("DOMContentLoaded", function () {
    const itemSelect = document.getElementById("itemSelect");
    const trackCard = document.getElementById("track-card");
    const itemName = document.getElementById("itemName");
    const statusBadge = document.getElementById("statusBadge");
    const progressFill = document.querySelector(".progress-fill");
    const progressText = document.querySelector(".progress-text");

    const pendingDate = document.getElementById("pendingDate");
    const pendingDesc = document.getElementById("pendingDesc");
    const collectedDate = document.getElementById("collectedDate");
    const collectedDesc = document.getElementById("collectedDesc");
    const processingDate = document.getElementById("processingDate");
    const processingDesc = document.getElementById("processingDesc");
    const completedDate = document.getElementById("completedDate");
    const completedDesc = document.getElementById("completedDesc");

    const dots = document.querySelectorAll(".timeline-dot");

    trackCard.style.display = "none";

    itemSelect.addEventListener("change", function () {
        const selectedOption = this.options[this.selectedIndex];

        const selectedName = selectedOption.text.trim();
        const status = selectedOption.dataset.status || "Not Started";

        itemName.textContent = selectedName;
        statusBadge.textContent = status;

        statusBadge.className = "status-badge";
        statusBadge.classList.add(status.toLowerCase().replaceAll(" ", "-"));

        pendingDate.textContent = selectedOption.dataset.pendingDate || "Pending";
        pendingDesc.textContent = selectedOption.dataset.pendingDesc || "Your item has been added to the system";

        collectedDate.textContent = selectedOption.dataset.collectedDate || "Pending";
        collectedDesc.textContent = selectedOption.dataset.collectedDesc || "Item has been collected from your location";

        processingDate.textContent = selectedOption.dataset.processingDate || "Pending";
        processingDesc.textContent = selectedOption.dataset.processingDesc || "Item is being processed at our facility";

        completedDate.textContent = selectedOption.dataset.completedDate || "Pending";
        completedDesc.textContent = selectedOption.dataset.completedDesc || "Process has finished successfully";

        dots.forEach(function (dot) {
            dot.classList.remove("completed", "active");
        });

        if (status === "Not Started") {
            progressFill.style.width = "0%";
            progressText.textContent = "0% complete";
        }
        else if (status === "Pending") {
            progressFill.style.width = "25%";
            progressText.textContent = "25% complete";
            dots[0].classList.add("active");
        }
        else if (status === "Collected") {
            progressFill.style.width = "50%";
            progressText.textContent = "50% complete";
            dots[0].classList.add("completed");
            dots[1].classList.add("active");
        }
        else if (status === "Processing") {
            progressFill.style.width = "75%";
            progressText.textContent = "75% complete";
            dots[0].classList.add("completed");
            dots[1].classList.add("completed");
            dots[2].classList.add("active");
        }
        else if (status === "Completed") {
            progressFill.style.width = "100%";
            progressText.textContent = "100% complete";
            dots[0].classList.add("completed");
            dots[1].classList.add("completed");
            dots[2].classList.add("completed");
            dots[3].classList.add("active");
        }

        trackCard.style.display = "block";
    });
});