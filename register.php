<?php ini_set('display_errors', 0); ?>
<?php
require_once 'config.php';
require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($conn);
    $result = $user->register($username, $password);

    if ($result) {
        // Registration successful, redirect to login page
        echo "<script>alert('User Registered Succesfully, Welcome to DIWA'); setTimeout(function() { window.location.href = 'login.php'; }, 100);</script>";
        exit;
    } else {
        // Registration failed
        echo "Registration failed!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body class="registration-page">
    <nav class="navbar">
        <div class="logo-container">
            <a href="login.php">
                <img src="diwa/logos/4.png" alt="Diwa Logo">
             </a>
        </div>
        <button onclick="location.href='login.php'">
            LOGIN
        </button>
    </nav>
    <div class="container">
        <img src="diwa/logos/3.png" alt="Diwa Logo">
        <p class="app-desc">Embrace Life's Journey, One Entry at a Time!</p>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Enter Username" required>
            <input class="p1" type="password" name="password" placeholder="Enter Password" required>
            <input class="p2" type="password" name="confirm_password" placeholder="Re-enter Password" required>
            <input type="submit" value="REGISTER">
        </form>
        <p class="register">
            Already have an account? 
            <br>
            <a href="login.php" class="create-link">LOGIN</a>
        </p>
    </div>
    <script src="scripts/register.js"></script>
</body>
</html>
