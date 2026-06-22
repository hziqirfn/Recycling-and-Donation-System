<?php

session_start();

include("../inc/connect.php");
include("../inc/auth.php");

$userId = $_SESSION['userid'];

$sql = "SELECT
            i.ItemId,
            i.ItemName,
            COALESCE(t.Status,'Not Started') AS Status,
            t.pending_date,
            t.pending_desc,
            t.collected_date,
            t.collected_desc,
            t.processing_date,
            t.processing_desc,
            t.completed_date,
            t.completed_desc
        FROM item i
        LEFT JOIN track_item t ON i.ItemId = t.ItemId
        WHERE i.UserId = '$userId'";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../image/logo.png">

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
                        <option selected disabled value="">Select Item</option>

                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <option
                                value="<?= htmlspecialchars($row['ItemId']) ?>"
                                data-status="<?= htmlspecialchars($row['Status']) ?>"
                                data-pending-date="<?= htmlspecialchars($row['pending_date'] ?? '') ?>"
                                data-pending-desc="<?= htmlspecialchars($row['pending_desc'] ?? '') ?>"
                                data-collected-date="<?= htmlspecialchars($row['collected_date'] ?? '') ?>"
                                data-collected-desc="<?= htmlspecialchars($row['collected_desc'] ?? '') ?>"
                                data-processing-date="<?= htmlspecialchars($row['processing_date'] ?? '') ?>"
                                data-processing-desc="<?= htmlspecialchars($row['processing_desc'] ?? '') ?>"
                                data-completed-date="<?= htmlspecialchars($row['completed_date'] ?? '') ?>"
                                data-completed-desc="<?= htmlspecialchars($row['completed_desc'] ?? '') ?>">
                                <?= htmlspecialchars($row['ItemName']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="track-card" id="track-card" style="display:none;">
                    <div class="track-header">
                        <h2 id="itemName">---</h2>
                        <span class="status-badge" id="statusBadge">Not Started</span>
                    </div>

                    <div class="timeline-white-box">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>

                                <div class="timeline-content">
                                    <h3>Pending</h3>
                                    <p class="timeline-date" id="pendingDate">Pending</p>
                                    <p class="timeline-desc" id="pendingDesc">
                                        Your item has been added to the system
                                    </p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-dot"></div>

                                <div class="timeline-content">
                                    <h3>Collected</h3>
                                    <p class="timeline-date" id="collectedDate">Pending</p>
                                    <p class="timeline-desc" id="collectedDesc">
                                        Item has been collected from your location
                                    </p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-dot"></div>

                                <div class="timeline-content">
                                    <h3>Processing</h3>
                                    <p class="timeline-status" id="processingDate">Pending</p>
                                    <p class="timeline-desc" id="processingDesc">
                                        Item is being processed at our facility
                                    </p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-dot"></div>

                                <div class="timeline-content">
                                    <h3>Completed</h3>
                                    <p class="timeline-status" id="completedDate">Pending</p>
                                    <p class="timeline-desc" id="completedDesc">
                                        Process has finished successfully
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="progress-section">
                            <div class="progress-bar">
                                <div class="progress-fill"></div>
                            </div>

                            <p class="progress-text">0% complete</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>