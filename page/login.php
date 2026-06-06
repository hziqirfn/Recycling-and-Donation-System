<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Login - UTeM RecycleHub</title>
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

            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>

                <div class="login-footer">
                    <a href="#">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">Login</button>
            </form>

            <p class="register-link"><a href="#">Register new account</a></p>
        </section>
    </main>
</body>
</html>