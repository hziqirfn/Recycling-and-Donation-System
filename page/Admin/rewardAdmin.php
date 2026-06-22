<?php

session_start();

$admin = true;

include("../../inc/connect.php");
include("../../inc/auth.php");

$queryReward = "
SELECT *
FROM reward
ORDER BY RewardId ASC
";

$resultReward = mysqli_query($conn,$queryReward);

if(!$resultReward){
    die(mysqli_error($conn));
}

$totalReward = mysqli_num_rows($resultReward);

/* POINT CONFIGURATION */

$pointResult = mysqli_query(
    $conn,
    "SELECT * FROM point_configure"
);

$points = [];

while($rowPoint = mysqli_fetch_assoc($pointResult))
{
    $points[$rowPoint['ActivityType']]
    = $rowPoint['PointConfigure'];
}

/* QUERY BARU UNTUK DISPLAY */

$pointDisplay = mysqli_query(
    $conn,
    "SELECT * FROM point_configure"
);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/admin/headerAdmin.css">
    <link rel="stylesheet" href="../../style/admin/sidebarAdmin.css">
    <link rel="stylesheet" href="../../style/admin/rewardAdmin.css">
    <title>UTeM RecycleHub</title>
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

            <option value="all">All Rewards</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>

        </select>

        <select id="roleFilter"
                onchange="filterRewards()">

            <option value="all">
                All Roles
            </option>

            <option value="utem">
                UTeM
            </option>

            <option value="public">
                Public
            </option>
 

        </select>

    </div>

    <div class="total-text">
        <strong><?= $totalReward; ?></strong> total rewards
    </div>

    <div class="reward-grid">

    <?php
    if($totalReward > 0)
    {
        while($row = mysqli_fetch_assoc($resultReward))
        {
    ?>

    <div class="reward-card
         <?= strtolower($row['Status']); ?>
         <?= strtolower($row['RewardRole']); ?>">

        <div class="card-top">

            <span class="reward-icon">🎁</span>

            <span class="badge <?= ($row['Status']=="Active")
            ? "badge-active"
            : "badge-inactive"; ?>">

                <?= $row['Status']; ?>

            </span>

        </div>

        <h3><?= $row['RewardName']; ?></h3>

        <h2><?= $row['RewardPoint']; ?> pts</h2>

        <p>Stock: <?= $row['Stock']; ?></p>

        <p>Role: <?= $row['RewardRole']; ?></p>

        <div class="card-actions">

            <button class="edit-btn"

                onclick="openEditModal(
                '<?= $row['RewardId']; ?>',
                '<?= $row['RewardName']; ?>',
                '<?= $row['RewardPoint']; ?>',
                '<?= $row['Stock']; ?>',
                '<?= $row['RewardRole']; ?>',
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
    }
    else
    {
    ?>

    <div class="empty-state">

        <h3>No Rewards Available</h3>

        <p>
            Click Add Reward to create your first reward.
        </p>

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

        <?php
        while($rowPoint = mysqli_fetch_assoc($pointDisplay))
        {
        ?>

           <div class="point-item">

               <span>
                   <?= $rowPoint['ActivityType']; ?>
               </span>

               <strong>
                   <?= $rowPoint['PointConfigure']; ?> pts
               </strong>

           </div>

        <?php
        }
        ?>

        </div>
    </div>
</div>


<div id="pointModal" class="modal">

    <div class="modal-content">

        <h2>Update Point Configuration</h2>

        <form action="updatePoints.php" method="POST">

    <label>Donate</label>

    <input type="number"
           name="donate"
           value="<?= isset($points['Donate']) ? $points['Donate'] : 0; ?>"
           required>

    <label>Recycle</label>

    <input type="number"
           name="recycle"
           value="<?= isset($points['Recycle']) ? $points['Recycle'] : 0; ?>"
           required>

    <button type="submit">
        Save
    </button>

    <button type="button"
            onclick="closePointModal()">
        Cancel
    </button>

</form>

    </div>

</div>

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
                   name="RewardPoint"
                   placeholder="Points"
                   required>

            <input type="number"
                   name="stock"
                   placeholder="Stock"
                   required>

            <select name="rewardRole" required>

                <option value="UTeM">
                    UTeM
                </option>

                <option value="Public">
                    Public
                </option>

            </select>

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
                   name="RewardPoint"
                   required>

            <input type="number"
                   id="editStock"
                   name="stock"
                   required>
            
            <select id="editRewardRole"
                    name="rewardRole">

                <option value="UTeM">
                    UTeM
                </option>

                <option value="Public">
                    Public
                </option>

            </select>

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

<script>

function openAddModal(){
    document.getElementById("addModal").style.display = "flex";
}

function closeAddModal(){
    document.getElementById("addModal").style.display = "none";
}

function openEditModal(id,name,points,stock,rewardRole,status){

    document.getElementById("editRewardId").value = id;
    document.getElementById("editRewardName").value = name;
    document.getElementById("editPoints").value = points;
    document.getElementById("editStock").value = stock;
    document.getElementById("editRewardRole").value = rewardRole;
    document.getElementById("editStatus").value = status;

    document.getElementById("editModal").style.display = "flex";
}

function closeEditModal(){
    document.getElementById("editModal").style.display = "none";
}

function filterRewards(){

    let status =
    document.getElementById("statusFilter").value;

    let role =
    document.getElementById("roleFilter").value;

    let cards =
    document.querySelectorAll(".reward-card");

    cards.forEach(card => {

        let statusMatch =
        (status === "all") ||
        card.classList.contains(status);

        let roleMatch =
        (role === "all") ||
        card.classList.contains(role);

        if(statusMatch && roleMatch){

            card.style.display = "block";

        }
        else{

            card.style.display = "none";

        }

    });

}

function openPointModal(){
    document.getElementById("pointModal").style.display = "flex";
}

function closePointModal(){
    document.getElementById("pointModal").style.display = "none";
}

</script>

<?php mysqli_close($conn); ?>

</body>
</html>