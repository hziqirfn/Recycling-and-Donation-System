<?php
include("../../inc/connect.php");

$sql = "SELECT item.ItemId,
               item.ItemName,
               item.Category,
               item.item_date,
               user.Name
        FROM item
        JOIN user ON item.UserId = user.UserId";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/admin/sidebarAdmin.css">
    <link rel="stylesheet" href="../../style/admin/addItemAdmin.css">
    <link rel="stylesheet" href="../../style/admin/headerAdmin.css">
    <script src="../../js/admin/addItemAdmin.js" defer></script>
    <title>UTeM RecycleHub</title>
</head>

<body class="item-management-page">
    <?php include("headerAdmin.php"); ?>
    <?php include("sidebarAdmin.php"); ?>

    <label for="cb" id="overlay"></label>

    <main class="dashboard-container">
        <header class="dashboard-header">
            <h2>Item Management</h2>
            <p>Review and approve recycling/donation submissions.</p>
        </header>

        <section class="table-controls">
            <div class="tabs">
                <button class="tab-btn active" data-filter="all">All</button>
                <button class="tab-btn" data-filter="pending">Pending</button>
                <button class="tab-btn" data-filter="approved">Approved</button>
                <button class="tab-btn" data-filter="rejected">Rejected</button>
            </div>
            <div class="search-box">
                <img src="../../image/search.png" alt="search">
                <input type="text" id="searchInput" placeholder="Search items...">
            </div>
        </section>

        <section class="table-container">
            <table class="management-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item Name</th>
                        <th>Submitted By</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr data-status="pending">
                            <td><?= $row['ItemId'] ?></td>
                            <td><strong><?= $row['ItemName'] ?></strong></td>
                            <td><?= $row['Name'] ?></td>
                            <td><?= $row['Category'] ?></td>
                            <td><?= $row['item_date'] ?></td>
                            <td>
                                <span class="badge badge-pending">Pending</span>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>