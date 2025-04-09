<?php
session_start();
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

            // Redirect to home page after successful login
            header("Location: landing_logout.php");
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
