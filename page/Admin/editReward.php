<?php

session_start();

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

    $query = "
    UPDATE reward
    SET
        RewardName = '$rewardName',
        RewardPoint = '$rewardPoint',
        Stock = '$stock',
        RewardRole = '$rewardRole',
        Status = '$status'
    WHERE RewardId = '$rewardId'
    ";

    mysqli_query($conn,$query);

    header("Location: rewardAdmin.php");
    exit();
}
?>