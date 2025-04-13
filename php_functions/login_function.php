<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start a session only if one is not already active
}

include 'db_connection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if user exists in the database
    $query = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $query->bindParam(':username', $username);
    $query->execute();

    if ($query->rowCount() > 0) {
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Verify the hashed password
        if (password_verify($password, $user['password'])) {
            // Store user data in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            // Combine first_name and last_name for full_name session
            if (!empty($user['first_name']) && !empty($user['last_name'])) {
                $_SESSION['full_name'] = $user['first_name'] . ' ' . $user['last_name'];
            } else {
                $_SESSION['full_name'] = null; // Ensure no "Guest" is stored
            }

            // Redirect to home page after successful login
            header("Location: landing_page.php");
            exit();
        } else {
            $_SESSION['message'] = 'Invalid password!';
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['message'] = 'User not found!';
        header("Location: login.php");
        exit();
    }
}
?>
