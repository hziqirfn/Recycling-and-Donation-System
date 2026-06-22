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

    if ($result->num_rows != 1)
    {
        $_SESSION['error'] = "Email not exist";
        header("Location: resetPassword.php");
        exit();
    }
    else
    {
        if ($password != $_POST['confPassword'])
        {
            $_SESSION['error'] = "Password not match";
            header("Location: resetPassword.php");
            exit();
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql2 = "UPDATE user SET Password = '$hash' WHERE Email='$email'";
        $result2 = $conn->query($sql2);

        if ($result2 === TRUE)
        {
            $_SESSION['success'] = "Password reset successful";
            header("Location: resetPassword.php");
            exit();
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTeM RecycleHub</title>
    <link rel="stylesheet" href="../style/resetPassword.css">
    <link rel="stylesheet" href="../style/global.css">
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

    <div class="reset-container">
        <div class="reset-card">
            <h1>Reset Password</h1>

            <form id="resetForm" action="resetPassword.php" method="post">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="abc@email.com" required>

                <label for="password">New Password</label>
                <input type="password" name="password" placeholder="New Password" required>

                <label for="confPassword">Confirm Password</label>
                <input type="password" name="confPassword" placeholder="Re-Type New Password" required>

                <button type="submit">Reset Password</button>
            </form>
        </div>
    </div>

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

if ($success != "")
{
?>
    <div id="alert" class="alert">
        <div class="popup-box"><br>
            <p><?= $success; ?></p> <br><br>
        </div>
    </div>

    <script>
        setTimeout(function () 
        {
            window.location.href = "login.php";
        }, 2000);
    </script>
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
</html>