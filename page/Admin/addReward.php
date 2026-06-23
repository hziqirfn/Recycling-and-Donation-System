<?php

session_start();

include("../../inc/connect.php");
include("../../inc/auth.php");

$id = $_POST['rewardId'];
$name = $_POST['rewardName'];
$points = $_POST['pointsRequired'];
$stock = $_POST['stock'];
$status = $_POST['status'];

$query = "INSERT INTO reward_catalog(RewardId, RewardName, PointsRequired, Stock, Status)
          VALUES ('$id', '$name', '$points', '$stock', '$status')";
mysqli_query($conn,$query);

header("Location: rewardAdmin.php");

exit();

include("../../inc/connect.php");
include("../../inc/auth.php");

if(isset($_POST['rewardId']))
{
    $rewardId = $_POST['rewardId'];
    $rewardName = $_POST['rewardName'];
    $rewardPoint = $_POST['RewardPoint'];
    $stock = $_POST['stock'];
    $rewardRole = $_POST['rewardRole'];
    $status = $_POST['status'];

    $check = mysqli_query(
        $conn,
        "SELECT * FROM reward
        WHERE RewardId='$rewardId'"
    );

    if(mysqli_num_rows($check) > 0)
    {
        echo "<script>
                alert('Reward ID already exists');
                window.location='rewardAdmin.php';
              </script>";
        exit();
    }

    $query = "
    INSERT INTO reward
    (
        RewardId,
        RewardName,
        RewardPoint,
        Stock,
        RewardRole,
        Status
    )
    VALUES
    (
        '$rewardId',
        '$rewardName',
        '$rewardPoint',
        '$stock',
        '$rewardRole',
        '$status'
    )
    ";

    mysqli_query($conn,$query);

    header("Location: rewardAdmin.php");
    exit();
}
?>