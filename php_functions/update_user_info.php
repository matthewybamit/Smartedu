<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['field'], $_POST['value'])) {
    $userId = $_SESSION['user_id']; // Assuming user_id is stored in session
    $field = $_POST['field'];
    $value = $_POST['value'];

    // Validate allowed fields
    $allowedFields = ['name', 'email', 'username', 'password'];
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
