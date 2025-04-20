<?php
session_start();

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['user_id'])) {
    $_SESSION['user_id'] = $data['user_id'];
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
}
?>
