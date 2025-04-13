<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['full_name'] ?? null; // Ensure no "Guest" is stored
    $score = $_POST['score'] ?? 0;
    $total = $_POST['total'] ?? 0;

    if (!empty($fullName)) { // Only insert if fullName is valid and not empty
        // Store the result in the database
        $query = $conn->prepare("INSERT INTO results (name, total_score, total_item) VALUES (:name, :total_score, :total_item)");
        $query->bindParam(':name', $fullName);
        $query->bindParam(':total_score', $score);
        $query->bindParam(':total_item', $total);
        $query->execute();
    }

    // Redirect to MODULES.php
    header("Location: ../MODULES.php");
    exit();
}
?>
