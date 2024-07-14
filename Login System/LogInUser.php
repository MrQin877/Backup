<?php
session_start();
ob_start(); // Start output buffering

// Check if login credentials are provided
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $user_password = $_POST['password']; // Rename to avoid conflict with admin password

    // Check if the provided credentials match the admin credentials
    if ($email === 'admin@sunnysmile.com' && $user_password === 'S1S0@1!9') {
        // Set session variables for admin
        $_SESSION['username'] = 'admin'; 
        $_SESSION['email'] = $email;

        // Redirect to AdminProfile.php
        header("Location: ../My Account/AdminProfile.php");
        exit();
    } else {
        // Proceed with regular user login
        $servername = "localhost";
        $username = "root";
        $db_password = ""; // Rename to avoid conflict with user password
        $dbname = "sunnysmile";

        // Create a connection
        $conn = new mysqli($servername, $username, $db_password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Initialize an error message variable
        $error_message = "";

        // Prepare and bind
        $stmt = $conn->prepare("SELECT id, username, password, email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);

        // Execute the statement
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $username, $hashed_password, $email);
        $stmt->fetch();

        // Verify the password
        if ($stmt->num_rows > 0 && password_verify($user_password, $hashed_password)) {
            // Set session variables for regular user
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;

            // Redirect to UserAccount.php
            header("Location: ../My Account/UserProfile.php");
            exit();
        } else {
            $error_message = "Invalid email or password";
        }

        // Close the statement
        $stmt->close();

        // Close the connection
        $conn->close();

        // If neither admin nor valid user, show error message
        if (!empty($error_message)) {
            echo '<script>alert("' . $error_message . '");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Login System/LogInUser.css"> <!-- Link your CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <header>
        <figure class="logo">
            <img src="../image/hospitalLogo.jpeg" alt="Hospital Logo">
        </figure>
        <nav style="background-color:#FFC145 ;">
            <div class="nav-section-a">
                <a href="../Booking Appointment/bookingform.php">Booking Appointment</a>
                <a href="../Doctor Profile/doctors profile.html">Doctor Profile</a>
                <a href="../Common Disease/common diseases.html">Common Disease</a>
            </div>
            <div class="nav-section-b">
                <div class="dropdown">
                    <a href="../Medical Service/medical services.html" class="dropdown-word">Medical Service</a>
                <div class="dropdown">
                    <div class="dropdown-word">About Us</div>
                    <ul class="dropdown-content">
                        <li><a href="../About Us/AboutUs_History.html">Hospital History</a></li>
                        <li><a href="../About Us/Mission&Vision.html">Vision & Mission</a></li>
                        <li><a href="../Newsboard/newsboardUser.html">News Board</a></li>
                        <li><a href="../Survey/survey.html">Survey</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <a href="../Contact Us/ContactUs.html" class="dropdown-word">Contact Us</a>
                </div>
                <div class="dropdown">
                    <div class="dropdown-word">My Account</div>
                    <ul class="dropdown-content">
                        <li><a href="../Login System/LogInUser.php">Log In</a></li>
                        <li><a href="../My Account/UserProfile.php">My Profile</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="title-band">
        <h1>Login / Sign Up</h1>
    </div>
    <main>
        <section class="login-form">
            <h2>Login</h2>

            <!-- Display error message if login fails -->
            <?php if (!empty($error_message)): ?>
                <p style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <form action="../Login System/LoginUser.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>

            <p>Don't have an account yet? <a href="../Login System/MyAccountSignUp.php">Sign Up</a></p>
            <p>Forgot your password? <a href="../Login System/reset_password.php">Reset it here</a></p>
        </section>
    </main>
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
</body>
</html>

