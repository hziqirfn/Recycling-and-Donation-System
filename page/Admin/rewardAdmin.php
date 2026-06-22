<?php

session_start();

$admin = true;

include("../../inc/connect.php");
include("../../inc/auth.php");

$queryReward = "

SELECT *
FROM reward_catalog
ORDER BY RewardId ASC

";

$resultReward = mysqli_query($conn,$queryReward);

if(!$resultReward){
    die(mysqli_error($conn));
}

$totalReward = mysqli_num_rows($resultReward);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTeM RecycleHub</title>

    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/admin/headerAdmin.css">
    <link rel="stylesheet" href="../../style/admin/sidebarAdmin.css">
    <link rel="stylesheet" href="../../style/admin/rewardAdmin.css">
</head>

<body class="rewards-page">

<?php 

include("headerAdmin.php");
include("sidebarAdmin.php"); 

?>

<label for="cb" id="overlay"></label>

<div class="dashboard-container">

    <div class="dashboard-header">
       <h2>Reward Management</h2>
       <p>Manage reward items and point redemption.</p>
    </div>

    <div class="header-actions">

       <button class="add-btn"
               onclick="openAddModal()">

           + Add Reward

       </button>

       <select id="statusFilter"
               onchange="filterRewards()">

           <option value="all">
               All Rewards
           </option>

           <option value="active">
               Active
           </option>

           <option value="inactive">
               Inactive
           </option>

       </select>

    </div>

    <div class="total-text">
        <strong><?= $totalReward; ?></strong> total rewards
    </div>

    <div class="reward-grid">
        <?php
        while($row = mysqli_fetch_assoc($resultReward))
        {
        ?>

        <div class="reward-card <?= strtolower($row['Status']); ?>">

            <div class="card-top">

                <span class="reward-icon">
                    🎁
                </span>

                <span class="badge <?= ($row['Status']=="Active") ? "badge-active" : "badge-inactive"; ?>">

                   <?= $row['Status']; ?>

                </span>

            </div>

            <h3>
                <?= $row['RewardName']; ?>
            </h3>

            <h2>
                <?= $row['PointsRequired']; ?> pts
            </h2>

            <p>
                Stock: <?= $row['Stock']; ?>
            </p>

            <div class="card-actions">

                <button class="edit-btn"

                    onclick="openEditModal(
                    '<?= $row['RewardId']; ?>',
                    '<?= $row['RewardName']; ?>',
                    '<?= $row['PointsRequired']; ?>',
                    '<?= $row['Stock']; ?>',
                    '<?= $row['Status']; ?>'
                    )">

                    Edit

                </button>

                <a class="delete-btn"
                   href="deleteReward.php?id=<?= $row['RewardId']; ?>"
                   onclick="return confirm('Delete this reward?')">

                       Delete

                </a>

            </div>

        </div>

        <?php
        }
        ?>

    </div>

    <div class="points-card">

        <div class="points-header">
            <h2>Points Configuration</h2>

            <button class="edit-btn" onclick="openPointModal()">
                Update Points
            </button>
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


<div id="pointModal" class="modal">

    <div class="modal-content">
        <h2>Update Point Configuration</h2>

        <input type="number" placeholder="Paper Points">

        <input type="number" placeholder="Plastic Points">

        <input type="number" placeholder="Glass Points">

        <button type="button"
                onclick="closePointModal()">
            Save
        </button>

        <button type="button"
                onclick="closePointModal()">
            Cancel
        </button>

    </div>
</div>

<script>

function openAddModal(){

    document.getElementById("addModal")
    .style.display = "flex";
}

function closeAddModal(){

    document.getElementById("addModal")
    .style.display = "none";
}

function openEditModal(
id,
name,
points,
stock,
status
){

    document.getElementById("editRewardId").value = id;

    document.getElementById("editRewardName").value = name;

    document.getElementById("editPoints").value = points;

    document.getElementById("editStock").value = stock;

    document.getElementById("editStatus").value = status;

    document.getElementById("editModal")
    .style.display = "flex";
}

function closeEditModal(){

    document.getElementById("editModal")
    .style.display = "none";
}

function filterRewards(){

    let filter =
    document.getElementById("statusFilter").value;

    let cards =
    document.querySelectorAll(".reward-card");

    cards.forEach(card => {

        if(filter == "all"){

            card.style.display = "block";
        }

        else if(card.classList.contains(filter)){

            card.style.display = "block";
        }

        else{

            card.style.display = "none";
        }

    });

}

function openPointModal(){

    document.getElementById("pointModal")
    .style.display = "flex";
}

function closePointModal(){

    document.getElementById("pointModal")
    .style.display = "none";
}

</script>

<div id="addModal" class="modal">

    <div class="modal-content">

        <h2>Add Reward</h2>

        <form action="addReward.php"
              method="POST">

            <input type="text"
                   name="rewardId"
                   placeholder="Reward ID"
                   required>

            <input type="text"
                   name="rewardName"
                   placeholder="Reward Name"
                   required>

            <input type="number"
                   name="pointsRequired"
                   placeholder="Points"
                   required>

            <input type="number"
                   name="stock"
                   placeholder="Stock"
                   required>

            <select name="status">

                <option value="Active">
                    Active
                </option>

                <option value="Inactive">
                    Inactive
                </option>

            </select>

            <button type="submit">
                Save
            </button>

            <button type="button"
                    onclick="closeAddModal()">

                Cancel

            </button>

        </form>

    </div>

</div>

<div id="editModal" class="modal">

    <div class="modal-content">

        <h2>Edit Reward</h2>

        <form action="editReward.php"
              method="POST">

            <input type="text"
                   id="editRewardId"
                   name="rewardId"
                   readonly>

            <input type="text"
                   id="editRewardName"
                   name="rewardName"
                   required>

            <input type="number"
                   id="editPoints"
                   name="pointsRequired"
                   required>

            <input type="number"
                   id="editStock"
                   name="stock"
                   required>

            <select id="editStatus"
                    name="status">

                <option value="Active">
                    Active
                </option>

                <option value="Inactive">
                    Inactive
                </option>

            </select>

            <button type="submit">
                Update
            </button>

            <button type="button"
                    onclick="closeEditModal()">

                Cancel

            </button>

        </form>

    </div>

</div>

<?php mysqli_close($conn); ?>

</body>
</html>