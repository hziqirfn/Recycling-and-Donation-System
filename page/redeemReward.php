<?php

session_start();

include("../inc/connect.php");
include("../inc/auth.php");

$userId = $_SESSION['userid'];
$rewardId = $_POST['rewardId'];

$queryReward = "
SELECT *
FROM reward
WHERE RewardId='$rewardId'
AND Status='Active'
AND Stock > 0
";

$resultReward = mysqli_query($conn, $queryReward);
$reward = mysqli_fetch_assoc($resultReward);

if (!$reward) {
    $_SESSION['redeem_status'] = "failed";
    $_SESSION['redeem_message'] = "Reward not available.";
    header("Location: reward.php");
    exit();
}

$queryUser = "
SELECT Points
FROM user
WHERE UserId='$userId'
";

$resultUser = mysqli_query($conn, $queryUser);
$user = mysqli_fetch_assoc($resultUser);

$userPoints = $user['Points'];
$rewardPoint = $reward['RewardPoint'];

if ($userPoints < $rewardPoint) {
    $_SESSION['redeem_status'] = "failed";
    $_SESSION['redeem_message'] = "Not enough points to redeem this reward.";
    header("Location: reward.php");
    exit();
}

$newPoints = $userPoints - $rewardPoint;

mysqli_query($conn, "
UPDATE user
SET Points='$newPoints'
WHERE UserId='$userId'
");

mysqli_query($conn, "
UPDATE reward
SET Stock = Stock - 1
WHERE RewardId='$rewardId'
");

$_SESSION['redeem_status'] = "success";
$_SESSION['redeem_message'] = $reward['RewardName'] . " redeemed successfully!";

header("Location: reward.php");
exit();

?>