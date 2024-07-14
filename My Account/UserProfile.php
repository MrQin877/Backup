<?php
session_start();
 
$username = $_SESSION['username'];
$email = $_SESSION['email'];
//$profile_image = $_SESSION['profile_image'];
 
// Database connection
$servername = "localhost";
$db_username = "root"; // Renamed from $username to $db_username
$password = "";
$dbname = "sunnysmile";
 
$conn = new mysqli($servername, $db_username, $password, $dbname);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../My Account/UserAccount.css"> <!-- Link your CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <figure class="logo">
            <img src="hospitalLogo.jpeg" alt="Hospital Logo">
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
                        <li><a href="../Login System/MyAccountSignUp.php">Sign Up / Log In</a></li>
                        <li><a href="../My Account/UserAccount.php">My Profile</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
 
    <div class="title-band">
        <h1>User Profile</h1>
    </div>
    <main>
        <section class="profile">
            <div class="profile-info">
            <div class="profile-image">
            <?php
    // Check if user has uploaded a profile image
            $sql = "SELECT profile_image FROM users WHERE username=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
 
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($profile_image);
                $stmt->fetch();
                echo '<img id="profileImage" src="' . htmlspecialchars($profile_image) . '" alt="Profile Image">';
            } else {
                echo '<img id="profileImage" src="default_profile_image.jpg" alt="Profile Image">';
            }
 
            $stmt->close();
            ?>
        </div>
                <form action="upload_profile_image.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="profile_image" accept="image/*">
                    <button type="submit">Upload Image</button>
                </form>
 
                <div class="profile-details">
                    <h3 id="username">Username: <?php echo htmlspecialchars($username); ?></h3>
                    <p id="email">Email: <?php echo htmlspecialchars($email); ?></p>
                </div>
            </div>
            <ul class="medical-history">
                <div class="history-details">
                    <div class="patient-info"></div>
                    <div class="history">
                        <h2>Medical History</h2>
                        <ul id="medical-history-list">
                            <?php
                            $sql = "SELECT drName, purpose, date FROM users WHERE username=?";
                            $stmt = $conn->prepare($sql);

                            if ($stmt === false) {
                                die("Error preparing statement: " . $conn->error);
                            }

                            $stmt->bind_param("s", $username);
                            if ($stmt->execute() === false) {
                                die("Error executing statement: " . $stmt->error);
                            }

                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $drName = isset($row['drName']) ? htmlspecialchars($row['drName']) : "----";
                                    $purpose = isset($row['purpose']) ? htmlspecialchars($row['purpose']) : "----";
                                    $date = isset($row['date']) ? htmlspecialchars($row['date']) : "---";

                                    echo '<li>On ' . $date . ', booked ' . $drName . ' for ' . $purpose . '</li>';
                                }
                            } else {
                                echo '<p id="no-history-message">No history available</p>';
                            }

                            $stmt->close();
                            ?>

                        </ul>
                    </div>
                </div>
            </ul>
            <button class="testimony-button" onclick="window.location.href='../Testimony/testimony.php'">View Patient Testimonies</button>
        </section>
    </main>
    <!-- Logout Button -->
    <div style="text-align: right; padding: 40px;">
        <form action="logout1.php" method="post">
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
        document.addEventListener("DOMContentLoaded", function() {
            var testimonyButton = document.querySelector('.testimony-button');
            testimonyButton.addEventListener('click', function() {
                window.location.href = 'patient-testimonies.html';
            });
            var profileLink = document.getElementById('myProfileLink');
            profileLink.addEventListener('click', function(event) {
                <?php if (!isset($_SESSION['username']) || !isset($_SESSION['email'])): ?>
                    event.preventDefault();
                    alert('Login first');
                    window.location.href = '../Login System/MyAccountSignUp.php';
                <?php endif; ?>
            });
        });
 
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
    </script>
</body>
</html>
 
<?php
$conn->close();
?>
