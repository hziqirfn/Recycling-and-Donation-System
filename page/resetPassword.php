<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTeM RecycleHub</title>
    <link rel="stylesheet" href="../style/resetPassword.css">
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

    <div class="reset-container">

        <div class="reset-card">

            <img src="../image/logo.png" alt="Logo" class="reset-logo">

            <h1>Reset Password</h1>

            <form id="resetForm">

                <label>Email</label>
                <input type="email" placeholder="abc@email.com" required>

                <label>New Password</label>
                <input type="password" placeholder="New Password" required>

                <button type="submit">
                    Reset Password
                </button>

            </form>

        </div>

    </div>

    <script>
        document.getElementById("resetForm").addEventListener("submit", function(e) {

            e.preventDefault();

            alert("Password berjaya ditukar!");

            window.location.href = "login.php";

        });
    </script>

</body>

</html>