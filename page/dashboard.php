<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/sidebar.css">
    <link rel="stylesheet" href="../style/dashboard.css">

    <script src="../js/dashboard.js" defer></script>

    <title>UTeM RecycleHub</title>
</head>

<body>

    <?php include("header.php"); ?>

    <div id="main">

        <?php include("sidebar.php"); ?>

        <label for="cb" id="overlay"></label>

        <div id="content">

            <!-- TOP SECTION -->
            <div id="content1">

                <div class="welcome">
                    <h2>Welcome Back, User!</h2>
                    <p>Let's make a positive impact today</p>
                </div>

                <div class="boxPoint">
                    <h3>250</h3>
                    <p>Your Points</p>
                </div>

            </div>

            <!-- STATISTIC BOXES -->
            <div id="content2">

                <div class="box">
                    <h3>15</h3>
                    <p>Total Item</p>
                </div>

                <div class="box">
                    <h3>8</h3>
                    <p>Donated</p>
                </div>

                <div class="box">
                    <h3>7</h3>
                    <p>Sold</p>
                </div>

            </div>

            <!-- BOTTOM SECTION -->
            <div id="content3">

                <!-- RECENT ACTIVITY -->
                <div class="box2">

                    <div class="boxHeader">
                        <h3>Recent Activity</h3>
                        <button>View All</button>
                    </div>

                    <ul class="activityList">
                        <li>✔ Clothes donated - 15 Jun 2026</li>
                        <li>✔ Plastic recycled - 13 Jun 2026</li>
                        <li>✔ E-Waste pickup completed - 10 Jun 2026</li>
                        <li>✔ Glass recycled - 8 Jun 2026</li>
                        <li>✔ Books donated - 6 Jun 2026</li>
                    </ul>

                </div>

                <!-- TOP CONTRIBUTORS -->
                <div class="box2">

                    <div class="boxHeader">
                        <h3>Top Contributors</h3>
                        <button>View All</button>
                    </div>

                    <ol class="contributorList">
                        <li>Ali - 520 pts</li>
                        <li>Siti - 480 pts</li>
                        <li>Ahmad - 450 pts</li>
                        <li>John - 400 pts</li>
                        <li>User - 250 pts</li>
                    </ol>

                </div>

            </div>

        </div>

    </div>

</body>

</html>