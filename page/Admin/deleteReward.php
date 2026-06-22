<?php

session_start();

include("../../inc/connect.php");
include("../../inc/auth.php");

if(isset($_GET['id']))
{
    $rewardId = $_GET['id'];

    $query = "
    DELETE FROM reward
    WHERE RewardId = '$rewardId'
    ";

    mysqli_query($conn,$query);

    header("Location: rewardAdmin.php");
    exit();
}
?>