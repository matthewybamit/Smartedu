<?php
session_start();
$score = $_SESSION['score'] ?? 0;
$total = $_SESSION['total'] ?? 0; // Ensure total is initialized properly
$fullName = $_SESSION['full_name'] ?? 'Guest'; // Ensure full name is stored in session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="css/result.css">
</head>
<body>
    <div class="result-container">
        <h1>Congratulations!</h1>
        <p>You scored <strong><?php echo $score; ?></strong> out of <strong><?php echo $total; ?></strong> questions.</p>
        <form method="POST" action="php_functions/store_and_clear_session.php">
            <input type="hidden" name="full_name" value="<?php echo htmlspecialchars($fullName); ?>">
            <input type="hidden" name="score" value="<?php echo $score; ?>">
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <button type="submit">Proceed</button>
        </form>
    </div>
</body>
</html>
