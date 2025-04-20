<?php
include 'db_connection.php'; // Include database connection

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['user_id'], $data['name'], $data['email'], $data['profile_picture'])) {
    $userId = $data['user_id'];
    $name = $data['name'];
    $email = $data['email'];
    $profilePicture = $data['profile_picture'];

    try {
        // Check if the user already exists
        $stmt = $conn->prepare("SELECT id FROM google_account WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // User already exists, no need to insert
            echo json_encode(['success' => true, 'message' => 'User already exists.']);
        } else {
            // Insert new user into the database
            $stmt = $conn->prepare("INSERT INTO google_account (user_id, name, email, profile_picture) VALUES (:user_id, :name, :email, :profile_picture)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':profile_picture', $profilePicture);
            $stmt->execute();

            echo json_encode(['success' => true, 'message' => 'User saved successfully.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
}
?>
