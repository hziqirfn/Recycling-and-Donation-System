<?php

session_start();

include("../../inc/connect.php");
include("../../inc/auth.php");

$donate = $_POST['donate'];
$recycle = $_POST['recycle'];

mysqli_query(
    $conn,
    "UPDATE point_configure
     SET PointConfigure='$donate'
     WHERE ActivityType='Donate'"
);

mysqli_query(
    $conn,
    "UPDATE point_configure
     SET PointConfigure='$recycle'
     WHERE ActivityType='Recycle'"
);

header("Location: rewardAdmin.php");
exit();

?>
