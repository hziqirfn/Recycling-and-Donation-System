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

$totalItem = $data['totalItem'];

$sqlRecent = "SELECT ItemName, Status, ItemDate, RejectReason
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

$sqlContributor = "SELECT Name, Points
                   FROM user
                   WHERE Role NOT LIKE '%Admin%'
                   ORDER BY Points DESC
                   LIMIT 5";

$resultContributor = $conn->query($sqlContributor);

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

                    <table>
                        <tr>
                            <th>Item Name</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>

                        <?php
                        $countActivity = 0;

                        while ($row = $resultRecent->fetch_assoc()) {
                            $countActivity++;
                        ?>
                            <tr class="<?= ($countActivity > 3) ? 'hiddenActivity' : ''; ?>">
                                <td><?= $row['ItemName']; ?></td>
                                <td>
                                    <?php
                                    if ($row['Status'] == 'Rejected' && !empty($row['RejectReason'])) {
                                        echo htmlspecialchars($row['Status']) . " (" . htmlspecialchars($row['RejectReason']) . ")";
                                    } else {
                                        echo $row['Status'];
                                    }
                                    ?>
                                </td>
                                <td><?= $row['ItemDate']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>

                <div class="box2">
                    <div class="boxHeader">
                        <h3>Top Contributors</h3>
                        <button id="contributorBtn" onclick="toggleContributor()">View All</button>
                    </div>

                    <table>
                        <tr>
                            <th>Ranking</th>
                            <th>Name</th>
                            <th>Total Points</th>
                        </tr>

                        <?php
                        $countContributor = 0;

                        if ($resultContributor->num_rows > 0) {
                            while ($row = $resultContributor->fetch_assoc()) {
                                $countContributor++;
                                $rankDisplay = $countContributor;

                                if ($countContributor == 1) {
                                    $rankDisplay = "🥇";
                                } elseif ($countContributor == 2) {
                                    $rankDisplay = "🥈";
                                } elseif ($countContributor == 3) {
                                    $rankDisplay = "🥉";
                                }
                        ?>
                                <tr class="<?= ($countContributor > 3) ? 'hiddenContributor' : ''; ?>">
                                    <td><?= $rankDisplay ?></td>
                                    <td><?= $row['Name']; ?></td>
                                    <td><?= $row['Points']; ?> pts</td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="3">No contributors yet</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>