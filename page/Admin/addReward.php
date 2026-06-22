<?php

session_start();

include("../../inc/connect.php");
include("../../inc/auth.php");

$error = "";

if (isset($_SESSION['error']))
{
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

if(isset($_POST['rewardId']))
{
    $rewardId = $_POST['rewardId'];
    $rewardName = $_POST['rewardName'];
    $rewardPoint = $_POST['RewardPoint'];
    $stock = $_POST['stock'];
    $rewardRole = $_POST['rewardRole'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("SELECT * FROM reward WHERE RewardId = ?");
    $stmt->bind_param("s", $rewardId);
    $stmt->execute();
    $check = $stmt->get_result();

    if(mysqli_num_rows($check) > 0)
    {
        $_SESSION['error'] = "Reward ID already exists";
        header("Location: rewardAdmin.php");
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

<!DOCTYPE html>
<html>
<body>
    <?php 
if ($error != "")
{
?>
<div id="alert" class="alert">
    <div class="popup-box"><br>
        <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
        <br><br>
        <button onclick="closePopup()">OK</button>
    </div>
</div>
<?php 
}

if ($success != "")
{
?>
<div id="alert" class="alert">
    <div class="popup-box"><br>
        <p><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?></p>
        <br><br>
        <button onclick="closePopup()">OK</button>
    </div>
</div>
<?php 
}
?>

<script>
function closePopup()
{
    document.getElementById('alert').style.display = 'none';
}
</script>

</body>