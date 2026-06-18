<?php

session_start();

include("../inc/connect.php");

$error = "";
$success = "";

if (isset($_SESSION['error']))
{
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

if (isset($_SESSION['success']))
{
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1)
    {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['Password']))
        {
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "Login successful...Redirecting";
            header("Location: login.php?success=1");
            exit();
        }
        else
        {
            $_SESSION['error'] = "Password is wrong";
            header("Location: login.php");
            exit();
        }
    }
    else
    {
        $_SESSION['error'] = "Email not exist";
        header("Location: login.php");
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>UTeM RecycleHub</title>
    <link rel="stylesheet" href="../style/login.css">
</head>

<body>

    <header class="header">
        <div class="logo-section">
            <div class="logo-box">
                <img src="../image/logo.png" alt="Logo">
            </div>

            <div class="logo-text">
                <h2>UTeM RecycleHub</h2>
                <p>Recycling & Donation</p>
            </div>
        </div>
    </header>

    <main class="login-page">
        <section class="login-card">
            <div class="login-card-icon">
                <img src="../image/logo.png" alt="Login icon">
            </div>
            <h1>Login</h1>
            <p class="login-subtitle">Sign in to your account</p>

            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="abc@email.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>

                <div class="login-footer">
                    <a href="resetPassword.php">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">Login</button>
            </form>

            <p class="register-link"><a href="signup.php">Register new account</a></p>
        </section>
    </main>

<?php 
if ($error != "")
{
?>
    <div id="alert" class="alert">
        <div class="popup-box"><br>
            <p><?= $error; ?></p> <br><br>
            <button onclick="closePopup()">OK</button>
        </div>
    </div>
<?php 
}
else if ($success != "")
{
?>
    <div id="alert" class="alert">
        <div class="popup-box"><br>
            <p><?= $success; ?></p> <br><br>
        </div>
    </div>
</body>
<?php 
}

if (isset($_GET['success']))
{
?>
    <script>
        setTimeout(function () 
        {
            window.location.href = "dashboard.php";
        }, 2000);
    </script>
<?php
}
else
{
?>
    <script>
        function closePopup()
        {
            document.getElementById('alert').style.display = 'none';
        }
    </script>

<?php
}
?>

</html>