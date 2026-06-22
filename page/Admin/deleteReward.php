<?php

session_start();

include("../../inc/connect.php");
include("../../inc/auth.php");

$id = $_GET['id'];

$query = "

DELETE FROM reward_catalog

WHERE RewardId='$id'

";

mysqli_query($conn,$query);

header("Location: rewardAdmin.php");

exit();

?>