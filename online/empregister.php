<?php
include 'dab.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare('SELECT * FROM employers WHERE email = :email');
    $stmt->execute(['email' => $email]);
    if ($stmt->fetch()) {
        echo "Employer with this email already exists!";
    } else {
        $stmt = $pdo->prepare('INSERT INTO employers (name, email, password) VALUES (:name, :email, :password)');
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
        echo "Registration successful!";
        header('Location: emplogin.php');
    }
}
?>
<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employer Registration</title>
</head>
<body>
    <style>
        /* General styles for the Register Form */


    </style>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Name" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Register</button>
    </form>
</body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Registration</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: saddlebrown;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        /* Registration form container */
        .register-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Form title */
        .register-container h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        /* Input fields */
        .register-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .register-container input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }

        /* Submit button */
        .register-container button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .register-container button:hover {
            background-color: #2980b9;
        }

        /* Additional styles for responsiveness */
        @media (max-width: 480px) {
            .register-container {
                padding: 15px;
            }

            .register-container h1 {
                font-size: 20px;
            }
        }
        .L{
padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Employer Registration</h1>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Name" required><br><br>
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <button type="submit">Register</button><br>
          <div class="L">
          <p>If you have an account <a href="emplogin.php">LOGIN  HERE</p></a>
          </div>
        </form>
    </div>
</body>
</html>