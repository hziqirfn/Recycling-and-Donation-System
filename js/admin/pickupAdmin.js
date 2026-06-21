const statusFilter = document.getElementById("statusFilter");
const rows = document.querySelectorAll(".management-table tbody tr");

statusFilter.addEventListener("change", function () {

    const selectedStatus = this.value;

    rows.forEach(row => {

        const rowStatus = row.dataset.status;

        if (selectedStatus === "all" || rowStatus === selectedStatus) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }

    });

});

function goTrack(id)
{
    window.location.href = "pickupTrackAdmin.php?id=" + id;
}