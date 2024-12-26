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

$sql = "SELECT class_name, class_description FROM class";
$result = $conn->query($sql);

$user_id = $_SESSION['user'];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['class_id'])) {
    $class_id = intval($_POST['class_id']);
    $stmt = $conn->prepare("INSERT INTO reservation (class_id, user_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $class_id, $user_id);

    if (!$stmt->execute()) {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$sql1 = "SELECT class_id, class_name, class_description FROM class";
$result = $conn->query($sql1);
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
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $class_id = $row['class_id'];
                $className = htmlspecialchars($row['class_name']);
                $description = htmlspecialchars($row['class_description']);
                $imagePath = "assest/img/" . strtolower($className) . ".jpeg";

                echo "<div class='item'>";
                echo "  <form action='' method='post'>";
                echo "<img src='$imagePath' alt='{$className} Class' class='card-image'>";
                echo "<h4>" . strtoupper($className) . "</h4>";
                echo "<p>$description</p>";
                echo "<input type='hidden' name='class_id' value='$class_id'>";
                echo "<button type='submit' name='reserve' class='reserve-btn'>Reserve</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "<p>No classes available at the moment.</p>";
        }
        ?>
    </div>
</section>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reserve'])) {
    $class_id = intval($_POST['class_id']);
    $user_id = $_SESSION['user'];

    $checkSql = "SELECT * FROM reservation WHERE user_id = ? AND class_id = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("ii", $user_id, $class_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
    } else {
        $insertSql = "INSERT INTO reservation (user_id, class_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param("ii", $user_id, $class_id);

        if ($stmt->execute()) {
            echo "<p>Reservation successful!</p>";
        } else {
            echo "<p>Failed to reserve the class. Please try again.</p>";
        }
    }

    $stmt->close();
}

$conn->close();
?>
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
