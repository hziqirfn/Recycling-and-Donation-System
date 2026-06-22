<?php

session_start();

include("../../inc/connect.php");
include("../../inc/auth.php");

$success = "";

if (isset($_SESSION['success']))
{
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

$email = $_SESSION['email'];

$sql = "SELECT * FROM user WHERE Email='$email'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email = $_SESSION['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $sql2 = "UPDATE user SET Name = '$name', NoPhone = '$phone' WHERE Email='$email'";
    $result2 = $conn->query($sql2);

    if ($result2 === TRUE)
    {
        $_SESSION['name'] = $name;
        $_SESSION['phone'] = $phone;

        $_SESSION['success'] = "Profile updated";
        header("Location: profileAdmin.php");
        exit();
    }
}

$admin = true;
$adminId = $_SESSION['userid'];

$queryActivity = "
SELECT *
FROM activity
WHERE UserId = '$adminId'
AND ActivityType = 'Admin'
ORDER BY ActivityDate DESC
";

$resultActivity = mysqli_query($conn, $queryActivity);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../image/logo.png">

    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/admin/headerAdmin.css">
    <link rel="stylesheet" href="../../style/admin/sidebarAdmin.css">
    <link rel="stylesheet" href="../../style/admin/profileAdmin.css">
    <script src="../../js/profile.js" defer></script>

    <title>UTeM RecycleHub</title>
</head>

<body>

<?php
    $admin = true;
    include("headerAdmin.php");
    include("sidebarAdmin.php");
?>

    <label for="cb" id="overlay"></label>

    <div id="main">
        <div class="content">

            <div class="left-panel">
                <div class="gambar">
                    <img src="../../image/profile1.png" alt="Admin Profile">
                </div>  

                <h2>Admin Profile</h2>

                <p>Manage administrator information</p>
            </div>

            <div class="right-panel">

                <div class="profil">
                    <div class="top">
                        <button type="button" onclick="editbtn()" id="editBtn">Edit</button>
                    </div>

                    <form action="profileAdmin.php" method="post">

                        <label>Name</label>
                        <input type="text" name="name" class="edit" value="<?= $user['Name'] ?>" readonly>

                        <label>Email</label>
                        <input type="email" name="email" value="<?= $_SESSION['email'] ?>" readonly>

                        <label>Phone Number</label>
                        <input type="text" name="phone" class="edit" value="<?= $user['NoPhone'] ?>" placeholder="---"
                            maxlength="11" oninput="this.value=this.value.replace(/[^0-9]/g, '')" inputmode="numeric" readonly>

                        <label>Role</label>
                        <input type="text" name="role" value="<?= $_SESSION['role'] ?>" readonly>

                        <div class="bottom" id="bottomBtn">
                            <button type="submit">Save</button>
                            <button type="button" onclick="cancelbtn()" id="cancel">Cancel</button>
                        </div>
                        
                    </form>
                </div>

                <h2>Admin Activity</h2>

                <div class="profil2">
                    <?php
                    if (mysqli_num_rows($resultActivity) > 0) 
                    {
                        while ($activity = mysqli_fetch_assoc($resultActivity)) 
                        {
                    ?>
                            <div class="activity-box">
                                <?= $activity['ActivityText']; ?>-
                                <?= date('d M Y', strtotime($activity['ActivityDate'])); ?>
                            </div>
                    <?php
                        }
                    } 
                    else 
                    {
                    ?>
                        <div class="activity-box">
                            No activity found
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php
if ($success != "")
{
?>
    <div id="alert" class="alert">
        <div class="popup-box"><br>
            <p><?= $success; ?></p> <br><br>
            <button onclick="closePopup()">OK</button>
        </div>
    </div>
<?php 
} 
?>

<div id="confirmAlert" class="alert" style="display:none;">
    <div class="popup-box">
        <p id="confirmText"></p>
        <br>
        <button id="yesBtn">Yes</button>
        <button onclick="confirmClosePopup()">No</button>
    </div>
</div>

</body>

</html>