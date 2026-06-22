const itemSelect = document.getElementById("itemSelect");
const trackCard = document.getElementById("track-card");
const selectedItemName = document.getElementById("selectedItemName");
const selectedItemCategory = document.getElementById("selectedItemCategory");
const statusBadge = document.getElementById("statusBadge");
const progressFill = document.getElementById("progressFill");
const progressText = document.getElementById("progressText");

function renderActiveSelection() {
  if (!itemSelect || itemSelect.selectedIndex <= 0) {
    if (trackCard) trackCard.style.display = "none";
    return;
  }

  trackCard.style.display = "block";

  const selectedOption = itemSelect.options[itemSelect.selectedIndex];

  selectedItemName.textContent = selectedOption.text;
  selectedItemCategory.textContent =
    selectedOption.getAttribute("data-category") || "General";

  updateTimelineUI(selectedOption);

  let status = selectedOption.getAttribute("data-status") || "Not Started";
  statusBadge.textContent = status;

  updateActionButtons(status);

  renderProgress(status);

  updateTimelineColors(status);

  function updateTimelineColors(status) {
    const stages = ["pending", "collected", "processing", "completed"];
    const statusOrder = {
      "Not Started": 0,
      Pending: 1,
      Collected: 2,
      Processing: 3,
      Completed: 4,
    };
    const completedCount = statusOrder[status] || 0;

    const dots = document.querySelectorAll(".timeline-dot");
    const timeline = document.querySelector(".timeline");

    // Color the dots
    stages.forEach((stage, index) => {
      const dot = dots[index];
      if (index < completedCount) {
        dot.style.background = "#4caf50";
      } else {
        dot.style.background = "#b0bec5";
      }
    });

    // Color the vertical line (requires the CSS change I mentioned previously)
    if (status !== "Not Started") {
      timeline.classList.add("progress-active");
    } else {
      timeline.classList.remove("progress-active");
    }
  }
}

function renderProgress(status) {
  let percentage = "0%";
  let text = "0% complete";

  // Clean up the status string to ensure matches
  const cleanStatus = status ? status.trim() : "Not Started";

  switch (cleanStatus) {
    case "Not Started":
      percentage = "0%";
      text = "0% complete";
      break;
    case "Pending":
      percentage = "25%";
      text = "25% complete";
      break;
    case "Collected":
      percentage = "50%";
      text = "50% complete";
      break;
    case "Processing":
      percentage = "75%";
      text = "75% complete";
      break;
    case "Completed":
      percentage = "100%";
      text = "100% complete";
      break;
    default:
      percentage = "0%";
      text = "0% complete";
      break;
  }

  progressFill.style.width = percentage;
  progressText.textContent = text;
}

function updateActionButtons(status) {
  document
    .querySelectorAll(".action-toggle-container")
    .forEach((container) => {
      const stage = container.getAttribute("data-stage");
      container.innerHTML = "";

      let isDone = false;
      let nextStatus = "";
      let isDisabled = false;

      if (stage === "pending") {
        isDone = status !== "Not Started";
        nextStatus = "Pending";
      } else if (stage === "collected") {
        isDone = ["Collected", "Processing", "Completed"].includes(status);
        nextStatus = "Collected";
        isDisabled = status !== "Pending";
      } else if (stage === "processing") {
        isDone = ["Processing", "Completed"].includes(status);
        nextStatus = "Processing";
        isDisabled = status !== "Collected";
      } else if (stage === "completed") {
        isDone = status === "Completed";
        nextStatus = "Completed";
        isDisabled = status !== "Processing";
      }

      if (isDone) {
        const badge = document.createElement("span");
        badge.className = "badge-done";
        badge.textContent = "✓ Done";
        container.appendChild(badge);
      } else {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "btn-action";
        btn.textContent = "Mark Done";

        if (isDisabled) {
          btn.disabled = true;
          btn.style.opacity = "0.5";
          btn.style.cursor = "not-allowed";
        } else {
          btn.addEventListener("click", () => {
            changeStepStatus(nextStatus);
          });
        }

        container.appendChild(btn);
      }
    });
}

if (itemSelect) {
  itemSelect.addEventListener("change", renderActiveSelection);

  setTimeout(() => {
    const requestedId = itemSelect.getAttribute("data-selected");

    if (requestedId) {
      for (let i = 0; i < itemSelect.options.length; i++) {
        if (itemSelect.options[i].value === requestedId) {
          itemSelect.selectedIndex = i;
          renderActiveSelection();
          break;
        }
      }
    }
  }, 100);
}

// HELPERS 

function updateTimelineUI(option) {
  const stages = ["pending", "collected", "processing", "completed"];

  stages.forEach((stage) => {
    const dateVal = option.getAttribute(`data-${stage}-date`) || "";
    const descVal = option.getAttribute(`data-${stage}-desc`) || "";

    const dateEl = document.getElementById(`display-${stage}-date`);
    const descEl = document.getElementById(`display-${stage}-desc`);

    if (dateEl && dateVal) {
      dateEl.textContent = "📅 " + formatDateString(dateVal);
    }

    if (descEl && descVal) {
      descEl.textContent = descVal;
    }
  });
}

function formatDateString(dateStr) {
  if (!dateStr || !dateStr.includes("-")) return dateStr;

  return new Date(dateStr).toLocaleDateString("en-GB", {
    year: "numeric",
    month: "2-digit",
    day: "2-digit",
  });
}

function changeStepStatus(nextStatusName) {
  const itemSelect = document.getElementById("itemSelect");

  document.getElementById("targetItemId").value = itemSelect.value;
  document.getElementById("newStatus").value = nextStatusName;

  document.getElementById("timelineForm").submit();
}

function openEditModal(stageName) {
  const itemSelect = document.getElementById("itemSelect");
  const selectedOption = itemSelect.options[itemSelect.selectedIndex];

  const stageKey = stageName.toLowerCase();

  document.getElementById("modalItemId").value = itemSelect.value;
  document.getElementById("modalStageId").value = stageName;

  document.getElementById("modalStageTitle").textContent =
    `${stageName} — Add Tracking Data`;

  document.getElementById("modalStatusDate").value =
    selectedOption.getAttribute(`data-${stageKey}-date`) || "";

  document.getElementById("modalStatusDesc").value =
    selectedOption.getAttribute(`data-${stageKey}-desc`) || "";

  const modal = document.getElementById("editDataPopup");

  modal.style.display = "flex";

  setTimeout(() => {
    modal.classList.add("show-modal");
  }, 10);
}

function closeEditModal() {
  const modal = document.getElementById("editDataPopup");

  modal.classList.remove("show-modal");

  setTimeout(() => {
    modal.style.display = "none";
  }, 250);
}
