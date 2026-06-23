<?php

session_start();

include("../../inc/connect.php");
include("../../inc/auth.php");

$id = $_GET['id'];

$sql = "DELETE FROM reward
        WHERE RewardId='$id'";

if(mysqli_query($conn, $sql))
{
    $_SESSION['delete_status'] = "success";
    $_SESSION['delete_message'] = "Reward deleted successfully!";
}
else
{
    $_SESSION['delete_status'] = "failed";
    $_SESSION['delete_message'] = "Failed to delete reward!";
}

header("Location: rewardAdmin.php");
exit();

?>