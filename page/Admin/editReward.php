<?php

session_start();

include("../../inc/connect.php");
include("../../inc/auth.php");

$id = $_POST['rewardId'];

$name = $_POST['rewardName'];

$points = $_POST['pointsRequired'];

$stock = $_POST['stock'];

$status = $_POST['status'];

$query = "

UPDATE reward_catalog

SET

RewardName='$name',
PointsRequired='$points',
Stock='$stock',
Status='$status'

WHERE RewardId='$id'

";

mysqli_query($conn,$query);

header("Location: rewardAdmin.php");

exit();

?>