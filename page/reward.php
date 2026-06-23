<?php

session_start();

include("../inc/connect.php");
include("../inc/auth.php");

$userId = $_SESSION['userid'];

$queryPoint = "SELECT Points FROM user WHERE UserId = '$userId'";
$resultPoint = mysqli_query($conn, $queryPoint);
$userData = mysqli_fetch_assoc($resultPoint);
$userPoints = $userData['Points'] ?? 0;

/* Rank user ikut semua user bukan admin */
$queryRank = "
SELECT COUNT(*) + 1 AS UserRank
FROM user
WHERE Points > $userPoints
AND Role != 'Admin'
";
$resultRank = mysqli_query($conn, $queryRank);
$rankData = mysqli_fetch_assoc($resultRank);
$userRank = $rankData['UserRank'];

$resultUser = mysqli_query($conn, $queryUser);

$user = mysqli_fetch_assoc($resultUser);

$userPoints = $user['Points'];

$queryReward = "
SELECT *
FROM reward
WHERE Status='Active'
AND Stock > 0
ORDER BY RewardPoint ASC
";
$resultCommunity = mysqli_query($conn, $queryCommunity);

$resultReward = mysqli_query($conn, $queryReward);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../image/logo.png">

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
                        <?php
                        $rank = 1;
                        while ($row = mysqli_fetch_assoc($resultCommunity)) {
                        ?>
                            <div class="leader-item">
                                <div class="rank">#<?= $rank ?></div>

                                <div class="leader-info">
                                    <h4><?= $row['Name'] ?></h4>
                                    <p><?= $row['Points'] ?> Points</p>
                                </div>
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
                        <?php
                            $rank++;
                        }
                        ?>
                    </div>
                </div>

                <div class="available-rewards">
                    <h2>Available Rewards</h2>

                    <div class="reward-grid">
                        <?php

                        if (mysqli_num_rows($resultReward) > 0) {
                            while ($row = mysqli_fetch_assoc($resultReward)) {
                        ?>

                                <div class="reward-card">

                                    <div class="reward-icon">
                                        🎁
                                    </div>

                                    <h3>
                                        <?= $row['RewardName']; ?>
                                    </h3>

                                    <p>
                                        Required Points:
                                        <?= $row['RewardPoint']; ?>
                                    </p>

                                    <p>
                                        Stock:
                                        <?= $row['Stock']; ?>
                                    </p>

                                    <form action="redeemReward.php" method="POST">
                                        <input type="hidden" name="rewardId" value="<?= $row['RewardId']; ?>">

                                        <button type="submit" class="redeem-btn">
                                            Redeem
                                        </button>
                                    </form>

                                </div>

                            <?php
                            }
                        } else {
                            ?>

                            <div class="empty-state">

                                <h3>No Reward Available</h3>

                                <p>
                                    Please check again later.
                                </p>

                            </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['redeem_status'])) { ?>

        <div id="redeemPopup" class="popup" style="display:flex;">
            <div class="popup-content">

                <?php if ($_SESSION['redeem_status'] == "success") { ?>
                    <h2>✅ Success</h2>
                <?php } else { ?>
                    <h2>❌ Not Successful</h2>
                <?php } ?>

                <p>
                    <?= $_SESSION['redeem_message']; ?>
                </p>

                <button onclick="closePopup()">
                    OK
                </button>
            </div>
        </div>

    <?php
        unset($_SESSION['redeem_status']);
        unset($_SESSION['redeem_message']);
    }
    ?>

</body>

</html>