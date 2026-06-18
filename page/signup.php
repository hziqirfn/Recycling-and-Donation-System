<?php

session_start();

include("../inc/connect.php");

$error = "";

if (isset($_SESSION['error']))
{
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($password != $_POST['confPassword'])
    {
        $_SESSION['error'] = "Password not match";
        header("Location: signup.php");
        exit();
    }
    else 
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        $prefix = "PBC-";
        $role = "Public";
        if (str_ends_with($email, '@student.utem.edu.my'))
        {
            $prefix = "STD-";
            $role = "Student";
        }
        else if (str_ends_with($email, '@utem.edu.my'))
        {
            $prefix = "STF-";
            $role = "Staff";
        }
        else if (str_ends_with($email, '@admin.com'))
        {
            $prefix = "ADM-";
            $role = "Admin";
        }

        $sql = "SELECT UserId FROM user WHERE UserId 
                LIKE '$prefix%' ORDER BY CAST(SUBSTRING(UserId, " .(strlen($prefix) + 1). ") AS UNSIGNED) 
                DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $lastNum = (int) preg_replace('/[^0-9]/', '', $row['UserId']);
            $userId = $prefix . ($lastNum + 1);
        }
        else 
        {
            $userId = $prefix . "1";
        }

        $sql2 = "INSERT INTO user(UserId, Email, Name, Password, Role) VALUES ('$userId', '$email', '$username', '$hash', '$role')";
        $result2 = $conn->query($sql2);

        if ($result2 === TRUE)
        {
            $_SESSION['error'] = "Register successful";
            header("Location: login.php");
            exit();
        }
        else
        {
            $_SESSION['error'] = "Register failed";
            header("Location: signup.php");
            exit();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTeM RecycleHub</title>
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
                Welcome! Please create your account to get started.
            </p>

            <form action="signup.php" method="post" id="signupForm">

                <label for="email">Email</label>
                <input type="email" name="email" placeholder="abc@email.com" required>

                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Username" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>

                <label for="confPassword">Confirm Password</label>
                <input type="password" name="confPassword" placeholder="Re-Type Password" required>

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
?>
</body>

<script>
    function closePopup()
    {
        document.getElementById('alert').style.display = 'none';
    }
</script>

</html>