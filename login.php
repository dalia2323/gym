<?php
session_start();
include('handler/db.php');
if (isset($_POST['login'])) {
    global $conn;
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $errors = [];

    if (empty($email)) {
        $errors[] = "You should enter an email";
    }
    if(0){

      
    }
    if (!empty($email)) {
      $stm = "SELECT * FROM users WHERE email=? AND password=?";
    $q = $conn->prepare($stm);
    $q->bind_param("ss", $email, $password);
    $q->execute();
    $result = $q->get_result();

    if ($result->num_rows == 0) {
        $errors[] = "Incorrect email";
    } else {
        $data = $result->fetch_assoc();
        $_SESSION['user'] = [
            "name" => $data['name'],
            "email" => $email,
        ];
          $q->close(); 
        header('location: mainpage.php');
          exit(); 
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assest/css/login-style.css">

    <title>Document</title>
</head>
<body>
    <form action="" method="post"id="create-account-form">
        <h2 class="title">Login</h2>
        <div class="input-group">
        <input id="email" placeholder="hello@gmail.com" name="email" type="text">
</div>
<div class="input-group">
        <input id="password" placeholder="password" name="password" type="password">
</div>
        <div style="color:red;">
                    <?php 
                      if(isset($errors)){
                      if(!empty($errors)){
                      foreach($errors as $msg){
                        echo $msg . "<br>";
                        }
                      }
                  }?>
                </div>
        <button class="btn" type="submit" name="login">Submit</button>
    </form>   
</body>
    
</html>
