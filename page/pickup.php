<?php

session_start();

include("../inc/connect.php");
include("../inc/auth.php");

$userId = $_SESSION['userid'];
$sql = "SELECT ItemId, ItemName, Category FROM item WHERE UserId = '$userId'";
$result = $conn->query($sql);

$error = "";

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $itemIds = $_POST['itemId'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $note = $_POST['note'];

    $prefix = "PKP-";

    $sql2 = "SELECT RequestId FROM pickup_request WHERE RequestId
             LIKE '$prefix%' ORDER BY CAST(SUBSTRING(RequestId, " . (strlen($prefix) + 1) . ") AS UNSIGNED)
             DESC LIMIT 1";
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
        $lastNum = (int) preg_replace('/[^0-9]/', '', $row['RequestId']);
        $requestId = $prefix . ($lastNum + 1);
    } else {
        $requestId = $prefix . "1";
    }

    $sql3 = "INSERT INTO pickup_request (RequestId, PickupDate, PickupTime, PickupAddress, Description, UserId)
             VALUES ('$requestId', '$date', '$time', '$location', '$note', '$userId')";
    $success = $conn->query($sql3);

    if ($success)
    {
        foreach ($itemIds as $itemid)
        {
            $sql4 = "INSERT INTO pickup_item (ItemId, RequestId)
                     VALUES ('$itemid', '$requestId')";

            if (!$conn->query($sql4))
            {
                $success = false;
                break;
            }
        }
    }

    if ($success)
    {
        $_SESSION['RequestId'] = $requestId;
        $_SESSION['error'] = "Your request pickup added";
    } 
    else 
    {
        $_SESSION['error'] = "Your request pickup failed to add";
    }
    header("Location: pickup.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/sidebar.css">
    <link rel="stylesheet" href="../style/pickup.css">
    <link rel="stylesheet" href="../style/dashboard.css">
    <script src="../js/pickup.js" defer></script>
    <title>UTeM RecycleHub</title>
</head>

<body>
    <?php include("header.php"); ?>

    <div id="main">
        <?php include("sidebar.php"); ?>

        <label for="cb" id="overlay"></label>

        <div id="content">
            <div class="pickup-container">
                <div class="pickup-title">
                    <h2>Request Pickup</h2>
                    <p>Schedule a collection for your item</p>
                </div>

                <form class="pickup-form" action="pickup.php" method="post">
                    <label>Item</label>

                    <div class="dropdown-header" id="dropdown-header" onclick="toggleDropdown()">
                        <span id="dropdown-text">Select items...</span>
                        <span >⌄</span>
                    </div>

                    <div class="dropdown-container">
                        <div class="options-scroll-area">

                        <?php 
                        $currentCategory = "";
                        while($row = $result->fetch_assoc())
                        {
                            if ($currentCategory != $row['Category'])
                            {
                                $currentCategory = $row['Category'];
                        ?>
                                <div class="category-header"><?= $currentCategory ?></div>
                        <?php
                        }
                        ?>
                            <label class="option-row">
                                <input type="checkbox" name="itemId[]" value="<?= $row['ItemId'] ?>">
                                <span class="item-text"><?= $row['ItemName'] ?></span>
                            </label>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                    <small>
                        Don't see your item?
                        <a href="addItem.php">Add it first</a>
                    </small>

                    <div class="row">
                        <div class="input-group">
                            <label class="pickup">Pickup Date</label>
                            <div class="date">
                                <input type="date" id="openDate" name="date" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="pickup">Preferred Time</label>
                            <div class="time">
                                <input type="time" id="openTime" name="time" required>
                            </div>
                        </div>
                    </div>

                    <label for="location">Pickup Location</label>
                    <small class="location">
                        Please provide detailed address including building/hostel name
                    </small>
                    <textarea rows="4" name="location" required></textarea>



                    <label for="note">Additional Notes (Optional)</label>
                    <textarea rows="4" name="note"></textarea>

                    <div class="info-box">
                        <h3>Pickup Information</h3>
                        <ul>
                            <li>Pickup service is free for all UTeM students and staff</li>
                            <li>We'll confirm your pickup within 24 hours</li>
                            <li>Please ensure items are ready at the scheduled time</li>
                            <li>You'll earn points once the item is collected</li>
                        </ul>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="submit-btn">
                            Schedule Pickup
                        </button>

                        <button type="reset" class="cancel-btn">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if ($error != "") {
    ?>
        <div id="alert" class="alert">
            <div class="popup-box"><br>
                <p><?= $error; ?></p> <br><br>
                <button onclick="closePopup()">OK</button>
            </div>
        </div>
    <?php
    }
    ?>
</body>

</html>