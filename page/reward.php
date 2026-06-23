<?php

session_start();

include("../inc/connect.php");
include("../inc/auth.php");

$userId = $_SESSION['userid'];

$queryPoint = "
SELECT Points
FROM user
WHERE UserId = '$userId'
";

$resultPoint = mysqli_query($conn, $queryPoint);
$userData = mysqli_fetch_assoc($resultPoint);

$userPoints = $userData['Points'];

$queryRank = "
SELECT COUNT(*) + 1 AS UserRank
FROM user
WHERE Points > $userPoints
AND Role != 'Admin'
";

$resultRank = mysqli_query($conn, $queryRank);
$rankData = mysqli_fetch_assoc($resultRank);

$userRank = $rankData['UserRank'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/sidebar.css">
    <link rel="stylesheet" href="../style/reward.css">
    <link rel="stylesheet" href="../style/dashboard.css">
    <script src="../js/reward.js" defer></script>

    <title>UTeM RecycleHub</title>
</head>

<body>
    <?php include("header.php"); ?>

    <div id="main">
        <?php include("sidebar.php"); ?>

        <label for="cb" id="overlay"></label>

        <div id="content">
            <div class="rewards-container">
                <div class="rewards-title">
                    <h2>Rewards</h2>
                    <p>Track your progress and redeem amazing rewards</p>
                </div>

                <div class="rewards-stats">
                    <div class="stat-card">
                        <h2>Your Points</h2>
                        <span><?= $userPoints ?></span>
                    </div>

                    <div class="stat-card">
                        <h2>Your Rank</h2>
                        <span>#<?= $userRank ?></span>
                    </div>
                </div>

                <div class="leaderboard-card">
                    <div class="leaderboard-tabs">
                        <button id="communityBtn" class="active-tab" onclick="showCommunity()">
                            Community Leaderboard
                        </button>

                        <button id="utemBtn" onclick="showUTeM()">
                            UTeM Leaderboard
                        </button>

                        <span class="update-badge">
                            Updated Daily
                        </span>
                    </div>

                    <div class="leaderboard-list" id="communityBoard">
                        <div class="leader-item">
                            <div class="rank">#1</div>

                            <div class="leader-info">
                                <h4>Ahmad</h4>
                                <p>2500 Points</p>
                            </div>

                            <span class="point-badge">+3</span>
                        </div>

                        <div class="leader-item">
                            <div class="rank">#2</div>

                            <div class="leader-info">
                                <h4>Siti</h4>
                                <p>2200 Points</p>
                            </div>

                            <span class="point-badge">+3</span>
                        </div>

                        <div class="leader-item">
                            <div class="rank">#3</div>

                            <div class="leader-info">
                                <h4>Jason</h4>
                                <p>2000 Points</p>
                            </div>

                            <span class="point-badge">+3</span>
                        </div>
                    </div>

                    <div class="leaderboard-list" id="utemBoard">
                        <div class="leader-item">
                            <div class="rank">#1</div>

                            <div class="leader-info">
                                <h4>Ali UTeM</h4>
                                <p>1800 Points</p>
                            </div>

                            <span class="point-badge">+3</span>
                        </div>

                        <div class="leader-item">
                            <div class="rank">#2</div>

                            <div class="leader-info">
                                <h4>Aina UTeM</h4>
                                <p>1600 Points</p>
                            </div>

                            <span class="point-badge">+3</span>
                        </div>

                        <div class="leader-item">
                            <div class="rank">#3</div>

                            <div class="leader-info">
                                <h4>Hakim UTeM</h4>
                                <p>1500 Points</p>
                            </div>

                            <span class="point-badge">+3</span>
                        </div>
                    </div>
                </div>

                <div class="available-rewards">
                    <h2>Available Rewards</h2>

                    <div class="reward-grid">
                        <div class="reward-card">
                            <span class="reward-points">100 pts</span>

                            <h4>Food Voucher</h4>
                            <button class="redeem-btn" data-reward="Food Voucher">
                                Redeem Now
                            </button>
                        </div>

                        <div class="reward-card">
                            <span class="reward-points">150 pts</span>

                            <h4>Grab Voucher</h4>
                            <button class="redeem-btn" data-reward="Grab Voucher">
                                Redeem Now
                            </button>
                        </div>

                        <div class="reward-card">
                            <span class="reward-points">200 pts</span>

                            <h4>UTeM Merchandise</h4>
                            <button class="redeem-btn" data-reward="UTeM Merchandise">
                                Redeem Now
                            </button>
                        </div>

                        <div class="reward-card">
                            <span class="reward-points">300 pts</span>

                            <h4>Cash Voucher</h4>
                            <button class="redeem-btn" data-reward="Cash Voucher">
                                Redeem Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="redeemPopup" class="popup">
        <div class="popup-content">
            <h2>✅ Success</h2>
            <p id="rewardText">
                Reward Redeemed Successfully!
            </p>

            <button onclick="closePopup()">
                OK
            </button>
        </div>
    </div>

</body>

</html>