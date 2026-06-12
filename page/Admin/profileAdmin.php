<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/admin/headerAdmin.css">
    <link rel="stylesheet" href="../../style/sidebar.css">
    <link rel="stylesheet" href="../../style/admin/profileAdmin.css">

    <script src="../../js/profile.js" defer></script>

    <title>Admin Profile</title>
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
                    <img src="../../image/profile.png" alt="Admin Profile">
                </div>

                <h2>Admin Profile</h2>

                <p>Manage administrator account information</p>

            </div>

            <div class="right-panel">

                <div class="profil">

                    <div class="top">
                        <button type="button" id="editBtn">Edit</button>
                    </div>

                    <form action="" method="post">

                        <label>Admin ID</label>
                        <input type="text" name="adminID" value="ADM001" readonly>

                        <label>Full Name</label>
                        <input type="text" name="name" value="Admin User">

                        <label>Email</label>
                        <input type="email" name="email" value="admin@utem.edu.my">

                        <label>Phone Number</label>
                        <input type="text" name="phone" value="0123456789">

                        <label>Role</label>
                        <input type="text" name="role" value="Administrator" readonly>

                        <label>Last Login</label>
                        <input type="text" value="10 Jun 2026 10:30 PM" readonly>

                        <div class="bottom" id="bottomBtn">
                            <button type="submit">Save</button>
                            <button type="reset">Cancel</button>
                        </div>

                    </form>

                </div>

                <h2>Admin Activity</h2>

                <div class="profil2">

                    <div class="activity-box">
                        Approved pickup request - 5 Jun 2026
                    </div>

                    <div class="activity-box">
                        Added new reward item - 7 Jun 2026
                    </div>

                    <div class="activity-box">
                        Updated item category - 8 Jun 2026
                    </div>

                    <div class="activity-box">
                        Managed user account - 9 Jun 2026
                    </div>

                    <div class="activity-box">
                        Approved reward redemption - 10 Jun 2026
                    </div>

                    <div class="admin-stats">

                        <div class="stat">
                            <h3>150</h3>
                            <p>Users</p>
                        </div>

                        <div class="stat">
                            <h3>85</h3>
                            <p>Items</p>
                        </div>

                        <div class="stat">
                            <h3>32</h3>
                            <p>Pickups</p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>