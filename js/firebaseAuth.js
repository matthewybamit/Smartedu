// Import the Firebase libraries
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js";
import { getAuth, signInWithPopup, GoogleAuthProvider, signOut } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-auth.js";

// Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyCb3W9TIdZl9plArb0RUZhMbVvkKtWLae8",
    authDomain: "smartedu-37463.firebaseapp.com",
    projectId: "smartedu-37463",
    storageBucket: "smartedu-37463.firebasestorage.app",
    messagingSenderId: "662715357758",
    appId: "1:662715357758:web:593f006a04bcde3273cf6f"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const provider = new GoogleAuthProvider();

// Get the Google Sign-In button by its ID
const googleSignInBtn = document.getElementById('googleSignIn');
const loginSection = document.getElementById('loginSection'); // Optional: for showing/hiding login UI
const profileSection = document.getElementById('profileSection'); // Optional: for showing/hiding profile UI
const profileImage = document.getElementById('profileImage'); // Optional: display user image
const profileName = document.getElementById('profileName'); // Optional: display user name

// Function to save user data to the database and set user_id in the session
function saveUserToDatabase(userId, name, email, profilePicture) {
    fetch('php_functions/save_google_user.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            user_id: userId,
            name: name,
            email: email,
            profile_picture: profilePicture,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Save user_id in the session
            fetch('php_functions/set_session.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ user_id: userId }),
            })
            .then(() => {
                // Redirect to landing page after saving user data and session
                window.location.href = 'landing_page.php';
            })
            .catch(error => {
                console.error('Error setting session:', error);
                alert('An error occurred. Please try again.');
            });
        } else {
            console.error('Failed to save user data:', data.message);
            alert('Failed to save user data. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

// Google Sign-In Button Event Listener
googleSignInBtn.addEventListener('click', () => {
    signInWithPopup(auth, provider)
        .then((result) => {
            const user = result.user;
            console.log('User Info:', user);

            // Save user data to the database
            saveUserToDatabase(user.uid, user.displayName, user.email, user.photoURL);
        })
        .catch((error) => {
            console.error('Login Error:', error);
            alert('Failed to login. Please try again.');
        });
});
