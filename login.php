<?php ini_set('display_errors', 0); ?>
<?php
session_start();
require_once 'config.php';
require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($conn);
    $result = $user->login($username, $password);

    if ($result) {
        // Login successful, store user ID and username in session
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['username'] = $username;
        // Redirect to diary page
        header("Location: diary.php");
        exit;
    } else {
        $login_error = "Invalid username or password.";
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
<body>
    <nav class="navbar">
        <div class="logo-container">
            <img src="diwa/logos/4.png" alt="Diwa Logo">
        </div>
        <button onclick="location.href='register.php'">
            REGISTER
        </button>
    </nav>
    <div class="container">
        <img src="diwa/logos/3.png" alt="Diwa Logo">
        <p class="app-desc"> Embrace Life's Journey, One Entry at a Time!</p>
        <?php if (isset($login_error)) : ?>
            <script>alert('<?php echo $login_error; ?>');</script>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Enter Username" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="submit" value="LOGIN">
        </form>
        <p class="register">
            Don't have an account? 
            <br>
            <a href="register.php" class="create-link">Create Account</a>
        </p>
    </div>
    <script src="scripts/login.js"></script>
</body>
</html>
