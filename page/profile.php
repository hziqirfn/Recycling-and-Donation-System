<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/profile.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/sidebar.css">
    <link rel="stylesheet" href="../style/global.css">
    <script src="../js/profile.js" defer></script>
    <script src="../js/dashboard.js" defer></script>
    <title>UTeM RecycleHub</title>
</head>

<body>
    <?php include("header.php"); ?>

    <div id="main">
        <?php include("sidebar.php"); ?>

        <div class="content">
            <div class="gambar">
                <img src="../image/profile.png" alt="profile">
            </div>

            <div>
                <div class="content">
                    <h2>Profile</h2>
                    <div class="profil">
                        <div class="top">
                            <button type="button" id="editBtn">Edit</button>
                        </div>

                        <form action="" method="post">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name">

                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">

                            <label for="phone">Phone Number</label>
                            <input type="number" name="phone" id="phone">

                            <label for="address">Address</label>
                            <textarea name="address" id="address"></textarea><br>

                            <div class="bottom" id="bottomBtn">
                                <button type="submit">Save</button>
                                <button type="reset">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="content">
                    <h2>Recent Activity</h2>
                    <div class="profil2">

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>