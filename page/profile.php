<?php
session_start();

include("../inc/connect.php");
include("../inc/auth.php");

$success = "";

if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

$sql = "SELECT * FROM user WHERE Email='$email'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $sql2 = "UPDATE user SET Name = '$name', NoPhone = '$phone' WHERE Email='$email'";
    $result2 = $conn->query($sql2);

    if ($result2 === TRUE) {
        $_SESSION['name'] = $name;
        $_SESSION['phone'] = $phone;

        $_SESSION['success'] = "Profile updated";
        header("Location: profile.php");
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/sidebar.css">
    <link rel="stylesheet" href="../style/profile.css">
    <script src="../js/profile.js" defer></script>
    <title>UTeM RecycleHub</title>
</head>

<body>
<?php 
    include("header.php");
    include("sidebar.php"); 
?>

    <label for="cb" id="overlay"></label>

    <div id="main">
        <div class="content">

            <div class="left-panel">
                <div class="gambar">
                    <img src="../image/profile1.png" alt="Profile">
                </div>

                <h2>Profile</h2>
                <p>Manage your personal information</p>
            </div>

            <div class="right-panel">
                <div class="profil">
                    <div class="top">
                        <button type="button" onclick="editbtn()" id="editBtn">Edit</button>
                    </div>

                    <form action="profile.php" method="post">
                        <label>Name</label>
                        <input type="text" name="name" class="edit" value="<?= $user['Name'] ?>" readonly>

                        <label>Email</label>
                        <input type="email" name="email" value="<?= $_SESSION['email'] ?>" readonly>

                        <label>Phone Number</label>
                        <input type="text" name="phone" class="edit" value="<?= $user['NoPhone'] ?>" placeholder="---"
                            maxlength="11" oninput="this.value=this.value.replace(/[^0-9]/g, '')" inputmode="numeric" readonly>

                        <label>Role</label>
                        <input type="text" name="role" id="role" value="<?= $_SESSION['role'] ?>" readonly>

                        <div class="bottom" id="bottomBtn">
                            <button type="submit">Save</button>
                            <button type="button" onclick="cancelbtn()" id="cancel">Cancel</button>
                        </div>
                    </form>
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