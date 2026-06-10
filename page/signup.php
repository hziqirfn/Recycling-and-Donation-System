<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../style/signup.css">
</head>
<body>

<header class="header">

    <div class="logo-section">

        <img src="../image/logo.png" alt="Logo">

        <div>
            <h2>UTeM RecycleHub</h2>
            <p>Recycling & Donation</p>
        </div>

    </div>

</header>

<div class="signup-wrapper">

    <div class="signup-left">

        <h1>Sign Up</h1>

        <p>
            Welcome! Please create your account
            <br>
            to get started
        </p>

        <form action="dashboard.php" method="POST">

            <label>Email</label>
            <input type="email" placeholder="Email">

            <label>Username</label>
            <input type="text" placeholder="Username">

            <label>Password</label>
            <input type="password" placeholder="Password">

            <button type="submit">
                Sign Up
            </button>

        </form>

    </div>

    <div class="signup-right">

        <div class="logo-card">

            <img src="../image/logo.png" alt="Logo">

            <h2>UTeM RecycleHub</h2>

        </div>

    </div>

</div>

</body>
</html>