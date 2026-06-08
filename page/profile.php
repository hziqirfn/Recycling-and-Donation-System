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

        <div class="content">

            <!-- LEFT SIDE -->
            <div class="left-panel">

                <div class="gambar">
                    <img src="../image/profile.png" alt="Profile">
                </div>

                <h2>Profile</h2>

                <p>Manage your personal informations</p>

            </div>

            <!-- RIGHT SIDE -->
            <div class="right-panel">

                <!-- PROFILE DETAILS -->
                <div class="profil">

                    <div class="top">
                        <button type="button" id="editBtn">Edit</button>
                    </div>

                    <form action="" method="post">

                        <label>Name</label>
                        <input type="text" name="name">

                        <label>Email</label>
                        <input type="email" name="email">

                        <label>Phone Number</label>
                        <input type="text" name="phone">

                        <label>Address</label>
                        <textarea name="address"></textarea>

                        <div class="bottom" id="bottomBtn">
                            <button type="submit">Save</button>
                            <button type="reset">Cancel</button>
                        </div>

                    </form>

                </div>

                <!-- RECENT ACTIVITY -->
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