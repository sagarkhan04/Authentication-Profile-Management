<?php
session_start();
include('./config/db.php'); // Database connection

// Get POST data
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Validation
if (!$email) {
    $_SESSION['email_error'] = "Please enter your email";
    header("Location: login.php");
    exit;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['email_error'] = "Invalid email format";
    header("Location: login.php");
    exit;
}

if (!$password) {
    $_SESSION['pass_error'] = "Please enter your password";
    header("Location: login.php");
    exit;
}

// Check if email exists
$stmt = $db_connect->prepare("SELECT id, name, email, password FROM users WHERE email=? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        // Password correct, create session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];

        $_SESSION['login_success'] = "Login successful!";
        header("Location: dashboard.php");
        exit;
    } else {
        $_SESSION['login_error'] = "Incorrect password";
        header("Location: login.php");
        exit;
    }
} else {
    $_SESSION['login_error'] = "Email not found";
    header("Location: login.php");
    exit;
}


$_SESSION = [];

// Destroy the session
session_destroy();

// Delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect to login page
header("Location: login.php");
exit;
?>