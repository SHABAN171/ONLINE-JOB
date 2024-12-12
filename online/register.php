<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user input
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);
    $password = trim($_POST['password']); // Separate confirmation field
    $phone = htmlspecialchars(trim($_POST['phone']));
    $country = htmlspecialchars(trim($_POST['country']));

    // Validate input
    if ($password !== $password) {
        echo "Passwords do not match! Please try again.";
    } elseif (strlen($password) < 6) {
        echo "Password must be at least 6 characters long.";
    } else {
        // Check if the email already exists
        $stmt = $pdo->prepare('SELECT * FROM jobfinder WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            echo "Email already exists!";
        } else {
            // Hash the password for secure storage
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into the database
            $stmt = $pdo->prepare('INSERT INTO jobfinder (firstname, lastname, email, password, phone, country) 
                                   VALUES (:firstname, :lastname, :email, :password, :phone, :country)');
            try {
                $stmt->execute([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'password' => $hashed_password,
                    'phone' => $phone,
                    'country' => $country
                ]);
                echo "Registration successful!";
                header('Location: login.php');
                exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link rel="stylesheet" href="register.css">
</head>
<body>
  <div class="form-container">
    <form action=" " method="POST" class="register-form">
      <h2>Register</h2>
      
      <div class="form-group">
        <input type="text" id="firstname" name="firstname" placeholder="Firstname" required>
      </div>

      <div class="form-group">
        <input type="text" id="lastname" name="lastname" placeholder="Lastname" required>
      </div>

      <div class="form-group">
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <input type="password" id="password" name="password" placeholder="Your password please" required>
      </div>
      <div class="form-group">
        <input type="password" id="password" name="password" placeholder="Confirm your password" required>
      </div>
   <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" required>
      </div>

      <div class="form-group">
        <!-- <label>Gender</label> -->
        <div class="gender-options">
          <!-- <input type="radio" id="male" name="gender" value="male" required>
          <label for="male">Male</label> -->

          <!-- <input type="radio" id="female" name="gender" value="female" required>
          <label for="female">Female</label> -->
        </div>
      </div>

      <div class="form-group">
        <label for="country">Country</label>
        <select id="country" name="country" required>
          <option value="" disabled selected>Select your country</option>
          <option value="TAN">Tanzania</option>
          <option value="KEN">Kenya</option>
          <option value="UGA">Uganda</option>
          <option value="RWA">Rwanda</option>
          <option value="CON">Congo</option>
          <option value="BUR">Burundi</option>

        </select>
      </div>

      <div class="form-group">
        <button type="submit" class="submit-btn">Submit</button>
      </div>
      
      <div class="farm-group">
        <button type="reset" class="reset-btn"><a href="register.php"></a>Reset</button><br><br>
        <p>If you have an account, please <br> <a href="login.php"> LOG IN HERE!!</a></p>
      </div>
    </form>
  </div>
</body>
</html>
