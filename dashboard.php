<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Website</title>
    <link rel="stylesheet" href="CSS/dashboard.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Bigelow+Rules&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <div class="background">
        <h1 class="modules-txt">DASHBOARD</h1>
        <div class="topbox">
            <!-- Profile Image Placeholder -->
            <label for="fileInput" class="circle-button">
                <img src="photos/default-avatar.png" alt="Image" id="profileImage" class="button-image"> <!-- Profile Image ID -->
                <span class="button-text">Image</span>
            </label>
            <input type="file" id="fileInput" accept="image/*" style="display: none;">
            
            <div class="info">
                <!-- Name Placeholder -->
                <h3 class="name1" id="userName">Name</h3> <!-- Name ID -->
                <!-- Email Placeholder -->
                <h3 class="age2" id="age">Age</h3> <!-- Email ID -->
            </div>

            <div class="score-section">
                <div class="average-score">
                    <h1>87.8</h1>
                    <p>Average Score</p>
                </div>
            
                <div class="progress-bars">
                    <div class="progress-item">
                        <div class="circle" data-percentage="77">
                            <span>77%</span>
                        </div>
                        <p>Grades</p>
                    </div>
                    <div class="progress-item">
                        <div class="circle" data-percentage="77">
                            <span>77%</span>
                        </div>
                        <p>Progress</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="leftbox">
            <h1>Recent Module</h1>
            <div class="scroll_leftbox">
                <div class="leftbox_grid">  
                    <div class="recent_module">
                        <h1>There are many variations</h1>
                    </div>
                    <div class="recent_module">
                        <h1>There are many variations</h1>
                    </div>
                    <div class="recent_module">
                        <h1>There are many variations</h1>
                    </div>
                    <div class="recent_module">
                        <h1>There are many variations</h1>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="topmid">
            <h1>Recent Activity</h1>
            <div class="scroll_topmid">
                <div class="grid_topmid">
                    <img src="photos/quiz.png"  class="quiz">
                    <img src="photos/quiz.png"  class="quiz">
                    <img src="photos/quiz.png"  class="quiz">
                    <img src="photos/quiz.png"  class="quiz">
                    
                </div>
            </div>
        </div>
        
        <div class="profile-box">
    <div class="profile-row">
        <a href="#" class="edit-label">Edit Name</a>
        <span class="value-label" id="displayName">Name</span> <!-- Added ID "displayName" -->
    </div>
    <div class="profile-row">
        <a href="#" class="edit-label">Edit Email</a>
        <span class="value-label" id="displayEmail">Email</span> <!-- Added ID "displayEmail" -->
    </div>
    <div class="profile-row">
        <a href="#" class="edit-label">Edit Username</a>
        <span class="value-label" id="displayUsername">Username</span> <!-- Added ID "displayUsername" -->
    </div>
    <div class="profile-row">
        <a href="#" class="edit-label">Edit Password</a>
        <span class="value-label">******* </span>
    </div>
</div>

      
        <div class="overall-section">
    <h2>Overall</h2>
    <canvas id="overallChart" width="300" height="300"></canvas>
    <div class="chart-labels">
        <div><span class="color-box" style="background-color: #FFC107;"></span>Quizzes 52.1%</div>
        <div><span class="color-box" style="background-color: #FF5722;"></span>Assignments 31.3%</div>
        <div><span class="color-box" style="background-color: #4CAF50;"></span>Category 5.2%</div>
        <div><span class="color-box" style="background-color: #4CAF50;"></span>Subject 10.4%</div>
    </div>
</div>

        





    </div>
    
    <script src="js/firebaseAuth.js"></script> 
    <script>
        const ctx = document.getElementById('overallChart').getContext('2d');
        const overallChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Quizzes', 'Assignments', 'Category', 'Subject'],
                datasets: [{
                    data: [52.1, 31.3, 5.2, 10.4],
                    backgroundColor: ['#FFC107', '#FF5722', '#fd5c63', '#4CAF50'],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false  /* Hide default legend */
                    }
                }
            }
        });
    </script>
   
</body>
</html>
