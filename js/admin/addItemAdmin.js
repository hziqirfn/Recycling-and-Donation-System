const tabButtons = document.querySelectorAll(".tab-btn");
const tableRows = document.querySelectorAll(".management-table tbody tr");

tabButtons.forEach(function(button) {
    button.addEventListener("click", function() {
        const filter = button.getAttribute("data-filter");

        tabButtons.forEach(function(btn) {
            btn.classList.remove("active");
        });

        button.classList.add("active");

        tableRows.forEach(function(row) {
            const status = row.getAttribute("data-status");

            if (filter === "all" || status === filter) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
});

const searchInput = document.getElementById("searchInput");
const rows = document.querySelectorAll(".management-table tbody tr");

searchInput.addEventListener("keyup", function () {

    const keyword = searchInput.value.toLowerCase();

    rows.forEach(function(row) {

        const itemName = row.cells[1].textContent.toLowerCase();
        const submittedBy = row.cells[2].textContent.toLowerCase();
        const category = row.cells[3].textContent.toLowerCase();

        if (
            itemName.includes(keyword) ||
            submittedBy.includes(keyword) ||
            category.includes(keyword)
        ) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }

    });

});