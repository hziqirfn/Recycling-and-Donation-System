<?php

session_start();

include("../inc/connect.php");
include("../inc/auth.php");

$userId = $_SESSION['userid'];

$query = "SELECT COUNT(*) AS totalItem
          FROM item
          WHERE UserId = '$userId'";

$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);

$totalItem = $data['totalItem'];

$sqlRecent = "SELECT ItemName, Status, ItemDate
              FROM item
              WHERE UserId = '$userId'
              ORDER BY ItemDate DESC
              LIMIT 5";

$resultRecent = $conn->query($sqlRecent);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/sidebar.css">
    <link rel="stylesheet" href="../style/dashboard.css">
    <script src="../js/dashboard.js" defer></script>
    <title>UTeM RecycleHub</title>
</head>

<body>
    <?php include("header.php"); ?>

    <div id="main">
        <?php include("sidebar.php"); ?>

        <label for="cb" id="overlay"></label>

        <div id="content">
            <div id="content1">
                <div class="welcome">
                    <h2>Welcome Back, <?= $_SESSION['name']; ?>!</h2>
                    <p>Let's make a positive impact today</p>
                </div>

                <div class="boxPoint">
                    <h3>200</h3>
                    <p>Your Points</p>
                </div>
            </div>

            <div id="content2">
                <div class="box">
                    <h2><?php echo $totalItem; ?></h2>
                    <p>Total Item</p>
                </div>

                <div class="box">
                    <h3>8</h3>
                    <p>Donated</p>
                </div>

                <div class="box">
                    <h3>7</h3>
                    <p>Recycled</p>
                </div>
            </div>

            <div id="content3">
                <div class="box2">
                    <div class="boxHeader">
                        <h3>Recent Activity</h3>
                        <button onclick="toggleActivity()">View All</button>
                    </div>

                    <ul class="activityList" id="activityList">
                        <?php 
                        while ($row = $resultRecent->fetch_assoc()) 
                        { 
                        ?>
                            <li>
                                <?= $row['ItemName'] ?> - <?= $row['Status'] ?> - <?= $row['ItemDate'] ?>
                            </li>
                        <?php 
                        } 
                        ?>
                    </ul>
                </div>

                <div class="box2">
                    <div class="boxHeader">
                        <h3>Top Contributors</h3>
                        <button onclick="toggleContributor()">View All</button>
                    </div>

                    <ol class="contributorList" id="contributorList">
                        <li>Ali - 520 pts</li>
                        <li>Siti - 480 pts</li>
                        <li>Ahmad - 450 pts</li>
                        <li class="hiddenContributor">John - 400 pts</li>
                        <li class="hiddenContributor">User - 250 pts</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</body>

</html>