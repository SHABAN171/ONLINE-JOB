<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);

    // Check if user exists in the database
    $stmt = $pdo->prepare('SELECT * FROM jobfinder WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Login successful, create session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['firstname'];
        header('Location: dashboard.php'); // Redirect to a dashboard or homepage
        exit();
    } else {
        // Login failed
        $error = "Invalid email or password. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="login-container">
    <form action="#" method="post" class="login-form">
      <h2><marquee behavior="" direction="">Login here</marquee></h2>
      <div class="form-group">
        
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        
        <input type="password" id="password" name="password" placeholder="Enter your password please" required>
      </div>
      <div class="form-group">
        <button type="submit" class="login-btn">Login</button>
      </div>
      <div>
        <p>If you don't have an account <a href="register.php"><br> REGISTER HERE</a></p>
      </div>
    </form>
  </div>
</body>
</html>