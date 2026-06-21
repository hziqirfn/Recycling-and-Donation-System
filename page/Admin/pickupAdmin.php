<?php

session_start();

$admin = true;
include("../../inc/connect.php");
include("../../inc/auth.php");

$queryPickup = "SELECT pr.RequestId, pr.UserId, u.Name, pr.PickupAddress, pr.PickupDate,
                COUNT(pi.ItemId) AS TotalItems
                FROM pickup_request pr
                LEFT JOIN pickup_item pi
                    ON pr.RequestId = pi.RequestId
                LEFT JOIN user u
                    ON pr.UserId = u.UserId
                GROUP BY pr.RequestId, pr.UserId, u.Name, pr.PickupAddress, pr.PickupDate
                ORDER BY pr.PickupDate DESC";

$resultPickup = mysqli_query($conn, $queryPickup);

$totalPickup = mysqli_num_rows($resultPickup);

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
    <link rel="stylesheet" href="../../style/admin/pickupAdmin.css">
    <script src="../../js/admin/pickupAdmin.js" defer></script>
    <title>UTeM RecycleHub</title>
</head>

<body class="pickup-request-page">

    <?php include("headerAdmin.php"); ?>
    <?php include("sidebarAdmin.php"); ?>

    <label for="cb" id="overlay"></label>

    <div class="dashboard-container">

        <div class="dashboard-header">
            <h2>Pickup Management</h2>
            <p>View scheduled and pending pickup requests.</p>
        </div>

        <div class="table-card">
            <div class="table-top">

                <div class="total-text">
                    <strong><?php echo $totalPickup; ?></strong> total requests
                </div>

                <div class="filter-wrapper">
                    <span class="filter-label">Filter:</span>

                    <select id="statusFilter" class="filter-select">
                        <option value="all">All Requests</option>
                        <option value="pending">Pending</option>
                        <option value="scheduled">Scheduled</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>

            <table class="management-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Address</th>
                        <th>Pickup Date</th>
                        <th>Items</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    while ($row = mysqli_fetch_assoc($resultPickup)) 
                    { 
                    ?>
                        <tr ondblclick="goTrack('<?= $row['RequestId'] ?>')">
                            <td><?= $row['RequestId']; ?></td>

                            <td>
                                <strong><?= $row['Name']; ?></strong>
                            </td>

                            <td><?= $row['PickupAddress']; ?></td>

                            <td><?= $row['PickupDate']; ?></td>

                            <td><?= $row['TotalItems']; ?> items</td>
                        </tr>
                    <?php 
                    } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>