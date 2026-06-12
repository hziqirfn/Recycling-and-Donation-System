<?php
$admin = true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/headerAdmin.css">
    <link rel="stylesheet" href="../../style/sidebarAdmin.css">
    <link rel="stylesheet" href="../../style/dashboardAdmin.css">
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
                    <h2>150</h2>
                    <p>Total Users</p>
                </div>

                <div class="card">
                    <h2>85</h2>
                    <p>Total Items</p>
                </div>

                <div class="card">
                    <h2>32</h2>
                    <p>Pickup Requests</p>
                </div>

                <div class="card">
                    <h2>1200</h2>
                    <p>Total Points</p>
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