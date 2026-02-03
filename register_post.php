<?php
session_start();
include('./config/db.php');

// Get POST data
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$terms = isset($_POST['terms']) ? true : false;

// Validation
if (!$name) {
    $_SESSION['name_error'] = "Please enter your full name";
    header("Location: registration.php");
    exit;
}

if (!$email) {
    $_SESSION['email_error'] = "Please enter your email";
    header("Location: registration.php");
    exit;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['email_error'] = "Invalid email format";
    header("Location: registration.php");
    exit;
}

if (!$password) {
    $_SESSION['pass_error'] = "Please enter your password";
    header("Location: registration.php");
    exit;
} elseif (strlen($password) < 6) {
    $_SESSION['pass_error'] = "Password must be at least 6 characters";
    header("Location: registration.php");
    exit;
}

if (!$confirm_password) {
    $_SESSION['cn_password_error'] = "Please confirm your password";
    header("Location: registration.php");
    exit;
} elseif ($password != $confirm_password) {
    $_SESSION['cn_password_error'] = "Password and confirm password do not match";
    header("Location: registration.php");
    exit;
}

if (!$terms) {
    $_SESSION['terms_error'] = "You must agree to terms and conditions";
    header("Location: registration.php");
    exit;
}

// Check if email exists
$stmt = $db_connect->prepare("SELECT COUNT(*) AS count FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
    $_SESSION['registration_error'] = "Email already registered";
    header("Location: registration.php");
    exit;
}

// Hash password
$hashed_pass = password_hash($password, PASSWORD_DEFAULT);

// Insert user into database
$stmt = $db_connect->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashed_pass);

if ($stmt->execute()) {
    $_SESSION['registration_success'] = "Registration successful! Please login.";
    header("Location: login.php");
    exit;
} else {
    $_SESSION['registration_error'] = "Something went wrong, please try again";
    header("Location: registration.php");
    exit;
}
?>