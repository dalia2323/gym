<?php
session_start();
if(!isset($_SESSION['user'])){
  header('location:login.php');
  exit();
}
include('handler/db.php');
$name = $_SESSION['user']['email'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="assest/all.min.css">
    <link rel="stylesheet" href="assest/css/mainpage-style.css">
</head>
<body>
<header>
    <nav>
        <div class="logo">
            <i class="fa-solid fa-dumbbell"></i>
            <span>The Beasts</span>
        </div>
        <div class="user-info"> WELCOME <?php echo $name; ?>
        </div>
        <a href="logout.php" title="Logout" class="anchor">
        <i class="fa fa-sign-out" aria-hidden="true"></i>
        </a>
    </nav>
</header>
<main>
    <section class="section1">        
        <p>The Beasts Gym</p>
        <div>Lorem ipsum dolor sit amet distinctio<br>
            consectetur adipisicing elit. Adipisci, totam eum! <br>
            Necessitatibus quidem fugit deleniti ut libero, <br>
            sequi fuga neque aliquid nesciunt veniam fugiat.</div>
        <button class="main-btn">Get started</button>
    </section>
    <section class="section2">
        <h2>Reserve a Class</h2>
        <div id="reservation-form">
            <div class="item">
                <img src="assest/img/yoga.jpeg" alt="Yoga Class" class="card-image">
                <h4>YOGA</h4>
                <form action="">
                    <select id="class-select">
                        <option value="9:00 AM">Class-9:00 AM</option>
                        <option value="10:30 AM">Class-10:30 AM</option>
                        <option value="6:00 PM">Class-6:00 PM</option>
                    </select>
                    <button class="reserve-btn">Reserve</button>
                </form>
            </div>
            <div class="item">
                <img src="assest/img/zumba.jpeg" alt="Zumba Class" class="card-image">
                <h4>ZUMBA</h4>
                <form action="">
                    <select id="class-select">
                        <option value="9:00 AM">Class-9:00 AM</option>
                        <option value="10:30 AM">Class-10:30 AM</option>
                        <option value="6:00 PM">Class-6:00 PM</option>
                    </select>
                    <button class="reserve-btn">Reserve</button>
                </form>
            </div>
            <div class="item">
                <img src="assest/img/pilates.jpeg" alt="Pilates Class" class="card-image">
                <h4>PILATES</h4>
                <form action="">
                    <select id="class-select">
                        <option value="9:00 AM">Class-9:00 AM</option>
                        <option value="10:30 AM">Class-10:30 AM</option>
                        <option value="6:00 PM">Class-6:00 PM</option>
                    </select>
                    <button class="reserve-btn">Reserve</button>
                </form>
            </div>
        </div>
    </section>
 <!-- New Section for Reservations Table -->
 <section class="reservation-table">
    <h2>Your Reservations</h2>
    <table>
        <thead>
            <tr>
                <th>Class Name</th>
                <th>Time</th>
                <th>Reservation Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Yoga</td>
                <td>9:00 AM</td>
                <td>Reserved</td>
            </tr>
            <tr>
                <td>Zumba</td>
                <td>10:30 AM</td>
                <td>Reserved</td>
            </tr>
            <tr>
                <td>Pilates</td>
                <td>6:00 PM</td>
                <td>Available</td>
            </tr>
        </tbody>
    </table>
</section>
<section class="health-profile">
    <h2>Your Health Profile</h2>
    <form action="" class="health-form">
        <div class="form-group">
            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" placeholder="Enter your weight" required>
        </div>
        <div class="form-group">
            <label for="height">Height (cm):</label>
            <input type="number" id="height" name="height" placeholder="Enter your height" required>
        </div>
        <div class="form-group">
            <label for="goal">Fitness Goal:</label>
            <select id="goal" name="goal" required>
                <option value="lose-weight">Lose Weight</option>
                <option value="build-muscle">Build Muscle</option>
                <option value="maintain">Maintain</option>
            </select>
        </div>
        <div class="form-group">
            <label for="activity-level">Activity Level:</label>
            <select id="activity-level" name="activity-level" required>
                <option value="low">Low</option>
                <option value="moderate">Moderate</option>
                <option value="high">High</option>
            </select>
        </div>
        <button type="submit" class="submit-btn">Save Profile</button>
    </form>
</section>
<section class="contact-section">
    <h2>Contact Us</h2>
    <form action="" class="contact-form">
        <div class="form-group">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="message">Your Message:</label>
            <textarea id="message" name="message" placeholder="Enter your message" required></textarea>
        </div>
        <button type="submit" class="submit-btn">Send Message</button>
    </form>
</section>
</main>
<footer class="footer">
    <div class="footer-content">
        <div class="footer-logo">
            <i class="fa-solid fa-dumbbell"></i>
            <span>The Beasts Gym</span>
        </div>
        <div class="footer-social">
            <a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" class="social-icon"><i class="fa-brands fa-twitter"></i></a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 The Beasts Gym. All rights reserved.</p>
    </div>
</footer>
<script src="js/mainpage.js"></script>
</body>
</html>
