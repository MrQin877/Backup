<?php
session_start();
ob_start(); // Start output buffering

// Determine the login status and role
$loggedIn = isset($_SESSION['username']);
$isAdmin = $loggedIn && $_SESSION['username'] == 'admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../My Account/AdminProfile.css"> <!-- Link your CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .newsboard-button {
            background-color: #FF6B6C;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
        .newsboard-button:hover {
            background-color: #FF8B8C;
        }
        .hidden{
            display:none;
        }
    </style>
</head>
<body>
<header>
    <figure class="logo">
        <img src="../image/hospitalLogo.jpeg" alt="Hospital Logo">
    </figure>
    <nav style="background-color:#FFC145 ;">
        <div class="nav-section-a">
            <a href="../Booking Appointment/bookingform">Booking Appointment</a>
            <a href="../Doctor Profile/doctors profile.html">Doctor Profile</a>
            <a href="../Common Disease/common diseases.html">Common Disease</a>
        </div>
        <div class="nav-section-b">
            <div class="dropdown">
                <a href="../Medical Service/medical services.html" class="dropdown-word">Medical Service</a>
            </div>
            <div class="dropdown">
                <div class="dropdown-word">About Us</div>
                <ul class="dropdown-content">
                    <li><a href="../About Us/History.html">Hospital History</a></li>
                    <li><a href="../About Us/Mission&Visio1.html">Vision & Mission</a></li>
                    <li><a href="../Newsboard/newsboardUser1.html">News Board</a></li>
                    <li><a href="../Survey/survey.html">Survey</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <a href="../Contact Us/ContactUs1.html" class="dropdown-word">Contact Us</a>
            </div>
            <div class="dropdown">
                <div class="dropdown-word">My Account</div>
                <ul class="dropdown-content">
                    <li class="<?php echo $loggedIn ? 'hidden' : ''; ?>"><a href="../Login System/LogInUser.php" id="login" >Log In</a></li>
                    <li class="<?php echo $loggedIn && !$isAdmin ? '' : 'hidden'; ?>"><a href="../My Account/UserProfile.php" id="profile">My Profile</a></li>
                    <li class="<?php echo $loggedIn && $isAdmin ? '' : 'hidden'; ?>"><a href="../My Account/AdminProfile.php" id="admin" >Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

    <div class="title-band">
        <h1>Admin Profile</h1>
    </div>
    <main>
        <section class="profile">
            <div class="profile-info">
                <div class="profile-image">
                    <!-- Display selected image here -->
                    <img id="profileImage" src="../My Account/AdminProfile.jpeg" alt="Profile Image">
                </div>
                <div class="profile-details">
                    <h3>Admin</h3>
                    <p>admin@sunnysmile.com</p>
                </div>
            </div>
            
            <!-- "View news board" button -->
            <button class="newsboard-button" onclick="redirectToNewsBoard()">Manage Newsboard</button>
        </section>
    </main>
    <div style="text-align: right; padding: 40px;">
        <form action="../Login System/logout1.php" method="post">
            <button type="submit" class="logout-button">Log Out</button>
        </form>
    </div>
    <footer>
        <div class="footerContainer">
            <div class="socialIcons">
                <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://x.com/?lang=zh"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://support.google.com/answer/2451065?hl=en"><i class="fa-brands fa-google-plus"></i></a>
                <a href="https://www.youtube.com/"><i class="fa-brands fa-youtube"></i></a>
            </div>
            <div class="footerNav">
                <ul><li><a href="../Homepage/combine.html">Home</a></li>
                    <li><a href="../Medical Service/medical services.html">Medical Service</a></li>
                    <li><a href="../Doctor Profile/doctors profile.html">Our Doctors</a></li>
                    <li><a href="../Booking Appointment/bookingform.php">Appointment Booking</a></li>
                    <li><a href="../About Us/AboutUs_History.html">About Us</a></li>
                    <li><a href="../Contact Us/ContactUs.html">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div class="footerBottom">
            <p>Copyright &copy;2024 <span class="designer">SUNNY SMILE HOSPITAL</span></p>
        </div>
    </footer>
    
    <script>
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function() {
                var dataURL = reader.result;
                var output = document.getElementById('profileImage');
                output.src = dataURL;
            };

            reader.readAsDataURL(input.files[0]);
        }
        
        // Logout function
        document.getElementById('logout').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default link behavior
            localStorage.clear(); // Optionally clear local storage or session variables if used
            window.location.href = "../Login System/LogInUser.php";
        });

        // Disable browsing back after logout
        window.onload = function() {
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        }
    </script>
</body>
</html>
