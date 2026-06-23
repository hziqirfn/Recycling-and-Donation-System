<?php

session_start();

include("../../inc/connect.php");
include("../../inc/auth.php");

$admin = true;

//total user
$query = "SELECT COUNT(*) AS totalUser
          FROM user
          WHERE Role IN ('Public','Student(UTeM)','Staff(UTeM)')";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
$totalUser = $data['totalUser'];

//total item
$queryItem = "SELECT COUNT(*) AS totalItem FROM item";
$resultItem = mysqli_query($conn, $queryItem);
$dataItem = mysqli_fetch_assoc($resultItem);
$totalItem = $dataItem['totalItem'];

//total pick
$queryPickup = "SELECT COUNT(*) AS totalPickup FROM pickup_request";
$resultPickup = mysqli_query($conn, $queryPickup);
$totalPickup = mysqli_fetch_assoc($resultPickup)['totalPickup'];

// Recent Req
$queryRecent = "SELECT pr.RequestId, u.Name, COUNT(pi.ItemId) AS TotalItems
                FROM pickup_request pr
                JOIN user u 
                    ON pr.UserId = u.UserId
                LEFT JOIN pickup_item pi 
                    ON pr.RequestId = pi.RequestId
                GROUP BY pr.RequestId
                ORDER BY pr.PickupDate DESC
                LIMIT 5";
$resultRecent = mysqli_query($conn, $queryRecent);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../image/logo.png">

    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/admin/headerAdmin.css">
    <link rel="stylesheet" href="../../style/admin/sidebarAdmin.css">
    <link rel="stylesheet" href="../../style/admin/dashboardAdmin.css">
    <title>UTeM RecycleHub</title>
</head>

<body>

    <?php include("headerAdmin.php"); ?>
    <?php include("sidebarAdmin.php"); ?>

    <label for="cb" id="overlay"></label>

    <div id="main">

        <div id="content">

            <div class="welcome-card">
                <h1>Admin Dashboard</h1>
                <p>Manage users, items and pickup requests.</p>
            </div>

            <div class="stats">

                <div class="card">
                    <h2><?php echo $totalUser; ?></h2>
                    <p>Total Users</p>
                </div>

                <div class="card">
                    <h2><?php echo $totalItem; ?></h2>
                    <p>Total Items</p>
                </div>

                <div class="card">
                    <h2><?php echo $totalPickup; ?></h2>
                    <p>Pickup Requests</p>
                </div>

            </div>

            <div class="table-card">

                <h2>Recent Requests</h2>

                <table>

                    <tr>
                        <th>Request ID</th>
                        <th>User</th>
                        <th>Total Items</th>
                    </tr>

                    <?php while ($row = mysqli_fetch_assoc($resultRecent)) { ?>

                        <tr>
                            <td><?= $row['RequestId']; ?></td>
                            <td><?= $row['Name']; ?></td>
                            <td><?= $row['TotalItems']; ?> Items</td>
                        </tr>

                    <?php } ?>
                </table>

            </div>

        </div>

    </div>

</body>

</html>