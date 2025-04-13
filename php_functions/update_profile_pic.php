<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_pic'])) {
    $userId = $_SESSION['user_id']; // Assuming user_id is stored in session
    $file = $_FILES['profile_pic'];

    // Validate the uploaded file
    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../photos/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = uniqid() . '_' . basename($file['name']);
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            $relativePath = 'photos/' . $fileName; // Save the relative path
            // Update the profile_pic column in the database
            $query = $conn->prepare("UPDATE users SET profile_pic = :profile_pic WHERE id = :id");
            $query->bindParam(':profile_pic', $relativePath);
            $query->bindParam(':id', $userId);

            if ($query->execute()) {
                echo json_encode(['success' => true]);
                exit();
            }
        }
    }
}

echo json_encode(['success' => false]);
?>
