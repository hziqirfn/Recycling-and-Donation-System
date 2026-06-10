<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Management Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../style/sidebarAdmin.css">
    <link rel="stylesheet" href="style/addItemAdmin.css">
    <link rel="stylesheet" href="../../style/header.css">
</head>

<body>
    <?php include("headerAdmin.php"); ?>
    <?php include("sidebarAdmin.php"); ?>

    <main class="dashboard-container">
        <header class="dashboard-header">
            <h1>Item Management</h1>
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
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
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
                    <tr data-status="pending">
                        <td class="text-muted">ITM-001</td>
                        <td><strong>Old Textbooks</strong></td>
                        <td>Ahmad Razif</td>
                        <td>Paper</td>
                        <td>2026-06-07</td>
                        <td><span class="badge badge-pending">Pending</span></td>
                    </tr>
                    <tr data-status="approved">
                        <td class="text-muted">ITM-002</td>
                        <td><strong>Plastic Bottles</strong></td>
                        <td>Siti Nurhaliza</td>
                        <td>Plastic</td>
                        <td>2026-06-07</td>
                        <td><span class="badge badge-approved">Approved</span></td>
                    </tr>
                    <tr data-status="rejected">
                        <td class="text-muted">ITM-003</td>
                        <td><strong>Used Laptop</strong></td>
                        <td>Muhammad Hafiz</td>
                        <td>Electronics</td>
                        <td>2026-06-06</td>
                        <td><span class="badge badge-rejected">Rejected</span></td>
                    </tr>
                    <tr data-status="pending">
                        <td class="text-muted">ITM-004</td>
                        <td><strong>Glass Jars</strong></td>
                        <td>Nurul Ain</td>
                        <td>Glass</td>
                        <td>2026-06-06</td>
                        <td><span class="badge badge-pending">Pending</span></td>
                    </tr>
                    <tr data-status="pending">
                        <td class="text-muted">ITM-005</td>
                        <td><strong>Cardboard Boxes</strong></td>
                        <td>Faris Izwan</td>
                        <td>Paper</td>
                        <td>2026-06-05</td>
                        <td><span class="badge badge-pending">Pending</span></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
    <script src="js/addItemAdmin.js"></script>
</body>

</html>