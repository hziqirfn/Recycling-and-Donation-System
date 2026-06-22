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
            $_SESSION['email'] = $user['Email'];
            $_SESSION['name'] = $user['Name'];
            $_SESSION['role'] = $user['Role'];
            $_SESSION['userid'] = $user['UserId'];
            $_SESSION['success'] = "Login successful...Redirecting";

            if ($email == "admin@utem.edu.my" && $user['Role'] == "Admin")
            {
                $_SESSION['redirect'] = "../page/admin/dashboardAdmin.php";
            }
            else
            {
                $_SESSION['redirect'] = "dashboard.php";
            }
            header("Location: login.php");
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
    <link rel="icon" type="image/png" href="../image/logo.png">

    <link rel="stylesheet" href="../style/login.css">
    <link rel="stylesheet" href="../style/global.css">
    <title>UTeM RecycleHub</title>
</head>

<body>

    <div id="head">
        <div class="side">
            <div class="logo">
                <img src="../image/logo.png" alt="logo">
            </div>

            <div class="text">
                <h2>UTeM RecycleHub</h2>
                <p>Recycling & Donation</p>
            </div>
        </div>
    </div>

    <main class="login-page">
        <section class="login-card">
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
            <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p> <br><br>
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
            <p><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?></p> <br><br>
        </div>
    </div>
    
    <script>
        setTimeout(() =>
        {
            window.location.href = "<?= htmlspecialchars($_SESSION['redirect'], ENT_QUOTES, 'UTF-8'); ?>";
        }, 2000);
    </script>
<?php 
    unset($_SESSION['redirect']); 
}
?>

<script>
    function closePopup()
    {
        document.getElementById('alert').style.display = 'none';
    }
</script>

</body>
</html>