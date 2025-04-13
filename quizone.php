<?php
session_start();
include_once 'php_functions/db_connection.php';

$subject = isset($_SESSION['subject']) ? $_SESSION['subject'] : null;

if ($subject === 'history') {
    $tableName = 'quiz_history';
} elseif ($subject === 'english') {
    $tableName = 'quiz_english';
} else {
    die("Invalid subject or no subject selected.");
}

// Fetch all questions from the database
$query = $conn->prepare("SELECT id, quiz_title, question, choice_a, choice_b, choice_c, choice_d, correct_choice FROM $tableName ORDER BY id ASC");
$query->execute();
$questions = $query->fetchAll(PDO::FETCH_ASSOC);

// Initialize or update the current question index
if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
    $_SESSION['score'] = 0; // Ensure score is initialized
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $currentQuestion = $questions[$_SESSION['current_question']];
        $userAnswer = $_POST['answer'] ?? null;

        // Check if the answer is correct
        if ($userAnswer === $currentQuestion['correct_choice']) {
            $_SESSION['score']++;
        }

        // Move to the next question
        $_SESSION['current_question']++;
    }
}

// Check if the quiz is finished
if ($_SESSION['current_question'] >= count($questions)) {
    $totalQuestions = count($questions); // Ensure total questions are counted correctly
    $score = $_SESSION['score'] ?? 0; // Ensure score is not null
    $username = $_SESSION['username']; // Get the username from the session

    // Fetch first_name and last_name from the database
    $query = $conn->prepare("SELECT first_name, last_name FROM users WHERE username = :username");
    $query->bindParam(':username', $username);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Combine first_name and last_name, ensure no invalid names are stored
    $fullName = ($user && !empty($user['first_name']) && !empty($user['last_name']) && $user['first_name'] !== 'Guest') 
        ? $user['first_name'] . ' ' . $user['last_name'] 
        : null;

    // Check if the user has already submitted the quiz
    $checkQuery = $conn->prepare("SELECT COUNT(*) FROM results WHERE name = :name AND total_item = :total_item");
    $checkQuery->bindParam(':name', $fullName);
    $checkQuery->bindParam(':total_item', $totalQuestions);
    $checkQuery->execute();
    $alreadySubmitted = $checkQuery->fetchColumn();

    if (!$alreadySubmitted && !empty($fullName)) { // Only insert if not already submitted and fullName is valid
        // Store the result in the database
        $insertQuery = $conn->prepare("INSERT INTO results (name, total_score, total_item) VALUES (:name, :total_score, :total_item)");
        $insertQuery->bindParam(':name', $fullName);
        $insertQuery->bindParam(':total_score', $score);
        $insertQuery->bindParam(':total_item', $totalQuestions);
        $insertQuery->execute();
    }

    // Set total in session
    $_SESSION['total'] = $totalQuestions;

    // Redirect to result page
    header("Location: result.php");
    exit();
}

// Get the current question
$currentQuestion = $questions[$_SESSION['current_question']];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Page</title>
    <link rel="stylesheet" href="css/quizone.css">
    <link rel="stylesheet" href="css/navbar.css">
    <script>
        function submitAnswer(answer) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.style.display = 'none';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'answer';
            input.value = answer;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</head>
<body>
<header>
    <nav>
        <div class="logo_container">
            <img src="photos/orange.png" class="logowl" alt="Logo">
            <div class="logo">Lumin</div>
        </div>
        <div class="burger_and_search">
            <a href="styles.php" class="search">
                <img src="photos/search.png" class="search-icon" alt="Search">
            </a>
            <div class="burger" id="burger">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <ul id="nav-menu">
            <li><a href="landing_page.php">Home</a></li>
            <li><a href="styles.php">Styles</a></li>
            <li><a href="MODULES.php">Modules</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="php_functions/logout.php">Log Out</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <div class="quiz-card">
        <div class="quiz-title">
            <?php echo htmlspecialchars($currentQuestion['quiz_title']); ?>
        </div>
        <div class="quiz-progress">
            Question <?php echo $_SESSION['current_question'] + 1; ?> of <?php echo count($questions); ?>
        </div>
        <div class="quiz-question">
            <?php echo htmlspecialchars($currentQuestion['question']); ?>
        </div>
        <div class="quiz-options">
            <button class="quiz-option" onclick="submitAnswer('A')">
                <?php echo htmlspecialchars($currentQuestion['choice_a']); ?>
            </button>
            <button class="quiz-option" onclick="submitAnswer('B')">
                <?php echo htmlspecialchars($currentQuestion['choice_b']); ?>
            </button>
            <button class="quiz-option" onclick="submitAnswer('C')">
                <?php echo htmlspecialchars($currentQuestion['choice_c']); ?>
            </button>
            <button class="quiz-option" onclick="submitAnswer('D')">
                <?php echo htmlspecialchars($currentQuestion['choice_d']); ?>
            </button>
        </div>
    </div>
</div>

<script>
    // Toggle the visibility of the menu
    const burger = document.getElementById('burger');
    const navMenu = document.getElementById('nav-menu');

    burger.addEventListener('click', () => {
        navMenu.classList.toggle('active');
    });
</script>
</body>
</html>
