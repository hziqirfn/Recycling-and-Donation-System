<?php

include("../../inc/connect.php");

$id = $_POST['rewardId'];

$name = $_POST['rewardName'];

$points = $_POST['pointsRequired'];

$stock = $_POST['stock'];

$status = $_POST['status'];

$query = "

INSERT INTO reward_catalog

(
RewardId,
RewardName,
PointsRequired,
Stock,
Status
)

VALUES

(
'$id',
'$name',
'$points',
'$stock',
'$status'
)

";

mysqli_query($conn,$query);

header("Location: rewardAdmin.php");

exit();

?>