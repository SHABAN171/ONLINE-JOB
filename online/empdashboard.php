<?php
session_start();
if (!isset($_SESSION['employer_id'])) {
    header('Location: emplogin.php');
    exit();
}
include 'dab.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_title = $_POST['job_title'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $email = $_POST['email'];
    $employer_id = $_SESSION['employer_id'];

    $stmt = $pdo->prepare('INSERT INTO job_listings (job_title, company, location, email, employer_id) VALUES (:job_title, :company, :location, :email, :employer_id)');
    $stmt->execute([
        'job_title' => $job_title,
        'company' => $company,
        'location' => $location,
        'email' => $email,
        'employer_id' => $employer_id
    ]);
    header('Location: employerjobs.php');
    exit();
    echo "Job posted successfully!";
}
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <title>Employer Dashboard</title>
</head>
<body>
    <style>
        /* Dashboard styles */


    </style>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['employer_name']); ?>!</h1>
    <a href="logout.php">Logout</a>
    <h2>Post a New Job</h2>
    <form method="POST" action="">
        <input type="text" name="job_title" placeholder="Job Title" required><br><br>
        <input type="text" name="company" placeholder="Company Name" required><br><br>
        <input type="text" name="location" placeholder="Location" required><br><br>
        <input type="email" name="email" placeholder="Contact Email" required><br><br>
        <button type="submit">Post Job</button>
    </form>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Dashboard</title>
    <style>
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: lightgray;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Dashboard container */
        .dashboard {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Header styles */
        .dashboard h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .dashboard h2 {
            font-size: 20px;
            margin-top: 20px;
            color: #34495e;
        }

        /* Form styles */
        form {
            display: flex;
            flex-direction: column;
        }

        form input,
        form button {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        form input:focus {
            outline: none;
            border-color: #3498db;
        }

        form button {
            background-color: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #2980b9;
        }

        /* Logout button */
        .logout-container {
            margin-top: auto; /* Push logout button to the bottom */
            text-align: center;
            padding: 10px 0;
        }

        .logout-container a {
            text-decoration: none;
            font-size: 16px;
            color: #e74c3c;
            padding: 10px 20px;
            border: 1px solid #e74c3c;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .logout-container a:hover {
            background-color: #e74c3c;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['employer_name']); ?>!</h1>

        <h2>Post a New Job</h2>
        <form method="POST" action="">
            <input type="text" name="job_title" placeholder="Job Title" required>
            <input type="text" name="company" placeholder="Company Name" required>
            <input type="text" name="location" placeholder="Location" required>
            <input type="email" name="email" placeholder="Contact Email" required>
            <button type="submit">Post Job</button>
        </form>

        <div class="logout-container">
            <a href="emplogout.php">Logout</a>
        </div>
    </div>
</body>
</html>