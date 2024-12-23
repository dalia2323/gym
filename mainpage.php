<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit();
}
include('handler/db.php');
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
$name = $_SESSION['user']['email'];
if (isset($_POST['submit-btn-info'])) {
    $height = filter_var($_POST['height'], FILTER_SANITIZE_STRING);
    $weight = filter_var($_POST['weight'], FILTER_SANITIZE_STRING);
    $weightGoal = filter_var($_POST['WeightGoal'], FILTER_SANITIZE_STRING);
    // echo "Height: $height, Weight: $weight, Weight Goal: $weightGoal <br>";
    $query = "UPDATE users 
            SET weight = '$weight', height = '$height', goalWeight = '$weightGoal'
            WHERE email = '$name'";
    if (mysqli_query($conn, $query)) {
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
$query = "SELECT height, weight, goalWeight FROM users WHERE email = '$name'";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $height = $row['height'];
    $weight = $row['weight'];
    $weightGoal = $row['goalWeight'];
} else {
    $height = $weight = $weightGoal = "Not set";
}
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
        <div>
        </div>
    </section>
    <section class="section2">
        <h2>Reserve a Class</h2>
        <div id="reservation-form">
            <div class="item">
                <img src="assest/img/yoga.jpeg" alt="Yoga Class" class="card-image">
                <h4>YOGA</h4>
                <form action="">
                    <!-- <select id="class-select">
                        <option value="9:00 AM">Class-9:00 AM</option>
                        <option value="10:30 AM">Class-10:30 AM</option>
                        <option value="6:00 PM">Class-6:00 PM</option>
                    </select> -->
                    <button class="reserve-btn">Reserve</button>
                </form>
            </div>
            <div class="item">
                <img src="assest/img/zumba.jpeg" alt="Zumba Class" class="card-image">
                <h4>ZUMBA</h4>
                <form action="">
                    <!-- <select id="class-select">
                        <option value="9:00 AM">Class-9:00 AM</option>
                        <option value="10:30 AM">Class-10:30 AM</option>
                        <option value="6:00 PM">Class-6:00 PM</option>
                    </select> -->
                    <button class="reserve-btn">Reserve</button>
                </form>
            </div>
            <div class="item">
                <img src="assest/img/pilates.jpeg" alt="Pilates Class" class="card-image">
                <h4>PILATES</h4>
                <form action="">
                    <!-- <select id="class-select">
                        <option value="9:00 AM">Class-9:00 AM</option>
                        <option value="10:30 AM">Class-10:30 AM</option>
                        <option value="6:00 PM">Class-6:00 PM</option>
                    </select> -->
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
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Yoga</td>
            </tr>
            <tr>
                <td>Zumba</td>
            </tr>
            <tr>
                <td>Pilates</td>
            </tr>
        </tbody>
    </table>
</section>
<section class="health-profile">
    <h2>Your Health Profile</h2>
    <form action="" method="post" class="health-form" id="health-form">
    <div class="form-group">
        <label for="weight">Weight (kg):</label>
        <input type="number" id="weight" name="weight" placeholder="Enter your weight" required>
    </div>
    <div class="form-group">
        <label for="height">Height (cm):</label>
        <input type="number" id="height" name="height" placeholder="Enter your height" required>
    </div>
    <div class="form-group">
        <label for="WeightGoal">Weight Goal (kg):</label>
        <input type="number" id="WeightGoal" name="WeightGoal" placeholder="Enter your goal weight" required>
    </div>
    <button type="submit" name="submit-btn-info" class="submit-btn-info">Save Profile</button>
</form>
</section>
<section class="reservation-table">
    <h2>Your Health Tracker</h2>
    <table>
        <thead>
            <tr>
                <th>Height</th>
                <th>Weight</th>
                <th>Weight Goal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>  <?php echo htmlspecialchars($height); ?></td>
                <td><?php echo htmlspecialchars($weight); ?></td>
                <td><?php echo htmlspecialchars($weightGoal); ?></td>
            </tr>
        </tbody>
    </table>
    <button class="updateinfo">UPDATE</button>
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
