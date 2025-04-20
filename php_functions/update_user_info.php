<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['field'], $_POST['value'])) {
    $userId = $_SESSION['user_id']; // Assuming user_id is stored in session
    $field = $_POST['field'];
    $value = $_POST['value'];

    // Validate allowed fields
    $allowedFields = ['name', 'email', 'username', 'password', 'age'];
    if (!in_array($field, $allowedFields)) {
        echo json_encode(['success' => false, 'message' => 'Invalid field.']);
        exit();
    }

    // Special handling for password (hash it)
    if ($field === 'password') {
        $value = password_hash($value, PASSWORD_DEFAULT);
    }

    // Map 'name' to first_name and last_name
    if ($field === 'name') {
        $nameParts = explode(' ', $value, 2);
        $firstName = $nameParts[0];
        $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

        $query = $conn->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name WHERE id = :id");
        $query->bindParam(':first_name', $firstName);
        $query->bindParam(':last_name', $lastName);
        $query->bindParam(':id', $userId);
    } elseif ($field === 'age') {
        try {
            // Check if the user is a Google user
            $query = $conn->prepare("SELECT id FROM google_account WHERE user_id = :user_id");
            $query->bindParam(':user_id', $userId);
            $query->execute();

            if ($query->rowCount() > 0) {
                // Update age in google_account table
                $update = $conn->prepare("UPDATE google_account SET age = :age WHERE user_id = :user_id");
                $update->bindParam(':age', $value);
                $update->bindParam(':user_id', $userId);
                $update->execute();
            } else {
                // Update age in users table for non-Google users
                $update = $conn->prepare("UPDATE users SET age = :age WHERE id = :id");
                $update->bindParam(':age', $value);
                $update->bindParam(':id', $userId);
                $update->execute();
            }

            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit();
    } else {
        $query = $conn->prepare("UPDATE users SET $field = :value WHERE id = :id");
        $query->bindParam(':value', $value);
        $query->bindParam(':id', $userId);
    }

    if ($query->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
