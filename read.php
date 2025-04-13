<?php
include_once 'php_functions/module_function.php';  // Include the function to fetch title and description
include_once 'php_functions/db_connection.php';  // Include the database connection file

// Fetch both title and description
$moduleDetails = getEnglishModuleDetails($conn);

// Extract title and description from the result
$title = $moduleDetails['title'];
$description = $moduleDetails['description'];
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Website</title>
    <link rel="stylesheet" href="CSS/read.css">
    <link rel="stylesheet" href="css/navbar.css">
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



    <main>

        <div class="background">
            <div class="readFrame">
                
                <div class="readcontent">

                    <button class="save">Save</button>
                    <button class="finish">Finished</button>
                    <button class="start" onclick="location.href='quizone.php';">Start Quiz</button>

                    <div class="scroll-read">
                        <h2>01</h2>
                        <h1><?php echo htmlspecialchars($title); ?></h1> <!-- Display the title -->

                        <!-- Display the description fetched from the database -->
                        <p><?php echo htmlspecialchars($description); ?></p> <!-- Display the description -->
                    </div>
                </div>

                <div class="content">
                    <h1></h1>
                    <h2></h2>
                    <h3></h3>

                </div>




            </div>
        </div>
    </main>
    <footer>

    </footer>

    <script src="scripts.js"></script>


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