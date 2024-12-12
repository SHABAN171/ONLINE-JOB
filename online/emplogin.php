<?php
session_start();
include 'dab.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM employers WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $employer = $stmt->fetch();

    if ($employer && password_verify($password, $employer['password'])) {
        $_SESSION['employer_id'] = $employer['id'];
        $_SESSION['employer_name'] = $employer['name'];
        header('Location: empdashboard.php');
    } else {
        echo "Invalid email or password!";
    }
}
?>
<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employer Login</title>
</head>
<body>
    <style>
        /* General styles */


    </style>
    <form method="POST" action=""><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Login</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: sandybrown;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        /* Login form container */
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: bisque;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Form title */
        .login-container h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        /* Input fields */
        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-container input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }

        /* Submit button */
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: saddlebrown;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-container button:hover {
            background-color: #2980b9;
        }

        /* Additional styles for responsiveness */
        @media (max-width: 480px) {
            .login-container {
                padding: 15px;
               
            }

            .login-container h1 {
                font-size: 20px;
                
            }
        }
        .A{
            padding-top: 10px;
        
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Employer Login</h1>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <div class="A">
                <p>If you haven't an account <a href="empregister.php">REGISTER HERE</a></p>

            </div>
        </form>
    </div>
</body>
</html>