<?php
session_start();
if (!isset($_SESSION['employer_id'])) {
    header('Location: emplogin.php');
    exit();
}
include 'dab.php';

// Fetch job listings from the database
$stmt = $pdo->query('SELECT * FROM job_listings');
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    
}
echo "Job posted successfully!";


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>

    <style>
       body {
  font-family: Arial, sans-serif;
  background-color: chocolate;
  color: #333;
  margin: 0;
  padding: 0;
}

.dashboard-container {
  max-width: 800px;
  margin: 20px auto;
  padding: 20px;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  color: #555;
}

.logout-btn {
  text-align: right;
  margin-bottom: 20px;
}

.logout-btn a {
  color: #fff;
  background-color: #d9534f;
  padding: 10px 15px;
  text-decoration: none;
  border-radius: 5px;
}

.logout-btn a:hover {
  background-color: #c9302c;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

table th, table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

table th {
  background-color: #f4f4f9;
  font-weight: bold;
}

table tr:nth-child(even) {
  background-color: #f9f9f9;
}

table tr:hover {
  background-color: #f1f1f1;
}

table a {
  color: #007bff;
  text-decoration: none;
}

table a:hover {
  text-decoration: underline;
} 
    </style>
  <div class="dashboard-container">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['employer_name']); ?>!</h1>
    <div class="logout-btn">
      <a href="emplogout.php">Logout</a>
    </div>

    <h2>POSTED JOBS</h2>
    <table>
      <thead>
        <tr>
          <th>Job Title</th>
          <th>Company</th>
          <th>Location</th>
          <th>Contact Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($jobs): ?>
          <?php foreach ($jobs as $job): ?>
            <tr>
              <td><?php echo htmlspecialchars($job['job_title']); ?></td>
              <td><?php echo htmlspecialchars($job['company']); ?></td>
              <td><?php echo htmlspecialchars($job['location']); ?></td>
              <td><?php echo htmlspecialchars($job['email']); ?></td>
              <td>
                <a href="mailto:<?php echo htmlspecialchars($job['email']); ?>?subject=Job Application for <?php echo urlencode($job['job_title']); ?>">delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5">No job listings available at the moment.</td>
          </tr>
        <?php endif; ?>
      </tbody>