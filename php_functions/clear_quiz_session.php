<?php
session_start();

// Unset only the quiz-related session variables
unset($_SESSION['score']);
unset($_SESSION['total']);

// Redirect to MODULES.php
header("Location: ../MODULES.php");
exit();
?>
