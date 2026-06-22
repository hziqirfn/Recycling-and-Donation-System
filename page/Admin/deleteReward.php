<?php

include("../../inc/connect.php");

$id = $_GET['id'];

$query = "

DELETE FROM reward_catalog

WHERE RewardId='$id'

";

mysqli_query($conn,$query);

header("Location: rewardAdmin.php");

exit();

?>