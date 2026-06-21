<?php

$imgPath = "../../image/";

?>

<div id="side">

    <div class="dashboard">
        <a href="dashboardAdmin.php">
            <img src="<?= $imgPath ?>dashboard.png" alt="dashboard">
            Dashboard
        </a>
    </div>

    <div class="add">
        <a href="addItemAdmin.php">
            <img src="<?= $imgPath ?>add.png" alt="manage item">
            Item Management
        </a>
    </div>

    <div class="pickup">
        <a href="pickupAdmin.php">
            <img src="<?= $imgPath ?>pickup.png" alt="pickup request">
            Pickup Management
        </a>
    </div>

    <div class="reward">
        <a href="rewardAdmin.php">
            <img src="<?= $imgPath ?>reward.png" alt="reward">
            Reward Management
        </a>
    </div>

    <hr>

    <div class="logout">
        <a href="../logout.php">
            <img src="<?= $imgPath ?>logout.png" alt="logout">
            Log Out
        </a>
    </div>

</div>