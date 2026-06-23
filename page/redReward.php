<?php

session_start();

include("../inc/connect.php");
include("../inc/auth.php");

$userId = $_SESSION['userid'];

$queryUserRole = "
SELECT Role
FROM user
WHERE UserId = '$userId'
";

$resultUserRole = mysqli_query($conn, $queryUserRole);
$user = mysqli_fetch_assoc($resultUserRole);

if (!$user) {
    $_SESSION['redeem_status'] = "error";
    $_SESSION['redeem_message'] = "User not found.";
    header("Location: reward.php");
    exit();
}

$userRole = $user['Role'];

$queryReward = "
SELECT *
FROM reward
WHERE Stock > 0
AND (
    RewardRole = 'Public'
    OR RewardRole = '$userRole'
    OR (
        RewardRole = 'UTeM'
        AND (
            '$userRole' = 'Student(UTeM)'
            OR '$userRole' = 'Staff(UTeM)'
        )
    )
)
ORDER BY RewardPoint ASC
LIMIT 1
";

$resultReward = mysqli_query($conn, $queryReward);
$reward = mysqli_fetch_assoc($resultReward);

if (!$reward) {
    $_SESSION['redeem_status'] = "error";
    $_SESSION['redeem_message'] = "No reward available for your role.";
    header("Location: reward.php");
    exit();
}

$rewardId = $reward['RewardId'];
$requiredPoint = $reward['RewardPoint'];
$stock = $reward['Stock'];
$rewardName = $reward['RewardName'];

$queryPoints = "
SELECT Points
FROM user
WHERE UserId = '$userId'
";

$resultPoints = mysqli_query($conn, $queryPoints);
$userData = mysqli_fetch_assoc($resultPoints);

$userPoint = $userData['Points'];

if ($stock <= 0) {
    $_SESSION['redeem_status'] = "error";
    $_SESSION['redeem_message'] = "Reward is out of stock.";
    header("Location: reward.php");
    exit();
}

if ($userPoint < $requiredPoint) {
    $_SESSION['redeem_status'] = "error";
    $_SESSION['redeem_message'] = "Insufficient points.";
    header("Location: reward.php");
    exit();
}

mysqli_query($conn, "
UPDATE user
SET Points = Points - $requiredPoint
WHERE UserId = '$userId'
");

mysqli_query($conn, "
UPDATE reward
SET Stock = Stock - 1
WHERE RewardId = '$rewardId'
");

mysqli_query($conn, "
INSERT INTO user_reward (UserId, RewardId)
VALUES ('$userId', '$rewardId')
");

mysqli_query($conn, "
INSERT INTO activity
(
    UserId,
    ActivityText,
    ActivityType
)
VALUES
(
    '$userId',
    'Redeemed reward $rewardName',
    'User'
)
");

$_SESSION['redeem_status'] = "success";
$_SESSION['redeem_message'] = "Reward redeemed successfully.";

header("Location: reward.php");
exit();

?>