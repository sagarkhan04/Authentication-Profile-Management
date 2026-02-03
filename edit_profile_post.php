<?php
include('./config/db.php');

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));

    // Validation
    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // If no errors, update the database
    if (empty($errors)) {
        // Check if email is already in use by another user
        $email_check_query = "SELECT id FROM users WHERE email = ? AND id != 1 LIMIT 1";
        $stmt = $db_connect->prepare($email_check_query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $email_result = $stmt->get_result();

        if ($email_result->num_rows > 0) {
            $errors[] = "Email is already in use";
        } else {
            // Update user profile
            $update_query = "UPDATE users SET name = ?, email = ? WHERE id = 1";
            $stmt = $db_connect->prepare($update_query);
            $stmt->bind_param("ss", $name, $email);

            if ($stmt->execute()) {
                header("Location: dashboard.php?success=Profile updated successfully");
                exit();
            } else {
                $errors[] = "Failed to update profile: " . $db_connect->error;
            }
        }
        $stmt->close();
    }

    // If there are errors, redirect back with error message
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: edit-profile.php");
        exit();
    }
} else {
    // If not a POST request, redirect to edit profile
    header("Location: edit-profile.php");
    exit();
}