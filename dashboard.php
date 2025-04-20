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
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Bigelow+Rules&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<?php
include 'php_functions/db_connection.php'; // Ensure database connection is included

session_start();
$userId = $_SESSION['user_id']; // Assuming user_id is stored in session during login

// Check if the user logged in with Google
$query = $conn->prepare("SELECT name, email, profile_picture FROM google_account WHERE user_id = :user_id");
$query->bindParam(':user_id', $userId);
$query->execute();

$googleUser = $query->fetch(PDO::FETCH_ASSOC);

if ($googleUser) {
    $fullName = $googleUser['name'];
    $profilePicture = $googleUser['profile_picture'];
    $email = $googleUser['email'];
    $age = $googleUser['age'] ?? 'N/A';
} else {
    // Fetch user details from the `users` table for non-Google users
    $query = $conn->prepare("SELECT first_name, last_name, age, profile_pic, email, username FROM users WHERE id = :id");
    $query->bindParam(':id', $userId);
    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);
    $fullName = $user ? $user['first_name'] . ' ' . $user['last_name'] : 'Guest';
    $profilePicture = $user && !empty($user['profile_pic']) 
        ? $user['profile_pic'] 
        : 'https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small_2x/default-avatar-icon-of-social-media-user-vector.jpg';
    $email = $user['email'] ?? 'N/A';
    $age = $user['age'] ?? 'N/A';
}

// Fetch the most recent modules accessed by the user
$recentModulesQuery = $conn->prepare("
    SELECT modules_pic 
    FROM recent_modules 
    WHERE username = :username 

");
$recentModulesQuery->bindParam(':username', $_SESSION['username']);
$recentModulesQuery->execute();
$recentModules = $recentModulesQuery->fetchAll(PDO::FETCH_ASSOC);
?>
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

    <div class="background">
        <h1 class="modules-txt">DASHBOARD</h1>
        <div class="topbox">
            <!-- Profile Image Placeholder -->
            <div class="profile-picture-container" style="text-align: left; margin-left: 25px;">
                <div class="profile-picture">
                    <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture" id="profileImage" class="circle-image">
                </div>
                <button id="changeProfileButton" class="change-profile-btn">Change Profile</button>
                <input type="file" id="fileInput" accept="image/*" style="display: none;">
            </div>

            <script>
                const fileInput = document.getElementById('fileInput');
                const profileImage = document.getElementById('profileImage');
                const changeProfileButton = document.getElementById('changeProfileButton');

                changeProfileButton.addEventListener('click', () => {
                    fileInput.click();
                });

                fileInput.addEventListener('change', (event) => {
                    const file = event.target.files[0];
                    if (file) {
                        const formData = new FormData();
                        formData.append('profile_pic', file);

                        fetch('php_functions/update_profile_pic.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    profileImage.src = e.target.result;
                                };
                                reader.readAsDataURL(file);
                            } else {
                                alert('Failed to update profile picture.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while updating the profile picture.');
                        });
                    }
                });
            </script>

            <div class="info">
                <h3 class="name1" id="userName">Name: <?php echo htmlspecialchars($fullName); ?></h3>
                <h3 class="age2" id="age">Age: <?php echo htmlspecialchars($age); ?> </h3>
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
                    <?php foreach ($recentModules as $module): ?>
                        <div class="recent_module">
                            <img src="<?php echo htmlspecialchars($module['modules_pic']); ?>" alt="Module Image" style="width: 100%; height: auto; border-radius: 10px;">
                        </div>
                    <?php endforeach; ?>
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
        <a href="#" class="edit-label" onclick="openModal('name', '<?php echo htmlspecialchars($fullName); ?>')">Edit Name</a>
        <span class="value-label" id="displayName"><?php echo htmlspecialchars($fullName); ?></span>
    </div>
    <div class="profile-row">
        <a href="#" class="edit-label" onclick="openModal('email', '<?php echo htmlspecialchars($email); ?>')">Edit Email</a>
        <span class="value-label" id="displayEmail"><?php echo htmlspecialchars($email); ?></span>
    </div>
    <div class="profile-row">
    <a href="#" class="edit-label" onclick="openModal('username', '<?php echo htmlspecialchars($user['username'] ?? 'N/A'); ?>')">Edit Username</a>
    <span class="value-label" id="displayUsername"><?php echo htmlspecialchars($user['username'] ?? 'N/A'); ?></span>
    </div>
    <div class="profile-row">
        <a href="#" class="edit-label" onclick="openModal('password', '')">Edit Password</a>
        <span class="value-label">******* </span>
    </div>
</div>

<!-- Modal -->
<div id="editModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle" style="color: black;">Edit</h2>
        <input type="text" id="modalInput" placeholder="Enter new value">
        <div class="modal-buttons">
            <button onclick="saveChanges()">Save</button>
            <button onclick="closeModal()">Cancel</button>
        </div>
    </div>
</div>

<script>
    let currentField = '';

    function openModal(field, currentValue) {
        currentField = field;
        document.getElementById('modalTitle').innerText = `Edit ${field.charAt(0).toUpperCase() + field.slice(1)}`;
        const input = document.getElementById('modalInput');
        input.value = currentValue;
        input.type = 'text';
        document.getElementById('editModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    function saveChanges() {
        const newValue = document.getElementById('modalInput').value;

        if (newValue) {
            const formData = new FormData();
            formData.append('field', currentField);
            formData.append('value', newValue);

            fetch('php_functions/update_user_info.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`${currentField.charAt(0).toUpperCase() + currentField.slice(1)} updated successfully.`);
                    window.location.reload(); // Refresh the page after successful update
                } else {
                    alert('Failed to update. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating.');
            });
        }
    }
</script>

      
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
