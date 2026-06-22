<?php

session_start();

include("../../inc/connect.php");
include("../../inc/auth.php");

$itemId = $_GET['id'];

$sql = "SELECT item.*,
               user.Name,
               user.Email,
               user.NoPhone
        FROM item
        JOIN user ON item.UserId = user.UserId
        WHERE item.ItemId = '$itemId'";

$result = $conn->query($sql);
$item = $result->fetch_assoc();

// APPROVE
if (isset($_POST['approve'])) {

    $itemId = $_POST['itemId'];

    $sql = "UPDATE item
            SET Status='Approved'
            WHERE ItemId='$itemId'";

    $conn->query($sql);

    // Activity Admin
    $adminId = $_SESSION['userid'];

    mysqli_query($conn, "
    INSERT INTO activity(UserId, ActivityText, ActivityType)
    VALUES(
        '$adminId',
        'Approved item $itemId',
        'Admin'
    )");

    // Activity User
    $userId = $item['UserId'];
    $itemName = $item['ItemName'];

    mysqli_query($conn, "
    INSERT INTO activity(UserId, ActivityText, ActivityType)
    VALUES(
        '$userId',
        'Your item $itemName has been approved by admin',
        'User'
    )");

    header("Location: addItemAdmin.php");
    exit();
}

// REJECT
if (isset($_POST['reject'])) {

    $itemId = $_POST['itemId'];
    $reason = $_POST['rejectreason'];

    $sql = "UPDATE item
            SET Status='Rejected',
                RejectReason='$reason'
            WHERE ItemId='$itemId'";

    $conn->query($sql);

    // Activity Admin
    $adminId = $_SESSION['userid'];

    mysqli_query($conn, "
    INSERT INTO activity(UserId, ActivityText, ActivityType)
    VALUES(
        '$adminId',
        'Rejected item $itemId',
        'Admin'
    )");

    // Activity User
    $userId = $item['UserId'];
    $itemName = $item['ItemName'];

    mysqli_query($conn, "
    INSERT INTO activity(UserId, ActivityText, ActivityType)
    VALUES(
        '$userId',
        'Your item $itemName has been rejected by admin',
        'User'
    )");

    header("Location: addItemAdmin.php");
    exit();
}

$conn->close();
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
    <link rel="stylesheet" href="../../style/admin/itemDetailAdmin.css">
   
    <title>UTeM RecycleHub</title>
</head>

<body>
    <?php include("headerAdmin.php"); ?>
    <?php include("sidebarAdmin.php"); ?>

    <label for="cb" id="overlay"></label>

    <main class="details-container">

        <section class="image-card">
            <img src="../../image-UserItem/<?= $item['Image'] ?>" alt="Item Image">

            <div class="image-text">
                <h1><?= $item['ItemName'] ?></h1>
                <p><?= $item['ItemId'] ?></p>
            </div>

            <span class="condition-badge"><?= $item['Condition'] ?></span>
        </section>

        <section class="info-card">
            <h3>Description</h3>
            <p><?= $item['Description'] ?></p>
        </section>

        <section class="info-card">
            <h3>Item Information</h3>

            <div class="info-row">
                <span>Item ID</span>
                <b><?= $item['ItemId'] ?></b>
            </div>

            <div class="info-row">
                <span>Name</span>
                <b><?= $item['ItemName'] ?></b>
            </div>

            <div class="info-row">
                <span>Category</span>
                <b><?= $item['Category'] ?></b>
            </div>

            <div class="info-row">
                <span>Condition</span>
                <b><?= $item['Condition'] ?></b>
            </div>

            <div class="info-row">
                <span>Submitted Date</span>
                <b><?= $item['ItemDate'] ?></b>
            </div>

            <div class="info-row">
                <span>Activity Type</span>
                <b><?= $item['ActivityType'] ?></b>
            </div>
        </section>

        <section class="info-card">
            <h3>Submitted By</h3>

            <div class="user-box">
                <div class="avatar"><?= strtoupper(substr($item['Name'], 0, 1)) ?></div>
                <div>
                    <b><?= $item['Name'] ?></b>
                    <p><?= $item['NoPhone'] ?? '---' ?></p>
                    <p><?= $item['Email'] ?></p>
                    <small><?= $item['UserId'] ?></small>
                </div>
            </div>
        </section>

        <section class="review-box">
            <h3>Admin Review Required</h3>
            <p>Review the item details above before deciding.</p>

            <form method="post" class="action-buttons">
                <input type="hidden" name="itemId" value="<?= $item['ItemId'] ?>">

                <button type="submit" name="approve" class="approve-btn" formnovalidate>
                    Approve
                </button>

                <button type="button" onclick="showRejectBox()" class="reject-btn">
                    Reject
                </button>

                <div id="rejectBox" class="reject-box">
                    <label>Reason for Rejection</label>

                    <textarea
                        id="rejectreason"
                        name="rejectreason"
                        class="reject-textarea"
                        placeholder="Example: Item image is unclear or item information is incomplete..."></textarea>

                    <button type="submit" name="reject" class="confirm-reject-btn">
                        Confirm Reject
                    </button>
                </div>
            </form>
        </section>

    </main>
    <script>
        function showRejectBox() {
            document.getElementById("rejectBox").style.display = "block";

            document.getElementById("rejectreason").required = true;
        }
    </script>
</body>

</html>