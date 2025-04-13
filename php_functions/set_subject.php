<?php
session_start();

if (isset($_GET['subject'])) {
    $_SESSION['subject'] = $_GET['subject'];
    header("Location: ../review.php");
    exit();
}
?>
