<?php
session_start();
 
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
 
$servername = "localhost"; // replace with your database host
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "sunnysmile"; // replace with your database name
 
// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);
 
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
// Create the registration table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    security_question VARCHAR(255) NOT NULL,
    security_answer VARCHAR(255) NOT NULL,
    profile_image VARCHAR(255),
    drName VARCHAR(50),
    purpose VARCHAR(100),
    date date,
    UNIQUE (email)
)";
 
if ($conn->query($sql) !== TRUE) {
    echo "Error creating table: " . $conn->error;
}
 
$error = '';
 
// Get form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $email = $_POST['email'];
    $security_question = $_POST['security-question'];
    $security_answer = $_POST['security-answer'];
 
    // Check if the email already exists　emailかぶりチェックはここだよ～～～～
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $error = 'Email already exists. Please use a different email.';
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, security_question, security_answer) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $password, $email, $security_question, $security_answer);
 
        // Execute the statement
        if ($stmt->execute() === TRUE) {
            // Set session variables
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
 
            // Redirect to UserProfile.php
            header("Location: ../My Account/UserProfile.php");
            exit();
        } else {
            $error = 'Error: ' . $stmt->error;
        }
    }
 
    // Close the statement
    $stmt->close();
}
 
// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../Login System/MyAccountSignUp.css"> <!-- Link your CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <figure class="logo">
            <img src="../image/hospitalLogo.jpeg" alt="Hospital Logo">
        </figure>
        <nav style="background-color:#FFC145;">
            <div class="nav-section-a">
                <a href="../Booking Appointment/bookingform.php">Booking Appointment</a>
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
        <section class="signup-form">
            <h2>Sign Up</h2>
            <?php
            if ($error) {
                echo '<p style="color:red;">' . $error . '</p>';
            }
            ?>
            <div id="User" class="tab-content active">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                   
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <br>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
 
                    <label for="security-question">Security Question:</label>
                    <select id="security-question" name="security-question" required>
                        <option value="">Select a question...</option>
                        <option value="pet">What was the name of your first pet?</option>
                        <option value="mother-maiden">What is your mother's maiden name?</option>
                        <option value="first-car">What was the make and model of your first car?</option>
                        <option value="school">What was the name of your elementary school?</option>
                    </select>
 
                    <label for="security-answer">Answer:</label>
                    <input type="text" id="security-answer" name="security-answer" required>
 
                    <button type="submit">Sign Up</button>
                    <a href="../My Account/UserProfile.php"></a>
                </form>
            </div>
            <p>Already have an account? <a href="../Login System/LogInUser.php">Log in</a></p>
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
    <script>
    function submitForm() {
        // Get form values
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const email = document.getElementById('email').value;
        const securityQuestion = document.getElementById('security-question').value;
        const securityAnswer = document.getElementById('security-answer').value;
 
        // Password validation
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
        if (!passwordPattern.test(password)) {
            alert('Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.');
            return;
        }
 
        // Check if all fields are filled
        if (username && password && email && securityQuestion && securityAnswer) {
            // Save profile data to localStorage
            const profileData = {
                username: username,
                email: email
            };
            localStorage.setItem('profileData', JSON.stringify(profileData));
 
            // The form will automatically submit because of the action and method attributes
        } else {
            alert('Please fill in all the required fields.');
        }
    }
 
    // Attach the submitForm function to the form submit event
    document.getElementById('user-form').addEventListener('submit', submitForm);
    </script>
</body>
</html>
 
 
