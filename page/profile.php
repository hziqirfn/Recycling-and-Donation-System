<?php
session_start();

include("../inc/connect.php");

if (!isset($_SESSION['userid']))
{
    header("Location login.php");
    exit();
}


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
    <script src="../js/dashboard.js" defer></script>
    <title>UTeM RecycleHub</title>
</head>

<body>
    <?php include("header.php"); ?>

    <div id="main">
        <?php include("sidebar.php"); ?>

        <label for="cb" id="overlay"></label>

        <div class="content">
            <div class="left-panel">
                <div class="gambar">
                    <img src="../image/profile.png" alt="Profile">
                </div>

                <h2>Profile</h2>
                <p>Manage your personal informations</p>
            </div>

            <div class="right-panel">
                <div class="profil">
                    <div class="top">
                        <button type="button" onclick="editbtn()" id="editBtn">Edit</button>
                    </div>

                    <form action="profile.php" method="post">
                        <label>Name</label>
                        <input type="text" name="name" class="edit" value="<?= $_SESSION['name'] ?>" readonly>

                        <label>Email</label>
                        <input type="email" name="email" class="edit" value="<?= $_SESSION['email'] ?>" readonly>

                        <label>Phone Number</label>
                        <input type="text" name="phone" class="edit" value="<?= $_SESSION['phone'] ?? '---' ?>" maxlength="11" oninput="this.value=this.value.replace(/[^0-9]/g, '')" inputmode="numeric" readonly>

                        <label>Address</label>
                        <textarea name="address" class="edit" readonly></textarea>

                        <div class="bottom" id="bottomBtn">
                            <button type="submit">Save</button>
                            <button type="reset">Cancel</button>
                        </div>
                    </form>
                </div>

                <h2>Recent Activity</h2>
                <div class="profil2">
                    <div class="activity-box">
                        Plastic recycled - 5 Jun 2026
                    </div>

                    <div class="activity-box">
                        Books donated - 7 Jun 2026
                    </div>

                    <div class="activity-box">
                        E-Waste pickup completed - 10 Jun 2026
                    </div>

                    <div class="activity-box">
                        Glass recycled - 13 Jun 2026
                    </div>

                    <div class="activity-box">
                        Clothes donated - 15 Jun 2026
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>