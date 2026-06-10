<?php
$admin = true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pickup Requests</title>

    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/headerAdmin.css">
    <link rel="stylesheet" href="../../style/sidebarAdmin.css">
    <link rel="stylesheet" href="style/pickupAdmin.css">
</head>

<body class="pickup-request-page">

<?php include("headerAdmin.php"); ?>
<?php include("sidebarAdmin.php"); ?>

<label for="cb" id="overlay"></label>

<div class="dashboard-container">

    <div class="dashboard-header">
        <h1>Pickup Requests</h1>
        <p>Manage scheduled and pending pickup requests.</p>
    </div>

    <div class="table-card">

        <div class="table-top">

            <div class="total-text">
                <strong>5</strong> total requests
            </div>

            <button class="filter-btn">
                ☰ Filter
            </button>

        </div>

        <table class="management-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Address</th>
                    <th>Pickup Date</th>
                    <th>Items</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

    <tr>
        <td>PKP-001</td>
        <td><strong>Ahmad Razif</strong></td>
        <td>Kolej Tun Fatimah, UTeM</td>
        <td>2026-06-10</td>
        <td>3 items</td>
        <td><span class="badge badge-scheduled">Scheduled</span></td>
        <td><button class="action-btn">⋯</button></td>
    </tr>

    <tr>
        <td>PKP-002</td>
        <td><strong>Siti Nurhaliza</strong></td>
        <td>Kolej Kediaman 1, UTeM</td>
        <td>2026-06-09</td>
        <td>5 items</td>
        <td><span class="badge badge-pending">Pending</span></td>
        <td><button class="action-btn">⋯</button></td>
    </tr>

    <tr>
        <td>PKP-003</td>
        <td><strong>Muhammad Hafiz</strong></td>
        <td>FKE Faculty Building</td>
        <td>2026-06-08</td>
        <td>2 items</td>
        <td><span class="badge badge-completed">Completed</span></td>
        <td><button class="action-btn">⋯</button></td>
    </tr>

    <tr>
        <td>PKP-004</td>
        <td><strong>Nurul Ain</strong></td>
        <td>Kolej Kediaman 2, UTeM</td>
        <td>2026-06-08</td>
        <td>7 items</td>
        <td><span class="badge badge-pending">Pending</span></td>
        <td><button class="action-btn">⋯</button></td>
    </tr>

    <tr>
        <td>PKP-005</td>
        <td><strong>Faris Izwan</strong></td>
        <td>Library Complex, UTeM</td>
        <td>2026-06-07</td>
        <td>4 items</td>
        <td><span class="badge badge-completed">Completed</span></td>
        <td><button class="action-btn">⋯</button></td>
    </tr>

</tbody>

        </table>

    </div>

</div>

</body>
</html>