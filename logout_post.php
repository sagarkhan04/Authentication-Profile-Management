<?php
session_start();

// সমস্ত সেশন ডেটা ক্লিয়ার করা
$_SESSION = [];

// সেশন ডেস্ট্রয় করা
session_destroy();

// সেশন কুকি ডিলিট করা (সাপোর্টেড হলে)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// login.php-এ রিডিরেক্ট
header("Location: login.php");
exit;
?>