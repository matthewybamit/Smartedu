 // Import the Firebase libraries
 import { initializeApp } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js";
 import { getAuth, signInWithPopup, GoogleAuthProvider, signOut } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-auth.js";

 // Firebase configuration
 const firebaseConfig = {
     apiKey: "AIzaSyCpgVuo3sAsdbdVIZ1W6X54CY7DrvvX5hA",
     authDomain: "compaq-2f7b9.firebaseapp.com",
     projectId: "compaq-2f7b9",
     storageBucket: "compaq-2f7b9.appspot.com",
     messagingSenderId: "938797418930",
     appId: "1:938797418930:web:d7400d0f460b4c9038bcab"
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

 // Google Sign-In Button Event Listener
googleSignInBtn.addEventListener('click', () => {
    signInWithPopup(auth, provider)
        .then((result) => {
            // Get user info from result
            const user = result.user;
            console.log('User Info:', user);

            // Store user profile image, name, and email in localStorage
            localStorage.setItem('userProfileImage', user.photoURL);
            localStorage.setItem('userName', user.displayName);
            localStorage.setItem('userEmail', user.email);

            // Redirect to dashboard page after successful login
            window.location.href = 'dashboard.php';
        })
        .catch((error) => {
            // Handle login error
            console.error('Login Error:', error);
            alert('Failed to login. Please try again.');
        });
});
