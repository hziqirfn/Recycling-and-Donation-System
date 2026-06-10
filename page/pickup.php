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

    <title>Pickup Request</title>
</head>

<body>

    <?php include("header.php"); ?>

    <div id="main">

        <?php include("sidebar.php"); ?>

        <label for="cb" id="overlay"></label>

        <div id="content">

            <div class="pickup-container">

                <div class="pickup-title">
                    <h1>Request Pickup</h1>
                    <p>Schedule a collection for your item</p>
                </div>

                <form class="pickup-form">

                    <select id="itemList">
                        <option>Select Item</option>
                    </select>

                    <small>
                        Don't see your item?
                        <a href="addItem.html">Add it first</a>
                    </small>

                    <div class="row">

                        <div class="input-group">
                            <label>Pickup Date</label>
                            <input type="date">
                        </div>

                        <div class="input-group">
                            <label>Preferred Time</label>
                            <input type="time">
                        </div>

                    </div>

                    <label>Pickup Location</label>

                    <textarea rows="4"></textarea>

                    <small>
                        Please provide detailed address including building/hostel name
                    </small>

                    <label>Additional Notes (Optional)</label>

                    <textarea rows="4"></textarea>

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

                        <button type="reset" class="cancel-btn">
                            Cancel
                        </button>

                        <button type="submit" class="submit-btn">
                            Schedule Pickup
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
    <script src="../js/pickup.js"></script>
</body>

</html>