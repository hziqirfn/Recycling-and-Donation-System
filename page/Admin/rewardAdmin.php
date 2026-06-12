<?php
$admin = true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rewards Control</title>

    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/admin/headerAdmin.css">
    <link rel="stylesheet" href="../../style/admin/sidebarAdmin.css">
    <link rel="stylesheet" href="../../style/admin/rewardAdmin.css">
</head>

<body class="rewards-page">

<?php include("headerAdmin.php"); ?>
<?php include("sidebarAdmin.php"); ?>

<label for="cb" id="overlay"></label>

<div class="dashboard-container">

   <div class="dashboard-header">

    <h1>Rewards Control</h1>

    <p>Manage reward items and point redemption.</p>

    <div class="header-actions">

        <button class="add-btn"
                onclick="openAddModal()">
            + Add Reward
        </button>

        <select id="statusFilter"
                onchange="filterRewards()">

            <option value="all">All Rewards</option>

            <option value="active">Active</option>

            <option value="inactive">Inactive</option>

        </select>

    </div>

</div>

    <div class="reward-grid">

        <div class="reward-card active">

            <div class="card-top">
                <span class="reward-icon">🎁</span>
                <span class="badge badge-active">Active</span>
            </div>

            <h3>RM5 Touch n Go</h3>

            <h2>100 pts</h2>

            <p>Stock: 50</p>
            <p>Redeemed: 128</p>

            <div class="card-actions">

                 <button class="edit-btn"
                         onclick="openEditModal('RM5 Touch n Go','100')">
                     Edit
                 </button>

                 <button class="delete-btn"
                         onclick="deleteReward('RM5 Touch n Go')">
                     Delete
                 </button>

            </div>

        </div>

        <div class="reward-card active">

            <div class="card-top">
                <span class="reward-icon">🎁</span>
                <span class="badge badge-active">Active</span>
            </div>

            <h3>RM10 Touch n Go</h3>

            <h2>200 pts</h2>

            <p>Stock: 30</p>
            <p>Redeemed: 89</p>

            <div class="card-actions">

                 <button class="edit-btn"
                         onclick="openEditModal('RM10 Touch n Go','200')">
                     Edit
                 </button>

                 <button class="delete-btn"
                         onclick="deleteReward('RM10 Touch n Go')">
                     Delete
                 </button>

            </div>

        </div>

        <div class="reward-card active">

            <div class="card-top">
                <span class="reward-icon">🎁</span>
                <span class="badge badge-active">Active</span>
            </div>

            <h3>UTeM Merchandise</h3>

            <h2>350 pts</h2>

            <p>Stock: 15</p>
            <p>Redeemed: 42</p>

            <div class="card-actions">

                 <button class="edit-btn"
                         onclick="openEditModal('UTeM Merchandise','350')">
                     Edit
                 </button>

                 <button class="delete-btn"
                         onclick="deleteReward('UTeM Merchandise')">
                     Delete
                 </button>

            </div>

        </div>

        <div class="reward-card inactive">

            <div class="card-top">
                <span class="reward-icon">🎁</span>
                <span class="badge badge-inactive">Inactive</span>
            </div>

            <h3>Canteen Voucher RM3</h3>

            <h2>60 pts</h2>

            <p>Stock: 0</p>
            <p>Redeemed: 201</p>

            <div class="card-actions">

                 <button class="edit-btn"
                         onclick="openEditModal('Canteen Voucher RM3','60')">
                     Edit
                 </button>

                 <button class="delete-btn"
                         onclick="deleteReward('Canteen Voucher RM3')">
                     Delete
                 </button>

            </div>
        </div>

    </div>

    <div class="points-card">

        <div class="points-header">

        <h2>
            Points Configuration
        </h2>

        <button class="edit-btn"
                onclick="openPointModal()">

            Update Points

        </button>

        </div>

    </div>

        <div class="points-grid">

            <div class="point-item">
                <span>Paper (per kg)</span>
                <strong>10 pts</strong>
            </div>

            <div class="point-item">
                <span>Plastic (per kg)</span>
                <strong>15 pts</strong>
            </div>

            <div class="point-item">
                <span>Electronics (per unit)</span>
                <strong>50 pts</strong>
            </div>

            <div class="point-item">
                <span>Glass (per kg)</span>
                <strong>8 pts</strong>
            </div>

        </div>

    </div>

</div>

<div id="rewardModal"
     class="modal">

    <div class="modal-content">

        <h2 id="modalTitle">
            Add Reward
        </h2>

        <input type="text"
               id="rewardName"
               placeholder="Reward Name">

        <input type="number"
               id="rewardPoint"
               placeholder="Points">

        <button onclick="saveReward()">

            Save

        </button>

        <button onclick="closeModal()">

            Cancel

        </button>

    </div>

</div>


<div id="pointModal"
     class="modal">

    <div class="modal-content">

        <h2>
            Update Point Configuration
        </h2>

        <input type="number"
               placeholder="Paper Points">

        <input type="number"
               placeholder="Plastic Points">

        <input type="number"
               placeholder="Glass Points">

        <button onclick="closePointModal()">

            Save

        </button>

    </div>

</div>

<script>

function openAddModal(){

    document.getElementById("modalTitle")
    .innerHTML = "Add Reward";

    document.getElementById("rewardModal")
    .style.display = "flex";
}

function openEditModal(name, points){

    document.getElementById("modalTitle")
    .innerHTML = "Edit Reward";

    document.getElementById("rewardName")
    .value = name;

    document.getElementById("rewardPoint")
    .value = points;

    document.getElementById("rewardModal")
    .style.display = "flex";
}

function closeModal(){

    document.getElementById("rewardModal")
    .style.display = "none";
}

function saveReward(){

    alert("Reward Saved Successfully");

    closeModal();
}

function deleteReward(name){

    if(confirm("Delete " + name + " ?")){

        alert("Reward Deleted");
    }
}

function openPointModal(){

    document.getElementById("pointModal")
    .style.display = "flex";
}

function closePointModal(){

    document.getElementById("pointModal")
    .style.display = "none";
}

function filterRewards(){

    let filter =
    document.getElementById(
    "statusFilter").value;

    let cards =
    document.querySelectorAll(
    ".reward-card");

    cards.forEach(card => {

        if(filter === "all"){

            card.style.display =
            "block";
        }

        else if(
        card.classList.contains(filter)){

            card.style.display =
            "block";
        }

        else{

            card.style.display =
            "none";
        }

    });

}

</script>

</body>
</html>