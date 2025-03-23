<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Page</title>
    <link rel="stylesheet" href="css/startquiz.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Bigelow+Rules&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <img src="photos/orange.png"  class="logowl">
            <div class="logo">Lumin</div>
            <ul>
               <li><a href="landing_logout.php">Home</a></li>
                <li><a href="styles.php">Styles</a></li>
                <li><a href="MODULES.php">Modules</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="#">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="quiz-card">
            <div class="quiz-image"></div>
            <div class="caption">There are many variations (ito kunwari module)</div>
            <button class="start-btn" onclick="location.href='quizone.html'">START QUIZ</button>

            
        </div>
    </div>

    <script src="js/startquiz.js"></script>
</body>
</html>