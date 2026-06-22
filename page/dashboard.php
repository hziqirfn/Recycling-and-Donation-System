<?php

session_start();

include("../inc/connect.php");
include("../inc/auth.php");

$userId = $_SESSION['userid'];

$point = "SELECT Points
          FROM user
          WHERE UserId = '$userId'";
$resultPoint = mysqli_query($conn, $point);
$dataPoint = mysqli_fetch_assoc($resultPoint);

$query = "SELECT COUNT(*) AS totalItem
          FROM item
          WHERE UserId = '$userId'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

$sqlRecent = "SELECT ItemName, Status, ItemDate
              FROM item
              WHERE UserId = '$userId'
              ORDER BY ItemDate DESC
              LIMIT 5";
$resultRecent = $conn->query($sqlRecent);

$queryActivity = "SELECT *
                  FROM activity
                  WHERE UserId = '$userId'
                  AND ActivityType = 'User'
                  ORDER BY ActivityDate DESC
                  LIMIT 5";
$resultActivity = mysqli_query($conn, $queryActivity);

//Donate
$queryDonate = "SELECT COUNT(*) AS totalDonate 
                FROM item
                WHERE UserId = '$userId'
                AND ActivityType = 'Donate'
                AND Status = 'Approved'";
$resultDonate = mysqli_query($conn, $queryDonate);
$totalDonate = mysqli_fetch_assoc($resultDonate)['totalDonate'];

//recycled
$queryRecycle = "SELECT COUNT(*) AS totalRecycle 
                 FROM item 
                 WHERE UserId = '$userId'
                 AND ActivityType = 'Recycle'
                 AND Status = 'Approved'";
$resultRecycle = mysqli_query($conn, $queryRecycle);
$totalRecycle = mysqli_fetch_assoc($resultRecycle)['totalRecycle'];

$conn->close();
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
                    <h3><?= $dataPoint['Points'] ?></h3>
                    <p>Your Points</p>
                </div>
            </div>

            <div id="content2">
                <div class="box">
                    <h2><?= $data['totalItem'] ?></h2>
                    <p>Total Item</p>
                </div>

                <div class="box">
                    <h3><?= $totalDonate ?></h3>
                    <p>Donated</p>
                </div>

                <div class="box">
                    <h3><?= $totalRecycle ?></h3>
                    <p>Recycled</p>
                </div>
            </div>

            <div id="content3">
                <div class="box2">
                    <div class="boxHeader">
                        <h3>Recent Activity</h3>
                        <button id="activityBtn" onclick="toggleActivity()">View All</button>
                    </div>

                    <ul class="activityList" id="activityList">
                        <?php
                        while ($row = $resultRecent->fetch_assoc()) {
                        ?>
                            <li>
                                <span><?= $row['ItemName'] ?></span>
                                <span><?= $row['Status'] ?></span>
                                <span><?= $row['ItemDate'] ?></span>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>

                <div class="box2">
                    <div class="boxHeader">
                        <h3>Top Contributors</h3>
                        <button id="contributorBtn" onclick="toggleContributor()">View All</button>
                    </div>

                    <ol class="contributorList" id="contributorList">
                        <?php
                        $countContributor = 0;

                        if ($resultContributor->num_rows > 0) {
                            while ($row = $resultContributor->fetch_assoc()) {
                                $countContributor++;
                        ?>
                                <li class="<?= ($countContributor > 3) ? 'hiddenContributor' : ''; ?>">
                                    <?= $row['Name']; ?> - <?= $row['Points']; ?> pts
                                </li>
                            <?php
                            }
                        } else {
                            ?>
                            <li>No contributors yet</li>
                        <?php } ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</body>

</html>