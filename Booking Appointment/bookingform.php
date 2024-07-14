<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../Login System/LogInUser.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bookingform.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Appointment Booking Form</title>
</head>
<body>
    <header>
        <figure class="logo">
            <img src="../image/LogoSShospital.png" alt="Hospital Logo">
        </figure>
        <nav style="background-color:#FFC145 ;">
            <div class="nav-section-a">
                <a href="../Booking Appointment/bookingform.php">Booking Appointment</a>
                <a href="../Doctor Profile/doctors profile.html">Doctor Profile</a>
                <a href="../Common Disease/common diseases.html">Common Disease</a>
            </div>
            <div class="nav-section-b">
                <div class="dropdown-word">
                    <a href="../Medical Service/medical services.html" class="dropdown-word">Medical Service</a>
                </div>
                <div class="dropdown">
                    <div class="dropdown-word">About Us</div>
                    <ul class="dropdown-content">
                        <li><a href="../About Us/AboutUs_History.html">Hospital History</a></li>
                        <li><a href="../About Us/">Vision & Mission</a></li>
                        <li><a href="../Newsboard/newsboardUser.html">News Board</a></li>
                        <li><a href="../Survey/survey.html">Survey</a></li>
                    </ul>
                </div>
                <div class="dropdown-word">
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

    <main>
        <section class="booking-form-section">
            <h1>Appointment Booking Form</h1>
            <div id="loginPrompt" style="display: none;">
                <p>You need to <a href="../Login System/LogInUser.php">log in</a> to book an appointment.</p>
            </div>
            <form id="bookingForm" action="bookingform.php" method="POST">
                <fieldset>
                    <legend>Patient Information</legend>
                    <label for="childName">Child's Full Name:</label>
                    <input type="text" id="childName" name="childName" required>

                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required>

                    <label for="parentName">Parent/Guardian Name:</label>
                    <input type="text" id="parentName" name="parentName" required>

                    <label for="contactNumber">Emergency Contact Number:</label>
                    <input type="tel" id="contactNumber" name="contactNumber" required>
                </fieldset>

                <fieldset>
                    <legend>Appointment Details</legend>
                    <label for="appointmentDate">Date:</label>
                    <input type="date" id="appointmentDate" name="appointmentDate" required>

                    <label for="appointmentTime">Time:</label>
                    <input type="time" id="appointmentTime" name="appointmentTime" required>

                    <label for="medicalService">Medical Service:</label>
                    <small>* All patients must go through a general pediatrician before being referred to specialists.</small>
                    <select id="medicalService" name="medicalService" required>
                        <option value="">Select Medical Service</option>
                        <option value="Routine Check-up">Routine Check-up</option>
                        <option value="Vaccination">Vaccination</option>
                        <option value="Diagnosis and Treatment of Illness">Diagnosis and Treatment of Illness</option>
                        <option value="Growth and Development Assessment">Growth and Development Assessment</option>
                        <option value="Health Screenings">Health Screenings</option>
                    </select>

                    <label for="doctorInCharge">Doctor Incharge:</label>
                    <select id="doctorInCharge" name="doctorInCharge" required>
                        <option value="">Select Doctor</option>
                        <option value="Dr. Sienna Wright">Dr. Sienna Wright</option>
                        <option value="Dr. Alex Warren">Dr. Alex Warren</option>
                    </select>

                    <label for="reason">Reason (optional):</label>
                    <textarea id="reason" name="reason" rows="4" cols="50"></textarea>
                </fieldset>

                <button type="submit">Submit</button>
            </form>
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
