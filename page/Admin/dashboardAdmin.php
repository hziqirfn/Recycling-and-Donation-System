<?php
session_start();

$admin = true;

include("../../inc/connect.php");
include("../../inc/auth.php");

$query = "SELECT COUNT(*) AS totalUser
          FROM user
          WHERE Role IN ('Public','Student(UTeM)','Staff(UTeM)')";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
$totalUser = $data['totalUser'];

$queryItem = "SELECT COUNT(*) AS totalItem FROM item";
$resultItem = mysqli_query($conn, $queryItem);
$dataItem = mysqli_fetch_assoc($resultItem);
$totalItem = $dataItem['totalItem'];

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
    <link rel="stylesheet" href="../../style/admin/dashboardAdmin.css">
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
                    <h2>32</h2>
                    <p>Pickup Requests</p>
                </div>

            </div>

            <div class="table-card">

                <h2>Recent Requests</h2>

                <table>

                    <tr>
                        <th>User</th>
                        <th>Item</th>
                        <th>Status</th>
                    </tr>

                    <tr>
                        <td>Hakim</td>
                        <td>Books</td>
                        <td>Pending</td>
                    </tr>

                    <tr>
                        <td>Ali</td>
                        <td>Plastic</td>
                        <td>Completed</td>
                    </tr>

                    <tr>
                        <td>Siti</td>
                        <td>E-Waste</td>
                        <td>Pending</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

</body>

</html>