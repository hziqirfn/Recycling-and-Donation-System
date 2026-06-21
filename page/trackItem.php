<?php

session_start();

include("../inc/connect.php");
include("../inc/auth.php");

$userId = $_SESSION['userid'];
$sql = "SELECT ItemId, ItemName FROM item WHERE UserId = '$userId'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/sidebar.css">
    <link rel="stylesheet" href="../style/trackItem.css">
    <link rel="stylesheet" href="../style/dashboard.css">
    <script src="../js/trackItem.js" defer></script>

    <title>UTeM RecycleHub</title>
</head>

<body>
    <?php include("header.php"); ?>

    <div id="main">
        <?php include("sidebar.php"); ?>

        <label for="cb" id="overlay"></label>

        <div id="content">
            <div class="track-container">
                <div class="track-title">
                    <h2>Track Items</h2>
                    <p>Check the status of your item</p>
                </div>

                <div class="track-selector">
                    <label>Item to track</label>
                    <select id="itemSelect">
                        <option selected disabled>Select Item</option>
                        <?php 
                        while($row = $result->fetch_assoc())
                        {
                        ?>
                            <option value="<?= $row['ItemId'] ?>"><?= $row['ItemName'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="track-card" id="track-card">
                    <div class="track-header">
                        <h2 id="itemName">---</h2>
                        <span class="status-badge processing" id="statusBadge">Processing</span>
                    </div>

                    <div class="timeline-white-box">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-dot completed"></div>

                                <div class="timeline-content">
                                    <h3>Pending</h3>
                                    <p class="timeline-date">Apr 14, 2026</p>
                                    <p class="timeline-desc">Your item has been added to the system</p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-dot completed"></div>

                                <div class="timeline-content">
                                    <h3>Collected</h3>
                                    <p class="timeline-date">Apr 15, 2026</p>
                                    <p class="timeline-desc">Item has been collected from your location</p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-dot active"></div>

                                <div class="timeline-content">
                                    <h3>Processing</h3>
                                    <p class="timeline-status">In Progress</p>
                                    <p class="timeline-desc">Item is being processed at our facility</p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-dot"></div>

                                <div class="timeline-content">
                                    <h3>Completed</h3>
                                    <p class="timeline-status">Pending</p>
                                </div>
                            </div>
                        </div>

                        <div class="progress-section">

                            <div class="progress-bar">
                                <div class="progress-fill"></div>
                            </div>

                            <p class="progress-text">75% complete</p>
                        </div>
                    </div>

                    <div class="estimated-completion">
                        Estimated completion: Less than 1 day
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>