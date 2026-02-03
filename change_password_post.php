<?php
include('./config/db.php');
session_start();

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validation
    $errors = [];

    if (empty($current_password)) {
        $errors[] = "Current password is required";
    }

    if (empty($new_password)) {
        $errors[] = "New password is required";
    } elseif (strlen($new_password) < 6) {
        $errors[] = "New password must be at least 6 characters long";
    }

    if (empty($confirm_password)) {
        $errors[] = "Please confirm your new password";
    }

    if (!empty($new_password) && !empty($confirm_password) && $new_password !== $confirm_password) {
        $errors[] = "New passwords do not match";
    }

    // If no errors, verify current password and update
    if (empty($errors)) {
        // Get current password from database
        $user_query = "SELECT password FROM users WHERE id = 1";
        $user_result = $db_connect->query($user_query);
        $user = $user_result->fetch_assoc();

        // Verify current password
        if (!password_verify($current_password, $user['password'])) {
            $errors[] = "Current password is incorrect";
        } else {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Update password in database
            $update_query = "UPDATE users SET password = ? WHERE id = 1";
            $stmt = $db_connect->prepare($update_query);
            $stmt->bind_param("s", $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Password changed successfully!";
                header("Location: change-password.php");
                exit();
            } else {
                $errors[] = "Failed to update password: " . $db_connect->error;
            }
            $stmt->close();
        }
    }

    // If there are errors, redirect back with error message
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: change-password.php");
        exit();
    }
} else {
    // If not a POST request, redirect to change password
    header("Location: change-password.php");
    exit();
}
